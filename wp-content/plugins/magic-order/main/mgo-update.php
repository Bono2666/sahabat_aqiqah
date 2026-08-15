<?php


function optionnya_fix($var) {
    global $wpdb;
    $table_name = $wpdb->prefix . "cf_forms";
    $id = $_GET["id"];
    
    $row = $wpdb->get_results('SELECT * from '.$table_name.' where form_id="'.$id.'" and type="primary"');
    $row = $row[0];
    $dataconfig = json_encode(maybe_unserialize( $row->config ));
    $datajson = json_decode($dataconfig);
    $fields = $datajson->layout_grid->fields;
    
    $var_optionnya = '';

    foreach ($fields as $key => $value ) {
    $nama_class = $datajson->fields->$key->config->custom_class;
    $pieces = explode(" ", $nama_class);
    $nama_class = $pieces[0];

    $type_input = $datajson->fields->$key->type;
        if($nama_class!=""){
            $value = $nama_class.":".$type_input;
            $isi = $var;

            if($isi==$value){
                $selected = 'selected="selected"';
            }else{
                $selected = "";
            }

            if (strpos($nama_class, 'mgo_kecamatan') !== false || strpos($nama_class, 'mgo_total') !== false || strpos($nama_class, 'mgo_orderid') !== false || strpos($nama_class, 'mgo_csid') !== false || strpos($nama_class, 'mgo_csmail') !== false || strpos($nama_class, 'mgo_provinsi') !== false || strpos($nama_class, 'mgo_kabkota') !== false || strpos($nama_class, 'btn_buy') !== false) {
                $disabled = 'disabled="disabled"';
            }else{
                $disabled = "";
            }
            
            $var_optionnya .= '<option value="'.$nama_class.':'.$type_input.'" '.$selected.' '.$disabled.'>'.$nama_class.'</option>';
        }
    }

    return $var_optionnya;

}

function magic_order_update() {
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
    $id = isset($_GET['id']) ? $_GET['id'] : '';

    //update
    if (isset($_POST['update'])) {

        $text = str_replace('\\', '', $_POST["field_form"]);
        $keyword = '":"';
        $field_form = preg_replace_callback('/' . preg_quote($keyword) . '/', 
          function() { return '_x'.mt_rand().'":"'; }, $text);

        $rumus_calculation = $_POST['rumus_calculation'];
        
        $jumlah_form = $wpdb->get_var('SELECT * from '.$table_name2.' where id_form="'.$id.'"');
        if($jumlah_form>=1){
            $wpdb->update(
                $table_name2, //table
                array('field_form' => $field_form), //data
                array('id_form' => $id), //where
                array('%s'), //data format
                array('%s') //where format
            );
            $wpdb->update(
                    $table_name2, //table
                    array('rumus_calculation' => $rumus_calculation), //data
                    array('id_form' => $id), //where
                    array('%s'), //data format
                    array('%s') //where format
            );
        }else {
            $wpdb->insert(
                $table_name2, //table
                array('id_form' => $id, 'field_form' => $field_form, 'rumus_calculation' => $rumus_calculation), //data
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
        $field_form = $row2[0]->field_form;
        $rumus_calculation = $row2[0]->rumus_calculation;
    }
    
    else {

        
            $row = $wpdb->get_results('SELECT * from '.$table_name.' where form_id="'.$id.'" and type="primary"');
            $row = $row[0];
            $dataconfig = json_encode(maybe_unserialize( $row->config ));
            $datajson = json_decode($dataconfig);
            $fields = $datajson->layout_grid->fields;
            $judul_form = $datajson->name;

            $row2 = $wpdb->get_results('SELECT * from '.$table_name2.' where id_form="'.$id.'"');
            if($row2==null){
                $field_form = '';
                $rumus_calculation = '';
            }else{
                $field_form = $row2[0]->field_form;
                $rumus_calculation = $row2[0]->rumus_calculation;
            }

    }
    ?>
    <link type="text/css" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/style-admin.css?ver=<?php echo $plugin_version; ?>" rel="stylesheet" />
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
            <div class="updated"><p>Formula Updated.</p></div>
        <?php } ?>
    </div>

    <div class="wrap" style="box-shadow: 0 4px 25px 0 rgba(0,0,0,.1);border-radius: 4px;">
        <div class="sub-title" style="padding-bottom: 40px;margin-top: 18px;">
            <header class="mgo-header">
                <h1 class="mgo-logo"><img class="icon-title2" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/magic-order-icon2.png"></h1>
                <div class="step-indicator" style="display: none;">
                  <a class="step completed">Form List</a>
                </div>
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

        ?>

            <div class="page-title"><a href="<?php echo admin_url('admin.php?page=magic_order_form') ?>" style="text-decoration: none;margin-left: 10px;" class="mgo_link"><span>Form Lists</span></a><span><span class="dashicons dashicons-arrow-right-alt2"></span><span class="dashicons dashicons-arrow-right-alt2" style="margin-left: -15px;"></span></span><span>Formula <b><?php echo $judul_form; ?></b></span></div>
        </div>

        <div class="wrap-container" style="margin-top: -80px;">
        <form id="form_calculation" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <table class='wp-list-table widefat fixed' style="padding: 0px 0px;border: 0;background: #fff;margin-bottom: 30px;margin-top: 10px;">
                <tr id="first-line">
                    <td>
                        <h3 style="margin-bottom: 5px;">Operation:</h3>
                        <select class="select-var" style="display: none;">
                        <option value="mgo_kecamatan:text" selected="selected">mgo_kecamatan</option>
                        </select>
                        <?php 
                            $optionnya = '';
                            foreach ($fields as $key => $value ) {
                                $nama_class = $datajson->fields->$key->config->custom_class;
                                $pieces = explode(" ", $nama_class);
                                $nama_class = $pieces[0];
                                $type_input = $datajson->fields->$key->type;
                                if($nama_class!=""){

                                    if (strpos($nama_class, 'mgo_ongkir') !== false) {
                                        $selected = 'selected="selected"';
                                    }else{
                                        $selected = "";
                                    }

                                    if (strpos($nama_class, 'mgo_kecamatan') !== false) {
                                        $disabled = 'disabled="disabled"';

                                    }else{
                                        $disabled = "";
                                    }

                                    if (strpos($nama_class, 'mgo_total') !== false) {
                                        $disabled2 = 'disabled="disabled"';
                                    }else{
                                        $disabled2 = "";
                                    }

                                    if (strpos($nama_class, 'mgo_orderid') !== false) {
                                        $disabled3 = 'disabled="disabled"';
                                    }else{
                                        $disabled3 = "";
                                    }

                                    if (strpos($nama_class, 'mgo_csid') !== false) {
                                        $disabled4 = 'disabled="disabled"';
                                    }else{
                                        $disabled4 = "";
                                    }

                                    if (strpos($nama_class, 'mgo_csmail') !== false) {
                                        $disabled5 = 'disabled="disabled"';
                                    }else{
                                        $disabled5 = "";
                                    }

                                    if (strpos($nama_class, 'mgo_provinsi') !== false) {
                                        $disabled6 = 'disabled="disabled"';
                                    }else{
                                        $disabled6 = "";
                                    }

                                    if (strpos($nama_class, 'mgo_kabkota') !== false) {
                                        $disabled7 = 'disabled="disabled"';
                                    }else{
                                        $disabled7 = "";
                                    }

                                    if (strpos($nama_class, 'btn_buy') !== false) {
                                        $disabled8 = 'disabled="disabled"';
                                    }else{
                                        $disabled8 = "";
                                    }
                                    
                                    $optionnya .= '<option value="'.$nama_class.':'.$type_input.'" '.$selected.' '.$disabled.' '.$disabled2.' '.$disabled3.' '.$disabled4.' '.$disabled5.' '.$disabled6.' '.$disabled7.' '.$disabled8.'>'.$nama_class.'</option>';
                                }
                            }
                            /*
                            function RandomString($length) {
                                $keys = array_merge(range(0,9), range('a', 'z'));

                                $key = "";
                                for($i=0; $i < $length; $i++) {
                                    $key .= $keys[mt_rand(0, count($keys) - 1)];
                                }
                                return $key;
                            }
                            */
                        ?>
                        
                    </td>
                </tr>
                <?php 
                        $array_fieldform = json_decode($field_form, TRUE);

                        if (is_array($array_fieldform) || is_object($array_fieldform)){
                            // get formula and change to only operator
                            $string = $rumus_calculation;
                            $change_pembagi = str_replace("/", ":", $string);
                            $clean_code = preg_replace('/[^-+*:]/', '', $change_pembagi);
                            $array_operation = str_split($clean_code);
                            

                            $no = 1; // 0 untuk mgo_kecamatan, selain itu echo
                            foreach ($array_fieldform as $key => $value) {

                                $pieces = explode("_x", $key);
                                $key = $pieces[0];

                                if($key!='mgo_kecamatan'){
                                    // echo $key.':'.$value.'<br>';
                                    $varnya = $key.':'.$value;
                                    $rand_id = RandomString(4);

                                    $a = $no-2;
                                    $var_char = '';
                                    foreach($array_operation as $key => $value){
                                        if($key==$a){
                                            $var_char = $value;
                                        }
                                    }

                                    $char_plus = '';
                                    $char_minus = '';
                                    $char_kali = '';
                                    $char_bagi = '';
                                    if($var_char=='+'){
                                        $char_plus = 'selected="selected"';
                                    }
                                    if($var_char=='-'){
                                        $char_minus = 'selected="selected"';
                                    }
                                    if($var_char=='*'){
                                        $char_kali = 'selected="selected"';
                                    }
                                    if($var_char==':'){
                                        $char_bagi = 'selected="selected"';
                                    }

                                    $option_calc = '<select name="op-'.$rand_id.'" class="calc"><option value="+" '.$char_plus.'>+</option><option value="-" '.$char_minus.'>-</option><option value="*" '.$char_kali.'>x</option><option value="/" '.$char_bagi.'>:</option></select>';
                                    $button_delete = '<input type="button" name="update" title="Delete" value="&nbsp;-&nbsp;" class="button btn-del" onclick=del("'.$rand_id.'")>';
                                    
                                    if($no==1){
                                        $option_calc = '';
                                        $button_delete = '';
                                    }
                                    
                                    echo '
                                    <tr id="tr-'.$rand_id.'"><td>'.$option_calc.'
                                    <select name="select-'.$rand_id.'" class="calc select-var">'.optionnya_fix($varnya).'</select>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$button_delete.'</td></tr>';
                                    $no++;
                                }
                            }
                        }else{
                            echo'<tr><td><select name="select-'.RandomString(3).'" class="calc select-var">'.$optionnya.'</select></td></tr>';
                        }

                    ?>
                <tr id="line">
                </tr>
                <tr>
                    <td>
                        <button id="add_line" type='button' name="update" class='button btn_mgo'><span class="dashicons dashicons-plus" style="margin-top:6px;margin-right:2px;font-size: 16px;"></span>Add Line</button>
                    </td>
                </tr>

                <tr><td></td></tr>
                <tr>
                    <td>
                        <hr>
                    </td>
                </tr>
                <tr><td style="padding-top: 20px;">
                    <h3>Formula:</h3>
                    <textarea name="field_form" id="hasil-var" cols="100" rows="2" style="display: none;" readonly=""><?php echo $field_form;?></textarea>
                    <textarea name="rumus_calculation" id="hasil-calc" cols="100" rows="3" readonly=""><?php echo $rumus_calculation;?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button id="form_generate" type='button' name="update" class='button btn_mgo'><span class="dashicons dashicons-update" style="margin-top:3px;margin-right:2px;"></span>Generate</button>&nbsp;&nbsp;
                        <button id="del_form_generate" type='button' name="update" class='button btn_mgo btn_regular btn_clear'><span class="dashicons dashicons-trash" style="margin-top:3px;margin-right:2px;"></span>Clear</button>&nbsp;&nbsp;
                    </td>
                </tr>
                <tr><td></td></tr>
                <tr><td></td></tr>
                <tr>
                    <td>
                        <hr>
                    </td>
                </tr>
            </table>
            <br>
            <input type='submit' id="save" name="update" value='Save Formula' class='button btn_mgo_new_purple' style="margin-left:10px !important;margin-top: -20px !important;"> &nbsp;&nbsp;
            
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
    }

    $('#form_generate').bind('click', function(){
        
        var arr_var = $('select.select-var').map(function(){
              return this.value;
          }).get().toString();
        console.log(arr_var);

        var arrvar_petik = arr_var.replace(/:/g , '":"');
        var arrvar_comma = arrvar_petik.replace(/,/g , '","');
        var new_arr_var = arrvar_comma;    
        $('#hasil-var').val('{"'+new_arr_var+'"}');

        var arr_calc = $('select.calc').map(function(){
              return this.value;
          }).get().toString();
        console.log("calc:"+arr_calc);

        var arrcalc_set_jx = arr_calc.replace(/ set_jx/g , "");
        var arrcalc_set_default = arrcalc_set_jx.replace(/ set_default/g , "");
        var arrcalc_set_hide = arrcalc_set_default.replace(/ set_hide/g , "");
        var arrcalc_set_show = arrcalc_set_hide.replace(/ set_show/g , "");
        var arrcalc_hidden = arrcalc_set_show.replace(/:hidden/g , "");
        var arrcalc_checkbox = arrcalc_hidden.replace(/:checkbox/g , "");
        var arrcalc_radio = arrcalc_checkbox.replace(/:radio/g , "");
        var arrcalc_dropdown = arrcalc_radio.replace(/:dropdown/g , "");
        var arrcalc_text = arrcalc_dropdown.replace(/:text/g , "");
        var arrcalc_number = arrcalc_text.replace(/:number/g , "");
        var arrcalc_comma = arrcalc_number.replace(/,/g , "");
        var arrcalc_plus = arrcalc_comma.replace(/\+/g , ")+(");
        var arrcalc_minus = arrcalc_plus.replace(/\-/g , ")-(");
        var new_arr_calc = arrcalc_plus;

        $('#hasil-calc').val('('+new_arr_calc+')');

    });

    $('#del_form_generate').bind('click', function(){
        $('#hasil-var').val('');
        $('#hasil-calc').val('');
    });


    $('#add_line').bind('click', function(){
        var idnya = generate();
        var option = '<?php echo $optionnya; ?>';
        var content = '<tr id="tr-'+idnya+'"><td><select name="op-'+idnya+'" class="calc"><option value="+">+</option><option value="-">-</option><option value="*">x</option><option value="/">:</option></select>&nbsp;<select name="select-'+idnya+'" class="calc select-var">'+option+'</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="update" title="Delete" value="&nbsp;-&nbsp;" class="button btn-del" onclick=del("'+idnya+'")></td></tr>';
        $('#line').append(content);
    });
</script>
    <?php
}
