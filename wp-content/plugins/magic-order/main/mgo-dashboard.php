<?php

function magic_order_dashboard() {
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
    $query = $wpdb->get_results("SELECT * FROM $table_name where gf_custom_class='mgo_orderid' ");

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
<!-- partial -->
	<nav class="t-header">

      <div class="t-header-content-wrapper">
        <div class="t-header-content">
        	<div class="viewport-header">
	            <nav aria-label="breadcrumb">
	              <ol class="breadcrumb has-arrow" style="padding-top: 17px;padding-left: 30px;">
	                <li class="breadcrumb-item">
	                  <a href="#">Data Order</a>
	                </li>
	                <li class="breadcrumb-item" style="color: #6c757d;">|</li>
	                <li class="breadcrumb-item active" aria-current="page">Statistics</li>
	                <li class="breadcrumb-item" style="color: #6c757d;">|</li>
	                <li class="breadcrumb-item active" aria-current="page">Settings</li>
	              </ol>
	            </nav>
	        </div>

          <ul class="nav ml-auto">
            <li class="nav-item dropdown">
              <a class="nav-link" href="#" id="notificationDropdown" data-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-bell-outline mdi-1x"></i>
              </a>
              <div class="dropdown-menu navbar-dropdown dropdown-menu-right" aria-labelledby="notificationDropdown">
                <div class="dropdown-header">
                  <h6 class="dropdown-title">Notifications</h6>
                  <p class="dropdown-title-text">You have 4 unread notification</p>
                </div>
                <div class="dropdown-body">
                  <div class="dropdown-list">
                    <div class="icon-wrapper rounded-circle bg-inverse-primary text-primary">
                      <i class="mdi mdi-alert"></i>
                    </div>
                    <div class="content-wrapper">
                      <small class="name">Storage Full</small>
                      <small class="content-text">Server storage almost full</small>
                    </div>
                  </div>
                  <div class="dropdown-list">
                    <div class="icon-wrapper rounded-circle bg-inverse-success text-success">
                      <i class="mdi mdi-cloud-upload"></i>
                    </div>
                    <div class="content-wrapper">
                      <small class="name">Upload Completed</small>
                      <small class="content-text">3 Files uploded successfully</small>
                    </div>
                  </div>
                  <div class="dropdown-list">
                    <div class="icon-wrapper rounded-circle bg-inverse-warning text-warning">
                      <i class="mdi mdi-security"></i>
                    </div>
                    <div class="content-wrapper">
                      <small class="name">Authentication Required</small>
                      <small class="content-text">Please verify your password to continue using cloud services</small>
                    </div>
                  </div>
                </div>
                <div class="dropdown-footer">
                  <a href="#">View All</a>
                </div>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="#" id="messageDropdown" data-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-message-outline mdi-1x"></i>
                <span class="notification-indicator notification-indicator-primary notification-indicator-ripple"></span>
              </a>
              <div class="dropdown-menu navbar-dropdown dropdown-menu-right" aria-labelledby="messageDropdown">
                <div class="dropdown-header">
                  <h6 class="dropdown-title">Messages</h6>
                  <p class="dropdown-title-text">You have 4 unread messages</p>
                </div>
                <div class="dropdown-body">
                  <div class="dropdown-list">
                    <div class="image-wrapper">
                      <img class="profile-img" src="http://www.placehold.it/50x50" alt="profile image">
                      <div class="status-indicator rounded-indicator bg-success"></div>
                    </div>
                    <div class="content-wrapper">
                      <small class="name">Clifford Gordon</small>
                      <small class="content-text">Lorem ipsum dolor sit amet.</small>
                    </div>
                  </div>
                  <div class="dropdown-list">
                    <div class="image-wrapper">
                      <img class="profile-img" src="http://www.placehold.it/50x50" alt="profile image">
                      <div class="status-indicator rounded-indicator bg-success"></div>
                    </div>
                    <div class="content-wrapper">
                      <small class="name">Rachel Doyle</small>
                      <small class="content-text">Lorem ipsum dolor sit amet.</small>
                    </div>
                  </div>
                  <div class="dropdown-list">
                    <div class="image-wrapper">
                      <img class="profile-img" src="http://www.placehold.it/50x50" alt="profile image">
                      <div class="status-indicator rounded-indicator bg-warning"></div>
                    </div>
                    <div class="content-wrapper">
                      <small class="name">Lewis Guzman</small>
                      <small class="content-text">Lorem ipsum dolor sit amet.</small>
                    </div>
                  </div>
                </div>
                <div class="dropdown-footer">
                  <a href="#">View All</a>
                </div>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="#" id="appsDropdown" data-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-apps mdi-1x"></i>
              </a>
              <div class="dropdown-menu navbar-dropdown dropdown-menu-right" aria-labelledby="appsDropdown">
                <div class="dropdown-header">
                  <h6 class="dropdown-title">Apps</h6>
                  <p class="dropdown-title-text mt-2">Authentication required for 3 apps</p>
                </div>
                <div class="dropdown-body border-top pt-0">
                  <a class="dropdown-grid">
                    <i class="grid-icon mdi mdi-jira mdi-2x"></i>
                    <span class="grid-tittle">Jira</span>
                  </a>
                  <a class="dropdown-grid">
                    <i class="grid-icon mdi mdi-trello mdi-2x"></i>
                    <span class="grid-tittle">Trello</span>
                  </a>
                  <a class="dropdown-grid">
                    <i class="grid-icon mdi mdi-artstation mdi-2x"></i>
                    <span class="grid-tittle">Artstation</span>
                  </a>
                  <a class="dropdown-grid">
                    <i class="grid-icon mdi mdi-bitbucket mdi-2x"></i>
                    <span class="grid-tittle">Bitbucket</span>
                  </a>
                </div>
                <div class="dropdown-footer">
                  <a href="#">View All</a>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <hr style="margin-top: 30px;">
    <div class="row">
        <div class="col-md-6 order-md-1">
		    <div class="row" style="padding-left: 15px;padding-top: 10px;">
			    <div class="col-md-2" style="text-align: left;padding-top: 5px;color: #4b4b4b;">
			      <span>Form :</span>
			    </div>
			    <div class="col-md-6">
			      <select class="custom-select" style="padding:0;padding-left: 10px;background: #fff;">
			        <option selected>ALL</option>
			        <option value="1">One</option>
			        <option value="2">Two</option>
			        <option value="3">Three</option>
			      </select>
			    </div>
		    </div>
		    <div class="row" style="padding-left: 15px;padding-top: 10px;">
			    <div class="col-md-2" style="text-align: left;padding-top: 5px;color: #4b4b4b;">
			      <span>Filter :</span>
			    </div>
			    <div class="col-md-6">
			      <select class="custom-select" style="padding:0;padding-left: 10px;background: #fff;">
			        <option selected>Select Filter</option>
			        <option value="1">One</option>
			        <option value="2">Two</option>
			        <option value="3">Three</option>
			      </select>
			    </div>
		    </div>
		</div>
		<div class="col-md-6 order-md-1" style="text-align: right;">
		    <div class="chartjs-legend">
		    	<ul class="0-legend" style="padding: 0;margin: 0;margin-top: 0px;margin-top: 10px;">
		    		<li><i class="mdi mdi-auto-fix" style="color: #2d92fe;margin-right: 5px;"></i>Change Themes</li>
		    	</ul>
		    </div>
		</div>
	</div>
    <hr style="visibility: hidden;">
    <div class="page-content-wrapper">
        <div class="page-content-wrapper-inner">
          <div class="content-viewport">

            <div class="row">
            	

              <div class="col-md-7 equel-grid">
	                <div class="row flex-grow">
	                  <div class="col-12 equel-grid">
	                    <div class="grid widget-sales-card d-flex flex-column">
	                      <div class="grid-body pb-3">
	                        <div class="wrapper d-flex">
	                          <p class="card-title">Closing Ratio</p>
	                          <div class="badge badge-success ml-auto">+ 12.42%</div>
	                        </div>
	                        <div class="wrapper mt-2">
	                          <h3>321,212</h3>
	                          <small class="text-gray">Closing ratio in this week</small>
	                        </div>
	                      </div>
	                      <div class="mt-auto" style="height: 72px !important;"><div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
	                        <canvas class="w-100 chartjs-render-monitor" id="sales-conversion" height="37" style="display: block; height: 72px !important;" width="362"></canvas>
	                      </div>
	                    </div>
	                  </div>
	                </div>
              </div>
              <div class="col-md-5 equel-grid">
                <div class="row flex-grow">
                  <div class="col-6 equel-grid">
                    <div class="grid d-flex flex-column align-items-center justify-content-center" style="background: #2d92fe;">
                      <div class="grid-body text-center">
                        <div class="profile-img img-rounded bg-inverse-primary no-avatar component-flat mx-auto mb-4" style="background: rgba(255, 255, 255, 0.23);"><i class="mdi mdi-account-group mdi-2x" style="color: #fff;"></i></div>
                        <h2 class="font-weight-medium" style="color: #fff;"><span class="animated-count">21.2</span>k</h2>
                        <small class="text-gray d-block mt-3" style="color: #fff;">Today Orders</small>
                        <small class="font-weight-medium text-success"></small>
                      </div>
                    </div>
                  </div>
                  <div class="col-6 equel-grid">
                    <div class="grid d-flex flex-column align-items-center justify-content-center" style="background: #1a76ca;">
                      <div class="grid-body text-center">
                        <div class="profile-img img-rounded bg-inverse-danger no-avatar component-flat mx-auto mb-4" style="background: rgba(255, 255, 255, 0.33);"><i class="mdi mdi-airballoon mdi-2x" style="color: #fff;"></i></div>
                        <h2 class="font-weight-medium" style="color: #fff;"><span class="animated-count">1.6</span>k</h2>
                        <small class="text-gray d-block mt-3" style="color: #fff;">Total Orders</small>
                        <small class="font-weight-medium text-danger"></small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              
            </div>
          	<div class="row">
              <div class="col-md-12 equel-grid">
                <div class="grid">
                  <div class="grid-body py-3" style="padding-left: 20px;">
                    <div class="split-header">
                        <p class="card-title">Order History</p>
                        <div class="content-wrapper v-centered">
                            <small class="text-muted">2h ago</small>
                            <span class="btn action-btn btn-refresh btn-xs component-flat">
                              <i class="mdi mdi-autorenew"></i>
                            </span>

                        <div class="btn-group">
	                        <button type="button" class="btn btn-trasnparent btn-xs component-flat pr-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                          <i class="mdi mdi-dots-vertical"></i>
	                        </button>
	                        <div class="dropdown-menu dropdown-menu-right">
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
                          <th colspan="2" class="pl-4">No</th>
                          <th>Name</th>
                          <th>Product</th>
                          <th>Whatsapp</th>
                          <th>Form</th>
                          <th>Order ID</th>
                          <th>CS</th>
                          <th>Total Price</th>
                          <th>Date Order</th>
                          <th>Followup</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      	<?php
                      	$no = 1;
                      	foreach ($query as $row) {
                      		
                      		$orderid = $row->gf_value;
                      		$entry_id = $row->gf_entry_id;

                      		// Get Customer Name
                      		$customer_name = '';
                      		$get_name = $wpdb->get_results("SELECT * from $table_name where gf_entry_id=$entry_id and gf_custom_class='mgo_nama' ");
	                        if($get_name!=null){ $customer_name = $get_name[0]->gf_value; }



                      	?>
								<tr>
		                          <td><?php echo $no; ?></td>
		                          <td> Just Now </td>
		                          <td> Just Now </td>
		                          <td> Just Now </td>
		                          <td><?php echo $orderid; ?></td>
		                          <td> Just Now </td>
		                          <td> Just Now </td>
		                          <td> Just Now </td>
		                          <td> Followup </td>
		                          <td> Just Now </td>
		                          <td> Followup </td>
		                          <td> Action </td>
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
    <!--page body ends -->
    <!-- SCRIPT LOADING START FORM HERE /////////////-->
    <!-- plugins:js -->
    <script src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/rui/vendors/js/core.js"></script>
    <script src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/rui/vendors/js/vendor.addons.js"></script>
    <!-- endinject -->
    <!-- Vendor Js For This Page Ends-->
    <script src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/rui/vendors/chartjs/Chart.min.js"></script>
    <!-- Vendor Js For This Page Ends-->
    <!-- build:js -->
    <script src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/rui/js/template.js"></script>
    <script src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/rui/js/dashboard.js"></script>
    <!-- endbuild -->


<?php

}