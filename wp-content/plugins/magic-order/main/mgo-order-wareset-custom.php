<?php

function magic_order_data_wareset_custom() {
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
    // $table_name = $wpdb->prefix . "mgo_settings";

    $table_name = $wpdb->prefix . "cf_forms";
    $table_name2 = $wpdb->prefix . "mgo_calculation";
    $table_name3 = $wpdb->prefix . "users";
    $id = isset($_GET['id']) ? $_GET['id'] : '';

    $row = $wpdb->get_results('SELECT * from '.$table_name.' where form_id="'.$id.'" and type="primary"');
    
    if(isset($row[0]->config)){

      $row = $row[0];

      $dataconfig = json_encode(maybe_unserialize( $row->config ));
      $datajson = json_decode($dataconfig);
      $fields = $datajson->layout_grid->fields;
      $judul_form = $datajson->name;
    }else{
      echo '<h2>Maaf Form ID anda tidak terdaftar!</h2>';
      return false;
    }


    if($plugin_license=='FREEMIUM'){
        $disabled_setting = 'disabled=""';
    }else{
        $disabled_setting = '';
    }

    ?>
    
    <link href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/emoji/lib/css/emoji.css" rel="stylesheet">
    <link type="text/css" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/style-admin.css?ver=<?php echo $plugin_version; ?>" rel="stylesheet" />
    <style>
        .api-container {
            width: 45%;
            margin: 0 auto;
        }
        .api-input {
            width: 410px;
            height: 42px;
            font-size: 21px;
            padding-left: 10px;
        }
        @media only screen and (max-width:720px) {
            .api-container {
                width: 100%;
            }
        }
        @media only screen and (max-width:480px) {
            .api-input {
                width: 100%;
            }
        }

    </style>
    <div class="wrap plugin_info"><h2 class="title" style="display: none;"></h2></div>
    <?php

        // Get USER ROLES
        $cap = get_user_meta( wp_get_current_user()->ID, $wpdb->get_blog_prefix() . 'capabilities', true );
        $roles = array_keys((array)$cap);
        $role = $roles[0];
        
        ?>
    <div class="wrap" style="box-shadow: 0 4px 25px 0 rgba(0,0,0,.1);border-radius: 4px;">
        <div class="sub-title" style="padding-bottom: 40px;margin-top: 18px;">
        <header class="mgo-header">
            <h1 class="mgo-logo"><img class="icon-title2" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/magic-order-icon2.png"></h1>
              
              <a href="<?php echo admin_url('admin.php?page=magic_order_update_followup&id=').$id ?>" style="cursor: pointer;position: absolute;right: 0;margin-top: 80px;margin-right: 50px;height: 0;width: 0;">
                <span class='button' style="float: right;border: none;background: none;box-shadow: none;margin-top: -25px;"><< BACK</span>
                </a>
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

        </div>


        <div class="wrap-container" style="margin-top: -170px;">
            <div class="api-container">
                
                <p style="color:#464646;"><b>Klik Tombol dibawah untuk Mereset Whatsapp Text</b><br>
                <br>
                
                <input type='button' id="reset_wa" name="insert" value='RESET WHATSAPP TEXT' class='button btn_mgo' style="margin-left:0px;"><span id="success_response"></span>
                <br>
                <br>
                <br>
                <br>
            </div>
        </div>
    </div>
    <script type='text/javascript' src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/jquery-2.1.1.min.js?ver=<?php echo $plugin_version; ?>"></script>

<link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/confirm/jquery-confirm.min.css?ver=<?php echo $plugin_version; ?>">
<script src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/confirm/jquery-confirm.min.js?ver=<?php echo $plugin_version; ?>"></script>

    <script>
    $(document).ready(function(){


        $('#reset_wa').bind('click', function() {
            

            $.confirm({
                title: 'Whatsapp Reset',
                content: 'Are you sure want to Reset Whatsapp Text?',
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
                        text: "Yes, Reset",
                        btnClass: 'btn-danger',
                        keys: ['enter'],
                        action: function(e){
                            
                            $("#success_response").html('<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Reseting...</span>');
                            
                            var data_nya = [
                                'reset',
                                '<?php echo $id;?>'
                            ];

                            var data = {
                                "action": "myaction_reset_wa_custom",
                                "datanya": data_nya
                            };
                            jQuery.post(ajaxurl, data, function(response) {
                                $("#success_response").html(response).show().delay(5000).fadeOut();
                                
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