<?php

function magic_order_coupon() {
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
    $table_name = $wpdb->prefix . "mgo_coupons";
    $table_name2 = $wpdb->prefix . "cf_forms";

    $row = $wpdb->get_results('SELECT * from '.$table_name);

    ?>
    <link type="text/css" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/style-admin.css?ver=<?php echo $plugin_version; ?>" rel="stylesheet" />
    <!-- <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet" /> -->
    
    <style>
        .api-container {
            width: 100%;
        }
        .api-input {
            width: 410px;
            height: 42px;
            font-size: 21px;
            padding-left: 10px;
        }
        
        /* columns */
        .clearfix {
          overflow: hidden;
        }
        .modal {
          box-shadow: 0 0 10px #0000003d !important;
        }

        section {
          color: #232323;
          font-family: sans-serif;
          float: left;
        }

        .one {
          background-color: #fff;
          color: #49535F;
          font-size: 13px;
          font-weight: bold;
          padding: 20px 30px 35px 35px;
          border-radius: 4px !important;
          width: 94%;
        }

        .two {
          background-color: #fff;
          width: 96%;
          padding: 0px 10px 35px 10px;
        }

        @media ( max-width : 720px ){
            .one, .two {
                width: 100%;
            }
        }
        .box-coupon {
            background: #49535f;
            width: 100%;
            float: left;
            margin-top:3%;
            height: 57px;
            text-align: center;
            padding-top: 16px;
            border-radius: 4px !important;
            color: #ffffff;
        }
        .box-coupon.first {
          height: 45px;
          padding-top: 27px;
          margin-bottom: 20px;
        }
        .box-coupon span {
          /* color: #FFD535; */
        }
        .box-coupon.content {
          width: 30%;
          margin-left: 5%;
        }
        .box-coupon.content:nth-child(3n) {
          margin-left: 0;
        }
        .one .box-coupon.first {
          border:1px dashed #ababab;
          background: none;
        }

        .one .box-coupon.first:hover {
          background: #F0F6F8;
          cursor: pointer;
        }
        .delete_coupon {
          margin-right: 7px;
        }

        /*  textbox */
        .title-input {
            font-size: 14px;
            margin-bottom:8px;
            margin-top:16px;
        }
        .input-icon-wrap {
          border: none;   
          display: flex;
          flex-direction: row;
          border: 1px solid #eaeaea;
          margin-bottom: 10px;
          border-radius: 3px !important;
        }

        .input-icon {
          background: none;
        }

        input.input-with-icon {
          border: 0;
          flex: 1;
          box-shadow: unset;
        }

        input.input-with-icon:focus {
            outline: 0 !important;
            border-color: inherit;
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        .input-icon, .input-with-icon {
          padding: 10px;
        }
        
        .input-icon-wrap .dashicons {
            color: #4F5965;
        }
        .select-status {
          width: 100%;
          border: 0;
          margin-top: 7px;
          box-shadow: none;
          outline: 0;
        }
        .circle-status {
          position: absolute;
          margin-top: -15px;
          margin-left: 6px;
          width:8px;
          height:8px;
          -webkit-border-radius: 10px;
                  border-radius: 10px;
        }
        .circle-status.notactive {
          background: #FF003C;
        }
        .circle-status.active {
          background: #88C100;
        }
        .circle-status.expired {
          background: #FF8A00;
        }
        .circle-status.notyet {
          background: #CCC;
        }
        .box-action {
          width: 100%;
          text-align: right;
          padding-right: 5px;
        }
        .box-action .dashicons {
          font-size: 18px;
          margin-top: -5px;
          color: #66707d;
        }
        .box-action .dashicons.edit_coupon{
          margin-right: 3px;
        }
        .box-action .dashicons:hover {
          cursor: pointer;
        }
        .box-action .dashicons.edit_coupon:hover {
           color: #ffffff;
        }
        .box-action .dashicons.delete_coupon:hover{
           color: #D8204C;
        }
        .dashicons.flag_green {
          color: #88C100;
        }
        .dashicons.flag_red {
          color: #D8204C;
        }

        @media only screen and (max-width:720px) {
            .api-container {
                width: 100%;
            }
            .box-coupon.content {
              width: 100% !important;
              margin-left: 0 !important;
            }
        }
        @media only screen and (max-width:640px) {
            .one {
              padding: 20px 15px 35px 15px;
            }
        }
        @media only screen and (max-width:480px) {
            .api-input {
                width: 100%;
            }
        }
        .modal a.close-modal {
          display: none !important;
        }
        .close_modal, .close_modal2 {
          position: absolute;
          top: -12.5px;
          right: -12.5px;
          display: block;
          width: 30px;
          height: 30px;
          text-indent: -9999px;
          background-size: contain;
          background-repeat: no-repeat;
          background-position: center center;
          background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAA8CAYAAAA6/NlyAAAAAXNSR0IArs4c6QAAA3hJREFUaAXlm8+K00Acx7MiCIJH/yw+gA9g25O49SL4AO3Bp1jw5NvktC+wF88qevK4BU97EmzxUBCEolK/n5gp3W6TTJPfpNPNF37MNsl85/vN/DaTmU6PknC4K+pniqeKJ3k8UnkvDxXJzzy+q/yaxxeVHxW/FNHjgRSeKt4rFoplzaAuHHDBGR2eS9G54reirsmienDCTRt7xwsp+KAoEmt9nLaGitZxrBbPFNaGfPloGw2t4JVamSt8xYW6Dg1oCYo3Yv+rCGViV160oMkcd8SYKnYV1Nb1aEOjCe6L5ZOiLfF120EjWhuBu3YIZt1NQmujnk5F4MgOpURzLfAwOBSTmzp3fpDxuI/pabxpqOoz2r2HLAb0GMbZKlNV5/Hg9XJypguryA7lPF5KMdTZQzHjqxNPhWhzIuAruOl1eNqKEx1tSh5rfbxdw7mOxCq4qS68ZTjKS1YVvilu559vWvFHhh4rZrdyZ69Vmpgdj8fJbDZLJpNJ0uv1cnr/gjrUhQMuI+ANjyuwftQ0bbL6Erp0mM/ny8Fg4M3LtdRxgMtKl3jwmIHVxYXChFy94/Rmpa/pTbNUhstKV+4Rr8lLQ9KlUvJKLyG8yvQ2s9SBy1Jb7jV5a0yapfF6apaZLjLLcWtd4sNrmJUMHyM+1xibTjH82Zh01TNlhsrOhdKTe00uAzZQmN6+KW+sDa/JD2PSVQ873m29yf+1Q9VDzfEYlHi1G5LKBBWZbtEsHbFwb1oYDwr1ZiF/2bnCSg1OBE/pfr9/bWx26UxJL3ONPISOLKUvQza0LZUxSKyjpdTGa/vDEr25rddbMM0Q3O6Lx3rqFvU+x6UrRKQY7tyrZecmD9FODy8uLizTmilwNj0kraNcAJhOp5aGVwsAGD5VmJBrWWbJSgWT9zrzWepQF47RaGSiKfeGx6Szi3gzmX/HHbihwBser4B9UJYpFBNX4R6vTn3VQnez0SymnrHQMsRYGTr1dSk34ljRqS/EMd2pLQ8YBp3a1PLfcqCpo8gtHkZFHKkTX6fs3MY0blKnth66rKCnU0VRGu37ONrQaA4eZDFtWAu2fXj9zjFkxTBOo8F7t926gTp/83Kyzzcy2kZD6xiqxTYnHLRFm3vHiRSwNSjkz3hoIzo8lCKWUlg/YtGs7tObunDAZfpDLbfEI15zsEIY3U/x/gHHc/G1zltnAgAAAABJRU5ErkJggg==');
        }
        
    </style>
    <div class="wrap plugin_info"><h2 class="title" style="display: none;"></h2>

          <?php
            
            // Get USER ROLES
            $cap = get_user_meta( wp_get_current_user()->ID, $wpdb->get_blog_prefix() . 'capabilities', true );
            $roles = array_keys((array)$cap);
            $role = $roles[0];

            date_default_timezone_set('Asia/jakarta');
            $date_now = date('m/d/Y H:i:s', time());

            // Check Plugin Licensed
            if($plugin_license=='FREEMIUM' || $plugin_license=='STARTER'){
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

            if($plugin_license=='FREEMIUM' || $plugin_license=='STARTER'){
                // echo $plugin_license_info;
                echo '
                <div class="sub-title-info"><span>Maaf, Hanya untuk Basic dan PRO License.</span></div>
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


        <div class="wrap-container" style="margin-top: -150px;padding-bottom: 80px;">
            <div class="clearfix">
              <section class="one" style="padding-top: 0;">
                <p style="text-align: center; font-size: 16px; font-weight: 300;display: none;"><b>My</b> Coupons</p>
                <a href="#modal_coupon" rel="modal:open" title="Add New Coupon">
                  <div class="box-coupon first">
                    <span class="dashicons dashicons-plus" style="color: #6C61F6;"></span>
                  </div>
                </a>
                <?php
                  foreach($row as $data){
                    if( $data->coupon_discount!=null && $data->coupon_type=='ph' ){
                      $potongan = ' ('.number_format($data->coupon_discount,0,",",".").')';
                    }else if( $data->coupon_discount!=null && $data->coupon_type=='ps' ){
                      $potongan = ' ('.number_format($data->coupon_discount,0,",",".").')';
                    }else{
                      $potongan = '';
                    }

                    if( $data->coupon_status==1 ){
                        $today = strtotime($date_now);
                        $expire = strtotime($data->coupon_expired);
                        $start = strtotime($data->coupon_start);

                        if($today < $start){
                            $status = 'notyet';
                            $status_title = 'Not yet';
                        }else if($today >= $expire){
                            $status = 'expired';
                            $status_title = 'expired';
                        }else {
                            $status = 'active';
                            $status_title = 'Active';
                        }
                    }else{
                        
                        $status = 'notactive';
                        $status_title = 'Not Active';
                        
                    }

                    if($data->coupon_type=='go'){
                      $coupon_type = 'GO';
                    }
                    if($data->coupon_type=='ph'){
                      $coupon_type = 'Rp';
                    }
                    if($data->coupon_type=='ps'){
                      $coupon_type = '%';
                    }

                    echo '<div class="box-coupon content" id="coupon_'.$data->id.'"><span id="couponcode_'.$data->id.'">'.$data->coupon_code.'</span><br><span style="font-size:11px;font-weight:300;" id="typeexpired_'.$data->id.'">'.$coupon_type.$potongan.' / '.date("F j, Y - ",strtotime($data->coupon_expired)).date("H:i ",strtotime($data->coupon_expired)).'</span>
                      <div class="box-action"><a href="#modal_coupon2" rel="modal:open" style="text-decoration: none;"><span class="dashicons dashicons-edit edit_coupon" title="Edit Coupon" data-id="'.$data->id.'"></span></a><span class="dashicons dashicons-trash delete_coupon" title="Delete Coupon" data-id="'.$data->id.'"></span></div>
                      <div class="circle-status '.$status.'" title="'.$status_title.'"  id="status_'.$data->id.'"><div class="scrap"></div></div></div>';
                  }
                ?>
                
              </section>
              <div style="margin-top:20px;font-weight: 300;margin-left: 35px;">
                  <p>&nbsp;</p>
                  <br>
                  <span style="margin-right: 20px;"><b>STATUS :</b> </span><div class="circle-status notyet" style="position: unset;display: inline-block;margin-right: 10px;"></div><span style="margin-right: 20px;">Not yet</span><div class="circle-status active" style="position: unset;display: inline-block;margin-right: 10px;"></div><span style="margin-right: 20px;">Active</span>
                  <div class="circle-status notactive" style="position: unset;display: inline-block;margin-right: 10px;"></div><span style="margin-right: 20px;">Not Active</span>
                  <div class="circle-status expired" style="position: unset;display: inline-block;margin-right: 10px;"></div><span>Expired</span>
                </div>
    
            </div>
            
            <!-- Modal -->
            <div id="modal_coupon" class="modal animated zoomIn" style="display:none;">
              <section class="two">
                <p style="font-size: 18px;color:#49535F;font-weight: bold;" class="popup-title">Add New Coupon <span style="position: absolute;margin-left: 10px;"><?php echo '<img src='.plugin_dir_url( __FILE__ ).'../assets/icons/loader2.gif>';?><span id="response_success"></span></span></p>
                <div>
                    <div class="input-icon-wrap">
                      <span class="input-icon"><span class="dashicons dashicons-tag"></span></span>
                      <select name="" id="coupon_type" class="select-status" title="Coupon Type">
                        <option value="0">Coupon Type</option>
                        <option value="go">Gratis Ongkir (GO)</option>
                        <option value="ph">Potongan Harga (Rp)</option>
                        <option value="ps">Potongan Harga (%)</option>
                      </select>
                    </div>
                </div>
                <div id="field_name" style="display: none;">
                    <div class="input-icon-wrap">
                      <span class="input-icon"><span class="dashicons dashicons-format-aside"></span></span>
                      <input type="text" class="input-with-icon" id="coupon_name" placeholder="Coupon Name" title="Coupon Name">
                    </div>
                </div>
                <div id="field_code" style="display: none;">
                    <div class="input-icon-wrap">
                      <span class="input-icon"><span class="dashicons dashicons-admin-network"></span></span>
                      <input type="text" class="input-with-icon" id="coupon_code" placeholder="Coupon Code" title="Coupon Code">
                    </div>
                </div>
                <div id="field_start" style="display: none;">
                    <div class="input-icon-wrap">
                      <span class="input-icon"><span class="dashicons dashicons-calendar-alt"></span></span>
                      <input type="text" class="input-with-icon coupon" id="coupon_start" placeholder="Date Start" title="Date Start">
                    </div>
                </div>
                <div id="field_expired" style="display: none;">
                    <div class="input-icon-wrap">
                      <span class="input-icon"><span class="dashicons dashicons-calendar-alt"></span></span>
                      <input type="text" class="input-with-icon coupon" id="coupon_expired" placeholder="Date Expired" title="Date Expired">
                    </div>
                </div>
                <div id="field_status" style="display: none;">
                    <div class="input-icon-wrap">
                      <span class="input-icon"><span class="dashicons dashicons-flag"></span></span>
                      <select name="" id="coupon_status" class="select-status" title="Status">
                        <option value="0">Set Status</option>
                        <option value="1">Active</option>
                        <option value="2">Deactive</option>
                      </select>
                    </div>
                </div>
                <div id="field_discount" style="display: none;">
                    <div class="input-icon-wrap">
                      <span class="input-icon"><span class="dashicons dashicons-edit"></span></span>
                      <input type="text" class="input-with-icon discount" id="coupon_discount" placeholder="Discount Example: 100.000" title="Discount">
                    </div>
                </div>
                <div style="padding-top: 25px;text-align: center;">
                    <input type='button' id="save_coupon" name="insert" value='Save Coupon' class='button btn_coupon' style="margin-top: 10px;">
                    <span id="success_response"></span>
                </div>
                      <a href="javascript:;" class="close_modal">Close</a>
              </section>
            </div>

            <!-- Modal2 -->
            <div id="modal_coupon2" class="modal animated zoomIn" style="display:none;">
              <section class="two">
                <p style="font-size: 18px;color:#49535F;font-weight: bold;" class="popup-title2">Edit Coupon <span style="position: absolute;margin-left: 10px;"><?php echo '<img src='.plugin_dir_url( __FILE__ ).'../assets/icons/loader2.gif>';?><span id="response_success2"></span></span></p>
                <span id="field_input">Loading...</span>
                <a href="javascript:;" class="close_modal2">Close</a>
              </section>
            </div>


        </div>
    </div>
    <script type='text/javascript' src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/jquery-2.1.1.min.js?ver=<?php echo $plugin_version; ?>"></script>
    <script src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/modal/jquery.modal.min.js?ver=<?php echo $plugin_version; ?>"></script>
    <link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/modal/jquery.modal.min.css?ver=<?php echo $plugin_version; ?>" />

    <link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/timepicker/jquery.datetimepicker.min.css?ver=<?php echo $plugin_version; ?>" />
    <script src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/timepicker/jquery.datetimepicker.full.min.js?ver=<?php echo $plugin_version; ?>"></script>

    <link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/confirm/jquery-confirm.min.css?ver=<?php echo $plugin_version; ?>">
    <script src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/confirm/jquery-confirm.min.js?ver=<?php echo $plugin_version; ?>"></script>
    <script>

    $(document).ready(function(e){


        $(".close_modal").bind("click", function(e) {
            $('#modal_coupon').removeClass('zoomIn').addClass('zoomOut');
            setTimeout(function(){ 
                $.modal.close();
                $('#modal_coupon').removeClass('zoomOut').addClass('zoomIn');
               },
            400);
        });

        $(".close_modal2").bind("click", function(e) {
            $('#modal_coupon2').removeClass('zoomIn').addClass('zoomOut');
            setTimeout(function(){ 
                $.modal.close();
                $('#modal_coupon2').removeClass('zoomOut').addClass('zoomIn');
               },
            400);
        });

        $("#coupon_start").datetimepicker({
            format:'Y-m-d H:i'
        });

        $("#coupon_expired").datetimepicker({
            format:'Y-m-d H:i'
        });
        
        $("#coupon_type").val("0");
        $("#coupon_status").val("0");

        $("#coupon_type").bind("change", function(e) {
            var id = $(this).find('option:selected').val();
            if(id=="ph"){
                $("#field_discount").show();
                $("#field_name").show();
                $("#field_code").show();
                $("#field_start").show();
                $("#field_expired").show();
                $("#field_status").show();
                $("#field_discount .input-icon").html('<span style="font-size: 14px;margin-left: 3px;color: #4f5964;">Rp</span>');
                $("#field_discount #coupon_discount").attr("placeholder", "Discount Example: 100.000");
            }else if(id=="ps"){
                $("#field_discount").show();
                $("#field_name").show();
                $("#field_code").show();
                $("#field_start").show();
                $("#field_expired").show();
                $("#field_status").show();
                $("#field_discount .input-icon").html('<span style="font-size: 16px;margin-left: 3px;color: #4f5964;">%</span>');
                $("#field_discount #coupon_discount").attr("placeholder", "1-100");
            }else if(id=="go"){
                $("#field_discount").hide();
                $("#field_name").show();
                $("#field_code").show();
                $("#field_start").show();
                $("#field_expired").show();
                $("#field_status").show();
            }else{
                $("#field_discount").hide();
                $("#field_name").hide();
                $("#field_code").hide();
                $("#field_start").hide();
                $("#field_expired").hide();
                $("#field_status").hide();
            }
        });

        $(document).on("change", "#coupon_type2", function(e) {
            var id = $(this).find('option:selected').val();
            if(id=="ph"){
                $("#field_discount2").show();
                $("#field_name2").show();
                $("#field_code2").show();
                $("#field_start2").show();
                $("#field_expired2").show();
                $("#field_status2").show();
                $("#field_discount2 .input-icon").html('<span style="font-size: 14px;margin-left: 3px;color: #4f5964;">Rp</span>');
                $("#field_discount2 #coupon_discount2").attr("placeholder", "Discount Example: 100.000");
            }else if(id=="ps"){
                $("#field_discount").show();
                $("#field_name").show();
                $("#field_code").show();
                $("#field_start").show();
                $("#field_expired").show();
                $("#field_status").show();
                $("#field_discount2 .input-icon").html('<span style="font-size: 16px;margin-left: 3px;color: #4f5964;">%</span>');
                $("#field_discount2 #coupon_discount2").attr("placeholder", "1-100");
            }else if(id=="go"){
                $("#field_discount2").hide();
                $("#field_name2").show();
                $("#field_code2").show();
                $("#field_start2").show();
                $("#field_expired2").show();
                $("#field_status2").show();
            }else{
                $("#field_discount2").hide();
                $("#field_name2").hide();
                $("#field_code2").hide();
                $("#field_start2").hide();
                $("#field_expired2").hide();
                $("#field_status2").hide();
            }
        });

        $(document).on("change", "#coupon_status", function(e) {
            var id = $(this).find('option:selected').val();
            if(id=='1'){
                $('#field_status .dashicons.dashicons-flag').addClass('flag_green');
                $('#field_status .dashicons.dashicons-flag').removeClass('flag_red');
            }else if(id=='2'){
                $('#field_status .dashicons.dashicons-flag').addClass('flag_red');
                $('#field_status .dashicons.dashicons-flag').removeClass('flag_green');
            }else{
              $('#field_status .dashicons.dashicons-flag').removeClass('flag_red');
              $('#field_status .dashicons.dashicons-flag').removeClass('flag_green');
            }
        });

        
        $(document).on("click", ".edit_coupon", function(e) {
            var id_coupon = $(this).data('id');
            $('#field_input').html('Loading...');
            $('#response_success2').html('');
            var data_nya = [
                id_coupon
            ];
            var data = {
                "action": "myaction_form_edit_coupon",
                "datanya": data_nya
            };
            jQuery.post(ajaxurl, data, function(response) {
                $('#field_input').html(response);
            });
        });

        
        $(document).on("click", ".delete_coupon", function(e) {
            var id_coupon = $(this).data('id');

            $.confirm({
                title: 'Hello',
                content: 'Are you sure want to Delete this coupon?',
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
                        text: "Delete",
                        btnClass: 'btn-danger',
                        keys: ['enter'],
                        action: function(e){
                            
                            var data_nya = [
                                id_coupon
                            ];
                            var data = {
                                "action": "myaction_delete_coupon",
                                "datanya": data_nya
                            };
                            jQuery.post(ajaxurl, data, function(response) {
                                if(response=="success"){
                                    $('#coupon_'+id_coupon).remove();
                                }
                            });
                        }
                    },
                }
            });
        });

        $(document).on("click", "#update_coupon", function(e) {
            var coupon_type2 = $("#coupon_type2").find(":selected").val();
            var coupon_name2 = $("#coupon_name2").val();
            var coupon_code2 = $("#coupon_code2").val();
            var coupon_discount2 = $("#coupon_discount2").val();
            var coupon_start2 = $("#coupon_start2").val();
            var coupon_expired2 = $("#coupon_expired2").val();
            var coupon_status2 = $("#coupon_status2").find(":selected").val();
            var coupon_id2 = $("#coupon_id2").val();

            if(coupon_type2==0){
              $.alert({
                  title: '',
                  content: 'Please choose your coupon type!',
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

            if(coupon_type2=='go'){
              if(coupon_name2=='' || coupon_code2=='' || coupon_expired2=='' || coupon_status2==0){
                $.alert({
                    title: '',
                    content: 'Please insert all field!',
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
              var discountnya2 = '';
            }

            if(coupon_type2=='ph'){
              if(coupon_name2=='' || coupon_code2=='' || coupon_expired2=='' || coupon_status2==0 || coupon_discount2==''){
                $.alert({
                    title: '',
                    content: 'Please insert all field!',
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
              var discountnya2 = ' ('+coupon_discount2+')';
            }


            if(coupon_type2=='ps'){
              if(coupon_name2=='' || coupon_code2=='' || coupon_expired2=='' || coupon_status2==0 || coupon_discount2==''){
                $.alert({
                    title: '',
                    content: 'Please insert all field!',
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
              var discountnya2 = ' ('+coupon_discount2+')';
            }

            if(Date.parse(coupon_expired2)-Date.parse(coupon_start2)<0){
              $.alert({
                  title: '',
                  content: 'Please correct your start date and expired date!',
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

            if(coupon_status2=='1'){

              if(Date.parse(new Date())-Date.parse(coupon_start2)<0){
                  var active2 = 'notyet';
                  var title_active2 = 'Not yet';
              }else if(Date.parse(coupon_expired2)-Date.parse(new Date())<0){
                  var active2 = 'expired';
                  var title_active2 = 'Expired';
              }else{
                  var active2 = 'active';
                  var title_active2 = 'Active';
              }

            }else{
              var active2 = 'notactive';
              var title_active2 = 'Not Active';
            }

            var datenya = coupon_expired2.split("-");
            var tahun = datenya[0];
            var bulan = datenya[1];
            var tanggal = datenya[2];
            tanggal = tanggal.split(" ");
            if(bulan=="1" || bulan=="01"){
                var bulannya = 'January';
            }else if(bulan=="2" || bulan=="02"){
                var bulannya = 'February';
            }else if(bulan=="3" || bulan=="03"){
                var bulannya = 'March';
            }else if(bulan=="4" || bulan=="04"){
                var bulannya = 'April';
            }else if(bulan=="5" || bulan=="05"){
                var bulannya = 'May';
            }else if(bulan=="6" || bulan=="06"){
                var bulannya = 'June';
            }else if(bulan=="7" || bulan=="07"){
                var bulannya = 'July';
            }else if(bulan=="8" || bulan=="08"){
                var bulannya = 'August';
            }else if(bulan=="9" || bulan=="09"){
                var bulannya = 'September';
            }else if(bulan=="10" || bulan=="10"){
                var bulannya = 'October';
            }else if(bulan=="11" || bulan=="11"){
                var bulannya = 'November';
            }else{
                var bulannya = 'December';
            }

            var newdate2 = bulannya+' '+tanggal[0]+', '+tahun+' - '+tanggal[1];

            var value_discount2 = coupon_discount2.replace(/\./g,'');
            value_discount2 = parseInt(value_discount2,10);

            if(coupon_type2=='go'){
              coupon_type2_new = "GO";
            }
            if(coupon_type2=='ph'){
              coupon_type2_new = "Rp";
            }
            if(coupon_type2=='ps'){
              coupon_type2_new = "%";
              if(value_discount2>100){
                $.alert({
                    title: '',
                    content: 'Maaf, Potongan harga % hanya 1-100. Silahkan update potongan harga anda.',
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
            }

            var type_and_expired = coupon_type2_new+discountnya2+' / '+newdate2;

            $('.popup-title2 img').show();
            $('#response_success2').html('');

            var data_nya = [
                coupon_type2,
                coupon_name2,
                coupon_code2,
                value_discount2,
                coupon_start2,
                coupon_expired2,
                coupon_status2,
                coupon_id2
            ];
            var data = {
                "action": "myaction_update_coupon",
                "datanya": data_nya
            };
            jQuery.post(ajaxurl, data, function(response) {
                
                if(response=='success'){

                    $('#couponcode_'+coupon_id2).text(coupon_code2);
                    $('#typeexpired_'+coupon_id2).text(type_and_expired);
                    $('#status_'+coupon_id2).removeClass('notyet').removeClass('active').removeClass('notactive').removeClass('expired').addClass(active2);

                    $('.popup-title2 img').hide();
                    $('#response_success2').show();
                    $('#response_success2').html('<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;color: #2EC26A;margin-left:-10px;"><span class="dashicons dashicons-yes" style="margin-right: 5px; font-size: 25px;"></span>Update Coupon Success!</span>').delay(2000).fadeOut();

                }else{
                  $('.popup-title2 img').hide();
                  $('#response_success2').show();
                  $('#response_success2').html('<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;color: #D12F2F;margin-left:-10px;"><span class="dashicons dashicons-no-alt" style="margin-right: 5px; font-size: 25px;"></span>Duplicate Coupon Code!</span>').delay(2000).fadeOut();
                }
            });   

        });

        $("#save_coupon").bind("click", function(e) {
            var coupon_type = $("#coupon_type").find(":selected").val();
            var coupon_name = $("#coupon_name").val();
            var coupon_code = $("#coupon_code").val();
            var coupon_discount = $("#coupon_discount").val();
            var coupon_start = $("#coupon_start").val();
            var coupon_expired = $("#coupon_expired").val();
            var coupon_status = $("#coupon_status").find(":selected").val();

            if(coupon_type==0){
              $.alert({
                    title: '',
                    content: 'Please choose your coupon type!',
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
            
            if(coupon_type=='go'){
              if(coupon_name=='' || coupon_code=='' || coupon_expired=='' || coupon_status==0){
                $.alert({
                    title: '',
                    content: 'Please insert all field!',
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
              var discountnya = '';
            }

            if(coupon_type=='ph'){
              if(coupon_name=='' || coupon_code=='' || coupon_expired=='' || coupon_status==0 || coupon_discount==''){
                $.alert({
                    title: '',
                    content: 'Please insert all field!',
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
              var discountnya = ' ('+coupon_discount+')';
            }


            if(coupon_type=='ps'){
              if(coupon_name=='' || coupon_code=='' || coupon_expired=='' || coupon_status==0 || coupon_discount==''){
                $.alert({
                    title: '',
                    content: 'Please insert all field!',
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
              var discountnya = ' ('+coupon_discount+')';
            }

            if(Date.parse(coupon_expired)-Date.parse(coupon_start)<0){
              $.alert({
                  title: '',
                  content: 'Please correct your start date and expired date!',
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

            if(coupon_status=='1'){

              if(Date.parse(new Date())-Date.parse(coupon_start)<0){
                  var active = 'notyet';
                  var title_active = 'Not yet';
              }else if(Date.parse(coupon_expired)-Date.parse(new Date())<0){
                  var active = 'expired';
                  var title_active = 'Expired';
              }else{
                  var active = 'active';
                  var title_active = 'Active';
              }
            }else{
              var active = 'notactive';
              var title_active = 'Not Active';
            }

            var datenya = coupon_expired.split("-");
            var tahun = datenya[0];
            var bulan = datenya[1];
            var tanggal = datenya[2];
            tanggal = tanggal.split(" ");
            if(bulan=="1" || bulan=="01"){
                var bulannya = 'January';
            }else if(bulan=="2" || bulan=="02"){
                var bulannya = 'February';
            }else if(bulan=="3" || bulan=="03"){
                var bulannya = 'March';
            }else if(bulan=="4" || bulan=="04"){
                var bulannya = 'April';
            }else if(bulan=="5" || bulan=="05"){
                var bulannya = 'May';
            }else if(bulan=="6" || bulan=="06"){
                var bulannya = 'June';
            }else if(bulan=="7" || bulan=="07"){
                var bulannya = 'July';
            }else if(bulan=="8" || bulan=="08"){
                var bulannya = 'August';
            }else if(bulan=="9" || bulan=="09"){
                var bulannya = 'September';
            }else if(bulan=="10" || bulan=="10"){
                var bulannya = 'October';
            }else if(bulan=="11" || bulan=="11"){
                var bulannya = 'November';
            }else{
                var bulannya = 'December';
            }

            var newdate = bulannya+' '+tanggal[0]+', '+tahun+' - '+tanggal[1];

            var value_discount = coupon_discount.replace(/\./g,'');
            value_discount = parseInt(value_discount,10);

            if(coupon_type=='go'){
              coupon_typenya = "GO";
            }
            if(coupon_type=='ph'){
              coupon_typenya = "Rp";
            }
            if(coupon_type=='ps'){
              coupon_typenya = "%";
              if(value_discount>100){
                  $.alert({
                      title: '',
                      content: 'Maaf, Potongan harga % hanya 1-100. Silahkan update potongan harga anda.',
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
            }
            
            $('.popup-title img').show();
            $('#response_success').html('');
            var data_nya = [
                coupon_type,
                coupon_name,
                coupon_code,
                value_discount,
                coupon_start,
                coupon_expired,
                coupon_status
            ];
            var data = {
                "action": "myaction_save_coupon",
                "datanya": data_nya
            };
            jQuery.post(ajaxurl, data, function(response) {
                

                var datane = response.split("_");
                var resp = datane[0];
                var idcoupon = datane[1];
                
                if(resp=='success'){
                    $("#coupon_name").val('');
                    $("#coupon_code").val('');
                    $("#coupon_discount").val('');
                    $("#coupon_start").val('');
                    $("#coupon_expired").val('');
                    $("#coupon_status").val('0');
                    $('#field_status .dashicons.dashicons-flag').removeClass('flag_red');
                    $('#field_status .dashicons.dashicons-flag').removeClass('flag_green');


                    var box = '<div id="coupon_'+idcoupon+'" class="box-coupon content"><span id="couponcode_'+idcoupon+'">'+coupon_code+'</span><br><span id="typeexpired_'+idcoupon+'" style="font-size:11px;font-weight:300;">'+coupon_typenya+discountnya+' / '+newdate+' </span><div class="box-action"><a href="#modal_coupon2" rel="modal:open" style="text-decoration: none;"><span class="dashicons dashicons-edit edit_coupon" title="Edit Coupon" data-id="'+idcoupon+'"></span></a><span class="dashicons dashicons-trash delete_coupon" title="Delete Coupon" data-id="'+idcoupon+'"></span></div><div id="status_'+idcoupon+'" class="circle-status '+active+'" title="'+title_active+'"><div class="scrap"></div></div></div>';
                    $('.one').append(box);
                    $('.popup-title img').hide();
                    $('#response_success').show();
                    $('#response_success').html('<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;color: #2EC26A;margin-left:-10px;"><span class="dashicons dashicons-yes" style="margin-right: 5px; font-size: 25px;"></span>Save Coupon Success!</span>').delay(5000).fadeOut();;
                }else{
                  $('.popup-title img').hide();
                  $('#response_success').show();
                  $('#response_success').html('<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;color: #D12F2F;margin-left:-10px;"><span class="dashicons dashicons-no-alt" style="margin-right: 5px; font-size: 25px;"></span>Duplicate Coupon Code!</span>').delay(5000).fadeOut();;
                }
            });            
            
        });

        
        function testDecimals(currentVal) {
            var count;
            currentVal.match(/\./g) === null ? count = 0 : count = currentVal.match(/\./g);
            return count;
        }

        function replaceCommas(yourNumber) {
            
            var components = yourNumber.toString().split(",");
            if (components.length === 1) 
                components[0] = yourNumber;
            components[0] = components[0].replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            if (components.length === 2)
                components[1] = components[1].replace(/\D/g, "");
            return components.join(".");
         
        }

        $(document).on("keyup", "input.discount", function(event) {
            if (event.which >= 37 && event.which <= 40) {
                event.preventDefault();
            }

            var currentVal = $(this).val();
            var testDecimal = testDecimals(currentVal);
            if (testDecimal.length > 1) {
                console.log("You cannot enter more than one decimal point");
                currentVal = currentVal.slice(0, -1);
            }
            $(this).val(replaceCommas(currentVal));

        });


        
      
    });
    </script>
    <?php
}