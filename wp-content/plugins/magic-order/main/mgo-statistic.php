<?php

function count_order_today($id_user){
    global $wpdb;
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $table_name4 = $wpdb->prefix . "cf_form_entry_values";
    $table_name5 = $wpdb->prefix . "cf_form_entries";

    // SET TODAY - 7 HOURS
    $today_now_start = date("Y-m-d 00:01");
    $time_start = strtotime($today_now_start);
    $date_start = strtotime('-7 hours', $time_start);
    $today_now_start = date("Y-m-d 00:01");
    $filter_datestart_today = date('Y-m-d H:i', $date_start);

    // SET TODAY MIDNIGNHT
    $today_now_end = date("Y-m-d 23:59:59");

    $rows_entry = $wpdb->get_results("SELECT * from $table_name4
    LEFT JOIN $table_name5 ON $table_name4.entry_id = $table_name5.id
    where slug='mgo_csid' and form_id='".$id."' and value='".$id_user."' AND datestamp BETWEEN '$filter_datestart_today' AND '$today_now_end' ORDER BY $table_name4.entry_id DESC");

    return (sizeof($rows_entry));
}

function count_order($id_user){
    global $wpdb;
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $table_name4 = $wpdb->prefix . "cf_form_entry_values";
    $table_name5 = $wpdb->prefix . "cf_form_entries";

    $rows_entry = $wpdb->get_results("SELECT * from $table_name4
    LEFT JOIN $table_name5 ON $table_name4.entry_id = $table_name5.id
    where slug='mgo_csid' and form_id='".$id."' and value='".$id_user."' ORDER BY $table_name4.entry_id DESC");

    return (sizeof($rows_entry));
}

function total_orderid(){
    global $wpdb;
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $table_name4 = $wpdb->prefix . "cf_form_entry_values";
    $table_name5 = $wpdb->prefix . "cf_form_entries";

    $rows_entry = $wpdb->get_results("SELECT * from $table_name4
    LEFT JOIN $table_name5 ON $table_name4.entry_id = $table_name5.id
    where slug='mgo_orderid' and form_id='".$id."' ORDER BY $table_name4.entry_id DESC");

    $rows_entry2 = $wpdb->get_results("SELECT * from $table_name4
    LEFT JOIN $table_name5 ON $table_name4.entry_id = $table_name5.id
    where slug='mgo_orderid2' and form_id='".$id."' ORDER BY $table_name4.entry_id DESC");

    $satu = sizeof($rows_entry);
    $dua = sizeof($rows_entry2);
    $totalnya = $satu + $dua;
    return ($totalnya);
}


function total_csid(){
    global $wpdb;
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $table_name4 = $wpdb->prefix . "cf_form_entry_values";
    $table_name5 = $wpdb->prefix . "cf_form_entries";

    $rows_entry = $wpdb->get_results("SELECT * from $table_name4
    LEFT JOIN $table_name5 ON $table_name4.entry_id = $table_name5.id
    where slug='mgo_csid' and form_id='".$id."' ORDER BY $table_name4.entry_id DESC");

    return (sizeof($rows_entry));
}

function magic_order_statistic() {
    mgo_global_vars();
    $expired = $GLOBALS['mgovars']['expired'];
    $date_expired = $GLOBALS['mgovars']['date_expired'];
    $plugin_name = $GLOBALS['mgovars']['plugin_name'];
    $plugin_version = $GLOBALS['mgovars']['plugin_version'];
    $plugin_license = $GLOBALS['mgovars']['plugin_license'];
    $plugin_license_info = $GLOBALS['mgovars']['plugin_license_info'];
    $apikey = $GLOBALS['mgovars']['apikey'];
    $apikey_status = $GLOBALS['mgovars']['apikey_status'];
    
    global $wpdb;
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $table_name = $wpdb->prefix . "cf_forms";
    $table_name2 = $wpdb->prefix . "mgo_calculation";
    $table_name3 = $wpdb->prefix . "users";

        $row = $wpdb->get_results('SELECT * from '.$table_name.' where form_id="'.$id.'" and type="primary"');
        $row = $row[0];
        $dataconfig = json_encode(maybe_unserialize( $row->config ));
        $datajson = json_decode($dataconfig);
        $fields = $datajson->layout_grid->fields;
        $judul_form = $datajson->name;

        $table_name4 = $wpdb->prefix . "cf_form_entry_values";
        $table_name5 = $wpdb->prefix . "cf_form_entries";
        $table_name6 = $wpdb->prefix . "mgo_orders";
        $table_name7 = $wpdb->prefix . "mgo_order_statuses";
        $table_name8 = $wpdb->prefix . "users";

        $id_cs_form = $wpdb->get_results('SELECT id_cs from '.$table_name2.' where id_form="'.$id.'"');
        if (isset($id_cs_form[0]->id_cs)) {
            $id_cs_form = explode(",", $id_cs_form[0]->id_cs);
        }
        
        // Statistics
        $rows_entry2 = $wpdb->get_results("SELECT value as cs_id from $table_name4
        LEFT JOIN $table_name5 ON $table_name4.entry_id = $table_name5.id
        where slug='mgo_csid' and form_id='".$id."' GROUP BY value ORDER BY $table_name4.entry_id DESC");

    //}
    ?>
    <link type="text/css" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/style-admin.css?ver=<?php echo $plugin_version; ?>" rel="stylesheet" />
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
    <div class="wrap plugin_info"><h2 class="title" style="display: none;"></h2>
        <?php
            
        // Get USER ROLES
        $cap = get_user_meta( wp_get_current_user()->ID, $wpdb->get_blog_prefix() . 'capabilities', true );
        $roles = array_keys((array)$cap);
        $role = $roles[0];

        ?>

        <?php
        $id = isset($_POST['update']) ? $_POST['update'] : '';
        if (isset($_POST['update'])) { ?>
        <div class="updated"><p>Customer Service Updated.</p></div>
        <?php } ?>
    </div>
    <div class="wrap" style="box-shadow: 0 4px 25px 0 rgba(0,0,0,.1);border-radius: 4px;">
        <div class="sub-title" style="padding-bottom: 40px;margin-top: 18px;">
            <header class="mgo-header">
                <h1 class="mgo-logo"><img class="icon-title2" src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/icons/magic-order-icon2.png"></h1>
            </header> 

            <?php

            if($apikey=='' || $apikey_status!='valid'){
                echo '
                <div class="sub-title-info"><span>API Key tidak valid atau belum tersedia, silahkan update API Key anda. <a href="'.site_url().'/wp-admin/admin.php?page=magic_order_api" style="text-decoration: none;">[ Update ]</a></span></div>';
                return false;
            }

            if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
                echo '
                <div class="sub-title-info"><span>Plugin Caldera Forms belum terinstall, silahkan install terlebih dahulu! <a href="'.site_url().'/wp-admin/plugin-install.php?s=caldera+forms&tab=search&type=term" style="text-decoration: none;">[ INSTALL ]</a></span></div>
                ';
                return false;
            }

            if($expired!='allowed'){
                echo '
                <div class="sub-title-info"><span>Maaf, plugin anda Expired. <a href="https://member.sinkronus.com" style="text-decoration: none;">[ Extend Now ]</a></span></div>
                ';
                return false;
            }

            // CUSTOMER SERVICES (EDITOR ROLE)
            if($role!='administrator'){
                echo '
                <div class="sub-title-info"><span>This menu is only for administrator!</span></div>
                 ';
                return false;
            }

            if($plugin_license=='FREEMIUM' || $plugin_license=='STARTER'){
                echo '
                <div class="sub-title-info"><span>Maaf, fitur ini hanya untuk BASIC dan PRO License.</span></div>
                 ';
                return false;
            }

        ?>

            <div class="page-title"><a href="<?php echo admin_url('admin.php?page=magic_order_form') ?>" style="text-decoration: none;margin-left: 10px;" class="mgo_link"><span>Form Lists</span></a><span><span class="dashicons dashicons-arrow-right-alt2"></span><span class="dashicons dashicons-arrow-right-alt2" style="margin-left: -15px;"></span></span><span>CS Statistic <b><?php echo $judul_form; ?></b></span></div>
        </div>

            <div class="wrap-container" style="padding-left:60px;margin-top: -80px;">
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-white">
                        <div class="panel-heading">
                                        <h3 class="panel-title">Today Orders Statistic</h3>
                                    </div>
                        <div class="panel-body" style="">
                            <div>
                                <canvas id="chart2" height="150" style="margin-left: -20px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" style="margin-top: 40px;">
                    <div class="panel panel-white">
                        <div class="panel-heading">
                                        <h3 class="panel-title">ALL Orders Statistic</h3>
                                    </div>
                        <div class="panel-body" style="">
                            <div>
                                <canvas id="chart3" height="150" style="margin-left: -20px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                             
            </div>
            <br>
            <br>
            <p><b>Note: </b></br>Statistik ini hanya mengambil semua data order yang memiliki Customer Service (CS) pada orderan yang masuk.</p>

            
            <?php
            /*
            echo 'Total Order: '.total_csid().'<br>';
            print_r(json_encode($rows_entry2));
            echo '<br><br>';

            foreach($rows_entry2 as $row){
                if (in_array($row->cs_id, $id_cs_form)) {
                    $active = ' (Active)';
                }else{
                    $active = ' (Not Active)';
                }
                $jumlahnya = count_order($row->cs_id);
                // echo 'ID '.$row->cs_id.': '.$jumlahnya.' Order '.$active.'<br>';
                 echo '"ID '.$row->cs_id.$active.'",';
            }
            */
            ?>
            </div>
        

    </div>
<script type='text/javascript' src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/jquery-2.1.1.min.js?ver=<?php echo $plugin_version; ?>"></script>
<script type='text/javascript' src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/chart/chart.min.js?ver=<?php echo $plugin_version; ?>"></script>
<script>
$(document).ready(function() {
  $(".accordion a").click(function(){
    $(this).toggleClass("active");
    $(this).next(".content").slideToggle(400);
   });
});
$("document").ready(function(){
  $(".tab-slider--body").hide();
  $(".tab-slider--body:first").show();
});

$(".tab-slider--nav li").bind("click", function(e){
  $(".tab-slider--body").hide();
  var activeTab = $(this).attr("rel");
  $("#"+activeTab).fadeIn();
    if($(this).attr("rel") == "tab2"){
        $(".tab-slider--tabs").addClass("slide");
    }else{
        $(".tab-slider--tabs").removeClass("slide");
    }
  $(".tab-slider--nav li").removeClass("active");
  $(this).addClass("active");
});
$( document ).ready(function() {
    
    var ctx2 = document.getElementById("chart2").getContext("2d");
    var ctx3 = document.getElementById("chart3").getContext("2d");
    var data2 = {
        labels: [
        <?php
            if(sizeof($rows_entry2)==0){
                echo '"No Order"';
            }else{
                foreach($rows_entry2 as $row){
                    // $get_name = $wpdb->get_results("SELECT * from $table_name8 where ID=$row->cs_id ");
                    $args2 = array( 'blog_id' => 0, 'search' => $row->cs_id, 'search_columns' => array( 'ID' ) );
                    $get_name = get_users( $args2 );

                    if($get_name==null){
                        $cs_name = 'No Name';
                    }else{
                        $cs_name = $get_name[0]->display_name;
                    }

                    if (in_array($row->cs_id, $id_cs_form)) {
                        $active = ' (Active)';
                    }else{
                        $active = ' (Not Active)';
                    }

                    $jumlahnya = count_order_today($row->cs_id);
                    echo '"'.$cs_name.$active.' : '.$jumlahnya.' order ",';
                }
            }
        ?>
        ],
        datasets: [
            {
                label: "My Second dataset",
                fillColor: "rgba(34,186,160,0.5)",
                strokeColor: "rgba(34,186,160,0.8)",
                highlightFill: "rgba(34,186,160,0.75)",
                highlightStroke: "rgba(34,186,160,1)",
                data: [
                    <?php
                        if(sizeof($rows_entry2)==0){
                            echo sizeof($rows_entry2);
                        }else{
                            foreach($rows_entry2 as $row){
                                if (in_array($row->cs_id, $id_cs_form)) {
                                    $active = ' (Active)';
                                }else{
                                    $active = ' (Not Active)';
                                }
                                $jumlahnya = count_order_today($row->cs_id);
                                echo '"'.$jumlahnya.'",';
                            }
                        }
                    ?>
                    ]
            }
        ]
    };
    var data3 = {
        labels: [
        <?php
            if(sizeof($rows_entry2)==0){
                echo '"No Order"';
            }else{
                foreach($rows_entry2 as $row){
                    // $get_name = $wpdb->get_results("SELECT * from $table_name8 where ID=$row->cs_id ");
                    $args2 = array( 'blog_id' => 0, 'search' => $row->cs_id, 'search_columns' => array( 'ID' ) );
                    $get_name = get_users( $args2 );

                    if($get_name==null){
                        $cs_name = 'No Name';
                    }else{
                        $cs_name = $get_name[0]->display_name;
                    }

                    if (in_array($row->cs_id, $id_cs_form)) {
                        $active = ' (Active)';
                    }else{
                        $active = ' (Not Active)';
                    }

                    $jumlahnya = count_order($row->cs_id);
                    echo '"'.$cs_name.$active.' : '.$jumlahnya.' order ",';
                }
            }
        ?>
        ],
        datasets: [
            {
                label: "My Second dataset",
                fillColor: "rgba(34,186,160,0.5)",
                strokeColor: "rgba(34,186,160,0.8)",
                highlightFill: "rgba(34,186,160,0.75)",
                highlightStroke: "rgba(34,186,160,1)",
                data: [
                    <?php
                        if(sizeof($rows_entry2)==0){
                            echo sizeof($rows_entry2);
                        }else{
                            foreach($rows_entry2 as $row){
                                if (in_array($row->cs_id, $id_cs_form)) {
                                    $active = ' (Active)';
                                }else{
                                    $active = ' (Not Active)';
                                }
                                $jumlahnya = count_order($row->cs_id);
                                echo '"'.$jumlahnya.'",';
                            }
                        }
                    ?>
                    ]
            }
        ]
    };
    
    var chart2 = new Chart(ctx2).Bar(data2, {
        scaleBeginAtZero : true,
        scaleShowGridLines : true,
        scaleGridLineColor : "rgba(0,0,0,.05)",
        scaleGridLineWidth : 1,
        scaleShowHorizontalLines: true,
        scaleShowVerticalLines: true,
        barShowStroke : true,
        barStrokeWidth : 2,
        barDatasetSpacing : 1,
        legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
        responsive: true
    });
    
    var chart3 = new Chart(ctx3).Bar(data3, {
        scaleBeginAtZero : true,
        scaleShowGridLines : true,
        scaleGridLineColor : "rgba(0,0,0,.05)",
        scaleGridLineWidth : 1,
        scaleShowHorizontalLines: true,
        scaleShowVerticalLines: true,
        barShowStroke : true,
        barStrokeWidth : 2,
        barDatasetSpacing : 1,
        legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
        responsive: true
    });
    
    
});
    
</script>
    <?php
}
