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
        <?php 
        printpagehead(isLecturerLoggedIn()['image']);
        printsidebar();        
        ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper" >
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <?php  printCompany('baru'); ?>
                
                
                
                <!-- ======== Bidang List ================== -->
                     <div class="row" id="edit">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Tambah Majikan Baru</h4>
                                <?php if(isset($error)){ ?>
                                <h4 style="color: red;"><?php echo $error; unset($error); ?></h4>
                                <?php } ?>
                            </div>                            
                            <div class="table-responsive">
                                <form class="form-horizontal form-material" action="company.php" method="post">
                                    <div class="form-group">
                                        <label class="col-md-6">Nama Majikan</label>
                                        <div class="col-md-3">
                                            <input type="text" value="" class="form-control form-control-line" name="name" required>
                                        </div>
                                        <div class="form-group">
                                        <label class="col-md-6">Alamat</label>
                                        <div class="col-md-3">
                                            <textarea type="text" class="form-control form-control-plaintext" name="address" required></textarea>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                        <label class="col-md-6">PC Majikan (Nama) </label>
                                        <div class="col-md-3">
                                            <input type="text" value="" class="form-control form-control-line" name="user_name" required>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                        <label class="col-md-6">PC Majikan (Email)</label>
                                        <div class="col-md-3">
                                            <input type="email" value="" class="form-control form-control-line" name="user_email" required>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                        <label class="col-md-6">PC Majikan (No. KP)</label>
                                        <div class="col-md-3">
                                            <input type="text" value="" class="form-control form-control-line" name="user_ic" required>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                        <label class="col-md-6">Telefon Majikan</label>
                                        <div class="col-md-3">
                                            <input type="number"  min="1000000" max="199999999" value="" class="form-control form-control-line" name="phone" required>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                        <label class="col-md-6">Email Majikan</label>
                                        <div class="col-md-3">
                                            <input type="email" value="" class="form-control form-control-line" name="email" required>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                        <label class="col-md-6">Laman Web Majikan</label>
                                        <div class="col-md-3">
                                            <input type="text" value="" class="form-control form-control-line" name="website" required>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <input type="submit" name="company_add" class="btn btn-outline-cyan" value="Tambah Majikan"/>
                                            </div>
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
    <script src="../../dist/js/pages/dashboards/dashboard1.js"></script>
</body>

</html><?php }else {header("Location:../../../index.php?error=Unauthorized Level of Access#services");}} else {header("Location:../../../index.php?error=Unauthorized Access#services");} ?>