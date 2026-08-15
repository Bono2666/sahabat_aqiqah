<?php

function magic_order_form() {
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
    mgo_global_vars();
    $expired = $GLOBALS['mgovars']['expired'];
    $date_expired = $GLOBALS['mgovars']['date_expired'];

    // Get User ROLES
    $cap = get_user_meta( wp_get_current_user()->ID, $wpdb->get_blog_prefix() . 'capabilities', true );
    $roles = array_keys((array)$cap);
    $role = $roles[0];
?>
    <link type="text/css" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/style-admin.css?ver=<?php echo $plugin_version; ?>" rel="stylesheet" />
    <style>
        .widefat th {
            height: 30px;
        }
        .widefat td, .widefat th {
            padding: 15px 20px;
        }
        .widefat td {
            padding: 20px 20px;
        }

        .widefat th {
            font-size: 13px;
        }
        .widefat td {
            font-size: 12px !important;
        }
        }
        .widefat tbody {
            box-shadow: 0 0px 1px 0 rgba(0,0,0,.1);
        }
        table.widefat {
            border: 0;
        }
        .formula_box {
            font-size: 12px;
            background: #eaf3f7;
            padding: 5px 10px;
            border-radius: 4px;
            margin-bottom: 5px;
            color: #2980b9;
        }
        .wrap-container {
            padding: 35px 55px;
            padding-bottom: 80px;
        }

    </style>
    <div class="wrap plugin_info"><h2 class="title" style="display: none;"></h2>
    <?php
        $table_name = $wpdb->prefix . "cf_forms";
        $table_name2 = $wpdb->prefix . "mgo_calculation";
        $table_name3 = $wpdb->prefix . "mgo_settings";
        $table_name4 = $wpdb->prefix . "users";
        $table_name5 = $wpdb->prefix . "cf_form_entries";
    
        $rows = $wpdb->get_results("SELECT * from $table_name where type='primary'");

        
        ?>
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

            <div class="page-title" style="padding-left: 13px;">Form List</div>
        </div>
        
        <div class="wrap-container" style="margin-top: -100px;">
            <table class="wp-list-table widefat fixed striped posts" style="box-shadow: 0 4px 25px 0 rgba(0,0,0,.1);margin-bottom: 30px;">
                <tr style="font-weight: bold;" class="t_head">
                    <th class="manage-column ss-list-width" style="font-weight: bold;width: 30px;color:#fff;border-top-left-radius: 4px;padding-right: 0;">No</th>
                    <th class="manage-column ss-list-width" style="font-weight: bold;color:#fff;">Form Name</th>
                    <th class="manage-column ss-list-width" style="font-weight: bold;color:#fff;">Form ID</th>
                    <th class="manage-column ss-list-width" style="font-weight: bold;width: 150px;color:#fff;">Formula</th>
                    <th class="manage-column ss-list-width" style="font-weight: bold;color:#fff;">CS</th>
                    <th class="manage-column ss-list-width" style="font-weight: bold;width: 100px;color:#fff;">Followup&nbsp;WA</th>
                    <th class="manage-column ss-list-width" style="font-weight: bold;width: 120px;color:#fff;border-top-right-radius: 4px;">CS Statistics</th>
                </tr>
                <?php $no=1; ?>
                <?php 

                    $form_name = array();
                    foreach ($rows as $row) { 
                        $dataconfig = json_encode(maybe_unserialize( $row->config ));
                        $datajson = json_decode($dataconfig);
                        $row2 = $wpdb->get_results('SELECT * from '.$table_name2.' where id_form="'.$row->form_id.'"');
                        if($row2==null){
                            $formula = '';
                            $csnya = '-';
                            $followup_wa = '<div>-</div>';
                        }else{
                            $formula = $row2[0]->rumus_calculation;
                            $csnya = $row2[0]->id_cs;
                            if($csnya==null){
                                $csnya = '-';
                            }else{
                                $csnya = $row2[0]->id_cs;

                                $vars = explode(',',$csnya);
                                $nama_cs = '';

                                foreach($vars as $iduser)
                                {
                                    //do your code here
                                    $id_cs = $iduser;
                                    // $get_name = $wpdb->get_results("SELECT * from $table_name4 where ID=$id_cs ");
                                    $args2 = array( 'blog_id' => 0, 'search' => $id_cs, 'search_columns' => array( 'ID' ) );
                                    $get_name = get_users( $args2 );

                                    if($get_name==null){
                                        $cs_name = '-';
                                    }else{
                                        $cs_name = $get_name[0]->display_name; // nama asli
                                    }

                                    $items = array(
                                        // '#F8B595',
                                        // '#F67280',
                                        // '#C06C84',
                                        // '#6C5B7C',
                                        // '#307672',
                                        '#2980B9',
                                        // '#9346B2',
                                        // '#404B69',
                                        // '#4D7CAE'
                                        );
                                    $bg = $items[array_rand($items)];

                                    $nama_cs .= '<div style="padding:2px 8px;background:'.$bg.';color:#fff;margin:0 5px 5px 0;display:inline-block;border-radius:2px;">'.$cs_name.'</div>';
                                    
                                    
                                }

                                $csnya = $nama_cs;
                            }

                            if($row2[0]->f_wa_status==0){
                                $followup_wa = '<div style="padding:2px 8px;background:#ad62aa;color:#fff;margin:0 5px 5px 0;display:inline-block;border-radius:2px;">General</div>';
                            }else{
                                $followup_wa = '<div style="padding:2px 8px;background:#6c7ae0;color:#fff;margin:0 5px 5px 0;display:inline-block;border-radius:2px;">Custom</div>';
                            }
                        }

                        // jumlah data order
                        $jumlah_data = $wpdb->get_results("SELECT count(*) as total from $table_name5 where form_id='$row->form_id' and status='active';");
                        if($jumlah_data!=null){
                            $data_order = $jumlah_data[0]->total;
                        }else{
                            $data_order = 0;
                        }


                    ?>
                    <tr>
                        <td class="manage-column ss-list-width" style="padding-right: 0px;"><?php echo $no; ?></td>
                        <td class="manage-column ss-list-width"><b><?php echo $datajson->name; ?></b><br><a href="javascript:;" data-formid="<?php echo $row->form_id; ?>" class="del_data_order" style="margin-top: 5px !important;display: flex;">Delete Data ( <span id="total_<?php echo $row->form_id;?>"><?php echo $data_order; ?></span> )</a><span id="info_<?php echo $row->form_id;?>"></span></td>
                        <td class="manage-column ss-list-width"><?php echo $row->form_id; ?></td>
                        <td class="manage-column ss-list-width"><div class="formula_box"><?php echo $formula; ?></div><a href="<?php echo admin_url('admin.php?page=magic_order_update&id=' . $row->form_id); ?>" style="margin-top: 5px !important;display: flex;">Edit Formula</a></td>
                        <td class="manage-column ss-list-width"><?php echo $csnya; ?><br><a href="<?php echo admin_url('admin.php?page=magic_order_update_cs&id=' . $row->form_id); ?>" style="margin-top: 5px !important;display: flex;">Edit CS</a></td>
                        <td><?php echo $followup_wa; ?><a href="<?php echo admin_url('admin.php?page=magic_order_update_followup&id=' . $row->form_id); ?>" style="margin-top: 5px !important;display: flex;">Settings</a></td>
                        <td><a href="<?php echo admin_url('admin.php?page=magic_order_statistic&id=' . $row->form_id); ?>">View Statistics</a></td>
                    </tr>
                <?php 

                    $no++;
                } 
                    
                    if($rows==null){
                        echo '<tr><td colspan="7" style="text-align:left;">No Data.</td></td>';
                    }

                ?>
            </table>
        </div>
    </div>

<script type='text/javascript' src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/jquery-2.1.1.min.js?ver=<?php echo $plugin_version; ?>"></script>
<link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/confirm/jquery-confirm.min.css?ver=<?php echo $plugin_version; ?>">
<script src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/confirm/jquery-confirm.min.js?ver=<?php echo $plugin_version; ?>"></script>
<script>
$(document).ready(function() {
    $('.del_data_order').click(function (e) {
        var form_id = $(this).attr('data-formid');
        $.confirm({
            title: 'Hello',
            content: 'Apakah anda Yakin ingin Menghapus seluruh Data di Form ini? Data tidak akan kembali.',
            animation: 'scale',
            closeAnimation: 'scale',
            animateFromElement: false,
            theme: 'modern',
            scrollToPreviousElement: false,
            scrollToPreviousElementAnimate: false,
            buttons: {   
                
                cancel: function(){
                        console.log('the user clicked cancel');
                },
                ok: {
                    text: "Yes, Delete ALL",
                    btnClass: 'btn-danger',
                    keys: ['enter'],
                    action: function(e){
                        
                        $("#info_"+form_id).html('<p style="color: #343434;font-size:12px;">Deleting...</p>').show();
        
                        var data_nya = [
                            'delete_data_form',
                            form_id
                        ];
                        var data = {
                            "action": "myaction_del_data_byform",
                            "datanya": data_nya
                        };
                        jQuery.post(ajaxurl, data, function(response) {
                            
                            if(response=='success'){
                                $("#info_"+form_id).html('<p style="color: #20BF6B;font-size:12px;">Delete Success!</p>').show().delay(3000).fadeOut();
                                $("#total_"+form_id).text('0');
                            }

                        });

                    }
                },
            }
        });        
    });

});

</script>
    <?php
}