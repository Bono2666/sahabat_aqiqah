<?php


function optionnya_fix2($id) {
    global $wpdb;

    $table_name3 = $wpdb->prefix . "users";
    // $users = $wpdb->get_results('SELECT ID,display_name from '.$table_name3.' ');
    
    $blogs = array();
    $args = array( 'blog_id' => 0 );
    $users = get_users( $args );


    $var_optionnya2 = '<option value="">Choose CS</option>';
    foreach ($users as $data ) {

        if ($data->ID==$id) {
            $selected = 'selected="selected"';
        }else{
            $selected = "";
        }
        $nama_user = str_replace("'", "", $data->display_name);
        $var_optionnya2 .= '<option value="'.$data->ID.'" '.$selected.'>'.$nama_user.'</option>';
    
    }
    return $var_optionnya2;
}

function magic_order_update_cs() {
    mgo_global_vars();
    $expired = $GLOBALS['mgovars']['expired'];
    $date_expired = $GLOBALS['mgovars']['date_expired'];
    $plugin_name = $GLOBALS['mgovars']['plugin_name'];
    $plugin_version = $GLOBALS['mgovars']['plugin_version'];
    $plugin_license = $GLOBALS['mgovars']['plugin_license'];
    $plugin_license_info = $GLOBALS['mgovars']['plugin_license_info'];
    $apikey = $GLOBALS['mgovars']['apikey'];
    $apikey_status = $GLOBALS['mgovars']['apikey_status'];
    
    global $wpdb;
    
    $table_name = $wpdb->prefix . "cf_forms";
    $table_name2 = $wpdb->prefix . "mgo_calculation";
    $table_name3 = $wpdb->prefix . "users";
    $id = isset($_GET['id']) ? $_GET['id'] : '';

    //update
    if (isset($_POST['update'])) {

        $id_cs = $_POST['id_cs'];
        $cs_bobot = str_replace('\\', '', $_POST['bobot_cs']);


        $jumlah_form = $wpdb->get_var('SELECT * from '.$table_name2.' where id_form="'.$id.'"');
        if($jumlah_form>=1){
            $wpdb->update(
                    $table_name2, //table
                    array('id_cs' => $id_cs, 'cs_bobot' => $cs_bobot), //data
                    array('id_form' => $id), //where
                    array('%s'), //data format
                    array('%s') //where format
            );
        }else {
            $wpdb->insert(
                $table_name2, //table
                array('id_form' => $id, 'field_form' => '', 'rumus_calculation' => '', 'id_cs' => $id_cs, 'cs_bobot' => $cs_bobot), //data
                array('%s', '%s') //data format         
            );
        }
        

        $row = $wpdb->get_results('SELECT * from '.$table_name.' where form_id="'.$id.'" and type="primary"');
        $row = $row[0];
        $dataconfig = json_encode(maybe_unserialize( $row->config ));
        $datajson = json_decode($dataconfig);
        $fields = $datajson->layout_grid->fields;
        $judul_form = $datajson->name;

        $row2 = $wpdb->get_results('SELECT * from '.$table_name2.' where id_form="'.$id.'"');
        $id_cs = $row2[0]->id_cs;
        $cs_bobot = $row2[0]->cs_bobot;

    } else {

            $row = $wpdb->get_results('SELECT * from '.$table_name.' where form_id="'.$id.'" and type="primary"');
            $row = $row[0];
            $dataconfig = json_encode(maybe_unserialize( $row->config ));
            $datajson = json_decode($dataconfig);
            $fields = $datajson->layout_grid->fields;
            $judul_form = $datajson->name;

            $row2 = $wpdb->get_results('SELECT * from '.$table_name2.' where id_form="'.$id.'"');
            if($row2==null){
                $id_cs = '';
                $cs_bobot = '{"":""}';
            }else{
                $id_cs = $row2[0]->id_cs;
                $cs_bobot = $row2[0]->cs_bobot;
            }

    }
    ?>
    <link type="text/css" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/style-admin.css?ver=<?php echo $plugin_version; ?>" rel="stylesheet" />
    <style>
        .bobot-cs {
            position: absolute;display:inline;padding: 5px 7px;border-radius: 4px;color: #6c61f6;font-weight: bold;
        }
        .opt-plus {
            display: none;
        }
    <style>
    
    </style>
    <div class="wrap plugin_info"><h2 class="title" style="display: none;"></h2>
        <?php
            
            // Get USER ROLES
            $cap = get_user_meta( wp_get_current_user()->ID, $wpdb->get_blog_prefix() . 'capabilities', true );
            $roles = array_keys((array)$cap);
            $role = $roles[0];
            ?>

            <?php
            $id = isset($_POST['update']) ? $_POST['update'] : '';
            if (isset($_POST['update'])) { ?>
            <div class="updated"><p>Customer Service Updated.</p></div>
            <?php } ?>
    </div>
    <div class="wrap" style="box-shadow: 0 4px 25px 0 rgba(0,0,0,.1);border-radius: 4px;">
        <div class="sub-title" style="padding-bottom: 40px;margin-top: 18px;">
            <header class="mgo-header">
                <h1 class="mgo-logo"><img class="icon-title2" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/magic-order-icon2.png"></h1>
            </header> 

            <?php

            if($apikey=='' || $apikey_status!='valid'){
                echo '
                <div class="sub-title-info"><span>API Key tidak valid atau belum tersedia, silahkan update API Key anda. <a href="'.site_url().'/wp-admin/admin.php?page=magic_order_api" style="text-decoration: none;">[ Update ]</a></span></div>';
                return false;
            }

            if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
                echo '
                <div class="sub-title-info"><span>Plugin Caldera Forms belum terinstall, silahkan install terlebih dahulu! <a href="'.site_url().'/wp-admin/plugin-install.php?s=caldera+forms&tab=search&type=term" style="text-decoration: none;">[ INSTALL ]</a></span></div>
                ';
                return false;
            }

            if($expired!='allowed'){
                echo '
                <div class="sub-title-info"><span>Maaf, plugin anda Expired. <a href="https://member.sinkronus.com" style="text-decoration: none;">[ Extend Now ]</a></span></div>
                ';
                return false;
            }

            // CUSTOMER SERVICES (EDITOR ROLE)
            if($role!='administrator'){
                echo '
                <div class="sub-title-info"><span>This menu is only for administrator!</span></div>
                 ';
                return false;
            }

            if($plugin_license=='FREEMIUM' || $plugin_license=='STARTER'){
                echo '
                <div class="sub-title-info"><span>Maaf, fitur ini hanya untuk BASIC dan PRO License.</span></div>
                 ';
                return false;
            }

        ?>

            <div class="page-title"><a href="<?php echo admin_url('admin.php?page=magic_order_form') ?>" style="text-decoration: none;margin-left: 10px;" class="mgo_link"><span>Form Lists</span></a><span><span class="dashicons dashicons-arrow-right-alt2"></span><span class="dashicons dashicons-arrow-right-alt2" style="margin-left: -15px;"></span></span><span>CS <b><?php echo $judul_form; ?></b></span></div>
        </div>

            <div class="wrap-container"  style="margin-top: -80px;">
            <form id="form_calculation" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <table class='wp-list-table widefat fixed' style="padding: 0px 0px;border: 0;background: #fff;margin-bottom: 30px;margin-top: 10px;">
                    <tr id="first-line">
                        <td>
                            <h3 style="margin-bottom: 5px;">Customer Service:</h3>
                        </td>
                    </tr>
                    <?php 

                            // OPTIONS
                            // $users = $wpdb->get_results('SELECT ID,display_name from '.$table_name3.' ');
                            $blogs = array();
                            $args = array( 'blog_id' => 0 );
                            $users = get_users( $args );

                            $optionnya = '<option value="">Choose CS</option>';
                            foreach ($users as $data ) {
                                $nama_user = str_replace("'", "", $data->display_name);
                                $optionnya .= '<option value="'.$data->ID.'">'.$nama_user.'</option>';
                            }

                            $fields = json_decode($cs_bobot, true);

                            if(!empty($fields)){
                                // get total 
                                $total_bobot = 0;
                                foreach ($fields as $key => $value ) {
                                    $total_bobot = $total_bobot+$value;
                                }

                                $no = 1;
                                // $total_priority = 0;
                                foreach ($fields as $key => $value ) {

                                    // $id_csnya = $key;
                                    $id_csnya_data = explode("_", $key);
                                    $id_csnya = $id_csnya_data[0];

                                    $bobot_csnya = $value;
                                    $persen_cs = ($bobot_csnya/$total_bobot)*100;

                                    $rand_id = RandomString(4);

                                    $option_bobotnya = '';
                                    for($c=1; $c <= 10; $c++) {
                                        $selected = '';
                                        if($c==$bobot_csnya){
                                          $selected = 'selected';
                                        }
                                        $option_bobotnya .= '<option data-id="'.$rand_id.'" value="'.$c.'" '.$selected.'>'.$c.'</option>';
                                    }

                                    $option_calc = '<select name="op-'.$rand_id.'" class="calc opt-plus"><option value="cs">+</option></select>';
                                    $button_delete = '<input type="button" name="update" title="Delete" value="&nbsp;-&nbsp;" class="button btn-del btn_red_line" style="margin-left:30px;" onclick=del("'.$rand_id.'")>';
                                    
                                    
                                    if($no==1){
                                        $option_calc = '';
                                        $button_delete = '';
                                    }
                                    
                                    echo '
                                    <tr id="tr-'.$rand_id.'"><td>'.$option_calc.'
                                    <select name="select-'.$rand_id.'" id="select-'.$rand_id.'" data-id="'.$rand_id.'" class="calc select-var">'.optionnya_fix2($id_csnya).'</select>
                                    &nbsp;<select title="Bobot CS" class="cs_priority cs_'.$rand_id.'" onclick="run_persen()">'.$option_bobotnya.'</select>&nbsp;&nbsp;&nbsp;&nbsp;<div style="" class="bobot-cs" title="Bobot Lead CS yang akan diterima"><span class="hasil_persen persen_'.$rand_id.'" data-id="'.$rand_id.'">'.number_format($persen_cs, 1, '.', '').'%</span></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$button_delete.'</td></tr>';

                                    $no++;
                                }
                            }else{
                            // SHOW CS FROM DB
                            $array_cs = explode(',', $id_cs);
                            $count_array_cs = count($array_cs);
                            $no = 1; // first option
                            foreach ($array_cs as $key => $value) {

                                $persen_cs = (1/$count_array_cs)*100;

                                $rand_id = RandomString(4);

                                $option_bobotnya = '';
                                for($c=1; $c <= 10; $c++) {
                                    $selected = '';
                                    if($c==1){
                                      $selected = 'selected';
                                    }
                                    $option_bobotnya .= '<option data-id="'.$rand_id.'" value="'.$c.'" '.$selected.'>'.$c.'</option>';
                                }

                                $bobotnya = '';
                                for($c=1; $c <= 10; $c++) {
                                    $bobotnya .= '<option data-id="'.$rand_id.'" value="'.$c.'">'.$c.'</option>';
                                }

                                $option_calc = '<select name="op-'.$rand_id.'" class="calc opt-plus"><option value="cs">+</option></select>';
                                $button_delete = '<input type="button" name="update" title="Delete" value="&nbsp;-&nbsp;" class="button btn-del btn_red_line" style="margin-left:30px;" onclick=del("'.$rand_id.'")>';
                                
                                
                                if($no==1){
                                    $option_calc = '';
                                    $button_delete = '';
                                }

                                $id_csnya = $value;

                                echo '
                                    <tr id="tr-'.$rand_id.'"><td>'.$option_calc.'
                                    <select name="select-'.$rand_id.'" id="select-'.$rand_id.'" data-id="'.$rand_id.'" class="calc select-var">'.optionnya_fix2($id_csnya).'</select>
                                    &nbsp;<select title="Bobot CS" class="cs_priority cs_'.$rand_id.'" onclick="run_persen()">'.$option_bobotnya.'</select>&nbsp;&nbsp;&nbsp;&nbsp;<div style="" class="bobot-cs" title="Bobot Lead CS yang akan diterima"><span class="hasil_persen persen_'.$rand_id.'" data-id="'.$rand_id.'">'.number_format($persen_cs, 1, '.', '').'%</span></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$button_delete.'</td></tr>';

                                $no++;
                            
                            }
                        }
                         

                        ?>
                    <tr id="line">
                    </tr>
                    <tr>
                        <td>
                            <button id="add_line" type='button' name="update" class='button btn_mgo' style="margin-top: 10px;"><span class="dashicons dashicons-plus" style="margin-top:6px;margin-right:2px;font-size: 16px;"></span>Add Line</button>
                        </td>
                    </tr>

                    <tr><td></td></tr>
                    <tr>
                        <td>
                            <!-- <hr> -->
                        </td>
                    </tr>
                    <tr style="display: none;"><td>
                        <textarea name="id_cs" id="hasil-calc" cols="100" rows="2" readonly="" style="display: inline;"><?php echo $id_cs;?></textarea>
                        <textarea name="bobot_cs" id="bobot_cs" cols="100" rows="2" readonly="" style="display: inline;"><?php echo $cs_bobot;?></textarea>
                        </td>
                    </tr>
                </table>
                <input type='submit' id="save" name="update" value='Save CS' class='button btn_mgo_new_purple' style="margin-left: 10px !important;"> &nbsp;&nbsp;
                
            </form>
            </div>
        

    </div>
<script type='text/javascript' src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/jquery-2.1.1.min.js?ver=<?php echo $plugin_version; ?>"></script>
<script>
    var ALPHABET = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    var ID_LENGTH = 4;
    var generate = function() {
      var rtn = '';
      for (var i = 0; i < ID_LENGTH; i++) {
        rtn += ALPHABET.charAt(Math.floor(Math.random() * ALPHABET.length));
      }
      return rtn;
    }

    function del(a){
        $('#tr-'+a).remove();
        run_persen();
    }

    $("form").submit(function(){

        var selected_val = $.map($(".select-var"), function(a){
            return a.value;
        }).join(",");

        var arr = selected_val.split(",");
        
        if(arr.length>1){
            for (i=0; i<=arr.length; i++) {
                if (arr[i] == "") {
                    alert("Maaf, ada field CS yang belum anda pilih!");
                    return false;
                }
            }
        }

    });

    $('#del_form_generate').bind('click', function(){
        $('#hasil-calc').val('');
    });


    $(document).on("change", ".select-var", function(e) {
        run_idcs();
        run_persen();
    });

    $('#add_line').bind('click', function(){
        var idnya = generate();
        var option = '<?php echo $optionnya; ?>';
        var content = '<tr id="tr-'+idnya+'"><td><select name="op-'+idnya+'" class="calc opt-plus"><option value="cs">+</option></select><select name="select-'+idnya+'" id="select-'+idnya+'" class="calc select-var">'+option+'</select>&nbsp;&nbsp;<select title="Bobot CS" class="cs_priority cs_'+idnya+'" onclick="run_persen()"><option data-id="'+idnya+'" value="1" selected="">1</option><option data-id="'+idnya+'" value="2">2</option><option data-id="'+idnya+'" value="3">3</option><option data-id="'+idnya+'" value="4">4</option><option data-id="'+idnya+'" value="5">5</option><option data-id="'+idnya+'" value="6">6</option><option data-id="'+idnya+'" value="7">7</option><option data-id="'+idnya+'" value="8">8</option><option data-id="'+idnya+'" value="9">9</option><option data-id="'+idnya+'" value="10">10</option></select>&nbsp;&nbsp;&nbsp;&nbsp;<div style="" class="bobot-cs" title="Bobot Lead CS yang akan diterima"><span class="hasil_persen persen_'+idnya+'" data-id="'+idnya+'"></span></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="update" title="Delete" value="&nbsp;-&nbsp;" style="margin-left: 23px;" class="button btn-del btn_red_line" onclick=del("'+idnya+'")></td></tr>';
        $('#line').append(content);
        run_persen();
    });

    function run_idcs() {
        var selected_val = $.map($(".select-var"), function(a){
                return a.value;
        }).join(',');

        $('#hasil-calc').val(selected_val);
    }

    function run_persen(){
        
        run_idcs();

        var arr_cs_priority = $('select.cs_priority').map(function(){
            console.log("oke "+this.value);
            return this.value;

        }).get().toString();

        var str3 = arr_cs_priority;
        var str3_array = str3.split(',');

        total_priority = 0;
        var len2 = str3_array.length;
        for(var i = 0; i < str3_array.length; i++) {
            nilai = parseFloat(str3_array[i]);
            total_priority = total_priority+nilai;
        }

        var new_selected = [];
        $(".hasil_persen").each(function(){
                new_selected.push($(this).data('id'));
        });
        new_selected = new_selected.toString();

        var array = new_selected.split(',');

        arrayLength = array.length;
        arr_bobot_cs = '';
        no = 1;
        for (var i = 0; i < arrayLength; i++) {
            if(array[i]!=0){

                id_ne = array[i];
                var valuenya = $('#tr-'+id_ne+' select.cs_priority').find('option:selected').val();

                hasil_persennya = (valuenya/total_priority)*100;
                $('.persen_'+id_ne).text(hasil_persennya.toFixed(1)+'%');

                var id_csnya = $('#select-'+id_ne).find('option:selected').val();

                // console.log(id_ne);
                // console.log(id_csnya);
                // console.log(valuenya);

                if(i==0){
                    arr_bobot_cs = '';
                }
                if(arrayLength==no){
                    arr_bobot_cs += '"'+id_csnya+'_'+id_ne+'"' + ":" + '"'+valuenya+'"';
                }else{
                    arr_bobot_cs += '"'+id_csnya+'_'+id_ne+'"' + ":" + '"'+valuenya+'"' + ',';
                }
            }
            no++;
        }
        $('#bobot_cs').val('{'+arr_bobot_cs+'}');
    }


</script>
    <?php
}
