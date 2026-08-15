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
<link rel="stylesheet" type="text/css" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/datatables/dataTables.bootstrap4.min.css" />
<style>
body{
    background:#F0F6F8
}
table caption{
    padding:.5em 0
}
table.dataTable th,table.dataTable td{
    white-space:nowrap
}
th{
    font-size:14px
}
td{
    font-size:13px
}
th:last-child,td:last-child{
    text-align:center
}
.dt-buttons.btn-group{
    position:absolute;
    right:0;
    margin-right:65px
}
button.buttons-excel,button.buttons-copy{
    font-size:13px
}
button.buttons-excel{
    background:#36B459;
    color:#fff;
    border:1px solid #27AE60;
    font-size:13px
}
button.buttons-excel:hover{
    background:#2CAF23;
    border:1px solid #27AE60
}
label{
    font-size:14px
}
#dataorders_info{
    font-size:12px
}
#dataorders_paginate{
    font-size:14px
}
#dataorders_filter{
    position:absolute;
    right:0;
    margin-right:65px
}
.order_status{
    font-size:12px;
    padding:4px 10px;
    background:#5A6268;
    color:#FFF;
    -webkit-border-radius:4px;
    border-radius:4px
}
a.link_on_table{
    text-decoration:none
}
a.link_on_table .dashicons{
    font-size:16px;
    margin-top:2px;
    margin-right:2px
}
a.btn-send-wa{
    color:#1EAD3A
}
a.btn-send-wa.red{
    color:#AC1B33
}
a.btn-send-wa img{
    margin-right:3px;
    margin-top:-3px
}
a.btn-send-wa-multiple1 img,a.btn-send-wa-multiple2 img,a.btn-send-wa-multiple3 img{
    margin-top:-3px
}
a.btn-send-wa-multiple1.green,a.btn-send-wa-multiple2.green,a.btn-send-wa-multiple3.green{
    background:#36bd47;
    padding:5px 8px 5px 5px;
    color:#fff;
    border-radius:16px;
    font-weight:300
}
a.btn-send-wa-multiple1.red,a.btn-send-wa-multiple2.red,a.btn-send-wa-multiple3.red{
    background:#ac1c34;
    padding:5px 8px 5px 5px;
    color:#fff;
    border-radius:16px;
    font-weight:300
}
.modal-header,.modal-body,.modal-footer{
    padding-left:1.7rem;
    padding-right:1.7rem
}
.modal-body{
    padding-top:1.7rem
}
.delete_order{
    color:#EB3B5A;
    cursor:pointer
}
.delete_order:hover{
    color:#D31534
}
.dashicons.spin{
    animation:dashicons-spin 1s infinite;
    animation-timing-function:linear
}
.pagination,.dataTables_info{
    font-size:13px
}
#example_processing{
    display:inherit;
    border:1px solid rgb(108,219,108);
    z-index:9999;
    background:#FFF
}
table.dataTable thead .sorting::before,table.dataTable thead .sorting_asc::before,table.dataTable thead .sorting_desc::before,table.dataTable thead .sorting_asc_disabled::before,table.dataTable thead .sorting_desc_disabled::before{
    display:none
}
table.dataTable thead .sorting::after,table.dataTable thead .sorting_asc::after,table.dataTable thead .sorting_desc::after,table.dataTable thead .sorting_asc_disabled::after,table.dataTable thead .sorting_desc_disabled::after{
    display:none
}
tbody tr.selected{
    background:#BBC8E3!important
}
#example th:first-child.sorting_asc{
    padding-right:0!important
}
.select-info{
    font-weight:700;
    padding-left:20px
}
.select-item{
    display:none
}
#btn_print{
    border:1px solid #fff
}
#btn_print:hover{
    border:1px solid #666;
    cursor:pointer
}
.modal-dialog.modal-print-label{
    max-width:800px!important
}
.modal-content{
    border-radius:8px
}
.column{
    float:left;
    width:25%;
    height:135px;
    font-size:12px
}
.row.label_produk{
    border:1px solid #222;
    padding:10px 20px;
    width:100%;
    border-bottom:1px dashed #222;
    border-left:0;
    border-right:0;
    border-top:0;
    font-size:13px
}
.row.label_pengiriman{
    border:1px solid #222;
    margin-bottom:8px
}
.column.label_orderid{
    width:20%;
    padding:10px
}
.column.label_penerima{
    width:30%;
    padding:10px;
    border-left:1px dashed #222
}
.column.label_pengirim{
    width:30%;
    padding:10px;
    border-left:1px dashed #222
}
.column.label_ekspedisi{
    width:20%;
    padding:10px;
    border-left:1px dashed #222
}
.row:after{
    content:"";
    display:table;
    clear:both
}
.jconfirm .jconfirm-box .jconfirm-buttons button.btn-blue{
    background-color:#db6934!important
}
.jconfirm .jconfirm-box .jconfirm-buttons button.btn-blue:hover{
    background-color:#de522c!important
}
.select2-container{
    float:left;
    font-size:14px
}
#btn_download_all{
    box-shadow:none!important;
    text-shadow:none!important;
    color:#fff!important;
    border:1px solid #27AE60!important;
    height:38px!important;
    background:#36B459!important;
    width:135px!important;
    margin-right:1px
}
#btn_download_selected{
    box-shadow:none!important;
    text-shadow:none!important;
    color:#fff!important;
    border:1px solid #27AE60!important;
    height:38px!important;
    background:#36B459!important;
    width:173px!important
}
#btn_print_label{
    box-shadow:none!important;
    text-shadow:none!important;
    color:#fff!important;
    border:1px solid #0f71c5!important;
    height:38px!important;
    background:#007BFF!important;
    width:121px!important
}
#example_info{
    height:31px
}
#div_total_order {
    width:200px;
    position: absolute;
    float: right;
    right: 0;
    margin-right: 285px;
    background: #f37206;
    padding: 15px 25px;
    margin-top: 40px;
    color: #ffffff;
    border-radius: 3px;
    box-shadow: 0 5px 10px rgba(0,0,0,0.2),0 25px 80px rgba(0,0,0,0.1);
    text-align: center;
}
#div_closing_ratio {
    width:200px;
    position: absolute;
    float: right;
    right: 0;
    margin-right: 65px;
    background: #f37206;
    padding: 15px 25px;
    margin-top: 40px;
    color: #ffffff;
    border-radius: 3px;
    box-shadow: 0 5px 10px rgba(0,0,0,0.2),0 25px 80px rgba(0,0,0,0.1);
    text-align: center;
}
#closing_ratio, #total_order {
    font-size: 35px;
}
.text_closing_ratio {
    font-size: 12px
}

@keyframes dashicons-spin{
    0%{
        transform:rotate(0deg)
    }
    100%{
        transform:rotate(360deg)
    }
}
@media only screen and (max-width:760px){
    .modal-backdrop{
        display:none
    }
    a .button{
        margin-right:-10px!important
    }
    .dt-buttons.btn-group,.dataTables_filter{
        width:auto!important;
        margin-right:65px!important
    }
    .dataTables_length{
        padding-top:45px
    }
    .dataTables_length,.dataTables_info{
        text-align:left!important
    }
    .button .dashicons.dashicons-admin-generic{
        margin-top:0!important
    }
}
@media only screen and (max-width:480px){
    #exampleModalLongTitle{
        font-size:14px;
        padding-left:2px
    }
    .modal-header.title-1{
        padding-left:10px!important
    }
    .modal-header.title-2{
        padding-left:40px!important
    }
    #dataorders_filter label{
        font-size:0px!important
    }
    #div_closing_ratio {
        width: 120px !important;
        margin-right: 35px !important;
        margin-top: 40px;
    }
    #div_total_order {
        width: 120px !important;
        margin-right: 175px !important;
        margin-top: 40px;
    }
    #closing_ratio, #total_order {
        font-size: 25px;
    }
    .text_closing_ratio {
        font-size: 9px;
    }
    #div_filter {
        margin-top: 160px !important;
    }
}



.main-nav {
    margin-top: 18px;
    display: flex;
    margin-bottom: -1px;
}
.main-nav a {
    padding: 20px 45px;
    text-transform: uppercase;
    text-align: center;
    display: block;
}
.main-nav a {
    font-size: .99em;
    color: #718DAE;
}
.main-nav a:hover {
    color: #34495e;
    text-decoration: none;
}
ul.main-nav li {
    margin-bottom: 0;
}
ul.main-nav li.active a {
    color: #34495e;
}
ul.main-nav li.active {
    color: #34495e;
    background: #fff;
    border: 1px solid #e3ebf0;
    border-bottom: 0;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}

</style>

    <?php
    
        global $wpdb;
        $table_name = $wpdb->prefix . "cf_forms";
        $table_name3 = $wpdb->prefix . "mgo_settings";
        $table_name4 = $wpdb->prefix . "cf_form_entry_values";
        $table_name5 = $wpdb->prefix . "cf_form_entries";
        $table_name6 = $wpdb->prefix . "mgo_orders";
        $table_name7 = $wpdb->prefix . "mgo_order_statuses";
        $table_name8 = $wpdb->prefix . "users";
        $table_name9 = $wpdb->prefix . "mgo_phone";

        // Set Array
        $data_array = array(
                'label_pengirim',
        );

        foreach ($data_array as $key => $value) {
            // cek apakah di table ada sesuai "type" ?
            $query = $wpdb->get_results('SELECT data from '.$table_name3.' where type="'.$value.'"');
            if($query==null){
                // klo gak ada, insert data
                if($value=='label_pengirim'){
                    $isi = '<b>Allsha Online Shop</b><br><div>Bandung, Jawa Barat</div><div>087812345678<br></div>';
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


        $plugin_status = $wpdb->get_results("SELECT * from $table_name3 where type='plugin_status'")[0];
        $table_field = $wpdb->get_results("SELECT data from $table_name3 where type='table_field'")[0];


        // DEFAULT
        // $rows_entry = $wpdb->get_results("SELECT * from $table_name4 LEFT JOIN $table_name5 ON $table_name4.entry_id = $table_name5.id where slug='mgo_orderid' or slug='mgo_orderid2' ORDER BY $table_name4.entry_id DESC $limit");

        // GROUP BY VALUE
        // $rows_entry = $wpdb->get_results("SELECT * from $table_name4 LEFT JOIN $table_name5 ON $table_name4.entry_id = $table_name5.id where form_id='CF5ba7ae3dd8b30' and slug='mgo_orderid' ORDER BY $table_name4.entry_id DESC limit 55");
    
        // $rows_entry = $wpdb->get_results("SELECT * from $table_name4 LEFT JOIN $table_name5 ON $table_name4.entry_id = $table_name5.id where slug = 'mgo_csid' and value=2 ORDER BY $table_name4.entry_id DESC limit 15");

        

        // $statuses = $wpdb->get_results("SELECT * from $table_name7");

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

        // DATA USERS
        $blogs = array();
        $args = array( 'blog_id' => 0 );
        $users = get_users( $args );
        $data_users = '<option value="0">Choose CS</option>';
        foreach ($users as $row ) {
            $data_users .= '<option value="'.$row->ID.'">'.$row->display_name.'</option>';
        }

        // FORM
        $query_forms = $wpdb->get_results("SELECT * from $table_name where type='primary'");
        $data_forms = '<option value="0">ALL</option>';
        foreach ($query_forms as $row ) {
            $dataconfig = json_encode(maybe_unserialize( $row->config ));
            $datajson = json_decode($dataconfig);
            $data_forms .= '<option value="'.$row->form_id.'">'.$datajson->name.'</option>';
        }

        ?>

<div class="wrap">
    <h2 class="title"><img class="icon-title" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/magic-order-icon.png">
        <div class="main-title" style="margin-top: -25px;"><?php echo $plugin_name; ?>
            <div style="font-size: 11px;margin-top: -10px;color:#A0C9D7;">Version <?php echo $plugin_version; ?></div>
        </div>
        <div style="float: right;margin-right: 10px;margin-top: 25px;">
            <span style="color:#666e89;font-size:16px;">
            <?php 
            if($role!='administrator'){
                echo ' '.wp_get_current_user()->display_name;
            }else{
                echo ' Administrator ';
            }
            ?>
            <img src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/user.png" style="width: 30px;margin-left: 12px;margin-top: -4px;">
            </span>
        </div>
    </h2>

    <?php
    if($apikey=='' || $apikey_status!='valid'){
        echo '
        <div class="sub-title" style="margin-top:20px;"><span>API Key tidak valid atau belum tersedia, silahkan update API Key anda. <a href="'.site_url().'/wp-admin/admin.php?page=magic_order_api" style="text-decoration: none;">[ Update ]</a></span></div>
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
        <div class="sub-title" style="margin-top:20px;"><span>Plugin Caldera Forms belum terinstall, silahkan install terlebih dahulu! <a href="'.site_url().'/wp-admin/plugin-install.php?s=caldera+forms&tab=search&type=term" style="text-decoration: none;">[ INSTALL ]</a></span></div>
        <div class="wrap-container" style="padding: 15px 30px;">
        </div>';
        return false;
    }

    if($expired!='allowed'){
        echo '
        <div class="sub-title" style="margin-top:20px;"><span>Maaf, plugin anda Expired. <a href="https://member.sinkronus.com" style="text-decoration: none;">[ Extend Now ]</a></span></div>
        <div class="wrap-container" style="padding: 15px 30px;">
        </div>';
        return false;
    }
    ?>
    
    <ul class="main-nav">
        <li class="active"><a href="#">Data Order</a></li>
        <li><a href="#">Konfirmasi</a></li>
        <li><a href="#">Rekapan</a></li>
    </ul>

        
        <div class="sub-title" style="padding-bottom: 40px;margin-top: 0;">
            <?php
            
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
            if (in_array("14", $array_table)) { $wanumber_show = 1; }else{ $wanumber_show = 0; }

            ?>

            <div style="position: absolute;font-size: 15px;display: none;margin-left: 30px;padding-top: 3px;" id="statusinfo"></div>
            <a href="<?php echo admin_url('admin.php?page=magic_order_data_settings') ?>">
            <span class="button" style="float: right;border: none;background: none;box-shadow: none;margin-right: 7px;"><span class="dashicons dashicons-admin-generic" style="margin-top: 5px;margin-right: 3px;font-size: 16px;"></span>Settings</span>
            </a>
            <div id="div_total_order"><span class="text_closing_ratio">TOTAL ORDER</span><br><span id="total_order">0</span></div>
            <div id="div_closing_ratio"><span class="text_closing_ratio">CLOSING RATIO</span><br><span id="closing_ratio">0</span><span style="font-size:18px;">%</span></span></div>

            <div id="div_filter" style="padding-bottom:0px;font-size:15px;margin-top: 40px;">
                <span>Form: </span><select name="filter" id="form" class="form-control form-control-sm" style="width: 210px;padding-left:5px;padding-right:5px;margin-right:5px;display: inline;font-size:14px;">
                    <?php echo $data_forms; ?>
                    </select><br>
                <div style="margin-top: 15px;">
                    <span>Filter:</span>
                    <select name="filter" id="filter" class="form-control form-control-sm" style="width: 140px;padding-left:4px;display: inline-block;margin-top:-2px;margin-left: 2px;font-size:14px;">
                        <option value="0">-- Filter --</option>
                        <!-- <option value="form">Form</option> -->
                        <?php
                        if($role=='administrator'){echo '<option value="cs">CS</option>';}?>
                        <option value="orderid">Order ID</option>
                        <option value="product">Product</option>
                        <option value="coupon">Coupon</option>
                        <option value="name">Customer Name</option>
                        <option value="date">Date</option>
                        <option value="status">Status</option>
                    </select>
                    <div id="box-filter" style="display: none;">
                        <div style="display: flex;">
                            <input type="text" id="orderid" placeholder="Order ID" class="form-control form-control-sm" style="width: 210px;display: inline;margin-right:5px;">
                            <input type="text" id="product" placeholder="Product Name" class="form-control form-control-sm" style="width: 210px;display: inline;margin-right:5px;">
                            <input type="text" id="coupon" placeholder="Coupon Code" class="form-control form-control-sm" style="width: 210px;display: inline;margin-right:5px;">
                            <input type="text" id="name" placeholder="Customer Name" class="form-control form-control-sm" style="width: 210px;display: inline;margin-right:5px;">
                            <input type="text" id="date_start" maxlength="16" placeholder="Start Date" class="form-control form-control-sm" style="width: 150px;display: inline;margin-right:5px;">
                            <input type="text" id="date_end" maxlength="16" placeholder="End Date" class="form-control form-control-sm" style="width: 150px;display: inline;margin-right:5px;">
                            
                            <input type="button" id="btn_filter" class="button btn_mgo" value="Filter" style="height: 30px;width: 70px;display: none;"  />
                            
                        </div>
                    </div>
                    <div id="date_cs" style="margin-top: 15px;margin-left: 44px;display: none;">
                        <select name="filter" id="cs" class="form-control form-control-sm" style="width: 140px;padding-left:5px;padding-right:5px;margin-right:5px;display: none;float: left;">
                            <?php echo $data_users; ?>
                            </select>
                        <select name="filter" id="cs_date" class="form-control form-control-sm" style="width: 100px;padding-left:5px;padding-right:5px;margin-right:5px;display:inline;float: left;">
                            <option value="alldate">All Date</option>
                            <option value="withdate">With Date</option>
                            </select>
                        <input type="text" id="date_startcs" maxlength="16" placeholder="Start Date" class="form-control form-control-sm" style="width: 150px;display: inline;margin-right:5px;">
                        <input type="text" id="date_endcs" maxlength="16" placeholder="End Date" class="form-control form-control-sm" style="width: 150px;display: inline;margin-right:5px;">
                        <input type="button" id="btn_filter2" class="button btn_mgo" value="Filter" style="height: 30px;width: 70px;display: none;"  />
                    </div>
                    <div id="date_status" style="margin-top: 15px;margin-left: 44px;display: none;">
                        <p style="position: absolute;margin-top: 40px;font-size: 11px;"><b>Note:</b> <Br>Jika anda pilih Confirmed dan status Packaged keluar, <br>itu karena dalam order tersebut sudah terhitung Confirmed juga. Begitu juga pada Shipped dan Delivered.</p>
                        <select name="status" id="status" class="form-control form-control-sm" style="width: 140px; padding-left: 5px; padding-right: 5px; margin-right: 5px; float: left; display: block;">
                            <option value="1" selected="">Confirmed</option>
                            <option value="2">Packaged</option>
                            <option value="3">Shipped</option>
                            <option value="4">Delivered</option>
                            </select>
                        <select name="status_date" id="status_date" class="form-control form-control-sm" style="width: 100px;padding-left:5px;padding-right:5px;margin-right:5px;display:inline;float: left;">
                            <option value="alldate">All Date</option>
                            <option value="withdate">With Date</option>
                            </select>
                        <input type="text" id="date_start_status" maxlength="16" placeholder="Start Date" class="form-control form-control-sm" style="width: 150px;display: none;margin-right:5px;">
                        <input type="text" id="date_end_status" maxlength="16" placeholder="End Date" class="form-control form-control-sm" style="width: 150px;display: none;margin-right:5px;">

                        <input type="button" id="btn_filter3" class="button btn_mgo" value="Filter" style="height: 30px;width: 70px;"  />
                    </div>
            
                </div>
            </div>
        </div>
            <div class="wrap-container" style="padding:45px 30px 65px 30px;">
                <div class="table-responsive"> 
                    
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th style=""></th>
                                <th <?php if($no_show==0){echo 'style="display: none;"'; }?>>No</th>
                                <th <?php if($name_show==0){echo 'style="display: none;"'; }?>>Name</th>
                                <th <?php if($nama_produk_show==0){echo 'style="display: none;"'; }?>>Product</th>
                                <th <?php if($wanumber_show==0){echo 'style="display: none;"'; }?>>Whatsapp</th>
                                <th <?php if($form_show==0){echo 'style="display: none;"'; }?>>Form ID</th>
                                <th <?php if($orderid_show==0){echo 'style="display: none;"'; }?>>Order ID</th>
                                <th <?php if($cs_show==0){echo 'style="display: none;"'; }?>>CS</th>
                                <th <?php if($kupon_show==0){echo 'style="display: none;"'; }?>>Coupon</th>
                                <?php if($plugin_license=="VIP"){ ?>
                                <th <?php if($kupon_show==0){echo 'style="display: none;"'; }?>>Alamat</th>
                                <th <?php if($kupon_show==0){echo 'style="display: none;"'; }?>>Kecamatan</th>
                                <th <?php if($kupon_show==0){echo 'style="display: none;"'; }?>>Ongkir</th>
                                <th <?php if($kupon_show==0){echo 'style="display: none;"'; }?>>COD</th>
                                <th <?php if($kupon_show==0){echo 'style="display: none;"'; }?>>Confirmation</th>
                                <th <?php if($kupon_show==0){echo 'style="display: none;"'; }?>>Phone Confirmation</th>
                                <?php } ?>
                                <th <?php if($total_show==0){echo 'style="display: none;"'; }?>>Total Price</th>
                                <th <?php if($date_show==0){echo 'style="display: none;"'; }?>>Date Order</th>
                                <th <?php if($detail_show==0){echo 'style="display: none;"'; }?>>Detail</th>
                                <th <?php if($wa_show==0){echo 'style="display: none;"'; }?>>Followup</th>
                                <th <?php if($multiple_wa_show==0){echo 'style="display: none;"'; }?>>Multiple Followup</th>
                                <th <?php if($status_show==0){echo 'style="display: none;"'; }?>>Status</th>
                                <th <?php if($action_show==0){echo 'style="display: none;"'; }?>>Action</th>
                            </tr>
                        </thead>
                    </table>
                    <div style="margin-left:12px;margin-bottom: 20px;">
                        <hr>  
                        
                        <button id="btn_print_label" data-toggle="modal" data-target="#ModalPrintLabel" class="button btn_mgo" style=""  ><img src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/printer-white.png" style="width: 22px;margin-right: 5px;">Print Label</button>

                        <button id="btn_download_all" class="button btn_mgo" style="display: none;"><img src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/csv.png" style="width: 22px;margin-right: 5px;">Download All</button>

                        <button id="btn_download_selected" class="button btn_mgo" style="display: none;"><img src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/csv.png" style="width: 22px;margin-right: 5px;">Download Selected</button>
                    </div>
                </div> <!-- table-responsive -->
            </div>
        <!-- Modal -->
        <div class="modal fade" id="ModalUpdateStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="top:45px;">
              <div class="modal-header title-1" style="background: #007BFF;color: #fff;border-bottom: 0;padding: 1rem 1.7rem 0.1rem 1.7rem;">
                <h5 class="modal-title" id="exampleModalLongTitle"><span class="dashicons dashicons-tag" style="padding-top: 5px; margin-right: 5px;"></span> Order ID: <span id="orderid_info"></span></h5><Br>
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

        <!-- Modal -->
        <div class="modal fade" id="ModalPrintLabel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-print-label" role="document">
            <div class="modal-content" style="top:45px;height: 540px;">
              <div class="modal-header title-1" style="background: #007BFF;color: #fff;border-bottom: 0;padding: 1rem 1.7rem 0.1rem 1.7rem;">
                <h5 class="modal-title" id="exampleModalLongTitle"><img src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/printer2.png" style="width: 60px;margin-right: 5px;"> Print Label Pengiriman <span id="jumlah_label"></span></h5><Br>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#ffffff;">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-header title-2" style="background: #007BFF;color: #fff;border-radius: 0; padding: 0.1rem 1.7rem 1.1rem 6rem">
                    <div>
                        <label style="margin-right: 20px;">
                            <input class="table_field" name="hide_produk" id="hide_produk" value="0" type="checkbox" /><span class="labelname">Hide Produk</span>
                        </label>
                        <label style="margin-right: 20px;">
                            <input class="table_field" name="hide_ekspedisi" id="hide_ekspedisi" value="0" type="checkbox" /><span class="labelname">Hide Ekspedisi</span>
                        </label>
                        <label>
                            <input class="table_field" name="hide_ongkir" id="hide_ongkir" value="0" type="checkbox" /><span class="labelname">Hide Detail Ongkir</span>
                        </label>
                    </div>
              </div>
              <div class="modal-body" style="overflow-y: scroll;">
                <div id="content_order_label" style="margin-bottom: 10px;padding-top: 10px;"></div>
              </div>
              <div class="modal-footer">
                <div id="btn_print" style="padding: 5px 15px;border-radius: 4px;" onclick="printDiv('content_order_label')"><img src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/printer.png" style="width: 22px;margin-right: 5px;"><span style="font-size: 14px;">Print</span></div>
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
<script type="text/javascript" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/datatables/dataTables.select.min.js?ver=<?php echo $plugin_version; ?>"></script>
<script type="text/javascript" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/datatables/dataTables.checkboxes.min.js?ver=<?php echo $plugin_version; ?>"></script>
<link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/confirm/jquery-confirm.min.css?ver=<?php echo $plugin_version; ?>">
<script src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/confirm/jquery-confirm.min.js?ver=<?php echo $plugin_version; ?>"></script>
<link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/timepicker/jquery.datetimepicker.min.css?ver=<?php echo $plugin_version; ?>" />
<script src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/timepicker/jquery.datetimepicker.full.min.js?ver=<?php echo $plugin_version; ?>"></script>

<script>

    function printDiv(divName) {
        var set_produk = $('#hide_produk:checked').val();
        var set_ekspedisi = $('#hide_ekspedisi:checked').val();
        var set_ongkir = $('#hide_ongkir:checked').val();

        if(set_produk!=0){
            val_produk = 'show';
        }else{
            val_produk = 'hide';
        }

        if(set_ekspedisi!=0){
            val_ekspedisi = 'show';
        }else{
            val_ekspedisi = 'hide';
        }

        if(set_ongkir!=0){
            val_ongkir = 'show';
        }else{
            val_ongkir = 'hide';
        }

        window.open("<?php echo admin_url('?mgo_page=print_label&id=');?>"+id_order+"&produk="+val_produk+"&ekspedisi="+val_ekspedisi+"&ongkir="+val_ongkir+"", "_blank");
    }
    
    $(document).ready(function() {

        $("#date_start").datetimepicker({
            format:'Y-m-d H:i'
        });

        $("#date_end").datetimepicker({
            format:'Y-m-d H:i'
        });

        $("#date_startcs").datetimepicker({
            format:'Y-m-d H:i'
        });

        $("#date_endcs").datetimepicker({
            format:'Y-m-d H:i'
        });

        $("#date_start_status").datetimepicker({
            format:'Y-m-d H:i'
        });

        $("#date_end_status").datetimepicker({
            format:'Y-m-d H:i'
        });

        var load = 0;
        var table = $('#example').DataTable( {
            "searching": false,
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "destroy": true,
            "columnDefs": [
                <?php if($plugin_license=="VIP"){ ?>
                    { targets: [0, 0], className: "checkbox_select"},
                    { targets: [0, 0], 'checkboxes': { 'selectRow': true }, visible: true },
                    { targets: [0, 1], visible: <?php if($no_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 2], visible: <?php if($name_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 3], visible: <?php if($nama_produk_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 4], visible: <?php if($wanumber_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 5], visible: <?php if($form_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 6], visible: <?php if($orderid_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 7], visible: <?php if($cs_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 8], visible: <?php if($kupon_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 9], visible: false},
                    { targets: [0, 10], visible: false},
                    { targets: [0, 11], visible: true},
                    { targets: [0, 12], visible: true},
                    { targets: [0, 13], visible: true},
                    { targets: [0, 14], visible: false},
                    { targets: [0, 15], visible: <?php if($total_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 16], visible: <?php if($date_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 17], visible: <?php if($detail_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 18], visible: <?php if($wa_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 19], visible: <?php if($multiple_wa_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 20], visible: <?php if($status_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 21], visible: <?php if($action_show==0){echo 'false'; }else{echo'true';}?>}
                <?php } else { ?>
                    { targets: [0, 0], className: "checkbox_select"},
                    { targets: [0, 0], 'checkboxes': { 'selectRow': true }, visible: true },
                    { targets: [0, 1], visible: <?php if($no_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 2], visible: <?php if($name_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 3], visible: <?php if($nama_produk_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 4], visible: <?php if($wanumber_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 5], visible: <?php if($form_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 6], visible: <?php if($orderid_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 7], visible: <?php if($cs_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 8], visible: <?php if($kupon_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 9], visible: <?php if($total_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 10], visible: <?php if($date_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 11], visible: <?php if($detail_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 12], visible: <?php if($wa_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 13], visible: <?php if($multiple_wa_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 14], visible: <?php if($status_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 15], visible: <?php if($action_show==0){echo 'false'; }else{echo'true';}?>}
                <?php } ?>],
            "ajax": {
                "url": ajaxurl,
                "type": "POST",
                "dataSrc": "myList",
                'data': {
                    action: 'myaction_data_orders',
                    filter_option: $('#filter option:selected').val(),
                    filter_form: $('#form option:selected').val(),
                    filter_cs: $('#cs option:selected').val(),
                    filter_orderid: $('#orderid').val(),
                    filter_product: $('#product').val(),
                    filter_coupon: $('#coupon').val(),
                    filter_name: $('#name').val(),
                    filter_datestart: $('#date_start').val(),
                    filter_dateend: $('#date_end').val(),
                    filter_csdate: $('#cs_date').val(),
                    filter_datestartcs: $('#date_startcs').val(),
                    filter_dateendcs: $('#date_endcs').val(),
                    filter_status: $('#status').val(),
                    filter_statusdate: $('#status_date').val(),
                    filter_datestartstatus: $('#date_start_status').val(),
                    filter_dateendstatus: $('#date_end_status').val(),
                    filter_load: load
                }
            },
            "lengthMenu": [
                [ 10, 25, 50, 100, -1 ],
                [ '10', '25', '50', '100', 'All' ]
            ],
            "dom": '<"dt-buttons"Bf><"clear">lirtp',
            "buttons": [
                { extend: 'copyHtml5', text: 'Copy' },
                { extend: 'excelHtml5', text: 'Download Excel' }
            ],
            "fnInitComplete": function(oSettings, json) {
                $("#total_order").text(numberWithDot(json.recordsTotal));
                $("#closing_ratio").text(json.closingRatio);
            },
            "createdRow": function( row, data, dataIndex ) {
                var orderid = $(row).find('td:eq(1) span').data('orderid');
                var entryid = $(row).find('td:eq(1) span').data('entryid');
                $(row).attr('id', 'order_'+orderid).attr('data-entryid',entryid);
            }
        });

        function new_alert(pesan){
            $.alert({
                title: '',
                content: "<b>"+pesan+"</b>",
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
        }


        $('#btn_filter, #btn_filter2, #btn_filter3').click(function (e) {
            if($('#cs_date option:selected').val()=='withdate'){
                var startnya = $('#date_startcs').val();
                var endnya = $('#date_startcs').val();
                if(startnya=='' || endnya==''){
                    pesan = 'Tolong input tanggal anda terlebih dahulu dengan benar!';
                    new_alert(pesan);
                    return false;
                }
            }

            if($('#filter option:selected').val()=='orderid'){
                if($('#orderid').val()==''){
                    pesan = 'Isi Order ID terlebih dahulu!';
                    new_alert(pesan);
                    return false;
                }
                
            }
            if($('#filter option:selected').val()=='product'){
                if($('#product').val()==''){
                    pesan = 'Isi nama Produk terlebih dahulu!';
                    new_alert(pesan);
                    return false;
                }
            }
            if($('#filter option:selected').val()=='coupon'){
                if($('#coupon').val()==''){
                    pesan = 'Isi Kode Kupon terlebih dahulu!';
                    new_alert(pesan);
                    return false;
                }
            }
            if($('#filter option:selected').val()=='name'){
                if($('#name').val()==''){
                    pesan = 'Isi Nama Customer terlebih dahulu!';
                    new_alert(pesan);
                    return false;
                }
            }
            if($('#filter option:selected').val()=='date'){
                if($('#date_start').val()=='' || $('#date_end').val()==''){
                    pesan = 'Isi tanggal terlebih dahulu!';
                    new_alert(pesan);
                    return false;
                }
            }


            var load = 2;
            load_datatable(load);
        });

        $('#form').change(function (e) {
            if($('#form option:selected').val()=='0'){
                $('#btn_download_all').hide();
                $('#btn_download_selected').hide();
            }else{
                $('#btn_download_all').show();
                $('#btn_download_selected').show();
            }
            var load = 1;
            load_datatable(load);
        });

        // load 0 = by refresh page
        // load 1 = change form
        // load 2 = by klik button filter

        function load_datatable(load){

            if(load==2){
                load = 2;
            }else{
                if($('#form option:selected').val()==0){
                    load = 0;
                }else{
                    load = 1;
                }
            }

            $('.odd').css({"color":"#F2F2F2"});
            $('.even').css({"color":"#ffffff"});

            $('#example').DataTable( {
                "searching": false,
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "destroy": true,
                "columnDefs": [
                <?php if($plugin_license=="VIP"){ ?>
                    { targets: [0, 0], className: "checkbox_select"},
                    { targets: [0, 0], 'checkboxes': { 'selectRow': true }, visible: true },
                    { targets: [0, 1], visible: <?php if($no_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 2], visible: <?php if($name_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 3], visible: <?php if($nama_produk_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 4], visible: <?php if($wanumber_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 5], visible: <?php if($form_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 6], visible: <?php if($orderid_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 7], visible: <?php if($cs_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 8], visible: <?php if($kupon_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 9], visible: false},
                    { targets: [0, 10], visible: false},
                    { targets: [0, 11], visible: true},
                    { targets: [0, 12], visible: true},
                    { targets: [0, 13], visible: true},
                    { targets: [0, 14], visible: false},
                    { targets: [0, 15], visible: <?php if($total_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 16], visible: <?php if($date_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 17], visible: <?php if($detail_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 18], visible: <?php if($wa_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 19], visible: <?php if($multiple_wa_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 20], visible: <?php if($status_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 21], visible: <?php if($action_show==0){echo 'false'; }else{echo'true';}?>}
                <?php } else { ?>
                    { targets: [0, 0], className: "checkbox_select"},
                    { targets: [0, 0], 'checkboxes': { 'selectRow': true }, visible: true },
                    { targets: [0, 1], visible: <?php if($no_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 2], visible: <?php if($name_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 3], visible: <?php if($nama_produk_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 4], visible: <?php if($wanumber_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 5], visible: <?php if($form_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 6], visible: <?php if($orderid_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 7], visible: <?php if($cs_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 8], visible: <?php if($kupon_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 9], visible: <?php if($total_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 10], visible: <?php if($date_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 11], visible: <?php if($detail_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 12], visible: <?php if($wa_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 13], visible: <?php if($multiple_wa_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 14], visible: <?php if($status_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 15], visible: <?php if($action_show==0){echo 'false'; }else{echo'true';}?>}
                <?php } ?>],
                "ajax": {
                    "url": ajaxurl,
                    "type": "POST",
                    "dataSrc": "myList",
                    'data': {
                        action: 'myaction_data_orders',
                        filter_option: $('#filter option:selected').val(),
                        filter_form: $('#form option:selected').val(),
                        filter_cs: $('#cs option:selected').val(),
                        filter_orderid: $('#orderid').val(),
                        filter_product: $('#product').val(),
                        filter_coupon: $('#coupon').val(),
                        filter_name: $('#name').val(),
                        filter_datestart: $('#date_start').val(),
                        filter_dateend: $('#date_end').val(),
                        filter_csdate: $('#cs_date').val(),
                        filter_datestartcs: $('#date_startcs').val(),
                        filter_dateendcs: $('#date_endcs').val(),
                        filter_status: $('#status').val(),
                        filter_statusdate: $('#status_date').val(),
                        filter_datestartstatus: $('#date_start_status').val(),
                        filter_dateendstatus: $('#date_end_status').val(),
                        filter_load: load
                    }
                },
                "lengthMenu": [
                    [ 10, 25, 50, 100, -1 ],
                    [ '10', '25', '50', '100', 'All' ]
                ],
                "dom": '<"dt-buttons"Bf><"clear">lirtp',
                "buttons": [
                    { extend: 'copyHtml5', text: 'Copy' },
                    { extend: 'excelHtml5', text: 'Download Excel' }
                ],
                "fnInitComplete": function(oSettings, json) {
                    $("#total_order").text(numberWithDot(json.recordsTotal));
                    $("#closing_ratio").html(json.closingRatio);
                },
                "createdRow": function( row, data, dataIndex ) {
                    var orderid = $(row).find('td:eq(1) span').data('orderid');
                    var entryid = $(row).find('td:eq(1) span').data('entryid');
                    $(row).attr('id', 'order_'+orderid).attr('data-entryid',entryid);
                }
            });
        }


        $('#btn_download_selected').on('click', function(e){
            var new_selected = [];
            $('.selected').each(function() {
                new_selected.push($(this).data("entryid"));
            });

            if(new_selected.length == 0) {
                $.alert({
                    title: '',
                    content: "<b>Pilih data order terlebih dahulu!",
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

            console.log( new_selected );
            var formid = $('#form option:selected').val();

            var redirectWindow = window.open("<?php echo admin_url('admin-post.php?action=print.csv&type=selected&entryid=');?>"+new_selected+"&formid="+formid, "_self");
            redirectWindow.location;

        });


        $('#btn_download_all').on('click', function(e){
            var formid = $('#form option:selected').val();
            var redirectWindow = window.open("<?php echo admin_url('admin-post.php?action=print.csv&type=all&entryid=');?>"+"0&formid="+formid, "_self");
            redirectWindow.location;

        });

        const numberWithDot = (x) => {
          return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }


        $('#example tbody').on( 'click', 'td', function () {
            // alert( 'Clicked on cell in visible column: '+table.cell( this ).index().columnVisible );
            if($(this).hasClass("checkbox_select")){
                var classnya = $(this).closest('tr').attr("class");
                if(classnya.search("selected") != -1) {
                    // uncheked
                    $(this).closest('tr').removeClass("selected");
                    $(this).find("input").prop('checked',false);
                    // alert(1);
                }else{
                    // checked
                    $(this).closest('tr').addClass("selected");

                    if($(this).find("input").prop('checked')){
                        // alert(2);
                        // $(this).find("input").prop('checked',true);
                        return false;
                    }else{
                        $(this).find("input").prop('checked',true);
                    }
                }
                // alert(classnya);
            }else{
                // if($(this).find("a").length > 0){
                    
                // }else{
                //     return false;
                // }
            }
        } );


        $('#btn_print_label').click(function (e) {

            $('#content_order_label').text('Loading...');
            $("#hide_produk").prop('checked', false);
            $("#hide_ekspedisi").prop('checked', false);
            $("#hide_ongkir").prop('checked', false);

            // entry id
            var new_selected = [];
            var a = 0;
            id_order = '';
            $('.selected').each(function() {
                new_selected.push($(this).data("entryid"));
                a = a+1;
                id_order += $(this).data("entryid")+',';
            });

            if(new_selected.length == 0) {
                $.alert({
                    title: '',
                    content: "<b>Pilih data order terlebih dahulu!",
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

            if(a>0){
                $('#jumlah_label').text('('+a+' Label)');
            }
            

            var data_nya = [
                new_selected
            ];
            var data = {
                "action": "myaction_print_label",
                "datanya": data_nya
            };
            jQuery.post(ajaxurl, data, function(response) {
                $("#content_order_label").html(response);
                
            });
        });

        

        // Default

        // FIlter
        $("#form").val("0");
        $("#filter").val("0");
        $("#cs_date").val("alldate");
        $('#date_startcs').hide();
        $('#date_endcs').hide();

        val_filter = 0;
        $('#filter').change(function (e) {
            var val_filter = $(this).val();

            $('#box-filter').show().css({"display":"inline-block"});
            $('#btn_filter').show();
            $('#cs').hide();
            $('#orderid').hide();
            $('#product').hide();
            $('#coupon').hide();
            $('#name').hide();
            $('#date_start').hide();
            $('#date_end').hide();
            $('#date_cs').show();
            $('#date_status').hide();

            if(val_filter=='0'){
                $('#box-filter').hide();
                $('#btn_filter').hide();
            }

            if(val_filter=='cs'){
                $('#cs').show();
                $('#date_cs').show();
                $('#cs_date').show();
                $('#btn_filter2').show();
                $('#btn_filter').hide();
            }else if(val_filter=='orderid'){
                $('#orderid').show();
                hide_field_cs();
            }else if(val_filter=='product'){
                $('#product').show();
                hide_field_cs();
            }else if(val_filter=='coupon'){
                $('#coupon').show();
                hide_field_cs();
            }else if(val_filter=='name'){
                $('#name').show();
                hide_field_cs();
            }else if(val_filter=='date'){
                $('#date_start').show();
                $('#date_end').show();
                hide_field_cs();
            }else if(val_filter=='status'){
                $('#date_status').show();
                $('#btn_filter').hide();
                hide_field_cs();
            }else{
                $('#box-filter').hide();
                $('#btn_filter').hide();
            }
        });

        function hide_field_cs(){
                $('#btn_filter2').hide();
                $('#date_startcs').hide();
                $('#date_endcs').hide();
                $('#cs_date').hide();
        }

        $('#cs_date').change(function (e) {
            var cs_date = $('#cs_date option:selected').val();
            if(cs_date=='alldate'){
                $('#date_startcs').hide();
                $('#date_endcs').hide();
            }else{
                $('#date_startcs').css({"display":"inline"});
                $('#date_endcs').css({"display":"inline"});
            }
        });

        $('#status_date').change(function (e) {
            var cs_date = $('#status_date option:selected').val();
            if(cs_date=='alldate'){
                $('#date_start_status').hide();
                $('#date_end_status').hide();
            }else{
                $('#date_start_status').css({"display":"inline"});
                $('#date_end_status').css({"display":"inline"});
            }
        });
        

        $('#hide_ekspedisi').change(function (e) {
            if($(this).is(':checked')){
                $('.label_penerima').css({"width":"40%"});
                $('.label_ekspedisi').hide();
            }else{
                $('.label_penerima').css({"width":"30%"});
                $('.label_ekspedisi').show();
            }
        });

        $('#hide_ongkir').change(function (e) {
            if($(this).is(':checked')){
                $('.detail_ongkir').hide();
            }else{
                $('.detail_ongkir').show();
            }
        });

        $('#hide_produk').change(function (e) {
            if($(this).is(':checked')){
                $('.label_produk').hide();
            }else{
                $('.label_produk').show();
            }
        });


        
    });



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

    $(document).on("click", ".update_status", function() {
        var orderid = $(this).attr('data-id');
        $('#orderid_info').text(orderid);
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
    

    $(document).on("click", ".delete_order", function() {
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
        $('#orderid_info').text(orderid);
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