<?php

function magic_order_autosave_wa_settings() {
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

    $row = $wpdb->get_results('SELECT data from '.$table_name.' where type="wa_followup" or type="wa_autosave" ORDER BY id ASC');
    $wa_followup  = $row[0]->data;
    $wa_autosave  = $row[1]->data;

    ?>
    
    <link href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/emoji/lib/css/emoji.css" rel="stylesheet">
    <link type="text/css" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/style-admin.css?ver=<?php echo $plugin_version; ?>" rel="stylesheet" />
    <style>
        i.emoji-picker-icon.fa-smile-o::before {
            content: "" !important;
        }
        .btn_mgo {
            height: 40px !important;
            padding-left: 20px !important;
            padding-right: 20px !important;
        }
        .api-container{width:45%;margin:0 auto}.api-input{width:410px;height:42px;font-size:21px;padding-left:10px}@media only screen and (max-width:720px){.api-container{width:100%}}@media only screen and (max-width:480px){.api-input{width:100%}}#toolbar,#toolbar2,#toolbar3{margin:0 0 1em;border:0;padding:0;list-style:none}#toolbar li,#toolbar2 li,#toolbar3 li{display:inline-block}#toolbar li a,#toolbar2 li a,#toolbar3 li a{color:#999;text-decoration:none;background-color:#eee;border:1px solid #ccc;display:inline-block;width:2em;line-height:2em;text-align:center},#toolbar li a:hover,#toolbar2 li a:hover,#toolbar3 li a:hover{box-shadow:0 1px 3px #ccc}#editable,#editable2,#editable3{min-height:5em;outline:0}#editable2:empty::before,#editable3:empty::before,#editable:empty::before{content:"Whatsapp Custom Text";color:#ccc}#result,#result3,#result5{background-color:#eee;padding:.5em .75em}#result3::before,#result5::before,#result::before{content:"HTML output:";display:block;color:#999}.emoji-picker-icon{background:url('<?php echo plugin_dir_url( __FILE__ ); ?>../assets/emoji/lib/img/emoji-icon.jpg') #eaeaea;width:24px;height:24px}.box{min-height:80px;cursor:text;border:1px solid #ddd;padding:10px}.radio.ganjil{margin-right:32px}.labelname{padding-left:8px;position:absolute;margin-left:30px;margin-top:-21px}.checkbox,.radio{margin-bottom:8px;margin-left:-10px;width:48%;float:left}.radio label{padding:10px}.checkbox *,.radio *{cursor:pointer}.checkbox input,.radio input{opacity:0}.checkbox span,.radio span{position:relative;display:inline-block;margin-left:-25px;vertical-align:top;width:20px;height:20px;border-radius:2px;border:1px solid #ccc}.checkbox:hover span,.radio:hover span{border-color:#6c61f6}.checkbox span:before,.radio span:before{content:"\2713";position:absolute;top:0;left:0;right:0;bottom:0;opacity:0;text-align:center;font-size:16px;line-height:16px;vertical-align:middle;color:#6c61f6}.radio span{border-radius:50%}.radio span:before{content:"";width:10px;height:10px;margin:5px auto;background-color:#6c61f6;border-radius:100px}.checkbox input[type=checkbox]:checked+span,.radio input[type=radio]:checked+span{border-color:#6c61f6;background-color:#6c61f6}.radio input[type=radio]:checked+span{background-color:#fff}.checkbox input[type=checkbox]:checked+span:before,.radio input[type=radio]:checked+span:before{color:#fff;opacity:1;transition:color .3 ease-out}.checkbox input[type=checkbox]:disabled+span,.radio input[type=radio]:disabled+span{border-color:#ddd!important;background-color:#ddd!important}
    </style>
   <!--  <div class="wrap">
    <h2 class="title"><img class="icon-title" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/magic-order-icon.png">
    <div class="main-title" style="margin-top: -30px;"><?php echo $plugin_name; ?><div style="font-size: 11px;margin-top: -10px;color:#A0C9D7;">Version <?php echo $plugin_version; ?></div></div></h2> -->
    <div class="wrap plugin_info"><h2 class="title" style="display: none;"></h2></div>
        <?php

        // Check Plugin Licensed
        

        // Get User ROLES
        $cap = get_user_meta( wp_get_current_user()->ID, $wpdb->get_blog_prefix() . 'capabilities', true );
        $roles = array_keys((array)$cap);
        $role = $roles[0];
        
        ?>
        
        <div class="wrap" style="box-shadow: 0 4px 25px 0 rgba(0,0,0,.1);border-radius: 4px;">
        <div class="sub-title" style="padding-bottom: 40px;margin-top: 18px;">
        <header class="mgo-header">
            <h1 class="mgo-logo"><img class="icon-title2" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/magic-order-icon2.png"></h1>
              
              <a href="<?php echo admin_url('admin.php?page=magic_order_autosave_wa_reset') ?>" style="cursor: pointer;position: absolute;right: 0;margin-top: 80px;margin-right: 50px;height: 0;width: 0;">
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

            if($plugin_license=='FREEMIUM' || $plugin_license=='STARTER'){
                // echo $plugin_license_info;
                echo '
                <div class="sub-title-info"><span>Hanya untuk License Basic dan PRO.</span></div>
                ';
                return false;
            }

        ?>
        </div>

        <div class="wrap-container" style="padding-top: 80px;margin-top: -200px;">
            <div class="api-container">
                <div class="page-title" style="font-size: 21px;margin-top: 50px;"><a href="<?php echo admin_url('admin.php?page=magic_order_autosave_wa') ?>" style="text-decoration: none;margin-left:0px;" class="mgo_link"><span>AUTOSAVE WA</span></a><span><span class="dashicons dashicons-arrow-right-alt2"></span><span class="dashicons dashicons-arrow-right-alt2" style="margin-left: -15px;"></span></span><span>SETTINGS</span></div>
                <br>
                <!-- <hr> -->
                <br>
                <p style="color:#464646;margin-bottom: 25px;"><b>ACTIVATE AUTOSAVE</b></p>
                <div style=" padding-bottom: 50px;margin-top: -10px;">
                    <div class="radio">
                      <label>
                        <input class="table_field" name="autosave" value="0" type="radio" <?php if($wa_autosave==0){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Deactive</div>
                      </label>
                    </div>
                    <div class="radio" style="margin-left: -90px;">
                      <label>
                        <input class="table_field" name="autosave" value="1" type="radio" <?php if($wa_autosave==1){echo 'checked'; }?>>
                        <span></span><div class="labelname" style="margin-top: -19px;">Active</div>
                      </label>
                    </div>

                </div>
                <div><input type='button' id="activate_autosave" name="insert" value='Save' class='button btn_mgo' style=""><span id="success_response">
                </span></div>
                <br>
                <br>
                <hr>
                <br>
                <p style="color:#464646;margin-bottom: 20px;"><b>WHATSAPP TEXT FOLLOWUP</b><br>
                <?php
                    // change icon emoji
                    $wa_followup = str_replace(':1f604:', '<img draggable="false" src="https://s.w.org/images/core/emoji/2.4/svg/1f604.svg" class="emoji" />', $wa_followup);

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
                            <div id="mytext" contenteditable="true" data-emojiable="true" data-emoji-input="unicode"><?php echo $wa_followup; ?></div>
                        </div>
                    </div>
                    <div style="display: none;" id="result"></div>
                    <textarea id="result2" style="min-height: 95px;width:100%;display:none; "><?php echo $wa_followup; ?></textarea>
                </div>
                <br>
                <input type='button' id="save_wa_settings" name="insert" value='Save' class='button btn_mgo' style="margin-top: 10px;"><span id="success_response2"></span>
                <br><br>
                </p>
                <p>
                <b>Note:</b>
                <ul style="list-style-type: circle;margin-left: 12px;">
                    <li>Tambahkan <b>[mgo_nama]</b> jika ingin menampilkan nama customer</li>
                    <li>Anda bisa menggunakan Font styling pada textarea yang tersedia.</li>
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

        $('#activate_autosave').bind('click', function() {

            var autosave = $("input[type=radio][name=autosave]:checked").val();

            
            $("#success_response").html('<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Saving...</span>');

            var data_nya = [
                autosave
            ];
            
            var data = {
                'action': 'myaction_activate_autosave',
                'datanya': data_nya
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response").html(response);
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


        $('#save_wa_settings').bind('click', function() {
            $("#success_response2").html('<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Saving...</span>');
            
            $('#editable img').removeAttr('src').removeAttr('draggable').removeAttr('class');
            var content = $('#editable').html();
            var newcontent1 = content.replace(/<img alt="/g , "");
            var newcontent2 = newcontent1.replace(/">/g , "");
            var newcontent3 = newcontent2.replace(/&amp;/g , "dan");
            var newcontent4 = newcontent3.replace(/%/g , " persen");

            var data_nya = [
                newcontent4
            ];

            var data = {
                'action': 'myaction_wa_settings2',
                'datanya': data_nya
            };

            jQuery.post(ajaxurl, data, function(response) {
                $("#success_response2").html(response);
                window.location.reload();
            });

        });


        $("#editable")
            .on("keyup", function(evt) {
                alert(1);
                var s = $(this).html();
                s = s.replace(/<(\/?)([^>]+)>/gi,"&lt;$1$2&gt;");
                s = s.replace(/(&lt;([^\/&]+)&gt;)/gi, "<br/>$1")
                $("#result").html(s);
                $("#result2").html(s);
            })
            .on("blur", function(evt) {
                if ($(this).text().trim() === "")
                {
                    $(this).html("").keyup();
                }
        });

        $("#toolbar li a").click(function(evt){
            evt.preventDefault();
            document.execCommand.apply(document, $(this).data("action"));
            $("#editable").keyup();
        });

        $("#editable2")
            .on("keyup", function(evt) {
                var s = $(this).html();
                s = s.replace(/<(\/?)([^>]+)>/gi,"&lt;$1$2&gt;");
                s = s.replace(/(&lt;([^\/&]+)&gt;)/gi, "<br/>$1")
                $("#result3").html(s);
                $("#result4").html(s);
            })
            .on("blur", function(evt) {
                if ($(this).text().trim() === "")
                {
                    $(this).html("").keyup();
                }
        });

        $("#toolbar2 li a").click(function(evt){
            evt.preventDefault();
            document.execCommand.apply(document, $(this).data("action"));
            $("#editable2").keyup();
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


      });
    </script>
    <script>
        
    </script>

    <?php
}