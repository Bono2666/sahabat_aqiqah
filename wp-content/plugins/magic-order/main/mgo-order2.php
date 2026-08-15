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
        
    global $wpdb;

    // $mgoUpdate = get_option( 'external_updates-magic-order' );
    // echo $newVersion = $mgoUpdate->checkedVersion;
    // echo $oldVersion = $mgoUpdate->update->version;

    // if ( !(version_compare( $oldVersion, $newVersion ) < 0) ) {
    //     // return FALSE;
    // }else{
    //     echo 'Gasss';
    // }
    

    $table_name = $wpdb->prefix . "cf_forms";
    $table_name3 = $wpdb->prefix . "mgo_settings";
    $table_name4 = $wpdb->prefix . "cf_form_entry_values";
    $table_name5 = $wpdb->prefix . "cf_form_entries";
    $table_name6 = $wpdb->prefix . "mgo_orders";
    $table_name7 = $wpdb->prefix . "mgo_order_statuses";
    $table_name8 = $wpdb->prefix . "users";
    $table_name9 = $wpdb->prefix . "mgo_phone";
    $table_name10 = $wpdb->prefix . "options";
    $table_name11 = $wpdb->prefix . "mgo_courier";
    $table_name12 = $wpdb->prefix . "mgo_calculation";

    $query   = $wpdb->get_results('SELECT data from '.$table_name3.' where type="check_time" ORDER BY id ASC');
    if(empty($query[0]->data)){
        // ***************************************
        // klo check_time ada, artinya sudah version 3.0
        // maka eksekusi query dibawah ini
        // ***************************************
        $data_array = array(
                'check_time',
                'utc_status', // date data order
                'utc_value', // date data order
                'utc_status_dataorder',
                'utc_value_dataorder',
                'followup_button_status',
                'qris_qrcode',
                'page_protector',
                'mgo_footer',
                'pagination_table',
                'jx_apikey',
                'jx_customer_code',
                'jx_pickup_status',
                'jx_pickup_data',
        );

        foreach ($data_array as $key => $value) {
            // cek apakah di table ada sesuai "type" ?
            $query = $wpdb->get_results('SELECT data from '.$table_name3.' where type="'.$value.'"');
            if($query==null){
                // -> klo gak ada, insert
                if($value=='utc_status'){
                    $isi = '0';
                }elseif($value=='utc_status_dataorder'){
                    $isi = '0';
                }elseif($value=='followup_button_status'){
                    $isi = '0';
                }elseif($value=='page_protector'){
                    $isi = '0';
                }elseif($value=='mgo_footer'){
                    $isi = '1';
                }elseif($value=='pagination_table'){
                    $isi = '0';
                }elseif($value=='jx_pickup_status'){
                    $isi = '1';
                }elseif($value=='jx_pickup_data'){
                    $isi = '{"":""}';
                }else {
                    $isi = '';
                }

                $wpdb->insert($table_name3,array('type' => $value,'data' => $isi));
                
            }
        }

        // ***************************************
        // table mgo_order_courier
        // ***************************************
        $data_array3 = array(
                'jne',
                'pos',
                'tiki',
                'pcp',
                'esl',
                'rpx',
                'pandu',
                'wahana',
                'sicepat',
                'jnt',
                'pahala',
                'cahaya',
                'sap',
                'jet',
                'indah',
                'slis',
                'dse',
                'first',
                'ncs',
                'star',
                'nss',
                'ninja',
                'lion',
                'idl',
                'jx',
            );

        foreach ($data_array3 as $key => $value) {
            $query = $wpdb->get_results('SELECT courier_code from '.$table_name11.' where courier_code="'.$value.'"');
            if($query==null){

                if($value=='jne'){
                    $courier_name = 'Jalur Nugraha Ekakurir (JNE)';
                }elseif($value=='pos'){
                    $courier_name = 'POS Indonesia (POS)';
                }elseif($value=='tiki'){
                    $courier_name = 'Citra Van Titipan Kilat (TIKI)';
                }elseif($value=='pcp'){
                    $courier_name = 'Priority Cargo and Package (PCP)';
                }elseif($value=='esl'){
                    $courier_name = 'Eka Sari Lorena (ESL)';
                }elseif($value=='rpx'){
                    $courier_name = 'RPX Holding (RPX)';
                }elseif($value=='pandu'){
                    $courier_name = 'Pandu Logistics (PANDU)';
                }elseif($value=='wahana'){
                    $courier_name = 'Wahana Prestasi Logistik (WAHANA)';
                }elseif($value=='sicepat'){
                    $courier_name = 'SiCepat Express (SICEPAT)';
                }elseif($value=='jnt'){
                    $courier_name = 'J&T Express (J&T)';
                }elseif($value=='pahala'){
                    $courier_name = 'Pahala Kencana Express (PAHALA)';
                }elseif($value=='cahaya'){
                    $courier_name = 'Cahaya Logistik (CAHAYA)';
                }elseif($value=='sap'){
                    $courier_name = 'SAP Express (SAP)';
                }elseif($value=='jet'){
                    $courier_name = 'JET Express (JET)';
                }elseif($value=='indah'){
                    $courier_name = 'Indah Logistic (INDAH)';
                }elseif($value=='slis'){
                    $courier_name = 'Solusi Ekspres (SLIS)';
                }elseif($value=='dse'){
                    $courier_name = '21 Express (DSE)';
                }elseif($value=='first'){
                    $courier_name = 'First Logistics (FIRST)';
                }elseif($value=='ncs'){
                    $courier_name = 'Nusantara Card Semesta (NCS)';
                }elseif($value=='star'){
                    $courier_name = 'Star Cargo (STAR)';
                }elseif($value=='nss'){
                    $courier_name = 'Nusantara Surya Sakti Express (NSS)';
                }elseif($value=='ninja'){
                    $courier_name = 'Ninja Xpress (NINJA)';
                }elseif($value=='lion'){
                    $courier_name = 'Lion Parcel (LION)';
                }elseif($value=='idl'){
                    $courier_name = 'IDL Cargo (IDL)';
                }elseif($value=='jx'){
                    $courier_name = 'J-Express (JX)';
                }else{
                    $courier_name = '';
                }

                $wpdb->insert( 
                    $table_name11, 
                    array(
                        'courier_name' => $courier_name,
                        'courier_code' => $value
                    ) 
                );
            }
        }

        // ***************************************
        // add origin_province and origin_city
        // ***************************************
        $charset_collate = $wpdb->get_charset_collate();
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        $result = $wpdb->get_var("SHOW COLUMNS FROM $table_name12 LIKE 'origin_province'");
        if($result==null) {
            $sql = "CREATE TABLE $table_name12 (
                  origin_province text NOT NULL,
                  origin_city text NOT NULL,
                  etd_status int(1) NOT NULL
                )  $charset_collate; ";
            dbDelta($sql);
        }

        $result = $wpdb->get_var("SHOW COLUMNS FROM $table_name12 LIKE 'error_message'");
        if($result==null) {
            $sql = "CREATE TABLE $table_name12 (
                    error_message text NOT NULL,
                    wanotif_cod_message text NOT NULL,
                    cs_bobot text NOT NULL,
                    wanotif_forward text NOT NULL
                )  $charset_collate; ";
            dbDelta($sql);
        }

    }

    

    // $plugin_status = $wpdb->get_results("SELECT * from $table_name3 where type='plugin_status'")[0];
    // $table_field = $wpdb->get_results("SELECT data from $table_name3 where type='table_field'")[0];
    // $btn_del_status = $wpdb->get_results("SELECT data from $table_name3 where type='btn_del_status'")[0];

    // $followup_wanotif_status = $wpdb->get_results("SELECT data from $table_name3 where type='followup_wanotif_status'")[0];

    
    // Get User ROLES
    $cap = get_user_meta( wp_get_current_user()->ID, $wpdb->get_blog_prefix() . 'capabilities', true );
    $roles = array_keys((array)$cap);
    $role = $roles[0];

    $query_settings = $wpdb->get_results('SELECT data from '.$table_name3.' where type="plugin_status" or type="table_field" or type="order_refresh_page" or type="order_refresh_second" or type="btn_del_status" or type="followup_wanotif_status" or type="nama_produk_status" or type="nama_produk_other_name" or type="dash_style" or type="followup_button_status" or type="pagination_table" ORDER BY id ASC');
    $plugin_status = $query_settings[0]->data;
    $table_field = $query_settings[1]->data;
    $order_refresh_page = $query_settings[2]->data;
    $order_refresh_second = $query_settings[3]->data;
    $btn_del_status = $query_settings[4]->data;
    $followup_wanotif_status = $query_settings[5]->data;
    $nama_produk_status = $query_settings[6]->data;
    $nama_produk_other_name = $query_settings[7]->data;
    $dash_style = $query_settings[8]->data;
    $followup_button_status = $query_settings[9]->data;
    $pagination_table = $query_settings[10]->data;

    if(empty($followup_button_status)){
        $followup_button_status = 0;
    }
    if($followup_button_status==null || $followup_button_status==''){
        $followup_button_status = 0;
    }
    if(empty($pagination_table)){
        $pagination_table = 0;
    }

    // DATA USERS
    $blogs = array();
    $args = array( 'blog_id' => 0 );
    $users = get_users( $args );
    $data_users = '<option value="0">Choose CS</option>';
    foreach ($users as $row ) {
        $data_users .= '<option value="'.$row->ID.'">'.$row->display_name.'</option>';
    }


    if($role!='administrator'){
        $display_name = ' '.wp_get_current_user()->display_name;
    }else{
        $display_name = ' Administrator ';
    }

    if($nama_produk_status=='1'){
        $nama_produknya = 'Program';
    }elseif($nama_produk_status=='2'){
        $nama_produknya = 'Kegiatan';
    }elseif($nama_produk_status=='3'){
        $nama_produknya = $nama_produk_other_name;
    }else{
        $nama_produknya = 'Product';
    }


    
?>

<link rel="stylesheet" type="text/css" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/datatables/datatables.min.css?ver=<?php echo $plugin_version; ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/style-admin.css?ver=<?php echo $plugin_version; ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/datatables/dataTables.bootstrap4.min.css?ver=<?php echo $plugin_version; ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/toast/jquery.toast.css?ver=<?php echo $plugin_version; ?>" />

    <?php 
    if($pagination_table=='1'){
        echo '
    <style>
        /* page type input pagynate */

        #example_paginate {
            margin-top: 15px;
        }
        .dataTables_paginate.paging_input{
            font-size: 12px;
        }
        .paginate_button {
            background: #fff;
            margin-left: 3px;
            margin-right: 3px;
            padding: 6px 12px;
            border-radius: 4px;
            border: 1px solid #007BFF;
            color:#007BFF;
            cursor: pointer;
        }
        .paginate_button:hover {
            background: #007BFF;
            -moz-transition: background 0.2s;
            -webkit-transition: background 0.2s;
            -o-transition: background 0.2s;
            -ms-transition: background 0.2s;
            transition: background 0.2s;
            color:#fff;
        }
        .paginate_button.disabled {
            background: #92a5b91f;
            border: 1px solid #aaa;
            color: #444;
            cursor: default;
        }
        .paginate_input {
            width: 80px;
            text-align: center;
        }
        .previous.paginate_button{
            margin-right: 15px;
        }
        .next.paginate_button{
            margin-left: 15px;
        }

</style>
';

} ?>


<style>
    .modal {
       /* left: 25% !important;
        background-color: transparent !important;
        box-shadow: none !important;
        border: none !important;
        top:0% !important;*/
    }
    .field_hidden {
        display: none;
    }
    .checkbox_value {
        margin-bottom: 3px !important;
    }
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
    #statusinfo {
        right: 0;
        margin-right: 350px;
        margin-top: 255px;
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
        /*background:#ac1c34;*/
        background: #D8204C;
        padding:5px 8px 5px 5px;
        color:#fff;
        border-radius:16px;
        font-weight:300
    }
    .modal-header,.modal-body,.modal-footer{
        padding-left:1.75rem;
        padding-right:1.75rem
    }
    .modal-body{
        padding-top:1.75rem
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
    /*.jconfirm .jconfirm-box .jconfirm-buttons button.btn-blue{
        background-color:#db6934!important
    }
    .jconfirm .jconfirm-box .jconfirm-buttons button.btn-blue:hover{
        background-color:#de522c!important
    }*/
    .select2-container{
        float:left;
        font-size:14px
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
        margin-top: 20px;
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
        margin-top: 20px;
        color: #ffffff;
        border-radius: 3px;
        box-shadow: 0 5px 10px rgba(0,0,0,0.2),0 25px 80px rgba(0,0,0,0.1);
        text-align: center;
    }
    #div_total_order2 {
        width:160px;
        position: absolute;
        float: right;
        right: 0;
        margin-right: 685px;
        background: #b063c5;
        padding: 15px 25px;
        margin-top: 20px;
        color: #ffffff;
        border-radius: 3px;
        box-shadow: 0 5px 10px rgba(176,99,197,0.2),0 25px 80px rgba(176,99,197,0.1);
        text-align: center;
    }
    #div_closing_ratio2 {
        width:120px;
        position: absolute;
        float: right;
        right: 0;
        margin-right: 555px;
        background: #b063c5;
        padding: 15px 25px;
        margin-top: 20px;
        color: #ffffff;
        border-radius: 3px;
        box-shadow: 0 5px 10px rgba(176,99,197,0.2),0 25px 80px rgba(176,99,197,0.1);
        text-align: center;
    }
    #div_closing_ratio3 {
        width:120px;
        position: absolute;
        float: right;
        right: 0;
        margin-right: 425px;
        background: #b063c5;
        padding: 15px 25px;
        margin-top: 20px;
        color: #ffffff;
        border-radius: 3px;
        box-shadow: 0 5px 10px rgba(176,99,197,0.2),0 25px 80px rgba(176,99,197,0.1);
        text-align: center;
    }

    .text_closing_ratio {
        font-size: 12px
    }
    .title-1, .title-2 {
        /*background: #007BFF;*/
        /*background: #5C54CF;*/
        /*background: linear-gradient(to left, #5C54CF, #007BFF);*/
        /*background: linear-gradient(to left, #2C2EB8, #6c61f6);*/
        /*background: linear-gradient(to left, #5C54CF, #3052D7);*/
        background: linear-gradient(to left, #2C2EB8, #6c61f6);
    }
    p.modal-title {
        font-size: 12px;
    }
    .h5, h5 {
        font-size: 1.1rem;
    }
    .modal-content {
        border: none;
    }
    button#edit_order{
        background:#6c61f6 !important; 
        border: 1px solid#6c61f6 !important;
        box-shadow: 0px 0px 5px 5px rgba(0, 0, 0, 0.2);
        transition: 0.3s ease;
    }
    button#edit_order:hover {
        background: #5c51e3 !important;
    }
    .content-value {
        min-height: 20px;
    }
    #statusnya {
        max-width: none;
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
        .persen_closing {
            font-size: 11px;
        }
        #box-statistic {
            margin-top: 30px !important;
        }
        #div_settings_and_name {
            margin-top: 50px !important;
        }
        .button.data_order_settings {
            margin-right: 10px !important;
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
        .text_closing_ratio {
            font-size: 9px;
        }
        #div_filter {
            margin-top: 160px !important;
        }
    }
    @keyframes blink {
      0% {
        opacity: 0.2;
      }
      20% {
        opacity: 1;
      }
      100% {
        opacity: 0.2;
      }
    }

    .mgo_loading span {
      animation-name: blink;
      animation-duration: 1.4s;
      animation-iteration-count: infinite;
      animation-fill-mode: both;
      font-size: 18px;
    }

    .mgo_loading span:nth-child(2) {
      animation-delay: 0.2s;
    }

    .mgo_loading span:nth-child(3) {
      animation-delay: 0.4s;
    }
    .persen_closing {
        font-size: 13px;margin-left:2px;
    }
    .content-slug[contenteditable="true"]:active *, .content-value[contenteditable="true"]:active * {
        border: none;
        background: #fafafa;
    }
    p.content-csid, p.content-slug, p.content-value {
        margin:0;
    }
    [contenteditable="true"] {
        background: #eaeaea;
        padding: 2px 5px;
    }
    .btn_save {
        background: #007bff;color: #fff;padding: 2px 4px;border-radius: 4px;position: absolute;margin-left: -15px;
        cursor: pointer;
    }
    .btn_edit {
        color: #0073AA;
        cursor: pointer;
    }
    #loading_status2 {
        margin-right: 65%;
        position: absolute;
        left: 0;
        margin-left: 30px;
    }
    .status_gray {
        color: #C0CAD5 !important;
    }
    .box-stat {
        background: #fff;
        /*box-shadow: 0 4px 25px 0 rgba(0,0,0,.1);*/
        width: 100%;
        border-radius: 2px;
        border: 1px solid #fff;
        /*padding: 30px;*/
        /*float: left;*/
        /*margin-right: 2%;*/
        margin-bottom: 60px;
    }
    .box-stat2 {
        background: #fff;
        box-shadow: 0 4px 25px 0 rgba(0,0,0,.1);
        width: 44%;
        border-radius: 2px;
        border: 1px solid #fff;
        padding: 30px;
    }
    .mgo-header {
        padding-top: 0;
        margin-top: 39px;
    }
    .sub-title {
        min-height: 250px;
    }
    .button.data_order_settings {
        float: right;
        border: none;
        background: none;
        box-shadow: none;
        margin-top: -25px;
        margin-right: 10px;
        padding: 5px 5px;
        transition: 0.3s ease;
        cursor: pointer;
    }
    .button.data_order_settings:hover {
        background: none;
        color: #007BFF;
    }
    .data_order_user {
        color: #646e8a !important;
    }
    


</style>
<div class="wrap plugin_info"><h2 class="title" style="display: none;"></h2></div>
<div class="wrap" style="box-shadow: 0 4px 25px 0 rgba(0,0,0,.1);border-radius: 4px;">
<div class="sub-title" style="padding-bottom: 40px;margin-top: 18px;">
<header class="mgo-header" style="margin-top: 52px;">
    <h1 class="mgo-logo"><img class="icon-title2" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/magic-order-icon2.png?ver="></h1>
    <div id="div_settings_and_name">
        <span class='button data_order_user' style="float: right;border: none;background: none;box-shadow: none;margin-top: -25px;cursor: default;background: #97979712;border-radius: 40px;margin-right: 10px;margin-right: 10px;padding: 5px 20px;"><?php 
            if($role!='administrator'){
                echo ' '.wp_get_current_user()->display_name;
            }else{
                echo ' Administrator ';
            }
            ?>
            <img src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/user.png" style="width: 20px;margin-left: 12px;margin-top: -4px;">
            </span></span>
        <span class='button divider_user' style="float: right;border: none;background: none;box-shadow: none;margin-top: -25px;cursor: default;margin-right: 10px;padding: 5px 5px;">|</span>
        <a href="<?php echo admin_url('admin.php?page=magic_order_data_settings') ?>" style="cursor: pointer;height: 0;width: 0;">
        <span class='button data_order_settings' style=""><span class="dashicons dashicons-admin-generic" style="margin-top: 6px;margin-right: 3px;font-size: 16px;"></span>Settings</span>
        </a> 
        
        
    </div>
    
</header> 
            
    <?php

        if($apikey=='' || $apikey_status!='valid'){
            echo '
            <style>.sub-title-info {margin-top: 25px;}</style>
            <div class="sub-title-info"><span>API Key tidak valid atau belum tersedia, silahkan update API Key anda. <a href="'.site_url().'/wp-admin/admin.php?page=magic_order_api" style="text-decoration: none;">[ Update ]</a></span></div>';
            return false;
        }

        if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
            echo '
            <style>.sub-title-info {margin-top: 25px;}</style>
            <div class="sub-title-info"><span>Plugin Caldera Forms belum terinstall, silahkan install terlebih dahulu! <a href="'.site_url().'/wp-admin/plugin-install.php?s=caldera+forms&tab=search&type=term" style="text-decoration: none;">[ INSTALL ]</a></span></div>
            ';
            return false;
        }

        if($expired!='allowed'){
            echo '
            <style>.sub-title-info {margin-top: 25px;}</style>
            <div class="sub-title-info"><span>Maaf, plugin anda Expired. <a href="https://member.sinkronus.com" style="text-decoration: none;">[ Extend Now ]</a></span></div>
            ';
            return false;
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


            <!-- <span>Data Orders -<?php echo $display_name;?></span> -->
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

            <div style="position: absolute;font-size: 15px;display: none;margin-left: 30px;padding-top: 3px;" id="statusinfo"></div>
            <div id="box-statistic" style="margin-top: 15px;" >
                <div class="card-body" style="width: 33%;float: left;">
                        <div id="box-total-order" style="<?php if($dash_style!=1){echo'background: #8659cc;';}?>">
                            <div class="box-title-mgo">TOTAL ORDER</div>
                            <div class="box-text-mgo" style="font-weight: bold;margin-top: -2px;"><span id="total_order">0</span></div>
                        </div>
                        <div id="box-total-cod" style="<?php if($dash_style!=1){echo'display:none;';}?>">
                            <div class="box-title-mgo">TOTAL COD</div>
                            <div class="box-text-mgo" style="font-weight: bold;margin-top: -2px;<?php if($dash_style!=1){echo'color: #36b459;';}?>"><span id="total_cod">0</span></div>
                        </div>

                </div>
                <div class="card-body" style="width: 33%;float: left;">
                        <div style="width: 160px; height: 57px;text-align: center;padding: 7px 10px;color: #72727a;border-radius: 4px;padding-left: 30%;">
                            <div class="box-title-mgo">CLOSING RATIO</div>
                            <div class="box-text-mgo" style="font-weight: bold;margin-top: -2px;color: #3c3b55;<?php if($dash_style!=1){echo'color: #8659cc;';}else{echo'color: #f37206;';}?>"><span id="closing_ratio">0</span></div>
                        </div>
                        <div style="width: 160px; height: 57px;text-align: center;padding: 7px 10px;color: #72727a;border-radius: 4px;margin-top: 20px;padding-left: 30%;<?php if($dash_style!=1){echo'display:none;';}?>">
                            <div class="box-title-mgo">COD CLOSING RATIO</div>
                            <div class="box-text-mgo" style="font-weight: bold;margin-top: -2px;color: #3c3b55;<?php if($dash_style!=1){echo'display:none;';}else{echo'color: #5c54cf;';}?>"><span id="ctr_cod">0</span></div>
                        </div>

                </div>
                <div class="card-body" style="width: 33%;float: left;">
                        <div style="width: 160px; height: 57px;text-align: center;padding: 7px 10px;color: #72727a;border-radius: 4px;">
                            <div class="box-title-mgo">RTS RATIO</div>
                            <div class="box-text-mgo" style="font-weight: bold;margin-top: -2px;color: #3c3b55;<?php if($dash_style!=1){echo'color: #F47200;';}?>"><span id="rts_total">0</span></div>
                        </div>
                        <div style="width: 160px; height: 57px;text-align: center;padding: 7px 10px;color: #72727a;border-radius: 4px;margin-top: 20px;<?php if($dash_style!=1){echo'display:none;';}?>">
                            <div class="box-title-mgo">COD RTS RATIO</div>
                            <div class="box-text-mgo" style="font-weight: bold;margin-top: -2px;color: #3c3b55;"><span id="rts_cod">0</span></div>
                        </div>

                </div>
            </div>

            <div id="div_filter" style="padding-bottom:0px;font-size:15px;margin-top: 55px;">
                <span>Form: </span><select name="filter" id="form" class="form-control form-control-sm" style="width: 210px;padding-left:5px;padding-right:25px;margin-right:5px;display: inline;font-size:14px;">
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
                        <option value="product"><?php echo $nama_produknya; ?></option>
                        <option value="coupon">Coupon</option>
                        <option value="name">Customer Name</option>
                        <option value="date">Date</option>
                        <option value="status">Status</option>
                    </select>
                    <div id="box-filter" style="display: none;">
                        <div style="display: flex;">
                            <input type="text" id="orderid" placeholder="Order ID" class="form-control form-control-sm" style="width: 210px;display: inline;margin-right:5px;">
                            <input type="text" id="product" placeholder="<?php echo $nama_produknya; ?>" class="form-control form-control-sm" style="width: 210px;display: inline;margin-right:5px;">
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
                        <p style="position: absolute;margin-top: 40px;font-size: 11px;width: 40%;"><b>Note:</b> <Br>Jika anda pilih Confirmed dan status Packaged keluar, itu karena dalam order tersebut sudah terhitung Confirmed juga. Begitu juga pada Shipped dan Delivered.</p>
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
            <div class="wrap-container" style="padding:85px 30px 65px 30px;">
                <div class="table-responsive"> 
                    
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th style=""></th>
                                <th <?php if($no_show==0){echo 'style="display: none;"'; }?>>No</th>
                                <th <?php if($name_show==0){echo 'style="display: none;"'; }?>>Name</th>
                                <th <?php if($nama_produk_show==0){echo 'style="display: none;"'; }?>><?php echo $nama_produknya; ?></th>
                                <th <?php if($wanumber_show==0){echo 'style="display: none;"'; }?>>Whatsapp</th>
                                <th <?php if($otp_show==0){echo 'style="display: none;"'; }?>>OTP</th>
                                <th <?php if($form_show==0){echo 'style="display: none;"'; }?>>Form</th>
                                <th <?php if($orderid_show==0){echo 'style="display: none;"'; }?>>Order ID</th>
                                <th <?php if($cs_show==0){echo 'style="display: none;"'; }?>>CS</th>
                                <th <?php if($kupon_show==0){echo 'style="display: none;"'; }?>>Coupon</th>
                                <th <?php if($payment_show==0){echo 'style="display: none;"'; }?>>Payment</th>
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
                        <?php 
                        $del_button = '<button id="btn_del_mgo" class="button btn_mgo btn_red" style=""  ><span class="dashicons dashicons-trash delete_wa" style="color: #fff;margin-left: -10px;margin-top: 3px;margin-right: 4px;"></span>Delete Selected</button>';

                        if($role=='administrator'){
                            echo $del_button;
                        }else{
                            if($btn_del_status==0){}else{
                                echo $del_button;
                            }
                        }
                        ?>
                        <button id="btn_print_label" data-toggle="modal" data-target="#ModalPrintLabel" class="button btn_mgo" style=""  ><img src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/printer-white.png" style="width: 18px;margin-right: 5px;margin-top: -2px;">Print Label</button>

                        <button id="btn_download_all" disabled="" class="button btn_mgo" style="display: inline;"><img src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/csv.png" style="width: 18px;margin-right: 5px;">Download All</button>

                        <button id="btn_download_selected" disabled="" class="button btn_mgo" style="display: inline;"><img src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/csv.png" style="width: 18px;margin-right: 5px;">Download Selected</button>
                    </div>
                </div> <!-- table-responsive -->
            </div>
        <!-- Modal -->
        <div class="modal fade" id="ModalUpdateStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="top:45px;">
              <div class="modal-header title-1" style="color: #fff;border-bottom: 0;padding: 1rem 1.7rem 0.1rem 1.7rem;">
                <h5 class="modal-title" id="exampleModalLongTitle"><span class="dashicons dashicons-tag" style="padding-top: 5px; margin-right: 5px;"></span> Order ID: <span id="orderid_info"></span></h5><Br>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#ffffff;">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-header title-2" style="color: #fff;border-radius: 0; padding: 0.1rem 1.7rem 1.1rem 3.7rem">
                <p class="modal-title">Form: <span id="formid"></span></p>
              </div>
              <div class="modal-body">
                <div id="content_order" style="margin-bottom: 10px;padding-top: 10px;"></div>
              </div>
              <div class="modal-footer">
                &nbsp;<div id="loading_status2"></div>
                    <button id="edit_order" class="button btn_mgo" style="text-shadow: none !important;color:#fff !important;height: 36px !important;width: 85px !important;display: none;"><span class="dashicons dashicons-edit edit_order" style="font-size: 18px;padding-top: 4px;margin-right: 3px;"></span>Edit</button>
              </div>

            </div>
          </div>
        </div> 
        <!-- end modal -->

        <!-- Modal -->
        <div class="modal fade" id="ModalPrintLabel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-print-label" role="document">
            <div class="modal-content" style="top:45px;height: 540px;">
              <div class="modal-header title-1" style="color: #fff;border-bottom: 0;padding: 1rem 1.7rem 0.1rem 1.7rem;">
                <h5 class="modal-title" id="exampleModalLongTitle"><img src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/printer2.png" style="width: 60px;margin-right: 5px;"> Print Label Pengiriman <span id="jumlah_label"></span></h5><Br>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#ffffff;">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-header title-2" style="color: #fff;border-radius: 0; padding: 0.1rem 1.7rem 1.1rem 6rem">
                    <div class="print_settings" style="margin-top: -10px;font-size: 11px;">
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
<script src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/toast/jquery.toast.min.js?ver=<?php echo $plugin_version; ?>">
</script>

<script>

    // https://github.com/DataTables/Plugins/blob/master/pagination/input.js
    !function(e){function a(e){return Math.ceil(e._iDisplayStart/e._iDisplayLength)+1}function t(e){return Math.ceil(e.fnRecordsDisplay()/e._iDisplayLength)}e.fn.dataTableExt.oPagination.input={fnInit:function(s,n,i){var l=document.createElement("span"),r=document.createElement("span"),o=document.createElement("span"),u=document.createElement("span"),c=document.createElement("input"),p=document.createElement("span"),d=document.createElement("span"),h=s.oLanguage.oPaginate,g=s.oClasses,f=h.info||"Page _INPUT_ of _TOTAL_";l.innerHTML=h.sFirst,r.innerHTML=h.sPrevious,o.innerHTML=h.sNext,u.innerHTML=h.sLast,l.className="first "+g.sPageButton,r.className="previous "+g.sPageButton,o.className="next "+g.sPageButton,u.className="last "+g.sPageButton,c.className="paginate_input",p.className="paginate_total",""!==s.sTableId&&(n.setAttribute("id",s.sTableId+"_paginate"),l.setAttribute("id",s.sTableId+"_first"),r.setAttribute("id",s.sTableId+"_previous"),o.setAttribute("id",s.sTableId+"_next"),u.setAttribute("id",s.sTableId+"_last")),c.type="text",f=(f=f.replace(/_INPUT_/g,"</span>"+c.outerHTML+"<span>")).replace(/_TOTAL_/g,"</span>"+p.outerHTML+"<span>"),d.innerHTML="<span>"+f+"</span>",n.appendChild(l),n.appendChild(r),e(d).children().each(function(e,a){n.appendChild(a)}),n.appendChild(o),n.appendChild(u),e(l).click(function(){1!==a(s)&&(s.oApi._fnPageChange(s,"first"),i(s))}),e(r).click(function(){1!==a(s)&&(s.oApi._fnPageChange(s,"previous"),i(s))}),e(o).click(function(){a(s)!==t(s)&&(s.oApi._fnPageChange(s,"next"),i(s))}),e(u).click(function(){a(s)!==t(s)&&(s.oApi._fnPageChange(s,"last"),i(s))}),e(n).find(".paginate_input").keyup(function(e){if(38===e.which||39===e.which?this.value++:(37===e.which||40===e.which)&&this.value>1&&this.value--,""===this.value||this.value.match(/[^0-9]/))this.value=this.value.replace(/[^\d]/g,"");else{var a=s._iDisplayLength*(this.value-1);a<0&&(a=0),a>=s.fnRecordsDisplay()&&(a=(Math.ceil(s.fnRecordsDisplay()/s._iDisplayLength)-1)*s._iDisplayLength),s._iDisplayStart=a,s.oInstance.trigger("page.dt",s),i(s)}}),e("span",n).bind("mousedown",function(){return!1}),e("span",n).bind("selectstart",function(){return!1}),t(s)<=1&&e(n).hide()},fnUpdate:function(s){if(s.aanFeatures.p){var n=t(s),i=a(s),l=s.aanFeatures.p;if(n<=1)e(l).hide();else{var r=function(e){var a=e._iDisplayStart,t=e._iDisplayLength,s=e.fnRecordsDisplay(),n=-1===t,i=n?0:Math.ceil(a/t),l=n?1:Math.ceil(s/t),r=i>0?"":e.oClasses.sPageButtonDisabled,o=i<l-1?"":e.oClasses.sPageButtonDisabled;return{first:r,previous:r,next:o,last:o}}(s);e(l).show(),e(l).children(".first").removeClass(s.oClasses.sPageButtonDisabled).addClass(r.first),e(l).children(".previous").removeClass(s.oClasses.sPageButtonDisabled).addClass(r.previous),e(l).children(".next").removeClass(s.oClasses.sPageButtonDisabled).addClass(r.next),e(l).children(".last").removeClass(s.oClasses.sPageButtonDisabled).addClass(r.last),e(l).find(".paginate_total").html(n),e(l).find(".paginate_input").val(i)}}}}}(jQuery);

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

    function success_toast(text){
        $.toast({ 
          text : text, 
          showHideTransition : 'slide',
          bgColor : '#0abb87',
          textColor : '#fff',
          allowToastClose : false,
          hideAfter : 3000,
          stack : 5,
          textAlign : 'left',
          position : 'top-right'
        });
    }

    function failed_toast(text){
        $.toast({ 
          text : text, 
          showHideTransition : 'slide',
          bgColor : '#E92B4B',
          textColor : '#fff',
          allowToastClose : false,
          hideAfter : 3000,
          stack : 5,
          textAlign : 'left',
          position : 'top-right'
        });
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
            <?php if($pagination_table=='1'){ echo '"pagingType": "input",'; }?>
            "ordering": false,
            "searching": false,
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "destroy": true,
            "columnDefs": [
                    { targets: [0, 0], className: "checkbox_select"},
                    { targets: [0, 0], 'checkboxes': { 'selectRow': true }, visible: true },
                    { targets: [0, 1], visible: <?php if($no_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 2], visible: <?php if($name_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 3], visible: <?php if($nama_produk_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 4], visible: <?php if($wanumber_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 5], visible: <?php if($otp_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 6], visible: <?php if($form_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 7], visible: <?php if($orderid_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 8], visible: <?php if($cs_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 9], visible: <?php if($kupon_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 10], visible: <?php if($payment_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 11], visible: <?php if($total_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 12], visible: <?php if($date_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 13], visible: <?php if($detail_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 14], visible: <?php if($wa_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 15], className: "td_multiple_wa", visible: <?php if($multiple_wa_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 16], visible: <?php if($status_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 17], visible: <?php if($action_show==0){echo 'false'; }else{echo'true';}?>}
                ],
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
                // $("#total_order").text(numberWithDot(json.recordsTotal));
                // $("#closing_ratio").text(json.closingRatio);
            },
            "createdRow": function( row, data, dataIndex ) {
                var orderid = $(row).find('td:eq(1) span').data('orderid');
                var entryid = $(row).find('td:eq(1) span').data('entryid');
                $(row).attr('id', 'order_'+orderid).attr('class', 'order_'+entryid).attr('data-entryid',entryid);
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
            totalclosing_run(load);
        });


        // Set firstload Data Order
        totalclosing_run(0);

        function totalclosing_run(a){
            // console.log(a);
            $("#total_order").html("<p class='mgo_loading'><span>.</span><span>.</span><span>.</span></p>");
            $("#closing_ratio").html("<p class='mgo_loading'><span>.</span><span>.</span><span>.</span></p>");
            $("#rts_total").html("<p class='mgo_loading'><span>.</span><span>.</span><span>.</span></p>");
            $("#total_cod").html("<p class='mgo_loading'><span>.</span><span>.</span><span>.</span></p>");
            $("#ctr_cod").html("<p class='mgo_loading'><span>.</span><span>.</span><span>.</span></p>");
            $("#rts_cod").html("<p class='mgo_loading'><span>.</span><span>.</span><span>.</span></p>");


            if(a==0){
                var filter_form = '';
            }else{
                var filter_form = $('#form option:selected').val();
            }
            
            var load = a;
            var filter_option = $('#filter option:selected').val();
            var filter_cs = $('#cs option:selected').val();
            var filter_orderid = $('#orderid').val();
            var filter_product= $('#product').val();
            var filter_coupon= $('#coupon').val();
            var filter_name= $('#name').val();
            var filter_datestart= $('#date_start').val();
            var filter_dateend= $('#date_end').val();
            var filter_csdate= $('#cs_date').val();
            var filter_datestartcs= $('#date_startcs').val();
            var filter_dateendcs= $('#date_endcs').val();
            var filter_status= $('#status').val();
            var filter_statusdate= $('#status_date').val();
            var filter_datestartstatus= $('#date_start_status').val();
            var filter_dateendstatus= $('#date_end_status').val();

            var data_nya = [
                load,
                filter_form,
                filter_option,
                filter_cs,
                filter_orderid,
                filter_product,
                filter_coupon,
                filter_name,
                filter_datestart,
                filter_dateend,
                filter_csdate,
                filter_datestartcs,
                filter_dateendcs,
                filter_status,
                filter_statusdate,
                filter_datestartstatus,
                filter_dateendstatus,
            ];

            var data = {
                "action": "myaction_data_orders_totalclosing",
                "datanya": data_nya
            };
            
            jQuery.post(ajaxurl, data, function(response) {
                var fields = response.split("_");
                var total = fields[0];
                var closing = fields[1];
                var rts_total = fields[2];

                var total_cod = fields[3];
                var ctr_cod = fields[4];
                var rts_cod = fields[5];

                $("#total_order").html(total);
                $("#closing_ratio").html(closing+"<span class='persen_closing'>%</span>");
                $("#rts_total").html(rts_total+"<span class='persen_closing'>%</span>");
                $("#total_cod").html(total_cod);
                $("#ctr_cod").html(ctr_cod+"<span class='persen_closing'>%</span>");
                $("#rts_cod").html(rts_cod+"<span class='persen_closing'>%</span>");
            });
        }

        $('#btn_download_all').attr("disabled", true).attr("title", "Pilih Form di atas terlebih dahulu yang ingin di Download agar Button menjadi aktif.");
        $('#btn_download_selected').attr("disabled", true).attr("title", "Pilih Form di atas terlebih dahulu yang ingin di Download agar Button menjadi aktif.");

        $('#form').change(function (e) {
            if($('#form option:selected').val()=='0'){
                $('#btn_download_all').attr("disabled", true).attr("title", "Pilih Form di atas terlebih dahulu yang ingin di Download agar Button menjadi aktif.");
                $('#btn_download_selected').attr("disabled", true).attr("title", "Pilih Form di atas terlebih dahulu yang ingin di Download agar Button menjadi aktif.");
            }else{
                $('#btn_download_all').attr("disabled", false).attr("title", "");
                $('#btn_download_selected').attr("disabled", false).attr("title", "");
            }
            var load = 1;
            load_datatable(load);
            totalclosing_run(load);
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
                <?php if($pagination_table=='1'){ echo '"pagingType": "input",'; }?>
                "ordering": false,
                "searching": false,
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "destroy": true,
                "columnDefs": [
                    { targets: [0, 0], className: "checkbox_select"},
                    { targets: [0, 0], 'checkboxes': { 'selectRow': true }, visible: true },
                    { targets: [0, 1], visible: <?php if($no_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 2], visible: <?php if($name_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 3], visible: <?php if($nama_produk_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 4], visible: <?php if($wanumber_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 5], visible: <?php if($otp_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 6], visible: <?php if($form_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 7], visible: <?php if($orderid_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 8], visible: <?php if($cs_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 9], visible: <?php if($kupon_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 10], visible: <?php if($payment_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 11], visible: <?php if($total_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 12], visible: <?php if($date_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 13], visible: <?php if($detail_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 14], visible: <?php if($wa_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 15], visible: <?php if($multiple_wa_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 16], visible: <?php if($status_show==0){echo 'false'; }else{echo'true';}?>},
                    { targets: [0, 17], visible: <?php if($action_show==0){echo 'false'; }else{echo'true';}?>}
                ],
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
                    // $("#total_order").text(numberWithDot(json.recordsTotal));
                    // $("#closing_ratio").html(json.closingRatio);
                },
                "createdRow": function( row, data, dataIndex ) {
                    var orderid = $(row).find('td:eq(1) span').data('orderid');
                    var entryid = $(row).find('td:eq(1) span').data('entryid');
                    $(row).attr('id', 'order_'+orderid).attr('class', 'order_'+entryid).attr('data-entryid',entryid);
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
                    content: "<b>Pilih data order terlebih dahulu yang ingin di Download!",
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
                    content: "<b>Pilih data order terlebih dahulu yang ingin di Print!",
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

    

    $(document).on("click", "#edit_order", function() {
        $('.btn_edit').show();
        $('.btn_save').hide();
        $('.content-slug').attr('contenteditable','false');
        $('.content-value').attr('contenteditable','false');
    });

    $(document).on("click", ".btn_edit", function() {
        var orderid = $(this).data('id');
        $('#tr_'+orderid+' .content-slug').attr('contenteditable','true');
        $('#tr_'+orderid+' .content-value').attr('contenteditable','true');
        $('#tr_'+orderid+' .btn_save').show();
        $(this).hide();
        if ( $(this).hasClass("mgo_csid") ) {
            $('#tr_'+orderid+' .select_cs').show();
            $('#tr_'+orderid+' .cs_name').hide();
        }
        if ( $(this).hasClass("mgo_checkbox") ) {
            $('#tr_'+orderid+' .checkbox_value').removeClass('field_hidden');
            $('#tr_'+orderid+' .checkbox_all').addClass('field_hidden');
        }
    });

    $(document).on("click", ".btn_save", function() {
        var orderid = $(this).data('id');
        var slugnya = $('#tr_'+orderid+' .content-slug').text();
        var valuenya = $('#tr_'+orderid+' .content-value').text();
        var option_id = '';
        $('#tr_'+orderid+' .content-slug').attr('contenteditable','false');
        $('#tr_'+orderid+' .content-value').attr('contenteditable','false');
        $('#tr_'+orderid+' .btn_edit').show();
        $(this).hide();
        $("#loading_status2").show().html("Saving...");
        if ( $(this).hasClass("mgo_csid") ) {
            slugnya = $('#tr_'+orderid+' .content-csid').text();
            valuenya = $('#tr_'+orderid+' select').find("option:selected").val();
            name_cs = $('#tr_'+orderid+' select').find("option:selected").text();
            if(name_cs=='Select CS'){
                name_cs='-';
            }
            $('#tr_'+orderid+' .select_cs').hide();
            $('#tr_'+orderid+' .cs_name').show().text(name_cs);
            $('#order_'+orderid_tr+' .td_csname').text(name_cs);
        }
        if ( $(this).hasClass("mgo_orderid") ) {
            slugnya = $('#tr_'+orderid+' .content-orderid').text();
        }
        if ( $(this).hasClass("mgo_checkbox") ) {
            
            var new_selected = [];
            var new_selected2 = [];
            $('#tr_'+orderid+' .checkbox_value').each(function(){
                new_selected.push($(this).text());
                new_selected2.push($(this).attr('data-option')+'|'+$(this).text());
            });
            new_selected = new_selected.toString();
            valuenya = new_selected2.toString();

            $('#tr_'+orderid+' .checkbox_all').text(new_selected).removeClass('field_hidden');
            $('#tr_'+orderid+' .checkbox_value').addClass('field_hidden');

            // var option_id = $(this).attr('data-option');

            // alert(valuenya);
            // alert(slugnya);

        }

        // return false;

        var data_nya = [
            orderid,
            slugnya,
            valuenya
        ];

        var data = {
            'action': 'myaction_update_data_order',
            'datanya': data_nya
        };
        jQuery.post(ajaxurl, data, function(response) {
            $("#loading_status2").show().html(response).delay(3000).fadeOut();
        });
    });

    entry_idnya = '';
    $(document).on("click", ".update_status", function() {
        $('#edit_order').hide();
        entry_idnya = $(this).attr('data-entryid');
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
            content: 'Apakah anda Yakin ingin men-Delete Data Order ini?',
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
                                $("#order_"+order_id).remove();
                                $("#statusinfo").html('<p style="color: #20BF6B">Delete success!</p>').show().delay(3000).fadeOut();
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
        var data_textnya = $(this).attr("data-textnya");
        var idnya = "status_"+id_on_orders;
        var orderidnya = $("#orderid_info").text();

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
            content: 'Apakah anda Yakin ingin Men-Delete Data Order ini?',
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
                            id_on_orders,
                            orderidnya
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
                                // console.log(valuenya);
                                $("#"+idnya).addClass("hidden_status").removeClass("show_status").remove();
                                $("#statusnya "+valuenya).attr("disabled", false);

                                var textnya = $(".list-group-item.show_status:last").attr("data-textnya");
                                var colornya = $(".list-group-item.show_status:last").attr("data-colornya");

                                if (typeof textnya == "undefined") {
                                    $("#status_"+orderidnya).html("-");
                                    $("#status_"+orderidnya).css( "background-color", "#d0d3dd" );
                                }else{
                                    $("#status_"+orderidnya).text(textnya);
                                    $("#status_"+orderidnya).css( "background-color", colornya );
                                }
                            }

                            if(data_textnya=="RTS / Canceled"){
                                $('.d-flex h5').removeClass('status_gray');
                                $("#statusnya option[value=5]").attr("disabled", false);
                            }

                        });
                        
                    }
                },
            }
        });
    });

    orderid_tr = '';
    $(document).on("click", ".btn-detail-order", function() {
        $('#edit_order').show();
        var orderid = $(this).attr('data-id');
        orderid_tr = orderid;
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
        var formid = $(this).attr("data-formid");

        $("#img_"+no).hide();
        $("#icon_"+no).show();

        var data_nya = [
            entry_id,
            orderid,
            'followup1',
            formid
        ];

        var data = {
            "action": "myaction_send_wa",
            "datanya": data_nya
        };
        
        jQuery.post(ajaxurl, data, function(response) {
            // single
            var followup_wanotif_status = <?php if($followup_wanotif_status==null){echo '0';}else{echo $followup_wanotif_status;} ?>;
            if(followup_wanotif_status==1){
                var substring = "Failed";

                if(response.indexOf(substring) !== -1){
                    failed_toast(response);
                }else{
                    success_toast(response);
                }
            }else{
                var redirectWindow = window.open(response, "_blank");
                redirectWindow.location;
            }
            
            $("#img_"+no).show();
            $("#icon_"+no).hide();
            $("#wa_"+btn_id).removeClass("red");
            $("#img_"+no).attr("src","<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/wa.png?ver=<?php echo $plugin_version; ?>");
            // multiple
            $("#img_"+no+"_1").show();
            $("#icon_"+no+"_1").hide();
            $("#wa_"+btn_id+"_1").removeClass("red").addClass("green");
            $("#img_"+no+"_1").attr("src","<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/wa_24_green.png?ver=<?php echo $plugin_version; ?>");
            
        });
    });

    $(document).on("click", ".btn-send-wa-multiple1", function() {
        var entry_id = $(this).attr("data-entryid");
        var no = $(this).attr("data-no");
        var btn_id = $(this).attr("data-id");
        var orderid = $(this).attr("data-id");
        var formid = $(this).attr("data-formid");

        $("#img_"+no+"_1").hide();
        $("#icon_"+no+"_1").show();

        var data_nya = [
            entry_id,
            orderid,
            'followup1',
            formid
        ];
        var data = {
            "action": "myaction_send_wa",
            "datanya": data_nya
        };
        
        jQuery.post(ajaxurl, data, function(response) {
            // single
            var followup_wanotif_status = <?php if($followup_wanotif_status==null){echo '0';}else{echo $followup_wanotif_status;} ?>;
            if(followup_wanotif_status==1){
                var substring = "Failed";

                if(response.indexOf(substring) !== -1){
                    failed_toast(response);
                }else{
                    success_toast(response);
                }
            }else{
                var redirectWindow = window.open(response, "_blank");
                redirectWindow.location;
            }

            $("#img_"+no).show();
            $("#icon_"+no).hide();
            $("#wa_"+btn_id).removeClass("red");
            $("#img_"+no).attr("src","<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/wa.png?ver=<?php echo $plugin_version; ?>");
            // multiple
            $("#img_"+no+"_1").show();
            $("#icon_"+no+"_1").hide();
            $("#wa_"+btn_id+"_1").removeClass("red").addClass("green");
            $("#img_"+no+"_1").attr("src","<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/wa_24_green.png?ver=<?php echo $plugin_version; ?>");

        });

    });

    $(document).on("click", ".btn-send-wa-multiple2", function() {
       
        var followup_button_status = <?php echo $followup_button_status;?>;
        var entry_id = $(this).attr("data-entryid");
        var no = $(this).attr("data-no");
        var btn_id = $(this).attr("data-id");
        var orderid = $(this).attr("data-id");
        var formid = $(this).attr("data-formid");

        var id_wa_1 = "wa_"+btn_id+"_1";

        if(followup_button_status==0){
            if ($("#"+id_wa_1).hasClass("red")) {
                $.alert({
                    title: '',
                    content: '<b>Maaf,</b>oke Selesaikan dahulu followup pertama anda!',
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

        $("#img_"+no+"_2").hide();
        $("#icon_"+no+"_2").show();

        var data_nya = [
            entry_id,
            orderid,
            'followup2',
            formid
        ];
        var data = {
            "action": "myaction_send_wa",
            "datanya": data_nya
        };
        
        jQuery.post(ajaxurl, data, function(response) {
            // multiple
            var followup_wanotif_status = <?php if($followup_wanotif_status==null){echo '0';}else{echo $followup_wanotif_status;} ?>;
            if(followup_wanotif_status==1){
                var substring = "Failed";

                if(response.indexOf(substring) !== -1){
                    failed_toast(response);
                }else{
                    success_toast(response);
                }
            }else{
                var redirectWindow = window.open(response, "_blank");
                redirectWindow.location;
            }

            $("#img_"+no+"_2").show();
            $("#icon_"+no+"_2").hide();
            $("#wa_"+btn_id+"_2").removeClass("red").addClass("green");
            $("#img_"+no+"_2").attr("src","<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/wa_24_green.png?ver=<?php echo $plugin_version; ?>");
            
        });

    });

    

    $(document).on("click", ".btn-send-wa-multiple3", function() {
        var followup_button_status = <?php echo $followup_button_status;?>;

        var entry_id = $(this).attr("data-entryid");
        var no = $(this).attr("data-no");
        var btn_id = $(this).attr("data-id");
        var orderid = $(this).attr("data-id");
        var formid = $(this).attr("data-formid");

        var id_wa_1 = "wa_"+btn_id+"_1";
        var id_wa_2 = "wa_"+btn_id+"_2";
        if(followup_button_status==0){
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
        }

        $("#img_"+no+"_3").hide();
        $("#icon_"+no+"_3").show();

        var data_nya = [
            entry_id,
            orderid,
            'followup3',
            formid
        ];
        var data = {
            "action": "myaction_send_wa",
            "datanya": data_nya
        };
        
        jQuery.post(ajaxurl, data, function(response) {
            // multiple
            var followup_wanotif_status = <?php if($followup_wanotif_status==null){echo '0';}else{echo $followup_wanotif_status;} ?>;
            if(followup_wanotif_status==1){
                var substring = "Failed";

                if(response.indexOf(substring) !== -1){
                    failed_toast(response);
                }else{
                    success_toast(response);
                }
            }else{
                var redirectWindow = window.open(response, "_blank");
                redirectWindow.location;
            }

            $("#img_"+no+"_3").show();
            $("#icon_"+no+"_3").hide();
            $("#wa_"+btn_id+"_3").removeClass("red").addClass("green");
            $("#img_"+no+"_3").attr("src","<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/wa_24_green.png?ver=<?php echo $plugin_version; ?>");
            
        });

    });
    

    $(document).on("click", "#update_status_order", function(){
        var numItems = $(".list-group-item.show_status").length;
        var textnya_status = $("#statusnya option:selected").data("status");
        var idnya_status = $("#statusnya option:selected").val();
        var colornya_status = $("#statusnya option:selected").data("color");
        var ketnya_status = $("#statusnya option:selected").data("ket");
        var orderid = $(this).attr("data-id");
        var form_idnya = $("#formid").text();
        var additional_info = $("#additional_info").val();

        var last_status = $(".list-group-item.show_status:last").attr("data-textnya");

        if($('.list-group-item').length==0){
            // alert($('.list-group-item').length);
            // alert(idnya_status==5);
            // return false;
            if(idnya_status==5){
                $.alert({
                    title: '',
                    content: "<b>Maaf,</b> tidak bisa langsung RTS / Canceled. Minimal anda beri dahulu status Confirmed, kemudian status <b>RTS / Canceled</b>!",
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
        

        if(last_status == 'RTS / Canceled'){
            $.alert({
                title: '',
                content: "<b>Maaf,</b> Order ini sudah di set RTS / Canceled. Hapus terlebih dahulu status <b>RTS / Canceled</b>-nya!",
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

        
        var hasil = idnya_status-numItems;
        if(hasil>1){
            if(idnya_status<5){
                $.alert({
                    title: '',
                    content: "<b>Maaf,</b> mulailah dari Confirmed, Packaged, Shipped, selanjutnya Delivered!",
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
        if(hasil==0){
            $.alert({
                title: '',
                content: "<b>Maaf,</b> status ini sudah dibuat!",
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

        // alert(idnya_status);
        // return false;

        

        var data_nya = [
            orderid,
            idnya_status,
            additional_info,
            entry_idnya,
            form_idnya
        ];
        var data = {
            "action": "myaction_update_order_status",
            "datanya": data_nya
        };
        $("#status_loading_update").html("Loading...").show();
        jQuery.post(ajaxurl, data, function(response) {
            var fields = response.split("_");
            var info = fields[0];
            var idnya = fields[1];
            var idstatus = "status_"+idnya;

            if(textnya_status=='RTS / Canceled'){
                $('.d-flex h5').addClass('status_gray');
            }

            if(info=="success"){
                $("#status_loading_update").html('<span style="color:#20BF6B;">Update Status Success!</span>').delay(3000).fadeOut();

                var data2 = '<div id="'+idstatus+'" style="cursor:text;" class="list-group-item list-group-item-action flex-column align-items-start show_status" data-textnya="'+textnya_status+'" data-colornya="'+colornya_status+'"><div class="d-flex w-100 justify-content-between"><h5 class="mb-1" style="color:'+colornya_status+';font-size:16px;">'+textnya_status+'</h5><small><?php echo $datenya;?></small></div><p class="btn-delete-status" data-id="'+idnya+'" data-urutandiv="'+idnya_status+'" data-textnya="'+textnya_status+'"><span class="dashicons dashicons-trash" title="Delete Status"></span></p><p class="mb-1">'+ketnya_status+'</p><p class="mb-1">'+additional_info+'</p></div>';
                    
                    $("#content_order .list-group").append(data2);

                $("#status_"+orderid).text(textnya_status);
                $("#status_"+orderid).css( "background-color", colornya_status );

                var valuenya = "option[value="+idnya_status+"]";
                $("#statusnya "+valuenya).attr("disabled", true);
                
            }
        });
    });


    $('#btn_del_mgo').click(function (e) {
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
                content: "<b>Pilih data terlebih dahulu yang ingin di Delete!",
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
            content: 'Apakah anda Yakin ingin men-Delete Data Order ini?',
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
                        
                        $("#statusinfo").html('<p style="color: #343434">Loading...</p>').show();
        
                        var data_nya = [
                            new_selected
                        ];

                        // alert(new_selected);
                        // return false;
                        var data = {
                            "action": "myaction_delete_order_selected",
                            "datanya": data_nya
                        };
                        jQuery.post(ajaxurl, data, function(response) {
                            
                            if(response=='success'){
                                new_selected.forEach(function(entry) {
                                    console.log(entry);
                                   $('.order_'+entry).remove().prop("checked", true);
                                });
                                $("#statusinfo").html('<p style="color: #20BF6B">Delete success!</p>').show().delay(3000).fadeOut();
                            }else{
                                $("#statusinfo").html('<p style="color: #D8204C">Failed!</p>').show().delay(3000).fadeOut();
                            }


                        });

                    }
                },
            }
        });        
    });

</script>
    <?php
}