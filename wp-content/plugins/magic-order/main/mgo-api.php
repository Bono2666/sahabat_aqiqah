<?php

function magic_order_api() {
    mgo_global_vars();
    $expired = $GLOBALS['mgovars']['expired'];
    $date_expired = $GLOBALS['mgovars']['date_expired'];
    $plugin_name = $GLOBALS['mgovars']['plugin_name'];
    $plugin_version = $GLOBALS['mgovars']['plugin_version'];
    
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";

    $row = $wpdb->get_results('SELECT * from '.$table_name);
    $apikey         = $row[0]->data;
    $apikey_status  = $row[1]->data;
    $plugin_status  = $row[2]->data;
    $apiurl         = $row[3]->data;


    // Set Array
    $data_array = array(
            'jquery_active',
            'minchar',
            'fontawesome',
            'wanotif_status',
            'wanotif_type',
            'wanotif_apikey',
            'wanotif_url',
            'wanotif_message',
            'wanotif_csrotator',
    );

    foreach ($data_array as $key => $value) {
        // cek apakah di table ada sesuai "type" ?
        $query = $wpdb->get_results('SELECT data from '.$table_name.' where type="'.$value.'"');
        if($query==null){
            // klo gak ada, insert data
            if($value=='jquery_active'){
                $isi = '1';
            }elseif($value=='minchar'){
                $isi = '3';
            }elseif($value=='fontawesome'){
                $isi = '1';
            }elseif($value=='wanotif_status'){
                $isi = '0';
            }elseif($value=='wanotif_type'){
                $isi = '0';
            }elseif($value=='wanotif_url'){
                $isi = 'https://api.wanotif.id/v1';
            }else {
                $isi = '';
            }

            $wpdb->insert( 
                $table_name3, 
                array(
                    'type' => $value,
                    'data' => $isi
                ) 
            );

        }
    }


    ?>
    <link type="text/css" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/style-admin.css?ver=<?php echo $plugin_version; ?>" rel="stylesheet" />
    <style>
        .api-container {
            width: 45%;
            margin: 0 auto;
        }
        .btn_mgo {
            height: 40px !important;
            padding-left: 20px !important;
            padding-right: 20px !important;
        }
        @media only screen and (max-width:720px) {
            .api-container {
                width: 100%;
            }
        }
        @media only screen and (max-width:480px) {
            
        }

    </style>

    <div class="wrap plugin_info"><h2 class="title" style="display: none;"></h2>
        <?php
            
            // Get USER ROLES
            $cap = get_user_meta( wp_get_current_user()->ID, $wpdb->get_blog_prefix() . 'capabilities', true );
            $roles = array_keys((array)$cap);
            $role = $roles[0];

            // CUSTOMER SERVICES (EDITOR ROLE)
            // if($role!='administrator'){
            //     echo '
            //     <div class="sub-title-info"><span>This menu is only for administrator!</span></div>
            //     <div class="wrap-container" style="padding: 15px 30px;">
            //     </div>';
            //     return false;
            // }

            ?>
    </div>
    <div class="wrap" style="box-shadow: 0 4px 25px 0 rgba(0,0,0,.1);border-radius: 4px;">
        <div class="sub-title" style="padding-bottom: 40px;margin-top: 18px;">
            <header class="mgo-header">
                <h1 class="mgo-logo"><img class="icon-title2" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/magic-order-icon2.png"></h1>
                
            </header> 

            <?php

            // CUSTOMER SERVICES (EDITOR ROLE)
            if($role!='administrator'){
                echo '
                <div class="sub-title-info"><span>This menu is only for administrator!</span></div>
                ';
                return false;
            }

        ?>
        <a href="<?php echo admin_url('admin.php?page=magic_order_general') ?>" style="cursor: pointer;">
        <span class='button' style="float: right;border: none;background: none;box-shadow: none;margin-top: -25px;"><span class="dashicons dashicons-admin-generic" style="margin-top: 6px;margin-right: 3px;font-size: 16px;"></span>General Settings</span>
        </a>

            <!-- <div class="page-title">API Settings</div> -->
    </div>


        <div class="wrap-container" style="margin-top: -180px;">
            <div class="api-container" style="margin-bottom: 60px;margin-top: 30px;">
                <br>
                <?php 
                if($apikey_status=='valid') {
                    echo '<h1>Congratulations, <span class="lisenced">'.$plugin_status.'</span> License.</h1>';
                }
                if($apikey_status=='deactivated') {
                    echo '<h1>API KEY <b>Deactivated</b></h1>';
                }
                if($apikey_status=='banned') {
                    echo '<h1>Your account is <b>Banned!</b></h1>';
                }

                ?>
                <p>Masukkan API Key Magic Order agar anda bisa terhubung dengan sistem.<br>Gunakan <a href="https://member.sinkronus.com/downloads" style="text-decoration: none;">[ Link ini ]</a> jika anda lupa dengan API Key anda. Sukses terus usahanya!</p>
                <input type="text" id="apikey" class="api-input" maxlength="32" value="<?php echo $apikey; ?>" style="font-weight: bold;margin-bottom: 20px;"><br>
                <input type='button' id="deactivate_apikey" name="insert2" value='Hapus Website' class='button btn_mgo btn_add_apikey' style="margin-top: 10px !important;">&nbsp;&nbsp;&nbsp;
                    <input type='button' id="activate_apikey" name="insert" value='Activate API Key' class='button btn_mgo' style="margin-top: 10px;">
                <br><br><div id="success_response" style="margin-left: -30px;"></div>
                <br><br><br><br>
            </div>
        </div>
    </div>
    <script type='text/javascript' src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/jquery-2.1.1.min.js?ver=<?php echo $plugin_version; ?>"></script>
    <script>
        $('#activate_apikey').bind('click', function() {
            $("#success_response").html('<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Activating...</span>');
            var data = {
                'action': 'mgo_api_activate_settings',
                'datanya': $('#apikey').val()
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response").html(response);
                window.location.reload();
            });
        });
        $('#deactivate_apikey').bind('click', function() {
            $("#success_response").html('<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Loading...</span>');
            var data = {
                'action': 'mgo_api_deactivate_settings',
                'datanya': $('#apikey').val()
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response").html(response);
                window.location.reload();
            });
        });
    </script>
    <?php
}