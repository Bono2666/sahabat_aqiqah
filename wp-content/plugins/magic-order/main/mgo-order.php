<?php

function magic_order_data() {
    mgo_global_vars();
    $expired = $GLOBALS['mgovars']['expired'];
    $date_expired = $GLOBALS['mgovars']['date_expired'];
    $plugin_name = $GLOBALS['mgovars']['plugin_name'];
    $plugin_version = $GLOBALS['mgovars']['plugin_version'];
    $plugin_license = $GLOBALS['mgovars']['plugin_license'];
    $apikey = $GLOBALS['mgovars']['apikey'];
    $apikey_status = $GLOBALS['mgovars']['apikey_status'];

?>
<link rel="stylesheet" type="text/css" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/datatables/datatables.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/style-admin.css?ver=<?php echo $plugin_version; ?>" />

    <style>

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
    a.btn-send-wa img{
        margin-right: 3px;
        margin-top: -3px;
    }
    a.btn-send-wa-multiple1 img, a.btn-send-wa-multiple2 img, a.btn-send-wa-multiple3 img {
        margin-top: -3px;
    }
    a.btn-send-wa-multiple1.green, a.btn-send-wa-multiple2.green, a.btn-send-wa-multiple3.green {
        background: #36bd47;
        padding: 5px 8px 5px 5px;
        color: #ffffff;
        border-radius: 16px;
        font-weight: 300;
    }
    a.btn-send-wa-multiple1.red, a.btn-send-wa-multiple2.red, a.btn-send-wa-multiple3.red {
        background: #ac1c34;
        padding: 5px 8px 5px 5px;
        color: #ffffff;
        border-radius: 16px;
        font-weight: 300;
    }
    .modal-header, .modal-body, .modal-footer {
        padding-left:1.7rem;
        padding-right:1.7rem;
    }
    .modal-body {
        padding-top: 1.7rem;
    }
    .delete_order {
        color: #EB3B5A;
        cursor: pointer;
    }
    .delete_order:hover{
        color: #D31534;
    }
    .dashicons.spin {
       animation: dashicons-spin 1s infinite;
       animation-timing-function: linear;
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
    

     <div class="wrap">
    <h2 class="title"><img class="icon-title" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/magic-order-icon.png">
    <div class="main-title" style="margin-top: -25px;"><?php echo $plugin_name; ?><div style="font-size: 11px;margin-top: -10px;color:#A0C9D7;">Version <?php echo $plugin_version; ?></div></div></h2>
        
        <?php
        global $wpdb;
        $table_name = $wpdb->prefix . "cf_forms";
        $table_name3 = $wpdb->prefix . "mgo_settings";

        $plugin_status = $wpdb->get_results("SELECT * from $table_name3 where type='plugin_status'")[0];
        $table_field = $wpdb->get_results("SELECT data from $table_name3 where type='table_field'")[0];

        if($apikey=='' || $apikey_status!='valid'){
            echo '
            <div class="sub-title-info"><span>API Key tidak valid atau belum tersedia, silahkan update API Key anda. <a href="'.site_url().'/wp-admin/admin.php?page=magic_order_api" style="text-decoration: none;">[ Update ]</a></span></div>
            <div class="wrap-container" style="padding: 15px 30px;">
            </div>';
            return false;
        }
        $limit = '';
        if($plugin_status->data=='Freemium' || $plugin_status->data=='freemium' || $plugin_status->data=='FREEMIUM'){
            $limit = 'LIMIT 100';
        }

        if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
            echo '
            <div class="sub-title-info"><span>Plugin Caldera Forms belum terinstall, silahkan install terlebih dahulu! <a href="'.site_url().'/wp-admin/plugin-install.php?s=caldera+forms&tab=search&type=term" style="text-decoration: none;">[ INSTALL ]</a></span></div>
            <div class="wrap-container" style="padding: 15px 30px;">
            </div>';
            return false;
        }

        if($expired!='allowed'){
            echo '
            <div class="sub-title-info"><span>Maaf, plugin anda Expired. <a href="https://member.sinkronus.com" style="text-decoration: none;">[ Extend Now ]</a></span></div>
            <div class="wrap-container" style="padding: 15px 30px;">
            </div>';
            return false;
        }
        
        $table_name4 = $wpdb->prefix . "cf_form_entry_values";
        $table_name5 = $wpdb->prefix . "cf_form_entries";
        $table_name6 = $wpdb->prefix . "mgo_orders";
        $table_name7 = $wpdb->prefix . "mgo_order_statuses";
        $table_name8 = $wpdb->prefix . "users";
        $table_name9 = $wpdb->prefix . "mgo_phone";

        // DEFAULT
        // $rows_entry = $wpdb->get_results("SELECT * from $table_name4 LEFT JOIN $table_name5 ON $table_name4.entry_id = $table_name5.id where slug='mgo_orderid' or slug='mgo_orderid2' ORDER BY $table_name4.entry_id DESC $limit");

        // GROUP BY VALUE
        $rows_entry = $wpdb->get_results("SELECT * from $table_name4 LEFT JOIN $table_name5 ON $table_name4.entry_id = $table_name5.id where slug='mgo_orderid' or slug='mgo_orderid2' GROUP BY value,form_id ORDER BY $table_name4.entry_id DESC $limit");

        $statuses = $wpdb->get_results("SELECT * from $table_name7");

        // Get User ROLES
        $cap = get_user_meta( wp_get_current_user()->ID, $wpdb->get_blog_prefix() . 'capabilities', true );
        $roles = array_keys((array)$cap);
        $role = $roles[0];


        $query_settings = $wpdb->get_results('SELECT data from '.$table_name3.' where type="order_refresh_page" or type="order_refresh_second" ORDER BY id ASC');
        $order_refresh_page = $query_settings[0]->data;
        $order_refresh_second = $query_settings[1]->data;

        // Statistics

        // all
        // $rows_entry2 = $wpdb->get_results("SELECT * from $table_name4
        //     LEFT JOIN $table_name5 ON $table_name4.entry_id = $table_name5.id
        //     where slug='mgo_orderid' and form_id='CF5a97dc6d09c49' ORDER BY $table_name4.entry_id DESC $limit");

        // per user
        /*
        $rows_entry2 = $wpdb->get_results("SELECT * from $table_name4
            LEFT JOIN $table_name5 ON $table_name4.entry_id = $table_name5.id
            where slug='mgo_csid' and form_id='CF5a97dc6d09c49' and value='2' ORDER BY $table_name4.entry_id DESC $limit");
            */

        ?>
        <div class="sub-title" style="padding-bottom: 40px;margin-top: 18px;">
            <span>Data Orders <?php // $plugin_license="VIP"; echo $plugin_license; ?><?php 
            if($role!='administrator'){
                echo ' - '.wp_get_current_user()->display_name;
            }else{
                echo ' - Administrator ';
            }
            
            $array_table = explode(',', $table_field->data);
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

            ?>    
            </span>
            <div style="position: absolute;font-size: 15px;margin-top: 38px;display: none;" id="statusinfo"></div>
            <a href="<?php echo admin_url('admin.php?page=magic_order_data_settings') ?>">
            <span class="button" style="float: right;border: none;background: none;box-shadow: none;margin-right: 7px;"><span class="dashicons dashicons-admin-generic" style="margin-top: 5px;margin-right: 3px;font-size: 16px;"></span>Settings</span>
            </a>
        </div>
        <div class="wrap-container" style="padding:45px 30px;">
            <div class="table-responsive"> 
            <table id="dataorders" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th <?php if($no_show==0){echo 'style="display: none;"'; }?>>No</th>
                        <th <?php if($name_show==0){echo 'style="display: none;"'; }?>>Name</th>
                        <th <?php if($nama_produk_show==0){echo 'style="display: none;"'; }?>>Product</th>
                        <th <?php if($form_show==0){echo 'style="display: none;"'; }?>>Form ID</th>
                        <th <?php if($orderid_show==0){echo 'style="display: none;"'; }?>>Order ID</th>
                        <th <?php if($cs_show==0){echo 'style="display: none;"'; }?>>CS</th>
                        <th <?php if($kupon_show==0){echo 'style="display: none;"'; }?>>Coupon</th>
                        <?php if($plugin_license=="VIP"){
                        echo '<th style="display: none;">Alamat</th>';
                        echo '<th style="display: none;">Kecamatan</th>';
                        echo '<th>Ongkir</th>';
                        echo '<th>COD</th>';
                        echo '<th>Confirmation</th>';
                        echo '<th style="display: none;">Phone Confirmation</th>';
                        }?>
                        <th <?php if($total_show==0){echo 'style="display: none;"'; }?>>Total Price</th>
                        <th <?php if($date_show==0){echo 'style="display: none;"'; }?>>Date Order</th>
                        <th <?php if($detail_show==0){echo 'style="display: none;"'; }?>>Detail</th>
                        <th <?php if($wa_show==0){echo 'style="display: none;"'; }?>>Followup</th>
                        <th <?php if($multiple_wa_show==0){echo 'style="display: none;"'; }?>>Multiple Followup</th>
                        <th <?php if($status_show==0){echo 'style="display: none;"'; }?>>Status</th>
                        <th <?php if($action_show==0){echo 'style="display: none;"'; }?>>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // print_r(json_encode($rows_entry));

                    $no = 1;
                    foreach ($rows_entry as $row) {
                        // echo $row->form_id.' '.$row->entry_id.' '.$row->field_id.' '.$row->slug.' '.$row->value.'<br>';
                        
                        // Total Price
                        $gettotal = $wpdb->get_results("SELECT * from $table_name4 where entry_id=$row->entry_id and slug='mgo_total' ");
                        if($gettotal==null){
                            $totalnya = '-';
                        }else{
                            $totalnya = $gettotal[0]->value;
                        }

                        // Nama Customer
                        $get_name = $wpdb->get_results("SELECT * from $table_name4 where entry_id=$row->entry_id and slug='mgo_nama' ");
                        if($get_name==null){
                            $customer_name = '-';
                        }else{
                            $customer_name = $get_name[0]->value;
                        }

                        // Nama Produk
                        $get_nama_produk = $wpdb->get_results("SELECT * from $table_name4 where entry_id=$row->entry_id and slug='mgo_nama_produk' ");
                        if($get_nama_produk==null){
                            $nama_produk = '-';
                        }else{
                            $nama_produk = $get_nama_produk[0]->value;
                        }

                        // Status
                        $get_status = $wpdb->get_results("SELECT a.*, b.nama_status, b.color  from $table_name6 a LEFT JOIN $table_name7 b ON a.status_id = b.id where order_id='$row->value' and status_id!=0 ORDER BY id DESC LIMIT 1 ");
                        if($get_status==null){
                            $status = '-';
                            $color = '#999';
                        }else{
                            if($get_status[0]->nama_status==null){
                                $status = '-';
                                $color = '#999';
                            }else{
                                $status = $get_status[0]->nama_status;
                                $color = $get_status[0]->color;
                            }
                        }

                        // Followup
                        $get_followup = $wpdb->get_results("SELECT status_id from $table_name6 where order_id='$row->value' and status_id=0 ORDER BY status_id ASC LIMIT 1");
                        $get_followup2 = $wpdb->get_results("SELECT status_id from $table_name6 where order_id='$row->value' and status_id=22 ORDER BY status_id ASC LIMIT 1");
                        $get_followup3 = $wpdb->get_results("SELECT status_id from $table_name6 where order_id='$row->value' and status_id=33 ORDER BY status_id ASC LIMIT 1");

                        $followup_1=0;
                        $followup_2=0;
                        $followup_3=0;

                        if(isset($get_followup[0]->status_id)){
                            if($get_followup[0]->status_id==0){
                                $followup_1 = 1;
                            }
                        }
                        if(isset($get_followup2[0]->status_id)){
                            if($get_followup2[0]->status_id==22){
                                $followup_2 = 1;
                            }
                        }
                        if(isset($get_followup3[0]->status_id)){
                            if($get_followup3[0]->status_id==33){
                                $followup_3 = 1;
                            }
                        }


                        if($followup_1==0){
                            $wa_info_multiple1='red';
                            $wa_title1 = 'Belum di Followup';
                        }else{
                            $wa_info_multiple1='green';
                            $wa_title1 = 'Sudah di Followup';
                        }

                        if($followup_2==0){
                            $wa_info_multiple2='red';
                            $wa_title2 = 'Belum di Followup';
                        }else{
                            $wa_info_multiple2='green';
                            $wa_title2 = 'Sudah di Followup';
                        }

                        if($followup_3==0){
                            $wa_info_multiple3='red';
                            $wa_title3 = 'Belum di Followup';
                        }else{
                            $wa_info_multiple3='green';
                            $wa_title3 = 'Sudah di Followup';
                        }

                        // print_r($get_followup);
                        // return false;
                        if($get_followup==null){
                            $wa_info = 'red';
                            $wa_icon = 'wa_red.png';
                            $wa_title = 'Belum di Followup';
                        }else{
                            $wa_info = '';
                            $wa_icon = 'wa.png';
                            $wa_title = 'Sudah di Followup';
                        }


                        // GET CS
                        // 1. Get mgo_cs id
                        $get_cs = $wpdb->get_results("SELECT * from $table_name4 where entry_id=$row->entry_id and slug='mgo_csid' ");
                        if($get_cs==null){
                            $cs_name = '-';
                        }else{
                            // 2. Get Name CS
                            $id_cs = $get_cs[0]->value;
                            if (is_numeric($id_cs)){
                                // $get_name = $wpdb->get_results("SELECT * from $table_name8 where ID=$id_cs ");
                                $args2 = array( 'blog_id' => 0, 'search' => $id_cs, 'search_columns' => array( 'ID' ) );
                                $get_name = get_users( $args2 );

                                if($get_name==null){
                                    $cs_name = '-';
                                }else{
                                    $cs_name = $get_name[0]->display_name; // nama asli
                                    // $cs_name = $get_name[0]->user_login; // username
                                }
                            } else {
                                $cs_name = '-';
                            } 
                            
                        }

                        // Kode Kupon
                        $getkupon = $wpdb->get_results("SELECT * from $table_name4 where entry_id=$row->entry_id and slug='mgo_kupon' ");
                        if($getkupon==null){
                            $kode_kupon = '-';
                        }else{
                            if($getkupon[0]->value==''){
                                $kode_kupon = '-';
                            }else{
                                $kode_kupon = $getkupon[0]->value;
                            }
                        }

                        date_default_timezone_set('GMT');
                        //set an date and time to work with
                        $start = $row->datestamp;

                        //display the converted time
                        $time_now = date('Y-m-d H:i:s',strtotime('+7 hour',strtotime($start)));

                        // CUSTOMER SERVICES (EDITOR ROLE)
                        if($role!='administrator'){
                            $id_login = wp_get_current_user()->ID;
                            if($id_login==$id_cs && $get_cs!=null) {

                            ?>
                            <tr id="order_<?php echo $row->value; ?>">
                                <td <?php if($no_show==0){echo 'style="display: none;"'; }?>><?php echo $no; ?></td>
                                <td <?php if($name_show==0){echo 'style="display: none;"'; }?>><?php echo $customer_name; ?></td>
                                <td <?php if($nama_produk_show==0){echo 'style="display: none;"'; }?>><?php echo $nama_produk; ?></td>
                                <td <?php if($form_show==0){echo 'style="display: none;"'; }?>><?php echo $row->form_id; ?></td>
                                <td <?php if($orderid_show==0){echo 'style="display: none;"'; }?>><?php echo $row->value; ?></td>
                                <td <?php if($cs_show==0){echo 'style="display: none;"'; }?>><?php echo $cs_name; ?></td>
                                <td <?php if($kupon_show==0){echo 'style="display: none;"'; }?>><?php echo $kode_kupon; ?></td>
                                <?php if($plugin_license=="VIP"){
                                    // COD / Non COD
                                    $get_ongkir = $wpdb->get_results("SELECT * from $table_name4 where entry_id=$row->entry_id and slug='mgo_ongkir' ");
                                    $get_alamat = $wpdb->get_results("SELECT * from $table_name4 where entry_id=$row->entry_id and slug='mgo_alamat' ");
                                    $get_kecamatan = $wpdb->get_results("SELECT * from $table_name4 where entry_id=$row->entry_id and slug='mgo_kecamatan' ");
                                    $get_confirm = $wpdb->get_results("SELECT * from $table_name9 where orderid='$row->value' ");
                                    
                                    $codnon = '-';
                                    $harga_ongkir = '-';
                                    $alamat = '-';
                                    $kecamatan = '-';
                                    $confirm = '-';
                                    $phone = '-';
                                    
                                    if($get_ongkir!=null){
                                        $codnon = $get_ongkir[0]->value;
                                        if (strpos($codnon, 'COD') !== false) {
                                            $codnon = 'COD';
                                            $harga_ongkir_data = explode("Rp ", $get_ongkir[0]->value);
                                            $harga_ongkir = "Rp".$harga_ongkir_data[1];
                                        }elseif (strpos($codnon, 'Estimasi harga') !== false) {
                                            $codnon = 'Non';
                                            $harga_ongkir_data = explode("Rp ", $get_ongkir[0]->value);
                                            $harga_ongkir = "Rp".$harga_ongkir_data[1];
                                        }else{
                                            $codnon = '-';
                                        }
                                    }

                                    if($get_alamat!=null){
                                        $alamat = $get_alamat[0]->value;
                                    }
                                    if($get_kecamatan!=null){
                                        $kecamatan = $get_kecamatan[0]->value;
                                    }

                                    if($get_confirm!=null){
                                        if($get_confirm[0]->status==1){
                                            $confirm = 'Confirmed';
                                        }
                                        $phone = $get_confirm[0]->phone;
                                    }

                                echo '<td style="display: none;">'.$alamat.'</td>';
                                echo '<td style="display: none;">'.$kecamatan.'</td>';
                                echo '<td>'.$harga_ongkir.'</td>';
                                echo '<td>'.$codnon.'</td>';
                                echo '<td>'.$confirm.'</td>';
                                echo '<td style="display: none;">'.$phone.'</td>';
                                }?>
                                <td <?php if($total_show==0){echo 'style="display: none;"'; }?>><?php echo $totalnya; ?></td>
                                <td <?php if($date_show==0){echo 'style="display: none;"'; }?>><?php echo date("F j, Y - ",strtotime($time_now)).date("H:i ",strtotime($time_now)); ?></td>
                                <td <?php if($detail_show==0){echo 'style="display: none;"'; }?>>
                                    <a href="javascript:;" class="link_on_table btn-detail-order" data-id="<?php echo $row->value; ?>" data-formid="<?php echo $row->form_id; ?>" data-entryid="<?php echo $row->entry_id; ?>" data-toggle="modal" data-target="#ModalUpdateStatus">
                                        <span class="dashicons dashicons-format-aside"></span>Detail</a>
                                </td>
                                <td <?php if($wa_show==0){echo 'style="display: none;"'; }?>>
                                    <a href="javascript:;" data-no="<?php echo $no;?>" id="wa_<?php echo $row->value; ?>" data-id="<?php echo $row->value; ?>" data-entryid="<?php echo $row->entry_id; ?>" class="link_on_table btn-send-wa <?php echo $wa_info; ?>" title="<?php echo $wa_title; ?>">
                                    <span id="icon_<?php echo $no;?>" class="dashicons dashicons-update spin" style="font-size: 21px;margin-top: 0px;width: 21px;display: none;"></span>
                                    <img id="img_<?php echo $no;?>" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/<?php echo $wa_icon; ?>" />Send WA</a>
                                </td>
                                <td <?php if($multiple_wa_show==0){echo 'style="display: none;padding-top: 13px;"'; }?>>
                                    <a href="javascript:;" data-no="<?php echo $no;?>" id="wa_<?php echo $row->value; ?>_1" data-id="<?php echo $row->value; ?>" data-entryid="<?php echo $row->entry_id; ?>" class="link_on_table btn-send-wa-multiple1 <?php echo $wa_info_multiple1; ?>" title="<?php echo $wa_title1; ?>">
                                    <span id="icon_<?php echo $no;?>_1" class="dashicons dashicons-update spin" style="font-size: 21px;margin-top: 0px;width: 21px;margin-right:0;display: none;"></span>
                                    <img id="img_<?php echo $no;?>_1" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/wa_24_<?php echo $wa_info_multiple1; ?>.png" style="width:20px;margin-right:0px; margin-left: 2px;" />1</a>

                                     <a href="javascript:;" data-no="<?php echo $no;?>" id="wa_<?php echo $row->value; ?>_2" data-id="<?php echo $row->value; ?>" data-entryid="<?php echo $row->entry_id; ?>" class="link_on_table btn-send-wa-multiple2 <?php echo $wa_info_multiple2; ?>" title="<?php echo $wa_title2; ?>">
                                    <span id="icon_<?php echo $no;?>_2" class="dashicons dashicons-update spin" style="font-size: 21px;margin-top: 0px;width: 21px;margin-right:0;display: none;"></span>
                                    <img id="img_<?php echo $no;?>_2" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/wa_24_<?php echo $wa_info_multiple2; ?>.png" style="width:20px;margin-right:0px; margin-left: 2px;" />2</a>

                                     <a href="javascript:;" data-no="<?php echo $no;?>" id="wa_<?php echo $row->value; ?>_3" data-id="<?php echo $row->value; ?>" data-entryid="<?php echo $row->entry_id; ?>" class="link_on_table btn-send-wa-multiple3 <?php echo $wa_info_multiple3; ?>" title="<?php echo $wa_title3; ?>">
                                    <span id="icon_<?php echo $no;?>_3" class="dashicons dashicons-update spin" style="font-size: 21px;margin-top: 0px;width: 21px;margin-right:0;display: none;"></span>
                                    <img id="img_<?php echo $no;?>_3" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/wa_24_<?php echo $wa_info_multiple3; ?>.png" style="width:20px;margin-right:0px; margin-left: 2px;" />3</a>
                                </td>
                                <td <?php if($status_show==0){echo 'style="display: none;"'; }?>><span id="status_<?php echo $row->value; ?>" class="order_status" style="text-transform:capitalize;background-color:<?php echo $color;?>"><?php echo $status; ?></span></td>
                                <td <?php if($action_show==0){echo 'style="display: none;"'; }?>>
                                    <a href="javascript:;" class="link_on_table update_status" data-id="<?php echo $row->value; ?>" data-toggle="modal" data-target="#ModalUpdateStatus" data-formid="<?php echo $row->form_id; ?>">
                                        <span class="dashicons dashicons-welcome-write-blog" title="Update Order Status"></span>
                                    </a> | <span data-orderid="<?php echo $row->value; ?>" data-entryid="<?php echo $row->entry_id; ?>" class="dashicons dashicons-trash delete_order" title="Delete Order"></span></td>
                            </tr>

                            <?php $no++; 
                            } // close if tags if($id_login==$id_cs && $get_cs!=null)
                        } 
                        // ADMINISTRATOR ROLE
                        else {
                            ?>
                            <tr id="order_<?php echo $row->value; ?>">
                                <td <?php if($no_show==0){echo 'style="display: none;"'; }?>><?php echo $no; ?></td>
                                <td <?php if($name_show==0){echo 'style="display: none;"'; }?>><?php echo $customer_name; ?></td>
                                <td <?php if($nama_produk_show==0){echo 'style="display: none;"'; }?>><?php echo $nama_produk; ?></td>
                                <td <?php if($form_show==0){echo 'style="display: none;"'; }?>><?php echo $row->form_id; ?></td>
                                <td <?php if($orderid_show==0){echo 'style="display: none;"'; }?>><?php echo $row->value; ?></td>
                                <td <?php if($cs_show==0){echo 'style="display: none;"'; }?>><?php echo $cs_name; ?></td>
                                <td <?php if($kupon_show==0){echo 'style="display: none;"'; }?>><?php echo $kode_kupon; ?></td>
                                <?php if($plugin_license=="VIP"){
                                    // COD / Non COD
                                    $get_ongkir = $wpdb->get_results("SELECT * from $table_name4 where entry_id=$row->entry_id and slug='mgo_ongkir' ");
                                    $get_alamat = $wpdb->get_results("SELECT * from $table_name4 where entry_id=$row->entry_id and slug='mgo_alamat' ");
                                    $get_kecamatan = $wpdb->get_results("SELECT * from $table_name4 where entry_id=$row->entry_id and slug='mgo_kecamatan' ");
                                    $get_confirm = $wpdb->get_results("SELECT * from $table_name9 where orderid='$row->value' ");
                                    
                                    $codnon = '-';
                                    $harga_ongkir = '-';
                                    $alamat = '-';
                                    $kecamatan = '-';
                                    $confirm = '-';
                                    $phone = '-';
                                    
                                    if($get_ongkir!=null){
                                        $codnon = $get_ongkir[0]->value;
                                        if (strpos($codnon, 'COD') !== false) {
                                            $codnon = 'COD';
                                            $harga_ongkir_data = explode("Rp ", $get_ongkir[0]->value);
                                            $harga_ongkir = "Rp".$harga_ongkir_data[1];
                                        }elseif (strpos($codnon, 'Estimasi harga') !== false) {
                                            $codnon = 'Non';
                                            $harga_ongkir_data = explode("Rp ", $get_ongkir[0]->value);
                                            $harga_ongkir = "Rp".$harga_ongkir_data[1];
                                        }else{
                                            $codnon = '-';
                                        }
                                    }

                                    if($get_alamat!=null){
                                        $alamat = $get_alamat[0]->value;
                                    }
                                    if($get_kecamatan!=null){
                                        $kecamatan = $get_kecamatan[0]->value;
                                    }

                                    if($get_confirm!=null){
                                        if($get_confirm[0]->status==1){
                                            $confirm = 'Confirmed';
                                        }
                                        $phone = $get_confirm[0]->phone;
                                    }

                                echo '<td style="display: none;">'.$alamat.'</td>';
                                echo '<td style="display: none;">'.$kecamatan.'</td>';
                                echo '<td>'.$harga_ongkir.'</td>';
                                echo '<td>'.$codnon.'</td>';
                                echo '<td>'.$confirm.'</td>';
                                echo '<td style="display: none;">'.$phone.'</td>';
                                }?>
                                <td <?php if($total_show==0){echo 'style="display: none;"'; }?>><?php echo $totalnya; ?></td>
                                <td <?php if($date_show==0){echo 'style="display: none;"'; }?>><?php echo date("F j, Y - ",strtotime($time_now)).date("H:i ",strtotime($time_now)); ?></td>
                                <td <?php if($detail_show==0){echo 'style="display: none;"'; }?>>
                                    <a href="javascript:;" class="link_on_table btn-detail-order" data-id="<?php echo $row->value; ?>" data-formid="<?php echo $row->form_id; ?>" data-entryid="<?php echo $row->entry_id; ?>" data-toggle="modal" data-target="#ModalUpdateStatus">
                                        <span class="dashicons dashicons-format-aside"></span>Detail</a>
                                </td>
                                <td <?php if($wa_show==0){echo 'style="display: none;"'; }?>>
                                    <a href="javascript:;" data-no="<?php echo $no;?>" id="wa_<?php echo $row->value; ?>" data-id="<?php echo $row->value; ?>" data-entryid="<?php echo $row->entry_id; ?>" class="link_on_table btn-send-wa <?php echo $wa_info; ?>" title="<?php echo $wa_title; ?>">
                                    <span id="icon_<?php echo $no;?>" class="dashicons dashicons-update spin" style="font-size: 21px;margin-top: 0px;width: 21px;display: none;"></span>
                                    <img id="img_<?php echo $no;?>" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/<?php echo $wa_icon; ?>" />Send WA</a>
                                </td>
                                <td <?php if($multiple_wa_show==0){echo 'style="display: none;padding-top: 13px;"'; }?>>
                                    <a href="javascript:;" data-no="<?php echo $no;?>" id="wa_<?php echo $row->value; ?>_1" data-id="<?php echo $row->value; ?>" data-entryid="<?php echo $row->entry_id; ?>" class="link_on_table btn-send-wa-multiple1 <?php echo $wa_info_multiple1; ?>" title="<?php echo $wa_title1; ?>">
                                    <span id="icon_<?php echo $no;?>_1" class="dashicons dashicons-update spin" style="font-size: 21px;margin-top: 0px;width: 21px;margin-right:0;display: none;"></span>
                                    <img id="img_<?php echo $no;?>_1" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/wa_24_<?php echo $wa_info_multiple1; ?>.png" style="width:20px;margin-right:0px; margin-left: 2px;" />1</a>

                                     <a href="javascript:;" data-no="<?php echo $no;?>" id="wa_<?php echo $row->value; ?>_2" data-id="<?php echo $row->value; ?>" data-entryid="<?php echo $row->entry_id; ?>" class="link_on_table btn-send-wa-multiple2 <?php echo $wa_info_multiple2; ?>" title="<?php echo $wa_title2; ?>">
                                    <span id="icon_<?php echo $no;?>_2" class="dashicons dashicons-update spin" style="font-size: 21px;margin-top: 0px;width: 21px;margin-right:0;display: none;"></span>
                                    <img id="img_<?php echo $no;?>_2" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/wa_24_<?php echo $wa_info_multiple2; ?>.png" style="width:20px;margin-right:0px; margin-left: 2px;" />2</a>

                                     <a href="javascript:;" data-no="<?php echo $no;?>" id="wa_<?php echo $row->value; ?>_3" data-id="<?php echo $row->value; ?>" data-entryid="<?php echo $row->entry_id; ?>" class="link_on_table btn-send-wa-multiple3 <?php echo $wa_info_multiple3; ?>" title="<?php echo $wa_title3; ?>">
                                    <span id="icon_<?php echo $no;?>_3" class="dashicons dashicons-update spin" style="font-size: 21px;margin-top: 0px;width: 21px;margin-right:0;display: none;"></span>
                                    <img id="img_<?php echo $no;?>_3" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/wa_24_<?php echo $wa_info_multiple3; ?>.png" style="width:20px;margin-right:0px; margin-left: 2px;" />3</a>
                                </td>
                                <td <?php if($status_show==0){echo 'style="display: none;"'; }?>><span id="status_<?php echo $row->value; ?>" class="order_status" style="text-transform:capitalize;background-color:<?php echo $color;?>"><?php echo $status; ?></span></td>
                                <td <?php if($action_show==0){echo 'style="display: none;"'; }?>>
                                    <a href="javascript:;" class="link_on_table update_status" data-id="<?php echo $row->value; ?>" data-toggle="modal" data-target="#ModalUpdateStatus" data-formid="<?php echo $row->form_id; ?>">
                                        <span class="dashicons dashicons-welcome-write-blog" title="Update Order Status"></span>
                                    </a> | <span data-orderid="<?php echo $row->value; ?>" data-entryid="<?php echo $row->entry_id; ?>" class="dashicons dashicons-trash delete_order" title="Delete Order"></span></td>
                            </tr>
                            <?php $no++;
                        }
                    }
                ?>
                </tbody>
            </table>
            </div>
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

<script>
    $(document).ready(function() {
    <?php
    $order_refresh_second = $order_refresh_second*1000;
    if($order_refresh_page==1){
        echo "
            setTimeout(function() {
              location.reload();
            }, ".$order_refresh_second.");
        ";
    }
    ?>

    });

</script>

<script>
$(document).ready(function() {
        
        $('.button.buttons-excel span').text('Download Excel');
        document.title='Data Orders';
        $('#dataorders').DataTable(
            {   
                "dom": '<"dt-buttons"Bf><"clear">lirtp',
                "paging": true,
                "autoWidth": true,
                "responsive": true,
                "buttons": [
                    { extend: 'copyHtml5', text: 'Copy' },
                    { extend: 'excelHtml5', text: 'Download Excel' }
                ]
            }
        );

        function formatDate(date) {
            var monthNames = [
                "January", "February", "March",
                "April", "May", "June", "July",
                "August", "September", "October",
                "November", "December"
            ];

            var day = date.getDate();
            var monthIndex = date.getMonth();
            var year = date.getFullYear();

            return day + ' ' + monthNames[monthIndex] + ' ' + year;
        }
        
        $('#dataorders_filter input').attr('placeholder', 'Search Order');
        
    });

    $(document).on("click", ".update_status", function() {
        var orderid = $(this).attr('data-id');
        $('#orderid').text(orderid);
        var formid = $(this).attr('data-formid');
        $('#formid').text(formid);
        $('#update_status_order').attr('data-id', orderid);
        $('#content_order').text('Loading...');
        var data_nya = [
            orderid
        ];
        var data = {
            'action': 'myaction_get_order_status',
            'datanya': data_nya
        };
        jQuery.post(ajaxurl, data, function(response) {
            $('#content_order').html(response);
        });
    });
    

    $('.delete_order').on('click', function () {
        var entry_id = $(this).attr("data-entryid");
        var order_id = $(this).attr('data-orderid');
        
        $.confirm({
            title: 'Hello',
            content: 'Are you sure want to Delete this order?',
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
                        
                        $("#statusinfo").html('<p style="color: #343434">Loading...</p>').show();
                        
                        var data_nya = [
                            entry_id
                        ];
                        var data = {
                            "action": "myaction_delete_order",
                            "datanya": data_nya
                        };
                        jQuery.post(ajaxurl, data, function(response) {
                            if(response=="success"){
                                $("#order_"+order_id).hide();
                                $("#statusinfo").html('<p style="color: #20BF6B">Delete order success!</p>').show().delay(2000).fadeOut();
                            }
                        });

                    }
                },
            }
        });
    });


    $(document).on("click", ".btn-delete-status", function() {
        var numItems = $(".list-group-item.show_status").length;
        var id_on_orders = $(this).attr("data-id");

        var urutan_div = $(this).attr("data-urutandiv");
        var idnya = "status_"+id_on_orders;

        var hasil = urutan_div-numItems;
        if(hasil<0){
            $.alert({
                title: '',
                content: '<b>Sorry,</b> Delete the last status first!',
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
            title: 'Hello',
            content: 'Are you sure want to Delete this order?',
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
                            id_on_orders
                        ];
                        var data = {
                            "action": "myaction_delete_order_status",
                            "datanya": data_nya
                        };
                        $("#loading_status").html("Loading...").show();
                        jQuery.post(ajaxurl, data, function(response) {
                            if(response=="success"){
                                $("#loading_status").html('<span style="color:#20BF6B;">Delete Status Success!</span>').delay(3000).fadeOut();
                            
                                var valuenya = "option[value="+urutan_div+"]";
                                console.log(valuenya);
                                $("#"+idnya).addClass("hidden_status").removeClass("show_status");
                                $("#statusnya "+valuenya).attr("disabled", false);

                                var textnya = $(".list-group-item.show_status:last").attr("data-textnya");
                                var colornya = $(".list-group-item.show_status:last").attr("data-colornya");
                                var orderidnya = $("#orderid").text();
                                if (typeof textnya == "undefined") {
                                    $("#status_"+orderidnya).html("-");
                                    $("#status_"+orderidnya).css( "background-color", "#999" );
                                }else{
                                    $("#status_"+orderidnya).text(textnya);
                                    $("#status_"+orderidnya).css( "background-color", colornya );
                                }
                            }
                        });
                        
                    }
                },
            }
        });
    });

    $(document).on("click", ".btn-detail-order", function() {
        var orderid = $(this).attr('data-id');
        $('#orderid').text(orderid);
        var formid = $(this).attr('data-formid');
        $('#formid').text(formid);
        var entry_id = $(this).attr("data-entryid");
        $('#content_order').text('Loading...');

        var data_nya = [
            entry_id
        ];
        var data = {
            "action": "myaction_show_detail_order",
            "datanya": data_nya
        };
        
        jQuery.post(ajaxurl, data, function(response) {
            $('#content_order').html(response);
        });
    });


    $(document).on("click", ".btn-send-wa", function() {
        var entry_id = $(this).attr("data-entryid");
        var no = $(this).attr("data-no");
        var btn_id = $(this).attr("data-id");
        var orderid = $(this).attr("data-id");

        $("#img_"+no).hide();
        $("#icon_"+no).show();

        var data_nya = [
            entry_id,
            orderid
        ];
        var data = {
            "action": "myaction_send_wa",
            "datanya": data_nya
        };
        
        jQuery.post(ajaxurl, data, function(response) {
            // single
            $("#img_"+no).show();
            $("#icon_"+no).hide();
            $("#wa_"+btn_id).removeClass("red");
            $("#img_"+no).attr("src","<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/wa.png");
            // multiple
            $("#img_"+no+"_1").show();
            $("#icon_"+no+"_1").hide();
            $("#wa_"+btn_id+"_1").removeClass("red").addClass("green");
            $("#img_"+no+"_1").attr("src","<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/wa_24_green.png");
            var redirectWindow = window.open(response, "_blank");
            redirectWindow.location;
        });
    });

    $(document).on("click", ".btn-send-wa-multiple1", function() {
        var entry_id = $(this).attr("data-entryid");
        var no = $(this).attr("data-no");
        var btn_id = $(this).attr("data-id");
        var orderid = $(this).attr("data-id");

        $("#img_"+no+"_1").hide();
        $("#icon_"+no+"_1").show();

        var data_nya = [
            entry_id,
            orderid
        ];
        var data = {
            "action": "myaction_send_wa",
            "datanya": data_nya
        };
        
        jQuery.post(ajaxurl, data, function(response) {
            // single
            $("#img_"+no).show();
            $("#icon_"+no).hide();
            $("#wa_"+btn_id).removeClass("red");
            $("#img_"+no).attr("src","<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/wa.png");
            // multiple
            $("#img_"+no+"_1").show();
            $("#icon_"+no+"_1").hide();
            $("#wa_"+btn_id+"_1").removeClass("red").addClass("green");
            $("#img_"+no+"_1").attr("src","<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/wa_24_green.png");
            var redirectWindow = window.open(response, "_blank");
            redirectWindow.location;
        });

    });

    $(document).on("click", ".btn-send-wa-multiple2", function() {
       
        var entry_id = $(this).attr("data-entryid");
        var no = $(this).attr("data-no");
        var btn_id = $(this).attr("data-id");
        var orderid = $(this).attr("data-id");

        var id_wa_1 = "wa_"+btn_id+"_1";
        if ($("#"+id_wa_1).hasClass("red")) {
            $.alert({
                title: '',
                content: '<b>Maaf,</b> Selesaikan dahulu followup pertama anda!',
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

        $("#img_"+no+"_2").hide();
        $("#icon_"+no+"_2").show();

        var data_nya = [
            entry_id,
            orderid
        ];
        var data = {
            "action": "myaction_send_wa_followup2",
            "datanya": data_nya
        };
        
        jQuery.post(ajaxurl, data, function(response) {
            // multiple
            $("#img_"+no+"_2").show();
            $("#icon_"+no+"_2").hide();
            $("#wa_"+btn_id+"_2").removeClass("red").addClass("green");
            $("#img_"+no+"_2").attr("src","<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/wa_24_green.png");
            var redirectWindow = window.open(response, "_blank");
            redirectWindow.location;
        });

    });

    

    $(document).on("click", ".btn-send-wa-multiple3", function() {
        var entry_id = $(this).attr("data-entryid");
        var no = $(this).attr("data-no");
        var btn_id = $(this).attr("data-id");
        var orderid = $(this).attr("data-id");

        var id_wa_1 = "wa_"+btn_id+"_1";
        var id_wa_2 = "wa_"+btn_id+"_2";
        if ($("#"+id_wa_1).hasClass("red") || $("#"+id_wa_2).hasClass("red")) {
            $.alert({
                title: '',
                content: '<b>Maaf,</b> Selesaikan dahulu followup pertama dan kedua anda!',
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

        $("#img_"+no+"_3").hide();
        $("#icon_"+no+"_3").show();

        var data_nya = [
            entry_id,
            orderid
        ];
        var data = {
            "action": "myaction_send_wa_followup3",
            "datanya": data_nya
        };
        
        jQuery.post(ajaxurl, data, function(response) {
            // multiple
            $("#img_"+no+"_3").show();
            $("#icon_"+no+"_3").hide();
            $("#wa_"+btn_id+"_3").removeClass("red").addClass("green");
            $("#img_"+no+"_3").attr("src","<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/wa_24_green.png");
            var redirectWindow = window.open(response, "_blank");
            redirectWindow.location;
        });

    });
    

    $(document).on("click", "#update_status_order", function(){
        var numItems = $(".list-group-item.show_status").length;

        var textnya_status = $("#statusnya option:selected").text();
        var idnya_status = $("#statusnya option:selected").val();
        var colornya_status = $("#statusnya option:selected").data("color");
        var ketnya_status = $("#statusnya option:selected").data("ket");
        var orderid = $(this).attr("data-id");
        var additional_info = $("#additional_info").val();
        
        var hasil = idnya_status-numItems;
        if(hasil>1){
            $.alert({
                title: '',
                content: "<b>Sorry,</b> you don't have permission to jump the status!",
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
        if(hasil==0){
            $.alert({
                title: '',
                content: "<b>Sorry,</b> this status has created!",
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
        if(hasil<1){
            $.alert({
                title: '',
                content: "<b>Sorry,</b> these statuses are completed!",
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

        var data_nya = [
            orderid,
            idnya_status,
            additional_info
        ];
        var data = {
            "action": "myaction_update_order_status",
            "datanya": data_nya
        };
        $("#loading_status").html("Loading...").show();
        jQuery.post(ajaxurl, data, function(response) {
            var fields = response.split("_");
            var info = fields[0];
            var idnya = fields[1];
            var idstatus = "status_"+idnya;
            if(info=="success"){
                $("#loading_status").html('<span style="color:#20BF6B;">Update Status Success!</span>').delay(3000).fadeOut();

                var data2 = '<div id="'+idstatus+'" style="cursor:text;" class="list-group-item list-group-item-action flex-column align-items-start show_status" data-textnya="'+textnya_status+'" data-colornya="'+colornya_status+'"><div class="d-flex w-100 justify-content-between"><h5 class="mb-1" style="color:'+colornya_status+';font-size:16px;">'+textnya_status+'</h5><small><?php echo $datenya;?></small></div><p class="btn-delete-status" data-id="'+idnya+'" data-urutandiv="'+idnya_status+'"><span class="dashicons dashicons-trash" title="Delete Status"></span></p><p class="mb-1">'+ketnya_status+'</p><p class="mb-1">'+additional_info+'</p></div>';
                    
                    $("#content_order .list-group").append(data2);

                $("#status_"+orderid).text(textnya_status);
                $("#status_"+orderid).css( "background-color", colornya_status );

                var valuenya = "option[value="+idnya_status+"]";
                $("#statusnya "+valuenya).attr("disabled", true);
                
            }
        });
    });

</script>
    <?php
}