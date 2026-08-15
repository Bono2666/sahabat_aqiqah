<?php

function magic_order_hide_atc() {
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
    $table_name = $wpdb->prefix . "mgo_settings";
    $table_name2 = $wpdb->prefix . "cf_forms";

    $row = $wpdb->get_results('SELECT data from '.$table_name.' where type="atc_button" or type="additional_button" or type="additional_text" or type="additional_link" ORDER BY id ASC');
    $atc_button  = $row[0]->data;
    $additional_button  = $row[1]->data;
    $additional_text = $row[2]->data;
    $additional_link = $row[3]->data;

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
            .checkbox,.radio{
                width:35% !important;
            }
            .labelname {
                margin-left:37px !important;
                margin-top:-20px !important;
            }
        }
        @media only screen and (max-width:480px) {
            
        }
        .radio.ganjil{margin-right:32px}.labelname{padding-left:8px;position:absolute;margin-left:30px;margin-top:-21px}.checkbox,.radio{margin-bottom:8px;margin-left:-10px;width:25%;float:left}.radio label{padding:10px}.checkbox *,.radio *{cursor:pointer}.checkbox input,.radio input{opacity:0}.checkbox span,.radio span{position:relative;display:inline-block;margin-left:-25px;vertical-align:top;width:20px;height:20px;border-radius:2px;border:1px solid #ccc}.checkbox:hover span,.radio:hover span{border-color:#6c61f6}.checkbox span:before,.radio span:before{content:"\2713";position:absolute;top:0;left:0;right:0;bottom:0;opacity:0;text-align:center;font-size:16px;line-height:16px;vertical-align:middle;color:#6c61f6}.radio span{border-radius:50%}.radio span:before{content:"";width:10px;height:10px;margin:4px auto;background-color:#6c61f6;border-radius:100px;margin-top: 5px;}.checkbox input[type=checkbox]:checked+span,.radio input[type=radio]:checked+span{border-color:#6c61f6;background-color:#6c61f6}.radio input[type=radio]:checked+span{background-color:#fff}.checkbox input[type=checkbox]:checked+span:before,.radio input[type=radio]:checked+span:before{color:#fff;opacity:1;transition:color .3 ease-out;}.checkbox input[type=checkbox]:disabled+span,.radio input[type=radio]:disabled+span{border-color:#ddd!important;background-color:#ddd!important}

    </style>
   <!--  <div class="wrap">
    <h2 class="title"><img class="icon-title" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/magic-order-icon.png">
    <div class="main-title" style="margin-top: -30px;"><?php echo $plugin_name; ?><div style="font-size: 11px;margin-top: -10px;color:#A0C9D7;">Version <?php echo $plugin_version; ?></div></div></h2> -->
     <div class="wrap plugin_info"><h2 class="title" style="display: none;"></h2>
        <?php
            
            // Get USER ROLES
            $cap = get_user_meta( wp_get_current_user()->ID, $wpdb->get_blog_prefix() . 'capabilities', true );
            $roles = array_keys((array)$cap);
            $role = $roles[0];

            // Check Plugin Licensed
            if($plugin_license=='FREEMIUM'){
                echo $plugin_license_info;
                return false;
            }
            
            ?>
        </div>

        <div class="wrap" style="box-shadow: 0 4px 25px 0 rgba(0,0,0,.1);border-radius: 4px;">
        <div class="sub-title" style="padding-bottom: 40px;margin-top: 18px;">
            <header class="mgo-header">
                <h1 class="mgo-logo"><img class="icon-title2" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/magic-order-icon2.png"></h1>
            </header>
            <!-- <div class="page-title">HIDE ADD TO CART</div> -->

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

        <div class="wrap-container" style="margin-top: -200px;">
            <div class="api-container">
                <div class="page-title" style="font-size: 21px;">
                    <span>HIDE ADD TO CART</span></div>
                    <p>For WooCommerce</p>
                
                <hr>
                <Br>
                <br>
                <p style="color:#464646;margin-bottom: 25px;"><b>ADD TO CART BUTTON</b></p>
                <div style=" padding-bottom: 50px;margin-top: -10px;">
                    <div class="radio">
                      <label>
                        <input class="table_field" name="atc_button" value="0" type="radio" <?php if($atc_button==0){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Hide</div>
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input class="table_field" name="atc_button" value="1" type="radio" <?php if($atc_button==1){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Show</div>
                      </label>
                    </div>

                </div>
                <p style="color:#464646;margin-bottom: 25px;"><b>ADDITIONAL BUTTON</b></p>
                <div style="padding-bottom: 40px;margin-top: -10px;">
                    <div class="radio">
                      <label>
                        <input class="table_field" name="additional_button" value="0" type="radio" <?php if($additional_button==0){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Hide</div>
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input class="table_field" name="additional_button" value="1" type="radio" <?php if($additional_button==1){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Show</div>
                      </label>
                    </div>
                    <input type="text" class="api-input" placeholder="Text Button" style="font-size:15px;height: 40px;margin-bottom: 15px;margin-top:15px;" value="<?php echo $additional_text; ?>" name="additional_text">
                    <input type="text" class="api-input" placeholder="Link Button" value="<?php echo $additional_link; ?>" style="font-size:15px;height: 40px;" name="additional_link">
                </div>
                <div><input type='button' id="save_atc" name="insert" value='Save' class='button btn_mgo' style=""><span id="success_response">
                </span></div>
                <br>
                <br>
                <p>
                <b>Note:</b>
                <ul style="list-style-type: circle;margin-left: 12px;">
                    <li>Fitur ini hanya berfungsi / bisa digunakan untuk toko online atau Wordpress yang menggunakan fitur <b>WooCommerce</b>.</li>
                    <li>Fitur ini digunakan untuk menyembunyikan atau menghilangkan tombol bawaan WooCommerce (Tombol Add to Cart) dan menggantikanya dengan tombol baru yang akan diarahkan ke form yang sudah kita sediakan.</li>
                    <li>Additional Button (tombol yang baru) akan membawa 3 variabel, yaitu:</li>
                        <ul style="list-style-type: disc;margin-left: 12px;">
                            <li>Nama produk</li>
                            <li>Kategori produk</li>
                            <li>Ukuran produk</li>
                            <li>Harga produk</li>
                            <li>Jumlah produk</li>
                            <li>Trackads</li>
                        </ul>
                </ul>
                </p>
                <br>
                <br>
                
            </div>
        </div>
    </div>
    <script type='text/javascript' src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/jquery-2.1.1.min.js?ver=<?php echo $plugin_version; ?>"></script>
    <script>
        $('#save_atc').bind('click', function() {

            var atc_button = $("input[type=radio][name=atc_button]:checked").val();
            var additional_button = $("input[type=radio][name=additional_button]:checked").val();
            var additional_text = $("input[name=additional_text]").val();
            var additional_link = $("input[name=additional_link]").val();

            // alert(atc_button+':'+additional_button+':'+additional_text+':'+additional_link);

            $("#success_response").html('<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Saving...</span>');

            var data_nya = [
                atc_button,
                additional_button,
                additional_text,
                additional_link
            ];
            
            var data = {
                'action': 'myaction_save_atc',
                'datanya': data_nya
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response").html(response);
                window.location.reload();
            });
        });
        
    </script>
    <?php
}