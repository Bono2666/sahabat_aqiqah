<?php


function get_datauser($id_user) {
    global $wpdb;
    
    $blogs = array();
    $args = array( 'blog_id' => 0 );
    $users = get_users( $args );

    $var_optionnya2 = '<option value="">Choose User</option>';
    foreach ($users as $data ) {
        if ($data->ID==$id_user) {
            $selected = 'selected="selected"';
        }else{
            $selected = "";
        }
        $nama_user = str_replace("'", "", $data->display_name);
        $var_optionnya2 .= '<option value="'.$data->ID.'" '.$selected.'>'.$nama_user.'</option>';
    }
    return $var_optionnya2;
}

function get_datauser2($id_user) {
    global $wpdb;
    
    $blogs = array();
    $args = array( 'blog_id' => 0 );
    $users = get_users( $args );

    $usernya = '';
    foreach ($users as $data ) {
        if ($data->ID==$id_user) {
            $nama_user = str_replace("'", "", $data->display_name);
            $usernya = $nama_user;
        }
    }
    return $usernya;
}


function get_apikey_wanotif() {
    global $wpdb;

    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";

    $row = $wpdb->get_results('SELECT data from '.$table_name.' where type="wanotif_apikey" or type="wanotif_csrotator" ORDER BY id ASC');
    $wanotif_apikey   = $row[0]->data;
    $wanotif_csrotator  = $row[1]->data;

    // GET SINGLE SENDER
    $single_sender = '';
    if($wanotif_apikey!=''){
        $single_sender = '<option value="'.$wanotif_apikey.'">Single Sender Apikey - '.$wanotif_apikey.'</option>';
    }

    // GET CS ROTATOR SENDER
    $csrotator_sender = '';
    $fields = json_decode($wanotif_csrotator, true);
    if(!empty($fields))
    {
        $i = 0;
        $len = count($fields);
        foreach ($fields as $key => $value ) {
            $csrotator_sender .= '<option value="'.$value.'">'.get_datauser2($key).' - '.$value.'</option>';
            $i++;
        }
    }
    
    return $single_sender.$csrotator_sender;

}

function get_channel_telegram() {
    global $wpdb;

    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";

    $row = $wpdb->get_results('SELECT data from '.$table_name.' where type="telegram_single_channel" or type="telegram_csrotator_channel" ORDER BY id ASC');
    $telegram_single_channel     = $row[0]->data;
    $telegram_csrotator_channel  = $row[1]->data;

    // GET SINGLE SENDER
    $owner_channel = '';
    if($telegram_single_channel!=''){
        $owner_channel = '<option value="'.$telegram_single_channel.'">Owner Channel : '.$telegram_single_channel.'</option>';
    }

    // GET CS ROTATOR SENDER
    $csrotator_channel = '';
    $fields = json_decode($telegram_csrotator_channel, true);
    if(!empty($fields))
    {
        $i = 0;
        $len = count($fields);
        foreach ($fields as $key => $value ) {
            $csrotator_channel .= '<option value="'.$value.'">'.get_datauser2($key).' : '.$value.'</option>';
            $i++;
        }
    }
    
    return $owner_channel.$csrotator_channel;

}

function magic_order_general() {
    mgo_global_vars();
    $expired = $GLOBALS['mgovars']['expired'];
    $date_expired = $GLOBALS['mgovars']['date_expired'];
    $plugin_name = $GLOBALS['mgovars']['plugin_name'];
    $plugin_version = $GLOBALS['mgovars']['plugin_version'];
    $plugin_license = $GLOBALS['mgovars']['plugin_license'];
    $apikey = $GLOBALS['mgovars']['apikey'];
    $apikey_status = $GLOBALS['mgovars']['apikey_status'];
    
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";

    $row = $wpdb->get_results('SELECT data from '.$table_name.' where type="apikey" or type="apikey_status" or type="plugin_status" or type="apiurl" or type="ro_apikey" or type="sms_status" or type="sms_userkey" or type="sms_passkey"  or type="sms_apiurl" or type="sms_text" or type="jquery_active" or type="minchar" or type="fontawesome" or type="wanotif_status" or type="wanotif_type" or type="wanotif_apikey" or type="wanotif_url" or type="wanotif_message" or type="wanotif_csrotator" or type="moota_apikey" or type="moota_status" or type="mgo_license" or type="moota_wanotif_message" or type="moota_wanotif_status" or type="telegram_status" or type="telegram_apikey_bot" or type="telegram_id_bot" or type="telegram_username_bot" or type="telegram_message" or type="telegram_single_channel" or type="telegram_csrotator_channel" or type="qris_qrcode" or type="page_protector" or type="mgo_footer" ORDER BY id ASC');
    $apikey         = $row[0]->data;
    $apikey_status  = $row[1]->data;
    $plugin_status  = $row[2]->data;
    $apiurl         = $row[3]->data;
    $ro_apikey      = $row[4]->data;
    $sms_status     = $row[5]->data;
    $sms_userkey    = $row[6]->data;
    $sms_passkey    = $row[7]->data;
    $sms_apiurl     = $row[8]->data;
    $sms_text       = $row[9]->data;
    $jquery_active  = $row[10]->data;
    $minchar        = $row[11]->data;
    $fontawesome    = $row[12]->data;
    $wanotif_status   = $row[13]->data;
    $wanotif_type     = $row[14]->data;
    $wanotif_apikey   = $row[15]->data;
    $wanotif_url      = $row[16]->data;
    $wanotif_message  = $row[17]->data;
    $wanotif_csrotator  = $row[18]->data;
    $moota_apikey       = $row[19]->data;
    $moota_status       = $row[20]->data;
    $mgo_license        = $row[21]->data;
    $moota_wanotif_message = $row[22]->data;
    $moota_wanotif_status = $row[23]->data;
    $telegram_status = $row[24]->data;
    $telegram_apikey_bot = $row[25]->data;
    $telegram_id_bot = $row[26]->data;
    $telegram_username_bot = $row[27]->data;
    $telegram_message = $row[28]->data;
    $telegram_single_channel = $row[29]->data;
    $telegram_csrotator_channel = $row[30]->data;
    $qris_qrcode = $row[31]->data;
    $page_protector = $row[32]->data;
    $mgo_footer = $row[33]->data;

    
    ?>
    <link type="text/css" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/style-admin.css?ver=<?php echo $plugin_version; ?>" rel="stylesheet" />
    <style>
        .btn_mgo {
            height: 40px !important;
            padding-left: 20px !important;
            padding-right: 20px !important;
        }
        input.csrotator_apikey, input.csrotator_channel {
            font-size: 13px;font-weight: bold;color: #6c61f6;margin-bottom: 10px;margin-top:10px;width: 57%;height: 35px;
        }
        .api-container {
            width: 45%;
            margin: 0 auto;
        }
        select.select_csrotator {
            height: 35px;
            padding-left: 10px;
            margin-top: -3px;
        }
        .div_channel select.select_csrotator_channel {
            height: 35px;
            padding-left: 10px;
            margin-top: -2px;
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
        .radio.ganjil{margin-right:32px}.labelname{padding-left:8px;position:absolute;margin-left:30px;margin-top:-21px}.checkbox,.radio{margin-bottom:8px;margin-left:-10px;width:50%;float:left}.radio label{padding:10px}.checkbox *,.radio *{cursor:pointer}.checkbox input,.radio input{opacity:0}.checkbox span,.radio span{position:relative;display:inline-block;margin-left:-25px;vertical-align:top;width:20px;height:20px;border-radius:2px;border:1px solid #ccc}.checkbox:hover span,.radio:hover span{border-color:#6c61f6}.checkbox span:before,.radio span:before{content:"\2713";position:absolute;top:0;left:0;right:0;bottom:0;opacity:0;text-align:center;font-size:16px;line-height:16px;vertical-align:middle;color:#6c61f6}.radio span{border-radius:50%}.radio span:before{content:"";width:10px;height:10px;margin:4px auto;background-color:#6c61f6;border-radius:100px;margin-top: 5px;}.checkbox input[type=checkbox]:checked+span,.radio input[type=radio]:checked+span{border-color:#6c61f6;background-color:#6c61f6}.radio input[type=radio]:checked+span{background-color:#fff}.checkbox input[type=checkbox]:checked+span:before,.radio input[type=radio]:checked+span:before{color:#fff;opacity:1;transition:color .3 ease-out;}.checkbox input[type=checkbox]:disabled+span,.radio input[type=radio]:disabled+span{border-color:#ddd!important;background-color:#ddd!important}
        .jconfirm-box {
            padding: 40px 45px !important;
        }
        .jconfirm-title {
            width:100% !important;
        }
        .jconfirm .jconfirm-box .jconfirm-buttons button.btn-blue {
            background-color: #32b7de;
        }

    </style>
    <div class="wrap plugin_info"><h2 class="title" style="display: none;"></h2>
        <?php
            
            // Get USER ROLES
            $cap = get_user_meta( wp_get_current_user()->ID, $wpdb->get_blog_prefix() . 'capabilities', true );
            $roles = array_keys((array)$cap);
            $role = $roles[0];

            // CUSTOMER SERVICES (EDITOR ROLE)
            if($role!='administrator'){
                echo '
                <div class="sub-title-info"><span>This menu is only for administrator!</span></div>
                ';
                return false;
            }
        ?>
    </div>
    <div class="wrap" style="box-shadow: 0 4px 25px 0 rgba(0,0,0,.1);border-radius: 4px;">
        <div class="sub-title" style="padding-bottom: 40px;margin-top: 18px;">
            <header class="mgo-header">
                <h1 class="mgo-logo"><img class="icon-title2" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/magic-order-icon2.png"></h1>
            </header>
    </div>


        <div class="wrap-container" style="margin-top: -160px;">
            <div class="api-container" style="margin-top: -30px;">
                <div class="page-title" style="font-size: 21px;"><a href="<?php echo admin_url('admin.php?page=magic_order_api') ?>" style="text-decoration: none;" class="mgo_link"><span>API SETTINGS</span></a><span><span class="dashicons dashicons-arrow-right-alt2"></span><span class="dashicons dashicons-arrow-right-alt2" style="margin-left: -15px;"></span></span><span>GENERAL SETTINGS</span></div>
                <br>
                <hr>
                <Br>
                <div id="magic_ongkir_div" style="display: none;"> <!-- magic ongkir -->
                <br><h1 style="margin-top: 10px;">API Magic Ongkir URL</h1>
                <p>Masukkan API URL dengan benar agar dapat terhubung ke Server.<br>
                <b>Default:</b> <i>https://magicongkir.sinkronus.com/api/autocomplete</i></p>
                
                <input type="text" id="apiurl" class="api-input" value="<?php echo $apiurl; ?>" style="font-size: 13px;font-weight: bold;color: #6c61f6;">
                <br>
                <input type='button' id="save_apiurl" name="insert" value='Save API Magic Ongkir' class='button btn_mgo' style="margin-top: 20px;"><span id="success_response"></span>
                <br><br><br>
                <hr>
                </div> <!-- end magic ongkir -->
                <br><h1>Page Protector</h1>
                <p>Fitur ini adalah fitur untuk melindungi Landing Page dari pencurian data. Dengan fitur ini <b>Ctrl+Copy dan Klik kanan tidak akan bekerja pada Landing Page</b>. Aktifkan jika anda memang ini penting dan Deactivate jika tidak diperlukan.</p><br>
                <div style="padding-bottom: 10px;">

                    <div style="padding-bottom: 0px;">
                        <div class="radio">
                          <label>
                            <input class="table_field page_protector" name="page_protector" value="0" type="radio" <?php if($page_protector=='0'){echo 'checked'; }?>>
                            <span></span><div class="labelname" style="margin-top: -19px;">Deactivate</div>
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input class="table_field page_protector" name="page_protector" value="1" type="radio" <?php if($page_protector!='0'){echo 'checked'; }?>>
                            <span></span><div class="labelname" style="margin-top: -19px;">Activate</div>
                          </label>
                        </div>
                    </div>
                </div>
                <br>
                <input type='button' id="save_page_protector" name="" value='Save Page Protector' class='button btn_mgo' style="margin-top: 25px;"><span id="success_response9"></span>
                <br>
                <br><br>
                <hr>
                <br><h1>Powered by Magic Order</h1>
                <div style='text-align: left;color: #a9aebb;margin-top:30px;margin-bottom:20px;font-size:11px;font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif;'><img style="width: 28px;margin-right: 10px;position: absolute;margin-top: -4px;" src="<?php echo plugin_dir_url( __FILE__ )?>../assets/icons/magic-order-30.png" alt="Magic Order 3.0"><div style="color: #a9aebb !important;margin-left: 40px;">Powered by Magic Order</div></div>

                <p>Gunakan Settingan ini untuk menampilkan <b>Powered by Magic Order</b> di Footer Form. Aktifkan jika memang anda <b><i>Bangga dan ikut mendukung Magic Order agar terus dikembangkan sesuai dengan keinginan dan kebutuhan anda</i></b> dengan mengaktifkan settingan ini. Dan Deaktifkan jika memang tidak diperlukan.</p><br>
                <div style="padding-bottom: 10px;">

                    <div style="padding-bottom: 0px;">
                        <div class="radio">
                          <label>
                            <input class="table_field mgo_footer" name="mgo_footer" value="0" type="radio" <?php if($mgo_footer=='0'){echo 'checked'; }?>>
                            <span></span><div class="labelname" style="margin-top: -19px;">Deactivate</div>
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input class="table_field mgo_footer" name="mgo_footer" value="1" type="radio" <?php if($mgo_footer!='0'){echo 'checked'; }?>>
                            <span></span><div class="labelname" style="margin-top: -19px;">Activate</div>
                          </label>
                        </div>
                    </div>
                </div>
                <br>
                <input type='button' id="save_mgo_footer" name="" value='Save Powered By' class='button btn_mgo' style="margin-top: 25px;"><span id="success_response10"></span>
                <br>
                <br><br>
                <hr>
                <br><h1>API Rajaongkir</h1>
                <p>Gunakan API Rajaongkir bawaan default Magic Order yang tersedia (Pro 1, 2, dan 3) atau API Rajaongkir anda. <b>Gunakan API Rajaongkir dengan lisensi PRO</b> agar sistem ongkir berjalan dengan baik.</p><br>
                <div style="padding-bottom: 10px;">

                    <div class="radio" style="width:100%;margin-bottom: 12px;">
                      <label>
                        <input class="table_field ro_pro" name="ro_pro" value="1" type="radio" <?php if($ro_apikey=='f8c9777c807e12be084a770f23c1a573'){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">API Pro 1</div>
                      </label>
                    </div>

                    <div class="radio" style="width:100%;margin-bottom: 12px;">
                      <label>
                        <input class="table_field ro_pro" name="ro_pro" value="2" type="radio" <?php if($ro_apikey=='3f3bce6f9e0d62d356f48cb8040b5653'){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">API Pro 2</div>
                      </label>
                    </div>
                    <div class="radio" style="width:100%;margin-bottom: 12px;">
                      <label>
                        <input class="table_field ro_pro" name="ro_pro" value="3" type="radio" <?php if($ro_apikey=='87a2b30d61ef10ad50774cf55b54cccd'){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">API Pro 3</div>
                      </label>
                    </div>
                    <div class="radio" style="width:100%;margin-bottom: 20px;">
                      <label>
                        <input class="table_field ro_pro" name="ro_pro" value="4" type="radio" <?php if($ro_apikey=='f8c9777c807e12be084a770f23c1a573' || $ro_apikey=='3f3bce6f9e0d62d356f48cb8040b5653' || $ro_apikey=='87a2b30d61ef10ad50774cf55b54cccd'){}else{echo 'checked';}?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Input API PRO Rajaongkir milik sendiri</div>
                      </label>
                    </div>
                    <input class="api-input api_ro_self" type="text" placeholder="API PRO Rajaongkir" style="font-size: 14px;font-weight: bold;color: #6c61f6;margin-bottom:-20px;<?php if($ro_apikey=='3f3bce6f9e0d62d356f48cb8040b5653' || $ro_apikey=='f8c9777c807e12be084a770f23c1a573' || $ro_apikey=='87a2b30d61ef10ad50774cf55b54cccd'){echo'display:none;';}?>" value="<?php if($ro_apikey=='f8c9777c807e12be084a770f23c1a573' || $ro_apikey=='3f3bce6f9e0d62d356f48cb8040b5653' || $ro_apikey=='87a2b30d61ef10ad50774cf55b54cccd'){}else{echo $ro_apikey;}?>" />
                </div>
                <br>
                <br>
                <input type='button' id="save_api_ro" name="insert" value='Save API Rajaongkir' class='button btn_mgo' style="margin-top: 10px;"><span id="success_response_ro"></span>
                <br><br><br>
                <hr>
                <br><h1>API MOOTA</h1>
                <br>
                <?php 
                if($mgo_license!='9e3360ac711fcd82ceea74c8eb69bda9'){
                    echo'<div style="background: #ffd800;padding: 10px;border: 1px dashed orange;">Hanya untuk <b>Pro License</b>. <a href="https://t.me/rpujakesuma" target="_blank">Kontak untuk Upgrade Sekarang!</a></div>';
                }
                ?>
                <?php
                global $wp;
                $url_wp = home_url($wp->request);
                ?>
                <p>Silahkan berlangganan ke <a href="https://moota.co/" target="_blank">Moota</a> dan dapatkan Apikey nya, 
                supaya update pembelian/transferan yang masuk bisa dilakukan secara otomatis.</p>

                <div style="padding-bottom: 20px;">
                    <div class="radio">
                      <label>
                        <input class="table_field moota_status" name="moota_status" value="0" type="radio" <?php if($moota_status=='0'){echo 'checked'; }?> <?php if($mgo_license!='9e3360ac711fcd82ceea74c8eb69bda9'){echo'disabled=""';}?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Deactivate</div>
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input class="table_field moota_status" name="moota_status" value="1" type="radio" <?php if($moota_status=='1'){echo 'checked'; }?> <?php if($mgo_license!='9e3360ac711fcd82ceea74c8eb69bda9'){echo'disabled=""';}?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Activate</div>
                      </label>
                    </div>
                </div>
                <div id="div_moota" style="<?php if($moota_status=='1'){echo '"display:inline;"';}else{echo 'display:none;"';}?>">
                <br>
                <div style="margin-top: 20px;margin-bottom: 10px;"><label for=""><b>API Endpoint :</b> </label></div>
                <input type="text" id="moota_endpoint" class="api-input" value="<?php echo $url_wp; ?>/?mgo_moota=push" style="font-size: 13px;font-weight: bold;color: #6c61f6;" readonly="">
                <br>
                <div style="margin-top: 20px;margin-bottom: 10px;"><label for=""><b>Apikey Moota :</b> </label></div>
                <input type="text" id="moota_apikey" placeholder="Apikey Moota Anda" class="api-input" value="<?php echo $moota_apikey; ?>" style="font-size: 13px;font-weight: bold;color: #6c61f6;">
                <br>
                <div style="margin-top: 25px;margin-bottom: 10px;"><label for=""><b>Whatsapp Notification to Customer (Wanotif) :</b> </label></div>
                <div style="padding-bottom: 20px;">
                    <div class="radio">
                      <label>
                        <input class="table_field moota_wanotif_status" name="moota_wanotif_status" value="0" type="radio" <?php if($moota_wanotif_status=='0'){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Deactivate</div>
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input class="table_field moota_wanotif_status" name="moota_wanotif_status" value="1" type="radio" <?php if($moota_wanotif_status=='1'){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Activate</div>
                      </label>
                    </div>
                </div>

                <div id="div_moota_message" class="div_general_message" style="<?php if($moota_wanotif_status=='0'){echo 'display: none'; }?>">
                    <div style="margin-top: 25px;margin-bottom: 10px;"><label for=""><b>Success Message (Wanotif) :</b> </label></div>
                    <textarea id="moota_wanotif_message" style="font-size: 13px;font-weight: normal;margin-top:5px;width: 90%;height: 100px;padding: 10px 15px;"><?php echo $moota_wanotif_message; ?></textarea><br>
                    <p>
                        <ul style="font-size: 13px;width: 90%;font-size: 12px;">
                            <li><b>Note :</b></li>
                            <li>Tambahkan [mgo_orderid], [mgo_nama], dan atau [mgo_nama_produk] agar pesan yang anda kirim lebih personal. Contoh: <br><b><i>Terimakasih [mgo_nama], kami telah menerima pembayaran untuk Order ID [mgo_orderid]. Pesanan [mgo_nama_produk] anda akan segera kami proses.</i></b></li>
                        </ul>
                    </p>

                </div>
                </div>
                <br>
                <input type='button' id="save_moota_apikey" name="insert" value='Save API Moota' class='button btn_mgo' style="margin-top: 20px;" <?php if($mgo_license!='9e3360ac711fcd82ceea74c8eb69bda9'){echo'disabled=""';}?>><span id="success_response_moota"></span>
                <br><br><br>
                <hr>


                <br><h1>API WANOTIF</h1>
                <br>
                <div style="padding-bottom: 20px;">
                    <div class="radio">
                      <label>
                        <input class="table_field wanotif_status" name="wanotif_status" value="0" type="radio" <?php if($wanotif_status=='0'){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Deactivate</div>
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input class="table_field wanotif_status" name="wanotif_status" value="1" type="radio" <?php if($wanotif_status=='1'){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Activate</div>
                      </label>
                    </div>
                </div>
                <div style="<?php if($wanotif_status=='1'){echo '"display:inline;"';}else{echo 'display:none;"';}?>" id="div_wanotif" >
                    <br>
                    <br>
                    <label><b>Pilih salah satu tipe sender :</b></label><br><br>
                    <div style="padding-bottom: 20px;">
                        <div class="radio">
                          <label>
                            <input class="table_field wanotif_type" name="wanotif_type" value="0" type="radio" <?php if($wanotif_type=='0'){echo 'checked'; }?>>
                            <span></span><div class="labelname" style="margin-top: -19px;">Single Sender</div>
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input class="table_field wanotif_type" name="wanotif_type" value="1" type="radio" <?php if($wanotif_type=='1'){echo 'checked'; }?>>
                            <span></span><div class="labelname" style="margin-top: -19px;">CS Rotator Sender</div>
                          </label>
                        </div>
                    </div>
                    <br>
                    <div class="div_single_sender" <?php if($wanotif_type=='0'){echo 'style="display:inline;"'; }else{echo'style="display:none;"';}?>>
                        <div style="margin-top: 20px;margin-bottom: 10px;"><label for=""><b>Apikey Single Sender :</b> </label></div>
                        <input type="text" id="wanotif_apikey" class="api-input" value="<?php echo $wanotif_apikey; ?>" style="font-size: 15px;font-weight: bold;color: #6c61f6;margin-top:10px;width: 63%;margin-bottom: -10px;" placeholder="Apikey Wanotif" maxlength="32">
                    </div>
                    <div class="div_csrotator_sender" <?php if($wanotif_type=='1'){echo 'style="display:inline;"'; }else{echo'style="display:none;"';}?>>
                        <div style="margin-top: 20px;margin-bottom: 10px;"><label for=""><b>Apikey CS Rotator Sender :</b> </label></div>
                        <div class="div_apikey">
                            <?php
                                $fields = json_decode($wanotif_csrotator, true);

                                if(!empty($fields))
                                {
                                    $i = 0;
                                    $len = count($fields);
                                    foreach ($fields as $key => $value ) {

                                        echo '
                                        <div class="apikey_csrotator" id="apikey_'.$key.'">
                                            <select name="id_user_csrorator" class="select_csrotator">
                                                '.get_datauser($key).'
                                            </select>
                                            <input type="text" class="api-input csrotator_apikey" value="'.$value.'" placeholder="Apikey Wanotif" maxlength="32">
                                            <button class="button btn_mgo btn_del_apikey" title="Delete Apikey" data-id="apikey_'.$key.'"><span class="dashicons dashicons-no-alt"></span></button>
                                        </div>
                                        ';
                                        $i++;
                                    }
                                }

                            ?>
                            
                        </div>
                        <button id="add_apikey" name="add_apikey"  title="ADD Apikey" class='button btn_mgo btn_add_apikey' style="margin-top: -10px;"><span class="dashicons dashicons-plus" style="padding-top: 5px;margin-right: 5px;"></span>Add Apikey</button><span id="success_response"></span>
                    </div>
                    <div class="div_general_message">
                        <div style="margin-top: 40px;margin-bottom: 10px;"><label for=""><b>General Message :</b> </label></div>
                        <textarea id="wanotif_general_message" style="font-size: 13px;font-weight: normal;margin-top:10px;width: 90%;height: 100px;padding: 10px 15px;"><?php echo $wanotif_message; ?></textarea>

                    </div>
                </div>
                <br>
                <br>
                <input type='button' id="save_wanotif" name="insert" value='Save API WANOTIF' class='button btn_mgo' style="margin-top: 10px;">
                <input type='button' id="test_whatsapp_settings" name="wa" value='Test Send WA' class='button btn_mgo' style="<?php if($wanotif_status=='0'){echo 'display:none;'; }?>">
                <span id="success_response_wanotif"></span>

                <br><br>
                <p style="font-size:12px;"><b><i>Note untuk General Message</i></b><br>
                - [mgo_orderid] : untuk menambahkan Order ID pemesanan.<br>
                - [mgo_nama] : untuk menambahkan nama customer.<br>
                - [mgo_nama_produk] : untuk menambahkan nama produk.<br>
                - [mgo_jumlah_barang] : untuk menambahkan jumlah barang.<br>
                - [mgo_item_total] : untuk menambahkan item total dari pemesanan.<br>
                - [mgo_total] : untuk menambahkan total harga dari pemesanan.<br>
                - [mgo_dp]</b> : untuk menambahkan nilai DP dari Total.<br>
                - [mgo_sisa]</b> : untuk menambahkan nilai sisa pembayaran dari Total - DP.<br>
                - [mgo_pembayaran] : untuk menampilkan pilihan Bank atau metode pembayaran.<br>
                - Anda juga bisa memasukkan karakter emoticon pada Message Whatsapp ini.<br>
                - [mgo_cswa] : untuk menambahkan nomor WA CS, pastikan menggunakan CS Rotator.<br>
                - [mgo_csid] : untuk menambahkan Nama CS, pastikan menggunakan CS Rotator.<br>
                - [followup1] : untuk menambahkan link Followup 1.<br>
                - [followup2] : untuk menambahkan link Followup 2.<br>
                - [followup3] : untuk menambahkan link Followup 3.<br>
                - [mgo_detail_order] : untuk menambahkan detail order secara keseluruhan.<br>


                <br>
                <b><i>Contoh :</i></b><br>
                <div style="background:#EEF0F9;padding: 10px 12px;border-radius: 2px;margin-top: 8px;font-size:11px;">
                Hai kakak *[mgo_nama]*, berikut detail Order Anda<br>
                [mgo_detail_order]<br>
                Segera transfer ke [mgo_pembayaran].<br>Terimakasih.
                </div>
                </p>
                <br>
                <br>

                <hr>
                <br>
                <h1>API TELEGRAM</h1><br>
                <div style="padding-bottom: 20px;padding-top: 5px;">
                    <div class="radio">
                      <label>
                        <input class="table_field telegram_status" name="telegram_status" value="0" type="radio" <?php if($telegram_status=='0'){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Deactivate</div>
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input class="table_field telegram_status" name="telegram_status" value="1" type="radio" <?php if($telegram_status=='1'){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Activate</div>
                      </label>
                    </div>
                </div>
                <div style="<?php if($telegram_status=='1'){echo '"display:inline;"';}else{echo 'display:none;"';}?>" id="div_telegram" >
                    <br>
                    <br>
                    <label><b>Telegram Bot :</b></label><br>
                    <input type="text" id="telegram_apikey_bot" class="api-input" value="<?php echo $telegram_apikey_bot; ?>" style="font-size: 15px;font-weight: bold;color: #6c61f6;margin-top:21px !important;width: 63%;margin-bottom: 5px;margin-top: 20px;" placeholder="API Token Bot " title="API Token Bot">
                        <button id="request_bot" class="button btn_mgo btn_add_apikey" title="Delete Apikey" style="margin-top: 20px;">Request Bot</button>

                        <input type="text" id="telegram_username_bot" class="api-input" value="<?php echo $telegram_username_bot; ?>" style="font-size: 15px;font-weight: bold;color: #6c61f6;margin-top:11px !important;width: 63%;margin-bottom: -10px;background:#eaeff7;border: 1px solid#7e8993 !important;" placeholder="Username Bot"  title="Username Bot, Can't be edit." disabled="">
                        <button  id="register_bot" class="button btn_mgo btn_add_apikey" title="Delete Apikey" style="margin-top: 10px;">Register Bot</button>

                        <span id="success_response7"></span>
                    <br>
                    <br>
                    <br>
                    <div>
                        <div style="margin-top:0px;margin-bottom: 10px;"><label for=""><b>Owner Channel :</b> </label></div>
                        <input type="text" id="telegram_single_channel" class="api-input" value="<?php echo $telegram_single_channel; ?>" style="font-size: 15px;font-weight: bold;color: #6c61f6;margin-top:10px;width: 63%;margin-bottom: 5px;" placeholder="@NamaChannel " title="Telegram Channel">
                    </div>
                    <div>
                        <div style="margin-top: 20px;margin-bottom: 10px;"><label for=""><b>CS Rotator Channel :</b> </label></div>
                        <?php 
                        if($mgo_license!='9e3360ac711fcd82ceea74c8eb69bda9'){
                            echo'<div style="background: #ffd800;padding: 10px;border: 1px dashed orange;margin-bottom:5px;">Hanya untuk <b>Pro License</b>. <a href="https://t.me/rpujakesuma" target="_blank">Kontak untuk Upgrade Sekarang!</a></div>';
                        }
                        ?>
                        <div class="div_channel <?php if($mgo_license!='9e3360ac711fcd82ceea74c8eb69bda9'){echo'set_disabled';}?>">
                            <?php
                                $fields = json_decode($telegram_csrotator_channel, true);

                                $disabled = '';
                                if($mgo_license!='9e3360ac711fcd82ceea74c8eb69bda9'){$disabled="disabled";}

                                if(!empty($fields))
                                {
                                    $i = 0;
                                    $len = count($fields);
                                    foreach ($fields as $key => $value ) {
                                        echo '
                                        <div class="channel_csrotator" id="channel_'.$key.'">
                                            <select name="id_user_csrorator_channel" class="select_csrotator_channel" '.$disabled.'>
                                                '.get_datauser($key).'
                                            </select>
                                            <input type="text" class="api-input csrotator_channel" value="'.$value.'" placeholder="@NamaChannel" '.$disabled.'>
                                            <button class="button btn_mgo btn_del_channel" title="Delete Apikey" data-id="channel_'.$key.'" '.$disabled.'><span class="dashicons dashicons-no-alt"></span></button>
                                        </div>
                                        ';
                                        $i++;
                                    }
                                }

                            ?>
                            
                        </div>
                        <button id="add_channel" name="add_channel"  title="ADD Channel" class='button btn_mgo btn_add_apikey' style="margin-top: -10px;" <?php if($mgo_license!='9e3360ac711fcd82ceea74c8eb69bda9'){echo'disabled=""';}?>><span class="dashicons dashicons-plus" style="padding-top: 5px;margin-right: 5px;"></span>Add Channel</button><span id="success_response"></span>
                    </div>
                    <div class="div_general_message">
                        <div style="margin-top: 40px;margin-bottom: 10px;"><label for=""><b>General Message :</b> </label></div>
                        <textarea id="telegram_general_message" style="font-size: 13px;font-weight: normal;margin-top:10px;width: 90%;height: 100px;padding: 10px 15px;"><?php echo $telegram_message; ?></textarea>

                    </div>
                </div>
                <br>
                <input type='button' id="save_telegram" name="" value='Save Telegram' class='button btn_mgo' style="margin-top: 10px;">
                <input type='button' id="test_telegram_settings" name="telegram" value='Test Send Telegram' class='button btn_mgo' style="<?php if($telegram_status=='0'){echo 'display:none;'; }?>">
                <div id="success_response_channel"></div>
                <br>
                <p style="font-size:12px;"><b><i>Note untuk General Message</i></b><br>
                - [mgo_orderid] : untuk menambahkan Order ID pemesanan.<br>
                - [mgo_nama] : untuk menambahkan nama customer.<br>
                - [mgo_nama_produk] : untuk menambahkan nama produk.<br>
                - [mgo_jumlah_barang] : untuk menambahkan jumlah barang.<br>
                - [mgo_item_total] : untuk menambahkan item total dari pemesanan.<br>
                - [mgo_total] : untuk menambahkan total harga dari pemesanan.<br>
                - [mgo_pembayaran] : untuk menampilkan pilihan Bank atau metode pembayaran.<br>
                - Anda juga bisa memasukkan karakter emoticon pada Message Whatsapp ini.<br>
                - [mgo_cswa] : untuk menambahkan nomor WA CS, pastikan menggunakan CS Rotator.<br>
                - [mgo_csid] : untuk menambahkan Nama CS, pastikan menggunakan CS Rotator.<br>
                - [followup1] : untuk menambahkan link Followup 1.<br>
                - [followup2] : untuk menambahkan link Followup 2.<br>
                - [followup3] : untuk menambahkan link Followup 3.<br>
                - [mgo_detail_order] : untuk menambahkan detail order secara keseluruhan.<br>
                <br>
                <b><i>Contoh :</i></b><br>
                <div style="background:#EEF0F9;padding: 10px 12px;border-radius: 2px;margin-top: 8px;font-size:11px;">Alhamdulillah ada orderan masuk,<br>
                Nama: *[mgo_nama]*<br>
                [mgo_detail_order]<br><br>
                Followup ya Bro *[mgo_csid]*,<br>
                Followup : [followup1]<br>
                Semoga berhasil.</div>
                </p>
                <br>
                <br>
                <hr>
                <br><h1>API SMS</h1>
                <br>
                <div style="padding-bottom: 20px;">
                    <div class="radio">
                      <label>
                        <input class="table_field sms_status" name="sms_status" value="0" type="radio" <?php if($sms_status=='0'){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Deactivate</div>
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input class="table_field sms_status" name="sms_status" value="1" type="radio" <?php if($sms_status=='1'){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Activate</div>
                      </label>
                    </div>
                </div>
                <br>
                <div class="show_sms_settings" <?php if($sms_status=='1'){echo 'style="display:inline;"';}else{echo 'style="display:none;"';}?>>
                    <p><b>API URL :</b></p>
                    <div style="padding-bottom: 10px;">
                        <div class="radio" style="width:100%;margin-bottom: 12px;">
                          <label>
                            <input class="table_field sms_apiurl" name="sms_apiurl" value="http://reguler.sms-notifikasi.com/apps/smsapi.php" type="radio" <?php if($sms_apiurl=='http://reguler.sms-notifikasi.com/apps/smsapi.php'){echo 'checked'; }?>>
                            <span></span><div class="labelname" style="margin-top: -19px;">API 1 : http://<b>reguler.sms-notifikasi.com</b>/apps/smsapi.php</div>
                          </label>
                        </div>
                        <div class="radio" style="width:100%;margin-bottom: 12px;">
                          <label>
                            <input class="table_field sms_apiurl" name="sms_apiurl" value="http://masking.sms-notifikasi.com/apps/smsapi.php" type="radio" <?php if($sms_apiurl=='http://masking.sms-notifikasi.com/apps/smsapi.php'){echo 'checked'; }?>>
                            <span></span><div class="labelname" style="margin-top: -19px;">API 2 : http://<b>masking.sms-notifikasi.com</b>/apps/smsapi.php</div>
                          </label>
                        </div>
                        <div class="radio" style="width:100%;margin-bottom: 12px;">
                          <label>
                            <input class="table_field sms_apiurl" name="sms_apiurl" value="https://reguler.zenziva.net/apps/smsapi.php" type="radio" <?php if($sms_apiurl=='https://reguler.zenziva.net/apps/smsapi.php'){echo 'checked'; }?>>
                            <span></span><div class="labelname" style="margin-top: -19px;">API 3 : https://<b>reguler.zenziva.net</b>/apps/smsapi.php</div>
                          </label>
                        </div>
                        <div class="radio" style="width:100%;margin-bottom: 12px;">
                          <label>
                            <input class="table_field sms_apiurl" name="sms_apiurl" value="https://alpha.zenziva.net/apps/smsapi.php" type="radio" <?php if($sms_apiurl=='https://alpha.zenziva.net/apps/smsapi.php'){echo 'checked'; }?>>
                            <span></span><div class="labelname" style="margin-top: -19px;">API 4 : https://<b>alpha.zenziva.net</b>/apps/smsapi.php</div>
                          </label>
                        </div>
                        <div class="radio" style="width:100%;margin-bottom: 20px;">
                          <label>
                            <input class="table_field sms_apiurl" name="sms_apiurl" value="two_way" type="radio" <?php if($sms_apiurl!='http://reguler.sms-notifikasi.com/apps/smsapi.php' && $sms_apiurl!='http://masking.sms-notifikasi.com/apps/smsapi.php' && $sms_apiurl!='https://reguler.zenziva.net/apps/smsapi.php' && $sms_apiurl!='https://alpha.zenziva.net/apps/smsapi.php'){echo 'checked'; }?>>
                            <span></span><div class="labelname" style="margin-top: -19px;">API 5 : Two Way</div>
                          </label>
                        </div>
                        <input class="api-input two_way" type="text" placeholder="URL API KIRIM SMS (Two Way)" style="font-size: 14px;font-weight: bold;color: #6c61f6;margin-bottom:-20px;" value="<?php echo $sms_apiurl;?>" />
                    </div><br>
                    <p><b>User Key :</b></p>
                    <input type="text" id="sms_userkey" class="api-input" value="<?php echo $sms_userkey; ?>" style="font-size: 18px;font-weight: bold;color: #6c61f6;">
                    <br><br>
                    <p><b>Pass Key :</b></p>
                    <input type="text" id="sms_passkey" class="api-input" value="<?php echo $sms_passkey; ?>" style="font-size: 18px;font-weight: bold;color: #6c61f6;">
                    <br><br>
                    <p><b>General Message :</b></p>
                    <input type="text" id="sms_text" class="api-input" value="<?php echo $sms_text; ?>" style="font-size: 13px;font-weight: bold;color: #6c61f6;">
                   <br>
                </div>
                <br>
                <input type='button' id="save_sms_settings" name="insert" value='Save API SMS' class='button btn_mgo' style="margin-top: 10px;"><input type='button' id="test_sms_settings" name="insert" value='Test SMS' class='button btn_mgo' style="<?php if($sms_status=='0'){echo 'display:none;'; }?>"><span id="success_response3"></span>
                <br><br>
                <p style="font-size:12px;"><b><i>Note untuk General Message</i></b><br>
                    - [mgo_orderid] : untuk menambahkan Order ID pemesanan.<br>
                - [mgo_nama] : untuk menambahkan nama customer.<br>
                - [mgo_nama_produk] : untuk menambahkan nama produk.<br>
                - [mgo_item_total] : untuk menambahkan item total dari pemesanan.<br>
                - [mgo_total] : untuk menambahkan total harga dari pemesanan.<br>
                - [followup1] : untuk menambahkan link Followup 1.<br>
                - [followup2] : untuk menambahkan link Followup 2.<br>
                - [followup3] : untuk menambahkan link Followup 3.<br>
                - [mgo_pembayaran] : untuk menambahkan rekening anda.<br>
                <br>
                    <b><i>Contoh :</i></b><br>
                    <div style="background:#EEF0F9;padding: 10px 12px;border-radius: 2px;margin-top: 8px;font-size:11px;">Yth Bp/Ibu [mgo_nama], ID [mgo_orderid] untuk pembelian [mgo_nama_produk] sejumlah [mgo_total] mohon ditransfer ke [mgo_pembayaran]. Terimakasih</div>
                    </p>
                    <br><br>
                <hr>
                <br><br>

                <h1>JQuery Plugin</h1>
                <p style="font-size:12px;"><b><i>Note:</i></b> Pastikan settingan JQuery ini aktif agar plugin berjalan normal. Jika mengalami Double Jquery (kasus tertentu), settingan ini bisa di Non-aktifkan.<br></p>
                <div style="padding-bottom: 20px;">
                    <div class="radio">
                      <label>
                        <input class="table_field jquery_active" name="jquery_active" value="0" type="radio" <?php if($jquery_active=='0'){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Deactivate</div>
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input class="table_field jquery_active" name="jquery_active" value="1" type="radio" <?php if($jquery_active!='0'){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Activate</div>
                      </label>
                    </div>
                </div>
                <br>
                <input type='button' id="save_jquery" name="save" value='Save JQuery' class='button btn_mgo' style="margin-top: 10px;"><span id="success_response4"></span>
                <br>
                <br>
                <br>
                <hr>
                <br>
                <h1>Autocomplete Kecamatan (Minimal Character)</h1>
                <p style="font-size:12px;"><b><i>Note:</i></b> Disarankan menggunakan minimal 3 karakter untuk autocomplete kecamatan.<br></p>
                <div style="padding-bottom: 20px;">
                    <label for="">Min : </label>
                    <select name="michar" id="minchar" style="height: 35px;">
                        <option value="1" <?php if($minchar=='1'){echo 'selected'; }?>>1 Karakter</option>
                        <option value="2" <?php if($minchar=='2'){echo 'selected'; }?>>2 Karakter</option>
                        <option value="3" <?php if($minchar=='3'){echo 'selected'; }?>>3 Karakter</option>
                        <option value="4" <?php if($minchar=='4'){echo 'selected'; }?>>4 Karakter</option>
                        <option value="5" <?php if($minchar=='5'){echo 'selected'; }?>>5 Karakter</option>
                    </select>
                </div>
                <input type='button' id="save_minchar" name="" value='Save Minimal Character' class='button btn_mgo' style="margin-top: 10px;"><span id="success_response5"></span>
                <br>
                <br>
                <Br>
                <hr>
                <br>
                <h1>Fontawesome Icons</h1>
                <p style="font-size:12px;"><b><i>Note:</i></b> Aktifkan jika ingin menggunakan Fontawesome Icons pada form anda.<br></p>
                <div style="padding-bottom: 30px;">
                    <div class="radio">
                      <label>
                        <input class="table_field set_fontawesome" name="fontawesome" value="0" type="radio" <?php if($fontawesome=='0'){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Deactivate</div>
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input class="table_field set_fontawesome" name="fontawesome" value="1" type="radio" <?php if($fontawesome!='0'){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Activate</div>
                      </label>
                    </div>
                </div>
                <input type='button' id="save_fontawesome" name="" value='Save Fontawesome' class='button btn_mgo' style="margin-top: 25px;"><span id="success_response6"></span>
                <br>
                <br>
                <Br>
                <hr>
                <br>
                <h1>QRIS QR-Code</h1>
                <p style="font-size:12px;"><b>QRIS atau Quick Response Code Indonesia Standard.</b> QRIS ini adalah standarisasi pembayaran menggunakan metode QR Code dari Bank Indonesia agar proses transaksi dengan QR Code dapat dilakukan dengan mudah, cepat, dan terjaga keamanannya. <br>1 QR-Code dapat digunakan untuk membayar melalui GoPay, OVO, Dana, dan LinkAja.<br><br><b><i>Note:</i></b> Silahkan paste link Image QRIS QR-Code anda.<br></p>
                <div style="padding-bottom: 30px;">
                    <input type="text" id="qris_link" class="api-input" value="<?php echo $qris_qrcode; ?>" style="font-size: 15px;font-weight: bold;color: #6c61f6;margin-top:10px;width: 63%;margin-bottom: -10px;" placeholder="https://">
                </div>
                <input type='button' id="save_qris" name="" value='Save QRIS' class='button btn_mgo' style="margin-top: 15px;"><span id="success_response8"></span>
                <br>
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
        function randomString(len, an){
            an = an&&an.toLowerCase();
            var str="", i=0, min=an=="a"?10:0, max=an=="n"?10:62;
            for(;i++<len;){
              var r = Math.random()*(max-min)+min <<0;
              str += String.fromCharCode(r+=r>9?r<36?55:61:48);
            }
            return str;
        }

        $('#save_apiurl').bind('click', function() {
            $("#success_response").html('<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Saving...</span>');
            var data = {
                'action': 'mgo_url_settings',
                'datanya': $('#apiurl').val()
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response").html(response);
                window.location.reload();
            });
        });
        $('#save_phonesetting').bind('click', function() {
            $("#success_response2").html('<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Saving...</span>');

            var datanya = [
                    $('#notif').val(),
                    $('#urlcs').val(),
                    $('input[type=radio][name=opentab]:checked').val(),
                    $('input[type=radio][name=formresend]:checked').val()
                ];

            // alert(datanya);
            // return false;
                
            var data = {
                'action': 'myaction_save_phonesetting',
                'datanya': datanya
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response2").html(response);
                window.location.reload();
            });
        });


        $( ".sms_status" ).bind("change", function(e){
            var sms_status = $(this).val();
            if(sms_status==1){
                $('.show_sms_settings').show();
                $('#test_sms_settings').show();
            }else{
                $('.show_sms_settings').hide();
                $('#test_sms_settings').hide();
            }
        });
        $( ".wanotif_status" ).bind("change", function(e){
            var wanotif_status = $(this).val();
            if(wanotif_status==1){
                $('#div_wanotif').show();
                $('#test_whatsapp_settings').show();
            }else{
                $('#div_wanotif').hide();
                $('#test_whatsapp_settings').hide();
            }
        });
        $( ".telegram_status" ).bind("change", function(e){
            var telegram_status = $(this).val();
            if(telegram_status==1){
                $('#div_telegram').show();
                $('#test_telegram_settings').show();
            }else{
                $('#div_telegram').hide();
                $('#test_telegram_settings').hide();
            }
        });


        $( ".moota_status" ).bind("change", function(e){
            var moota_status = $(this).val();
            if(moota_status==1){
                $('#div_moota').show();
            }else{
                $('#div_moota').hide();
            }
        });

        $( ".moota_wanotif_status" ).bind("change", function(e){
            var moota_wanotif_status = $(this).val();
            if(moota_wanotif_status==1){
                $('#div_moota_message').show();
            }else{
                $('#div_moota_message').hide();
            }
        });

        
        $( ".wanotif_type" ).bind("change", function(e){
            var wanotif_type = $(this).val();
            if(wanotif_type==1){
                $('.div_single_sender').hide();
                $('.div_csrotator_sender').show();
            }else{
                $('.div_single_sender').show();
                $('.div_csrotator_sender').hide();
            }
        });


        $( "#save_wanotif" ).bind("click", function(e){

            $("#success_response_wanotif").html('<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Saving...</span>');

            var arr_user = $('select.select_csrotator').map(function(){
                return this.value;
            }).get().toString();

            var arr_apikey = $('input.csrotator_apikey').map(function(){
                return this.value;
            }).get().toString();

            var str1 = arr_user;
            var str1_array = str1.split(',');

            var str2 = arr_apikey;
            var str2_array = str2.split(',');


            var hasil = '';
            var len = str1_array.length;
            for(var i = 0; i < str1_array.length; i++) {
                
                hasil += '"'+str1_array[i]+'":"'+str2_array[i]+'"';
                if (i == len - 1) {
                }else{
                    hasil += ',';
                }
            }

            var wanotif_csrotator = '{'+hasil+'}';
            var wanotif_status = $('input[type=radio][name=wanotif_status]:checked').val();
            var wanotif_type = $('input[type=radio][name=wanotif_type]:checked').val();
            var wanotif_apikey = $('#wanotif_apikey').val();
            var wanotif_message = $('#wanotif_general_message').val();

            var datanya = [
                    wanotif_status,
                    wanotif_type,
                    wanotif_apikey,
                    wanotif_message,
                    wanotif_csrotator
                ];
                
            var data = {
                'action': 'myaction_save_wanotif_settings',
                'datanya': datanya
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response_wanotif").html(response);
                window.location.reload();
            });
        });


        $( "#save_qris" ).bind("click", function(e){

            $("#success_response8").html('<span class="button" style="margin-top: 20px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Saving...</span>');

            var qris_qrcode = $('#qris_link').val();

            var datanya = [
                    qris_qrcode
                ];
                
            var data = {
                'action': 'myaction_save_qris',
                'datanya': datanya
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response8").html(response);
                window.location.reload();
            });
        });

        

        $( "#save_telegram" ).bind("click", function(e){

            var botnya = $('#telegram_username_bot').val();

            if($('input[type=radio][name=telegram_status]:checked').val()==1){
                if(botnya==''){
                    alert('Bot anda kosong. Daftarkan Bot anda terlebih dahulu.');
                    return false;
                }
            }

            $("#success_response_channel").html('<span class="button" style="margin-top: 20px;border: 0;background: none;box-shadow: none;cursor: text;">Saving...</span>');

            var arr_user = $('select.select_csrotator_channel').map(function(){
                return this.value;
            }).get().toString();

            var arr_apikey = $('input.csrotator_channel').map(function(){
                return this.value;
            }).get().toString();

            var str1 = arr_user;
            var str1_array = str1.split(',');

            var str2 = arr_apikey;
            var str2_array = str2.split(',');


            var hasil = '';
            var len = str1_array.length;
            for(var i = 0; i < str1_array.length; i++) {
                
                hasil += '"'+str1_array[i]+'":"'+str2_array[i]+'"';
                if (i == len - 1) {
                }else{
                    hasil += ',';
                }
            }

            var telegram_status = $('input[type=radio][name=telegram_status]:checked').val();
            var telegram_single_channel = $('#telegram_single_channel').val();
            var telegram_csrotator_channel = '{'+hasil+'}';
            var telegram_general_message = $('#telegram_general_message').val();

            var datanya = [
                telegram_status,
                telegram_single_channel,
                telegram_csrotator_channel,
                telegram_general_message
            ];
            
            var data = {
                'action': 'myaction_save_telegram_settings',
                'datanya': datanya
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response_channel").html(response);
                window.location.reload();
            });
        });

        
        $( "#add_apikey" ).bind("click", function(e){
            var rand = randomString(3);

            $('.div_apikey').append('<div class="apikey_csrotator" id="'+rand+'"><select name="id_user_csrorator" class="select_csrotator"><?php echo get_datauser(null);?></select><input type="text" class="api-input csrotator_apikey" value="" placeholder="Apikey Wanotif" maxlength="32" style="margin-left: 4px;"><button class="button btn_mgo btn_del_apikey" title="Delete Apikey" style="margin-left: 4px;" onclick=del("'+rand+'")><span class="dashicons dashicons-no-alt"></span></button></div>');
        });

        $( ".btn_del_apikey" ).bind("click", function(e){
            var idnya = $(this).data('id');
            $('#'+idnya).remove();
        });


        $( "#add_channel" ).bind("click", function(e){
            var rand = randomString(3);

            $('.div_channel').append('<div class="channel_csrotator" id="'+rand+'"><select name="id_user_csrorator_channel" class="select_csrotator_channel"><?php echo get_datauser(null);?></select><input type="text" class="api-input csrotator_channel" value="" placeholder="@NamaChannel" style="margin-left: 4px;"><button class="button btn_mgo btn_del_channel" title="Delete Channel" style="margin-left: 4px;" onclick=del("'+rand+'")><span class="dashicons dashicons-no-alt"></span></button></div>');
        });

        $( ".btn_del_channel" ).bind("click", function(e){
            var idnya = $(this).data('id');
            $('#'+idnya).remove();
        });

        function del(a){
            $('#'+a).remove();
        }

        
        <?php if($sms_apiurl!='http://reguler.sms-notifikasi.com/apps/smsapi.php' && $sms_apiurl!='http://masking.sms-notifikasi.com/apps/smsapi.php' && $sms_apiurl!='https://reguler.zenziva.net/apps/smsapi.php' && $sms_apiurl!='https://alpha.zenziva.net/apps/smsapi.php'){echo '$(".two_way").show();'; }else{echo '$(".two_way").hide();';}?>

        $( ".sms_apiurl" ).bind("change", function(e){
            var sms_apiurl = $(this).val();
            if(sms_apiurl=='two_way'){
                $('.two_way').show();
            }else{
                $('.two_way').hide();
            }
        });

        $( ".ro_pro" ).bind("change", function(e){
            var ro_pro_val = $(this).val();
            if(ro_pro_val=='4'){
                $('.api_ro_self').show();
            }else{
                $('.api_ro_self').hide();
            }
        });

        
        $('#save_api_ro').bind('click', function() {
            $("#success_response_ro").html('<span class="button" style="margin-top: 15px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Saving...</span>');

            var ro_pro = $('input[type=radio][name=ro_pro]:checked').val();

            if(ro_pro=='4'){
                apikey_ro = $('input.api_ro_self').val();
            }else{
                apikey_ro = ro_pro;
            }

            var datanya = [
                    apikey_ro
                ];
                
            var data = {
                'action': 'myaction_save_api_rajaongkir',
                'datanya': datanya
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response_ro").html(response);
                window.location.reload();
            });
        });

        $('#save_moota_apikey').bind('click', function() {
            $("#success_response_moota").html('<span class="button" style="margin-top: 25px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Saving...</span>');

            var moota_apikey = $('#moota_apikey').val();
            var moota_status = $('input[type=radio][name=moota_status]:checked').val();
            var moota_wanotif_message = $('#moota_wanotif_message').val();
            var moota_wanotif_status = $('input[type=radio][name=moota_wanotif_status]:checked').val();

            var datanya = [
                    moota_apikey,
                    moota_status,
                    moota_wanotif_message,
                    moota_wanotif_status
                ];
                
            var data = {
                'action': 'myaction_save_moota_apikey',
                'datanya': datanya
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response_moota").html(response);
                window.location.reload();
            });
        });

        


        $('#save_sms_settings').bind('click', function() {
            $("#success_response3").html('<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Saving...</span>');

            var apiurlnya = $('input[type=radio][name=sms_apiurl]:checked').val();

            if(apiurlnya=='two_way'){
                apiurlnya = $('input.two_way').val();
            }

            var datanya = [
                    $('input[type=radio][name=sms_status]:checked').val(),
                    $('#sms_userkey').val(),
                    $('#sms_passkey').val(),
                    apiurlnya,
                    $('#sms_text').val()
                ];
                
            var data = {
                'action': 'myaction_save_smssettings',
                'datanya': datanya
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response3").html(response);
                window.location.reload();
            });
        });

        $('#save_jquery').bind('click', function() {
            $("#success_response4").html('<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Saving...</span>');
            var datanya = [
                    $('input[type=radio][name=jquery_active]:checked').val()
                ];
            var data = {
                'action': 'myaction_save_jquery',
                'datanya': datanya
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response4").html(response);
                window.location.reload();
            });
        });

        $('#save_minchar').bind('click', function() {
            $("#success_response5").html('<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Saving...</span>');
            
            var datanya = [
                    $("#minchar").find("option:selected").val()
                ];
            var data = {
                'action': 'myaction_save_minchar',
                'datanya': datanya
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response5").html(response);
                window.location.reload();
            });
        });

        $('#save_fontawesome').bind('click', function() {
            $("#success_response6").html('<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Saving...</span>');
            var datanya = [
                    $('input[type=radio][name=fontawesome]:checked').val()
                ];
            var data = {
                'action': 'myaction_save_fontawesome',
                'datanya': datanya
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response6").html(response);
                window.location.reload();
            });
        });

        $('#save_page_protector').bind('click', function() {
            $("#success_response9").html('<span class="button" style="margin-top: 30px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Saving...</span>');
            var datanya = [
                    $('input[type=radio][name=page_protector]:checked').val()
                ];
            var data = {
                'action': 'myaction_save_page_protector',
                'datanya': datanya
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response9").html(response);
                window.location.reload();
            });
        });

        $('#save_mgo_footer').bind('click', function() {
            $("#success_response10").html('<span class="button" style="margin-top: 30px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Saving...</span>');
            var datanya = [
                    $('input[type=radio][name=mgo_footer]:checked').val()
                ];
            var data = {
                'action': 'myaction_save_mgo_footer',
                'datanya': datanya
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response10").html(response);
                window.location.reload();
            });
        });

    


        $('#request_bot').bind('click', function() {
            $("#success_response7").html('<span class="button" style="margin-top: 20px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: -10px;">Requesting...</span>');
            var datanya = [
                    $('#telegram_apikey_bot').val()
                ];
            var data = {
                'action': 'myaction_get_username_telegram',
                'datanya': datanya
            };

            jQuery.post(ajaxurl, data, function(response) {
                if(response!='failed'){
                    var info = '<span class="button" style="margin-top: 20px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: -10px;color: #2EC26A;">Request Success, Telegram Bot detected.<br>Klik <span style="color:#263B51;">"Register Bot"</span> to Activated.</span>';
                    $('#telegram_username_bot').attr('value', response).val(response);
                }else{
                    var info = '<span class="button" style="margin-top: 20px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: -10px;color: #C11D1D;">Failed! Please check your API Key.</span>';
                }
                
                $("#success_response7").html(info);
                // window.location.reload();
            });
        });

        $('#register_bot').bind('click', function() {
            $("#success_response7").html('<span class="button" style="margin-top: 20px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: -10px;">Registering...</span>');
            if($('#telegram_username_bot').val()==''){
                alert('Your Bot empty!');
                return false;
            }
            var datanya = [
                    $('#telegram_apikey_bot').val(),
                    $('#telegram_username_bot').val()
                ];
            var data = {
                'action': 'myaction_get_data_telegram',
                'datanya': datanya
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response7").html(response);
                // window.location.reload();
            });
        });

        $('#send_to_telegram').bind('click', function() {
            $("#success_response7").html('<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Sending...</span>');
            var datanya = [
                    $('#apiTelegram').val()
                ];
            var data = {
                'action': 'myaction_mgo_send2tg',
                'datanya': datanya
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response7").html(response);
                // window.location.reload();
            });
        });

        $('#send_to_telegram_channel').bind('click', function() {
            $("#success_response7").html('<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Sending...</span>');
            var datanya = [
                    $('#apiTelegram').val()
                ];
            var data = {
                'action': 'myaction_mgo_send2tg_channel',
                'datanya': datanya
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response7").html(response);
                // window.location.reload();
            });
        });

        $('#test_whatsapp_settings').bind('click', function() {

            $.confirm({
                title: '<p style="text-align:center;"><br><img style="width:80px;padding-left:15px;" src="<?php echo plugin_dir_url( __FILE__ )?>../assets/icons/sendwa.png" /><br><img id="loading_sendwa" style="width:30px;margin-left:-8px;display:none;" src="<?php echo plugin_dir_url( __FILE__ )?>../assets/icons/loader2.gif" /><span id="info_sendwa"></span></p>',
                content: '' +
                '<form action="" class="formName">' +
                '<div class="form-group">' +
                '<label style="font-size: 14px;padding-bottom: 20px;">Pilih Apikey:</label><br>' +
                '<select style="margin-bottom: 10px;height: 40px;width: 350px;padding-left:7px;" class="apikey_option"><?php echo get_apikey_wanotif();?></select>' +
                '<label style="font-size: 14px;padding-bottom: 20px;">Phone Number:</label><br>' +
                '<input style="width: 99%;padding: 10px 10px;margin-bottom:10px;" type="text" placeholder="Contoh: 087825642567" class="phone_wa form-control" required />' +
                '<label style="font-size: 14px;padding-bottom: 20px;">Message:</label><br>' +
                '<textarea class="message_wa" name="" style="width: 99%;" rows="3" required></textarea>' +
                '</div>' +
                '</form>',
                buttons: {
                    cancel: function () {
                        //close
                        // $.alert('canceled');
                    },
                    formSubmit: {
                        text: 'Send WA',
                        btnClass: 'btn-green',
                        action: function () {
                            var phone = this.$content.find('.phone_wa').val();
                            if(!phone){
                                $.alert("Phone Number can't be empty!");
                                return false;
                            }
                            var message = this.$content.find('.message_wa').val();
                            if(!message){
                                $.alert("Message can't be empty!");
                                return false;
                            }
                            if(isNaN(phone)){
                                $.alert("Phone Number is not a Number!");
                                return false;
                            }

                            var apikey = this.$content.find('.apikey_option').val();
                            // alert(apikey);
                            // return false;

                            $('#loading_sendwa').show();
                            $('#info_sendwa').html('').hide();

                            var datanya = [
                                    apikey,
                                    phone,
                                    message
                                ];
                                
                            var data = {
                                'action': 'myaction_testing_sendwa',
                                'datanya': datanya
                            };

                            jQuery.post(ajaxurl, data, function(response) {
                                $('#loading_sendwa').hide();
                                if(response=='success'){
                                    $('#info_sendwa').html('<span style="color:#00C11D">Send Success</span>').show();
                                }else{
                                    $('#info_sendwa').html('<span style="color:#e61818">'+response+'</span>').show();
                                }
                            });

                            return false;
                            // $.alert('Your name is ' + name);
                        }
                    }
                },
                onContentReady: function () {
                    // bind to events
                    var jc = this;
                    this.$content.find('form').on('submit', function (e) {
                        // if the user submits the form by pressing enter in the field.
                        e.preventDefault();
                        jc.$$formSubmit.trigger('click'); // reference the button and click it
                    });
                }
            });
        });


        $('#test_telegram_settings').bind('click', function() {

            $.confirm({
                title: '<p style="text-align:center;"><br><img style="width:80px;padding-left:15px;" src="<?php echo plugin_dir_url( __FILE__ )?>../assets/icons/sendtg.png" /><br><img id="loading_send_telegram" style="width:30px;margin-left:-8px;display:none;" src="<?php echo plugin_dir_url( __FILE__ )?>../assets/icons/loader2.gif" /><span id="info_sendtele"></span></p>',
                content: '' +
                '<form action="" class="formName">' +
                '<div class="form-group">' +
                '<label style="font-size: 14px;padding-bottom: 20px;">Channel:</label><br>' +
                '<select style="margin-bottom: 10px;height: 40px;width: 350px;padding-left:7px;" class="channel_option"><?php echo get_channel_telegram();?></select>' +
                '<label style="font-size: 14px;padding-bottom: 20px;">Message:</label><br>' +
                '<textarea class="message_to_channel" name="" style="width: 99%;" rows="3" required></textarea>' +
                '</div>' +
                '</form>',
                buttons: {
                    cancel: function () {
                        //close
                        // $.alert('canceled');
                    },
                    formSubmit: {
                        text: 'Send to Channel',
                        btnClass: 'btn-blue btn-telegram',
                        action: function () {
                            var message = this.$content.find('.message_to_channel').val();
                            if(!message){
                                $.alert("Message can't be empty!");
                                return false;
                            }

                            var channel = this.$content.find('.channel_option').val();
                            // alert(apikey);
                            // return false;

                            $('#loading_send_telegram').show();
                            $('#info_sendtele').html('').hide();

                            var datanya = [
                                    channel,
                                    message
                                ];
                                
                            var data = {
                                'action': 'myaction_testing_send_telegram',
                                'datanya': datanya
                            };

                            jQuery.post(ajaxurl, data, function(response) {
                                $('#loading_send_telegram').hide();
                                if(response=='success'){
                                    $('#info_sendtele').html('<span style="color:#00C11D">Send Success.</span>').show();
                                }else{
                                    $('#info_sendtele').html('<span style="color:#e61818">'+response+'</span>').show();
                                }
                            });

                            return false;
                        }
                    }
                },
                onContentReady: function () {
                    // bind to events
                    var jc = this;
                    this.$content.find('form').on('submit', function (e) {
                        // if the user submits the form by pressing enter in the field.
                        e.preventDefault();
                        jc.$$formSubmit.trigger('click'); // reference the button and click it
                    });
                }
            });
        });


        
        $('#test_sms_settings').bind('click', function() {
            var sms_status = $('input[type=radio][name=sms_status]:checked').val();
            var sms_userkey = $('#sms_userkey').val();
            var sms_passkey = $('#sms_passkey').val();
            var sms_apiurl = $('input[type=radio][name=sms_apiurl]:checked').val();
            var sms_text = $('#sms_text').val();

            if(sms_status=='' || sms_userkey=='' || sms_passkey=='' || sms_apiurl=='' || sms_text==''){
                $.alert({
                    title: '',
                    content: '<b>Sorry,</b> Complete your API SMS Settings first!<br>1. Save API SMS Settings<br>2. Test SMS',
                    icon: 'dashicons dashicons-warning',
                    animation: 'scale',
                    closeAnimation: 'scale',
                    theme: 'modern',
                    scrollToPreviousElement: false,
                    scrollToPreviousElementAnimate: false,
                    buttons: {
                        okay: {
                            text: 'Okay',
                            btnClass: 'btn-blue'
                        }
                    }
                });
                return false;
            }

            $.confirm({
                title: '<p style="text-align:center;"><br><img style="width:80px;padding-left:15px;" src="<?php echo plugin_dir_url( __FILE__ )?>../assets/icons/sendsms.png" /><br><img id="loading_sendsms" style="width:30px;margin-left:-8px;display:none;" src="<?php echo plugin_dir_url( __FILE__ )?>../assets/icons/loader2.gif" /><span id="info_sendsms"></span></p>',
                content: '' +
                '<form action="" class="formName">' +
                '<div class="form-group">' +
                '<label style="font-size: 14px;padding-bottom: 20px;">Phone Number:</label><br>' +
                '<input style="width: 99%;padding: 10px 10px;margin-bottom:10px;" type="text" placeholder="Contoh: 087825642567" class="phone form-control" required />' +
                '<label style="font-size: 14px;padding-bottom: 20px;">Message:</label><br>' +
                '<textarea class="message" name="" style="width: 99%;" rows="3" required></textarea>' +
                '</div>' +
                '</form>',
                buttons: {
                    cancel: function () {
                        //close
                        // $.alert('canceled');
                    },
                    formSubmit: {
                        text: 'Send SMS',
                        btnClass: 'btn-red btn-sms',
                        action: function () {
                            var phone = this.$content.find('.phone').val();
                            if(!phone){
                                $.alert("Phone Number can't be empty!");
                                return false;
                            }
                            var message = this.$content.find('.message').val();
                            if(!message){
                                $.alert("Message can't be empty!");
                                return false;
                            }
                            if(isNaN(phone)){
                                $.alert("Phone Number is not a Number!");
                                return false;
                            }

                            $('#loading_sendsms').show();
                            $('#info_sendsms').html('').hide();

                            var datanya = [
                                    phone,
                                    message
                                ];
                                
                            var data = {
                                'action': 'myaction_testing_sendsms',
                                'datanya': datanya
                            };

                            jQuery.post(ajaxurl, data, function(response) {
                                $('#loading_sendsms').hide();
                                $('#info_sendsms').html(response).show();
                            });

                            return false;
                            // $.alert('Your name is ' + name);
                        }
                    }
                },
                onContentReady: function () {
                    // bind to events
                    var jc = this;
                    this.$content.find('form').on('submit', function (e) {
                        // if the user submits the form by pressing enter in the field.
                        e.preventDefault();
                        jc.$$formSubmit.trigger('click'); // reference the button and click it
                    });
                }
            });
        });
        
    </script>
    <?php
}