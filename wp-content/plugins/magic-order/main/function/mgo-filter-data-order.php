<?php 
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

    // $plugin_status = $wpdb->get_results("SELECT * from $table_name3 where type='plugin_status'")[0];
    $query_setting = $wpdb->get_results('SELECT data from '.$table_name3.' where type="dash_style" ORDER BY id ASC');

    // print_r($query_setting);

    $dash_style  = $query_setting[0]->data;
    // FROM DATATABLES
    // $startlist = $_POST['start'];
    // $length = $_POST['length'];
    // $draw = $_POST['draw'];
    // $filter_option = $_POST['filter_option'];

    $filter_load = $_POST['datanya'][0];
    $filter_form = $_POST['datanya'][1];
    $filter_option = $_POST['datanya'][2];
    $filter_cs = $_POST['datanya'][3];
    $filter_orderid = $_POST['datanya'][4];

    $filter_product = $_POST['datanya'][5];
    $filter_coupon = $_POST['datanya'][6];
    $filter_name = $_POST['datanya'][7];
    $filter_datestart = $_POST['datanya'][8];
    $filter_dateend = $_POST['datanya'][9];
    $filter_csdate = $_POST['datanya'][10];
    $filter_datestartcs = $_POST['datanya'][11];
    $filter_dateendcs = $_POST['datanya'][12];
    $filter_status = $_POST['datanya'][13];
    $filter_statusdate = $_POST['datanya'][14];
    $filter_datestartstatus = $_POST['datanya'][15];
    $filter_dateendstatus = $_POST['datanya'][16];

   
	$mgo_settings = $wpdb->get_results('SELECT data from '.$table_name3.' where type="utc_status" or type="utc_value" or type="utc_status_dataorder" or type="utc_value_dataorder" ORDER BY id ASC');
    $utc_status = $mgo_settings[0]->data;
    $utc_value = $mgo_settings[1]->data;
    $utc_status_dataorder = $mgo_settings[2]->data;
    $utc_value_dataorder = $mgo_settings[3]->data;

    // $time_now_dataorder = date('Y-m-d H:i:s',strtotime('+7 hour',strtotime($start)));
    // $time_now_dataorder = date('Y-m-d H:i:s',strtotime('+7 hour',strtotime($start)));
    $time_start = strtotime($filter_datestart);
    $date_start = strtotime('-7 hours', $time_start);
    $time_end = strtotime($filter_dateend);
    $date_end = strtotime('-7 hours', $time_end);
    $time_start2 = strtotime($filter_datestartcs);
    $date_start2 = strtotime('-7 hours', $time_start2);
    $time_end2 = strtotime($filter_dateendcs);
    $date_end2 = strtotime('-7 hours', $time_end2);
	// if($utc_status_dataorder==1){
	// 	$jam_tambahan = $utc_value_dataorder;
	// 	if($jam_tambahan<0){
	// 		$tandabaca = '-';
	// 	}else{
	// 		$tandabaca = '+';
	// 	}
	// 	// echo '<script>alert('.$jam_tambahan.');</script>';

 //    	// $time_now_dataorder = date('Y-m-d H:i:s',strtotime('+'.$jam_tambahan.' hour',strtotime($start)));
 //    	// $date_start = strtotime("$tandabaca$jam_tambahan hours", $time_start);
	//     // $date_end = strtotime("$tandabaca$jam_tambahan hours", $time_end);
	//     // $date_start2 = strtotime("$tandabaca$jam_tambahan hours", $time_start2);
	//     // $date_end2 = strtotime("$tandabaca$jam_tambahan hours", $time_end2);

	//     $date_start = strtotime("-21 hours", $time_start);
	//     $date_end = strtotime("-21 hours", $time_end);
	//     $date_start2 = strtotime("+0 hours", $time_start2);
	//     $date_end2 = strtotime("+0 hours", $time_end2);
 //    }

    // DATA GENERAL
    
	$filter_datestart_now = date('Y-m-d H:i', $date_start);

	
	$filter_dateend_now = date('Y-m-d H:i', $date_end);

	// DATE CS
    
	$filter_datestart_now2 = date('Y-m-d H:i', $date_start2);

	
	$filter_dateend_now2 = date('Y-m-d H:i', $date_end2);
    

    // GET USER ROLES ROLES
    $cap = get_user_meta( wp_get_current_user()->ID, $wpdb->get_blog_prefix() . 'capabilities', true );
    $roles = array_keys((array)$cap);
    $role = $roles[0];
    $id_login = wp_get_current_user()->ID;

    // FILTER LOAD
    // 0 : artinya query semua
    // 1 : artinya query semua berdasarkan form
    // 2 : artinya query berdasarkan filter

    // set Filter Load = 0 ketika form dipilih "ALL"
    if($filter_load=='1' && $filter_form=='0'){
    	$filter_load = 0;
    }

    $query_total_cod = 0;
    $query_closing_cod = 0;
    $query_rts_cod = 0;
    $query_total_closing_cod = 0;

    if($filter_load==0){ // ALL FORM
    	if($role=='administrator'){
	
			$query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a
				LEFT JOIN $table_name5 as b ON a.entry_id = b.id
				where slug LIKE '%mgo_orderid%'
				GROUP BY a.slug");

			$query_total_closing_all = $wpdb->get_var("SELECT count(*) from $table_name6 as a 
				LEFT JOIN $table_name4 as b ON a.order_id = b.value
				where a.status_id=1 ");

			$query_total_closing_ada_rts = $wpdb->get_var("SELECT count(*) from $table_name6 as a 
				LEFT JOIN $table_name4 as b ON a.order_id = b.value
				where a.status_rts=1 ");

			$query_total_closing = $query_total_closing_all - $query_total_closing_ada_rts;


			if($dash_style=='1'){
			    $query_total_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
			    	LEFT JOIN $table_name4 as b ON a.entry_id = b.entry_id 
			    	where a.value LIKE '%cod%' 
			    	and a.slug = 'mgo_pembayaran' 
			    	and b.slug LIKE '%mgo_orderid%' ");

			    $query_closing_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
			    	LEFT JOIN $table_name6 as b ON a.entry_id = b.entry_idnya
			    	where a.value LIKE '%cod%' 
			    	and a.slug = 'mgo_pembayaran'
			    	and b.entry_idnya != ''
			    	and b.status_id = 1 ");

			    $query_rts_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
			    	LEFT JOIN $table_name6 as b ON a.entry_id = b.entry_idnya 
			    	where a.value LIKE '%cod%' 
			    	and a.slug = 'mgo_pembayaran'
			    	and b.entry_idnya != ''
			    	and b.status_rts = 1 ");

			    $query_total_closing_cod = $query_closing_cod - $query_rts_cod;
			}

		 //    print_r($query_total_cod);
			// echo '_';
			// print_r($query_total_closing_cod);
			// echo '_';
			// print_r($query_rts_cod);
			// echo '_';

		}else{

		    $query_total = $wpdb->get_var("SELECT count(*) from $table_name4 as a 
		    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
		    	LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
		    	where c.value = '$id_login' and c.slug = 'mgo_csid' and a.slug like '%mgo_orderid%'");

		    $query_total_closing_all = $wpdb->get_var("SELECT count(*) from $table_name6 as a 
				LEFT JOIN $table_name4 as b ON a.order_id = b.value
				LEFT JOIN $table_name4 as c ON b.entry_id = c.entry_id
				where a.status_id=1 and b.value!='' and c.slug='mgo_csid' and c.value='$id_login' ");

		    $query_total_closing_ada_rts = $wpdb->get_var("SELECT count(*) from $table_name6 as a 
				LEFT JOIN $table_name4 as b ON a.order_id = b.value
				LEFT JOIN $table_name4 as c ON b.entry_id = c.entry_id
				where a.status_rts=1 and b.value!='' and c.slug='mgo_csid' and c.value='$id_login' ");

		    $query_total_closing = $query_total_closing_all - $query_total_closing_ada_rts;


		    if($dash_style=='1'){
		    $query_total_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
		    	LEFT JOIN $table_name4 as b ON a.entry_id = b.entry_id 
		    	LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
		    	where a.value LIKE '%cod%' 
		    	and a.slug = 'mgo_pembayaran' 
		    	and b.slug LIKE '%mgo_orderid%'
		    	and c.value = '$id_login' and c.slug = 'mgo_csid' ");

		    $query_closing_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
		    	LEFT JOIN $table_name6 as b ON a.entry_id = b.entry_idnya
		    	LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
		    	where a.value LIKE '%cod%' 
		    	and a.slug = 'mgo_pembayaran'
		    	and b.entry_idnya != ''
		    	and b.status_id = 1
		    	and c.value = '$id_login' and c.slug = 'mgo_csid' ");

		    $query_rts_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
		    	LEFT JOIN $table_name6 as b ON a.entry_id = b.entry_idnya 
		    	LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
		    	where a.value LIKE '%cod%' 
		    	and a.slug = 'mgo_pembayaran'
		    	and b.entry_idnya != ''
		    	and b.status_rts = 1 
		    	and c.value = '$id_login' and c.slug = 'mgo_csid' ");

		    $query_total_closing_cod = $query_closing_cod - $query_rts_cod;
			}


		}

	}elseif($filter_load==1){ // PER-FORM
		if($role=='administrator'){

			$query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a
				LEFT JOIN $table_name5 as b ON a.entry_id = b.id
				where slug LIKE '%mgo_orderid%' and b.form_id='$filter_form'
				GROUP BY a.slug");

			$query_total_closing_all = $wpdb->get_var("SELECT count(*) from $table_name6 as a 
				LEFT JOIN $table_name4 as b ON a.order_id = b.value
                LEFT JOIN $table_name5 as c ON b.entry_id = c.id
				where a.status_id=1 and b.value!='' and c.form_id='$filter_form'");

			$query_total_closing_ada_rts = $wpdb->get_var("SELECT count(*) from $table_name6 as a 
				LEFT JOIN $table_name4 as b ON a.order_id = b.value
                LEFT JOIN $table_name5 as c ON b.entry_id = c.id
				where a.status_rts=1 and b.value!='' and c.form_id='$filter_form'");

			$query_total_closing = $query_total_closing_all - $query_total_closing_ada_rts;

			// if($query_total==null){
			// 	$query_total = 0;
			// }

		 //    print_r($query_total);
		 //    echo '_';
		 //    print_r($query_total_closing);
		 //    echo '_';
		 //    print_r($query_total_closing_ada_rts);

		 //    wp_die();

			if($dash_style=='1'){
			$query_total_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
		    	LEFT JOIN $table_name4 as b ON a.entry_id = b.entry_id 
		    	LEFT JOIN $table_name5 as c ON a.entry_id = c.id
		    	where a.value LIKE '%cod%' 
		    	and a.slug = 'mgo_pembayaran' 
		    	and b.slug LIKE '%mgo_orderid%' and c.form_id='$filter_form' ");

		    $query_closing_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
		    	LEFT JOIN $table_name6 as b ON a.entry_id = b.entry_idnya
		    	LEFT JOIN $table_name5 as c ON a.entry_id = c.id
		    	where a.value LIKE '%cod%' 
		    	and a.slug = 'mgo_pembayaran'
		    	and b.entry_idnya != ''
		    	and b.status_id = 1 and c.form_id='$filter_form' ");

		    $query_rts_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
		    	LEFT JOIN $table_name6 as b ON a.entry_id = b.entry_idnya 
		    	LEFT JOIN $table_name5 as c ON a.entry_id = c.id
		    	where a.value LIKE '%cod%' 
		    	and a.slug = 'mgo_pembayaran'
		    	and b.entry_idnya != ''
		    	and b.status_rts = 1 and c.form_id='$filter_form' ");

		    $query_total_closing_cod = $query_closing_cod - $query_rts_cod;
			}



		    /*
		    $query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a
				LEFT JOIN $table_name5 as b ON a.entry_id = b.id
				where slug LIKE '%mgo_orderid%'
				GROUP BY a.slug");

			$query_closing_ril = $wpdb->get_var("SELECT count(*) from $table_name6 as a 
				LEFT JOIN $table_name4 as b ON a.order_id = b.value
				where a.status_id=1 ");

			$query_closing_ada_rts = $wpdb->get_var("SELECT count(*) from $table_name6 as a 
				LEFT JOIN $table_name4 as b ON a.order_id = b.value
				where a.status_rts=1 ");

			$query_closing = $query_closing_ril - $query_closing_ada_rts;
			*/


		    // $query_total_cod = $wpdb->get_results("SELECT a.entry_id, d.value as value from $table_name4 as a 
			   //  	LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id 
			   //  	where a.value LIKE '%cod%' 
			   //  	and a.slug = 'mgo_pembayaran' 
			   //  	and d.slug LIKE '%mgo_orderid%' ");

		    // $query_closing_cod = $wpdb->get_results("SELECT a.entry_id from $table_name4 as a 
			   //  	LEFT JOIN $table_name6 as d ON a.entry_id = d.entry_id 
			   //  	where a.value LIKE '%cod%' 
			   //  	and a.slug = 'mgo_pembayaran'
			   //  	and d.entry_id != ''
			   //  	and d.status_id = 1 ");

		    // $query_rts = $wpdb->get_results("SELECT a.entry_id from $table_name4 as a 
			   //  	LEFT JOIN $table_name6 as d ON a.entry_id = d.entry_id 
			   //  	where a.value LIKE '%cod%' 
			   //  	and a.slug = 'mgo_pembayaran'
			   //  	and d.entry_id != ''
			   //  	and d.status_id = 5 ");

		}else{

			// $query_total = $wpdb->get_results("SELECT a.value as orderid from $table_name4 as a 
		 //    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
		 //    	LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
		 //    	where c.value = '$id_login' and c.slug = 'mgo_csid' and a.slug like '%mgo_orderid%' and form_id = '$filter_form'
		 //    	GROUP BY orderid");

		 //    $query_closing = $wpdb->get_results("SELECT count(*) as closing from $table_name6 as a 
			// 	LEFT JOIN $table_name4 as b ON a.order_id = b.value
			// 	LEFT JOIN $table_name4 as c ON b.entry_id = c.entry_id
			// 	LEFT JOIN $table_name5 as d ON b.entry_id = d.id 
			// 	where a.status_id=1 and b.value!='' and c.slug='mgo_csid' and c.value='$id_login' and form_id = '$filter_form' ");



		    $query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a
				LEFT JOIN $table_name5 as b ON a.entry_id = b.id
				LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
				where a.slug LIKE '%mgo_orderid%' and b.form_id='$filter_form' 
				and c.value = '$id_login' and c.slug = 'mgo_csid'");

			$query_total_closing_all = $wpdb->get_var("SELECT COUNT(*) from $table_name6 as a 
				LEFT JOIN $table_name4 as b ON a.order_id = b.value
                LEFT JOIN $table_name5 as c ON b.entry_id = c.id
                LEFT JOIN $table_name4 as d ON b.entry_id = d.entry_id 
				where a.status_id=1 and b.value!='' and c.form_id='$filter_form' 
				and d.value = '$id_login' and d.slug = 'mgo_csid' ");

			$query_total_closing_ada_rts = $wpdb->get_var("SELECT count(*) from $table_name6 as a 
				LEFT JOIN $table_name4 as b ON a.order_id = b.value
                LEFT JOIN $table_name5 as c ON b.entry_id = c.id
                LEFT JOIN $table_name4 as d ON b.entry_id = d.entry_id 
				where a.status_rts=1 and b.value!='' and c.form_id='$filter_form' 
				and d.value = '$id_login' and d.slug = 'mgo_csid' ");

			$query_total_closing = $query_total_closing_all - $query_total_closing_ada_rts;

			// if($query_total==null){
			// 	$query_total = 0;
			// }

		 //    print_r($query_total);
		 //    echo '_';
		 //    print_r($query_total_closing);
		 //    echo '_';
		 //    print_r($query_total_closing_ada_rts);

		 //    wp_die();

			if($dash_style=='1'){
			$query_total_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
		    	LEFT JOIN $table_name4 as b ON a.entry_id = b.entry_id 
		    	LEFT JOIN $table_name5 as c ON a.entry_id = c.id
		    	LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id 
		    	where a.value LIKE '%cod%' 
		    	and a.slug = 'mgo_pembayaran' 
		    	and b.slug LIKE '%mgo_orderid%' and c.form_id='$filter_form' 
		    	and d.value = '$id_login' and d.slug = 'mgo_csid'");

		    $query_closing_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
		    	LEFT JOIN $table_name6 as b ON a.entry_id = b.entry_idnya
		    	LEFT JOIN $table_name5 as c ON a.entry_id = c.id
		    	LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id 
		    	where a.value LIKE '%cod%' 
		    	and a.slug = 'mgo_pembayaran'
		    	and b.entry_idnya != ''
		    	and b.status_id = 1 and c.form_id='$filter_form' 
		    	and d.value = '$id_login' and d.slug = 'mgo_csid'");

		    $query_rts_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
		    	LEFT JOIN $table_name6 as b ON a.entry_id = b.entry_idnya 
		    	LEFT JOIN $table_name5 as c ON a.entry_id = c.id
		    	LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id 
		    	where a.value LIKE '%cod%' 
		    	and a.slug = 'mgo_pembayaran'
		    	and b.entry_idnya != ''
		    	and b.status_rts = 1 and c.form_id='$filter_form' 
		    	and d.value = '$id_login' and d.slug = 'mgo_csid'");

		    $query_total_closing_cod = $query_closing_cod - $query_rts_cod;
			}


		}

	}elseif($filter_load==2){

		if($filter_form=='0'){
			$formnya = "";
		}else{
			$formnya = "and form_id='$filter_form'";
		}

		if($filter_option=='cs'){

			if($filter_csdate=='alldate'){

				$query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
			    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
			    	LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
			    	where c.value = '$filter_cs' and c.slug = 'mgo_csid' and a.slug like '%mgo_orderid%' $formnya ");

				$query_total_closing_all = $wpdb->get_var("SELECT count(*) from $table_name6 as a 
					LEFT JOIN $table_name4 as b ON a.order_id = b.value
					LEFT JOIN $table_name4 as c ON b.entry_id = c.entry_id
					LEFT JOIN $table_name5 as d ON b.entry_id = d.id 
					where a.status_id=1 and b.value!='' and c.slug='mgo_csid' and c.value='$filter_cs' $formnya ");

				$query_total_closing_ada_rts = $wpdb->get_var("SELECT count(*) from $table_name6 as a 
					LEFT JOIN $table_name4 as b ON a.order_id = b.value
					LEFT JOIN $table_name4 as c ON b.entry_id = c.entry_id
					LEFT JOIN $table_name5 as d ON b.entry_id = d.id 
					where a.status_rts=1 and b.value!='' and c.slug='mgo_csid' and c.value='$filter_cs' $formnya ");

				$query_total_closing = $query_total_closing_all - $query_total_closing_ada_rts;



				if($dash_style=='1'){
				$query_total_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
			    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
			    	LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
			    	LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id 
			    	where c.value = '$filter_cs' and c.slug = 'mgo_csid' and a.slug like '%mgo_orderid%' 
			    	and d.value LIKE '%cod%' and d.slug='mgo_pembayaran' $formnya ");

				$query_closing_cod = $wpdb->get_var("SELECT count(*) from $table_name6 as a 
					LEFT JOIN $table_name4 as b ON a.order_id = b.value
					LEFT JOIN $table_name4 as c ON b.entry_id = c.entry_id
					LEFT JOIN $table_name5 as d ON b.entry_id = d.id 
					LEFT JOIN $table_name4 as e ON b.entry_id = e.entry_id 
					where a.status_id=1 and b.value!='' and c.slug='mgo_csid' and c.value='$filter_cs' 
					and e.value LIKE '%cod%' and e.slug='mgo_pembayaran' $formnya ");

				$query_rts_cod = $wpdb->get_var("SELECT count(*) from $table_name6 as a 
					LEFT JOIN $table_name4 as b ON a.order_id = b.value
					LEFT JOIN $table_name4 as c ON b.entry_id = c.entry_id
					LEFT JOIN $table_name5 as d ON b.entry_id = d.id 
					LEFT JOIN $table_name4 as e ON b.entry_id = e.entry_id 
					where a.status_rts=1 and b.value!='' and c.slug='mgo_csid' and c.value='$filter_cs' 
					and e.value LIKE '%cod%' and e.slug='mgo_pembayaran' $formnya ");

				$query_total_closing_cod = $query_closing_cod - $query_rts_cod;
				}


			}else{

				$query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
			    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
			    	LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
			    	where c.value = '$filter_cs' and c.slug = 'mgo_csid' and a.slug like '%mgo_orderid%' 
			    	and datestamp BETWEEN '$filter_datestart_now2' AND '$filter_dateend_now2'
			    	$formnya");

		    	$query_total_closing_all = $wpdb->get_var("SELECT count(*) from $table_name6 as a 
					LEFT JOIN $table_name4 as b ON a.order_id = b.value
					LEFT JOIN $table_name4 as c ON b.entry_id = c.entry_id
					LEFT JOIN $table_name5 as d ON b.entry_id = d.id 
					where a.status_id=1 and b.value!='' and c.slug='mgo_csid' and c.value='$filter_cs' 
					and datestamp BETWEEN '$filter_datestart_now2' AND '$filter_dateend_now2'
					$formnya ");

		    	$query_total_closing_ada_rts = $wpdb->get_var("SELECT count(*) from $table_name6 as a 
					LEFT JOIN $table_name4 as b ON a.order_id = b.value
					LEFT JOIN $table_name4 as c ON b.entry_id = c.entry_id
					LEFT JOIN $table_name5 as d ON b.entry_id = d.id 
					where a.status_rts=1 and b.value!='' and c.slug='mgo_csid' and c.value='$filter_cs' 
					and datestamp BETWEEN '$filter_datestart_now2' AND '$filter_dateend_now2'
					$formnya ");

		    	$query_total_closing = $query_total_closing_all - $query_total_closing_ada_rts;



		    	if($dash_style=='1'){
				$query_total_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
			    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
			    	LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
			    	LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id 
			    	where c.value = '$filter_cs' and c.slug = 'mgo_csid' and a.slug like '%mgo_orderid%' 
			    	and d.value LIKE '%cod%' and d.slug='mgo_pembayaran' 
			    	and datestamp BETWEEN '$filter_datestart_now2' AND '$filter_dateend_now2'
			    	$formnya");

		    	$query_closing_cod = $wpdb->get_var("SELECT count(*) from $table_name6 as a 
					LEFT JOIN $table_name4 as b ON a.order_id = b.value
					LEFT JOIN $table_name4 as c ON b.entry_id = c.entry_id
					LEFT JOIN $table_name5 as d ON b.entry_id = d.id 
					LEFT JOIN $table_name4 as e ON b.entry_id = e.entry_id 
					where a.status_id=1 and b.value!='' and c.slug='mgo_csid' and c.value='$filter_cs' 
					and e.value LIKE '%cod%' and e.slug='mgo_pembayaran' 
					and datestamp BETWEEN '$filter_datestart_now2' AND '$filter_dateend_now2'
					$formnya ");

		    	$query_rts_cod = $wpdb->get_var("SELECT count(*) from $table_name6 as a 
					LEFT JOIN $table_name4 as b ON a.order_id = b.value
					LEFT JOIN $table_name4 as c ON b.entry_id = c.entry_id
					LEFT JOIN $table_name5 as d ON b.entry_id = d.id 
					LEFT JOIN $table_name4 as e ON b.entry_id = e.entry_id 
					where a.status_rts=1 and b.value!='' and c.slug='mgo_csid' and c.value='$filter_cs' 
					and e.value LIKE '%cod%' and e.slug='mgo_pembayaran' 
					and datestamp BETWEEN '$filter_datestart_now2' AND '$filter_dateend_now2'
					$formnya ");

		    	$query_total_closing_cod = $query_closing_cod - $query_rts_cod;
			    }

			}

		}elseif($filter_option=='orderid'){
			if($role=='administrator'){

				$query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
			    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
			    	where value = '$filter_orderid' $formnya ");

		    	$query_total_closing_all = $wpdb->get_var("SELECT COUNT(*) from $table_name6 as a 
					LEFT JOIN $table_name4 as b ON a.order_id = b.value 
					LEFT JOIN $table_name5 as c ON b.entry_id = c.id
					where a.status_id=1 and b.value = '$filter_orderid' $formnya ");

		    	$query_total_closing_ada_rts = $wpdb->get_var("SELECT COUNT(*) from $table_name6 as a 
					LEFT JOIN $table_name4 as b ON a.order_id = b.value 
					LEFT JOIN $table_name5 as c ON b.entry_id = c.id
					where a.status_rts=1 and b.value = '$filter_orderid' $formnya ");

		    	$query_total_closing = $query_total_closing_all - $query_total_closing_ada_rts;

		    	
		    	if($dash_style=='1'){
				$query_total_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
			    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
			    	LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
			    	where a.value = '$filter_orderid' 
			    	and c.value LIKE '%cod%' and c.slug='mgo_pembayaran' $formnya ");

		    	$query_closing_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name6 as a 
					LEFT JOIN $table_name4 as b ON a.order_id = b.value 
					LEFT JOIN $table_name5 as c ON b.entry_id = c.id
					LEFT JOIN $table_name4 as d ON b.entry_id = d.entry_id 
					where a.status_id=1 and b.value = '$filter_orderid' 
					and d.value LIKE '%cod%' and d.slug='mgo_pembayaran' $formnya ");

		    	$query_rts_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name6 as a 
					LEFT JOIN $table_name4 as b ON a.order_id = b.value 
					LEFT JOIN $table_name5 as c ON b.entry_id = c.id
					LEFT JOIN $table_name4 as d ON b.entry_id = d.entry_id 
					where a.status_rts=1 and b.value = '$filter_orderid' 
					and d.value LIKE '%cod%' and d.slug='mgo_pembayaran' $formnya ");

		    	$query_total_closing_cod = $query_closing_cod - $query_rts_cod;
			    }


			}else{


			    $query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
					where c.value = '$id_login' and c.slug = 'mgo_csid' and a.slug like '%mgo_orderid%' and a.value='$filter_orderid' $formnya  ");

			    $query_total_closing_all = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id
					LEFT JOIN $table_name6 as d ON d.order_id = a.value 
					where c.value = '$id_login' and c.slug = 'mgo_csid' and a.slug like '%mgo_orderid%' and a.value='$filter_orderid' and d.status_id=1 $formnya");

			    $query_total_closing_ada_rts = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id
					LEFT JOIN $table_name6 as d ON d.order_id = a.value 
					where c.value = '$id_login' and c.slug = 'mgo_csid' and a.slug like '%mgo_orderid%' and a.value='$filter_orderid' and d.status_rts=1 $formnya");

			    $query_total_closing = $query_total_closing_all - $query_total_closing_ada_rts;


			    if($dash_style=='1'){
			    $query_total_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
					LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id 
					where c.value = '$id_login' and c.slug = 'mgo_csid' and a.slug like '%mgo_orderid%' and a.value='$filter_orderid' 
					and d.value LIKE '%cod%' and d.slug='mgo_pembayaran' $formnya  ");

			    $query_closing_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id
					LEFT JOIN $table_name6 as d ON d.order_id = a.value 
					LEFT JOIN $table_name4 as e ON a.entry_id = e.entry_id 
					where c.value = '$id_login' and c.slug = 'mgo_csid' and a.slug like '%mgo_orderid%' and a.value='$filter_orderid' and d.status_id=1 and e.value LIKE '%cod%' and e.slug='mgo_pembayaran' $formnya");

			    $query_rts_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id
					LEFT JOIN $table_name6 as d ON d.order_id = a.value 
					LEFT JOIN $table_name4 as e ON a.entry_id = e.entry_id 
					where c.value = '$id_login' and c.slug = 'mgo_csid' and a.slug like '%mgo_orderid%' and a.value='$filter_orderid' and d.status_rts=1 and e.value LIKE '%cod%' and e.slug='mgo_pembayaran' $formnya");

			    $query_total_closing_cod = $query_closing_cod - $query_rts_cod;
				}



			}

		}elseif($filter_option=='product'){
			if($role=='administrator'){


			    $query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
			    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
			    	LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
			    	LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id 
			    	where a.value LIKE '%$filter_product%' and a.slug = 'mgo_nama_produk' and c.slug = 'mgo_csid' and d.slug LIKE '%mgo_orderid%' $formnya ");

			    $query_total_closing_all = $wpdb->get_var("SELECT COUNT(*) from $table_name6 as a 
					LEFT JOIN $table_name4 as b ON a.order_id = b.value 
					LEFT JOIN $table_name5 as c ON b.entry_id = c.id
					LEFT JOIN $table_name4 as d ON b.entry_id = d.entry_id 
					where d.slug = 'mgo_nama_produk' and d.value like '%$filter_product%' and a.status_id=1 and b.value!='' $formnya ");

			    $query_total_closing_ada_rts = $wpdb->get_var("SELECT COUNT(*) from $table_name6 as a 
					LEFT JOIN $table_name4 as b ON a.order_id = b.value 
					LEFT JOIN $table_name5 as c ON b.entry_id = c.id
					LEFT JOIN $table_name4 as d ON b.entry_id = d.entry_id 
					where d.slug = 'mgo_nama_produk' and d.value like '%$filter_product%' and a.status_rts=1 and b.value!='' $formnya ");

			    $query_total_closing = $query_total_closing_all - $query_total_closing_ada_rts;


			    if($dash_style=='1'){
			    $query_total_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
			    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
			    	LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
			    	LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id 
			    	LEFT JOIN $table_name4 as e ON a.entry_id = e.entry_id 
			    	where a.value LIKE '%$filter_product%' and a.slug = 'mgo_nama_produk' and c.slug = 'mgo_csid' and d.slug LIKE '%mgo_orderid%' and e.value LIKE '%cod%' and e.slug='mgo_pembayaran' $formnya ");

			    $query_closing_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name6 as a 
					LEFT JOIN $table_name4 as b ON a.order_id = b.value 
					LEFT JOIN $table_name5 as c ON b.entry_id = c.id
					LEFT JOIN $table_name4 as d ON b.entry_id = d.entry_id 
					LEFT JOIN $table_name4 as e ON b.entry_id = e.entry_id 
					where d.slug = 'mgo_nama_produk' and d.value like '%$filter_product%' and a.status_id=1 and b.value!='' 
					and e.value LIKE '%cod%' and e.slug='mgo_pembayaran' $formnya ");

			    $query_rts_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name6 as a 
					LEFT JOIN $table_name4 as b ON a.order_id = b.value 
					LEFT JOIN $table_name5 as c ON b.entry_id = c.id
					LEFT JOIN $table_name4 as d ON b.entry_id = d.entry_id 
					LEFT JOIN $table_name4 as e ON b.entry_id = e.entry_id 
					where d.slug = 'mgo_nama_produk' and d.value like '%$filter_product%' and a.status_rts=1 and b.value!='' 
					and e.value LIKE '%cod%' and e.slug='mgo_pembayaran' $formnya ");

			    $query_total_closing_cod = $query_closing_cod - $query_rts_cod;
				}
			    

			}else{

			    $query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
					LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id 
					where a.value LIKE '%$filter_product%' 
					and a.slug = 'mgo_nama_produk' and c.value = '$id_login' and c.slug = 'mgo_csid' and d.slug LIKE '%mgo_orderid%' $formnya ");

			    $query_total_closing_all = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
					LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id
					LEFT JOIN $table_name6 as e ON d.value = e.order_id
					where a.value LIKE '%$filter_product%' 
					and a.slug = 'mgo_nama_produk' 
					and c.value = '$id_login'
					and c.slug = 'mgo_csid'
					and d.slug LIKE '%mgo_orderid%'
					and e.status_id=1 $formnya ");

			    $query_total_closing_ada_rts = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
					LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id
					LEFT JOIN $table_name6 as e ON d.value = e.order_id
					where a.value LIKE '%$filter_product%' 
					and a.slug = 'mgo_nama_produk' 
					and c.value = '$id_login'
					and c.slug = 'mgo_csid'
					and d.slug LIKE '%mgo_orderid%'
					and e.status_rts=1 $formnya ");

			    $query_total_closing = $query_total_closing_all - $query_total_closing_ada_rts;


			    if($dash_style=='1'){
			    $query_total_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
					LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id 
					LEFT JOIN $table_name4 as e ON a.entry_id = e.entry_id 
					where a.value LIKE '%$filter_product%' 
					and a.slug = 'mgo_nama_produk' and c.value = '$id_login' and c.slug = 'mgo_csid' and d.slug LIKE '%mgo_orderid%' 
					and e.value LIKE '%cod%' and e.slug='mgo_pembayaran' $formnya ");

			    $query_closing_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
					LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id
					LEFT JOIN $table_name6 as e ON d.value = e.order_id
			    	LEFT JOIN $table_name4 as f ON a.entry_id = f.entry_id 
					where a.value LIKE '%$filter_product%' 
					and a.slug = 'mgo_nama_produk' 
					and c.value = '$id_login'
					and c.slug = 'mgo_csid'
					and d.slug LIKE '%mgo_orderid%'
					and e.status_id=1 
					and f.value LIKE '%cod%' and f.slug='mgo_pembayaran' $formnya ");

			    $query_rts_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
					LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id
					LEFT JOIN $table_name6 as e ON d.value = e.order_id
					LEFT JOIN $table_name4 as f ON a.entry_id = f.entry_id 
					where a.value LIKE '%$filter_product%' 
					and a.slug = 'mgo_nama_produk' 
					and c.value = '$id_login'
					and c.slug = 'mgo_csid'
					and d.slug LIKE '%mgo_orderid%'
					and e.status_rts=1 
					and f.value LIKE '%cod%' and f.slug='mgo_pembayaran' $formnya ");

			    $query_total_closing_cod = $query_closing_cod - $query_rts_cod;
				}

			}

		}elseif($filter_option=='coupon'){
			if($role=='administrator'){

			    $query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
			    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
			    	LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
			    	LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id 
			    	where a.value LIKE '%$filter_coupon%' 
			    	and a.slug = 'mgo_kupon' 
			    	and c.slug = 'mgo_csid' 
			    	and d.slug LIKE '%mgo_orderid%' $formnya ");

			    $query_total_closing_all = $wpdb->get_var("SELECT COUNT(*) from $table_name6 as a 
					LEFT JOIN $table_name4 as b ON a.order_id = b.value 
					LEFT JOIN $table_name5 as c ON b.entry_id = c.id
					LEFT JOIN $table_name4 as d ON b.entry_id = d.entry_id 
					where d.slug = 'mgo_kupon' and d.value LIKE '%$filter_coupon%' and a.status_id=1 and b.value!='' $formnya ");

			    $query_total_closing_ada_rts = $wpdb->get_var("SELECT COUNT(*) from $table_name6 as a 
					LEFT JOIN $table_name4 as b ON a.order_id = b.value 
					LEFT JOIN $table_name5 as c ON b.entry_id = c.id
					LEFT JOIN $table_name4 as d ON b.entry_id = d.entry_id 
					where d.slug = 'mgo_kupon' and d.value LIKE '%$filter_coupon%' and a.status_rts=1 and b.value!='' $formnya ");

			    $query_total_closing = $query_total_closing_all - $query_total_closing_ada_rts;


			    if($dash_style=='1'){
			    $query_total_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
			    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
			    	LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
			    	LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id  
			    	LEFT JOIN $table_name4 as e ON a.entry_id = e.entry_id 
			    	where a.value LIKE '%$filter_coupon%' 
			    	and a.slug = 'mgo_kupon' 
			    	and c.slug = 'mgo_csid' 
			    	and d.slug LIKE '%mgo_orderid%' 
			    	and e.value LIKE '%cod%' and e.slug='mgo_pembayaran' $formnya ");

			    $query_closing_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name6 as a 
					LEFT JOIN $table_name4 as b ON a.order_id = b.value 
					LEFT JOIN $table_name5 as c ON b.entry_id = c.id
					LEFT JOIN $table_name4 as d ON b.entry_id = d.entry_id  
			    	LEFT JOIN $table_name4 as e ON b.entry_id = e.entry_id 
					where d.slug = 'mgo_kupon' and d.value LIKE '%$filter_coupon%' and a.status_id=1 and b.value!='' 
					and e.value LIKE '%cod%' and e.slug='mgo_pembayaran' $formnya ");

			    $query_rts_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name6 as a 
					LEFT JOIN $table_name4 as b ON a.order_id = b.value 
					LEFT JOIN $table_name5 as c ON b.entry_id = c.id
					LEFT JOIN $table_name4 as d ON b.entry_id = d.entry_id 
					LEFT JOIN $table_name4 as e ON b.entry_id = e.entry_id 
					where d.slug = 'mgo_kupon' and d.value LIKE '%$filter_coupon%' and a.status_rts=1 and b.value!='' 
					and e.value LIKE '%cod%' and e.slug='mgo_pembayaran' $formnya ");

			    $query_total_closing_cod = $query_closing_cod - $query_rts_cod;
				}


			}else{

			    $query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
					LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id 
					where a.value LIKE '%$filter_coupon%' 
					and a.slug = 'mgo_kupon' and c.value = '$id_login' 
					and c.slug = 'mgo_csid' and d.slug LIKE '%mgo_orderid%' $formnya ");

			    $query_total_closing_all = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
					LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id
					LEFT JOIN $table_name6 as e ON d.value = e.order_id
					where a.value LIKE '%$filter_coupon%' 
					and a.slug = 'mgo_kupon' 
					and c.value = '$id_login'
					and c.slug = 'mgo_csid'
					and d.slug LIKE '%mgo_orderid%'
					and e.status_id=1 $formnya ");

			    $query_total_closing_ada_rts = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
					LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id
					LEFT JOIN $table_name6 as e ON d.value = e.order_id
					where a.value LIKE '%$filter_coupon%' 
					and a.slug = 'mgo_kupon' 
					and c.value = '$id_login'
					and c.slug = 'mgo_csid'
					and d.slug LIKE '%mgo_orderid%'
					and e.status_rts=1 $formnya ");

			    $query_total_closing = $query_total_closing_all - $query_total_closing_ada_rts;


			    if($dash_style=='1'){
			    $query_total_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
					LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id 
			    	LEFT JOIN $table_name4 as e ON a.entry_id = e.entry_id 
					where a.value LIKE '%$filter_coupon%' 
					and a.slug = 'mgo_kupon' and c.value = '$id_login' 
					and c.slug = 'mgo_csid' and d.slug LIKE '%mgo_orderid%' 
					and e.value LIKE '%cod%' and e.slug='mgo_pembayaran' $formnya ");

			    $query_closing_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
					LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id
					LEFT JOIN $table_name6 as e ON d.value = e.order_id 
			    	LEFT JOIN $table_name4 as f ON a.entry_id = f.entry_id 
					where a.value LIKE '%$filter_coupon%' 
					and a.slug = 'mgo_kupon' 
					and c.value = '$id_login'
					and c.slug = 'mgo_csid'
					and d.slug LIKE '%mgo_orderid%'
					and e.status_id=1 
					and f.value LIKE '%cod%' and f.slug='mgo_pembayaran' $formnya ");

			    $query_rts_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
					LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id
					LEFT JOIN $table_name6 as e ON d.value = e.order_id 
			    	LEFT JOIN $table_name4 as f ON a.entry_id = f.entry_id 
					where a.value LIKE '%$filter_coupon%' 
					and a.slug = 'mgo_kupon' 
					and c.value = '$id_login'
					and c.slug = 'mgo_csid'
					and d.slug LIKE '%mgo_orderid%'
					and e.status_rts=1 
					and f.value LIKE '%cod%' and f.slug='mgo_pembayaran' $formnya ");

			    $query_total_closing_cod = $query_closing_cod - $query_rts_cod;
				}

			}

		}elseif($filter_option=='name'){
			if($role=='administrator'){

			    $query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
			    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
			    	LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id 
			    	where a.value LIKE '%$filter_name%' 
			    	and a.slug = 'mgo_nama' 
			    	and d.slug LIKE '%mgo_orderid%' $formnya ");

			    $query_total_closing_all = $wpdb->get_var("SELECT COUNT(*) from $table_name6 as a 
					LEFT JOIN $table_name4 as b ON a.order_id = b.value 
					LEFT JOIN $table_name5 as c ON b.entry_id = c.id
					LEFT JOIN $table_name4 as d ON b.entry_id = d.entry_id 
					where d.slug = 'mgo_nama' and d.value like '%$filter_name%' and a.status_id=1 and b.value!='' $formnya ");

			    $query_total_closing_ada_rts = $wpdb->get_var("SELECT COUNT(*) from $table_name6 as a 
					LEFT JOIN $table_name4 as b ON a.order_id = b.value 
					LEFT JOIN $table_name5 as c ON b.entry_id = c.id
					LEFT JOIN $table_name4 as d ON b.entry_id = d.entry_id 
					where d.slug = 'mgo_nama' and d.value like '%$filter_name%' and a.status_rts=1 and b.value!='' $formnya ");

			    $query_total_closing = $query_total_closing_all - $query_total_closing_ada_rts;


			    if($dash_style=='1'){
			    $query_total_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
			    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
			    	LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id 
			    	LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
			    	where a.value LIKE '%$filter_name%' 
			    	and a.slug = 'mgo_nama' 
			    	and d.slug LIKE '%mgo_orderid%' 
			    	and c.value LIKE '%cod%' and c.slug='mgo_pembayaran' $formnya ");

			    $query_closing_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name6 as a 
					LEFT JOIN $table_name4 as b ON a.order_id = b.value 
					LEFT JOIN $table_name5 as c ON b.entry_id = c.id
					LEFT JOIN $table_name4 as d ON b.entry_id = d.entry_id 
			    	LEFT JOIN $table_name4 as e ON b.entry_id = e.entry_id 
					where d.slug = 'mgo_nama' and d.value like '%$filter_name%' and a.status_id=1 and b.value!='' 
					and e.value LIKE '%cod%' and e.slug='mgo_pembayaran' $formnya ");

			    $query_rts_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name6 as a 
					LEFT JOIN $table_name4 as b ON a.order_id = b.value 
					LEFT JOIN $table_name5 as c ON b.entry_id = c.id
					LEFT JOIN $table_name4 as d ON b.entry_id = d.entry_id 
			    	LEFT JOIN $table_name4 as e ON b.entry_id = e.entry_id 
					where d.slug = 'mgo_nama' and d.value like '%$filter_name%' and a.status_rts=1 and b.value!='' 
					and e.value LIKE '%cod%' and e.slug='mgo_pembayaran' $formnya ");

			    $query_total_closing_cod = $query_closing_cod - $query_rts_cod;
				}



			}else{

			    $query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
					LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id 
					where a.value LIKE '%$filter_name%' 
					and a.slug = 'mgo_nama' and c.value = '$id_login' and c.slug = 'mgo_csid' and d.slug LIKE '%mgo_orderid%' $formnya ");

			    $query_total_closing_all = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
					LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id
					LEFT JOIN $table_name6 as e ON d.value = e.order_id
					where a.value LIKE '%$filter_name%' 
					and a.slug = 'mgo_nama' 
					and c.value = '$id_login'
					and c.slug = 'mgo_csid'
					and d.slug LIKE '%mgo_orderid%'
					and e.status_id=1 $formnya
					ORDER BY a.entry_id DESC");

			    $query_total_closing_ada_rts = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
					LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id
					LEFT JOIN $table_name6 as e ON d.value = e.order_id
					where a.value LIKE '%$filter_name%' 
					and a.slug = 'mgo_nama' 
					and c.value = '$id_login'
					and c.slug = 'mgo_csid'
					and d.slug LIKE '%mgo_orderid%'
					and e.status_rts=1 $formnya
					ORDER BY a.entry_id DESC");

			    $query_total_closing = $query_total_closing_all - $query_total_closing_ada_rts;


			    if($dash_style=='1'){
			    $query_total_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
					LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id 
					LEFT JOIN $table_name4 as e ON a.entry_id = e.entry_id 
					where a.value LIKE '%$filter_name%' 
					and a.slug = 'mgo_nama' and c.value = '$id_login' and c.slug = 'mgo_csid' and d.slug LIKE '%mgo_orderid%' 
					and e.value LIKE '%cod%' and e.slug='mgo_pembayaran' $formnya ");

			    $query_closing_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
					LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id
					LEFT JOIN $table_name6 as e ON d.value = e.order_id
					LEFT JOIN $table_name4 as f ON a.entry_id = f.entry_id 
					where a.value LIKE '%$filter_name%' 
					and a.slug = 'mgo_nama' 
					and c.value = '$id_login'
					and c.slug = 'mgo_csid'
					and d.slug LIKE '%mgo_orderid%'
					and e.status_id=1 
					and f.value LIKE '%cod%' and f.slug='mgo_pembayaran' $formnya
					ORDER BY a.entry_id DESC");

			    $query_rts_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
					LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id
					LEFT JOIN $table_name6 as e ON d.value = e.order_id
					LEFT JOIN $table_name4 as f ON a.entry_id = f.entry_id 
					where a.value LIKE '%$filter_name%' 
					and a.slug = 'mgo_nama' 
					and c.value = '$id_login'
					and c.slug = 'mgo_csid'
					and d.slug LIKE '%mgo_orderid%'
					and e.status_rts=1 
					and f.value LIKE '%cod%' and f.slug='mgo_pembayaran' $formnya
					ORDER BY a.entry_id DESC");

			    $query_total_closing_cod = $query_closing_cod - $query_rts_cod;
				}

			}

		}elseif($filter_option=='date'){

			if($role=='administrator'){

				$query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					where a.slug LIKE '%mgo_orderid%'
					and datestamp BETWEEN '$filter_datestart_now' AND '$filter_dateend_now' $formnya ");

			    $query_total_closing_all = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name6 as c ON a.value = c.order_id
					where a.slug LIKE '%mgo_orderid%' and c.status_id=1
					and datestamp BETWEEN '$filter_datestart_now' AND '$filter_dateend_now' $formnya");

			    $query_total_closing_ada_rts = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name6 as c ON a.value = c.order_id
					where a.slug LIKE '%mgo_orderid%' and c.status_rts=1
					and datestamp BETWEEN '$filter_datestart_now' AND '$filter_dateend_now' $formnya");

			    $query_total_closing = $query_total_closing_all - $query_total_closing_ada_rts;

			    // echo '_oke';

			    if($dash_style=='1'){
				$query_total_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id
					where a.slug LIKE '%mgo_orderid%'
					and datestamp BETWEEN '$filter_datestart_now' AND '$filter_dateend_now' 
					and c.value LIKE '%cod%' and c.slug='mgo_pembayaran' $formnya ");

			    $query_closing_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name6 as c ON a.value = c.order_id
					LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id
					where a.slug LIKE '%mgo_orderid%' and c.status_id=1
					and datestamp BETWEEN '$filter_datestart_now' AND '$filter_dateend_now' 
					and d.value LIKE '%cod%' and d.slug='mgo_pembayaran' $formnya");

			    $query_rts_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a
					LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
					LEFT JOIN $table_name6 as c ON a.value = c.order_id
					LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id
					where a.slug LIKE '%mgo_orderid%' and c.status_rts=1
					and datestamp BETWEEN '$filter_datestart_now' AND '$filter_dateend_now' 
					and d.value LIKE '%cod%' and d.slug='mgo_pembayaran' $formnya");

			    $query_total_closing_cod = $query_closing_cod - $query_rts_cod;
				}


			}else{
				

				$query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
			    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
			    	LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
			    	where c.value = '$id_login' and c.slug = 'mgo_csid' and a.slug = 'mgo_orderid' 
			    	and datestamp BETWEEN '$filter_datestart_now' AND '$filter_dateend_now'
			    	$formnya ");

		    	$query_total_closing_all = $wpdb->get_var("SELECT COUNT(*) from $table_name6 as a 
					LEFT JOIN $table_name4 as b ON a.order_id = b.value
					LEFT JOIN $table_name4 as c ON b.entry_id = c.entry_id
					LEFT JOIN $table_name5 as d ON b.entry_id = d.id 
					where a.status_id=1 and b.value!='' and c.slug='mgo_csid' and c.value='$id_login' 
					and datestamp BETWEEN '$filter_datestart_now' AND '$filter_dateend_now'
					$formnya ");

		    	$query_total_closing_ada_rts = $wpdb->get_var("SELECT COUNT(*) from $table_name6 as a 
					LEFT JOIN $table_name4 as b ON a.order_id = b.value
					LEFT JOIN $table_name4 as c ON b.entry_id = c.entry_id
					LEFT JOIN $table_name5 as d ON b.entry_id = d.id 
					where a.status_rts=1 and b.value!='' and c.slug='mgo_csid' and c.value='$id_login' 
					and datestamp BETWEEN '$filter_datestart_now' AND '$filter_dateend_now'
					$formnya ");

		    	$query_total_closing = $query_total_closing_all - $query_total_closing_ada_rts;


		    	if($dash_style=='1'){
				$query_total_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
			    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
			    	LEFT JOIN $table_name4 as c ON a.entry_id = c.entry_id 
					LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id
			    	where c.value = '$id_login' and c.slug = 'mgo_csid' and a.slug = 'mgo_orderid' 
			    	and datestamp BETWEEN '$filter_datestart_now' AND '$filter_dateend_now'
			    	and d.value LIKE '%cod%' and d.slug='mgo_pembayaran' $formnya ");

		    	$query_closing_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name6 as a 
					LEFT JOIN $table_name4 as b ON a.order_id = b.value
					LEFT JOIN $table_name4 as c ON b.entry_id = c.entry_id
					LEFT JOIN $table_name5 as d ON b.entry_id = d.id 
					LEFT JOIN $table_name4 as e ON b.entry_id = e.entry_id
					where a.status_id=1 and b.value!='' and c.slug='mgo_csid' and c.value='$id_login' 
					and datestamp BETWEEN '$filter_datestart_now' AND '$filter_dateend_now'
					and e.value LIKE '%cod%' and e.slug='mgo_pembayaran' $formnya ");

		    	$query_rts_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name6 as a 
					LEFT JOIN $table_name4 as b ON a.order_id = b.value
					LEFT JOIN $table_name4 as c ON b.entry_id = c.entry_id
					LEFT JOIN $table_name5 as d ON b.entry_id = d.id 
					LEFT JOIN $table_name4 as e ON b.entry_id = e.entry_id
					where a.status_rts=1 and b.value!='' and c.slug='mgo_csid' and c.value='$id_login' 
					and datestamp BETWEEN '$filter_datestart_now' AND '$filter_dateend_now'
					and e.value LIKE '%cod%' and e.slug='mgo_pembayaran' $formnya ");

		    	$query_total_closing_cod = $query_closing_cod - $query_rts_cod;
			    }
			}

		}elseif($filter_option=='status'){


			if($role=='administrator'){

					if($filter_statusdate=='alldate'){
						$date_range = '';
					}else{
						$date_range = "and datestamp BETWEEN '$filter_datestartstatus' AND '$filter_dateendstatus'";
					}

					if($filter_status<=1){

						$query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a
							LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
							LEFT JOIN $table_name6 as c ON a.value = c.order_id 
							where a.slug LIKE '%mgo_orderid%' 
							and c.status_id=$filter_status 
							and c.status_rts is NULL 
							$date_range $formnya");

						$query_total_closing = $query_total;


						$query_total_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a
							LEFT JOIN $table_name5 as b ON a.entry_id = b.id 
							LEFT JOIN $table_name6 as c ON a.value = c.order_id 
							LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id
							where a.slug LIKE '%mgo_orderid%' and c.status_id=$filter_status and c.status_rts is NULL 
							and d.value LIKE '%cod%' and d.slug='mgo_pembayaran' $date_range $formnya");

						$query_total_closing_cod = $query_total_cod;


					}else{

						$filter_status2 = $filter_status-1;

						$query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id
							LEFT JOIN $table_name6 as c ON a.value = c.order_id 
							LEFT JOIN $table_name6 as d ON a.value = d.order_id 
					    	where a.slug like '%mgo_orderid%' 
					    	and c.status_id=$filter_status2 and c.status_rts is NULL
					    	and d.status_id=$filter_status
					    	$date_range $formnya ");

						$query_total_closing = $query_total;


					}

			    	

			}else{

					if($filter_statusdate=='alldate'){
						$date_range = '';
					}else{
						$date_range = "and datestamp BETWEEN '$filter_datestartstatus' AND '$filter_dateendstatus'";
					}

					if($filter_status<=1){

						$query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id
							LEFT JOIN $table_name6 as c ON a.value = c.order_id 
					    	LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id 
					    	where d.value = '$id_login' and d.slug = 'mgo_csid'
					    	and a.slug like '%mgo_orderid%' and c.status_id=$filter_status and c.status_rts is NULL
					    	$date_range $formnya ");

						$query_total_closing = $query_total;

						$query_total_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id
							LEFT JOIN $table_name6 as c ON a.value = c.order_id 
					    	LEFT JOIN $table_name4 as d ON a.entry_id = d.entry_id 
							LEFT JOIN $table_name4 as e ON a.entry_id = e.entry_id
					    	where d.value = '$id_login' and d.slug = 'mgo_csid'
					    	and a.slug like '%mgo_orderid%' and c.status_id=$filter_status and c.status_rts is NULL 
					    	and e.value LIKE '%cod%' and e.slug='mgo_pembayaran' 
					    	$date_range $formnya ");

						$query_total_closing_cod = $query_total_cod;

					}else{

						$filter_status2 = $filter_status-1;

						$query_total = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id
							LEFT JOIN $table_name6 as c ON a.value = c.order_id 
							LEFT JOIN $table_name6 as d ON a.value = d.order_id 
					    	LEFT JOIN $table_name4 as e ON a.entry_id = e.entry_id 
					    	where e.value = '$id_login' and e.slug = 'mgo_csid'
					    	and a.slug like '%mgo_orderid%' and c.status_id=$filter_status2 and c.status_rts is NULL 
					    	and d.status_id=$filter_status
					    	$date_range $formnya ");

						$query_total_closing = $query_total;

						$query_total_cod = $wpdb->get_var("SELECT COUNT(*) from $table_name4 as a 
					    	LEFT JOIN $table_name5 as b ON a.entry_id = b.id
							LEFT JOIN $table_name6 as c ON a.value = c.order_id 
							LEFT JOIN $table_name6 as d ON a.value = d.order_id 
					    	LEFT JOIN $table_name4 as e ON a.entry_id = e.entry_id 
							LEFT JOIN $table_name4 as f ON a.entry_id = f.entry_id
					    	where e.value = '$id_login' and e.slug = 'mgo_csid'
					    	and a.slug like '%mgo_orderid%' and c.status_id=$filter_status2 and c.status_rts is NULL 
					    	and d.status_id=$filter_status 
					    	and f.value LIKE '%cod%' and f.slug='mgo_pembayaran' 
					    	$date_range $formnya ");

						$query_total_closing_cod = $query_total_cod;
					}

			   //  	$query_closing = $wpdb->get_results("SELECT count(*) as closing from $table_name6 as a 
						// LEFT JOIN $table_name4 as b ON a.order_id = b.value
						// LEFT JOIN $table_name5 as c ON b.entry_id = c.id 
				  //   	LEFT JOIN $table_name4 as d ON b.entry_id = d.entry_id 
				  //   	where d.value = '$id_login' and d.slug = 'mgo_csid'
						// and a.status_id=$filter_status and b.value!='' 
						// $date_range $formnya ");
			}
		}

	}

	    // JUMLAH CLOSING RATE (CRT)
		if($query_total==null){
			$query_total = 0;
		}
		if($query_total_closing_ada_rts==null){
			$query_total_closing_ada_rts = 0;
		}


	    $jumlah_total = $query_total; // count($query_total);
	    $jumlah_closing = $query_total_closing; //$query_closing[0]->closing;
	    $jumlah_rts = $query_total_closing_ada_rts;

	    if($jumlah_total==0){
	    	$crt_total = 0;
	    }else{
		    $crt_total = ($jumlah_closing/$jumlah_total)*100;
		    $crt_total = number_format($crt_total, 1, '.', '');
		    // explode
		    $pieces_crt = explode(".", $crt_total);
            if($pieces_crt[1]==0){
            	$crt_total = $pieces_crt[0];
            }
		}

		if($jumlah_rts==0){
			$rts_total = 0;
		}else{
			$rts_total = ($jumlah_rts/$jumlah_total)*100;
		    $rts_total = number_format($rts_total, 1, '.', '');
		    // explode
		    $pieces_rts = explode(".", $rts_total);
            if($pieces_rts[1]==0){
            	$rts_total = $pieces_rts[0];
            }
		}
		

		// START COD
		if($query_total_cod!=0){
			$total_cod = ($query_total_cod);
			$total_rts = ($query_rts_cod);
			$total_closing_cod = ($query_total_closing_cod);
			// $total_closing_cod = ($total_closing_cod - $total_rts);
			
			$crt_cod = ($total_closing_cod/$total_cod)*100;
		    $crt_cod = number_format($crt_cod, 1, '.', '');
		    // explode
		    $pieces_crt_cod = explode(".", $crt_cod);
	        if($pieces_crt_cod[1]==0){
	        	$crt_cod = $pieces_crt_cod[0];
	        }

			$rts_cod = ($total_rts/$total_cod)*100;
		    $rts_cod = number_format($rts_cod, 1, '.', '');
		    // explode
		    $pieces_rts_cod = explode(".", $rts_cod);
	        if($pieces_rts_cod[1]==0){
	        	$rts_cod = $pieces_rts_cod[0];
	        }
		}else{
			$total_cod = '0';
			$crt_cod = '0';
			$rts_cod = '0';
		}

		if($crt_cod=='nan'){
			$crt_cod = 0;
		}
		if($rts_cod=='nan'){
			$rts_cod = 0;
		}

		// $total_closing_cod
    	echo $jumlah_total.'_'.$crt_total.'_'.$rts_total.'_'.$total_cod.'_'.$crt_cod.'_'.$rts_cod;

    	// print_r(json_encode($query_closing_cod));

?>