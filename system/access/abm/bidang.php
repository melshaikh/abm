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
        if(isset($_POST['addnew']))
        {
            $sql = "SELECT * FROM `area` WHERE `name` = '".$_POST['name']."'";
            if($ck = $db->query($sql))
            {
                if($ck->num_rows < 1)
                {
                    $sql = "INSERT INTO `area` (`id`,`name`) VALUE (NULL, '".$_POST['name']."')";
                    if($db->query($sql))
                        $error = "BIDANG BARU BERJAYA DI TAMBAH";
                    else $error = $sql;
                }else 
                {
                    $error = "NAMA BIDANG TELAH WUJUD";
                }
                
            }else $error = $sql;
        }
        if(isset($_POST['editbidang']))
        {
            $sql = "SELECT * FROM `area` WHERE `name` = '".$_POST['name']."'";
            if($ck = $db->query($sql))
            {
                if($ck->num_rows < 1)
                {
                    $sql = "UPDATE `area` SET `name` = '".$_POST['name']."' WHERE `id` = '".$_POST['bidang_id']."'";
                    if($db->query($sql))
                    {

                    }else                echo $sql;
                }else 
                {
                    $error = "NAMA BIDANG TELAH WUJUD";
                }
            }else $error = $sql;
            
        }
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
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">MAKLUMAT BIDANG</h4>
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
                
                    
               
                <?php if(isset($_GET['edit'])){ 
                    $tred = getAreaByID($_GET['edit']);?>
                <!-- ======== Student Edit ================== -->
                <div class="row" id="edit">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Kemaskini Bidang</h4>
                            </div>
                            <form class="form-horizontal m-t-30" action="bidang.php" method="post">
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-1">Nama Bidang</label>
                                    <input type="text" class="form-control col-sm-4" name="name" value="<?php echo $tred['name'] ?>">                                    
                                </div>
                                <div class="col-sm-4 offset-sm-2">
                                        <input type="hidden" name="bidang_id" value="<?php echo $tred['id'] ?>"/>
                                        <input type="submit"  class="btn btn-outline-cyan" value="Kemaskini" name="editbidang"/>
                                    </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php                     
                    $std_list = getArea();  
                    ?>
                <!-- ======== Bidang List ================== -->
                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Tambah Bidang</h4>
                                <?php if(isset($error)){ ?>
                                <h4 style="color: red;"><?php echo $error; unset($error); ?></h4>
                                <?php } ?>
                            </div>
                            <div class="table-responsive">
                                <form class="form-horizontal form-material" action="bidang.php" method="post">
                                    <div class="form-group">
                                        <label class="col-md-12">Nama Bidang</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Nama Bidang" class="form-control form-control-line" name="name" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="submit" name="addnew" class="btn btn-success" value="Tambah"/>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><?php //echo $std_list; ?></h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">Bidang</th>
                                            <th class="border-top-0">Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($std_list->num_rows > 0)
                                            while($std = $std_list->fetch_assoc()){ ?>
                                        <tr>    
                                            <td><span class="font-medium"><?php echo $std['name'] ?></span> </td>
                                            <td><a href="bidang.php?edit=<?php echo $std['id']?>#edit"><span class="label label-success label-rounded">Edit</span></a></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
                
                
                <!-- ============================================================== -->
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