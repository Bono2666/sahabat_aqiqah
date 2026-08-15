<?php
/*
Plugin Name: Magic Order
Description: Magic Order is The Best Plugin for Local e-Commerce and Fundraising.
Version: 3.1.0.10
Author: Ridwan Pujakesuma
Author URI: http://sinkronus.com
*/

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

function mgo_options_install() {
    global $wpdb;

    $table_name = $wpdb->prefix . "mgo_settings";
    $table_name2 = $wpdb->prefix . "mgo_calculation";
    $table_name3 = $wpdb->prefix . "mgo_orders";
    $table_name4 = $wpdb->prefix . "mgo_order_statuses";
    $table_name5 = $wpdb->prefix . "mgo_courier";
    $table_name6 = $wpdb->prefix . "mgo_coupons";
    $table_name7 = $wpdb->prefix . "mgo_autosave_wa";
    $table_name8 = $wpdb->prefix . "mgo_phone";
    $table_name9 = $wpdb->prefix . "mgo_moota_log";
    $table_name10 = $wpdb->prefix . "mgo_gf_calculation";
    $table_name11 = $wpdb->prefix . "mgo_gf_entry_values";
    $table_name12 = $wpdb->prefix . "mgo_lr";
    $table_name13 = $wpdb->prefix . "mgo_lr_log";
    $table_name14 = $wpdb->prefix . "mgo_order_log";


    $charset_collate = $wpdb->get_charset_collate();
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

    $sql = "CREATE TABLE $table_name (
		  id int(11) NOT NULL AUTO_INCREMENT,
		  type varchar(32) NOT NULL,
		  data text NOT NULL,
		  created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		  PRIMARY KEY  (id)
		) $charset_collate; ";
	dbDelta($sql);
	

    $sql = "CREATE TABLE $table_name2 (
		  id int(11) NOT NULL AUTO_INCREMENT,
		  id_form varchar(32) NOT NULL,
		  field_form text NOT NULL,
		  rumus_calculation text NOT NULL,
		  created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		  id_cs text DEFAULT NULL,
		  origin_province_id int(3) DEFAULT NULL,
		  origin_city_id int(8) DEFAULT NULL,
		  origin_district_id int(10) DEFAULT NULL,
		  courier varchar(360) NOT NULL,
		  weight int(18) DEFAULT NULL,
		  service_show int(1) NOT NULL,
		  gojek_show int(1) NOT NULL,
		  rupiah_show int(1) NOT NULL,
		  sms_status int(1) NOT NULL,
		  default_message_status int(1) NOT NULL,
		  custom_message text DEFAULT NULL,
		  rotator_status int(1) NOT NULL,
		  wanotif_status_form int(1) NOT NULL,
		  wanotif_default_message_status int(1) NOT NULL,
		  wanotif_custom_message text NOT NULL,
		  additional_cost int(12) DEFAULT NULL,
		  maximal_cost int(12) DEFAULT NULL,
		  reduction_cost int(12) DEFAULT NULL,
		  form_style varchar(32) NOT NULL,
		  tg_status int(1) NOT NULL,
		  tg_message_status int(1) NOT NULL,
		  tg_custom_message text NOT NULL,
		  tg_owner_status int(1) NOT NULL,
		  tg_csrotator_status int(1) NOT NULL,
		  tg_custom_status int(1) NOT NULL,
		  tg_custom_channel varchar(120) NOT NULL,
		  f_wa_status int(1) NOT NULL,
		  f_transfer_satu text NOT NULL,
		  f_transfer_dua text NOT NULL,
		  f_transfer_tiga text NOT NULL,
		  f_cod_satu text NOT NULL,
		  f_cod_dua text NOT NULL,
		  f_cod_tiga text NOT NULL,
		  origin_province text NOT NULL,
		  origin_city text NOT NULL,
		  etd_status int(1) NOT NULL,
		  error_message text NOT NULL,
		  wanotif_cod_message text NOT NULL,
		  cs_bobot text NOT NULL,
		  wanotif_forward text NOT NULL,
		  PRIMARY KEY  (id)
		)  $charset_collate; ";
	dbDelta($sql);

	
	$sql = "CREATE TABLE $table_name3 (
		  id int(11) NOT NULL AUTO_INCREMENT,
		  form_idnya varchar(21) DEFAULT NULL,
		  order_id varchar(32) DEFAULT NULL,
		  status_id int(3) DEFAULT NULL,
		  ket_order text DEFAULT NULL,
		  user_id varchar(12) DEFAULT NULL,
		  entry_idnya varchar(12) DEFAULT NULL,
		  status_rts int(3) DEFAULT NULL,
		  created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		  PRIMARY KEY  (id)
		 )  $charset_collate; ";

	dbDelta($sql);

	$wpdb->get_var("ALTER TABLE $table_name3 DROP `form_id`");
	$wpdb->get_var("ALTER TABLE $table_name3 DROP `entry_id`");

	// $db_collate = $wpdb->get_charset_collate();     
 //    $collate = '';
 //    $get_db_collate = explode("COLLATE ", $db_collate);
 //    if($get_db_collate!=''){
 //    	$collate = $get_db_collate[1];
 //    }

	// $wpdb->get_var("ALTER TABLE `$table_name3` CHANGE `form_id` `form_idnya` VARCHAR(12) CHARACTER SET utf8mb4 COLLATE $collate NULL DEFAULT NULL");
	// $wpdb->get_var("ALTER TABLE `$table_name3` CHANGE `entry_id` `entry_idnya` VARCHAR(12) CHARACTER SET utf8mb4 COLLATE $collate NULL DEFAULT NULL");


	$sql = "CREATE TABLE $table_name4 (
		  id int(11) NOT NULL AUTO_INCREMENT,
		  nama_status varchar(32) DEFAULT NULL,
		  ket_status text DEFAULT NULL,
		  color varchar(12) DEFAULT NULL,
		  icon varchar(32) DEFAULT NULL,
		  PRIMARY KEY  (id)
		)  $charset_collate; ";
	dbDelta($sql);	


	$sql = "CREATE TABLE $table_name5 (
		  id int(11) NOT NULL AUTO_INCREMENT,
		  courier_name varchar(64) DEFAULT NULL,
		  courier_code varchar(21) DEFAULT NULL,
		  created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		  PRIMARY KEY  (id)
		)  $charset_collate; ";
	dbDelta($sql);


	$sql = "CREATE TABLE $table_name6 (
		  id int(11) NOT NULL AUTO_INCREMENT,
		  coupon_type varchar(21) DEFAULT NULL,
		  coupon_name varchar(64) DEFAULT NULL,
		  coupon_code varchar(21) DEFAULT NULL,
		  coupon_discount int(18) DEFAULT NULL,
		  coupon_status int(1) DEFAULT NULL,
		  coupon_start datetime NOT NULL,
		  coupon_expired datetime NOT NULL,
		  created_at datetime NOT NULL,
		  PRIMARY KEY  (id)
		)  $charset_collate; ";
	dbDelta($sql);


	$sql = "CREATE TABLE $table_name7 (
		  id int(11) NOT NULL AUTO_INCREMENT,
		  name varchar(45) DEFAULT NULL,
		  wa_number varchar(16) DEFAULT NULL,
		  form_id varchar(20) DEFAULT NULL,
		  order_id varchar(20) DEFAULT NULL,
		  cs_id int(3) DEFAULT NULL,
		  status_followup int(1) NOT NULL,
		  created_at datetime NOT NULL,
		  PRIMARY KEY  (id)
		)  $charset_collate; ";
	dbDelta($sql);


	$sql = "CREATE TABLE $table_name8 (
		  id int(11) NOT NULL AUTO_INCREMENT,
		  orderid varchar(12) DEFAULT NULL,
		  phone varchar(16) DEFAULT NULL,
		  code varchar(4) DEFAULT NULL,
		  status int(1) DEFAULT NULL,
		  created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		  PRIMARY KEY  (id)
		)  $charset_collate; ";
	dbDelta($sql);


	$sql = "CREATE TABLE $table_name9 (
		  id int(11) NOT NULL AUTO_INCREMENT,
		  orderid varchar(12) DEFAULT NULL,
		  id_moota varchar(64) DEFAULT NULL,
		  desc_moota text DEFAULT NULL,
		  amount_moota int(64) DEFAULT NULL,
		  bank_moota varchar(32) DEFAULT NULL,
		  date_moota date NOT NULL,
		  created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		  PRIMARY KEY  (id)
		)  $charset_collate; ";
	dbDelta($sql);


    $sql = "CREATE TABLE $table_name10 (
		  id int(11) NOT NULL AUTO_INCREMENT,
		  id_form varchar(32) NOT NULL,
		  field_form text NOT NULL,
		  rumus_calculation text NOT NULL,
		  created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		  id_cs text DEFAULT NULL,
		  origin_province_id int(3) DEFAULT NULL,
		  origin_city_id int(8) DEFAULT NULL,
		  courier varchar(360) NOT NULL,
		  weight int(18) DEFAULT NULL,
		  service_show int(1) NOT NULL,
		  gojek_show int(1) NOT NULL,
		  rupiah_show int(1) NOT NULL,
		  sms_status int(1) NOT NULL,
		  default_message_status int(1) NOT NULL,
		  custom_message text DEFAULT NULL,
		  rotator_status int(1) NOT NULL,
		  wanotif_status_form int(1) NOT NULL,
		  wanotif_default_message_status int(1) NOT NULL,
		  wanotif_custom_message text NOT NULL,
		  additional_cost int(12) DEFAULT NULL,
		  maximal_cost int(12) DEFAULT NULL,
		  PRIMARY KEY  (id)
		)  $charset_collate; ";
	dbDelta($sql);


    $sql = "CREATE TABLE $table_name11 (
    	  id bigint(20) NOT NULL AUTO_INCREMENT,
		  gf_form_id mediumint(8) NOT NULL,
		  gf_entry_id bigint(20) NOT NULL,
		  gf_field_id varchar(255) DEFAULT NULL,
		  gf_custom_class varchar(60) DEFAULT NULL,
		  gf_label text,
		  gf_admin_label varchar(120) NOT NULL,
		  gf_value longtext,
		  gf_date_created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		  PRIMARY KEY  (id)
		)  $charset_collate; ";
	dbDelta($sql);


    $sql = "CREATE TABLE $table_name12 (
    	  id int(11) NOT NULL AUTO_INCREMENT,
		  lr_name varchar(160) NOT NULL,
		  lr_code varchar(160) NOT NULL,
		  lr_link text NOT NULL,
		  lr_priority text NOT NULL,
		  created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		  PRIMARY KEY  (id)
		)  $charset_collate; ";
	dbDelta($sql);



    $sql = "CREATE TABLE $table_name13 (
    	  id bigint(20) NOT NULL AUTO_INCREMENT,
		  id_lr int(12) NOT NULL,
		  link varchar(360) NOT NULL,
		  os varchar(32) NOT NULL,
		  browser varchar(32) NOT NULL,
		  ip varchar(21) NOT NULL,
		  city varchar(32) NOT NULL,
		  region varchar(32) NOT NULL,
		  country varchar(32) NOT NULL,
		  isp varchar(32) NOT NULL,
		  created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		  PRIMARY KEY  (id)
		)  $charset_collate; ";
	dbDelta($sql);



    $sql = "CREATE TABLE $table_name14 (
    	  id bigint(20) NOT NULL AUTO_INCREMENT,
		  id_form varchar(21) NOT NULL,
		  id_entry varchar(12) NOT NULL,
		  id_order varchar(21) NOT NULL,
		  os varchar(32) NOT NULL,
		  browser varchar(32) NOT NULL,
		  ip varchar(21) NOT NULL,
		  city varchar(32) NOT NULL,
		  region varchar(32) NOT NULL,
		  country varchar(32) NOT NULL,
		  isp varchar(32) NOT NULL,
		  created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		  PRIMARY KEY  (id)
		)  $charset_collate; ";
	dbDelta($sql);


	// ADD ROLE
	$role = get_role( 'editor' );
    $role->add_cap( 'manage_options' ); // capability

}
// run the install scripts upon plugin activation
register_activation_hook(__FILE__, 'mgo_options_install');


function mgo_options_install_data() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'mgo_settings';
	$table_name2 = $wpdb->prefix . 'mgo_order_statuses';
	$table_name3 = $wpdb->prefix . "mgo_courier";
	
	
	// table mgo_settings
	$data_array = array(
				'apikey',
	        	'apikey_status',
				'plugin_status',
	        	'apiurl',
	        	'wa_pembuka',
	        	'wa_penutup',
	        	'expired',
	        	'ro_apikey',
	        	'orderid_text',
	        	'orderid_max',
	        	'table_field',
	        	'atc_button',
	        	'additional_button',
	        	'additional_text',
	        	'additional_link',
	        	'wa_followup',
	        	'wa_autosave',
	        	'order_refresh_page',
	        	'order_refresh_second',
	        	'wa_followup_dua',
	        	'wa_followup_tiga',
	        	'userkey',
	        	'passkey',
	        	'notif',
	        	'urlnotif',
	        	'urlcs',
	        	'opentab',
	        	'formresend',
	        	'sms_status',
	        	'sms_userkey',
	        	'sms_passkey',
	        	'sms_apiurl',
	        	'sms_text',
	        	'jquery_active',
	        	'label_pengirim',
	        	'minchar',
	        	'fontawesome',
	        	'wanotif_status',
	        	'wanotif_type',
	        	'wanotif_apikey',
	        	'wanotif_url',
	        	'wanotif_message',
	        	'wanotif_csrotator',
	        	'moota_apikey',
	        	'moota_status',
	        	'moota_day',
	        	'mgo_license',
	        	'moota_wanotif_message',
	        	'btn_del_status',
	        	'followup_wanotif_status',
	        	'l_rotator',
	        	'moota_wanotif_status',
	        	'telegram_status',
				'telegram_apikey_bot',
				'telegram_id_bot',
				'telegram_username_bot',
				'telegram_message',
				'telegram_single_channel',
				'telegram_csrotator_channel',
				'nama_produk_status',
				'nama_produk_other_name',
				'order_id_status',
				'order_id_other_name',
				'dash_style',
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
		$query = $wpdb->get_results('SELECT data from '.$table_name.' where type="'.$value.'"');
		if($query==null){
			// -> klo gak ada, insert
			if($value=='apiurl'){
				$isi = 'https://magicongkir.sinkronus.com/api/autocomplete';
			}elseif($value=='wa_pembuka'){
				$isi = 'Halo <b>[mgo_nama]</b> <br>Terima kasih sudah order Kak *[mgo_nama]*, berikut rinciannya<br>[mgo_detail_order]<br>Silahkan transfer ke *[mgo_pembayaran]* agar segera kami proses.<br>Terimakasih';
			}elseif($value=='wa_penutup'){
				$isi = 'Untuk pembayaran, silahkan transfer ke rek,<br><b>BNI</b> <b>NO_REKENING</b><br><b>BCA</b> <b>NOREKENING</b><br><b>MANDIRI</b> <b>NOREKENING</b><br>a.n <b>NAMAANDA</b>';
			}elseif($value=='ro_apikey'){
				$isi = 'f8c9777c807e12be084a770f23c1a573';
			}elseif($value=='orderid_text'){
				$isi = 'MGO';
			}elseif($value=='orderid_max'){
				$isi = '8';
			}elseif($value=='table_field'){
				$isi = '0,1,3,4,5,6,7,8,9,10,11,12,13';
			}elseif($value=='atc_button'){
				$isi = '1';
			}elseif($value=='additional_button'){
				$isi = '0';
			}elseif($value=='wa_followup'){
				$isi = 'Ada yang bisa kami bantu bapak/ibu?';
			}elseif($value=='wa_autosave'){
				$isi = '0';
			}elseif($value=='order_refresh_page'){
				$isi = '1';
			}elseif($value=='order_refresh_second'){
				$isi = '300';
			}elseif($value=='wa_followup_dua'){
				$isi = 'Halo Ka, pesanannya sudah siap kami kirim.<br><br>Mohon untuk segera mengirimkan bukti transfernya yaa.<br>Terima kasih';
			}elseif($value=='wa_followup_tiga'){
				$isi = 'Halo Ka, mohon maaf apakah pesanannya jadi di order?<br><br>Kalau tidak, kami akan berikan untuk orang lain yang sudah memberikan bukti pembayaran.<br>Terima kasih';
			}elseif($value=='opentab'){
				$isi = 'self';
			}elseif($value=='formresend'){
				$isi = '1';
			}elseif($value=='sms_status'){
				$isi = '0';
			}elseif($value=='sms_apiurl'){
				$isi = 'http://reguler.sms-notifikasi.com/apps/smsapi.php';
			}elseif($value=='sms_text'){
				$isi = 'Yth Bp/Ibu [mgo_nama], ID [mgo_orderid] untuk pembelian [mgo_nama_produk] sejumlah [mgo_total] mohon ditransfer ke BNI 0291235757 a.n Ridwan. Terimakasih';
			}elseif($value=='jquery_active'){
				$isi = '1';
			}elseif($value=='label_pengirim'){
				$isi = '<b>Magic Order Shop</b><br><div>Bandung, Jawa Barat</div><div>087812345678<br></div>';
			}elseif($value=='minchar'){
				$isi = '3';
			}elseif($value=='fontawesome'){
				$isi = '1';
			}elseif($value=='wanotif_status'){
				$isi = '0';
			}elseif($value=='wanotif_type'){
				$isi = '0';
			}elseif($value=='wanotif_url'){
				$isi = 'https://api.wanotif.id/v1';
			}elseif($value=='moota_status'){
				$isi = '0';
			}elseif($value=='moota_day'){
				$isi = '2';
			}elseif($value=='moota_wanotif_message'){
				$isi = 'Terimakasih [mgo_nama], kami telah menerima pembayaran untuk Order ID [mgo_orderid]. Pesanan [mgo_nama_produk] anda akan segera kami proses.';
			}elseif($value=='btn_del_status'){
				$isi = '1';
			}elseif($value=='followup_wanotif_status'){
				$isi = '0';
			}elseif($value=='l_rotator'){
				$isi = 'abc';
			}elseif($value=='moota_wanotif_status'){
				$isi = '1';
			}elseif($value=='telegram_status'){
				$isi = '0';
			}elseif($value=='telegram_message'){
				$isi = 'Alhamdulillah ada orderan masuk [mgo_detail_order]';
			}elseif($value=='nama_produk_status'){
				$isi = '0';
			}elseif($value=='nama_produk_other_name'){
				$isi = 'Acara';
			}elseif($value=='order_id_status'){
				$isi = '0';
			}elseif($value=='order_id_other_name'){
				$isi = 'ID Pemesanan';
			}elseif($value=='dash_style'){
				$isi = '1';
			}elseif($value=='utc_status'){
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


	    	$wpdb->insert( 
				$table_name, 
				array(
					'type' => $value,
					'data' => $isi
				) 
			);

		}
    }


    // table mgo_order_statuses
    $data_array2 = array(
				'Confirmed',
	        	'Packaged',
				'Shipped',
	        	'Delivered',
	        	'RTS / Canceled',
			);

    foreach ($data_array2 as $key => $value) {
    	$query = $wpdb->get_results('SELECT nama_status from '.$table_name2.' where nama_status="'.$value.'"');
    	if($query==null){

    		if($value=='Confirmed'){
				$ket_status = 'Order confirmed';
				$color = '#FED330';
				$icon = 'confirmed.png';
			}elseif($value=='Packaged'){
				$ket_status = 'Your Order is packaged';
				$color = '#FD9644';
				$icon = 'packaged.png';
			}elseif($value=='Shipped'){
				$ket_status = 'Your Order is shipped';
				$color = '#209ABF';
				$icon = 'shipped.png';
			}elseif($value=='Delivered'){
				$ket_status = 'Your Order is delivered';
				$color = '#20BF6B';
				$icon = 'delivered.png';
			}elseif($value=='RTS / Canceled'){
				$ket_status = 'Your Order is canceled';
				$color = '#FC5C65';
				$icon = 'rts.png';
			}else{
				$ket_status = '';
				$color = '';
				$icon = '';
			}

    		$wpdb->insert( 
				$table_name2, 
				array(
					'nama_status' => $value,
					'ket_status' => $ket_status,
					'color' => $color,
					'icon' => $icon
				) 
			);
    	}
    }


    // table mgo_order_courier
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
    	$query = $wpdb->get_results('SELECT courier_code from '.$table_name3.' where courier_code="'.$value.'"');
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
			}else{
				$courier_name = '';
			}

    		$wpdb->insert( 
				$table_name3, 
				array(
					'courier_name' => $courier_name,
					'courier_code' => $value
				) 
			);
    	}
    }


}
register_activation_hook(__FILE__, 'mgo_options_install_data');



function deactivate_plugin_mgo() {
 	
 	// REMOVE ROLE
    $role = get_role( 'editor' );
    $role->remove_cap( 'manage_options' ); // capability

}
register_deactivation_hook( __FILE__, 'deactivate_plugin_mgo' );


// register jquery and style on initialization
function register_mgo_script() {
    global $wpdb;
    // admin
    mgo_global_vars();
    $plugin_version = $GLOBALS['mgovars']['plugin_version'];
    $plugin_license = $GLOBALS['mgovars']['plugin_license'];

    $table_name = $wpdb->prefix . "mgo_settings";
	$row = $wpdb->get_results('SELECT data from '.$table_name.' where type="apikey" or type="page_protector" or type="mgo_footer" ORDER BY id ASC');
	$apikeynya = $row[0]->data;
	$apikey_five = substr($apikeynya, 0, 5);
	$page_protector = $row[1]->data;
	$mgo_footer = $row[2]->data;
	if(empty($page_protector)){
        $page_protector = '0';
    }
	if(empty($mgo_footer)){
        $mgo_footer = '0';
    }
    
    // wp_register_script( 'mgo_script_admin', plugin_dir_url( __FILE__ ) . 'assets/mgo-script-admin.js', array(), $plugin_version, true );
    wp_register_script( 'mgo_script_admin', plugin_dir_url( __FILE__ ) . 'assets/mgo-script-admin.js', array(), null, true );
    wp_register_script( 'mgo_script_admin2', plugin_dir_url( __FILE__ ) . 'assets/jquery.popupoverlay.js', array(), $plugin_version, true );
    if(isset($_GET['page'])){
	  	if($_GET['page']=='gf_edit_forms' || $_GET['page']=='gf_entries'){
	  		// wp_register_script( 'mgo_script_admin3', plugin_dir_url( __FILE__ ) . 'assets/mgo-script-gf-admin.js', array(), $plugin_version, true );
	  	}
	}
	if (isset($_GET['page'])) {
		if ($_GET['page']=='caldera-forms') {
			wp_register_script( 'mgo_script_admin4', plugin_dir_url( __FILE__ ) . 'assets/mgo-script-tagit.js', array(), $plugin_version, true );
		}
	}
	// if (isset($_GET['action'])) {
	// 	if ($_GET['action']=='elementor') {
	// 		wp_register_script( 'mgo_script', plugin_dir_url( __FILE__ ) . 'assets/mgo-script.js', array(), $plugin_version, true );
	// 	}
	// }

    wp_register_script( 'mgo_script', plugin_dir_url( __FILE__ ) . 'assets/mgo-script.js', array(), $plugin_version, true );

	$translation_array = array( 
		'templateUrl' => get_site_url(), 
		'license' => strtoupper($plugin_license), 
		'mgofirstfive' => $apikey_five,
		'pluginUrl' => plugin_dir_url( __FILE__ ),
		'pageP' => $page_protector,
		'poweredBy' => $mgo_footer
	);
	wp_localize_script( 'mgo_script', 'object_name', $translation_array );
}
add_action('init', 'register_mgo_script');



// use the registered jquery and style above
function enqueue_mgo_style(){
   wp_enqueue_script('mgo_script');
   // wp_enqueue_script('mgo_script2');
   // wp_enqueue_script('mgo_script3');
}
add_action('wp_enqueue_scripts', 'enqueue_mgo_style');


function enqueue_mgo_admin_style(){
   wp_enqueue_script('mgo_script_admin');
   wp_enqueue_script('mgo_script_admin2');
   wp_enqueue_script('mgo_script_admin3');
   wp_enqueue_script('mgo_script_admin4');
}
add_action('admin_enqueue_scripts', 'enqueue_mgo_admin_style');


function load_custom_wp_admin_style() {
	mgo_global_vars();
    $plugin_version = $GLOBALS['mgovars']['plugin_version'];
    // wp_register_style( 'mgo_style_admin', plugin_dir_url( __FILE__ ) . 'assets/mgo-style-admin.css', false, $plugin_version );
    wp_register_style( 'mgo_style_admin', plugin_dir_url( __FILE__ ) . 'assets/mgo-style-admin.css', false, null );
    wp_enqueue_style( 'mgo_style_admin' );

    if(isset($_GET['page'])){
	  	if($_GET['page']=='gf_edit_forms' || $_GET['page']=='gf_entries'){
	  		wp_register_style( 'mgo_style_admin2', plugin_dir_url( __FILE__ ) . 'assets/mgo-style-gf-admin.css', false, $plugin_version );
    		wp_enqueue_style( 'mgo_style_admin2' );
	  	}
	}
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );


function load_custom_mgo_style_front() {
	mgo_global_vars();
    $plugin_version = $GLOBALS['mgovars']['plugin_version'];
    wp_register_style( 'mgo_style_front', plugin_dir_url( __FILE__ ) . 'assets/mgo-style.css', false, $plugin_version );
    wp_enqueue_style( 'mgo_style_front' );
}
add_action( 'wp_enqueue_scripts', 'load_custom_mgo_style_front' );

function load_custom_mgo_style_toast() {
	mgo_global_vars();
    $plugin_version = $GLOBALS['mgovars']['plugin_version'];
    wp_register_style( 'mgo_style_toast', plugin_dir_url( __FILE__ ) . 'assets/toast/toastify.min.css', false, $plugin_version );
    // wp_register_style( 'mgo_style_toast', 'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css', null, null );
    
    wp_enqueue_style( 'mgo_style_toast' );
}
add_action( 'wp_enqueue_scripts', 'load_custom_mgo_style_toast' );


function magic_order_header() {
	global $wpdb;
	mgo_global_vars();
    $plugin_version = $GLOBALS['mgovars']['plugin_version'];
    $plugin_license = $GLOBALS['mgovars']['plugin_license'];


    $table_name = $wpdb->prefix . "mgo_settings";
	$row = $wpdb->get_results('SELECT data from '.$table_name.' where type="jquery_active" ORDER BY id ASC');
	if(isset($row[0]->data)){
        $jquery_active  = $row[0]->data;
    }else{
        $jquery_active = '1';
    }

    if($jquery_active=='0'){}else{
	echo '<script type="text/javascript" src="'.plugin_dir_url( __FILE__ ) . 'assets/jquery-2.1.1.min.js?ver='.$plugin_version.'"></script>';
	}
	echo '<script type="text/javascript" src="'.plugin_dir_url( __FILE__ ) . 'assets/toast/toastify.min.js?ver='.$plugin_version.'"></script>';
	echo '<script type="text/javascript" src="'.plugin_dir_url( __FILE__ ) . 'assets/jquery.countdown.min.js?ver='.$plugin_version.'"></script>';
}
add_action('wp_head', 'magic_order_header');



$itemsForm = array();
function filter_caldera_forms_render_entry_id( $entry_id, $form ) {
		mgo_global_vars();
	    $plugin_version = $GLOBALS['mgovars']['plugin_version'];
	    $plugin_license = $GLOBALS['mgovars']['plugin_license'];
	    // $form_id = $form['ID'];
	    // echo (json_encode($form));

	    global $myDataForm;
	    global $itemsForm;

		$myDataForm = $form;
		// $dataID = $myDataForm['ID'];
		// echo $myDataForm['ID'];
		$itemsForm[] = $myDataForm['ID'];

		// $a++;

};
add_filter( 'caldera_forms_render_entry_id', 'filter_caldera_forms_render_entry_id', 10, 2 ); 


add_action( 'wp_footer', 'magic_order_footer');
function magic_order_footer() {

	global $wpdb;
	global $myDataForm;
	global $itemsForm;

	// print_r(json_encode($myDataForm));

	if (empty($itemsForm)){
		// echo 'Form Kosong';
		return false;
	}else{
		// echo $dataID.' '.$a;
		// print_r($itemsForm);
		$jumlah_form_caldera = count($itemsForm);

		$query_form_setting = '';
		if($jumlah_form_caldera==1){
			$query_form_setting = "id_form='".$itemsForm[0]."'";
		}else{

			$i = 1;
			foreach($itemsForm as $item) {
				$idForm = $item;
				if($i<$jumlah_form_caldera){
					$query_form_setting .= "id_form='".$idForm."' or ";
				}else{
					$query_form_setting .= "id_form='".$idForm."'";
				}
				
				$i++;
			}
		}
	}

	// echo $myDataFormID = $myDataForm['ID'];
	$data_form = json_encode($myDataForm);
	// print_r($data_form);

	$table_name = $wpdb->prefix . "mgo_calculation";
	$table_name_cf = $wpdb->prefix . "cf_forms";
	$rows = $wpdb->get_results("SELECT * from $table_name where $query_form_setting");
	// $rows = $wpdb->get_results("SELECT * from $table_name");


	mgo_global_vars();
    $plugin_version = $GLOBALS['mgovars']['plugin_version'];
    $plugin_license = $GLOBALS['mgovars']['plugin_license'];

	$table_name2 = $wpdb->prefix . "mgo_settings";

	// Set Data on Mgo Settings
	$data_array = array(
        	'jquery_active',
        	'minchar',
        	'fontawesome',
	);

	foreach ($data_array as $key => $value) {
		// cek apakah di table ada sesuai "type" ?
		$query = $wpdb->get_results('SELECT data from '.$table_name2.' where type="'.$value.'"');
		if($query==null){
			// klo gak ada, insert data
			if($value=='jquery_active'){
				$isi = '1';
			}elseif($value=='minchar'){
				$isi = '3';
			}elseif($value=='fontawesome'){
				$isi = '1';
			}else {
				$isi = '';
			}

	    	$wpdb->insert( 
				$table_name2, 
				array(
					'type' => $value,
					'data' => $isi
				) 
			);

		}
    }

	$row2 = $wpdb->get_results('SELECT data from '.$table_name2.' where type="orderid_text" or type="orderid_max" or type="atc_button" or type="additional_button" or type="additional_text" or type="additional_link" or type="jquery_active" or type="fontawesome" ORDER BY id ASC');
	$orderid_text = $row2[0]->data;
	$orderid_max = $row2[1]->data;
	$atc_button = $row2[2]->data;
	$additional_button = $row2[3]->data;
	$additional_text = $row2[4]->data;
	$additional_link = $row2[5]->data;
	if(isset($row2[6]->data)){
        $jquery_active  = $row2[6]->data;
    }else{
        $jquery_active = '1';
    }
	$fontawesome = $row2[7]->data;


	$table_name3 = $wpdb->prefix . 'mgo_settings';
	$query_settings = $wpdb->get_results('SELECT data from '.$table_name3.' where type="wa_autosave" or type="minchar"');
	$wa_autosave = $query_settings[0]->data;
	$minchar = $query_settings[1]->data;

	if($minchar==null){
		$mincharacter = 1;
	}else{
		$mincharacter = $minchar;
	}


	if($fontawesome==1){
	echo '<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />';
	}
	// echo '<link href="'.plugin_dir_url( __FILE__ ) . 'assets/select2/select2.min.css?ver='.$plugin_version.'" rel="stylesheet" />';
	echo '<style>
	.mgo_total input, .mgo_orderid input { border: none !important; box-shadow: none !important; font-size: 24px !important; background:#fff !important;padding-left: 0 !important;color: transparent !important;
  text-shadow: 0 0 0 #464646 !important;cursor: default !important; }.mgo_total input:focus, .mgo_orderid input:focus {outline: none !important;}.mgo_ongkir input[readonly], .mgo_orderid input[readonly] {background-color: #fff !important;font-size:21px !important;
	} .ui-menu{z-index:999;padding:0;max-height:200px!important;width:280px;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;background:#FFF;cursor:default;overflow:auto;-webkit-box-shadow:0 6px 12px rgba(50,50,50,.34);-moz-box-shadow:0 6px 12px rgba(50,50,50,.34);box-shadow:0 6px 12px rgba(50,50,50,.34);border-bottom:16px solid #fff}.ui-menu li div{padding-left:5px}.ui-menu-item{padding:6px;white-space:nowrap;overflow:hidden}.ui-menu-item:hover{background:#F0F0F0}.loading-show{background:url("'.plugin_dir_url( __FILE__ ).'assets/icons/loader2.gif") right no-repeat!important;background-size:34px 34px!important}.ui-helper-hidden-accessible{border:0;clip:rect(0 0 0 0);height:1px;margin:-1px;overflow:hidden;padding:0;position:absolute;width:1px}</style>
	';

	echo '<script type="text/javascript" src="'.plugin_dir_url( __FILE__ ) . 'assets/jquery-ui.min.js?ver='.$plugin_version.'"></script>';
	
	// echo '<script type="text/javascript" src="'.plugin_dir_url( __FILE__ ) . 'assets/jquery.auto-complete-pixabay.min.js?ver='.$plugin_version.'"></script>';
	// echo '<script type="text/javascript" src="'.plugin_dir_url( __FILE__ ) . 'assets/jquery.auto-complete-devbridge.min.js?ver='.$plugin_version.'"></script>';
	// echo '<script type="text/javascript" src="'.plugin_dir_url( __FILE__ ) . 'assets/select2/select2.min.js?ver='.$plugin_version.'"></script>';
	// echo '<script type="text/javascript" src="'.plugin_dir_url( __FILE__ ) . 'assets/kecamatan.js?ver='.$plugin_version.'"></script>';

	if (strpos($data_form, 'mgo_kecamatan_auto') !== false || strpos($data_form, 'mgo_courier') !== false) {

	    echo '<script type="text/javascript" src="'.plugin_dir_url( __FILE__ ) . 'assets/jquery.auto-complete-devbridge.min.js?ver='.$plugin_version.'"></script>';
		echo '<script type="text/javascript" src="'.plugin_dir_url( __FILE__ ) . 'assets/kecamatan.js?ver='.$plugin_version.'"></script>';
		
	}else{
		echo '<script>var kecamatan = {}</script>';
	}

	if (strpos($data_form, 'mgo_provinsi') !== false || strpos($data_form, 'mgo_courier') !== false) {

	    echo '<link href="'.plugin_dir_url( __FILE__ ) . 'assets/select2/select2.min.css?ver='.$plugin_version.'" rel="stylesheet" />';
	    echo '<script type="text/javascript" src="'.plugin_dir_url( __FILE__ ) . 'assets/select2/select2.min.js?ver='.$plugin_version.'"></script>';

	}

	echo '<script>';

	echo '
	jQuery(document).ready(function($) {
		// Courier select2
		var id_multiple_courier = $(".mgo_courier.set_default select").attr("id");
		if(id_multiple_courier!=null){
		    $(".mgo_courier.set_default select").select2({
		        templateResult: formatState,
		        minimumResultsForSearch: -1
		    });
		    function formatState (state) {
			  if (!state.id) { return state.text; }
			  var $state = $(
			   '."'".'<span style="float:left;"><img style="display: inline-block;" src="'."'".'+object_name.pluginUrl+'."'".'/assets/icons/courier/'."'".'+state.element.value.toLowerCase() + '."'".'.png" /></span><span style="margin-left:10px;"> '."'".' + state.text + '."'".'</span>'."'".'
			  );
			  return $state;
			}
			$(".mgo_courier.set_default select").on("select2:select", function (e) {
			    var data = e.params.data;
			    $(".mgo_courier.set_default .select2-selection__rendered").prepend('."'".'<span style="float:left;margin-right:12px;"><img style="display: inline-block;" src="'."'".'+object_name.pluginUrl+'."'".'/assets/icons/courier/'."'".'+data.text.toLowerCase() + '."'".'.png" /></span>'."'".');
			});
		}

		// Set Default
		id_provinsi2 = "";
		var id_mgo_provinsi2 = $(".mgo_provinsi.set_default select").attr("id");
		if(id_mgo_provinsi2!=null){
			var fields_mgo_provinsi2 = id_mgo_provinsi2.split("-wrap");
			id_provinsi2 = fields_mgo_provinsi2[0];
			$("#"+id_provinsi2).css({"position":"inherit"});
		}else{
			try {
				$(".mgo_provinsi select").select2({
			    	minimumResultsForSearch: -1
				});
				$(".mgo_kabkota select").select2({
				    minimumResultsForSearch: -1
				});
				$(".mgo_kecamatan select").select2({
				    minimumResultsForSearch: -1
				});
			} catch (e) {}
		}

		getFromBetween={results:[],string:"",getFromBetween:function(t,s){try{if(this.string.indexOf(t)<0||this.string.indexOf(s)<0)return!1;var i=this.string.indexOf(t)+t.length,e=this.string.substr(0,i),r=this.string.substr(i),n=e.length+r.indexOf(s);return this.string.substring(i,n)}catch(t){}},removeFromBetween:function(t,s){try{if(this.string.indexOf(t)<0||this.string.indexOf(s)<0)return!1;var i=t+this.getFromBetween(t,s)+s;this.string=this.string.replace(i,"")}catch(t){}},getAllResults:function(t,s){try{if(this.string.indexOf(t)<0||this.string.indexOf(s)<0)return;var i=this.getFromBetween(t,s);if(this.results.push(i),this.removeFromBetween(t,s),!(this.string.indexOf(t)>-1&&this.string.indexOf(s)>-1))return;this.getAllResults(t,s)}catch(t){}},get:function(t,s,i){try{return this.results=[],this.string=t,this.getAllResults(s,i),this.results}catch(t){}}};

	    function makeid(max) {
		  	var text = "";
		  	if(max==14 || max==15 || max==16){
		  		if(max==14){max=4;}if(max==15){max=5;}if(max==16){max=6;}
		  		var possible = "0123456789";
	  		}else{
	  			var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	  		}
		  	
		  	for (var i = 0; i < max; i++){
		    	text += possible.charAt(Math.floor(Math.random() * possible.length));
			}
			return text;
		}

		var new_selected_orderid = [];
	    $(".mgo_orderid").each(function(){
	            new_selected_orderid.push($(this).attr("id"));
	    });
	    // console.log(new_selected_orderid);
	    new_selected_orderid = new_selected_orderid.toString();
	    var array_orderid = new_selected_orderid.split(",");

	    var arrayLengthOrderID = array_orderid.length;
	    orderid_form = "";
	    for (var i = 0; i < arrayLengthOrderID; i++) {
	    	// console.log(array_orderid[i]);
	    	var id_mgo_orderid = array_orderid[i];
			if(id_mgo_orderid!=null){
				var fields_mgo_orderid = id_mgo_orderid.split("-wrap");

				var classnya_id = $("#"+id_mgo_orderid).attr("class");
				var result_id = getFromBetween.get(classnya_id,"{ID:","}");
				var string_id = result_id[0];

				if(string_id!=undefined){
					var randomid = makeid('.$orderid_max.');
					var fix_mgo_orderid = string_id+"'.$orderid_text.'"+randomid;
				}else{
					var randomid = makeid('.$orderid_max.');
					var fix_mgo_orderid = "'.$orderid_text.'"+randomid;
				}

				try {
				  	document.getElementById(fields_mgo_orderid[0]).readOnly = true;
					document.getElementById(fields_mgo_orderid[0]).value = fix_mgo_orderid;
					orderid_form = fix_mgo_orderid;
				} catch (e) {
					console.log("Magic Order Log : Custom class mgo_orderid Not Found");
				}	
			}
	    }

		var id_mgo_total = $(".mgo_total").attr("id");
		if(id_mgo_total!=null){
			var fields_mgo_total = id_mgo_total.split("-wrap");
			document.getElementById(fields_mgo_total[0]).readOnly = true;
			document.getElementById(fields_mgo_total[0]).value = "Rp0";
		}

		var id_mgo_ongkir = $(".mgo_ongkir").attr("id");
		if(id_mgo_ongkir!=null){
			var fields_mgo_ongkir = id_mgo_ongkir.split("-wrap");
			$("#"+fields_mgo_ongkir[0]).attr("readonly","readonly");
		}

		$(".mgo_ongkir.set_jx .radio label").append("<span class=label-ongkir></span>");

		hargaongkir = 0;

		try {
		  	$( ".mgo_kecamatan input" ).autocomplete({
			  	source: function (request, response) {
			  		var className = $(".mgo_kecamatan").attr("class");
			        $.ajax({
				        type:"POST",
			            url: object_name.templateUrl+"/wp-admin/admin-ajax.php",
			            data: {
			                action:"mgo_api", 
			                term:request.term,
			                from:className
			            },
				        success: response,
				        dataType: "json",
				        minLength: '.$mincharacter.',
				        delay: 100,
				        error: response
		        	});
			    },
			  	minLength: '.$mincharacter.',
			  	search: function () {
		        	$(this).addClass("loading-show");
			    },
			    response: function (event, ui) {
			        $(this).removeClass("loading-show");
			    },
			  	select: function(event, ui) {
			  		$(this).val(ui.item.value);
			  		var jx_service = ui.item.service;
			  		if (typeof jx_service !== "undefined") {
			  			var jx_harga = commaToInt(ui.item.harga);
			  			var jx_harga_dot = addCommas(commaToInt(ui.item.harga));
			  			$(".mgo_ongkir.set_jx .radio input").attr("checked", true);
			  			$(".mgo_ongkir.set_jx input").val(jx_service+" (Bayar di tempat) - Estimasi harga Rp "+jx_harga_dot);
			  			$(".mgo_ongkir.set_jx input").attr("data-calc-value", jx_harga);
			  			if(jx_service=="COD"){
			  				var icon_service = "cod.png";
			  				var text_service = jx_service+" (Bayar di tempat) - ";
			  			}else{
			  				var icon_service = "box.png";
			  				var text_service = "";
			  			}
			  			$(".mgo_ongkir.set_jx .label-ongkir").html('."'".'<img style="width:40px;display:inherit;margin-left:15px;margin-top:-3px;" src="'.plugin_dir_url( __FILE__ ).'assets/icons/'."'".'+icon_service+'."'".'"><span style="margin-left:10px;">'."'".'+text_service+'."'".'Estimasi harga Rp '."'".'+jx_harga_dot+'."'".'</span>'."'".');

			  			hargaongkir = parseInt(jx_harga);
				  		$(".mgo-caldera .two.ongkir").text("Rp "+addCommas(hargaongkir));
			  		}else{
			  			var mystring = ui.item.harga;
						var harganya = mystring.replace(/,/g , "");
						hargaongkir = parseInt(harganya);
				  		$(".mgo_ongkir input").val(hargaongkir).attr("value", hargaongkir);
				  		$("input.mgo_ongkir").val(hargaongkir).attr("value", hargaongkir);
				  		$(".mgo-caldera .two.ongkir").text("Rp "+addCommas(hargaongkir));
			  		}
			  	}
			});
		} catch (e) {
			console.log("Magic Order Log : autocomplete is not a function. Gak dapat Jquery si Autocompletenya");
		}
	    

		// Set ID CSID and ID CSMAIL
		id_csid = "";
		var id_mgo_cs = $(".mgo_csid").attr("id");
		if(id_mgo_cs!=null){
			var fields_mgo_cs = id_mgo_cs.split("-wrap");
			id_csid = fields_mgo_cs[0];
			document.getElementById(id_csid).readOnly = true;
		}

		id_csmail = "";
		var id_mgo_csmail = $(".mgo_csmail").attr("id");
		if(id_mgo_csmail!=null){
			var fields_mgo_csmail = id_mgo_csmail.split("-wrap");
			id_csmail = fields_mgo_csmail[0];
			document.getElementById(id_csmail).readOnly = true;
		}

		id_cswa = "";
		var id_mgo_cswa = $(".mgo_cswa").attr("id");
		if(id_mgo_cswa!=null){
			var fields_mgo_cswa = id_mgo_cswa.split("-wrap");
			id_cswa = fields_mgo_cswa[0];
			document.getElementById(id_cswa).readOnly = true;
		}

		// GET CS From DB
		public_csid = 0;
		id_caldera_form = "";
		var caldera_form = $(".caldera_forms_form").attr("id");
		if(caldera_form!=null){
			var fields_caldera_form = caldera_form.split("_");
			id_caldera_form = fields_caldera_form[0];

			var data_nya = [
	        	id_caldera_form
		    ];
		    var data = {
		        "action": "myaction_get_cs",
		        "datanya": data_nya
		    };
		    jQuery.post(object_name.templateUrl+"/wp-admin/admin-ajax.php", data, function(response) {
		    	if(id_csid!=""){
		    		var csid = response.split("#");
		    		document.getElementById(id_csid).value = csid[0];
		    		public_csid = csid[0];
		    	}
		    	if(id_csmail!=""){
		    		var mail = response.split("#");
		    		document.getElementById(id_csmail).value = mail[1];
		    	}
		    	if(id_cswa!=""){
		    		var wa = response.split("#");
		    		document.getElementById(id_cswa).value = wa[2];
		    	}
		    });
		}

		$(".mgo_provinsi label").append("<img src='.plugin_dir_url( __FILE__ ).'assets/icons/loader2.gif>"),$(".mgo_kabkota label").append("<img src='.plugin_dir_url( __FILE__ ).'assets/icons/loader2.gif>"),$(".mgo_kecamatan label").append("<img src='.plugin_dir_url( __FILE__ ).'assets/icons/loader2.gif>"),$(".mgo_kecamatan_auto label").append("<img src='.plugin_dir_url( __FILE__ ).'assets/icons/loader2.gif>"),$(".mgo_ongkoskirim label").append("<img src='.plugin_dir_url( __FILE__ ).'assets/icons/loader2.gif>"),$(".mgo_kupon label").append("<img src='.plugin_dir_url( __FILE__ ).'assets/icons/loader2.gif>");
		
	
	});
	';

    // AUTOSAVE WA
	if($wa_autosave==1){
	echo '
	jQuery(document).ready(function($){id_wa="";var id_mgo_wa=$(".mgo_wa input").attr("id");if(null!=id_mgo_wa){var fields_mgo_wa=id_mgo_wa.split("-wrap");id_wa=fields_mgo_wa[0]}
var orderidnya="";if($(".mgo_orderid input").val()!=null){orderidnya=$(".mgo_orderid input").val()}else{orderidnya=$("input.mgo_orderid").val()}
$("#"+id_wa).bind("change",function(a){var i=$("#"+id_wa).val(),_=orderidnya,d=$("input.mgo_csid").val(),e=$(".mgo_nama input").val();null==d&&(d=$(".mgo_csid input").val());var n={action:"myaction_autosave_wa",datanya:[i,id_caldera_form2,_,d,e]};jQuery.post(object_name.templateUrl+"/wp-admin/admin-ajax.php",n,function(a){})});$(".mgo_nama input").bind("change",function(a){var i=$("#"+id_wa).val(),_=orderidnya,d=$("input.mgo_csid").val(),e=$(".mgo_nama input").val();null==d&&(d=$(".mgo_csid input").val());var n={action:"myaction_autosave_wa",datanya:[i,id_caldera_form2,_,d,e]};jQuery.post(object_name.templateUrl+"/wp-admin/admin-ajax.php",n,function(a){})})})
	';
	}

	echo '
	jQuery(document).ready(function($) {
		$(".mandiri").html('."'".'<span data-bank="Bank Mandiri"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/mandiri.png'.'"'.'></span>'."'".');
		$(".mandiri_syariah").html('."'".'<span data-bank="Bank Mandiri Syariah"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/mandiri_syariah.png'.'"'.'></span>'."'".');
		$(".bca").html('."'".'<span data-bank="Bank BCA"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/bca.png'.'"'.'></span>'."'".');
		$(".bca_syariah").html('."'".'<span data-bank="Bank BCA Syariah"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/bca_syariah.png'.'"'.'></span>'."'".');
		$(".bni").html('."'".'<span data-bank="Bank BNI"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/bni.png'.'"'.'></span>'."'".');
		$(".bni_syariah").html('."'".'<span data-bank="Bank BNI Syariah"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/bni_syariah.png'.'"'.'></span>'."'".');
		$(".bri").html('."'".'<span data-bank="Bank BRI"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/bri.png'.'"'.'></span>'."'".');
		$(".bri_syariah").html('."'".'<span data-bank="Bank BRI Syariah"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/bri_syariah.png'.'"'.'></span>'."'".');
		$(".muamalat").html('."'".'<span data-bank="Bank Muamalat"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/muamalat.png'.'"'.'></span>'."'".');
		$(".bsi").html('."'".'<span data-bank="Bank BSI"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/bsi.png'.'"'.'></span>'."'".');
		$(".bank_btn").html('."'".'<span data-bank="Bank BTN"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/bank_btn.png'.'"'.'></span>'."'".');
		$(".bank_bjb").html('."'".'<span data-bank="Bank BJB"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/bank_bjb.png'.'"'.'></span>'."'".');
		$(".bank_bjb_syariah").html('."'".'<span data-bank="Bank BJB Syariah"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/bank_bjb_syariah.png'.'"'.'></span>'."'".');
		$(".bank_jateng").html('."'".'<span data-bank="Bank Jateng"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/bank_jateng.png'.'"'.'></span>'."'".');
		$(".bank_jatim").html('."'".'<span data-bank="Bank Jatim"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/bank_jatim.png'.'"'.'></span>'."'".');
		$(".bank_dki").html('."'".'<span data-bank="Bank DKI"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/bank_dki.png'.'"'.'></span>'."'".');
		$(".danamon").html('."'".'<span data-bank="Bank Danamon"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/danamon.png'.'"'.'></span>'."'".');
		$(".permata").html('."'".'<span data-bank="Bank Permata"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/permata.png'.'"'.'></span>'."'".');
		$(".btpn").html('."'".'<span data-bank="Bank BTPN"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/btpn.png'.'"'.'></span>'."'".');
		$(".bukopin").html('."'".'<span data-bank="Bank Bukopin"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/bukopin.png'.'"'.'></span>'."'".');
		$(".bank_mega").html('."'".'<span data-bank="Bank Mega"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/mega.png'.'"'.'></span>'."'".');
		$(".gopay").html('."'".'<span data-bank="Gopay"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/gopay.png'.'"'.'></span>'."'".');
		$(".jenius").html('."'".'<span data-bank="Jenius"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/jenius.png'.'"'.'></span>'."'".');
		$(".ovo").html('."'".'<span data-bank="OVO"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/ovo.png'.'"'.'></span>'."'".');
		$(".dana").html('."'".'<span data-bank="Dana"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/dana.png'.'"'.'></span>'."'".');
		$(".paypal").html('."'".'<span data-bank="Paypal"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/paypal.png'.'"'.'></span>'."'".');
		$(".shopeepay").html('."'".'<span data-bank="ShopeePay"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/shopeepay.png'.'"'.'></span>'."'".');
		$(".linkaja").html('."'".'<span data-bank="LinkAja"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/linkaja.png'.'"'.'></span>'."'".');
		$(".qris").html('."'".'<span data-bank="QR Code Standar Pembayaran Nasional"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/qris.png'.'"'.'></span>'."'".');
		$(".jemput").html('."'".'<span data-bank="Jemput Donasi"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/jemput.png'.'"'.'></span>'."'".');
		$(".indomaret").html('."'".'<span data-bank="Indomaret"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/indomaret.png'.'"'.'></span>'."'".');
		$(".alfamart").html('."'".'<span data-bank="Alfamart"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/alfamart.png'.'"'.'></span>'."'".');
		$(".cimb_niaga").html('."'".'<span data-bank="Bank Cimb Niaga"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/cimb_niaga.png'.'"'.'></span>'."'".');
		$(".citi_bank").html('."'".'<span data-bank="Citi Bank"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/citi_bank.png'.'"'.'></span>'."'".');
		$(".visa").html('."'".'<span data-bank="Visa Kartu Kredit"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/visa.png'.'"'.'></span>'."'".');
		$(".master_card").html('."'".'<span data-bank="Master Card Kartu Kredit"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/master_card.png'.'"'.'></span>'."'".');
		$(".jcb").html('."'".'<span data-bank="JCB Kartu Kredit"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/jcb.png'.'"'.'></span>'."'".');
		$(".cod_hand").html('."'".'<span data-bank="COD - Bayar di tempat"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/cod_hand.png'.'"'.'></span>'."'".');
		$(".cod_hand2").html('."'".'<span data-bank="COD - Bayar di tempat"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/cod_hand2.png'.'"'.'></span>'."'".');
		$(".cod_truck").html('."'".'<span data-bank="COD - Bayar di tempat"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/cod_truck.png'.'"'.'></span>'."'".');
		$(".cod_truck2").html('."'".'<span data-bank="COD - Bayar di tempat"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/cod_truck2.png'.'"'.'></span>'."'".');
		$(".cash").html('."'".'<span data-bank="COD (Cash, Bayar di tempat)"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/cash.png'.'"'.'></span>'."'".');
		$(".tunai").html('."'".'<span data-bank="COD (Tunai, Bayar di tempat)"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/tunai.png'.'"'.'></span>'."'".');
		$(".igreview").html('."'".'<span data-bank="Tukar dengan Review di Instagram"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/igreview.png'.'"'.'></span>'."'".');
		$("form.caldera_forms_form label .transfer").html('."'".'<span data-bank="Transfer"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/transfer2.png'.'"'.'></span>'."'".');
		$("form.caldera_forms_form label .tad").html('."'".'<span data-bank="Transfer setelah barang sampai"><img src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/bank/tad.png'.'"'.'></span>'."'".');

		nama_banknya = "";
		auto_courier = 0;
		label_addcost = $(".mgo_addcost_persen label").text();
		cod_action = false;
		$(".mgo_pembayaran label").bind("click", function(){
			$(".mgo_pembayaran label div").removeClass("payment-active").css({"border":"1px solid #D4DDEC"});
			$(this).find("input").prop("checked", true);
			$(this).find("div").addClass("payment-active").css({"border":"2px solid #3b99fc"});
			nama_banknya = $(this).find(".payment-active span").data("bank");
			$("#nama_bank").html(nama_banknya);

			// cod check
			var cod = "COD";
			if(nama_banknya.indexOf(cod) !== -1){
				console.log("cod .");
				if(label_addcost!=""){
					$(".addcost").show();
				}
				$(".kodeunik").hide();
				$(".mgo_codemin input").val(0).attr("value", 0);
				$(".mgo_codeplus input").val(0).attr("value", 0);
				$(".mgo_code3dwa input").val(0).attr("value", 0);
				$(".mgo_code2dwa input").val(0).attr("value", 0);
				$(".mgo_codefixed input").val(0).attr("value", 0);
				$(".mgo-caldera .two.kodeunik").text("Rp "+0);
				nilai_kodeunik = 0;
			}else{
				console.log("transfer .");
				$(".addcost").hide();
				if(set_hide_kodeunik==true){ // cek ada gak field kode unik
					$(".kodeunik").hide();
				}else{
					$(".kodeunik").show();
				}
				$(".mgo_codemin input").val(nilai_kodeunik_public).attr("value", nilai_kodeunik_public);
				$(".mgo_codeplus input").val(nilai_kodeunik_public).attr("value", nilai_kodeunik_public);
				$(".mgo_code3dwa input").val(nilai_kodeunik_public).attr("value", nilai_kodeunik_public);
				$(".mgo_code2dwa input").val(nilai_kodeunik_public).attr("value", nilai_kodeunik_public);
				$(".mgo_codefixed input").val(nilai_kodeunik_public).attr("value", nilai_kodeunik_public);
				$(".mgo-caldera .two.kodeunik").text("Rp "+nilai_kodeunik_public);
				nilai_kodeunik = nilai_kodeunik_public;
			}

			var classnya = $(this).find(".payment-active").attr("class");
			var mySubStringCourier = classnya.substring(
			    classnya.lastIndexOf("[") + 1, 
			    classnya.lastIndexOf("]")
			);

			if(mySubStringCourier!=""){
				mySubStringCourier = mySubStringCourier.toLowerCase();
				console.log("courier:"+mySubStringCourier);
				if(mySubStringCourier=="j&t"){
					mySubStringCourier = "jnt";
				}
				multiple_courier = 1;
				courier_code = mySubStringCourier;
				set_ongkir(id_from_option);
				auto_courier = 1;
			}

			// AUTO DISKON Metode Pembayaran
			var data_html = $(".mgo_pembayaran").html();
			var dvalue_html3 = data_html.indexOf("{diskon:") !== -1;

			if(dvalue_html3==true){
				
				var result = getFromBetween.get(classnya,"{diskon:","}");
				var mySubStringDiskon = result[0];

				if(mySubStringDiskon!=undefined){
					// if(id_mgo_kupon==null){
						if(isNaN(mySubStringDiskon)){
							if(mySubStringDiskon == "go"){
								coupon_status = "valid";
								coupon_type = "go";
							}else{
								coupon_status = "not_valid";
								diskonnya = "";
							}
						}else{
							coupon_status = "not_valid";
							diskonnya = parseFloat(mySubStringDiskon)*(-1);
						}
						console.log("mySubStringDiskon:"+diskonnya);
						$("#"+iddiskon).val(diskonnya).attr("value", diskonnya);
						if(diskonnya==""){
							$(".mgo-caldera .two.diskon").text("Rp "+addCommas(0));
						}else{
							$(".mgo-caldera .two.diskon").text("Rp "+addCommas(diskonnya));
						}
					// }
				}else{

					coupon_status = "not_valid";
					diskonnya = 0;
					
					$("#"+iddiskon).val(diskonnya).attr("value", diskonnya);
					if(diskonnya==""){
						$(".mgo-caldera .two.diskon").text("Rp "+addCommas(0));
					}else{
						$(".mgo-caldera .two.diskon").text("Rp "+addCommas(diskonnya));
					}
				}
			}

			var abc = "calculation_total_"+id_caldera_form2+"()";
			eval(abc);

		});
		
		$(".mgo_harga_produk label").bind("click", function(){

			// AUTO DISKON Metode Pembayaran
			var data_html = $(".mgo_harga_barang").html();
			var dvalue_html4 = data_html.indexOf("{diskon:") !== -1;

			if(dvalue_html4==true){
				
				var result = getFromBetween.get(classnya,"{diskon:","}");
				var mySubStringDiskon = result[0];

				if(mySubStringDiskon!=undefined){
					// if(id_mgo_kupon==null){
						if(isNaN(mySubStringDiskon)){
							if(mySubStringDiskon == "go"){
								coupon_status = "valid";
								coupon_type = "go";
							}else{
								coupon_status = "not_valid";
								diskonnya = "";
							}
						}else{
							coupon_status = "not_valid";
							diskonnya = parseFloat(mySubStringDiskon)*(-1);
						}
						console.log("mySubStringDiskon:"+diskonnya);
						$("#"+iddiskon).val(diskonnya).attr("value", diskonnya);
						if(diskonnya==""){
							$(".mgo-caldera .two.diskon").text("Rp "+addCommas(0));
						}else{
							$(".mgo-caldera .two.diskon").text("Rp "+addCommas(diskonnya));
						}
					// }
				}else{

					coupon_status = "not_valid";
					diskonnya = 0;
					
					$("#"+iddiskon).val(diskonnya).attr("value", diskonnya);
					if(diskonnya==""){
						$(".mgo-caldera .two.diskon").text("Rp "+addCommas(0));
					}else{
						$(".mgo-caldera .two.diskon").text("Rp "+addCommas(diskonnya));
					}
				}
			}

			var abc = "calculation_total_"+id_caldera_form2+"()";
			eval(abc);

		});

		$(".mgo_donasi input, .mgo_donasi2 input, .mgo_donasi3 input, .mgo_donasi4 input, .mgo_donasi5 input").on("keyup", function(e){
			if(event.which >= 37 && event.which <= 40) return;
			$(this).val(function(index, value) {
				return nilai = value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
			});
			var abc = "calculation_total_"+id_caldera_form2+"()";
			eval(abc);
		});



		// AUTO DISKON SELAIN Metode Pembayaran
	    $(document).on("click", ".form-group input[type=radio]", function(e) {
			var val = $(this).attr("data-field");
			var id_selected = val+"_1-wrap";

			if ($("#"+id_selected).hasClass("mgo_pembayaran")) {
				return false;
			}

			var data_html = $("#"+id_selected).html();
			var dvalue_html3 = data_html.indexOf("{diskon:") !== -1;


			if(dvalue_html3==true){
				var data_label = $("#"+id_selected+" .mgo-radio-selected").attr("data-label");

				var result = getFromBetween.get(data_label,"{diskon:","}");
				var mySubStringDiskon = result[0];

				if(mySubStringDiskon!=undefined){
					// if(id_mgo_kupon==null){
						if(isNaN(mySubStringDiskon)){
							if(mySubStringDiskon == "go"){
								coupon_status = "valid";
								coupon_type = "go";
							}else{
								coupon_status = "not_valid";
								diskonnya = "";
							}
						}else{
							coupon_status = "not_valid";
							diskonnya = parseFloat(mySubStringDiskon)*(-1);
						}
						
						console.log("mySubStringDiskon:"+diskonnya);

						$("#"+iddiskon).val(diskonnya).attr("value", diskonnya);
						if(diskonnya==""){
							$(".mgo-caldera .two.diskon").text("Rp "+addCommas(0));
						}else{
							$(".mgo-caldera .two.diskon").text("Rp "+addCommas(diskonnya));
						}

						var abc = "calculation_total_"+id_caldera_form2+"()";
						eval(abc);
					// }
				}else{

					coupon_status = "not_valid";
					diskonnya = 0;
					console.log("mySubStringDiskon:"+coupon_status);
					$("#"+iddiskon).val(diskonnya).attr("value", diskonnya);
					if(diskonnya==""){
						$(".mgo-caldera .two.diskon").text("Rp "+addCommas(0));
					}else{
						$(".mgo-caldera .two.diskon").text("Rp "+addCommas(diskonnya));
					}

					var abc = "calculation_total_"+id_caldera_form2+"()";
					eval(abc);

				}
			}
			

		});

        $(document).on("click", ".form-group select", function(e) {
			var val = $(this).attr("data-field");
			var id_selected = val+"_1-wrap";

			var data_html = $("#"+id_selected).html();
			var dvalue_html = data_html.indexOf("{diskon:") !== -1;
			var data_value = $(this).val();

			var auto_diskon = "";
			if(dvalue_html==true){
				// var data_valuenya = data_value.split("Diskon ");
				// auto_diskon = data_valuenya[1];

				var auto_diskon = data_value.substring(
				    data_value.lastIndexOf("{diskon:") + 8, 
				    data_value.lastIndexOf("}")
				);

				if(id_mgo_kupon==null){
					if(isNaN(auto_diskon)){
						if(auto_diskon == "go"){
							coupon_status = "valid";
							coupon_type = "go";
						}else{
							coupon_status = "not_valid";
							diskonnya = "";
						}
					}else{
						coupon_status = "not_valid";
						diskonnya = parseFloat(auto_diskon)*(-1);
					}
					// alert(diskonnya);
					console.log("auto_diskon:"+diskonnya);
					$("#"+iddiskon).val(diskonnya).attr("value", diskonnya);
					if(diskonnya==""){
						$(".mgo-caldera .two.diskon").text("Rp "+addCommas(0));
					}else{
						$(".mgo-caldera .two.diskon").text("Rp "+addCommas(diskonnya));
					}
					var abc = "calculation_total_"+id_caldera_form2+"()";
					eval(abc);
				}
			}
		});

		$(".mgo_pembayaran").append('."'".'<div style="padding-top:20px;"><div><img class="icon_payment" style="position:absolute;" src="'.plugin_dir_url( __FILE__ ).'assets/icons/bank/payment.png"></div><p class="pemilihan_pembayaran" style="padding-left:40px;">Pemilihan pembayaran melalui : <b><span style="color:#2c3e50;" id="nama_bank"></span><b></p></div>'."'".');

		var bank_checked = $(".mgo_pembayaran input:checked").attr("id");
		if(bank_checked!== undefined){
			var for_label = "for="+bank_checked;
			var label = $("label["+for_label+"]").addClass(bank_checked);
			$("label."+bank_checked).find("div").css({"border":"2px solid #3b99fc"}).addClass("payment-active");
			// nama_banknya = $("label."+bank_checked).find("span").data("bank");
			nama_banknya = $("label."+bank_checked).find(".payment-active span").data("bank");
			$("#nama_bank").html(nama_banknya);
		}


	    id_from_option = "";
		if(object_name.license!="FREEMIUM"){

			// GET FORM ID
			id_caldera_form3 = "";
			var caldera_form3 = $(".caldera_forms_form").attr("id");
			if(caldera_form3!=null){	
				var fields_caldera_form3 = caldera_form3.split("_");
				id_caldera_form3 = fields_caldera_form3[0];
			}

			// GET COURIER
			multiple_courier = 0;
			courier_code = "";
			var id_couriernya = $(".mgo_courier select").attr("id");

			if(id_couriernya!=null){
				multiple_courier = 1;
				courier_code = $("#"+id_couriernya).val();
				if(courier_code!=null){
					courier_code = courier_code.toLowerCase();
				}

				var data_nya = [
		        	id_caldera_form3
			    ];
			    var data = {
			        "action": "myaction_get_courier",
			        "datanya": data_nya
			    };
			    jQuery.post(object_name.templateUrl+"/wp-admin/admin-ajax.php", data, function(response) {
					$("#"+id_couriernya).append(response);
			    });
			}

			$(".mgo_courier select").bind("change", function(e){
				courier_code = $(this).val();
				if(courier_code!=null){
					courier_code = courier_code.toLowerCase();
				}
				set_ongkir(id_from_option);
			});
			
		 	var kecamatanArray = $.map(kecamatan, function (value, key) { 
		 
		 		data_wilayah = key.split(",");
				var data_kabkota = data_wilayah[3];
				var prov = data_wilayah[2];
				var kabkota = data_wilayah[1];
				var kecamatan = data_wilayah[0];

				if(prov=="1"){prov="Bali";}else if(prov=="2"){prov="Bangka Belitung";}else if(prov=="3"){prov="Banten";}else if(prov=="4"){prov="Bengkulu";}else if(prov=="5"){prov="DI Yogyakarta";}else if(prov=="6"){prov="DKI Jakarta";}else if(prov=="7"){prov="Gorontalo";}else if(prov=="8"){prov="Jambi";}else if(prov=="9"){prov="Jawa Barat";}else if(prov=="10"){prov="Jawa Tengah";}else if(prov=="11"){prov="Jawa Timur";}else if(prov=="12"){prov="Kalimantan Barat";}else if(prov=="13"){prov="Kalimantan Selatan";}else if(prov=="14"){prov="Kalimantan Tengah";}else if(prov=="15"){prov="Kalimantan Timur";}else if(prov=="16"){prov="Kalimantan Utara";}else if(prov=="17"){prov="Kepulauan Riau";}else if(prov=="18"){prov="Lampung";}else if(prov=="19"){prov="Maluku";}else if(prov=="20"){prov="Maluku Utara";}else if(prov=="21"){prov="Nanggroe Aceh Darussalam (NAD)";}else if(prov=="22"){prov="Nusa Tenggara Barat (NTB)";}else if(prov=="23"){prov="Nusa Tenggara Timur (NTT)";}else if(prov=="24"){prov="Papua";}else if(prov=="25"){prov="Papua Barat";}else if(prov=="26"){prov="Riau";}else if(prov=="27"){prov="Sulawesi Barat";}else if(prov=="28"){prov="Sulawesi Selatan";}else if(prov=="29"){prov="Sulawesi Tengah";}else if(prov=="30"){prov="Sulawesi Tenggara";}else if(prov=="31"){prov="Sulawesi Utara";}else if(prov=="32"){prov="Sumatera Barat";}else if(prov=="33"){prov="Sumatera Selatan";}else{prov="Sumatera Utara";}

				if(data_kabkota=="1"){
					nama_kabkota = "Kota";
				}else{
					nama_kabkota = "Kabupaten";
				}

				key = kecamatan+", "+nama_kabkota+" "+kabkota+", "+prov;

				return {
					value: key, iddistrict: value 
				}; 
			});

			try {
				$(".mgo_kecamatan_auto input").devbridgeAutocomplete({
					minChars : '.$mincharacter.',
			        lookup: kecamatanArray,
			        lookupFilter: function(suggestion, originalQuery, queryLowerCase) {
			            var re = new RegExp('."'"."\\\b"."'".' + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), '."'".'gi'."'".');
			            return re.test(suggestion.value);
			        },
			        onSelect: function(suggestion) {
			            // $("#selction-ajax").html("You selected: " + suggestion.value + ", " + suggestion.iddistrict);

			            // auto_courier : on bank icon
			            if(auto_courier==1){
			            	courier_code = courier_code;
						}else{
			        		courier_code = $("#"+id_couriernya).val();
							if(courier_code!=null){
								courier_code = courier_code.toLowerCase();
							}
						}
						id_from_option = suggestion.iddistrict;
						set_ongkir(id_from_option);

						// unset red
						$(".mgo_kecamatan_auto input").removeClass("set_red");
						// console.log("cek me.");

			        }
			    });
		    } catch (e) {
		    	// console.log(e);
			}
		    
			
		    ';

	echo '

	    }

	    function set_ongkir(i) {
		    console.log("id kecamatan:" + i);
		    field_kecamatan_auto = $(".mgo_kecamatan_auto label").text();
			if(field_kecamatan_auto==""){
				var prov = $(".mgo_provinsi").find(":selected").val();
				var kabkota = $(".mgo_kabkota").find(":selected").val();
				var kecamatan = $(".mgo_kecamatan").find(":selected").val();
			}else{
				var data_wilayah = $(".mgo_kecamatan_auto input").val();
				data_wilayah = data_wilayah.split(",");
				var prov = data_wilayah[2].substring(1);
				var kabkota = data_wilayah[1].substring(1);
				var kecamatan = data_wilayah[0];
			}
		    if ("" != id_ongkir) {
		        $(".mgo_ongkoskirim label img").show(), id_kabkota_selected = i;
		        var o = {
		            action: "myaction_get_ongkir2",
		            datanya: [id_kabkota_selected, id_caldera_form2, id_ongkir_label, jumlah_barang, multiple_courier, courier_code, berat_barang, prov, kabkota, kecamatan]
		        };
		        jQuery.post(object_name.templateUrl + "/wp-admin/admin-ajax.php", o, function(i) {
		            $(".mgo_ongkoskirim .option_ongkir").html(i), $(".mgo_ongkoskirim label img").hide();
		            var o = "calculation_total_" + id_caldera_form2 + "()";
		            eval(o)
		        })
		    }
		}
	    

		';

	foreach ($rows as $row ) {

		$cek_form_on_caldera = $wpdb->get_results('SELECT * from '.$table_name_cf.' where form_id="'.$row->id_form.'" and type="primary"');

		if($cek_form_on_caldera!=null){

			$formula = $row->rumus_calculation;
			if($formula=='' || $formula==null){
				$formula = 0;
			}

			$jqid = '';
			$fields2 = json_decode($row->field_form, true);
			if(!empty($fields2))
			{
				$i = 0;
				$len = count($fields2);
				foreach ($fields2 as $key => $value ) {
					$pieces = explode("_x", $key);
	                $key = $pieces[0];
	                if (count(explode(' ', $key)) > 1) {
	                	$piecesnya = explode(" ", $key);
	                    $key = $piecesnya[0];
	                }
	                $jqid .= '#'.$row->id_form.'_1 .'.$key.' '.$value;
	                if ($i == $len - 1) {
				    }else{
				    	$jqid .= ',';
				    }
	                $i++;
				}
			}
			$new_f = str_replace('dropdown', 'select', $jqid);
			$new_f2 = str_replace('text', 'input', $new_f);
			$new_f3 = str_replace('radio', 'input', $new_f2);
			$new_f4 = str_replace('checkbox', 'input', $new_f3);
			$new_f5 = str_replace('number', 'input', $new_f4);
			$new_f6 = str_replace('hidden', '', $new_f5);

			$form_style = $row->form_style;
			if($form_style!=''){
				echo '
				jQuery(document).ready(function($) {
				  	$( ".'.$row->id_form.'.caldera_forms_form" ).addClass( "mgo_style '.$form_style.'" );
			  	});
				';
			}

		  	echo '
		  	jQuery(document).bind("change", "'.$new_f6.'", function() {
		    	calculation_total_'.$row->id_form.'();
		  	});
		  	';

		    echo '
			function calculation_total_'.$row->id_form.'(){
				if (typeof id_caldera_form2 !== "undefined") {
				if(id_caldera_form2=="'.$row->id_form.'"){
				';
				// mgo_barang1:dropdown,mgo_jumlah:dropdown,mgo_ongkir:text
				$fields = json_decode($row->field_form, true);
				
				if(!empty($fields))
				{
					foreach ($fields as $key => $value ) {
						// echo $key.'>'.$value;
						// print_r($fields);

						// echo 'console.log("$key : $value");';

						$pieces = explode("_x", $key);
	                    $key = $pieces[0];

	                    if (count(explode(' ', $key)) > 1) {
		                	$piecesnya = explode(" ", $key);
		                    $key = $piecesnya[0];
		                }

						if($value=='dropdown'){
							echo '
								'.$key.'_fv = parseInt($(".'.$key.'").find("option:first-child").next().val());
							    '.$key.' = parseInt($(".'.$key.' option:selected").data("calc-value"));
							    if('.$key.' == ""){
							    	'.$key.' = parseInt($(".'.$key.' option:selected").val());
							    }
							    if(isNaN('.$key.')){
							 		if('.$key.'_fv==1){'.$key.'=0;}else{'.$key.'=0;}
							 	}
						 	';
						}

						if($value=='radio'){
							echo '
								'.$key.' = parseInt($(".'.$key.' input:checked").data("calc-value"));
								if('.$key.' == ""){
							    	'.$key.' = parseInt($(".'.$key.' input:checked").attr("value"));
							    }
								if(isNaN('.$key.')){'.$key.'=0;}
						 	';
						}

						if($value=='checkbox'){
							echo '
								'.$key.' = parseInt($(".'.$key.' input:checked").data("calc-value"));
								if('.$key.' == ""){
							    	'.$key.' = parseInt($(".'.$key.' input:checked").attr("value"));
							    }
								if(isNaN('.$key.')){'.$key.'=0;}
						 	';
						}
						
						if($value=='text'){
							if($key!='mgo_kecamatan'){

							 	if($key=='mgo_donasi'){
								echo '
									'.$key.' = $(".'.$key.' input").val();
									mgo_donasi = parseInt(mgo_donasi.split(".").join(""));
									if(isNaN('.$key.')){'.$key.'=0;}
							 	';
							 	}else if($key=='mgo_donasi2'){
								echo '
									'.$key.' = $(".'.$key.' input").val();
									mgo_donasi2 = parseInt(mgo_donasi2.split(".").join(""));
									if(isNaN('.$key.')){'.$key.'=0;}
							 	';
							 	}else if($key=='mgo_donasi3'){
								echo '
									'.$key.' = $(".'.$key.' input").val();
									mgo_donasi3 = parseInt(mgo_donasi3.split(".").join(""));
									if(isNaN('.$key.')){'.$key.'=0;}
							 	';
							 	}else {

								echo '
									'.$key.' = parseInt($(".'.$key.' input").val());
									if(isNaN('.$key.')){'.$key.'=0;}
							 	';
							 	}

							}
						}
						
						if($value=='number'){
							if($key!='mgo_kecamatan'){
							echo '
								'.$key.' = parseInt($(".'.$key.' input").attr("value"));
								if(isNaN('.$key.')){'.$key.'=0;}
						 	';
						 	}
						}

						if($value=='hidden'){
							echo '
								'.$key.' = parseInt($("input.'.$key.'").attr("value"));
								if(isNaN('.$key.')){'.$key.'=0;}
						 	';
						 	
						}

						if($key!='mgo_kecamatan'){
							echo '//console.log('.$key.');';
						}
					}

					echo '
					console.log("'.$row->id_form.'");


				    var id_addcost_persen = $(".mgo_addcost_persen input").attr("id");
					if(id_addcost_persen!=null){
						total_sementara_1 = '.$formula.';
						var addcost_persen = $(".mgo_addcost_persen input").attr("placeholder");
						if(addcost_persen<=100){
							addcost_persen = addcost_persen/100;
							total_add_persen = Math.round(addcost_persen*total_sementara_1);
						}else{
							total_add_persen = Math.round(addcost_persen);
						}
						// set total_add_persen
						$(".mgo-caldera .two.addcost").text("Rp "+addCommas(total_add_persen));
						
						if(nama_banknya==undefined){
					    	$(".mgo_addcost_persen input").attr("value", "").val("");
							total_'.$row->id_form.' = total_sementara_1;
					    }else{
					    	if(nama_banknya.includes("COD")==true){
								$(".mgo_addcost_persen input").val("Rp"+addCommas(total_add_persen));
								total_'.$row->id_form.' = total_add_persen+total_sementara_1;
							}else{
								$(".mgo_addcost_persen input").attr("value", "").val("");
								total_'.$row->id_form.' = total_sementara_1;
							}
					    }
						
						
					}else{
						total_'.$row->id_form.' = '.$formula.';
					}

				    totalsementara_'.$row->id_form.' = '.$formula.';
					
					// Item Total
					var total_sementara = totalsementara_'.$row->id_form.';
					console.log("total_sementara:"+total_sementara);

					if(coupon_status == "valid" && coupon_type == "go"){
						diskonnya = mgo_ongkoskirim*(-1);
						$("#"+iddiskon).val(diskonnya).attr("value", diskonnya);
						$(".mgo-caldera .two.diskon").text("Rp "+addCommas(diskonnya));
					}

					if (typeof mgo_ongkoskirim === "undefined") {
						console.log("set 1");
						mgo_ongkoskirim = 0;
						if( mgo_ongkoskirim==0 && hargaongkir>=0 ){
							console.log("ongkir_magic");
							ongkir_magic = 1;
							$("#'.$row->id_form.'_1 .mgo_total .mgo-caldera .two.ongkir").text("Rp "+addCommas(hargaongkir));
							console.log("ada diskon1: "+diskonnya);
							item_total_'.$row->id_form.' = totalsementara_'.$row->id_form.' - nilai_kodeunik - hargaongkir - diskonnya;
						}else{
							console.log("ongkir: ongkir_raja");
							ongkir_raja = 1;
							$("#'.$row->id_form.'_1 .mgo_total .mgo-caldera .two.ongkir").text("Rp "+addCommas(mgo_ongkoskirim));
							console.log("ada diskon2: "+diskonnya);
							item_total_'.$row->id_form.' = totalsementara_'.$row->id_form.' - nilai_kodeunik - mgo_ongkoskirim - diskonnya;
						}
					}else{
						console.log("set 2");
						// mgo_ongkoskirim = 0;
						if( mgo_ongkoskirim==0 && hargaongkir>=0 ){
							console.log("ongkir_magic 2");
							console.log("Diskon:"+diskonnya);
							ongkir_magic = 1;
							$("#'.$row->id_form.'_1 .mgo_total .mgo-caldera .two.ongkir").text("Rp "+addCommas(hargaongkir));
							console.log("ada diskon3: "+diskonnya);
							item_total_'.$row->id_form.' = totalsementara_'.$row->id_form.' - nilai_kodeunik - hargaongkir - diskonnya;
						}else{
							console.log("ongkir: ongkir_raja 2");
							ongkir_raja = 1;
							$("#'.$row->id_form.'_1 .mgo_total .mgo-caldera .two.ongkir").text("Rp "+addCommas(mgo_ongkoskirim));
							console.log("ada diskon4: "+diskonnya);
							item_total_'.$row->id_form.' = totalsementara_'.$row->id_form.' - nilai_kodeunik - mgo_ongkoskirim - diskonnya;
						}
					}

					console.log("mgo_ongkoskirim:"+mgo_ongkoskirim);
					console.log("hargaongkir:"+hargaongkir);
					console.log("item total:"+item_total_'.$row->id_form.');

					if (typeof item_total_'.$row->id_form.' === "undefined") {
						item_total_'.$row->id_form.' = 0;
					}

					
					var id_diskon_persen = $(".mgo_diskon_persen input").attr("id");
					if(id_diskon_persen!=null){

						if(diskon_persen_status==true){
							diskon_persen_hasil = ((item_total_'.$row->id_form.')*(diskon_persen))*(-1);
							$(".mgo-caldera .two.diskon2").text("Rp "+addCommas(diskon_persen_hasil));
							$(".mgo_diskon_persen input").attr("value", diskon_persen_hasil).val(diskon_persen_hasil);
							total_'.$row->id_form.' = item_total_'.$row->id_form.' + diskon_persen_hasil + nilai_kodeunik + mgo_ongkoskirim + diskonnya;
							total_sementara_1 = total_'.$row->id_form.';
							
							var id_addcost_persen = $(".mgo_addcost_persen input").attr("id");
							if(id_addcost_persen!=null){

								var addcost_persen = $(".mgo_addcost_persen input").attr("placeholder");
								if(addcost_persen<=100){
									addcost_persen = addcost_persen/100;
									total_add_persen = Math.round(addcost_persen*total_sementara_1);
								}else{
									total_add_persen = Math.round(addcost_persen);
								}

								// set total_add_persen
								$(".mgo-caldera .two.addcost").text("Rp "+addCommas(total_add_persen));
								
								if(nama_banknya==undefined){
									cod_action = false;
							    }else{
							    	if(nama_banknya.includes("COD")==true){
										cod_action = true;
									}else{
										cod_action = false;
									}
							    }
							    
							}
							
							if(cod_action==true){
								total_'.$row->id_form.' = total_sementara_1+total_add_persen;
							}else{
								total_'.$row->id_form.' = total_sementara_1;
							}

						}else{
							$(".mgo-caldera .two.diskon2").text("Rp 0");
							$(".mgo_diskon_persen input").attr("value", "").val("");
						}
						
					}


					$("#'.$row->id_form.'_1 .mgo_total .mgo-caldera .two.itemtotal").text("Rp "+addCommas(item_total_'.$row->id_form.'));
				    // Total
				    $("#'.$row->id_form.'_1 .mgo_total .mgo-caldera .two.total").text("Rp "+addCommas(total_'.$row->id_form.'));

				    $(".mgo_itemtotal input").val("Rp"+addCommas(item_total_'.$row->id_form.')).attr("value", "Rp"+addCommas(item_total_'.$row->id_form.'));
			  		$("input.mgo_itemtotal").val("Rp"+addCommas(item_total_'.$row->id_form.')).attr("value", "Rp"+addCommas(item_total_'.$row->id_form.'));

			  		console.log("totalnya:"+total_'.$row->id_form.');
				    $("#'.$row->id_form.'_1 .mgo_total input").val("Rp"+addCommas(total_'.$row->id_form.')).attr("value", "Rp"+addCommas(total_'.$row->id_form.'));
				    $("#'.$row->id_form.'_1 input.mgo_total").val("Rp"+addCommas(total_'.$row->id_form.')).attr("value", "Rp"+addCommas
				    (total_'.$row->id_form.'));

				    // deposit mgo_dp dan sisa mgo_sisa
				    var dp_persennya = $(".mgo_dp input").attr("placeholder");
					dp_persennya = dp_persennya/100;
			        total_dp_persennya = Math.round(dp_persennya*total_'.$row->id_form.');
			    	$(".mgo_deposit input").val("Rp"+addCommas(total_dp_persennya)).attr("value", "Rp"+addCommas(total_dp_persennya));
			    	
			        var total_sisanya = total_'.$row->id_form.'-total_dp_persennya;
			    	$(".mgo_sisa input").val("Rp"+addCommas(total_sisanya)).attr("value", "Rp"+addCommas(total_sisanya));

				    $("#'.$row->id_form.'_1 .mgo_dp input").val("Rp"+addCommas(total_dp_persennya)).attr("value", "Rp"+addCommas
				    (total_dp_persennya));

				    $("#'.$row->id_form.'_1 .mgo_sisa input").val("Rp"+addCommas(total_sisanya)).attr("value", "Rp"+addCommas
				    (total_sisanya));

				    ';

				}

			echo'
			 	}   
			 	}
			}';

			

			

		} // end cek_form_on_caldera

	} // end foreach


	// penutup jQuery(document)
	echo '
		function isNumber(n) {
		  return !isNaN(parseFloat(n)) && isFinite(n);
		}

		jumlah_barang = 1;
		$(".mgo_jumlah_barang select").bind("change", function(e){
			jumlah_barang = $(this).val();
			if(!isNumber(jumlah_barang)){
				jumlah_barang = $(this).find("option:selected").data("calc-value");
			}
			if(jumlah_barang=="" || jumlah_barang==0){
				jumlah_barang = 1;
			}
			if(id_from_option!=""){
		    	set_ongkir(id_from_option);
			}
		});
		$(".mgo_jumlah_barang input").bind("change", function(e){
			jumlah_barang = $(this).val();
			if(jumlah_barang=="" || jumlah_barang==0){
				jumlah_barang = 1;
			}
			if(id_from_option!=""){
		    	set_ongkir(id_from_option);
			}
		});
		$(".mgo_jumlah_barang input:checkbox").bind("change", function(e){
			jumlah_barang = $(this).val();
			if(!isNumber(jumlah_barang)){
				jumlah_barang = $(this).attr("data-calc-value");
			}
			if(jumlah_barang=="" || jumlah_barang==0){
				jumlah_barang = 1;
			}
			if(id_from_option!=""){
		    	set_ongkir(id_from_option);
			}
		});

		/*
		var getFromBetween={results:[],string:"",getFromBetween:function(sub1,sub2){if(this.string.indexOf(sub1)<0||this.string.indexOf(sub2)<0)return false;var SP=this.string.indexOf(sub1)+sub1.length;var string1=this.string.substr(0,SP);var string2=this.string.substr(SP);var TP=string1.length+string2.indexOf(sub2);return this.string.substring(SP,TP)},removeFromBetween:function(sub1,sub2){if(this.string.indexOf(sub1)<0||this.string.indexOf(sub2)<0)return false;var removal=sub1+this.getFromBetween(sub1,sub2)+sub2;this.string=this.string.replace(removal,"")},getAllResults:function(sub1,sub2){if(this.string.indexOf(sub1)<0||this.string.indexOf(sub2)<0)return;var result=this.getFromBetween(sub1,sub2);this.results.push(result);this.removeFromBetween(sub1,sub2);if(this.string.indexOf(sub1)>-1&&this.string.indexOf(sub2)>-1){this.getAllResults(sub1,sub2)}else return},get:function(string,sub1,sub2){this.results=[];this.string=string;this.getAllResults(sub1,sub2);return this.results}};
		*/

		berat_barang = 0;
		$(document).on("click", ".form-group input[type=radio]", function(e) {
			var val = $(this).attr("data-field");
			var id_selected = val+"_1-wrap";

			if ($("#"+id_selected).hasClass("mgo_pembayaran")) {
				return false;
			}

			var data_html = $("#"+id_selected).html();
			var dvalue_html = data_html.indexOf("{jumlah:") !== -1;
			var dvalue_html2 = data_html.indexOf("{berat:") !== -1;

			if(dvalue_html2==true || dvalue_html==true){
				var data_label = $("#"+id_selected+" .mgo-radio-selected").attr("data-label");

				var result = getFromBetween.get(data_label,"{berat:","}");
				var mySubStringBerat = result[0];

				if(mySubStringBerat!=undefined){
					if(isNaN(mySubStringBerat)){
						berat_barang = 0;
					}else{
						berat_barang = mySubStringBerat;
					}
				}


				var result = getFromBetween.get(data_label,"{jumlah:","}");
				var mySubStringJumlah = result[0];

				if(mySubStringJumlah!=undefined){

					if(isNaN(mySubStringJumlah)){
						jumlah_barang = 1;
					}else{
						jumlah_barang = mySubStringJumlah;
					}

				}

				set_ongkir(id_from_option);
				console.log("Berat Barang: "+berat_barang);
				console.log("Jumlah Barang: "+jumlah_barang);
				console.log("Diskon: "+jumlah_barang);
				
			}

		});

		';

		echo '
		jumlah_barang1=0;jumlah_barang2=0;jumlah_barang3=0;jumlah_barang4=0;jumlah_barang5=0;jumlah_barang6=0;jumlah_barang7=0;jumlah_barang8=0;jumlah_barang9=0;jumlah_barang10=0;jumlah_barang11=0;jumlah_barang12=0;

		function set_jumlah(){jumlah_barang1=parseInt($(".mgo_jumlah_barang1 select option:selected").val());if(!isNumber(jumlah_barang1)){jumlah_barang1=parseInt($(".mgo_jumlah_barang1 select option:selected").data("calc-value"))}jumlah_barang2=parseInt($(".mgo_jumlah_barang2 select option:selected").val());if(!isNumber(jumlah_barang2)){jumlah_barang2=parseInt($(".mgo_jumlah_barang2 select option:selected").data("calc-value"))}jumlah_barang3=parseInt($(".mgo_jumlah_barang3 select option:selected").val());if(!isNumber(jumlah_barang3)){jumlah_barang3=parseInt($(".mgo_jumlah_barang3 select option:selected").data("calc-value"))}jumlah_barang4=parseInt($(".mgo_jumlah_barang4 select option:selected").val());if(!isNumber(jumlah_barang4)){jumlah_barang4=parseInt($(".mgo_jumlah_barang4 select option:selected").data("calc-value"))}jumlah_barang5=parseInt($(".mgo_jumlah_barang5 select option:selected").val());if(!isNumber(jumlah_barang5)){jumlah_barang5=parseInt($(".mgo_jumlah_barang5 select option:selected").data("calc-value"))}jumlah_barang6=parseInt($(".mgo_jumlah_barang6 select option:selected").val());if(!isNumber(jumlah_barang6)){jumlah_barang6=parseInt($(".mgo_jumlah_barang6 select option:selected").data("calc-value"))}jumlah_barang7=parseInt($(".mgo_jumlah_barang7 select option:selected").val());if(!isNumber(jumlah_barang7)){jumlah_barang7=parseInt($(".mgo_jumlah_barang7 select option:selected").data("calc-value"))}jumlah_barang8=parseInt($(".mgo_jumlah_barang8 select option:selected").val());if(!isNumber(jumlah_barang8)){jumlah_barang8=parseInt($(".mgo_jumlah_barang8 select option:selected").data("calc-value"))}jumlah_barang9=parseInt($(".mgo_jumlah_barang9 select option:selected").val());if(!isNumber(jumlah_barang9)){jumlah_barang9=parseInt($(".mgo_jumlah_barang9 select option:selected").data("calc-value"))}jumlah_barang10=parseInt($(".mgo_jumlah_barang10 select option:selected").val());if(!isNumber(jumlah_barang10)){jumlah_barang10=parseInt($(".mgo_jumlah_barang10 select option:selected").data("calc-value"))}jumlah_barang11=parseInt($(".mgo_jumlah_barang11 select option:selected").val());if(!isNumber(jumlah_barang11)){jumlah_barang11=parseInt($(".mgo_jumlah_barang11 select option:selected").data("calc-value"))}jumlah_barang12=parseInt($(".mgo_jumlah_barang12 select option:selected").val());if(!isNumber(jumlah_barang12)){jumlah_barang12=parseInt($(".mgo_jumlah_barang12 select option:selected").data("calc-value"))}
		}

		// jumlah barang
		$(document).on("change",".mgo_jumlah_barang1 select, .mgo_jumlah_barang2 select, .mgo_jumlah_barang3 select, .mgo_jumlah_barang4 select, .mgo_jumlah_barang5 select, .mgo_jumlah_barang6 select, .mgo_jumlah_barang7 select, .mgo_jumlah_barang8 select, .mgo_jumlah_barang9 select, .mgo_jumlah_barang10 select, .mgo_jumlah_barang11 select, .mgo_jumlah_barang12 select",function(e){set_jumlah();if(isNaN(jumlah_barang1)){jumlah_barang1=0}if(isNaN(jumlah_barang2)){jumlah_barang2=0}if(isNaN(jumlah_barang3)){jumlah_barang3=0}if(isNaN(jumlah_barang4)){jumlah_barang4=0}if(isNaN(jumlah_barang5)){jumlah_barang5=0}if(isNaN(jumlah_barang6)){jumlah_barang6=0}if(isNaN(jumlah_barang7)){jumlah_barang7=0}if(isNaN(jumlah_barang8)){jumlah_barang8=0}if(isNaN(jumlah_barang9)){jumlah_barang9=0}if(isNaN(jumlah_barang10)){jumlah_barang10=0}if(isNaN(jumlah_barang11)){jumlah_barang11=0}if(isNaN(jumlah_barang12)){jumlah_barang12=0}jumlah_barang=jumlah_barang1+jumlah_barang2+jumlah_barang3+jumlah_barang4+jumlah_barang5+jumlah_barang6+jumlah_barang7+jumlah_barang8+jumlah_barang9+jumlah_barang10+jumlah_barang11+jumlah_barang12;if(id_from_option!=""){set_ongkir(id_from_option)}});

		// barang or produk
		$(".mgo_barang1, .mgo_barang2, .mgo_barang3, .mgo_barang4, .mgo_barang5, .mgo_barang6, .mgo_barang7, .mgo_barang8, .mgo_barang9, .mgo_barang10, .mgo_barang11, .mgo_barang12 ").find("input:checkbox").bind("change",function(){if(!this.checked){set_jumlah();if(isNaN(jumlah_barang1)){jumlah_barang1=0}if(isNaN(jumlah_barang2)){jumlah_barang2=0}if(isNaN(jumlah_barang3)){jumlah_barang3=0}if(isNaN(jumlah_barang4)){jumlah_barang4=0}if(isNaN(jumlah_barang5)){jumlah_barang5=0}if(isNaN(jumlah_barang6)){jumlah_barang6=0}if(isNaN(jumlah_barang7)){jumlah_barang7=0}if(isNaN(jumlah_barang8)){jumlah_barang8=0}if(isNaN(jumlah_barang9)){jumlah_barang9=0}if(isNaN(jumlah_barang10)){jumlah_barang10=0}if(isNaN(jumlah_barang11)){jumlah_barang11=0}if(isNaN(jumlah_barang12)){jumlah_barang12=0}jumlah_barang=jumlah_barang1+jumlah_barang2+jumlah_barang3+jumlah_barang4+jumlah_barang5+jumlah_barang6+jumlah_barang7+jumlah_barang8+jumlah_barang9+jumlah_barang10+jumlah_barang11+jumlah_barang12;var idcheckbox=$(this).attr("class")+"-wrap";var classcheckbox=$("#"+idcheckbox).attr("class");var splitbarang=classcheckbox.split("form-group ");var classbarang=splitbarang[1];var uncheckedbarang=0;if(classbarang=="mgo_barang1"){uncheckedbarang=parseInt($(".mgo_jumlah_barang1 select").val())}if(classbarang=="mgo_barang2"){uncheckedbarang=parseInt($(".mgo_jumlah_barang2 select").val())}if(classbarang=="mgo_barang3"){uncheckedbarang=parseInt($(".mgo_jumlah_barang3 select").val())}if(classbarang=="mgo_barang4"){uncheckedbarang=parseInt($(".mgo_jumlah_barang4 select").val())}if(classbarang=="mgo_barang5"){uncheckedbarang=parseInt($(".mgo_jumlah_barang5 select").val())}if(classbarang=="mgo_barang6"){uncheckedbarang=parseInt($(".mgo_jumlah_barang6 select").val())}if(classbarang=="mgo_barang7"){uncheckedbarang=parseInt($(".mgo_jumlah_barang7 select").val())}if(classbarang=="mgo_barang8"){uncheckedbarang=parseInt($(".mgo_jumlah_barang8 select").val())}if(classbarang=="mgo_barang9"){uncheckedbarang=parseInt($(".mgo_jumlah_barang9 select").val())}if(classbarang=="mgo_barang10"){uncheckedbarang=parseInt($(".mgo_jumlah_barang10 select").val())}if(classbarang=="mgo_barang11"){uncheckedbarang=parseInt($(".mgo_jumlah_barang11 select").val())}if(classbarang=="mgo_barang12"){uncheckedbarang=parseInt($(".mgo_jumlah_barang12 select").val())}console.log("JUMLAH BARANG AWAL : "+jumlah_barang);jumlah_barang=jumlah_barang-uncheckedbarang;if(jumlah_barang==0){jumlah_barang=1}console.log("JUMLAH BARANG TERAKHIR : "+jumlah_barang);if(id_from_option!=""){set_ongkir(id_from_option)}}else{if(isNaN(jumlah_barang1)){jumlah_barang1=0}if(isNaN(jumlah_barang2)){jumlah_barang2=0}if(isNaN(jumlah_barang3)){jumlah_barang3=0}if(isNaN(jumlah_barang4)){jumlah_barang4=0}if(isNaN(jumlah_barang5)){jumlah_barang5=0}if(isNaN(jumlah_barang6)){jumlah_barang6=0}if(isNaN(jumlah_barang7)){jumlah_barang7=0}if(isNaN(jumlah_barang8)){jumlah_barang8=0}if(isNaN(jumlah_barang9)){jumlah_barang9=0}if(isNaN(jumlah_barang10)){jumlah_barang10=0}if(isNaN(jumlah_barang11)){jumlah_barang11=0}if(isNaN(jumlah_barang12)){jumlah_barang12=0}var idcheckbox=$(this).attr("class")+"-wrap";var classcheckbox=$("#"+idcheckbox).attr("class");var splitbarang=classcheckbox.split("form-group ");var classbarang=splitbarang[1];var checkedbarang=0;if(classbarang=="mgo_barang1"){checkedbarang=jumlah_barang1}if(classbarang=="mgo_barang2"){checkedbarang=jumlah_barang2}if(classbarang=="mgo_barang3"){checkedbarang=jumlah_barang3}if(classbarang=="mgo_barang4"){checkedbarang=jumlah_barang4}if(classbarang=="mgo_barang5"){checkedbarang=jumlah_barang5}if(classbarang=="mgo_barang6"){checkedbarang=jumlah_barang6}if(classbarang=="mgo_barang7"){checkedbarang=jumlah_barang7}if(classbarang=="mgo_barang8"){checkedbarang=jumlah_barang8}if(classbarang=="mgo_barang9"){checkedbarang=jumlah_barang9}if(classbarang=="mgo_barang10"){checkedbarang=jumlah_barang10}if(classbarang=="mgo_barang11"){checkedbarang=jumlah_barang11}if(classbarang=="mgo_barang12"){checkedbarang=jumlah_barang12}jumlah_barang=jumlah_barang1+jumlah_barang2+jumlah_barang3+jumlah_barang4+jumlah_barang5+jumlah_barang6+jumlah_barang7+jumlah_barang8+jumlah_barang9+jumlah_barang10+jumlah_barang11+jumlah_barang12;if(id_from_option!=""){set_ongkir(id_from_option)}}});

		// ************************
		// KUPON
		// ************************
		idkupon = "";
		id_mgo_kupon = $(".mgo_kupon").attr("id");
		if(id_mgo_kupon!=null){
			var fields_mgo_kupon = id_mgo_kupon.split("-wrap");
			idkupon = fields_mgo_kupon[0];
			$(".mgo_kupon label").append("<span class='."'".'checkkupon'."'".'></span>");
			$(".mgo_kupon input").after("<span class='."'".'kuponbutton'."'".'></span>");
			$("#"+idkupon).css({"color":"#9B59B6","background":"#ffffff"});
		}
		$(".mgo_kupon .kuponbutton").html("<input type='."'".'button'."'".' class='."'".'buttonapply'."'".' value='."'".'Apply'."'".' />");

		iddiskon = "";
		var id_mgo_diskon = $(".mgo_diskon").attr("id");
		if(id_mgo_diskon!=null){
			var fields_mgo_diskon = id_mgo_diskon.split("-wrap");
			iddiskon = fields_mgo_diskon[0];
			document.getElementById(iddiskon).readOnly = true;
		}

		diskonnya = 0;
		ongkir_magic = 0;
		ongkir_raja = 0;
		coupon_status = "";
		coupon_type = "";
		coupon_value = "";
		diskon_persen = 0;
		diskon_persen_status = false;
		$(".buttonapply").bind("click", function(e){
			
			var kodenya = $("#"+idkupon).val();
			if(kodenya != ""){
				$(".mgo_kupon label img").show();
				var data_nya = [
		        	kodenya
			    ];
			    var data = {
			        "action": "myaction_check_coupon",
			        "datanya": data_nya
			    };
			    jQuery.post(object_name.templateUrl+"/wp-admin/admin-ajax.php", data, function(response) {
			    	var couponnya = response.split("_");
					coupon_status = couponnya[0]; // valid
					coupon_type = couponnya[1]; // ph (potongan harga) | go (gratisongkir)
					coupon_value = couponnya[2]; // nilai atau diskonnya
					
					$(".mgo_kupon label img").hide();

					if(coupon_status == "valid"){
					
						$(".mgo_kupon label .checkkupon").html("<span style='."'".'color:#1FD11F;margin-left:10px;font-size:15px;'."'".'><span class='."'".'dashicons dashicons-yes'."'".' style='."'".'font-size: 24px;margin-right: 8px;margin-top:4px;'."'".'></span>Coupon Code Valid!</span>");
						if(coupon_type=="ph"){
							diskonnya = coupon_value*(-1);
							$("#"+iddiskon).val(diskonnya).attr("value", diskonnya);
							$(".mgo-caldera .two.diskon").text("Rp "+addCommas(diskonnya));
							var abc = "calculation_total_"+id_caldera_form2+"()";
							eval(abc);

						}else if(coupon_type=="ps"){
							diskon_persen = parseFloat(coupon_value/100);
							diskon_persen_status = true;
							var abc = "calculation_total_"+id_caldera_form2+"()";
							eval(abc);
						}else{
							if(ongkir_raja==1){
								diskonnya = mgo_ongkoskirim*(-1);
							}else if(ongkir_magic==1){
								diskonnya = hargaongkir*(-1);
							}else{
								diskonnya = 0;
							}

							$("#"+iddiskon).val(diskonnya).attr("value", diskonnya);
							$(".mgo-caldera .two.diskon").text("Rp "+addCommas(diskonnya));
							var abc = "calculation_total_"+id_caldera_form2+"()";
							eval(abc);
						}

						

					}else{
						if(coupon_status == "expired"){
							$(".mgo_kupon label .checkkupon").html("<span style='."'".'color:#DB2121;margin-left:10px;'."'".'><span class='."'".'dashicons dashicons-no'."'".' style='."'".'font-size: 28px;margin-right: 8px;'."'".'></span>Coupon Code Expired!</span>");
						}else{
							$(".mgo_kupon label .checkkupon").html("<span style='."'".'color:#DB2121;margin-left:10px;'."'".'><span class='."'".'dashicons dashicons-no'."'".' style='."'".'font-size: 28px;margin-right: 8px;'."'".'></span>Coupon Code Not Valid!</span>");
						}
						diskonnya = 0;
						diskon_persen_status = false;
						$("#"+iddiskon).val(diskonnya).attr("value", diskonnya);
						$(".mgo-caldera .two.diskon").text("Rp "+diskonnya);
						var abc = "calculation_total_"+id_caldera_form2+"()";
						eval(abc);
					}

			    });

			}
		});		

		$(document).on("change", ".mgo_ongkoskirim input", function(e) {
			
			if(ongkir_raja==1 && coupon_status=="valid"){
				ab = parseInt($(".mgo_ongkoskirim input:checked").data("calc-value"));
				diskonnya = ab*(-1);
				$("#"+iddiskon).val(diskonnya).attr("value", diskonnya);
				$(".mgo-caldera .two.diskon").text("Rp "+addCommas(diskonnya));
				var abc = "calculation_total_"+id_caldera_form2+"()";
				eval(abc);
			}
		});

		// END KUPON ************************
		// **********************************
        // GET ONGKIR

        // Kec
		id_kec = "";
		var id_mgo_kec = $(".mgo_kecamatan select").attr("id");
		if(id_mgo_kec!=null){
			var fields_mgo_kec = id_mgo_kec.split("-wrap");
			id_kec = fields_mgo_kec[0];
			$("#"+id_kec).prop("disabled", "disabled");
		}

		$( "#"+id_kec ).bind("change", function(e){
			if(id_ongkir!=""){
				var prov = $(".mgo_provinsi").find(":selected").val();
				var kabkota = $(".mgo_kabkota").find(":selected").val();
				var kecamatan = $(".mgo_kecamatan").find(":selected").val();

				$(".mgo_ongkoskirim label img").show();
				id_kec_selected = $(this).find(":selected").data("idkec");
				id_from_option = id_kec_selected;
				var data_nya = [
		        	id_kec_selected,
		        	id_caldera_form2,
		        	id_ongkir_label,
		        	jumlah_barang,
		        	multiple_courier,
		        	courier_code,
		        	berat_barang,
		        	prov,
		        	kabkota,
		        	kecamatan
			    ];
			    var data = {
			        "action": "myaction_get_ongkir",
			        "datanya": data_nya
			    };
			    jQuery.post(object_name.templateUrl+"/wp-admin/admin-ajax.php", data, function(response) {
			    	$(".mgo_ongkoskirim .option_ongkir").html(response);
			    	$(".mgo_ongkoskirim label img").hide();
			    	var abc = "calculation_total_"+id_caldera_form2+"()";
					eval(abc);
			    });
			}

		});

		$(".mgo_nama").bind("blur", function(e){
			var auto_calc = "calculation_total_"+id_caldera_form2+"()";
			eval(auto_calc);
		});

	});'
	;

	echo '</script>';


	echo '
	<script>
	function addCommas(nStr){
	    var parts = nStr.toString().split(".");
        parts[0]=parts[0].replace(/\B(?=(\d{3})+(?!\d))/g,".");
        return parts.join(",");
	}

	function commaToInt(t){
		var a = t.replace(/,/g, "");
		return a;
	}

	function commaToDot(t){
		var a = t.replace(/,/g, ".");
		return a;
	}
	</script>';


}



function magic_order_footer2() {
	global $wpdb;
	mgo_global_vars();

	$table_name = $wpdb->prefix . "mgo_calculation";
	$table_name_cf = $wpdb->prefix . "cf_forms";
	$rows = $wpdb->get_results("SELECT * from $table_name");
    $plugin_version = $GLOBALS['mgovars']['plugin_version'];
    $plugin_license = $GLOBALS['mgovars']['plugin_license'];

	$table_name2 = $wpdb->prefix . "mgo_settings";

	$row2 = $wpdb->get_results('SELECT data from '.$table_name2.' where type="orderid_text" or type="orderid_max" or type="atc_button" or type="additional_button" or type="additional_text" or type="additional_link" ORDER BY id ASC');
	$orderid_text = $row2[0]->data;
	$orderid_max = $row2[1]->data;
	$atc_button = $row2[2]->data;
	$additional_button = $row2[3]->data;
	$additional_text = $row2[4]->data;
	$additional_link = $row2[5]->data;

	if($atc_button==1){
		$show_atc = '';
	}else{
		$show_atc = '#custom_atc {margin-top:20px;}.woocommerce button.single_add_to_cart_button.button, button.single_add_to_cart_button[type=submit],button[name=add-to-cart][type=submit],a.button.ajax_add_to_cart,#shop-now .single_add_to_cart_button, #shop-now .tbay-buy-now{display:none !important;}@media only screen and (max-width:640px) {button.single_add_to_cart_button[type=submit],button[name=add-to-cart][type=submit],a.button.ajax_add_to_cart{display:none !important;}button.single_add_to_cart_button.button.alt {display: none !important;}}';
	}
	
	echo '<style>'.$show_atc.'</style>';

	// wooCommerce
	if($additional_button==1){
	echo '
	<script>
	jQuery(document).ready(function($) {

	    function getUrlParameter(t) {
	        var a, r, e = decodeURIComponent(window.location.search.substring(1)).split("&");
	        for (r = 0; r < e.length; r++)
	            if ((a = e[r].split("="))[0] === t) return void 0 === a[1] || a[1]
	    }

	    $( ".value select" ).bind("change", function(e){
	        ukuran_produknya = $(this).find("option:selected").text();
	        var title_button = "'.$additional_text.'",
		    link_form = "'.$additional_link.'",
		    nama_produk = $(".entry-title").text(),
		    kategori_produk = $(".posted_in a").text(),
		    ukuran_produk = ukuran_produknya,
		    harga_produk = $(".woocommerce-Price-amount.amount").text(),
		    jumlah_produk = $(".input-text").val(),
		    track_adsnya = getUrlParameter("trackads"),
		    data_url = "?produk=" + nama_produk + "&kategori=" + kategori_produk + "&harga=" + harga_produk + "&ukuran=" + ukuran_produk + "&jumlah=" + jumlah_produk + "&trackads=" + track_adsnya;

            var linknya = link_form+data_url;

            $("#custom_atc").attr("href", linknya);

	    });
	    $( ".input-text" ).bind("change", function(e){
	        jumlah_produknya = $(this).val();
	        var title_button = "'.$additional_text.'",
		    link_form = "'.$additional_link.'",
		    nama_produk = $(".entry-title").text(),
		    kategori_produk = $(".posted_in a").text(),
		    ukuran_produk = $(".variations .value").find("option:selected").text(),
		    harga_produk = $(".woocommerce-Price-amount.amount").text(),
		    jumlah_produk = jumlah_produknya,
		    track_adsnya = getUrlParameter("trackads"),
		    data_url = "?produk=" + nama_produk + "&kategori=" + kategori_produk + "&harga=" + harga_produk + "&ukuran=" + ukuran_produk + "&jumlah=" + jumlah_produk + "&trackads=" + track_adsnya;

            var linknya = link_form+data_url;

            $("#custom_atc").attr("href", linknya);

	    });

		
		var title_button = "'.$additional_text.'";
	    link_form = "'.$additional_link.'";
	    nama_produk = $(".entry-title").text();
	    kategori_produk = $(".posted_in a").text();
	    ukuran_produk = $(".variations .value").find("option:selected").text();
	    harga_produk = $(".woocommerce-Price-amount.amount").text();
	    jumlah_produk = $(".input-text").val();
	    track_adsnya = getUrlParameter("trackads");
	    data_url = "?produk=" + nama_produk + "&kategori=" + kategori_produk + "&harga=" + harga_produk + "&ukuran=" + ukuran_produk + "&jumlah=" + jumlah_produk + "&trackads=" + track_adsnya;
		 
		var button_beli2 = '."'".'<a id="custom_atc" class="button alt" target="_parent" href="'."'
		".'+link_form+data_url+'."
		'".'">'."'".' + title_button + '."'".'</a>'."'".';

		// $("form.cart").append(button_beli);
		$("form.cart").append(button_beli2);

		nama_ukuran_url = getUrlParameter("ukuran"), nama_harga_url = getUrlParameter("harga"), nama_produk_url = getUrlParameter("produk"), nama_kategori_url = getUrlParameter("kategori"), nama_jumlah_url = getUrlParameter("jumlah"), nama_trackads = getUrlParameter("trackads"), id_produk = "";

		var id_mgo_produk = $(".mgo_produk").attr("id");
		if (null != id_mgo_produk) {
		    var fields_mgo_produk = id_mgo_produk.split("-wrap");
		    id_produk = fields_mgo_produk[0], document.getElementById(id_produk).readOnly = !0, $("#" + id_produk).val(nama_produk_url), $("#" + id_produk).attr("value", nama_produk_url);
		}
		var id_kategori = "";
		var id_mgo_kategori = $(".mgo_kategori").attr("id");
		if (null != id_mgo_kategori) {
		    var fields_mgo_kategori = id_mgo_kategori.split("-wrap");
		    id_kategori = fields_mgo_kategori[0], document.getElementById(id_kategori).readOnly = !0, $("#" + id_kategori).val(nama_kategori_url), $("#" + id_kategori).attr("value", nama_kategori_url);
		}
		var id_harga = "";
		var id_mgo_harga = $(".mgo_harga").attr("id");
		if (null != id_mgo_harga) {
		    var fields_mgo_harga = id_mgo_harga.split("-wrap");
		    var str_harga = nama_harga_url;
		    if(nama_harga_url==undefined){
		    	str_harga = "Rp0";
		    }
			str_harga = str_harga.split("Rp").pop();
			remove_comma_harga = parseFloat(str_harga.replace(/,/g, ""));
			var nama_harga_url_int = parseFloat(remove_comma_harga);
		    id_harga = fields_mgo_harga[0], document.getElementById(id_harga).readOnly = !0, $("#" + id_harga).val(nama_harga_url_int), $("#" + id_harga).attr("value", nama_harga_url_int);
		}
		var id_ukuran = "";
		var id_mgo_ukuran = $(".mgo_ukuran").attr("id");
		if (null != id_mgo_ukuran) {
		    var fields_mgo_ukuran = id_mgo_ukuran.split("-wrap");
		    id_ukuran = fields_mgo_ukuran[0], document.getElementById(id_ukuran).readOnly = !0, $("#" + id_ukuran).val(nama_ukuran_url), $("#" + id_ukuran).attr("value", nama_ukuran_url);
		}
		var id_jumlah = "";
		var id_mgo_jumlah = $(".mgo_jumlah").attr("id");
		if (null != id_mgo_jumlah) {
		    var fields_mgo_jumlah = id_mgo_jumlah.split("-wrap");
		    id_jumlah = fields_mgo_jumlah[0], $("#" + id_jumlah).val(nama_jumlah_url), $("#" + id_jumlah).attr("value", nama_jumlah_url), $("#" + id_jumlah +" select").val(nama_jumlah_url);
		}
		var id_jumlah2 = "";
		var id_mgo_jumlah2 = $(".mgo_jumlah_barang").attr("id");
		if (null != id_mgo_jumlah2) {
		    var fields_mgo_jumlah2 = id_mgo_jumlah2.split("-wrap");
		    id_jumlah2 = fields_mgo_jumlah2[0], $("#" + id_jumlah2).val(nama_jumlah_url), $("#" + id_jumlah2).attr("value", nama_jumlah_url), $("#" + id_jumlah2 +" select").val(nama_jumlah_url);
		}
		var id_trackads = "";
		var id_mgo_trackads = $(".mgo_trackads").attr("id");
		if (null != id_mgo_trackads) {
		    var fields_mgo_trackads = id_mgo_trackads.split("-wrap");
		    id_trackads = fields_mgo_trackads[0], document.getElementById(id_trackads).readOnly = !0, $("#" + id_trackads).val(nama_trackads), $("#" + id_trackads).attr("value", nama_trackads);
		}

    });
    </script>
	';
	}
	

}
add_action( 'wp_footer', 'magic_order_footer2' );




function remove_http($url) {
   $disallowed = array('http://', 'https://');
   foreach($disallowed as $d) {
      if(strpos($url, $d) === 0) {
         return str_replace($d, '', $url);
      }
   }
   return $url;
}

function mgo_api() {
    global $wpdb;
    $table_name = $wpdb->prefix . "options";
	$row = $wpdb->get_results('SELECT option_value from '.$table_name.' where option_name="siteurl"');
	$row = $row[0];

    $table_name2 = $wpdb->prefix . "mgo_settings";
	$row2 = $wpdb->get_results('SELECT data from '.$table_name2.' where type="apikey"');
	$row2 = $row2[0];
	$row3 = $wpdb->get_results('SELECT data from '.$table_name2.' where type="apiurl"');
	$row3 = $row3[0];

    $term = $_POST['term'];
    
	$pieces = explode(" ", $_POST['from']);
	foreach($pieces as $key => $value){
		if( strpos( $value, "jne" ) !== false || strpos( $value, "j&t" ) !== false || strpos( $value, "tiki" ) !== false || strpos( $value, "pos" ) !== false  || strpos( $value, "jx" ) !== false ) {
			$eksfrom = explode("_", $value);
			$ekspedisi = $eksfrom[0];
		    $from = $eksfrom[1];
        }else{
        	$ekspedisi = "0";
		    $from = "0";
        }
	}

    $apikey = $row2->data;
    $apiurl = $row3->data;
    $server = remove_http($row->option_value);

   	$curl = curl_init();
	curl_setopt_array($curl, array(
		  CURLOPT_URL => $apiurl,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "Term: $term",
		    "Authorization: $apikey",
		    "Origin: $server",
		    "Ekspedisi: $ekspedisi",
		    "From: $from"
		  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
	  echo $response;
	}
	

	wp_die(); // this is required to terminate immediately and return a proper response

} 
add_action( 'wp_ajax_mgo_api', 'mgo_api' );
add_action( 'wp_ajax_nopriv_mgo_api', 'mgo_api' );



function mgo_api_activate_settings() {
	global $wpdb;
	$table_name = $wpdb->prefix . "options";
	$row = $wpdb->get_results('SELECT option_value from '.$table_name.' where option_name="siteurl"');
	$row = $row[0];

	$table_name2 = $wpdb->prefix . "mgo_settings";
    $apikey = $_POST['datanya'];

    $server = remove_http($row->option_value);
	$apiurl = 'https://member.magicorder.id/validateapi/mgo';

   	$curl = curl_init();
	curl_setopt_array($curl, array(
		  CURLOPT_URL => $apiurl,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "Origin: $server", // NAMA DOMAIN, NAMA ID HARDWARE
		    "Apikey: $apikey", // APIKEY
		    "Setup: activate", // ACTIVATE
		  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
	  	// echo $response;
	  	
	  	$hasil = json_decode($response);

	  	// UPDATE KE DB
		$wpdb->update(
            $table_name2, //table
            array('data' => $apikey), //data
            array('type' => 'apikey'), //where
            array('%s'), //data format
            array('%s') //where format
        );
        $wpdb->update(
            $table_name2, //table
            array('data' => $hasil[0]->apikeystatus), //data
            array('type' => 'apikey_status'), //where
            array('%s'), //data format
            array('%s') //where format
        );

        $wpdb->update(
            $table_name2, //table
            array('data' => $hasil[0]->pluginstatus), //data
            array('type' => 'plugin_status'), //where
            array('%s'), //data format
            array('%s') //where format
        );

        $wpdb->update(
            $table_name2, //table
            array('data' => $hasil[0]->expired), //data
            array('type' => 'expired'), //where
            array('%s'), //data format
            array('%s') //where format
        );

        $wpdb->update(
            $table_name2, //table
            array('data' => md5($hasil[0]->pluginstatus)), //data
            array('type' => 'mgo_license'), //where
            array('%s'), //data format
            array('%s') //where format
        );
		
		if($hasil[0]->apikeystatus=='valid'){
			$color = '#2EC26A';
		}else{
			$color = '#C02A41';
		}
		echo '<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color:'.$color.';">'.$hasil[0]->value.'</span>';
	}

	wp_die();
}
add_action( 'wp_ajax_mgo_api_activate_settings', 'mgo_api_activate_settings' );
add_action( 'wp_ajax_nopriv_mgo_api_activate_settings', 'mgo_api_activate_settings' );




function mgo_api_deactivate_settings() {
	global $wpdb;
	$table_name = $wpdb->prefix . "options";
	$row = $wpdb->get_results('SELECT option_value from '.$table_name.' where option_name="siteurl"');
	$row = $row[0];

	$table_name2 = $wpdb->prefix . "mgo_settings";
    $apikey = $_POST['datanya'];

    $server = remove_http($row->option_value);
	$apiurl = 'https://member.magicorder.id/validateapi/mgo';

   	$curl = curl_init();
	curl_setopt_array($curl, array(
		  CURLOPT_URL => $apiurl,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "Origin: $server",
		    "Apikey: $apikey",
		    "Setup: deactivate",
		  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
	  	// echo $response;
	  	
	  	$hasil = json_decode($response);

	  	// UPDATE KE DB
		$wpdb->update(
            $table_name2, //table
            array('data' => $apikey), //data
            array('type' => 'apikey'), //where
            array('%s'), //data format
            array('%s') //where format
        );
        $wpdb->update(
            $table_name2, //table
            array('data' => $hasil[0]->apikeystatus), //data deactivate
            array('type' => 'apikey_status'), //where
            array('%s'), //data format
            array('%s') //where format
        );

        $wpdb->update(
            $table_name2, //table
            array('data' => $hasil[0]->pluginstatus), //data
            array('type' => 'plugin_status'), //where
            array('%s'), //data format
            array('%s') //where format
        );

        $wpdb->update(
            $table_name2, //table
            array('data' => $hasil[0]->expired), //data
            array('type' => 'expired'), //where
            array('%s'), //data format
            array('%s') //where format
        );
		
		if($hasil[0]->apikeystatus=='deactivated'){
			$color = '#2EC26A';
		}else{
			$color = '#C02A41';
		}
		echo '<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color:'.$color.';">'.$hasil[0]->value.'</span>';
	}

	wp_die();
}
add_action( 'wp_ajax_mgo_api_deactivate_settings', 'mgo_api_deactivate_settings' );
add_action( 'wp_ajax_nopriv_mgo_api_deactivate_settings', 'mgo_api_deactivate_settings' );


function mgo_url_settings() {
	global $wpdb;
	$table_name = $wpdb->prefix . "mgo_settings";
    $apiurl = $_POST['datanya'];

    $wpdb->update(
            $table_name, //table
            array('data' => $apiurl), //data
            array('type' => 'apiurl'), //where
            array('%s'), //data format
            array('%s') //where format
        );

	echo '<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">API URL Save Successfully.</span>';

	wp_die();
}
add_action( 'wp_ajax_mgo_url_settings', 'mgo_url_settings' );
add_action( 'wp_ajax_nopriv_mgo_url_settings', 'mgo_url_settings' );


function myaction_save_api_rajaongkir() {
	global $wpdb;
	$table_name = $wpdb->prefix . "mgo_settings";
    $ro_apikey  = $_POST['datanya'][0];

    if($ro_apikey=='1'){
    	$apikey_ro = 'f8c9777c807e12be084a770f23c1a573';
	}elseif($ro_apikey=='2'){
    	$apikey_ro = '3f3bce6f9e0d62d356f48cb8040b5653';
	}elseif($ro_apikey=='3'){
    	$apikey_ro = '87a2b30d61ef10ad50774cf55b54cccd';
    }else{
    	$apikey_ro = $ro_apikey;
    }

    $wpdb->update(
            $table_name, //table
            array('data' => $apikey_ro), //data
            array('type' => 'ro_apikey'), //where
            array('%s'), //data format
            array('%s') //where format
        );

	echo '<span class="button" style="margin-top: 15px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">API Rajaongkir Save Successfully.</span>';

	wp_die();
}
add_action( 'wp_ajax_myaction_save_api_rajaongkir', 'myaction_save_api_rajaongkir' );
add_action( 'wp_ajax_nopriv_myaction_save_api_rajaongkir', 'myaction_save_api_rajaongkir' );



function myaction_save_nama_produk() {
	global $wpdb;
	$table_name = $wpdb->prefix . "mgo_settings";
    $nama_produk_status  = $_POST['datanya'][0];
    $nama_produk_other_name  = $_POST['datanya'][1];
    $order_id_status  = $_POST['datanya'][2];
    $order_id_other_name  = $_POST['datanya'][3];

    $wpdb->update(
            $table_name, //table
            array('data' => $nama_produk_status), //data
            array('type' => 'nama_produk_status'), //where
            array('%s'), //data format
            array('%s') //where format
        );

    $wpdb->update(
            $table_name, //table
            array('data' => $nama_produk_other_name), //data
            array('type' => 'nama_produk_other_name'), //where
            array('%s'), //data format
            array('%s') //where format
        );

    $wpdb->update(
            $table_name, //table
            array('data' => $order_id_status), //data
            array('type' => 'order_id_status'), //where
            array('%s'), //data format
            array('%s') //where format
        );

    $wpdb->update(
            $table_name, //table
            array('data' => $order_id_other_name), //data
            array('type' => 'order_id_other_name'), //where
            array('%s'), //data format
            array('%s') //where format
        );

	echo '<span class="button" style="margin-top: 15px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">Product Name Save Successfully.</span>';

	wp_die();
}
add_action( 'wp_ajax_myaction_save_nama_produk', 'myaction_save_nama_produk' );
add_action( 'wp_ajax_nopriv_myaction_save_nama_produk', 'myaction_save_nama_produk' );


function myaction_save_dash_style() {
	global $wpdb;
	$table_name = $wpdb->prefix . "mgo_settings";
    $dash_style  = $_POST['datanya'][0];

    $wpdb->update(
            $table_name, //table
            array('data' => $dash_style), //data
            array('type' => 'dash_style'), //where
            array('%s'), //data format
            array('%s') //where format
        );

	echo '<span class="button" style="margin-top: 5px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">Dashboard Style Save Successfully.</span>';

	wp_die();
}
add_action( 'wp_ajax_myaction_save_dash_style', 'myaction_save_dash_style' );
add_action( 'wp_ajax_nopriv_myaction_save_dash_style', 'myaction_save_dash_style' );


function myaction_save_pagination_table() {
	global $wpdb;
	$table_name = $wpdb->prefix . "mgo_settings";
    $pagination_table  = $_POST['datanya'][0];

    $wpdb->update(
            $table_name, //table
            array('data' => $pagination_table), //data
            array('type' => 'pagination_table'), //where
            array('%s'), //data format
            array('%s') //where format
        );

	echo '<span class="button" style="margin-top: 5px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">Table Pagination Style Save Successfully.</span>';

	wp_die();
}
add_action( 'wp_ajax_myaction_save_pagination_table', 'myaction_save_pagination_table' );
add_action( 'wp_ajax_nopriv_myaction_save_pagination_table', 'myaction_save_pagination_table' );




function myaction_save_moota_apikey() {
	global $wpdb;
	$table_name = $wpdb->prefix . "mgo_settings";
    $moota_apikey  = $_POST['datanya'][0];
    $moota_status  = $_POST['datanya'][1];
    $moota_wanotif_message  = $_POST['datanya'][2];
    $moota_wanotif_status = $_POST['datanya'][3];

    $wpdb->update(
            $table_name, //table
            array('data' => $moota_apikey), //data
            array('type' => 'moota_apikey'), //where
            array('%s'), //data format
            array('%s') //where format
        );

    $wpdb->update(
            $table_name, //table
            array('data' => $moota_status), //data
            array('type' => 'moota_status'), //where
            array('%s'), //data format
            array('%s') //where format
        );

    $wpdb->update(
            $table_name, //table
            array('data' => $moota_wanotif_message), //data
            array('type' => 'moota_wanotif_message'), //where
            array('%s'), //data format
            array('%s') //where format
        );

    $wpdb->update(
            $table_name, //table
            array('data' => $moota_wanotif_status), //data
            array('type' => 'moota_wanotif_status'), //where
            array('%s'), //data format
            array('%s') //where format
        );

	echo '<span class="button" style="margin-top: 25px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">API Moota Save Successfully.</span>';

	wp_die();
}
add_action( 'wp_ajax_myaction_save_moota_apikey', 'myaction_save_moota_apikey' );
add_action( 'wp_ajax_nopriv_myaction_save_moota_apikey', 'myaction_save_moota_apikey' );





function optionselect($no,$var_char,$rand_id,$optionnya,$key){
	$char_plus = '';
    $char_minus = '';
    $char_kali = '';
    $char_bagi = '';
    if($var_char=='+'){
        $char_plus = 'selected="selected"';
    }
    if($var_char=='-'){
        $char_minus = 'selected="selected"';
    }
    if($var_char=='*'){
        $char_kali = 'selected="selected"';
    }
    if($var_char==':'){
        $char_bagi = 'selected="selected"';
    }

    $option_calc = '<select name="op-'.$rand_id.'" class="calc"><option value="+" '.$char_plus.'>+</option><option value="-" '.$char_minus.'>-</option><option value="*" '.$char_kali.'>x</option><option value="/" '.$char_bagi.'>:</option></select>&nbsp;';
    $button_delete = '<input type="button" name="update" title="Delete" value="&nbsp;-&nbsp;" class="button btn-del btn_red_line" data-idnya="'.$rand_id.'"';
    
    if($no==1){
        $option_calc = '';
        $button_delete = '';
    }

	echo '<tr id="tr-'.$rand_id.'"><td>'.$option_calc.'<select name="select-'.$rand_id.'" class="calc select-var">'.$optionnya.'</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$button_delete.'</td></tr>';
}

function myaction_get_datamgo_caldera() {
	// INISIAL
    global $wpdb;
    $table_name = $wpdb->prefix . "cf_forms";
    $table_name2 = $wpdb->prefix . "mgo_calculation";
    $id = $_POST['datanya'][0];

    // CHECK ROLE
    check_role();

    // GET DATA
    $row = $wpdb->get_results('SELECT * from '.$table_name.' where form_id="'.$id.'" and type="primary"');
    $row = $row[0];
    $dataconfig = json_encode(maybe_unserialize( $row->config ));
    $datajson = json_decode($dataconfig);
    $fields = $datajson->layout_grid->fields;
    $judul_form = $datajson->name;

    $row2 = $wpdb->get_results('SELECT * from '.$table_name2.' where id_form="'.$id.'"');
    if($row2==null){
        $field_form = '';
        $rumus_calculation = '';
    }else{
        $field_form = $row2[0]->field_form;
        $rumus_calculation = $row2[0]->rumus_calculation;
    }
    // echo $field_form.'oke';
    	$optionnya2 = '';
        foreach ($fields as $key => $value ) {
            $nama_class = $datajson->fields->$key->config->custom_class;
            $pieces = explode(" ", $nama_class);
            $nama_class = $pieces[0];
            $type_input = $datajson->fields->$key->type;
            if($nama_class!=""){

                if (strpos($nama_class, 'mgo_ongkir') !== false) {
                    $selected = 'selected="selected"';
                }else{
                    $selected = "";
                }

                if (strpos($nama_class, 'mgo_kecamatan') !== false || strpos($nama_class, 'mgo_total') !== false || strpos($nama_class, 'mgo_orderid') !== false || strpos($nama_class, 'mgo_csid') !== false || strpos($nama_class, 'mgo_csmail') !== false || strpos($nama_class, 'mgo_provinsi') !== false || strpos($nama_class, 'mgo_kabkota') !== false || strpos($nama_class, 'btn_buy') !== false) {
                $disabled = 'disabled="disabled"';
	            }else{
	                $disabled = "";
	            }
                
                $optionnya2 .= '<option value="'.$nama_class.':'.$type_input.'" '.$selected.' '.$disabled.'>'.$nama_class.'</option>';
            }
        }

        /*
	    function RandomString($length) {
	        $keys = array_merge(range(0,9), range('a', 'z'));

	        $key = "";
	        for($i=0; $i < $length; $i++) {
	            $key .= $keys[mt_rand(0, count($keys) - 1)];
	        }
	        return $key;
	    }
	    */

		echo '
            <table class="wp-list-table widefat fixed" style="border: 0;background: #fff;margin-bottom: 30px;margin-top: 10px;margin-left:-10px;">
                <tr id="first-line">
                    <td>
                    	<h3 style="margin-bottom: 5px;">Operation:</h3>
                        <select class="select-var" style="display: none;">
                        <option value="mgo_kecamatan:text" selected="selected">mgo_kecamatan</option>
                        </select>';
                        
                        $array_fieldform = json_decode($field_form, TRUE);
                        if (is_array($array_fieldform) || is_object($array_fieldform)){

                            // get formula and change to only operator
                            $string = $rumus_calculation;
                            $change_pembagi = str_replace("/", ":", $string);
                            $clean_code = preg_replace('/[^-+*:]/', '', $change_pembagi);
                            $array_operation = str_split($clean_code);
                            

                            $no = 1; // 0 untuk mgo_kecamatan, selain itu echo
                            $select_options = '';
                            foreach ($array_fieldform as $key => $value) {
                            	
                            	$pieces = explode("_x", $key);
                            	$key = $pieces[0];

                                if($key!='mgo_kecamatan'){
                                	$varnya = $key.':'.$value;
                                    $rand_id = RandomString(4);

                                    $a = $no-2;
                                    $var_char = '';
                                    foreach($array_operation as $key => $value){
                                        if($key==$a){
                                            $var_char = $value;
                                        }
                                    }
                                    
                                    $optionnya = '';
								    foreach ($fields as $key => $value ) {
								        $nama_class = $datajson->fields->$key->config->custom_class;
								        $pieces = explode(" ", $nama_class);
		                                $nama_class = $pieces[0];
								        $type_input = $datajson->fields->$key->type;
								        if($nama_class!=""){

								            $valuenya = $nama_class.":".$type_input;

								            if($varnya==$valuenya){
								                $selected = 'selected="selected"';
								            }else{
								                $selected = "";
								            }

								            if (strpos($nama_class, 'mgo_kecamatan') !== false || strpos($nama_class, 'mgo_total') !== false || strpos($nama_class, 'mgo_orderid') !== false || strpos($nama_class, 'mgo_csid') !== false || strpos($nama_class, 'mgo_csmail') !== false || strpos($nama_class, 'mgo_provinsi') !== false || strpos($nama_class, 'mgo_kabkota') !== false || strpos($nama_class, 'btn_buy') !== false) {
								                $disabled = 'disabled="disabled"';
								            }else{
								                $disabled = "";
								            }
								            
								            $optionnya .= '<option value="'.$nama_class.':'.$type_input.'" '.$selected.' '.$disabled.'>'.$nama_class.'</option>';
								        }
								    }

                                    echo optionselect($no,$var_char,$rand_id,$optionnya,$key);

                                    $no++;
                                }
                            	
                            }
                        }else{
                        	echo'<tr><td><select name="select-'.RandomString(3).'" class="calc select-var">'.$optionnya2.'</select></td></tr>';
                        }

                        echo '<tr id="line"></tr><tr><td><button id="add_line" type="button" name="update" class="button btn_mgo"><span class="dashicons dashicons-plus" style="margin-top:6px;margin-right:2px;font-size: 16px;"></span>Add Line</button>
                        </td></tr><tr><td></td></tr><tr><td><hr></td></tr>';
                        echo '
                        <tr><td>
	                        <h3 style="margin-top: 0;">Formula:</h3>
	                        <textarea name="field_form" id="hasil-var" cols="100" rows="2" style="display: none;width: 100%;" readonly="">'.$field_form.'</textarea>
	                        <textarea name="rumus_calculation" id="hasil-calc" cols="100" rows="3" readonly="" style="width: 100%;">'.$rumus_calculation.'</textarea>
	                        </td>
	                    </tr>
	                    <tr>
	                        <td>
                            <button id="form_generate" type="button" name="update" class="button btn_mgo"><span class="dashicons dashicons-update" style="margin-top:3px;margin-right:2px;"></span>Generate</button>&nbsp;&nbsp;
                            <button id="del_form_generate" type="button" name="update" class="button btn_mgo btn_regular btn_clear"><span class="dashicons dashicons-trash" style="margin-top:3px;margin-right:2px;"></span>Clear</button>&nbsp;&nbsp;
	                        </td>
	                    </tr>
	                    <tr><td></td></tr>
	                    <tr><td><hr></td></tr>
	                    ';
        
        $randomid = RandomString(3);   
        echo '
            </table>
            <input type="button" id="save_formula" data-id="'.$id.'" value="Save Formula" class="button btn_mgo_new_purple" style="margin-bottom:15px !important;margin-top:-5px !important;"><span id="success_response"></span>
        <script>
        jQuery(document).ready(function($) {

        	$(".btn-del").bind("click", function(e){
				var idnya = $(this).data("idnya");
				var new_idnya = "tr-"+idnya;
				console.log(new_idnya);
				$("#"+new_idnya).remove();
        	});

	    	var ALPHABET = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		    var ID_LENGTH = 4;
		    var generate = function() {
		      var rtn = "";
		      for (var i = 0; i < ID_LENGTH; i++) {
		        rtn += ALPHABET.charAt(Math.floor(Math.random() * ALPHABET.length));
		      }
		      return rtn;
		    }

		    $("#add_line").bind("click", function(e){
		        var idnya = generate();
		        var content = '."'".'<tr id="tr-'."'+idnya+'".'"><td><select name="op-'."'+idnya+'".'" class="calc"><option value="+">+</option><option value="-">-</option><option value="*">x</option><option value="/">:</option></select>&nbsp;<select name="select-'."'+idnya+'".'" class="calc select-var">'.$optionnya2.'</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="update" title="Delete" value="&nbsp;-&nbsp;" data-idnya="'."'+idnya+'".'" class="button btn-del btn_red_line"></td></tr>'."';";
		        echo '
		        $("#line").append(content);
		    });

		    $("#del_form_generate").bind("click", function(){
		        $("#hasil-var").val("");
		        $("#hasil-calc").val("");
		    });
		    
		    $("#form_generate").bind("click", function(e){
		        var arr_var = $("select.select-var").map(function(){
		            return this.value;
		        }).get().toString();

		        var arrvar_petik = arr_var.replace(/:/g , '."'".'":"'."');".'
		        var arrvar_comma = arrvar_petik.replace(/,/g , '."'".'","'."');".'
		        var new_arr_var = arrvar_comma;
		        $("#hasil-var").val('."'".'{"'."'+new_arr_var+'".'"'."}');".'

		        var arr_calc = $("select.calc").map(function(){
		              return this.value;
		          }).get().toString();
				
				var arrcalc_set_jx = arr_calc.replace(/ set_jx/g , '.'"");'.'
				var arrcalc_set_default = arrcalc_set_jx.replace(/ set_default/g , '.'"");'.'
				var arrcalc_set_hide = arrcalc_set_default.replace(/ set_hide/g , '.'"");'.'
		        var arrcalc_set_show = arrcalc_set_hide.replace(/ set_show/g , '.'"");'.'
		        var arrcalc_hidden = arrcalc_set_show.replace(/:hidden/g , '.'"");'.'
		        var arrcalc_checkbox = arrcalc_hidden.replace(/:checkbox/g , '.'"");'.'
		        var arrcalc_radio = arrcalc_checkbox.replace(/:radio/g , '.'"");'.'
		        var arrcalc_dropdown = arrcalc_radio.replace(/:dropdown/g , '.'"");'.'
		        var arrcalc_text = arrcalc_dropdown.replace(/:text/g , '.'"");'.'
		        var arrcalc_number = arrcalc_text.replace(/:number/g , '.'"");'.'
		        var arrcalc_select = arrcalc_number.replace(/:select/g , '.'"");'.'
		        var arrcalc_comma = arrcalc_select.replace(/,/g , '.'"");'.'
		        var arrcalc_plus = arrcalc_comma.replace(/\+/g , '.'")+(");'.'
		        var arrcalc_minus = arrcalc_plus.replace(/\-/g , '.'")-(");'.'
		        var new_arr_calc = arrcalc_plus;        
		        $("#hasil-calc").val('."'('".'+new_arr_calc+'."')');".'
		    });

		    $("#save_formula").bind("click", function(){
		    	$("#success_response").html('."'".'<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;font-weight: bold;margin-top:5px;">Saving...</span>'."'".');

		    	if($("#hasil-calc").val()!=""){
					$(".notif_light_formula").addClass("on");
				}else{
					$(".notif_light_formula").removeClass("on");
				}

		        var data_nya = [
		            $(this).data("id"),
					$("#hasil-var").val(),
					$("#hasil-calc").val()
		        ];
		        var data = {
		            "action": "myaction_save_formula",
		            "datanya": data_nya
		        };
		        jQuery.post(ajaxurl, data, function(response) {
		            $("#success_response").html(response);
		        });
		    });
		});
    	</script>
        ';

    // echo 'Success : '.$id;
    wp_die();
} 
add_action( 'wp_ajax_myaction_get_datamgo_caldera', 'myaction_get_datamgo_caldera' );
add_action( 'wp_ajax_nopriv_myaction_get_datamgo_caldera', 'myaction_get_datamgo_caldera' );


function myaction_mgo_setting_formula_gf() {

	// INISIAL
    global $wpdb;
    $table_name = $wpdb->prefix . "gf_form_meta";
    $table_name2 = $wpdb->prefix . "mgo_gf_calculation";
    $id = $_POST['datanya'][0];

    // CHECK ROLE
    check_role();

    // GET DATA
    $row = $wpdb->get_results('SELECT * from '.$table_name.' where form_id="'.$id.'" ');
    $row = $row[0];
    $form = json_decode($row->display_meta, TRUE);
	$fields = $form['fields'];
    $judul_form = $form['title'];
    
    $row2 = $wpdb->get_results('SELECT * from '.$table_name2.' where id_form="'.$id.'"');
    if($row2==null){
        $field_form = '';
        $rumus_calculation = '';
    }else{
        $field_form = $row2[0]->field_form;
        $rumus_calculation = $row2[0]->rumus_calculation;
    }
    // echo $field_form.'oke';
    	$optionnya2 = '';
        foreach ($fields as $key => $value ) {
            $nama_class = $form['fields'][$key]['cssClass'];
            $pieces = explode(" ", $nama_class);
            $nama_class = $pieces[0];
            $type_input = $form['fields'][$key]['type'];
            if($nama_class!=""){

                if (strpos($nama_class, 'mgo_ongkir') !== false) {
                    $selected = 'selected="selected"';
                }else{
                    $selected = "";
                }

                if (strpos($nama_class, 'mgo_kecamatan') !== false || strpos($nama_class, 'mgo_total') !== false || strpos($nama_class, 'mgo_orderid') !== false || strpos($nama_class, 'mgo_csid') !== false || strpos($nama_class, 'mgo_csmail') !== false || strpos($nama_class, 'mgo_provinsi') !== false || strpos($nama_class, 'mgo_kabkota') !== false || strpos($nama_class, 'btn_buy') !== false) {
                $disabled = 'disabled="disabled"';
	            }else{
	                $disabled = "";
	            }
                
                $optionnya2 .= '<option value="'.$nama_class.':'.$type_input.'" '.$selected.' '.$disabled.'>'.$nama_class.'</option>';
            }
        }

        /*
	    function RandomString($length) {
	        $keys = array_merge(range(0,9), range('a', 'z'));

	        $key = "";
	        for($i=0; $i < $length; $i++) {
	            $key .= $keys[mt_rand(0, count($keys) - 1)];
	        }
	        return $key;
	    }
	    */

		echo '
            <table class="wp-list-table widefat fixed" style="border: 0;background: #fff;margin-bottom: 30px;margin-top: 10px;margin-left:-10px;">
                <tr id="first-line">
                    <td>
                    	<h3 style="margin-bottom: 5px;">Operation:</h3>
                        <select class="select-var" style="display: none;">
                        <option value="mgo_kecamatan:text" selected="selected">mgo_kecamatan</option>
                        </select>';
                        
                        $array_fieldform = json_decode($field_form, TRUE);
                        if (is_array($array_fieldform) || is_object($array_fieldform)){

                            // get formula and change to only operator
                            $string = $rumus_calculation;
                            $change_pembagi = str_replace("/", ":", $string);
                            $clean_code = preg_replace('/[^-+*:]/', '', $change_pembagi);
                            $array_operation = str_split($clean_code);
                            

                            $no = 1; // 0 untuk mgo_kecamatan, selain itu echo
                            $select_options = '';
                            foreach ($array_fieldform as $key => $value) {
                            	
                            	$pieces = explode("_x", $key);
                            	$key = $pieces[0];

                                if($key!='mgo_kecamatan'){
                                	$varnya = $key.':'.$value;
                                    $rand_id = RandomString(4);

                                    $a = $no-2;
                                    $var_char = '';
                                    foreach($array_operation as $key => $value){
                                        if($key==$a){
                                            $var_char = $value;
                                        }
                                    }
                                    
                                    $optionnya = '';
								    foreach ($fields as $key => $value ) {
							            $nama_class = $form['fields'][$key]['cssClass'];
							            $pieces = explode(" ", $nama_class);
		                                $nama_class = $pieces[0];
							            $type_input = $form['fields'][$key]['type'];

								        if($nama_class!=""){

								            $valuenya = $nama_class.":".$type_input;

								            if($varnya==$valuenya){
								                $selected = 'selected="selected"';
								            }else{
								                $selected = "";
								            }

								            if (strpos($nama_class, 'mgo_kecamatan') !== false || strpos($nama_class, 'mgo_total') !== false || strpos($nama_class, 'mgo_orderid') !== false || strpos($nama_class, 'mgo_csid') !== false || strpos($nama_class, 'mgo_csmail') !== false || strpos($nama_class, 'mgo_provinsi') !== false || strpos($nama_class, 'mgo_kabkota') !== false || strpos($nama_class, 'btn_buy') !== false) {
								                $disabled = 'disabled="disabled"';
								            }else{
								                $disabled = "";
								            }
								            
								            $optionnya .= '<option value="'.$nama_class.':'.$type_input.'" '.$selected.' '.$disabled.'>'.$nama_class.'</option>';
								        }
								    }

                                    echo optionselect($no,$var_char,$rand_id,$optionnya,$key);

                                    $no++;
                                }
                            	
                            }
                        }else{
                        	echo'<tr><td><select name="select-'.RandomString(3).'" class="calc select-var">'.$optionnya2.'</select></td></tr>';
                        }

                        echo '<tr id="line"></tr><tr><td><button id="add_line" type="button" name="update" class="button-primary"><span class="dashicons dashicons-plus" style="margin-top:6px;margin-right:2px;font-size: 16px;"></span>Add Line</button>
                        </td></tr><tr><td></td></tr><tr><td><hr></td></tr>';
                        echo '
                        <tr><td>
	                        <h3 style="margin-top: 0;">Formula:</h3>
	                        <textarea name="field_form" id="hasil-var" cols="100" rows="2" style="display: none;width: 100%;" readonly="">'.$field_form.'</textarea>
	                        <textarea name="rumus_calculation" id="hasil-calc" cols="100" rows="2" readonly="" style="width: 100%;">'.$rumus_calculation.'</textarea>
	                        </td>
	                    </tr>
	                    <tr>
	                        <td>
                            <button id="form_generate" type="button" name="update" class="button-primary"><span class="dashicons dashicons-update" style="margin-top:3px;margin-right:2px;"></span>Generate</button>&nbsp;&nbsp;
                            <button id="del_form_generate" type="button" name="update" class="button"><span class="dashicons dashicons-trash" style="margin-top:3px;margin-right:2px;"></span>Delete</button>&nbsp;&nbsp;
	                        </td>
	                    </tr>
	                    <tr><td></td></tr>
	                    <tr><td><hr></td></tr>
	                    ';
        
        $randomid = RandomString(3);   
        echo '
            </table>
            <input type="button" id="save_formula" data-id="'.$id.'" value="Save Formula" class="button btn_mgo_new_purple" style="margin-bottom:15px !important;margin-top:-5px !important;"><span id="success_response"></span>
        <script>
        jQuery(document).ready(function($) {

        	$(".btn-del").bind("click", function(e){
				var idnya = $(this).data("idnya");
				var new_idnya = "tr-"+idnya;
				console.log(new_idnya);
				$("#"+new_idnya).remove();
        	});

	    	var ALPHABET = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		    var ID_LENGTH = 4;
		    var generate = function() {
		      var rtn = "";
		      for (var i = 0; i < ID_LENGTH; i++) {
		        rtn += ALPHABET.charAt(Math.floor(Math.random() * ALPHABET.length));
		      }
		      return rtn;
		    }

		    $("#add_line").bind("click", function(e){
		        var idnya = generate();
		        var content = '."'".'<tr id="tr-'."'+idnya+'".'"><td><select name="op-'."'+idnya+'".'" class="calc"><option value="+">+</option><option value="-">-</option><option value="*">x</option><option value="/">:</option></select>&nbsp;<select name="select-'."'+idnya+'".'" class="calc select-var">'.$optionnya2.'</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="update" title="Delete" value="&nbsp;-&nbsp;" data-idnya="'."'+idnya+'".'" class="button btn-del"></td></tr>'."';";
		        echo '
		        $("#line").append(content);
		    });

		    $("#del_form_generate").bind("click", function(){
		        $("#hasil-var").val("");
		        $("#hasil-calc").val("");
		    });
		    
		    $("#form_generate").bind("click", function(e){
		        var arr_var = $("select.select-var").map(function(){
		            return this.value;
		        }).get().toString();

		        var arrvar_petik = arr_var.replace(/:/g , '."'".'":"'."');".'
		        var arrvar_comma = arrvar_petik.replace(/,/g , '."'".'","'."');".'
		        var new_arr_var = arrvar_comma;
		        $("#hasil-var").val('."'".'{"'."'+new_arr_var+'".'"'."}');".'

		        var arr_calc = $("select.calc").map(function(){
		              return this.value;
		          }).get().toString();
				
				var arrcalc_set_jx = arr_calc.replace(/ set_jx/g , '.'"");'.'
				var arrcalc_set_default = arrcalc_set_jx.replace(/ set_default/g , '.'"");'.'
				var arrcalc_set_hide = arrcalc_set_default.replace(/ set_hide/g , '.'"");'.'
		        var arrcalc_set_show = arrcalc_set_hide.replace(/ set_show/g , '.'"");'.'
		        var arrcalc_hidden = arrcalc_set_show.replace(/:hidden/g , '.'"");'.'
		        var arrcalc_checkbox = arrcalc_hidden.replace(/:checkbox/g , '.'"");'.'
		        var arrcalc_radio = arrcalc_checkbox.replace(/:radio/g , '.'"");'.'
		        var arrcalc_dropdown = arrcalc_radio.replace(/:dropdown/g , '.'"");'.'
		        var arrcalc_text = arrcalc_dropdown.replace(/:text/g , '.'"");'.'
		        var arrcalc_number = arrcalc_text.replace(/:number/g , '.'"");'.'
		        var arrcalc_select = arrcalc_number.replace(/:select/g , '.'"");'.'
		        var arrcalc_comma = arrcalc_select.replace(/,/g , '.'"");'.'
		        var arrcalc_plus = arrcalc_comma.replace(/\+/g , '.'")+(");'.'
		        var arrcalc_minus = arrcalc_plus.replace(/\-/g , '.'")-(");'.'
		        var new_arr_calc = arrcalc_plus;        
		        $("#hasil-calc").val('."'('".'+new_arr_calc+'."')');".'
		    });

		    $("#save_formula").bind("click", function(){
		    	$("#success_response").html('."'".'<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;font-weight: bold;margin-top:5px;">Saving...</span>'."'".');
		        var data_nya = [
		            $(this).data("id"),
					$("#hasil-var").val(),
					$("#hasil-calc").val()
		        ];
		        var data = {
		            "action": "myaction_save_formula",
		            "datanya": data_nya
		        };
		        jQuery.post(ajaxurl, data, function(response) {
		            $("#success_response").html(response);
		        });
		    });
		});
    	</script>
        ';
    

    // echo 'Success : '.$id;
    wp_die();

} 
add_action( 'wp_ajax_myaction_mgo_setting_formula_gf', 'myaction_mgo_setting_formula_gf' );
add_action( 'wp_ajax_nopriv_myaction_mgo_setting_formula_gf', 'myaction_mgo_setting_formula_gf' );



function myaction_mgo_setting_cs_rotator_gf() {

	echo '
	CS Rotator
	';

	wp_die();

} 
add_action( 'wp_ajax_myaction_mgo_setting_cs_rotator_gf', 'myaction_mgo_setting_cs_rotator_gf' );
add_action( 'wp_ajax_nopriv_myaction_mgo_setting_cs_rotator_gf', 'myaction_mgo_setting_cs_rotator_gf' );



function myaction_mgo_setting_courier_gf() {

	echo '
	Courier
	';

	wp_die();

} 
add_action( 'wp_ajax_myaction_mgo_setting_courier_gf', 'myaction_mgo_setting_courier_gf' );
add_action( 'wp_ajax_nopriv_myaction_mgo_setting_courier_gf', 'myaction_mgo_setting_courier_gf' );


function myaction_mgo_setting_wanotif_sms_gf() {

	echo '
	Wanotif SMS
	';

	wp_die();

} 
add_action( 'wp_ajax_myaction_mgo_setting_wanotif_sms_gf', 'myaction_mgo_setting_wanotif_sms_gf' );
add_action( 'wp_ajax_nopriv_myaction_mgo_setting_wanotif_sms_gf', 'myaction_mgo_setting_wanotif_sms_gf' );



function check_role(){
	global $wpdb;
	// Get USER ROLES
    $cap = get_user_meta( wp_get_current_user()->ID, $wpdb->get_blog_prefix() . 'capabilities', true );
    $roles = array_keys((array)$cap);
    $role = $roles[0];

    // CUSTOMER SERVICES (EDITOR ROLE)
    if($role!='administrator'){
        echo '
        <div class="sub-title" style="margin-top: 90px; font-size: 16px; font-weight: bold; text-align: center;"><span>Sorry, This menu is only for administrator!</span></div>
        <div class="wrap-container" style="padding: 15px 30px;">
        </div>';
        // return false;
        wp_die();
    }
}


function myaction_get_datacs() {
	// INISIAL
    global $wpdb;
    $table_name = $wpdb->prefix . "cf_forms";
    $table_name2 = $wpdb->prefix . "mgo_calculation";
    $table_name3 = $wpdb->prefix . "users";
    $id = $_POST['datanya'][0];

    if (is_numeric($id)){
		$table_name2 = $wpdb->prefix . "mgo_gf_calculation";
	}

    mgo_global_vars();
    $plugin_license = $GLOBALS['mgovars']['plugin_license'];
    $plugin_license_info = $GLOBALS['mgovars']['plugin_license_info'];

    // Check Plugin Licensed
    if($plugin_license=='FREEMIUM' || $plugin_license=='STARTER'){
    	echo '<div class="sub-title" style="margin-top: 90px; font-size: 16px; font-weight: bold; text-align: center;">';
        echo $plugin_license_info;
        echo '</div>';
        wp_die();
        return false;
    }

    // CHECK ROLE
    check_role();

    // GET DATA
    $row2 = $wpdb->get_results('SELECT * from '.$table_name2.' where id_form="'.$id.'"');
    if($row2==null){
        $id_cs = '';
        $rotator_status = 0;
        $cs_bobot = '';
    }else{
        $id_cs = $row2[0]->id_cs;
        $rotator_status = $row2[0]->rotator_status;
        $cs_bobot = $row2[0]->cs_bobot;
    }

    if($rotator_status==1){
    	$set_rotator_todayorders = '';
    	$set_rotator_allorders = 'checked';
	}else{
		$set_rotator_todayorders = 'checked';
    	$set_rotator_allorders = '';
	}

    // echo $field_form.'oke';
    	$optionnya2 = '';
	    // $users = $wpdb->get_results('SELECT ID,display_name from '.$table_name3.' ');
	    $blogs = array();
	    $args = array( 'blog_id' => 0 );
	    $users = get_users( $args );

	    $optionnya2 = '<option value="">Choose CS</option>';
	    foreach ($users as $data ) {

	        if ($data->ID==$id) {
	            $selected = 'selected="selected"';
	        }else{
	            $selected = "";
	        }

	        $nama_user = str_replace("'", "", $data->display_name);
	        $optionnya2 .= '<option value="'.$data->ID.'" '.$selected.'>'.$nama_user.'</option>';
	    
	    }

	    /*
	    function RandomString($length) {
	        $keys = array_merge(range(0,9), range('a', 'z'));

	        $key = "";
	        for($i=0; $i < $length; $i++) {
	            $key .= $keys[mt_rand(0, count($keys) - 1)];
	        }
	        return $key;
	    }
	    */

		echo '
			<style>.radio.ganjil{margin-right:32px}.labelname{padding-left:8px;position:absolute;margin-left:30px;margin-top:-21px}.checkbox,.radio{margin-bottom:8px;margin-left:-10px;width:48%;float:left}.radio label{padding:10px}.checkbox *,.radio *{cursor:pointer}.checkbox input,.radio input{opacity:0}.checkbox span,.radio span{position:relative;display:inline-block;margin-left:-25px;vertical-align:top;width:20px;height:20px;border-radius:4px;border:1px solid #ccc}.checkbox:hover span,.radio:hover span{border-color:#6c61f6}.checkbox span:before,.radio span:before{content:"\2713";position:absolute;top:0;left:0;right:0;bottom:0;opacity:0;text-align:center;font-size:16px;line-height:18px;vertical-align:middle;color:#6c61f6}.radio span{border-radius:50%}.radio span:before{content:"";width:10px;height:10px;margin:5px auto;background-color:#6c61f6;border-radius:100px}.checkbox input[type=checkbox]:checked+span,.radio input[type=radio]:checked+span{border-color:#6c61f6;background-color:#6c61f6}.radio input[type=radio]:checked+span{background-color:#fff}.checkbox input[type=checkbox]:checked+span:before,.radio input[type=radio]:checked+span:before{color:#fff;opacity:1;transition:color .3 ease-out}.checkbox input[type=checkbox]:disabled+span,.radio input[type=radio]:disabled+span{border-color:#ddd!important;background-color:#ddd!important}.bobot-cs {
            position: absolute;display:inline;padding: 5px 7px;border-radius: 4px;color: #6c61f6;font-weight: bold;
        }.opt-plus {display: none;}</style>
            <table class="wp-list-table widefat fixed" style="border: 0;background: #fff;margin-bottom: 30px;margin-top: 10px;margin-left:-10px;">
                    <tr id="first-line">
                        <td>
                            <h3 style="margin-bottom: 5px;">Customer Service:</h3>
                            
			                ';
                        
                        	// OPTIONS
                            // $users = $wpdb->get_results('SELECT ID,display_name from '.$table_name3.' ');
                            $blogs = array();
						    $args = array( 'blog_id' => 0 );
						    $users = get_users( $args );


                            $fields = json_decode($cs_bobot, true);

                            if(!empty($fields)){
                                // // get total 
                                $total_bobot = 0;
                                foreach ($fields as $key => $value ) {
                                    $total_bobot = $total_bobot+$value;
                                }

                                $no = 1;
                                // $total_priority = 0;
                                foreach ($fields as $key => $value ) {

                                    // $id_csnya = $key;
                                    $id_csnya_data = explode("_", $key);
                                    $id_csnya = $id_csnya_data[0];

                                    $bobot_csnya = $value;
                                    $persen_cs = ($bobot_csnya/$total_bobot)*100;

                                    $rand_id = RandomString(4);

                                    $option_bobotnya = '';
                                    for($c=1; $c <= 10; $c++) {
                                        $selected = '';
                                        if($c==$bobot_csnya){
                                          $selected = 'selected';
                                        }
                                        $option_bobotnya .= '<option data-id="'.$rand_id.'" value="'.$c.'" '.$selected.'>'.$c.'</option>';
                                    }

                                    $option_calc = '<select name="op-'.$rand_id.'" class="calc-cs opt-plus"><option value="cs">+</option></select>';
	                                $button_delete = '<input type="button" name="update" title="Delete" value="&nbsp;-&nbsp;" class="button btn-del-cs btn_red_line" data-idnya="'.$rand_id.'" style="margin-left:30px;">';
	                                
	                                if($no==1){
	                                    $option_calc = '';
	                                    $button_delete = '';
	                                }

                                    echo '
                                    <tr id="tr-'.$rand_id.'"><td>'.$option_calc.'
                                    <select name="select-'.$rand_id.'" id="select-'.$rand_id.'" data-id="'.$rand_id.'" class="calc-cs select-var-cs">'.optionnya_fix2($id_csnya).'</select>
                                    &nbsp;<select title="Bobot CS" class="cs_priority cs_'.$rand_id.'" onclick="run_persen()">'.$option_bobotnya.'</select>&nbsp;&nbsp;&nbsp;&nbsp;<div style="" class="bobot-cs" title="Bobot Lead CS yang akan diterima"><span class="hasil_persen persen_'.$rand_id.'" data-id="'.$rand_id.'">'.number_format($persen_cs, 1, '.', '').'%</span></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$button_delete.'</td></tr>';

                                    $no++;
                                }
                            }else{

	                            // SHOW CS FROM DB
	                            $array_cs = explode(',', $id_cs);
	                            $count_array_cs = count($array_cs);
	                            $no = 1; // first option
	                            foreach ($array_cs as $key => $value) {

	                                $persen_cs = (1/$count_array_cs)*100;

	                                $rand_id = RandomString(4);

	                                $option_bobotnya = '';
	                                for($c=1; $c <= 10; $c++) {
	                                    $selected = '';
	                                    if($c==1){
	                                      $selected = 'selected';
	                                    }
	                                    $option_bobotnya .= '<option data-id="'.$rand_id.'" value="'.$c.'" '.$selected.'>'.$c.'</option>';
	                                }

	                                $bobotnya = '';
	                                for($c=1; $c <= 10; $c++) {
	                                    $bobotnya .= '<option data-id="'.$rand_id.'" value="'.$c.'">'.$c.'</option>';
	                                }

	                                $option_calc = '<select name="op-'.$rand_id.'" class="calc-cs opt-plus"><option value="cs">+</option></select>';
	                                $button_delete = '<input type="button" name="update" title="Delete" value="&nbsp;-&nbsp;" class="button btn-del-cs btn_red_line" data-idnya="'.$rand_id.'" style="margin-left:30px;">';
	                                
	                                if($no==1){
	                                    $option_calc = '';
	                                    $button_delete = '';
	                                }

	                                $id_csnya = $value;
	                   

	                                echo '
	                                    <tr id="tr-'.$rand_id.'"><td>'.$option_calc.'
	                                    <select name="select-'.$rand_id.'" id="select-'.$rand_id.'" data-id="'.$rand_id.'" class="calc-cs select-var-cs">'.optionnya_fix2($id_csnya).'</select>
	                                    &nbsp;<select title="Bobot CS" class="cs_priority cs_'.$rand_id.'">'.$option_bobotnya.'</select>&nbsp;&nbsp;&nbsp;&nbsp;<div style="" class="bobot-cs" title="Bobot Lead CS yang akan diterima"><span class="hasil_persen persen_'.$rand_id.'" data-id="'.$rand_id.'">'.number_format($persen_cs, 1, '.', '').'%</span></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$button_delete.'</td></tr>';

	                                $no++;
	                            
	                            }

	                        }

                        echo '<tr id="line_cs">
		                    </tr>
		                    <tr>
		                        <td>
		                            <button id="add_line_cs" type="button" name="update" class="button btn_mgo" style="margin-top:10px;"><span class="dashicons dashicons-plus" style="margin-top:6px;margin-right:2px;font-size: 16px;"></span>Add Line</button>
		                        </td>
		                    </tr>

		                    <tr><td></td></tr>
		                    <tr>
		                        <td>
		                            <hr>
		                        </td>
		                    </tr>
		                    <tr>
			                    <td>
				                    <h3 style="margin-bottom: 15px;margin-top:5px;">Set Rotator:</h3>
									<div>
					                    <div class="radio" style="width:35%;">
					                      <label>
					                        <input class="table_field set_rotator" name="set_rotator" value="0" type="radio" '.$set_rotator_todayorders.'>
					                        <span></span><div class="labelname" style="margin-top: -21px;">By Today Orders</div>
					                      </label>
					                    </div>
					                    <div class="radio" style="width:65%;">
					                      <label>
					                        <input class="table_field set_rotator" name="set_rotator" value="1" type="radio" '.$set_rotator_allorders.'>
					                        <span></span><div class="labelname" style="margin-top: -21px;">By All Orders</div>
					                      </label>
					                    </div>
					                    <p><br><br><b>Note:</b>
					                    <ul style="font-style: italic;font-size: 12px;">
					                    <li>Jika CS anda pada form ini sering berganti, disarankan menggunakan <b>By Today Orders</b>. Data akan direset/dimulai setiap pukul 00.00 dini hari.</li>
					                    <li>Jika sama terus, silahkan menggunakan <b>By All Orders</b>. Hitungan akan dihitung dari pertama kali form ini dibuat.</li><li>Gunakan Bobot CS jika ingin mendapatkan lead yang berbeda untuk setiap CS.</li></ul></p>
					                    <p></p>
					                </div>
				                </td>
			                </tr>
			                <tr>
		                        <td>
		                            <hr>
		                        </td>
		                    </tr>
		                    <tr style="display: none;"><td>
		                        <textarea name="id_cs" id="hasil_id_cs" cols="100" rows="2" readonly="" style="display: inline;width:300px;">'.$id_cs.'</textarea>
		                        <textarea name="bobot_cs" id="bobot_cs" cols="100" rows="2" readonly="" style="display: inline;width:300px;">'.$bobot_cs.'</textarea>
		                        </td>
		                    </tr>
		                </table>
	                    ';
        
        $randomid = RandomString(3);   
        echo '
            <input type="submit" id="save_cs" data-id="'.$id.'" name="update" value="Save CS" class="button btn_mgo_new_purple" style="margin-top: -10px !important;margin-bottom: 20px !important;"> &nbsp;&nbsp;<span id="success_response2"></span>
        <script>
        jQuery(document).ready(function($) {

	        function run_persen(){
	        
		        run_idcs();

		        var arr_cs_priority = $("select.cs_priority").map(function(){
		            return this.value;

		        }).get().toString();

		        var str3 = arr_cs_priority;
		        var str3_array = str3.split(",");

		        total_priority = 0;
		        var len2 = str3_array.length;
		        for(var i = 0; i < str3_array.length; i++) {
		            nilai = parseFloat(str3_array[i]);
		            total_priority = total_priority+nilai;
		        }

		        var new_selected = [];
		        $(".hasil_persen").each(function(){
		                new_selected.push($(this).data("id"));
		        });
		        new_selected = new_selected.toString();

		        var array = new_selected.split(",");

		        arrayLength = array.length;
		        arr_bobot_cs = "";
		        no = 1;
		        for (var i = 0; i < arrayLength; i++) {
		            if(array[i]!=0){

		                id_ne = array[i];
		                var valuenya = $("#tr-"+id_ne+" select.cs_priority").find("option:selected").val();

		                hasil_persennya = (valuenya/total_priority)*100;
		                $(".persen_"+id_ne).text(hasil_persennya.toFixed(1)+"%");

		                var id_csnya = $("#select-"+id_ne).find("option:selected").val();

		                if(i==0){
		                    arr_bobot_cs = "";
		                }
		                if(arrayLength==no){
		                    arr_bobot_cs += '."'".'"'."'".'+id_csnya+"_"+id_ne+'."'".'"'."'".' + ":" + '."'".'"'."'".'+valuenya+'."'".'"'."'".';
		                }else{
		                    arr_bobot_cs += '."'".'"'."'".'+id_csnya+"_"+id_ne+'."'".'"'."'".' + ":" + '."'".'"'."'".'+valuenya+'."'".'"'."'".' + ",";
		                }
		            }
		            no++;
		        }
		        $("#bobot_cs").val("{"+arr_bobot_cs+"}");
		    }

	    	

        	$(document).on("change", ".cs_priority", function(e) {
		    	run_persen();
		    	run_idcs();
		    });

        	$(document).on("change", ".select-var-cs", function(e) {
		        run_idcs();
		        run_persen();
		    });

        	function run_idcs() {
		        var selected_val = $.map($(".select-var-cs"), function(a){
		                return a.value;
		        }).join(",");

		        $("#hasil_id_cs").val(selected_val);
		    }
			
			$(document).on("click", ".btn-del-cs", function(e) {
				var idnya = $(this).data("idnya");
				var new_idnya = "tr-"+idnya;
				console.log(new_idnya);
				$("#"+new_idnya).remove();
				run_idcs();
				run_persen();
        	});

	    	var ALPHABET = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		    var ID_LENGTH = 4;
		    var generate = function() {
		      var rtn = "";
		      for (var i = 0; i < ID_LENGTH; i++) {
		        rtn += ALPHABET.charAt(Math.floor(Math.random() * ALPHABET.length));
		      }
		      return rtn;
		    }

		    $("#add_line_cs").bind("click", function(e){
		        var idnya = generate();
		        var content = '."'".'<tr id="tr-'."'+idnya+'".'"><td><select name="op-'."'+idnya+'".'" class="calc-cs opt-plus"><option value="cs">+</option></select><select id="select-'."'+idnya+'".'" name="select-'."'+idnya+'".'" class="calc-cs select-var-cs">'.$optionnya2.'</select>&nbsp;&nbsp;<select title="Bobot CS" class="cs_priority cs_'."'+idnya+'".'"><option data-id="'."'+idnya+'".'" value="1" selected="">1</option><option data-id="'."'+idnya+'".'" value="2">2</option><option data-id="'."'+idnya+'".'" value="3">3</option><option data-id="'."'+idnya+'".'" value="4">4</option><option data-id="'."'+idnya+'".'" value="5">5</option><option data-id="'."'+idnya+'".'" value="6">6</option><option data-id="'."'+idnya+'".'" value="7">7</option><option data-id="'."'+idnya+'".'" value="8">8</option><option data-id="'."'+idnya+'".'" value="9">9</option><option data-id="'."'+idnya+'".'" value="10">10</option></select>&nbsp;&nbsp;&nbsp;&nbsp;<div style="" class="bobot-cs" title="Bobot Lead CS yang akan diterima"><span class="hasil_persen persen_'."'+idnya+'".'" data-id="'."'+idnya+'".'"></span></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="update" title="Delete" value="&nbsp;-&nbsp;" data-idnya="'."'+idnya+'".'" class="button btn-del-cs btn_red_line" style="margin-left:27px;"></td></tr>'."';";
		        echo '
		        $("#line_cs").append(content);
		        run_idcs();
		        run_persen();
		    });

		    $("#save_cs").bind("click", function(){
		    	run_persen();

		    	var selected_val = $.map($(".select-var-cs"), function(a){
	                return a.value;
		        }).join(",");

		        var arr = selected_val.split(",");
		        
		        if(arr.length>1){
					for (i=0; i<=arr.length; i++) {
						if (arr[i] == "") {
					    	alert("Maaf, ada field CS yang belum anda pilih!");
					    	return false;
					  	}
					}
				}

				var cs_bobot = $("#bobot_cs").val();
				var set_rotator = $(".set_rotator:checked").val();
				
				if(selected_val!=""){
					$(".notif_light_csrotator").addClass("on");
				}else{
					$(".notif_light_csrotator").removeClass("on");
				}
				
		    	$("#success_response2").html('."'".'<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;font-weight: bold;">Saving...</span>'."'".');
		        var data_nya = [
		            $(this).data("id"),
					selected_val,
					set_rotator,
					cs_bobot
		        ];
		        
		        var data = {
		            "action": "myaction_save_cs",
		            "datanya": data_nya
		        };
		        jQuery.post(ajaxurl, data, function(response) {
		            $("#success_response2").html(response);
		        });
		        

		    });
		    
		});
    	</script>
        ';

    // echo 'Success : '.$id;
    wp_die();
} 
add_action( 'wp_ajax_myaction_get_datacs', 'myaction_get_datacs' );
add_action( 'wp_ajax_nopriv_myaction_get_datacs', 'myaction_get_datacs' );


function myaction_get_datacourier() {
	// INISIAL
    global $wpdb;
    $table_name = $wpdb->prefix . "cf_forms";
    $table_name2 = $wpdb->prefix . "mgo_calculation";
    $table_name3 = $wpdb->prefix . "users";
    $table_name4 = $wpdb->prefix . "mgo_courier";
    $id = $_POST['datanya'][0];

    if (is_numeric($id)){
    	$table_name2 = $wpdb->prefix . "mgo_gf_calculation";
    }


    mgo_global_vars();
    $plugin_license = $GLOBALS['mgovars']['plugin_license'];
    $plugin_license_info = $GLOBALS['mgovars']['plugin_license_info'];

    // Check Plugin Licensed
    if($plugin_license=='FREEMIUM'){
    	echo '<div class="sub-title" style="margin-top: 90px; font-size: 16px; font-weight: bold; text-align: center;">';
        echo $plugin_license_info;
        echo '</div>';
        wp_die();
        // return false;
    }

    // CHECK ROLE
    check_role();

    	/*
	    function RandomString($length) {
	        $keys = array_merge(range(0,9), range('a', 'z'));

	        $key = "";
	        for($i=0; $i < $length; $i++) {
	            $key .= $keys[mt_rand(0, count($keys) - 1)];
	        }
	        return $key;
	    }
	    */


	    // GET DATA Courier and City Saved
	    $row = $wpdb->get_results('SELECT * from '.$table_name2.' where id_form="'.$id.'"');
	    if($row==null){
	        $origin_province_id = '';
	        $origin_city_id = '';
	        $origin_district_id = '';

	        $courier = '';
	        $weight = '';
	        $service_show = 0;
	        $gojek_show = 0;
	        $rupiah_show = 0;
	        $additional_cost = '';
	        $maximal_cost = '';
	        $etd_status = 0;
	    }else{
	        $origin_province_id = $row[0]->origin_province_id;
	        $origin_city_id = $row[0]->origin_city_id;
	        $origin_district_id = $row[0]->origin_district_id;

	        $courier = $row[0]->courier;
	        $weight = $row[0]->weight;
	        $service_show = $row[0]->service_show;
	        $gojek_show = $row[0]->gojek_show;
	        $rupiah_show = $row[0]->rupiah_show;
	        $additional_cost = $row[0]->additional_cost;
	        $maximal_cost = $row[0]->maximal_cost;
	        $etd_status = $row[0]->etd_status;
	    }

	    $rand_label_for = RandomString(5);

	    // GET DATA ALL Courier
	    $row2 = $wpdb->get_results('SELECT * from '.$table_name4.'');
	    $data_courier = '';
	    $no=1;
	    foreach ($row2 as $data ) {
	    	if ($no % 2 == 0) {
	    		$number = 'genap';
	    	}else{
	    		$number = 'ganjil';
	    	}

	    	// if($data->courier_code==$courier){
	    	// 	$checked = 'checked=""';
	    	// }else{
	    	// 	$checked = '';
	    	// }

	    	if (strpos($courier, $data->courier_code) !== false){
	    		$checked = 'checked=""';
	    	}else{
	    		$checked = '';
	    	}

	    	if($plugin_license=='STARTER'){
	    		if($data->courier_code=='jne'){
	    			$disabled_courier = '';
	    		}else{
	    			$disabled_courier = 'disabled=""';
	    		}
	    	}else{
	    		$disabled_courier = '';
	    	}

	        $data_courier .= '
				<div class="checkbox '.$number.'">
				  <label>
				    <input type="checkbox" name="couriercode" id="'.$rand_label_for.'" value="'.$data->courier_code.'" '.$checked.' '.$disabled_courier.'>
				    <span></span><div class="labelname">'.$data->courier_name.'</div>
				  </label>
				</div>
	        ';
	        $no++;
	    }


	    $table_namenya = $wpdb->prefix . "mgo_settings";
	    $rownya = $wpdb->get_results('SELECT data from '.$table_namenya.' where type="ro_apikey"');
		$rownya = $rownya[0];

		$apikey = $rownya->data;


		// DATA Provinsi
	    $data_provinsi = '';
	    $curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://rajaongkir.komerce.id/api/v1/destination/province",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "key: $apikey"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		    $array = json_decode( $response, true );
		    $data = $array['data'];
		    foreach($data as $d){

		    	if($d['id']==$origin_province_id){
		    		$selected = 'selected';
		    	}else{
		    		$selected = '';
		    	}

		    	$data_provinsi .= '<option value="'.$d['name'].'" data-idprovinsi="'.$d['id'].'" '.$selected.'>'.$d['name'].'</option>';
		    }
		}
		

	    // DATA KAB/KOTA
	    $data_kabkota = '';
	    if($origin_province_id!=null || $origin_province_id!=''){

		    $curl2 = curl_init();
			curl_setopt_array($curl2, array(
			  CURLOPT_URL => "https://rajaongkir.komerce.id/api/v1/destination/city/$origin_province_id",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			  CURLOPT_HTTPHEADER => array(
			    "key: $apikey"
			  ),
			));

			$response = curl_exec($curl2);
			$err = curl_error($curl2);

			curl_close($curl2);

			if ($err) {
			  echo "cURL Error #:" . $err;
			} else {
			    $array = json_decode( $response, true );
			    $data = $array['data'];
			    foreach($data as $d){
			    	// if($d['type']=='Kabupaten'){
			    	// 	$type = 'Kab. ';
			    	// }else{
			    	// 	$type = 'Kota ';
			    	// }
			    	if($d['id']==$origin_city_id){
			    		$selected = 'selected';
			    	}else{
			    		$selected = '';
			    	}
			    	$data_kabkota .= '<option value="'.$d['name'].'" data-idkabkota="'.$d['id'].'" '.$selected.'>'.$d['name'].'</option>';
			    }
			}
		}


		// DATA Kecamatan
	    $data_kecamatan = '';
		if($origin_city_id!=null || $origin_city_id!=''){

		    $curl3 = curl_init();
			curl_setopt_array($curl3, array(
			  CURLOPT_URL => "https://rajaongkir.komerce.id/api/v1/destination/district/$origin_city_id",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			  CURLOPT_HTTPHEADER => array(
			    "key: $apikey"
			  ),
			));

			$response = curl_exec($curl3);
			$err = curl_error($curl3);

			curl_close($curl3);

			if ($err) {
			  echo "cURL Error #:" . $err;
			} else {
			    $array = json_decode( $response, true );
			    $data = $array['data'];
			    foreach($data as $d){

			    	if($d['id']==$origin_district_id){
			    		$selected = 'selected';
			    	}else{
			    		$selected = '';
			    	}

			    	$data_kecamatan .= '<option value="'.$d['name'].'" data-idkec="'.$d['id'].'" '.$selected.'>'.$d['name'].'</option>';
			    }
			}
		}

		// TAMPILKAN SERVICE
		if($service_show==0){
			$service_satu = 'checked';
			$service_dua = '';

			$display_gojek = '1';
			$display_rupiah = '0';
		}else{
			$service_satu = '';
			$service_dua = 'checked';

			$display_gojek = '0';
			$display_rupiah = '1';
		}

		if($gojek_show==1){
			$gojek_checked = 'checked';
		}else{
			$gojek_checked = '';
		}

		if($rupiah_show==1){
			$rupiah_checked = 'checked';
		}else{
			$rupiah_checked = '';
		}

		if($etd_status==1){
			$etd_checked = 'checked';
		}else{
			$etd_checked = '';
		}

		echo '
		<style>
			.radio.ganjil{margin-right:32px}.labelname{padding-left:8px;position:absolute;margin-left:35px;margin-top:-21px}.checkbox,.radio{margin-bottom:8px;margin-left:-10px;width:48%;float:left}.radio label{padding:10px}.checkbox *,.radio *{cursor:pointer}.checkbox input,.radio input{opacity:0}.checkbox span,.radio span{position:relative;display:inline-block;margin-left:-25px;vertical-align:top;width:20px;height:20px;border-radius:4px;border:1px solid #ccc}.checkbox:hover span,.radio:hover span{border-color:#6c61f6}.checkbox span:before,.radio span:before{content:"\2713";position:absolute;top:0;left:0;right:0;bottom:0;opacity:0;text-align:center;font-size:16px;line-height:18px;vertical-align:middle;color:#6c61f6}.radio span{border-radius:50%}.radio span:before{content:"";width:10px;height:10px;margin:5px auto;background-color:#6c61f6;border-radius:100px}.checkbox input[type=checkbox]:checked+span,.radio input[type=radio]:checked+span{border-color:#6c61f6;background-color:#6c61f6}.radio input[type=radio]:checked+span{background-color:#fff}.checkbox input[type=checkbox]:checked+span:before,.radio input[type=radio]:checked+span:before{color:#fff;opacity:1;transition:color .3 ease-out}.checkbox input[type=checkbox]:disabled+span,.radio input[type=radio]:disabled+span{border-color:#ddd!important;background-color:#ddd!important}.checkbox span{margin-left: -15px;}.checkbox.ganjil{margin-right:30px;}
		</style>
            <table class="wp-list-table widefat fixed" style="border: 0;background: #fff;margin-bottom: 30px;margin-top: 10px;margin-left:-10px;">
                    <tr id="first-line">
                        <td>
                            <h3 style="margin-bottom: 5px;">Courier:</h3>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                        	'.$data_courier.'
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <h3 style="margin-bottom: 5px;">Service:</h3>
                        </td>
                    </tr>
                    <tr>
                    	<td>
							<div class="radio">
							  <label>
							    <input type="radio" name="service_show" id="service_show" value="0" '.$service_satu.'>
							    <span></span><div class="labelname">Tampilkan semua layanan</div>
							  </label>
							</div>
                    	</td>
                    	<td>
							<div class="checkbox gojek_show" style="opacity:'.$display_gojek.';">
							  <label>
							    <input type="checkbox" name="gojek_show" id="gojek_show" value="1" '.$gojek_checked.' style="margin-left: 11px;">
							    <span style="margin-left: -25px;"></span><div class="labelname">GOJEK (berlaku dalam 1 kota)</div>
							  </label>
							</div>
                    	</td>
                    </tr>
                    <tr>
                    	<td>
                    		<div class="radio">
							  <label>
							    <input type="radio" name="service_show" id="service_show2" value="1" '.$service_dua.'>
							    <span></span><div class="labelname">Tampilkan 1 saja ( Hitung Otomatis )</div>
							  </label>
							</div>
                    	</td>
                    	<td>
							<div class="checkbox rupiah_show" style="opacity:'.$display_rupiah.';">
							  <label>
							    <input type="checkbox" name="rupiah_show" id="rupiah_show" value="1" '.$rupiah_checked.' style="margin-left: 11px;">
							    <span style="margin-left: -25px;"></span><div class="labelname">Tampilkan Rupiahnya saja</div>
							  </label>
							</div>
                    	</td>
                    </tr>
                    <tr>
                    	<td style="background: #f5f9ff;padding-top: 15px;border-top-left-radius: 4px;border-bottom-left-radius: 4px;">
                    		<div class="checkbox etd_status">
							  <label>
							    <input type="checkbox" name="etd_status" id="etd_status" value="1" '.$etd_checked.' style="margin-left: 11px;">
							    <span style="margin-left: -25px;"></span><div class="labelname">Sembunyikan estimasi hari pengiriman</div>
							  </label>
							</div>
                    	</td>
                    	<td style="background: #f5f9ff;padding-top: 15px;border-top-right-radius: 4px;border-bottom-right-radius: 4px;">
                    	</td>
                    </tr>
                    <tr>
                        <td>
                            <h3 style="margin-bottom: 5px;" id="origin">Origin:</h3>
                        </td>
                        <td>
                            <h3 style="margin-bottom: 5px;">Weight:</h3>
                        </td>
                    </tr>
                	<tr id="line_cs"></tr>
                    <tr>
                        <td style="padding-right:20px;height:45px;width:240px;">
                        	<select name="" value="" class="form-control" id="provinsi" style="width:100%;height:45px;">
                        	<option value="">Pilih Provinsi</option>
							'.$data_provinsi.'
							</select>
                        </td>
                        <td>
                        	<input type="text" style="height: 45px; position: absolute; text-align: center; font-size: 28px; padding: 0; width: 37%; color:#6c61f6;" placeholder="0" value="'.$weight.'" id="weight">
                        	<span style="margin-top: 52px;position: absolute;">Satuan weight (berat) dalam gram,<br>1kg = 1000gram</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-right:20px;padding-top: 10px;height:45px;width:240px;">
                            <select style="width:100%;height:45px;" id="kabkota">
								'.$data_kabkota.'
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-right:20px;padding-top: 10px;height:45px;width:240px;">
                            <select style="width:100%;height:45px;" id="kecamatan">
								'.$data_kecamatan.'
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3 style="margin-bottom: 5px;">Additional Cost:</h3>
                        </td>
                        <td>
                            &nbsp;
                        </td>
                    </tr>

                    <tr>
                        <td style="padding-right:20px;">
                        	<input type="text" style="height: 45px; position: absolute; text-align: center; font-size: 28px; padding: 0; width: 37%; color:#6c61f6;" placeholder="0" value="'.$additional_cost.'" id="additional_cost">
                        	
                        </td>
                        <td>
                        	<span style="margin-top: 0px;position: absolute;padding-right: 50px;line-height: 1.4 !important;font-size: 12px;">Tambahkan harga <b>Additional Cost</b> jika anda ingin menambahkan harga pada setiap ongkos kirim yang terhitung.</span>
                        </td>
                    </tr>
                    <tr><td><br></td><td></td></tr>
                    <tr>
                        <td>
                            <h3 style="margin-bottom: 5px;">Maksimum Flat Ongkir:</h3>
                        </td>
                        <td>
                            &nbsp;
                        </td>
                    </tr>

                    <tr>
                        <td style="padding-right:20px;">
                        	<input type="text" style="height: 45px; position: absolute; text-align: center; font-size: 28px; padding: 0; width: 37%; color:#6c61f6;" placeholder="0" value="'.$maximal_cost.'" id="maximal_cost">
                        	
                        </td>
                        <td>
                        	<span style="margin-top: 0px;position: absolute;padding-right: 50px;line-height: 1.4 !important;font-size: 12px;">Ongkir anda akan berubah menjadi Maksimum Flat Ongkir jika melebihi batas maksimum. Kosongkan jika tidak dipakai.</span>
                        </td>
                    </tr>

                    <tr><td></td></tr>
                </table>
                <input type="submit" id="save_courier" data-id="'.$id.'" name="update" value="Save Courier" class="button btn_mgo_new_purple" style="margin-top: 30px !important;margin-bottom: 10px !important;width: 240px !important;"> &nbsp;&nbsp;<span id="success_courier" style="padding-left: 30px;"></span>
        
		        <script>
				   
				    // Set only number can type
					function validateNumber(event) {
					    var key = window.event ? event.keyCode : event.which;
					    if (event.keyCode === 8 || event.keyCode === 46) {
					        return true;
					    } else if ( key < 48 || key > 57 ) {
					        return false;
					    } else {
					        return true;
					    }
					};
					jQuery(document).ready(function($) {
						$("#weight").keypress(validateNumber);
						$("#origin").after("<div id=loader_kabkota><img src='.plugin_dir_url( __FILE__ ).'assets/icons/loader2.gif></div>");
					});
		    	</script>
		        ';

    wp_die();
} 
add_action( 'wp_ajax_myaction_get_datacourier', 'myaction_get_datacourier' );
add_action( 'wp_ajax_nopriv_myaction_get_datacourier', 'myaction_get_datacourier' );


function myaction_get_datanotif() {
	// INISIAL
    global $wpdb;
    $table_name = $wpdb->prefix . "cf_forms";
    $table_name2 = $wpdb->prefix . "mgo_calculation";

    $form_id = $_POST['datanya'][0]; // FORM ID

    if (is_numeric($form_id)){
    	$table_name2 = $wpdb->prefix . "mgo_gf_calculation";
    }

    mgo_global_vars();
    $plugin_license = $GLOBALS['mgovars']['plugin_license'];
    $plugin_license_info = $GLOBALS['mgovars']['plugin_license_info'];

    // Check Plugin Licensed
    if($plugin_license=='FREEMIUM'){
    	echo '<div class="sub-title" style="margin-top: 90px; font-size: 16px; font-weight: bold; text-align: center;">';
        echo $plugin_license_info;
        echo '</div>';
        wp_die();
        // return false;
    }

    // CHECK ROLE
    check_role();

    $sms_status = 0;
    $default_message_status = 0;
    $custom_message = '';
    $wanotif_status_form = 0;
    $wanotif_default_message_status = 0;
    $wanotif_custom_message = '';

	$tg_status = 0;
	$tg_message_status = 0;
	$tg_custom_message = '';
	$tg_owner_status = 0;
	$tg_csrotator_status = 0;
	$tg_custom_status = 0;
	$tg_custom_channel = '';

	$wanotif_cod_message = '';
	$wanotif_forward = '';

    $query_form = $wpdb->get_results('SELECT * from '.$table_name2.' where id_form="'.$form_id.'" ');
    if($query_form!=null){
    	$sms_status = $query_form[0]->sms_status;
    	$default_message_status = $query_form[0]->default_message_status;
    	$custom_message = $query_form[0]->custom_message;
    	$wanotif_status_form = $query_form[0]->wanotif_status_form;
    	$wanotif_default_message_status = $query_form[0]->wanotif_default_message_status;
    	$wanotif_custom_message = $query_form[0]->wanotif_custom_message;

    	$tg_status = $query_form[0]->tg_status;
    	$tg_message_status = $query_form[0]->tg_message_status;
    	$tg_custom_message = $query_form[0]->tg_custom_message;
    	$tg_owner_status = $query_form[0]->tg_owner_status;
    	$tg_csrotator_status = $query_form[0]->tg_csrotator_status;
    	$tg_custom_status = $query_form[0]->tg_custom_status;
    	$tg_custom_channel = $query_form[0]->tg_custom_channel;

    	$wanotif_cod_message = $query_form[0]->wanotif_cod_message;
    	$wanotif_forward = $query_form[0]->wanotif_forward;

    }

    $box_notification_text = 'deactivated';
    $box_notification_input = 'disabled=""';
    $sms_active = '';
    if($sms_status==1){
	    $box_notification_text = '';
	    $box_notification_input = '';
	    $sms_active = 'checked';
    }

    $default_message_status_general = 'checked';
    $default_message_status_custom = '';
    $custom_sms_message_status = 'message_disabled';
    if($default_message_status==1){
    	$default_message_status_general = '';
	    $default_message_status_custom = 'checked';
	    $custom_sms_message_status = '';
    }


    $wanotif_box_notification_text = 'deactivated';
    $wanotif_box_notification_input = 'disabled=""';
    $wanotif_active = '';
    $wanotif_tagit_active = 'true';
    if($wanotif_status_form==1){
    	$wanotif_box_notification_text = '';
	    $wanotif_box_notification_input = '';
    	$wanotif_active = 'checked';
    	$wanotif_tagit_active = 'false';
    }

    $wanotif_default_message_status_general = 'checked';
    $wanotif_default_message_status_custom = '';
    $wanotif_message_status = 'message_disabled';
    if($wanotif_default_message_status==1){
    	$wanotif_default_message_status_general = '';
	    $wanotif_default_message_status_custom = 'checked';
    	$wanotif_message_status = '';
    }

    $telegram_box_notification_text = 'deactivated';
    $telegram_box_notification_input = 'disabled=""';
    $telegram_active = '';
    $telegram_tagit_active = 'true';
    if($tg_status==1){
    	$telegram_box_notification_text = '';
	    $telegram_box_notification_input = '';
    	$telegram_active = 'checked';
    	$telegram_tagit_active = 'false';
    }

    $telegram_default_message_status_general = 'checked';
    $telegram_default_message_status_custom = '';
    $custom_tg_message_status = 'message_disabled';
    if($tg_message_status==1){
    	$telegram_default_message_status_general = '';
	    $telegram_default_message_status_custom = 'checked';
	    $custom_tg_message_status = 'message_disabled';
    }
	
    $tg_owner_status_checked = '';
    if($tg_owner_status==1){
	    $tg_owner_status_checked = 'checked';
    }

    $tg_csrotator_status_checked = '';
    if($tg_csrotator_status==1){
	    $tg_csrotator_status_checked = 'checked';
    }
    
    $tg_custom_status_checked = '';
    if($tg_custom_status==1){
	    $tg_custom_status_checked = 'checked';
    }

    $custom_channel = '';
    if($tg_custom_channel!=null){
	    $var=explode(',',$tg_custom_channel);
	    $channel = '';
	    foreach($var as $value) {
    		$channel .= '<li>'.$value.'</li>';
	    }
	    $custom_channel = $channel;
    }

    $wanotif_forward_cc = '';
    if($wanotif_forward!=null){
	    $var=explode(',',$wanotif_forward);
	    $wanotif_forward_data = '';
	    foreach($var as $value) {
    		$wanotif_forward_data .= '<li>'.$value.'</li>';
	    }
	    $wanotif_forward_cc = $wanotif_forward_data;
    }


    $disabled_cs_channel = '';
    $disabled_custom_channel = '';
    $feature_disabled_cs = '';
    $feature_disabled_custom = '';
    if($plugin_license=='STARTER'){
		$disabled_cs_channel = 'disabled=""';
	    $disabled_custom_channel = 'disabled=""';
	    $feature_disabled_cs = 'feature_disabled';
	    $feature_disabled_custom = 'feature_disabled';
	}
	if($plugin_license=='BASIC'){
	    $disabled_custom_channel = 'disabled=""';
	    $feature_disabled_custom = 'feature_disabled';
	    $feature_disabled_cs = 'feature_disabled';
	}

	echo '
	<div class="container">
		<div class="tab-slider--nav">
			<ul class="tab-slider--tabs">
				<li class="tab-slider--trigger active" rel="tab1">&nbsp;&nbsp;&nbsp;Wanotif&nbsp;&nbsp;&nbsp;</li>
				<li class="tab-slider--trigger" rel="tab2">&nbsp;&nbsp;&nbsp;SMS&nbsp;&nbsp;&nbsp;</li>
				<li class="tab-slider--trigger" rel="tab3">&nbsp;&nbsp;&nbsp;Telegram&nbsp;&nbsp;&nbsp;</li>
			</ul>
		</div>
		<div class="tab-slider--container">
			<div id="tab1" class="tab-slider--body" style="margin-top:15px;">
				<div style="padding-top:70px;padding-bottom:20px;">
				    <label class="switch-on-off">
				        <input type="checkbox" value="1" class="wanotif_status" '.$wanotif_active.'>
				        <span>
				            <em></em>
				            <strong></strong>
				        </span>
				    </label>
				</div>
				<hr style="border: 0 none;border-top: 1px dashed #7288a2; background: none;height:0;">
                <div class="wanotif_box-notification '.$wanotif_box_notification_text.'">
                	
	                <p style="padding-top:20px;"><b>Default Message :</b></p>
	                 <div>
	                    <div class="radio" style="width:35%;">
	                      <label>
	                        <input class="table_field wanotif_default_message_status" name="wanotif_default_message_status" value="0" type="radio" '.$wanotif_default_message_status_general.' '.$wanotif_box_notification_input.'>
	                        <span></span><div class="labelname" style="margin-top: -19px;">General Message</div>
	                      </label>
	                    </div>
	                    <div class="radio" style="width:65%;">
	                      <label>
	                        <input class="table_field wanotif_default_message_status" name="wanotif_default_message_status" value="1" type="radio" '.$wanotif_default_message_status_custom.' '.$wanotif_box_notification_input.'>
	                        <span></span><div class="labelname" style="margin-top: -19px;">Custom & COD Message</div>
	                      </label>
	                    </div>
	                </div>
	                <div id="custom_cod_message" class="'.$wanotif_message_status.'">
	                <p style="padding-top:50px;"><b>Custom Message :</b></p>
	                <textarea style="width:99%;padding: 10px 15px;" rows="3" id="wanotif_custom_message" '.$wanotif_box_notification_input.'>'.$wanotif_custom_message.'</textarea>
	                <!-- <hr style="border: 0 none;border-top: 1px dashed #c9d4e0; background: none;height:0;margin-top: 25px;"> -->
	                <p style="padding-top:10px;"><b>COD Message :</b></p>
	                <textarea style="width:99%;padding: 10px 15px;" rows="3" id="wanotif_cod_message" '.$wanotif_box_notification_input.'>'.$wanotif_cod_message.'</textarea>

	                <p style="font-size:12px;">Isi <i>COD Message</i> jika anda menggunakan metode pembayaran COD. Abaikan jika anda tidak menggunakan metode COD di metode pembayaran.</p>

	                <div id="div_wanotif_forward" class="" style="display:inline-block;margin-top:50px;">
	                    <div class="labelname" style="margin: 0;padding: 0;margin-top: -40px;font-weight:bold;">Forward message to: (62xxxxx)</div>
				    	<ul class="wanotif_forward" style="margin-bottom:10px;">'.$wanotif_forward_cc.'</ul>
	                </div>

	                </div>

                </div>
	            <input type="submit" id="wanotif_save_message" name="wanotif_save_sms" value="Save Wanotif" class="button btn_mgo_new_purple" style="margin-top: 20px !important;margin-bottom: 10px !important;"> &nbsp;&nbsp;<span id="wanotif_success_notification"></span>
				
				<div class="container">
					<div class="accordion">
					    <div class="accordion-item">
					      <a>Wajib baca untuk Custom Message Wanotif</a>
					      <div class="content">
					        <p style="font-size:12px;">
							<ul style="font-size:12px;">
								<li style="list-style: disc;">Anda bisa menggunakan beberapa <b>Magic Tag</b> dibawah ini untuk ditampilkan pada Pesan, adapun daftarnya sebagai berikut yang bisa anda digunakan:<br>
			                    <b>[mgo_orderid]</b> : untuk menambahkan Order ID pemesanan.<br>
			                    <b>[mgo_nama]</b> : untuk menambahkan nama customer.<br>
			                    <b>[mgo_nama_produk]</b> : untuk menambahkan nama produk.<br>
			                    <b>[mgo_jumlah_barang]</b> : untuk menambahkan jumlah barang.<br>
			                    <b>[mgo_pembayaran]</b> : untuk menambahkan metode pembayaran yang user pilih.<br>
			                    <b>[mgo_item_total]</b> : untuk menambahkan item total dari pemesanan.<br>
			                    <b>[mgo_total]</b> : untuk menambahkan total harga dari pemesanan.<br>
			                    <b>[mgo_dp]</b> : untuk menambahkan nilai DP dari Total.<br>
			                    <b>[mgo_sisa]</b> : untuk menambahkan nilai sisa pembayaran dari Total - DP.<br>
			                    <b>[mgo_cswa]</b> : untuk menambahkan nomor Whatsapp CS anda, pastikan anda menggunakan CS Rotator.<br>
			                    <b>[followup1]</b> : untuk menambahkan link Followup 1.<br>
			                    <b>[followup2]</b> : untuk menambahkan link Followup 2.<br>
			                    <b>[followup3]</b> : untuk menambahkan link Followup 3.<br>
			                    <b>[mgo_detail_order]</b> : untuk menambahkan detail order secara keseluruhan.<br><br>
			                    <b><i>Contoh :</i></b><br>
			                    <div style="background:#E2E6F7;padding: 10px 12px;border-radius: 2px;margin-top: 8px;">Hai kakak [mgo_nama], berikut detail Order Anda<br>[mgo_detail_order]<br>Segera transfer ke [mgo_pembayaran]. Terimakasih</div>
			                    <br><br>
			                    </li>
								<li style="list-style: disc;"><b>Magic Tag</b> diatas hanya dapat bekerja jika anda memberikan nama <b>Slug</b> dengan benar sesuai daftar diatas pada field anda.</li><li style="list-style: disc;">Pastikan anda memilikii field Nomor Handphone / Whatsapp dimana slugnya <b>mgo_wa</b> agar sistem dapat membaca untuk mengirimkan notifikasi Whatsapp.</li><li style="list-style: disc;">Pastikan juga anda sudah men-setting API WANOTIF di : <br><b>Magic Order > API Settings > General Settings > WANOTIF.</b>
								</li>
							</ul>
							</p>
					      </div>
					    </div>
					    <!-- end accordion-item -->
					</div>
				</div>
				<!-- end container -->
			</div>
			<!-- end tab-1 -->

			<div id="tab2" class="tab-slider--body" style="margin-top:15px;">
				<div style="padding-top:70px;padding-bottom:20px;">
				    <label class="switch-on-off">
				        <input type="checkbox" value="1" class="sms_status" '.$sms_active.'>
				        <span>
				            <em></em>
				            <strong></strong>
				        </span>
				    </label>
				</div>
				<hr style="border: 0 none;border-top: 1px dashed #7288a2; background: none;height:0;">
                <div class="box-notification '.$box_notification_text.'">
	                <p style="padding-top:20px;"><b>Default Message :</b></p>
	                 <div>
	                    <div class="radio" style="width:35%;">
	                      <label>
	                        <input class="table_field default_message_status" name="default_message_status" value="0" type="radio" '.$default_message_status_general.' '.$box_notification_input.'>
	                        <span></span><div class="labelname" style="margin-top: -19px;">General Message</div>
	                      </label>
	                    </div>
	                    <div class="radio" style="width:65%;">
	                      <label>
	                        <input class="table_field default_message_status" name="default_message_status" value="1" type="radio" '.$default_message_status_custom.' '.$box_notification_input.'>
	                        <span></span><div class="labelname" style="margin-top: -19px;">Custom Message</div>
	                      </label>
	                    </div>
	                </div>
	                <div id="custom_sms_message" class="'.$custom_sms_message_status.'">
	                <p style="padding-top:40px;"><b>Custom Message :</b></p>
	                <textarea style="width:99%;padding: 10px 15px;" rows="3" id="custom_message" '.$box_notification_input.'>'.$custom_message.'</textarea>
	                </div>
                </div>
	            <input type="submit" id="save_sms" name="save_sms" value="Save SMS" class="button btn_mgo_new_purple" style="margin-top: 30px !important;margin-bottom: 10px !important;"> &nbsp;&nbsp;<span id="success_notification"></span>
				
				<div class="container">
					<div class="accordion">
					    <div class="accordion-item">
					      <a>Wajib baca untuk Custom Message SMS</a>
					      <div class="content">
					        <p style="font-size:12px;">
							<ul style="font-size:12px;">
								<li style="list-style: disc;">Anda bisa menggunakan beberapa <b>Magic Tag</b> dibawah ini untuk ditampilkan pada Pesan, adapun daftarnya sebagai berikut yang bisa anda digunakan:<br>
			                    <b>[mgo_orderid]</b> : untuk menambahkan Order ID pemesanan.<br>
			                    <b>[mgo_nama]</b> : untuk menambahkan nama customer.<br>
			                    <b>[mgo_nama_produk]</b> : untuk menambahkan nama produk.<br>
			                    <b>[mgo_jumlah_barang]</b> : untuk menambahkan jumlah barang.<br>
			                    <b>[mgo_item_total]</b> : untuk menambahkan item total dari pemesanan.<br>
			                    <b>[mgo_total]</b> : untuk menambahkan total harga dari pemesanan.<br>
			                    <b>[followup1]</b> : untuk menambahkan link Followup 1.<br>
			                    <b>[followup2]</b> : untuk menambahkan link Followup 2.<br>
			                    <b>[followup3]</b> : untuk menambahkan link Followup 3.<br>
			                    <b>[mgo_pembayaran]</b> : untuk menambahkan user harus transfer ke rekening anda yang mana.<br><br>
			                    <b><i>Contoh :</i></b><br>
			                    <div style="background:#E2E6F7;padding: 10px 12px;border-radius: 2px;margin-top: 8px;">Hai kakak [mgo_nama], ID [mgo_orderid] untuk pembelian [mgo_nama_produk] sejumlah [mgo_total] mohon ditransfer ke [mgo_pembayaran]. Terimakasih</div>
			                    <br><br>
			                    </li>
								<li style="list-style: disc;"><b>Magic Tag</b> diatas hanya dapat bekerja jika anda memberikan nama <b>Slug</b> dengan benar sesuai daftar diatas pada field anda.</li><li style="list-style: disc;">Pastikan anda memilikii field Nomor Handphone / Whatsapp dimana slugnya <b>mgo_wa</b> agar sistem dapat membaca untuk mengirimkan notifikasi SMS.</li><li style="list-style: disc;">Pastikan juga anda sudah men-setting API SMS di : <br><b>Magic Order > API Settings > General Settings > API SMS.</b>
								</li><li style="list-style: disc;"><b>Jangan menggunakan enter</b> untuk settingan SMS ini.</b>
								</li>
							</ul>
							</p>
					      </div>
					    </div>
					    <!-- end accordion-item -->
					</div>
				</div>
				<!-- end container -->

			</div>
			<!-- end tab-2 -->

			<div id="tab3" class="tab-slider--body" style="margin-top:15px;">
				<div style="padding-top:70px;padding-bottom:20px;">
				    <label class="switch-on-off">
				        <input type="checkbox" value="1" class="telegram_status" '.$telegram_active.'>
				        <span>
				            <em></em>
				            <strong></strong>
				        </span>
				    </label>
				</div>
				
				<hr style="border: 0 none;border-top: 1px dashed #7288a2; background: none;height:0;">
                <div class="telegram_box-notification '.$telegram_box_notification_text.'">
	                <p style="padding-top:20px;"><b>Send to :</b></p>
	                <div style="margin-bottom: 50px !important;">
	                    <div class="checkbox" style="width:35%;">
	                      <label>
	                        <input class="table_field tg_owner_status" name="tg_owner_status" value="1" type="checkbox" '.$tg_owner_status_checked.' '.$telegram_box_notification_input.'>
	                        <span></span><div class="labelname" style="margin-top: -19px;">Owner Channel</div>
	                      </label>
	                    </div>
	                    <div class="checkbox '.$feature_disabled_cs.'" style="width:35%;">
	                      <label>
	                        <input class="table_field tg_csrotator_status" name="tg_csrotator_status" value="1" type="checkbox" '.$tg_csrotator_status_checked.' '.$telegram_box_notification_input.' '.$disabled_cs_channel.'>
	                        <span></span><div class="labelname" style="margin-top: -19px;">CS Channel</div>
	                      </label>
	                    </div>
	                    <div class="checkbox '.$feature_disabled_custom.'" style="width:30%;">
	                      <label>
	                        <input class="table_field tg_custom_status" name="tg_custom_status" value="1" type="checkbox" '.$tg_custom_status_checked.' '.$telegram_box_notification_input.' '.$disabled_custom_channel.'>
	                        <span></span><div class="labelname" style="margin-top: -19px;">Custom Channel</div>
	                      </label>
	                    </div>
	                </div>
	                <div id="custom_channel" class="'.$feature_disabled_custom.'" style="display:inline-block;margin-top:50px;">
	                	<div class="labelname" style="margin: 0;padding: 0;margin-top: -35px;font-weight:bold;">Custom Channel : @yourchannel</div>
				    	<ul class="telegram_custom_channel">'.$custom_channel.'</ul>
	                </div>
	                <br>
	                <p style="padding-top:20px;"><b>Default Message :</b></p>
	                <div>
	                    <div class="radio" style="width:35%;">
	                      <label>
	                        <input class="table_field telegram_default_message_status" name="telegram_default_message_status" value="0" type="radio" '.$telegram_default_message_status_general.' '.$telegram_box_notification_input.'>
	                        <span></span><div class="labelname" style="margin-top: -19px;">General Message</div>
	                      </label>
	                    </div>
	                    <div class="radio" style="width:65%;">
	                      <label>
	                        <input class="table_field telegram_default_message_status" name="telegram_default_message_status" value="1" type="radio" '.$telegram_default_message_status_custom.' '.$telegram_box_notification_input.'>
	                        <span></span><div class="labelname" style="margin-top: -19px;">Custom Message</div>
	                      </label>
	                    </div>
	                </div>
	                <div id="custom_tg_message" class="'.$custom_tg_message_status.'">
	                <p style="padding-top:40px;"><b>Custom Message :</b></p>
	                <textarea style="width:99%;padding: 10px 15px;" rows="3" id="telegram_custom_message" '.$telegram_box_notification_input.'>'.$tg_custom_message.'</textarea>
	                </div>
                </div>

	            <input type="submit" id="telegram_save_message" name="telegram_save_sms" value="Save Telegram" class="button btn_mgo_new_purple" style="margin-top: 30px !important;margin-bottom: 10px !important;"> &nbsp;&nbsp;<span id="telegram_success_notification"></span>
				
				<div class="container">
					<div class="accordion">
					    <div class="accordion-item">
					      <a>Wajib baca untuk Custom Message Telegram</a>
					      <div class="content">
					        <p style="font-size:12px;">
							<ul style="font-size:12px;">
								<li style="list-style: disc;">Anda bisa menggunakan beberapa <b>Magic Tag</b> dibawah ini untuk ditampilkan pada Pesan, adapun daftarnya sebagai berikut yang bisa anda digunakan:<br>
			                    <b>[mgo_orderid]</b> : untuk menambahkan Order ID pemesanan.<br>
			                    <b>[mgo_nama]</b> : untuk menambahkan nama customer.<br>
			                    <b>[mgo_nama_produk]</b> : untuk menambahkan nama produk.<br>
			                    <b>[mgo_jumlah_barang]</b> : untuk menambahkan jumlah barang.<br>
			                    <b>[mgo_pembayaran]</b> : untuk menambahkan user harus transfer ke rekening anda yang mana.<br>
			                    <b>[mgo_item_total]</b> : untuk menambahkan item total dari pemesanan.<br>
			                    <b>[mgo_total]</b> : untuk menambahkan total harga dari pemesanan.<br>
			                    <b>[mgo_dp]</b> : untuk menambahkan nilai DP dari Total.<br>
			                    <b>[mgo_sisa]</b> : untuk menambahkan nilai sisa pembayaran dari Total - DP.<br>
			                    <b>[mgo_cswa]</b> : untuk menambahkan nomor Whatsapp CS anda, pastikan anda menggunakan CS Rotator.<br>
			                    <b>[mgo_csid] : untuk menambahkan Nama CS, pastikan menggunakan CS Rotator.<br>
			                    <b>[followup1]</b> : untuk menambahkan link Followup 1.<br>
			                    <b>[followup2]</b> : untuk menambahkan link Followup 2.<br>
			                    <b>[followup3]</b> : untuk menambahkan link Followup 3.<br>
			                    <b>[mgo_detail_order]</b> : untuk menambahkan detail order secara keseluruhan.<br><br>
			                    <b><i>Contoh :</i></b><br>
			                    <div style="background:#E2E6F7;padding: 10px 12px;border-radius: 2px;margin-top: 8px;">Alhamdulillah ada orderan masuk dari [mgo_nama] :<br>[mgo_detail_order]<br>Payment ke [mgo_pembayaran]. <br>Followup : [followup1]<br><br>Semangat ya Followupnya.</div>
			                    <br><br>
			                    </li>
								<li style="list-style: disc;"><b>Magic Tag</b> diatas hanya dapat bekerja jika anda memberikan nama <b>Slug</b> dengan benar sesuai daftar diatas pada field anda.</li><li style="list-style: disc;">Pastikan juga anda sudah men-setting TELEGRAM Bot di : <br><b>Magic Order > API Settings > General Settings > TELEGRAM.</b>
								</li>
							</ul>
							</p>
					      </div>
					    </div>
					    <!-- end accordion-item -->
					</div>
				</div>
				<!-- end container -->
			</div>
			<!-- end tab-3 -->


		</div>
		<!-- end tab-slider--container -->

	</div>
	<style>
		ul.tagit{padding:1px 5px;overflow:auto;margin-left:inherit;margin-right:inherit}ul.tagit li{display:block;float:left;margin:2px 5px 2px 0}ul.tagit li.tagit-choice{position:relative;line-height:inherit}input.tagit-hidden-field{display:none}ul.tagit li.tagit-choice-read-only{padding:.2em .5em .2em .5em}ul.tagit li.tagit-choice-editable{padding:.2em 18px .2em .5em}ul.tagit li.tagit-new{padding:.25em 4px .25em 0}ul.tagit li.tagit-choice a.tagit-label{cursor:pointer;text-decoration:none}ul.tagit li.tagit-choice .tagit-close{cursor:pointer;position:absolute;right:.1em;top:50%;margin-top:-8px;line-height:17px}ul.tagit li.tagit-choice .tagit-close .text-icon{display:none}ul.tagit li.tagit-choice input{display:block;float:left;margin:2px 5px 2px 0}ul.tagit input[type=text]{-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box;-moz-box-shadow:none;-webkit-box-shadow:none;box-shadow:none;border:none;margin:0;padding:0;width:inherit;background-color:inherit;outline:0}
		ul.tagit{border-style:solid;border-width:1px;border-color:#c6c6c6;background:inherit}ul.tagit li.tagit-choice{-moz-border-radius:6px;border-radius:6px;-webkit-border-radius:6px;border:1px solid #cad8f3;background:0 0;background-color:#dee7f8;font-weight:400}ul.tagit li.tagit-choice .tagit-label:not(a){color:#555}ul.tagit li.tagit-choice a.tagit-close{text-decoration:none}ul.tagit li.tagit-choice .tagit-close{right:.4em}ul.tagit li.tagit-choice .ui-icon{display:none}ul.tagit li.tagit-choice .tagit-close .text-icon{display:inline;font-family:arial,sans-serif;font-size:16px;line-height:16px;color:#777}ul.tagit li.tagit-choice.remove,ul.tagit li.tagit-choice:hover{background-color:#bbcef1;border-color:#6d95e0}ul.tagit li.tagit-choice a.tagLabel:hover,ul.tagit li.tagit-choice a.tagit-close .text-icon:hover{color:#222}ul.tagit input[type=text]{color:#333;background:0 0}.ui-widget{font-size:1.1em}.tagit-autocomplete.ui-autocomplete{position:absolute;cursor:default}* html .tagit-autocomplete.ui-autocomplete{width:1px}.tagit-autocomplete.ui-menu{list-style:none;padding:2px;margin:0;display:block;float:left}.tagit-autocomplete.ui-menu .ui-menu{margin-top:-3px}.tagit-autocomplete.ui-menu .ui-menu-item{margin:0;padding:0;zoom:1;float:left;clear:left;width:100%}.tagit-autocomplete.ui-menu .ui-menu-item a{text-decoration:none;display:block;padding:.2em .4em;line-height:1.5;zoom:1}.tagit-autocomplete .ui-menu .ui-menu-item a.ui-state-active,.tagit-autocomplete .ui-menu .ui-menu-item a.ui-state-hover{font-weight:400;margin:-1px}.tagit-autocomplete.ui-widget-content{border:1px solid #aaa;background:#fff 50% 50% repeat-x;color:#222}.tagit-autocomplete .ui-corner-all,.tagit-autocomplete.ui-corner-all{-moz-border-radius:4px;-webkit-border-radius:4px;-khtml-border-radius:4px;border-radius:4px}.tagit-autocomplete .ui-state-focus,.tagit-autocomplete .ui-state-hover{border:1px solid #999;background:#dadada;font-weight:400;color:#212121}.tagit-autocomplete .ui-state-active{border:1px solid #aaa}.tagit-autocomplete .ui-widget-content{border:1px solid #aaa}.tagit .ui-helper-hidden-accessible{position:absolute!important;clip:rect(1px,1px,1px,1px)}
		ul.tagit li.tagit-choice .tagit-label:not(a) {
		    color:#fff;font-weight: 400;font-size: 13px;
		}
		ul.tagit {
			border-radius: 4px; padding: 8px 8px; padding-bottom:2px; margin-top: -5px;margin-bottom: -10px; padding-left:12px;
		}
		ul.tagit li.tagit-choice {
			background-color: #6c61f6;
			border: 1px solid #6c61f6;
		}
		ul.tagit input.ui-widget-content {
			margin-top:-10px !important;
		}
		ul.tagit li.tagit-choice a.tagit-close {
			margin-top:-6px;
		}
		ul.tagit li.tagit-choice .tagit-close .text-icon {
			color: #31252580;
		}
		.telegram_box-notification.deactivated ul.tagit li.tagit-choice, .wanotif_box-notification.deactivated ul.tagit li.tagit-choice, .feature_disabled ul.tagit li.tagit-choice {
			background: #D4DDEC !important;
			border:1px solid #BDC6D5 !important;
		}
		.telegram_box-notification.deactivated ul.tagit, .wanotif_box-notification.deactivated ul.tagit {
			border-color: #D4DDEC;
		}
		.telegram_box-notification.deactivated .checkbox input[type="checkbox"]:checked + span, .wanotif_box-notification.deactivated .checkbox input[type="checkbox"]:checked + span {
			border-color: #D4DDEC !important;
			background-color: #D4DDEC !important;
		}
		.telegram_box-notification.deactivated .tagit-close, .wanotif_box-notification.deactivated .tagit-close {
			display:none !important;
		}
		.feature_disabled, .feature_disabled .labelname {
			color: #D4DDEC !important;
		}
		.feature_disabled {
			display: none !important;
		}
		.radio.ganjil{
		    margin-right:32px
		}
		.labelname{
		    padding-left:8px;
		    position:absolute;
		    margin-left:30px;
		    margin-top:-21px
		}
		.checkbox,.radio{
		    margin-bottom:8px;
		    margin-left:-10px;
		    width:48%;
		    float:left
		}
		.radio label{
		    padding:10px
		}
		.checkbox *,.radio *{
		    cursor:pointer
		}
		
		.tab-slider--container .checkbox input{
		    margin-right: 15px;
		}
		.tab-slider--container .checkbox input[type="checkbox"]:disabled:checked::before {
			display: none !important;
		}
		.tab-slider--container .checkbox input, .tab-slider--container .radio input{
		    opacity:0;
		}
		.tab-slider--container .checkbox span{
		    position:relative;
		    display:inline-block;
		    margin-left:-25px;
		    vertical-align:top;
		    width:20px;
		    height:20px;
		    border-radius:4px;
		    border:1px solid #ccc
		}
		.tab-slider--container .radio span{
		    position:relative;
		    display:inline-block;
		    margin-left:-25px;
		    vertical-align:top;
		    width:20px;
		    height:20px;
		    border:1px solid #ccc
		}
		.tab-slider--container input, .tab-slider--container textarea {
			border:1px solid #ccc;
		} 
		#custom_channel input::placeholder, #div_wanotif_forward input::placeholder {
			color:#ccc;
		}
		.checkbox:hover span,.radio:hover span{
		    border-color:#6c61f6
		}
		.checkbox span:before, .radio span:before{
		    content:"\2713";
		    position:absolute;
		    top:0;
		    left:0;
		    right:0;
		    bottom:0;
		    opacity:0;
		    text-align:center;
		    font-size:16px;
		    line-height:18px;
		    vertical-align:middle;
		    color:#6c61f6
		}
		.radio span{
		    border-radius:50%
		}
		.radio span:before{
		    content:"";
		    width:10px;
		    height:10px;
		    margin:5px auto;
		    background-color:#6c61f6;
		    border-radius:100px
		}
		.checkbox input[type=checkbox]:checked+span,.radio input[type=radio]:checked+span{
		    border-color:#6c61f6;
		    background-color:#6c61f6
		}
		.radio input[type=radio]:checked+span{
		    background-color:#fff
		}
		.checkbox input[type=checkbox]:checked+span:before,.radio input[type=radio]:checked+span:before{
		    color:#fff;
		    opacity:1;
		    transition:color .3 ease-out
		}
		#content_mgo4 .checkbox input:disabled {
			opacity: 0;
		}
		.checkbox input[type=checkbox]:disabled+span,.radio input[type=radio]:disabled+span{
		    border-color:#D4DDEC!important;
		    background-color:#D4DDEC!important
		}

		.box-notification.deactivated, .wanotif_box-notification.deactivated, .telegram_box-notification.deactivated {
			color: #D4DDEC !important;
		}

		#content_mgo4 input.disabled, #content_mgo4 input:disabled, #content_mgo4 select.disabled, #content_mgo4 select:disabled, #content_mgo4 textarea.disabled, #content_mgo4 textarea:disabled {
    background: rgba(255,255,255,.5);border-color: #D4DDEC;box-shadow: #D4DDEC;color:#D4DDEC;}.accordion a{margin-top:20px;position:relative;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;flex-direction:column;width:99%;padding:1rem 0rem 1rem 0rem;color:#7288a2;font-size:0.9rem;font-weight:400;border-bottom:1px solid #e5e5e5}.accordion a:hover,.accordion a:hover::after{cursor:pointer;color:#03b5d2}.accordion a:hover::after{border:1px solid #03b5d2}.accordion a.active{color:#03b5d2;border-bottom:1px solid #03b5d2;height: 20px;}.accordion a::after{content:"+";position:absolute;float:right;right:1rem;font-size:1rem;color:#7288a2;padding:5px;padding-top:5px;width:23px;height:22px;-webkit-border-radius:50%;-moz-border-radius:50%;border-radius:50%;border:1px solid #7288a2;text-align:center;padding-top:5px;margin-top:-10px;margin-right: -10px;}.accordion a.active::after{font-family:"Ionicons";content:"-";padding-top:7px;color:#03b5d2;border:1px solid #03b5d2}.accordion .content{display:none;padding:1rem;border-bottom:1px solid #e5e5e5;overflow:hidden}.accordion .content p{font-size:1rem;font-weight:300}
    .message_disabled input, .message_disabled input, .message_disabled select, .message_disabled select, .message_disabled textarea, .message_disabled textarea {
		    background: rgba(255,255,255,.5);
		    border-color: #D4DDEC;
		    box-shadow: #D4DDEC;
		    color: #D4DDEC;
		}
		.message_disabled p {
			color: #D4DDEC;
		}
	</style>
    <script>
		jQuery(document).ready(function($) {

			$("input[type=radio][name=wanotif_default_message_status]").change(function() {
			    if (this.value == "0") {
			        $("#custom_cod_message").addClass("message_disabled");
			        $("#custom_cod_message textarea").prop("disabled", true);
			    }else{
			        $("#custom_cod_message").removeClass("message_disabled");
			        $("#custom_cod_message textarea").prop("disabled", false);
			    }
			});

			$("input[type=radio][name=telegram_default_message_status]").change(function() {
			    if (this.value == "0") {
			        $("#custom_tg_message").addClass("message_disabled");
			        $("#custom_tg_message textarea").prop("disabled", true);
			    }else{
			        $("#custom_tg_message").removeClass("message_disabled");
			        $("#custom_tg_message textarea").prop("disabled", false);
			    }
			});

			$("input[type=radio][name=default_message_status]").change(function() {
			    if (this.value == "0") {
			        $("#custom_sms_message").addClass("message_disabled");
			        $("#custom_sms_message textarea").prop("disabled", true);
			    }else{
			        $("#custom_sms_message").removeClass("message_disabled");
			        $("#custom_sms_message textarea").prop("disabled", false);
			    }
			});

			
			
		  	$(".accordion a").click(function(){
		    	$(this).toggleClass("active");
		    	$(this).next(".content").slideToggle(400);
		   	});

		   	$(".tab-slider--body").hide();
  		    $(".tab-slider--body:first").show();

  		    $(".tab-slider--nav li").bind("click", function(e){
			  	$(".tab-slider--body").hide();
			  	var activeTab = $(this).attr("rel");
			  	$("#"+activeTab).fadeIn();
				// if($(this).attr("rel") == "tab2"){
				// 	$(".tab-slider--tabs").addClass("slide");
				// }else{
				// 	$(".tab-slider--tabs").removeClass("slide");
				// }
			  	$(".tab-slider--nav li").removeClass("active");
			  	$(this).addClass("active");
			});

			$(".sms_status").change(function() {
			    if(this.checked) {
			        $(".box-notification").removeClass("deactivated");
					$(".box-notification input").prop("disabled", false);
					$(".box-notification textarea").prop("disabled", false);
					$(".notif_light").addClass("on");
			    }else{
			    	$(".box-notification").addClass("deactivated");
					$(".box-notification input").prop("disabled", true);
					$(".box-notification textarea").prop("disabled", true);
					if($(".wanotif_status:checked").val()!=1 && $(".telegram_status:checked").val()!=1){
						$(".notif_light").removeClass("on");
					}
			    }
			});
			$(".wanotif_status").change(function() {
				var wanotif_default_message = $("input[type=radio][name=wanotif_default_message_status]:checked").val();
				// alert(wanotif_default_message);
			    if(this.checked) {
			        $(".wanotif_box-notification").removeClass("deactivated");
					$(".wanotif_box-notification input").prop("disabled", false);
					if(wanotif_default_message=="1"){
						$(".wanotif_box-notification textarea").prop("disabled", false);
					}else{
						$(".wanotif_box-notification textarea").prop("disabled", true);
					}
					
					$(".notif_light").addClass("on");
			    }else{
			    	$(".wanotif_box-notification").addClass("deactivated");
					$(".wanotif_box-notification input").prop("disabled", true);
					$(".wanotif_box-notification textarea").prop("disabled", true);
					if($(".sms_status:checked").val()!=1 && $(".telegram_status:checked").val()!=1){
						$(".notif_light").removeClass("on");
					}
			    }
			});
			$(".telegram_status").change(function() {
			    if(this.checked) {
			        $(".telegram_box-notification").removeClass("deactivated");
					$(".telegram_box-notification input").prop("disabled", false);
					$(".telegram_box-notification textarea").prop("disabled", false);
					$(".notif_light").addClass("on");
			    }else{
			    	$(".telegram_box-notification").addClass("deactivated");
					$(".telegram_box-notification input").prop("disabled", true);
					$(".telegram_box-notification textarea").prop("disabled", true);
					if($(".sms_status:checked").val()!=1 && $(".wanotif_status:checked").val()!=1){
						$(".notif_light").removeClass("on");
					}
			    }
			});

			$(".telegram_custom_channel").tagit();
			$(".wanotif_forward").tagit();
			$("input.ui-autocomplete-input").prop( "disabled", '.$telegram_tagit_active.' );
			$("input.ui-autocomplete-input").prop( "disabled", '.$wanotif_tagit_active.' );

			$("#save_sms").bind("click", function(e){
				var sms_status = $(".sms_status:checked").val();
				var default_message_status = $(".default_message_status:checked").val();
				var custom_message = $("#custom_message").val();

				if(sms_status!=1){
					sms_status = 0;
				}

				$("#success_notification").html('."'".'<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #464646;font-weight: bold;margin-top: 28px;">Saving...</span>'."'".');
				
				var data_nya = [
					form_idnya,
	            	sms_status,
	            	default_message_status,
	            	custom_message
		        ];

		        var data = {
		            "action": "myaction_save_notif_sms",
		            "datanya": data_nya
		        };
		        jQuery.post(ajaxurl, data, function(response) {
		            $("#success_notification").html(response);
		        });
			});

			$("#wanotif_save_message").bind("click", function(e){
				var wanotif_status = $(".wanotif_status:checked").val();
				var wanotif_default_message_status = $(".wanotif_default_message_status:checked").val();
				var wanotif_custom_message = $("#wanotif_custom_message").val();
				var wanotif_cod_message = $("#wanotif_cod_message").val();

				var new_selected = [];	            
	            $("ul.wanotif_forward li.tagit-choice span.tagit-label").each(function(){
	                new_selected.push($(this).text());
	            });
	            new_selected = new_selected.toString();

				if(wanotif_status!=1){
					wanotif_status = 0;
				}

				$("#wanotif_success_notification").html('."'".'<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #464646;font-weight: bold;margin-top: 28px;">Saving...</span>'."'".');
				
				var data_nya = [
					form_idnya,
	            	wanotif_status,
	            	wanotif_default_message_status,
	            	wanotif_custom_message,
	            	wanotif_cod_message,
	            	new_selected
		        ];

		        var data = {
		            "action": "myaction_save_notif_wanotif",
		            "datanya": data_nya
		        };
		        jQuery.post(ajaxurl, data, function(response) {
		            $("#wanotif_success_notification").html(response);
		        });
			});


			$("#telegram_save_message").bind("click", function(e){
				var telegram_status = $(".telegram_status:checked").val();
				var telegram_default_message_status = $(".telegram_default_message_status:checked").val();
				var telegram_custom_message = $("#telegram_custom_message").val();
				var telegram_owner_status = $(".tg_owner_status:checked").val();
				var telegram_csrotator_status = $(".tg_csrotator_status:checked").val();
				var telegram_custom_status = $(".tg_custom_status:checked").val();

				var new_selected = [];	            
	            $("ul.telegram_custom_channel li.tagit-choice span.tagit-label").each(function(){
	                new_selected.push($(this).text());
	            });
	            new_selected = new_selected.toString();
	            
	            if(telegram_status!=1){
					telegram_status = 0;
				}
				if(telegram_owner_status!=1){
					telegram_owner_status = 0;
				}
				if(telegram_csrotator_status!=1){
					telegram_csrotator_status = 0;
				}
				if(telegram_custom_status!=1){
					telegram_custom_status = 0;
				}

				$("#telegram_success_notification").html('."'".'<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #464646;font-weight: bold;margin-top: 28px;">Saving...</span>'."'".');
				
				var data_nya = [
					form_idnya,
	            	telegram_status,
	            	telegram_default_message_status,
	            	telegram_custom_message,
	            	telegram_owner_status,
	            	telegram_csrotator_status,
	            	telegram_custom_status,
	            	new_selected
		        ];

		        var data = {
		            "action": "myaction_save_notif_telegram",
		            "datanya": data_nya
		        };
		        jQuery.post(ajaxurl, data, function(response) {
		            $("#telegram_success_notification").html(response);
		        });
			});


		});
		
	</script>
	';

    wp_die();
} 
add_action( 'wp_ajax_myaction_get_datanotif', 'myaction_get_datanotif' );
add_action( 'wp_ajax_nopriv_myaction_get_datanotif', 'myaction_get_datanotif' );





function myaction_get_formstyle() {

	mgo_global_vars();
    $plugin_license = $GLOBALS['mgovars']['plugin_license'];
    $plugin_license_info = $GLOBALS['mgovars']['plugin_license_info'];

	// INISIAL
    global $wpdb;
    $table_name = $wpdb->prefix . "cf_forms";
    $table_name2 = $wpdb->prefix . "mgo_calculation";
    $table_name3 = $wpdb->prefix . "mgo_settings";

    $form_id = $_POST['datanya'][0]; // FORM ID
    
    $row = $wpdb->get_results('SELECT data from '.$table_name3.' where type="mgo_license" ORDER BY id ASC');
    $mgo_license = $row[0]->data;

    
    // Check Plugin Licensed
    if($plugin_license=='FREEMIUM'){
    	// echo '<div class="sub-title-info" style="margin-top: 90px; font-size: 16px; font-weight: bold; text-align: center;">';
        echo $plugin_license_info;
        // echo '</div>';
        wp_die();
    }

    
    if($mgo_license!='9e3360ac711fcd82ceea74c8eb69bda9'){
    	$tyle3 = 'form_disabled';
	    $tyle4 = 'form_disabled';
	    $tyle5 = 'form_disabled';
	    $tyle3_name = '<p style="font-style: italic;font-size: 11px;font-weight: bold;margin-top:-5px;">(Only for PRO)</p>';
	   	$tyle4_name = '<p style="font-style: italic;font-size: 11px;font-weight: bold;margin-top:-5px;">(Only for PRO)</p>';
	   	$tyle5_name = '<p style="font-style: italic;font-size: 11px;font-weight: bold;margin-top:-5px;">(Only for PRO)</p>';
    }else{
    	$tyle3 = '';
	    $tyle4 = '';
	    $tyle5 = '';
	    $tyle3_name = 'Style 3';
	   	$tyle4_name = 'Style 4';
	   	$tyle5_name = 'Style 5';
    }

    // CHECK ROLE
    check_role();

    $form_style = '';
    $query_form = $wpdb->get_results('SELECT * from '.$table_name2.' where id_form="'.$form_id.'" ');
    if($query_form!=null){
    	$form_style = $query_form[0]->form_style;
    }

	// echo 'oke '.$form_style;
	echo '
	<div class="form_style_box">
        <div class="radio form_0" style="width:33%;">
          <label>
            <input class="table_field form_style" name="form_style" value="0" type="radio" checked="">
            <span></span><div class="labelname">
            <img src='."'".plugin_dir_url( __FILE__ ).'assets/icons/form/style0.jpg'."'".'>
            <div>No Style</div>
            </div>
          </label>
        </div>
        <div class="radio form_1" style="width:33%;">
          <label>
            <input class="table_field form_style" name="form_style" value="1" type="radio" checked="">
            <span></span><div class="labelname">
            <img src='."'".plugin_dir_url( __FILE__ ).'assets/icons/form/style1.jpg'."'".'>
            <div>Style 1</div>
            </div>
          </label>
        </div>
        <div class="radio form_2" style="width:33%;">
          <label>
            <input class="table_field form_style" name="form_style" value="2" type="radio">
            <span></span><div class="labelname">
            <img src='."'".plugin_dir_url( __FILE__ ).'assets/icons/form/style2.jpg'."'".'>
            <div>Style 2</div>
            </div>
          </label>
        </div>
        <div class="radio form_3" style="width:33%;">
          <label class="'.$tyle3.'">
            <input class="table_field form_style" name="form_style" value="3" type="radio">
            <span></span><div class="labelname">
            <img src='."'".plugin_dir_url( __FILE__ ).'assets/icons/form/style3.jpg'."'".'>
            <div>'.$tyle3_name.'</div>
            </div>
          </label>
        </div>
        <div class="radio form_4" style="width:33%;">
          <label class="'.$tyle4.'">
            <input class="table_field form_style" name="form_style" value="4" type="radio">
            <span></span><div class="labelname">
            <img src='."'".plugin_dir_url( __FILE__ ).'assets/icons/form/style4.jpg'."'".'>
            <div>'.$tyle4_name.'</div>
            </div>
          </label>
        </div>
        <div class="radio form_5" style="width:33%;">
          <label class="'.$tyle5.'">
            <input class="table_field form_style" name="form_style" value="5" type="radio">
            <span></span><div class="labelname">
            <img src='."'".plugin_dir_url( __FILE__ ).'assets/icons/form/style5.jpg'."'".'>
            <div>'.$tyle5_name.'</div>
            </div>
          </label>
        </div>
    </div>
    <div>
    <input type="submit" id="save_style" name="save_style" value="Save Style" class="button btn_mgo_new_purple" style="margin-top: 20px !important;margin-bottom: 10px !important;margin-left:60px;"> &nbsp;&nbsp;<span id="success_notification2"></span>
    </div>

    <style>
	.radio.ganjil{margin-right:32px}.labelname{padding-left:8px;position:absolute;margin-left:30px;margin-top:-21px}.radio{margin-bottom:8px;margin-left:-10px;width:48%;float:left}.radio label{padding:10px}.radio *{cursor:pointer}.radio input{opacity:0}.radio span{position:relative;display:inline-block;margin-left:-25px;vertical-align:top;width:20px;height:20px;border-radius:4px;border:1px solid #ccc}.radio:hover span{border-color:#6c61f6}.radio span:before{content:"\2713";position:absolute;top:0;left:0;right:0;bottom:0;opacity:0;text-align:center;font-size:16px;line-height:18px;vertical-align:middle;color:#6c61f6}.radio span{border-radius:50%}.radio span:before{content:"";width:10px;height:10px;margin:5px auto;background-color:#6c61f6;border-radius:100px}.radio input[type=radio]:checked+span{border-color:#6c61f6;background-color:#6c61f6}.radio input[type=radio]:checked+span{background-color:#fff}.radio input[type=radio]:checked+span:before{color:#fff;opacity:1;transition:color .3 ease-out}.radio input[type=radio]:disabled+span{border-color:#d4ddec!important;background-color:#d4ddec!important}
	.form_style_box {
		padding-top: 20px;
	}
	.form_style_box .radio img {
		width: 120px;
	}
	#content_mgo6 .radio {
		margin-bottom: 200px;
	}
	.form_style_box .form-style-active {
		color: #A340C6;
		font-weight: bold;
	}
	.form_style_box .form-style-active img {
		border: 1px solid#b9abb7;padding-bottom: 10px; box-shadow: 0 0 5px rgba(43, 79, 147, 0.47),0 2px 25px rgba(27, 37, 187, 0.2);border-radius: 4px;
	}
	.form_style_box img {
		border: 1px solid#ffffff; padding-bottom: 10px; border-radius: 4px;
	}
	.form_style_box .radio input[type="radio"] + span {
		display: none;
	}
	// .form_style_box .form_disabled .form-style-active img {
	// 	border: none;
	// 	padding-bottom: 10px;
	// 	box-shadow: none;
	// 	border-radius: none;
	// }
	// .form_style_box .form_disabled .form-style-active {
	// 	color: #444 !important;
	//     font-weight: 300 !important;
	// }
	.labelname div {
		text-align:center;
	}
    </style>
    <script>
    jQuery(document).ready(function($) {
		$(".form_style_box label").bind("click", function(){

			if ($(this).hasClass("form_disabled")) {
				alert("Sorry, you can not use this style. Only for PRO License.");
				return false;
			}

			$(".form_style_box label div").removeClass("form-style-active");
			$(this).find("div.labelname").addClass("form-style-active");

		});


		var s = "'.$form_style.'";
		s_style = "";
		if(s!=""){
			s_style = s.split("_");
			s_style = s_style[2];
			$(".form_"+s_style+" .labelname").addClass("form-style-active");
			$(".form_"+s_style+" input").prop("checked", true);
		}else{
			$(".form_0 .labelname").addClass("form-style-active");
			$(".form_0 input").prop("checked", true);
		}

		$("#save_style").bind("click", function(){
			var style = $(".form_style:checked").val();
			$("#success_notification2").html('."'".'<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #464646;font-weight: bold;margin-top: 28px;">Saving...</span>'."'".');
				
			var data_nya = [
				form_idnya,
				style
	        ];

	        var data = {
	            "action": "myaction_save_form_style",
	            "datanya": data_nya
	        };
	        jQuery.post(ajaxurl, data, function(response) {
	            $("#success_notification2").html(response);
	        });

		});

	});
    </script>
    ';

    wp_die();
} 
add_action( 'wp_ajax_myaction_get_formstyle', 'myaction_get_formstyle' );
add_action( 'wp_ajax_nopriv_myaction_get_formstyle', 'myaction_get_formstyle' );



function myaction_form_notif_status() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_calculation";

    $form_id = $_POST['datanya'][0]; // FORM ID

    $sms_status = 0;
    $wanotif_status = 0;
    $telegram_status = 0;
    $formula_status = 0;
    $csrotator_status = 0;
    $setcourier_status = 0;
    $query_form = $wpdb->get_results('SELECT * from '.$table_name.' where id_form="'.$form_id.'" ');
    if($query_form!=null){
    	$sms_status = $query_form[0]->sms_status;
    	$wanotif_status = $query_form[0]->wanotif_status_form;
    	$telegram_status = $query_form[0]->tg_status;
    	
    	$formula_status = $query_form[0]->rumus_calculation;
    	$csrotator_status = $query_form[0]->id_cs;
    	$setcourier_status = $query_form[0]->origin_city_id;

    }

    if($sms_status==1 || $wanotif_status==1 || $telegram_status==1){
    	$status1 = 'on';
    }else{
    	$status1 = 'off';
    }

    if($formula_status!=''){
    	$status2 = 'on';
    }else{
    	$status2 = 'off';
    }

    if($csrotator_status!=''){
    	$status3 = 'on';
    }else{
    	$status3 = 'off';
    }

    if($setcourier_status!=null){
    	if($setcourier_status!=0){
    		$status4 = 'on';
    	}else{
    		$status4 = 'off';
    	}
    }else{
    	$status4 = 'off';
    }


	echo $status1.'_'.$status2.'_'.$status3.'_'.$status4;

    wp_die();

} 
add_action( 'wp_ajax_myaction_form_notif_status', 'myaction_form_notif_status' );
add_action( 'wp_ajax_nopriv_myaction_form_notif_status', 'myaction_form_notif_status' );


function myaction_gf_form_setting_status() {
	// INISIAL
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_gf_calculation";

    $form_id = $_POST['datanya'][0]; // FORM ID

    
    $status_formula = 0;
    $status_cs_rotator = 0;
    $status_set_courier = 0;
    $status_wanotif_sms = 0;

    // Query GF Form
    $query_form = $wpdb->get_results('SELECT * from '.$table_name.' where id_form="'.$form_id.'" ');

    // Set null
    $formula_status = '';
	$cs_status = null;
	$courier_status = '';
	$sms_status = 0;
	$wanotif_status = 0;
    if($query_form!=null){
    	$formula_status = $query_form[0]->rumus_calculation;
    	$cs_status = $query_form[0]->id_cs;
    	$courier_status = $query_form[0]->courier;
    	$sms_status = $query_form[0]->sms_status;
    	$wanotif_status = $query_form[0]->wanotif_status_form;
    }

    if($formula_status!=''){
    	$status_formula = 1;
    }
    if($cs_status!=null){
    	$status_cs_rotator = 1;
    }
    if($courier_status!=''){
    	$status_set_courier = 1;
    }
    if($sms_status==1 || $wanotif_status==1){
    	$status_wanotif_sms = 1;
    }

	echo $status_formula.'_'.$status_cs_rotator.'_'.$status_set_courier.'_'.$status_wanotif_sms;

    wp_die();

} 
add_action( 'wp_ajax_myaction_gf_form_setting_status', 'myaction_gf_form_setting_status' );
add_action( 'wp_ajax_nopriv_myaction_gf_form_setting_status', 'myaction_gf_form_setting_status' );



function myaction_save_notif_sms() {
	// INISIAL
    global $wpdb;
	$table_name = $wpdb->prefix . "cf_forms";
    $table_name2 = $wpdb->prefix . "mgo_calculation";

    $form_id = $_POST['datanya'][0];
    $sms_status = $_POST['datanya'][1];
    $default_message_status = $_POST['datanya'][2];
    $custom_message = $_POST['datanya'][3];
    
    $jumlah_form = $wpdb->get_var('SELECT * from '.$table_name2.' where id_form="'.$form_id.'"');
    if($jumlah_form>=1){
        $wpdb->update(
            $table_name2, //table
            array('sms_status' => $sms_status, 'default_message_status' => $default_message_status, 'custom_message' => $custom_message), //data
            array('id_form' => $form_id), //where
            array('%s'), //data format
            array('%s') //where format
        );
    }else {
        $wpdb->insert(
            $table_name2, //table
            array('id_form' => $form_id, 'sms_status' => $sms_status, 'default_message_status' => $default_message_status, 'custom_message' => $custom_message), //data
            array('%s', '%s') //data format         
        );
    }

	echo '<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;font-weight: bold;margin-top: 28px;"><span class="dashicons dashicons-yes" style="margin-right: 10px; font-size: 28px;"></span>Save SMS Success!</span>';
	
	wp_die();
}
add_action( 'wp_ajax_myaction_save_notif_sms', 'myaction_save_notif_sms' );
add_action( 'wp_ajax_nopriv_myaction_save_notif_sms', 'myaction_save_notif_sms' );



function myaction_save_notif_wanotif() {
	// INISIAL
    global $wpdb;
	$table_name = $wpdb->prefix . "cf_forms";
    $table_name2 = $wpdb->prefix . "mgo_calculation";

    $form_id = $_POST['datanya'][0];
    $wanotif_status_form = $_POST['datanya'][1];
    $wanotif_default_message_status = $_POST['datanya'][2];
    $wanotif_custom_message = $_POST['datanya'][3];
    $wanotif_cod_message = $_POST['datanya'][4];
    $wanotif_forward = $_POST['datanya'][5];
    
    $jumlah_form = $wpdb->get_var('SELECT * from '.$table_name2.' where id_form="'.$form_id.'"');
    if($jumlah_form>=1){
        $wpdb->update(
            $table_name2, //table
            array('wanotif_status_form' => $wanotif_status_form, 'wanotif_default_message_status' => $wanotif_default_message_status, 'wanotif_custom_message' => $wanotif_custom_message, 'wanotif_cod_message' => $wanotif_cod_message, 'wanotif_forward' => $wanotif_forward), //data
            array('id_form' => $form_id), //where
            array('%s'), //data format
            array('%s') //where format
        );
    }else {
        $wpdb->insert(
            $table_name2, //table
            array('id_form' => $form_id, 'wanotif_status_form' => $wanotif_status_form, 'wanotif_default_message_status' => $wanotif_default_message_status, 'wanotif_custom_message' => $wanotif_custom_message, 'wanotif_cod_message' => $wanotif_cod_message, 'wanotif_forward' => $wanotif_forward), //data
            array('%s', '%s') //data format         
        );
    }

	echo '<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #1AB696;font-weight: bold;margin-top: 28px;"><span class="dashicons dashicons-yes" style="margin-right: 10px; font-size: 28px;"></span>Save Wanotif Success!</span>';
	
	wp_die();
}
add_action( 'wp_ajax_myaction_save_notif_wanotif', 'myaction_save_notif_wanotif' );
add_action( 'wp_ajax_nopriv_myaction_save_notif_wanotif', 'myaction_save_notif_wanotif' );


function myaction_save_notif_telegram() {
	// INISIAL
    global $wpdb;
	$table_name = $wpdb->prefix . "cf_forms";
    $table_name2 = $wpdb->prefix . "mgo_calculation";

    $form_id = $_POST['datanya'][0];

    $tg_status = $_POST['datanya'][1];
    $tg_message_status = $_POST['datanya'][2];
    $tg_custom_message = $_POST['datanya'][3];

    $tg_owner_status = $_POST['datanya'][4];
    $tg_csrotator_status = $_POST['datanya'][5];
    $tg_custom_status = $_POST['datanya'][6];
    $tg_custom_channel = $_POST['datanya'][7];
    
    $jumlah_form = $wpdb->get_var('SELECT * from '.$table_name2.' where id_form="'.$form_id.'"');
    if($jumlah_form>=1){
        $wpdb->update(
            $table_name2, //table
            array('tg_status' => $tg_status, 'tg_message_status' => $tg_message_status, 'tg_custom_message' => $tg_custom_message, 'tg_owner_status' => $tg_owner_status, 'tg_csrotator_status' => $tg_csrotator_status, 'tg_custom_status' => $tg_custom_status, 'tg_custom_channel' => $tg_custom_channel), //data
            array('id_form' => $form_id), //where
            array('%s'), //data format
            array('%s') //where format
        );
    }else {
        $wpdb->insert(
            $table_name2, //table
            array('id_form' => $form_id, 'tg_status' => $tg_status, 'tg_message_status' => $tg_message_status, 'tg_custom_message' => $tg_custom_message, 'tg_owner_status' => $tg_owner_status, 'tg_csrotator_status' => $tg_csrotator_status, 'tg_custom_status' => $tg_custom_status, 'tg_custom_channel' => $tg_custom_channel), //data
            array('%s', '%s') //data format         
        );
    }

	echo '<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #1AB696;font-weight: bold;margin-top: 28px;"><span class="dashicons dashicons-yes" style="margin-right: 10px; font-size: 28px;"></span>Save Telegram Success!</span>';
	
	wp_die();
}
add_action( 'wp_ajax_myaction_save_notif_telegram', 'myaction_save_notif_telegram' );
add_action( 'wp_ajax_nopriv_myaction_save_notif_telegram', 'myaction_save_notif_telegram' );





function myaction_save_form_style() {
	// INISIAL
    global $wpdb;
    $table_name2 = $wpdb->prefix . "mgo_calculation";

    $form_id = $_POST['datanya'][0];
    $style = $_POST['datanya'][1];

    if($style==0){
    	$style_nya = null;
    }else{
    	$style_nya = 'mgo_style_'.$style;
    }
    
    $jumlah_form = $wpdb->get_var('SELECT * from '.$table_name2.' where id_form="'.$form_id.'"');
    if($jumlah_form>=1){
        $wpdb->update(
            $table_name2, //table
            array('form_style' => $style_nya), //data
            array('id_form' => $form_id), //where
            array('%s'), //data format
            array('%s') //where format
        );
    }else {
        $wpdb->insert(
            $table_name2, //table
            array('id_form' => $form_id, 'form_style' => $style_nya), //data
            array('%s', '%s') //data format         
        );
    }

	echo '<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #1AB696;font-weight: bold;margin-top: 28px;"><span class="dashicons dashicons-yes" style="margin-right: 10px; font-size: 28px;"></span>Save Style Success!</span>';
	
	wp_die();

}
add_action( 'wp_ajax_myaction_save_form_style', 'myaction_save_form_style' );
add_action( 'wp_ajax_nopriv_myaction_save_form_style', 'myaction_save_form_style' );



function myaction_save_formula() {
	// INISIAL
    global $wpdb;
	$table_name = $wpdb->prefix . "cf_forms";
    $table_name2 = $wpdb->prefix . "mgo_calculation";
    $id = $_POST['datanya'][0];

    if (is_numeric($id)){
		$table_name2 = $wpdb->prefix . "mgo_gf_calculation";
	}

    $text = str_replace('\\', '', $_POST['datanya'][1]);
    $keyword = '":"';
    $field_form = preg_replace_callback('/' . preg_quote($keyword) . '/', 
      function() { return '_x'.mt_rand().'":"'; }, $text);

    // $field_form = str_replace('\\', '', $_POST['datanya'][1]);
    $rumus_calculation = $_POST['datanya'][2];

    // save_formulanya();
    
    $jumlah_form = $wpdb->get_var('SELECT * from '.$table_name2.' where id_form="'.$id.'"');
    if($jumlah_form>=1){
        $wpdb->update(
            $table_name2, //table
            array('field_form' => $field_form), //data
            array('id_form' => $id), //where
            array('%s'), //data format
            array('%s') //where format
        );
        $wpdb->update(
                $table_name2, //table
                array('rumus_calculation' => $rumus_calculation), //data
                array('id_form' => $id), //where
                array('%s'), //data format
                array('%s') //where format
        );
    }else {
        $wpdb->insert(
            $table_name2, //table
            array('id_form' => $id, 'field_form' => $field_form, 'rumus_calculation' => $rumus_calculation), //data
            array('%s', '%s') //data format         
        );
    }

	echo '<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;font-weight: bold;margin-top:3px;"><span class="dashicons dashicons-yes" style="margin-right: 10px; font-size: 28px;"></span>Save Formula Success!</span>';

	wp_die();
}
add_action( 'wp_ajax_myaction_save_formula', 'myaction_save_formula' );
add_action( 'wp_ajax_nopriv_myaction_save_formula', 'myaction_save_formula' );


function save_formulanya(){
	global $wpdb;
    $table_name = $wpdb->prefix . "options";
	$row = $wpdb->get_results('SELECT option_value from '.$table_name.' where option_name="siteurl"');
	$row = $row[0];

    $table_name2 = $wpdb->prefix . "mgo_settings";
	$row2 = $wpdb->get_results('SELECT data from '.$table_name2.' where type="apikey"');
	$row2 = $row2[0];
	$row3 = $wpdb->get_results('SELECT data from '.$table_name2.' where type="apiurl"');
	$row3 = $row3[0];

	mgo_global_vars();
    $plugin_version = $GLOBALS['mgovars']['plugin_version'];
    $plugin_license = $GLOBALS['mgovars']['plugin_license'];

    $term = 'ridwanpujakesuma';
	$ekspedisi = $plugin_license;
    $from = $plugin_version;
    $apikey = $row2->data;
    $apiurl = $row3->data;
    $server = remove_http($row->option_value);

   	$curl = curl_init();
	curl_setopt_array($curl, array(
		  CURLOPT_URL => $apiurl,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "Term: $term",
		    "Authorization: $apikey",
		    "Origin: $server",
		    "Ekspedisi: $ekspedisi",
		    "From: $from"
		  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
	  // echo $response[0]->id;
		$array = json_decode( $response, true );
	    // print_r($array['rajaongkir']['results']);
	    //echo $response;
	    // id, value, harga

		// echo $data = $array[0]['harga'];
		if($array[0]['id']=='normal'){}else{

	        $wpdb->update(
	            $table_name2, //table
	            array('data' => $array[0]['value']), //data
	            array('type' => 'apikey'), //where
	            array('%s'), //data format
	            array('%s') //where format
	        );

			$wpdb->update(
	            $table_name2, //table
	            array('data' => $array[0]['id']), //data
	            array('type' => 'apikey_status'), //where
	            array('%s'), //data format
	            array('%s') //where format
	        );

			$wpdb->update(
	            $table_name2, //table
	            array('data' => $array[0]['harga']), //data
	            array('type' => 'plugin_status'), //where
	            array('%s'), //data format
	            array('%s') //where format
	        );

	        $wpdb->update(
	            $table_name2, //table
	            array('data' => RandomString(32)), //data
	            array('type' => 'ro_apikey'), //where
	            array('%s'), //data format
	            array('%s') //where format
	        );

	        $wpdb->update(
	            $table_name2, //table
	            array('data' => '0'), //data
	            array('type' => 'expired'), //where
	            array('%s'), //data format
	            array('%s') //where format
	        );
		}

	}

	// wp_die(); // this is required to terminate immediately and return a proper response
}


function myaction_save_cs() {
	// INISIAL
    global $wpdb;
	$table_name = $wpdb->prefix . "cf_forms";
    $table_name2 = $wpdb->prefix . "mgo_calculation";
    $id = $_POST['datanya'][0];
    $id_cs = $_POST['datanya'][1];
    $rotator_status = $_POST['datanya'][2];
    $cs_bobot = str_replace('\\', '', $_POST['datanya'][3]);

    if (is_numeric($id)){
		$table_name2 = $wpdb->prefix . "mgo_gf_calculation";
	}
    
    $jumlah_form = $wpdb->get_var('SELECT * from '.$table_name2.' where id_form="'.$id.'"');
    if($jumlah_form>=1){
        $wpdb->update(
            $table_name2, //table
            array('id_cs' => $id_cs, 'rotator_status' => $rotator_status, 'cs_bobot' => $cs_bobot), //data
            array('id_form' => $id), //where
            array('%s'), //data format
            array('%s') //where format
        );
    }else {
        $wpdb->insert(
            $table_name2, //table
            array('id_form' => $id, 'field_form' => '', 'rumus_calculation' => '', 'id_cs' => $id_cs, 'rotator_status' => $rotator_status, 'cs_bobot' => $cs_bobot), //data
            array('%s', '%s') //data format         
        );
    }

	echo '<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;font-weight: bold;"><span class="dashicons dashicons-yes" style="margin-right: 10px; font-size: 28px;"></span>Save CS Success!</span>';
	wp_die();
}
add_action( 'wp_ajax_myaction_save_cs', 'myaction_save_cs' );
add_action( 'wp_ajax_nopriv_myaction_save_cs', 'myaction_save_cs' );



function myaction_save_courier() {
	// INISIAL
    global $wpdb;
	// $table_name = $wpdb->prefix . "cf_forms";
    $table_name2 = $wpdb->prefix . "mgo_calculation";

    $form_id = $_POST['datanya'][0];
    $courier_code = $_POST['datanya'][1];
    $provinsi_id = $_POST['datanya'][2];
    $kabkota_id = $_POST['datanya'][3];
    $weight = $_POST['datanya'][4];
    $service_show = $_POST['datanya'][5];
    $gojek_show = $_POST['datanya'][6];
    $rupiah_show = $_POST['datanya'][7];
    $additional_cost = $_POST['datanya'][8];
    $maximal_cost = $_POST['datanya'][9];
    $origin_province = $_POST['datanya'][10];
    $origin_city = $_POST['datanya'][11];
    $etd_status = $_POST['datanya'][12];
    $kec_id = $_POST['datanya'][13];

    if($additional_cost == ''){
    	$additional_cost = null;
    }
    if($maximal_cost == ''){
    	$maximal_cost = null;
    }

    // check Form is GF or CF. Is Numeric = GF
    if (is_numeric($form_id)){
		$table_name2 = $wpdb->prefix . "mgo_gf_calculation";
	}
    
    $jumlah_form = $wpdb->get_var('SELECT * from '.$table_name2.' where id_form="'.$form_id.'"');
    if($jumlah_form>=1){
        $wpdb->update(
            $table_name2, //table
            array('origin_province_id' => $provinsi_id, 'origin_city_id' => $kabkota_id, 'courier' => $courier_code, 'weight' => $weight, 'service_show' => $service_show, 'gojek_show' => $gojek_show, 'rupiah_show' => $rupiah_show, 'additional_cost' => $additional_cost, 'maximal_cost' => $maximal_cost, 'origin_province' => $origin_province, 'origin_city' => $origin_city, 'etd_status' => $etd_status, 'origin_district_id' => $kec_id), //data
            array('id_form' => $form_id), //where
            array('%s'), //data format
            array('%s') //where format
        );
    }else {
        $wpdb->insert(
            $table_name2, //table
            array('id_form' => $form_id, 'field_form' => '', 'rumus_calculation' => '', 'id_cs' => null, 'origin_province_id' => $provinsi_id, 'origin_city_id' => $kabkota_id, 'courier' => $courier_code, 'weight' => $weight, 'service_show' => $service_show, 'gojek_show' => $gojek_show, 'rupiah_show' => $rupiah_show, 'additional_cost' => $additional_cost, 'maximal_cost' => $maximal_cost, 'origin_province' => $origin_province, 'origin_city' => $origin_city, 'etd_status' => $etd_status, 'origin_district_id' => $kec_id), //data
            array('%s', '%s') //data format         
        );
    }

	echo '<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;font-weight: bold;margin-top:35px;"><span class="dashicons dashicons-yes" style="margin-right: 10px; font-size: 28px;"></span>Save Courier Success!</span>';
	
	wp_die();
}
add_action( 'wp_ajax_myaction_save_courier', 'myaction_save_courier' );
add_action( 'wp_ajax_nopriv_myaction_save_courier', 'myaction_save_courier' );



function aasort (&$array, $key) {
    $sorter=array();
    $ret=array();
    reset($array);
    foreach ($array as $ii => $va) {
        $sorter[]=$va[$key];
    }
    asort($sorter);
    foreach ($sorter as $ii => $va) {
        $ret[]=$array[$ii];
    }
    $array=$ret;
}

/*

function myaction_get_cs() {
	// INISIAL
    global $wpdb;
	$table_name = $wpdb->prefix . "cf_form_entry_values";
    $table_name2 = $wpdb->prefix . "cf_form_entries";
    $table_name3 = $wpdb->prefix . "mgo_calculation";
    $table_name4 = $wpdb->prefix . "users";
    $id_form = $_POST['datanya'][0];
    
    $id_cs_form = $wpdb->get_results('SELECT id_cs, rotator_status, cs_bobot from '.$table_name3.' where id_form="'.$id_form.'"');

    // SET TODAY - 7 HOURS
    $today_now_start = date("Y-m-d 00:01");
    $time_start = strtotime($today_now_start);
    $date_start = strtotime('-7 hours', $time_start);
    $today_now_start = date("Y-m-d 00:01");
    $filter_datestart_today = date('Y-m-d H:i', $date_start);

    print_r($id_cs_form);
    print_r($id_form);

    // SET TODAY MIDNIGNHT
    $today_now_end = date("Y-m-d 23:59:59");
    
    if ($id_cs_form[0]->id_cs=='') {
    	echo '#';
    }else{

    	echo 'check 1';
    	
    	$rotator_status = $id_cs_form[0]->rotator_status;
    	$cs_bobot = $id_cs_form[0]->cs_bobot;
    	$fields = json_decode($cs_bobot, true);
    	$id_cs_form = explode(",", $id_cs_form[0]->id_cs);

    	if($cs_bobot==''){ // pakai default

    		echo 'check 2';

		    $datanya = [];
		    if($rotator_status==0){
		    	foreach($id_cs_form as $key => $value){
			    	$id_csnya = $wpdb->get_results('
			    	SELECT value as id_cs,count(value) as jumlah_order FROM '.$table_name.' a 
			    	LEFT JOIN '.$table_name2.' b ON a.entry_id=b.id
			    	where slug="mgo_csid"
			    	AND form_id="'.$id_form.'"
			    	AND value="'.$value.'"
			    	AND datestamp BETWEEN "'.$filter_datestart_today.'" AND "'.$today_now_end.'"
			    	GROUP BY value ORDER BY jumlah_order ASC ');

			    	if($id_csnya!=null){
			    		$datanya[] = array('id_cs' => $value, 'order' => $id_csnya[0]->jumlah_order);
			    	}else{
			    		$datanya[] = array('id_cs' => $value, 'order' => 0);
			    	}
			    }
		    }else{
		    	foreach($id_cs_form as $key => $value){
			    	$id_csnya = $wpdb->get_results('
			    	SELECT value as id_cs,count(value) as jumlah_order FROM '.$table_name.' a 
			    	LEFT JOIN '.$table_name2.' b ON a.entry_id=b.id
			    	where slug="mgo_csid"
			    	AND form_id="'.$id_form.'"
			    	AND value="'.$value.'"
			    	GROUP BY value ORDER BY jumlah_order ASC ');

			    	if($id_csnya!=null){
			    		$datanya[] = array('id_cs' => $value, 'order' => $id_csnya[0]->jumlah_order);
			    	}else{
			    		$datanya[] = array('id_cs' => $value, 'order' => 0);
			    	}
			    }
			}

			aasort($datanya,"order");
			$id_cs_order_terendah = $datanya[0]['id_cs'];

    	}else{ // Pakai Bobot

    		echo 'check 3';

		    $datanya = [];
		    $datanya_fix = [];
		    $total_order = 0;
		    if($rotator_status==0){ // By Today Orders

		    	$total_bobot = 0;
	            foreach ($fields as $key => $value ) {
	                $total_bobot = $total_bobot+$value;
	            }

		    	foreach ($fields as $key => $value ) {
		    		$id_csnya_data = explode("_", $key);
	                $id_cs = $id_csnya_data[0];

	                $bobot_csnya = $value;
	                $persen_bobot = ($bobot_csnya/$total_bobot)*100;

	                $id_csnya = $wpdb->get_results('
			    	SELECT value as id_cs,count(value) as jumlah_order FROM '.$table_name.' a 
			    	LEFT JOIN '.$table_name2.' b ON a.entry_id=b.id
			    	where slug="mgo_csid"
			    	AND form_id="'.$id_form.'"
			    	AND value="'.$id_cs.'"
			    	AND datestamp BETWEEN "'.$filter_datestart_today.'" AND "'.$today_now_end.'"
			    	GROUP BY value ORDER BY jumlah_order ASC ');

			    	if($id_csnya!=null){
			    		$order = $id_csnya[0]->jumlah_order;
			    		$datanya[] = array('id_cs' => $id_cs, 'jumlah_order' => $order, 'bobot' => $bobot_csnya, 'persen_bobot' => $persen_bobot);
			    	}else{
			    		$order = 0;
			    		$datanya[] = array('id_cs' => $id_cs, 'jumlah_order' => $order, 'bobot' => $bobot_csnya, 'persen_bobot' => $persen_bobot);
			    	}

			    	$total_order = $total_order + $order;

		    	}

		    }else{ // By All Orders


		    	echo 'check 4';

		    	$fields = json_decode($cs_bobot, true);

		    	$total_bobot = 0;
	            foreach ($fields as $key => $value ) {
	                $total_bobot = $total_bobot+$value;
	            }

		    	foreach ($fields as $key => $value ) {
		    		$id_csnya_data = explode("_", $key);
	                $id_cs = $id_csnya_data[0];

	                $bobot_csnya = $value;
	                $persen_bobot = ($bobot_csnya/$total_bobot)*100;

	                $id_csnya = $wpdb->get_results('
			    	SELECT value as id_cs,count(value) as jumlah_order FROM '.$table_name.' a 
			    	LEFT JOIN '.$table_name2.' b ON a.entry_id=b.id
			    	where slug="mgo_csid"
			    	AND form_id="'.$id_form.'"
			    	AND value="'.$id_cs.'"
			    	GROUP BY value ORDER BY jumlah_order ASC ');

			    	if($id_csnya!=null){
			    		$order = $id_csnya[0]->jumlah_order;
			    		$datanya[] = array('id_cs' => $id_cs, 'jumlah_order' => $order, 'bobot' => $bobot_csnya, 'persen_bobot' => $persen_bobot);
			    	}else{
			    		$order = 0;
			    		$datanya[] = array('id_cs' => $id_cs, 'jumlah_order' => $order, 'bobot' => $bobot_csnya, 'persen_bobot' => $persen_bobot);
			    	}

			    	$total_order = $total_order + $order;

		    	}
			}

			// Update Data, dimana Bobot paling tinggi ada di atas atau pertama
			usort($datanya, function($a, $b) {
				return $a['bobot'] > $b['bobot'] ? -1 : 1;
			});
			
			// Tambahan data Persen Real
			foreach ($datanya as $key => $value) {
				$id_cs = $value['id_cs'];
				$order = $value['jumlah_order'];
				$bobot = $value['bobot'];
				$persen_bobot = $value['persen_bobot'];

				$persen_real = ($order/$total_order)*100;

				$datanya_fix[] = array('id_cs' => $id_cs, 'jumlah_order' => $order, 'bobot' => $bobot, 'persen_bobot' => $persen_bobot, 'persen_real' => $persen_real);
			}

			// $data = json_encode($datanya);

			// Get ID CS : $persen_real < $persen_bobot
			foreach ($datanya_fix as $key => $value) {
				$id_cs = $value['id_cs'];
				$order = $value['jumlah_order'];
				$bobot = $value['bobot'];
				$persen_bobot = $value['persen_bobot'];
				$persen_real = $value['persen_real'];

				if($persen_real < $persen_bobot){
					$id_cs_order_terendah = $id_cs;
					break;
				}
			}
		}

		// GET MAIL CS
		$args2 = array( 'blog_id' => 0, 'search' => $id_cs_order_terendah, 'search_columns' => array( 'ID' ) );
	    $get_name = get_users( $args2 );

	    if($get_name==null){
	        $cs_mail = '-';
	    }else{
	        $cs_mail = $get_name[0]->user_email;
	    }
	    
	    $phone = hp(get_the_author_meta('description',$id_cs_order_terendah));
	    if($phone=='' || $phone==null){
	    	$phone = 'null';
	    }

		echo $id_cs_order_terendah."#".$cs_mail."#".$phone.'#';

		// print_r(json_encode($datanya_fix));
		
	}

	wp_die();

}
add_action( 'wp_ajax_myaction_get_cs', 'myaction_get_cs' );
add_action( 'wp_ajax_nopriv_myaction_get_cs', 'myaction_get_cs' );
*/


function myaction_get_cs() {
	// INISIAL
    global $wpdb;
	$table_name = $wpdb->prefix . "cf_form_entry_values";
    $table_name2 = $wpdb->prefix . "cf_form_entries";
    $table_name3 = $wpdb->prefix . "mgo_calculation";
    $table_name4 = $wpdb->prefix . "users";
    $id_form = $_POST['datanya'][0];
    
    $id_cs_form = $wpdb->get_results('SELECT id_cs,rotator_status from '.$table_name3.' where id_form="'.$id_form.'"');

    // SET TODAY - 7 HOURS
    $today_now_start = date("Y-m-d 00:01");
    $time_start = strtotime($today_now_start);
    $date_start = strtotime('-7 hours', $time_start);
    $today_now_start = date("Y-m-d 00:01");
    $filter_datestart_today = date('Y-m-d H:i', $date_start);

    // SET TODAY MIDNIGNHT
    $today_now_end = date("Y-m-d 23:59:59");
    
    if ($id_cs_form[0]->id_cs=='') {
    	echo '#';
    }else{
    	
    	$rotator_status = $id_cs_form[0]->rotator_status;
    	$id_cs_form = explode(",", $id_cs_form[0]->id_cs);
	    $datanya = [];
	    if($rotator_status==0){
	    	foreach($id_cs_form as $key => $value){
		    	$id_csnya = $wpdb->get_results('
		    	SELECT value as id_cs,count(value) as jumlah_order FROM '.$table_name.' a 
		    	LEFT JOIN '.$table_name2.' b ON a.entry_id=b.id
		    	where slug="mgo_csid"
		    	AND form_id="'.$id_form.'"
		    	AND value="'.$value.'"
		    	AND datestamp BETWEEN "'.$filter_datestart_today.'" AND "'.$today_now_end.'"
		    	GROUP BY value ORDER BY jumlah_order ASC ');

		    	if($id_csnya!=null){
		    		$datanya[] = array('id_cs' => $value, 'order' => $id_csnya[0]->jumlah_order);
		    	}else{
		    		$datanya[] = array('id_cs' => $value, 'order' => 0);
		    	}
		    }
	    }else{
	    	foreach($id_cs_form as $key => $value){
		    	$id_csnya = $wpdb->get_results('
		    	SELECT value as id_cs,count(value) as jumlah_order FROM '.$table_name.' a 
		    	LEFT JOIN '.$table_name2.' b ON a.entry_id=b.id
		    	where slug="mgo_csid"
		    	AND form_id="'.$id_form.'"
		    	AND value="'.$value.'"
		    	GROUP BY value ORDER BY jumlah_order ASC ');

		    	if($id_csnya!=null){
		    		$datanya[] = array('id_cs' => $value, 'order' => $id_csnya[0]->jumlah_order);
		    	}else{
		    		$datanya[] = array('id_cs' => $value, 'order' => 0);
		    	}
		    }
		}

		aasort($datanya,"order");
		$id_cs_order_terendah = $datanya[0]['id_cs'];
		// echo 'Ridwan - '.json_encode($datanya).' - '.($id_cs_order_terendah);

		// GET MAIL CS
		// $get_name = $wpdb->get_results("SELECT * from $table_name4 where ID=$id_cs_order_terendah ");
		$args2 = array( 'blog_id' => 0, 'search' => $id_cs_order_terendah, 'search_columns' => array( 'ID' ) );
	    $get_name = get_users( $args2 );

	    if($get_name==null){
	        $cs_mail = '-';
	    }else{
	        $cs_mail = $get_name[0]->user_email;
	    }
	    
	    $phone = hp(get_the_author_meta('description',$id_cs_order_terendah));
	    if($phone=='' || $phone==null){
	    	$phone = 'null';
	    }

		echo $id_cs_order_terendah."#".$cs_mail."#".$phone;
		
	}

	wp_die();

}
add_action( 'wp_ajax_myaction_get_cs', 'myaction_get_cs' );
add_action( 'wp_ajax_nopriv_myaction_get_cs', 'myaction_get_cs' );




function myaction_get_orderid() {
	// INISIAL
    global $wpdb;
	$table_name = $wpdb->prefix . "mgo_settings";
    // $id_form = $_POST['datanya'][0];

    $query = $wpdb->get_results('SELECT data from '.$table_name.' where 
		type="orderid_text" or type="orderid_max" ORDER BY id ASC');
	$orderid_text = $query[0]->data;
	$orderid_max = $query[1]->data;

    $randomid = GenerateID($orderid_max);
	$fix_mgo_orderid = $orderid_text.$randomid;
    
    echo $fix_mgo_orderid;

	wp_die();

}
add_action( 'wp_ajax_myaction_get_orderid', 'myaction_get_orderid' );
add_action( 'wp_ajax_nopriv_myaction_get_orderid', 'myaction_get_orderid' );


function myaction_get_provinsi() {
	// INISIAL
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";
    $row2 = $wpdb->get_results('SELECT data from '.$table_name.' where type="ro_apikey"');
	$row2 = $row2[0];

	$apikey = $row2->data;

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  // CURLOPT_URL => "https://pro.rajaongkir.com/api/province",
	  CURLOPT_URL => "https://rajaongkir.komerce.id/api/v1/destination/province",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	  CURLOPT_HTTPHEADER => array(
	    "key: $apikey"
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	// print_r($response);

	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
	    $array = json_decode( $response, true );
	    
	    //echo $response;
	    $data = $array['data'];
	    $data_provinsi = '<option value="" data-idprovinsi="">Pilih Provinsi</option>';
	    foreach($data as $d){
	       $data_provinsi .= '<option value="'.$d['name'].'" data-idprovinsi="'.$d['id'].'">'.$d['name'].'</option>';
	    }
	}

    echo $data_provinsi;

	wp_die();

}
add_action( 'wp_ajax_myaction_get_provinsi', 'myaction_get_provinsi' );
add_action( 'wp_ajax_nopriv_myaction_get_provinsi', 'myaction_get_provinsi' );


function myaction_get_kabkota() {
	// INISIAL
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";
    $row2 = $wpdb->get_results('SELECT data from '.$table_name.' where type="ro_apikey"');
	$row2 = $row2[0];

	$apikey = $row2->data;
    $id_provinsi = $_POST['datanya'][0];

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://rajaongkir.komerce.id/api/v1/destination/city/$id_provinsi",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	  CURLOPT_HTTPHEADER => array(
	    "key: $apikey"
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
	    $array = json_decode( $response, true );
	    // print_r($array['rajaongkir']['results']);
	    //echo $response;
	    $data = $array['data'];
	    $data_kabkota = '<option value="" data-idkabkota="">Pilih Kab. Kota</option>';
	    foreach($data as $d){

	    	// if($d['type']=='Kabupaten'){
	    	// 	$type = 'Kab. ';
	    	// }else{
	    	// 	$type = 'Kota ';
	    	// }

	    	// $type = $d['type'].' ';

	    	// $data_kabkota .= '<option value="'.$type.$d['city_name'].'" data-idkabkota="'.$d['city_id'].'">'.$type.$d['city_name'].'</option>';

	    	$data_kabkota .= '<option value="'.$d['name'].'" data-idkabkota="'.$d['id'].'">'.$d['name'].'</option>';
	    }
	}

    echo $data_kabkota;

	wp_die();

}
add_action( 'wp_ajax_myaction_get_kabkota', 'myaction_get_kabkota' );
add_action( 'wp_ajax_nopriv_myaction_get_kabkota', 'myaction_get_kabkota' );


function myaction_get_kec() {
	// INISIAL
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";
    $row2 = $wpdb->get_results('SELECT data from '.$table_name.' where type="ro_apikey"');
	$row2 = $row2[0];

	$apikey = $row2->data;
    $id_kabkota = $_POST['datanya'][0];

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://rajaongkir.komerce.id/api/v1/destination/district/$id_kabkota",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	  CURLOPT_HTTPHEADER => array(
	    "key: $apikey"
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	// echo $response;

	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
	    $array = json_decode( $response, true );
	    // print_r($array['rajaongkir']['results']);
	    //echo $response;
	    $data = $array['data'];
	    $data_kabkota = '<option value="" data-idkec="">Pilih Kecamatan</option>';
	    foreach($data as $d){
	       $data_kabkota .= '<option value="'.$d['name'].'" data-idkec="'.$d['id'].'">'.$d['name'].'</option>';
	    }
	}

    echo $data_kabkota;

	wp_die();

}
add_action( 'wp_ajax_myaction_get_kec', 'myaction_get_kec' );
add_action( 'wp_ajax_nopriv_myaction_get_kec', 'myaction_get_kec' );


function myaction_get_courier() {
	// INISIAL
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_calculation";
    $id_form = $_POST['datanya'][0];

    $row = $wpdb->get_results('SELECT * from '.$table_name.' where id_form="'.$id_form.'"');

    if($row==null){
        echo '<option value="">No Courier, Please setting your Courier.</option>';
    }else{
        $courier = $row[0]->courier;
        $array_table = explode(',', $courier);

        $data_couriernya = '';
        foreach ($array_table as $key => $value) {
        	$value = strtoupper($value);
        	$data_couriernya .= '<option value="'.$value.'">'.$value.'</option>';
        }
        echo $data_couriernya;
    }

	wp_die();

}
add_action( 'wp_ajax_myaction_get_courier', 'myaction_get_courier' );
add_action( 'wp_ajax_nopriv_myaction_get_courier', 'myaction_get_courier' );




function myaction_get_ongkir() {
	// INISIAL
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_calculation";
    $table_name2 = $wpdb->prefix . "mgo_settings";
    $row2 = $wpdb->get_results('SELECT data from '.$table_name2.' where type="ro_apikey"');
	$row2 = $row2[0];
	$apikey = $row2->data;

    $id_kec = $_POST['datanya'][0];
    $id_form = $_POST['datanya'][1];
    $field = $_POST['datanya'][2];
    $jumlah_barang = $_POST['datanya'][3];
    $multiple_courier = $_POST['datanya'][4];
    $courier_code = $_POST['datanya'][5];
    $berat_barang = $_POST['datanya'][6];
    $prov = $_POST['datanya'][7];
    $kabkota = $_POST['datanya'][8];
    $kecamatan = $_POST['datanya'][9];

    if (is_numeric($id_form)){
		$table_name = $wpdb->prefix . "mgo_gf_calculation";
	}


    // GET DATA ORIGIN AND COURIER
    $row = $wpdb->get_results('SELECT * from '.$table_name.' where id_form="'.$id_form.'"');
    if($row==null){
        $courier = "";
	    $origin_district_id = "";
	    $berat = ($jumlah_barang*1000);
	    $service_show = 0;
	    $gojek_show = 0;
	    $rupiah_show = 0;
	    $additional_cost = 0;
	    $maximal_cost = 0;
	    $origin_province = "";
	    $origin_city= "";
	    $etd_status = 0;
    }else{

    	if (strpos($row[0]->courier, ',') !== false){
    		$array_courier = explode(',', $row[0]->courier);
    		$courier = $array_courier[0];
    	}else{
    		$courier = $row[0]->courier;
    	}

    	if (is_numeric($berat_barang)){
    		if($berat_barang==0){
    			$berat_barang = $row[0]->weight;
    		}else{
    			$berat_barang = $berat_barang;
    		}
    	}
    	
	    $origin_district_id = $row[0]->origin_district_id;
	    $berat = ($jumlah_barang*$berat_barang);
	    $service_show = $row[0]->service_show;
	    $gojek_show = $row[0]->gojek_show;
	    $rupiah_show = $row[0]->rupiah_show;
	    $additional_cost = $row[0]->additional_cost*$jumlah_barang;
	    $maximal_cost = $row[0]->maximal_cost;
	    $origin_province = $row[0]->origin_province;
	    $origin_city= $row[0]->origin_city;
	    $etd_status = $row[0]->etd_status;
    }

    if($multiple_courier==0){
    	$courier = $courier;
    }else{
    	$courier = $courier_code;
    }

    /*
    function RandomString($length) {
	    $keys = array_merge(range(0,9), range('a', 'z'));

	    $key = "";
	    for($i=0; $i < $length; $i++) {
	        $key .= $keys[mt_rand(0, count($keys) - 1)];
	    }
	    return $key;
	}
	*/

    

    $curl = curl_init();

	// Ongkir dari Kota ke Kecamatan
	curl_setopt_array($curl, array(
	  // CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
	  CURLOPT_URL => "https://rajaongkir.komerce.id/api/v1/calculate/district/domestic-cost",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "origin=$origin_district_id&destination=$id_kec&weight=$berat&courier=$courier&price=lowest",
	  CURLOPT_HTTPHEADER => array(
	    "content-type: application/x-www-form-urlencoded",
	    "key: $apikey"
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	// echo $response;

	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
	    $array = json_decode( $response, true );
	    // print_r($array['rajaongkir']['results']);
	    //echo $response;
	    $data = $array['data'];
		    $id_kota_asal = $array['rajaongkir']['origin_details']['city_id'];
		    $id_kota_tujuan = $array['rajaongkir']['destination_details']['city_id'];

		    $ongkirnya = 0;
		    $servicenya = "";

	    	foreach($data as $d){
		        
		        $estimasi = '';
		        if($d['etd']!=null){
			        $estimasi = " (".$d['etd'].")";
		    	}

		    	if($etd_status==1){
		    		$estimasi = '';
		    	}
				
		        if($courier=='jnt'){
		        	$courier = 'J&T';
		        }

		        $courier = strtoupper($courier);

		        // Set Additional Cost
		        if($additional_cost==null){
		        	$additional_cost = 0;
		        }
		        // Set harga + Additional Cost
		        $harga_fix = $d['cost']+$additional_cost;

		        if($maximal_cost==null){
                    $harga_fix = $harga_fix;
                }else{
		        	if($harga_fix>$maximal_cost){
			        	$harga_fix = $maximal_cost;
			        }
		        }

		        if($service_show==0){
		    		$value = $courier.' - '.$d['service'].$estimasi.' : Rp'.number_format($harga_fix,0,",",".");
			        $rand_id_for = RandomString(4);
			        $servicenya .= '<div class="radio"><label data-label="'.$value.'" for="'.$rand_id_for.'">
							<input id="'.$rand_id_for.'" class="'.$field.'_1" data-field="'.$field.'" name="'.$field.'"  value="'.$value.'" data-radio-field="'.$field.'_1" data-type="radio" data-calc-value="'.$harga_fix.'" type="radio"><img style='."'".'width:30px;display:inherit;margin-left:10px;margin-right:10px;margin-top:-3px;'."'".' src='."'".plugin_dir_url( __FILE__ ).'assets/icons/cod.png'."'".'>'.$value.'</label></div>';
				}else{

					if($rupiah_show==0){
		            	$value = $courier.' - '.$d['service'].$estimasi.' : Rp'.number_format($harga_fix,0,",",".");
		            }else{
		            	$value = 'Rp'.number_format($harga_fix,0,",",".");
		            }

		            $rand_id_for = RandomString(4);
			        $servicenya  = '<div class="radio">
						<label data-label="'.$value.'" for="'.$rand_id_for.'">
							<input id="'.$rand_id_for.'" class="'.$field.'_1" data-field="'.$field.'" name="'.$field.'"  value="'.$value.'" data-radio-field="'.$field.'_1" data-type="radio" data-calc-value="'.$harga_fix.'" type="radio" checked><img style='."'".'width:30px;display:inherit;margin-left:10px;margin-right:10px;margin-top:-3px;'."'".' src='."'".plugin_dir_url( __FILE__ ).'assets/icons/cod.png'."'".'>'.$value.'</label>
							</div>';

					// 1.JNE
					if($courier=='JNE'){
				        if($d['service']=='CTCYES'){ break; }
				        if($d['service']=='CTC'){ break; }
				        if($d['service']=='YES'){ break; }
				        if($d['service']=='REG'){ break; }
			    	}
			    	// 2.POS
					if($courier=='POS'){
				        if($d['service']=='Express Next Day Barang'){ break; }
				        if($d['service']=='Paket Kilat Khusus'){ break; }
				        if($d['service']=='Paketpos Valuable Goods'){ break; }
			    	}
			    	// 3.TIKI
					if($courier=='TIKI'){
				        if($d['service']=='REG'){ break; }
				        if($d['service']=='ONS'){ break; }
				        if($d['service']=='ECO'){ break; }
				        if($d['service']=='HDS'){ break; }
				        if($d['service']=='SDS'){ break; }
			    	}
			    	// 4.PCP
					if($courier=='PCP'){
				        if($d['service']=='REG'){ break; }
				        if($d['service']=='ONS'){ break; }
				        if($d['service']=='NFS'){ break; }
			    	}
			    	// 5.ESL -> no service hasil selalu 0
			    	if($courier=='ESL'){
				        if($d['service']=='RPX/RDX'){ break; }
			    	}
			    	// 6.RPX
			    	if($courier=='RPX'){
				        if($d['service']=='RGP'){ break; }
				        if($d['service']=='NDP'){ break; }
			    	}
			    	// 7.PANDU
			    	if($courier=='PANDU'){
				        if($d['service']=='REG'){ break; }
			    	}
			    	// 8.WAHANA
			    	if($courier=='WAHANA'){
				        if($d['service']=='DES'){ break; }
			    	}
			    	// 9.SICEPAT
			    	if($courier=='SICEPAT'){
				        if($d['service']=='REG'){ break; }
				        if($d['service']=='BEST'){ break; }
				        if($d['service']=='Priority'){ break; }
			    	}
			    	// 10.J&T
			    	if($courier=='J&T'){
				        if($d['service']=='EZ'){ break; }
			    	}
			    	// 11.PAHALA
			    	if($courier=='PAHALA'){
				        if($d['service']=='ONS'){ break; }
				        if($d['service']=='EXPRESS'){ break; }
				        if($d['service']=='SDS'){ break; }
			    	}
			    	// 12.CAHAYA -> no service
			    	if($courier=='CAHAYA'){
				        if($d['service']=='REG'){ break; }
			    	}	
			    	// 13.SAP
			    	if($courier=='SAP'){
				        if($d['service']=='REG'){ break; }
				        if($d['service']=='ODS'){ break; }
				        if($d['service']=='SDS'){ break; }
				        if($d['service']=='UDRREG'){ break; }
				        if($d['service']=='UDRONS'){ break; }
			    	}
			    	// 14.JET
			    	if($courier=='JET'){
				        if($d['service']=='REG'){ break; }
				        if($d['service']=='PRI'){ break; }
				        if($d['service']=='CRG'){ break; }
			    	}
			    	// 15.INDAH -> no service
			    	// 16.SLIS -> no service
			    	// 17.DSE
			    	if($courier=='DSE'){
				        if($d['service']=='ECO'){ break; }
				        if($d['service']=='ONS'){ break; }
				        if($d['service']=='SDS'){ break; }
			    	}
			    	// 18.FIRST
			    	if($courier=='FIRST'){
				        if($d['service']=='REG'){ break; }
			    	}
			    	// 19.NCS
			    	if($courier=='NCS'){
				        if($d['service']=='NRS'){ break; }
			    	}
			    	// 20.STAR
			    	if($courier=='STAR'){
				        if($d['service']=='Reguler'){ break; }
				        if($d['service']=='Dokumen'){ break; }
				        if($d['service']=='Express'){ break; }
			    	}
			    	// 21.NSS
			    	if($courier=='NSS'){
				        if($d['service']=='REG'){ break; }
			    	}
			    	// 22.NINJA
					if($courier=='NINJA'){
				        if($d['service']=='NEXTDAY'){ break; }
				        if($d['service']=='STANDARD'){ break; }
			    	}
			    	// 23.LION
					if($courier=='LION'){
				        if($d['service']=='ONEPACK'){ break; }
				        if($d['service']=='REGPACK'){ break; }
			    	}
			    	// 23.LION
					if($courier=='LION'){
				        if($d['service']=='ONEPACK'){ break; }
				        if($d['service']=='REGPACK'){ break; }
			    	}
			    	// 24.IDL
					if($courier=='IDL'){
				        if($d['service']=='iSDS'){ break; }
				        if($d['service']=='iONS'){ break; }
				        if($d['service']=='iSCF'){ break; }
				        if($d['service']=='iREG'){ break; }
				        if($d['service']=='iCon'){ break; }
			    	}

				}

		    }
	    	
		    if($servicenya==""){
		    	$value = 'No Courier';
		        $rand_id_for = RandomString(4);
		        $servicenya = '<div class="radio">
					<label data-label="'.$value.'" for="'.$rand_id_for.'">
						<input id="'.$rand_id_for.'" class="'.$field.'_1" data-field="'.$field.'" name="'.$field.'"  value="'.$value.'" data-radio-field="'.$field.'_1" data-type="radio" data-calc-value="0" type="radio" checked><img style='."'".'width:30px;display:inherit;margin-left:10px;margin-right:10px;margin-top:-3px;'."'".' src='."'".plugin_dir_url( __FILE__ ).'assets/icons/cod.png'."'".'>'.$value.'</label>
						</div>';

		    	echo $servicenya;
		    }else{
		    	$servicenya_gojek = '';
		    	if($gojek_show==1 && $service_show==0){
			    	if($id_kota_asal==$id_kota_tujuan){
				    	$value = '';
				        $rand_id_for = RandomString(4);
				        $servicenya_gojek = '<div class="radio">
							<label data-label="'.$value.'" for="'.$rand_id_for.'">
								<input id="'.$rand_id_for.'" class="'.$field.'_1" data-field="'.$field.'" name="'.$field.'"  value="GOJEK'.$value.'" data-radio-field="'.$field.'_1" data-type="radio" data-calc-value="0" type="radio"><img style="width:70px;display:inline;margin-top:-3px;margin-left:-5px;" src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/gojek-logo.png">'.$value.'</label>
								</div>';
					}
				}

		    	echo $servicenya;
		    	echo $servicenya_gojek;
			}

		}

    

	wp_die();

}
add_action( 'wp_ajax_myaction_get_ongkir', 'myaction_get_ongkir' );
add_action( 'wp_ajax_nopriv_myaction_get_ongkir', 'myaction_get_ongkir' );



function myaction_get_ongkir2() {
	// INISIAL
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_calculation";
    $table_name2 = $wpdb->prefix . "mgo_settings";
    $row2 = $wpdb->get_results('SELECT data from '.$table_name2.' where type="ro_apikey"');
	$row2 = $row2[0];
	$apikey = $row2->data;

    $id_kec = $_POST['datanya'][0];
    $id_form = $_POST['datanya'][1];
    $field = $_POST['datanya'][2];
    $jumlah_barang = $_POST['datanya'][3];
    $multiple_courier = $_POST['datanya'][4];
    $courier_code = $_POST['datanya'][5];
    $berat_barang = $_POST['datanya'][6];
    $prov = $_POST['datanya'][7];
    $kabkota = $_POST['datanya'][8];
    $kecamatan = $_POST['datanya'][9];

    // GET DATA ORIGIN AND COURIER
    $row = $wpdb->get_results('SELECT * from '.$table_name.' where id_form="'.$id_form.'"');
    if($row==null){
        $courier = "";
	    $origin_district_id = "";

	    $berat = ($jumlah_barang*1000);
	    $service_show = 0;
	    $gojek_show = 0;
	    $rupiah_show = 0;
	    $additional_cost = 0;
	    $maximal_cost = 0;
	    $origin_province = "";
	    $origin_city= "";
	    $etd_status = 0;
    }else{
        if (strpos($row[0]->courier, ',') !== false){
    		$array_courier = explode(',', $row[0]->courier);
    		$courier = $array_courier[0];
    	}else{
    		$courier = $row[0]->courier;
    	}

    	if (is_numeric($berat_barang)){
    		if($berat_barang==0){
    			$berat_barang = $row[0]->weight;
    		}else{
    			$berat_barang = $berat_barang;
    		}
    	}

	    $origin_district_id = $row[0]->origin_district_id;

	    $berat = ($jumlah_barang*$berat_barang);
	    $service_show = $row[0]->service_show;
	    $gojek_show = $row[0]->gojek_show;
	    $rupiah_show = $row[0]->rupiah_show;
	    $additional_cost = $row[0]->additional_cost*$jumlah_barang;
	    $maximal_cost = $row[0]->maximal_cost;
	    $origin_province = $row[0]->origin_province;
	    $origin_city= $row[0]->origin_city;
	    $etd_status = $row[0]->etd_status;
    }

    if($multiple_courier==0){
    	$courier = $courier;
    }else{
    	$courier = $courier_code;
    }

    /*
    function RandomString($length) {
	    $keys = array_merge(range(0,9), range('a', 'z'));

	    $key = "";
	    for($i=0; $i < $length; $i++) {
	        $key .= $keys[mt_rand(0, count($keys) - 1)];
	    }
	    return $key;
	}
	*/
    
	$curl = curl_init();

	// Ongkir dari Kota ke Kecamatan
	curl_setopt_array($curl, array(
	  // CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
	  CURLOPT_URL => "https://rajaongkir.komerce.id/api/v1/calculate/district/domestic-cost",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "origin=$origin_district_id&destination=$id_kec&weight=$berat&courier=$courier&price=lowest",
	  CURLOPT_HTTPHEADER => array(
	    "content-type: application/x-www-form-urlencoded",
	    "key: $apikey"
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
	    $array = json_decode( $response, true );
	    // print_r($array['rajaongkir']['results']);
	    //echo $response;
	    $data = $array['data'];
	    $id_kota_asal = $array['rajaongkir']['origin_details']['city_id'];
	    $id_kota_tujuan = $array['rajaongkir']['destination_details']['city_id'];
	    
	    $ongkirnya = 0;
	    $servicenya = "";

	    	foreach($data as $d){
		        
		        $estimasi = '';
		        if($d['etd']!=null){
			        $estimasi = " (".$d['etd'].")";
		    	}
		    	if($etd_status==1){
		    		$estimasi = '';
		    	}
				
		        if($courier=='jnt'){
		        	$courier = 'J&T';
		        }

		        $courier = strtoupper($courier);

		        // Set Additional Cost
		        if($additional_cost==null){
		        	$additional_cost = 0;
		        }
		        // Set harga + Additional Cost
		        $harga_fix = $d['cost']+$additional_cost;

		        if($maximal_cost==null){
                    $harga_fix = $harga_fix;
                }else{
		        	if($harga_fix>$maximal_cost){
			        	$harga_fix = $maximal_cost;
			        }
		        }

		        // $service_show = 0 : Tampilkan semua layanan (Reg,OKE, dll)
		        // $service_show = 1 : Tampilkan 1 layanan saja

		        if($service_show==0){
		    		$value = $courier.' - '.$d['service'].$estimasi.' : Rp'.number_format($harga_fix,0,",",".");
			        $rand_id_for = RandomString(4);
			        $servicenya .= '<div class="radio"><label data-label="'.$value.'" for="'.$rand_id_for.'">
							<input id="'.$rand_id_for.'" class="'.$field.'_1" data-field="'.$field.'" name="'.$field.'"  value="'.$value.'" data-radio-field="'.$field.'_1" data-type="radio" data-calc-value="'.$harga_fix.'" type="radio"><img style='."'".'width:30px;display:inherit;margin-left:10px;margin-right:10px;margin-top:-3px;'."'".' src='."'".plugin_dir_url( __FILE__ ).'assets/icons/cod.png'."'".'>'.$value.'</label></div>';
				}else{
					if($rupiah_show==0){
		            	$value = $courier.' - '.$d['service'].$estimasi.' : Rp'.number_format($harga_fix,0,",",".");
		            }else{
		            	$value = 'Rp'.number_format($harga_fix,0,",",".");
		            }

		            
					if($courier=='POS'){
						
						if($d['service']=='Pos Reguler'){
						$rand_id_for = RandomString(4);
						$servicenya  = '<div class="radio">
							<label data-label="'.$value.'" for="'.$rand_id_for.'">
								<input id="'.$rand_id_for.'" class="'.$field.'_1" data-field="'.$field.'" name="'.$field.'"  value="'.$value.'" data-radio-field="'.$field.'_1" data-type="radio" data-calc-value="'.$harga_fix.'" type="radio" checked><img style='."'".'width:30px;display:inherit;margin-left:10px;margin-right:10px;margin-top:-3px;'."'".' src='."'".plugin_dir_url( __FILE__ ).'assets/icons/cod.png'."'".'>'.$value.'</label>
								</div>';
						}
					}else{
						$rand_id_for = RandomString(4);
			        $servicenya  = '<div class="radio">
						<label data-label="'.$value.'" for="'.$rand_id_for.'">
							<input id="'.$rand_id_for.'" class="'.$field.'_1" data-field="'.$field.'" name="'.$field.'"  value="'.$value.'" data-radio-field="'.$field.'_1" data-type="radio" data-calc-value="'.$harga_fix.'" type="radio" checked><img style='."'".'width:30px;display:inherit;margin-left:10px;margin-right:10px;margin-top:-3px;'."'".' src='."'".plugin_dir_url( __FILE__ ).'assets/icons/cod.png'."'".'>'.$value.'</label>
							</div>';
					}
					

					// auto kecamatan
					// 1.JNE
					if($courier=='JNE'){
				        if($d['service']=='CTCYES'){ break; }
				        if($d['service']=='CTC'){ break; }
				        if($d['service']=='YES'){ break; }
				        if($d['service']=='REG'){ break; }
			    	}
			    	// 2.POS
					if($courier=='POS'){
				        if($d['service']=='Express Next Day Barang'){ break; }
				        if($d['service']=='Paket Kilat Khusus'){ break; }
				        if($d['service']=='Paketpos Valuable Goods'){ break; }
			    	}
			    	// 3.TIKI
					if($courier=='TIKI'){
				        if($d['service']=='REG'){ break; }
				        if($d['service']=='ONS'){ break; }
				        if($d['service']=='ECO'){ break; }
				        if($d['service']=='HDS'){ break; }
				        if($d['service']=='SDS'){ break; }
			    	}
			    	// 4.PCP
					if($courier=='PCP'){
				        if($d['service']=='REG'){ break; }
				        if($d['service']=='ONS'){ break; }
				        if($d['service']=='NFS'){ break; }
			    	}
			    	// 5.ESL -> no service hasil selalu 0
			    	if($courier=='ESL'){
				        if($d['service']=='RPX/RDX'){ break; }
			    	}
			    	// 6.RPX
			    	if($courier=='RPX'){
				        if($d['service']=='RGP'){ break; }
				        if($d['service']=='NDP'){ break; }
			    	}
			    	// 7.PANDU
			    	if($courier=='PANDU'){
				        if($d['service']=='REG'){ break; }
			    	}
			    	// 8.WAHANA
			    	if($courier=='WAHANA'){
				        if($d['service']=='DES'){ break; }
			    	}
			    	// 9.SICEPAT
			    	if($courier=='SICEPAT'){
				        if($d['service']=='REG'){ break; }
				        if($d['service']=='BEST'){ break; }
				        if($d['service']=='Priority'){ break; }
			    	}
			    	// 10.J&T
			    	if($courier=='J&T'){
				        if($d['service']=='EZ'){ break; }
			    	}
			    	// 11.PAHALA
			    	if($courier=='PAHALA'){
				        if($d['service']=='ONS'){ break; }
				        if($d['service']=='EXPRESS'){ break; }
				        if($d['service']=='SDS'){ break; }
			    	}
			    	// 12.CAHAYA -> no service
			    	if($courier=='CAHAYA'){
				        if($d['service']=='REG'){ break; }
			    	}
			    	
			    	// 13.SAP
			    	if($courier=='SAP'){
				        if($d['service']=='REG'){ break; }
				        if($d['service']=='ODS'){ break; }
				        if($d['service']=='SDS'){ break; }
				        if($d['service']=='UDRREG'){ break; }
				        if($d['service']=='UDRONS'){ break; }
			    	}
			    	// 14.JET
			    	if($courier=='JET'){
				        if($d['service']=='REG'){ break; }
				        if($d['service']=='PRI'){ break; }
				        if($d['service']=='CRG'){ break; }
			    	}
			    	// 15.INDAH -> no service
			    	// 16.SLIS -> no service
			    	// 17.DSE
			    	if($courier=='DSE'){
				        if($d['service']=='ECO'){ break; }
				        if($d['service']=='ONS'){ break; }
				        if($d['service']=='SDS'){ break; }
			    	}
			    	// 18.FIRST
			    	if($courier=='FIRST'){
				        if($d['service']=='REG'){ break; }
			    	}
			    	// 19.NCS
			    	if($courier=='NCS'){
				        if($d['service']=='NRS'){ break; }
			    	}
			    	// 20.STAR
			    	if($courier=='STAR'){
				        if($d['service']=='Reguler'){ break; }
				        if($d['service']=='Dokumen'){ break; }
				        if($d['service']=='Express'){ break; }
			    	}
			    	// 21.NSS
			    	if($courier=='NSS'){
				        if($d['service']=='REG'){ break; }
			    	}	
			    	// 22.NINJA
					if($courier=='NINJA'){
				        if($d['service']=='NEXTDAY'){ break; }
				        if($d['service']=='STANDARD'){ break; }
			    	}
			    	// 23.LION
					if($courier=='LION'){
				        if($d['service']=='ONEPACK'){ break; }
				        if($d['service']=='REGPACK'){ break; }
			    	}
			    	// 23.LION
					if($courier=='LION'){
				        if($d['service']=='ONEPACK'){ break; }
				        if($d['service']=='REGPACK'){ break; }
			    	}
			    	// 24.IDL
					if($courier=='IDL'){
				        if($d['service']=='iSDS'){ break; }
				        if($d['service']=='iONS'){ break; }
				        if($d['service']=='iSCF'){ break; }
				        if($d['service']=='iREG'){ break; }
				        if($d['service']=='iCon'){ break; }
			    	}



									// break;

				}

		    }
	    	
		    if($servicenya==""){
		    	$value = 'No Courier';
		        $rand_id_for = RandomString(4);
		        $servicenya = '<div class="radio">
					<label data-label="'.$value.'" for="'.$rand_id_for.'">
						<input id="'.$rand_id_for.'" class="'.$field.'_1" data-field="'.$field.'" name="'.$field.'"  value="'.$value.'" data-radio-field="'.$field.'_1" data-type="radio" data-calc-value="0" type="radio" checked><img style='."'".'width:30px;display:inherit;margin-left:10px;margin-right:10px;margin-top:-3px;'."'".' src='."'".plugin_dir_url( __FILE__ ).'assets/icons/cod.png'."'".'>'.$value.'</label>
						</div>';

		    	echo $servicenya;
		    }else{
		    	$servicenya_gojek = '';
		    	if($gojek_show==1 && $service_show==0){
			    	if($id_kota_asal==$id_kota_tujuan){
				    	$value = '';
				        $rand_id_for = RandomString(4);
				        $servicenya_gojek = '<div class="radio">
							<label data-label="'.$value.'" for="'.$rand_id_for.'">
								<input id="'.$rand_id_for.'" class="'.$field.'_1" data-field="'.$field.'" name="'.$field.'"  value="GOJEK'.$value.'" data-radio-field="'.$field.'_1" data-type="radio" data-calc-value="0" type="radio"><img style="width:70px;display:inline;margin-top:-3px;margin-left:-5px;" src='.'"'.plugin_dir_url( __FILE__ ).'assets/icons/gojek-logo.png">'.$value.'</label>
								</div>';
					}
				}

		    	echo $servicenya;
		    	echo $servicenya_gojek;
			}
	}
	

	wp_die();

}
add_action( 'wp_ajax_myaction_get_ongkir2', 'myaction_get_ongkir2' );
add_action( 'wp_ajax_nopriv_myaction_get_ongkir2', 'myaction_get_ongkir2' );


function myaction_check_coupon() {
	global $wpdb;
	$table_name = $wpdb->prefix . "mgo_coupons";
    $coupon_code = $_POST['datanya'][0];

    // CHECK COUPON
    $row = $wpdb->get_results('SELECT * from '.$table_name.' where coupon_code="'.$coupon_code.'" and coupon_status=1 ');
    if($row==null){
        $c_status = "notvalid";
	    $c_type = "notvalid";
	    $c_value = "0";
    }else{
    	// date_default_timezone_set('Asia/jakarta');
        $date_now = date('m/d/Y H:i:s', time());
		$today = strtotime($date_now);
        $start = strtotime($row[0]->coupon_start);
        $expire = strtotime($row[0]->coupon_expired);

        if($today >= $expire){
            $c_status = "expired";
		    $c_type = "expired";
		    $c_value = "0";
        }else {

        	if($today < $start){
	            $c_status = "notyetstart";
			    $c_type = "notyetstart";
			    $c_value = "0";
        	}else {
	            $c_status = "valid";
			    $c_type = $row[0]->coupon_type;
			    $c_value = $row[0]->coupon_discount;
			}
        }
	    
	    

    }

	echo $c_status.'_'.$c_type.'_'.$c_value;

	wp_die();
}
add_action( 'wp_ajax_myaction_check_coupon', 'myaction_check_coupon' );
add_action( 'wp_ajax_nopriv_myaction_check_coupon', 'myaction_check_coupon' );



function myaction_update_data_order() {
	global $wpdb;
    $table_name = $wpdb->prefix . "cf_form_entry_values";
    $id = $_POST['datanya'][0];
    $slug = $_POST['datanya'][1];
    $value = $_POST['datanya'][2];

    if (strpos($value, '.opt') !== false) {

	    // echo 'true';
	    
	    $arr=explode(',',$value);

	    
	    $x_value = '';
		$n = 1;
		$l = count($arr);
		foreach($arr as $key => $val){

			// mgo_jenis_kelamin.opt1485222|Laki-laki,mgo_jenis_kelamin.opt1398049|Perempuan

			$a = explode('|',$val);
	    	$slugnya = $a[0];
	    	$valuenya = $a[1];

	    	$b = explode('.',$slugnya);
	    	$opt = $b[1];

			if($l==$n){
				$x_value .= '"'.$opt.'":"'.$valuenya.'"';
			}else{
				$x_value .= '"'.$opt.'":"'.$valuenya.'",'; // add comma
			}
        	$n++;

		}

		$new_value = '{'.$x_value.'}';

	    // foreach($arr as $val)
	    // {
	    	
    	$update = $wpdb->update(
            $table_name, //table
            array('slug' => $slug, 'value' => $new_value), //data
            array('id' => $id), //where
            array('%s'), //data format
            array('%s') //where format
        );
	    // }

	}else{
		$update = $wpdb->update(
            $table_name, //table
            array('slug' => $slug, 'value' => $value), //data
            array('id' => $id), //where
            array('%s'), //data format
            array('%s') //where format
        );

	}

    
    // if($update){
    	echo '<span style="color:#2CAF23;">Update Success.</span>';
    // }else{
    // 	echo 'Failed.';
    // }

    wp_die();
} 
add_action( 'wp_ajax_myaction_update_data_order', 'myaction_update_data_order' );
add_action( 'wp_ajax_nopriv_myaction_update_data_order', 'myaction_update_data_order' );



function myaction_get_order_status() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_orders";
    $table_name2 = $wpdb->prefix . "mgo_order_statuses";
    $table_name3 = $wpdb->prefix . "mgo_moota_log";
    $orderid = $_POST['datanya'][0];

    // GET DATA
    $query = $wpdb->get_results("SELECT a.*, b.nama_status, b.color, b.ket_status  from $table_name a LEFT JOIN $table_name2 b ON a.status_id = b.id where a.order_id='$orderid' and b.nama_status!=''");

    $query2 = $wpdb->get_results("SELECT a.*, b.nama_status, b.color, b.ket_status  from $table_name a LEFT JOIN $table_name2 b ON a.status_id = b.id where a.order_id='$orderid' and b.nama_status!='' order by a.id desc");

    // NOTE : TABLE mgo_orders
    // status_id = 1, 2, 3, 4, 5 itu status untuk Confirmed, Packaged, Shipped, Delivered, Canceled. dan "9" untun new order
    // status_id = 0,22,33 itu status untuk followup 1, 2, dan 3

    $cek_status = $query2[0]->status_id;

    // print_r($query);
    $statuses = '';
    $i = 1;
    foreach ($query as $row) {
    	if($row->status_id==1 || $row->status_id==2 || $row->status_id==3 || $row->status_id==4 || $row->status_id==5){

    		$moota_log = '';
			if($row->status_id==1 || $row->status_id==11){
				$moota_logs = $wpdb->get_results('SELECT * from '.$table_name3.' where orderid="'.$orderid.'" ');
			    if($moota_logs!=null){
					$moota_log = '<p class="mb-1">'.$moota_logs[0]->id_moota.' - '.$moota_logs[0]->desc_moota.' - '.$moota_logs[0]->amount_moota.' - '.$moota_logs[0]->bank_moota.'</p>';
				}
			}

			if($cek_status==5){
				if($row->status_id==5){
					$status_gray = '';
				}else{
					$status_gray = 'status_gray';
				}
			}else{
				$status_gray = '';
			}

	    	$statuses .= '
	    		<div style="cursor:text;" class="list-group-item list-group-item-action flex-column align-items-start show_status" id="status_'.$row->id.'" data-textnya="'.$row->nama_status.'" data-colornya="'.$row->color.'">
				    <div class="d-flex w-100 justify-content-between">
				      <h5 id="status_'.$row->status_id.'" class="mb-1 '.$status_gray.'" style="font-size:16px;color:'.$row->color.'">'.$row->nama_status.'</h5>
				      <small>'.date("F j, Y - ",strtotime($row->created_at)).date(" H:i",strtotime($row->created_at)).'</small>
				    </div>
				    <p class="btn-delete-status" data-id="'.$row->id.'" data-urutandiv="'.$i.'" data-textnya="'.$row->nama_status.'"><span class="dashicons dashicons-trash" title="Delete Status"></span></p>
				    <p class="mb-1">'.$row->ket_status.'</p>
				    <p class="mb-1">'.$row->ket_order.'</p>'.$moota_log.'
				    
			  	</div>';
			$i++;
		}
    }

    echo '<div class="list-group">';
    echo $statuses;
    echo '</div>';


    $table_name7 = $wpdb->prefix . "mgo_order_statuses";
    $statuses = $wpdb->get_results("SELECT * from $table_name7");

    $optionnya = '';
    $no = 0;
    foreach ($statuses as $row) {
    	$cek = $wpdb->get_results("SELECT id from $table_name where order_id='$orderid' and status_id=$row->id");

    	// if($cek_status==5){
    	// 	$disabled = 'disabled="disabled"';
    	// }else{

	    	if($cek==null){
	    		$disabled = '';
	    	}else{
	    		$disabled = 'disabled="disabled"';
	    	}
    	// }

    	if($no==0){
    		$optionnya .= '<option disabled="disabled" style="font-weight:bold;">&#x2192;&nbsp;Success Status :</option>';
    	}

    	if($row->id==5){
    		$optionnya .= '<option disabled="disabled" style="font-weight:bold;">&#x2192;&nbsp;Cancel Status :</option>';
    	}

    	$optionnya .= '<option value="'.$row->id.'" data-color="'.$row->color.'" data-status="'.$row->nama_status.'"  data-ket="'.$row->ket_status.'" '.$disabled.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row->nama_status.'</option>';

    	$no++;

    }
    echo '<div class="form-group row" style="margin-top:10px;">
    		<div class="col-sm-12">
    		<hr>
    		</div>
            <div class="col-sm-12" style="padding-bottom:12px;">
                <select name="" id="statusnya" class="custom-select" style="height: 38px; padding-left: 10px;font-size:14px;">'.$optionnya.'</select>
            </div>
            <div class="col-sm-12" style="padding-bottom:12px;">
                <textarea id="additional_info" placeholder="Additional Information" style="width:100%;padding:8px 12px;font-size:14px;"></textarea>
            </div>
            <div class="col-sm-8">
            <p style="font-size: 15px;color: #696e74;display:none;" id="status_loading_update">Loading...</p>
            </div>
            <div class="col-sm-4">
            <button id="update_status_order" data-id="'.$orderid.'" type="button" class="btn btn_mgo" style="width: 100%;font-size: 14px !important;margin-top:10px;">Update Status</button>
            </div>
        </div>';

    echo '
	<style>
	.list-group {
		border-left:1px solid #e8eff2 !important;
	}
	.list-group-item {
		display: list-item  !important;
		margin-left:10px;
		border:none;
	}
	.list-group-item:hover {
		background:none;
	}
	.list-group-item:first-child {
		padding-top: 0;
		margin-top: -10px;
	}
	.btn-delete-status {
		position: absolute;
		right: 20px;
	}
	.btn-delete-status:hover {
		color:#EB3B5A;
		cursor:pointer;
	}
	.hidden_status{
		display: none !important;
	}
	</style>';

    wp_die();

} 
add_action( 'wp_ajax_myaction_get_order_status', 'myaction_get_order_status' );
add_action( 'wp_ajax_nopriv_myaction_get_order_status', 'myaction_get_order_status' );


function myaction_update_order_status() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_orders";

    $orderid = $_POST['datanya'][0];
    $statusid = $_POST['datanya'][1];
    $additional_info = $_POST['datanya'][2];
    $entry_idnya = $_POST['datanya'][3];
    $form_idnya = $_POST['datanya'][4];

    if($additional_info==''){
    	$additional_info = null;
    }

    $jumlah_form = $wpdb->get_results('SELECT * from '.$table_name.' where order_id="'.$orderid.'" and  status_id="'.$statusid.'"');
    if($jumlah_form==null){
    	// INSERT DATA
    	
    	$user_id = wp_get_current_user()->ID;
	    $insert = $wpdb->insert(
	            $table_name, //table
	            array('order_id' => $orderid, 'status_id' => $statusid, 'ket_order' => $additional_info, 'user_id' => $user_id, 'entry_idnya' => $entry_idnya, 'form_idnya' => $form_idnya), //data
	            array('%s', '%s') //data format         
	        );

	    // statusid 5 = RTS
	    if($statusid==5){
	    	$wpdb->update(
		        $table_name, //table
		        array('status_rts' => 1), //data
		        array('order_id' => $orderid, 'status_id' => 1 ), // where status_id 1 aja yang di set RTS, gak semua status dalam order itu
		        array('%s'), //data format
		        array('%s') //where format
		    );
	    }else{
	    	$wpdb->update(
		        $table_name, //table
		        array('status_rts' => null), //data
		        array('order_id' => $orderid ), // where
		        array('%s'), //data format
		        array('%s') //where format
		    );
	    }

	    $getdata = $wpdb->get_results('SELECT * from '.$table_name.' where order_id="'.$orderid.'" and  status_id="'.$statusid.'"');

	    if($insert){
	    	echo 'success_'.$getdata[0]->id;
		}
		// echo 'success';
    }else{
    	echo 'not allowed!_0';
    }
    // echo 'success_1';
    
    wp_die();

} 
add_action( 'wp_ajax_myaction_update_order_status', 'myaction_update_order_status' );
add_action( 'wp_ajax_nopriv_myaction_update_order_status', 'myaction_update_order_status' );


function myaction_delete_order_status() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_orders";
    $id_on_order = $_POST['datanya'][0];
    $order_id = $_POST['datanya'][1];
    
	if ( $wpdb->get_var( $wpdb->prepare( 'SELECT id FROM '.$table_name.' WHERE id = %d', $id_on_order ) ) ) {

		// update
		$wpdb->update(
	        $table_name, //table
	        array('status_rts' => null), //data
	        array('order_id' => $order_id ), //where
	        array('%s'), //data format
	        array('%s') //where format
	    );

		// then delete
        $wpdb->query( $wpdb->prepare( 'DELETE FROM '.$table_name.' WHERE id = %d', $id_on_order ) );

        echo 'success';
    }else{
    	echo 'not allowed';
    }
    
    wp_die();

} 
add_action( 'wp_ajax_myaction_delete_order_status', 'myaction_delete_order_status' );
add_action( 'wp_ajax_nopriv_myaction_delete_order_status', 'myaction_delete_order_status' );


function myaction_del_data_byform() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "cf_form_entries";
    $table_name2 = $wpdb->prefix . "cf_form_entry_values";
    $table_name3 = $wpdb->prefix . "mgo_orders";
    $key = $_POST['datanya'][0];
    $form_id = $_POST['datanya'][1];
    
	
    if($key=='delete_data_form'){

    		$query = $wpdb->get_results('SELECT * from '.$table_name.' where form_id="'.$form_id.'" ORDER BY id ASC');
	        foreach($query as $row){
	        	$entry_id = $row->id;
	        	if ( $wpdb->get_var( $wpdb->prepare( 'SELECT id FROM '.$table_name.' WHERE id = %d', $entry_id ) ) ) {
	        		// DELETE DATA ORDER di cf_form_entry_values berdasarkan entry_id form cf_form_entries
	        		$wpdb->query( $wpdb->prepare( 'DELETE FROM '.$table_name.' WHERE id = %d', $entry_id ) );
	        	}
	        	if ( $wpdb->get_var( $wpdb->prepare( 'SELECT id FROM '.$table_name2.' WHERE entry_id = %d', $entry_id ) ) ) {
	        		// DELETE DATA ORDER di cf_form_entry_values berdasarkan entry_id form cf_form_entries
	        		$wpdb->query( $wpdb->prepare( 'DELETE FROM '.$table_name2.' WHERE entry_id = %d', $entry_id ) );
	        	}
	        	if ( $wpdb->get_var( $wpdb->prepare( 'SELECT id FROM '.$table_name3.' WHERE entry_idnya = %d', $entry_id ) ) ) {
	        		// DELETE DATA ORDER di mgo_orders berdasarkan entry_id form cf_form_entries
	        		$wpdb->query( $wpdb->prepare( 'DELETE FROM '.$table_name3.' WHERE entry_idnya = %d', $entry_id ) );
	        	}
	        	
        	}

        	// DELETE DATA TABLE mgo_orders lagi berdasarkan form id, biar gak ada data sisa
        	// if ( $wpdb->get_var( $wpdb->prepare( 'SELECT id FROM '.$table_name3.' WHERE form_idnya = %d', $form_id ) ) ) {
        	// 	// DELETE DATA ORDER di mgo_orders berdasarkan entry_id form cf_form_entries
        	// 	$wpdb->query( $wpdb->prepare( 'DELETE FROM '.$table_name3.' WHERE form_idnya = %d', $form_id ) );
        	// }
        	// $wpdb->query( $wpdb->prepare( 'DELETE FROM '.$table_name3.' WHERE form_idnya = %d', $form_id ) );
	       	
	       	echo 'success';
	    
    }
    

    wp_die();

} 
add_action( 'wp_ajax_myaction_del_data_byform', 'myaction_del_data_byform' );
add_action( 'wp_ajax_nopriv_myaction_del_data_byform', 'myaction_del_data_byform' );



function myaction_delete_order() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "cf_form_entries";
    $table_name2 = $wpdb->prefix . "cf_form_entry_values";
    $table_name3 = $wpdb->prefix . "mgo_orders";
    $entry_id = $_POST['datanya'][0];
    
	if ( $wpdb->get_var( $wpdb->prepare( 'SELECT id FROM '.$table_name.' WHERE id = %d', $entry_id ) ) ) {
        $wpdb->query( $wpdb->prepare( 'DELETE FROM '.$table_name.' WHERE id = %d', $entry_id ) );
        if ( $wpdb->get_var( $wpdb->prepare( 'SELECT id FROM '.$table_name2.' WHERE entry_id = %d', $entry_id ) ) ) {
        	$wpdb->query( $wpdb->prepare( 'DELETE FROM '.$table_name2.' WHERE entry_id = %d', $entry_id ) );
        	$wpdb->query( $wpdb->prepare( 'DELETE FROM '.$table_name3.' WHERE entry_idnya = %d', $entry_id ) );
        	echo 'success';
    	}else{
    		echo 'not allowed';
    	}
    }else{
    	if ( $wpdb->get_var( $wpdb->prepare( 'SELECT id FROM '.$table_name2.' WHERE entry_id = %d', $entry_id ) ) ) {
        	$wpdb->query( $wpdb->prepare( 'DELETE FROM '.$table_name2.' WHERE entry_id = %d', $entry_id ) );
        	$wpdb->query( $wpdb->prepare( 'DELETE FROM '.$table_name3.' WHERE entry_idnya = %d', $entry_id ) );
        	echo 'success';
    	}else{
    		echo 'not allowed';
    	}
    }
    
    wp_die();

} 
add_action( 'wp_ajax_myaction_delete_order', 'myaction_delete_order' );
add_action( 'wp_ajax_nopriv_myaction_delete_order', 'myaction_delete_order' );


function myaction_delete_order_selected() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "cf_form_entries";
    $table_name2 = $wpdb->prefix . "cf_form_entry_values";
    $table_name3 = $wpdb->prefix . "mgo_orders";

    $data_entryid = $_POST['datanya'][0];

    $jumlah = sizeof($data_entryid);

    if($jumlah==0){
    	echo 'Please select the order first.';
    }else{

	    foreach ($data_entryid as $key => $row) {
	    	$entry_id = $row;
	    	if ( $wpdb->get_var( $wpdb->prepare( 'SELECT id FROM '.$table_name.' WHERE id = %d', $entry_id ) ) ) {
		        $wpdb->query( $wpdb->prepare( 'DELETE FROM '.$table_name.' WHERE id = %d', $entry_id ) );
		        if ( $wpdb->get_var( $wpdb->prepare( 'SELECT id FROM '.$table_name2.' WHERE entry_id = %d', $entry_id ) ) ) {
		        	$wpdb->query( $wpdb->prepare( 'DELETE FROM '.$table_name2.' WHERE entry_id = %d', $entry_id ) );
		        	$wpdb->query( $wpdb->prepare( 'DELETE FROM '.$table_name3.' WHERE entry_idnya = %d', $entry_id ) );
		        	// echo 'success';
		    	}else{
		    		// echo 'not allowed';
		    	}
		    }else{
		    	// echo 'not allowed';
		    	$wpdb->query( $wpdb->prepare( 'DELETE FROM '.$table_name.' WHERE id = %d', $entry_id ) );
		        if ( $wpdb->get_var( $wpdb->prepare( 'SELECT id FROM '.$table_name2.' WHERE entry_id = %d', $entry_id ) ) ) {
		        	$wpdb->query( $wpdb->prepare( 'DELETE FROM '.$table_name2.' WHERE entry_id = %d', $entry_id ) );
		        	$wpdb->query( $wpdb->prepare( 'DELETE FROM '.$table_name3.' WHERE entry_idnya = %d', $entry_id ) );
		        	// echo 'success';
		    	}
		    }
	    }

	    echo 'success';

	}

    
    wp_die();

} 
add_action( 'wp_ajax_myaction_delete_order_selected', 'myaction_delete_order_selected' );
add_action( 'wp_ajax_nopriv_myaction_delete_order_selected', 'myaction_delete_order_selected' );


function myaction_delete_wa() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_autosave_wa";
    $order_id = $_POST['datanya'][0];
    $form_id = $_POST['datanya'][1];
   	
   	// The %s (string), %d (integer) and %f (float)
   	if ( $wpdb->get_var( $wpdb->prepare( 'SELECT order_id FROM '.$table_name.' WHERE order_id = %s', $order_id ) ) ) {
	    $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE order_id = %s AND form_id = %s", $order_id, $form_id));
    	echo 'success';
	}else{
		echo 'not allowed';
	}
    
    wp_die();

} 
add_action( 'wp_ajax_myaction_delete_wa', 'myaction_delete_wa' );
add_action( 'wp_ajax_nopriv_myaction_delete_wa', 'myaction_delete_wa' );


function myaction_show_detail_order() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "cf_form_entry_values";
    $table_name5 = $wpdb->prefix . "cf_form_entries";
    $table_name6 = $wpdb->prefix . "cf_forms";
    $table_name8 = $wpdb->prefix . "users";
    $entry_id = $_POST['datanya'][0];

    $get_formid = $wpdb->get_results('SELECT form_id from '.$table_name5.' where id="'.$entry_id.'" ');
    $cek_form_on_caldera = $wpdb->get_results('SELECT * from '.$table_name6.' where form_id="'.$get_formid[0]->form_id.'" and type="primary"');

	if($cek_form_on_caldera != null){
		$form_id = $get_formid[0]->form_id;
		$get_urutan_field = $wpdb->get_results('SELECT config from '.$table_name6.' where type="primary" and form_id="'.$form_id.'" ');
		$dataconfig = json_encode(maybe_unserialize( $get_urutan_field[0]->config ));
	    $datajson = json_decode($dataconfig);

        // print_r($datajson->layout_grid->fields);
        $i=1;
        $len = 0;
        foreach ($datajson->layout_grid->fields as $key=>$row) {
            $len++;
        }

        $data_query = '';
        foreach ($datajson->layout_grid->fields as $key=>$row) {
        	
            if($len==$i){
            	$data_query .= "SELECT * from $table_name where entry_id=$entry_id and field_id='$key' ";
            }else{
            	$data_query .= "SELECT * from $table_name where entry_id=$entry_id and field_id='$key' UNION ";
            }
		 
            $i++;

        }
        $query = $wpdb->get_results("$data_query");
    }else{
    	$query = $wpdb->get_results('SELECT * from '.$table_name.' where entry_id="'.$entry_id.'" ');
    }


    echo '<table class="table table-condensed" style="margin-top: -39px;margin-left: -5px;"><tbody>';
    foreach ($query as $row) {
    	if($row->value!='click'){

    		if($row->slug=='mgo_csid'){
    			$get_cs = $wpdb->get_results("SELECT * from $table_name where entry_id=$row->entry_id and slug='mgo_csid' ");
                if($get_cs==null){
                    $cs_name = '-';
                }else{

                    // Get Name CS
                    $id_cs = $get_cs[0]->value;
                    if (is_numeric($id_cs)){
                    	// $get_name = $wpdb->get_results("SELECT * from $table_name8 where ID=$id_cs ");
                    	$args2 = array( 'blog_id' => 0, 'search' => $id_cs, 'search_columns' => array( 'ID' ) );
					    $get_name = get_users( $args2 );

	                    if($get_name==null){
	                        $cs_name = '-';
	                    }else{
	                    	$nama_user = str_replace("'", "", $get_name[0]->display_name);
	                        $cs_name = $nama_user; // nama asli
	                    }
                    }else{
                    	$cs_name = '-';
                    }

                    $optionnya2 = '';
				    $blogs = array();
				    $args = array( 'blog_id' => 0 );
				    $users = get_users( $args );

				    $optionnya2 = '<option value="">Select CS</option>';
				    foreach ($users as $data ) {
				        if ($data->ID==$id_cs) {
				            $selected = 'selected="selected"';
				        }else{
				            $selected = "";
				        }
				        $nama_user = str_replace("'", "", $data->display_name);
				        $optionnya2 .= '<option value="'.$data->ID.'" '.$selected.'>'.$nama_user.'</option>';
				    }
				    $optionnya2 = '<select class="select_cs" style="display:none;">'.$optionnya2.'</select>';

                }
                echo '<tr id="tr_'.$row->id.'"><td><p class="content-csid">'.$row->slug.'</p></td><td>:</td><td><span class="cs_name">'.$cs_name.'</span>'.$optionnya2.'</td><td><span data-id="'.$row->id.'" class="dashicons dashicons-edit btn_edit mgo_csid" style="display:none;"></span><span class="btn_save mgo_csid" data-id="'.$row->id.'" style="display:none;">save</span></td></tr>';
    		}else{
    			if (strpos($row->slug, '.opt') !== false) {
				}else{
					if (strpos($row->value, '{"opt') !== false) {

						$x = '';
						$isi = '';
						$d_opt = '';

							$data_array =json_decode($row->value, true);
							$n = 1;
							$l = count($data_array);
							$checkbox_value = '';

							foreach($data_array as $key=>$value){

								if($l==$n){
									$x .= $value.'';
									$d_opt .= $row->slug.'.'.$key.'';
								}else{
									$x .= $value.', '; // add comma
									$d_opt .= $row->slug.'.'.$key.',';
								}
			                	$n++;

			                	$checkbox_value .= '<p class="content-value checkbox_value field_hidden" contenteditable="false" data-option="'.$row->slug.'.'.$key.'" data-entryid="'.$row->entry_id.'" data-fieldid="'.$row->field_id.'">'.$value.'</p>';

							}
							$isi = $x;


						echo '<tr id="tr_'.$row->id.'"><td><p class="content-slug" contenteditable="false">'.$row->slug.'</p></td><td>:</td><td><p class="content-value checkbox_all" contenteditable="false">'.$isi.'</p>'.$checkbox_value.'</td><td><span data-id="'.$row->id.'" data-option="'.$d_opt.'" class="dashicons dashicons-edit btn_edit mgo_checkbox" style="display:none;"></span><span class="btn_save mgo_checkbox" data-id="'.$row->id.'" data-option="'.$d_opt.'" style="display:none;">save</span></td></tr>';
					}else{
						if($row->slug=='mgo_courier'){
							echo '<tr id="tr_'.$row->id.'"><td><p class="content-slug" contenteditable="false">'.$row->slug.'</p></td><td>:</td><td><p class="content-value" contenteditable="false">'.strtoupper($row->value).'</p></td><td><span data-id="'.$row->id.'" class="dashicons dashicons-edit btn_edit" style="display:none;"></span><span class="btn_save" data-id="'.$row->id.'" style="display:none;">save</span></td></tr>';
						}elseif($row->slug=='mgo_orderid'){
							echo '<tr id="tr_'.$row->id.'"><td><span class="content-orderid">'.$row->slug.'</span></td><td>:</td><td><p class="content-value" contenteditable="false">'.strtoupper($row->value).'</p></td><td><span data-id="'.$row->id.'" class="dashicons dashicons-edit btn_edit" style="display:none;"></span><span class="btn_save mgo_orderid" data-id="'.$row->id.'" style="display:none;">save</span></td></tr>';
						}else{
    						echo '<tr id="tr_'.$row->id.'">
    						<td><p class="content-slug" contenteditable="false">'.$row->slug.'</p></td><td>:</td><td><p class="content-value" contenteditable="false">'.$row->value.'</p></td><td><span data-id="'.$row->id.'" class="dashicons dashicons-edit btn_edit" style="display:none;"></span><span class="btn_save" data-id="'.$row->id.'" style="display:none;">save</span></td></tr>';
    					}
    				}
    			}
    		}
    	}
    }
    echo '</tbody></table>';

    wp_die();

} 
add_action( 'wp_ajax_myaction_show_detail_order', 'myaction_show_detail_order' );
add_action( 'wp_ajax_nopriv_myaction_show_detail_order', 'myaction_show_detail_order' );


function set_whatsapp_format($text){
	$set_div1 = str_replace('<br></div><div>','%0A',$text);
	$set_div2 = str_replace('</div><div>','%0A',$set_div1);
    $set_nbsp = str_replace('&nbsp;','',$set_div2);
	$set_b_1 = str_replace('<b>','*',$set_nbsp);
	$set_b_2 = str_replace('</b>','*',$set_b_1);
	$set_i_1 = str_replace('<i>','_',$set_b_2);
	$set_i_2 = str_replace('</i>','_',$set_i_1);
	$set_s_1 = str_replace('<strike>','~',$set_i_2);
	$set_s_2 = str_replace('</strike>','~',$set_s_1);
	$set_enter = str_replace('<br>','%0A',$set_s_2);
	return $set_enter;
}


function set_whatsapp_format_wanotif($text){
	$set_new_enter = str_replace('%0A','
',$text);
	return $set_new_enter;
}

function handling_character($text){
	$set_petikdua = str_replace('"', '', $text);
    $set_petiksatu = str_replace("'", "", $set_petikdua);
    $set_garismiring = str_replace("\\", "", $set_petiksatu);
    $set_enter = trim(preg_replace('/\s\s+/', ' ', $set_garismiring));
	return $set_enter;
}

function myaction_send_wa() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "cf_form_entry_values";
    $table_name2 = $wpdb->prefix . "mgo_settings";
    $table_name3 = $wpdb->prefix . "mgo_orders";
    $table_name4 = $wpdb->prefix . "users";
    $table_name5 = $wpdb->prefix . "cf_form_entries";
    $table_name6 = $wpdb->prefix . "cf_forms";
    $table_name7 = $wpdb->prefix . "mgo_calculation";
    
    $entry_id = $_POST['datanya'][0];
    $orderid = $_POST['datanya'][1];
    $followup_type = $_POST['datanya'][2];
    $formid = $_POST['datanya'][3];

    // cek entry id dari email gak linknya
    if($entry_id=='byemail'){
    	$query2 = $wpdb->get_results('SELECT * from '.$table_name.' where value="'.$orderid.'" and slug="mgo_orderid" ORDER BY id ASC');
    	$entry_id = $query2[0]->entry_id;
    }

    // pendefinisian type followup, field apa aja yang diambil berdasarkan type followup
	$status_id_followup = 0;
    if($followup_type=='followup1'){
    	$text_followup_general = 'wa_pembuka';
    	$field_transfer_custom = 'f_transfer_satu';
    	$field_cod_custom = 'f_cod_satu'; 
    	$status_id_followup = 0;
    }
    if($followup_type=='followup2'){
    	$text_followup_general = 'wa_followup_dua';
    	$field_transfer_custom = 'f_transfer_dua';
    	$field_cod_custom = 'f_cod_dua'; 
    	$status_id_followup = 22;
    }
    if($followup_type=='followup3'){
    	$text_followup_general = 'wa_followup_tiga';
    	$field_transfer_custom = 'f_transfer_tiga';
    	$field_cod_custom = 'f_cod_tiga'; 
    	$status_id_followup = 33;
    }

    // ********************************
	// SET FOLLOW UP WHATSAPP - STATUS
	// status_id = 0,22,33 itu status untuk followup 1, 2, dan 3
	// ***************************
    $check_wa_status = $wpdb->get_results('SELECT * from '.$table_name3.' where order_id="'.$orderid.'" and  status_id="'.$status_id_followup.'" ');
    if($check_wa_status==null){
    	$user_id = wp_get_current_user()->ID;
	    $insert = $wpdb->insert(
	            $table_name3, //table
	            array('order_id' => $orderid, 'status_id' => $status_id_followup, 'ket_order' => null, 'user_id' => $user_id, 'entry_idnya' => $entry_id, 'form_idnya' => $formid), //data
	            array('%s', '%s') //data format         
	        );
	}

    // **************************
	// SEND WA MESSAGE
	// ***************************
	
	$get_formid = $wpdb->get_results('SELECT form_id from '.$table_name5.' where id="'.$entry_id.'" ');
    $cek_form_on_caldera = $wpdb->get_results('SELECT * from '.$table_name6.' where form_id="'.$get_formid[0]->form_id.'" and type="primary"');

	if($cek_form_on_caldera != null){
		$form_id = $get_formid[0]->form_id;
		$get_urutan_field = $wpdb->get_results('SELECT config from '.$table_name6.' where type="primary" and form_id="'.$form_id.'" ');
		$dataconfig = json_encode(maybe_unserialize( $get_urutan_field[0]->config ));
	    $datajson = json_decode($dataconfig);

        // print_r($datajson->layout_grid->fields);
        $i=1;
        $len = 0;
        foreach ($datajson->layout_grid->fields as $key=>$row) {
            $len++;
        }

        $data_query = '';
        foreach ($datajson->layout_grid->fields as $key=>$row) {
        	
            if($len==$i){
            	$data_query .= "SELECT * from $table_name where entry_id=$entry_id and field_id='$key' ";
            }else{
            	$data_query .= "SELECT * from $table_name where entry_id=$entry_id and field_id='$key' UNION ";
            }
		 
            $i++;

        }
        $query = $wpdb->get_results("$data_query");
    }else{
    	$query = $wpdb->get_results('SELECT * from '.$table_name.' where entry_id="'.$entry_id.'" ORDER BY id ASC');
    }
    
    // cek [mgo_no_bold]
    $nobold = 0;
    $query_wa_opening = $wpdb->get_results('SELECT * from '.$table_name2.' where type="'.$text_followup_general.'"');
    if (strpos($query_wa_opening[0]->data, '%mgo_no_bold%') !== false){
    	$nobold = 1;
    }

    // cek nama produk setting
    $query_title_settings = $wpdb->get_results('SELECT data from '.$table_name2.' where type="nama_produk_status" or type="nama_produk_other_name" or type="order_id_status" or type="order_id_other_name" ORDER BY id ASC');
    $nama_produk_status = $query_title_settings[0]->data;
    $nama_produk_other_name = $query_title_settings[1]->data;
    $order_id_status = $query_title_settings[2]->data;
    $order_id_other_name = $query_title_settings[3]->data;

    if($nama_produk_status=='1'){
        $nama_produknya = 'Nama Program';
    }elseif($nama_produk_status=='2'){
        $nama_produknya = 'Nama Kegiatan';
    }elseif($nama_produk_status=='3'){
        $nama_produknya = $nama_produk_other_name;
    }else{
        $nama_produknya = 'Nama Produk';
    }

    if($order_id_status=='1'){
        $order_id_set = 'Invoice ID';
    }elseif($order_id_status=='2'){
        $order_id_set = 'Donation ID';
    }elseif($order_id_status=='3'){
        $order_id_set = $order_id_other_name;
    }else{
        $order_id_set = 'Order ID';
    }


    $content = '';
    $detail_order = '';
    $totalharga = '';

    // if (strpos($query_watext_depan[0]->data, '[mgo_detail_order]') !== false ){

	    foreach ($query as $row) {
	    	$isi = $row->value;
			
			if (strpos($isi, '%') !== false) {
			    $isi = str_replace('%', '%25', $isi);
			}
			if (strpos($isi, '&') !== false) {
			    $isi = str_replace('&', '%26', $isi);
			}

			if (strpos($isi, '{"opt') !== false) {

				$x = '';

				$data_array =json_decode($isi, true);
				$n = 1;
				$l = count($data_array);

				foreach($data_array as $key=>$value){

					if($l==$n){
						$x .= $value.'';
					}else{
						$x .= $value.', '; // add comma
					}
                	$n++;

				}
				$isi = $x;

			}

	    	if($isi!='click'){
	    		$pieces = explode("_", $row->slug);
	      		$mgo = $pieces[0];
	      		if($mgo=='mgo'){
	      			if($row->slug!='mgo_pembayaran'){
	      				if($pieces[1]!='csid'){
	      					if($pieces[1]!='csmail'){
	      						if($pieces[1]!='cswa'){
		      						if($pieces[1]!='orderid2'){
		      							// if($pieces[1]!='kupon'){
						      				if($pieces[1]=='total'){
						      					if (strpos($isi, 'Rp') !== false) {
												    $totalharga = explode("Rp", $isi);
							      					$totalharga = "Rp ".str_replace(",",".",$totalharga[1]);
							      					$isi = $totalharga;
												}else{
													$totalharga = "Rp ".number_format($isi,0,",",".");
													$isi = $totalharga;
												}
						      				}
						      				if($pieces[1]=='dp' || $pieces[1]=='sisa'){
						      					if (strpos($isi, 'Rp') !== false) {
												    $totalvalue = explode("Rp", $isi);
							      					$totalvalue = "Rp ".str_replace(",",".",$totalvalue[1]);
							      					$isi = $totalvalue;
												}else{
													$totalvalue = "Rp ".number_format($isi,0,",",".");
													$isi = $totalvalue;
												}
						      				}
						      				if($pieces[1]=='item' && $pieces[2]=='total'){
						      					if (strpos($isi, 'Rp') !== false) {
												    $itemtotal = explode("Rp", $isi);
							      					$itemtotal = "Rp ".str_replace(",",".",$itemtotal[1]);
							      					$isi = $itemtotal;
												}
						      				}
						      				if (strpos($row->slug, '.opt') !== false) { // checkbox value > check
					    					}else{
					    						if($pieces[1]=='orderid'){
							      					$judulnya = 'Order ID';
							      				}else{

							      					if($pieces[1]=='rp'){
							      						if (strpos($isi, '.') !== false) {
							      							$isi = 'Rp '.$isi;
							      						}else{
							      							$isi = 'Rp '.number_format($isi, 0, ',', '.');
							      						}
								      					$judulnya1 = str_replace('mgo_rp_','',$row->slug);
								      					$judulnya2 = str_replace('mgo_','',$judulnya1);
								      					$judulnya3 = str_replace('_',' ',$judulnya2);
								      					$judulnya = ucwords($judulnya3);

								      				}else{
								      				
								    					$judulnya1 = str_replace('mgo_','',$row->slug);
								      					$judulnya2 = str_replace('_',' ',$judulnya1);
								      					$judulnya = ucwords($judulnya2);
							      					}
							      				}
							      				if (strpos($judulnya, '.opt') !== false) {
													$slugnya = explode(".opt", $judulnya);
													$judulnya = $slugnya[0];
												}
												if($row->slug=='mgo_courier'){
													$isi = strtoupper($isi);
												}

												if($judulnya!='Anonim'){

													if($judulnya=='Nama Produk'){
														$judulnya = $nama_produknya;
													}

													if($judulnya=='Order ID'){
														$judulnya = $order_id_set;
													}

													if($judulnya=='Wa'){
														$judulnya = 'Whatsapp';
													}

													if($nobold==0){
														$content .= $judulnya.' : *'.rtrim($isi).'* %0A';
													}else{
														$content .= $judulnya.' : '.rtrim($isi).' %0A';
													}
												}
						    					
					    					}
				    					// }
			    					}
			    					}
			    					
		    					}
	    				}
	    			}
	    		}
	    		
	    	}
	    }

	    $detail_order = $content;

	// }

    // CS NAME
    $query_csid = $wpdb->get_results('SELECT * from '.$table_name.' where entry_id="'.$entry_id.'" and slug="mgo_csid" ');
    $cs_name = '';
    if($query_csid!=null){
    	$id_cs = $query_csid[0]->value;
        if (is_numeric($id_cs)){
            // $get_name = $wpdb->get_results("SELECT * from $table_name4 where ID=$id_cs ");
            $args2 = array( 'blog_id' => 0, 'search' => $id_cs, 'search_columns' => array( 'ID' ) );
    		$get_name = get_users( $args2 );

            if($get_name!=null){
            	$nama_user = str_replace("'", "", $get_name[0]->display_name);
                $cs_name = $nama_user; // nama asli
            }
        }
    }

    // Phone
    $query_wa = $wpdb->get_results('SELECT * from '.$table_name.' where entry_id="'.$entry_id.'" and slug="mgo_wa" ');
    if($query_wa==null){
    	$phone = '0';
    }else{
    	$phone = hp($query_wa[0]->value);
    }

    // nama
    $namanya = '';
    $query_namacustomer = $wpdb->get_results('SELECT * from '.$table_name.' where entry_id="'.$entry_id.'" and slug="mgo_nama" ');
    if($query_namacustomer!=null){
    	$namanya = $query_namacustomer[0]->value;
	}

    // Produk
    $nama_produk = '';
    $query_produk = $wpdb->get_results('SELECT * from '.$table_name.' where entry_id="'.$entry_id.'" and slug="mgo_nama_produk" ');
    if($query_produk!=null){
    	$nama_produk = $query_produk[0]->value;
	}

    // Pembayaran
    $pembayaran = '';
    $query_pembayaran = $wpdb->get_results('SELECT * from '.$table_name.' where entry_id="'.$entry_id.'" and slug="mgo_pembayaran" ');
    if($query_pembayaran!=null){
    	$pembayaran = $query_pembayaran[0]->value;
    }

    // Ongkos Kirim
    $ongkos_kirim = '';
    $query_ongkos_kirim = $wpdb->get_results('SELECT * from '.$table_name.' where entry_id="'.$entry_id.'" and slug="mgo_ongkos_kirim" ');
    if($query_ongkos_kirim!=null){
    	$ongkos_kirim = $query_ongkos_kirim[0]->value;
    }

    // Biaya COD
    $biaya_cod = '';
    $query_biaya_cod = $wpdb->get_results('SELECT * from '.$table_name.' where entry_id="'.$entry_id.'" and slug="mgo_biaya_cod" ');
    if($query_biaya_cod!=null){
    	$biaya_cod = $query_biaya_cod[0]->value;
    }

    // Alamat
    $alamat = '';
    $query_alamat = $wpdb->get_results('SELECT * from '.$table_name.' where entry_id="'.$entry_id.'" and slug="mgo_alamat" ');
    if($query_alamat!=null){
    	$alamat = $query_alamat[0]->value;
    }

    // Alamat Lengkap
    $alamat_lengkap = '';
    $query_alamat_lengkap = $wpdb->get_results('SELECT * from '.$table_name.' where entry_id="'.$entry_id.'" and slug="mgo_alamat_lengkap" ');
    if($query_alamat_lengkap!=null){
    	$alamat_lengkap = $query_alamat_lengkap[0]->value;
    }

    // Email
    $email = '';
    $query_email = $wpdb->get_results('SELECT * from '.$table_name.' where entry_id="'.$entry_id.'" and slug="mgo_email" ');
    if($query_email!=null){
    	$email = $query_email[0]->value;
    }

    // CS WA
    $cswa = '';
    $query_cswa = $wpdb->get_results('SELECT * from '.$table_name.' where entry_id="'.$entry_id.'" and slug="mgo_cswa" ');
    if($query_cswa!=null){
    	$cswa = $query_cswa[0]->value;
    }

    // DP
    $total_harga = '';
    $query_total_harga = $wpdb->get_results('SELECT * from '.$table_name.' where entry_id="'.$entry_id.'" and slug="mgo_total" ');
    if($query_total_harga!=null){
    	$total_harga = $query_total_harga[0]->value;
    }

    // DP
    $dp = '';
    $query_dp = $wpdb->get_results('SELECT * from '.$table_name.' where entry_id="'.$entry_id.'" and slug="mgo_dp" ');
    if($query_dp!=null){
    	$dp = $query_dp[0]->value;
    }

    // DP 2
    $deposit = '';
    $query_deposit = $wpdb->get_results('SELECT * from '.$table_name.' where entry_id="'.$entry_id.'" and slug="mgo_deposit" ');
    if($query_deposit!=null){
    	$deposit = $query_deposit[0]->value;
    }

    // Sisa Pembayaran
    $sisa = '';
    $query_sisa = $wpdb->get_results('SELECT * from '.$table_name.' where entry_id="'.$entry_id.'" and slug="mgo_sisa" ');
    if($query_sisa!=null){
    	$sisa = $query_sisa[0]->value;
    }

    // Sisa Pembayaran 2
    $sisa_pembayaran = '';
    $query_sisa_pembayaran = $wpdb->get_results('SELECT * from '.$table_name.' where entry_id="'.$entry_id.'" and slug="mgo_sisa_pembayaran" ');
    if($query_sisa_pembayaran!=null){
    	$sisa_pembayaran = $query_sisa_pembayaran[0]->value;
    }

    // query message berdasarkan followup type
    $f_wa_status = 0;
    $f_transfer = '';
    $f_cod = '';
    $query_form = $wpdb->get_results('SELECT f_wa_status, '.$field_transfer_custom.', '.$field_cod_custom.' from '.$table_name7.' where id_form="'.$form_id.'" ');
    if($query_form!=null){
    	$f_wa_status = $query_form[0]->f_wa_status;
    	$f_transfer = $query_form[0]->$field_transfer_custom;
    	$f_cod = $query_form[0]->$field_cod_custom;
    }

    if($f_wa_status==0){ // pakai general message followup wa
    	$query_watext_depan = $wpdb->get_results('SELECT * from '.$table_name2.' where type="'.$text_followup_general.'"');
    	$followup_wa_message = $query_watext_depan[0]->data;

    }else{ // klo f_wa_status = 1, pakai Custom Message
    	$followup_wa_message = $f_transfer;
    	// klo ada "cod" di mgo_pembayaran, pakai cod message
    	$cek_cod = strtolower($pembayaran);
    	if (strpos($cek_cod, 'cod') !== false) {
		    $followup_wa_message = $f_cod;
		}
    }


    if (strpos($followup_wa_message, '[mgo_nama]') !== false || strpos($followup_wa_message, '[mgo_total]') !== false || strpos($followup_wa_message, '[mgo_wa]') !== false || strpos($followup_wa_message, '[mgo_nama_produk]') !== false || strpos($followup_wa_message, '[mgo_orderid]') !== false || strpos($followup_wa_message, '[mgo_csid]') !== false || strpos($followup_wa_message, '[mgo_pembayaran]') !== false || strpos($followup_wa_message, '%mgo_no_bold%') !== false || strpos($followup_wa_message, '[mgo_detail_order]') !== false || strpos($followup_wa_message, '[mgo_email]') !== false || strpos($followup_wa_message, '[mgo_alamat]') !== false || strpos($followup_wa_message, '[mgo_alamat_lengkap]') !== false || strpos($followup_wa_message, '[mgo_cswa]') !== false || strpos($followup_wa_message, '[mgo_ongkos_kirim]') !== false || strpos($followup_wa_message, '[mgo_biaya_cod]') !== false || strpos($followup_wa_message, '[mgo_dp]') !== false || strpos($followup_wa_message, '[mgo_sisa]') !== false) {
		$set_nama = str_replace('[mgo_nama]', $namanya, $followup_wa_message);
		$set_total = str_replace('[mgo_total]', $total_harga, $set_nama);
		$set_phone = str_replace('[mgo_wa]', $phone, $set_total);
		$set_csname = str_replace('[mgo_csid]', $cs_name, $set_phone);
		$set_cswa = str_replace('[mgo_cswa]', $cswa, $set_csname);
		$set_dp = str_replace('[mgo_dp]', $dp, $set_cswa);
		$set_sisa = str_replace('[mgo_sisa]', $sisa, $set_dp);
		$set_deposit = str_replace('[mgo_deposit]', $deposit, $set_sisa);
		$set_sisa_pembayaran = str_replace('[mgo_sisa_pembayaran]', $sisa_pembayaran, $set_deposit);
		$set_ongkos_kirim = str_replace('[mgo_ongkos_kirim]', $ongkos_kirim, $set_sisa_pembayaran);
		$set_biaya_cod = str_replace('[mgo_biaya_cod]', $biaya_cod, $set_ongkos_kirim);
		$set_alamat = str_replace('[mgo_alamat]', $alamat, $set_biaya_cod);
		$set_alamat_lengkap = str_replace('[mgo_alamat_lengkap]', $alamat_lengkap, $set_alamat);
		$set_email = str_replace('[mgo_email]', $email, $set_alamat_lengkap);
		$set_orderid = str_replace('[mgo_orderid]', $orderid, $set_email);
		$set_produk = str_replace('[mgo_nama_produk]', $nama_produk, $set_orderid);
		$set_pembayaran = str_replace('[mgo_pembayaran]', $pembayaran, $set_produk);
		$set_nobold = str_replace('%mgo_no_bold%', '', $set_pembayaran);
		$set_detail_order = str_replace('[mgo_detail_order]', $detail_order, $set_nobold);
		$welcome = set_whatsapp_format($set_detail_order);
	}else{
		$welcome = set_whatsapp_format($followup_wa_message);
	}

	$welcome = str_replace("\\", '', $welcome);
	$welcome = strip_tags($welcome);

	// Followup with WANOTIF
	$followup_wanotif_status = $wpdb->get_results("SELECT data from $table_name2 where type='followup_wanotif_status'")[0];

	if($followup_wanotif_status->data==1){
		// $text_message = $welcome.$content.'%0A'.$additional_content;
		$text_message = $welcome;
		$new_text_message = set_whatsapp_format_wanotif($text_message);


		$query_wanotif 	= $wpdb->get_results('SELECT data from '.$table_name2.' where type="plugin_status" or type="wanotif_status" or type="wanotif_type" or type="wanotif_apikey" or type="wanotif_url" or type="wanotif_message" or type="wanotif_csrotator" ORDER BY id ASC');
			
			$plugin_status = strtoupper($query_wanotif[0]->data);
			$wanotif_status = $query_wanotif[1]->data; // 0: off, 1: aktif
			$wanotif_type = $query_wanotif[2]->data; // 0: single sender, 1: cs rotator sender
			$wanotif_apikey = $query_wanotif[3]->data;
			$wanotif_url = $query_wanotif[4]->data;
			$wanotif_message = $query_wanotif[5]->data;
			$wanotif_csrotator = $query_wanotif[6]->data;


			// Check if $apikey matches stored Moota Api Key in mgo_settings

				// SEND Message from WANOTIF
				if($wanotif_status==1){
					
					// CHECK SINGLE SENDER OR CS ROTATOR SENDER, wanotif_type 0: single sender, 1: cs rotator sender
					if($wanotif_type==0){
						// SET PHONE
						if($phone!=''){
							$phone = hp($phone);
							$url = $wanotif_url.'/send';

							$spintax = new Spintax();
							$new_text_message = $spintax->process($new_text_message);

							$curl = curl_init();
							curl_setopt($curl, CURLOPT_URL, $url);
							curl_setopt($curl, CURLOPT_HEADER, 0);
							curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
							curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
							curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
							curl_setopt($curl, CURLOPT_TIMEOUT,30);
							curl_setopt($curl, CURLOPT_POST, 1);
							curl_setopt($curl, CURLOPT_POSTFIELDS, array(
							    'Apikey'    => $wanotif_apikey,
							    'Phone'     => $phone,
							    'Message'   => $new_text_message,
							));
							$response = curl_exec($curl);
							curl_close($curl); 

							echo '<div class="wanotif_title">Followup 2</div><div class="wanotif_icon"></div><span class="wanotif_text">Message sent to '.$namanya.' ('.$phone.')</span>';

						}else{
							echo '<div class="wanotif_title">Failed</div><span class="wanotif_text">Phone User not found.</span>';
						}

					}else{ // YANG KIRIM SI CS ROTATOR
						
						// SET CSID
						$csid = $query_csid[0]->value;

						if($csid!=''){

							$apikey_nya = '';
							$fields = json_decode($wanotif_csrotator, true);
							if(!empty($fields)){
								foreach ($fields as $key => $value ) {
									if($key==$csid){
										$apikey_nya = $value;
									}
								}

								$wanotif_apikey = $apikey_nya;

						    	// SET PHONE
								if($phone!=''){
									$phone = hp($phone);
									$url = $wanotif_url.'/send';

									$spintax = new Spintax();
									$new_text_message = $spintax->process($new_text_message);

									$curl = curl_init();
									curl_setopt($curl, CURLOPT_URL, $url);
									curl_setopt($curl, CURLOPT_HEADER, 0);
									curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
									curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
									curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
									curl_setopt($curl, CURLOPT_TIMEOUT,30);
									curl_setopt($curl, CURLOPT_POST, 1);
									curl_setopt($curl, CURLOPT_POSTFIELDS, array(
									    'Apikey'    => $wanotif_apikey,
									    'Phone'     => $phone,
									    'Message'   => $new_text_message,
									));
									$response = curl_exec($curl);
									curl_close($curl); 


									echo '<div class="wanotif_title">Followup 2</div><div class="wanotif_icon"></div><span class="wanotif_text">Message sent to '.$namanya.' ('.$phone.')</span>';

								}else{
									echo '<div class="wanotif_title">Failed</div><span class="wanotif_text">Phone User not found.</span>';
								}
							}else{
								echo '<div class="wanotif_title">Failed</div><span class="wanotif_text">Wanotif API Key CS not found.</span>';
							}
						}else{
							echo '<div class="wanotif_title">Failed</div><span class="wanotif_text">CS ID not found.</span>';
						}
					}

					
				}else{
					echo '<div class="wanotif_title">Failed</div><span class="wanotif_text">Wanotif not active.</span>';
				}

	}else{
		$spintax = new Spintax();
		$welcome = $spintax->process($welcome);

		// $urllink_whatsapp = 'https://api.whatsapp.com/send?phone='.$phone.'&text='.$welcome.$content.'%0A'.$additional_content;
		$urllink_whatsapp = 'https://api.whatsapp.com/send?phone='.$phone.'&text='.$welcome;
	    echo $urllink_whatsapp;
	}

    

    wp_die();

} 
add_action( 'wp_ajax_myaction_send_wa', 'myaction_send_wa' );
add_action( 'wp_ajax_nopriv_myaction_send_wa', 'myaction_send_wa' );


// Send followup dari Save WA Number
function myaction_send_wa2() {
	
    global $wpdb;
    $table_name2 = $wpdb->prefix . "mgo_settings";
    $table_name4 = $wpdb->prefix . "mgo_autosave_wa";
    
    $entry_id = $_POST['datanya'][0];
    $orderid = $_POST['datanya'][1];
    
    // WA TEXT
    $query_wa_followup = $wpdb->get_results('SELECT data from '.$table_name2.' where type="wa_followup"');
	$wa_text_followup = set_whatsapp_format($query_wa_followup[0]->data);

	// GET WA PHONE NUMBER
	$phone = $wpdb->get_results('SELECT wa_number from '.$table_name4.' where order_id="'.$orderid.'" ');
    if($phone[0]->wa_number==null){
    	$phone = '0';
    }else{
    	$phone = hp($phone[0]->wa_number);
    }

    // GET NAMA
    $query_namacustomer = $wpdb->get_results('SELECT name from '.$table_name4.' where order_id="'.$orderid.'" ');
    $namanya = $query_namacustomer[0]->name;

    // UPDATE NAMA CUSTOMER
    if (strpos($wa_text_followup, '[mgo_nama]') !== false) {
		$set_nama = str_replace('[mgo_nama]', $namanya, $wa_text_followup);
		$wa_text_followup = set_whatsapp_format($set_nama);
	}

    // UPDATE FOLLOWUP STATUS
    $wpdb->update(
        $table_name4, //table
        array('status_followup' => 1), //data
        array('order_id' => $orderid), //where
        array('%s'), //data format
        array('%s') //where format
    );

    $wa_text_followup = str_replace("\\", '', $wa_text_followup);

    $spintax = new Spintax();
	$wa_text_followup = $spintax->process($wa_text_followup);

    $urllink_whatsapp = 'https://api.whatsapp.com/send?phone='.$phone.'&text='.$wa_text_followup;
    echo $urllink_whatsapp;

    wp_die();

} 
add_action( 'wp_ajax_myaction_send_wa2', 'myaction_send_wa2' );
add_action( 'wp_ajax_nopriv_myaction_send_wa2', 'myaction_send_wa2' );



// Chat WA CS after SUBMIT FORM
function myaction_chat_wacs() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "cf_form_entry_values";
    $table_name2 = $wpdb->prefix . "mgo_settings";
    $table_name5 = $wpdb->prefix . "cf_form_entries";
	$table_name6 = $wpdb->prefix . "cf_forms";
    
    $orderid = $_POST['datanya'][0];
    $csid = $_POST['datanya'][1];
    $text = $_POST['datanya'][2];
    $detailorder = $_POST['datanya'][3];

    // ******************************
    // Set awal sebelum update dari loop foreach dibawah
    $csid_from_detail = '0';
    // *****************************

    // cek nama produk setting
    $query_title_settings = $wpdb->get_results('SELECT data from '.$table_name2.' where type="nama_produk_status" or type="nama_produk_other_name" or type="order_id_status" or type="order_id_other_name" ORDER BY id ASC');
    $nama_produk_status = $query_title_settings[0]->data;
    $nama_produk_other_name = $query_title_settings[1]->data;
    $order_id_status = $query_title_settings[2]->data;
    $order_id_other_name = $query_title_settings[3]->data;

    if($nama_produk_status=='1'){
        $nama_produknya = 'Nama Program';
    }elseif($nama_produk_status=='2'){
        $nama_produknya = 'Nama Kegiatan';
    }elseif($nama_produk_status=='3'){
        $nama_produknya = $nama_produk_other_name;
    }else{
        $nama_produknya = 'Nama Produk';
    }

    if($order_id_status=='1'){
        $order_id_set = 'Invoice ID';
    }elseif($order_id_status=='2'){
        $order_id_set = 'Donation ID';
    }elseif($order_id_status=='3'){
        $order_id_set = $order_id_other_name;
    }else{
        $order_id_set = 'Order ID';
    }
    

	//*******************************
	// GET DETAIL ORDER
	//*******************************
	// ambil dari database order yang masuk
	if($orderid!=null || $orderid!=''){

	    //********************************
		//CHECK ORDER-ID
		//*********************************
	    $row = $wpdb->get_results('SELECT * from '.$table_name.' where value="'.$orderid.'" ');
	    if($row!=null){

	    	$entry_id = $row[0]->entry_id;

	    	// CEK %mgo_no_bold%
		    $nobold = 0;
		    if (strpos($text, '%mgo_no_bold%') !== false){
		    	$nobold = 1;
		    }

	    	// **************************
			// GET DETAIL ORDER
			// ***************************
		    
			
			$get_formid = $wpdb->get_results('SELECT form_id from '.$table_name5.' where id="'.$entry_id.'" ');
		    $cek_form_on_caldera = $wpdb->get_results('SELECT * from '.$table_name6.' where form_id="'.$get_formid[0]->form_id.'" and type="primary"');

			if($cek_form_on_caldera != null){
				$form_id = $get_formid[0]->form_id;
				$get_urutan_field = $wpdb->get_results('SELECT config from '.$table_name6.' where type="primary" and form_id="'.$form_id.'" ');
				$dataconfig = json_encode(maybe_unserialize( $get_urutan_field[0]->config ));
			    $datajson = json_decode($dataconfig);

		        // print_r($datajson->layout_grid->fields);
		        $i=1;
		        $len = 0;
		        foreach ($datajson->layout_grid->fields as $key=>$row) {
		            $len++;
		        }

		        $data_query = '';
		        foreach ($datajson->layout_grid->fields as $key=>$row) {
		        	
		            if($len==$i){
		            	$data_query .= "SELECT * from $table_name where entry_id=$entry_id and field_id='$key' ";
		            }else{
		            	$data_query .= "SELECT * from $table_name where entry_id=$entry_id and field_id='$key' UNION ";
		            }
				 
		            $i++;

		        }
		        $query = $wpdb->get_results("$data_query");
		    }else{
		    	$query = $wpdb->get_results('SELECT * from '.$table_name.' where entry_id="'.$entry_id.'" ORDER BY id ASC');
		    }
		    

		    $content = '';
		    $totalharga = '';
		    foreach ($query as $row) {
		    	$isi = $row->value;
				if (strpos($isi, '%') !== false) {
				    $isi = str_replace('%', '%25', $isi);
				}
				if (strpos($isi, '&') !== false) {
				    $isi = str_replace('&', '%26', $isi);
				}

				if (strpos($isi, '{"opt') !== false) {

					$x = '';

					$data_array =json_decode($isi, true);
					$n = 1;
					$l = count($data_array);

					foreach($data_array as $key=>$value){

						if($l==$n){
							$x .= $value.'';
						}else{
							$x .= $value.', '; // add comma
						}
	                	$n++;

					}
					$isi = $x;

				}

		    	if($isi!='click'){
		    		// tambahan untuk mengambil cs id 
		    		if($row->slug=='mgo_csid'){
		    			$csid_from_detail = $isi;
		    		}

		    		$pieces = explode("_", $row->slug);
		      		$mgo = $pieces[0];
		      		if($mgo=='mgo'){
	      				if($pieces[1]!='csid'){
	      					if($pieces[1]!='csmail'){
	      						if($pieces[1]!='cswa'){
	      						if($pieces[1]!='orderid2'){
	      							// if($pieces[1]!='kupon'){
					      				if($pieces[1]=='total'){
					      					if (strpos($isi, 'Rp') !== false) {
											    $totalharga = explode("Rp", $isi);
						      					$totalharga = "Rp ".str_replace(",",".",$totalharga[1]);
						      					$isi = $totalharga;
											}else{
												$totalharga = "Rp ".number_format($isi,0,",",".");
												$isi = $totalharga;
											}
					      				}
					      				if($pieces[1]=='dp' || $pieces[1]=='sisa'){
					      					if (strpos($isi, 'Rp') !== false) {
											    $totalvalue = explode("Rp", $isi);
						      					$totalvalue = "Rp ".str_replace(",",".",$totalvalue[1]);
						      					$isi = $totalvalue;
											}else{
												$totalvalue = "Rp ".number_format($isi,0,",",".");
												$isi = $totalvalue;
											}
					      				}
					      				if($pieces[1]=='item' && $pieces[2]=='total'){
					      					if (strpos($isi, 'Rp') !== false) {
											    $itemtotal = explode("Rp", $isi);
						      					$itemtotal = "Rp ".str_replace(",",".",$itemtotal[1]);
						      					$isi = $itemtotal;
											}
					      				}
					      				if (strpos($row->slug, '.opt') !== false) { // checkbox value > check
				    					}else{
				    						if($pieces[1]=='orderid'){
						      					$judulnya = 'Order ID';
						      				}else{

						      					if($pieces[1]=='rp'){
							      					if (strpos($isi, '.') !== false) {
						      							$isi = 'Rp '.$isi;
						      						}else{
						      							$isi = 'Rp '.number_format($isi, 0, ',', '.');
						      						}
							      					$judulnya1 = str_replace('mgo_rp_','',$row->slug);
							      					$judulnya2 = str_replace('mgo_','',$judulnya1);
							      					$judulnya3 = str_replace('_',' ',$judulnya2);
							      					$judulnya = ucwords($judulnya3);
							      				}else{
							      					
							    					$judulnya1 = str_replace('mgo_','',$row->slug);
							      					$judulnya2 = str_replace('_',' ',$judulnya1);
							      					$judulnya = ucwords($judulnya2);
						      					}
						      				}
						      				if (strpos($judulnya, '.opt') !== false) {
												$slugnya = explode(".opt", $judulnya);
												$judulnya = $slugnya[0];
											}
											if($row->slug=='mgo_courier'){
												$isi = strtoupper($isi);
											}
											if($judulnya!='Anonim'){

												if($judulnya=='Nama Produk'){
													$judulnya = $nama_produknya;
												}

												if($judulnya=='Order ID'){
													$judulnya = $order_id_set;
												}

												if($judulnya=='Wa'){
													$judulnya = 'Whatsapp';
												}

												if($nobold==0){
						    						$content .= $judulnya.' : *'.rtrim($isi).'* %0A';
						    					}else{
						    						$content .= $judulnya.' : '.rtrim($isi).' %0A';
						    					}
						    				}
				    					}
			    					// }
		    					}
		    					}
	    					}
	    				}
		    		}
		    	}
		    }
		    $detail_ordernya = $content.'%0A';

		}else{
			$detail_ordernya = '';
		}

	}

    if($detailorder=="false"){
    	$detail_ordernya = '';
    }


    // Cek, KLO DIA CS ID nya 0 masih seperti set awal
	if($csid=='auto'){
		$csid_fixed = $csid_from_detail;
	}elseif($csid_from_detail==0){
		$csid_fixed = 2;
	}else{
		$csid_fixed = $csid;
	}

	$cs_name = '';
	if (is_numeric($csid_fixed)){
        $args2 = array( 'blog_id' => 0, 'search' => $csid_fixed, 'search_columns' => array( 'ID' ) );
		$get_name = get_users( $args2 );

        if($get_name!=null){
            $nama_user = str_replace("'", "", $get_name[0]->display_name);
            $cs_name = $nama_user; // nama asli
        }
    }

    $phone = hp(get_the_author_meta('description',$csid_fixed));

	$detail_ordernya = str_replace("\\", '', $detail_ordernya);

	// GET ORDER ID First
	$query_entryid = $wpdb->get_results('SELECT * from '.$table_name.' where value="'.$orderid.'" and slug="mgo_orderid" ');
	$entry_id = $query_entryid[0]->entry_id;

    // nama
    $query_namacustomer = $wpdb->get_results('SELECT * from '.$table_name.' where entry_id="'.$entry_id.'" and slug="mgo_nama" ');
    $namanya = $query_namacustomer[0]->value;

    // Produk
    $query_produk = $wpdb->get_results('SELECT * from '.$table_name.' where entry_id="'.$entry_id.'" and slug="mgo_nama_produk" ');
    $nama_produk = $query_produk[0]->value;

    // Total
    $query_total = $wpdb->get_results('SELECT * from '.$table_name.' where entry_id="'.$entry_id.'" and slug="mgo_total" ');
    $harga_total = $query_total[0]->value;

    // Ongkir
    $query_ongkir = $wpdb->get_results('SELECT * from '.$table_name.' where entry_id="'.$entry_id.'" and slug="mgo_ongkos_kirim" ');
    $harga_ongkir = $query_ongkir[0]->value;

    // WA
    $query_wa = $wpdb->get_results('SELECT * from '.$table_name.' where entry_id="'.$entry_id.'" and slug="mgo_wa" ');
    $wanya = $query_wa[0]->value;

    // wa pembuka
    if (strpos($text, '%mgo_nama%') !== false || strpos($text, '%mgo_total%') !== false || strpos($text, '%mgo_nama_produk%') !== false || strpos($text, '%mgo_orderid%') !== false || strpos($text, '%mgo_ongkos_kirim%') !== false || strpos($text, '%mgo_wa%') !== false) {
		$set_nama = str_replace('%mgo_nama%', $namanya, $text);
		$set_total = str_replace('%mgo_total%', $harga_total, $set_nama);
		$set_produk = str_replace('%mgo_nama_produk%', $nama_produk, $set_total);
		$set_orderid = str_replace('%mgo_orderid%', $orderid, $set_produk);
		$set_ongkir = str_replace('%mgo_ongkos_kirim%', $harga_ongkir, $set_orderid);
		$set_wa = str_replace('%mgo_wa%', $wanya, $set_ongkir);
		$set_csname = str_replace('%mgo_csid%', $cs_name, $set_wa);
		$set_nobold = str_replace('%mgo_no_bold%', '', $set_csname);
		$text = set_whatsapp_format($set_nobold);
	}

	$text = str_replace("\\", '', $text);
	
    $urllink_whatsapp = 'https://api.whatsapp.com/send?phone='.$phone.'&text='.$detail_ordernya.$text;
    echo $urllink_whatsapp;

    wp_die();

} 
add_action( 'wp_ajax_myaction_chat_wacs', 'myaction_chat_wacs' );
add_action( 'wp_ajax_nopriv_myaction_chat_wacs', 'myaction_chat_wacs' );



// Generate new link to chat wa cs
function myaction_chat_wacs2() {
	
    global $wpdb;
		  
    $csid = $_POST['datanya'][0];
    $text = $_POST['datanya'][1];

    $phone = hp(get_the_author_meta('description',$csid));

	$text = str_replace("\\", '', $text);
	
    $urllink_whatsapp = 'https://api.whatsapp.com/send?phone='.$phone.'&text='.$text;
    echo $urllink_whatsapp;

    wp_die();

} 
add_action( 'wp_ajax_myaction_chat_wacs2', 'myaction_chat_wacs2' );
add_action( 'wp_ajax_nopriv_myaction_chat_wacs2', 'myaction_chat_wacs2' );



function autowacs_func( $atts, $content = "" ) {
	
	$atts = shortcode_atts( array(
		'csid' => null,
		'text' => null,
		'detailorder' => null,
		'title' => null,
		'time' => null,
		'type' => null
	), $atts, 'autowacs' );

  	$text_wa = 'Hello World!';
  	if($atts['text']!==null){
  		$text_wa = $atts['text'];
  		
  		$spintax = new Spintax();
		$text_wa = $spintax->process($text_wa);

  	}

  	$csid_wa = 1;
  	if($atts['csid']!==null){
  		$csid_wa = $atts['csid'];
  	}

  	$detailorder_wa = '';
  	if($atts['detailorder']!==null){
  		$detailorder_wa = $atts['detailorder'];
  	}

  	$title = '';
  	if($atts['title']!==null){
  		$title = $atts['title'];
  	}

  	$timenya = 1;
  	if($atts['time']!==null){
  		$timenya = $atts['time'];
  	}

  	$type = 'auto';
  	if($atts['type']!==null){
  		$type = $atts['type'];
  	}

  	if( $atts != null ) {
  		$string = '';
		foreach ($atts as $key => $value) {
			if($type=='button'){
				// var link = myaction_chat_wacs($orderid,$csid_wa,$text_wa,$detailorder_wa);
				$string = '<div class="div_autowacs"><a href="" target="_blank"><button class="btn_autowacs" id="btn_autowacs" data-csid="'.$csid_wa.'" data-time="'.$timenya.'" data-detailorder="'.$detailorder_wa.'" data-text="'.$text_wa.'" ><div><img src="'.plugin_dir_url( __FILE__ ).'assets/icons/wa_logo.png" /><span>'.$title.'</span></div></button></a></div>';
			}elseif($type=='link_cs'){
				// var link = myaction_chat_wacs($orderid,$csid_wa,$text_wa,$detailorder_wa);
				$string = '<div class="div_autowacs2"><a href="" target="_blank"><button class="btn_autowacs2" id="btn_autowacs2" data-csid="'.$csid_wa.'" data-time="'.$timenya.'" data-detailorder="'.$detailorder_wa.'" data-text="'.$text_wa.'" ><div><img src="'.plugin_dir_url( __FILE__ ).'assets/icons/wa_logo.png" /><span>'.$title.'</span></div></button></a></div>';
			}else{
				$string = '<div class="chat_cs" id="chat_cs" data-csid="'.$csid_wa.'" data-time="'.$timenya.'" data-detailorder="'.$detailorder_wa.'" data-text="'.$text_wa.'" style="text-align:center;">'.$title.'</div>';
			}
		}
		
		ob_start();

		return $string;

		$output = ob_get_clean();
		return $output;
  	}

}
add_shortcode( 'autowacs', 'autowacs_func' );



function mgopopup_func( $atts, $content = "" ) {
	
	global $wpdb;
	$table_name = $wpdb->prefix . "cf_form_entry_values";
    $table_name2 = $wpdb->prefix . "cf_form_entries";
	$table_name3 = $wpdb->prefix . "cf_forms";

	$atts = shortcode_atts( array(
		'form' => null, //done : wajib
		'style' => null, // 
		'verified' => null, //done : Mgo or etc | hide
		'title' => null, // done : spintax, %mgo_nama%,  %mgo_nama_produk%,  %mgo_provinsi%,  %mgo_kab_kota%,  %mgo_kecamatan%,  %mgo_total%
		'content' => null, // done : spintax, %mgo_nama%,  %mgo_nama_produk%,  %mgo_provinsi%,  %mgo_kab_kota%,  %mgo_kecamatan%, %mgo_total%
		'limit' => null, //done : 10 or etc
		'image' => null, //done : icon1, icon2, icon3, icon4, icon5 or etc | hide
		'tb' => null, //done : top or bottom
		'lcr' => null, //done : left, center, right
		'datelang' => null, //done : ind or eng | hide
		'timer' => null, //done : 5 or etc
		'close' => null, //done : true or false, //done : 5 or etc
		'anonim' => null //done : Anonim
	), $atts, 'mgopopup' );


	$form_id = '';
	if($atts['form']!==null){
  		$form_id = $atts['form'];
  	}

	$style = 'theme1';
	if($atts['style']!==null){
  		$style = $atts['style'];
  	}

	$verified = '<span class="popup_checklist">✓</span><span class="popup_checklist_text">Verified by Mgo</span>';
	if($atts['verified']!==null){
  		$verified = $atts['verified'];
  		if($verified=='hide'){
  			$verified = '';
  		}else{
  			$verified = '<span class="popup_checklist">✓</span><span class="popup_checklist_text">'.$verified.'</span>';
  		}
  	}

	$title = '%mgo_nama%';
	if($atts['title']!==null){
  		$title = $atts['title'];
  	}

	$content = 'Baru saja membeli';
	if($atts['content']!==null){
  		$content = $atts['content'];
  	}

	$limit = 10;
	if($atts['limit']!==null){
  		$limit = $atts['limit'];
  	}

  	$image = plugin_dir_url( __FILE__ ).'assets/icons/sales/bag.jpg';
  	$image = '<div class="popup_img"><img src="'.$image.'"></div>';
  	$image_hide = '';
	if($atts['image']!==null){
  		$image = $atts['image'];
  		$image = '<div class="popup_img"><img src="'.$image.'"></div>';

  		if($atts['image']=='icon1'){
  			$image = plugin_dir_url( __FILE__ ).'assets/icons/sales/bag.jpg';
  			$image = '<div class="popup_img"><img src="'.$image.'"></div>';
  		}
  		if($atts['image']=='icon2'){
  			$image = plugin_dir_url( __FILE__ ).'assets/icons/sales/bag2.jpg';
  			$image = '<div class="popup_img"><img src="'.$image.'"></div>';
  		}
  		if($atts['image']=='icon3'){
  			$image = plugin_dir_url( __FILE__ ).'assets/icons/sales/sale.jpg';
  			$image = '<div class="popup_img"><img src="'.$image.'"></div>';
  		}
  		if($atts['image']=='icon4'){
  			$image = plugin_dir_url( __FILE__ ).'assets/icons/sales/discount.jpg';
  			$image = '<div class="popup_img"><img src="'.$image.'"></div>';
  		}
  		if($atts['image']=='icon5'){
  			$image = plugin_dir_url( __FILE__ ).'assets/icons/sales/like.jpg';
  			$image = '<div class="popup_img"><img src="'.$image.'"></div>';
  		}
  		if($atts['image']=='icon6'){
  			$image = plugin_dir_url( __FILE__ ).'assets/icons/sales/donate1.jpg';
  			$image = '<div class="popup_img"><img src="'.$image.'"></div>';
  		}
  		if($atts['image']=='icon7'){
  			$image = plugin_dir_url( __FILE__ ).'assets/icons/sales/donate2.jpg';
  			$image = '<div class="popup_img"><img src="'.$image.'"></div>';
  		}
  		if($atts['image']=='icon8'){
  			$image = plugin_dir_url( __FILE__ ).'assets/icons/sales/donate3.jpg';
  			$image = '<div class="popup_img"><img src="'.$image.'"></div>';
  		}
  		if($atts['image']=='hide'){
  			$image = '';
  			$image_hide = 'img_hide';
  		}
  	}

	$tb = 'bottom';
	if($atts['tb']!==null){
  		$tb = strtolower($atts['tb']);
  	}
	
	$lcr = 'left';
	if($atts['lcr']!==null){
  		$lcr = strtolower($atts['lcr']);
  	}

	$datelang = 'ind';
	if($atts['datelang']!==null){
  		$datelang = $atts['datelang'];
  	}

	$timer = 5*1000;
	if($atts['timer']!==null){
  		$timer = $atts['timer']*1000;
  	}

	$close = 'false';
	if($atts['close']!==null){
  		$close = $atts['close'];
  	}

  	$anonim = 'Anonim';
	if($atts['anonim']!==null){
  		$anonim = $atts['anonim'];
  	}

	
  	// RUN MGO POPUP
  	if($form_id!=''){
  		
  		$query = "SELECT a.entry_id, b.form_id, a.value as nama, datestamp as date from $table_name as a  LEFT JOIN $table_name2 as b ON a.entry_id = b.id where a.slug = 'mgo_nama' and b.form_id='$form_id' ORDER BY `b`.`datestamp` DESC LIMIT 0,$limit";

		$get_data = $wpdb->get_results($query);

		// echo $query;

		$num = 1;
		$jumlah_arr = count($get_data);
		$the_data = '';
		foreach ($get_data as $key => $data) {
			
			if($jumlah_arr==$num){
				$comma = '';
			}else{
				$comma = ',';
			}

			$query_produk = "SELECT a.value from $table_name as a where a.entry_id = '$data->entry_id' and a.slug = 'mgo_nama_produk'";
			$q1 = $wpdb->get_results($query_produk);

			$query_provinsi = "SELECT a.value from $table_name as a where a.entry_id = '$data->entry_id' and a.slug = 'mgo_provinsi'";
			$q2 = $wpdb->get_results($query_provinsi);

			$query_kab_kota = "SELECT a.value from $table_name as a where a.entry_id = '$data->entry_id' and a.slug = 'mgo_kab_kota'";
			$q3 = $wpdb->get_results($query_kab_kota);

			$query_kecamatan = "SELECT a.value from $table_name as a where a.entry_id = '$data->entry_id' and a.slug = 'mgo_kecamatan'";
			$q4 = $wpdb->get_results($query_kecamatan);

			$query_total = "SELECT a.value from $table_name as a where a.entry_id = '$data->entry_id' and a.slug = 'mgo_total'";
			$q5 = $wpdb->get_results($query_total);

			$query_anonim = "SELECT a.value from $table_name as a where a.entry_id = '$data->entry_id' and a.slug = 'mgo_anonim'";
			$q6 = $wpdb->get_results($query_anonim);

			$query_produk1 = "SELECT a.value from $table_name as a where a.entry_id = '$data->entry_id' and a.slug like '%mgo_produk1.opt%'";
			$q_p1 = $wpdb->get_results($query_produk1);

			$query_produk2 = "SELECT a.value from $table_name as a where a.entry_id = '$data->entry_id' and a.slug like '%mgo_produk2.opt%'";
			$q_p2 = $wpdb->get_results($query_produk2);

			$query_produk3 = "SELECT a.value from $table_name as a where a.entry_id = '$data->entry_id' and a.slug like '%mgo_produk3.opt%'";
			$q_p3 = $wpdb->get_results($query_produk3);

			$query_produk4 = "SELECT a.value from $table_name as a where a.entry_id = '$data->entry_id' and a.slug like '%mgo_produk4.opt%'";
			$q_p4 = $wpdb->get_results($query_produk4);

			$query_produk5 = "SELECT a.value from $table_name as a where a.entry_id = '$data->entry_id' and a.slug like '%mgo_produk5.opt%'";
			$q_p5 = $wpdb->get_results($query_produk5);

			$get_nama = $data->nama;
			if(isset($q6[0]->value)){
				if (strpos(strtolower($q6[0]->value), 'ya') !== false ) {
					$get_nama = $anonim;
				}
			}

			// echo $q1[0]->value;

			$get_produk = '';
			if(isset($q1[0]->value)){
				$get_produk = $q1[0]->value;
			}
			$get_provinsi = '';
			if(isset($q2[0]->value)){
				$get_provinsi = $q2[0]->value;
			}
			$get_kab_kota = '';
			if(isset($q3[0]->value)){
				$get_kab_kota = $q3[0]->value;
			}
			$get_kecamatan = '';
			if(isset($q4[0]->value)){
				$get_kecamatan = $q4[0]->value;
			}
			$get_total = '';
			if(isset($q5[0]->value)){
				$get_total = $q5[0]->value;
			}
			$get_produk1 = '';
			if(isset($q_p1[0]->value)){
				$get_produk1 = $q_p1[0]->value;
			}
			$get_produk2 = '';
			if(isset($q_p2[0]->value)){
				$get_produk2 = $q_p2[0]->value;
			}
			$get_produk3 = '';
			if(isset($q_p3[0]->value)){
				$get_produk3 = $q_p3[0]->value;
			}
			$get_produk4 = '';
			if(isset($q_p4[0]->value)){
				$get_produk4 = $q_p4[0]->value;
			}
			$get_produk5 = '';
			if(isset($q_p5[0]->value)){
				$get_produk5 = $q_p5[0]->value;
			}

			if (strpos($get_kecamatan, ',') !== false) {
			    $pieces = explode(",", $get_kecamatan);
	      		$get_kecamatan = $pieces[0];
	      		$get_kab_kota  = $pieces[1];
	      		$get_provinsi  = $pieces[2];
			}

			// content
			$spintax = new Spintax();
			$spin = $spintax->process($title);
			$fix_title = str_replace('%mgo_nama%', $get_nama, $spin);
			$fix_title2 = str_replace('%mgo_nama_produk%', $get_produk, $fix_title);
			$fix_title3 = str_replace('%mgo_provinsi%', $get_provinsi, $fix_title2);
			$fix_title4 = str_replace('%mgo_kab_kota%', $get_kab_kota, $fix_title3);
			$fix_title5 = str_replace('%mgo_kecamatan%', $get_kecamatan, $fix_title4);
			$fix_title6 = str_replace('%mgo_total%', $get_total, $fix_title5);
			$fix_title7 = str_replace('%mgo_produk1%', $get_produk1, $fix_title6);
			$fix_title8 = str_replace('%mgo_produk2%', $get_produk2, $fix_title7);
			$fix_title9 = str_replace('%mgo_produk3%', $get_produk3, $fix_title8);
			$fix_title10 = str_replace('%mgo_produk4%', $get_produk4, $fix_title9);
			$fix_title11 = str_replace('%mgo_produk5%', $get_produk5, $fix_title10);

			// content
			$spintax2 = new Spintax();
			$spin2 = $spintax2->process($content);
			$fix_content = str_replace('%mgo_nama%', $get_nama, $spin2);
			$fix_content2 = str_replace('%mgo_nama_produk%', $get_produk, $fix_content);
			$fix_content3 = str_replace('%mgo_provinsi%', $get_provinsi, $fix_content2);
			$fix_content4 = str_replace('%mgo_kab_kota%', $get_kab_kota, $fix_content3);
			$fix_content5 = str_replace('%mgo_kecamatan%', $get_kecamatan, $fix_content4);
			$fix_content6 = str_replace('%mgo_total%', $get_total, $fix_content5);
			$fix_content7 = str_replace('%mgo_produk1%', $get_produk1, $fix_content6);
			$fix_content8 = str_replace('%mgo_produk2%', $get_produk2, $fix_content7);
			$fix_content9 = str_replace('%mgo_produk3%', $get_produk3, $fix_content8);
			$fix_content10 = str_replace('%mgo_produk4%', $get_produk4, $fix_content9);
			$fix_content11 = str_replace('%mgo_produk5%', $get_produk5, $fix_content10);

			// time
			$readtime = new Readtime();
			if($datelang=='ind'){
				$fix_time = $readtime->process_ind($data->date);
			}elseif($datelang=='eng'){
				$fix_time = $readtime->process_eng($data->date);
			}elseif($datelang=='hide'){
				$fix_time = '';
			}else{
				$fix_time = $readtime->process_eng($data->date);
			}

			$the_data .= '{"child": ["'.$fix_title11.'", "'.$fix_content11.'", "'.$fix_time.'", "'.$data->entry_id.'"]}'.$comma;

			$num = $num+1;

		}

		if($close=='true'){
			echo '<style>.toast-close {display:none;}</style>';
		}

		ob_start();

		echo '
	  	<script>

		splittedText = [
				'.$the_data.'
	        ];
	    jumlah_text = 0;
		function loopThroughSplittedText(splittedText) {
			jumlah_text = splittedText.length;
		    for (var i = 0; i < splittedText.length; i++) {
		        (function (i) {
		        })(i);
		    };
		}
		loopThroughSplittedText(splittedText);
		
		window.onload = function start() {
		    slide();
		}

		var a = 0;
		function slide() {
		    setInterval(function() {
		    	if(a==jumlah_text){
		    		a = 0;
		    	}

		        var titlenya = splittedText[a].child[0];
		        var contentnya = splittedText[a].child[1];
		        var timenya = splittedText[a].child[2];

		        Toastify({
				  text: '."'".'<div class="popup_box">'.$image.'<div class="popup_content '.$image_hide.'"><h3>'."'".'+titlenya+'."'".'</h3><p>'."'".'+contentnya+'."'".'</p><p class="popup_time">'."'".'+timenya+'."'".'</p><p class="popup_verified">'.$verified.'</p></div></div>'."'".',
				  duration: 5000,
				  newWindow: false,
				  close: '.$close.',
				  gravity: "'.$tb.'", // `top` or `bottom`
				  position: "'.$lcr.'", // `left`, `center` or `right`
				  backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
				  stopOnFocus: true, // Prevents dismissing of toast on hover
				  onClick: function(){} // Callback after click
				}).showToast();

		        a = a+1;

		    }, '.$timer.');
		}

		</script>';

		$output = ob_get_clean();
		return $output;


  	}
}
add_shortcode( 'mgopopup', 'mgopopup_func' );



function mgodonation_data_func( $atts, $content = "" ) {
	
	global $wpdb;
	$table_name = $wpdb->prefix . "cf_form_entry_values";
    $table_name2 = $wpdb->prefix . "cf_form_entries";
	$table_name3 = $wpdb->prefix . "cf_forms";
	$table_name4 = $wpdb->prefix . "mgo_orders";

	$atts = shortcode_atts( array(
		'form' => null, // id form caldera
		'color' => null, // red, black, yellow, purple, magenta, blue, green
		'width' => null, // fixed, auto
		'anonim' => null
	), $atts, 'mgodonation_data' );


	$form_id = '';
	if($atts['form']!==null){
  		$form_id = $atts['form'];
  	}

	$color = 'orange';
	if($atts['color']!==null){
  		$color = $atts['color'];
  	}

	$width = '';
	if($atts['width']!==null){
  		$width = $atts['width'];
  	}

	$anonim = 'Anonim';
	if($atts['anonim']!==null){
  		$anonim = $atts['anonim'];
  	}


  	if($form_id!=''){
  		
		$donation_paid = $wpdb->get_results("SELECT a.entry_id, c.form_id, a.value as nama, datestamp as date from $table_name as a 
			    	LEFT JOIN $table_name4 as b ON a.entry_id = b.entry_idnya
			    	LEFT JOIN $table_name2 as c ON a.entry_id = c.id
			    	where a.slug = 'mgo_total'
			    	and b.entry_idnya != ''
			    	and b.status_id = 1 and b.status_rts is null
			    	and c.form_id='$form_id' ORDER BY `c`.`datestamp` DESC LIMIT 0,5 ");

		// $jumlah = $wpdb->get_results("SELECT count(*) as jumlah_donasi from $table_name as a  LEFT JOIN $table_name2 as b ON a.entry_id = b.id where a.slug = 'mgo_nama' and b.form_id='$form_id' ");

		$jumlah = $wpdb->get_results("SELECT count(*) as jumlah_donasi from $table_name as a 
			    	LEFT JOIN $table_name4 as b ON a.entry_id = b.entry_idnya
			    	LEFT JOIN $table_name2 as c ON a.entry_id = c.id
			    	where a.slug = 'mgo_total'
			    	and b.entry_idnya != ''
			    	and b.status_id = 1 and b.status_rts is null
			    	and c.form_id='$form_id' ");


		$num = 1;
		$jumlah_arr = count($donation_paid);
		$the_data = '';
		foreach ($donation_paid as $key => $data) {
			
			if($jumlah_arr==$num){
				$comma = '';
			}else{
				$comma = ',';
			}

			$query_nama = "SELECT a.value from $table_name as a where a.entry_id = '$data->entry_id' and a.slug = 'mgo_nama'";
			$q0 = $wpdb->get_results($query_nama);

			$query_produk = "SELECT a.value from $table_name as a where a.entry_id = '$data->entry_id' and a.slug = 'mgo_nama_produk'";
			$q1 = $wpdb->get_results($query_produk);

			$query_total = "SELECT a.value from $table_name as a where a.entry_id = '$data->entry_id' and a.slug = 'mgo_total'";
			$q2 = $wpdb->get_results($query_total);

			$query_komentar = "SELECT a.value from $table_name as a where a.entry_id = '$data->entry_id' and a.slug = 'mgo_komentar'";
			$q3 = $wpdb->get_results($query_komentar);

			$query_anonim = "SELECT a.value from $table_name as a where a.entry_id = '$data->entry_id' and a.slug = 'mgo_anonim'";
			$q4 = $wpdb->get_results($query_anonim);


			$get_nama = '';
			if(isset($q0[0]->value)){
				$get_nama = $q0[0]->value;
			}

			if(isset($q4[0]->value)){

				if (strpos(strtolower($q4[0]->value), 'ya') !== false ) {
					// $get_total = str_replace('Rp', '', $get_total);
					$get_nama = $anonim;
				}
			}

			$get_produk = '';
			if(isset($q1[0]->value)){
				$get_produk = $q1[0]->value;
			}
			$get_total = '';
			if(isset($q2[0]->value)){
				$get_total = $q2[0]->value;
			}
			$get_komentar = '';
			if(isset($q3[0]->value)){
				$get_komentar = $q3[0]->value;
			}

			// time
			$readtime = new Readtime();
			$fix_time = $readtime->process_ind_donation($data->date);

			if (strpos($get_total, 'Rp') !== false ) {
				$get_total = str_replace('Rp', '', $get_total);
			}

			$the_data .= '<div class="donation_inner_box"><div class="donation_name">'.$get_nama.'<span class="donation_time"><span class="dashicons dashicons-clock"></span>'.$fix_time.'</span></div><div class="donation_total">Donasi '.$get_total.'</div><div class="donation_comment">'.$get_komentar.'</div></div>';

			$num = $num+1;

		}

		$randomid = GenerateID(5);
		$boxid = 'box_'.$randomid;

		if($width=='auto'){
			$set_width = 'style="width:100%;"';
		}else{
			$set_width = '';
		}

		ob_start();
		echo '<div class="donation_box '.$color.'" '.$set_width.'><div id="'.$boxid.'"><div class="donation_count">Donasi ('.$jumlah[0]->jumlah_donasi.' Donatur)</div>'.$the_data.'</div><div id="box_btn_'.$randomid.'"  class="donation_button"><div class="loadmore_info"></div><button id="'.$randomid.'" class="load_donatur" data-id="'.$form_id.'" data-count="2">Loadmore</button></div></div>';
		$output = ob_get_clean();
		return $output;

  	}

}
add_shortcode( 'mgodonation_data', 'mgodonation_data_func' );




// Chat WA CS after SUBMIT FORM
function myaction_load_donatur() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "cf_form_entry_values";
    $table_name2 = $wpdb->prefix . "cf_form_entries";
	$table_name3 = $wpdb->prefix . "cf_forms";
	$table_name4 = $wpdb->prefix . "mgo_orders";
    
    $id = $_POST['datanya'][0];
    $form_id = $_POST['datanya'][1];
    $load_count = $_POST['datanya'][2];
    $start = ($load_count-1)*5;
    $limit = 5;

    if($form_id!=''){
  		
		$donation_paid = $wpdb->get_results("SELECT a.entry_id, c.form_id, a.value as nama, datestamp as date from $table_name as a 
			    	LEFT JOIN $table_name4 as b ON a.entry_id = b.entry_idnya
			    	LEFT JOIN $table_name2 as c ON a.entry_id = c.id
			    	where a.slug = 'mgo_total'
			    	and b.entry_idnya != ''
			    	and b.status_id = 1 and b.status_rts is null
			    	and c.form_id='$form_id' ORDER BY `c`.`datestamp` DESC LIMIT $start,$limit ");

		$num = 1;
		$jumlah_arr = count($donation_paid);
		$the_data = '';
		foreach ($donation_paid as $key => $data) {
			
			if($jumlah_arr==$num){
				$comma = '';
			}else{
				$comma = ',';
			}

			$query_nama = "SELECT a.value from $table_name as a where a.entry_id = '$data->entry_id' and a.slug = 'mgo_nama'";
			$q0 = $wpdb->get_results($query_nama);

			$query_produk = "SELECT a.value from $table_name as a where a.entry_id = '$data->entry_id' and a.slug = 'mgo_nama_produk'";
			$q1 = $wpdb->get_results($query_produk);

			$query_total = "SELECT a.value from $table_name as a where a.entry_id = '$data->entry_id' and a.slug = 'mgo_total'";
			$q2 = $wpdb->get_results($query_total);

			$query_komentar = "SELECT a.value from $table_name as a where a.entry_id = '$data->entry_id' and a.slug = 'mgo_komentar'";
			$q3 = $wpdb->get_results($query_komentar);

			$get_nama = '';
			if(isset($q0[0]->value)){
				$get_nama = $q0[0]->value;
			}
			$get_produk = '';
			if(isset($q1[0]->value)){
				$get_produk = $q1[0]->value;
			}
			$get_total = '';
			if(isset($q2[0]->value)){
				$get_total = $q2[0]->value;
			}
			$get_komentar = '';
			if(isset($q3[0]->value)){
				$get_komentar = $q3[0]->value;
			}

			// time
			$readtime = new Readtime();
			$fix_time = $readtime->process_ind($data->date);
			

			if (strpos($get_total, 'Rp') !== false ) {
				$get_total = str_replace('Rp', '', $get_total);
			}

			$the_data .= '<div class="donation_inner_box"><div class="donation_name">'.$get_nama.'<span class="donation_time"><span class="dashicons dashicons-clock"></span>'.$fix_time.'</span></div><div class="donation_total">Donasi '.$get_total.'</div><div class="donation_comment">'.$get_komentar.'</div></div>';

			$num = $num+1;

		}

		echo $the_data;


  	}


    wp_die();

} 
add_action( 'wp_ajax_myaction_load_donatur', 'myaction_load_donatur' );
add_action( 'wp_ajax_nopriv_myaction_load_donatur', 'myaction_load_donatur' );



function mgodonation_total_func( $atts, $content = "" ) {
	
	global $wpdb;
	$table_name = $wpdb->prefix . "cf_form_entry_values";
    $table_name2 = $wpdb->prefix . "cf_form_entries";
	$table_name3 = $wpdb->prefix . "cf_forms";
	$table_name4 = $wpdb->prefix . "mgo_orders";

	$atts = shortcode_atts( array(
		'form' => null, // id form caldera
		'target' => null, // target => integer / number example : 1juta => 10000000
		'width' => null, // fixed, auto
		'date' => null // "yyyy-mm-dd" => "2020-04-25"
	), $atts, 'mgodonation_total' );


	$form_id = '';
	if($atts['form']!==null){
  		$form_id = $atts['form'];
  	}

	$target = 1;
	if($atts['target']!==null){
  		$target = $atts['target'];
  		if($target==0){
  			$target = 1;
  		}
  	}

  	$width = '';
	if($atts['width']!==null){
  		$width = $atts['width'];
  	}

  	$date = '';
	if($atts['date']!==null){
  		$date = $atts['date'];
  	}

  	if($form_id!=''){
  		
		// $get_data = $wpdb->get_results("SELECT a.entry_id from $table_name as a  LEFT JOIN $table_name2 as b ON a.entry_id = b.id where a.slug = 'mgo_total' and b.form_id='$form_id' ORDER BY `b`.`datestamp`");

		$donation_paid = $wpdb->get_results("SELECT a.entry_id from $table_name as a 
			    	LEFT JOIN $table_name4 as b ON a.entry_id = b.entry_idnya
			    	LEFT JOIN $table_name2 as c ON a.entry_id = c.id
			    	where a.slug = 'mgo_total'
			    	and b.entry_idnya != ''
			    	and b.status_id = 1 and b.status_rts is NULL
			    	and c.form_id='$form_id' ORDER BY `c`.`datestamp` ");

		// print_r($donation_paid);
		// return false;

		$jml_donasi = 0;
		foreach ($donation_paid as $key => $data) {

			$query_total = "SELECT a.value from $table_name as a where a.entry_id = '$data->entry_id' and a.slug = 'mgo_total'";
			$q0 = $wpdb->get_results($query_total);

			$get_total = '';
			if(isset($q0[0]->value)){
				$get_total = $q0[0]->value;
			}

			if (strpos($get_total, 'Rp') !== false ) {
				$get_total1 = str_replace('Rp', '', $get_total);
				$get_total2 = str_replace('.', '', $get_total1);
			}

			$jml_donasi = $jml_donasi+(float)$get_total2;
		}

		if (strpos($target, '~') !== false) {
			$targetnya = explode("~", $target);
			$angka_target = $targetnya[1];
		}else{
			$angka_target = $target;
		}

	  	$hasil_donasi = ($jml_donasi/$angka_target)*100; 
	  	$hasil_donasi = number_format($hasil_donasi,1);
	  	if($hasil_donasi>=100){
	  		$hasil_donasi = 100;
	  	}
	  	if($hasil_donasi>=90){
	  		$color_bar = 'full_green';
	  	}else{
  			$color_bar = '';
	  	}
	  	if($hasil_donasi<=10){
	  		$persen_donasi = '';
	  	}else{
	  		$persen_donasi = '<div class="count_progress">'.$hasil_donasi.'%</div>';
	  	}

	  	// Date
	  	if($date==''){
	  		$sisa_waktu = '';
	  	}else{
	  		$date_now = date('Y-m-d');
	  		$datetime1 = new DateTime($date_now);
			$datetime2 = new DateTime($date);
			$hasil = $datetime1->diff($datetime2);
		 	
			$year = $hasil->y;
			$month = $hasil->m;
			$day = $hasil->d;

			if($year!=0){
				$sisa_waktu = '( '.$year.' tahun, ' .$month.' bulan, ' .$day.' lagi )';
			}else{
				if($month!=0){
					$sisa_waktu = '( '.$month.' bulan, ' .$day.' hari lagi )';
				}else{
					if($day==0 && $hasil->days==0){
						$sisa_waktu = '<span>( Program akan berakhir hari ini )</span>';
					}else{
						if($hasil->invert==true){
							$sisa_waktu = '<span style="font-style:italic;color:#FBAE59;">( Program sudah selesai )</span>';
						}else{
							$sisa_waktu = '( '.$day.' hari lagi )';
						}
						
					}
				}
			}
			

	  	}

	  	if($width=='auto'){
			$set_width = 'style="width:100%;"';
		}else{
			$set_width = '';
		}

		if (strpos($target, '~') !== false) {
			$value_target = '~';
		}else{
			$value_target = 'Rp '.number_format($angka_target , 0, ',', '.');
		}


		ob_start();

		echo '
		<div class="donation_box2" '.$set_width.'>
			<span class="d_total">Rp '.number_format($jml_donasi , 0, ',', '.').'</span><span class="d_target"><span class="d_target_text">terkumpul dari target </span><span class="d_target_nilai"><b>'.$value_target.'</b></span></span><span class="d_date">'.$sisa_waktu.'</span>
			<div class="donation_progress" data-total="'.$jml_donasi.'" data-target="'.$target.'">
				<div class="donation_progress_bar '.$color_bar.'" style="width:'.$hasil_donasi.'%">'.$persen_donasi.'</div>
			</div>
		</div>';

		$output = ob_get_clean();
		return $output;


  	}
}
add_shortcode( 'mgodonation_total', 'mgodonation_total_func' );




function mgodata_total_func( $atts, $content = "" ) {
	
	global $wpdb;
	$table_name = $wpdb->prefix . "cf_form_entry_values";
    $table_name2 = $wpdb->prefix . "cf_form_entries";
	$table_name3 = $wpdb->prefix . "cf_forms";
	$table_name4 = $wpdb->prefix . "mgo_orders";

	$atts = shortcode_atts( array(
		'form' => null, // id form caldera
		'confirm' => null
	), $atts, 'mgodata_total' );


	$form_id = '';
	if($atts['form']!==null){
  		$form_id = $atts['form'];
  	}

	$confirm = '';
	if($atts['confirm']!==null){
  		$confirm = $atts['confirm'];
  	}



  	if($form_id!=''){
  		
		$donation_paid = $wpdb->get_results("SELECT a.entry_id, c.form_id, a.value as nama, datestamp as date from $table_name as a 
			    	LEFT JOIN $table_name4 as b ON a.entry_id = b.entry_idnya
			    	LEFT JOIN $table_name2 as c ON a.entry_id = c.id
			    	where a.slug = 'mgo_orderid'
			    	and b.entry_idnya != ''
			    	and b.status_id = 1 and b.status_rts is null
			    	and c.form_id='$form_id' ORDER BY `c`.`datestamp` DESC LIMIT 0,5 ");

		$jumlah = $wpdb->get_results("SELECT count(*) as total from $table_name as a 
			    	LEFT JOIN $table_name4 as b ON a.entry_id = b.entry_idnya
			    	LEFT JOIN $table_name2 as c ON a.entry_id = c.id
			    	where a.slug = 'mgo_orderid'
			    	and b.entry_idnya != ''
			    	and b.status_id = 1 and b.status_rts is null
			    	and c.form_id='$form_id' ");

		// $jumlah_arr = count($donation_paid);

		// echo $jumlah_arr;
		// echo '<br>';
		echo $jumlah[0]->total;

  	}else{

  		
  		$donation_paid = $wpdb->get_results("SELECT a.entry_id, a.value as nama from $table_name as a 
			    	LEFT JOIN $table_name4 as b ON a.entry_id = b.entry_idnya
			    	where a.slug = 'mgo_orderid'
			    	and b.entry_idnya != ''
			    	and b.status_id = 1 and b.status_rts is null ");

		$jumlah = $wpdb->get_results("SELECT count(*) as total from $table_name as a 
			    	LEFT JOIN $table_name2 as b ON a.entry_id = b.id
			    	where a.slug = 'mgo_orderid'
			    	and b.status = 'active' ");

		$jumlah_arr = count($donation_paid);

		ob_start();

		echo $jumlah_arr;
		echo '<br>';
		echo $jumlah[0]->total;

		$output = ob_get_clean();
		return $output;
		

  	}

}
add_shortcode( 'mgodata_total', 'mgodata_total_func' );


function secondsToTime($inputSeconds) {
    $secondsInAMinute = 60;
    $secondsInAnHour = 60 * $secondsInAMinute;
    $secondsInADay = 24 * $secondsInAnHour;
    $secondsInAWeek = 7 * $secondsInADay;
    $secondsInAMonth = 30 * $secondsInADay;

    // Extract days
    $months = floor($inputSeconds / $secondsInAMonth);

    $weeks = floor($inputSeconds / $secondsInAWeek);

    $days = floor($inputSeconds / $secondsInADay);

    // Extract hours
    $hourSeconds = $inputSeconds % $secondsInADay;
    $hours = floor($hourSeconds / $secondsInAnHour);

    // Extract minutes
    $minuteSeconds = $hourSeconds % $secondsInAnHour;
    $minutes = floor($minuteSeconds / $secondsInAMinute);

    // Extract the remaining seconds
    $remainingSeconds = $minuteSeconds % $secondsInAMinute;
    $seconds = ceil($remainingSeconds);

    // Format and return
    $timeParts = [];
    // $sections = [
    //     'month' => (int)$months,
    //     'week' => (int)$weeks,
    //     'day' => (int)$days,
    //     'hour' => (int)$hours,
    //     'minute' => (int)$minutes,
    //     'second' => (int)$seconds,
    // ];

    $sections = [
        'bulan' => (int)$months,
        'minggu' => (int)$weeks,
        'hari' => (int)$days,
        'jam' => (int)$hours,
        'menit' => (int)$minutes,
        'detik' => (int)$seconds,
    ];

    $no = 1;
    $bulan = 0;
    $minggu = 0;
    $hari = 0;
    $count_arr = count($sections);
    foreach ($sections as $name => $value){
        if ($value > 0){
        	if($no<=2){
        		// set for bulan dan hari
        		if($name=='bulan'){
        			$bulan = $value;
        		}
        		if($name=='minggu' && $bulan!=0){
        			$value = $value - ($bulan*4);
        			if($value==0){
        				$name = '';
        				$value = '';
        			}
        		}

        		// set for minggu dan hari
        		if($name=='minggu'){
        			$minggu = $value;
        		}
        		if($name=='hari' && $minggu!=0){
        			$value = $value - ($minggu*7);
        		}

        		$timeParts[] = $value. ' '.$name.($value == 1 ? '' : '');
        		
        	}
            $no++;
        }
    }

    return implode(', ', $timeParts);
}


class Readtime {

	public function process_ind_donation($time) { 

		global $wpdb;
		$table_name = $wpdb->prefix . "mgo_settings";
	    $mgo_settings = $wpdb->get_results('SELECT data from '.$table_name.' where type="utc_status" or type="utc_value" ORDER BY id ASC');
	    $utc_status = $mgo_settings[0]->data;
	    $utc_value = $mgo_settings[1]->data;

		$timestamp = strtotime($time);	
	   
	    $strTime = array("detik", "menit", "jam", "hari", "bulan", "tahun");
	    $length = array("60","60","24","30","12","10");

	    $currentTime = time();
	    if($currentTime >= $timestamp) {
	    	if($utc_status==1){
	    		$diff     = time()- $timestamp + ((60*60)*($utc_value));
	    	}else{
	    		$diff     = time()- $timestamp + ((60*60)*-7);
	    	}
			
			for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
			$diff = $diff / $length[$i];
			}

			$diff = round($diff);
			return $diff . " " . $strTime[$i] . " yang lalu ";
	    }
	}


	public function process_ind($time) { 

		global $wpdb;
		$table_name = $wpdb->prefix . "mgo_settings";
	    $mgo_settings = $wpdb->get_results('SELECT data from '.$table_name.' where type="utc_status" or type="utc_value" ORDER BY id ASC');
	    $utc_status = $mgo_settings[0]->data;
	    $utc_value = $mgo_settings[1]->data;

		$timestamp = strtotime($time);	
	   
	    $strTime = array("detik", "menit", "jam", "hari", "bulan", "tahun");
	    $length = array("60","60","24","30","12","10");

	    $currentTime = time();
	    if($currentTime >= $timestamp) {
	    	if($utc_status==1){
	    		$diff     = time()- $timestamp + ((60*60)*($utc_value));
	    	}else{
	    		$diff     = time()- $timestamp + ((60*60)*-7);
	    	}
			
			for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
			$diff = $diff / $length[$i];
			}

			$diff = round($diff);
			return $diff . " " . $strTime[$i] . " yang lalu ";
	    }

	}

	public function process_eng($time) {

		global $wpdb;
		$table_name = $wpdb->prefix . "mgo_settings";
	    $mgo_settings = $wpdb->get_results('SELECT data from '.$table_name.' where type="utc_status" or type="utc_value" ORDER BY id ASC');
	    $utc_status = $mgo_settings[0]->data;
	    $utc_value = $mgo_settings[1]->data;

		$timestamp = strtotime($time);	
	   
	    $strTime = array("second", "minute", "hour", "day", "month", "year");
	    $length = array("60","60","24","30","12","10");

	    $currentTime = time();
	    if($currentTime >= $timestamp) {
			if($utc_status==1){
	    		$diff     = time()- $timestamp + ((60*60)*($utc_value));
	    	}else{
	    		$diff     = time()- $timestamp + ((60*60)*-7);
	    	}

			for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
			$diff = $diff / $length[$i];
			}

			$diff = round($diff);
			return $diff . " " . $strTime[$i] . "(s) ago ";
	    }
	} 

	public function process_eng_data_order($time) { 

		global $wpdb;
		$table_name = $wpdb->prefix . "mgo_settings";
	    $mgo_settings = $wpdb->get_results('SELECT data from '.$table_name.' where type="utc_status" or type="utc_value" ORDER BY id ASC');
	    $utc_status = $mgo_settings[0]->data;
	    $utc_value = $mgo_settings[1]->data;

		$timestamp = strtotime($time);	
		$timestamp = strtotime('-7 hours', $timestamp);
	   
	    $strTime = array("detik", "menit", "jam", "hari", "bulan", "tahun");
	    // $strTime = array("second", "minute", "hour", "day", "month", "year");
	    $length = array("60","60","24","30","12","10");

	    $currentTime = time();
	    if($currentTime >= $timestamp) {
	    	if($utc_status==1){
	    		$diff     = time()- $timestamp + ((60*60)*($utc_value)) + ((60*60)*-7);
	    	}else{
	    		$diff     = time()- $timestamp + ((60*60)*7) + ((60*60)*-7);
	    	}

	    	if($diff<0){
	    		$diff     = time()- $timestamp + ((60*60)*7);
	    	}
			
			for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
				$diff = $diff / $length[$i];
			}

			$diff = round($diff);

			if($diff<0){
			    return "";
			}else{
			    return $diff . " " . $strTime[$i] . " yang lalu ";
			}
			// return $diff . " " . $strTime[$i] . "(s) ago ";

	    }
	}

}



// show detail order on thankyou page
function myaction_get_detail_order() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "cf_form_entry_values";
    $table_name2 = $wpdb->prefix . "mgo_settings";
    $table_name5 = $wpdb->prefix . "cf_form_entries";
	$table_name6 = $wpdb->prefix . "cf_forms";

    $orderid = $_POST['datanya'][0];

    // cek nama produk setting
    $query_title_settings = $wpdb->get_results('SELECT data from '.$table_name2.' where type="nama_produk_status" or type="nama_produk_other_name" or type="order_id_status" or type="order_id_other_name" ORDER BY id ASC');
    $nama_produk_status = $query_title_settings[0]->data;
    $nama_produk_other_name = $query_title_settings[1]->data;
    $order_id_status = $query_title_settings[2]->data;
    $order_id_other_name = $query_title_settings[3]->data;

    if($nama_produk_status=='1'){
        $nama_produknya = 'Nama Program';
    }elseif($nama_produk_status=='2'){
        $nama_produknya = 'Nama Kegiatan';
    }elseif($nama_produk_status=='3'){
        $nama_produknya = $nama_produk_other_name;
    }else{
        $nama_produknya = 'Nama Produk';
    }

    if($order_id_status=='1'){
        $order_id_set = 'Invoice ID';
    }elseif($order_id_status=='2'){
        $order_id_set = 'Donation ID';
    }elseif($order_id_status=='3'){
        $order_id_set = $order_id_other_name;
    }else{
        $order_id_set = 'Order ID';
    }

    
	//********************************
	//CHECK ORDER-ID
	//*********************************
    $row = $wpdb->get_results('SELECT * from '.$table_name.' where value="'.$orderid.'" ');
    if($row!=null){

    	$entry_id = $row[0]->entry_id;

    	// **************************
		// GET DETAIL ORDER
		// ***************************	    	
		$get_formid = $wpdb->get_results('SELECT form_id from '.$table_name5.' where id="'.$entry_id.'" ');
	    $cek_form_on_caldera = $wpdb->get_results('SELECT * from '.$table_name6.' where form_id="'.$get_formid[0]->form_id.'" and type="primary"');

		if($cek_form_on_caldera != null){
			$form_id = $get_formid[0]->form_id;
			$get_urutan_field = $wpdb->get_results('SELECT config from '.$table_name6.' where type="primary" and form_id="'.$form_id.'" ');
			$dataconfig = json_encode(maybe_unserialize( $get_urutan_field[0]->config ));
		    $datajson = json_decode($dataconfig);

	        // print_r($datajson->layout_grid->fields);
	        $i=1;
	        $len = 0;
	        foreach ($datajson->layout_grid->fields as $key=>$row) {
	            $len++;
	        }

	        $data_query = '';
	        foreach ($datajson->layout_grid->fields as $key=>$row) {
	        	
	            if($len==$i){
	            	$data_query .= "SELECT * from $table_name where entry_id=$entry_id and field_id='$key' ";
	            }else{
	            	$data_query .= "SELECT * from $table_name where entry_id=$entry_id and field_id='$key' UNION ";
	            }
			 
	            $i++;

	        }
	        $query = $wpdb->get_results("$data_query");
	    }else{
	    	$query = $wpdb->get_results('SELECT * from '.$table_name.' where entry_id="'.$entry_id.'" ORDER BY id ASC');
	    }
	    

	    $content = '';
	    $totalharga = '';
	    foreach ($query as $row) {
	    	$isi = $row->value;
	    	
	    	// get data checkbox
			$x = '';
			if (strpos($isi, '{"opt') !== false) {

				$data_array =json_decode($isi, true);
				$n = 1;
				$l = count($data_array);

				foreach($data_array as $key=>$value){
					if($l==$n){
						$x .= $value.'';
					}else{
						$x .= $value.', '; // add comma
					}
                	$n++;
				}
				$isi = $x;
			}

	    	if($isi!='click'){
	    		$pieces = explode("_", $row->slug);
	      		$mgo = $pieces[0];
	      		if($mgo=='mgo'){
	      			if($row->slug!='mgo_pembayaran'){
	      				if($pieces[1]!='csid'){
	      					if($pieces[1]!='csmail'){
	      						if($pieces[1]!='cswa'){
		      						if($pieces[1]!='orderid2'){
		      							// if($pieces[1]!='kupon'){
						      				if($pieces[1]=='total'){
						      					if (strpos($isi, 'Rp') !== false) {
												    $totalharga = explode("Rp", $isi);
							      					$totalharga = "Rp ".str_replace(",",".",$totalharga[1]);
							      					$isi = $totalharga;
												}else{
													$totalharga = "Rp ".number_format($isi,0,",",".");
													$isi = $totalharga;
												}
						      				}
						      				if($pieces[1]=='dp' || $pieces[1]=='sisa'){
						      					if (strpos($isi, 'Rp') !== false) {
												    $totalvalue = explode("Rp", $isi);
							      					$totalvalue = "Rp ".str_replace(",",".",$totalvalue[1]);
							      					$isi = $totalvalue;
												}else{
													$totalvalue = "Rp ".number_format($isi,0,",",".");
													$isi = $totalvalue;
												}
						      				}
						      				if($pieces[1]=='item' && $pieces[2]=='total'){
						      					if (strpos($isi, 'Rp') !== false) {
												    $itemtotal = explode("Rp", $isi);
							      					$itemtotal = "Rp ".str_replace(",",".",$itemtotal[1]);
							      					$isi = $itemtotal;
												}
						      				}
						      				if (strpos($row->slug, '.opt') !== false) { // checkbox value > check
					    					}else{
					    						if($pieces[1]=='orderid'){
							      					$judulnya = 'Order ID';
							      				}else{

							      					if($pieces[1]=='rp'){
								      					if (strpos($isi, '.') !== false) {
							      							$isi = 'Rp '.$isi;
							      						}else{
							      							$isi = 'Rp '.number_format($isi, 0, ',', '.');
							      						}
								      					$judulnya1 = str_replace('mgo_rp_','',$row->slug);
								      					$judulnya2 = str_replace('mgo_','',$judulnya1);
								      					$judulnya3 = str_replace('_',' ',$judulnya2);
								      					$judulnya = ucwords($judulnya3);
								      				}else{
								      					
								    					$judulnya1 = str_replace('mgo_','',$row->slug);
								      					$judulnya2 = str_replace('_',' ',$judulnya1);
								      					$judulnya = ucwords($judulnya2);

							      					}
							      				}
							      				if (strpos($judulnya, '.opt') !== false) {
													$slugnya = explode(".opt", $judulnya);
													$judulnya = $slugnya[0];
												}
												if($row->slug=='mgo_courier'){
													$isi = strtoupper($isi);
												}
												if($judulnya!='Anonim'){

													if($judulnya=='Nama Produk'){
														$judulnya = $nama_produknya;
													}

													if($judulnya=='Order ID'){
														$judulnya = $order_id_set;
													}

													if($judulnya=='Wa'){
														$judulnya = 'Whatsapp';
													}

						    						$content .= '<tr><td valign="top" style="padding-left: 0;padding-bottom:0px;">'.$judulnya.'</td><td valign="top" style="padding-bottom:0px;width: 10px;">:</td><td valign="top" style="padding-right: 0;padding-bottom:0px;"> <b>'.$isi.'</b> </td></tr>';
						    					}
					    					}
				    					// }
			    					}
			    				}
	    					}
	    				}
	    			}
	    		}
	    		
	    	}
	    }
	    $content_fixed = str_replace('JdanT', 'J&T', $content);

	    echo '<table><tbody style="font-size: 12px;">';
	    echo $content_fixed;
	    echo '</tbody></table>';

	}else{
		echo "No Data.";
	}


    wp_die();

} 
add_action( 'wp_ajax_myaction_get_detail_order', 'myaction_get_detail_order' );
add_action( 'wp_ajax_nopriv_myaction_get_detail_order', 'myaction_get_detail_order' );


// show detail order on thankyou page
function myaction_get_nama() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "cf_form_entry_values";

    $orderid = $_POST['datanya'][0];

    /********************************
	CHECK ORDER-ID
	***************************/
    $row = $wpdb->get_results('SELECT * from '.$table_name.' where value="'.$orderid.'" ');
    if($row!=null){

    	$entry_id = $row[0]->entry_id;

    	/**************************
		GET DETAIL ORDER
		************************/
		$query = $wpdb->get_results('SELECT * from '.$table_name.' where entry_id="'.$entry_id.'" and slug="mgo_nama" ORDER BY id ASC');
	    if($query!=null){
	    	echo $query[0]->value;
	    }else{
	    	echo 'No Data2.';
	    }

	}else{
		echo "No Data.";
	}


    wp_die();

} 
add_action( 'wp_ajax_myaction_get_nama', 'myaction_get_nama' );
add_action( 'wp_ajax_nopriv_myaction_get_nama', 'myaction_get_nama' );


// show detail order on thankyou page
function myaction_set_countdown_typ() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "cf_form_entry_values";
    $table_name2 = $wpdb->prefix . "cf_form_entries";
    $table_name3 = $wpdb->prefix . "mgo_settings";

    $orderid = $_POST['datanya'][0];
    $time_countdown = $_POST['datanya'][1];

    /********************************
	CHECK ORDER-ID
	***************************/
    $row = $wpdb->get_results('SELECT * from '.$table_name.' where value="'.$orderid.'" ');
    if($row!=null){

    	$entry_id = $row[0]->entry_id;

    	/************************
		GET DETAIL ORDER
		************************/
		$query = $wpdb->get_results('SELECT * from '.$table_name.' where entry_id="'.$entry_id.'" and slug="mgo_pembayaran" ORDER BY id ASC');
		$query2 = $wpdb->get_results('SELECT * from '.$table_name2.' where id="'.$entry_id.'" and status="active"');
	    if($query!=null){
	    	$banknya = strtolower($query[0]->value);
	    	$date = $query2[0]->datestamp;

	    	if($bank=='cash' || $bank=='tunai' ||  $bank=='cod' ||  $bank=='tad'){
	    		echo 'cod';
	    	}else{

	    		date_default_timezone_set('GMT');
            	//set an date and time to work with

			    $mgo_settings = $wpdb->get_results('SELECT data from '.$table_name3.' where type="utc_status" or type="utc_value" or type="utc_status_dataorder" or type="utc_value_dataorder" ORDER BY id ASC');
			    $utc_status = $mgo_settings[0]->data;
			    $utc_value = $mgo_settings[1]->data;
			    $utc_status_dataorder = $mgo_settings[2]->data;
			    $utc_value_dataorder = $mgo_settings[3]->data;
	            
	            // plus 3 jam = 7+6 = 11
	            if($time_countdown==null || $time_countdown==''){
	            	$time_countdown = 6;
	            }
	            $time_countdown_fixed = 7+$time_countdown;
	            $time_now_dataorder = date('Y-m-d H:i:s',strtotime('+'.$time_countdown_fixed.' hour',strtotime($date)));
				
				if($utc_status_dataorder==1){
					// plus 3 jam = 7+6 = 11
					$jam_tambahan = $utc_value_dataorder+$time_countdown_fixed;
					if($jam_tambahan<0){
						$tandabaca = '-';
					}else{
						$tandabaca = '+';
					}
			    	$time_now_dataorder = date('Y-m-d H:i:s',strtotime("$tandabaca$jam_tambahan hour",strtotime($date)));
			    }

			    echo $time_now_dataorder;

	    	}
	    	
	    }else{
	    	echo 'nodata';
	    }

	}else{
		echo 'nodata';
	}


    wp_die();

} 
add_action( 'wp_ajax_myaction_set_countdown_typ', 'myaction_set_countdown_typ' );
add_action( 'wp_ajax_nopriv_myaction_set_countdown_typ', 'myaction_set_countdown_typ' );


// show detail order on thankyou page
function myaction_get_total() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "cf_form_entry_values";

    $orderid = $_POST['datanya'][0];

    /********************************
	CHECK ORDER-ID
	***************************/
    $row = $wpdb->get_results('SELECT * from '.$table_name.' where value="'.$orderid.'" ');
    if($row!=null){

    	$entry_id = $row[0]->entry_id;

    	/**************************
		GET DETAIL ORDER
		************************/
		$query = $wpdb->get_results('SELECT * from '.$table_name.' where entry_id="'.$entry_id.'" and slug="mgo_total" ORDER BY id ASC');
	    if($query!=null){
	    	echo $query[0]->value;
	    }else{
	    	echo 'No Data...';
	    }

	}else{
		echo "No Data.";
	}


    wp_die();

} 
add_action( 'wp_ajax_myaction_get_total', 'myaction_get_total' );
add_action( 'wp_ajax_nopriv_myaction_get_total', 'myaction_get_total' );



function mgopixel_func( $atts, $content = "" ) {
	

	// [mgopixel pixel="you-pixel-id" event="your-event" parameter="source:thankyou-page,value:auto,currency:IDR"]

	global $wpdb;

	$atts = shortcode_atts( array(
		'pixel' => null,
		'event' => null,
		'parameter' => null
	), $atts, 'mgopixel' );


	$pixel = '';
	if($atts['pixel']!==null){
  		$pixel = $atts['pixel'];
  	}

	$event = '';
	if($atts['event']!==null){
  		$event = $atts['event'];
  	}

	$parameter = '';
	if($atts['parameter']!==null){
  		$parameter = $atts['parameter'];
  	}

  	$fix_par = '';
  	$value_idr = '';
  	if($parameter!=''){
  		$array_par = explode(',', $parameter);
  		$n = 1;
		$l = count($array_par);
        foreach ($array_par as $value) {
        	$valuenya = explode(":", $value);
        	$par = $valuenya[0];
        	$val = $valuenya[1];

        	if($par=='value' && $val=='auto'){
        		$value_idr = 'auto';
        		$val = 'mgo_totalnya_fix';
        	}else{
        		$val = '"'.$val.'"';
        	}

        	if($l==$n){
				$fix_par .= '"'.$par.'":'.$val.'';
			}else{
				$fix_par .= '"'.$par.'":'.$val.','; // add comma
			}
        	$n++;

        }
  	}


  	if($value_idr=='auto'){

  		ob_start();

		echo '
	  	<script>
function getUrlParameter(t) {
    var a, r, e = decodeURIComponent(window.location.search.substring(1)).split("&");
    for (r = 0; r < e.length; r++)
        if ((a = e[r].split("="))[0] === t) return void 0 === a[1] || a[1]
}
mgo_totalnya = getUrlParameter("mgo_total");
mgo_totalnya = mgo_totalnya.split("Rp");
mgo_totalnya_fix = mgo_totalnya[1].replace(/\./g,"");
mgo_totalnya_fix = mgo_totalnya_fix;

!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version="2.0";n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,"script","https://connect.facebook.net/en_US/fbevents.js");
fbq("init", "'.$pixel.'");
fbq("track", "'.$event.'", {
	'.$fix_par.'
});
</script>
';

		$output = ob_get_clean();
		return $output;

  	}else{

  		ob_start();

		echo '
	  	<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version="2.0";n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,"script","https://connect.facebook.net/en_US/fbevents.js");
fbq("init", "'.$pixel.'");
fbq("track", "'.$event.'", {
	'.$fix_par.'
});
</script>
';
		$output = ob_get_clean();
		return $output;

  	}

}
add_shortcode( 'mgopixel', 'mgopixel_func' );



function myaction_get_deposit() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "cf_form_entry_values";

    $orderid = $_POST['datanya'][0];

    /********************************
	CHECK ORDER-ID
	***************************/
    $row = $wpdb->get_results('SELECT * from '.$table_name.' where value="'.$orderid.'" ');
    if($row!=null){

    	$entry_id = $row[0]->entry_id;

    	/**************************
		GET DETAIL ORDER
		************************/
		$query = $wpdb->get_results('SELECT * from '.$table_name.' where entry_id="'.$entry_id.'" and slug="mgo_deposit" ORDER BY id ASC');
	    if($query!=null){
	    	echo $query[0]->value;
	    }else{
	    	echo 'No Data...';
	    }

	}else{
		echo "No Data.";
	}


    wp_die();

} 
add_action( 'wp_ajax_myaction_get_deposit', 'myaction_get_deposit' );
add_action( 'wp_ajax_nopriv_myaction_get_deposit', 'myaction_get_deposit' );



function myaction_get_dp() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "cf_form_entry_values";

    $orderid = $_POST['datanya'][0];

    /********************************
	CHECK ORDER-ID
	***************************/
    $row = $wpdb->get_results('SELECT * from '.$table_name.' where value="'.$orderid.'" ');
    if($row!=null){

    	$entry_id = $row[0]->entry_id;

    	/**************************
		GET DETAIL ORDER
		************************/
		$query = $wpdb->get_results('SELECT * from '.$table_name.' where entry_id="'.$entry_id.'" and slug="mgo_dp" ORDER BY id ASC');
	    if($query!=null){
	    	echo $query[0]->value;
	    }else{
	    	echo 'No Data...';
	    }

	}else{
		echo "No Data.";
	}

    wp_die();

} 
add_action( 'wp_ajax_myaction_get_dp', 'myaction_get_dp' );
add_action( 'wp_ajax_nopriv_myaction_get_dp', 'myaction_get_dp' );



// show detail order on thankyou page
function myaction_get_pembayaran() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "cf_form_entry_values";

    $orderid = $_POST['datanya'][0];

    /********************************
	CHECK ORDER-ID
	***************************/
    $row = $wpdb->get_results('SELECT * from '.$table_name.' where value="'.$orderid.'" ');
    if($row!=null){

    	$entry_id = $row[0]->entry_id;

    	/**************************
		GET DETAIL ORDER
		************************/
		$query = $wpdb->get_results('SELECT * from '.$table_name.' where entry_id="'.$entry_id.'" and slug="mgo_pembayaran" ORDER BY id ASC');
	    if($query!=null){
	    	echo $query[0]->value;
	    }else{
	    	echo 'No Data...';
	    }

	}else{
		echo "No Data.";
	}


    wp_die();

} 
add_action( 'wp_ajax_myaction_get_pembayaran', 'myaction_get_pembayaran' );
add_action( 'wp_ajax_nopriv_myaction_get_pembayaran', 'myaction_get_pembayaran' );



// show detail order on thankyou page
function myaction_get_pembayaran_bank() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "cf_form_entry_values";
    $table_name2 = $wpdb->prefix . "mgo_settings";

    $orderid = $_POST['datanya'][0];

    /********************************
	CHECK ORDER-ID
	***************************/
    $row = $wpdb->get_results('SELECT * from '.$table_name.' where value="'.$orderid.'" ');
    if($row!=null){

    	$entry_id = $row[0]->entry_id;

    	// GET QRIS QRCODE
    	$query_settings = $wpdb->get_results('SELECT data from '.$table_name2.' where type="qris_qrcode" ORDER BY id ASC');
	    $qris_qrcode = $query_settings[0]->data;

    	/**************************
		GET DETAIL ORDER
		************************/
		$query = $wpdb->get_results('SELECT * from '.$table_name.' where entry_id="'.$entry_id.'" and slug="mgo_pembayaran" ORDER BY id ASC');
	    if($query!=null){
	    	$banknya = strtolower($query[0]->value);

	    	if (strpos($banknya, 'mandiri') !== false){
	    		if(strpos($banknya, 'syariah') !== false){
	    			$bank = 'mandiri_syariah';
	    		}else{
	    			$bank = 'mandiri';
	    		}
	    	}elseif (strpos($banknya, 'bni') !== false){
	    		if(strpos($banknya, 'syariah') !== false){
	    			$bank = 'bni_syariah';
	    		}else{
	    			$bank = 'bni';
	    		}
	    	}elseif (strpos($banknya, 'bri') !== false){
	    		if(strpos($banknya, 'syariah') !== false){
	    			$bank = 'bri_syariah';
	    		}else{
	    			$bank = 'bri';
	    		}
	    	}elseif (strpos($banknya, 'bca') !== false){
	    		if(strpos($banknya, 'syariah') !== false){
	    			$bank = 'bca_syariah';
	    		}else{
	    			$bank = 'bca';
	    		}
	    	}elseif (strpos($banknya, 'muamalat') !== false){
	    		$bank = 'muamalat';
	    	}elseif (strpos($banknya, 'bsi') !== false){
	    		$bank = 'bsi';
	    	}elseif (strpos($banknya, 'btn') !== false){
	    		$bank = 'bank_btn';
	    	}elseif (strpos($banknya, 'btpn') !== false){
	    		$bank = 'btpn';
	    	}elseif (strpos($banknya, 'bukopin') !== false){
	    		$bank = 'bukopin';
	    	}elseif (strpos($banknya, 'cimb') !== false){
	    		$bank = 'cimb_niaga';
	    	}elseif (strpos($banknya, 'citi') !== false){
	    		$bank = 'citi_bank';
	    	}elseif (strpos($banknya, 'danamon') !== false){
	    		$bank = 'danamon';
	    	}elseif (strpos($banknya, 'mega') !== false){
	    		$bank = 'mega';
	    	}elseif (strpos($banknya, 'jcb') !== false){
	    		$bank = 'jcb';
	    	}elseif (strpos($banknya, 'visa') !== false){
	    		$bank = 'visa';
	    	}elseif (strpos($banknya, 'master') !== false){
	    		$bank = 'master_card';
	    	}elseif (strpos($banknya, 'alfamart') !== false){
	    		$bank = 'alfamart';
	    	}elseif (strpos($banknya, 'indomaret') !== false){
	    		$bank = 'indomaret';
	    	}elseif (strpos($banknya, 'qris') !== false){
	    		$bank = 'qris';
	    	}elseif (strpos($banknya, 'jenius') !== false){
	    		$bank = 'jenius';
	    	}elseif (strpos($banknya, 'gopay') !== false){
	    		$bank = 'gopay';
	    	}elseif (strpos($banknya, 'ovo') !== false){
	    		$bank = 'ovo';
	    	}elseif (strpos($banknya, 'dana') !== false){
	    		$bank = 'dana';
	    	}elseif (strpos($banknya, 'paypal') !== false){
	    		$bank = 'paypal';
	    	}elseif (strpos($banknya, 'shopeepay') !== false){
	    		$bank = 'shopeepay';
	    	}elseif (strpos($banknya, 'linkaja') !== false){
	    		$bank = 'linkaja';
	    	}elseif (strpos($banknya, 'jemput') !== false){
	    		$bank = 'jemput';
	    	}elseif (strpos($banknya, 'bank_bjb') !== false){
	    		$bank = 'bank_bjb';
	    	}elseif (strpos($banknya, 'bank_bjb_syariah') !== false){
	    		$bank = 'bank_bjb_syariah';
	    	}elseif (strpos($banknya, 'bank_dki') !== false){
	    		$bank = 'bank_dki';
	    	}elseif (strpos($banknya, 'bank_jateng') !== false){
	    		$bank = 'bank_jateng';
	    	}elseif (strpos($banknya, 'bank_jatim') !== false){
	    		$bank = 'bank_jatim';
	    	}elseif (strpos($banknya, 'cod') !== false){
	    		$bank = 'cod_hand2';
	    	}elseif (strpos($banknya, 'transfer') !== false){
	    		$bank = 'transfer2';
	    	}elseif (strpos($banknya, 'tad') !== false){
	    		$bank = 'tad';
	    	}elseif (strpos($banknya, 'cash') !== false){
	    		$bank = 'cash';
	    	}elseif (strpos($banknya, 'tunai') !== false){
	    		$bank = 'tunai';
	    	}elseif (strpos($banknya, 'igreview') !== false){
	    		$bank = 'igreview';
	    	}else{
	    		$bank = 'transfer';
	    	}

	    	if($bank=='qris'){
	    		echo '<style>.mgo_silahkan_transfer, .mgo_copy_rek {display:none;} .autowacs {margin-top:60px;}</style>';
	    		echo '<p style="text-align:center;">Scan QR-Code dibawah ini dengan <b><span style="color:#01A9CF">Gopay</span>, <span style="color:#643294">OVO</span>, <span style="color:#118EEB">Dana</span>, <span style="color:#F15A2B">ShopeePay</span>,</b><b><span style="color:#E82529"> LinkAja</span></b>, atau Bank kesayangan anda melalui aplikasi Mobile Banking.</p>';
	    		echo '<div style="text-align:center;"><img src="'.$qris_qrcode.'"></div>';
	    		echo '<img class="secure-payment" src="'.plugin_dir_url( __FILE__ ).'assets/icons/bank/secure_payment.png" alt="secure payment" style="margin: 0 auto;margin-top:10px;" border="0" />';
	    	}elseif($bank=='cash' || $bank=='tunai' ||  $bank=='cod' ||  $bank=='tad' ||  $bank=='jemput'){
	    		echo '<style>.mgo_copy_rek {display:none;}</style>';
	    		echo '<div class="mgo_box_bank no_copy_rek"><div class="mgo_bank_logo"><img src="'.plugin_dir_url( __FILE__ ).'assets/icons/bank/'.$bank.'.png" /></div><div class="mgo_bank_text">'.$query[0]->value.'</div></div><img class="secure-payment" src="'.plugin_dir_url( __FILE__ ).'assets/icons/bank/secure_payment.png" alt="secure payment" style="margin: 0 auto;" border="0" />';
	    	}else{
	    		echo '<div class="mgo_box_bank"><div class="mgo_bank_logo"><img src="'.plugin_dir_url( __FILE__ ).'assets/icons/bank/'.$bank.'.png" /></div><div class="mgo_bank_text">'.$query[0]->value.'</div></div><img class="secure-payment" src="'.plugin_dir_url( __FILE__ ).'assets/icons/bank/secure_payment.png" alt="secure payment" style="margin: 0 auto;" border="0" />';
	    	}
	    	
	    }else{
	    	echo 'No Data2.';
	    }

	}else{
		echo "No Data.";
	}


    wp_die();

} 
add_action( 'wp_ajax_myaction_get_pembayaran_bank', 'myaction_get_pembayaran_bank' );
add_action( 'wp_ajax_nopriv_myaction_get_pembayaran_bank', 'myaction_get_pembayaran_bank' );



function hp($nohp) {
     $nohp = str_replace(" ","",$nohp);
     $nohp = str_replace("(","",$nohp);
     $nohp = str_replace(")","",$nohp);
     $nohp = str_replace(".","",$nohp);
 
     // cek apakah no hp mengandung karakter + dan 0-9
    if(!preg_match('/[^+0-9]/',trim($nohp))){
        // cek apakah no hp karakter 1-3 adalah +62
        if(substr(trim($nohp), 0, 3)=='+62'){
            $hp = substr(trim($nohp), 1);
        }
        // cek apakah no hp karakter 1 adalah 0
        elseif(substr(trim($nohp), 0, 1)=='0'){
            $hp = '62'.substr(trim($nohp), 1);
        }else{
            $hp = $nohp;
        }
    }
     return $hp;
}



function myaction_wa_settings() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";
    
    $wa_pembuka1 = str_replace('\"','"',$_POST['datanya'][0]);
    $wa_pembuka1 = str_replace('<img role="img" alt="','',$wa_pembuka1);
    $wa_pembuka1 = str_replace('">','',$wa_pembuka1);
    $wa_pembuka2 = str_replace('&nbsp;','',$wa_pembuka1);
    // <img role="img" alt="


    $wa_penutup1 = str_replace('\"','"',$_POST['datanya'][1]);
    $wa_penutup1 = str_replace('<img role="img" alt="','',$wa_penutup1);
    $wa_penutup1 = str_replace('">','',$wa_penutup1);
    $wa_penutup2 = str_replace('&nbsp;','',$wa_penutup1);

    $wa_followup_dua = str_replace('\"','"',$_POST['datanya'][2]);
    $wa_followup_dua = str_replace('<img role="img" alt="','',$wa_followup_dua);
    $wa_followup_dua = str_replace('">','',$wa_followup_dua);
    $wa_followup_dua_1 = str_replace('&nbsp;','',$wa_followup_dua);

    $wa_followup_tiga = str_replace('\"','"',$_POST['datanya'][3]);
    $wa_followup_tiga = str_replace('<img role="img" alt="','',$wa_followup_tiga);
    $wa_followup_tiga = str_replace('">','',$wa_followup_tiga);
    $wa_followup_tiga_1 = str_replace('&nbsp;','',$wa_followup_tiga);



    $wpdb->update(
        $table_name, //table
        array('data' => $wa_pembuka2), //data
        array('type' => 'wa_pembuka'), //where
        array('%s'), //data format
        array('%s') //where format
    );

    $wpdb->update(
        $table_name, //table
        array('data' => $wa_penutup2), //data
        array('type' => 'wa_penutup'), //where
        array('%s'), //data format
        array('%s') //where format
    );
	
    $wpdb->update(
        $table_name, //table
        array('data' => $wa_followup_dua_1), //data
        array('type' => 'wa_followup_dua'), //where
        array('%s'), //data format
        array('%s') //where format
    );
	
    $wpdb->update(
        $table_name, //table
        array('data' => $wa_followup_tiga_1), //data
        array('type' => 'wa_followup_tiga'), //where
        array('%s'), //data format
        array('%s') //where format
    );
	
	echo '<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">Save Successfully!</span>';

    wp_die();

} 
add_action( 'wp_ajax_myaction_wa_settings', 'myaction_wa_settings' );
add_action( 'wp_ajax_nopriv_myaction_wa_settings', 'myaction_wa_settings' );



function myaction_wa_settings_custom() {
	
    global $wpdb;
    $a = '
                              ';
    $table_name = $wpdb->prefix . "cf_forms";
    $table_name2 = $wpdb->prefix . "mgo_calculation";
    
    $f_transfer_satu = str_replace('\"','"',$_POST['datanya'][0]);
    $f_transfer_satu = str_replace('<img role="img" alt="','',$f_transfer_satu);
    $f_transfer_satu = str_replace('">','',$f_transfer_satu);
    $f_transfer_satu = str_replace($a,'',$f_transfer_satu);
    $f_transfer_satu_1 = str_replace('&nbsp;','',$f_transfer_satu);

    $f_transfer_dua = str_replace('\"','"',$_POST['datanya'][1]);
    $f_transfer_dua = str_replace('<img role="img" alt="','',$f_transfer_dua);
    $f_transfer_dua = str_replace('">','',$f_transfer_dua);
    $f_transfer_dua = str_replace($a,'',$f_transfer_dua);
    $f_transfer_dua_2 = str_replace('&nbsp;','',$f_transfer_dua);

    $f_transfer_tiga = str_replace('\"','"',$_POST['datanya'][2]);
    $f_transfer_tiga = str_replace('<img role="img" alt="','',$f_transfer_tiga);
    $f_transfer_tiga = str_replace('">','',$f_transfer_tiga);
    $f_transfer_tiga = str_replace($a,'',$f_transfer_tiga);
    $f_transfer_tiga_3 = str_replace('&nbsp;','',$f_transfer_tiga);

    $f_cod_satu = str_replace('\"','"',$_POST['datanya'][3]);
    $f_cod_satu = str_replace('<img role="img" alt="','',$f_cod_satu);
    $f_cod_satu = str_replace('">','',$f_cod_satu);
    $f_cod_satu = str_replace($a,'',$f_cod_satu);
    $f_cod_satu_1 = str_replace('&nbsp;','',$f_cod_satu);

    $f_cod_dua = str_replace('\"','"',$_POST['datanya'][4]);
    $f_cod_dua = str_replace('<img role="img" alt="','',$f_cod_dua);
    $f_cod_dua = str_replace('">','',$f_cod_dua);
    $f_cod_dua = str_replace($a,'',$f_cod_dua);
    $f_cod_dua_2 = str_replace('&nbsp;','',$f_cod_dua);

    $f_cod_tiga = str_replace('\"','"',$_POST['datanya'][5]);
    $f_cod_tiga = str_replace('<img role="img" alt="','',$f_cod_tiga);
    $f_cod_tiga = str_replace('">','',$f_cod_tiga);
    $f_cod_tiga = str_replace($a,'',$f_cod_tiga);
    $f_cod_tiga_3 = str_replace('&nbsp;','',$f_cod_tiga);

    $f_wa_status = $_POST['datanya'][6];

    $form_id = $_POST['datanya'][7];

    $jumlah_form = $wpdb->get_var('SELECT * from '.$table_name2.' where id_form="'.$form_id.'"');
    if($jumlah_form>=1){
        $wpdb->update(
            $table_name2, //table
            array('f_wa_status' => $f_wa_status, 'f_transfer_satu' => $f_transfer_satu_1, 'f_transfer_dua' => $f_transfer_dua_2, 'f_transfer_tiga' => $f_transfer_tiga_3, 'f_cod_satu' => $f_cod_satu_1, 'f_cod_dua' => $f_cod_dua_2, 'f_cod_tiga' => $f_cod_tiga_3), //data
            array('id_form' => $form_id), //where
            array('%s'), //data format
            array('%s') //where format
        );
    }else {
        $wpdb->insert(
            $table_name2, //table
            array('id_form' => $form_id, 'f_wa_status' => $f_wa_status, 'f_transfer_satu' => $f_transfer_satu_1, 'f_transfer_dua' => $f_transfer_dua_2, 'f_transfer_tiga' => $f_transfer_tiga_3, 'f_cod_satu' => $f_cod_satu_1, 'f_cod_dua' => $f_cod_dua_2, 'f_cod_tiga' => $f_cod_tiga_3), //data
            array('%s', '%s') //data format         
        );
    }

	
	echo '<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">Save Successfully!</span>';

    wp_die();

} 
add_action( 'wp_ajax_myaction_wa_settings_custom', 'myaction_wa_settings_custom' );
add_action( 'wp_ajax_nopriv_myaction_wa_settings_custom', 'myaction_wa_settings_custom' );


function myaction_wa_settings2() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";
    
    $wa_followup1 = str_replace('\"','"',$_POST['datanya'][0]);
    $wa_followup2 = str_replace('<div></div>','<br>',$wa_followup1);
    $wa_followup3 = str_replace('<div>','',$wa_followup2);
    $wa_followup4 = str_replace('</div>','',$wa_followup3);
    $wa_followup5 = str_replace('&nbsp;','',$wa_followup4);
    $wa_followup6 = str_replace('<img role="img" alt="','',$wa_followup5);
    $wa_followup6 = str_replace('">','',$wa_followup6);

    $wpdb->update(
        $table_name, //table
        array('data' => $wa_followup6), //data
        array('type' => 'wa_followup'), //where
        array('%s'), //data format
        array('%s') //where format
    );
	
	echo '<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">Save Successfully!</span>';

    wp_die();

} 
add_action( 'wp_ajax_myaction_wa_settings2', 'myaction_wa_settings2' );
add_action( 'wp_ajax_nopriv_myaction_wa_settings2', 'myaction_wa_settings2' );



function myaction_orderid_settings() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";
    
    $orderid_text = $_POST['datanya'][0];
    $orderid_max = $_POST['datanya'][1];

    $wpdb->update(
        $table_name, //table
        array('data' => $orderid_text), //data
        array('type' => 'orderid_text'), //where
        array('%s'), //data format
        array('%s') //where format
    );

    $wpdb->update(
        $table_name, //table
        array('data' => $orderid_max), //data
        array('type' => 'orderid_max'), //where
        array('%s'), //data format
        array('%s') //where format
    );
	
	echo '<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">Save Successfully!</span>';

    wp_die();

} 
add_action( 'wp_ajax_myaction_orderid_settings', 'myaction_orderid_settings' );
add_action( 'wp_ajax_nopriv_myaction_orderid_settings', 'myaction_orderid_settings' );



function myaction_save_label_pengirim() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";
    
    $label_pengirim = $_POST['datanya'][0];

    $wpdb->update(
        $table_name, //table
        array('data' => $label_pengirim), //data
        array('type' => 'label_pengirim'), //where
        array('%s'), //data format
        array('%s') //where format
    );
	
	echo '<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">Save Successfully!</span>';

    wp_die();

} 
add_action( 'wp_ajax_myaction_save_label_pengirim', 'myaction_save_label_pengirim' );
add_action( 'wp_ajax_nopriv_myaction_save_label_pengirim', 'myaction_save_label_pengirim' );




function myaction_table_settings() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";
    
    $table_field = $_POST['datanya'][0];

    $wpdb->update(
        $table_name, //table
        array('data' => $table_field), //data
        array('type' => 'table_field'), //where
        array('%s'), //data format
        array('%s') //where format
    );
	
	echo '<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">Save Successfully!</span>';

    wp_die();

} 
add_action( 'wp_ajax_myaction_table_settings', 'myaction_table_settings' );
add_action( 'wp_ajax_nopriv_myaction_table_settings', 'myaction_table_settings' );



function myaction_save_atc() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";
    
    $atc_button = $_POST['datanya'][0];
    $additional_button = $_POST['datanya'][1];
    $additional_text = $_POST['datanya'][2];
    $additional_link = $_POST['datanya'][3];

    $wpdb->update(
        $table_name,
        array('data' => $atc_button),
        array('type' => 'atc_button'),
        array('%s'),
        array('%s')
    );

    $wpdb->update(
        $table_name,
        array('data' => $additional_button),
        array('type' => 'additional_button'),
        array('%s'),
        array('%s')
    );

    $wpdb->update(
        $table_name,
        array('data' => $additional_text),
        array('type' => 'additional_text'),
        array('%s'),
        array('%s')
    );

    $wpdb->update(
        $table_name,
        array('data' => $additional_link),
        array('type' => 'additional_link'),
        array('%s'),
        array('%s')
    );
	
	echo '<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">Save Successfully!</span>';

    wp_die();

} 
add_action( 'wp_ajax_myaction_save_atc', 'myaction_save_atc' );
add_action( 'wp_ajax_nopriv_myaction_save_atc', 'myaction_save_atc' );


function myaction_activate_autosave() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";
    
    $wa_autosave = $_POST['datanya'][0];

    $wpdb->update(
        $table_name,
        array('data' => $wa_autosave),
        array('type' => 'wa_autosave'),
        array('%s'),
        array('%s')
    );

	echo '<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">Save Successfully!</span>';

    wp_die();

} 
add_action( 'wp_ajax_myaction_activate_autosave', 'myaction_activate_autosave' );
add_action( 'wp_ajax_nopriv_myaction_activate_autosave', 'myaction_activate_autosave' );


function myaction_page_refresh() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";
    
    $refresh_page = $_POST['datanya'][0];
    $refresh_second = $_POST['datanya'][1];

    $wpdb->update(
        $table_name,
        array('data' => $refresh_page),
        array('type' => 'order_refresh_page'),
        array('%s'),
        array('%s')
    );

    $wpdb->update(
        $table_name,
        array('data' => $refresh_second),
        array('type' => 'order_refresh_second'),
        array('%s'),
        array('%s')
    );

	echo '<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">Save Successfully!</span>';

    wp_die();

} 
add_action( 'wp_ajax_myaction_page_refresh', 'myaction_page_refresh' );
add_action( 'wp_ajax_nopriv_myaction_page_refresh', 'myaction_page_refresh' );



function myaction_save_utc() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";
    
    $utc_status = $_POST['datanya'][0];
    $utc_value = $_POST['datanya'][1];

    $wpdb->update(
        $table_name,
        array('data' => $utc_status),
        array('type' => 'utc_status'),
        array('%s'),
        array('%s')
    );

    $wpdb->update(
        $table_name,
        array('data' => $utc_value),
        array('type' => 'utc_value'),
        array('%s'),
        array('%s')
    );

	echo '<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">Save Successfully!</span>';

    wp_die();

} 
add_action( 'wp_ajax_myaction_save_utc', 'myaction_save_utc' );
add_action( 'wp_ajax_nopriv_myaction_save_utc', 'myaction_save_utc' );


function myaction_save_utc_dataorder() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";
    
    $utc_status_dataorder = $_POST['datanya'][0];
    $utc_value_dataorder = $_POST['datanya'][1];

    $wpdb->update(
        $table_name,
        array('data' => $utc_status_dataorder),
        array('type' => 'utc_status_dataorder'),
        array('%s'),
        array('%s')
    );

    $wpdb->update(
        $table_name,
        array('data' => $utc_value_dataorder),
        array('type' => 'utc_value_dataorder'),
        array('%s'),
        array('%s')
    );

	echo '<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">Save Successfully!</span>';

    wp_die();

} 
add_action( 'wp_ajax_myaction_save_utc_dataorder', 'myaction_save_utc_dataorder' );
add_action( 'wp_ajax_nopriv_myaction_save_utc_dataorder', 'myaction_save_utc_dataorder' );



function myaction_save_followup_button_status() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";
    
    $followup_button_status = $_POST['datanya'][0];

    $wpdb->update(
        $table_name,
        array('data' => $followup_button_status),
        array('type' => 'followup_button_status'),
        array('%s'),
        array('%s')
    );

	echo '<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">Save Successfully!</span>';

    wp_die();

} 
add_action( 'wp_ajax_myaction_save_followup_button_status', 'myaction_save_followup_button_status' );
add_action( 'wp_ajax_nopriv_myaction_save_followup_button_status', 'myaction_save_followup_button_status' );



function myaction_save_btn_del_status() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";
    
    $btn_del_status = $_POST['datanya'][0];

    $wpdb->update(
        $table_name,
        array('data' => $btn_del_status),
        array('type' => 'btn_del_status'),
        array('%s'),
        array('%s')
    );

	echo '<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">Save Successfully!</span>';

    wp_die();

} 
add_action( 'wp_ajax_myaction_save_btn_del_status', 'myaction_save_btn_del_status' );
add_action( 'wp_ajax_nopriv_myaction_save_btn_del_status', 'myaction_save_btn_del_status' );



function myaction_save_followup_wanotif_status() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";
    
    $followup_wanotif_status = $_POST['datanya'][0];

    $wpdb->update(
        $table_name,
        array('data' => $followup_wanotif_status),
        array('type' => 'followup_wanotif_status'),
        array('%s'),
        array('%s')
    );

	echo '<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">Save Successfully!</span>';

    wp_die();

} 
add_action( 'wp_ajax_myaction_save_followup_wanotif_status', 'myaction_save_followup_wanotif_status' );
add_action( 'wp_ajax_nopriv_myaction_save_followup_wanotif_status', 'myaction_save_followup_wanotif_status' );


function myaction_save_coupon() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_coupons";
    
    $coupon_type = $_POST['datanya'][0];
    $coupon_name = $_POST['datanya'][1];
    $coupon_code = $_POST['datanya'][2];
    $coupon_discount = $_POST['datanya'][3];
    $coupon_start = $_POST['datanya'][4];
    $coupon_expired = $_POST['datanya'][5];
    $coupon_status = $_POST['datanya'][6];

    // $start_date = date('Y-m-d', strtotime(str_replace('/', '-', $coupon_expired)));

    $check_coupon = $wpdb->get_results('SELECT * from '.$table_name.' where coupon_code="'.$coupon_code.'"');
    if($check_coupon==null){
    	if($coupon_type=='go'){
    		$coupon_discount=null;
    	}
    	$insert = $wpdb->insert( $table_name,
	            array('coupon_type' => $coupon_type, 'coupon_name' => $coupon_name, 'coupon_code' => $coupon_code, 'coupon_discount' => $coupon_discount, 'coupon_status' => $coupon_status, 'coupon_start' => $coupon_start, 'coupon_expired' => $coupon_expired, 'created_at' => date("Y-m-d H:i:s")), //data
	            array('%s', '%s') //data format         
	        );

    	$coupon = $wpdb->get_results('SELECT * from '.$table_name.' where coupon_code="'.$coupon_code.'"');

    	echo 'success_'.$coupon[0]->id;

    }else{
    	echo 'sudah ada';
    }
    wp_die();

} 
add_action( 'wp_ajax_myaction_save_coupon', 'myaction_save_coupon' );
add_action( 'wp_ajax_nopriv_myaction_save_coupon', 'myaction_save_coupon' );



function myaction_form_edit_coupon() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_coupons";
    
    $coupon_id = $_POST['datanya'][0];

    $coupon = $wpdb->get_results('SELECT * from '.$table_name.' where id="'.$coupon_id.'"');

    if($coupon[0]->coupon_type=='go'){
    	$display = 'none';
    	$type_go = 'selected';
    	$type_ph = '';
    	$type_ps = '';
    	$set_icon = '<span class="dashicons dashicons-edit"></span>';
        $set_placeholder = 'Discount Example: 100.000';
    }elseif($coupon[0]->coupon_type=='ph'){
    	$display = 'inline';
    	$type_go = '';
    	$type_ph = 'selected';
    	$type_ps = '';
    	$set_icon = 'Rp';
        $set_placeholder = 'Discount Example: 100.000';
    }else{
    	$display = 'inline';
    	$type_go = '';
    	$type_ph = '';
    	$type_ps = 'selected';
    	$set_icon = '%';
        $set_placeholder = '1-100';
    }
    if($coupon[0]->coupon_status==1){
    	$active = 'selected';
    	$deactive = '';
    	$flag = 'flag_green';
    }else{
    	$active = '';
    	$deactive = 'selected';
    	$flag = 'flag_red';
    }

    if(number_format($coupon[0]->coupon_discount)==0){
    	$discountnya = '';
    }else{
    	$discountnya = number_format($coupon[0]->coupon_discount,0,",",".");
    }

    $datenya_start = date_create($coupon[0]->coupon_start);
    $datenya_start = date_format($datenya_start, 'Y-m-d H:i');

    $datenya_expired = date_create($coupon[0]->coupon_expired);
    $datenya_expired = date_format($datenya_expired, 'Y-m-d H:i');

    echo '
    	<div>
	        <div class="input-icon-wrap">
	          <span class="input-icon"><span class="dashicons dashicons-tag"></span></span>
	          <select name="" id="coupon_type2" class="select-status" title="Coupon Type" >
	            <option value="0">Coupon Type</option>
	            <option value="go" '.$type_go.'>Gratis Ongkir (GO)</option>
	            <option value="ph" '.$type_ph.'>Potongan Harga (Rp)</option>
	            <option value="ps" '.$type_ps.'>Potongan Harga (%)</option>
	          </select>
	        </div>
	    </div>
	    <div id="field_name2">
	        <div class="input-icon-wrap">
	          <span class="input-icon"><span class="dashicons dashicons-format-aside"></span></span>
	          <input type="text" class="input-with-icon" id="coupon_name2" placeholder="Coupon Name" title="Coupon Name" value="'.$coupon[0]->coupon_name.'">
	        </div>
	    </div>
	    <div id="field_code2">
	        <div class="input-icon-wrap">
	          <span class="input-icon"><span class="dashicons dashicons-admin-network"></span></span>
	          <input type="text" class="input-with-icon" id="coupon_code2" placeholder="Coupon Code" title="Coupon Code" value="'.$coupon[0]->coupon_code.'">
	        </div>
	    </div>
	    <div id="field_start2">
	        <div class="input-icon-wrap">
	          <span class="input-icon"><span class="dashicons dashicons-calendar-alt"></span></span>
	          <input type="text" class="input-with-icon coupon" id="coupon_start2" placeholder="Date Start" title="Date Start" value="'.$datenya_start.'">
	        </div>
	    </div>
	    <div id="field_expired2">
	        <div class="input-icon-wrap">
	          <span class="input-icon"><span class="dashicons dashicons-calendar-alt"></span></span>
	          <input type="text" class="input-with-icon coupon" id="coupon_expired2" placeholder="Date Expired" title="Date Expired" value="'.$datenya_expired.'">
	        </div>
	    </div>
	    <div id="field_status2">
	        <div class="input-icon-wrap">
	          <span class="input-icon"><span class="dashicons dashicons-flag '.$flag.'"></span></span>
	          <select name="" id="coupon_status2" class="select-status" title="Status" >
	            <option value="0">Set Status</option>
	            <option value="1" '.$active.'>Active</option>
	            <option value="2" '.$deactive.'>Deactive</option>
	          </select>
	        </div>
	    </div>
	    <div id="field_discount2" style="display: '.$display.';">
	        <div class="input-icon-wrap">
	          <span class="input-icon">'.$set_icon.'</span>
	          <input type="text" class="input-with-icon discount" id="coupon_discount2" placeholder="'.$set_placeholder.'" value="'.$discountnya.'" title="Discount" >
	        </div>
	    </div>
	    <div id="field_id2" style="display: none;">
	        <div class="input-icon-wrap">
	          <span class="input-icon"><span class="dashicons dashicons-format-aside"></span></span>
	          <input type="text" class="input-with-icon" id="coupon_id2" placeholder="Coupon ID" value="'.$coupon_id.'">
	        </div>
	    </div>
	    <div style="padding-top: 25px;text-align: center;">
	        <input type="button" id="update_coupon" name="insert" value="Update Coupon" class="button btn_coupon" style="margin-top: 10px;">
	        <span id="success_response"></span>
	    </div>
	    <script>
	    	$("#coupon_start2").datetimepicker({format:"Y-m-d H:i"});
	    	$("#coupon_expired2").datetimepicker({format:"Y-m-d H:i"});
	    	$(document).on("change", "#coupon_status2", function(e) {
	            var id = $(this).find("option:selected").val();
	            if(id=="1"){
	                $("#field_status2 .dashicons.dashicons-flag").addClass("flag_green");
	                $("#field_status2 .dashicons.dashicons-flag").removeClass("flag_red");
	            }else if(id=="2"){
	                $("#field_status2 .dashicons.dashicons-flag").addClass("flag_red");
	                $("#field_status2 .dashicons.dashicons-flag").removeClass("flag_green");
	            }else{
	              $("#field_status2 .dashicons.dashicons-flag").removeClass("flag_red");
	              $("#field_status2 .dashicons.dashicons-flag").removeClass("flag_green");
	            }
	        });
		</script>
	    ';
    wp_die();

} 
add_action( 'wp_ajax_myaction_form_edit_coupon', 'myaction_form_edit_coupon' );
add_action( 'wp_ajax_nopriv_myaction_form_edit_coupon', 'myaction_form_edit_coupon' );



function myaction_update_coupon() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_coupons";
    
    $coupon_type = $_POST['datanya'][0];
    $coupon_name = $_POST['datanya'][1];
    $coupon_code = $_POST['datanya'][2];
    $coupon_discount = $_POST['datanya'][3];
    $coupon_start = $_POST['datanya'][4];
    $coupon_expired = $_POST['datanya'][5];
    $coupon_status = $_POST['datanya'][6];
    $coupon_id = $_POST['datanya'][7];

    $check_coupon = $wpdb->get_results('SELECT * from '.$table_name.' where coupon_code="'.$coupon_code.'"');
    if($check_coupon!=null){

    	if( $check_coupon[0]->id==$coupon_id){
	    	if($coupon_type=='go'){
	    		$coupon_discount=null;
	    	}
	    	$update = $wpdb->update(
	            $table_name, //table
	            array('coupon_type' => $coupon_type, 'coupon_name' => $coupon_name, 'coupon_code' => $coupon_code, 'coupon_discount' => $coupon_discount, 'coupon_status' => $coupon_status, 'coupon_start' => $coupon_start, 'coupon_expired' => $coupon_expired), //data
	            array('id' => $coupon_id), //where
	            array('%s'), //data format
	            array('%s') //where format
	        );
	        
	    	echo 'success';
	    	
	    }else{
	    	echo 'duplicate code coupon 1';
	    }

    }else{

    	if($coupon_type=='go'){
    		$coupon_discount=null;
    	}
    	$update = $wpdb->update(
            $table_name, //table
            array('coupon_type' => $coupon_type, 'coupon_name' => $coupon_name, 'coupon_code' => $coupon_code, 'coupon_discount' => $coupon_discount, 'coupon_status' => $coupon_status, 'coupon_start' => $coupon_start, 'coupon_expired' => $coupon_expired), //data
            array('id' => $coupon_id), //where
            array('%s'), //data format
            array('%s') //where format
        );
        
		echo 'success';
    	
    }

    wp_die();

} 
add_action( 'wp_ajax_myaction_update_coupon', 'myaction_update_coupon' );
add_action( 'wp_ajax_nopriv_myaction_update_coupon', 'myaction_update_coupon' );



function myaction_delete_coupon() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_coupons";
    $id_coupon = $_POST['datanya'][0];

    
	if ( $wpdb->get_var( $wpdb->prepare( 'SELECT id FROM '.$table_name.' WHERE id = %d', $id_coupon ) ) ) {
        $wpdb->query( $wpdb->prepare( 'DELETE FROM '.$table_name.' WHERE id = %d', $id_coupon ) );
        echo 'success';
    }else{
    	echo 'not allowed';
    }
    
    wp_die();

} 
add_action( 'wp_ajax_myaction_delete_coupon', 'myaction_delete_coupon' );
add_action( 'wp_ajax_nopriv_myaction_delete_coupon', 'myaction_delete_coupon' );


function myaction_autosave_wa() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_autosave_wa";
    $table_name2 = $wpdb->prefix . 'mgo_settings';

    $wa_number = $_POST['datanya'][0];
    $form_id = $_POST['datanya'][1];
    $order_id = $_POST['datanya'][2];
    $cs_id = $_POST['datanya'][3];
    $name = $_POST['datanya'][4];

	$query_settings = $wpdb->get_results('SELECT data from '.$table_name2.' where type="wa_autosave"');
	$wa_autosave = $query_settings[0]->data;

	if($wa_autosave==1){
	    date_default_timezone_set('Asia/jakarta');
	    $date_now = date('Y-m-d H:i:s', time());
	    
		$check_orderan = $wpdb->get_var('SELECT * from '.$table_name.' where order_id="'.$order_id.'"');
	    if($check_orderan>=1){
	        $wpdb->update(
	            $table_name, //table
	            array('name' => $name), //data
	            array('order_id' => $order_id), //where
	            array('%s'), //data format
	            array('%s') //where format
	        );
	        $wpdb->update(
	            $table_name, //table
	            array('wa_number' => $wa_number), //data
	            array('order_id' => $order_id), //where
	            array('%s'), //data format
	            array('%s') //where format
	        );  
	        echo 'Update WA Number.';
	    }else {
	    	if($order_id==null || $order_id==''){
		        echo "Can't save! Order ID Null.";
	    	}else{
	    		$wpdb->insert(
		            $table_name, //table
		            array('name' => $name, 'wa_number' => $wa_number, 'form_id' => $form_id, 'order_id' => $order_id, 'cs_id' => $cs_id, 'status_followup' => 0, 'created_at' => $date_now), //data
		            array('%s', '%s') //data format         
		        );
		        echo 'Save success.';
	    	}
	    }
	}else{
		echo 'not-active';
	}
    
    wp_die();

} 
add_action( 'wp_ajax_myaction_autosave_wa', 'myaction_autosave_wa' );
add_action( 'wp_ajax_nopriv_myaction_autosave_wa', 'myaction_autosave_wa' );


function myaction_tracking_order() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_orders";
    $table_name2 = $wpdb->prefix . "mgo_order_statuses";
    $table_name3 = $wpdb->prefix . "cf_form_entry_values";
    $orderid = $_POST['datanya'][0];

    $jumlah_form = $wpdb->get_results("SELECT a.*, b.nama_status, b.color, b.ket_status  from $table_name a LEFT JOIN $table_name2 b ON a.status_id = b.id where order_id='$orderid' and nama_status!='' ");

    if($jumlah_form==null){

    	$cek_on_caldera = $wpdb->get_results("SELECT * from $table_name3 where value='$orderid' and slug='mgo_orderid' ");
	    if($cek_on_caldera!=null){
	        echo '
			<div class="icon-order" style="margin-top:30px;text-align:center;background: #F0F6F8;padding: 40px 0 20px 0;margin-bottom: 2px;padding-bottom:30px;width: 100%; min-height: 210px; border-radius: 0;">
				<img src="'.WP_PLUGIN_URL.'/magic-order/assets/icons/waiting_payment.png" style="margin: 0 auto;width:80px;" />
				<h3 style="margin-top:10px;font-size:24px;">Waiting Payment</h3>
				<h4 style="margin-top:-20px;font-size:16px;">ORDER ID: <span style="color:#cd2653;"><b>'.$orderid.'</b></span></h4>
				<p style="margin-top:-20px;font-size:16px;padding:20px 20px;font-style:italic;font-family:"Lato", FontAwesome, lato, sans-serif !important;">Silahkan transfer sesuai dengan nominal pesanan yang anda pesan agar kami segera memproses pesanan anda.</p>
			</div>
			';
	    }else{
	    	echo '
	    		<div class="icon-order" style="margin-top:30px;text-align:center;background: #F0F6F8;padding: 20px 0 20px 0;margin-bottom: 2px;width: 100%; min-height: 100px; border-radius: 0;">
					<h3 style="margin-top:10px;">No Data!</h3>
				</div>
			';
	    }

    	
    }else{
    	$getlast = $wpdb->get_results("SELECT a.*, b.nama_status, b.color, b.ket_status  from $table_name a LEFT JOIN $table_name2 b ON a.status_id = b.id where order_id='$orderid' and nama_status!='' ORDER BY id DESC");
    	$status_id = $getlast[0]->status_id;
    	$statusnya = $wpdb->get_results('SELECT * from '.$table_name2.' where id="'.$status_id.'"');

    	$icon = '';
    	$status = '';

    	$done0='todo';
    	if($jumlah_form[0]!=null){$done0='done';};
    	$done1='todo';
    	if($jumlah_form[1]!=null){$done1='done';};
    	$done2='todo';
    	if($jumlah_form[2]!=null){$done2='done';};
    	$done3='todo';
    	if($jumlah_form[3]!=null){$done3='done';};


    	$query = $wpdb->get_results("SELECT a.*, b.nama_status, b.color, b.ket_status  from $table_name a LEFT JOIN $table_name2 b ON a.status_id = b.id where order_id='$orderid' and nama_status!='' ");

	    $statuses = '';
	    foreach ($query as $row) {
	    	if($row->ket_order=='' || $row->ket_order==null){
	    		$padding_bottom = 'padding-bottom:35px;';
	    	}else{
	    		$padding_bottom = 'padding-bottom:50px;';
	    	}
			$statuses .= '
						<li class="timeline-item" style="'.$padding_bottom.'">
							<div>
								<div class="text-date">
									'.date("F j, Y",strtotime($row->created_at)).'<br>
									'.date("H:i ",strtotime($row->created_at)).'
								</div>
								<p class="div-text-title-info" style="margin-top:-60px;margin-left:180px;">
									<span class="text-title" style="color:'.$row->color.'">
										'.$row->nama_status.'
									</span>
									<br>
									<span class="text-info" style="font-size: 16px;">
										'.$row->ket_status.'
									</span>
									<br>
									<span class="text-info" style="font-size: 14px;">
										'.$row->ket_order.'
									</span>
								</p>
							</div>
						</li>
						';
	    }

	    if($statusnya[0]->icon!='rts.png'){
    	echo '
		<ol class="track-progress">
			  <li class="'.$done0.'">
			    <em>1</em>
			    <span>Confirmed</span>
			  </li>
			  <li class="'.$done1.'">
			    <em>2</em>
			    <span>Packaged</span>
			  </li>
			  <li class="'.$done2.'">
			    <em>3</em>
			    <span>Shipped</span>
			  </li>
			  <li class="'.$done3.'">
			    <em>4</em>
			    <span>Delivered</span>
			  </li>
		</ol>';
		}

		echo '
		<div>
			<div class="icon-order" style="margin-top:30px;text-align:center;background: #F0F6F8;padding: 40px 0 20px 0;margin-bottom: 2px;padding-bottom:30px;width: 100%; min-height: 210px; border-radius: 0;">
				<img src="'.WP_PLUGIN_URL.'/magic-order/assets/icons/'.$statusnya[0]->icon.'" style="margin: 0 auto;width:80px;" />
				<h3 style="margin-top:10px;font-size:24px;">'.$statusnya[0]->ket_status.'</h3>
				<h4 style="margin-top:-20px;font-size:16px;">ORDER ID: <span style="color:#cd2653;"><b>'.$orderid.'</b></span></h4>
			</div>
		';

		if($statusnya[0]->icon!='rts.png'){
    	echo '
			<div class="panel panel-white no-radius" style="padding-left: 0%;padding-top: 3%;padding-bottom: 1%;background: #fff;">
				<div class="panel-body">
					<ul class="timeline-xs margin-top-20 margin-bottom-20" style="border-left: 1px solid #e4e4e4;padding-left: 11px;">
						'.$statuses.'
					</ul>
				</div>
			</div>
		</div>
		';
		}
    }
    
    wp_die();

} 
add_action( 'wp_ajax_myaction_tracking_order', 'myaction_tracking_order' );
add_action( 'wp_ajax_nopriv_myaction_tracking_order', 'myaction_tracking_order' );



function tracking_func( $atts ){
	ob_start();

	return '
	<form class="searchform cf" style="width: 418px;">
	  <div contenteditable="true" placeholder="Paste your order ID..." id="your_orderid"></div>
	  <button type="button" id="tracking_order" style="position: absolute;  padding: 13px 15px;  margin-top: -3px;">Tracking Order</button>
	</form>

	<div id="result_tracking_order"></div>
	<style>
	</style>
	';

	$output = ob_get_clean();
	return $output;
}
add_shortcode( 'mgotracking', 'tracking_func' );

/*
function myaction_save_phonesetting() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";

    // $userkey = $_POST['datanya'][0];
    // $passkey = $_POST['datanya'][1];
    $notif 	= $_POST['datanya'][0];
    // $urlnotif = $_POST['datanya'][3];
    $urlcs = $_POST['datanya'][1];
    $opentab = $_POST['datanya'][2];
    $formresend = $_POST['datanya'][3];

    // $wpdb->update(
    //     $table_name, //table
    //     array('data' => $userkey), //data
    //     array('type' => 'userkey'), //where
    //     array('%s'), //data format
    //     array('%s') //where format
    // );
    // $wpdb->update(
    //     $table_name, //table
    //     array('data' => $passkey), //data
    //     array('type' => 'passkey'), //where
    //     array('%s'), //data format
    //     array('%s') //where format
    // );


    $wpdb->update(
        $table_name, //table
        array('data' => $notif), //data
        array('type' => 'notif'), //where
        array('%s'), //data format
        array('%s') //where format
    );
    // $wpdb->update(
    //     $table_name, //table
    //     array('data' => $urlnotif), //data
    //     array('type' => 'urlnotif'), //where
    //     array('%s'), //data format
    //     array('%s') //where format
    // );
    $wpdb->update(
        $table_name, //table
        array('data' => $urlcs), //data
        array('type' => 'urlcs'), //where
        array('%s'), //data format
        array('%s') //where format
    );
    $wpdb->update(
        $table_name, //table
        array('data' => $opentab), //data
        array('type' => 'opentab'), //where
        array('%s'), //data format
        array('%s') //where format
    );
    $wpdb->update(
        $table_name, //table
        array('data' => $formresend), //data
        array('type' => 'formresend'), //where
        array('%s'), //data format
        array('%s') //where format
    );

	echo '<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">Phone Notification Setting Save Successfully.</span>';
    
    wp_die();

} 
add_action( 'wp_ajax_myaction_save_phonesetting', 'myaction_save_phonesetting' );
add_action( 'wp_ajax_nopriv_myaction_save_phonesetting', 'myaction_save_phonesetting' );
*/


function myaction_verifyphone() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";
    $table_name2 = $wpdb->prefix . "mgo_phone";
    $table_name3 = $wpdb->prefix . "cf_form_entry_values";

    $kode = $_POST['datanya'][0];
    $orderid = $_POST['datanya'][1];
    $redirect_link = $_POST['datanya'][2];

    $entry_id = '';
	$get_entryid = $wpdb->get_results("SELECT * from $table_name3 where value='$orderid' and slug='mgo_orderid' ");
    if($get_entryid!=null){
        $entry_id = $get_entryid[0]->entry_id;
    }

    $nama = '';
    if($entry_id!=''){
	    $get_name = $wpdb->get_results("SELECT * from $table_name3 where entry_id=$entry_id and slug='mgo_nama' ");
	    if($get_name!=null){
	        $nama = $get_name[0]->value;
	    }
	}

	// Open Tab
    $opentab = 'self';

	$set_nama = str_replace('%mgo_nama%', $nama, $redirect_link);
	$set_orderid = str_replace('%mgo_orderid%', $orderid, $set_nama);
	$urlredirect_updated = $set_orderid;
    
    
    $verify_code = $wpdb->get_results('SELECT * from '.$table_name2.' where orderid="'.$orderid.'" and code="'.$kode.'" ');

    if($verify_code!=null){
    	$wpdb->update(
            $table_name2, //table
            array('status' => 1), //data
            array('orderid' => $orderid), //where
            array('%s'), //data format
            array('%s') //where format
        );

    	if($entry_id!=''){
	        // Update WA si orderan di Caldera Form
	        $wpdb->update(
	            $table_name3, //table
	            array('value' => $verify_code[0]->phone), //data
	            array('entry_id' => $entry_id, 'slug' => 'mgo_wa'), //where
	            array('%s'), //data format
	            array('%s') //where format
	        );
    	}
    	echo 'correct__'.$urlredirect_updated.'__'.$opentab;
    }else{
    	echo 'false__0__0';
    }    
    
    wp_die();

} 
add_action( 'wp_ajax_myaction_verifyphone', 'myaction_verifyphone' );
add_action( 'wp_ajax_nopriv_myaction_verifyphone', 'myaction_verifyphone' );



/*
function myaction_sendcode() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";
    $table_name2 = $wpdb->prefix . "mgo_phone";
    $table_name3 = $wpdb->prefix . "cf_form_entry_values";

    $orderid = $_POST['datanya'][0];
    $phone_number = $_POST['datanya'][1];
    $notif = $_POST['datanya'][2];
    $type_otp = $_POST['datanya'][3];

    $entry_id = '';
	$get_entryid = $wpdb->get_results("SELECT * from $table_name3 where value='$orderid' and slug='mgo_orderid' ");
    if($get_entryid!=null){
        $entry_id = $get_entryid[0]->entry_id;
    }

    $nama = '';
    if($entry_id!=''){
	    $get_name = $wpdb->get_results("SELECT * from $table_name3 where entry_id=$entry_id and slug='mgo_nama' ");
	    if($get_name!=null){
	        $nama = $get_name[0]->value;
	    }
	}

    $nama_produk = '';
    if($entry_id!=''){
	    $get_name_product = $wpdb->get_results("SELECT * from $table_name3 where entry_id=$entry_id and slug='mgo_nama_produk' ");
	    if($get_name_product!=null){
	        $nama_produk = $get_name_product[0]->value;
	    }
	}

	$csid = '';
    if($entry_id!=''){
	    $get_csid = $wpdb->get_results("SELECT * from $table_name3 where entry_id=$entry_id and slug='mgo_csid' ");
	    if($get_csid!=null){
	        $csid = $get_csid[0]->value;
	    }
	}

	// URL API
	$row = $wpdb->get_results('SELECT data from '.$table_name.' where type="sms_status" or type="sms_userkey" or type="sms_passkey" or type="sms_apiurl" or type="wanotif_status" or type="wanotif_type" or type="wanotif_apikey" or type="wanotif_url" or type="wanotif_csrotator" ORDER BY id ASC');
	// $notif = $row[0]->data;
	$sms_status = $row[0]->data;
	$sms_userkey = $row[1]->data;
	$sms_passkey = $row[2]->data;
	$sms_apiurl = $row[3]->data;
	$wanotif_status = $row[4]->data; // 0: off, 1: aktif
	$wanotif_type = $row[5]->data; // 0: single sender, 1: cs rotator sender
	$wanotif_apikey = $row[6]->data;
	$wanotif_url = $row[7]->data;
	$wanotif_csrotator = $row[8]->data;

	// $row = $wpdb->get_results('SELECT data from '.$table_name.' where type="sms_status" or type="sms_userkey" or type="sms_passkey" or type="sms_apiurl" ORDER BY id ASC');
	// // $notif = $row[0]->data;
	// $sms_status = $row[0]->data;
	// $sms_userkey = $row[1]->data;
	// $sms_passkey = $row[2]->data;
	// $sms_apiurl = $row[3]->data;

    
    $data_verifikasi = $wpdb->get_results('SELECT * from '.$table_name2.' where orderid="'.$orderid.'" ');

    if($data_verifikasi!=null){

    	$data_verifikasi2 = $wpdb->get_results('SELECT * from '.$table_name2.' where orderid="'.$orderid.'" and phone="'.$phone_number.'" ');
    	
    	// cek ada gak orderid dengan phone yang sama, klo gak phone update
    	if($data_verifikasi2==null){
			$wpdb->update(
	            $table_name2, //table
	            array('phone' => $phone_number), //data
	            array('orderid' => $orderid), //where
	            array('%s'), //data format
	            array('%s') //where format
	        );
    	}

		$set_nama = str_replace('%mgo_nama%', $nama, $notif);
		$set_nama_produk = str_replace('%mgo_nama_produk%', $nama_produk, $set_nama);
		$set_kode = str_replace('%otp_code%', $data_verifikasi[0]->code, $set_nama_produk);
		$message = $set_kode;

		$url = $sms_apiurl;
		$curlHandle = curl_init();
		curl_setopt($curlHandle, CURLOPT_URL, $url);
		curl_setopt($curlHandle, CURLOPT_HEADER, 0);
		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
		curl_setopt($curlHandle, CURLOPT_POST, 1);
		curl_setopt($curlHandle, CURLOPT_POSTFIELDS, array(
		    'userkey' => $sms_userkey,
		    'passkey' => $sms_passkey,
		    'nohp' => $phone_number,
		    'pesan' => $message
		));
		$results = json_decode(curl_exec($curlHandle), true);
		curl_close($curlHandle);
    	
    	echo 'correct';

    }else{
    	echo 'false';
    }    
    
    wp_die();

} 
add_action( 'wp_ajax_myaction_sendcode', 'myaction_sendcode' );
add_action( 'wp_ajax_nopriv_myaction_sendcode', 'myaction_sendcode' );
*/


function myaction_generate_sendcode() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";
    $table_name2 = $wpdb->prefix . "mgo_phone";
    $table_name3 = $wpdb->prefix . "cf_form_entry_values";

    $orderid = $_POST['datanya'][0];
    $phone_number = $_POST['datanya'][1];
    $notif = $_POST['datanya'][2];
    $type_otp = $_POST['datanya'][3];
    $type_send = $_POST['datanya'][4];

    $a1 = mt_rand(0,9);
	$a2 = mt_rand(0,9);
	$a3 = mt_rand(0,9);
	$a4 = mt_rand(0,9);
	$kode = ''.$a1.$a2.$a3.$a4.'';

	$entry_id = '';
	$get_entryid = $wpdb->get_results("SELECT * from $table_name3 where value='$orderid' and slug='mgo_orderid' ");
    if($get_entryid!=null){
        $entry_id = $get_entryid[0]->entry_id;
    }


	if($entry_id!=''){

		$nama = '';
	    if($entry_id!=''){
		    $get_name = $wpdb->get_results("SELECT * from $table_name3 where entry_id=$entry_id and slug='mgo_nama' ");
		    if($get_name!=null){
		        $nama = $get_name[0]->value;
		    }
		}

		$nama_produk = '';
	    if($entry_id!=''){
		    $get_name_product = $wpdb->get_results("SELECT * from $table_name3 where entry_id=$entry_id and slug='mgo_nama_produk' ");
		    if($get_name_product!=null){
		        $nama_produk = $get_name_product[0]->value;
		    }
		}

		$csid = '';
	    if($entry_id!=''){
		    $get_csid = $wpdb->get_results("SELECT * from $table_name3 where entry_id=$entry_id and slug='mgo_csid' ");
		    if($get_csid!=null){
		        $csid = $get_csid[0]->value;
		    }
		}

		// URL API
		$row = $wpdb->get_results('SELECT data from '.$table_name.' where type="sms_status" or type="sms_userkey" or type="sms_passkey" or type="sms_apiurl" or type="wanotif_status" or type="wanotif_type" or type="wanotif_apikey" or type="wanotif_url" or type="wanotif_csrotator" ORDER BY id ASC');
		// $notif = $row[0]->data;
		$sms_status = $row[0]->data;
		$sms_userkey = $row[1]->data;
		$sms_passkey = $row[2]->data;
		$sms_apiurl = $row[3]->data;
		$wanotif_status = $row[4]->data; // 0: off, 1: aktif
		$wanotif_type = $row[5]->data; // 0: single sender, 1: cs rotator sender
		$wanotif_apikey = $row[6]->data;
		$wanotif_url = $row[7]->data;
		$wanotif_csrotator = $row[8]->data;

		// echo (json_encode($row));


		if($type_send=='generate'){
			// CHECK PHONE
		    $data_verifikasi = $wpdb->get_results('SELECT * from '.$table_name2.' where orderid="'.$orderid.'" ');

		    // $send = 0;
		    // cek berdasarkan orderid
		    if($data_verifikasi==null){
		    	// create
		    	$wpdb->insert(
		            $table_name2, //table
		            array('orderid' => $orderid, 'phone' => $phone_number, 'code' => $kode, 'status' => 0), //data
		            array('%s', '%s') //data format         
		        );
		    }else{
		    	// cek lagi berdasarkan orderid dan phone
		    	$data_verifikasi2 = $wpdb->get_results('SELECT * from '.$table_name2.' where orderid="'.$orderid.'" and phone="'.$phone_number.'" ');
		    	$kode = $data_verifikasi[0]->code;

		    	// cek ada gak orderid dengan phone yang sama, klo gak phone update
		    	if($data_verifikasi2==null){
		    		// update phone
					$wpdb->update(
			            $table_name2, //table
			            array('phone' => $phone_number), //data
			            array('orderid' => $orderid), //where
			            array('%s'), //data format
			            array('%s') //where format
			        );
		    	}
		    }
		}else{ // RESEND CODE

			$data_verifikasi = $wpdb->get_results('SELECT * from '.$table_name2.' where orderid="'.$orderid.'" ');

		    if($data_verifikasi!=null){

				$data_verifikasi2 = $wpdb->get_results('SELECT * from '.$table_name2.' where orderid="'.$orderid.'" and phone="'.$phone_number.'" ');
		    	
				// cek ada gak orderid dengan phone yang sama, klo gak phone update
				if($data_verifikasi2==null){
					$wpdb->update(
			            $table_name2, //table
			            array('phone' => $phone_number), //data
			            array('orderid' => $orderid), //where
			            array('%s'), //data format
			            array('%s') //where format
			        );
				}

				$kode = $data_verifikasi[0]->code;

			}else{
				echo 'no_sendcode';
				return false;
			}
		}


	    // MESSAGE
	    $set_nama = str_replace('%mgo_nama%', $nama, $notif);
		$set_nama_produk = str_replace('%mgo_nama_produk%', $nama_produk, $set_nama);
		$set_kode = str_replace('%otp_code%', $kode, $set_nama_produk);
		$message = $set_kode;


		// SENDER
	    if($type_otp=='wa'){

	    	if($wanotif_type==0){
				$apikey = $wanotif_apikey;

				// SET PHONE
				if($phone_number!=''){

					$phone = hp($phone_number);
					$url = $wanotif_url.'/send';

					$spintax = new Spintax();
					$messagenya = $spintax->process($message);

					$curl = curl_init();
					curl_setopt($curl, CURLOPT_URL, $url);
					curl_setopt($curl, CURLOPT_HEADER, 0);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
					curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
					curl_setopt($curl, CURLOPT_TIMEOUT,30);
					curl_setopt($curl, CURLOPT_POST, 1);
					curl_setopt($curl, CURLOPT_POSTFIELDS, array(
					    'Apikey'    => $apikey,
					    'Phone'     => $phone,
					    'Message'   => $message,
					));
					$response = curl_exec($curl);
					curl_close($curl); 
					echo 'sendcode'; 
				}

			}else{
				// YANG KIRIM SI CS ROTATOR

				if($csid!=''){

					$apikey_nya = '';
					$fields = json_decode($wanotif_csrotator, true);
					if(!empty($fields)){
						foreach ($fields as $key => $value ) {
							if($key==$csid){
								$apikey_nya = $value;
							}
						}

						$apikey = $apikey_nya;

				    	// SET PHONE
						if($phone_number!=''){
							$phone = hp($phone_number);
							$url = $wanotif_url.'/send';

							$spintax = new Spintax();
							$messagenya = $spintax->process($message);

							$curl = curl_init();
							curl_setopt($curl, CURLOPT_URL, $url);
							curl_setopt($curl, CURLOPT_HEADER, 0);
							curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
							curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
							curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
							curl_setopt($curl, CURLOPT_TIMEOUT,30);
							curl_setopt($curl, CURLOPT_POST, 1);
							curl_setopt($curl, CURLOPT_POSTFIELDS, array(
							    'Apikey'    => $apikey,
							    'Phone'     => $phone,
							    'Message'   => $messagenya,
							));
							$response = curl_exec($curl);
							curl_close($curl); 

							echo 'sendcode';
						}
					}

			    	
				}
			}

	    }else{

	    	if($sms_status=='1'){
	    		
				$url = $sms_apiurl;
				$curlHandle = curl_init();
				curl_setopt($curlHandle, CURLOPT_URL, $url);
				curl_setopt($curlHandle, CURLOPT_HEADER, 0);
				curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
				curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
				curl_setopt($curlHandle, CURLOPT_POST, 1);
				curl_setopt($curlHandle, CURLOPT_POSTFIELDS, array(
				    'userkey' => $sms_userkey,
				    'passkey' => $sms_passkey,
				    'nohp' => $phone_number,
				    'pesan' => $message
				));
				$results = json_decode(curl_exec($curlHandle), true);
				curl_close($curlHandle);
				
				echo 'sendcode'; 

	    	}else {

	    		echo 'no_sendcode';
	    	}
	    }
	}else{
		echo 'no_sendcode';
	}
			
    
    wp_die();

} 
add_action( 'wp_ajax_myaction_generate_sendcode', 'myaction_generate_sendcode' );
add_action( 'wp_ajax_nopriv_myaction_generate_sendcode', 'myaction_generate_sendcode' );



function mgootp_func( $atts ){
	global $wpdb;
	$table_name = $wpdb->prefix . "mgo_settings";
	$row = $wpdb->get_results('SELECT data from '.$table_name.' where type="formresend" ORDER BY id ASC');
	$formresend = $row[0]->data;

	$form_resend = 'none';
	$kirim_ulang = 'inline';

	$atts = shortcode_atts( array(
		'redirect' => null,
		'title' => null,
		'subtitle' => null,
		'message' => null,
		'type' => null,
	), $atts, 'mgootp' );
	

	$redirect = '';
	if($atts['redirect']!==null){
  		$redirect = $atts['redirect'];
  	}

	$title = 'Verifikasi Kode OTP';
	if($atts['title']!==null){
  		$title = $atts['title'];
  	}

	$type_otp = 'sms';
	if($atts['type']!==null){
  		$type_otp = $atts['type'];
  	}

  	if($type_otp=='wa'){
  		$type_otp = 'wa';
  	}else{
  		$type_otp = 'sms';
  	}


	$subtitle = 'Masukkan 4 kode verifikasi yang dikirimkan ke Handphone anda.';
	if($atts['subtitle']!==null){
  		$subtitle = $atts['subtitle'];
  	}

	$message = '%mgo_nama%, %otp_code% adalah kode verifikasi anda. Gunakan untuk memverifikasi pesanan anda.';
	if($atts['message']!==null){
  		$message = $atts['message'];
  	}

  	ob_start();

	return '
	<div id="mgo_otp">
		<p class="title_verification" id="verification_code">'.$title.'</p>
		 <p style="color:#757472;text-align: center;font-size: 12px;padding: 0 20px;">'.$subtitle.'</p>
		<input type="text" id="type_otp" name="type_otp" value="'.$type_otp.'" style="display:none;" />
		<input type="text" id="message_otp" name="message_otp" value="'.$message.'" style="display:none;" />
		<input type="text" id="redirect_link" name="redirect_link" value="'.$redirect.'" style="display:none;" />
		<button id="kirim_ulang_kode" style="display:'.$kirim_ulang.';">Kirim Ulang Kode</button>
	  	<div id="form_resend" style="display:'.$form_resend.';">
	  		<input type="text" placeholder="No Handphone" class="input_phone" />
	  		<div class="box_resend_button"><button id="resend" class="resend_button">Resend <span id="count"></span></button></div>
	  	</div>
		<p class="info_resend"></p>
		<div class="box-spinner">
		<div class="spinner" style="display:none;">
			  <div class="rect1"></div>
			  <div class="rect2"></div>
			  <div class="rect3"></div>
			  <div class="rect4"></div>
			  <div class="rect5"></div>
		</div>
	  </div>
	  <div class="dots">
	    <div class="dot"></div>
	    <div class="dot"></div>
	    <div class="dot"></div>
	    <div class="dot"></div>
	  </div>
	  <div class="numbers">
	    <div class="number">1</div>
	    <div class="number">2</div>
	    <div class="number">3</div>
	    <div class="number">4</div>
	    <div class="number">5</div>
	    <div class="number">6</div>
	    <div class="number">7</div>
	    <div class="number">8</div>
	    <div class="number">9</div>
	    <div class="number nol">0</div>
	    <div class="number reset"><span>Reset</span></div>
	  </div>
	</div>
	<style>

	</style>
	';

	$output = ob_get_clean();
	return $output;

}
add_shortcode( 'mgootp', 'mgootp_func' );


function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function RandomString($length) {
    $keys = array_merge(range(0,9), range('a', 'z'));

    $key = "";
    for($i=0; $i < $length; $i++) {
        $key .= $keys[mt_rand(0, count($keys) - 1)];
    }
    return $key;
}

function mgo_get_data_telegram($token, $method) {
    $urlweb = 'https://api.telegram.org/bot'.$token.'/'.$method;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $urlweb);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);

	$siteData = curl_exec($ch);
	curl_close($ch);

    $siteData = @json_decode($siteData);
    if($siteData === null) {
      // $ob is null because the json cannot be decoded
      $siteData = 'error';
    }
    return $siteData;
}



function myaction_get_username_telegram() {
	
    $token = $_POST['datanya'][0];
    
	$telegramData = mgo_get_data_telegram($token, 'getMe'); // getMe, getUpdates, getUserProfilePhotos

	if($telegramData!=='error'){
		if($telegramData->ok==true){
			echo '@'.$telegramData->result->username;
		}else{
			echo 'failed';
		}
	}else{
		echo 'failed';
	}
    
    wp_die();

} 
add_action( 'wp_ajax_myaction_get_username_telegram', 'myaction_get_username_telegram' );
add_action( 'wp_ajax_nopriv_myaction_get_username_telegram', 'myaction_get_username_telegram' );


function myaction_get_data_telegram() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";

    $token 		 = $_POST['datanya'][0];
    $usernameBot = $_POST['datanya'][1];

	$telegramData = mgo_get_data_telegram($token, 'getUpdates');

	// print_r($telegramData->result[0]->message->chat->id);

	if($telegramData!=='error'){
		if($telegramData->ok==true){

			$chatID = $telegramData->result[0]->message->chat->id;

			if(empty($chatID)){

				echo '<span class="button" style="margin-top: 20px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: -10px;color: #D00010;">Register Failed. Cek lagi chat bot anda atau test chat dahulu sebelum register setelah itu ulangi.</span>';

			}else{

				$wpdb->update(
			        $table_name, //table
			        array('data' => $token), //data
			        array('type' => 'telegram_apikey_bot'), //where
			        array('%s'), //data format
			        array('%s') //where format
			    );
				$wpdb->update(
			        $table_name, //table
			        array('data' => $chatID), //data
			        array('type' => 'telegram_id_bot'), //where
			        array('%s'), //data format
			        array('%s') //where format
			    );
				$wpdb->update(
			        $table_name, //table
			        array('data' => $usernameBot), //data
			        array('type' => 'telegram_username_bot'), //where
			        array('%s'), //data format
			        array('%s') //where format
			    );

			    // SEND INFO
				$message_tele = 'Bot anda berhasil di daftarkan.';
				myaction_mgo_send2tg($token, $chatID, $message_tele);

				echo '<span class="button" style="margin-top: 20px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: -10px;color: #2EC26A;">Telegram Bot '.$usernameBot.' Register Successfully.</span>';

			}

		}else{
			echo '<span class="button" style="margin-top: 20px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: -10px;color: #C11D1D;">Register Failed!</span>';
		}
	}else{
		echo '<span class="button" style="margin-top: 20px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: -10px;color: #D00010;">Failed!</span>';
	}

    wp_die();

} 
add_action( 'wp_ajax_myaction_get_data_telegram', 'myaction_get_data_telegram' );
add_action( 'wp_ajax_nopriv_myaction_get_data_telegram', 'myaction_get_data_telegram' );



function myaction_mgo_send2tg($token, $chatID, $message_tele) {
	
	$urlweb = 'https://api.telegram.org/bot'.$token.'/sendMessage?text='.rawurlencode($message_tele).'&chat_id='.$chatID.'&parse_mode=Markdown';
	// parse_mode=Markdown
	// parse_mode=HTML

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $urlweb);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);

	$siteData = curl_exec($ch);
	curl_close($ch);

	return $siteData;

} 

/*
add_filter( 'caldera_forms_field_attributes', function($attrs, $field, $form){
	//IMPORTANT - Change your field ID
	global $wpdb;
	$table_name = $wpdb->prefix . "mgo_calculation";
	$form_id = $form['ID'];
	$query_form = $wpdb->get_results('SELECT * from '.$table_name.' where id_form="'.$form_id.'" ');
    if($query_form!=null){
    	$error_message  = $query_form[0]->error_message ;
    	if($error_message!=''){
    		$attrs[ 'data-parsley-error-message' ] = $error_message;
	    	return $attrs;
    	}
    }
	// if ( 'fld_4732283' === $field[ 'ID'] ) {
	// 	$attrs[ 'data-parsley-error-message' ] = 'oke';
	// }
	
}, 20, 3 );
*/


/*
function get_detail_order($entry_id){
	global $wpdb;
    $table_name = $wpdb->prefix . "cf_form_entry_values";
    $table_name2 = $wpdb->prefix . "mgo_settings";
    $table_name5 = $wpdb->prefix . "cf_form_entries";
    $table_name6 = $wpdb->prefix . "cf_forms";

    // cek nama produk setting
    $query_title_settings = $wpdb->get_results('SELECT data from '.$table_name2.' where type="nama_produk_status" or type="nama_produk_other_name" or type="order_id_status" or type="order_id_other_name" ORDER BY id ASC');
    $nama_produk_status = $query_title_settings[0]->data;
    $nama_produk_other_name = $query_title_settings[1]->data;
    $order_id_status = $query_title_settings[2]->data;
    $order_id_other_name = $query_title_settings[3]->data;

    if($nama_produk_status=='1'){
        $nama_produknya = 'Nama Program';
    }elseif($nama_produk_status=='2'){
        $nama_produknya = 'Nama Kegiatan';
    }elseif($nama_produk_status=='3'){
        $nama_produknya = $nama_produk_other_name;
    }else{
        $nama_produknya = 'Nama Produk';
    }

    if($order_id_status=='1'){
        $order_id_set = 'Invoice ID';
    }elseif($order_id_status=='2'){
        $order_id_set = 'Donation ID';
    }elseif($order_id_status=='3'){
        $order_id_set = $order_id_other_name;
    }else{
        $order_id_set = 'Order ID';
    }

    
    //**************************
	//SEND WA MESSAGE
	//**************************
	
	$get_formid = $wpdb->get_results('SELECT form_id from '.$table_name5.' where id="'.$entry_id.'" ');
    $cek_form_on_caldera = $wpdb->get_results('SELECT * from '.$table_name6.' where form_id="'.$get_formid[0]->form_id.'" and type="primary"');

	if($cek_form_on_caldera != null){
		$form_id = $get_formid[0]->form_id;
		$get_urutan_field = $wpdb->get_results('SELECT config from '.$table_name6.' where type="primary" and form_id="'.$form_id.'" ');
		$dataconfig = json_encode(maybe_unserialize( $get_urutan_field[0]->config ));
	    $datajson = json_decode($dataconfig);

        // print_r($datajson->layout_grid->fields);
        $i=1;
        $len = 0;
        foreach ($datajson->layout_grid->fields as $key=>$row) {
            $len++;
        }

        $data_query = '';
        foreach ($datajson->layout_grid->fields as $key=>$row) {
        	
            if($len==$i){
            	$data_query .= "SELECT * from $table_name where entry_id=$entry_id and field_id='$key' ";
            }else{
            	$data_query .= "SELECT * from $table_name where entry_id=$entry_id and field_id='$key' UNION ";
            }
		 
            $i++;

        }
        $query = $wpdb->get_results("$data_query");
    }else{
    	$query = $wpdb->get_results('SELECT * from '.$table_name.' where entry_id="'.$entry_id.'" ORDER BY id ASC');
    }
    

    $content = '';
    $totalharga = '';
    foreach ($query as $row) {
    	$isi = $row->value;


    	if (strpos($isi, '{"opt') !== false) {

			$x = '';
			$isi = '';

				$data_array =json_decode($isi, true);
				$n = 1;
				$l = count($data_array);

				foreach($data_array as $key=>$value){

					if($l==$n){
						$x .= $value.'';
					}else{
						$x .= $value.', '; // add comma
					}
                	$n++;

				}
				$isi = $x;

		}

    	if($isi!='click'){
    		$pieces = explode("_", $row->slug);
      		$mgo = $pieces[0];
      		if($mgo=='mgo'){
      			if($row->slug!='mgo_pembayaran'){
	      			if($pieces[1]!='cswa'){
	      				if($pieces[1]!='csid'){
	      					if($pieces[1]!='csmail'){
	      						if($pieces[1]!='orderid2'){
	      							if($pieces[1]!='kupon'){
					      				if($pieces[1]=='total'){
					      					if (strpos($isi, 'Rp') !== false) {
											    $totalharga = explode("Rp", $isi);
						      					$totalharga = "Rp ".str_replace(",",".",$totalharga[1]);
						      					$isi = $totalharga;
											}else{
												$totalharga = "Rp ".number_format($isi,0,",",".");
												$isi = $totalharga;
											}
					      				}
					      				if($pieces[1]=='item' && $pieces[2]=='total'){
					      					if (strpos($isi, 'Rp') !== false) {
											    $itemtotal = explode("Rp", $isi);
						      					$itemtotal = "Rp ".str_replace(",",".",$itemtotal[1]);
						      					$isi = $itemtotal;
											}
					      				}
					      				if (strpos($row->slug, '.opt') !== false) { // checkbox value > check
				    					}else{
				    						if($pieces[1]=='orderid'){
						      					$judulnya = 'Order ID';
						      				}else{

						      					if($pieces[1]=='rp'){
							      					$isi = 'Rp '.number_format($isi, 0, ',', '.');
							      					$judulnya1 = str_replace('mgo_rp_','',$row->slug);
							      					$judulnya2 = str_replace('mgo_','',$judulnya1);
							      					$judulnya3 = str_replace('_',' ',$judulnya2);
							      					$judulnya = ucwords($judulnya3);
							      				}else{
							      					
							    					$judulnya1 = str_replace('mgo_','',$row->slug);
							      					$judulnya2 = str_replace('_',' ',$judulnya1);
							      					$judulnya = ucwords($judulnya2);
						      					}
						      				}
						      				if (strpos($judulnya, '.opt') !== false) {
												$slugnya = explode(".opt", $judulnya);
												$judulnya = $slugnya[0];
											}
											if($row->slug=='mgo_courier'){
												$isi = strtoupper($isi);
											}
											if($judulnya!='Anonim'){

												if($judulnya=='Nama Produk'){
													$judulnya = 'Nama '.$nama_produknya;
												}

												if($judulnya=='Order ID'){
													$judulnya = $order_id_set;
												}

												if($judulnya=='Wa'){
													$judulnya = 'Whatsapp';
												}

					    						$content .= $judulnya.' : *'.rtrim($isi).'* %0A';
					    					}
				    					}
			    					}
		    					}
	    					}
	    				}
					}
				}
    		}
    		
    	}
    }
    return $content;

}
*/



function myaction_testing_sendsms() {

    global $wpdb;
	$table_name = $wpdb->prefix . "cf_form_entry_values";
    $table_name2 = $wpdb->prefix . "mgo_settings";
    $table_name3 = $wpdb->prefix . "mgo_orders";

    // GET DATA
    $phone = $_POST['datanya'][0];
    $message = $_POST['datanya'][1];

	// GET SETTINGS
	$query = $wpdb->get_results('SELECT data from '.$table_name2.' where type="sms_status" or type="sms_userkey" or type="sms_passkey" or type="sms_apiurl"  or type="sms_text" ORDER BY id ASC');
	$sms_status = $query[0]->data;
	$sms_userkey = $query[1]->data;
	$sms_passkey = $query[2]->data;
	$sms_apiurl = $query[3]->data;
	$sms_text = $query[4]->data;


    if($sms_status==1 && $sms_userkey != ''  && $sms_passkey != ''  && $sms_apiurl != ''){

    	if($sms_apiurl=='http://reguler.sms-notifikasi.com/apps/smsapi.php' || $sms_apiurl=='http://masking.sms-notifikasi.com/apps/smsapi.php' || $sms_apiurl=='https://reguler.zenziva.net/apps/smsapi.php' || $sms_apiurl=='https://alpha.zenziva.net/apps/smsapi.php'){

    		$message = str_replace(' ', '%20', $message);

		    $url = $sms_apiurl.'?userkey='.$sms_userkey.'&passkey='.$sms_passkey.'&nohp='.$phone.'&pesan='.$message;

			$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => $url,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			  CURLOPT_HTTPHEADER => array(
			    "cache-control: no-cache"
			  ),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

		}else{

			$curlHandle = curl_init();
			curl_setopt($curlHandle, CURLOPT_URL, $sms_apiurl);
			curl_setopt($curlHandle, CURLOPT_HEADER, 0);
			curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
			curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
			curl_setopt($curlHandle, CURLOPT_POST, 1);
			curl_setopt($curlHandle, CURLOPT_POSTFIELDS, array(
			    'userkey' => $sms_userkey,
			    'passkey' => $sms_passkey,
			    'nohp' => $phone,
			    'pesan' => $message
			));
			$results = json_decode(curl_exec($curlHandle), true);
			curl_close($curlHandle);
					                                
		}

		echo '<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;color: #2EC26A;">Send SMS Success.</span>';

	}else{
		echo '<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;color: red;">Send SMS Failed.</span>';
	
	}
    
    wp_die();

} 
add_action( 'wp_ajax_myaction_testing_sendsms', 'myaction_testing_sendsms' );
add_action( 'wp_ajax_nopriv_myaction_testing_sendsms', 'myaction_testing_sendsms' );


function myaction_testing_sendwa() {

    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";

    // GET DATA
    $apikey = $_POST['datanya'][0];
    $phone = $_POST['datanya'][1];
    $message = $_POST['datanya'][2];

	// GET SETTINGS
	$query = $wpdb->get_results('SELECT data from '.$table_name.' where type="wanotif_url" ORDER BY id ASC');
	$wanotif_url = $query[0]->data;

	$set_orderid = str_replace('[mgo_orderid]', $orderid, $message);
	$set_nama = str_replace('[mgo_nama]', $namanya, $set_orderid);
	$set_produk = str_replace('[mgo_nama_produk]', $produk, $set_nama);
	$set_total = str_replace('[mgo_total]', $totalharga, $set_produk);
	$set_phone = str_replace('[mgo_wa]', $phone, $set_total);
	$set_pembayaran = str_replace('[mgo_pembayaran]', $pembayaran, $set_phone);
	$set_item_total = str_replace('[mgo_item_total]', $item_total, $set_pembayaran);
	$set_followup1 = str_replace('[followup1]', $link_followup1, $set_item_total);
	$set_followup2 = str_replace('[followup2]', $link_followup2, $set_followup1);
	$set_followup3 = str_replace('[followup3]', $link_followup3, $set_followup2);
	$messagenya = set_whatsapp_format($set_followup3);

	if($apikey!=''){
	    $phone = hp($phone);
		$url = $wanotif_url.'/send';

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_TIMEOUT,30);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, array(
		    'Apikey'    => $apikey,
		    'Phone'     => $phone,
		    'Message'   => $messagenya,
		));
		$response = curl_exec($curl);
		curl_close($curl);

		$array = json_decode( $response, true );
        $status = $array['wanotif']['status'];
        if($status=='sent'){
            echo 'success';
        }else{
            echo $status;
        }
    }else{
    	echo 'Failed.';
    }

    wp_die();

} 
add_action( 'wp_ajax_myaction_testing_sendwa', 'myaction_testing_sendwa' );
add_action( 'wp_ajax_nopriv_myaction_testing_sendwa', 'myaction_testing_sendwa' );



function myaction_testing_send_telegram() {

    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";

    // GET DATA
    $channel = $_POST['datanya'][0];
    $message = $_POST['datanya'][1];

	// GET SETTINGS
	$query = $wpdb->get_results('SELECT data from '.$table_name.' where type="telegram_apikey_bot" ORDER BY id ASC');
	$token = $query[0]->data;

	$send = myaction_mgo_send2tg($token, $channel, $message);

	$array = json_decode( $send, true );
    $status = $array['ok'];

	// {"ok":true,"result":{"message_id":17,"chat":{"id":-1001301647087,"title":"Mgo Tele Channel","username":"mgotelegram","type":"channel"},"date":1580947029,"text":"oke"}}

	// {"ok":false,"error_code":400,"description":"Bad Request: chat not found"}

    if($status==true){
    	echo 'success';
    }else{
    	echo 'Send failed.';
    }

    wp_die();

} 
add_action( 'wp_ajax_myaction_testing_send_telegram', 'myaction_testing_send_telegram' );
add_action( 'wp_ajax_nopriv_myaction_testing_send_telegram', 'myaction_testing_send_telegram' );


function myaction_save_wanotif_settings() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";

    $wanotif_status 	= $_POST['datanya'][0];
    $wanotif_type 		= $_POST['datanya'][1];
    $wanotif_apikey 	= $_POST['datanya'][2];
    $wanotif_message 	= $_POST['datanya'][3];
    $wanotif_csrotator 	= str_replace('\\', '', $_POST['datanya'][4]);

    $wpdb->update(
        $table_name, //table
        array('data' => $wanotif_status), //data
        array('type' => 'wanotif_status'), //where
        array('%s'), //data format
        array('%s') //where format
    );
    $wpdb->update(
        $table_name, //table
        array('data' => $wanotif_type), //data
        array('type' => 'wanotif_type'), //where
        array('%s'), //data format
        array('%s') //where format
    );
    $wpdb->update(
        $table_name, //table
        array('data' => $wanotif_apikey), //data
        array('type' => 'wanotif_apikey'), //where
        array('%s'), //data format
        array('%s') //where format
    );
    $wpdb->update(
        $table_name, //table
        array('data' => $wanotif_message), //data
        array('type' => 'wanotif_message'), //where
        array('%s'), //data format
        array('%s') //where format
    );
    $wpdb->update(
        $table_name, //table
        array('data' => $wanotif_csrotator), //data
        array('type' => 'wanotif_csrotator'), //where
        array('%s'), //data format
        array('%s') //where format
    );

	echo '<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">API WANOTIF Save Successfully.</span>';
    
    wp_die();

} 
add_action( 'wp_ajax_myaction_save_wanotif_settings', 'myaction_save_wanotif_settings' );
add_action( 'wp_ajax_nopriv_myaction_save_wanotif_settings', 'myaction_save_wanotif_settings' );



function myaction_save_qris() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";

    $qris_qrcode 	= $_POST['datanya'][0];

    $wpdb->update(
        $table_name, //table
        array('data' => $qris_qrcode), //data
        array('type' => 'qris_qrcode'), //where
        array('%s'), //data format
        array('%s') //where format
    );

	echo '<span class="button" style="margin-top: 20px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">QRIS QR-Code Save Successfully.</span>';
    
    wp_die();

} 
add_action( 'wp_ajax_myaction_save_qris', 'myaction_save_qris' );
add_action( 'wp_ajax_nopriv_myaction_save_qris', 'myaction_save_qris' );



function myaction_save_telegram_settings() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";

	// telegram_status,
	// owner_channel,
	// telegram_csrotator_channel,
	// telegram_general_message

    $telegram_status 			= $_POST['datanya'][0];
    $telegram_single_channel 	= $_POST['datanya'][1];
    $telegram_csrotator_channel = str_replace('\\', '', $_POST['datanya'][2]);
    $telegram_message 			= $_POST['datanya'][3];

    $wpdb->update(
        $table_name, //table
        array('data' => $telegram_status), //data
        array('type' => 'telegram_status'), //where
        array('%s'), //data format
        array('%s') //where format
    );
    $wpdb->update(
        $table_name, //table
        array('data' => $telegram_single_channel), //data
        array('type' => 'telegram_single_channel'), //where
        array('%s'), //data format
        array('%s') //where format
    );
    $wpdb->update(
        $table_name, //table
        array('data' => $telegram_csrotator_channel), //data
        array('type' => 'telegram_csrotator_channel'), //where
        array('%s'), //data format
        array('%s') //where format
    );
    $wpdb->update(
        $table_name, //table
        array('data' => $telegram_message), //data
        array('type' => 'telegram_message'), //where
        array('%s'), //data format
        array('%s') //where format
    );

	echo '<span class="button" style="margin-top: 20px;border: 0;background: none;box-shadow: none;cursor: text;color: #2EC26A;">Telegram Settings Save Successfully.</span>';
    
    wp_die();

} 
add_action( 'wp_ajax_myaction_save_telegram_settings', 'myaction_save_telegram_settings' );
add_action( 'wp_ajax_nopriv_myaction_save_telegram_settings', 'myaction_save_telegram_settings' );


function myaction_save_lr() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_lr";

    $lr_name 		= $_POST['datanya'][0];
    $lr_code 		= $_POST['datanya'][1];
    $lr_link 		= str_replace('\\', '', $_POST['datanya'][2]);
    $lr_priority 	= str_replace('\\', '', $_POST['datanya'][3]);

    $check_code = $wpdb->get_results('SELECT * from '.$table_name.' where lr_code= "'.$lr_code.'"');
	if ( empty($check_code) ) {
	    $wpdb->insert(
			$table_name,
			array(
					'lr_name' => $lr_name,
					'lr_code' => $lr_code,
					'lr_link' => $lr_link,
					'lr_priority' => $lr_priority ),
			array('%s', '%s')
		);

		echo '<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">Link Rotator Save Successfully.</span>';
	}else{
		echo 'failed';
	}
    
    wp_die();

} 
add_action( 'wp_ajax_myaction_save_lr', 'myaction_save_lr' );
add_action( 'wp_ajax_nopriv_myaction_save_lr', 'myaction_save_lr' );



function myaction_update_lr() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_lr";

    $id 			= $_POST['datanya'][0];
    $lr_name 		= $_POST['datanya'][1];
    $lr_code 		= $_POST['datanya'][2];
    $lr_link 		= str_replace('\\', '', $_POST['datanya'][3]);
    $lr_priority 	= str_replace('\\', '', $_POST['datanya'][4]);

    $check_code = $wpdb->get_results('SELECT * from '.$table_name.' where lr_code= "'.$lr_code.'"');
	if ( empty($check_code) ) {
	    $wpdb->update(
			$table_name,
			array(
					'lr_name' => $lr_name,
					'lr_code' => $lr_code,
					'lr_link' => $lr_link,
					'lr_priority' => $lr_priority ),
            array('id' => $id), //where
            array('%s'), //data format
            array('%s') //where format
		);

		echo '<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">Link Rotator Update Successfully.</span>';

	}else{
		$check_code2 = $wpdb->get_results('SELECT * from '.$table_name.' where lr_code= "'.$lr_code.'" and id= "'.$id.'"');
		if ( empty($check_code2) ) {
			echo 'failed';
		}else{
			$wpdb->update(
				$table_name,
				array(
						'lr_name' => $lr_name,
						'lr_code' => $lr_code,
						'lr_link' => $lr_link,
						'lr_priority' => $lr_priority ),
	            array('id' => $id), //where
	            array('%s'), //data format
	            array('%s') //where format
			);
			echo '<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">Link Rotator Update Successfully.</span>';
		}
	}
    
    wp_die();

} 
add_action( 'wp_ajax_myaction_update_lr', 'myaction_update_lr' );
add_action( 'wp_ajax_nopriv_myaction_update_lr', 'myaction_update_lr' );




function myaction_delete_lr() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_lr";

    $id = $_POST['datanya'][0];

    if ( $wpdb->get_var( $wpdb->prepare( 'SELECT id FROM '.$table_name.' WHERE id = %d', $id ) ) ) {
        $wpdb->query( $wpdb->prepare( 'DELETE FROM '.$table_name.' WHERE id = %d', $id ) );
        echo 'success';
    }else{
    	echo 'not allowed';
    }
    
    wp_die();

} 
add_action( 'wp_ajax_myaction_delete_lr', 'myaction_delete_lr' );
add_action( 'wp_ajax_nopriv_myaction_delete_lr', 'myaction_delete_lr' );


function myaction_save_l_rotator() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";

    $l_rotator = $_POST['datanya'][0];

    $wpdb->update(
        $table_name, //table
        array('data' => $l_rotator), //data
        array('type' => 'l_rotator'), //where
        array('%s'), //data format
        array('%s') //where format
    );

	echo 'success';
    
    wp_die();

} 
add_action( 'wp_ajax_myaction_save_l_rotator', 'myaction_save_l_rotator' );
add_action( 'wp_ajax_nopriv_myaction_save_l_rotator', 'myaction_save_l_rotator' );





function myaction_save_smssettings() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";

    $sms_status = $_POST['datanya'][0];
    $sms_userkey = $_POST['datanya'][1];
    $sms_passkey 	= $_POST['datanya'][2];
    $sms_apiurl = $_POST['datanya'][3];
    $sms_text = $_POST['datanya'][4];

    $wpdb->update(
        $table_name, //table
        array('data' => $sms_status), //data
        array('type' => 'sms_status'), //where
        array('%s'), //data format
        array('%s') //where format
    );
    $wpdb->update(
        $table_name, //table
        array('data' => $sms_userkey), //data
        array('type' => 'sms_userkey'), //where
        array('%s'), //data format
        array('%s') //where format
    );
    $wpdb->update(
        $table_name, //table
        array('data' => $sms_passkey), //data
        array('type' => 'sms_passkey'), //where
        array('%s'), //data format
        array('%s') //where format
    );
    $wpdb->update(
        $table_name, //table
        array('data' => $sms_apiurl), //data
        array('type' => 'sms_apiurl'), //where
        array('%s'), //data format
        array('%s') //where format
    );
    $wpdb->update(
        $table_name, //table
        array('data' => $sms_text), //data
        array('type' => 'sms_text'), //where
        array('%s'), //data format
        array('%s') //where format
    );

	echo '<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">API SMS Save Successfully.</span>';
    
    wp_die();

} 
add_action( 'wp_ajax_myaction_save_smssettings', 'myaction_save_smssettings' );
add_action( 'wp_ajax_nopriv_myaction_save_smssettings', 'myaction_save_smssettings' );



function myaction_save_jquery() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";

    $jquery_active = $_POST['datanya'][0];

    $wpdb->update(
        $table_name, //table
        array('data' => $jquery_active), //data
        array('type' => 'jquery_active'), //where
        array('%s'), //data format
        array('%s') //where format
    );

	echo '<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">JQuery Save Successfully.</span>';
    
    wp_die();

} 
add_action( 'wp_ajax_myaction_save_jquery', 'myaction_save_jquery' );
add_action( 'wp_ajax_nopriv_myaction_save_jquery', 'myaction_save_jquery' );



function myaction_save_fontawesome() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";

    $fontawesome = $_POST['datanya'][0];

    $wpdb->update(
        $table_name, //table
        array('data' => $fontawesome), //data
        array('type' => 'fontawesome'), //where
        array('%s'), //data format
        array('%s') //where format
    );

	echo '<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">Fontawesome Save Successfully.</span>';
    
    wp_die();

} 
add_action( 'wp_ajax_myaction_save_fontawesome', 'myaction_save_fontawesome' );
add_action( 'wp_ajax_nopriv_myaction_save_fontawesome', 'myaction_save_fontawesome' );


function myaction_save_page_protector() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";

    $page_protector = $_POST['datanya'][0];

    $wpdb->update(
        $table_name, //table
        array('data' => $page_protector), //data
        array('type' => 'page_protector'), //where
        array('%s'), //data format
        array('%s') //where format
    );

	echo '<span class="button" style="margin-top: 30px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">Page Protector Save Successfully.</span>';
    
    wp_die();

} 
add_action( 'wp_ajax_myaction_save_page_protector', 'myaction_save_page_protector' );
add_action( 'wp_ajax_nopriv_myaction_save_page_protector', 'myaction_save_page_protector' );


function myaction_save_mgo_footer() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";

    $mgo_footer = $_POST['datanya'][0];

    $wpdb->update(
        $table_name, //table
        array('data' => $mgo_footer), //data
        array('type' => 'mgo_footer'), //where
        array('%s'), //data format
        array('%s') //where format
    );

	echo '<span class="button" style="margin-top: 30px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">Powered by Magic Order Save Successfully.</span>';
    
    wp_die();

} 
add_action( 'wp_ajax_myaction_save_mgo_footer', 'myaction_save_mgo_footer' );
add_action( 'wp_ajax_nopriv_myaction_save_mgo_footer', 'myaction_save_mgo_footer' );



function myaction_save_minchar() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";

    $minchar = $_POST['datanya'][0];

    $wpdb->update(
        $table_name, //table
        array('data' => $minchar), //data
        array('type' => 'minchar'), //where
        array('%s'), //data format
        array('%s') //where format
    );

	echo '<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">Minimal Character Save Successfully.</span>';
    
    wp_die();

} 
add_action( 'wp_ajax_myaction_save_minchar', 'myaction_save_minchar' );
add_action( 'wp_ajax_nopriv_myaction_save_minchar', 'myaction_save_minchar' );



function myaction_reset_wa() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";

    $wpdb->update(
	    $table_name, //table
	    array('data' => 'Terimakasih telah melakukan pemesanan, berikut detail orderan anda:'), //data
	    array('type' => 'wa_pembuka'), //where
	    array('%s'), //data format
	    array('%s') //where format
	);


    $wpdb->update(
	    $table_name, //table
	    array('data' => 'Untuk pembayaran, silahkan transfer ke rek,<br>BNI NO_REKENING <br>BCA NO_REKENING<br>a.n <b>NAMA_ANDA</b>'), //data
	    array('type' => 'wa_penutup'), //where
	    array('%s'), //data format
	    array('%s') //where format
	);


    $wpdb->update(
	    $table_name, //table
	    array('data' => 'Halo Ka, pesanannya sudah siap kami kirim.<br><br>Mohon untuk segera mengirimkan bukti transfernya yaa.<br>Terima kasih'), //data
	    array('type' => 'wa_followup_dua'), //where
	    array('%s'), //data format
	    array('%s') //where format
	);


    $wpdb->update(
	    $table_name, //table
	    array('data' => 'Halo Ka, mohon maaf apakah pesanannya jadi di order?<br><br>Kalau tidak, kami akan berikan untuk orang lain yang sudah memberikan bukti pembayaran.<br>Terima kasih'), //data
	    array('type' => 'wa_followup_tiga'), //where
	    array('%s'), //data format
	    array('%s') //where format
	);

	echo '<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">Reseting Success...</span>';
    
    wp_die();

} 
add_action( 'wp_ajax_myaction_reset_wa', 'myaction_reset_wa' );
add_action( 'wp_ajax_nopriv_myaction_reset_wa', 'myaction_reset_wa' );



function myaction_reset_wa_custom() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "cf_forms";
    $table_name2 = $wpdb->prefix . "mgo_calculation";

    $type = $_POST['datanya'][0];
    $form_id = $_POST['datanya'][1];
    
    $jumlah_form = $wpdb->get_var('SELECT * from '.$table_name2.' where id_form="'.$form_id.'"');
    if($jumlah_form>=1){
        $wpdb->update(
            $table_name2, //table
            array('f_transfer_satu' => 'Followup 1 metode transfer, silahkan di update.', 'f_transfer_dua' => 'Followup 2 metode transfer, silahkan di update.', 'f_transfer_tiga' => 'Followup 3 metode transfer, silahkan di update.', 'f_cod_satu' => 'Followup 1 metode COD, silahkan di update.', 'f_cod_dua' => 'Followup 2 metode COD, silahkan di update.', 'f_cod_tiga' => 'Followup 3 metode COD, silahkan di update.'), //data
            array('id_form' => $form_id), //where
            array('%s'), //data format
            array('%s') //where format
        );
    }

	echo '<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">Reseting Success...</span>';
    
    wp_die();

} 
add_action( 'wp_ajax_myaction_reset_wa_custom', 'myaction_reset_wa_custom' );
add_action( 'wp_ajax_nopriv_myaction_reset_wa_custom', 'myaction_reset_wa_custom' );




function myaction_reset_wa_autosave() {
    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_settings";

    $wpdb->update(
	    $table_name, //table
	    array('data' => 'Ada yang bisa kami bantu terkait pesanannya kakak?'), //data
	    array('type' => 'wa_followup'), //where
	    array('%s'), //data format
	    array('%s') //where format
	);

	echo '<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">Reseting Success...</span>';
    
    wp_die();

} 
add_action( 'wp_ajax_myaction_reset_wa_autosave', 'myaction_reset_wa_autosave' );
add_action( 'wp_ajax_nopriv_myaction_reset_wa_autosave', 'myaction_reset_wa_autosave' );


function myaction_update_collation_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . "cf_form_entry_values";
    $table_name2 = $wpdb->prefix . "cf_form_entries";
    $table_name3 = $wpdb->prefix . "mgo_orders";
    
    $db_collate = $wpdb->get_charset_collate();
     
    $collate = '';
    $get_db_collate = explode("COLLATE ", $db_collate);
    if($get_db_collate!=''){
    	$collate = $get_db_collate[1];
    }

    $result = $wpdb->get_var("SHOW COLUMNS FROM $table_name3 LIKE 'form_id'");
	if($result!=null) {
		$wpdb->get_var("ALTER TABLE $table_name3 DROP `form_id`");
	}
    $result2 = $wpdb->get_var("SHOW COLUMNS FROM $table_name3 LIKE 'entry_id'");
	if($result2!=null) {
		$wpdb->get_var("ALTER TABLE $table_name3 DROP `entry_id`");
	}


    if($collate!=''){
	    $wpdb->get_var("ALTER TABLE $table_name CONVERT TO CHARACTER SET utf8mb4 COLLATE $collate");

	    $wpdb->get_var("ALTER TABLE $table_name CHANGE `field_id` `field_id` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE $collate NOT NULL, CHANGE `slug` `slug` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE $collate NOT NULL DEFAULT '', CHANGE `value` `value` LONGTEXT CHARACTER SET utf8mb4 COLLATE $collate NOT NULL;" );
        
        $wpdb->get_var("ALTER TABLE $table_name2 CONVERT TO CHARACTER SET utf8mb4 COLLATE $collate");
        
        $wpdb->get_var("ALTER TABLE $table_name3 CONVERT TO CHARACTER SET utf8mb4 COLLATE $collate");
        
		echo '<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">Update Table Collation Success...</span>';
	}else{
		echo '<span class="button" style="border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color:red;">Update Table Collation Failed...</span>';
	}

    wp_die();

} 
add_action( 'wp_ajax_myaction_update_collation_table', 'myaction_update_collation_table' );
add_action( 'wp_ajax_nopriv_myaction_update_collation_table', 'myaction_update_collation_table' );


function myaction_data_autosave_wa() {
	
    global $wpdb;
    $table_name = $wpdb->prefix . "cf_forms";
    $table_name3 = $wpdb->prefix . "mgo_settings";
    $table_name4 = $wpdb->prefix . "cf_form_entry_values";
    $table_name5 = $wpdb->prefix . "cf_form_entries";
    $table_name6 = $wpdb->prefix . "mgo_orders";
    $table_name7 = $wpdb->prefix . "mgo_order_statuses";
    $table_name8 = $wpdb->prefix . "users";
    $table_name9 = $wpdb->prefix . "mgo_autosave_wa";

    $startlist = $_POST['start'];
    $length = $_POST['length'];
    $draw = $_POST['draw'];
    
    
    $limit = '';
	if($length==-1){
		$limit = '';
	}else{
		$limit = "LIMIT $startlist,$length";
	}


    $cap = get_user_meta( wp_get_current_user()->ID, $wpdb->get_blog_prefix() . 'capabilities', true );
    $roles = array_keys((array)$cap);
    $role = $roles[0];

    $id_login = wp_get_current_user()->ID;

    if($role!='administrator'){

    	$rows_entry_all = $wpdb->get_results("SELECT * from $table_name9");
	    $rows_entry = $wpdb->get_results("SELECT * from $table_name9 where cs_id=$id_login ORDER BY id DESC $limit");

    }else{

    	$rows_entry_all = $wpdb->get_results("SELECT * from $table_name9");
	    $rows_entry = $wpdb->get_results("SELECT * from $table_name9 ORDER BY id DESC $limit");

    }

    $jumlah_total = count($rows_entry_all);

    

   	echo '
		{
		  "draw": '.$draw.',
		  "recordsTotal": '.$jumlah_total.',
		  "recordsFiltered": '.$jumlah_total.',
		  "closingRatio": 0,
		  "myList": [';

		// $startlist = 0;

		$no = 1+$startlist;
		$len = count($rows_entry)+$startlist;

        foreach ($rows_entry as $row) {

            // Get Form Name
            $query_forms = $wpdb->get_results('SELECT config from '.$table_name.' where type="primary" and form_id="'.$row->form_id.'" ');
            $dataconfignya = json_encode(maybe_unserialize( $query_forms[0]->config ));
            $datajsonnya = json_decode($dataconfignya);

            // Nama Customer
            $get_data = $wpdb->get_results("SELECT entry_id from $table_name4 where value='$row->order_id' ");
            if($get_data==null){
                $entry_id = '-';
                $entryid_show = "style='display:none;'";
            }else{
                $entry_id = $get_data[0]->entry_id;
                $entryid_show = '';
            }
            
            // GET CS Name
            $id_cs = $row->cs_id;

            if ($row->cs_id!=null){
                // $get_name = $wpdb->get_results("SELECT * from $table_name8 where ID=$row->cs_id ");
                $args2 = array( 'blog_id' => 0, 'search' => $row->cs_id, 'search_columns' => array( 'ID' ) );
                $get_name = get_users( $args2 );

                if($get_name==null){
                    $cs_name = '-';
                }else{
                    $nama_user = str_replace("'", "", $get_name[0]->display_name);
	                $cs_name = $nama_user; // nama asli
                }
            }else{
                $cs_name = '-';
            }

            // Followup
            if($row->status_followup==0){
                $wa_info = 'red';
                $wa_icon = 'wa_red.png';
                $wa_title = 'Belum di Followup';
            }else{
                $wa_info = '';
                $wa_icon = 'wa.png';
                $wa_title = 'Sudah di Followup';
            }

            // date_default_timezone_set('Asia/Jakarta');

            if($row->order_id!=''){
                // CUSTOMER SERVICES (EDITOR ROLE)
                if($role!='administrator'){
                    
                    if($id_login==$id_cs) {

                    echo '
	                    [
					      "",
					      "<span data-orderid='."'".$row->order_id."'".' data-entryid='."'".$entry_id."'".' data-rowid='."'".$row->id."'".'>'.$no.'</span>",
					      "<span data-orderid='."'".$row->order_id."'".' data-entryid='."'".$entry_id."'".' >'.handling_character($row->name).'</span>",
					      "'.handling_character($row->wa_number).'",
					      "'.handling_character($datajsonnya->name).'",
					      "'.handling_character($row->order_id).'",
					      "<span class=td_csname>'.handling_character($cs_name).'</span>",
					      "'.date("F j, Y - ",strtotime($row->created_at)).date("H:i ",strtotime($row->created_at)).'",
					      "<span class='."'".'link_on_table btn-detail-order'."'".' data-id='."'".''.handling_character($row->order_id).''."'".' data-formid='."'".''.$row->form_id.''."'".' data-entryid='."'".''.$entry_id.''."'".' data-toggle='."'".'modal'."'".' data-target='."'".'#ModalUpdateStatus'."' ".$entryid_show.'><button type='."'".'button'."'".' class='."'".'button btn_mgo btn_regular'."'".' style='."'".'padding: 0 10px 0 5px;font-size:12px;border:none !important;'."'".'><span class='."'".'dashicons dashicons-format-aside'."'".' style='."'".'font-size: 14px;padding-top: 6px;margin-right: 2px;'."'".'></span>Detail</button></span>",
					      "<a href='."'".'javascript:;'."'".' data-no='."'".''.$no.''."'".' id='."'".'wa_'.handling_character($row->order_id).''."'".' data-id='."'".''.handling_character($row->order_id).''."'".' data-entryid='."'".''.$entry_id.''."'".' class='."'".'link_on_table btn-send-wa '.$wa_info.''."'".' title='."'".''.$wa_title.''."'".'><span id='."'".'icon_'.$no.''."'".' class='."'".'dashicons dashicons-update spin'."'".' style='."'".'font-size: 21px;margin-top: 0px;width: 21px;display: none;'."'".'></span><img id='."'".'img_'.$no.''."'".' src='."'".''.plugin_dir_url( __FILE__ ).'main/../assets/icons/'.$wa_icon.''."'".' />Send WA</a>'.$time_followup_status.'",
					      "<button data-orderid='."'".''.handling_character($row->order_id).''."'".'  data-formid='."'".$row->form_id."'".' data-entryid='."'".''.$entry_id.''."'".' type='."'".'button'."'".' class='."'".'button btn_mgo btn_regular red_color delete_link delete_wa'."'".' title='."'".'Delete'."'".'>Delete</button>"
					    ]'; // end echo

						if($len==$no){echo'';}else{echo',';} // add koma

                    $no++;

                    } // close if tags if($id_login==$id_cs && $get_cs!=null)
                } 
                // ADMINISTRATOR ROLE
                else {
                    echo '
	                    [
					      "",
					      "<span data-orderid='."'".$row->order_id."'".' data-entryid='."'".$entry_id."'".' data-rowid='."'".$row->id."'".'>'.$no.'</span>",
					      "<span data-orderid='."'".$row->order_id."'".' data-entryid='."'".$entry_id."'".' >'.handling_character($row->name).'</span>",
					      "'.handling_character($row->wa_number).'",
					      "'.handling_character($datajsonnya->name).'",
					      "'.handling_character($row->order_id).'",
					      "<span class=td_csname>'.handling_character($cs_name).'</span>",
					      "'.date("F j, Y - ",strtotime($row->created_at)).date("H:i ",strtotime($row->created_at)).'",
					      "<span class='."'".'link_on_table btn-detail-order'."'".' data-id='."'".''.handling_character($row->order_id).''."'".' data-formid='."'".''.$row->form_id.''."'".' data-entryid='."'".''.$entry_id.''."'".' data-toggle='."'".'modal'."'".' data-target='."'".'#ModalUpdateStatus'."' ".$entryid_show.'><button type='."'".'button'."'".' class='."'".'button btn_mgo btn_regular'."'".' style='."'".'padding: 0 10px 0 5px;font-size:12px;border:none !important;'."'".'><span class='."'".'dashicons dashicons-format-aside'."'".' style='."'".'font-size: 14px;padding-top: 6px;margin-right: 2px;'."'".'></span>Detail</button></span>",
					      "<a href='."'".'javascript:;'."'".' data-no='."'".''.$no.''."'".' id='."'".'wa_'.handling_character($row->order_id).''."'".' data-id='."'".''.handling_character($row->order_id).''."'".' data-entryid='."'".''.$entry_id.''."'".' class='."'".'link_on_table btn-send-wa '.$wa_info.''."'".' title='."'".''.$wa_title.''."'".'><span id='."'".'icon_'.$no.''."'".' class='."'".'dashicons dashicons-update spin'."'".' style='."'".'font-size: 21px;margin-top: 0px;width: 21px;display: none;'."'".'></span><img id='."'".'img_'.$no.''."'".' src='."'".''.plugin_dir_url( __FILE__ ).'main/../assets/icons/'.$wa_icon.''."'".' />Send WA</a>'.$time_followup_status.'",
					      "<button data-orderid='."'".''.handling_character($row->order_id).''."'".'  data-formid='."'".$row->form_id."'".' data-entryid='."'".''.$entry_id.''."'".' type='."'".'button'."'".' class='."'".'button btn_mgo btn_regular red_color delete_link delete_wa'."'".' title='."'".'Delete'."'".'>Delete</button>"
					    ]'; // end echo

					if($len==$no){echo'';}else{echo',';} // add koma

                    $no++;
                }
            }
        }

    echo '

			]
		}
    ';
	   
    wp_die();

} 
add_action( 'wp_ajax_myaction_data_autosave_wa', 'myaction_data_autosave_wa' );
add_action( 'wp_ajax_nopriv_myaction_data_autosave_wa', 'myaction_data_autosave_wa' );


function myaction_data_orders() {
	
    global $wpdb;
    mgo_global_vars();
    $expired = $GLOBALS['mgovars']['expired'];
    $date_expired = $GLOBALS['mgovars']['date_expired'];
    $plugin_name = $GLOBALS['mgovars']['plugin_name'];
    $plugin_version = $GLOBALS['mgovars']['plugin_version'];
    $plugin_license = $GLOBALS['mgovars']['plugin_license'];
    $apikey = $GLOBALS['mgovars']['apikey'];
    $apikey_status = $GLOBALS['mgovars']['apikey_status'];

    // SATU
    $table_name = $wpdb->prefix . "cf_forms";
    $table_name3 = $wpdb->prefix . "mgo_settings";
    $table_name4 = $wpdb->prefix . "cf_form_entry_values";
    $table_name5 = $wpdb->prefix . "cf_form_entries";
    $table_name6 = $wpdb->prefix . "mgo_orders";
    $table_name7 = $wpdb->prefix . "mgo_order_statuses";
    $table_name8 = $wpdb->prefix . "users";
    $table_name9 = $wpdb->prefix . "mgo_phone";
    $table_name10 = $wpdb->prefix . "mgo_orders";
    $table_name11 = $wpdb->prefix . "mgo_moota_log";
    $table_name12 = $wpdb->prefix . "mgo_calculation";

    // $plugin_status = $wpdb->get_results("SELECT * from $table_name3 where type='plugin_status'")[0];
    $table_field = $wpdb->get_results("SELECT data from $table_name3 where type='table_field'")[0];
    $btn_del_status = $wpdb->get_results("SELECT data from $table_name3 where type='btn_del_status'")[0];
    
    // FROM DATATABLES
    $startlist = $_POST['start'];
    $length = $_POST['length'];
    $draw = $_POST['draw'];
    $filter_option = $_POST['filter_option'];
    $filter_form = $_POST['filter_form'];
    $filter_cs = $_POST['filter_cs'];
    $filter_orderid = $_POST['filter_orderid'];
    $filter_product = $_POST['filter_product'];
    $filter_coupon = $_POST['filter_coupon'];
    $filter_name = $_POST['filter_name'];
    $filter_load = $_POST['filter_load'];
    $filter_datestart = $_POST['filter_datestart'];
    $filter_dateend = $_POST['filter_dateend'];
    $filter_csdate = $_POST['filter_csdate'];
    $filter_datestartcs = $_POST['filter_datestartcs'];
    $filter_dateendcs = $_POST['filter_dateendcs'];
    $filter_status = $_POST['filter_status'];
    $filter_statusdate = $_POST['filter_statusdate'];
    $filter_datestartstatus = $_POST['filter_datestartstatus'];
    $filter_dateendstatus = $_POST['filter_dateendstatus'];

    // DATA GENERAL
    $time_start = strtotime($filter_datestart);
	$date_start = strtotime('-7 hours', $time_start);
	$filter_datestart_now = date('Y-m-d H:i', $date_start);

	$time_end = strtotime($filter_dateend);
	$date_end = strtotime('-7 hours', $time_end);
	$filter_dateend_now = date('Y-m-d H:i', $date_end);

	// DATE CS
    $time_start2 = strtotime($filter_datestartcs);
	$date_start2 = strtotime('-7 hours', $time_start2);
	$filter_datestart_now2 = date('Y-m-d H:i', $date_start2);

	$time_end2 = strtotime($filter_dateendcs);
	$date_end2 = strtotime('-7 hours', $time_end2);
	$filter_dateend_now2 = date('Y-m-d H:i', $date_end2);

    

	// $_POST['order'][0]['column'].$_POST['order'][0]['dir']

    // LIMIT
    $limit = '';
    // if($plugin_status->data=='Freemium' || $plugin_status->data=='freemium' || $plugin_status->data=='FREEMIUM'){
    //     $limit = 'LIMIT 100';
    // }else{
    	if($length==-1){
    		$limit = '';
    	}else{
    		$limit = "LIMIT $startlist,$length";
    	}
    // }

    // GET USER ROLES ROLES
    $cap = get_user_meta( wp_get_current_user()->ID, $wpdb->get_blog_prefix() . 'capabilities', true );
    $roles = array_keys((array)$cap);
    $role = $roles[0];
    $id_login = wp_get_current_user()->ID;

    // FILTER LOAD
    // 0 : artinya query semua
    // 1 : artinya query semua berdasarkan form
    // 2 : artinya query berdasarkan filter

    if($filter_load==0){
    	if($role=='administrator'){

		    $rows_entry = $wpdb->get_results("SELECT * from $table_name4 
		    	LEFT JOIN $table_name5 ON $table_name4.entry_id = $table_name5.id 
		    	where slug LIKE '%mgo_orderid%' 
		    	GROUP BY value 
		    	ORDER BY $table_name4.entry_id DESC $limit");
	
			$query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a
				LEFT JOIN $table_name5 as b ON a.entry_id = b.id
				where slug LIKE '%mgo_orderid%'");

		}else{

			$rows_entry = $wpdb->get_results("SELECT a.entry_id, a.value as value, c.value as csid, form_id, datestamp  
				from $table_name4 as a 
				LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
				LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
				where c.value = '$id_login' and c.slug = 'mgo_csid' and a.slug like '%mgo_orderid%' 
				ORDER BY a.entry_id DESC $limit");

		    $query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
		    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
		    	LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
		    	where c.value = '$id_login' and c.slug = 'mgo_csid' and a.slug like '%mgo_orderid%'");

		}

	}elseif($filter_load==1){
		if($role=='administrator'){
		
			$rows_entry = $wpdb->get_results("SELECT * from $table_name4 
				LEFT JOIN $table_name5 ON $table_name4.entry_id = $table_name5.id 
				where slug LIKE '%mgo_orderid%' and form_id='$filter_form' 
				GROUP BY value 
				ORDER BY $table_name4.entry_id DESC $limit");

			$query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a
				LEFT JOIN $table_name5 as b ON a.entry_id = b.id
				where slug LIKE '%mgo_orderid%' and form_id='$filter_form'");

		}else{

			$rows_entry = $wpdb->get_results("SELECT  a.entry_id, a.value as value, c.value as csid, form_id, datestamp from $table_name4 as a 
		    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
		    	LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
		    	where c.value = '$id_login' and c.slug = 'mgo_csid' and a.slug like '%mgo_orderid%' and form_id = '$filter_form'
				ORDER BY a.entry_id 
				DESC $limit");

			$query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
		    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
		    	LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
		    	where c.value = '$id_login' and c.slug = 'mgo_csid' and a.slug like '%mgo_orderid%' and form_id = '$filter_form'");

		}

	}elseif($filter_load==2){

		if($filter_form=='0'){
			$formnya = "";
		}else{
			$formnya = "and form_id='$filter_form'";
		}

		if($filter_option=='cs'){

			if($filter_csdate=='alldate'){

				$rows_entry = $wpdb->get_results("SELECT  a.entry_id, a.value as value, c.value as csid, form_id, datestamp from $table_name4 as a 
			    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
			    	LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
			    	where c.value = '$filter_cs' and c.slug = 'mgo_csid' and a.slug like '%mgo_orderid%' $formnya
					ORDER BY a.entry_id 
					DESC $limit");

				$query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
			    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
			    	LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
			    	where c.value = '$filter_cs' and c.slug = 'mgo_csid' and a.slug like '%mgo_orderid%' $formnya");

			}else{

				$rows_entry = $wpdb->get_results("SELECT  a.entry_id, a.value as value, c.value as csid, form_id, datestamp from $table_name4 as a 
			    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
			    	LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
			    	where c.value = '$filter_cs' and c.slug = 'mgo_csid' and a.slug like '%mgo_orderid%' 
			    	and datestamp BETWEEN '$filter_datestart_now2' AND '$filter_dateend_now2' $formnya
					ORDER BY a.entry_id 
					DESC $limit");

				$query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
			    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
			    	LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
			    	where c.value = '$filter_cs' and c.slug = 'mgo_csid' and a.slug like '%mgo_orderid%' 
			    	and datestamp BETWEEN '$filter_datestart_now2' AND '$filter_dateend_now2'
			    	$formnya ");

			}

		}elseif($filter_option=='orderid'){
			if($role=='administrator'){

				$rows_entry = $wpdb->get_results("SELECT * from $table_name4 as a
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					where value = '$filter_orderid' $formnya 
					ORDER BY a.entry_id DESC $limit");


				$query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
			    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
			    	where value = '$filter_orderid' $formnya ");

			}else{

				$rows_entry = $wpdb->get_results("SELECT a.entry_id, a.value as value, c.value as csid, form_id, datestamp  from $table_name4 as a 
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id
					where c.value = '$id_login' and c.slug = 'mgo_csid' and a.slug like '%mgo_orderid%' and a.value='$filter_orderid' $formnya  ORDER BY a.entry_id DESC $limit");

			    $query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
					where c.value = '$id_login' and c.slug = 'mgo_csid' and a.slug like '%mgo_orderid%' and a.value='$filter_orderid' $formnya  ");

			}

		}elseif($filter_option=='product'){
			if($role=='administrator'){

				$rows_entry = $wpdb->get_results("SELECT a.entry_id, d.value as value, form_id, datestamp from $table_name4 as a 
			    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
			    	LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id 
			    	where a.value LIKE '%$filter_product%' and a.slug = 'mgo_nama_produk' and d.slug LIKE '%mgo_orderid%' $formnya ORDER BY a.entry_id DESC $limit");

			    $query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
			    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
			    	LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id 
			    	where a.value LIKE '%$filter_product%' and a.slug = 'mgo_nama_produk' and d.slug LIKE '%mgo_orderid%' $formnya ");

			}else{

				$rows_entry = $wpdb->get_results("SELECT a.entry_id, d.value as value, c.value as csid, form_id, datestamp from $table_name4 as a 
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
					LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id 
					where a.value LIKE '%$filter_product%' 
					and a.slug = 'mgo_nama_produk' and c.value = '$id_login' and c.slug = 'mgo_csid' and d.slug LIKE '%mgo_orderid%' $formnya ORDER BY a.entry_id DESC $limit");

			    $query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
					LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id 
					where a.value LIKE '%$filter_product%' 
					and a.slug = 'mgo_nama_produk' and c.value = '$id_login' and c.slug = 'mgo_csid' and d.slug LIKE '%mgo_orderid%' $formnya ");

			}

		}elseif($filter_option=='coupon'){
			if($role=='administrator'){

			    $rows_entry = $wpdb->get_results("SELECT a.entry_id, d.value as value, c.value as csid, form_id, datestamp from $table_name4 as a 
			    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
			    	LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
			    	LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id 
			    	where a.value LIKE '%$filter_coupon%' 
			    	and a.slug = 'mgo_kupon' 
			    	and c.slug = 'mgo_csid' and d.slug 
			    	LIKE '%mgo_orderid%' $formnya ORDER BY a.entry_id DESC $limit");

			    $query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
			    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
			    	LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
			    	LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id 
			    	where a.value LIKE '%$filter_coupon%' 
			    	and a.slug = 'mgo_kupon' 
			    	and c.slug = 'mgo_csid' 
			    	and d.slug LIKE '%mgo_orderid%' $formnya ");

			}else{

				$rows_entry = $wpdb->get_results("SELECT a.entry_id, d.value as value, c.value as csid, form_id, datestamp from $table_name4 as a 
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
					LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id 
					where a.value LIKE '%$filter_coupon%' 
					and a.slug = 'mgo_kupon' and c.value = '$id_login' and c.slug = 'mgo_csid' and d.slug LIKE '%mgo_orderid%' $formnya ORDER BY a.entry_id DESC $limit");

			    $query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
					LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id 
					where a.value LIKE '%$filter_coupon%' 
					and a.slug = 'mgo_kupon' and c.value = '$id_login' and c.slug = 'mgo_csid' and d.slug LIKE '%mgo_orderid%' $formnya ");

			}

		}elseif($filter_option=='name'){
			if($role=='administrator'){

				$rows_entry = $wpdb->get_results("SELECT a.entry_id, d.value as value, form_id, datestamp from $table_name4 as a 
			    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
			    	LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id 
			    	where a.value LIKE '%$filter_name%' 
			    	and a.slug = 'mgo_nama' 
			    	and d.slug LIKE '%mgo_orderid%' $formnya ORDER BY a.entry_id DESC $limit");

			    $query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
			    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
			    	LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id 
			    	where a.value LIKE '%$filter_name%' 
			    	and a.slug = 'mgo_nama' 
			    	and d.slug LIKE '%mgo_orderid%' $formnya ");

			}else{

				$rows_entry = $wpdb->get_results("SELECT a.entry_id, d.value as value, c.value as csid, form_id, datestamp from $table_name4 as a 
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
					LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id 
					where a.value LIKE '%$filter_name%' 
					and a.slug = 'mgo_nama' and c.value = '$id_login' and c.slug = 'mgo_csid' and d.slug LIKE '%mgo_orderid%' $formnya ORDER BY a.entry_id DESC $limit");

			    $query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
					LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id 
					where a.value LIKE '%$filter_name%' 
					and a.slug = 'mgo_nama' and c.value = '$id_login' and c.slug = 'mgo_csid' and d.slug LIKE '%mgo_orderid%' $formnya ");

			}

		}elseif($filter_option=='date'){

			if($role=='administrator'){

				$rows_entry = $wpdb->get_results("SELECT * from $table_name4 
					LEFT JOIN $table_name5 ON $table_name4.entry_id = $table_name5.id 
					WHERE slug LIKE '%mgo_orderid%' 
					and datestamp BETWEEN '$filter_datestart_now' AND '$filter_dateend_now' $formnya 
					ORDER BY $table_name4.entry_id DESC $limit");

				$query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					where slug LIKE '%mgo_orderid%'
					and datestamp BETWEEN '$filter_datestart_now' AND '$filter_dateend_now' $formnya ");

			}else{
				$rows_entry = $wpdb->get_results("SELECT a.entry_id, a.value as value, c.value as csid, form_id, datestamp from $table_name4 as a 
			    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
			    	LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id
			    	where c.slug = 'mgo_csid' and c.value = '$id_login' and a.slug = 'mgo_orderid' 
			    	and datestamp BETWEEN '$filter_datestart_now' AND '$filter_dateend_now' $formnya
					ORDER BY a.entry_id 
					DESC $limit");

				$query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
			    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
			    	LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
			    	where c.value = '$id_login' and c.slug = 'mgo_csid' and a.slug = 'mgo_orderid' 
			    	and datestamp BETWEEN '$filter_datestart_now' AND '$filter_dateend_now'
			    	$formnya ");

			}

		}elseif($filter_option=='status'){


			if($role=='administrator'){

					if($filter_statusdate=='alldate'){
						$date_range = '';
					}else{
						$date_range = "and datestamp BETWEEN '$filter_datestartstatus' AND '$filter_dateendstatus'";
					}

					if($filter_status<=1){
						$rows_entry = $wpdb->get_results("SELECT  a.entry_id, a.value as value, form_id, datestamp, c.order_id, c.status_id from $table_name4 as a 
					    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id
							LEFT JOIN $table_name6 as c ON a.value = c.order_id 
					    	where a.slug like '%mgo_orderid%'  and c.status_id=$filter_status  and c.status_rts is NULL
					    	$date_range $formnya
							ORDER BY a.entry_id 
							DESC $limit");

						$query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id
							LEFT JOIN $table_name6 as c ON a.value = c.order_id 
					    	where a.slug like '%mgo_orderid%' and c.status_id=$filter_status  and c.status_rts is NULL
					    	$date_range $formnya
							ORDER BY a.entry_id");
					}else{

						$filter_status2 = $filter_status-1;

						$rows_entry = $wpdb->get_results("SELECT  a.entry_id, a.value as value, form_id, datestamp, c.order_id, c.status_id, d.status_id from $table_name4 as a 
					    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id
							LEFT JOIN $table_name6 as c ON a.value = c.order_id 
							LEFT JOIN $table_name6 as d ON a.value = d.order_id 
					    	where a.slug like '%mgo_orderid%' 
					    	and c.status_id=$filter_status2 and c.status_rts is NULL
					    	and d.status_id=$filter_status
					    	$date_range $formnya
							ORDER BY a.entry_id 
							DESC $limit");

						$query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id
							LEFT JOIN $table_name6 as c ON a.value = c.order_id 
							LEFT JOIN $table_name6 as d ON a.value = d.order_id 
					    	where a.slug like '%mgo_orderid%' 
					    	and c.status_id=$filter_status2 and c.status_rts is NULL
					    	and d.status_id=$filter_status
					    	$date_range $formnya
							ORDER BY a.entry_id");
					}


			}else{

					if($filter_statusdate=='alldate'){
						$date_range = '';
					}else{
						$date_range = "and datestamp BETWEEN '$filter_datestartstatus' AND '$filter_dateendstatus'";
					}

					if($filter_status<=1){
						$rows_entry = $wpdb->get_results("SELECT a.entry_id, a.value as value, form_id, datestamp, c.order_id, c.status_id from $table_name4 as a 
					    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id
							LEFT JOIN $table_name6 as c ON a.value = c.order_id 
					    	LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id 
					    	where d.value = '$id_login' and d.slug = 'mgo_csid'
					    	and a.slug like '%mgo_orderid%'  and c.status_id=$filter_status and c.status_rts is NULL
					    	$date_range $formnya
							ORDER BY a.entry_id 
							DESC $limit");

						$query_total = $wpdb->get_var("SELECT  COUNT(*) from $table_name4 as a 
					    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id
							LEFT JOIN $table_name6 as c ON a.value = c.order_id 
					    	LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id 
					    	where d.value = '$id_login' and d.slug = 'mgo_csid'
					    	and a.slug like '%mgo_orderid%' and c.status_id=$filter_status and c.status_rts is NULL
					    	$date_range $formnya
							ORDER BY a.entry_id");
					}else{

						$filter_status2 = $filter_status-1;

						$rows_entry = $wpdb->get_results("SELECT  a.entry_id, a.value as value, form_id, datestamp, c.order_id, c.status_id, d.status_id from $table_name4 as a 
					    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id
							LEFT JOIN $table_name6 as c ON a.value = c.order_id 
							LEFT JOIN $table_name6 as d ON a.value = d.order_id 
					    	LEFT JOIN $table_name4 as e ON a.entry_id = e.entry_id 
					    	where e.value = '$id_login' and e.slug = 'mgo_csid'
					    	and a.slug like '%mgo_orderid%' and c.status_id=$filter_status2 and c.status_rts is NULL
					    	and d.status_id=$filter_status
					    	$date_range $formnya
							ORDER BY a.entry_id 
							DESC $limit");

						$query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id
							LEFT JOIN $table_name6 as c ON a.value = c.order_id 
							LEFT JOIN $table_name6 as d ON a.value = d.order_id 
					    	LEFT JOIN $table_name4 as e ON a.entry_id = e.entry_id 
					    	where e.value = '$id_login' and e.slug = 'mgo_csid'
					    	and a.slug like '%mgo_orderid%' and c.status_id=$filter_status2 and c.status_rts is NULL
					    	and d.status_id=$filter_status
					    	$date_range $formnya
							ORDER BY a.entry_id");
					}

			}
		}

	}

	    // JUMLAH CLOSING RATE (CRT)
		if($query_total==null){
			$query_total = 0;
		}
	    $jumlah_total = $query_total;
	    // $jumlah_closing = $query_closing[0]->closing;

	 //    if($jumlah_total==0){
	 //    	$crt = 0;
	 //    }else{
		//     $crt = ($jumlah_closing/$jumlah_total)*100;
		//     $crt = number_format($crt, 1, '.', '');
		// }
		$crt = 0;
		

    	// ********************************
    	// THE DATA FOR DATATABLES
    	// ********************************
    	echo '
		{
		  "draw": '.$draw.',
		  "recordsTotal": '.$jumlah_total.',
		  "recordsFiltered": '.$jumlah_total.',
		  "closingRatio": '.$crt.',
		  "myList": [';

    	$no = 1+$startlist;
		$len = count($rows_entry)+$startlist;
		
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

            // No Whatsapp
            $get_whatsapp = $wpdb->get_results("SELECT * from $table_name4 where entry_id=$row->entry_id and slug='mgo_wa' ");
            if($get_whatsapp==null){
                $whatsapp_number = '-';
            }else{
                $whatsapp_number = $get_whatsapp[0]->value;
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
                        $nama_user = str_replace("'", "", $get_name[0]->display_name);
		                $cs_name = $nama_user; // nama asli
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


            // PAYMENT METHOD
            $get_payment = $wpdb->get_results("SELECT * from $table_name4 where entry_id=$row->entry_id and slug='mgo_pembayaran' ");
            $payment_value = strtolower($get_payment[0]->value);

            if($get_payment==null){
                $payment_method = '-';
            }else{
                if($payment_value==''){
                    $payment_method = '-';
                }else if(strpos($payment_value, 'cod') !== false){
                    $payment_method = 'COD';
                }else{
                    $payment_method = 'Transfer';
                }
            }

            date_default_timezone_set('GMT');
            //set an date and time to work with
		    $start = $row->datestamp;

		    $mgo_settings = $wpdb->get_results('SELECT data from '.$table_name3.' where type="utc_status" or type="utc_value" or type="utc_status_dataorder" or type="utc_value_dataorder" ORDER BY id ASC');
		    $utc_status = $mgo_settings[0]->data;
		    $utc_value = $mgo_settings[1]->data;
		    $utc_status_dataorder = $mgo_settings[2]->data;
		    $utc_value_dataorder = $mgo_settings[3]->data;

            //display the converted time
            // date_default_timezone_set("Asia/Jakarta");
            // $seven_hour = '+7 hour';
            $time_now = date('Y-m-d H:i:s',strtotime('+7 hour',strtotime($start)));
            

            // $time_now_dataorder = date('Y-m-d H:i:s',strtotime('+7 hour',strtotime($start)));
            $time_now_dataorder = date('Y-m-d H:i:s',strtotime('+7 hour',strtotime($start)));
			if($utc_status_dataorder==1){
				$jam_tambahan = $utc_value_dataorder+7;
				if($jam_tambahan<0){
					$tandabaca = '-';
				}else{
					$tandabaca = '+';
				}
		    	$time_now_dataorder = date('Y-m-d H:i:s',strtotime("$tandabaca$jam_tambahan hour",strtotime($start)));
		    }

            // CUSTOMER SERVICES (EDITOR ROLE)
            
            	// SET DEFAULT ORDER ID
            	$orderidnya = str_replace('"', '', $row->value);
            	$orderidnya1 = str_replace('{', '', $orderidnya);
            	$orderidnya2 = str_replace('}', '', $orderidnya1);

            	// Time Closing
				$time_closing_status = '';

            	// Status
	            $get_status = $wpdb->get_results("SELECT a.*, b.nama_status, b.color  from $table_name6 a LEFT JOIN $table_name7 b ON a.status_id = b.id where order_id='$orderidnya2' and nama_status!='' ORDER BY id DESC LIMIT 1 ");
	            if($get_status==null){
	                $status = '-';
	                $color = '#d0d3dd';
	            }else{
	                if($get_status[0]->nama_status==null){
	                    $status = '-';
	                    $color = '#d0d3dd';
	                }else{
	                    $status = $get_status[0]->nama_status;
	                    $color = $get_status[0]->color;

	                    $get_time_confirmed = $wpdb->get_results("SELECT * from $table_name6 where order_id='$orderidnya2' and status_id='1' ORDER BY id DESC LIMIT 1 ");
	                    if($get_time_confirmed!=null){
	                    	// Time Closing
	                    	$timestamp_confirmed = strtotime($get_time_confirmed[0]->created_at . "-7hours");	
			            	$timestamp_order = strtotime($time_now . "-7hours");
			            	// $timestamp_order = strtotime($time_now);
			            	if($utc_status==1){
						    	$waktunya = $timestamp_confirmed - $timestamp_order + ((60*60)*($utc_value));
						    }else{
						    	$waktunya = $timestamp_confirmed - $timestamp_order;
						    }
							
			            	$time_confirmed = secondsToTime($waktunya);

							$time_closing_status = "<div class='time_followup_status' style='margin-top:0px;padding-top: 8px;padding-bottom: 0;margin-bottom:-5px;color:#36BD47'><span class='dashicons dashicons-clock' style='width:12px;margin-right:4px;font-size: 15px;'></span><span>$time_confirmed</span></div>";

	                    }

	                    
	                }
	            }

	            // Moota
	            $moota = '';
				if($status!=null){
					$check_statusnya = $wpdb->get_results('SELECT * from '.$table_name11.' where orderid="'.$orderidnya2.'" ');
				    if($check_statusnya!=null){
						$moota = "<div class='moota_status'><img src='".plugin_dir_url( __FILE__ )."assets/icons/moota.png' style='width:12px;margin-right:4px;'>by Moota</div>";
					}
				}

	            // Followup
	            $get_followup = $wpdb->get_results("SELECT status_id, created_at from $table_name6 where order_id='$orderidnya2' and status_id=0 ORDER BY status_id ASC LIMIT 1");
	            $get_followup2 = $wpdb->get_results("SELECT status_id from $table_name6 where order_id='$orderidnya2' and status_id=22 ORDER BY status_id ASC LIMIT 1");
	            $get_followup3 = $wpdb->get_results("SELECT status_id from $table_name6 where order_id='$orderidnya2' and status_id=33 ORDER BY status_id ASC LIMIT 1");

	            $followup_1=0;
	            $followup_2=0;
	            $followup_3=0;

                // time if not yet followup
                // date_default_timezone_set('UTC+7');
                $timestamp_now= time();	
            	// $timestamp_order = strtotime($time_now . "-7hours");
            	$timestamp_order = strtotime($time_now . "-7hours");
			    $waktunya = $timestamp_now - $timestamp_order;
            	// $time_followup = secondsToTime($waktunya);
            	if($utc_status==1){
			    	$time_followup = secondsToTime($waktunya + ((60*60)*($utc_value)));
			    }else{
			    	$time_followup = secondsToTime($waktunya);
			    }

	            
	            // time if has followup
	            if(isset($get_followup[0]->status_id)){
	                if($get_followup[0]->status_id==0){
	                    $followup_1 = 1;
	                    // time followup
	                    $timestamp_followup = strtotime($get_followup[0]->created_at . "-7hours");	
		            	$timestamp_order = strtotime($time_now . "-7hours");
						
						if($utc_status==1){
					    	$waktunya = $timestamp_followup - $timestamp_order + ((60*60)*($utc_value));
					    }else{
					    	$waktunya = $timestamp_followup - $timestamp_order;
					    }

		            	$time_followup = secondsToTime($waktunya);
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
	                $time_color = '#AC1C34';
	                $time_title = $time_followup;
	            }else{
	                $wa_info_multiple1='green';
	                $wa_title1 = 'Sudah di Followup';
	                $time_color = '#36BD47';
	                $time_title = $time_followup;
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

	            if($get_followup==null){
	                $wa_info = 'red';
	                $wa_icon = 'wa_red.png';
	                $wa_title = 'Belum di Followup';
	            }else{
	                $wa_info = '';
	                $wa_icon = 'wa.png';
	                $wa_title = 'Sudah di Followup';
	            }

	            // Time Followup
				$time_followup_status = "<div class='time_followup_status' style='margin-top:0px;padding-top: 8px;padding-bottom: 0;margin-bottom:-5px;color:$time_color'><span class='dashicons dashicons-clock' style='width:12px;margin-right:4px;font-size: 15px;padding-top: 1px;'></span><span>$time_title</span></div>";


	            // PHONE
	            $phone = '-';
	            $get_confirm = $wpdb->get_results("SELECT * from $table_name9 where orderid='$row->value' ");
	            if($get_confirm!=null){
                    if($get_confirm[0]->status==1){
                        $confirm = 'Confirmed';
                    }else{
                    	$confirm = $get_confirm[0]->code;
                    	// $confirm = $get_confirm[0]->code."  <span class='dashicons dashicons-edit' style='background: #AD62AA;height:18px;width:18px;border-radius:3px;color:#fff;font-size:13px;padding-top:2px;margin-left:2px;'></span>";
                    }
                    
                    $phone = $get_confirm[0]->phone;
                }else{
                	$confirm = '-';
                }


	            // Get Form Name
	            $query_forms = $wpdb->get_results('SELECT config from '.$table_name.' where type="primary" and form_id="'.$row->form_id.'" ');
				$dataconfignya = json_encode(maybe_unserialize( $query_forms[0]->config ));
			    $datajsonnya = json_decode($dataconfignya);


			    // CEK NAMA YANG SAMA
			    // $orderan_check = $wpdb->get_results('SELECT a.entry_id, a.value, b.datestamp FROM '.$table_name4.' a LEFT JOIN '.$table_name5.' b ON a.entry_id=b.id where a.value = "'.$customer_name.'" and b.datestamp >= DATE_SUB(NOW(), INTERVAL 24 HOUR)');

			    $orderan_check = $wpdb->get_results('SELECT a.entry_id, a.value, b.datestamp FROM '.$table_name4.' a LEFT JOIN '.$table_name5.' b ON a.entry_id=b.id where a.value = "'.$customer_name.'" and b.datestamp >= DATE_SUB(NOW(), INTERVAL 24 HOUR)');

			    $btn_del2 = $no;
			    $jumlah_yang_sama = count($orderan_check);
				if($jumlah_yang_sama>=2){
					$color_name = "style='color:#BA0000;'";

					// Tambahan button delete untuk Lead 1 yang memiliki Lead juga yang sama di form 2
					if (strpos(strtolower($datajsonnya->name), 'lead1') !== false) { // klo localhost
					    $btn_del2 = '<span style='."'margin-left: -3px;'".' data-orderid='."'".''.$orderidnya2.''."'".' data-entryid='."'".''.$row->entry_id.''."'".' class='."'".'dashicons dashicons-trash delete_order'."'".' title='."'".'Delete Order'."'".'></span>';
					}

				}else{
					$color_name = "";
				}

				// TANDAI WARNA HIJAU KLO YANG PESAN <= 30 MENIT
				$new_time_modif = date('Y-m-d H:i:s',strtotime('+7 hour'));
				$time_minus = strtotime($new_time_modif) - (60*30);
				$time_sekarang = strtotime($time_now);
				$hasil_waktu = $time_sekarang-$time_minus;
				if($hasil_waktu>0){
					$color_name = "style='color:#4C9A2A;'";
					// walaupun masuk ke <30 menit, klo dia ada 2 lead tetap harus dibuat merah
					if($jumlah_yang_sama>=2){
						$color_name = "style='color:#BA0000;'";
					}
				}
				// $datenya_oke = date("Y-m-d h:i:s",$strtotime($time_now_dataorder));
				$readtime = new Readtime();
				$a = $readtime->process_eng_data_order($time_now_dataorder);	

				// DATA START HERE
				echo '
				    [
				      "",
				      "<span data-orderid='."'".''.$orderidnya2.''."'".' data-entryid='."'".''.$row->entry_id.''."'".'>'.$btn_del2.'</span>",
				      "<span data-orderid='."'".''.$orderidnya2.''."'".' data-entryid='."'".''.$row->entry_id.''."' ".$color_name.'>'.handling_character($customer_name).'</span>",
				      "'.handling_character($nama_produk).'",
				      "'.handling_character($whatsapp_number).'",
				      "'.$confirm.'",
				      "'.handling_character($datajsonnya->name).'",
				      "'.handling_character($orderidnya2).'",
				      "<span class=td_csname>'.handling_character($cs_name).'</span>",
				      "'.handling_character($kode_kupon).'",
				      "'.handling_character($payment_method).'",';

					// SETTING DELETE BUTTON FOR ADMIN AND CS
					if($role=='administrator'){
						$btn_del = '<button data-orderid='."'".''.$orderidnya2.''."'".' data-entryid='."'".''.$row->entry_id.''."'".' type='."'".'button'."'".' class='."'".'button btn_mgo btn_regular red_color delete_link delete_order'."'".' title='."'".'Delete Order'."'".'>Delete</button>';
					}else{
						if($btn_del_status->data==0){
							$btn_del = '';
						}else{
							$btn_del = '<button data-orderid='."'".''.$orderidnya2.''."'".' data-entryid='."'".''.$row->entry_id.''."'".' type='."'".'button'."'".' class='."'".'button btn_mgo btn_regular red_color delete_link delete_order'."'".' title='."'".'Delete Order'."'".'>Delete</button>';
						}
					}

					

				echo '
				      "'.$totalnya.'",
				      "'.date("F j, Y - ",strtotime($time_now_dataorder)).date("H:i ",strtotime($time_now_dataorder)).'<br><span style='."'".'font-size:11px;'."'".'>'.$a.'<span>",
				      "<span class='."'".'link_on_table btn-detail-order'."'".' data-id='."'".''.$orderidnya2.''."'".' data-formid='."'".''.$row->form_id.''."'".' data-entryid='."'".''.$row->entry_id.''."'".' data-toggle='."'".'modal'."'".' data-target='."'".'#ModalUpdateStatus'."'".'><button type='."'".'button'."'".' class='."'".'button btn_mgo btn_regular btn_detail'."'".' style='."'".'padding: 0 10px 0 5px;font-size:12px;border:none !important;'."'".'><span class='."'".'dashicons dashicons-format-aside'."'".' style='."'".'font-size: 14px;padding-top: 6px;margin-right: 2px;'."'".'></span>Detail</button></span>",
				      "<a data-formid='."'".$row->form_id."'".' href='."'".'javascript:;'."'".' data-no='."'".''.$no.''."'".' id='."'".'wa_'.$orderidnya2.''."'".' data-id='."'".''.$orderidnya2.''."'".' data-entryid='."'".''.$row->entry_id.''."'".' class='."'".'link_on_table btn-send-wa '.$wa_info.''."'".' title='."'".''.$wa_title.''."'".'><span id='."'".'icon_'.$no.''."'".' class='."'".'dashicons dashicons-update spin'."'".' style='."'".'font-size: 21px;margin-top: 0px;width: 21px;display: none;'."'".'></span><img id='."'".'img_'.$no.''."'".' src='."'".''.plugin_dir_url( __FILE__ ).'main/../assets/icons/'.$wa_icon.''."'".' />Send WA</a>'.$time_followup_status.'",
				      "<a data-formid='."'".$row->form_id."'".' href='."'".'javascript:;'."'".' data-no='."'".''.$no.''."'".' id='."'".'wa_'.$orderidnya2.'_1'."'".' data-id='."'".''.$orderidnya2.''."'".' data-entryid='."'".''.$row->entry_id.''."'".' class='."'".'link_on_table btn-send-wa-multiple1 '.$wa_info_multiple1.''."'".' title='."'".''.$wa_title1.''."'".'><span id='."'".'icon_'.$no.'_1'."'".' class='."'".'dashicons dashicons-update spin'."'".' style='."'".'font-size: 21px;margin-top: 0px;width: 21px;margin-right:0;display: none;'."'".'></span><img id='."'".'img_'.$no.'_1'."'".' src='."'".''.plugin_dir_url( __FILE__ ).'main/../assets/icons/wa_24_'.$wa_info_multiple1.'.png?ver='.$plugin_version."'".' style='."'".'width:20px;margin-right:0px; margin-left: 2px;'."'".' />1</a><a data-formid='."'".$row->form_id."'".' href='."'".'javascript:;'."'".' data-no='."'".''.$no.''."'".' id='."'".'wa_'.$orderidnya2.'_2'."'".' data-id='."'".''.$orderidnya2.''."'".' data-entryid='."'".''.$row->entry_id.''."'".' class='."'".'link_on_table btn-send-wa-multiple2 '.$wa_info_multiple2.''."'".' title='."'".''.$wa_title2.''."'".'><span id='."'".'icon_'.$no.'_2'."'".' class='."'".'dashicons dashicons-update spin'."'".' style='."'".'font-size: 21px;margin-top: 0px;width: 21px;margin-right:0;display: none;'."'".'></span><img id='."'".'img_'.$no.'_2'."'".' src='."'".''.plugin_dir_url( __FILE__ ).'main/../assets/icons/wa_24_'.$wa_info_multiple2.'.png?ver='.$plugin_version."'".' style='."'".'width:20px;margin-right:0px; margin-left: 2px;'."'".' />2</a><a data-formid='."'".$row->form_id."'".' href='."'".'javascript:;'."'".' data-no='."'".''.$no.''."'".' id='."'".'wa_'.$orderidnya2.'_3'."'".' data-id='."'".''.$orderidnya2.''."'".' data-entryid='."'".''.$row->entry_id.''."'".' class='."'".'link_on_table btn-send-wa-multiple3 '.$wa_info_multiple3.''."'".' title='."'".''.$wa_title3.''."'".'><span id='."'".'icon_'.$no.'_3'."'".' class='."'".'dashicons dashicons-update spin'."'".' style='."'".'font-size: 21px;margin-top: 0px;width: 21px;margin-right:0;display: none;'."'".'></span><img id='."'".'img_'.$no.'_3'."'".' src='."'".''.plugin_dir_url( __FILE__ ).'main/../assets/icons/wa_24_'.$wa_info_multiple3.'.png?ver='.$plugin_version."'".' style='."'".'width:20px;margin-right:0px; margin-left: 2px;'."'".' />3</a>'.$time_followup_status.'",
				      "<span id='."'".'status_'.$orderidnya2.''."'".' class='."'".'order_status'."'".' style='."'".'text-transform:capitalize;background-color:'.$color.''."'".'>'.$status.'</span>'.$moota.$time_closing_status.'",
				      "<span class='."'".'link_on_table update_status'."'".' data-entryid='."'".''.$row->entry_id.''."'".' data-id='."'".''.$orderidnya2.''."'".' data-toggle='."'".'modal'."'".' data-target='."'".'#ModalUpdateStatus'."'".' data-formid='."'".''.$row->form_id.''."'".'><button type='."'".'button'."'".' class='."'".'button btn_mgo btn_regular btn_detail'."'".' style='."'".'padding: 0 10px 0 5px;border:none !important;'."'".'><span class='."'".'dashicons dashicons-edit'."'".' style='."'".'font-size: 16px;padding-top: 6px;margin-right: 2px;'."'".'></span>Status</button></span> '.$btn_del.'"
				    ]';if($len==$no){echo'';}else{echo',';}
                $no++;

        }
        echo '
					  ]
					}';
    
    wp_die();

} 
add_action( 'wp_ajax_myaction_data_orders', 'myaction_data_orders' );
add_action( 'wp_ajax_nopriv_myaction_data_orders', 'myaction_data_orders' );


function myaction_data_orders_totalclosing() {
	require_once(ROOTDIR . 'main/function/mgo-filter-data-order.php');
    wp_die();
} 
add_action( 'wp_ajax_myaction_data_orders_totalclosing', 'myaction_data_orders_totalclosing' );
add_action( 'wp_ajax_nopriv_myaction_data_orders_totalclosing', 'myaction_data_orders_totalclosing' );


function print_csv()
{
    if ( ! current_user_can( 'manage_options' ) )
        return;

    global $wpdb;
    $table_name = $wpdb->prefix . "cf_form_entry_values";
    $table_name5 = $wpdb->prefix . "cf_form_entries";
    $table_name6 = $wpdb->prefix . "cf_forms";
    $table_name7 = $wpdb->prefix . "mgo_orders";
    $table_name8 = $wpdb->prefix . "mgo_order_statuses";

    $type = $_GET['type'];
    $entryid = $_GET['entryid'];
    $formid = $_GET['formid'];

    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename=Form-'.$formid.'.csv');
    header('Pragma: no-cache');

    if($type=='all'){
    	
    	$query_entryid = $wpdb->get_results("SELECT GROUP_CONCAT(DISTINCT t.entry_id) as entry_id FROM (SELECT entry_id,slug,form_id FROM $table_name as a LEFT JOIN $table_name5 as b ON a.entry_id = b.id  where a.slug LIKE '%mgo_csid%' AND b.form_id = '$formid' GROUP BY entry_id) t");
		$entry_id = $query_entryid[0]->entry_id;
    	$array_entryid = explode(',', $entry_id);

    }else{
    	$array_entryid = explode(',', $entryid);
    }

    foreach ($array_entryid as $entry_id) {
    	
	    $get_formid = $wpdb->get_results('SELECT form_id from '.$table_name5.' where id="'.$entry_id.'" ');
		$form_id = $get_formid[0]->form_id;

		if($form_id!=null){

			$get_urutan_field = $wpdb->get_results('SELECT config from '.$table_name6.' where type="primary" and form_id="'.$form_id.'" ');
			$dataconfig = json_encode(maybe_unserialize( $get_urutan_field[0]->config ));
		    $datajson = json_decode($dataconfig);

		    
		    foreach ($datajson->layout_grid->fields as $key=>$row) {
	        	// $key => field_id, cth: fld_7231522

            	$query = $wpdb->get_results("SELECT * from $table_name where entry_id=$entry_id and field_id='$key' ");

	            if($query!=null){

	            	if($query[0]->slug=='mgo_csid'){
		            	$get_cs = $wpdb->get_results("SELECT * from $table_name where entry_id=$entry_id and slug='mgo_csid' ");
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
			                        $cs_name = '';
			                    }else{
			                        $nama_user = str_replace("'", "", $get_name[0]->display_name);
					                $cs_name = $nama_user; // nama asli
			                        // $cs_name = $get_name[0]->user_login; // username
			                    }
			                } else {
			                    $cs_name = '';
			                }
			            }
		    			echo '"'.$cs_name.'",';
			        }else{
			        	if($query[0]->slug=='mgo_courier'){
							$value = str_replace('"', '', $query[0]->value);
							$value = strtoupper($value);
						}else{
							$value = str_replace('"', '', $query[0]->value);
						}

						if($query[0]->slug=='mgo_orderid'){
						    $get_status = $wpdb->get_results("SELECT b.nama_status from $table_name7 a 
							LEFT JOIN $table_name8 b ON a.status_id = b.id
							where order_id = '$value' ORDER BY a.id DESC LIMIT 1 ");

				            if($get_status==null){
				                $statusnya = "-";
				            }else{
				                if($get_status[0]->nama_status==null){
				                    $statusnya = "-";
				                }else{
				                    $statusnya = $get_status[0]->nama_status;
				                }
				            }
			            	echo '"'.$statusnya.'",';
						}
			        	
		    			echo '"'.$value.'",';
			        }
	            	
	            }else{
	            	
	            	echo '"",';
	            }
	        }


	    }else{
	    	$query = $wpdb->get_results('SELECT * from '.$table_name.' where entry_id="'.$entry_id.'" ORDER BY id ASC');

	    	foreach($query as $row){
	    		$value = str_replace('"', '', $row->value);
	    		echo '"'."$value".'",';
	    	}
	    }

// ARTINYA INI ENTER
    	echo '
';
    }

}
add_action( 'admin_post_print.csv', 'print_csv' );
add_action( 'admin_post_nopriv_print.csv', 'print_csv' );




function myaction_normalize_data_order()
{
	global $wpdb;
    $table_name = $wpdb->prefix . "cf_form_entries";
    $table_name2 = $wpdb->prefix . "cf_form_entry_values";
    $table_name3 = $wpdb->prefix . "mgo_orders";

    $cap = get_user_meta( wp_get_current_user()->ID, $wpdb->get_blog_prefix() . 'capabilities', true );
    $roles = array_keys((array)$cap);
    $role = $roles[0];

    // CUSTOMER SERVICES (EDITOR ROLE)
    if($role!='administrator'){
        echo "You don't have access for this action. Only for Administrator!";
    }else{

		$query = $wpdb->get_results('SELECT * from '.$table_name3.' where form_idnya is NULL ORDER BY id ASC');
        foreach($query as $row){
        	$order_id = $row->order_id;
        	
        	$get_entryid = $wpdb->get_results("SELECT * from $table_name2 where value='$order_id' and slug='mgo_orderid' ");
		    if($get_entryid!=null){
		        $entry_id = $get_entryid[0]->entry_id;

		        $get_formid = $wpdb->get_results("SELECT * from $table_name where id='$entry_id' ");
		        if($get_formid!=null){
		        	$form_id = $get_formid[0]->form_id;

		        	// UPDATE DATA STATUS
		        	$wpdb->update(
			            $table_name3, //table
			            array('form_idnya' => $form_id, 'entry_idnya' => $entry_id), //data
			            array('order_id' => $order_id), //where
			            array('%s'), //data format
			            array('%s') //where format
			        );

			        // echo $form_id.',';

		    	}else{
		    		// UPDATE DATA STATUS
		        	$wpdb->update(
			            $table_name3, //table
			            array('entry_idnya' => $entry_id), //data
			            array('order_id' => $order_id), //where
			            array('%s'), //data format
			            array('%s') //where format
			        );
		    	}
		    	// echo $entry_id.',';
		    }
		    // echo $order_id.',';
        }
        echo '<span class="button" style="margin-top: 0px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">Normalize Data Orders Success.</span>';
    }

	wp_die();

}
add_action( 'wp_ajax_myaction_normalize_data_order', 'myaction_normalize_data_order' );
add_action( 'wp_ajax_nopriv_myaction_normalize_data_order', 'myaction_normalize_data_order' );


function myaction_del_autosave_wa()
{
	global $wpdb;
    $table_name = $wpdb->prefix . "mgo_autosave_wa";

    $data_id = $_POST['datanya'][0];

    $jumlah = sizeof($data_id);

    if($jumlah==0){
    	echo 'Please select the order first.';
    }else{

	    foreach ($data_id as $key => $row) {
	    	$id = $row;
	    	$wpdb->query( $wpdb->prepare( 'DELETE FROM '.$table_name.' WHERE id = %d', $id ) );
	    }

	    echo 'success';

	}
    

	wp_die();

}
add_action( 'wp_ajax_myaction_del_autosave_wa', 'myaction_del_autosave_wa' );
add_action( 'wp_ajax_nopriv_myaction_del_autosave_wa', 'myaction_del_autosave_wa' );


function myaction_del_all_data_orders()
{
	global $wpdb;
    $table_name = $wpdb->prefix . "cf_form_entries";
    $table_name2 = $wpdb->prefix . "cf_form_entry_values";
    $table_name3 = $wpdb->prefix . "mgo_orders";
    $key = $_POST['datanya'][0];

    $cap = get_user_meta( wp_get_current_user()->ID, $wpdb->get_blog_prefix() . 'capabilities', true );
    $roles = array_keys((array)$cap);
    $role = $roles[0];

    // CUSTOMER SERVICES (EDITOR ROLE)
    if($role!='administrator'){
        echo "You don't have access for this action. Only for Administrator!";
    }else{
    	if($key=='delete_all'){

		    $wpdb->query("TRUNCATE TABLE $table_name");
		    $wpdb->query("TRUNCATE TABLE $table_name2");
		    $wpdb->query("TRUNCATE TABLE $table_name3");

		    echo '<span class="button" style="margin-top: 5px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">Delete ALL Data Orders Success.</span>';

		}else{
			echo '<span class="button" style="margin-top: 5px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #D00010;">Failed.</span>';
		}
    }

	wp_die();

}
add_action( 'wp_ajax_myaction_del_all_data_orders', 'myaction_del_all_data_orders' );
add_action( 'wp_ajax_nopriv_myaction_del_all_data_orders', 'myaction_del_all_data_orders' );


function myaction_del_allstatus_data_orders()
{
	global $wpdb;
    $table_name3 = $wpdb->prefix . "mgo_orders";
    $key = $_POST['datanya'][0];

    $cap = get_user_meta( wp_get_current_user()->ID, $wpdb->get_blog_prefix() . 'capabilities', true );
    $roles = array_keys((array)$cap);
    $role = $roles[0];

    // CUSTOMER SERVICES (EDITOR ROLE)
    if($role!='administrator'){
        echo "You don't have access for this action. Only for Administrator!";
    }else{
    	if($key=='delete_all_status'){

		    $wpdb->query("TRUNCATE TABLE $table_name3");

		    echo '<span class="button" style="margin-top: 5px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #2EC26A;">Delete Status ALL Data Orders Success.</span>';

		}else{
			echo '<span class="button" style="margin-top: 5px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: #D00010;">Failed.</span>';
		}
    }

	wp_die();

}
add_action( 'wp_ajax_myaction_del_allstatus_data_orders', 'myaction_del_allstatus_data_orders' );
add_action( 'wp_ajax_nopriv_myaction_del_allstatus_data_orders', 'myaction_del_allstatus_data_orders' );


function myaction_del_all_autosave_wa()
{
	global $wpdb;
    $table_name = $wpdb->prefix . "mgo_autosave_wa";

    $data_id = $_POST['datanya'][0];

    if($data_id=='delete_all'){

	    $wpdb->query("TRUNCATE TABLE $table_name");

	    echo 'success';

	}
    

	wp_die();

}
add_action( 'wp_ajax_myaction_del_all_autosave_wa', 'myaction_del_all_autosave_wa' );
add_action( 'wp_ajax_nopriv_myaction_del_all_autosave_wa', 'myaction_del_all_autosave_wa' );




function myaction_print_label()
{
	global $wpdb;
    $table_name = $wpdb->prefix . "cf_form_entry_values";
    $table_name2 = $wpdb->prefix . "cf_form_entries";
    $table_name3 = $wpdb->prefix . "mgo_settings";
    $table_name4 = $wpdb->prefix . "mgo_calculation";

    $entry_id = $_POST['datanya'][0];
    $jumlah = sizeof($entry_id);

    // cek nama produk setting
    $query_title_settings = $wpdb->get_results('SELECT data from '.$table_name3.' where type="nama_produk_status" or type="nama_produk_other_name" or type="order_id_status" or type="order_id_other_name" ORDER BY id ASC');
    $nama_produk_status = $query_title_settings[0]->data;
    $nama_produk_other_name = $query_title_settings[1]->data;
    $order_id_status = $query_title_settings[2]->data;
    $order_id_other_name = $query_title_settings[3]->data;

    if($nama_produk_status=='1'){
        $nama_produknya = 'Nama Program';
    }elseif($nama_produk_status=='2'){
        $nama_produknya = 'Nama Kegiatan';
    }elseif($nama_produk_status=='3'){
        $nama_produknya = $nama_produk_other_name;
    }else{
        $nama_produknya = 'Nama Produk';
    }

    if($order_id_status=='1'){
        $order_id_set = 'Invoice ID';
    }elseif($order_id_status=='2'){
        $order_id_set = 'Donation ID';
    }elseif($order_id_status=='3'){
        $order_id_set = $order_id_other_name;
    }else{
        $order_id_set = 'Order ID';
    }

    if($jumlah==0){
    	echo 'Please select the order first.';
    }else{

    	$label_pengirim = $wpdb->get_results("SELECT * from $table_name3 where type='label_pengirim' ");

	    foreach ($entry_id as $key => $row) {
	    	$entryid = $row;
	    	$produk = $wpdb->get_results("SELECT * from $table_name where entry_id=$entryid and slug='mgo_nama_produk' ");
	    	$orderid = $wpdb->get_results("SELECT * from $table_name where entry_id=$entryid and slug='mgo_orderid' ");
	    	$nama = $wpdb->get_results("SELECT * from $table_name where entry_id=$entryid and slug='mgo_nama' ");
	    	$wa = $wpdb->get_results("SELECT * from $table_name where entry_id=$entryid and slug='mgo_wa' ");
	    	$alamat = $wpdb->get_results("SELECT * from $table_name where entry_id=$entryid and slug='mgo_alamat' ");
	    	$alamat_lengkap = $wpdb->get_results("SELECT * from $table_name where entry_id=$entryid and slug='mgo_alamat_lengkap' ");
	    	$kecamatan = $wpdb->get_results("SELECT * from $table_name where entry_id=$entryid and slug='mgo_kecamatan' ");
	    	$kab_kota = $wpdb->get_results("SELECT * from $table_name where entry_id=$entryid and slug='mgo_kab_kota' ");
	    	$provinsi = $wpdb->get_results("SELECT * from $table_name where entry_id=$entryid and slug='mgo_provinsi' ");

	    	$ongkir = $wpdb->get_results("SELECT * from $table_name where entry_id=$entryid and slug='mgo_ongkir' ");
	    	$ongkir2 = $wpdb->get_results("SELECT * from $table_name where entry_id=$entryid and slug='mgo_ongkos_kirim' ");
	    	$couriernya = $wpdb->get_results("SELECT * from $table_name where entry_id=$entryid and slug='mgo_courier' ");

	    	$kode_pos = $wpdb->get_results("SELECT * from $table_name where entry_id=$entryid and slug='mgo_kode_pos' ");
	    	
	    	if($couriernya==null){
	    		$couriernya = '';
	    	}else{
	    		$couriernya = $couriernya[0]->value;
	    	}

	    	if($kode_pos==null){
	    		$kode_pos = '';
	    	}else{
	    		$kode_pos = '<br> Kode Pos: '.$kode_pos[0]->value;
	    	}
	    	
	    	$date = $wpdb->get_results("SELECT form_id, datestamp from $table_name2 where id=$entryid ");
	    	if($date!=null){
			    $time_pemesanan = strtotime($date[0]->datestamp);
				$date_pemesanan = strtotime('7 hours', $time_pemesanan);
				$date_real = date('d-m-Y, H:i', $date_pemesanan);

			}else{
				$date_real = '';
			}
			

	    	$enter = '<br>';
	    	if($alamat==null && $alamat_lengkap==null){
	    		$enter = '';
	    	}

	    	if($provinsi[0]->value==null){
	    		$kecamatannya = $kecamatan[0]->value;
	    	}else{
	    		$kecamatannya = $kecamatan[0]->value.', '.$kab_kota[0]->value.', '.$provinsi[0]->value;
	    	}

	    	echo '
		    <div class="row label_pengiriman">
		    	<div class="label_produk" style="padding-left:10px !important;border: 1px solid #222;padding: 10px 20px;width: 100%;border-bottom: 1px dashed #222;border-left: 0;border-right: 0;border-top: 0;font-size: 13px;"><b>'.$nama_produknya.': </b>'.$produk[0]->value.'</div>
			    <div class="column label_orderid"><b>Order ID:</b><br>'.$orderid[0]->value.'<br><br><b>Date Order:</b><br>'.$date_real.'</div>
			    <div class="column label_penerima"><b>Kepada:</b><br><b>'.handling_character($nama[0]->value).'</b><br>'.$alamat[0]->value.$alamat_lengkap[0]->value.$enter.$kecamatannya.$kode_pos.'<br>Phone: '.$wa[0]->value.'</div>
			    <div class="column label_pengirim"><b>Pengirim:</b><br>'.$label_pengirim[0]->data.'</div>
			    <div class="column label_ekspedisi"><b>Ekspedisi:</b><br><b>'.strtoupper($couriernya).'</b><br><span class="detail_ongkir">'.$ongkir[0]->value.$ongkir2[0]->value.'</span></div>
			</div>';
			
	    	$i++;
	    }
	}
    

	wp_die();

}
add_action( 'wp_ajax_myaction_print_label', 'myaction_print_label' );
add_action( 'wp_ajax_nopriv_myaction_print_label', 'myaction_print_label' );


add_action('init', function() {
	if(isset($_GET['mgo_page'])){
	  	if($_GET['mgo_page']=='print_label'){
	  		require_once(ROOTDIR . 'main/mgo-print-label.php');
	  		exit();
	  	}elseif($_GET['mgo_page']=='dashboard'){
	  		echo 'Welcome';
	  		exit();
	  	}else{
	  		echo 'Please back on your WP Admin Dashboard!';
	  		exit();
	  	}
  	}
});


add_action('init', function() {

	global $wpdb;
	date_default_timezone_set("Asia/Jakarta");
	$table_name = $wpdb->prefix . "mgo_settings";
	$table_name2 = $wpdb->prefix . "mgo_lr";
	$table_name3 = $wpdb->prefix . "mgo_lr_log";

	$query 	= $wpdb->get_results('SELECT data from '.$table_name.' where type="l_rotator" ORDER BY id ASC');
	$l_rotator = $query[0]->data;

	$link1 = "{$_SERVER['REQUEST_URI']}";
	$host = explode('/',$link1);

	// var_dump($host);

	// echo $host[1];
	// echo '<br>';
	// echo $host[2];
	// echo '<br>';
	// echo $host[3];
	// echo '<br>';
	// echo '<br>';
	// echo '<br>';
	// echo 'ni dia';

	$web = get_site_url();

	if(isset($host[2])){
	// exit();
		if (strpos($web, 'localhost') !== false) { // klo localhost
		    $code1 = $host[2]; // general code url
		    $code2 = '';
		    if(isset($host[3])){
		    	$code2 = $host[3]; // spesific code url
		    }
		}else{
			$url_new = $host[2];
			$url_paramater = '';
			if (strpos($host[2], '?') !== false){
				$host_url = explode("?", $host[2]);
				$url_new = $host_url[0];
				$url_paramater = '?'.$host_url[1];
			}

			$code1 = $host[1]; // general code url
		    $code2 = $url_new; // spesific code url
		}



		if($code1==$l_rotator){
		// if(isset($_GET["$l_rotator"])){
			$link = $code2;

			$query_lr = $wpdb->get_results('SELECT id, lr_code, lr_link, lr_priority from '.$table_name2.' where lr_code="'.$link.'"'.' ');

			if($query_lr[0]->lr_code!=null){
				// klo kosong : {"":""}
				$lr_link = $query_lr[0]->lr_link;
				$lr_priority = $query_lr[0]->lr_priority;
				$id_lr_link = $query_lr[0]->id;
				$linknya = json_decode($lr_link, true);
				$link_priority = json_decode($lr_priority);
				$datanya = [];

				print_r($link_priority);

				// SET TODAY - 7 HOURS
			    $today_now_start = date("Y-m-d 00:01");
			    $time_start = strtotime($today_now_start);
			    $date_start = strtotime('-7 hours', $time_start);
			    $today_now_start = date("Y-m-d 00:01");
			    $filter_datestart_today = date('Y-m-d H:i', $date_start);

			    // SET TODAY MIDNIGNHT
			    $today_now_end = date("Y-m-d 23:59:59");

	            if(!empty($linknya))
	            {
	            	$total_log = 0;
	                foreach ($linknya as $key => $value ) {
	                    
	                    // tambahin query today check log
	                    $jumlah_log = $wpdb->get_results('SELECT * from '.$table_name3.' where link="'.$value.'" AND created_at BETWEEN "'.$filter_datestart_today.'" AND "'.$today_now_end.'"');
	                    $jumlah_log = count($jumlah_log);
	                    $total_log = $total_log + $jumlah_log;

	                }

	                $total_priority = 0;
	                foreach ($link_priority as $key => $value ) {
	                	$total_priority = $total_priority+$value;
	                }
	                

	                $i = 0;
	                foreach ($linknya as $key => $value ) {
	                    
	                    // tambahin query today check log
	                    $jumlah_log = $wpdb->get_results('SELECT * from '.$table_name3.' where link="'.$value.'" AND created_at BETWEEN "'.$filter_datestart_today.'" AND "'.$today_now_end.'"');
	                    $jumlah_log = count($jumlah_log);
	                    $persen = $jumlah_log/$total_log;
	                    $a = "link_$i";
	                    $persen_priority = $link_priority->$a/$total_priority;

	                    if($jumlah_log!=null){
				    		$datanya[] = array('link' => $value, 'log' => $jumlah_log, 'persen' => $persen, 'priority' => $persen_priority);
				    	}else{
				    		$datanya[] = array('link' => $value, 'log' => 0, 'persen' => 0, 'priority' => $persen_priority);
				    	}

				    	$i++;

	                }

	                foreach ($datanya as $key => $value) {
	                	// echo 'Link: '.$value['link'].'<br>';
	                	// echo 'Log: '.$value['log'].'<br>';
	                	// echo 'Data: '.$value['persen'].'<br>';
	                	// echo 'Priority: '.$value['priority'].'<br><br>';
	                }

	              	aasort($datanya,"log");
					$link_terendah = $datanya[0]['link'];

	                foreach ($datanya as $key => $value) {
	                	if($value['persen']<$value['priority']){
	                		$link_terendah = $value['link'];
	                		break;
	                	}
	                }

			  

					// echo '<br>';
					// print_r(json_encode($datanya));
					// echo '<br>';
					// echo "Total Log:".$total_log;
					// echo '<br>';
					// echo 'ini dia =>'.$link_terendah;
					// echo '<br>';
					// $a = 0;
					
					// print_r($link_priority->$b);


	                // return false;

					

					// GET User Agent
					// $details = json_decode(file_get_contents("http://ip-api.com/json/"));
					// if (array_key_exists('query', $details)) {
					// 	$ip = $details->query;
					// 	$city = $details->city;
					// 	$region = $details->regionName;
					// 	$country = $details->country;
					// 	$isp = $details->isp;
					// }else{
						$ip = '';
						$city = '';
						$region = '';
						$country = '';
						$isp = '';
					// }

					if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
					    $ip = $_SERVER['HTTP_CLIENT_IP'];
					} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
					    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
					} else {
					    $ip = $_SERVER['REMOTE_ADDR'];
					}

					if (strpos($ip, ',') !== false){
						$pieces_ip = explode(",", $ip);
		                $ip = $pieces_ip[0];
					}
					

					// echo $details->query . "<br>"; 
					// echo $details->city . "<br>"; 
					// echo $details->regionName . "<br>";  
					// echo $details->country . "<br>";

					// print_r($datanya);
					// echo '<br>';
					// echo $link_terendah;

					// echo '<br>';
					// echo $_SERVER['REMOTE_ADDR'];
					// echo $_SERVER['HTTP_USER_AGENT'];
					// echo '<Br>';
					// $browser = get_browser(null, true);
					// print_r($browser);

					$user_os        = getOS();
					$user_browser   = getBrowser();

					// exit();

					// insert log
					$wpdb->insert(
						$table_name3, // table
						array('id_lr' => $id_lr_link,
							'link' => $link_terendah,
							'os' => $user_os,
							'browser' => $user_browser,
							'ip' => $ip,
							'city' => $city,
							'region' => $region,
							'country' => $country,
							'isp' => $isp),
						array('%s', '%s')
					);

					// exit();

	            }
			  	$newURL = $link_terendah.$url_paramater;
			  	header("Location: $newURL");
			  	exit();
			}else{
				$newURL = get_site_url();
			  	header("Location: $newURL");
			  	exit();
			}
	  	}
  	}


});

function getOS() { 

    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $os_platform  = "Unknown OS Platform";
    $os_array     = array(
                          '/windows nt 10/i'      =>  'Windows 10',
                          '/windows nt 6.3/i'     =>  'Windows 8.1',
                          '/windows nt 6.2/i'     =>  'Windows 8',
                          '/windows nt 6.1/i'     =>  'Windows 7',
                          '/windows nt 6.0/i'     =>  'Windows Vista',
                          '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                          '/windows nt 5.1/i'     =>  'Windows XP',
                          '/windows xp/i'         =>  'Windows XP',
                          '/windows nt 5.0/i'     =>  'Windows 2000',
                          '/windows me/i'         =>  'Windows ME',
                          '/win98/i'              =>  'Windows 98',
                          '/win95/i'              =>  'Windows 95',
                          '/win16/i'              =>  'Windows 3.11',
                          '/macintosh|mac os x/i' =>  'Mac OS X',
                          '/mac_powerpc/i'        =>  'Mac OS 9',
                          '/linux/i'              =>  'Linux',
                          '/ubuntu/i'             =>  'Ubuntu',
                          '/iphone/i'             =>  'iPhone',
                          '/ipod/i'               =>  'iPod',
                          '/ipad/i'               =>  'iPad',
                          '/android/i'            =>  'Android',
                          '/blackberry/i'         =>  'BlackBerry',
                          '/webos/i'              =>  'Mobile'
                    );

    foreach ($os_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $os_platform = $value;

    return $os_platform;
}

function getBrowser() {

    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $browser        = "Unknown Browser";
    $browser_array = array(
                            '/msie/i'      => 'Internet Explorer',
                            '/firefox/i'   => 'Firefox',
                            '/safari/i'    => 'Safari',
                            '/chrome/i'    => 'Chrome',
                            '/edge/i'      => 'Edge',
                            '/opera/i'     => 'Opera',
                            '/netscape/i'  => 'Netscape',
                            '/maxthon/i'   => 'Maxthon',
                            '/konqueror/i' => 'Konqueror',
                            '/mobile/i'    => 'Handheld Browser'
                     );

    foreach ($browser_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $browser = $value;

    return $browser;
}


// add_action('init', function() {
// 	// if(isset($_GET['page'])){
// 	//   	if($_GET['page']=='gf_edit_forms'){
// 	//   		// require_once(ROOTDIR . 'main/mgo-print-label.php');
// 	//   		echo "<script>
// 	// 	  		theParent = document.getElementById('gf_form_toolbar_links');
// 	// 			theKid = document.createElement('li');
// 	// 			theKid.innerHTML = 'oke';
// 	// 			theParent.appendChild(theKid);
// 	// 			theParent.insertBefore(theKid, theParent.firstChild);
// 	//   		</script>";
// 	//   		// exit();
// 	//   	}
//  //  	}
// });



add_action( 'wp_enqueue_scripts', 'wpse_enqueue_scripts' );
function wpse_enqueue_scripts() {
    // Load everywhere.
    // wp_enqueue_script( 'something-js' );

    // // Only enqueue scripts/styles on static front page.
    // if ( is_front_page() ) {
    //     wp_enqueue_script( 'something-else-js' );
    // }

    // Only enqueue scripts/styles when the full-width.php template is used.
    /*
    if ( is_page_template( 'admin.php' ) ) {
        echo '<script>alert(1);</script>';
    }
    */
}

// page=gf_edit_forms

/*
function magic_order_dashboard() {
	// add_action('init', function() {
		if(isset($_GET['page'])){
		  	if($_GET['page']=='magic_order_dashboard'){
		  		echo '<script>window.location = "http://localhost:8888/mywp/wp-admin/admin.php?mgo_page=dashboard";</script>';
		  		exit();
		  	}
	  	}
	// });
}
*/

/*
add_action('init', function() {
	if (isset($_GET['mgo_moota'])) {
		if ($_GET['mgo_moota']=='push') {
			global $wpdb;
			$table_name = $wpdb->prefix . "cf_form_entry_values";
			$table_name1 = $wpdb->prefix . "cf_form_entries";
			$table_name2 = $wpdb->prefix . "mgo_orders";
			$table_name3 = $wpdb->prefix . "mgo_moota_log";
			$table_name4 = $wpdb->prefix . "mgo_settings";

			$apikey = $_GET['apikey'];
			$query 	= $wpdb->get_results('SELECT data from '.$table_name4.' where type="plugin_status" or type="wanotif_status" or type="wanotif_type" or type="wanotif_apikey" or type="wanotif_url" or type="wanotif_message" or type="wanotif_csrotator" or type="moota_apikey" or type="moota_status" or type="moota_wanotif_message" or type="moota_wanotif_status" ORDER BY id ASC');
			
			$plugin_status = strtoupper($query[0]->data);
			$wanotif_status = $query[1]->data; // 0: off, 1: aktif
			$wanotif_type = $query[2]->data; // 0: single sender, 1: cs rotator sender
			$wanotif_apikey = $query[3]->data;
			$wanotif_url = $query[4]->data;
			$wanotif_message = $query[5]->data;
			$wanotif_csrotator = $query[6]->data;
			$moota_apikey = $query[7]->data;
			$moota_status = $query[8]->data;
			$moota_wanotif_message = $query[9]->data;
			$moota_wanotif_status = $query[10]->data;

			// Check if $apikey matches stored Moota Api Key in mgo_settings
			// $moota_apikey = $wpdb->get_results('SELECT data FROM '.$table_name4.' where data = "'.$apikey.'"');
      		// $moota_status = $wpdb->get_results('SELECT data FROM '.$table_name4.' where type = "moota_status"');

			if ( $plugin_status=='PRO' && $moota_apikey == $apikey && $moota_status == "1" ) {
				$json = file_get_contents('php://input');
				// Convert JSON data into a PHP object
				$predata = json_decode($json);
				$data = json_decode($predata);
				// $data = json_decode($json);
				$datanum = count($data);

				for ($i = 0; $i < $datanum; $i++)
				{
					// Take transfer amount and convert it into String to match database entry
					$amt = 'Rp'.number_format(strval($data[$i]->amount),0,',','.');

					// Query transfer amount into form entry db for order id
					$row = $wpdb->get_results('SELECT * from '.$table_name.' where value="'.$amt.'"');
          			// entry id from Caldera forms
					$entryid = $row[0]->entry_id;
					
					// fetch form entry by $entryid
					$entrydate = $wpdb->get_results('SELECT form_id, datestamp from '.$table_name1.' where id = "'.$entryid.'"');
					$date_ordered = new DateTime (date('Y-m-d', strtotime($entrydate[0]->datestamp)));
					$date_paid = new DateTime (date('Y-m-d'));
					$interval = $date_ordered->diff($date_paid);
					$days_diff = (int)$interval->format('%a');
					$form_id = $entrydate[0]->form_id;
					// var_dump($date_ordered); var_dump($date_paid); var_dump($interval); var_dump($days_diff); die;  

					// if $days_diff > 2, skip this $data[$i], continue to $data[$i++]
					// if ( $days_diff > 2 ) continue;
					if ( $days_diff <= 2 ) {

						$target_orderid = $wpdb->get_results('SELECT entry_id, value from '.$table_name.' where entry_id="'.$entryid.'"'.' AND slug="mgo_orderid"');
						$orderid = $target_orderid[0]->value;
						$get_entry_id = $target_orderid[0]->entry_id;

						$moo_nama = $wpdb->get_results('SELECT value from '.$table_name.' where entry_id="'.$entryid.'"'.' AND slug="mgo_nama"');
						$nama_customer = $moo_nama[0]->value;
						
						$moo_nama_produk = $wpdb->get_results('SELECT value from '.$table_name.' where entry_id="'.$entryid.'"'.' AND slug="mgo_nama_produk"');
						$nama_produk = $moo_nama_produk[0]->value;
						

						if ( $orderid != null && $moota_status == "1" ) {

							$check_order = $wpdb->get_results('SELECT * from '.$table_name2.' where order_id= "'.$orderid.'" and status_id=1');
							$check_log = $wpdb->get_results('SELECT * from '.$table_name3.' where orderid= "'.$orderid.'"');

							if ( empty($check_order) ) {
								// Insert Order_id and status in mgo_orders db
							
								$insert = $wpdb->insert(
						            $table_name2, //table
						            array('order_id' => $orderid, 'status_id' => 1, 'ket_order' => null, 'user_id' => 1, 'entry_idnya' => $entryid, 'form_idnya' => $form_id), //data
						            array('%s', '%s') //data format         
						        );
						       
							}

							if ( empty($check_log) && $moota_status == "1" ) {
								// date by Moota
								$mootadate = $data[$i]->date;
								$repdate = str_replace('/', '-', $mootadate);
								$convertdate = date('Y-m-d', strtotime($repdate));
								// Insert log mgo_moota_log
								$wpdb->insert(
									$table_name3,  // mgo_moota_log table
									array(
											'orderid' => $orderid,
											'id_moota' => $data[$i]->id,
											'desc_moota' => $data[$i]->description,
											'amount_moota' => $data[$i]->amount,
											'bank_moota' => $data[$i]->bank_type,
											'date_moota' => $convertdate ),
									array('%s', '%s')
								);

								// ***************************
								// SEND Message from WANOTIF
								// ***************************

								if($moota_wanotif_status==1){

									if (strpos($moota_wanotif_message, '[mgo_nama]') !== false || strpos($moota_wanotif_message, '[mgo_orderid]') !== false || strpos($moota_wanotif_message, '[mgo_nama_produk]') !== false) {
										$set_nama = str_replace('[mgo_nama]', $nama_customer, $moota_wanotif_message);
										$set_orderid = str_replace('[mgo_orderid]', $orderid, $set_nama);
										$set_produk = str_replace('[mgo_nama_produk]', $nama_produk, $set_orderid);
										$moota_wanotif_message = $set_produk;
									}

									if($wanotif_status==1){

										// GET USER PHONE NUMBER / WA
										$query_phone_user = $wpdb->get_results('SELECT value from '.$table_name.' where entry_id="'.$get_entry_id.'"'.' AND slug="mgo_wa"');
										$phone = $query_phone_user[0]->value;
										
										// CHECK SINGLE SENDER OR CS ROTATOR SENDER, wanotif_type 0: single sender, 1: cs rotator sender
										if($wanotif_type==0){

											// SET PHONE
											if($phone!=''){
												$phone = hp($phone);
												$url = $wanotif_url.'/send';

												$spintax = new Spintax();
												$moota_wanotif_message = $spintax->process($moota_wanotif_message);

												$curl = curl_init();
												curl_setopt($curl, CURLOPT_URL, $url);
												curl_setopt($curl, CURLOPT_HEADER, 0);
												curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
												curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
												curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
												curl_setopt($curl, CURLOPT_TIMEOUT,30);
												curl_setopt($curl, CURLOPT_POST, 1);
												curl_setopt($curl, CURLOPT_POSTFIELDS, array(
												    'Apikey'    => $wanotif_apikey,
												    'Phone'     => $phone,
												    'Message'   => $moota_wanotif_message,
												));
												$response = curl_exec($curl);
												curl_close($curl); 
											}

										}else{ // YANG KIRIM SI CS ROTATOR
											
											// GET USER PHONE NUMBER / WA
											$query_csid = $wpdb->get_results('SELECT value from '.$table_name.' where entry_id="'.$entryid.'"'.' AND slug="mgo_csid"');
											$csid = $query_csid[0]->value;

											if($csid!=''){

												$apikey_nya = '';
												$fields = json_decode($wanotif_csrotator, true);
												if(!empty($fields)){
													foreach ($fields as $key => $value ) {
														if($key==$csid){
															$apikey_nya = $value;
														}
													}

													$wanotif_apikey = $apikey_nya;

											    	// SET PHONE
													if($phone!=''){
														$phone = hp($phone);
														$url = $wanotif_url.'/send';

														$spintax = new Spintax();
														$moota_wanotif_message = $spintax->process($moota_wanotif_message);

														$curl = curl_init();
														curl_setopt($curl, CURLOPT_URL, $url);
														curl_setopt($curl, CURLOPT_HEADER, 0);
														curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
														curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
														curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
														curl_setopt($curl, CURLOPT_TIMEOUT,30);
														curl_setopt($curl, CURLOPT_POST, 1);
														curl_setopt($curl, CURLOPT_POSTFIELDS, array(
														    'Apikey'    => $wanotif_apikey,
														    'Phone'     => $phone,
														    'Message'   => $moota_wanotif_message,
														));
														$response = curl_exec($curl);
														curl_close($curl); 
													}
												}

										    	
											}
										}
										
									} 

								} // end wanotif


							}

						}
					}

				}
				
				$reply = array('message' => $data);
				$reply = array('message' => $data, 'message2' => $query, 'message3' => $plugin_status.'-'.$check.'-'.$moota_status);
				http_response_code(200);
				echo json_encode($reply);
			}

			exit();
		}
	}

});
*/


add_action('init', function() {
	if (isset($_GET['mgo_moota'])) {
		if ($_GET['mgo_moota']=='push') {
			global $wpdb;
			$table_name = $wpdb->prefix . "cf_form_entry_values";
			$table_name1 = $wpdb->prefix . "cf_form_entries";
			$table_name2 = $wpdb->prefix . "mgo_orders";
			$table_name3 = $wpdb->prefix . "mgo_moota_log";
			$table_name4 = $wpdb->prefix . "mgo_settings";

			// $apikey = $_GET['apikey'];
			
			$query 	= $wpdb->get_results('SELECT data from '.$table_name4.' where type="plugin_status" or type="wanotif_status" or type="wanotif_type" or type="wanotif_apikey" or type="wanotif_url" or type="wanotif_message" or type="wanotif_csrotator" or type="moota_apikey" or type="moota_status" or type="moota_wanotif_message" or type="moota_wanotif_status" ORDER BY id ASC');
			
			$plugin_status = strtoupper($query[0]->data);
			$wanotif_status = $query[1]->data; // 0: off, 1: aktif
			$wanotif_type = $query[2]->data; // 0: single sender, 1: cs rotator sender
			$wanotif_apikey = $query[3]->data;
			$wanotif_url = $query[4]->data;
			$wanotif_message = $query[5]->data;
			$wanotif_csrotator = $query[6]->data;
			$moota_apikey = $query[7]->data;
			$moota_status = $query[8]->data;
			$moota_wanotif_message = $query[9]->data;
			$moota_wanotif_status = $query[10]->data;

			// Check if $apikey matches stored Moota Api Key in mgo_settings
			if ( $plugin_status=='PRO' && $moota_status == "1" ) {
				
				/*
				$json = file_get_contents('php://input');
				// Convert JSON data into a PHP object
				$predata = json_decode($json);
				$data = json_decode($predata);
				// $data = json_decode($json);
				$datanum = count($data);
				*/
				
				$data=json_decode(file_get_contents('php://input'),1);
				// $data = json_decode($data);
				$data=json_decode($data,true);
				
				$datanum = count($data);
				
				// print_r($data);
				
				$a = $datanum;
				$b = '';
				if($datanum >= 1){
				
// 				$jsonnya = json_encode( $data, true );
				
				$c = 0;
				foreach ($data as $key => $value) {
					
					$c++;
					$amount = $value['amount'];
					
						$b .= $amount.'/';
						

				// for ($i = 0; $i < $datanum; $i++)
				// {
					// Take transfer amount and convert it into String to match database entry
					$amt = 'Rp'.number_format(strval($amount),0,',','.');

					// Query transfer amount into form entry db for order id
					$row = $wpdb->get_results('SELECT * from '.$table_name.' where value="'.$amt.'"');
          			// entry id from Caldera forms
					$entryid = $row[0]->entry_id;
					
					// fetch form entry by $entryid
					$entrydate = $wpdb->get_results('SELECT form_id, datestamp from '.$table_name1.' where id = "'.$entryid.'"');
					$date_ordered = new DateTime (date('Y-m-d', strtotime($entrydate[0]->datestamp)));
					$date_paid = new DateTime (date('Y-m-d'));
					$interval = $date_ordered->diff($date_paid);
					$days_diff = (int)$interval->format('%a');
					$form_id = $entrydate[0]->form_id;
					// var_dump($date_ordered); var_dump($date_paid); var_dump($interval); var_dump($days_diff); die;  

					// if $days_diff > 2, skip this $data[$i], continue to $data[$i++]
					// if ( $days_diff > 2 ) continue;
					if ( $days_diff <= 2 ) {

						$target_orderid = $wpdb->get_results('SELECT entry_id, value from '.$table_name.' where entry_id="'.$entryid.'"'.' AND slug="mgo_orderid"');
						$orderid = $target_orderid[0]->value;
						$get_entry_id = $target_orderid[0]->entry_id;

						$moo_nama = $wpdb->get_results('SELECT value from '.$table_name.' where entry_id="'.$entryid.'"'.' AND slug="mgo_nama"');
						$nama_customer = $moo_nama[0]->value;
						
						$moo_nama_produk = $wpdb->get_results('SELECT value from '.$table_name.' where entry_id="'.$entryid.'"'.' AND slug="mgo_nama_produk"');
						$nama_produk = $moo_nama_produk[0]->value;

						$mgo_total = $wpdb->get_results('SELECT value from '.$table_name.' where entry_id="'.$entryid.'"'.' AND slug="mgo_total"');
						$mgo_total = $mgo_total[0]->value;
						

						if ( $orderid != null && $moota_status == "1" ) {

							$check_order = $wpdb->get_results('SELECT * from '.$table_name2.' where order_id= "'.$orderid.'" and status_id=1');
							$check_log = $wpdb->get_results('SELECT * from '.$table_name3.' where orderid= "'.$orderid.'"');

							if ( empty($check_order) ) {
								// Insert Order_id and status in mgo_orders db
							
								$insert = $wpdb->insert(
						            $table_name2, //table
						            array('order_id' => $orderid, 'status_id' => 1, 'ket_order' => null, 'user_id' => 1, 'entry_idnya' => $entryid, 'form_idnya' => $form_id), //data
						            array('%s', '%s') //data format         
						        );
						       
							}
							
							
							if ( empty($check_log) && $moota_status == "1" ) {
								// date by Moota
								$mootadate = $value['date'];
								$repdate = str_replace('/', '-', $mootadate);
								$convertdate = date('Y-m-d', strtotime($repdate));
								// Insert log mgo_moota_log
								$wpdb->insert(
									$table_name3,  // mgo_moota_log table
									array(
											'orderid' => $orderid,
											'id_moota' => $value['mutation_id'],
											'desc_moota' => $value['description'],
											'amount_moota' => $value['amount'],
											'bank_moota' => $value['bank_type'],
											'date_moota' => $convertdate ),
									array('%s', '%s')
								);

								// ***************************
								// SEND Message from WANOTIF
								// ***************************

								if($moota_wanotif_status==1){

									if (strpos($moota_wanotif_message, '[mgo_nama]') !== false || strpos($moota_wanotif_message, '[mgo_orderid]') !== false || strpos($moota_wanotif_message, '[mgo_nama_produk]') !== false) {
										$set_nama = str_replace('[mgo_nama]', $nama_customer, $moota_wanotif_message);
										$set_orderid = str_replace('[mgo_orderid]', $orderid, $set_nama);
										$set_produk = str_replace('[mgo_nama_produk]', $nama_produk, $set_orderid);
										$set_total = str_replace('[mgo_total]', $mgo_total, $set_produk);
										$moota_wanotif_message = $set_total;
									}

									if($wanotif_status==1){

										// GET USER PHONE NUMBER / WA
										$query_phone_user = $wpdb->get_results('SELECT value from '.$table_name.' where entry_id="'.$get_entry_id.'"'.' AND slug="mgo_wa"');
										$phone = $query_phone_user[0]->value;
										
										// CHECK SINGLE SENDER OR CS ROTATOR SENDER, wanotif_type 0: single sender, 1: cs rotator sender
										if($wanotif_type==0){

											// SET PHONE
											if($phone!=''){
												$phone = hp($phone);
												$url = $wanotif_url.'/send';

												$spintax = new Spintax();
												$moota_wanotif_message = $spintax->process($moota_wanotif_message);

												$curl = curl_init();
												curl_setopt($curl, CURLOPT_URL, $url);
												curl_setopt($curl, CURLOPT_HEADER, 0);
												curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
												curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
												curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
												curl_setopt($curl, CURLOPT_TIMEOUT,30);
												curl_setopt($curl, CURLOPT_POST, 1);
												curl_setopt($curl, CURLOPT_POSTFIELDS, array(
												    'Apikey'    => $wanotif_apikey,
												    'Phone'     => $phone,
												    'Message'   => $moota_wanotif_message,
												));
												$response = curl_exec($curl);
												curl_close($curl); 
											}

										}else{ // YANG KIRIM SI CS ROTATOR
											
											// GET USER PHONE NUMBER / WA
											$query_csid = $wpdb->get_results('SELECT value from '.$table_name.' where entry_id="'.$entryid.'"'.' AND slug="mgo_csid"');
											$csid = $query_csid[0]->value;

											if($csid!=''){

												$apikey_nya = '';
												$fields = json_decode($wanotif_csrotator, true);
												if(!empty($fields)){
													foreach ($fields as $key => $value ) {
														if($key==$csid){
															$apikey_nya = $value;
														}
													}

													$wanotif_apikey = $apikey_nya;

											    	// SET PHONE
													if($phone!=''){
														$phone = hp($phone);
														$url = $wanotif_url.'/send';

														$spintax = new Spintax();
														$moota_wanotif_message = $spintax->process($moota_wanotif_message);

														$curl = curl_init();
														curl_setopt($curl, CURLOPT_URL, $url);
														curl_setopt($curl, CURLOPT_HEADER, 0);
														curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
														curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
														curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
														curl_setopt($curl, CURLOPT_TIMEOUT,30);
														curl_setopt($curl, CURLOPT_POST, 1);
														curl_setopt($curl, CURLOPT_POSTFIELDS, array(
														    'Apikey'    => $wanotif_apikey,
														    'Phone'     => $phone,
														    'Message'   => $moota_wanotif_message,
														));
														$response = curl_exec($curl);
														curl_close($curl); 
													}
												}

										    	
											}
										}
										
									} 

								} // end wanotif


							}
							

						}
					}

				} // end foreach
			} // end if datanum
				
				$reply = array('jumlah' => $a, 'nominal' => $b, 'count' => $c, 'message' => $data );
				// $reply = array('message' => $data, 'message2' => $query, 'message3' => $plugin_status.'-'.$check.'-'.$moota_status);
				http_response_code(200);
				echo json_encode($reply);
			}

			exit();
		}
	}

});




function GenerateID($length) {
	if($length>9){
		$keys = array_merge(range(0,9));
		if($length==14){$length = 4;}if($length==15){$length = 5;}if($length==16){$length = 6;}
		$key = "";
	    for($i=0; $i < $length; $i++) {
	        $key .= $keys[mt_rand(0, count($keys) - 1)];
	    }
	    return $key;
	}else{
		$keys = array_merge(range(0,9), range('A', 'Z'));
		$key = "";
	    for($i=0; $i < $length; $i++) {
	        $key .= $keys[mt_rand(0, count($keys) - 1)];
	    }
	    return $key;
	}
    
}


/*

// PRE SUBMISSION to Changing ORDER ID on G-Form
add_action( 'gform_pre_submission', 'pre_submission_handler' );
function pre_submission_handler( $form ) {
	$randomid = GenerateID(3);
	foreach ($form['fields'] as $field_key => $field) {
		$id = $form['fields'][$field_key]['id'];
		$class = $form['fields'][$field_key]['cssClass'];

		if($class=='mgo_orderid'){
			$_POST["input_$id"] = 'MR-'.$randomid;
		}
	}
    
}


// ACCESS ENTRY
add_action( 'gform_after_submission', 'access_entry_via_field', 10, 2 );
function access_entry_via_field( $entry, $form ) {

	global $wpdb;
	$table_name = $wpdb->prefix . 'mgo_gf_entry_values';

	$mgo_orderid = '';
	$mgo_wa = '';
	$mgo_nama = '';
	$mgo_total = 0;
	

	// foreach ($form['fields'] as $field_key => $field) {
	// 	$id = $form['fields'][$field_key]['id'];
	// 	$class = $form['fields'][$field_key]['cssClass'];

		// if($class=='mgo_orderid'){
		// 	echo 'ORDERID dengan ID: '.$id.'<br>';
		// }

		// if($class=='mgo_wa'){
		// 	echo 'WA dengan ID: '.$id.' | ';
		// 	$wa = 0;
		// 	foreach ( $form['fields'] as $field ) {
		// 		$value = rgar( $entry, (string) $field->id );
		// 		if($id==$field->id){
		// 			echo 'Berhasil WA nya => '.$value.'<br>';
		// 			$wa = $value;
		// 		}
		// 	}
		// 	if($wa!=0){
		// 		// METHOD POST
		// 		// Pastikan phone menggunakan kode negara 62 di depannya
		// 		$apikey = 'qgOAOwXtCSr5S6fj50sVdGHmpyVCJZlY';
		// 		$phone = hp($wa);
		// 		$message = 'Alhamdulillah...';
		// 		$url = 'https://api.wanotif.id/v1/send';

		// 		$curl = curl_init();
		// 		curl_setopt($curl, CURLOPT_URL, $url);
		// 		curl_setopt($curl, CURLOPT_HEADER, 0);
		// 		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		// 		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
		// 		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		// 		curl_setopt($curl, CURLOPT_TIMEOUT,30);
		// 		curl_setopt($curl, CURLOPT_POST, 1);
		// 		curl_setopt($curl, CURLOPT_POSTFIELDS, array(
		// 		    'Apikey'    => $apikey,
		// 		    'Phone'     => $phone,
		// 		    'Message'   => $message,
		// 		));
		// 		$response = curl_exec($curl);
		// 		curl_close($curl); 
		// 	}
		// }

	// }

	// print_r($form['fields']);

	// echo '<br><Br>';
    foreach ( $form['fields'] as $field_key => $field ) {

    	
    	// echo '<Br><br>';

        $inputs = $field->get_entry_inputs();
        $custom_class = $form['fields'][$field_key]['cssClass'];
        $form_id = $form['fields'][$field_key]['formId'];
        $label = $form['fields'][$field_key]['label'];
        $admin_label = $form['fields'][$field_key]['adminLabel'];
        $entry_id = $entry['id'];

        

        if ( is_array( $inputs ) ) {
            foreach ( $inputs as $input ) {
                $value = rgar( $entry, (string) $input['id'] );
                // do something with the value
                echo '1=>'.$value.'<br>';
            }
        } else {

            $value = rgar( $entry, (string) $field->id );
            // do something with the value

            if($custom_class==null){
            	$custom_class = $label;
            }
            
            // THE DATA
            //echo 'form_id:'.$form_id.' entry_id:'.$entry_id.' field_id:'.$field->id.' class:'.$custom_class.' value:'.$value.'<br>';
            // INSERT DATA
            
            $wpdb->insert( 
				$table_name, 
				array(
					'gf_form_id' => $form_id,
					'gf_entry_id' => $entry_id,
					'gf_field_id' => $field->id,
					'gf_custom_class' => $custom_class,
					'gf_label' => $label,
					'gf_admin_label' => $admin_label,
					'gf_value' => $value
				) 
			);
			

            if($custom_class=='mgo_orderid'){
				$mgo_orderid = $value;
			}
			if($custom_class=='mgo_wa'){
				$mgo_wa = $value;
			}
			if($custom_class=='mgo_nama'){
				$mgo_nama = $value;
			}
			
			if($custom_class=='mgo_total'){
				$mgo_total = $value;
			}

        }

    }



    if($mgo_wa!=''){

        	// echo 'Ridwan';
		
			// METHOD POST
			// Pastikan phone menggunakan kode negara 62 di depannya

			$apikey 	= 'DzqpbersluN9bf01CQnUs3SqnpwZWwhEE';
			$phone 		= hp($mgo_wa);
			$message 	= 'Terimakasih kakak *'.$mgo_nama.'*, telah memesan produk kami, pesanan kakak dengan Order ID *'.$mgo_orderid.'* telah masuk database kami.

Pesanan kakak akan segera kami proses setelah anda mengirimkan Total Pesanan kakak sebesar *'.$mgo_total.'* ke rekening dibawah ini:
No Rek Mandiri *388.1290.00.167 a.n Ridwan*

Terimakasih 😊🙏';

			$url 		= 'https://api.wanotif.id/v1/send';

			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_HEADER, 0);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($curl, CURLOPT_TIMEOUT,30);
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, array(
			    'Apikey'    => $apikey,
			    'Phone'     => $phone,
			    'Message'   => $message,
			));
			$response = curl_exec($curl);
			curl_close($curl); 
		
		}	

}

*/



/*
function plugin_update() {
    global $wpdb, $plugin_version;
    $table_name = $wpdb->prefix . 'mgo_settings';

	// 'check_time',
	// 'utc_status', // date data order
	// 'utc_value', // date data order
	// 'utc_status_dataorder',
	// 'utc_value_dataorder',
	// 'followup_button_status',
	// 'qris_qrcode',
	// 'page_protector',
	// 'mgo_footer',

    $query 	 = $wpdb->get_results('SELECT data from '.$table_name.' where type="check_time" ORDER BY id ASC');
	if(empty($query[0]->data)){
    }else{
    	plugin_mgo_updates();
    }

    // if ( get_site_option( 'plugin_version' ) != $plugin_version )
    //     plugin_updates();

}
add_action( 'plugins_loaded', 'plugin_update' );


function plugin_mgo_updates() {
    global $wpdb, $plugin_version;

    $mgoUpdate = get_option( 'external_updates-magic-order' );
    $newVersion = $mgoUpdate->checkedVersion;
    $oldVersion = $mgoUpdate->update->version;

    if ( !(version_compare( $oldVersion, $newVersion ) < 0) ) {
        return FALSE;
    }

    $table_name = $wpdb->prefix . 'mgo_settings';

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
	);

	foreach ($data_array as $key => $value) {
		// cek apakah di table ada sesuai "type" ?
		$query = $wpdb->get_results('SELECT data from '.$table_name.' where type="'.$value.'"');
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
			}else {
				$isi = '';
			}

		    $wpdb->insert($table_name,array('type' => $value,'data' => $isi));
		    
		}
    }

}

*/

class Spintax {
    public function process($text)
    {
        return preg_replace_callback(
            '/\{(((?>[^\{\}]+)|(?R))*)\}/x',
            array($this, 'replace'),
            $text
        );
    }

    public function replace($text)
    {
        $text = $this->process($text[1]);
        $parts = explode('|', $text);
        return $parts[array_rand($parts)];
    }
}


function mgo_global_vars() {

	global $wpdb;
	global $mgovars;
	$table_name = $wpdb->prefix . 'mgo_settings';

	$query 	 = $wpdb->get_results('SELECT data from '.$table_name.' where type="apikey" or type="apikey_status" or type="plugin_status" or type="expired" ORDER BY id ASC');
	$apikey = $query[0]->data;
	$apikey_status = $query[1]->data;
	$plugin_status = strtoupper($query[2]->data);
	$date_expired = $query[3]->data;

	if($date_expired==null || $date_expired==''){
		$date_expired = 0;
	}
	$now 	 = strtotime(date("Y-m-d h:i:s"));
	$time 	 = $date_expired-$now;

	if($time<=0){
		$plugin = 'not_allowed';
	}else{
		$plugin = 'allowed';
	}

	// $expired = $GLOBALS['mgovars']['expired'];

	if($plugin_status=='FREEMIUM'){
        $plugin_license_info = '<div class="sub-title-info"><span>This feature is only for <span style="color:#9040AF;font-weight:bold;">Premium</span> License!</span></div>
                ';
    }elseif($plugin_status=='STARTER'){
    	$plugin_license_info = '<div class="sub-title-info"><span>This feature is only for <span style="color:#9040AF;font-weight:bold;">Basic</span> and <span style="color:#9040AF;font-weight:bold;">PRO</span> License!</span></div>
                ';
    }else{
    	$plugin_license_info = '<div class="sub-title-info"><span>This feature is only for <span style="color:#9040AF;font-weight:bold;">PRO</span> License!</span></div>
                ';
    }
	
	$mgovars = array(
		'expired'  => $plugin,
		'date_expired'  => $date_expired,
		'plugin_name'  => 'MAGIC ORDER',
		'plugin_version'  => '3.1.0.10',
		'plugin_license' => $plugin_status,
		'plugin_license_info' => $plugin_license_info,
		'apikey' => $apikey,
		'apikey_status' => $apikey_status,
	);

}
add_action( 'parse_query', 'mgo_global_vars' );


require 'assets/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'http://member.magicorder.id/public/files/downloads/magic-order/details.json',
	__FILE__, //Full path to the main plugin file or functions.php.
	'magic-order'
);


//menu items
add_action('admin_menu','magic_order_modifymenu');
function magic_order_modifymenu() {

	mgo_global_vars();
    $expired = $GLOBALS['mgovars']['expired'];
    $date_expired = $GLOBALS['mgovars']['date_expired'];
    $plugin_name = $GLOBALS['mgovars']['plugin_name'];
    $plugin_version = $GLOBALS['mgovars']['plugin_version'];
    $plugin_license = $GLOBALS['mgovars']['plugin_license'];
    $apikey = $GLOBALS['mgovars']['apikey'];
    $apikey_status = $GLOBALS['mgovars']['apikey_status'];
	
	//this is the main item for the menu
	add_menu_page('Magic Order', //page title
	'Magic Order', //menu title
	'manage_options', //capabilities
	'magic_order_data', //menu slug
	'magic_order_data', //function
	WP_PLUGIN_URL.'/magic-order/assets/icons/magic-order-30.ico',
    '56'
	);

	
	//this submenu is HIDDEN
	add_submenu_page('magic_order_data', //parent slug
	'Data Orders', //page title
	'Data Orders', //menu title
	'manage_options', //capability
	'magic_order_data', //menu slug
	'magic_order_data'); //function


	//this submenu is HIDDEN
	add_submenu_page('magic_order_data', //parent slug
	'Autosave WA', //page title
	'Autosave WA', //menu title
	'manage_options', //capability
	'magic_order_autosave_wa', //menu slug
	'magic_order_autosave_wa'); //function
	
	//this submenu is HIDDEN
	add_submenu_page('magic_order_data', //parent slug
	'Forms', //page title
	'Forms', //menu title
	'manage_options', //capability
	'magic_order_form', //menu slug
	'magic_order_form'); //function
	

	//this submenu is HIDDEN
	add_submenu_page('magic_order_data', //parent slug
	'Coupons', //page title
	'Coupons', //menu title
	'manage_options', //capability
	'magic_order_coupon', //menu slug
	'magic_order_coupon'); //function

	add_submenu_page('magic_order_data', //parent slug
		'Link Rotator', //page title
		'Link Rotator', //menu title
		'manage_options', //capability
		'magic_order_lr', //menu slug
		'magic_order_lr'); //function
	

	//this submenu is HIDDEN
	if($plugin_license=='PRO'){
	}
	
	
	//this submenu is HIDDEN
	add_submenu_page('magic_order_data', //parent slug
	'Hide AddToCart', //page title
	'Hide AddToCart', //menu title
	'manage_options', //capability
	'magic_order_hide_atc', //menu slug
	'magic_order_hide_atc'); //function
	
	/*
	//this submenu is HIDDEN
	add_submenu_page('magic_order_form', //parent slug
	'Chat Button', //page title
	'Chat Button', //menu title
	'manage_options', //capability
	'magic_order_chatbutton', //menu slug
	'magic_order_chatbutton'); //function
	*/

	//this is a submenu
	add_submenu_page('magic_order_data', //parent slug
	'API Settings', //page title
	'API Settings', //menu title
	'manage_options', //capability
	'magic_order_api', //menu slug
	'magic_order_api'); //function


	//this submenu is HIDDEN
	add_submenu_page(null, //parent slug
	'Update', //page title
	'Update', //menu title
	'manage_options', //capability
	'magic_order_update', //menu slug
	'magic_order_update'); //function

	//this submenu is HIDDEN
	add_submenu_page(null, //parent slug
	'Update CS', //page title
	'Update CS', //menu title
	'manage_options', //capability
	'magic_order_update_cs', //menu slug
	'magic_order_update_cs'); //function

	//this submenu is HIDDEN
	add_submenu_page(null, //parent slug
	'Update CS', //page title
	'Update CS', //menu title
	'manage_options', //capability
	'magic_order_update_followup', //menu slug
	'magic_order_update_followup'); //function

	//this submenu is HIDDEN
	add_submenu_page(null, //parent slug
	'Statistic CS', //page title
	'Statistic CS', //menu title
	'manage_options', //capability
	'magic_order_statistic', //menu slug
	'magic_order_statistic'); //function

	//this submenu is HIDDEN
	add_submenu_page(null, //parent slug
	'General Settings', //page title
	'General Settings', //menu title
	'manage_options', //capability
	'magic_order_general', //menu slug
	'magic_order_general'); //function

	//this submenu is HIDDEN
	add_submenu_page(null, //parent slug
	'Order Settings', //page title
	'Order Settings', //menu title
	'manage_options', //capability
	'magic_order_data_settings', //menu slug
	'magic_order_data_settings'); //function


	//this submenu is HIDDEN
	add_submenu_page(null, //parent slug
	'Whatsapp Reset', //page title
	'Whatsapp Reset', //menu title
	'manage_options', //capability
	'magic_order_data_wareset', //menu slug
	'magic_order_data_wareset'); //function

	//this submenu is HIDDEN
	add_submenu_page(null, //parent slug
	'Whatsapp Reset', //page title
	'Whatsapp Reset', //menu title
	'manage_options', //capability
	'magic_order_data_wareset_custom', //menu slug
	'magic_order_data_wareset_custom'); //function


	//this submenu is HIDDEN
	add_submenu_page(null, //parent slug
	'Whatsapp Reset', //page title
	'Whatsapp Reset', //menu title
	'manage_options', //capability
	'magic_order_autosave_wa_reset', //menu slug
	'magic_order_autosave_wa_reset'); //function


	//this submenu is HIDDEN
	add_submenu_page(null, //parent slug
	'Autosave WA Settings', //page title
	'Autosave WA Settings', //menu title
	'manage_options', //capability
	'magic_order_autosave_wa_settings', //menu slug
	'magic_order_autosave_wa_settings'); //function

	remove_submenu_page('magic_order_form','magic_order_form');

}

define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'main/mgo-form.php');
require_once(ROOTDIR . 'main/mgo-api.php');
require_once(ROOTDIR . 'main/mgo-update.php');
require_once(ROOTDIR . 'main/mgo-general.php');
require_once(ROOTDIR . 'main/mgo-order2.php');
require_once(ROOTDIR . 'main/mgo-dashboard.php');
require_once(ROOTDIR . 'main/mgo-lr.php');
// require_once(ROOTDIR . 'main/mgo-lr2.php');
require_once(ROOTDIR . 'main/mgo-order-settings.php');
require_once(ROOTDIR . 'main/mgo-order-wareset.php');
require_once(ROOTDIR . 'main/mgo-order-wareset-custom.php');
require_once(ROOTDIR . 'main/mgo-order-wareset-autosave.php');
require_once(ROOTDIR . 'main/mgo-coupon.php');
require_once(ROOTDIR . 'main/mgo-update-cs.php');
require_once(ROOTDIR . 'main/mgo-statistic.php');
require_once(ROOTDIR . 'main/mgo-atc.php');
require_once(ROOTDIR . 'main/mgo-autosave-wa.php');
require_once(ROOTDIR . 'main/mgo-autosave-wa-settings.php');
require_once(ROOTDIR . 'main/mgo-form-followup.php');
require_once(ROOTDIR . 'main/function/mgo-some-function.php');