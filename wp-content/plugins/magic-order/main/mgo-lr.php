<?php

function magic_order_lr() {
    mgo_global_vars();
    $expired = $GLOBALS['mgovars']['expired'];
    $date_expired = $GLOBALS['mgovars']['date_expired'];
    $plugin_name = $GLOBALS['mgovars']['plugin_name'];
    $plugin_version = $GLOBALS['mgovars']['plugin_version'];
    $plugin_license = $GLOBALS['mgovars']['plugin_license'];
    $plugin_license_info = $GLOBALS['mgovars']['plugin_license_info'];
    $apikey = $GLOBALS['mgovars']['apikey'];
    $apikey_status = $GLOBALS['mgovars']['apikey_status'];
    
?>
<link rel="stylesheet" type="text/css" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/datatables/datatables.min.css"/>
<link type="text/css" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/style-admin.css?ver=<?php echo $plugin_version; ?>" rel="stylesheet" />
    <style>
        a::link { color: blue; }          /* Unvisited links */
a::visited { color: purple; }     /* Visited links */
a::hover { color: yellow; }  /* Hovered links */
a::active { color: red !important; } 

    button.btn_mgo.btn_purple.btn_line {
        box-shadow: 0px 5px 5px 0 rgba(0,0,0,.1) !important;
    }
    button.btn_mgo.btn_purple, button.btn_mgo.btn_gray {
        box-shadow: 0px 5px 5px 0 rgba(0,0,0,.2) !important;
    }
    .btn-update {
        float: right;
    }
    .jconfirm.jconfirm-light .jconfirm-box-container .jconfirm-box {
        width: 460px !important;
    }
    canvas#chart3 {
        width: 90% !important;
        height: 420px !important;
        margin-left: 10px !important;
    }
    table caption {
        padding: .5em 0;
    }

    table.dataTable th,
    table.dataTable td {
      white-space: nowrap;
    }
    th { font-size: 14px; }
    td { font-size: 13px; }
    th:last-child, td:last-child {text-align:center;}
    .dt-buttons.btn-group {
        position: absolute;
        right: 0;
        margin-right: 65px;
        margin-top: -60px;
    }
    button.buttons-excel, button.buttons-copy {
        font-size: 13px;
    }
    button.buttons-excel {
        background: #36B459;
        color: #ffffff;
        border: 1px solid #27AE60;
        font-size: 13px;
    }
    button.buttons-excel:hover {
        background: #2CAF23;
        border: 1px solid #27AE60;
    }
    label {
        font-size: 14px;
    }
    .jconfirm.jconfirm-light .jconfirm-bg {
        background-color: slategray !important;
        opacity: .2 !important;
    }
    .show_link2 {
        font-size: 13px !important;
        padding: 0px 5px !important;
        margin-bottom: 10px;
    }
    .show_link2 .dashicons {
        font-size: 12px;
        padding-top: 3px;
    }
    #dataorders_info {
        font-size: 12px;
    }
    #dataorders_paginate {
        font-size: 14px;
    }
    #dataorders_filter {
        position: absolute;
        right: 0;
        margin-right: 65px;
    }
    thead tr {
    }
    .order_status {
        font-size: 12px;
        padding:4px 10px;
        background: #5A6268;
        color: #FFF;
        -webkit-border-radius: 4px;
                border-radius: 4px;
    }
    a.link_on_table {
        text-decoration: none;
        /*color: #9245B1;*/
    }
    a.link_on_table .dashicons {
        font-size: 16px;
        margin-top: 2px;
        margin-right: 2px;
    }
    a.btn-send-wa {
        color:#1EAD3A;
    }
    a.btn-send-wa.red{
        color:#AC1B33;
    }
    a.btn-send-wa img {
        margin-right: 3px;
        margin-top: -3px;
    }
    .modal-header, .modal-body, .modal-footer {
        padding-left:1.7rem;
        padding-right:1.7rem;
    }
    .modal-body {
        padding-top: 1.7rem;
    }
    .delete_order, .delete_wa {
        color: #EB3B5A;
        cursor: pointer;
    }
    .delete_wa:hover, .delete_order:hover{
        color: #D31534;
    }
    .dashicons.spin {
       animation: dashicons-spin 1s infinite;
       animation-timing-function: linear;
    }
    .dt-buttons.btn-group {
        display: none;
    }
    #dataorders_filter {
        display: inline;
    }
    input[type="text"] {
        font-size: 13px;
        border: 1px solid #cbccd2;
    }
    input.form-control {
        height: 35px;
    }
    .wp-core-ui select {
        border-color: #cbccd2;
    }
    .hasil_persen {
        text-align: right;
        color: #6c61f6 !important;
    }
    .showcase_text_area {
        text-align: right !important;
    }
    .link_priority {
        height: 35px;
    }
    .link_name {
        margin-bottom: 8px;
    }
    .btn.btn-outline-primary.btn_red_line {
        padding-top: 4px;
    }
    .add_link .dashicons {
        font-size: 13px;padding-top: 8px;margin-left: -5px;
    }
    .mx-auto {
        margin-bottom: 60px;
    }

    @keyframes dashicons-spin {
       0% {
          transform: rotate( 0deg );
       }
       100% {
          transform: rotate( 360deg );
       }
    }
    
    @media only screen and (max-width:760px) {
        .modal-backdrop {
            display:none;
        }
        a .button {
            margin-right:-10px !important;
        }
        .dt-buttons.btn-group, .dataTables_filter {
            width: auto !important;
            margin-right:65px !important;
        }
        .dataTables_length {
            padding-top:45px;
        }
        .dataTables_length, .dataTables_info {
            text-align:left !important;
        }
        .button .dashicons.dashicons-admin-generic {
            margin-top:0 !important;
        }
    }

    @media only screen and (max-width:480px) {
        #exampleModalLongTitle {
            font-size: 14px;
            padding-left: 2px;
        }
        .modal-header.title-1{
            padding-left: 10px !important;
        }
        .modal-header.title-2{
            padding-left: 40px !important;
        }
        #dataorders_filter label{
            font-size:0px !important;
        }
    }
    

    </style>
    

    <div class="wrap plugin_info"><h2 class="title" style="display: none;"></h2></div>

        <?php
        global $wpdb;
        $table_name = $wpdb->prefix . "mgo_gf_entry_values";
        $table_name2 = $wpdb->prefix . "mgo_lr";
        $table_name3 = $wpdb->prefix . "mgo_lr_log";
        $table_name4 = $wpdb->prefix . "mgo_settings";

        $table_name5 = $wpdb->prefix . "cf_forms";
        $table_name6 = $wpdb->prefix . "mgo_settings";

        // GET GENERAL SETTINGS
        // $query = $wpdb->get_results("SELECT * FROM $table_name where gf_custom_class='mgo_orderid' ");
        $query2 = $wpdb->get_results("SELECT * FROM $table_name2 order by id ASC ");
        $query = $wpdb->get_results('SELECT data from '.$table_name4.' where type="l_rotator" ORDER BY id ASC');
        $l_rotator = $query[0]->data;

        // Get User ROLES
        $cap = get_user_meta( wp_get_current_user()->ID, $wpdb->get_blog_prefix() . 'capabilities', true );
        $roles = array_keys((array)$cap);
        $role = $roles[0];

        ?>

        <div class="wrap" style="box-shadow: 0 4px 25px 0 rgba(0,0,0,.1);border-radius: 4px;">
        <div class="sub-title" style="padding-bottom: 40px;margin-top: 18px;">
            <header class="mgo-header" style="margin-top: 52px;">
                <h1 class="mgo-logo"><img class="icon-title2" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/magic-order-icon2.png"></h1>
            </header> 
            <?php

            if($apikey=='' || $apikey_status!='valid'){
                echo '
                <style>.sub-title-info{margin-top:30px;}</style>
                <div class="sub-title-info"><span>API Key tidak valid atau belum tersedia, silahkan update API Key anda. <a href="'.site_url().'/wp-admin/admin.php?page=magic_order_api" style="text-decoration: none;">[ Update ]</a></span></div>';
                return false;
            }

            if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
                echo '
                <style>.sub-title-info{margin-top:30px;}</style>
                <div class="sub-title-info"><span>Plugin Caldera Forms belum terinstall, silahkan install terlebih dahulu! <a href="'.site_url().'/wp-admin/plugin-install.php?s=caldera+forms&tab=search&type=term" style="text-decoration: none;">[ INSTALL ]</a></span></div>
                ';
                return false;
            }

            if($expired!='allowed'){
                echo '
                <style>.sub-title-info{margin-top:30px;}</style>
                <div class="sub-title-info"><span>Maaf, plugin anda Expired. <a href="https://member.sinkronus.com" style="text-decoration: none;">[ Extend Now ]</a></span></div>
                ';
                return false;
            }

            // CUSTOMER SERVICES (EDITOR ROLE)
            if($role!='administrator'){
                echo '
                <style>.sub-title-info{margin-top:30px;}</style>
                <div class="sub-title-info"><span>This menu is only for administrator!</span></div>
                </div>';
                return false;
            }

            if($plugin_license=='FREEMIUM' || $plugin_license=='STARTER' || $plugin_license=='BASIC'){
                // echo $plugin_license_info;
                echo '
                <style>.sub-title-info{margin-top:30px;}</style>
                <div class="sub-title-info"><span>Maaf, Hanya untuk License PRO.</span></div>
                </div>';
                return false;
            }

        ?>

            <?php if(isset($_GET['opt'])){ ?>

            <?php }else{ ?>
            <!-- Button Home page link rotator  -->
            <div style="position: absolute;right: 0;margin-right: 65px;">
                <button id="" class="button btn_mgo btn_purple btn_line edit_global" style=""  ><span class="dashicons dashicons-edit"></span>Edit Global URL</button>
                <a href="<?php echo admin_url('admin.php?page=magic_order_lr&opt=add') ?>"><button id="" class="button btn_mgo btn_purple" style=""  ><span class="dashicons dashicons-plus"></span>Add New</button></a>
            </div>
            <!-- End Button page link rotator  -->
            <?php } ?>
        </div>


        <div class="wrap-container" style="padding:45px 30px;margin-top: -80px;padding-bottom: 100px;">
            <?php if(isset($_GET['opt'])){

                if($_GET['opt']=="edit"){ ?>

                <?php

                if($_GET['data']!=null){
                  $id = $_GET['data'];
                  // return true;
                  // echo 1;
                  if(is_numeric($_GET['data'])){
                      $query3 = $wpdb->get_results('SELECT * from '.$table_name2.' where id="'.$id.'"');
                      $lr_name = $query3[0]->lr_name;
                      $lr_code = $query3[0]->lr_code;
                      $lr_link = $query3[0]->lr_link;
                      $lr_priority =  json_decode($query3[0]->lr_priority);
                  }else{
                    $newURL = admin_url('admin.php?page=magic_order_lr');
                    header("Location: $newURL");
                    exit();
                  }

                }else{
                  // return false;
                  // echo '<h3>No Data.</h3>';
                  $newURL = admin_url('admin.php?page=magic_order_lr');
                  header("Location: $newURL");
                  exit();
                }

                ?>

                <hr style="visibility: hidden;">
                <div class="page-content-wrapper">
                    <div class="page-content-wrapper-inner">
                      <div class="content-viewport">

                        <div class="row">
                          <div class="col-md-12 equel-grid">

                            <div class="grid" style="margin-top: -80px;">
                              <div class="grid-body">
                                <div class="item-wrapper">
                                  <div class="row mb-3">
                                    <div class="col-md-9 mx-auto">
                                      
                                      <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                        </div>
                                        <div class="col-md-7 showcase_content_area">
                                            <h3 class="grid-header" style="font-size: 21px;margin-bottom: 30px;color: #4a4957;">Edit Link Rotator</h3>
                                        </div>
                                      </div>
                                      <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                          <label for="inputType1">Link Rotator Name</label>
                                        </div>
                                        <div class="col-md-7 showcase_content_area">
                                          <input type="text" class="form-control" id="input_name" value="<?php echo $lr_name; ?>">
                                        </div>
                                      </div>
                                      
                                      <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                          <label for="inputType1">Link Code</label>
                                        </div>
                                        <div class="col-md-7 showcase_content_area">
                                          <input type="text" class="form-control" id="input_link_code" value="<?php echo $lr_code; ?>" placeholder="Misal: xyz atau link-pesanan-anda">
                                        </div>
                                      </div>
                                      
                                      <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                          <label for="inputType1">Link Rotator</label>
                                        </div>
                                        <div class="col-md-9 showcase_content_area">
                                          <p style="color: #4d8af0;padding-top: 3px;"><?php echo get_site_url().'/'.$l_rotator.'/';?><span id="link_code"><?php echo $lr_code; ?></span></p>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group row showcase_row_area div_link">
                                        <!-- link -->
                                        <div class="col-md-3 showcase_text_area">
                                          <label for="inputType1">Link</label>
                                        </div>
                                        <div class="col-md-9 showcase_content_area">
                                          <p style="font-size: 12px;color: #acacac;padding-top: 3px;">Silahkan tambahkan link yang akan dirotasi pada kolom dibawah</p>
                                        </div>
                                        <!-- end link -->

                                        <?php

                                        $fields = json_decode($lr_link, true);

                                        if(!empty($fields))
                                        {
                                            // // get total 
                                            $x = 0;
                                            $total_priority = 0;
                                            foreach ($fields as $key => $value ) {
                                                $y = "link_$x";
                                                $angka_priority = $lr_priority->$y;
                                                $total_priority = $total_priority + $angka_priority;
                                                $x++;
                                            }


                                            $i = 0;
                                            $len = count($fields);
                                            foreach ($fields as $key => $value ) {

                                              $a = "link_$i";
                                              $angka_priority = $lr_priority->$a;

                                              $persen_priority = ($angka_priority/$total_priority)*100;

                                              ?>

                                              <!-- link -->
                                              <?php $rand_id = GenerateID(3);?>
                                              <div class="col-md-3 showcase_text_area <?php echo $rand_id; ?>">
                                                <div class="hasil_persen persen_<?php echo $rand_id; ?>" data-id="<?php echo $rand_id; ?>" style="font-size: 11px;padding-top: 11px;color: #F04D82; font-weight:bold;"><?php echo number_format($persen_priority, 1, '.', '');?>%</div>
                                              </div>
                                              <div class="col-md-3 showcase_content_area <?php echo $rand_id; ?>" style="margin-top: 5px;padding-right:0px;">
                                                <input type="text" class="form-control link_name" value="<?php echo $key; ?>" placeholder="Link name" title="Nama Link">
                                              </div>
                                              <div class="col-md-4 showcase_content_area <?php echo $rand_id; ?>" style="margin-top: 5px;">
                                                <input type="text" class="form-control link_destination" value="<?php echo $value; ?>" placeholder="Paste your link" title="Link Tujuan">
                                              </div>
                                              <div class="col-md-1 showcase_content_area <?php echo $rand_id; ?>" style="margin-top: 5px;padding-left:0;">
                                                <select class="custom-select link_priority" onclick="run_persen()" title="Priority">
                                                  <?php
                                                    for($c=1; $c <= 10; $c++) {
                                                        $selected = '';
                                                        if($c==$angka_priority){
                                                          $selected = 'selected';
                                                        }
                                                        echo '<option data-id="'.$rand_id.'" value="'.$c.'" '.$selected.'>'.$c.'</option>';
                                                    }
                                                  ?>
                                                </select>
                                              </div>
                                              <div class="col-md-1 showcase_content_area <?php echo $rand_id; ?>" style="margin-top: 5px;">
                                                <div class="btn btn-outline-primary btn_red_line" title="Hapus Link" onclick="del('<?php echo $rand_id; ?>')" style="height: 35px;">-</div>
                                              </div>
                                              <!-- end link -->


                                              <?php
                                                $i++;
                                            }
                                        }

                                        ?>
                                       
                                      </div>
                                      
                                      

                                      <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                          <label for="inputType1"></label>
                                        </div>
                                        <div class="col-md-9 showcase_content_area">
                                          <button type="button" class="button btn_mgo btn_regular add_link" style="height: 35px;margin-top: -10px;margin-bottom:5px;"><span class="dashicons dashicons-plus"></span>Add Link</button>
                                        </div>
                                      </div>

                                      <hr style="margin-top: 30px;">

                                      <div class="form-group row showcase_row_area" style="margin-top: 20px;">
                                        <div class="col-md-3 showcase_text_area">
                                          <label for="inputType1"></label>
                                        </div>
                                        <div class="col-md-9 showcase_content_area">
                                           <a href="<?php echo admin_url('admin.php?page=magic_order_lr'); ?>"><button class="button btn_mgo btn_gray" data-id="<?php echo $id; ?>">BACK</button></a>
                                           <button id="update_link" class="button btn_mgo btn_purple" data-id="<?php echo $id; ?>">UPDATE LINK</button>
                                           <span id="success_info2"></span>
                                        </div>
                                      </div>

                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>


                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- content viewport ends -->
                </div>

                <!-- end edit  -->


              
              <?php }elseif($_GET['opt']=="add"){ ?>

                
                <hr style="visibility: hidden;">
                <div class="page-content-wrapper">
                    <div class="page-content-wrapper-inner">
                      <div class="content-viewport">

                        <div class="row">
                          <div class="col-md-12 equel-grid">


                            <div class="grid" style="margin-top: -80px;">
                              <div class="grid-body">
                                <div class="item-wrapper">
                                  <div class="row mb-3">
                                    <div class="col-md-9 mx-auto">

                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                        </div>
                                        <div class="col-md-7 showcase_content_area">
                                            <h3 class="grid-header" style="font-size: 21px;margin-bottom: 30px;color: #4a4957;">Add New Link Rotator</h3>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                          <label for="inputType1">Link Rotator Name</label>
                                        </div>
                                        <div class="col-md-7 showcase_content_area">
                                          <input type="text" class="form-control" id="input_name" value="">
                                        </div>
                                      </div>
                                      
                                      <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                          <label for="inputType1">Link Code</label>
                                        </div>
                                        <div class="col-md-7 showcase_content_area">
                                          <input type="text" class="form-control" id="input_link_code" value="" placeholder="Misal: xyz atau link-pesanan-anda">
                                        </div>
                                      </div>
                                      
                                      <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                          <label for="inputType1">Link Rotator</label>
                                        </div>
                                        <div class="col-md-9 showcase_content_area">
                                          <p style="color: #4d8af0;padding-top: 3px;"><?php echo get_site_url().'/'.$l_rotator.'/';?><span id="link_code"></span></p>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group row showcase_row_area div_link">
                                        <!-- link -->
                                        <div class="col-md-3 showcase_text_area">
                                          <label for="inputType1">Link</label>
                                        </div>
                                        <div class="col-md-9 showcase_content_area">
                                          <p style="font-size: 12px;color: #666;padding-top: 3px;">Silahkan tambahkan link yang akan dirotasi pada kolom dibawah</p>
                                        </div>
                                        <!-- end link -->
                                       
                                        <!-- link -->
                                        <?php $rand_id = GenerateID(3);?>
                                        <div class="col-md-3 showcase_text_area <?php echo $rand_id; ?>">
                                          <div class="hasil_persen persen_<?php echo $rand_id; ?>" data-id="<?php echo $rand_id; ?>" style="font-size: 11px;padding-top: 11px;color: #F04D82; font-weight:bold;">100%</div>
                                        </div>
                                        <div class="col-md-3 showcase_content_area <?php echo $rand_id; ?>" style="margin-top: 5px;padding-right: 0;">
                                          <input type="text" class="form-control link_name" value="" placeholder="Link name" title="Nama Link">
                                        </div>
                                        <div class="col-md-4 showcase_content_area <?php echo $rand_id; ?>" style="margin-top: 5px;">
                                          <input type="text" class="form-control link_destination" value="" placeholder="Paste your link" title="Link Tujuan">
                                        </div>
                                        <div class="col-md-1 showcase_content_area <?php echo $rand_id; ?>" style="margin-top: 5px;padding-left: 0px;">
                                          <select class="custom-select link_priority" onclick="run_persen()" title="Priority">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                          </select>
                                        </div>
                                        <div class="col-md-1 showcase_content_area <?php echo $rand_id; ?>" style="margin-top: 5px;">
                                          <div class="btn btn-outline-primary btn_red_line" title="Hapus Link" onclick="del('<?php echo $rand_id; ?>')" style="height: 35px;">-</div>
                                        </div>
                                        <!-- end link -->

                                      </div>
                                      
                                      

                                      <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                          <label for="inputType1"></label>
                                        </div>
                                        <div class="col-md-9 showcase_content_area">
                                          <button type="button" class="button btn_mgo btn_regular add_link" style="height: 35px;margin-top: -10px;margin-bottom:5px;"><span class="dashicons dashicons-plus"></span>Add Link</button>
                                        </div>
                                      </div>
                                      <hr style="margin-top: 30px;">

                                      <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                          <label for="inputType1"></label>
                                        </div>
                                        <div class="col-md-9 showcase_content_area" style="margin-top: 20px;">
                                           <!-- <div class="btn btn-info btn-rounded" id="save_link">SAVE LINK</div> -->
                                           <a href="<?php echo admin_url('admin.php?page=magic_order_lr'); ?>"><button class="button btn_mgo btn_gray">Back</button></a>
                                           <button id="save_link" class="button btn_mgo btn_purple" data-id="<?php echo $id; ?>">ADD NEW LINK</button>
                                           <span id="success_info"></span>
                                        </div>
                                      </div>

                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>


                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- content viewport ends -->
                </div>

                <!-- end add  -->

                <!-- start statistic -->
              
              <?php }elseif($_GET['opt']=="statistic"){ ?>


                <!-- add here -->
                <!-- <div class="row">
                  <div class="col-md-6 order-md-1">
                    <div class="row" style="padding-left: 15px;padding-top: 10px;">
                      <div class="col-md-12" style="text-align: left;padding-top: 5px;color: #4b4b4b;">
                        <span><p style="font-size: 18px;"><a href="<?php echo admin_url('admin.php?page=magic_order_lr') ?>">Link Rotator </a> > Statistic</p></span>
                      </div>
                    </div>
                  </div>
                </div> -->
                <hr style="visibility: hidden;">

                <?php

                if(isset($_GET['id'])){

                  $id = $_GET['id'];
                  // return true;
                  // echo 1;
                  if(is_numeric($_GET['id'])){
                      $query3 = $wpdb->get_results('SELECT * from '.$table_name2.' where id="'.$id.'"');
                      $lr_name = $query3[0]->lr_name;
                      $lr_code = $query3[0]->lr_code;
                      $lr_link = $query3[0]->lr_link;
                      $lr_priority =  json_decode($query3[0]->lr_priority);
                  }

                  $full_link = "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

                  $active_link_today = '';
                  $active_link_all = '';
                  $active_link_date = '';
                  $title_stat = '';

                  if($_GET['filter']=='today'){
                    $active_link_today = 'style="background: #e4eefd;color: #4d8af0;"';
                    $active_link_all = '';
                    $active_link_date = '';
                    $title_stat = 'Today Statistic ';

                  }else if($_GET['filter']=='all'){
                    $active_link_today = '';
                    $active_link_all = 'style="background: #e4eefd;color: #4d8af0;"';
                    $active_link_date = '';
                    $title_stat = 'All Statistic ';
                  }else{
                    $active_link_today = '';
                    $active_link_all = '';
                    $active_link_date = 'style="background: #e4eefd;color: #4d8af0;"';
                    $title_stat = 'Date range ';
                  }

                 
                  
                { ?>

                  <div class="page-content-wrapper" style="margin-top: -120px;">
                    <div class="page-content-wrapper-inner">
                      <div class="content-viewport">

                        <div class="row">
                          <div class="col-md-12 equel-grid">

                            <div class="row">
                                <div class="col-md-12" style="margin-top: 40px;">
                                    <div class="panel panel-white">
                                        <div class="col-md-12 showcase_content_area">
                                            <h3 class="grid-header" style="font-size: 21px;margin-bottom: 30px;color: #4a4957;margin-left: 10px;"><a href="<?php echo admin_url('admin.php?page=magic_order_lr') ?>">Link Rotator </a> > <?php echo $title_stat; ?></h3><br>

                                            <div style="position: absolute;right: 0;margin-top: -75px;margin-right: 50px;">
                                                <select id="change_statistic" style="font-size: 12px;padding-top: 2px;">
                                                    <option value="1" <?php if($_GET['filter']=='today'){ echo 'selected';}?>>Today Statistic</option>
                                                    <option value="2" <?php if($_GET['filter']=='all'){ echo 'selected';}?>>All Statistic</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="panel-body" style="">
                                            <div>
                                                <canvas id="chart3" height="150" style="margin-left: -40px;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                             
                            </div>


                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- content viewport ends -->
                </div> <!-- page-content-wrapper ends -->

                <?php }
          
                }else{
                  echo '
                  <div class="page-content-wrapper">
                      <div class="page-content-wrapper-inner">
                        <div class="content-viewport">

                          <div class="row">
                            <div class="col-md-12 equel-grid">


                              <div class="grid">
                                <div class="grid-body">
                                  <div class="item-wrapper">
                                    <div class="row mb-3">
                                      <div class="col-md-5 mx-auto">

                                        <div class="alert alert-primary" role="alert" style="margin-top:30px;text-align:left;padding-left:30px;padding-bottom:30px;">
                                          <h6 class="alert-heading">Sorry!</h6>
                                          <p>Your ID Statistic not Found. Please back to Link Rotator Dashboard.</p>
                                          <a href="'.admin_url('admin.php?page=magic_order_lr').'"><button class="btn btn-dismmiss btn-primary ml-auto"><< Back</button></a>
                                        </div>

                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>


                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- content viewport ends -->
                    </div> <!-- page-content-wrapper ends -->
                ';
                  return false;
                }

                ?>

                

                <!-- end statistic  -->

              <?php }else{ ?>
                
                <!-- Your code here... -->

                
              <?php } ?> <!-- end else here -->

            <?php }else{ ?>

                <!-- Link Rotator  -->
                <div class="table-responsive"> 
                    <table id="dataorders" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr class="solid-header">
                                <th>No</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Link Rotator</th>
                                <th>Data Link</th>
                                <th>Statistic</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no = 1;
                        foreach ($query2 as $row) {

                              $linknya = json_decode($row->lr_link, true);
                              $isi_link = '';

                              if(!empty($linknya)){
                                  foreach ($linknya as $key => $value ) {
                                    $isi_link .= $key.' : <a href="'.$value.'" target="_blank">'.$value.'</a><br>';
                                  }
                              }

                              $link_rotator = get_site_url().'/'.$l_rotator.'/'.$row->lr_code;


                        ?>
                            <tr id="link_<?php echo $no;?>">
                                <td><?php echo $no; ?></td>
                                <td><?php echo $row->lr_name; ?></td>
                                <td><?php echo $row->lr_code; ?></td>
                                <td>
                                <a href="<?php echo $link_rotator;?>" target="_blank" style="font-size: 11px;"><?php echo get_site_url().'/<span class="global_code_url" style="display: inherit;">'.$l_rotator.'</span>/'.$row->lr_code;?></a>
                                </td>
                                <td><span id="<?php echo $no;?>" data-id="<?php echo $no;?>" type="button" class="btn btn-link btn-xs has-icon show_link2" style="padding: 0;font-size: 13px;"><i class="mdi mdi-link"></i>View Link</span><br><div id="link2_<?php echo $no;?>" style="display:none;font-size: 11px;"><?php echo $isi_link;?></div></td>
                                <td>
                                <a href="<?php echo admin_url('admin.php?page=magic_order_lr').'&opt=statistic&id='.$row->id; ?>&filter=today" target="_parent" style="font-size: 11px;">
                                <span id="<?php echo $row->id;?>" data-id="<?php echo $row->id;?>" type="button" class="btn btn-link btn-xs has-icon" style="padding: 0;font-size: 13px;"><i class="mdi mdi-chart-line"></i>View Statistic</span>
                                </a>
                                </td>
                                <td style="color:#ababab;">
                                    <a href="<?php echo admin_url('admin.php?page=magic_order_lr'); ?>&opt=edit&data=<?php echo $row->id;?>">
                                    <button type="button" class="button btn_mgo btn_regular">Edit</button></a>
                                    <button type="button" class="button btn_mgo btn_regular red_color delete_link" data-id="<?php echo $row->id;?>" data-no="<?php echo $no;?>">Delete</button>
                                    <!--
                                    <a href="<?php echo admin_url('admin.php?page=magic_order_lr'); ?>&opt=edit&data=<?php echo $row->id;?>"><div class="btn btn-info btn-xs has-icon"><i class="mdi mdi-pencil"></i>Edit</div></a> | 
                                    <div class="btn btn-warning btn-xs has-icon delete_link" data-id="<?php echo $row->id;?>" data-no="<?php echo $no;?>"><i class="mdi mdi-delete"></i>Delete</div>
                                    -->

                                </td>
                            </tr>
                        <?php
                            $no++;
                        }
                        ?>
                            
                        </tbody>
                    </table>
                </div>
                <!-- end link rotator -->

            <?php } ?>
            
        </div>
        <!-- Modal -->
        <div class="modal fade" id="ModalUpdateStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="top:45px;">
              <div class="modal-header title-1" style="background: #007BFF;color: #fff;border-bottom: 0;padding: 1rem 1.7rem 0.1rem 1.7rem;">
                <h5 class="modal-title" id="exampleModalLongTitle"><span class="dashicons dashicons-tag" style="padding-top: 5px; margin-right: 5px;"></span> Order ID: <span id="orderid"></span></h5><Br>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#ffffff;">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-header title-2" style="background: #007BFF;color: #fff;border-radius: 0; padding: 0.1rem 1.7rem 1.1rem 3.7rem">
                <p class="modal-title">Form: <span id="formid"></span></p>
              </div>
              <div class="modal-body">
                <div id="content_order" style="margin-bottom: 10px;padding-top: 10px;"></div>
              </div>
              <div class="modal-footer">
                &nbsp;<div id="loading_status"></div>
              </div>
            </div>
          </div>
        </div> 
        <!-- end modal -->
    </div>
<?php
    date_default_timezone_set('Asia/Jakarta');
    $now = date("Y-m-d H:i:s");
    $datenya = date("F j, Y - ",strtotime($now)).date("H:i",strtotime($now));
?>
<script type='text/javascript' src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/jquery-2.1.1.min.js?ver=<?php echo $plugin_version; ?>"></script>
<script type="text/javascript" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/datatables/datatables.min.js?ver=<?php echo $plugin_version; ?>"></script>
<link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/confirm/jquery-confirm.min.css?ver=<?php echo $plugin_version; ?>">
<script src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/confirm/jquery-confirm.min.js?ver=<?php echo $plugin_version; ?>"></script>


<!-- statistic  -->

<?php 

    if(isset($_GET['opt'])){
      if($_GET['opt']=="statistic"){ 

        $fields = json_decode($lr_link, true);

        if(!empty($fields))
        {

            // SET TODAY - 7 HOURS
            $today_now_start = date("Y-m-d 00:01");
            $time_start = strtotime($today_now_start);
            $date_start = strtotime('-7 hours', $time_start);
            $today_now_start = date("Y-m-d 00:01");
            $filter_datestart_today = date('Y-m-d H:i', $date_start);

            // SET TODAY MIDNIGNHT
            $today_now_end = date("Y-m-d 23:59:59");


            // // get total 
            // $x = 0;
            // $total_priority = 0;
            // foreach ($fields as $key => $value ) {
            //     $y = "link_$x";
            //     $angka_priority = $lr_priority->$y;
            //     $total_priority = $total_priority + $angka_priority;
            //     $x++;
            // }

            $i = 0;
            $len = count($fields);
            $data_link_name = "";
            $data_stat = "";
            foreach ($fields as $key => $value ) {

              // $a = "link_$i";
              // $angka_priority = $lr_priority->$a;

              // $persen_priority = ($angka_priority/$total_priority)*100;
              // $key

              if($_GET['filter']=='today'){
                // Today
                $jumlah_log = $wpdb->get_results('SELECT * from '.$table_name3.' where link="'.$value.'" AND created_at BETWEEN "'.$filter_datestart_today.'" AND "'.$today_now_end.'"');
              }else if($_GET['filter']=='all'){
                // Total
                $jumlah_log = $wpdb->get_results('SELECT * from '.$table_name3.' where link="'.$value.'"');
              }else{
                // Soon
                $jumlah_log = $wpdb->get_results('SELECT * from '.$table_name3.' where link="'.$value.'" AND created_at BETWEEN "'.$filter_datestart_today.'" AND "'.$today_now_end.'"');
              }

              $jumlah_log = count($jumlah_log);
              
              $data_link_name .= '"'.$key.'"';
              $data_stat .= $jumlah_log;
              if ($i == $len - 1) {
              }else{
                $data_link_name .= ',';
                $data_stat .= ',';
              }
              $i++;

            }
        }

      ?>
    <script type='text/javascript' src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/chart/chart.min.js?ver=<?php echo $plugin_version; ?>"></script>

    <script>

        $( document ).ready(function() {
            
            var ctx3 = document.getElementById("chart3").getContext("2d");
            var data3 = {
                labels: [<?php echo $data_link_name; ?>],
                datasets: [
                    {
                        label: "My Second dataset",
                        fillColor: "rgba(34,186,160,0.5)",
                        strokeColor: "rgba(34,186,160,0.8)",
                        highlightFill: "rgba(34,186,160,0.75)",
                        highlightStroke: "rgba(34,186,160,1)",
                        data: [<?php echo $data_stat; ?>]
                    }
                ]
            };
            
            var chart3 = new Chart(ctx3).Bar(data3, {
                scaleBeginAtZero : true,
                scaleShowGridLines : true,
                scaleGridLineColor : "rgba(0,0,0,.05)",
                scaleGridLineWidth : 1,
                scaleShowHorizontalLines: true,
                scaleShowVerticalLines: true,
                barShowStroke : true,
                barStrokeWidth : 2,
                barDatasetSpacing : 1,
                legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
                responsive: true
            });

            $('#change_statistic').bind("change", function(e){
                var val = $(this).val();
                if(val==1){
                    window.open("<?php echo admin_url('admin.php?page=magic_order_lr') ?>&opt=<?php echo $_GET['opt']; ?>&id=<?php echo $_GET['id']; ?>&filter=today", '_self');
                }else{
                    window.open("<?php echo admin_url('admin.php?page=magic_order_lr') ?>&opt=<?php echo $_GET['opt']; ?>&id=<?php echo $_GET['id']; ?>&filter=all", '_self');
                }
                
            });
            
            
        });
        </script>

    <?php 
        } // end if statistic
    } // end opt get
?>



<!-- end statistic -->


    
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
          $('.'+a).remove();
          run_persen();
      }

      jQuery(document).ready(function($) {
          $('.show_link').bind('click', function(){
              if($(this).text()=='View Link'){
                  var idnya = $(this).data('id');
                  $(this).html('<span class="dashicons dashicons-admin-links"></span>Hide Link').addClass('btn-warning').removeClass('btn-link');
                  var linkid = 'link_'+idnya;
                  $('#'+linkid).show();
              }else{
                  var idnya = $(this).data('id');
                  $(this).html('View Link').addClass('btn-link').removeClass('btn-warning');
                  var linkid = 'link_'+idnya;
                  $('#'+linkid).hide();
              }
              
          });

          $('.show_link2').bind('click', function(){
              if($(this).text()=='View Link'){
                  var idnya = $(this).data('id');
                  $(this).html('<span class="dashicons dashicons-admin-links"></span>Hide Link').addClass('btn-warning').removeClass('btn-link');
                  var linkid = 'link2_'+idnya;
                  $('#'+linkid).show();
              }else{
                  var idnya = $(this).data('id');
                  $(this).html('View Link').addClass('btn-link').removeClass('btn-warning');
                  var linkid = 'link2_'+idnya;
                  $('#'+linkid).hide();
              }
              
          });

          $("#input_link_code").keyup(function(){
              // Getting the current value of textarea
              var currentText = $(this).val();
              // Setting the Div content
              $("#link_code").text(currentText);
          });

          $("#url_code").keyup(function(){
              var currentText = $(this).val();
              $("#global_url_code").text(currentText);
          });

          $(".save_global_url_code").bind('click', function(){
              $('.icon-loading-modal').show();
              var url_code = $('#url_code').val();
              var datanya = [
                      url_code
                  ];
                  
              var data = {
                  'action': 'myaction_save_l_rotator',
                  'datanya': datanya
              };

              jQuery.post(ajaxurl, data, function(response) {
                if(response=='success'){
                  $("#info-text").show();
                  $('.global_code_url').text(url_code);
                  $('.icon-loading-modal').hide();
                  window.location.reload();
                }
              });
          });


          $('.add_link').bind('click', function(){
              var idnya = generate();
              $('.div_link').append('<!-- link --><div class="col-md-3 showcase_text_area '+idnya+'"><div class="hasil_persen persen_'+idnya+'" data-id="'+idnya+'" style="font-size: 11px;padding-top: 11px;color: #F04D82; font-weight:bold;">%</div></div><div class="col-md-3 showcase_content_area '+idnya+'" style="margin-top: 5px;padding-right:0px;"><input type="text" class="form-control link_name" value="" placeholder="Link name"></div><div class="col-md-4 showcase_content_area '+idnya+'" style="margin-top: 5px;"><input type="text" class="form-control link_destination" value="" placeholder="Paste your link"></div><div class="col-md-1 showcase_content_area '+idnya+'" style="margin-top: 5px;padding-left:0px;"><select onclick="run_persen()" class="custom-select link_priority" title="Priority"><option data-id="'+idnya+'" value="1">1</option><option data-id="'+idnya+'" value="2">2</option><option data-id="'+idnya+'" value="3">3</option><option data-id="'+idnya+'" value="4">4</option><option data-id="'+idnya+'" value="5">5</option><option data-id="'+idnya+'" value="6">6</option><option data-id="'+idnya+'" value="7">7</option><option data-id="'+idnya+'" value="8">8</option><option data-id="'+idnya+'" value="9">9</option><option data-id="'+idnya+'" value="10">10</option></select></div><div class="col-md-1 showcase_content_area '+idnya+'" style="margin-top: 5px;"><div class="btn btn-outline-primary btn_red_line" style="height: 35px;" title="Hapus Link" onclick=del("'+idnya+'")>-</div></div><!-- end link -->');
              run_persen();
          });

          $( "#save_link" ).bind("click", function(e){

              

              var arr_link_name = $('input.link_name').map(function(){
                  return this.value;
              }).get().toString();

              var arr_link_destination = $('input.link_destination').map(function(){
                  return this.value;
              }).get().toString();

              var arr_link_priority = $('select.link_priority').map(function(){
                  return this.value;
              }).get().toString();

              var str1 = arr_link_name;
              var str1_array = str1.split(',');

              var str2 = arr_link_destination;
              var str2_array = str2.split(',');

              var str3 = arr_link_priority;
              var str3_array = str3.split(',');


              var hasil = '';
              var len = str1_array.length;
              for(var i = 0; i < str1_array.length; i++) {
                  
                  hasil += '"'+str1_array[i]+'":"'+str2_array[i]+'"';
                  if (i == len - 1) {
                  }else{
                      hasil += ',';
                  }
              }

              var hasil2 = '';
              var len2 = str3_array.length;
              for(var i = 0; i < str3_array.length; i++) {
                  
                  hasil2 += '"link_'+i+'":"'+str3_array[i]+'"';
                  if (i == len2 - 1) {
                  }else{
                      hasil2 += ',';
                  }
              }

              var lr_name = $('#input_name').val();
              var lr_code = $('#input_link_code').val();
              var lr_rotator = '{'+hasil+'}';
              var lr_priority = '{'+hasil2+'}';

              if(lr_name=='' || lr_code=='' || lr_rotator=='{"":""}'){
                $.alert('Tidak boleh kosong!');
                return false;
              }

              $("#success_info").html('<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Saving...</span>');

              var datanya = [
                      lr_name,
                      lr_code,
                      lr_rotator,
                      lr_priority
                  ];
                  
              var data = {
                  'action': 'myaction_save_lr',
                  'datanya': datanya
              };

              jQuery.post(ajaxurl, data, function(response) {
                if(response=='failed'){
                  $("#success_info").show();
                  $("#success_info").html('<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: red;">Failed! Link Code sudah terdaftar.</span>').fadeOut(5000);
                }else{
                  $('#input_name').val('');
                  $('#input_link_code').val('');
                  $('.link_name').val('');
                  $('.link_destination').val('');
                  $("#success_info").html(response);
                  window.location.reload();
                }
              });

          });

          

          /*
          $( ".link_priority" ).bind("change", function(e){

              var arr_link_priority = $('select.link_priority').map(function(){
                  return this.value;
              }).get().toString();

              var str3 = arr_link_priority;
              var str3_array = str3.split(',');

              total_priority = 0;
              var len2 = str3_array.length;
              for(var i = 0; i < str3_array.length; i++) {
                  nilai = parseFloat(str3_array[i]);
                  total_priority = total_priority+nilai;
              }


              var new_selected = [];
              $(".hasil_persen").each(function(){
                      new_selected.push($(this).data('id'));
              });
              new_selected = new_selected.toString();
              var array = new_selected.split(',');

              var arrayLength = array.length;
              for (var i = 0; i < arrayLength; i++) {
                  if(array[i]!=0){
                      // var runf = "auth_status_"+array[i]+"(1)";
                      // eval(runf);
                      id_ne = array[i];
                      var valuenya = $('.'+id_ne).find('option:selected').val();

                      hasil_persennya = (valuenya/total_priority)*100;
                      $('.persen_'+id_ne).text(hasil_persennya.toFixed(1)+'%')
                      console.log(id_ne);
                      console.log(valuenya);
                  }
              }

              // alert(total_priority);

          });
          */



          $( "#update_link" ).bind("click", function(e){

              var id_link = $(this).data('id');

              $("#success_info2").html('<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Saving...</span>');

              var arr_link_name = $('input.link_name').map(function(){
                  return this.value;
              }).get().toString();

              var arr_link_destination = $('input.link_destination').map(function(){
                  return this.value;
              }).get().toString();

              var arr_link_priority = $('select.link_priority').map(function(){
                  return this.value;
              }).get().toString();

              var str1 = arr_link_name;
              var str1_array = str1.split(',');

              var str2 = arr_link_destination;
              var str2_array = str2.split(',');

              var str3 = arr_link_priority;
              var str3_array = str3.split(',');


              var hasil = '';
              var len = str1_array.length;
              for(var i = 0; i < str1_array.length; i++) {
                  
                  hasil += '"'+str1_array[i]+'":"'+str2_array[i]+'"';
                  if (i == len - 1) {
                  }else{
                      hasil += ',';
                  }
              }

              var hasil2 = '';
              var len2 = str3_array.length;
              for(var i = 0; i < str3_array.length; i++) {
                  
                  hasil2 += '"link_'+i+'":"'+str3_array[i]+'"';
                  if (i == len2 - 1) {
                  }else{
                      hasil2 += ',';
                  }
              }

              var lr_name = $('#input_name').val();
              var lr_code = $('#input_link_code').val();
              var lr_rotator = '{'+hasil+'}';
              var lr_priority = '{'+hasil2+'}';

              var datanya = [
                      id_link,
                      lr_name,
                      lr_code,
                      lr_rotator,
                      lr_priority
                  ];
                  
              var data = {
                  'action': 'myaction_update_lr',
                  'datanya': datanya
              };

              jQuery.post(ajaxurl, data, function(response) {
                if(response=='failed'){
                  $("#success_info2").show();
                  $("#success_info2").html('<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: red;">Failed! Link Code sudah terdaftar.</span>').fadeOut(5000);
                }else{
                  $("#success_info2").html(response);
                  window.location.reload();
                }
              });
          });



          $( ".show_statistic" ).bind("click", function(e){
            // alert("Belum ready. Tinggal fungsi ini aja yang belum. Ntar dilanjut lagi, cepet kok.. ^_^ ");
            var idnya = $(this).data('id');
            alert(idnya);
          });


      });

    function run_persen(){
        
        var arr_link_priority = $('select.link_priority').map(function(){
            return this.value;
        }).get().toString();

        var str3 = arr_link_priority;
        var str3_array = str3.split(',');

        total_priority = 0;
        var len2 = str3_array.length;
        for(var i = 0; i < str3_array.length; i++) {
            nilai = parseFloat(str3_array[i]);
            total_priority = total_priority+nilai;
        }


        var new_selected = [];
        $(".hasil_persen").each(function(){
                new_selected.push($(this).data('id'));
        });
        new_selected = new_selected.toString();
        var array = new_selected.split(',');

        var arrayLength = array.length;
        for (var i = 0; i < arrayLength; i++) {
            if(array[i]!=0){
                // var runf = "auth_status_"+array[i]+"(1)";
                // eval(runf);
                id_ne = array[i];
                var valuenya = $('.'+id_ne).find('option:selected').val();

                hasil_persennya = (valuenya/total_priority)*100;
                $('.persen_'+id_ne).text(hasil_persennya.toFixed(1)+'%')
                console.log(id_ne);
                console.log(valuenya);
            }
        }
    }
    </script>
    <!-- endbuild -->



<script>
$(document).ready(function() {

    // $('.button.buttons-excel span').text('Download Excel');
    // document.title='WA NUMBER';
    $('#dataorders').DataTable(
        {   
            "dom": '<"dt-buttons"Bf><"clear">lirtp',
            "paging": true,
            "autoWidth": true,
            "responsive": true,
            "ordering": false,
            "buttons": [
                { extend: 'copyHtml5', text: 'Copy' },
                { extend: 'excelHtml5', text: 'Download Excel' }
            ]
        }
    );
    
    $('#dataorders_filter input').attr('placeholder', 'Search Order');

    // $( ".show_statistic" ).bind("click", function(e){
    //     // alert("Belum ready. Tinggal fungsi ini aja yang belum. Ntar dilanjut lagi, cepet kok.. ^_^ ");
    //     var idnya = $(this).data('id');
    //     alert(idnya);
    // });


    $( ".delete_link" ).bind("click", function(e){
        var id = $(this).data('id');
        var no = $(this).data('no');

        $.confirm({
            title: 'Hello',
            content: 'Apakah anda Yakin ingin Menghapus Link Rotator ini?',
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
                    text: "Yes, Delete",
                    btnClass: 'btn-danger',
                    keys: ['enter'],
                    action: function(e){
                        
                        $('.icon-loading').addClass('clicked').show();
                        var datanya = [
                            id
                        ];
                        var data = {
                            'action': 'myaction_delete_lr',
                            'datanya': datanya
                        };

                        jQuery.post(ajaxurl, data, function(response) {
                            if(response=='success'){
                                $('#link_'+no).remove();
                                $('.icon-loading').removeClass('clicked').hide();
                            }else{

                            }
                        });

                    }
                },
            }
        });   
        
    });


    $('.edit_global').on('click', function(){
        $.confirm({
            title: 'Global URL Rotator',
            content: '' +
                '<form action="" class="formName">' +
                '<div class="form-group">' +
                '<div><label style="margin-bottom:20px;color:#6C61F6;font-weight:bold;cursor:default;"><?php echo get_site_url().'/<span id="l_rotator">'.$l_rotator.'</span>/';?></label></div>' +
                '<label style="cursor:default;">Global URL Code</label>' +
                '<input value="<?php echo $l_rotator; ?>" id="global_code" type="text" placeholder="Your Global Code" class="data_global_url form-control" required />' +
                '</div>' +
                '</form>',
            buttons: {
                formSubmit: {
                    text: 'Update',
                    btnClass: 'btn-blue btn-update',
                    action: function(){
                        var data_global_url = this.$content.find('.data_global_url').val();
                        if(data_global_url.indexOf(' ') >= 0){
                            $.alert('Tidak boleh ada spasi!');
                            return false;
                        }
                        if(!data_global_url){
                            $.alert('Data tidak boleh kosong!');
                            return false;
                        }
                        // $.alert('Your name is ' + data_global_url);
                        //

                        var datanya = [
                            data_global_url
                        ];

                        var data = {
                            'action': 'myaction_save_l_rotator',
                            'datanya': datanya
                        };

                        jQuery.post(ajaxurl, data, function(response) {
                            if(response=='success'){
                                $.alert('Global Url telah diupdate menjadi:<br><b><?php echo get_site_url() ?>/' + data_global_url+'/</b>');
                                $('.global_code_url').text(data_global_url);
                            }else{
                                $.alert('Update Failed!');
                            }
                        });
                    }
                },
                cancel: function(){
                    //close
                },
            },
            onContentReady: function(){
                // you can bind to the form
                var jc = this;
                this.$content.find('form').on('submit', function(e){ // if the user submits the form by pressing enter in the field.
                    e.preventDefault();
                    jc.$$formSubmit.trigger('click'); // reference the button and click it
                });
            }
        });
    });

    $(document).on("keyup", "#global_code", function(e) {

        var code = $(this).val();
        $("#l_rotator").text(code);

    });



    
});
    


</script>
    <?php
}