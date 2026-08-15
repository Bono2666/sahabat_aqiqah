<?php

function magic_order_data_settings() {
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

    $row = $wpdb->get_results('SELECT data from '.$table_name.' where type="wa_pembuka" or type="wa_penutup" or type="orderid_text" or type="orderid_max" or type="table_field" or type="order_refresh_page" or type="order_refresh_second" or type="wa_followup_dua" or type="wa_followup_tiga" or type="label_pengirim" or type="btn_del_status" or type="followup_wanotif_status" or type="nama_produk_status" or type="nama_produk_other_name" or type="order_id_status" or type="order_id_other_name" or type="dash_style" or type="utc_status" or type="utc_value" or type="utc_status_dataorder" or type="utc_value_dataorder" or type="followup_button_status" or type="pagination_table" ORDER BY id ASC');
    $wa_depan  = $row[0]->data;
    $wa_belakang  = $row[1]->data;
    $orderid_text = $row[2]->data;
    $orderid_max = $row[3]->data;
    $table_field = $row[4]->data;
    $order_refresh_page = $row[5]->data;
    $order_refresh_second = $row[6]->data;
    $wa_followup_dua = $row[7]->data;
    $wa_followup_tiga = $row[8]->data;
    $label_pengirim = $row[9]->data;
    $btn_del_status = $row[10]->data;
    $followup_wanotif_status = $row[11]->data;
    $nama_produk_status = $row[12]->data;
    $nama_produk_other_name = $row[13]->data;
    $order_id_status = $row[14]->data;
    $order_id_other_name = $row[15]->data;
    $dash_style = $row[16]->data;
    $utc_status = $row[17]->data;
    $utc_value = $row[18]->data;
    $utc_status_dataorder = $row[19]->data;
    $utc_value_dataorder = $row[20]->data;
    $followup_button_status = $row[21]->data;
    $pagination_table = $row[22]->data;

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
        .btn_mgo {
            height: 40px !important;
            padding-left: 20px !important;
            padding-right: 20px !important;
        }
        .wrap-container {
            margin-top: -150px;
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

        /*editor*/

        #toolbar, #toolbar2, #toolbar3, #toolbar4, #toolbar5 {
          margin: 0 0 1em;
          border: 0 none;
          padding: 0;
          list-style: none;
        }
        #toolbar li, #toolbar2 li, #toolbar3 li, #toolbar4 li, #toolbar5 li {
          display: inline-block;
        }
        #toolbar li a, #toolbar2 li a, #toolbar3 li a, #toolbar4 li a, #toolbar5 li a {
          color: #999;
          text-decoration: none;
          background-color: #eee;
          border: 1px solid #ccc;
          display: inline-block;
          width: 2em;
          line-height: 2em;
          text-align: center;
        }
        #toolbar li a:hover, #toolbar2 li a:hover, #toolbar3 li a:hover, #toolbar4 li a:hover, #toolbar5 li a:hover {
          box-shadow: 0 1px 3px #ccc;
        }

        #editable, #editable2, #editable3, #editable4, #editable5 {
          min-height: 5em;
          outline: 0 none;
        }
        #editable:empty::before, #editable2:empty::before, #editable3:empty::before, #editable4:empty::before, #editable5:empty::before {
          content: "Whatsapp Custom Text";
          color: #ccc;
        }

        #result, #result3, #result5 {
          background-color: #eee;
          padding: .5em .75em;
        }
        #result::before, #result3::before, #result5::before {
          content: "HTML output:";
          display: block;
          color: #999;
        }
        i.emoji-picker-icon.fa-smile-o::before {
            content: "" !important;
        }
        .fa-smile-o::before {
        }
        .emoji-picker-icon {
            background: #eaeaea;
            background-image: url("<?php echo plugin_dir_url( __FILE__ ); ?>../assets/emoji/lib/img/emoji-icon.jpg");
            width: 24px;
            height: 24px;
        }
        #divcontainer5 .emoji-picker-icon {
            display: none;
        }
        .box {min-height: 80px;cursor: text;border: 1px solid #ddd;padding: 10px 10px;}
        .radio.ganjil{margin-right:32px}.labelname{padding-left:8px;position:absolute;margin-left:30px;margin-top:-21px}.checkbox,.radio{margin-bottom:8px;margin-left:-10px;width:48%;float:left}.radio label{padding:10px}.checkbox *,.radio *{cursor:pointer}.checkbox input,.radio input{opacity:0}.checkbox span,.radio span{position:relative;display:inline-block;margin-left:-25px;vertical-align:top;width:20px;height:20px;border-radius:2px;border:1px solid #ccc}.checkbox:hover span,.radio:hover span{border-color:#6c61f6}.checkbox span:before,.radio span:before{content:"\2713";position:absolute;top:0;left:0;right:0;bottom:0;opacity:0;text-align:center;font-size:16px;line-height:16px;vertical-align:middle;color:#6c61f6}.radio span{border-radius:50%}.radio span:before{content:"";width:10px;height:10px;margin:5px auto;background-color:#6c61f6;border-radius:100px}.checkbox input[type=checkbox]:checked+span,.radio input[type=radio]:checked+span{border-color:#6c61f6;background-color:#6c61f6}.radio input[type=radio]:checked+span{background-color:#fff}.checkbox input[type=checkbox]:checked+span:before,.radio input[type=radio]:checked+span:before{color:#fff;opacity:1;transition:color .3 ease-out}.checkbox input[type=checkbox]:disabled+span,.radio input[type=radio]:disabled+span{border-color:#ddd!important;background-color:#ddd!important}
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
              
              <a href="<?php echo admin_url('admin.php?page=magic_order_data_wareset') ?>" style="cursor: pointer;position: absolute;right: 0;margin-top: 80px;margin-right: 50px;height: 0;width: 0;">
                <span class='button' style="float: right;border: none;background: none;box-shadow: none;margin-top: -25px;"><span class="dashicons dashicons-admin-generic" style="margin-top: 6px;margin-right: 3px;font-size: 16px;"></span>Whatsapp RESET</span>
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

        <div class="wrap-container" style="margin-top: -190px;">
            <div class="api-container">
                <div class="page-title" style="font-size: 21px;margin-top: 50px;"><a href="<?php echo admin_url('admin.php?page=magic_order_data') ?>" style="text-decoration: none;margin-left:0px;" class="mgo_link"><span>DATA ORDER</span></a><span><span class="dashicons dashicons-arrow-right-alt2"></span><span class="dashicons dashicons-arrow-right-alt2" style="margin-left: -15px;"></span></span><span>SETTINGS</span></div>
                <br>
                <br>
                <hr><BR>
                <p style="color:#464646;"><b>ORDER ID</b><br>
                <p>Silahkan setting ORDER ID sesuai kebutuhan anda. Disarankan menggunakan random character, untuk memperkecil terjadinya Order ID yang sama.</p>
                <br>
                <input id="orderid_text" type="text" maxlength="10" title="Masukkan 3 sampai dengan 10 huruf karakter toko anda. 3 Huruf lebih baik!" value="<?php echo $orderid_text; ?>" style="font-weight: bold;height: 35px;width: 95px;text-align:center;" <?php echo $disabled_setting;?> >
                <span>+</span>
                <select name="" id="orderid_max" style="height: 35px;margin-top: -2px;width: 210px;" <?php echo $disabled_setting;?> >
                    <option value="4" <?php if($orderid_max==4){ echo'selected';} ?>>4 random character</option>
                    <option value="5" <?php if($orderid_max==5){ echo'selected';} ?>>5 random character</option>
                    <option value="6" <?php if($orderid_max==6){ echo'selected';} ?>>6 random character</option>
                    <option value="7" <?php if($orderid_max==7){ echo'selected';} ?>>7 random character</option>
                    <option value="8" <?php if($orderid_max==8){ echo'selected';} ?>>8 random character</option>
                    <option value="9" <?php if($orderid_max==9){ echo'selected';} ?>>9 random character</option>
                    <option value="14" <?php if($orderid_max==14){ echo'selected';} ?>>4 random number</option>
                    <option value="15" <?php if($orderid_max==15){ echo'selected';} ?>>5 random number</option>
                    <option value="16" <?php if($orderid_max==16){ echo'selected';} ?>>6 random number</option>
                </select>
                <br><br>
                <br>
                <input type='button' id="save_orderid_settings" name="insert" value='Save Order ID' class='button btn_mgo' style="margin-left:0px;" <?php echo $disabled_setting;?> ><span id="success_response2"></span>
                <br>
                <br>
                <br>
                <hr>
                <BR>
                <BR>
                <p style="color:#464646;"><b>DASHBOARD STATISTIC</b><br>
                <br>
                <div style="padding-bottom: 10px;">
                    <div class="radio" style="width:100%;margin-bottom: 12px;height: 100px;margin-top: 20px;">
                      <label>
                        <input class="table_field dash_style" name="dash_style" value="0" type="radio" <?php if($dash_style=='0'){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;"><img style="margin-top: -50px;" class="icon-title2" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/dash/style1.jpg"></div>
                      </label>
                    </div>
                    <div class="radio" style="width:100%;margin-bottom: 75px;">
                      <label>
                        <input class="table_field dash_style" name="dash_style" value="1" type="radio" <?php if($dash_style=='1'){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;"><img style="margin-top: -50px;" class="icon-title2" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/dash/style2.jpg"></div>
                      </label>
                    </div>
                </div>
                <br>
                <br>
                <input type='button' id="save_dash_style" name="insert" value='Save Dashboard' class='button btn_mgo' style="margin-left:0px;" <?php echo $disabled_setting;?> ><span id="success_response_dash"></span>
                <br>
                <br>
                <br> <br>
                <hr>
                <BR>
                <BR>
                <p style="color:#464646;"><b>TABLE PAGINATION STYLE</b><br>
                <br>
                <div style="padding-bottom: 10px;">
                    <div class="radio" style="width:100%;margin-bottom: 12px;height: 60px;margin-top: 20px;">
                      <label>
                        <input class="table_field pagination_table" name="pagination_table" value="0" type="radio" <?php if($pagination_table=='0'){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -40px;"><img style="margin-top: -20px;width: 350px;" class="icon-title2" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/table/tab1.jpg"></div>
                      </label>
                    </div>
                    <div class="radio" style="width:100%;margin-bottom: 55px;">
                      <label>
                        <input class="table_field pagination_table" name="pagination_table" value="1" type="radio" <?php if($pagination_table=='1'){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -43px;"><img style="margin-top: -20px;width: 380px;" class="icon-title2" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/table/tab2.jpg"></div>
                      </label>
                    </div>
                </div>
                <br>
                <br>
                <input type='button' id="save_pagination_table" name="insert" value='Save Style' class='button btn_mgo' style="margin-left:0px;" <?php echo $disabled_setting;?> ><span id="success_response_pagination_table"></span>
                <br>
                <br>
                <br>
                <hr>
                <br>
                <p style="color:#464646;"><b>NAME TITLE</b><br>
                <br>
                <p style="color:#464646;margin-top: -10px;">( Order ID )<br>
                <div style="padding-bottom: 10px;">
                    <div class="radio" style="width:24.5%;margin-bottom: 12px;">
                      <label>
                        <input class="table_field order_id_status" name="order_id_status" value="0" type="radio" <?php if($order_id_status=='0'){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Order ID</div>
                      </label>
                    </div>
                    <div class="radio" style="width:24.5%;margin-bottom: 12px;">
                      <label>
                        <input class="table_field order_id_status" name="order_id_status" value="1" type="radio" <?php if($order_id_status=='1'){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Invoice ID</div>
                      </label>
                    </div>
                    <div class="radio" style="width:24.5%;margin-bottom: 12px;">
                      <label>
                        <input class="table_field order_id_status" name="order_id_status" value="2" type="radio" <?php if($order_id_status=='2'){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Donation ID</div>
                      </label>
                    </div>
                    <div class="radio" style="width:24.5%;margin-bottom: 12px;">
                      <label>
                        <input class="table_field order_id_status" name="order_id_status" value="3" type="radio" <?php if($order_id_status=='3'){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Others</div>
                      </label>
                    </div>
                    <input class="api-input order_id_other_name" type="text" placeholder="Other name" style="font-size: 14px;font-weight: bold;color: #6c61f6;margin-bottom:-20px;margin-top:10px;<?php if($order_id_status!='3'){echo'display:none;';}?>" value="<?php echo $order_id_other_name; ?>" />
                </div>
                <br>
                <p style="color:#464646;margin-top: 20px;">( Nama Produk )<br>
                <div style="padding-bottom: 10px;">
                    <div class="radio" style="width:24.5%;margin-bottom: 12px;">
                      <label>
                        <input class="table_field nama_produk_status" name="nama_produk_status" value="0" type="radio" <?php if($nama_produk_status=='0'){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Produk</div>
                      </label>
                    </div>
                    <div class="radio" style="width:24.5%;margin-bottom: 12px;">
                      <label>
                        <input class="table_field nama_produk_status" name="nama_produk_status" value="1" type="radio" <?php if($nama_produk_status=='1'){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Program</div>
                      </label>
                    </div>
                    <div class="radio" style="width:24.5%;margin-bottom: 12px;">
                      <label>
                        <input class="table_field nama_produk_status" name="nama_produk_status" value="2" type="radio" <?php if($nama_produk_status=='2'){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Kegiatan</div>
                      </label>
                    </div>
                    <div class="radio" style="width:24.5%;margin-bottom: 12px;">
                      <label>
                        <input class="table_field nama_produk_status" name="nama_produk_status" value="3" type="radio" <?php if($nama_produk_status=='3'){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Others</div>
                      </label>
                    </div>
                    <input class="api-input nama_produk_other_name" type="text" placeholder="Other name" style="font-size: 14px;font-weight: bold;color: #6c61f6;margin-bottom:-20px;margin-top:10px;<?php if($nama_produk_status!='3'){echo'display:none;';}?>" value="<?php echo $nama_produk_other_name; ?>" />
                </div>
                <br>
                <br>
                <input type='button' id="save_nama_produk" name="insert" value='Save Name' class='button btn_mgo' style="margin-left:0px;margin-top: 5px;" <?php echo $disabled_setting;?> ><span id="success_response_nama_produk"></span>
                <br>
                <br>
                <br>
                <hr>
                <br>
                <br>

                <p style="color:#464646;"><b>TABLE FIELD / COLUMN</b><br>
                <br>
                <?php

                $array_table = explode(',', $table_field);
                if (in_array("0", $array_table)) { $no_show = 1; }else{ $no_show = 0; }
                if (in_array("1", $array_table)) { $name_show = 1; }else{ $name_show = 0; }
                if (in_array("2", $array_table)) { $form_show = 1; }else{ $form_show = 0; }
                if (in_array("3", $array_table)) { $orderid_show = 1; }else{ $orderid_show = 0; }
                if (in_array("4", $array_table)) { $total_show = 1; }else{ $total_show = 0; }
                if (in_array("5", $array_table)) { $date_show = 1; }else{ $date_show = 0; }
                if (in_array("6", $array_table)) { $cs_show = 1; }else{ $cs_show = 0; }
                if (in_array("7", $array_table)) { $detail_show = 1; }else{ $detail_show = 0; }
                if (in_array("8", $array_table)) { $wa_show = 1; }else{ $wa_show = 0; }
                if (in_array("9", $array_table)) { $status_show = 1; }else{ $status_show = 0; }
                if (in_array("10", $array_table)) { $action_show = 1; }else{ $action_show = 0; }
                if (in_array("11", $array_table)) { $kupon_show = 1; }else{ $kupon_show = 0; }
                if (in_array("12", $array_table)) { $multiple_wa_show = 1; }else{ $multiple_wa_show = 0; }
                if (in_array("13", $array_table)) { $nama_produk_show = 1; }else{ $nama_produk_show = 0; }
                if (in_array("14", $array_table)) { $wanumber_show = 1; }else{ $wanumber_show = 0; }
                if (in_array("15", $array_table)) { $payment_show = 1; }else{ $payment_show = 0; }
                if (in_array("16", $array_table)) { $otp_show = 1; }else{ $otp_show = 0; }

                ?>

                <div style="margin-left: 12px;padding-bottom: 190px;margin-top: -10px;">
                    
                    <div class="checkbox">
                      <label>
                        <input class="table_field" name="table_no" id="id_0" value="0" type="checkbox" <?php if($no_show==1){echo 'checked'; }?> >
                        <span></span><div class="labelname">1. No</div>
                      </label>
                    </div>


                    <div class="checkbox">
                      <label>
                        <input class="table_field" name="table_date" id="id_5" value="5" type="checkbox" <?php if($date_show==1){echo 'checked'; }?> >
                        <span></span><div class="labelname">10. Date Order</div>
                      </label>
                    </div>

                    <div class="checkbox">
                      <label>
                        <input class="table_field" name="table_name" id="id_1" value="1" type="checkbox" <?php if($name_show==1){echo 'checked'; }?> >
                        <span></span><div class="labelname">2. Name</div>
                      </label>
                    </div>

                    <div class="checkbox">
                      <label>
                        <input class="table_field" name="table_detail" id="id_7" value="7" type="checkbox" <?php if($detail_show==1){echo 'checked'; }?> >
                        <span></span><div class="labelname">11. Detail</div>
                      </label>
                    </div>


                    <div class="checkbox">
                      <label>
                        <input class="table_field" name="table_action" id="id_13" value="13" type="checkbox" <?php if($nama_produk_show==1){echo 'checked'; }?> >
                        <span></span><div class="labelname">3. Product</div>
                      </label>
                    </div>


                    <div class="checkbox">
                      <label>
                        <input class="table_field" name="table_wa" id="id_8" value="8" type="checkbox" <?php if($wa_show==1){echo 'checked'; }?> >
                        <span></span><div class="labelname">12. Followup</div>
                      </label>
                    </div>


                    <div class="checkbox">
                      <label>
                        <input class="table_field" name="table_form" id="id_14" value="14" type="checkbox" <?php if($wanumber_show==1){echo 'checked'; }?> >
                        <span></span><div class="labelname">4. Whatsapp</div>
                      </label>
                    </div>

                    
                    <div class="checkbox">
                      <label>
                        <input class="table_field" name="table_multiple_wa" id="id_12" value="12" type="checkbox" <?php if($multiple_wa_show==1){echo 'checked'; }?> >
                        <span></span><div class="labelname">13. Multiple Followup</div>
                      </label>
                    </div>
                    

                    <div class="checkbox">
                      <label>
                        <input class="table_field" name="table_form" id="id_2" value="2" type="checkbox" <?php if($form_show==1){echo 'checked'; }?> >
                        <span></span><div class="labelname">5. Form</div>
                      </label>
                    </div>

                    <div class="checkbox">
                      <label>
                        <input class="table_field" name="table_kupon" id="id_11" value="11" type="checkbox" <?php if($kupon_show==1){echo 'checked'; }?> >
                        <span></span><div class="labelname">14. Coupon</div>
                      </label>
                    </div>

                    <div class="checkbox">
                      <label>
                        <input class="table_field" name="table_orderid" id="id_3" value="3" type="checkbox" <?php if($orderid_show==1){echo 'checked'; }?> >
                        <span></span><div class="labelname">6. Order ID</div>
                      </label>
                    </div>
                    

                    <div class="checkbox">
                      <label>
                        <input class="table_field" name="table_action" id="id_10" value="10" type="checkbox" <?php if($action_show==1){echo 'checked'; }?> >
                        <span></span><div class="labelname">15. Action</div>
                      </label>
                    </div>

                    <div class="checkbox">
                      <label>
                        <input class="table_field" name="table_cs" id="id_6" value="6" type="checkbox" <?php if($cs_show==1){echo 'checked'; }?> >
                        <span></span><div class="labelname">7. CS</div>
                      </label>
                    </div>

                    <div class="checkbox">
                      <label>
                        <input class="table_field" name="table_status" id="id_15" value="15" type="checkbox" <?php if($payment_show==1){echo 'checked'; }?> >
                        <span></span><div class="labelname">16. Payment</div>
                      </label>
                    </div>


                    <div class="checkbox">
                      <label>
                        <input class="table_field" name="table_status" id="id_9" value="9" type="checkbox" <?php if($status_show==1){echo 'checked'; }?> >
                        <span></span><div class="labelname">8. Status</div>
                      </label>
                    </div>

                    <div class="checkbox">
                      <label>
                        <input class="table_field" name="table_status" id="id_16" value="16" type="checkbox" <?php if($otp_show==1){echo 'checked'; }?> >
                        <span></span><div class="labelname">17. OTP</div>
                      </label>
                    </div>

                    <div class="checkbox">
                      <label>
                        <input class="table_field" name="table_total" id="id_4" value="4" type="checkbox" <?php if($total_show==1){echo 'checked'; }?> >
                        <span></span><div class="labelname">9. Total Price</div>
                      </label>
                    </div>


                    

                </div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <input type='button' id="save_table_settings" name="insert" value='Save Column' class='button btn_mgo' style="margin-left:0px;"><span id="success_response3"></span>
                <br>
                <br>
                <br>
                <hr>
                <br>
                <p style="color:#464646;margin-bottom: 20px;margin-top:20px;"><b>FOLLOWUP 1 - Whatsapp TEXT</b><br>
                <?php
                    // change icon emoji
                    $wa_depan = str_replace(':1f604:', '<img draggable="false" src="https://s.w.org/images/core/emoji/2.4/svg/1f604.svg" class="emoji" />', $wa_depan);

                ?>
                <div>
                    <ul id="toolbar" style="margin-bottom: -7px;margin-top: 12px;">
                        <li><a href="" data-action='["bold",false,null]' title="Bold" style="font-weight: bold;">B</a></li>
                        <li><a href="" data-action='["italic",false,null]' title="Italic" style="font-style: italic;">I</a></li>
                        <li><a href="" data-action='["strikeThrough",false,null]' title="Heading"><s>S</s></a></li>
                        <li><a href="" data-action='["removeFormat",false,null]' title="Remove formatting" style="width:64px;">&times; Reset</a></li>
                    </ul>
                    <div style="width: 100%;">
                        <div id="divcontainer" class="lead emoji-picker-container">
                            <div id="mytext" contenteditable="true" data-emojiable="true" data-emoji-input="unicode"><?php echo $wa_depan; ?></div>
                        </div>
                    </div>
                </div>
                <br>
                <div style="display: none;">
                <p  style="color:#464646;margin-bottom: 20px;display: none;"><b>FOLLOWUP 1 - WHATSAPP TEXT CLOSING</b><br>
                <div style="display: none;">
                    <ul id="toolbar2" style="margin-bottom: -7px;margin-top: 12px;">
                        <li><a href="" data-action='["bold",false,null]' title="Bold" style="font-weight: bold;">B</a></li>
                        <li><a href="" data-action='["italic",false,null]' title="Italic" style="font-style: italic;">I</a></li>
                        <li><a href="" data-action='["strikeThrough",false,null]' title="Heading"><s>S</s></a></li>
                        <li><a href="" data-action='["removeFormat",false,null]' title="Remove formatting" style="width:64px;">&times; Reset</a></li>
                    </ul>
                    <div style="width: 100%;display: none;">
                        <div id="divcontainer2" class="lead emoji-picker-container">
                            <div id="mytext2" contenteditable="true" data-emojiable="true" data-emoji-input="unicode"><?php echo $wa_belakang; ?></div>
                        </div>
                    </div>
                </div>
                <br>
                </div>

                <p  style="color:#464646;margin-bottom: 20px;"><b>FOLLOWUP 2 - Whatsapp TEXT</b><br>
                <div>
                    <ul id="toolbar3" style="margin-bottom: -7px;margin-top: 12px;">
                        <li><a href="" data-action='["bold",false,null]' title="Bold" style="font-weight: bold;">B</a></li>
                        <li><a href="" data-action='["italic",false,null]' title="Italic" style="font-style: italic;">I</a></li>
                        <li><a href="" data-action='["strikeThrough",false,null]' title="Heading"><s>S</s></a></li>
                        <li><a href="" data-action='["removeFormat",false,null]' title="Remove formatting" style="width:64px;">&times; Reset</a></li>
                    </ul>
                    <div style="width: 100%;">
                        <div id="divcontainer3" class="lead emoji-picker-container">
                            <div id="mytext3" contenteditable="true" data-emojiable="true" data-emoji-input="unicode"><?php echo $wa_followup_dua; ?></div>
                        </div>
                    </div>
                </div>
                <br>
                <p  style="color:#464646;margin-bottom: 20px;"><b>FOLLOWUP 3 - Whatsapp TEXT</b><br>
                <div>
                    <ul id="toolbar4" style="margin-bottom: -7px;margin-top: 12px;">
                        <li><a href="" data-action='["bold",false,null]' title="Bold" style="font-weight: bold;">B</a></li>
                        <li><a href="" data-action='["italic",false,null]' title="Italic" style="font-style: italic;">I</a></li>
                        <li><a href="" data-action='["strikeThrough",false,null]' title="Heading"><s>S</s></a></li>
                        <li><a href="" data-action='["removeFormat",false,null]' title="Remove formatting" style="width:64px;">&times; Reset</a></li>
                    </ul>
                    <div style="width: 100%;">
                        <div id="divcontainer4" class="lead emoji-picker-container">
                            <div id="mytext4" contenteditable="true" data-emojiable="true" data-emoji-input="unicode"><?php echo $wa_followup_tiga; ?></div>
                        </div>
                    </div>
                </div>
                <br>
                <input type='button' id="save_wa_settings" name="insert" value='Save Whatsapp' class='button btn_mgo' style="margin-top: 10px;"><span id="success_response"></span>
                <br><br>
                </p>
                <p>
                <b>Note:</b>
                <ul style="list-style-type: circle;margin-left: 12px;width: 100%">
                    <li>Tambahkan Magic Tag berikut:
                        <br><b>[mgo_orderid]</b> : untuk menampilkan Order ID customer.
                        <br><b>[mgo_nama]</b> : untuk menampilkan nama customer.
                        <br><b>[mgo_email]</b> : untuk menampilkan email.
                        <br><b>[mgo_alamat]</b> : untuk menampilkan alamat.
                        <br><b>[mgo_alamat_lengkap]</b> : untuk menampilkan alamat lengkap.
                        <br><b>[mgo_nama_produk]</b> : untuk menampilkan nama produk. 
                        <br><b>[mgo_wa]</b> : untuk menampilkan nomor WA customer.
                        <br><b>[mgo_csid]</b> : untuk menampilkan nama CS kita.
                        <br><b>[mgo_cswa]</b> : untuk menampilkan Whatsapp CS kita.
                        <br><b>[mgo_pembayaran]</b> : untuk menambahkan rekening anda yang dipilih user dari form.
                        <br><b>[mgo_total]</b> : untuk menampilkan total pembelian anda pada Teks WA.
                        <br><b>[mgo_dp]</b> : untuk menambahkan nilai DP dari Total.
                        <br><b>[mgo_sisa]</b> : untuk menambahkan nilai sisa pembayaran dari Total - DP.
                        <br><span style="color: #5C51E3;"><b>[mgo_detail_order]</b></span> : untuk menambahkan detail order secara keseluruhan.
                        <br><br>
                                <i><B>Contoh :</B></i></b><br>
                                <div style="background: #F0F6F8;padding: 12px 12px;border-radius: 4px;border: 1px solid #eaeaea;">Hai kakak [mgo_nama], berikut detail Order Anda<br>[mgo_detail_order]<br>Segera transfer ke [mgo_pembayaran]. Terimakasih
                                <br></div><br>
                    </li>
                    <li>Selain Magic Tags diatas, anda tidak akan bisa memanggilnya.</li>
                    <li>Anda juga bisa menggunakan Font styling (Bold, Italic, Coret) pada menu di textarea.</li>
                    <li>Jika menemukan kendala dengan Font styling pada textarea, Anda bisa menggunakan Format asli dari Whatsapp dibawah.</li>
                        <ul style="list-style-type: disc;margin-left: 12px;">
                            <li>( * ) tebal</li>
                            <li>( _ ) miring</li>
                            <li>( ~ ) coret</li>
                            <li>( %0A ) enter</li>
                        </ul>
                </ul>
                </p>
                <br>
                <br>
                <hr>
                <br>
                <p style="color:#464646;"><b>MULTIPLE FOLLOWUP BUTTON - FREE CLICK</b><br>
                <br>
                <div style=" padding-bottom: 10px;margin-top: -10px;">
                    
                    <img style="width: 180px;margin-left: -15px;" class="icon-title2" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/multiple-button.png"><br><br><br>
                    Settingan ini digunakan untuk men-Set Button menjadi bebas di klik. Karena ada beberapa kasus button ini digunakan tidak berurut. Dengan setttingan ini maka anda bisa bebas mengklik button followup sesuai keinginan anda.
                </div>
                <br>
                <div style=" padding-bottom: 20px;margin-top: -10px;">
                    <div class="radio">
                      <label>
                        <input class="" name="followup_button_status" value="0" type="radio" <?php if($followup_button_status==0){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Deactive</div>
                      </label>
                    </div>
                    <div class="radio" style="margin-left: -10px;">
                      <label>
                        <input class="" name="followup_button_status" value="1" type="radio" <?php if($followup_button_status==1){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Active</div>
                      </label>
                    </div>
                </div>
                <br>
                <br>
                <input type='button' id="save_followup_button_status" name="insert" value='Save' class='button btn_mgo' style="margin-left:0px;"><span id="success_response13"></span>
                <br>
                <br><br>
                <hr>
                <br>
                <p style="color:#464646;"><b>TIMEZONE - Date Data Order</b><br>
                <br>
                <div style=" padding-bottom: 10px;margin-top: -10px;">
                    Settingan ini digunakan untuk mengupdate waktu Data Order agar sesuai dengan waktu wilayah kita. Jika anda merasa waktunya kelebihan 7 Jam. Maka anda cukup mengaktifkan settingan ini dan mensetting -7. Begitu juga sebaliknya, tinggal di sesuaikan. Jika Normal atau tidak ada masalah, silahkan Deactive settingan ini.
                </div>
                <br>
                <div style=" padding-bottom: 50px;margin-top: -10px;">
                    <div class="radio">
                      <label>
                        <input class="" name="utc_status_dataorder" value="0" type="radio" <?php if($utc_status_dataorder==0){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Deactive</div>
                      </label>
                    </div>
                    <div class="radio" style="margin-left: -10px;">
                      <label>
                        <input class="" name="utc_status_dataorder" value="1" type="radio" <?php if($utc_status_dataorder==1){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Active</div>
                      </label>
                    </div>
                </div>
                <select name="" id="utc_value_dataorder" style="height: 35px;margin-top: -2px;width: 90px;">
                    <option value="-1" <?php if($utc_value_dataorder==-1){ echo'selected';} ?>>-1</option>
                    <option value="-2" <?php if($utc_value_dataorder==-2){ echo'selected';} ?>>-2</option>
                    <option value="-3" <?php if($utc_value_dataorder==-3){ echo'selected';} ?>>-3</option>
                    <option value="-4" <?php if($utc_value_dataorder==-4){ echo'selected';} ?>>-4</option>
                    <option value="-5" <?php if($utc_value_dataorder==-5){ echo'selected';} ?>>-5</option>
                    <option value="-6" <?php if($utc_value_dataorder==-6){ echo'selected';} ?>>-6</option>
                    <option value="-7" <?php if($utc_value_dataorder==-7){ echo'selected';} ?>>-7</option>
                    <option value="-8" <?php if($utc_value_dataorder==-8){ echo'selected';} ?>>-8</option>
                    <option value="-9" <?php if($utc_value_dataorder==-9){ echo'selected';} ?>>-9</option>
                    <option value="-10" <?php if($utc_value_dataorder==-10){ echo'selected';} ?>>-10</option>
                    <option value="-11" <?php if($utc_value_dataorder==-11){ echo'selected';} ?>>-11</option>
                    <option value="-12" <?php if($utc_value_dataorder==-12){ echo'selected';} ?>>-12</option>
                    <option value="-13" <?php if($utc_value_dataorder==-13){ echo'selected';} ?>>-13</option>
                    <option value="-14" <?php if($utc_value_dataorder==-14){ echo'selected';} ?>>-14</option>
                    <option value="0" <?php if($utc_value_dataorder==0){ echo'selected';} ?>>0</option>
                    <option value="1" <?php if($utc_value_dataorder==1){ echo'selected';} ?>>+1</option>
                    <option value="2" <?php if($utc_value_dataorder==2){ echo'selected';} ?>>+2</option>
                    <option value="3" <?php if($utc_value_dataorder==3){ echo'selected';} ?>>+3</option>
                    <option value="4" <?php if($utc_value_dataorder==4){ echo'selected';} ?>>+4</option>
                    <option value="5" <?php if($utc_value_dataorder==5){ echo'selected';} ?>>+5</option>
                    <option value="6" <?php if($utc_value_dataorder==6){ echo'selected';} ?>>+6</option>
                    <option value="7" <?php if($utc_value_dataorder==7){ echo'selected';} ?>>+7</option>
                    <option value="8" <?php if($utc_value_dataorder==8){ echo'selected';} ?>>+8</option>
                    <option value="9" <?php if($utc_value_dataorder==9){ echo'selected';} ?>>+9</option>
                    <option value="10" <?php if($utc_value_dataorder==10){ echo'selected';} ?>>+10</option>
                    <option value="11" <?php if($utc_value_dataorder==11){ echo'selected';} ?>>+11</option>
                    <option value="12" <?php if($utc_value_dataorder==12){ echo'selected';} ?>>+12</option>
                    <option value="13" <?php if($utc_value_dataorder==13){ echo'selected';} ?>>+13</option>
                    <option value="14" <?php if($utc_value_dataorder==14){ echo'selected';} ?>>+14</option>
                </select>
                <br>
                <br>
                <br>
                <input type='button' id="save_utc_dataorder" name="insert" value='Save' class='button btn_mgo' style="margin-left:0px;"><span id="success_response12"></span>
                <br>
                <br>
                <br>
                <hr>
                <br>
                <p style="color:#464646;"><b>TIMEZONE - Time Followup</b><br>
                <br>
                <div style=" padding-bottom: 10px;margin-top: -10px;">
                    Settingan ini digunakan untuk mengupdate waktu Time Followup agar sesuai dengan waktu wilayah kita. Jika time followup kosong atau hilang, silahkan aktifkan dan set +7. Jika jam kelebihan 7 jam, set -7. Selebihnya sesuaikan dengan kebutuhan. Jika Normal atau tidak ada masalah, silahkan Deactive settingan ini.
                </div>
                <br>
                <div style=" padding-bottom: 50px;margin-top: -10px;">
                    <div class="radio">
                      <label>
                        <input class="" name="utc_status" value="0" type="radio" <?php if($utc_status==0){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Deactive</div>
                      </label>
                    </div>
                    <div class="radio" style="margin-left: -10px;">
                      <label>
                        <input class="" name="utc_status" value="1" type="radio" <?php if($utc_status==1){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Active</div>
                      </label>
                    </div>
                </div>
                <select name="" id="utc_value" style="height: 35px;margin-top: -2px;width: 90px;">
                    <option value="-1" <?php if($utc_value==-1){ echo'selected';} ?>>-1</option>
                    <option value="-2" <?php if($utc_value==-2){ echo'selected';} ?>>-2</option>
                    <option value="-3" <?php if($utc_value==-3){ echo'selected';} ?>>-3</option>
                    <option value="-4" <?php if($utc_value==-4){ echo'selected';} ?>>-4</option>
                    <option value="-5" <?php if($utc_value==-5){ echo'selected';} ?>>-5</option>
                    <option value="-6" <?php if($utc_value==-6){ echo'selected';} ?>>-6</option>
                    <option value="-7" <?php if($utc_value==-7){ echo'selected';} ?>>-7</option>
                    <option value="-8" <?php if($utc_value==-8){ echo'selected';} ?>>-8</option>
                    <option value="-9" <?php if($utc_value==-9){ echo'selected';} ?>>-9</option>
                    <option value="-10" <?php if($utc_value==-10){ echo'selected';} ?>>-10</option>
                    <option value="-11" <?php if($utc_value==-11){ echo'selected';} ?>>-11</option>
                    <option value="-12" <?php if($utc_value==-12){ echo'selected';} ?>>-12</option>
                    <option value="-13" <?php if($utc_value==-13){ echo'selected';} ?>>-13</option>
                    <option value="-14" <?php if($utc_value==-14){ echo'selected';} ?>>-14</option>
                    <option value="0" <?php if($utc_value==0){ echo'selected';} ?>>0</option>
                    <option value="1" <?php if($utc_value==1){ echo'selected';} ?>>+1</option>
                    <option value="2" <?php if($utc_value==2){ echo'selected';} ?>>+2</option>
                    <option value="3" <?php if($utc_value==3){ echo'selected';} ?>>+3</option>
                    <option value="4" <?php if($utc_value==4){ echo'selected';} ?>>+4</option>
                    <option value="5" <?php if($utc_value==5){ echo'selected';} ?>>+5</option>
                    <option value="6" <?php if($utc_value==6){ echo'selected';} ?>>+6</option>
                    <option value="7" <?php if($utc_value==7){ echo'selected';} ?>>+7</option>
                    <option value="8" <?php if($utc_value==8){ echo'selected';} ?>>+8</option>
                    <option value="9" <?php if($utc_value==9){ echo'selected';} ?>>+9</option>
                    <option value="10" <?php if($utc_value==10){ echo'selected';} ?>>+10</option>
                    <option value="11" <?php if($utc_value==11){ echo'selected';} ?>>+11</option>
                    <option value="12" <?php if($utc_value==12){ echo'selected';} ?>>+12</option>
                    <option value="13" <?php if($utc_value==13){ echo'selected';} ?>>+13</option>
                    <option value="14" <?php if($utc_value==14){ echo'selected';} ?>>+14</option>
                </select>
                <br>
                <br>
                <br>
                <input type='button' id="save_utc" name="insert" value='Save' class='button btn_mgo' style="margin-left:0px;"><span id="success_response11"></span>
                <br>
                <br>
                <br><hr>
                <br>
                <p style="color:#464646;"><b>PAGE REFRESH</b><br>
                <br>
                <div style=" padding-bottom: 10px;margin-top: -10px;">
                    Settingan ini digunakan untuk mereload halaman Data Order setiap berapa detik/menit sesuai kebutuhan anda. Disarankan untuk menggunakan 5 menit sekali jika anda harus stand-by di Data Order. Jika tidak, cukup 15 menit sekali saja.
                </div>
                <br>
                <div style=" padding-bottom: 50px;margin-top: -10px;">
                    <div class="radio">
                      <label>
                        <input class="" name="refresh_page" value="0" type="radio" <?php if($order_refresh_page==0){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Deactive</div>
                      </label>
                    </div>
                    <div class="radio" style="margin-left: -10px;">
                      <label>
                        <input class="" name="refresh_page" value="1" type="radio" <?php if($order_refresh_page==1){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Active</div>
                      </label>
                    </div>
                </div>
                <select name="" id="refresh_second" style="height: 35px;margin-top: -2px;width: 180px;">
                    <option value="10" <?php if($order_refresh_second==10){ echo'selected';} ?>>10 Seconds</option>
                    <option value="30" <?php if($order_refresh_second==30){ echo'selected';} ?>>30 Seconds</option>
                    <option value="60" <?php if($order_refresh_second==60){ echo'selected';} ?>>1 Minute</option>
                    <option value="300" <?php if($order_refresh_second==300){ echo'selected';} ?>>5 Minutes</option>
                    <option value="900" <?php if($order_refresh_second==900){ echo'selected';} ?>>15 Minutes</option>
                </select>
                <br>
                <br>
                <br>
                <input type='button' id="save_refresh" name="insert" value='Save' class='button btn_mgo' style="margin-left:0px;"><span id="success_response4"></span>
                <br>
                <br>
                <br>
                <hr>
                <br>
                <p style="color:#464646;"><b>FOLLOWUP SENDER WITH WANOTIF</b><br>
                <br>
                <div style=" padding-bottom: 10px;margin-top: -10px;">
                    Settingan ini digunakan untuk mengaktifkan Wanotif sebagai Sender dari Followup di Data Order. Pastikan settingan Wanotif anda di <b>Magic Order > API Settings > General Settings</b> dalam keadaan Aktif.
                </div>
                <br>
                <div style=" padding-bottom: 30px;margin-top: -10px;">
                    <div class="radio">
                      <label>
                        <input class="" name="followup_wanotif_status" value="0" type="radio" <?php if($followup_wanotif_status==0){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Deactive</div>
                      </label>
                    </div>
                    <div class="radio" style="margin-left: -10px;">
                      <label>
                        <input class="" name="followup_wanotif_status" value="1" type="radio" <?php if($followup_wanotif_status==1){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Active</div>
                      </label>
                    </div>
                </div>
                <br>
                <input type='button' id="save_followup_wanotif_status" name="insert" value='Save' class='button btn_mgo' style="margin-left:0px;"><span id="success_response7"></span>
                <br>
                <br>
                <br>
                <hr>
                <br>
                <p style="color:#464646;"><b>SHOW DELETE BUTTON (DATA ORDER) FOR CS</b><br>
                <br>
                <div style=" padding-bottom: 10px;margin-top: -10px;">
                    Settingan ini digunakan untuk mengaktifkan atau me-Nonaktifkan Button Delete di Data Order untuk CS anda.
                </div>
                <br>
                <div style=" padding-bottom: 30px;margin-top: -10px;">
                    <div class="radio">
                      <label>
                        <input class="" name="btn_del_status" value="0" type="radio" <?php if($btn_del_status==0){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Deactive</div>
                      </label>
                    </div>
                    <div class="radio" style="margin-left: -10px;">
                      <label>
                        <input class="" name="btn_del_status" value="1" type="radio" <?php if($btn_del_status==1){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Active</div>
                      </label>
                    </div>
                </div>
                <br>
                <input type='button' id="save_btn_del_status" name="insert" value='Save' class='button btn_mgo' style="margin-left:0px;"><span id="success_response6"></span>
                <br>
                <br>
                <br>
                <hr>
                
                <br>
                <p  style="color:#464646;margin-bottom: 20px;"><b>LABEL PENGIRIM (Untuk Print Label)</b><br>
                <div>
                    <ul id="toolbar5" style="margin-bottom: -7px;margin-top: 12px;">
                        <li><a href="" data-action='["bold",false,null]' title="Bold" style="font-weight: bold;">B</a></li>
                        <li><a href="" data-action='["italic",false,null]' title="Italic" style="font-style: italic;">I</a></li>
                        <li><a href="" data-action='["strikeThrough",false,null]' title="Heading"><s>S</s></a></li>
                        <li><a href="" data-action='["removeFormat",false,null]' title="Remove formatting" style="width:64px;">&times; Reset</a></li>
                    </ul>
                    <div style="width: 100%;">
                        <div id="divcontainer5" class="lead emoji-picker-container">
                            <div id="mytext5" contenteditable="true" data-emojiable="true" data-emoji-input="unicode"><?php echo $label_pengirim; ?></div>
                        </div>
                    </div>
                </div>
                <br>
                <input type='button' id="save_label_pengirim" name="insert" value='Save Label' class='button btn_mgo' style="margin-left:0px;" ><span id="success_response_label"></span>
                <br>
                <br>
                <br>
                <hr>
                <br>
                <p style="color:#464646;"><b>UPDATE TABLE COLLATION</b><br>
                <br>
                <div style=" padding-bottom: 10px;margin-top: -10px;">
                    <b>Note:</b> Option ini hanya boleh digunakan jika kamu mengalami Closing Ratio pada Data Order menampilkan 0%, padahal Status di Data Order sudah ada yang Confirmed.
                </div>
                <br>
                <input type='button' id="update_table_collation" name="insert" value='Update Table Collation' class='button btn_mgo' style="margin-left:0px;"><span id="success_response5"></span>
                <br>
                <br>
                <br>
                <hr>
                <br>
                <p style="color:#464646;"><b>NORMALIZE DATA ORDER</b><br>
                <br>
                <div style=" padding-bottom: 10px;margin-top: -10px;">
                    <b>Note:</b> Fungsi ini digunakan untuk menyesuaikan Status Data Order dari Versi 2.X ke Versi 3.X agar statusnya bisa dibaca dan ditampilkan secara tepat di Statistik Data Order.
                </div>
                <br>
                <input type='button' id="normalize_data_order" name="insert" value='Normalize Data Order' class='button btn_mgo' style="margin-left:0px;"><span id="success_response10"></span>
                <br>
                <br>
                <br>
                <hr>
                <br>
                <p style="color:#464646;"><b>DELETE ALL STATUS DATA ORDERS</b><br>
                <br>
                <div style=" padding-bottom: 10px;margin-top: -10px;">
                    <b>Note:</b> Fungsi ini hanya menghapus <b>Status</b> dari Data Order (Confirmed, Packaged, Shipped, Delivered, dan RTS/Cancel termasuk status followup WA). Pastikan anda sudah yakin ingin menghapus semua data, karena data tidak dapat dikembalikan jika sudah dihapus. Pastikan anda sudah mem-Backup datanya terlebih dahulu.  Terimakasih sudah membaca note ini.
                </div>
                <br>
                <input type='button' id="btn_del_mgo2" name="delete_data_orders" value='Delete All Status' class='button btn_mgo' style="margin-left:0px;width: 140px !important;"><span id="success_response9"></span>
                <br>
                <br>

                <br>
                <hr>
                <br>
                <p style="color:#464646;"><b>DELETE ALL DATA ORDERS</b><br>
                <br>
                <div style=" padding-bottom: 10px;margin-top: -10px;">
                    <b>Note:</b> Pastikan anda sudah yakin ingin menghapus semua data, karena data tidak dapat dikembalikan jika sudah dihapus, termasuk Status dari Data Order (Confirmed, Packaged, Shipped, Delivered, RTS/Cancel dan juga status followup WA). Pastikan anda sudah mem-Backup datanya terlebih dahulu. Terimakasih sudah membaca note ini.
                </div>
                <br>
                <input type='button' id="btn_del_mgo" name="delete_data_orders" value='Delete All Data Orders' class='button btn_mgo' style="margin-left:0px;width: 170px !important;"><span id="success_response8"></span>
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
    <!-- Begin emoji-picker JavaScript -->
    <script src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/emoji/lib/js/config.js"></script>
    <script src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/emoji/lib/js/util.js"></script>
    <script src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/emoji/lib/js/jquery.emojiarea.js"></script>
    <script src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/emoji/lib/js/emoji-picker.js"></script>
    <!-- End emoji-picker JavaScript -->
    <script>
    $(document).ready(function(){

        $( ".order_id_status" ).bind("change", function(e){
            var order_id_status = $(this).val();
            if(order_id_status=='3'){
                $('.order_id_other_name').show();
            }else{
                $('.order_id_other_name').hide();
            }
        });

        $( ".nama_produk_status" ).bind("change", function(e){
            var nama_produk_status = $(this).val();
            if(nama_produk_status=='3'){
                $('.nama_produk_other_name').show();
            }else{
                $('.nama_produk_other_name').hide();
            }
        });

         $('#save_nama_produk').bind('click', function() {
            $("#success_response_nama_produk").html('<span class="button" style="margin-top: 15px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Saving...</span>');

            var nama_produk_status = $('input[type=radio][name=nama_produk_status]:checked').val();
            var nama_produk_other_name = $('input.nama_produk_other_name').val();

            var order_id_status = $('input[type=radio][name=order_id_status]:checked').val();
            var order_id_other_name = $('input.order_id_other_name').val();

            var datanya = [
                    nama_produk_status,
                    nama_produk_other_name,
                    order_id_status,
                    order_id_other_name
                ];
                
            var data = {
                'action': 'myaction_save_nama_produk',
                'datanya': datanya
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response_nama_produk").html(response);
                window.location.reload();
            });
        });

        $('#save_dash_style').bind('click', function() {
            $("#success_response_dash").html('<span class="button" style="margin-top: 5px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Saving...</span>');

            var dash_style = $('input[type=radio][name=dash_style]:checked').val();

            var datanya = [
                    dash_style
                ];
                
            var data = {
                'action': 'myaction_save_dash_style',
                'datanya': datanya
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response_dash").html(response);
                window.location.reload();
            });
        });

        $('#save_pagination_table').bind('click', function() {
            $("#success_response_pagination_table").html('<span class="button" style="margin-top: 5px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Saving...</span>');

            var pagination_table = $('input[type=radio][name=pagination_table]:checked').val();

            var datanya = [
                    pagination_table
                ];
                
            var data = {
                'action': 'myaction_save_pagination_table',
                'datanya': datanya
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response_pagination_table").html(response);
                window.location.reload();
            });
        });

         

        $('#check').on('click', function(){
            
            $('#editable2 img').removeAttr('src').removeAttr('draggable').removeAttr('class');
            var content = $('#editable2').html();
            var newcontent1 = content.replace(/<img alt="/g , "");
            var newcontent2 = newcontent1.replace(/">/g , "");
            // alert(newcontent2);

        })

        $('#save_table_settings').bind('click', function() {
            $("#success_response3").html('<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Saving...</span>');
            var new_selected = [];
            $("input.table_field:checked").each(function(){
                new_selected.push($(this).val());
            });
            new_selected = new_selected.toString();
            
            var data_nya = [
                new_selected
            ];

            var data = {
                'action': 'myaction_table_settings',
                'datanya': data_nya
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response3").html(response);
                window.location.reload();
            });
        });

        $('#save_wa_settings').bind('click', function() {
            $("#success_response").html('<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Saving...</span>');
            
            $('#editable img').removeAttr('src').removeAttr('draggable').removeAttr('class');
            var content = $('#editable').html();
            var newcontent1 = content.replace(/<img alt="/g , "");
            var newcontent2 = newcontent1.replace(/">/g , "");
            var newcontent3 = newcontent2.replace(/&amp;/g , "dan");

            $('#editable2 img').removeAttr('src').removeAttr('draggable').removeAttr('class');
            var content2 = $('#editable2').html();
            var newcontent7 = content2.replace(/<img alt="/g , "");
            var newcontent8 = newcontent7.replace(/">/g , "");
            var newcontent9 = newcontent8.replace(/&amp;/g , "dan");

            $('#editable3 img').removeAttr('src').removeAttr('draggable').removeAttr('class');
            var content3 = $('#editable3').html();
            var newcontent11 = content3.replace(/<img alt="/g , "");
            var newcontent12 = newcontent11.replace(/">/g , "");
            var newcontent13 = newcontent12.replace(/&amp;/g , "dan");

            $('#editable4 img').removeAttr('src').removeAttr('draggable').removeAttr('class');
            var content4 = $('#editable4').html();
            var newcontent16 = content4.replace(/<img alt="/g , "");
            var newcontent17 = newcontent16.replace(/">/g , "");
            var newcontent18 = newcontent17.replace(/&amp;/g , "dan");

            // return false;
            var data_nya = [
                newcontent3,
                newcontent9,
                newcontent13,
                newcontent18
            ];

            var data = {
                'action': 'myaction_wa_settings',
                'datanya': data_nya
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response").html(response);
                window.location.reload();
            });

        });

        $('#save_label_pengirim').bind('click', function() {
            $("#success_response_label").html('<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Saving...</span>');
            
            var label = $('#editable5').html();
            
            // return false;
            var data_nya = [
                label
            ];

            var data = {
                'action': 'myaction_save_label_pengirim',
                'datanya': data_nya
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response_label").html(response);
                window.location.reload();
            });
            

        });

        $(document).on('keydown', '#orderid_text', function(e) {
            if (e.keyCode == 32){
                alert('Tidak boleh menggunakan Spasi.');
                return false;
            }
        });

        

        $('#save_orderid_settings').bind('click', function() {
            $("#success_response2").html('<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Saving...</span>');

            var orderid_text = $("#orderid_text").val();
            var orderid_max = $("#orderid_max option:selected").val();
        
            var data_nya = [
                orderid_text,
                orderid_max
            ];

            var data = {
                'action': 'myaction_orderid_settings',
                'datanya': data_nya
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response2").html(response);
                window.location.reload();
            });

        });

        $('#save_refresh').bind('click', function() {
            $("#success_response4").html('<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Saving...</span>');

            var refresh_page = $("input[type=radio][name=refresh_page]:checked").val();
            var refresh_second = $("#refresh_second option:selected").val();

            var data_nya = [
                refresh_page,
                refresh_second
            ];

            var data = {
                'action': 'myaction_page_refresh',
                'datanya': data_nya
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response4").html(response);
                window.location.reload();
            });

        });

        $('#save_utc').bind('click', function() {
            $("#success_response11").html('<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Saving...</span>');

            var utc_status = $("input[type=radio][name=utc_status]:checked").val();
            var utc_value = $("#utc_value option:selected").val();

            var data_nya = [
                utc_status,
                utc_value
            ];

            var data = {
                'action': 'myaction_save_utc',
                'datanya': data_nya
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response11").html(response);
                window.location.reload();
            });

        });

        $('#save_utc_dataorder').bind('click', function() {
            $("#success_response12").html('<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Saving...</span>');

            var utc_status_dataorder = $("input[type=radio][name=utc_status_dataorder]:checked").val();
            var utc_value_dataorder = $("#utc_value_dataorder option:selected").val();

            var data_nya = [
                utc_status_dataorder,
                utc_value_dataorder
            ];

            var data = {
                'action': 'myaction_save_utc_dataorder',
                'datanya': data_nya
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response12").html(response);
                window.location.reload();
            });

        });

        $('#save_followup_button_status').bind('click', function() {
            $("#success_response13").html('<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Saving...</span>');

            var followup_button_status = $("input[type=radio][name=followup_button_status]:checked").val();

            var data_nya = [
                followup_button_status
            ];

            var data = {
                'action': 'myaction_save_followup_button_status',
                'datanya': data_nya
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response13").html(response);
                window.location.reload();
            });

        });

        

        

        $('#save_btn_del_status').bind('click', function() {
            $("#success_response6").html('<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Saving...</span>');

            var btn_delete_data_order = $("input[type=radio][name=btn_del_status]:checked").val();

            var data_nya = [
                btn_delete_data_order
            ];

            var data = {
                'action': 'myaction_save_btn_del_status',
                'datanya': data_nya
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response6").html(response);
                window.location.reload();
            });

        });

        $('#save_followup_wanotif_status').bind('click', function() {
            $("#success_response7").html('<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Saving...</span>');

            var followup_wanotif_status = $("input[type=radio][name=followup_wanotif_status]:checked").val();

            var data_nya = [
                followup_wanotif_status
            ];

            var data = {
                'action': 'myaction_save_followup_wanotif_status',
                'datanya': data_nya
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response7").html(response);
                window.location.reload();
            });

        });


        $('#update_table_collation').bind('click', function() {
            $.confirm({
                title: 'Hello',
                content: 'Apakah anda yakin ingin meng-Update Table Collation?',
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
                        text: "Yes, Update",
                        btnClass: 'btn-danger',
                        keys: ['enter'],
                        action: function(e){
                            
                            $("#success_response5").html('<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Processing...</span>');

                            var data = {
                                'action': 'myaction_update_collation_table'
                            };

                            jQuery.post(ajaxurl, data, function(response) {
                                $("#success_response5").html(response);
                                window.location.reload();
                            });

                        }
                    },
                }
            });    
        });


        $('#normalize_data_order').bind('click', function() {
            $.confirm({
                title: 'Hello',
                content: 'Apakah anda ingin Menormalisasi Data Order?',
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
                        text: "Yes, Normalize Now",
                        btnClass: 'btn-danger',
                        keys: ['enter'],
                        action: function(e){
                            
                            $("#success_response10").html('<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Processing...</span>');

                            var data = {
                                'action': 'myaction_normalize_data_order'
                            };

                            jQuery.post(ajaxurl, data, function(response) {
                                $("#success_response10").html(response);
                                window.location.reload();
                            });

                        }
                    },
                }
            });    
        });
        


        $("#toolbar li a").click(function(evt){
            evt.preventDefault();
            document.execCommand.apply(document, $(this).data("action"));
            $("#editable").keyup();
        });

        $("#toolbar2 li a").click(function(evt){
            evt.preventDefault();
            document.execCommand.apply(document, $(this).data("action"));
            $("#editable2").keyup();
        });

        $("#toolbar3 li a").click(function(evt){
            evt.preventDefault();
            document.execCommand.apply(document, $(this).data("action"));
            $("#editable3").keyup();
        });

        $("#toolbar4 li a").click(function(evt){
            evt.preventDefault();
            document.execCommand.apply(document, $(this).data("action"));
            $("#editable4").keyup();
        });

        $("#toolbar5 li a").click(function(evt){
            evt.preventDefault();
            document.execCommand.apply(document, $(this).data("action"));
            $("#editable5").keyup();
        });

        document.querySelector("div[contenteditable]").addEventListener("paste", function(e) {
            e.preventDefault();
            var text = e.clipboardData.getData("text/plain");
            document.execCommand("insertHTML", false, text);
        });

        $('#btn_del_mgo').click(function (e) {
            
            $.confirm({
                title: 'Hello',
                content: 'Apakah anda Yakin ingin Menghapus Semua Data Order?',
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
                            
                            $("#success_response8").html('<span class="button" style="margin-top: 5px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #0071a1;">Deleting...</span>').show();
            
                            var data_nya = [
                                'delete_all'
                            ];

                            var data = {
                                "action": "myaction_del_all_data_orders",
                                "datanya": data_nya
                            };
                            jQuery.post(ajaxurl, data, function(response) {
                                
                                $("#success_response8").html(response);
                                window.location.reload();

                            });

                        }
                    },
                }
            });        
        });


      $('#btn_del_mgo2').click(function (e) {
            
            $.confirm({
                title: 'Hello',
                content: 'Apakah anda Yakin ingin Menghapus Status Data Order?',
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
                            
                            $("#success_response9").html('<span class="button" style="margin-top: 5px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #0071a1;">Deleting...</span>').show();
            
                            var data_nya = [
                                'delete_all_status'
                            ];

                            var data = {
                                "action": "myaction_del_allstatus_data_orders",
                                "datanya": data_nya
                            };
                            jQuery.post(ajaxurl, data, function(response) {
                                
                                $("#success_response9").html(response);
                                window.location.reload();

                            });

                        }
                    },
                }
            });        
        });

    });
    </script>

    <script>
      $(function() {
        // Initializes and creates emoji set from sprite sheet
        window.emojiPicker = new EmojiPicker({
          emojiable_selector: '[data-emojiable=true]',
          assetsPath: '<?php echo plugin_dir_url( __FILE__ ); ?>../assets/emoji/lib/img/',
          popupButtonClasses: 'fa fa-smile-o'
        });
        // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
        // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
        // It can be called as many times as necessary; previously converted input fields will not be converted again
        window.emojiPicker.discover();

        var idnya = "editable";
        var textnya = $('#mytext').html();
        $('#divcontainer .emoji-wysiwyg-editor').attr("id", idnya);
        $('#'+idnya).html(textnya).addClass("box");

        var idnya2 = "editable2";
        var textnya2 = $('#mytext2').html();
        $('#divcontainer2 .emoji-wysiwyg-editor').attr("id", idnya2);
        $('#'+idnya2).html(textnya2).addClass("box");

        var idnya3 = "editable3";
        var textnya3 = $('#mytext3').html();
        $('#divcontainer3 .emoji-wysiwyg-editor').attr("id", idnya3);
        $('#'+idnya3).html(textnya3).addClass("box");

        var idnya4 = "editable4";
        var textnya4 = $('#mytext4').html();
        $('#divcontainer4 .emoji-wysiwyg-editor').attr("id", idnya4);
        $('#'+idnya4).html(textnya4).addClass("box");

        var idnya5 = "editable5";
        var textnya5 = $('#mytext5').html();
        $('#divcontainer5 .emoji-wysiwyg-editor').attr("id", idnya5);
        $('#'+idnya5).html(textnya5).addClass("box");


      });
    </script>
    <script>
        
    </script>

    <?php
}