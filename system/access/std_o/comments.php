<?php include '../tols/heads.inc.php'; if(isStudentLoggedIn()){$std = isStudentLoggedIn();?>
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
        
        <!--side bar here-->
        

        <?php printpagehead(isStudentLoggedIn()['image']);
        printsidebar(); ?>
        <?php 
        if(isset($_POST['addaduan']))
        {
         $sql = "INSERT INTO `aduan` (`id`,`student_ic`,`subject`,`date_in`) "
                 . " VALUES (NULL, '".$std['ic']."', '".$_POST['aduan']."' , '".date('Y-m-d')."' )";
         if($db->query($sql))
                 $error = "ADUAN ANDA DI PERJAYA HANTAR";
             else $error = "ADUAN ANDA TIDAK PERJAYA HANTAR";
        }
        if(isset($_POST['deleteaduan']))
        {
         $sql = "DELETE FROM `aduan` WHERE `id` = '".$_POST['aduan_id']."' ";
         if($db->query($sql))
                 $error = "ADUAN ANDA DI PERJAYA PADAM";
             else $error = "ADUAN ANDA TIDAK PERJAYA PADAM";  
        }
        ?>
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
                
                <?php if(isset($_GET['delete']))
                    { 
                    $jx = getAduanByid($_GET['delete'])
                    ?>
                <div class="row">
                    <div class="col-lg-10">
                        <div class="card">
                            <div style="width: 85%; background-color: #e2e2e2; height: 2px; margin-left: 5%; margin-right: 10%"></div>
                                <div class="comment-widgets" style="margin-top: 1%">
                                <div class="d-flex flex-row comment-row m-t-0">
                                    <div class="comment-text w-100">
                                        <h6 class="font-medium"><?php echo $std['name'] ?></h6>
                                        <span class="m-b-15 d-block"><?php echo $jx['subject'] ?></span>
                                        <div class="comment-footer">
                                            <span class="text-muted float-right" style="margin-right: 20%"><?php echo $jx['date_in'] ?></span>
                                        </div>
                                    </div>
                                    </div>
                                </div>    
                                        <?php if(strcmp($jx['answer'],'') != 0){ ?>
                                    <div class="comment-widgets" >
                                        <div class="d-flex flex-row comment-row m-t-0" style="background-color: #00000011;">
                                    <div class="comment-text w-100" style="padding-top: 1%; padding-bottom: 1%">
                                        <h6 class="font-medium"><?php echo $jx['answerby'] ?></h6>
                                        <span class="m-b-15 d-block"><?php echo $jx['answer'] ?></span>
                                        <div class="comment-footer">
                                            <span class="text-muted float-right" style="margin-right: 20%"><?php echo $jx['date_answer'] ?></span>
                                        </div>
                                    </div>
                                    </div>
                                    </div>
                                        <?php } ?>  
                                    <div class="comment-widgets" >
                                        <div class="d-flex flex-row comment-row m-t-0">
                                    <div class="comment-text m-b-5" style="padding-top: 1%; padding-bottom: 1%; width: 80%">
                                        <div class="card-body text-center">
                                            <h4 class="card-title">Are you sure you wont to delete this aduan</h4>
                                        </div>
                                        <form action="comments.php" method="post">
                                            <div class="comment-footer" style="display: inline">
                                            <input type="hidden" name="aduan_id" value="<?php echo $jx['id'] ?>"/>
                                            <input type="submit" class="btn btn-danger"  style="margin-left: 45%" name="deleteaduan"  value="Ya"/>
                                            <input type="submit" class="btn btn-success "  value="Tidak"/>
                                        </div>
                                        </form>
                                    </div>
                                    </div>
                                    </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                
                
                    <?php $jobs = getAduanByStudentIc($std['ic']); ?>
                                                            <!-- Comment Row -->
                                <?php if($jobs != NULL)
                                    while($j = $jobs->fetch_assoc()){ ?>  
                                                            <div class="row">
                    <div class="col-md-10">
                        <div class="card">
                                <div class="comment-widgets" style="margin-top: 1%">
                                <div class="d-flex flex-row comment-row m-t-0">
                                    <div class="comment-text w-100">
                                        <h6 class="font-medium"><?php echo $std['name'] ?></h6>
                                        <span class="m-b-15 d-block"><?php echo $j['subject'] ?></span>
                                        <div class="comment-footer">
                                            <span class="text-muted float-right" style="margin-right: 20%"><?php echo $j['date_in'] ?></span>
                                        </div>
                                    </div>
                                    </div>
                                </div>    
                                        <?php if(strcmp($j['answer'],'') != 0){ ?>
                                    <div class="comment-widgets" >
                                        <div class="d-flex flex-row comment-row m-t-0" style="background-color: #00000011; margin: 1%;">
                                    <div class="comment-text w-100" style="">
                                        <h6 class="font-medium"><?php echo $j['answerby'] ?></h6>
                                        <span class="m-b-15 d-block"><?php echo $j['answer'] ?></span>
                                        <div class="comment-footer">
                                            <span class="text-muted float-right" style="margin-right: 20%"><?php echo $j['date_answer'] ?></span>
                                        </div>
                                    </div>
                                    </div>
                                    </div>
                                        <?php } ?>  
                                    <div class="comment-widgets" >
                                        <div class="d-flex flex-row comment-row m-t-0">
                                    <div class="comment-text m-b-5" style="padding-top: 1%; padding-bottom: 1%; width: 80%">
                                        <div class="comment-footer">
                                            <a class="btn btn-danger float-right" href="comments.php?delete=<?php echo $j['id'] ?>"> Padam </a>
                                        </div>
                                    </div>
                                    </div>
                                    </div>
                        </div>
                        </div>
                    </div>        
                                    <?php } ?>
                <div class="row">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Hantar Aduan</h4>
                            </div>
                            <div class="col-sm-6 offset-sm-1" >
                                        <h6 class="font-medium"><?php echo $std['name'] ?></h6>
                                        <h6 class="font-italic"><?php echo $std['email'] ?></h6>
                                        <form action="comments.php" method="post" class="form-horizontal m-t-30">
                                        <div class="form-group row p-t-20">
                                            <label class="col-sm-3">Aduan</label>
                                            <textarea name="aduan" required style="width: 80%; min-height: 150px;"></textarea>
                                        </div>
                                        <div class="form-group row p-t-20">                                            
                                            <input type="submit" class="btn btn-cyan form-control-sm" name="addaduan" value="Hantar Aduan"/>
                                        </div>
                                        </form>
                            </div>
                        </div>
                    </div>
                </div>            
                </div>
                
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php printFooter(); ?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
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
				label: 'No. Pelatih',
				backgroundColor: '#222888',
				borderColor: '#fff222',
				borderWidth: 0,
				data: <?php echo $count_string ?>
			}]
		};
                window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
                        var sparkRes;
                        
			window.myBar = new Chart(ctx, {
				type: 'bar',
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
		};
                var can = document.getElementById('canvas');
                can.height = '100';
                
</script>
</body>

</html><?php } else {header("Location:../../../index.php?error=Unauthorized Access#services");} ?>