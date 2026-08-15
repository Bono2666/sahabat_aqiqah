<html>
	<head>
		<title>
			MGO - Print Label
		</title>
		<style>
			body {
				font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
				line-height: 1.3;
			}
			@page {
		        margin-top: 2cm;
		        margin-bottom: 2cm;
		        margin-left: 1.2cm;
		        margin-right: 1.2cm;
		    }
			.column {font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";float: left;width: 25%;height: 135px;font-size: 12px;}.row.label_produk {border: 1px solid #222;padding: 1%;width: 98%;border-left: 0;border-right: 0;border-top: 0;font-size: 13px;}.row.label_pengiriman {border: 1px solid #222;margin-bottom: 8px;}.column.label_orderid {width: 16.5%;padding: 1%;}.column.label_penerima {width: 30%;padding: 1%;border-left: 1px dashed #222;}.column.label_pengirim {width: 30%;padding: 1%;border-left: 1px dashed #222;}.column.label_ekspedisi {width: 11%;padding: 1%;border-left: 1px dashed #222;float: left;}.row:after {content: "";display: table;clear: both;}
		</style>
	</head>
	<body onload="window.print()">
	
<?php

if($_GET['mgo_page']=='print_label'){
	global $wpdb;
	$cap = get_user_meta( wp_get_current_user()->ID, $wpdb->get_blog_prefix() . 'capabilities', true );
    $roles = array_keys((array)$cap);
    $role = $roles[0];
    if($role=='administrator' || $role=='editor'){
    	if(isset($_GET['id'])){
			
			global $wpdb;
		    $table_name = $wpdb->prefix . "cf_form_entry_values";
		    $table_name2 = $wpdb->prefix . "cf_form_entries";
		    $table_name3 = $wpdb->prefix . "mgo_settings";
		    $table_name4 = $wpdb->prefix . "mgo_calculation";

		    $query_produk_settings = $wpdb->get_results('SELECT data from '.$table_name3.' where type="nama_produk_status" or type="nama_produk_other_name" ORDER BY id ASC');
		    $nama_produk_status = $query_produk_settings[0]->data;
		    $nama_produk_other_name = $query_produk_settings[1]->data;

		    if($nama_produk_status=='1'){
		        $nama_produknya = 'Program';
		    }elseif($nama_produk_status=='2'){
		        $nama_produknya = 'Kegiatan';
		    }elseif($nama_produk_status=='3'){
		        $nama_produknya = $nama_produk_other_name;
		    }else{
		        $nama_produknya = 'Produk';
		    }

		    if(isset($_GET['produk'])){
		    	$set_produk = $_GET['produk'];
		    }else{
		    	$set_produk = 'show';
		    }

		    if(isset($_GET['ekspedisi'])){
		    	$set_ekspedisi = $_GET['ekspedisi'];
		    }else{
		    	$set_ekspedisi = 'show';
		    }
		    
		    if(isset($_GET['ongkir'])){
		    	$set_ongkir = $_GET['ongkir'];
		    }else{
		    	$set_ongkir = 'show';
		    }


		    $entry_id = $_GET['id'];
		    $entry_id = explode(',', $entry_id);

		    $jumlah = sizeof($entry_id);

		    if($jumlah==1 and $_GET['id']==''){
		    	echo 'Pilih data order terlebih dahulu untuk melakukan <b>Print Label</b>. :)';
		    	exit();
		    }



	    	$label_pengirim = $wpdb->get_results("SELECT * from $table_name3 where type='label_pengirim' ");

		    foreach ($entry_id as $key => $row) {
		    	$entryid = $row;
		    	if($entryid!=''){
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
						$date_pemesnan = strtotime('7 hours', $time_pemesanan);
						$date_real = date('d-m-Y, H:i', $date_pemesnan);

						// $formid = $date[0]->form_id;

						// $courier = $wpdb->get_results("SELECT courier from $table_name4 where id_form='$formid' ");
						// $couriernya = '<span style="font-size:16px;">'.$courier[0]->courier.'</span><br>';

					}else{
						$date_real = '';
						// $couriernya = '';
					}


			    	$enter = '<br>';
			    	if($alamat==null && $alamat_lengkap==null){
			    		$enter = '';
			    	}

			    	if($provinsi==null){
			    		if($kecamatan==null){
			    			$kecamatannya = '';
			    		}else{
			    			$kecamatannya = $kecamatan[0]->value;
			    		}
			    	}else{
			    		$kecamatannya = $kecamatan[0]->value.', '.$kab_kota[0]->value.', '.$provinsi[0]->value;
			    	}

			    	if($produk==null){
			    		$produknya = '';
			    	}else{
			    		$produknya = $produk[0]->value;
			    	}

			    	if($nama==null){
			    		$namanya = '';
			    	}else{
			    		$namanya = $nama[0]->value;
			    	}

			    	if($alamat==null){
			    		$alamatnya = '';
			    	}else{
			    		$alamatnya = $alamat[0]->value;
			    	}

			    	if($alamat_lengkap==null){
			    		$alamat_lengkapnya = '';
			    	}else{
			    		$alamat_lengkapnya = $alamat_lengkap[0]->value;
			    	}

			    	if($wa==null){
			    		$wanya = '';
			    	}else{
			    		$wanya = $wa[0]->value;
			    	}


			    	if($ongkir==null){
			    		$ongkirnya = '';
			    	}else{
			    		$ongkirnya = $ongkir[0]->value;
			    	}

			    	if($ongkir2==null){
			    		$ongkir2_nya = '';
			    	}else{
			    		$ongkir2_nya = $ongkir2[0]->value;
			    	}


			    	if($orderid==null){
			    		$orderid_nya = '';
			    	}else{
			    		$orderid_nya = $orderid[0]->value;
			    	}

			    	
			    	echo '
				    <div class="row label_pengiriman">';

				    if($set_produk=='show'){
				    	echo'
				    	<div class="label_produk" style="padding:1%;border: 1px solid #222;width: 98%;border-bottom: 1px dashed #222;border-left: 0;border-right: 0;border-top: 0;font-size: 13px;"><b>'.$nama_produknya.': </b>'.$produknya.'</div>';
				    }

				    	echo'
					    <div class="column label_orderid"><b>Order ID:</b><br>'.$orderid_nya.'<br><br><b>Date Order:</b><br>'.$date_real.'</div>
					    <div class="column label_penerima"><b>Kepada:</b><br><b>'.handling_character($namanya).'</b><br>'.$alamatnya.$alamat_lengkapnya.$enter.$kecamatannya.$kode_pos.'<br>Phone: '.$wanya.'</div>
					    <div class="column label_pengirim"><b>Pengirim:</b><br>'.$label_pengirim[0]->data.'</div>';
					if($set_ekspedisi=='show'){
						echo'
					    <div class="column label_ekspedisi"><b>Ekspedisi:</b><br><b>'.strtoupper($couriernya).'</b><br>';
					    if($set_ongkir=='show'){
							echo'
						    <span class="detail_ongkir">'.$ongkirnya.$ongkir2_nya.'</span>';
						}
					    echo'
					    </div>';
					}
					echo'
					</div>';
				}
		    }
			
		    
		}else{
			echo 'No data!';
		}	
    }

}

?>

	
	</body>
</html>