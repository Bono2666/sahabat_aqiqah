<?php

function magic_order_lr() {
    mgo_global_vars();
    $expired = $GLOBALS['mgovars']['expired'];
    $date_expired = $GLOBALS['mgovars']['date_expired'];
    $plugin_name = $GLOBALS['mgovars']['plugin_name'];
    $plugin_version = $GLOBALS['mgovars']['plugin_version'];
    $plugin_license = $GLOBALS['mgovars']['plugin_license'];
    $apikey = $GLOBALS['mgovars']['apikey'];
    $apikey_status = $GLOBALS['mgovars']['apikey_status'];

    global $wpdb;
    $table_name = $wpdb->prefix . "mgo_gf_entry_values";
    $table_name2 = $wpdb->prefix . "mgo_lr";
    $table_name3 = $wpdb->prefix . "mgo_lr_log";
    $table_name4 = $wpdb->prefix . "mgo_settings";


    // GET GENERAL SETTINGS

    // $query = $wpdb->get_results("SELECT * FROM $table_name where gf_custom_class='mgo_orderid' ");
    $query2 = $wpdb->get_results("SELECT * FROM $table_name2 order by id ASC ");
    $query = $wpdb->get_results('SELECT data from '.$table_name4.' where type="l_rotator" ORDER BY id ASC');
    $l_rotator = $query[0]->data;

?>

<!-- plugins:css -->

    <link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/rui/vendors/iconfonts/mdi/css/materialdesignicons.css">
    <link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/rui/vendors/css/vendor.addons.css">
    <!-- endinject -->
    <!-- vendor css for this page -->
    <link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/rui/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <!-- End vendor css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/rui/css/shared/style.css">
    <!-- endinject -->
    <!-- Layout style -->
    <link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/rui/css/demo_1/style.css">
    <style>
    	#wpbody {
    		padding-right: 25px;
			padding-left: 5px;
    	}
    	.t-header-content-wrapper {
    		padding-right: 10px !important;
    		padding-left: 0 !important;
        background: #fff !important;border-radius: 4px;box-shadow: 0 0 10px 0px rgb(207, 225, 231);
    	}
    	body, .row, .t-header {
    		background: #F0F6F8 !important;
    	}
    	.t-header {
    		margin-top: 20px;
			margin-bottom: 0px;
    	}
    	#current-circle-progress .circle-progress-value {
    		top: 25%;
    	}
    	.grid {
			box-shadow: 0 0 10px 0px rgb(207, 225, 231);
			border:none;
		}
		.grid-body .row {
			background: #fff !important;
		}
		ol.breadcrumb {
			margin-left: 0;
			margin-bottom: 0;
			background: transparent;
		}
		.breadcrumb.has-arrow .breadcrumb-item::before {
			content: '';
		}
		.update-nag {
			display: none;
		}
		hr {
			border-top: 1px solid rgb(227, 234, 237);
		}
		.equel-grid {
    		display: block !important;
		}
		canvas#sales-conversion {
			height: 72px !important;
		}
		select.custom-select {
			border: 1px solid #ced4da;
			height: 32px;
		}
		.custom-select {
			-webkit-appearance: menulist;
			-moz-appearance: menulist;
			appearance: menulist;
		}
    .t-header .t-header-content-wrapper .t-header-content .nav .nav-item:last-child .nav-link {
      padding-right: 20px;
    }
    </style>
    <style>
    .accordion a{margin-top:20px;position:relative;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;flex-direction:column;width:99%;padding:1rem 0rem 1rem 0rem;color:#7288a2;font-size:0.9rem;font-weight:400;border-bottom:1px solid #e5e5e5}.accordion a:hover,.accordion a:hover::after{cursor:pointer;color:#03b5d2}.accordion a:hover::after{border:1px solid #03b5d2}.accordion a.active{color:#03b5d2;border-bottom:1px solid #03b5d2;height: 20px;}.accordion a::after{content:"+";position:absolute;float:right;right:1rem;font-size:1rem;color:#7288a2;padding:5px;padding-top:5px;width:23px;height:22px;-webkit-border-radius:50%;-moz-border-radius:50%;border-radius:50%;border:1px solid #7288a2;text-align:center;padding-top:5px;margin-top:-10px;margin-right: -10px;}.accordion a.active::after{font-family:"Ionicons";content:"-";padding-top:7px;color:#03b5d2;border:1px solid #03b5d2}.accordion .content{display:none;padding:1rem;border-bottom:1px solid #e5e5e5;overflow:hidden}.accordion .content p{font-size:1rem;font-weight:300}
    @media only screen and (max-width:480px) {
        .wrap-container {
            padding-left:30px !important;
        }
        canvas#chart2 {
            width: 247px !important;
            height: 123px !important;
        }
        .wrap {
            padding:0;
        }
    </style>
  <link type="text/css" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/style-admin.css?ver=<?php echo $plugin_version; ?>" rel="stylesheet" />

  <div class="wrap">
    <h2 class="title"><img class="icon-title" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/magic-order-icon.png">
    <div class="main-title" style="margin-top: -30px;"><?php echo $plugin_name; ?><div style="font-size: 11px;margin-top: -10px;color:#A0C9D7;">Version <?php echo $plugin_version; ?></div></div></h2>
  </div>





    <hr style="margin-top: 15px;">

    <?php
    if(isset($_GET['opt'])){

      if($_GET['opt']=="edit"){ ?>

        <?php

        if($_GET['data']!=null){
          $id = $_GET['data'];
          // return true;
          // echo 1;
          if(is_numeric($_GET['data'])){
              $query3 = $wpdb->get_results('SELECT * from '.$table_name2.' where id="'.$id.'"');
              $lr_name = $query3[0]->lr_name;
              $lr_code = $query3[0]->lr_code;
              $lr_link = $query3[0]->lr_link;
              $lr_priority =  json_decode($query3[0]->lr_priority);
          }else{
            $newURL = admin_url('admin.php?page=magic_order_lr');
            header("Location: $newURL");
            exit();
          }

        }else{
          // return false;
          // echo '<h3>No Data.</h3>';
          $newURL = admin_url('admin.php?page=magic_order_lr');
          header("Location: $newURL");
          exit();
        }

        ?>

        <!-- edit here -->
        <div class="row">
          <div class="col-md-6 order-md-1">
            <div class="row" style="padding-left: 15px;padding-top: 10px;">
              <div class="col-md-12" style="text-align: left;padding-top: 5px;color: #4b4b4b;">
                <span><p style="font-size: 18px;"><a href="<?php echo admin_url('admin.php?page=magic_order_lr') ?>">Link Rotator </a> > Add New</p></span>
              </div>
            </div>
          </div>
        </div>
        <hr style="visibility: hidden;">
        <div class="page-content-wrapper">
            <div class="page-content-wrapper-inner">
              <div class="content-viewport">

                <div class="row">
                  <div class="col-md-12 equel-grid">


                    <div class="grid">
                      <p class="grid-header">Edit Link Rotator</p>
                      <div class="grid-body">
                        <div class="item-wrapper">
                          <div class="row mb-3">
                            <div class="col-md-9 mx-auto">
                              
                              <div class="form-group row showcase_row_area">
                                <div class="col-md-3 showcase_text_area">
                                  <label for="inputType1">Link Rotator Name</label>
                                </div>
                                <div class="col-md-7 showcase_content_area">
                                  <input type="text" class="form-control" id="input_name" value="<?php echo $lr_name; ?>">
                                </div>
                              </div>
                              
                              <div class="form-group row showcase_row_area">
                                <div class="col-md-3 showcase_text_area">
                                  <label for="inputType1">Link Code</label>
                                </div>
                                <div class="col-md-7 showcase_content_area">
                                  <input type="text" class="form-control" id="input_link_code" value="<?php echo $lr_code; ?>" placeholder="Misal: xyz atau link-pesanan-anda">
                                </div>
                              </div>
                              
                              <div class="form-group row showcase_row_area">
                                <div class="col-md-3 showcase_text_area">
                                  <label for="inputType1">Link Rotator</label>
                                </div>
                                <div class="col-md-9 showcase_content_area">
                                  <p style="color: #4d8af0;padding-top: 3px;"><?php echo get_site_url().'/'.$l_rotator.'/';?><span id="link_code"><?php echo $lr_code; ?></span></p>
                                </div>
                              </div>
                              
                              <div class="form-group row showcase_row_area div_link">
                                <!-- link -->
                                <div class="col-md-3 showcase_text_area">
                                  <label for="inputType1">Link</label>
                                </div>
                                <div class="col-md-9 showcase_content_area">
                                  <p style="font-size: 12px;color: #666;padding-top: 3px;">Silahkan tambahkan link yang akan dirotasi pada kolom dibawah</p>
                                </div>
                                <!-- end link -->

                                <?php

                                $fields = json_decode($lr_link, true);

                                

                                if(!empty($fields))
                                {
                                    // // get total 
                                    $x = 0;
                                    $total_priority = 0;
                                    foreach ($fields as $key => $value ) {
                                        $y = "link_$x";
                                        $angka_priority = $lr_priority->$y;
                                        $total_priority = $total_priority + $angka_priority;
                                        $x++;
                                    }


                                    $i = 0;
                                    $len = count($fields);
                                    foreach ($fields as $key => $value ) {

                                      $a = "link_$i";
                                      $angka_priority = $lr_priority->$a;

                                      $persen_priority = ($angka_priority/$total_priority)*100;

                                      ?>

                                      <!-- link -->
                                      <?php $rand_id = GenerateID(3);?>
                                      <div class="col-md-3 showcase_text_area <?php echo $rand_id; ?>">
                                        <div class="hasil_persen persen_<?php echo $rand_id; ?>" data-id="<?php echo $rand_id; ?>" style="font-size: 11px;padding-top: 11px;color: #F04D82; font-weight:bold;"><?php echo number_format($persen_priority, 1, '.', '');?>%</div>
                                      </div>
                                      <div class="col-md-3 showcase_content_area <?php echo $rand_id; ?>" style="margin-top: 5px;">
                                        <input type="text" class="form-control link_name" value="<?php echo $key; ?>" placeholder="Link name" title="Nama Link">
                                      </div>
                                      <div class="col-md-4 showcase_content_area <?php echo $rand_id; ?>" style="margin-top: 5px;">
                                        <input type="text" class="form-control link_destination" value="<?php echo $value; ?>" placeholder="Paste your link" title="Link Tujuan">
                                      </div>
                                      <div class="col-md-1 showcase_content_area <?php echo $rand_id; ?>" style="margin-top: 5px;">
                                        <select class="custom-select link_priority" onclick="run_persen()" title="Priority">
                                          <?php
                                            for($c=1; $c <= 10; $c++) {
                                                $selected = '';
                                                if($c==$angka_priority){
                                                  $selected = 'selected';
                                                }
                                                echo '<option data-id="'.$rand_id.'" value="'.$c.'" '.$selected.'>'.$c.'</option>';
                                            }
                                          ?>
                                        </select>
                                      </div>
                                      <div class="col-md-1 showcase_content_area <?php echo $rand_id; ?>" style="margin-top: 5px;">
                                        <div class="btn btn-outline-primary" title="Hapus Link" onclick="del('<?php echo $rand_id; ?>')" style="height: 35px;">-</div>
                                      </div>
                                      <!-- end link -->


                                      <?php
                                        $i++;
                                    }
                                }

                                ?>
                               
                              </div>
                              
                              

                              <div class="form-group row showcase_row_area">
                                <div class="col-md-3 showcase_text_area">
                                  <label for="inputType1"></label>
                                </div>
                                <div class="col-md-9 showcase_content_area">
                                  <div class="btn btn-outline-primary add_link" style="height: 35px;">ADD LINK</div>
                                </div>
                              </div>

                              <hr>

                              <div class="form-group row showcase_row_area">
                                <div class="col-md-3 showcase_text_area">
                                  <label for="inputType1"></label>
                                </div>
                                <div class="col-md-9 showcase_content_area">
                                   <div class="btn btn-info btn-rounded" id="update_link" data-id="<?php echo $id; ?>">UPDATE LINK</div>
                                   <span id="success_info2"></span>
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>


                  </div>
                </div>
              </div>
            </div>
            <!-- content viewport ends -->
        </div>

        <!-- end edit  -->


      
      <?php }elseif($_GET['opt']=="add"){ ?>

        <!-- add here -->
        <div class="row">
          <div class="col-md-6 order-md-1">
            <div class="row" style="padding-left: 15px;padding-top: 10px;">
              <div class="col-md-12" style="text-align: left;padding-top: 5px;color: #4b4b4b;">
                <span><p style="font-size: 18px;"><a href="<?php echo admin_url('admin.php?page=magic_order_lr') ?>">Link Rotator </a> > Add New</p></span>
              </div>
            </div>
          </div>
        </div>
        <hr style="visibility: hidden;">
        <div class="page-content-wrapper">
            <div class="page-content-wrapper-inner">
              <div class="content-viewport">

                <div class="row">
                  <div class="col-md-12 equel-grid">


                    <div class="grid">
                      <p class="grid-header">Add New Link Rotator</p>
                      <div class="grid-body">
                        <div class="item-wrapper">
                          <div class="row mb-3">
                            <div class="col-md-9 mx-auto">
                              
                              <div class="form-group row showcase_row_area">
                                <div class="col-md-3 showcase_text_area">
                                  <label for="inputType1">Link Rotator Name</label>
                                </div>
                                <div class="col-md-7 showcase_content_area">
                                  <input type="text" class="form-control" id="input_name" value="">
                                </div>
                              </div>
                              
                              <div class="form-group row showcase_row_area">
                                <div class="col-md-3 showcase_text_area">
                                  <label for="inputType1">Link Code</label>
                                </div>
                                <div class="col-md-7 showcase_content_area">
                                  <input type="text" class="form-control" id="input_link_code" value="" placeholder="Misal: xyz atau link-pesanan-anda">
                                </div>
                              </div>
                              
                              <div class="form-group row showcase_row_area">
                                <div class="col-md-3 showcase_text_area">
                                  <label for="inputType1">Link Rotator</label>
                                </div>
                                <div class="col-md-9 showcase_content_area">
                                  <p style="color: #4d8af0;padding-top: 3px;"><?php echo get_site_url().'/'.$l_rotator.'/';?><span id="link_code"></span></p>
                                </div>
                              </div>
                              
                              <div class="form-group row showcase_row_area div_link">
                                <!-- link -->
                                <div class="col-md-3 showcase_text_area">
                                  <label for="inputType1">Link</label>
                                </div>
                                <div class="col-md-9 showcase_content_area">
                                  <p style="font-size: 12px;color: #666;padding-top: 3px;">Silahkan tambahkan link yang akan dirotasi pada kolom dibawah</p>
                                </div>
                                <!-- end link -->
                               
                                <!-- link -->
                                <?php $rand_id = GenerateID(3);?>
                                <div class="col-md-3 showcase_text_area <?php echo $rand_id; ?>">
                                  <div class="hasil_persen persen_<?php echo $rand_id; ?>" data-id="<?php echo $rand_id; ?>" style="font-size: 11px;padding-top: 11px;color: #F04D82; font-weight:bold;">100%</div>
                                </div>
                                <div class="col-md-3 showcase_content_area <?php echo $rand_id; ?>" style="margin-top: 5px;">
                                  <input type="text" class="form-control link_name" value="" placeholder="Link name" title="Nama Link">
                                </div>
                                <div class="col-md-4 showcase_content_area <?php echo $rand_id; ?>" style="margin-top: 5px;">
                                  <input type="text" class="form-control link_destination" value="" placeholder="Paste your link" title="Link Tujuan">
                                </div>
                                <div class="col-md-1 showcase_content_area <?php echo $rand_id; ?>" style="margin-top: 5px;">
                                  <select class="custom-select link_priority" onclick="run_persen()" title="Priority">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                  </select>
                                </div>
                                <div class="col-md-1 showcase_content_area <?php echo $rand_id; ?>" style="margin-top: 5px;">
                                  <div class="btn btn-outline-primary" title="Hapus Link" onclick="del('<?php echo $rand_id; ?>')" style="height: 35px;">-</div>
                                </div>
                                <!-- end link -->

                              </div>
                              
                              

                              <div class="form-group row showcase_row_area">
                                <div class="col-md-3 showcase_text_area">
                                  <label for="inputType1"></label>
                                </div>
                                <div class="col-md-9 showcase_content_area">
                                  <div class="btn btn-outline-primary add_link" style="height: 35px;">ADD LINK</div>
                                </div>
                              </div>

                              <hr>

                              <div class="form-group row showcase_row_area">
                                <div class="col-md-3 showcase_text_area">
                                  <label for="inputType1"></label>
                                </div>
                                <div class="col-md-9 showcase_content_area">
                                   <div class="btn btn-info btn-rounded" id="save_link">SAVE LINK</div>
                                   <span id="success_info"></span>
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>


                  </div>
                </div>
              </div>
            </div>
            <!-- content viewport ends -->
        </div>

        <!-- end add  -->

        <!-- start statistic -->
      
      <?php }elseif($_GET['opt']=="statistic"){ ?>


        <!-- add here -->
        <div class="row">
          <div class="col-md-6 order-md-1">
            <div class="row" style="padding-left: 15px;padding-top: 10px;">
              <div class="col-md-12" style="text-align: left;padding-top: 5px;color: #4b4b4b;">
                <span><p style="font-size: 18px;"><a href="<?php echo admin_url('admin.php?page=magic_order_lr') ?>">Link Rotator </a> > Statistic</p></span>
              </div>
            </div>
          </div>
        </div>
        <hr style="visibility: hidden;">

        <?php

        if(isset($_GET['id'])){

          $id = $_GET['id'];
          // return true;
          // echo 1;
          if(is_numeric($_GET['id'])){
              $query3 = $wpdb->get_results('SELECT * from '.$table_name2.' where id="'.$id.'"');
              $lr_name = $query3[0]->lr_name;
              $lr_code = $query3[0]->lr_code;
              $lr_link = $query3[0]->lr_link;
              $lr_priority =  json_decode($query3[0]->lr_priority);
          }

          $full_link = "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

          $active_link_today = '';
          $active_link_all = '';
          $active_link_date = '';
          $title_stat = '';

          if($_GET['filter']=='today'){
            $active_link_today = 'style="background: #e4eefd;color: #4d8af0;"';
            $active_link_all = '';
            $active_link_date = '';
            $title_stat = 'Today Logs - ';

          }else if($_GET['filter']=='all'){
            $active_link_today = '';
            $active_link_all = 'style="background: #e4eefd;color: #4d8af0;"';
            $active_link_date = '';
            $title_stat = 'All Logs - ';
          }else{
            $active_link_today = '';
            $active_link_all = '';
            $active_link_date = 'style="background: #e4eefd;color: #4d8af0;"';
            $title_stat = 'Date range - ';
          }

         
          
        { ?>

          <div class="page-content-wrapper">
            <div class="page-content-wrapper-inner">
              <div class="content-viewport">

                <div class="row">
                  <div class="col-md-12 equel-grid">

  
                    <div class="grid">
                      <div class="btn-group" style="float: right;margin-top: 30px;margin-right: 30px;">
                          <button type="button" class="btn btn-inverse-primary btn-sm has-icon dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-settings"></i>Filter</button>
                          <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
                            <a class="dropdown-item" href="<?php echo $full_link; ?>&filter=today" <?php echo $active_link_today; ?>>Today</a>
                            <a class="dropdown-item" href="<?php echo $full_link; ?>&filter=all" <?php echo $active_link_all; ?>>All Logs</a>
                            <a class="dropdown-item filter_date" href="#" <?php echo $active_link_date; ?>>Date Range</a>
                          </div>
                      </div>
                      <!-- <p class="grid-header">Statistic <?php echo $lr_name; ?></p> -->
                      <div class="grid-body">
                        <div class="item-wrapper">
                          <div class="row mb-3">
                            <div class="col-md-9 mx-auto">
                              <!-- <div class="col-md-6"> -->
                                <div class="grid" style="box-shadow: none;">
                                  <div class="grid-body" style="margin-top: 60px;">
                                    <h2 class="grid-title"><?php echo $title_stat; ?>Statistic <?php echo $lr_name; ?></h2>
                                    <div class="item-wrapper">
                                      <canvas id="chartjs-bar-chart" width="600" height="400"></canvas>
                                    </div>
                                  </div>
                                </div>
                              <!-- </div> -->

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>


                  </div>
                </div>
              </div>
            </div>
            <!-- content viewport ends -->
        </div> <!-- page-content-wrapper ends -->

        <?php }
  
        }else{
          echo '
          <div class="page-content-wrapper">
              <div class="page-content-wrapper-inner">
                <div class="content-viewport">

                  <div class="row">
                    <div class="col-md-12 equel-grid">


                      <div class="grid">
                        <div class="grid-body">
                          <div class="item-wrapper">
                            <div class="row mb-3">
                              <div class="col-md-5 mx-auto">

                                <div class="alert alert-primary" role="alert" style="margin-top:30px;text-align:left;padding-left:30px;padding-bottom:30px;">
                                  <h6 class="alert-heading">Sorry!</h6>
                                  <p>Your ID Statistic not Found. Please back to Link Rotator Dashboard.</p>
                                  <a href="'.admin_url('admin.php?page=magic_order_lr').'"><button class="btn btn-dismmiss btn-primary ml-auto"><< Back</button></a>
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>


                    </div>
                  </div>
                </div>
              </div>
              <!-- content viewport ends -->
            </div> <!-- page-content-wrapper ends -->
        ';
          return false;
        }

        ?>

        

        <!-- end statistic  -->

      <?php }else{ ?>
        
        <!-- Your code here... -->

        
      <?php } ?> <!-- end else here -->

    <?php }else{ ?>


    <div class="row">
        <div class="col-md-6 order-md-1">
		    </div>

        <!-- modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="default-modal" style="display: none;" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Global URL Code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <h3 style="font-size: 18px;"><?php echo get_site_url().'/<span id="global_url_code">'.$l_rotator.'</span>/'; ?></h3>
                <p style="margin-top: 20px;width: 100%;">
                  <input type="text" class="form-control form-control-lg" id="url_code" value="<?php echo $l_rotator; ?>" style="height: 45px;text-align: center;font-size: 25px;">
                </p>
              </div>
              <div class="modal-footer" style="margin-bottom: 10px;">
                <span class="btn action-btn btn-refresh btn-xs component-flat icon-loading-modal clicked" style="display: none;">
                  <i class="mdi mdi-autorenew"></i>
                </span>
                <span style="color:#00E093;margin-right: 20px;display: none;" id="info-text">
                  <span class="btn action-btn btn-refresh btn-xs component-flat">
                    <i class="mdi mdi-check-circle" style="color: #00E093"></i>
                  </span>
                  <span>Save Success</span>
                </span>
                <button type="button" class="btn btn-link btn-sm" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-sm save_global_url_code">Save changes</button>
              </div>
            </div>
          </div>
        </div>
        <!-- end modal -->


        <!-- modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="default-modal2" style="display: none;" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Statistics</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Loading..</p>
              </div>
              <div class="modal-footer" style="margin-bottom: 10px;">
                <button type="button" class="btn btn-link btn-sm" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <!-- end modal -->

    		<div class="col-md-6 order-md-1" style="text-align: right;">
    		    <div class="chartjs-legend">
    		    	<ul class="0-legend" style="padding: 0;margin: 0;margin-top: 0px;margin-top: 10px;">
    		    		<a href="<?php echo admin_url('admin.php?page=magic_order_lr&opt=add') ?>"><div class="btn btn-info has-icon btn-rounded"><i class="mdi mdi-plus-box"></i>Add New Link Rotator</div></a>
                <div class="btn btn-outline-info has-icon btn-rounded" data-toggle="modal" data-target="#default-modal" id="edit_global" style="margin-left: 10PX;">
                              <i class="mdi mdi-pencil"></i>Edit Global URL Code</div>
    		    	</ul>
    		    </div>
    		</div>
	  </div>
    <hr style="visibility: hidden;">
    <div class="page-content-wrapper">
        <div class="page-content-wrapper-inner">
          <div class="content-viewport">

          	<div class="row">
              <div class="col-md-12 equel-grid">
                <div class="grid">
                  <div class="grid-body py-3" style="padding-left: 20px;">
                    <div class="split-header">
                        <p class="card-title">Data Link Rotator</p>
                        <div class="content-wrapper v-centered">
                            <span class="btn action-btn btn-refresh btn-xs component-flat icon-loading" style="display: none;">
                              <i class="mdi mdi-autorenew"></i>
                            </span>

                        <div class="btn-group">
	                        <button type="button" class="btn btn-trasnparent btn-xs component-flat pr-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                          <i class="mdi mdi-dots-vertical"></i>
	                        </button>
	                        <div class="dropdown-menu dropdown-menu-right" style="display: none;">
	                          <a class="dropdown-item" href="#">Expand View</a>
	                          <a class="dropdown-item" href="#">Edit</a>
	                        </div>
	                      </div>
                        </div>
                    </div>

                  </div>

                  <div class="table-responsive">
                    <table class="table table-hover table-sm">
                      <thead>
                        <tr class="solid-header">
                          <th>No</th>
                          <th>Name</th>
                          <th>Code</th>
                          <th>Link Rotator</th>
                          <th>Link</th>
                          <th>Statistic</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      	<?php
                      	$no = 1;
                      	foreach ($query2 as $row) {

                          $linknya = json_decode($row->lr_link, true);
                          $isi_link = '';

                          if(!empty($linknya)){
                              foreach ($linknya as $key => $value ) {
                                $isi_link .= $key.' : <a href="'.$value.'" target="_blank">'.$value.'</a><br>';
                              }
                          }

                          $link_rotator = get_site_url().'/'.$l_rotator.'/'.$row->lr_code;


                      	?>
								        <tr id="link_<?php echo $no;?>">
		                          <td><?php echo $no; ?></td>
                              <td><?php echo $row->lr_name; ?></td>
                              <td><?php echo $row->lr_code; ?></td>
                              <td>
                                <?php /*
                                <button id="<?php echo $no;?>" data-id="<?php echo $no;?>" type="button" class="btn btn-link btn-xs has-icon show_link"><i class="mdi mdi-link"></i>Show Link</button><br><div id="link_<?php echo $no;?>" style="display:none;"><a href="<?php echo $link_rotator;?>" target="_blank"><?php echo $link_rotator;?></a></div>*/ ?>
                                <a href="<?php echo $link_rotator;?>" target="_blank" style="font-size: 11px;"><?php echo get_site_url().'/<span class="global_code_url" style="display: inherit;">'.$l_rotator.'</span>/'.$row->lr_code;?></a>
                              </td>
                              <td><button id="<?php echo $no;?>" data-id="<?php echo $no;?>" type="button" class="btn btn-link btn-xs has-icon show_link2"><i class="mdi mdi-link"></i>Show Link</button><br><div id="link2_<?php echo $no;?>" style="display:none;"><?php echo $isi_link;?></div></td>
                              <td>
                                <a href="<?php echo admin_url('admin.php?page=magic_order_lr').'&opt=statistic&id='.$row->id; ?>&filter=today" target="_parent" style="font-size: 11px;">
                                <button id="<?php echo $row->id;?>" data-id="<?php echo $row->id;?>" type="button" class="btn btn-link btn-xs has-icon"><i class="mdi mdi-chart-line"></i>Statistic</button>
                                </a>
                              </td>
                              <td style="color:#ababab;"> <a href="<?php echo admin_url('admin.php?page=magic_order_lr'); ?>&opt=edit&data=<?php echo $row->id;?>"><div class="btn btn-info btn-xs has-icon"><i class="mdi mdi-pencil"></i>Edit</div></a> | <div class="btn btn-warning btn-xs has-icon delete_link" data-id="<?php echo $row->id;?>" data-no="<?php echo $no;?>"><i class="mdi mdi-delete"></i>Delete</div> </td>
		                    </tr>
                      	<?php

                      		$no++;

                      		}
                      	?>
                        
                      </tbody>
                    </table>
                  </div>
                  <a class="border-top px-3 py-2 d-block text-gray" href="#"><small class="font-weight-medium"><i class="mdi mdi-chevron-down mr-2"></i>View All Order History</small></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content viewport ends -->
    </div>


    <?php 
 
    }

    ?>


    <!--page body ends -->
    <!-- SCRIPT LOADING START FORM HERE /////////////-->
    <!-- plugins:js -->
    <script src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/rui/vendors/js/core.js"></script>
    <script src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/rui/vendors/js/vendor.addons.js"></script>
    <!-- endinject -->
    <!-- Vendor Js For This Page Ends-->

    <!-- Vendor Js For This Page Ends-->
    <!-- build:js -->
    <script src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/rui/js/template.js"></script>
    <script src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/rui/js/dashboard.js"></script>

    <?php 

    if(isset($_GET['opt'])){
      if($_GET['opt']=="statistic"){ 
      ?>
    <script src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/rui/vendors/chartjs/Chart.min.js"></script>
    <!-- <script src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/rui/js/charts/chartjs.js"></script> -->
    <script>
      $(function () {
        'use strict';

        $('.filter_date').bind('click', function(){
          alert('Belum kalo ini. Soon yah.. ^_^ ');
        })

        <?php

            $fields = json_decode($lr_link, true);

            if(!empty($fields))
            {

                // SET TODAY - 7 HOURS
                $today_now_start = date("Y-m-d 00:01");
                $time_start = strtotime($today_now_start);
                $date_start = strtotime('-7 hours', $time_start);
                $today_now_start = date("Y-m-d 00:01");
                $filter_datestart_today = date('Y-m-d H:i', $date_start);

                // SET TODAY MIDNIGNHT
                $today_now_end = date("Y-m-d 23:59:59");


                // // get total 
                // $x = 0;
                // $total_priority = 0;
                // foreach ($fields as $key => $value ) {
                //     $y = "link_$x";
                //     $angka_priority = $lr_priority->$y;
                //     $total_priority = $total_priority + $angka_priority;
                //     $x++;
                // }


                $i = 0;
                $len = count($fields);
                $data_link_name = "";
                $data_stat = "";
                foreach ($fields as $key => $value ) {

                  // $a = "link_$i";
                  // $angka_priority = $lr_priority->$a;

                  // $persen_priority = ($angka_priority/$total_priority)*100;
                  // $key

                  if($_GET['filter']=='today'){
                    // Today
                    $jumlah_log = $wpdb->get_results('SELECT * from '.$table_name3.' where link="'.$value.'" AND created_at BETWEEN "'.$filter_datestart_today.'" AND "'.$today_now_end.'"');
                  }else if($_GET['filter']=='all'){
                    // Total
                    $jumlah_log = $wpdb->get_results('SELECT * from '.$table_name3.' where link="'.$value.'"');
                  }else{
                    // Soon
                    $jumlah_log = $wpdb->get_results('SELECT * from '.$table_name3.' where link="'.$value.'" AND created_at BETWEEN "'.$filter_datestart_today.'" AND "'.$today_now_end.'"');
                  }

                  $jumlah_log = count($jumlah_log);
                  
                  $data_link_name .= '"'.$key.'"';
                  $data_stat .= $jumlah_log;
                  if ($i == $len - 1) {
                  }else{
                    $data_link_name .= ',';
                    $data_stat .= ',';
                  }
                  $i++;

                }
            }

        ?>

        if ($("#chartjs-bar-chart").length) {
          var BarData = {
            labels: [<?php echo $data_link_name; ?>],
            datasets: [{
              label: 'Logs',
              data: [<?php echo $data_stat; ?>],
              backgroundColor: [chartColors[0], chartColors[1], chartColors[2]]
            }]
          };
          var barChartCanvas = $("#chartjs-bar-chart").get(0).getContext("2d");
          var barChart = new Chart(barChartCanvas, {
            type: 'bar',
            data: BarData,
            options: {
              legend: false
            }
          });
        }
      });   
    </script>
    <?php }
  }
    ?>

    
    <script>
      var ALPHABET = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      var ID_LENGTH = 4;
      var generate = function() {
        var rtn = '';
        for (var i = 0; i < ID_LENGTH; i++) {
          rtn += ALPHABET.charAt(Math.floor(Math.random() * ALPHABET.length));
        }
        return rtn;
      }

      function del(a){
          $('.'+a).remove();
          run_persen();
      }

      jQuery(document).ready(function($) {
          $('.show_link').bind('click', function(){
              if($(this).text()=='Show Link'){
                  var idnya = $(this).data('id');
                  $(this).html('<i class="mdi mdi-link"></i>Hide Link').addClass('btn-warning').removeClass('btn-link');
                  var linkid = 'link_'+idnya;
                  $('#'+linkid).show();
              }else{
                  var idnya = $(this).data('id');
                  $(this).html('<i class="mdi mdi-link"></i>Show Link').addClass('btn-link').removeClass('btn-warning');
                  var linkid = 'link_'+idnya;
                  $('#'+linkid).hide();
              }
              
          });

          $('.show_link2').bind('click', function(){
              if($(this).text()=='Show Link'){
                  var idnya = $(this).data('id');
                  $(this).html('<i class="mdi mdi-link"></i>Hide Link').addClass('btn-warning').removeClass('btn-link');
                  var linkid = 'link2_'+idnya;
                  $('#'+linkid).show();
              }else{
                  var idnya = $(this).data('id');
                  $(this).html('<i class="mdi mdi-link"></i>Show Link').addClass('btn-link').removeClass('btn-warning');
                  var linkid = 'link2_'+idnya;
                  $('#'+linkid).hide();
              }
              
          });

          $("#input_link_code").keyup(function(){
              // Getting the current value of textarea
              var currentText = $(this).val();
              // Setting the Div content
              $("#link_code").text(currentText);
          });

          $("#url_code").keyup(function(){
              var currentText = $(this).val();
              $("#global_url_code").text(currentText);
          });

          $(".save_global_url_code").bind('click', function(){
              $('.icon-loading-modal').show();
              var url_code = $('#url_code').val();
              var datanya = [
                      url_code
                  ];
                  
              var data = {
                  'action': 'myaction_save_l_rotator',
                  'datanya': datanya
              };

              jQuery.post(ajaxurl, data, function(response) {
                if(response=='success'){
                  $("#info-text").show();
                  $('.global_code_url').text(url_code);
                  $('.icon-loading-modal').hide();
                  window.location.reload();
                }
              });
          });


          $('.add_link').bind('click', function(){
              var idnya = generate();
              $('.div_link').append('<!-- link --><div class="col-md-3 showcase_text_area '+idnya+'"><div class="hasil_persen persen_'+idnya+'" data-id="'+idnya+'" style="font-size: 11px;padding-top: 11px;color: #F04D82; font-weight:bold;">%</div></div><div class="col-md-3 showcase_content_area '+idnya+'" style="margin-top: 5px;"><input type="text" class="form-control link_name" value="" placeholder="Link name"></div><div class="col-md-4 showcase_content_area '+idnya+'" style="margin-top: 5px;"><input type="text" class="form-control link_destination" value="" placeholder="Paste your link"></div><div class="col-md-1 showcase_content_area '+idnya+'" style="margin-top: 5px;"><select onclick="run_persen()" class="custom-select link_priority" title="Priority"><option data-id="'+idnya+'" value="1">1</option><option data-id="'+idnya+'" value="2">2</option><option data-id="'+idnya+'" value="3">3</option><option data-id="'+idnya+'" value="4">4</option><option data-id="'+idnya+'" value="5">5</option><option data-id="'+idnya+'" value="6">6</option><option data-id="'+idnya+'" value="7">7</option><option data-id="'+idnya+'" value="8">8</option><option data-id="'+idnya+'" value="9">9</option><option data-id="'+idnya+'" value="10">10</option></select></div><div class="col-md-1 showcase_content_area '+idnya+'" style="margin-top: 5px;"><div class="btn btn-outline-primary" style="height: 35px;" onclick=del("'+idnya+'")>-</div></div><!-- end link -->');
              run_persen();
          });

          $( "#save_link" ).bind("click", function(e){

              $("#success_info").html('<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Saving...</span>');

              var arr_link_name = $('input.link_name').map(function(){
                  return this.value;
              }).get().toString();

              var arr_link_destination = $('input.link_destination').map(function(){
                  return this.value;
              }).get().toString();

              var arr_link_priority = $('select.link_priority').map(function(){
                  return this.value;
              }).get().toString();

              var str1 = arr_link_name;
              var str1_array = str1.split(',');

              var str2 = arr_link_destination;
              var str2_array = str2.split(',');

              var str3 = arr_link_priority;
              var str3_array = str3.split(',');


              var hasil = '';
              var len = str1_array.length;
              for(var i = 0; i < str1_array.length; i++) {
                  
                  hasil += '"'+str1_array[i]+'":"'+str2_array[i]+'"';
                  if (i == len - 1) {
                  }else{
                      hasil += ',';
                  }
              }

              var hasil2 = '';
              var len2 = str3_array.length;
              for(var i = 0; i < str3_array.length; i++) {
                  
                  hasil2 += '"link_'+i+'":"'+str3_array[i]+'"';
                  if (i == len2 - 1) {
                  }else{
                      hasil2 += ',';
                  }
              }



              var lr_name = $('#input_name').val();
              var lr_code = $('#input_link_code').val();
              var lr_rotator = '{'+hasil+'}';
              var lr_priority = '{'+hasil2+'}';

              var datanya = [
                      lr_name,
                      lr_code,
                      lr_rotator,
                      lr_priority
                  ];
                  
              var data = {
                  'action': 'myaction_save_lr',
                  'datanya': datanya
              };

              jQuery.post(ajaxurl, data, function(response) {
                if(response=='failed'){
                  $("#success_info").show();
                  $("#success_info").html('<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: red;">Failed! Link Code sudah terdaftar.</span>').fadeOut(5000);
                }else{
                  $('#input_name').val('');
                  $('#input_link_code').val('');
                  $('.link_name').val('');
                  $('.link_destination').val('');
                  $("#success_info").html(response);
                  window.location.reload();
                }
              });

          });

          

          /*
          $( ".link_priority" ).bind("change", function(e){

              var arr_link_priority = $('select.link_priority').map(function(){
                  return this.value;
              }).get().toString();

              var str3 = arr_link_priority;
              var str3_array = str3.split(',');

              total_priority = 0;
              var len2 = str3_array.length;
              for(var i = 0; i < str3_array.length; i++) {
                  nilai = parseFloat(str3_array[i]);
                  total_priority = total_priority+nilai;
              }


              var new_selected = [];
              $(".hasil_persen").each(function(){
                      new_selected.push($(this).data('id'));
              });
              new_selected = new_selected.toString();
              var array = new_selected.split(',');

              var arrayLength = array.length;
              for (var i = 0; i < arrayLength; i++) {
                  if(array[i]!=0){
                      // var runf = "auth_status_"+array[i]+"(1)";
                      // eval(runf);
                      id_ne = array[i];
                      var valuenya = $('.'+id_ne).find('option:selected').val();

                      hasil_persennya = (valuenya/total_priority)*100;
                      $('.persen_'+id_ne).text(hasil_persennya.toFixed(1)+'%')
                      console.log(id_ne);
                      console.log(valuenya);
                  }
              }

              // alert(total_priority);

          });
          */



          $( "#update_link" ).bind("click", function(e){

              var id_link = $(this).data('id');

              $("#success_info2").html('<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;">Saving...</span>');

              var arr_link_name = $('input.link_name').map(function(){
                  return this.value;
              }).get().toString();

              var arr_link_destination = $('input.link_destination').map(function(){
                  return this.value;
              }).get().toString();

              var arr_link_priority = $('select.link_priority').map(function(){
                  return this.value;
              }).get().toString();

              var str1 = arr_link_name;
              var str1_array = str1.split(',');

              var str2 = arr_link_destination;
              var str2_array = str2.split(',');

              var str3 = arr_link_priority;
              var str3_array = str3.split(',');


              var hasil = '';
              var len = str1_array.length;
              for(var i = 0; i < str1_array.length; i++) {
                  
                  hasil += '"'+str1_array[i]+'":"'+str2_array[i]+'"';
                  if (i == len - 1) {
                  }else{
                      hasil += ',';
                  }
              }

              var hasil2 = '';
              var len2 = str3_array.length;
              for(var i = 0; i < str3_array.length; i++) {
                  
                  hasil2 += '"link_'+i+'":"'+str3_array[i]+'"';
                  if (i == len2 - 1) {
                  }else{
                      hasil2 += ',';
                  }
              }

              var lr_name = $('#input_name').val();
              var lr_code = $('#input_link_code').val();
              var lr_rotator = '{'+hasil+'}';
              var lr_priority = '{'+hasil2+'}';

              var datanya = [
                      id_link,
                      lr_name,
                      lr_code,
                      lr_rotator,
                      lr_priority
                  ];
                  
              var data = {
                  'action': 'myaction_update_lr',
                  'datanya': datanya
              };

              jQuery.post(ajaxurl, data, function(response) {
                if(response=='failed'){
                  $("#success_info2").show();
                  $("#success_info2").html('<span class="button" style="margin-top: 10px;border: 0;background: none;box-shadow: none;cursor: text;margin-left: 20px;color: red;">Failed! Link Code sudah terdaftar.</span>').fadeOut(5000);
                }else{
                  $("#success_info2").html(response);
                  window.location.reload();
                }
              });
          });



          $( ".show_statistic" ).bind("click", function(e){
            // alert("Belum ready. Tinggal fungsi ini aja yang belum. Ntar dilanjut lagi, cepet kok.. ^_^ ");
            var idnya = $(this).data('id');
            alert(idnya);
          });


          $( ".delete_link" ).bind("click", function(e){

            if (confirm("Are you sure?")) {
                $('.icon-loading').addClass('clicked').show();
                var id = $(this).data('id');
                var no = $(this).data('no');
                var datanya = [
                        id
                    ];
                    
                var data = {
                    'action': 'myaction_delete_lr',
                    'datanya': datanya
                };

                jQuery.post(ajaxurl, data, function(response) {
                  if(response=='success'){
                    $('#link_'+no).remove();
                    $('.icon-loading').removeClass('clicked').hide();
                  }else{

                  }
                });
            }
            return false;
          });




      });

    function run_persen(){
        
        var arr_link_priority = $('select.link_priority').map(function(){
            return this.value;
        }).get().toString();

        var str3 = arr_link_priority;
        var str3_array = str3.split(',');

        total_priority = 0;
        var len2 = str3_array.length;
        for(var i = 0; i < str3_array.length; i++) {
            nilai = parseFloat(str3_array[i]);
            total_priority = total_priority+nilai;
        }


        var new_selected = [];
        $(".hasil_persen").each(function(){
                new_selected.push($(this).data('id'));
        });
        new_selected = new_selected.toString();
        var array = new_selected.split(',');

        var arrayLength = array.length;
        for (var i = 0; i < arrayLength; i++) {
            if(array[i]!=0){
                // var runf = "auth_status_"+array[i]+"(1)";
                // eval(runf);
                id_ne = array[i];
                var valuenya = $('.'+id_ne).find('option:selected').val();

                hasil_persennya = (valuenya/total_priority)*100;
                $('.persen_'+id_ne).text(hasil_persennya.toFixed(1)+'%')
                console.log(id_ne);
                console.log(valuenya);
            }
        }
    }
    </script>
    <!-- endbuild -->


<?php

}