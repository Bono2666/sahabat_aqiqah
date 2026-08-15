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
    	}
    	body, .row, .t-header {
    		background: #F0F6F8 !important;
    	}
    	.t-header {
    		margin-top: 20px;
			margin-bottom: 20px;
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
			background: transparent;
		}
		.breadcrumb.has-arrow .breadcrumb-item::before {
			content: '';
		}
		.update-nag {
			display: none;
		}
    </style>
<!-- partial -->
	<nav class="t-header">

      <div class="t-header-content-wrapper">
        <div class="t-header-content">
        	<div class="viewport-header">
	            <nav aria-label="breadcrumb">
	              <ol class="breadcrumb has-arrow">
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
    <div class="page-content-wrapper">
        <div class="page-content-wrapper-inner">
          <div class="content-viewport">
          	
            <div class="row">
              <div class="col-md-7 equel-grid order-md-2">
                <div class="grid d-flex flex-column justify-content-between overflow-hidden"><div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                  <div class="grid-body">
                    <div class="d-flex justify-content-between">
                      <p class="card-title">Sales Revenue</p>
                      <div class="chartjs-legend" id="sales-revenue-chart-legend"><ul class="0-legend"><li><span style="background-color:#1A76CA"></span>Sales</li><li><span style="background-color:#2d92fe"></span>Marketing</li></ul></div>
                    </div>
                    <div class="d-flex">
                      <p class="d-none d-xl-block">12.5% Growth compared to the last week</p>
                      <div class="ml-auto">
                        <h2 class="font-weight-medium text-gray"><i class="mdi mdi-menu-up text-success"></i><span class="animated-count">25.04</span>%</h2>
                      </div>
                    </div>
                  </div>
                  <canvas class="mt-4 chartjs-render-monitor" id="sales-revenue-chart" height="245" style="display: block; width: 649px; height: 245px;" width="649"></canvas>
                </div>
              </div>
              <div class="col-md-5 order-md-0">
                <div class="row">
                  <div class="col-6 equel-grid">
                    <div class="grid d-flex flex-column align-items-center justify-content-center">
                      <div class="grid-body text-center">
                        <div class="profile-img img-rounded bg-inverse-primary no-avatar component-flat mx-auto mb-4"><i class="mdi mdi-account-group mdi-2x"></i></div>
                        <h2 class="font-weight-medium"><span class="animated-count">21.2</span>k</h2>
                        <small class="text-gray d-block mt-3">Total Followers</small>
                        <small class="font-weight-medium text-success"><i class="mdi mdi-menu-up"></i><span class="animated-count">12.01</span>%</small>
                      </div>
                    </div>
                  </div>
                  <div class="col-6 equel-grid">
                    <div class="grid d-flex flex-column align-items-center justify-content-center">
                      <div class="grid-body text-center">
                        <div class="profile-img img-rounded bg-inverse-danger no-avatar component-flat mx-auto mb-4"><i class="mdi mdi-airballoon mdi-2x"></i></div>
                        <h2 class="font-weight-medium"><span class="animated-count">1.6</span>k</h2>
                        <small class="text-gray d-block mt-3">Impression</small>
                        <small class="font-weight-medium text-danger"><i class="mdi mdi-menu-down"></i><span class="animated-count">3.45</span>%</small>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6 equel-grid">
                    <div class="grid d-flex flex-column align-items-center justify-content-center">
                      <div class="grid-body text-center">
                        <div class="profile-img img-rounded bg-inverse-warning no-avatar component-flat mx-auto mb-4"><i class="mdi mdi-fire mdi-2x"></i></div>
                        <h2 class="font-weight-medium animated-count">2363</h2>
                        <small class="text-gray d-block mt-3">Reach</small>
                        <small class="font-weight-medium text-danger"><i class="mdi mdi-menu-down"></i><span class="animated-count">12.15</span>%</small>
                      </div>
                    </div>
                  </div>
                  <div class="col-6 equel-grid">
                    <div class="grid d-flex flex-column align-items-center justify-content-center">
                      <div class="grid-body text-center">
                        <div class="profile-img img-rounded bg-inverse-success no-avatar component-flat mx-auto mb-4"><i class="mdi mdi-charity mdi-2x"></i></div>
                        <h2 class="font-weight-medium"><span class="animated-count">23.6</span>%</h2>
                        <small class="text-gray d-block mt-3">Engagement Rate</small>
                        <small class="font-weight-medium text-success"><i class="mdi mdi-menu-up"></i><span class="animated-count">51.03</span>%</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          	<div class="row">
              <div class="col-md-12 equel-grid">
                <div class="grid">
                  <div class="grid-body py-3">
                    <p class="card-title ml-n1">Order History</p>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-hover table-sm">
                      <thead>
                        <tr class="solid-header">
                          <th colspan="2" class="pl-4">Customer</th>
                          <th>Order No</th>
                          <th>Purchased On</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="pr-0 pl-4">
                            <img class="profile-img img-sm" src="http://www.placehold.it/50x50" alt="profile image">
                          </td>
                          <td class="pl-md-0">
                            <small class="text-black font-weight-medium d-block">Barbara Curtis</small>
                            <span>
                              <span class="status-indicator rounded-indicator small bg-primary"></span>Account Deactivated </span>
                          </td>
                          <td>
                            <small>8523537435</small>
                          </td>
                          <td> Just Now </td>
                        </tr>
                        <tr>
                          <td class="pr-0 pl-4">
                            <img class="profile-img img-sm" src="http://www.placehold.it/50x50" alt="profile image">
                          </td>
                          <td class="pl-md-0">
                            <small class="text-black font-weight-medium d-block">Charlie Hawkins</small>
                            <span>
                              <span class="status-indicator rounded-indicator small bg-success"></span>Email Verified </span>
                          </td>
                          <td>
                            <small>9537537436</small>
                          </td>
                          <td> Mar 04, 2018 11:37am </td>
                        </tr>
                        <tr>
                          <td class="pr-0 pl-4">
                            <img class="profile-img img-sm" src="http://www.placehold.it/50x50" alt="profile image">
                          </td>
                          <td class="pl-md-0">
                            <small class="text-black font-weight-medium d-block">Nina Bates</small>
                            <span>
                              <span class="status-indicator rounded-indicator small bg-warning"></span>Payment On Hold </span>
                          </td>
                          <td>
                            <small>7533567437</small>
                          </td>
                          <td> Mar 13, 2018 9:41am </td>
                        </tr>
                        <tr>
                          <td class="pr-0 pl-4">
                            <img class="profile-img img-sm" src="http://www.placehold.it/50x50" alt="profile image">
                          </td>
                          <td class="pl-md-0">
                            <small class="text-black font-weight-medium d-block">Hester Richards</small>
                            <span>
                              <span class="status-indicator rounded-indicator small bg-success"></span>Email Verified </span>
                          </td>
                          <td>
                            <small>5673467743</small>
                          </td>
                          <td> Feb 21, 2018 8:34am </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <a class="border-top px-3 py-2 d-block text-gray" href="#"><small class="font-weight-medium"><i class="mdi mdi-chevron-down mr-2"></i>View All Order History</small></a>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 equel-grid">
                <div class="row flex-grow">
                  <div class="col-12 equel-grid">
                    <div class="grid widget-revenue-card">
                      <div class="grid-body d-flex flex-column h-100">
                        <div class="split-header">
                          <p class="card-title">Server Load</p>
                          <div class="content-wrapper v-centered">
                            <small class="text-muted">2h ago</small>
                            <span class="btn action-btn btn-refresh btn-xs component-flat">
                              <i class="mdi mdi-autorenew"></i>
                            </span>
                          </div>
                        </div>
                        <div class="mt-auto">
                          <h3 class="font-weight-medium mt-2">69.05%</h3>
                          <p class="text-gray">Storage is getting full</p>
                          <div class="d-flex justify-content-between text-muted mt-3">
                            <small>Usage</small>
                            <small>35.62 GB / 2 TB</small>
                          </div>
                          <div class="progress progress-slim mt-2">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 68%" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 equel-grid">
                    <div class="grid widget-sales-card d-flex flex-column">
                      <div class="grid-body pb-3">
                        <div class="wrapper d-flex">
                          <p class="card-title">Performance</p>
                          <div class="badge badge-success ml-auto">+ 12.42%</div>
                        </div>
                        <div class="wrapper mt-2">
                          <h3>321,212</h3>
                          <small class="text-gray">More traffic in this week</small>
                        </div>
                      </div>
                      <div class="mt-auto"><div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                        <canvas class="w-100 chartjs-render-monitor" id="sales-conversion" height="70" style="display: block; width: 362px; height: 70px;" width="362"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 col-sm-6 equel-grid">
                <div class="grid deposit-balance-card">
                  <div class="grid-body">
                    <p class="card-title">Deposits</p>
                    <div class="row">
                      <div class="col-md-12 mt-4">
                        <div id="current-circle-progress"><canvas width="120" height="120"></canvas>
                          <span class="circle-progress-value font-weight-medium text-primary h4">73%</span>
                        </div>
                      </div>
                      <div class="col-md-12 text-center mt-4">
                        <h4 class="font-weight-medium">$32,436</h4>
                      </div>
                      <div class="col-12">
                        <button type="button" class="btn btn-sm btn-block mt-4 btn-primary">View Transactions</button>
                      </div>
                      <div class="deposit-balance-card-footer">
                        <div class="footer-col col">
                          <small>Goal: $100k</small>
                          <div class="progress progress-slim mt-2">
                            <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                        <div class="footer-col col">
                          <small>Duration: 23 Days</small>
                          <div class="progress progress-slim mt-2">
                            <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="width: 76%" aria-valuenow="76" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-6 equel-grid">
                <div class="grid">
                  <div class="grid-body pb-0">
                    <p class="card-title">Your top countries</p>
                    <small class="mt-4">Sales performance revenue based by country</small>
                    <div class="table-responsive">
                      <table class="table mt-2">
                        <tbody>
                          <tr class="text-align-edge">
                            <td class="border-top-0"><i class="flag-icon flag-icon-at"></i></td>
                            <td class="border-top-0">Austria</td>
                            <td class="border-top-0 font-weight-bold">$3,434.10</td>
                          </tr>
                          <tr class="text-align-edge">
                            <td><i class="flag-icon flag-icon-br"></i></td>
                            <td>Brazil</td>
                            <td class="font-weight-bold">$3,233.20</td>
                          </tr>
                          <tr class="text-align-edge">
                            <td><i class="flag-icon flag-icon-de"></i></td>
                            <td>Germany</td>
                            <td class="font-weight-bold">$2,345.20</td>
                          </tr>
                          <tr class="text-align-edge">
                            <td><i class="flag-icon flag-icon-fr"></i></td>
                            <td>France</td>
                            <td class="font-weight-bold">$1,671.10</td>
                          </tr>
                          <tr class="text-align-edge">
                            <td><i class="flag-icon flag-icon-ca"></i></td>
                            <td>Canada</td>
                            <td class="font-weight-bold">$1,546.00</td>
                          </tr>
                          <tr class="text-align-edge">
                            <td><i class="flag-icon flag-icon-ch"></i></td>
                            <td>Switzerland</td>
                            <td class="font-weight-bold">$1,034.10</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 equel-grid">
                <div class="grid">
                  <div class="grid-body">
                    <div class="d-flex justify-content-between">
                      <p class="card-title">Activity Log</p>
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
                    <div class="vertical-timeline-wrapper">
                      <div class="timeline-vertical dashboard-timeline">
                        <div class="activity-log">
                          <p class="log-name">Agnes Holt</p>
                          <div class="log-details">Analytics dashboard has been created<span class="text-primary ml-1">#Slack</span></div>
                          <small class="log-time">8 mins Ago</small>
                        </div>
                        <div class="activity-log">
                          <p class="log-name">Ronald Edwards</p>
                          <div class="log-details">Report has been updated <div class="grouped-images mt-1">
                              <img class="img-sm" src="http://www.placehold.it/50x50" alt="Profile Image">
                              <img class="img-sm" src="http://www.placehold.it/50x50" alt="Profile Image">
                              <img class="img-sm" src="http://www.placehold.it/50x50" alt="Profile Image">
                              <img class="img-sm" src="http://www.placehold.it/50x50" alt="Profile Image">
                              <span class="plus-text img-sm">+3</span>
                            </div>
                          </div>
                          <small class="log-time">3 Hours Ago</small>
                        </div>
                        <div class="activity-log">
                          <p class="log-name">Charlie Newton</p>
                          <div class="log-details"> Approved your request <div class="wrapper mt-1">
                              <button type="button" class="btn btn-xs btn-primary">Approve</button>
                              <button type="button" class="btn btn-xs btn-inverse-primary">Reject</button>
                            </div>
                          </div>
                          <small class="log-time">2 Hours Ago</small>
                        </div>
                        <div class="activity-log">
                          <p class="log-name">Gussie Page</p>
                          <div class="log-details">Added new task: Slack home page</div>
                          <small class="log-time">4 Hours Ago</small>
                        </div>
                        <div class="activity-log">
                          <p class="log-name">Ina Mendoza</p>
                          <div class="log-details">Added new images</div>
                          <small class="log-time">8 Hours Ago</small>
                        </div>
                      </div>
                    </div>
                  </div>
                  <a class="border-top px-3 py-2 d-block text-gray" href="#"><small class="font-weight-medium"><i class="mdi mdi-chevron-down mr-2"></i>View All</small></a>
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