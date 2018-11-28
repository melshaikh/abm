<?php include '../tols/headl.inc.php'; if(isLecturerLoggedIn()){if(strcmp(isLecturerLoggedIn()['level'],'tusb') == 0 ){$loginuser = isLecturerLoggedIn();?>
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
                <?php printJobs('list'); ?>             
                
                
                <!-- ======== Bidang List ================== -->
                <?php if(isset($_GET['edit'])) { 
                $jj = getJobsById($_GET['edit']); ?>
            <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Maklumat Tawaran</h4>
                            </div>
                            <div class="table-responsive">
                                <form action="jobs.php" method="post">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <td style="width: 15%">NAMA TAWARAN</td>
                                            <td><span class="font-medium"><input type="text" value="<?php echo $jj['name']; ?>" name="name"/></span> </td>
                                        </tr>
                                        <tr>
                                            <td>NAMA MAJIKAN</td>
                                            <td><span class="font-medium"><input type="text" value="<?php echo $jj['company']; ?>" name="company"/></span> </td>
                                        </tr>
                                        <tr>
                                            <td>JAWATAN</td>
                                            <td><span class="font-medium"><input type="text" value="<?php echo $jj['position']; ?>" name="position"/></span> </td>
                                        </tr>
                                        <tr>
                                                <td>Bidang</td>
                                                <td>
                                                    <select name="bidang_id">
                                                        <option value="-1">All</option>
                                                        <?php $bds = getArea(); 
                                                        while($p = $bds->fetch_assoc()) { 
                                                            if($p['id'] == $jj['bidang_id']){ ?>
                                                        <option selected value="<?php echo $p['id']?>"><?php echo $p['name']?></option>
                                                        <?php } else { ?>
                                                        <option value="<?php echo $p['id']?>"><?php echo $p['name']?></option>
                                                        <?php }
                                                        
                                                        } ?>
                                                    </select>
                                                </td>
                                            </tr> 
                                        <tr>
                                            <td>Deskripsi</td>
                                            <td><span class="font-medium"><textarea style="width: 80%; min-height: 150px;" type="text" name="detail"><?php echo str_replace("--n--","\n",$jj['detail']);   ?></textarea></span> </td>
                                        </tr>
                                        <tr>
                                            <td>Tarikh Mula</td>
                                            <td><span class="font-medium"><input type="date" value="<?php echo $jj['sdate']; ?>" name="sdate"/></span> </td>
                                        </tr>
                                        <tr>
                                            <td>Tarikh Tamat</td>
                                            <td><span class="font-medium"><input type="date" value="<?php echo $jj['closing_date']; ?>" name="closing_date"/></span> </td>
                                        </tr>
                                        <tr>
                                            <td>Gaji (RM) </td>
                                            <td><span class="font-medium"><input type="text" value="<?php echo $jj['salary']; ?>" name="salary"/></span> </td>
                                        </tr>
                                        <tr>
                                            <td>PIC [Nama]</td>
                                            <td><span class="font-medium"><?php echo getUserById($jj['user_id'])['name']; ?></span> </td>
                                        </tr>
                                        <tr>
                                            <td>PIC [Email]</td>
                                            <td><span class="font-medium"><?php echo getUserById($jj['user_id'])['email']; ?></span> </td>
                                        </tr>
                                        <tr>
                                                <input type="hidden" name="job_id" value="<?php echo $jj['id'] ?>"/>
                                                <td colspan="2"><input type="submit" name="editjob" class="btn btn-outline-cyan" value="Kemaskini Tawaran" style="width: 15%"/></td>
                                            </tr>
                                    </tbody>
                                </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
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