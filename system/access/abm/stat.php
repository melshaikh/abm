<?php include '../tols/headl.inc.php'; if(isLecturerLoggedIn()){if(strcmp(isLecturerLoggedIn()['level'],'abm') == 0 ){$loginuser = isLecturerLoggedIn();?>
<html dir="ltr" lang="en">
<?php include 'prints.php'; ?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <title>e-GotJob ABM Utara</title>
    <link href="../../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="../../dist/css/style.min.css" rel="stylesheet">
</head>
<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-navbarbg="skin6" data-theme="light" data-layout="vertical" data-sidebartype="full" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php printpagehead(isLecturerLoggedIn()['image']) ?>
        <!--side bar here-->
        <?php        printsidebar(); ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Email campaign chart -->
                <!-- ============================================================== -->
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="card" >
                        <div class="card-body">
                            <?php 
                                $ys = getYearsASE();
                                $tot = 0;
                                $ystring = '[';
                                $count_string = '[';
                                while($y = $ys->fetch_assoc())
                                {
                                    $cc = getStudentCountByYear($y['name']);
                                    $tot = $tot + $cc;
                                    $ystring = $ystring.$y['name'].',';
                                    $count_string = $count_string.$cc.',';
                                }
                                $ystring = rtrim($ystring,',').']';
                                $count_string = rtrim($count_string,',').']';
                                
                ?>
                                
                                <h5 class="card-title m-b-5">Bilangan Pelatih/Tahun</h5>
                                <h3 class="font-light">Jumlah Pelatih: <?php echo $tot ?></h3>
                                <div class="m-t-20 text-center">
                                    <canvas id="canvas"></canvas>
                                    <!--<div id="earnings" style="padding-left: 30%"></div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card" >
                        <div class="card-body">
                            <?php 
                                $bds = getArea();
                                $tot = 0;
                                $areastring = '[';
                                $area_count_string = '[';
                                while($y = $bds->fetch_assoc())
                                {
                                    $cc = getStudentCountByArea($y['id']);
                                    if($cc > 0){                                    
                                    $tot = $tot + $cc;
                                    $areastring = $areastring."'".$y['name']."'".',';
                                    $area_count_string = $area_count_string.$cc.',';
                                    }
                                }
                                $areastring = rtrim($areastring,',').']';
                                $area_count_string = rtrim($area_count_string,',').']';
                                
                ?>
                                
                                <h5 class="card-title m-b-5">Bilangan Pelatih/Bidang</h5>
                                <h3 class="font-light">Jumlah Pelatih: <?php echo $tot ?></h3>
                                <div class="m-t-20 text-center">
                                    <canvas id="canvas_area"></canvas>
                                    <!--<div id="earnings" style="padding-left: 30%"></div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" >
                            <div class="card-body">
                            <?php 
                                $trds = getCourses();
                                $tot = 0;
                                $tredstring = '[';
                                $tred_count_string = '[';
                                while($y = $trds->fetch_assoc())
                                {
                                    $cc = getStudentCountByTred($y['id']);
                                    if($cc > 0){                                    
                                    $tot = $tot + $cc;
                                    $tredstring = $tredstring."'".$y['name']."'".',';
                                    $tred_count_string = $tred_count_string.$cc.',';
                                    }
                                }
                                $tredstring = rtrim($tredstring,',').']';
                                $tred_count_string = rtrim($tred_count_string,',').']';
                                
                ?>
                                
                                <h5 class="card-title m-b-5">Bilangan Pelatih/Tred</h5>
                                <h3 class="font-light">Jumlah Pelatih: <?php echo $tot ?></h3>
                                <div class="m-t-20 text-center">
                                    <canvas id="canvas_tred"></canvas>
                                    <!--<div id="earnings" style="padding-left: 30%"></div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <?php printFooter(); ?>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../../assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="../../dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../../dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="../../assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="../../assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script>
    $(function() {
    "use strict";

    // ============================================================== 
    // sales ratio
    // ============================================================== 
    var chart = new Chartist.Line('.sales', {
        labels: [1, 2, 3, 4, 5, 6, 7],
        series: [
            [24.5, 28.3, 42.7, 32, 34.9, 48.6, 40],
            [8.9, 5.8, 21.9, 5.8, 16.5, 6.5, 14.5]
        ]
    }, {
        low: 0,
        high: 48,
        showArea: true,
        fullWidth: true,
        plugins: [
            Chartist.plugins.tooltip()
        ],
        axisY: {
            onlyInteger: true,
            scaleMinSpace: 40,
            offset: 20,
            labelInterpolationFnc: function(value) {
                return (value / 10) + 'k';
            }
        },

    });

    var chart = [chart];

    // ============================================================== 
    // Our Visitor
    // ============================================================== 
    var sparklineLogin = function() {
        $('#earningd').sparkline([6, 10, 9, 11, 9, 10, 12], {
            type: 'bar',
            labels: [1, 2, 3, 4, 5, 6, 7],            
            height: '40',
            barWidth: '4',
            width: '100%',
            resize: true,
            barSpacing: '8',
            barColor: '#137eff'
        });
    };
    var sparkResize;

    $(window).resize(function(e) {
        clearTimeout(sparkResize);
        sparkResize = setTimeout(sparklineLogin, 500);
    });
    sparklineLogin();
});
</script>
<script src="../tols/Chart.bundle.min.js"></script>
<script>
//    var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
//		var color = '#fff000';

		var barChartData = {
			labels: <?php echo $ystring ?>,
			datasets: [{
				label: 'Pelatih/Tahun',
				backgroundColor: '#222888',
				borderColor: '#fff222',
				borderWidth: 0,
				data: <?php echo $count_string ?>
			}]
		};        
                var barChartDataArea = {
                        labels: <?php echo $areastring ?>,
			datasets: [{
				label: 'Pelatih/Bidang',
				backgroundColor: '#222888',
				borderColor: '#fff222',
				borderWidth: 0,
				data: <?php echo $area_count_string ?>
			}]
		};
                var barChartDataTred = {
                        labels: <?php echo $tredstring ?>,
			datasets: [{
				label: 'Pelatih/Tred',
				backgroundColor: '#222888',
				borderColor: '#fff222',
				borderWidth: 0,
				data: <?php echo $tred_count_string ?>
			}]
		};
                window.onload = function() {                
			var ctx = document.getElementById('canvas').getContext('2d');
                        var ctxarea = document.getElementById('canvas_area').getContext('2d');
                        var ctxtred = document.getElementById('canvas_tred').getContext('2d');
                        
                        
			window.myBar = new Chart(ctx, {
				type: 'line',
				data: barChartData,
                                options: {
					responsive: true,
					legend: {
						position: 'top',
					},
					title: {
						display: false,
						text: 'Chart.js Bar Chart'
					}
				}
			});
                        window.myBar = new Chart(ctxarea, {
				type: 'horizontalBar',
				data: barChartDataArea,
                                options: {
					responsive: true,
					legend: {
						position: 'top',
					},
					title: {
						display: false,
						text: 'Chart.js Bar Chart'
					}
				}
			});
                        window.myBar = new Chart(ctxtred, {
				type: 'horizontalBar',
				data: barChartDataTred,
                                options: {
					responsive: true,
					legend: {
						position: 'top',
					},
					title: {
						display: false,
						text: 'Chart.js Bar Chart'
					}
				}
			});
                        
		};
                
                
</script>
</body>

</html><?php }else {header("Location:../../../index.php?error=Unauthorized Level of Access#services");}} else {header("Location:../../../index.php?error=Unauthorized Access#services");} ?>