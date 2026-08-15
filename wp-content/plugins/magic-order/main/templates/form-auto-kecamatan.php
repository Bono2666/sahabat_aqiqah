<?php
/**
 * Caldera Forms - PHP Export 
 * Form Auto Kecamatan 
 * @see https://calderaforms.com/doc/exporting-caldera-forms/ 
 * @version    1.8.9
 * @license   GPL-2.0+
 * 
 */


/**
                     * Hooks to load form.
                     * Remove "caldera_forms_admin_forms" if you do not want this form to show in admin entry viewer
                     */
                    add_filter( "caldera_forms_get_forms", "slug_register_caldera_forms_formautokecamatan" );
                    add_filter( "caldera_forms_admin_forms", "slug_register_caldera_forms_formautokecamatan" );
                    /**
                     * Add form to front-end and admin
                     *
                     * @param array $forms All registered forms
                     *
                     * @return array
                     */
                    function slug_register_caldera_forms_formautokecamatan( $forms ) {
                        $forms["form-auto-kecamatan"] = apply_filters( "caldera_forms_get_form-form-auto-kecamatan", array() );
                        return $forms;
                    };

/**
 * Filter form request to include form structure to be rendered
 *
 * @since 1.3.1
 *
 * @param $form array form structure
 */
add_filter( 'caldera_forms_get_form-form-auto-kecamatan', function( $form ){
 return array(
  '_last_updated' => 'Mon, 10 Feb 2020 07:23:33 +0000',
  'ID' => 'form-auto-kecamatan',
  'cf_version' => '1.8.9',
  'name' => 'Form Auto Kecamatan',
  'scroll_top' => 0,
  'success' => 'Form has been successfully submitted. Thank you.																																																																																																																																	',
  'db_support' => 1,
  'pinned' => 0,
  'hide_form' => 1,
  'check_honey' => 1,
  'avatar_field' => '',
  'form_ajax' => 1,
  'custom_callback' => '',
  'layout_grid' => 
  array(
    'fields' => 
    array(
      'mgo_orderid' => '1:1',
      'mgo_csid' => '1:1',
      'mgo_csmail' => '1:1',
      'mgo_nama' => '1:1',
      'mgo_wa' => '1:1',
      'mgo_kecamatan' => '1:1',
      'mgo_nama_produk' => '1:1',
      'mgo_jumlah_barang' => '1:1',
      'mgo_ongkos_kirim' => '1:1',
      'mgo_diskon' => '1:1',
      'mgo_biaya_cod' => '1:1',
      'mgo_pembayaran' => '1:1',
      'mgo_total' => '1:1',
      'submit' => '1:1',
      'followup1' => '1:1',
    ),
    'structure' => '12',
  ),
  'fields' => 
  array(
    'mgo_orderid' => 
    array(
      'ID' => 'mgo_orderid',
      'type' => 'text',
      'label' => 'Order ID',
      'slug' => 'mgo_orderid',
      'conditions' => 
      array(
        'type' => '',
      ),
      'caption' => '',
      'config' => 
      array(
        'custom_class' => 'mgo_orderid',
        'placeholder' => '',
        'default' => '',
        'type_override' => 'text',
        'mask' => '',
        'email_identifier' => 0,
        'personally_identifying' => 0,
      ),
    ),
    'mgo_csid' => 
    array(
      'ID' => 'mgo_csid',
      'type' => 'hidden',
      'label' => 'CS ID',
      'slug' => 'mgo_csid',
      'conditions' => 
      array(
        'type' => '',
      ),
      'caption' => '',
      'config' => 
      array(
        'custom_class' => 'mgo_csid',
        'default' => '',
        'email_identifier' => 0,
        'personally_identifying' => 0,
      ),
    ),
    'mgo_csmail' => 
    array(
      'ID' => 'mgo_csmail',
      'type' => 'hidden',
      'label' => 'CS MAIL',
      'slug' => 'mgo_csmail',
      'conditions' => 
      array(
        'type' => '',
      ),
      'caption' => '',
      'config' => 
      array(
        'custom_class' => 'mgo_csmail',
        'default' => '',
        'email_identifier' => 0,
        'personally_identifying' => 0,
      ),
    ),
    'mgo_nama' => 
    array(
      'ID' => 'mgo_nama',
      'type' => 'text',
      'label' => 'Nama',
      'slug' => 'mgo_nama',
      'conditions' => 
      array(
        'type' => '',
      ),
      'required' => 1,
      'caption' => '',
      'config' => 
      array(
        'custom_class' => 'mgo_nama font_red',
        'placeholder' => '',
        'default' => '',
        'type_override' => 'text',
        'mask' => '',
        'email_identifier' => 0,
        'personally_identifying' => 0,
      ),
    ),
    'mgo_wa' => 
    array(
      'ID' => 'mgo_wa',
      'type' => 'text',
      'label' => 'WA Number',
      'slug' => 'mgo_wa',
      'conditions' => 
      array(
        'type' => '',
      ),
      'required' => 1,
      'caption' => 'Masukkan Whatsapp aktif anda untuk mendapatkan Auto Notifikasi WA',
      'config' => 
      array(
        'custom_class' => 'mgo_wa',
        'placeholder' => '',
        'default' => '',
        'type_override' => 'tel',
        'mask' => '',
        'email_identifier' => 0,
        'personally_identifying' => 0,
      ),
    ),
    'mgo_kecamatan' => 
    array(
      'ID' => 'mgo_kecamatan',
      'type' => 'text',
      'label' => 'Kecamatan',
      'slug' => 'mgo_kecamatan',
      'conditions' => 
      array(
        'type' => '',
      ),
      'required' => 1,
      'caption' => '',
      'entry_list' => 1,
      'config' => 
      array(
        'custom_class' => 'mgo_kecamatan_auto',
        'placeholder' => 'Contoh: Gedebage, Bandung, Jawa Barat',
        'default' => '',
        'type_override' => 'text',
        'mask' => '',
        'email_identifier' => 0,
        'personally_identifying' => 0,
      ),
    ),
    'mgo_nama_produk' => 
    array(
      'ID' => 'mgo_nama_produk',
      'type' => 'radio',
      'label' => 'Produk',
      'slug' => 'mgo_nama_produk',
      'conditions' => 
      array(
        'type' => '',
      ),
      'required' => 1,
      'caption' => '',
      'config' => 
      array(
        'custom_class' => 'mgo_harga_barang',
        'default_option' => '',
        'auto_type' => '',
        'taxonomy' => 'category',
        'post_type' => 'post',
        'value_field' => 'name',
        'orderby_tax' => 'name',
        'orderby_post' => 'name',
        'order' => 'ASC',
        'default' => '',
        'show_values' => 1,
        'option' => 
        array(
          'opt1459364' => 
          array(
            'calc_value' => 100000,
            'value' => 'Black Panther Merah',
            'label' => 'Black Panther Merah - Rp100,000',
          ),
          'opt1944228' => 
          array(
            'calc_value' => 120000,
            'value' => 'Black Panther Biru',
            'label' => 'Black Panther Biru - Rp120,000',
          ),
          'opt1763539' => 
          array(
            'calc_value' => 150000,
            'value' => 'Black Panther Hitam',
            'label' => 'Black Panther Hitam - Rp150,000',
          ),
        ),
        'email_identifier' => 0,
        'personally_identifying' => 0,
      ),
    ),
    'mgo_jumlah_barang' => 
    array(
      'ID' => 'mgo_jumlah_barang',
      'type' => 'dropdown',
      'label' => 'Jumlah',
      'slug' => 'mgo_jumlah_barang',
      'conditions' => 
      array(
        'type' => '',
      ),
      'required' => 1,
      'caption' => '',
      'config' => 
      array(
        'custom_class' => 'mgo_jumlah_barang',
        'placeholder' => '',
        'default_option' => '',
        'auto_type' => '',
        'taxonomy' => 'category',
        'post_type' => 'post',
        'value_field' => 'name',
        'orderby_tax' => 'name',
        'orderby_post' => 'name',
        'order' => 'ASC',
        'default' => '',
        'show_values' => 1,
        'option' => 
        array(
          'opt1305143' => 
          array(
            'calc_value' => 1,
            'value' => '1 Buah',
            'label' => '1 Buah',
          ),
          'opt1121055' => 
          array(
            'calc_value' => 2,
            'value' => '2 Buah',
            'label' => '2 Buah',
          ),
          'opt1988183' => 
          array(
            'calc_value' => 3,
            'value' => '3 Buah',
            'label' => '3 Buah',
          ),
          'opt1546025' => 
          array(
            'calc_value' => 4,
            'value' => '4 Buah',
            'label' => '4 Buah',
          ),
        ),
        'email_identifier' => 0,
        'personally_identifying' => 0,
      ),
    ),
    'mgo_ongkos_kirim' => 
    array(
      'ID' => 'mgo_ongkos_kirim',
      'type' => 'radio',
      'label' => 'Biaya Ongkos Kirim',
      'slug' => 'mgo_ongkos_kirim',
      'conditions' => 
      array(
        'type' => '',
      ),
      'caption' => '',
      'entry_list' => 1,
      'config' => 
      array(
        'custom_class' => 'mgo_ongkoskirim',
        'default_option' => '',
        'auto_type' => '',
        'taxonomy' => 'category',
        'post_type' => 'post',
        'value_field' => 'name',
        'orderby_tax' => 'name',
        'orderby_post' => 'name',
        'order' => 'ASC',
        'default' => '',
        'email_identifier' => 0,
        'personally_identifying' => 0,
      ),
    ),
    'mgo_biaya_cod' => 
    array(
      'ID' => 'mgo_biaya_cod',
      'type' => 'text',
      'label' => 'Biaya COD 1.5%',
      'slug' => 'mgo_biaya_cod',
      'conditions' => 
      array(
        'type' => '',
      ),
      'caption' => '',
      'config' => 
      array(
        'custom_class' => 'mgo_addcost_persen',
        'placeholder' => 1.5,
        'default' => '',
        'type_override' => 'text',
        'mask' => '',
        'email_identifier' => 0,
        'personally_identifying' => 0,
      ),
    ),
    'mgo_pembayaran' => 
    array(
      'ID' => 'mgo_pembayaran',
      'type' => 'radio',
      'label' => 'Metode Pembayaran',
      'slug' => 'mgo_pembayaran',
      'conditions' => 
      array(
        'type' => '',
      ),
      'required' => 1,
      'caption' => '',
      'config' => 
      array(
        'custom_class' => 'mgo_pembayaran',
        'inline' => 1,
        'default_option' => '',
        'auto_type' => '',
        'taxonomy' => 'category',
        'post_type' => 'post',
        'value_field' => 'name',
        'orderby_tax' => 'name',
        'orderby_post' => 'name',
        'order' => 'ASC',
        'default' => '',
        'show_values' => 1,
        'option' => 
        array(
          'opt1250869' => 
          array(
            'calc_value' => 0,
            'value' => 'Bank No Rek. 777-999-1111-98 a.n RIDWAN',
            'label' => '<div class="mandiri [pos] [diskon=50000]"></div>',
          ),
          'opt2037166' => 
          array(
            'calc_value' => 0,
            'value' => 'Bank BCA No Rek. 444-999-1111-98 a.n RIDWAN',
            'label' => '<div class="bca [j&t]"></div>',
          ),
          'opt1488737' => 
          array(
            'calc_value' => 0,
            'value' => 'Alfamart 111-999-1111-98 a.n RIDWAN',
            'label' => '<div class="alfamart [pos]"></div>',
          ),
          'opt1179382' => 
          array(
            'calc_value' => 0,
            'value' => 'COD mantap',
            'label' => '<div class="cod_hand [ninja]"></div>',
          ),
          'opt1927862' => 
          array(
            'calc_value' => '',
            'value' => 'cod 2',
            'label' => '<div class="cod_hand2 [indah]"></div>',
          ),
          'opt1226849' => 
          array(
            'calc_value' => '',
            'value' => 'cod 3',
            'label' => '<div class="cod_truck [tiki]"></div>',
          ),
          'opt1608479' => 
          array(
            'calc_value' => '',
            'value' => 'cod 4',
            'label' => '<div class="cod_truck2 [pandu]"></div>',
          ),
          'opt1483728' => 
          array(
            'calc_value' => '',
            'value' => 'transfer',
            'label' => '<div class="transfer [esl]"></div>',
          ),
        ),
        'email_identifier' => 0,
        'personally_identifying' => 0,
      ),
    ),
    'mgo_total' => 
    array(
      'ID' => 'mgo_total',
      'type' => 'text',
      'label' => 'Total',
      'slug' => 'mgo_total',
      'conditions' => 
      array(
        'type' => '',
      ),
      'caption' => '',
      'config' => 
      array(
        'custom_class' => 'mgo_total',
        'placeholder' => '',
        'default' => '',
        'type_override' => 'text',
        'mask' => '',
        'email_identifier' => 0,
        'personally_identifying' => 0,
      ),
    ),
    'submit' => 
    array(
      'ID' => 'submit',
      'type' => 'button',
      'label' => ' Kirim ke CS',
      'slug' => 'submit',
      'conditions' => 
      array(
        'type' => '',
      ),
      'caption' => '',
      'config' => 
      array(
        'custom_class' => 'btn_buy large',
        'type' => 'submit',
        'class' => 'btn btn-default',
        'target' => '',
      ),
    ),
    'followup1' => 
    array(
      'ID' => 'followup1',
      'type' => 'hidden',
      'label' => 'Followup',
      'slug' => 'followup1',
      'conditions' => 
      array(
        'type' => '',
      ),
      'caption' => '',
      'config' => 
      array(
        'custom_class' => 'followup1',
        'default' => '',
        'email_identifier' => 0,
        'personally_identifying' => 0,
      ),
    ),
    'mgo_diskon' => 
    array(
      'ID' => 'mgo_diskon',
      'type' => 'text',
      'label' => 'Diskon',
      'slug' => 'mgo_diskon',
      'conditions' => 
      array(
        'type' => '',
      ),
      'caption' => '',
      'config' => 
      array(
        'custom_class' => 'mgo_diskon',
        'placeholder' => '',
        'default' => '',
        'type_override' => 'text',
        'mask' => '',
        'email_identifier' => 0,
        'personally_identifying' => 0,
      ),
    ),
  ),
  'page_names' => 
  array(
    0 => 'Page 1',
  ),
  'mailer' => 
  array(
    'sender_name' => 'Caldera Forms Notification',
    'sender_email' => 'halo@sinkronus.com',
    'reply_to' => '%mgo_email%',
    'email_type' => 'html',
    'recipients' => '%mgo_email%',
    'bcc_to' => 'halo.sinkronus@gmail.com',
    'email_subject' => '',
    'email_message' => '{summary}',
  ),
  'conditional_groups' => 
  array(
    'conditions' => 
    array(
      'con_3072287981968496' => 
      array(
        'id' => 'con_3072287981968496',
        'name' => 'Produk 1',
        'type' => 'show',
        'group' => 
        array(
          'rw5489277837990571' => 
          array(
            'cl7396271918310712' => 
            array(
              'parent' => 'rw5489277837990571',
              'field' => 'mgo_nama',
              'compare' => 'contains',
              'value' => '',
            ),
          ),
        ),
        'fields' => 
        array(
          'cl7396271918310712' => 'mgo_nama',
        ),
      ),
    ),
  ),
  'settings' => 
  array(
    'responsive' => 
    array(
      'break_point' => 'sm',
    ),
  ),
  'privacy_exporter_enabled' => false,
  'version' => '1.8.9',
  'db_id' => '255',
  'type' => 'primary',
  '_external_form' => 1,
);
} );
