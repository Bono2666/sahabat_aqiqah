<?php

function magic_order_data() {

    if(isset($_GET['opt'])){
        if($_GET['opt']=="pickup"){
            $pickup = true;
        }else{
            $pickup = false;
        }
    }else{
        $pickup = false;
    }

    mgo_global_vars();
    global $wpdb;
    
    $expired = $GLOBALS['mgovars']['expired'];
    $date_expired = $GLOBALS['mgovars']['date_expired'];
    $plugin_name = $GLOBALS['mgovars']['plugin_name'];
    $plugin_version = $GLOBALS['mgovars']['plugin_version'];
    $plugin_license = $GLOBALS['mgovars']['plugin_license'];
    $apikey = $GLOBALS['mgovars']['apikey'];
    $apikey_status = $GLOBALS['mgovars']['apikey_status'];

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

    }

    
?>

<?php if($pickup==true){ ?>
    <?php
        require_once(ROOTDIR . 'main/mgo-data-pickup.php');
        wp_die();
    ?>
<?php }else{ ?>
    <?php
        require_once(ROOTDIR . 'main/mgo-data-order.php');
        wp_die();
    ?>


<?php } // end of opt data-order ?> 



    <?php
}

?>