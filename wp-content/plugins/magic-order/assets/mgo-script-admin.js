
jQuery(document).ready(function($) {
	// alert(1);
	var classnya = 'a.caldera-header-preview-button';
	var href = $(classnya).attr('href');
	if (href != null){
		var arr = href.split('cf_preview=');
		var form_id = arr[1];
		$(classnya).after('<style>input, button[type=submit], h3.caldera-editor-field-title, .layout-form-field label { font-family: "FontAwesome", sans-serif !important; }</style><div class="divider-btn"></div><a class="button caldera-header-preview-button my_popup_open my_popup" id="btn_mgo" data-formid="'+form_id+'" href="#"><span class="notif_light_formula" style=""></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Formula</a><a class="button caldera-header-preview-button my_popup2_open my_popup2 btn_mgo" id="btn_mgo2" data-formid="'+form_id+'" href="#"><span class="notif_light_csrotator" style=""></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CS Rotator</a><a class="button caldera-header-preview-button my_popup3_open my_popup3 btn_mgo" id="btn_mgo3" data-formid="'+form_id+'" href="#"><span class="notif_light_setcourier" style=""></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Set Courier</a><div id="my_popup"><div id="box_popup" style="padding-left:50px;padding-right:50px;"><div class="box-title"><button class="my_popup_close" title="Close Popup" style="width: 35px;height: 35px;padding: 0;margin-right: 25px;cursor: pointer;margin-top:5px;"><span class="popup_close_x">×</span></button><span class="dashicons dashicons-admin-tools"></span><h3 style="color: #fff;position:absolute;">MAGIC ORDER - FORMULA</h3></div><div id="content_mgo" ><div style="padding-top:30px;">Loading...</div></div></div></div><div id="my_popup2"><div id="box_popup2" style="padding-left:50px;padding-right:50px;"><div class="box-title"><button class="my_popup2_close" title="Close Popup" style="width: 35px;height: 35px;padding: 0;margin-right: 25px;cursor: pointer;cursor:pointer;border-radius:30px;float:right;margin-right:-25px;border:none;margin-top:5px;"><span class="popup_close_x">×</span></button><span class="dashicons dashicons-groups"></span><h3 style="color: #fff;position:absolute;">ADD CS ROTATOR</h3></div><div id="content_mgo2" ><div style="padding-top:30px;">Loading...</div></div></div></div><div id="my_popup3"> <div id="box_popup3" style="padding-left:50px;padding-right:50px;"> <div class="box-title"> <button class="my_popup3_close" title="Close Popup" style="width: 35px;height: 35px;padding: 0;margin-right: 25px;cursor: pointer;cursor:pointer;border-radius:30px;float:right;margin-right:-25px;border:none;margin-top:5px;"><span class="popup_close_x">×</span></button><span class="dashicons dashicons-flag"></span> <h3 style="color: #fff;position:absolute;">SET COURIER</h3> </div><div id="content_mgo3" > <div style="padding-top:30px;">Loading...</div></div></div></div><div id="my_popup4"> <div id="box_popup4" style="padding-left:50px;padding-right:50px;"> <div class="box-title"> <button class="my_popup4_close" title="Close Popup" style="width: 35px;height: 35px;padding: 0;margin-right: 25px;cursor: pointer;cursor:pointer;border-radius:30px;float:right;margin-right:-25px;border:none;margin-top:5px;"><span class="popup_close_x">×</span></button><span class="dashicons dashicons-megaphone"></span><h3 style="color: #fff;position:absolute;">NOTIFICATION</h3></div><div id="content_mgo4" style="padding-top:80px;"><div style="padding-top:10px;">Loading...</div></div></div></div><div id="my_popup5"> <div id="box_popup5" style="padding-left:50px;padding-right:50px;"> <div class="box-title"> <button class="my_popup5_close" title="Close Popup" style="width: 35px;height: 35px;padding: 0;margin-right: 25px;cursor: pointer;cursor:pointer;border-radius:30px;float:right;margin-right:-25px;border:none;margin-top:5px;"><span class="popup_close_x">×</span></button><span class="dashicons dashicons-text"></span><h3 style="color: #fff;position:absolute;">ICONS</h3></div><div id="content_mgo5" style="padding-top:80px;"><div style="padding-top:10px;">Loading...</div></div></div></div><div id="my_popup6"> <div id="box_popup6" style="padding-left:60px;padding-right:60px;"> <div class="box-title"> <button class="my_popup6_close" title="Close Popup" style="width: 36px;height: 36px;padding: 0;margin-right: 26px;cursor: pointer;cursor:pointer;border-radius:30px;float:right;margin-right:-26px;border:none;margin-top:6px;"><span class="popup_close_x">×</span></button><span class="dashicons dashicons-text"></span><h3 style="color: #fff;position:absolute;">FORM STYLE</h3></div><div id="content_mgo6" style="padding-top:80px;"><div style="padding-top:10px;">Loading...</div></div></div></div>' );
	    $('.caldera-editor-header-nav').after('<span class="box_notif" id="box_notif" style="padding: 8px 10px;"><span class="btn_notif my_popup4_open my_popup4" id="btn_mgo4" data-formid="'+form_id+'" style="background: #444477;color:#ffffff;position: absolute;margin-left:4px;margin-top: 7px;padding: 5px 12px;padding-left:24px;border-radius: 4px;border-bottom: 2px solid #222;cursor: pointer;">Wanotif, SMS, Telegram<div class="notif_light" style=""></div></span></span>');
    }

    $('.caldera-editor-header .box_notif').hide();
    $('.caldera-editor-header.caldera-editor-subnav .box_notif').show();
    $('#layout-config-panel-main h3').append('<a class="add-new-h2 caldera-add-group my_popup5_open my_popup5 button btn_mgo btn_regular" id="show_icons" style="float:right;margin-right: 195px;"><i class="fa fa-smile-o" style="margin-right:5px;"></i>Show Icons</a><a class="add-new-h2 caldera-add-group my_popup6_open my_popup6 button btn_mgo btn_regular" id="show_form_style" style="float:right;margin-right: 5px;"><i class="fa fa-clone" style="margin-right:5px;"></i>Form Style</a>');

    function getDataUrl(t) {
        var a, r, e = decodeURIComponent(window.location.search.substring(1)).split("&");
        for (r = 0; r < e.length; r++)
            if ((a = e[r].split("="))[0] === t) return void 0 === a[1] || a[1]
    }

    var id_btn_notif = $(".box_notif").attr("id");
    form_idnya = '';
    if(id_btn_notif!=null){
        form_idnya = getDataUrl('edit');
        var data_nya = [
            form_idnya
        ];
        var data = {
            'action': 'myaction_form_notif_status',
            'datanya': data_nya
        };
        jQuery.post(ajaxurl, data, function(response) {

            var status = response.split("_");
            var notif_status = status[0];
            var formula_status = status[1];
            var csrotator_status = status[2];
            var setcourier_status = status[3];

            if(notif_status=='on'){
                $('.notif_light').addClass('on');
            }
            if(formula_status=='on'){
                $('.notif_light_formula').addClass('on');
            }
            if(csrotator_status=='on'){
                $('.notif_light_csrotator').addClass('on');
            }
            if(setcourier_status=='on'){
                $('.notif_light_setcourier').addClass('on');
            }
        });
    }


    var url = $("#wp-admin-bar-new-content .ab-item").attr("href");
    if (url != null){
        url = url.split("post-new.php");
        var new_url = url[0]+"admin.php?page=magic_order_data";
        $("#wp-admin-bar-new-content").after("<li style=cursor:pointer;><a href="+new_url+" class='ab-item dashicons dashicons-cart'>Data Orders</a></li>");
    }
    
	$('#btn_mgo').bind('click', function(){
        idform = $(this).data('formid');
    });

    $('#btn_mgo2').bind('click', function(){
        idform2 = $(this).data('formid');
    });
    
    $('#btn_mgo3').bind('click', function(){
        idform3 = $(this).data('formid');
    });

    
	// Initialize the plugin
    $('#my_popup').popup({
        transition: '0.4s',
        scrolllock: true,
        focusdelay: 400
    });
    $('.my_popup').bind('click', function(){
        var data_nya = [
            idform
        ];
        var data = {
            'action': 'myaction_get_datamgo_caldera',
            'datanya': data_nya
        };
        jQuery.post(ajaxurl, data, function(response) {
            $('#content_mgo').html(response);
        });
        $('#box_popup').show();
    });

    // Initialize the plugin
    $('#my_popup2').popup({
        transition: '0.4s',
        scrolllock: true,
        focusdelay: 400
    });
    $('.my_popup2').bind('click', function(){
        var data_nya = [
            idform2
        ];
        var data = {
            'action': 'myaction_get_datacs',
            'datanya': data_nya
        };
        jQuery.post(ajaxurl, data, function(response) {
            $('#content_mgo2').html(response);
        });
        $('#box_popup2').show();
    });

    // Initialize the plugin
    $('#my_popup3').popup({
        transition: '0.4s',
        scrolllock: true,
        focusdelay: 400
    });
    $('.my_popup3').bind('click', function(){
        $('#box_popup3').show();
        var data_nya = [
            idform3
        ];
        var data = {
            'action': 'myaction_get_datacourier',
            'datanya': data_nya
        };
        jQuery.post(ajaxurl, data, function(response) {
            $('#content_mgo3').html(response);
        });
    });

    // Initialize the plugin
    $('#my_popup4').popup({
        transition: '0.4s',
        scrolllock: true,
        focusdelay: 400
    });
    $('.my_popup4').bind('click', function(){
        $('#box_popup4').show();
        var data_nya = [
            form_idnya
        ];
        var data = {
            'action': 'myaction_get_datanotif',
            'datanya': data_nya
        };
        jQuery.post(ajaxurl, data, function(response) {
            $('#content_mgo4').html(response);
        });
        
    });


    // Initialize the plugin
    $('#my_popup5').popup({
        transition: '0.4s',
        scrolllock: true,
        focusdelay: 400
    });
    $('.my_popup5').bind('click', function(){
        $('#content_mgo5').html('Loading..');
        $('#box_popup5').show();
        $('#content_mgo5').html('<iframe src="https://fontawesome.com/v4.7.0/cheatsheet/" style="height:280px;width:540px"></iframe>');
    });


    // Initialize the plugin
    $('#my_popup6').popup({
        transition: '0.4s',
        scrolllock: true,
        focusdelay: 200
    });
    $('.my_popup6').bind('click', function(){
        form_idnya = getDataUrl('edit');
        // alert(form_idnya);
        $('#content_mgo6').html('Loading..');

        var data_nya = [
            form_idnya
        ];
        var data = {
            'action': 'myaction_get_formstyle',
            'datanya': data_nya
        };
        jQuery.post(ajaxurl, data, function(response) {
            $('#box_popup6').show();
            $('#content_mgo6').html(response);
        });

    });



    $("#wp-pointer-0").hide();

    $(document).on('click', '#line .btn-del', function(e) {
        var idnya = $(this).data("idnya");
        var new_idnya = "tr-"+idnya;
        console.log(new_idnya);
        $("#"+new_idnya).remove();
    });

    $(document).on('click', '#line_cs .btn-del-cs', function(e) {
        var idnya = $(this).data("idnya");
        var new_idnya = "tr-"+idnya;
        console.log(new_idnya);
        $("#"+new_idnya).remove();
    });

    $(document).on("change", "#provinsi", function(e) {
        $("#loader_kabkota img").show();
        var id_provinsi_selected = $(this).find(":selected").data("idprovinsi");
        var data_nya = [
            id_provinsi_selected
        ];
        var data = {
            "action": "myaction_get_kabkota",
            "datanya": data_nya
        };
        jQuery.post(ajaxurl, data, function(response) {
            $("#loader_kabkota img").hide();
            $("#kabkota").children().remove();
            $("#kabkota").append(response);
            $("#kabkota").prop("disabled", false);
            
        });
    });

    $(document).on("change", "#kabkota", function(e) {
        $("#loader_kabkota img").show();
        var id_kabkota_selected = $(this).find(":selected").data("idkabkota");  // $(this).attr('data-idkabkota');
        console.log(id_kabkota_selected);
        var data_nya = [
            id_kabkota_selected
        ];
        var data = {
            "action": "myaction_get_kec",
            "datanya": data_nya
        };
        jQuery.post(ajaxurl, data, function(response) {
            $("#loader_kabkota img").hide();
            $("#kecamatan").children().remove();
            $("#kecamatan").append(response);
            $("#kecamatan").prop("disabled", false);
            
        });
    });

    $(document).on("click", "#service_show", function(e) {
        $(".gojek_show").css({'opacity': '1'});
        $(".rupiah_show").css({'opacity': '0'});
    });
    $(document).on("click", "#service_show2", function(e) {
        $(".gojek_show").css({'opacity': '0'});
        $(".rupiah_show").css({'opacity': '1'});
    });

    $(document).on("click", "#save_courier", function(e) {
        var form_id = $(this).data("id");
        // var courier_code = $("input[type='radio'][name='couriercode']:checked").val();
        var courier_selected = [];
        $("input[type='checkbox'][name='couriercode']:checked").each(function(){
            courier_selected.push($(this).val());
        });
        courier_selected = courier_selected.toString();

        var provinsi_id = $("#provinsi option:selected").data("idprovinsi");
        var kabkota_id = $("#kabkota option:selected").data("idkabkota");
        var kec_id = $("#kecamatan option:selected").data("idkec");

        // var provinsi_id = $("#provinsi option:selected").val();
        var origin_province = $("#provinsi option:selected").text();
        // var kabkota_id = $("#kabkota option:selected").data("idkabkota");
        var origin_city = $("#kabkota option:selected").text();
        var weight = $("#weight").val();
        var service_show = $("input[type='radio'][name='service_show']:checked").val();
        var gojek_show = $("input[type='checkbox'][name='gojek_show']:checked").val();
        var rupiah_show = $("input[type='checkbox'][name='rupiah_show']:checked").val();
        var additional_cost = $("#additional_cost").val();
        var maximal_cost = $("#maximal_cost").val();
        var etd_status = $("input[type='checkbox'][name='etd_status']:checked").val();

        if (typeof(gojek_show) == 'undefined') {
            gojek_show = 0;
        }
        if (typeof(rupiah_show) == 'undefined') {
            rupiah_show = 0;
        }
        if (typeof(etd_status) == 'undefined') {
            etd_status = 0;
        }

        if(kabkota_id!=""){
            if(kabkota_id!=0){
                $(".notif_light_setcourier").addClass("on");
            }else{
                $(".notif_light_setcourier").removeClass("on");
            }
            
        }else{
            $(".notif_light_setcourier").removeClass("on");
        }

        $("#success_courier").html('<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;font-weight: bold;margin-top:35px;">Saving...</span>');

        var data_nya = [
            form_id,
            courier_selected,
            provinsi_id,
            kabkota_id,
            weight,
            service_show,
            gojek_show,
            rupiah_show,
            additional_cost,
            maximal_cost,
            origin_province,
            origin_city,
            etd_status,
            kec_id
        ];
        var data = {
            "action": "myaction_save_courier",
            "datanya": data_nya
        };
        jQuery.post(ajaxurl, data, function(response) {
            $("#success_courier").html(response);
        });
        
    });

    

    // *****************
    // CUSTOM CLASS
    // *****************
    /*

    $( '<div class="magic-tags-autocomplete magic-order-customclass hidden"><ul><li class="header" style="background: #0085ba;color: white;">Custom Class<span class="close-magic-customclass">Close (<i class="fa fa-close"></i>)</span></li><li class="header">Basic</li><li class="tag" data-tag="mgo_orderid">mgo_orderid</li><li class="tag" data-tag="mgo_nama">mgo_nama</li><li class="tag" data-tag="mgo_wa">mgo_wa</li><li class="tag" data-tag="mgo_total">mgo_total</li><li class="header">CS</li><li class="tag" data-tag="mgo_csid">mgo_csid</li><li class="tag" data-tag="mgo_csmail">mgo_csmail</li><li class="header">Produk</li><li class="tag" data-tag="mgo_nama_produk">mgo_nama_produk</li><li class="tag" data-tag="mgo_jumlah_barang">mgo_jumlah_barang</li><li class="header">Rajaongkir Metode 1</li><li class="tag" data-tag="mgo_provinsi">mgo_provinsi</li><li class="tag" data-tag="mgo_kab_kota">mgo_kab_kota</li><li class="tag" data-tag="mgo_kecamatan">mgo_kecamatan</li><li class="tag" data-tag="mgo_ongkos_kirim">mgo_ongkos_kirim</li><li class="header">Rajaongkir Metode 2</li><li class="tag" data-tag="mgo_kecamatan">mgo_kecamatan</li><li class="tag" data-tag="mgo_ongkos_kirim">mgo_ongkos_kirim</li><li class="header">Magic Ongkir</li><li class="tag" data-tag="mgo_kecamatan">mgo_kecamatan</li><li class="tag" data-tag="mgo_ongkos_kirim">mgo_ongkos_kirim</li><li class="header">Kode Unik</li><li class="tag" data-tag="mgo_codemin">mgo_codemin</li><li class="tag" data-tag="mgo_codeplus">mgo_codeplus</li><li class="tag" data-tag="mgo_3dwa">mgo_3dwa</li><li class="tag" data-tag="mgo_2dwa">mgo_2dwa</li><li class="header">Followup WA from Email</li><li class="tag" data-tag="followup1">followup1</li><li class="tag" data-tag="followup2">followup2</li><li class="tag" data-tag="followup3">followup3</li><li class="header">Produk di WooCommerce</li><li class="tag" data-tag="mgo_nama_produk">mgo_nama_produk</li><li class="tag" data-tag="mgo_kategori">mgo_kategori</li><li class="tag" data-tag="mgo_harga">mgo_harga</li><li class="tag" data-tag="mgo_ukuran">mgo_ukuran</li><li class="tag" data-tag="mgo_jumlah">mgo_jumlah</li><li class="header">Kupon Diskon</li><li class="tag" data-tag="mgo_kupon">mgo_kupon</li><li class="tag" data-tag="mgo_diskon">mgo_diskon</li></ul></div>' )
    .insertAfter( ".customclass-field input" );

    id_field = '';
    // set id field by click field (edit pen icon)
    $(document).on("click", ".layout-form-field", function(e) {
        id_field = $(this).data('config');
        id_field = id_field+'_settings_pane';

        // hide select option
        $('.magic-order-slug').addClass('hidden');
        $('.magic-order-customclass').addClass('hidden');
    });

    // set id field by click setting form on right panel
    $(document).on("click", ".wrapper-instance-pane", function(e) {
        id_field = $(this).attr('id');
    });

    // example di field: fld_8333063_settings_pane
    // set on custom class action when click
    $(document).on("focusin", ".customclass-field input", function(e) {
        $('.magic-order-customclass').removeClass('hidden');
        $('.magic-order-slug').addClass('hidden');
    });

    // ketika diketik hidden
    $(document).on("keypress", ".customclass-field input", function(e) {
        $('.magic-order-customclass').addClass('hidden');
    });

    // ketika arrow di tekan : show
    $(document).on("keypress", ".customclass-field input", function(e) {
        if(e.keyCode==39 || e.keyCode==40){
            $('.magic-order-customclass').removeClass('hidden');
        }else{
            $('.magic-order-customclass').addClass('hidden');
        }
    });

    // Pilihan di klik
    $(document).on("click", ".magic-order-customclass ul li", function(e) {
        var text = $(this).text();
        $('#'+id_field+' .customclass-field .caldera-config-field input').val(text);
        $('.magic-order-customclass').addClass('hidden');
    });

    // klik close
    $(document).on("click", ".close-magic-customclass", function(e) {
        $('.magic-order-customclass').addClass('hidden');
        return false;
    });
    */



    // *****************
    // SLUG
    // *****************
    /*
    $( '<div class="magic-tags-autocomplete magic-order-slug hidden"><ul><li class="header" style="background: #0085ba;color: white;">Magic Order Slug<span class="close-magic-slug">Close (<i class="fa fa-close"></i>)</span></li><li class="header">Basic</li><li class="tag" data-tag="mgo_orderid">mgo_orderid</li><li class="tag" data-tag="mgo_nama">mgo_nama</li><li class="tag" data-tag="mgo_wa">mgo_wa</li><li class="tag" data-tag="mgo_kode_unik">mgo_kode_unik</li><li class="tag" data-tag="mgo_pembayaran">mgo_pembayaran</li><li class="tag" data-tag="mgo_total">mgo_total</li><li class="header">CS</li><li class="tag" data-tag="mgo_csid">mgo_csid</li><li class="tag" data-tag="mgo_csmail">mgo_csmail</li><li class="header">Produk</li><li class="tag" data-tag="mgo_nama_produk">mgo_nama_produk</li><li class="tag" data-tag="mgo_jumlah_barang">mgo_jumlah_barang</li><li class="header">Rajaongkir Metode 1</li><li class="tag" data-tag="mgo_provinsi">mgo_provinsi</li><li class="tag" data-tag="mgo_kab_kota">mgo_kab_kota</li><li class="tag" data-tag="mgo_kecamatan">mgo_kecamatan</li><li class="tag" data-tag="mgo_ongkos_kirim">mgo_ongkos_kirim</li><li class="header">Rajaongkir Metode 2</li><li class="tag" data-tag="mgo_kecamatan_auto">mgo_kecamatan_auto</li><li class="tag" data-tag="mgo_ongkos_kirim">mgo_ongkos_kirim</li><li class="header">Magic Ongkir</li><li class="tag" data-tag="mgo_kecamatan">mgo_kecamatan</li><li class="tag" data-tag="mgo_ongkos_kirim">mgo_ongkos_kirim</li><li class="header">Followup WA from Email</li><li class="tag" data-tag="followup1">followup1</li><li class="tag" data-tag="followup2">followup2</li><li class="tag" data-tag="followup3">followup3</li><li class="header">Produk di WooCommerce</li><li class="tag" data-tag="mgo_nama_produk">mgo_nama_produk</li><li class="tag" data-tag="mgo_kategori">mgo_kategori</li><li class="tag" data-tag="mgo_harga">mgo_harga</li><li class="tag" data-tag="mgo_ukuran">mgo_ukuran</li><li class="tag" data-tag="mgo_jumlah">mgo_jumlah</li><li class="header">Kupon Diskon</li><li class="tag" data-tag="mgo_kupon">mgo_kupon</li><li class="tag" data-tag="mgo_diskon">mgo_diskon</li></ul></div>' )
    .insertAfter( "input.field-slug" );

    idslug = '';
    $(document).on("click", ".close-magic-slug", function(e) {
        $('.magic-order-slug').addClass('hidden');
        return false;
    });
    
    $(document).on("click", ".magic-order-slug ul li", function(e) {
        var text = $(this).text();
        $('#'+idslug).val(text);
        $('.magic-order-slug').addClass('hidden');

        // set automatic
        if(text=='mgo_orderid' || text=='mgo_wa' || text=='mgo_total' || text=='mgo_csid' || text=='mgo_csmail' 
            || text=='mgo_kupon' || text=='mgo_diskon' || text=='followup1' || text=='followup2' || text=='followup3') {
            set_value_customclass(text);
        }else if(text=='mgo_kode_unik'){

        }else{
            set_value_customclass('');
        }
    });

    function set_value_customclass(text){
        $('#'+id_field+' .customclass-field .caldera-config-field input').val(text);
    }

    $(document).on("focusin", "input.field-slug", function(e) {
        idslug = $(this).attr('id');
        $('.magic-order-slug').removeClass('hidden');
        $('.magic-order-customclass').addClass('hidden');
    });

    // ketika arrow di tekan : show
    $(document).on("keypress", "input.field-slug", function(e) {
        if(e.keyCode==39 || e.keyCode==40){
            $('.magic-order-slug').removeClass('hidden');
        }else{
            $('.magic-order-slug').addClass('hidden');
        }
    });
    */
    
});


