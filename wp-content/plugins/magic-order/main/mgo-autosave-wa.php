<?php

function magic_order_autosave_wa() {
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
    .modal-content {
        border: none;
    }
    .pagination, .dataTables_info {
        font-size: 13px;
    }
    .select-info .select-item {
        display: none;
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
        /*margin-top: -60px;*/
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
    a.btn-send-wa img {
        margin-right: 3px;
        margin-top: -3px;
    }
    .modal-header {
        background: #5C54CF !important;
    }
    .modal-header, .modal-body, .modal-footer {
        padding-left:1.75rem;
        padding-right:1.75rem;
    }
    .modal-body {
        padding-top: 1.75rem;
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
    #content_order .table td {
        padding-bottom: 0.75 !important;
    }
    #content_order p {
        margin-bottom: 0 !important;
    }
    table.dataTable {
        border-collapse: collapse !important;
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
        $table_name = $wpdb->prefix . "cf_forms";
        $table_name3 = $wpdb->prefix . "mgo_settings";

        // $apikey = $wpdb->get_results("SELECT * from $table_name3 where type='apikey'")[0];
        // $apikey_status = $wpdb->get_results("SELECT * from $table_name3 where type='apikey_status'")[0];
        $plugin_status = $wpdb->get_results("SELECT * from $table_name3 where type='plugin_status'")[0];
        $table_field = $wpdb->get_results("SELECT data from $table_name3 where type='table_field'")[0];
        
        $table_name4 = $wpdb->prefix . "cf_form_entry_values";
        $table_name5 = $wpdb->prefix . "cf_form_entries";
        $table_name6 = $wpdb->prefix . "mgo_orders";
        $table_name7 = $wpdb->prefix . "mgo_order_statuses";
        $table_name8 = $wpdb->prefix . "users";
        $table_name9 = $wpdb->prefix . "mgo_autosave_wa";
        
        // Get User ROLES
        $cap = get_user_meta( wp_get_current_user()->ID, $wpdb->get_blog_prefix() . 'capabilities', true );
        $roles = array_keys((array)$cap);
        $role = $roles[0];

        ?>

        <div class="wrap" style="box-shadow: 0 4px 25px 0 rgba(0,0,0,.1);border-radius: 4px;">
        <div class="sub-title" style="padding-bottom: 40px;margin-top: 18px;">
        <header class="mgo-header" style="margin-top: 52px;">
            <h1 class="mgo-logo"><img class="icon-title2" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/magic-order-icon2.png"></h1>
              
              <a href="<?php echo admin_url('admin.php?page=magic_order_autosave_wa_settings') ?>" style="cursor: pointer;height: 0;width: 0;">
                <span class='button' style="float: right;border: none;background: none;box-shadow: none;margin-top: -25px;"><span class="dashicons dashicons-admin-generic" style="margin-top: 6px;margin-right: 3px;font-size: 16px;"></span>Settings</span>
                </a>
        </header> 
  <?php

            if($apikey=='' || $apikey_status!='valid'){
                echo '
                <style>.sub-title-info{margin-top:25px;}</style>
                <div class="sub-title-info"><span>API Key tidak valid atau belum tersedia, silahkan update API Key anda. <a href="'.site_url().'/wp-admin/admin.php?page=magic_order_api" style="text-decoration: none;">[ Update ]</a></span></div>';
                return false;
            }

            if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
                echo '
                <style>.sub-title-info{margin-top:25px;}</style>
                <div class="sub-title-info"><span>Plugin Caldera Forms belum terinstall, silahkan install terlebih dahulu! <a href="'.site_url().'/wp-admin/plugin-install.php?s=caldera+forms&tab=search&type=term" style="text-decoration: none;">[ INSTALL ]</a></span></div>
                ';
                return false;
            }

            if($expired!='allowed'){
                echo '
                <style>.sub-title-info{margin-top:25px;}</style>
                <div class="sub-title-info"><span>Maaf, plugin anda Expired. <a href="https://member.sinkronus.com" style="text-decoration: none;">[ Extend Now ]</a></span></div>
                ';
                return false;
            }

            if($plugin_license=='FREEMIUM' || $plugin_license=='STARTER'){
                // echo $plugin_license_info;
                echo '
                <style>.sub-title-info{margin-top:25px;}</style>
                <div class="sub-title-info"><span>Maaf, Hanya untuk Basic dan PRO License.</span></div>
                ';
                return false;
            }

            // if($plugin_license=='FREEMIUM' || $plugin_license=='STARTER' || $plugin_license=='BASIC'){
            //     echo '<style>.sub-title-info{margin-top:25px;}</style>'
            //     echo $plugin_license_info;
            //     return false;
            // }

        ?>
        </div>
        
        <div class="wrap-container" style="padding:100px 30px; margin-top: -150px;">

            <div class="table-responsive"> 
                    
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th style=""></th>
                            <th>No</th>
                            <th>Name</th>
                            <th>Whatsapp</th>
                            <th>Form</th>
                            <th>Order ID</th>
                            <th>CS</th>
                            <th>Date</th>
                            <th>Detail</th>
                            <th>Followup</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                </table>
                <div style="margin-left:12px;margin-bottom: 20px;">
                    <hr>  
                    
                    <button id="btn_del_mgo" class="button btn_mgo btn_red" style=""  ><span class="dashicons dashicons-trash delete_wa" style="color: #fff;margin-left: -10px;margin-top: 3px;margin-right: 4px;"></span>Delete Selected</button>

                    <button id="btn_del_mgo2" class="button btn_mgo btn_red" style=""  ><span class="dashicons dashicons-trash delete_wa" style="color: #fff;margin-left: -10px;margin-top: 3px;margin-right: 4px;"></span>Delete ALL</button>

                </div>
            </div> <!-- table-responsive -->


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
<script type="text/javascript" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/datatables/dataTables.select.min.js?ver=<?php echo $plugin_version; ?>"></script>
<script type="text/javascript" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/datatables/dataTables.checkboxes.min.js?ver=<?php echo $plugin_version; ?>"></script>

<link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/confirm/jquery-confirm.min.css?ver=<?php echo $plugin_version; ?>">
<script src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/confirm/jquery-confirm.min.js?ver=<?php echo $plugin_version; ?>"></script>
<script>
    $(document).ready(function() {

        

        var load = 0;
        var table = $('#example').DataTable( {
            "ordering": false,
            "searching": false,
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "destroy": true,
            "columnDefs": [
                    { targets: [0, 0], className: "checkbox_select", visible: true},
                    { targets: [0, 0], 'checkboxes': { 'selectRow': true }, visible: true },
                    { targets: [0, 1], visible: true },
                    { targets: [0, 2], visible: true },
                    { targets: [0, 3], visible: true },
                    { targets: [0, 4], visible: true },
                    { targets: [0, 5], visible: true },
                    { targets: [0, 6], visible: true },
                    { targets: [0, 7], visible: true },
                    { targets: [0, 8], visible: true },
                    { targets: [0, 9], visible: true },
                    { targets: [0, 10], visible: true }
                ],
            "ajax": {
                "url": ajaxurl,
                "type": "POST",
                "dataSrc": "myList",
                'data': {
                    action: 'myaction_data_autosave_wa',
                    // filter_option: $('#filter option:selected').val(),
                    // filter_form: $('#form option:selected').val(),
                    // filter_cs: $('#cs option:selected').val(),
                    // filter_orderid: $('#orderid').val(),
                    // filter_product: $('#product').val(),
                    // filter_coupon: $('#coupon').val(),
                    // filter_name: $('#name').val(),
                    // filter_datestart: $('#date_start').val(),
                    // filter_dateendstatus: $('#date_end_status').val(),
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
                var rowid = $(row).find('td:eq(1) span').data('rowid');
                $(row).attr('id', 'order_'+orderid).attr('class', 'order_'+rowid).attr('data-entryid',entryid).attr('data-rowid',rowid);
            }
        });

    });
    $(document).ready(function() {

        $('.button.buttons-excel span').text('Download Excel');
        // document.title='WA NUMBER';
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

    $(document).on("click", "td", function(e) {
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
        }
    });

    /*
    $(document).on("click", "input", function(e) {
        // alert( 'Clicked on cell in visible column: '+table.cell( this ).index().columnVisible );
        // alert(1);
        // if($(this).hasClass("checkbox_select")){
            var classnya = $(this).closest('tr').attr("class");

            // alert(classnya);
            // return false;
            if(classnya.search("selected") != -1) {
                // uncheked
                $(this).closest('tr').removeClass("selected");
                $(this).find("input").prop('checked',false);
                alert(1);
            }else{
                // checked
                $(this).closest('tr').addClass("selected");
                alert(2);
                if($(this).find("input").prop('checked')){
                    
                    // $(this).find("input").prop('checked',true);
                    return false;
                }else{
                    $(this).find("input").prop('checked',true);
                }
            }
        // }
    });
    */
    

    $(document).on("click", ".delete_wa", function(e) {
        var order_id = $(this).attr('data-orderid');
        var form_id = $(this).attr("data-formid");

        // alert(order_id);
        // return false;
        $.confirm({
            title: 'Hello',
            content: 'Are you sure want to Delete this WA Number?',
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
                            order_id,
                            form_id
                        ];
                        var data = {
                            "action": "myaction_delete_wa",
                            "datanya": data_nya
                        };
                        jQuery.post(ajaxurl, data, function(response) {
                            if(response=="success"){
                                $("#order_"+order_id).hide();
                                $("#statusinfo").html('<p style="color: #20BF6B">Delete WA success!</p>').show().delay(2000).fadeOut();
                            }
                        });

                    }
                },
            }
        });
    });

    $('#btn_del_mgo').click(function (e) {
        // entry id
        var new_selected = [];
        var a = 0;
        id_order = '';
        $('.selected').each(function() {
            new_selected.push($(this).data("rowid"));
            a = a+1;
            id_order += $(this).data("rowid")+',';
        });

        if(new_selected.length == 0) {
            $.alert({
                title: '',
                content: "<b>Pilih data terlebih dahulu!",
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
            content: 'Are you sure want to Delete this Data?',
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
                        var data = {
                            "action": "myaction_del_autosave_wa",
                            "datanya": data_nya
                        };
                        jQuery.post(ajaxurl, data, function(response) {
                            
                            if(response=='success'){
                                new_selected.forEach(function(entry) {
                                    console.log(entry);
                                   $('.order_'+entry).remove();
                                });
                            }

                        });

                    }
                },
            }
        });        
    });


    $('#btn_del_mgo2').click(function (e) {
        
        $.confirm({
            title: 'Hello',
            content: 'Apakah anda yakin ingin Men-Delete seluruh Data? Data tidak akan kembali.',
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
                        
                        $("#statusinfo").html('<p style="color: #343434">Loading...</p>').show();
        
                        var data_nya = [
                            'delete_all'
                        ];
                        var data = {
                            "action": "myaction_del_all_autosave_wa",
                            "datanya": data_nya
                        };
                        jQuery.post(ajaxurl, data, function(response) {
                            
                            if(response=='success'){
                                // new_selected.forEach(function(entry) {
                                //     console.log(entry);
                                //    $('.order_'+entry).hide();
                                // });
                                $('tbody tr').hide();
                                
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
            "action": "myaction_send_wa2",
            "datanya": data_nya
        };
        
        jQuery.post(ajaxurl, data, function(response) {
            $("#img_"+no).show();
            $("#icon_"+no).hide();
            $("#wa_"+btn_id).removeClass("red");
            $("#img_"+no).attr("src","<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/wa.png");
            window.open(response,'_blank');
        });
    });


</script>
    <?php
}