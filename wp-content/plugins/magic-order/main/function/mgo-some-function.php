<?php


function mgo_send_sms( $form, $referrer, $process_id, $entryid ){

	global $wpdb;
	global $mgovars;
	$table_name = $wpdb->prefix . "cf_form_entry_values";
    $table_name2 = $wpdb->prefix . "mgo_settings";
    $table_name3 = $wpdb->prefix . "mgo_orders";
    $table_name4 = $wpdb->prefix . "mgo_calculation";
    $table_name5 = $wpdb->prefix . "cf_form_entries";
    $table_name6 = $wpdb->prefix . "cf_forms";
    $table_name7 = $wpdb->prefix . "mgo_order_log";

    // FORM Input
	$entry_id = $entryid;
	$form_id = $form['ID'];

	// FORM Setting
	$sms_status_form = 0;
    $default_message_status = 0;
    $custom_message = '';
    $wanotif_status_form = 0;
    $wanotif_default_message_status = 0;
    $wanotif_custom_message = '';
    $wanotif_cod_message = '';
    $wanotif_forward = '';

    $tg_status = 0;
	$tg_message_status = 0;
	$tg_custom_message = '';
	$tg_owner_status = 0;
	$tg_csrotator_status = 0;
	$tg_custom_status = 0;
	$tg_custom_channel = '';

	$query_form = $wpdb->get_results('SELECT * from '.$table_name4.' where id_form="'.$form_id.'" ');
    if($query_form!=null){
    	$sms_status_form = $query_form[0]->sms_status;
    	$default_message_status = $query_form[0]->default_message_status;
    	$custom_message = $query_form[0]->custom_message;
    	$wanotif_status_form = $query_form[0]->wanotif_status_form;
    	$wanotif_default_message_status = $query_form[0]->wanotif_default_message_status;
    	$wanotif_custom_message = $query_form[0]->wanotif_custom_message;
    	$wanotif_cod_message = $query_form[0]->wanotif_cod_message;
    	$wanotif_forward = $query_form[0]->wanotif_forward;

    	$tg_status = $query_form[0]->tg_status;
    	$tg_message_status = $query_form[0]->tg_message_status;
    	$tg_custom_message = $query_form[0]->tg_custom_message;
    	$tg_owner_status = $query_form[0]->tg_owner_status;
    	$tg_csrotator_status = $query_form[0]->tg_csrotator_status;
    	$tg_custom_status = $query_form[0]->tg_custom_status;
    	$tg_custom_channel = $query_form[0]->tg_custom_channel;
    }

	// GET GENERAL SETTINGS
	$query = $wpdb->get_results('SELECT data from '.$table_name2.' where 
		type="orderid_text" or type="orderid_max" or type="sms_status" or type="sms_userkey" or type="sms_passkey" or type="sms_apiurl" or type="sms_text" or type="wanotif_status" or type="wanotif_type" or type="wanotif_apikey" or type="wanotif_url" or type="wanotif_message" or type="wanotif_csrotator" or type="l_rotator" or type="telegram_status" or type="telegram_apikey_bot" or type="telegram_id_bot" or type="telegram_username_bot" or type="telegram_message" or type="telegram_single_channel" or type="telegram_csrotator_channel" or type="nama_produk_status" or type="nama_produk_other_name" or type="order_id_status" or type="order_id_other_name" ORDER BY id ASC');
	$orderid_text = $query[0]->data;
	$orderid_max = $query[1]->data;
	$sms_status = $query[2]->data;
	$sms_userkey = $query[3]->data;
	$sms_passkey = $query[4]->data;
	$sms_apiurl = $query[5]->data;
	$sms_text = $query[6]->data;
	$wanotif_status = $query[7]->data; // 0: off, 1: aktif
	$wanotif_type = $query[8]->data; // 0: single sender, 1: cs rotator sender
	$wanotif_apikey = $query[9]->data;
	$wanotif_url = $query[10]->data;
	$wanotif_message = $query[11]->data;
	$wanotif_csrotator = $query[12]->data;
	$l_rotator = $query[13]->data;

	$telegram_status = $query[14]->data;
	$telegram_apikey_bot = $query[15]->data;
	$telegram_id_bot = $query[16]->data;
	$telegram_username_bot = $query[17]->data;
	$telegram_message = $query[18]->data;
	$telegram_single_channel = $query[19]->data;
	$telegram_csrotator_channel = $query[20]->data;

	$nama_produk_status = $query[21]->data;
    $nama_produk_other_name = $query[22]->data;
	$order_id_status = $query[23]->data;
    $order_id_other_name = $query[24]->data;


	// cek nama produk setting
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


	// ***********************************
	// GET THE DATA
	// ***********************************

	// Set NEW ORDER ID
    $randomid = GenerateID($orderid_max);
	$fix_mgo_orderid = $orderid_text.$randomid;

	$field_id_followup1 = '';
	$field_id_followup2 = '';
	$field_id_followup3 = '';
	$field_id_csid = '';
	$field_id_csmail = '';
	$field_id_nama = '';

	// GET DATA WITH FOREACH
	$data = array();
    foreach( $form[ 'fields' ] as $field_id => $field){
        
        // SET ORDER ID WHEN NULL
        if ($field['slug']=='mgo_orderid') {
        	$value_orderid = Caldera_Forms::get_field_data( $field_id, $form, $entry_id );
        	if($value_orderid==''){
        		$value = $fix_mgo_orderid;
			    Caldera_Forms::set_field_data( $field_id, $value, $form, $entry_id );
        	}
		}

        if ($field['slug']=='followup1') {
        	$field_id_followup1 = $field_id;
		}
        if ($field['slug']=='followup2') {
        	$field_id_followup2 = $field_id;
		}
        if ($field['slug']=='followup3') {
        	$field_id_followup3 = $field_id;
		}
        if ($field['slug']=='mgo_csid') {
        	$field_id_csid = $field_id;
		}
        if ($field['slug']=='mgo_csmail') {
        	$field_id_csmail = $field_id;
		}
        if ($field['slug']=='mgo_nama') {
        	$field_id_nama = $field_id;
		}

		$data[ $field['slug'] ] = Caldera_Forms::get_field_data( $field_id, $form );
        $data[ $field_id ] = Caldera_Forms::get_field_data( $field_id, $form );
        $data[ 'slug_'.$field_id ] = $field['slug'];

		
    }

    // ********************************************
    // SET DETAIL ORDER FROM CONTENT FOREACH
    // ********************************************
    $content = '';
    foreach( $form['layout_grid']['fields'] as $field_id => $field){
    	$f = $field_id; // field id dari urutan field di form

    	foreach( $form[ 'fields' ] as $field_id => $field){

			if($f==$field_id){
				$isi = Caldera_Forms::get_field_data( $field_id, $form, $entry_id );
				$slug = $field['slug'];

				// function for checkbox
				$x = '';
				if (strpos($isi, '{"opt') !== false) {
					$no = 1;
					$len = count($isi);
					foreach($isi as $key => $value){
						
						if($len==$no){
							$x .= $value.'';
						}else{
							$x .= $value.', '; // add comma
						}

                    	$no++;

					}
					$isi = $x;
				}

		    	if($isi!='click'){
		    		$pieces = explode("_", $slug);
		      		$mgo = $pieces[0];

		      		if($mgo=='mgo'){ // if($mgo=='mgo' && $isi!=''){
	      				if($slug!='mgo_pembayaran'){
	      					if($pieces[1]!='cswa'){
			      				if($pieces[1]!='csid'){
			      					if($pieces[1]!='csmail'){
			      						if($pieces[1]!='mgo_anonim'){
				      						if($pieces[1]!='orderid2'){
				      							if($isi!=''){

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
								      				if (strpos($slug, '.opt') !== false) { // checkbox value > check
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
										      					$judulnya1 = str_replace('mgo_rp_','',$slug);
										      					$judulnya2 = str_replace('mgo_','',$judulnya1);
										      					$judulnya3 = str_replace('_',' ',$judulnya2);
										      					$judulnya = ucwords($judulnya3);

										      				}else{
										      					
										    					$judulnya1 = str_replace('mgo_','',$slug);
										      					$judulnya2 = str_replace('_',' ',$judulnya1);
										      					$judulnya = ucwords($judulnya2);

									      					}
									      				}
									      				if (strpos($judulnya, '.opt') !== false) {
															$slugnya = explode(".opt", $judulnya);
															$judulnya = $slugnya[0];
														}
														if($slug=='mgo_courier'){
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

															$content .= $judulnya.' : *'.rtrim($isi).'* 
';
														}
								    					
							    					} // end of opt
							    				}
							    			}
							    		}
							    	}
							    }
							}
						}

		    		} // end of mgo
		    		
		    	} // END IF isi

			}


		}
    	
    }

    // set Detail Order
    $detail_order = $content;

//     $detail_order = $content.'
// => '. json_encode($form['layout_grid']['fields']);
	
	
	// $a = json_encode($form['ID']);
	// $detail_order = $a;


    // Get The data from foreach
	$pembayaran = '';
	if (!empty($data['mgo_pembayaran'])) {
	     $pembayaran = $data['mgo_pembayaran'];
	}
	$item_total = '';
	if (!empty($data['mgo_item_total'])) {
	     $item_total = $data['mgo_item_total'];
	}
	$namanya = '';
	if (!empty($data['mgo_nama'])) {
	     $namanya = $data['mgo_nama'];
	}
	$orderid = '';
	if (!empty($data['mgo_orderid'])) {
	     $orderid = $data['mgo_orderid'];
	}

	$totalharga = '';
	if (!empty($data['mgo_total'])) {
	     $totalharga = $data['mgo_total'];
	}
	$phone = '';
	if (!empty($data['mgo_wa'])) {
	     $phone = $data['mgo_wa'];
	}
	$produk = '';
	if (!empty($data['mgo_nama_produk'])) {
	     $produk = $data['mgo_nama_produk'];
	}
	$csid = '';
	if (!empty($data['mgo_csid'])) {
	     $csid = $data['mgo_csid'];
	}
	$csmail = '';
	if (!empty($data['mgo_csmail'])) {
	     $csmail = $data['mgo_csmail'];
	}
	$phone_cs = '';
	if($csid!=''){
		$phone_cs = hp(get_the_author_meta('description',$csid));
	}
	$jumlah_barang = '';
	if (!empty($data['mgo_jumlah_barang'])) {
	     $jumlah_barang = $data['mgo_jumlah_barang'];
	}
	$dpnya = '';
	if (!empty($data['mgo_dp'])) {
	     $dpnya = $data['mgo_dp'];
	}
	$sisanya = '';
	if (!empty($data['mgo_sisa'])) {
	     $sisanya = $data['mgo_sisa'];
	}


	// FOLLOWUP1
	$link_followup1 = '';
	if (!empty($data['followup1'])) {
	     $link_followup1 = $data['followup1'];
	}
    // SET FOLLOWUP1 WHEN NULL
	if($data['followup1']=='1' || $data['followup1']==''){
		if($field_id_followup1!=''){
			$value = get_site_url().'?followup1='.$orderid.'&entryid=byemail';
		    Caldera_Forms::set_field_data( $field_id_followup1, $value, $form, $entry_id );
		    $link_followup1 = $value;
		}
	}	

	// FOLLOWUP2
	$link_followup2 = '';
	if (!empty($data['followup2'])) {
	     $link_followup2 = $data['followup2'];
	}
	// SET FOLLOWUP2 WHEN NULL
	if($data['followup2']=='2' || $data['followup2']==''){
		if($field_id_followup2!=''){
			$value = get_site_url().'?followup2='.$orderid.'&entryid=byemail';
		    Caldera_Forms::set_field_data( $field_id_followup2, $value, $form, $entry_id );
		    $link_followup2 = $value;
		}
	}

	// FOLLOWUP3
	$link_followup3 = '';
	if (!empty($data['followup3'])) {
	     $link_followup3 = $data['followup3'];
	}
	// SET FOLLOWUP3 WHEN NULL
	if($data['followup3']=='3' || $data['followup3']==''){
		if($field_id_followup3!=''){
			$value = get_site_url().'?followup3='.$orderid.'&entryid=byemail';
		    Caldera_Forms::set_field_data( $field_id_followup3, $value, $form, $entry_id );
		    $link_followup3 = $value;
		}
	}


    // CS NAME
	$cs_name = 'null';
    if (is_numeric($csid)){
        $args2 = array( 'blog_id' => 0, 'search' => $csid, 'search_columns' => array( 'ID' ) );
		$get_name = get_users( $args2 );

        if($get_name!=null){
            $nama_user = str_replace("'", "", $get_name[0]->display_name);
            $cs_name = $nama_user; // nama asli
        }
    }


	$ref1 = '';
	if (!empty($data['ref1'])) {
	     $ref1 = $data['ref1'];
	}
	$ref2 = '';
	if (!empty($data['ref2'])) {
	     $ref2 = $data['ref2'];
	}
	$ref3 = '';
	if (!empty($data['ref3'])) {
	     $ref3 = $data['ref3'];
	}
	$ref4 = '';
	if (!empty($data['ref4'])) {
	     $ref4 = $data['ref4'];
	}
	$ref5 = '';
	if (!empty($data['ref5'])) {
	     $ref5 = $data['ref5'];
	}
	$ongkos_kirimnya = '';
	if (!empty($data['mgo_ongkos_kirim'])) {
	     $ongkos_kirimnya = $data['mgo_ongkos_kirim'];
	}
	$biaya_codnya = '';
	if (!empty($data['mgo_biaya_cod'])) {
	     $biaya_codnya = $data['mgo_biaya_cod'];
	}
	date_default_timezone_set('UTC+7');
	$date_caldera = date('l, jS \of F Y - H:i:s');


	// ***************************************************
	// ORDER LOG
	// ***************************************************
	/*
	if($l_rotator!=''){
		if($l_rotator!='abc' && $orderid!=''){
			// GET User Agent
			$details = json_decode(file_get_contents("http://ip-api.com/json/"));
			if (array_key_exists('query', $details)) {
				$ip = $details->query;
				$city = $details->city;
				$region = $details->regionName;
				$country = $details->country;
				$isp = $details->isp;
			}else{
				$ip = '';
				$city = '';
				$region = '';
				$country = '';
				$isp = '';
			}

			$user_os        = getOS();
			$user_browser   = getBrowser();

			// insert order log
			$wpdb->insert(
				$table_name7, // table
				array('id_form' => $form_id,
					'id_entry' => $entryid,
					'id_order' => $orderid,
					'os' => $user_os,
					'browser' => $user_browser,
					'ip' => $ip,
					'city' => $city,
					'region' => $region,
					'country' => $country,
					'isp' => $isp),
				array('%s', '%s')
			);
		}
	}
	*/


	//**********************************
	// SET CS ROTATOR - BALANCER
	//**********************************

	
	// Today Order
    $id_cs_form = $wpdb->get_results('SELECT id_cs,rotator_status,cs_bobot from '.$table_name4.' where id_form="'.$form_id.'"');

    // SET TODAY - 7 HOURS
    $today_now_start = date("Y-m-d 00:01");
    $time_start = strtotime($today_now_start);
    $date_start = strtotime('-7 hours', $time_start);
    $today_now_start = date("Y-m-d 00:01");
    $filter_datestart_today = date('Y-m-d H:i', $date_start);

    // SET TODAY MIDNIGNHT
    $today_now_end = date("Y-m-d 23:59:59");
    
    if ($id_cs_form==null) {
    }else{
    	if($id_cs_form[0]->id_cs!=''){
		    $rotator_status = $id_cs_form[0]->rotator_status;
	    	$cs_bobot = $id_cs_form[0]->cs_bobot;
	    	$fields = json_decode($cs_bobot, true);
	    	$id_cs_form = explode(",", $id_cs_form[0]->id_cs);

		    $datanya = [];
		    $datanya_fix = [];
		    $total_order = 0;
		    if($rotator_status=='0'){ // By Today Orders

		    	if($cs_bobot==''){
		    		foreach($id_cs_form as $key => $value){
				    	$id_csnya = $wpdb->get_results('
				    	SELECT value as id_cs,count(value) as jumlah_order FROM '.$table_name.' a 
				    	LEFT JOIN '.$table_name5.' b ON a.entry_id=b.id
				    	where slug="mgo_csid"
				    	AND form_id="'.$form_id.'"
				    	AND value="'.$value.'"
				    	AND datestamp BETWEEN "'.$filter_datestart_today.'" AND "'.$today_now_end.'"
				    	GROUP BY value ORDER BY jumlah_order ASC ');

				    	if($id_csnya!=null){
				    		$datanya[] = array('id_cs' => $value, 'order' => $id_csnya[0]->jumlah_order);
				    	}else{
				    		$datanya[] = array('id_cs' => $value, 'order' => 0);
				    	}
				    }

				    aasort($datanya,"order");
					$id_cs_order_terendah = $datanya[0]['id_cs'];

		    	}else{

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

		    	
				$args2 = array( 'blog_id' => 0, 'search' => $id_cs_order_terendah, 'search_columns' => array( 'ID' ) );
			    $get_name = get_users( $args2 );

			    if($get_name==null){
			        $cs_mail = '-';
			    }else{
			        $cs_mail = $get_name[0]->user_email;
			    }

			    // GLOBAL VAR
				$csmailnya = $cs_mail;
				$csid_update = $id_cs_order_terendah;

				// SET NEW CS ID
				Caldera_Forms::set_field_data( $field_id_csid, $csid_update, $form, $entry_id );

				// SET NEW CS MAIL
			    Caldera_Forms::set_field_data( $field_id_csmail, $csmailnya, $form, $entry_id );

			    // SET NAME CS
			    $args2 = array( 'blog_id' => 0, 'search' => $csid_update, 'search_columns' => array( 'ID' ) );
				$get_name = get_users( $args2 );
		        if($get_name!=null){
		            $nama_user = str_replace("'", "", $get_name[0]->display_name);
	                $cs_name = $nama_user; // nama asli
		        }	


		    }



		}
		
	}
	
	

	// **********************
	// SET THE SAME CS ID where NAME IS same on order before
	// **********************
	
	$orderan_check = $wpdb->get_results('SELECT a.entry_id, a.value, b.datestamp FROM '.$table_name.' a LEFT JOIN '.$table_name5.' b ON a.entry_id=b.id where a.value = "'.$namanya.'" and b.datestamp >= DATE_SUB(NOW(), INTERVAL 24 HOUR)');

	$jumlah_yang_sama = count($orderan_check);
	if($jumlah_yang_sama>=1){

		$get_csidnya = $wpdb->get_results('SELECT value from '.$table_name.' where entry_id="'.$orderan_check[0]->entry_id.'" and slug="mgo_csid"');
		if($get_csidnya!=null){

			$chek_cs_is_availlable_on_rotator = false;

			$id_cs_form = $wpdb->get_results('SELECT id_cs,rotator_status from '.$table_name4.' where id_form="'.$form_id.'"');

			if ($id_cs_form==null) {
		    }else{
		    	if($id_cs_form[0]->id_cs!=''){
			    	$rotator_status = $id_cs_form[0]->rotator_status;
			    	$id_cs_form = explode(",", $id_cs_form[0]->id_cs);

				    if (in_array($get_csidnya[0]->value, $id_cs_form)) {
						$chek_cs_is_availlable_on_rotator = true;
					}
				}
			}

			if($chek_cs_is_availlable_on_rotator==true){
				$value_csidnya = $get_csidnya[0]->value;
				Caldera_Forms::set_field_data( $field_id_csid, $value_csidnya, $form, $entry_id );
				// set cs id
			    $csid = $value_csidnya;
			    $csid_update = $value_csidnya;

			    // GET EMAIL CS ID
			    $args2 = array( 'blog_id' => 0, 'search' => $csid, 'search_columns' => array( 'ID' ) );
			    $get_name = get_users( $args2 );
			    if($get_name==null){
			        $cs_mail = '-';
			    }else{
			        $cs_mail = $get_name[0]->user_email;
			        $nama_user = str_replace("'", "", $get_name[0]->display_name);
	                $cs_name = $nama_user; // nama asli
			    }
			    
			    // set cs mail
			    $csmail = $cs_mail;
			    Caldera_Forms::set_field_data( $field_id_csmail, $csmail, $form, $entry_id );
			}
			

		}
	}
	

	// ***************************************************
	// SEND SMS
	// ***************************************************

	// Klo 1 Pakai Custom Message yang ada di FORM
	if($default_message_status==1){
		$sms_text = $custom_message;
	}

	// SETUP TEXT
	if (strpos($sms_text, '[mgo_orderid]') !== false || strpos($sms_text, '[mgo_csid]') !== false || strpos($sms_text, '[mgo_nama]') !== false || strpos($sms_text, '[mgo_total]') !== false || strpos($sms_text, '[mgo_wa]') !== false || strpos($sms_text, '[mgo_nama_produk]') !== false || strpos($sms_text, '[mgo_pembayaran]') !== false || strpos($sms_text, '[mgo_item_total]') !== false || strpos($sms_text, '[mgo_ongkos_kirim]') !== false || strpos($sms_text, '[mgo_biaya_cod]') !== false) {
		$set_csname = str_replace('[mgo_csid]', $cs_name, $sms_text);
		$set_csmail = str_replace('[mgo_csmail]', $csmail, $set_csname);
		$set_orderid = str_replace('[mgo_orderid]', $orderid, $set_csmail);
		$set_nama = str_replace('[mgo_nama]', $namanya, $set_orderid);
		$set_produk = str_replace('[mgo_nama_produk]', $produk, $set_nama);
		$set_total = str_replace('[mgo_total]', $totalharga, $set_produk);
		$set_dpnya = str_replace('[mgo_dp]', $dpnya, $set_total);
		$set_sisanya = str_replace('[mgo_sisa]', $sisanya, $set_dpnya);
		$set_phone = str_replace('[mgo_wa]', $phone, $set_sisanya);
		$set_pembayaran = str_replace('[mgo_pembayaran]', $pembayaran, $set_phone);
		$set_item_total = str_replace('[mgo_item_total]', $item_total, $set_pembayaran);
		$set_followup1 = str_replace('[followup1]', $link_followup1, $set_item_total);
		$set_followup2 = str_replace('[followup2]', $link_followup2, $set_followup1);
		$set_followup3 = str_replace('[followup3]', $link_followup3, $set_followup2);
		$set_phone_cs = str_replace('[mgo_cswa]', $phone_cs, $set_followup3);
		$set_jumlah_barang = str_replace('[mgo_jumlah_barang]', $jumlah_barang, $set_phone_cs);
		$set_ongkos_kirim = str_replace('[mgo_ongkos_kirim]', $ongkos_kirimnya, $set_jumlah_barang);
		$set_biaya_cod = str_replace('[mgo_biaya_cod]', $biaya_codnya, $set_ongkos_kirim);
		$set_ref1 = str_replace('[ref1]', $ref1, $set_biaya_cod);
		$set_ref2 = str_replace('[ref2]', $ref2, $set_ref1);
		$set_ref3 = str_replace('[ref3]', $ref3, $set_ref2);
		$set_ref4 = str_replace('[ref4]', $ref4, $set_ref3);
		$set_ref5 = str_replace('[ref5]', $ref5, $set_ref4);
		$datenya_cal = str_replace('[date]', $date_caldera, $set_ref5);
		$set_space = str_replace(' ', '%20', $datenya_cal);
		$textnya = set_whatsapp_format($set_space);
	}else{
		$set_space = str_replace(' ', '%20', $sms_text);
		$textnya = set_whatsapp_format($set_space);
	}

	$textnya_for_reguler = strip_tags($textnya);
	$textnya_for_twoway = str_replace('%20', ' ', $textnya_for_reguler);

	// cek settingan API SMS AKTIF GAK
    if($sms_status==1){

    	// cek juga settingan API SMS ke isi semua dan settingan di FORM activated atau 1
    	if($sms_userkey!='' && $sms_userkey!='' && $sms_userkey!='' && $sms_status_form==1){

			// SEND SMS
			if($sms_apiurl=='http://reguler.sms-notifikasi.com/apps/smsapi.php' || $sms_apiurl=='http://masking.sms-notifikasi.com/apps/smsapi.php' || $sms_apiurl=='https://reguler.zenziva.net/apps/smsapi.php' || $sms_apiurl=='https://alpha.zenziva.net/apps/smsapi.php'){

				$spintax = new Spintax();
				$textnya_for_reguler = $spintax->process($textnya_for_reguler);

			    $url = $sms_apiurl.'?userkey='.$sms_userkey.'&passkey='.$sms_passkey.'&nohp='.$phone.'&pesan='.$textnya_for_reguler;

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

				$spintax = new Spintax();
				$textnya_for_twoway = $spintax->process($textnya_for_twoway);

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
				    'pesan' => $textnya_for_twoway
				));
				$results = json_decode(curl_exec($curlHandle), true);
				curl_close($curlHandle);						                                
			}

		}

	}


	//*******************************************
	// SEND WANOTIF
	//*******************************************

	// CEK SETTINGAN GENERAL WANOTIF AKTIF ATAU GAK
	if($wanotif_status==1){
		
		// CEK SETTINGAN FORM WANOTIF AKTIF ATAU GAK
		if($wanotif_status_form==1){

			// 0: default message, 1: custom message
	    	if($wanotif_default_message_status==0){
	    		$message = $wanotif_message;
	    	}else{
	    		if(strpos(strtolower($pembayaran), 'cod') !== false){
	    			if($wanotif_cod_message!=''){
	                    $message = $wanotif_cod_message;
	    			}else{
	                    $message = $wanotif_custom_message;
	    			}
                }else{
                    $message = $wanotif_custom_message;
                }
	    	}

	    	// CEK [mgo_no_bold]
		    $nobold = 0;
		    $detail_order_update = $detail_order;
		    if (strpos($message, '[mgo_no_bold]') !== false){
		    	$detail_order_update = str_replace('*', '', $detail_order_update);
		    }

	    	// UPDATE MESSAGE
	    	$set_csname = str_replace('[mgo_csid]', $cs_name, $message);
	    	$set_csmail = str_replace('[mgo_csmail]', $csmail, $set_csname);
	    	$set_orderid = str_replace('[mgo_orderid]', $orderid, $set_csmail);
			$set_nama = str_replace('[mgo_nama]', $namanya, $set_orderid);
			$set_produk = str_replace('[mgo_nama_produk]', $produk, $set_nama);
			$set_total = str_replace('[mgo_total]', $totalharga, $set_produk);
			$set_dpnya = str_replace('[mgo_dp]', $dpnya, $set_total);
			$set_sisanya = str_replace('[mgo_sisa]', $sisanya, $set_dpnya);
			$set_phone = str_replace('[mgo_wa]', $phone, $set_sisanya);
			$set_pembayaran = str_replace('[mgo_pembayaran]', $pembayaran, $set_phone);
			$set_item_total = str_replace('[mgo_item_total]', $item_total, $set_pembayaran);
			$set_followup1 = str_replace('[followup1]', $link_followup1, $set_item_total);
			$set_followup2 = str_replace('[followup2]', $link_followup2, $set_followup1);
			$set_followup3 = str_replace('[followup3]', $link_followup3, $set_followup2);
			$set_phone_cs = str_replace('[mgo_cswa]', $phone_cs, $set_followup3);
			$set_jumlah_barang = str_replace('[mgo_jumlah_barang]', $jumlah_barang, $set_phone_cs);
			$set_nobold = str_replace('[mgo_no_bold]', '', $set_jumlah_barang);
			$set_detail_order = str_replace('[mgo_detail_order]', $detail_order_update, $set_nobold);
			$set_detail_order2 = str_replace('JdanT', 'J&T', $set_detail_order);
			$set_ongkos_kirim = str_replace('[mgo_ongkos_kirim]', $ongkos_kirimnya, $set_detail_order2);
			$set_biaya_cod = str_replace('[mgo_biaya_cod]', $biaya_codnya, $set_ongkos_kirim);
			$set_ref1 = str_replace('[ref1]', $ref1, $set_biaya_cod);
			$set_ref2 = str_replace('[ref2]', $ref2, $set_ref1);
			$set_ref3 = str_replace('[ref3]', $ref3, $set_ref2);
			$set_ref4 = str_replace('[ref4]', $ref4, $set_ref3);
			$set_ref5 = str_replace('[ref5]', $ref5, $set_ref4);
			$datenya_cal = str_replace('[date]', $date_caldera, $set_ref5);
			$messagenya = set_whatsapp_format($datenya_cal);

			// CHECK SINGLE SENDER OR CS ROTATOR SENDER, wanotif_type 0: single sender, 1: cs rotator sender
			if($wanotif_type==0){
				$apikey = $wanotif_apikey;

				// SET PHONE
				if($phone!=''){
					$phone = hp($phone);
					$url = $wanotif_url.'/send';

					$spintax = new Spintax();
					$messagenya = $spintax->process($messagenya);

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

					// forward wanotif
					$array_wanotif_forward = explode(',', $wanotif_forward);
			        foreach ($array_wanotif_forward as $key => $value) {
			        	if (is_numeric($value)){
			        		$phone =  hp($value);

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
			        	}
			        	
			        }
				}

			}else{
				// YANG KIRIM SI CS ROTATOR

				// KLO CS ID FORM ROTATOR isi, pakai ID CS yang ada di CS Rotator
				// Klo gak ada, pakai CS ID yang sudah dibawa atau ada di form (ID CS yang dibawa dari form 1 ke Form 2)
				if($id_cs_form[0]->id_cs!=''){
					$csid = $csid_update;
				}

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
						if($phone!=''){
							$phone = hp($phone);
							$url = $wanotif_url.'/send';

							$spintax = new Spintax();
							$messagenya = $spintax->process($messagenya);

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

							// forward wanotif
							$array_wanotif_forward = explode(',', $wanotif_forward);
					        foreach ($array_wanotif_forward as $key => $value) {
					        	if (is_numeric($value)){
					        		$phone =  hp($value);
					        		
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
					        	}
					        	
					        }
						}
					}

			    	
				}
			}
			
		}
	}

	//*******************************************
	// SEND Telegram
	//*******************************************

	if($telegram_status==1){

		// cek message
		if($tg_message_status==0){
    		$message = $telegram_message;
    	}else{
    		$message = $tg_custom_message;
    	}

    	$set_csname = str_replace('[mgo_csid]', $cs_name, $message);
    	$set_csmail = str_replace('[mgo_csmail]', $csmail, $set_csname);
    	$set_orderid = str_replace('[mgo_orderid]', $orderid, $set_csmail);
		$set_nama = str_replace('[mgo_nama]', $namanya, $set_orderid);
		$set_produk = str_replace('[mgo_nama_produk]', $produk, $set_nama);
		$set_total = str_replace('[mgo_total]', $totalharga, $set_produk);
		$set_phone = str_replace('[mgo_wa]', $phone, $set_total);
		$set_pembayaran = str_replace('[mgo_pembayaran]', $pembayaran, $set_phone);
		$set_item_total = str_replace('[mgo_item_total]', $item_total, $set_pembayaran);
		$set_followup1 = str_replace('[followup1]', $link_followup1, $set_item_total);
		$set_followup2 = str_replace('[followup2]', $link_followup2, $set_followup1);
		$set_followup3 = str_replace('[followup3]', $link_followup3, $set_followup2);
		$set_phone_cs = str_replace('[mgo_cswa]', $phone_cs, $set_followup3);
		$set_jumlah_barang = str_replace('[mgo_jumlah_barang]', $jumlah_barang, $set_phone_cs);
		$set_nobold = str_replace('[mgo_no_bold]', '', $set_jumlah_barang);
		$set_detail_order = str_replace('[mgo_detail_order]', $detail_order, $set_nobold);
		$set_detail_order2 = str_replace('JdanT', 'J&T', $set_detail_order);
		$set_ongkos_kirim = str_replace('[mgo_ongkos_kirim]', $ongkos_kirimnya, $set_detail_order2);
		$set_biaya_cod = str_replace('[mgo_biaya_cod]', $biaya_codnya, $set_ongkos_kirim);
		$set_ref1 = str_replace('[ref1]', $ref1, $set_biaya_cod);
		$set_ref2 = str_replace('[ref2]', $ref2, $set_ref1);
		$set_ref3 = str_replace('[ref3]', $ref3, $set_ref2);
		$set_ref4 = str_replace('[ref4]', $ref4, $set_ref3);
		$set_ref5 = str_replace('[ref5]', $ref5, $set_ref4);
		$datenya_cal = str_replace('[date]', $date_caldera, $set_ref5);
		$messagenya = $datenya_cal;

		// if tg_owner_status = 1
		if($tg_owner_status==1){
			if($telegram_single_channel!=''){
				myaction_mgo_send2tg($telegram_apikey_bot, $telegram_single_channel, $messagenya);
			}
		};

		// if tg_csrotator_status = 1
		if($tg_csrotator_status==1){
				if($id_cs_form[0]->id_cs!=''){
					$csid = $csid_update;
				}
				$channel_csnya = '';
				$fields = json_decode($telegram_csrotator_channel, true);
				if(!empty($fields)){
					foreach ($fields as $key => $value ) {
						if($key==$csid){
							$channel_csnya = $value;
						}
					}
					$channel_nya = $channel_csnya;
				}
				myaction_mgo_send2tg($telegram_apikey_bot, $channel_nya, $messagenya);
		}

		// if tg_custom_status = 1
		if($tg_custom_status==1){
			$array_channel = explode(',', $tg_custom_channel);
	        foreach ($array_channel as $key => $value) {
	        	myaction_mgo_send2tg($telegram_apikey_bot, $value, $messagenya);
	        }
    	}
		
	}

}
add_action('caldera_forms_submit_complete','mgo_send_sms',10,4);

?>