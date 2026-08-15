<?php


function magic_order_update_followup() {
    global $wpdb;

    mgo_global_vars();
    $expired = $GLOBALS['mgovars']['expired'];
    $date_expired = $GLOBALS['mgovars']['date_expired'];
    $plugin_name = $GLOBALS['mgovars']['plugin_name'];
    $plugin_version = $GLOBALS['mgovars']['plugin_version'];
    $plugin_license = $GLOBALS['mgovars']['plugin_license'];
    $plugin_license_info = $GLOBALS['mgovars']['plugin_license_info'];
    $apikey = $GLOBALS['mgovars']['apikey'];
    $apikey_status = $GLOBALS['mgovars']['apikey_status'];
    
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

      $query = $wpdb->get_results('SELECT * from '.$table_name2.' where id_form="'.$id.'"');
      if(isset($query[0]->f_wa_status)){
        $f_wa_status      = $query[0]->f_wa_status;
        $f_transfer_satu  = $query[0]->f_transfer_satu;
        $f_transfer_dua   = $query[0]->f_transfer_dua;
        $f_transfer_tiga  = $query[0]->f_transfer_tiga;
        $f_cod_satu       = $query[0]->f_cod_satu;
        $f_cod_dua        = $query[0]->f_cod_dua;
        $f_cod_tiga       = $query[0]->f_cod_tiga;
      }else{
        $f_wa_status      = '0';
        $f_transfer_satu  = '';
        $f_transfer_dua   = '';
        $f_transfer_tiga  = '';
        $f_cod_satu       = '';
        $f_cod_dua        = '';
        $f_cod_tiga       = '';
      }
      

    }else{
      echo '<h2>Maaf Form ID anda tidak terdaftar!</h2>';
      return false;
    }


    // print_r($query);

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

        #toolbar, #toolbar2, #toolbar3, #toolbar4, #toolbar5, #toolbar6 {
          margin: 0 0 1em;
          border: 0 none;
          padding: 0;
          list-style: none;
        }
        #toolbar li, #toolbar2 li, #toolbar3 li, #toolbar4 li, #toolbar5 li, #toolbar6 li {
          display: inline-block;
        }
        #toolbar li a, #toolbar2 li a, #toolbar3 li a, #toolbar4 li a, #toolbar5 li a, #toolbar6 li a {
          color: #999;
          text-decoration: none;
          background-color: #eee;
          border: 1px solid #ccc;
          display: inline-block;
          width: 2em;
          line-height: 2em;
          text-align: center;
        }
        #toolbar li a:hover, #toolbar2 li a:hover, #toolbar3 li a:hover, #toolbar4 li a:hover, #toolbar5 li a:hover, #toolbar6 li a:hover {
          box-shadow: 0 1px 3px #ccc;
        }

        #editable, #editable2, #editable3, #editable4, #editable5, #editable6 {
          min-height: 5em;
          outline: 0 none;
        }
        #editable:empty::before, 
        #editable2:empty::before,
        #editable3:empty::before, 
        #editable4:empty::before, 
        #editable5:empty::before, 
        #editable6:empty::before {
          content: "Whatsapp Custom Text";
          color: #ccc;
        }

        #result, #result2, #result3, #result4, #result5, #result6 {
          background-color: #eee;
          padding: .5em .75em;
        }
        #result::before, #result2::before, #result3::before, #result4::before, #result5::before, #result6::before {
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
        .box {min-height: 80px;cursor: text;border: 1px solid #ddd;padding: 10px 10px;}
        .radio.ganjil{margin-right:32px}.labelname{padding-left:8px;position:absolute;margin-left:30px;margin-top:-21px}.checkbox,.radio{margin-bottom:8px;margin-left:-10px;width:48%;float:left}.radio label{padding:10px}.checkbox *,.radio *{cursor:pointer}.checkbox input,.radio input{opacity:0}.checkbox span,.radio span{position:relative;display:inline-block;margin-left:-25px;vertical-align:top;width:20px;height:20px;border-radius:2px;border:1px solid #ccc}.checkbox:hover span,.radio:hover span{border-color:#6c61f6}.checkbox span:before,.radio span:before{content:"\2713";position:absolute;top:0;left:0;right:0;bottom:0;opacity:0;text-align:center;font-size:16px;line-height:16px;vertical-align:middle;color:#6c61f6}.radio span{border-radius:50%}.radio span:before{content:"";width:10px;height:10px;margin:5px auto;background-color:#6c61f6;border-radius:100px}.checkbox input[type=checkbox]:checked+span,.radio input[type=radio]:checked+span{border-color:#6c61f6;background-color:#6c61f6}.radio input[type=radio]:checked+span{background-color:#fff}.checkbox input[type=checkbox]:checked+span:before,.radio input[type=radio]:checked+span:before{color:#fff;opacity:1;transition:color .3 ease-out}.checkbox input[type=checkbox]:disabled+span,.radio input[type=radio]:disabled+span{border-color:#ddd!important;background-color:#ddd!important}
    </style>
    
    <div class="wrap plugin_info"><h2 class="title" style="display: none;"></h2>
     <?php
            
            // Get USER ROLES
            $cap = get_user_meta( wp_get_current_user()->ID, $wpdb->get_blog_prefix() . 'capabilities', true );
            $roles = array_keys((array)$cap);
            $role = $roles[0];

            ?>
    </div>

    <div class="wrap" style="box-shadow: 0 4px 25px 0 rgba(0,0,0,.1);border-radius: 4px;">
        <div class="sub-title" style="padding-bottom: 40px;margin-top: 18px;">
            <header class="mgo-header">
                <h1 class="mgo-logo"><img class="icon-title2" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/magic-order-icon2.png"></h1>

                <a href="<?php echo admin_url('admin.php?page=magic_order_data_wareset_custom') ?>&id=<?php echo $id;?>" style="cursor: pointer;position: absolute;right: 0;margin-top: 80px;margin-right: 50px;height: 0;width: 0;">
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


           <div class="wrap-container" style="margin-top: -180px;">
            <div class="api-container">
                <div class="page-title" style="font-size: 21px;margin-top: 50px;"><a href="<?php echo admin_url('admin.php?page=magic_order_form') ?>" style="text-decoration: none;margin-left:0px;" class="mgo_link"><span>Form Lists</span></a><span><span class="dashicons dashicons-arrow-right-alt2"></span><span class="dashicons dashicons-arrow-right-alt2" style="margin-left: -15px;"></span></span><span>Followup WA <b><?php echo $judul_form; ?></b></span></div>
                <br>
                <!-- <hr> -->
                <br>
                <p style="color:#464646;margin-top: 20px;"><b>CUSTOM FOLLOWUP WA</b><br>
                <br>
                <div style=" padding-bottom: 50px;margin-top: -10px;">
                    <input type="text" value="<?php echo $id;?>" name="form_id" style="display: none;">
                    <div class="radio">
                      <label>
                        <input class="f_wa_status" name="f_wa_status" value="0" type="radio" <?php if($f_wa_status==0){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">GENERAL</div>
                      </label>
                    </div>
                    <div class="radio" style="margin-left: -10px;">
                      <label>
                        <input class="f_wa_status" name="f_wa_status" value="1" type="radio" <?php if($f_wa_status==1){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">CUSTOM</div>
                      </label>
                    </div>
                </div>
                <br>
                <hr>
                <br>
                <div id="custom_followup" style="<?php if($f_wa_status==0){echo 'display:none;'; }?>">
                <p style="color:#464646;margin-bottom: 20px;margin-top:20px;"><b>FOLLOWUP 1 - Transfer</b><br>
                <div>
                    <ul id="toolbar" style="margin-bottom: -7px;margin-top: 12px;">
                        <li><a href="" data-action='["bold",false,null]' title="Bold" style="font-weight: bold;">B</a></li>
                        <li><a href="" data-action='["italic",false,null]' title="Italic" style="font-style: italic;">I</a></li>
                        <li><a href="" data-action='["strikeThrough",false,null]' title="Heading"><s>S</s></a></li>
                        <li><a href="" data-action='["removeFormat",false,null]' title="Remove formatting" style="width:64px;">&times; Reset</a></li>
                    </ul>
                    <div style="width: 100%;">
                        <div id="divcontainer" class="lead emoji-picker-container">
                            <div id="mytext" contenteditable="true" data-emojiable="true" data-emoji-input="unicode">
                              <?php echo $f_transfer_satu; ?></div>
                        </div>
                    </div>
                </div>
                <br>
                <div>
                <p  style="color:#464646;margin-bottom: 20px;"><b>FOLLOWUP 2 - Transfer</b><br>
                <div>
                    <ul id="toolbar2" style="margin-bottom: -7px;margin-top: 12px;">
                        <li><a href="" data-action='["bold",false,null]' title="Bold" style="font-weight: bold;">B</a></li>
                        <li><a href="" data-action='["italic",false,null]' title="Italic" style="font-style: italic;">I</a></li>
                        <li><a href="" data-action='["strikeThrough",false,null]' title="Heading"><s>S</s></a></li>
                        <li><a href="" data-action='["removeFormat",false,null]' title="Remove formatting" style="width:64px;">&times; Reset</a></li>
                    </ul>
                    <div style="width: 100%;">
                        <div id="divcontainer2" class="lead emoji-picker-container">
                            <div id="mytext2" contenteditable="true" data-emojiable="true" data-emoji-input="unicode">
                              <?php echo $f_transfer_dua; ?></div>
                        </div>
                    </div>
                </div>
                <br>
                </div>

                <p  style="color:#464646;margin-bottom: 20px;"><b>FOLLOWUP 3 - Transfer</b><br>
                <div>
                    <ul id="toolbar3" style="margin-bottom: -7px;margin-top: 12px;">
                        <li><a href="" data-action='["bold",false,null]' title="Bold" style="font-weight: bold;">B</a></li>
                        <li><a href="" data-action='["italic",false,null]' title="Italic" style="font-style: italic;">I</a></li>
                        <li><a href="" data-action='["strikeThrough",false,null]' title="Heading"><s>S</s></a></li>
                        <li><a href="" data-action='["removeFormat",false,null]' title="Remove formatting" style="width:64px;">&times; Reset</a></li>
                    </ul>
                    <div style="width: 100%;">
                        <div id="divcontainer3" class="lead emoji-picker-container">
                            <div id="mytext3" contenteditable="true" data-emojiable="true" data-emoji-input="unicode">
                              <?php echo $f_transfer_tiga; ?></div>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <br>
                <hr>
                <br>
                <br>
                <p  style="color:#464646;margin-bottom: 20px;"><b>FOLLOWUP 1 - COD</b><br>
                <div>
                    <ul id="toolbar4" style="margin-bottom: -7px;margin-top: 12px;">
                        <li><a href="" data-action='["bold",false,null]' title="Bold" style="font-weight: bold;">B</a></li>
                        <li><a href="" data-action='["italic",false,null]' title="Italic" style="font-style: italic;">I</a></li>
                        <li><a href="" data-action='["strikeThrough",false,null]' title="Heading"><s>S</s></a></li>
                        <li><a href="" data-action='["removeFormat",false,null]' title="Remove formatting" style="width:64px;">&times; Reset</a></li>
                    </ul>
                    <div style="width: 100%;">
                        <div id="divcontainer4" class="lead emoji-picker-container">
                            <div id="mytext4" contenteditable="true" data-emojiable="true" data-emoji-input="unicode">
                              <?php echo $f_cod_satu; ?></div>
                        </div>
                    </div>
                </div>
                <br>
                <p  style="color:#464646;margin-bottom: 20px;"><b>FOLLOWUP 2 - COD</b><br>
                <div>
                    <ul id="toolbar5" style="margin-bottom: -7px;margin-top: 12px;">
                        <li><a href="" data-action='["bold",false,null]' title="Bold" style="font-weight: bold;">B</a></li>
                        <li><a href="" data-action='["italic",false,null]' title="Italic" style="font-style: italic;">I</a></li>
                        <li><a href="" data-action='["strikeThrough",false,null]' title="Heading"><s>S</s></a></li>
                        <li><a href="" data-action='["removeFormat",false,null]' title="Remove formatting" style="width:64px;">&times; Reset</a></li>
                    </ul>
                    <div style="width: 100%;">
                        <div id="divcontainer5" class="lead emoji-picker-container">
                            <div id="mytext5" contenteditable="true" data-emojiable="true" data-emoji-input="unicode">
                              <?php echo $f_cod_dua; ?></div>
                        </div>
                    </div>
                </div>
                <br>
                <p  style="color:#464646;margin-bottom: 20px;"><b>FOLLOWUP 3 - COD</b><br>
                <div>
                    <ul id="toolbar6" style="margin-bottom: -7px;margin-top: 12px;">
                        <li><a href="" data-action='["bold",false,null]' title="Bold" style="font-weight: bold;">B</a></li>
                        <li><a href="" data-action='["italic",false,null]' title="Italic" style="font-style: italic;">I</a></li>
                        <li><a href="" data-action='["strikeThrough",false,null]' title="Heading"><s>S</s></a></li>
                        <li><a href="" data-action='["removeFormat",false,null]' title="Remove formatting" style="width:64px;">&times; Reset</a></li>
                    </ul>
                    <div style="width: 100%;">
                        <div id="divcontainer6" class="lead emoji-picker-container">
                            <div id="mytext6" contenteditable="true" data-emojiable="true" data-emoji-input="unicode">
                              <?php echo $f_cod_tiga; ?></div>
                        </div>
                    </div>
                </div>
                <br>
                </div> <!-- end custom_followup -->
                <br>
                <input type='button' id="save_wa_settings" name="insert" value='Save Custom Followup WA' class='button btn_mgo' style="margin-top: 10px;"><span id="success_response"></span>
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


            </div>
          </div>


        

    </div>
 <script type='text/javascript' src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/jquery-2.1.1.min.js?ver=<?php echo $plugin_version; ?>"></script>
    <!-- Begin emoji-picker JavaScript -->
    <script src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/emoji/lib/js/config.js"></script>
    <script src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/emoji/lib/js/util.js"></script>
    <script src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/emoji/lib/js/jquery.emojiarea.js"></script>
    <script src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/emoji/lib/js/emoji-picker.js"></script>
    <!-- End emoji-picker JavaScript -->
    <script>
    $(document).ready(function(){

        $(":radio[name='f_wa_status']").bind("change", function(e){
            var f_wa_status = $(this).filter(':checked').val();
            if(f_wa_status==1){
                $('#custom_followup').show();
            }else{
                $('#custom_followup').hide();
            }
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

            $('#editable5 img').removeAttr('src').removeAttr('draggable').removeAttr('class');
            var content5 = $('#editable5').html();
            var newcontent20 = content5.replace(/<img alt="/g , "");
            var newcontent21 = newcontent20.replace(/">/g , "");
            var newcontent22 = newcontent21.replace(/&amp;/g , "dan");

            $('#editable6 img').removeAttr('src').removeAttr('draggable').removeAttr('class');
            var content6 = $('#editable6').html();
            var newcontent24 = content6.replace(/<img alt="/g , "");
            var newcontent25 = newcontent24.replace(/">/g , "");
            var newcontent26 = newcontent25.replace(/&amp;/g , "dan");

            var f_wa_status = $("input[type=radio][name=f_wa_status]:checked").val();
            var form_id = $("input[name=form_id]").val();

            // return false;
            var data_nya = [
                newcontent3,
                newcontent9,
                newcontent13,
                newcontent18,
                newcontent22,
                newcontent26,
                f_wa_status,
                form_id
            ];

            // alert(newcontent3);

            // return false;

            var data = {
                'action': 'myaction_wa_settings_custom',
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
            $("#success_response5").html('<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Processing...</span>');

            var data = {
                'action': 'myaction_update_collation_table'
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response5").html(response);
                window.location.reload();
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

        $("#toolbar6 li a").click(function(evt){
            evt.preventDefault();
            document.execCommand.apply(document, $(this).data("action"));
            $("#editable6").keyup();
        });

        document.querySelector("div[contenteditable]").addEventListener("paste", function(e) {
            e.preventDefault();
            var text = e.clipboardData.getData("text/plain");
            document.execCommand("insertHTML", false, text);
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

        var idnya6 = "editable6";
        var textnya6 = $('#mytext6').html();
        $('#divcontainer6 .emoji-wysiwyg-editor').attr("id", idnya6);
        $('#'+idnya6).html(textnya6).addClass("box");


      });
    </script>
    <?php
}
