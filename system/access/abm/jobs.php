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
<script type="text/javascript">
function printDiv(divName){
                        
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
                        var x = document.getElementById("printform");
                        x.style.display = "none";
			window.print();
			document.body.innerHTML = originalContents;
		}

</script>
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
        if(isset($_POST['addnewjob']))
        {
            $det = preg_replace("/[\n\r]/","--n--",$_POST['detail']); 
            $sql = "INSERT INTO `jobs` (`id`, `name`, `company`, `position`"
                    . ", `detail`, `status`, `email`, `company_id`"
                    . ", `bidang_id`, `date`, `closing_date`, `salary`"
                    . ", `sdate`, `user_id`) "
                    . "VALUES (NULL, '".$_POST['name']."', '".$_POST['company']."', '".$_POST['position']."'"
                    . ", '".$det."' ,'NEW' ,'".$_POST['email']."' ,'".$_POST['company_id']."'"
                    . ", '".$_POST['bidang_id']."', '".date('Y-m-d')."', '".$_POST['edate']."', '".$_POST['salary']."'"
                    . ", '".$_POST['sdate']."' , '".$loginuser['id']."')";
            if($db->query($sql))
                $error = "TAWARAN KERJA BARU BERJAYA DI TAMBAH";
            else $error = "TAWARAN KERJA BARU TIDAK BERJAYA DI TAMBAH".$sql;
        }
        if(isset($_POST['editjob']))
        {
            $det = preg_replace("/[\n\r]/","--n--",$_POST['detail']); 
            $sql = "UPDATE `jobs` SET `name` = '".$_POST['name']."', `company` = '".$_POST['company']."', `position` = '".$_POST['position']."', `bidang_id` = '".$_POST['bidang_id']."'"
                    . ", `salary` = '".$_POST['salary']."', `detail` = '".$det."', `sdate` = '".$_POST['sdate']."', `closing_date` = '".$_POST['closing_date']."' "
                    . "WHERE `id` = '".$_POST['job_id']."'";
            if($db->query($sql))
                $error = "TAWARAN KERJA BERJAYA DI KEMASKINI";
            else $error = "TAWARAN KERJA TIDAK BERJAYA DI KEMASKINI : ".$sql;
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
            
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <?php printJobs('list'); ?>
                <!-- ======== Bidang List ================== -->
                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Cari Tawaran</h4>
                                <?php if(isset($error)){ ?>
                                <h4 style="color: red;"><?php echo $error; unset($error); ?></h4>
                                <?php } ?>
                            </div>
                            <div class="table-responsive">
                                <form class="form-horizontal form-material" action="jobs.php" method="post">
                                    <div class="form-group">
                                        <label class="col-md-12">Nama Tawaran</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Nama Tawaran" class="form-control form-control-line" name="name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="submit" name="search" class="btn btn-outline-cyan" value="Cari"/>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- ============== View Job Section ==================================== -->
            <?php if(isset($_GET['view'])) { 
                $jj = getJobsById($_GET['view']); ?>
            <div class="row" id="printview">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body" style="display: inline">
                                <form action="jobs_application.php" method="get">
                                    <label class="col-sm-2 font-medium">Maklumat Tawaran</label>
                                    <?php if(strcmp($jj['company_id'],ABM_COMANY_ID) == 0){ ?>
                                    <input type="hidden" name="jid" value="<?php echo $jj['id']; ?>"/>
                                    <input type="submit"  class="btn btn-outline-cyan col-sm-2" value="Senarai Permohon" name="application" />
                                    <?php } ?>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <td style="width: 20%">NAMA TAWARAN</td>
                                            <td><span class="font-medium"><?php echo $jj['name']; ?></span> </td>
                                        </tr>
                                        <tr>
                                            <td>NAMA MAJIKAN</td>
                                            <td><span class="font-medium"><?php echo $jj['company']; ?></span> </td>
                                        </tr>
                                        <tr>
                                            <td>JAWATAN</td>
                                            <td><span class="font-medium"><?php echo $jj['position']; ?></span> </td>
                                        </tr>
                                        <tr>
                                            <td>Deskripsi</td>
                                            <td><span class="font-medium"><?php echo str_replace("--n--","<br>",$jj['detail']);   ?></span> </td>
                                        </tr>
                                        <tr>
                                            <td>Tarikh Mula</td>
                                            <td><span class="font-medium"><?php echo $jj['sdate']; ?></span> </td>
                                        </tr>
                                        <tr>
                                            <td>Tarikh Tamat</td>
                                            <td><span class="font-medium"><?php echo $jj['closing_date']; ?></span> </td>
                                        </tr>
                                        <tr>
                                            <td>Gaji</td>
                                            <td><span class="font-medium"><?php echo $jj['salary']; ?></span> </td>
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
                                            <td>NAMA JAWATAN</td>
                                            <td><span class="font-medium"><?php echo $jj['name']; ?></span> </td>
                                        </tr>
                                        <tr id="printform">
                                            <td colspan="2">
                                                <form action="jobs.php" method="post">
                                              <button type="submit"  class="btn btn-outline-cyan" value="Cetak" name="printstd" onclick="printDiv('printview')">Cetak</button>   
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!-- ======== Jobs List ================== -->
            <?php if(isset($_POST['search'])) {
                $jlist = getJobsByUserId($loginuser['id'], $_POST['name']);
            } else 
            {
                $jlist = getJobsByUserId($loginuser['id'],'');
            }
            ?>
                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Senarai Tawaran</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">Nama Tawaran</th>
                                            <th class="border-top-0">Nama Majikan</th>
                                            <th class="border-top-0">Jawatan</th>
                                            <th class="border-top-0">Tarikh Mula</th>
                                            <th class="border-top-0">Tarikh Tamat</th>
                                            <th class="border-top-0">Status</th>
                                            <th class="border-top-0">Kemaskini</th>
                                            <th class="border-top-0">Papar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($jlist != NULL)
                                            while($std = $jlist->fetch_assoc()){ ?>
                                        <tr>    
                                            <td><span class="font-medium"><?php echo $std['name']; ?></span> </td>
                                            <td><span class="font-medium"><?php echo $std['company']; ?></span> </td>
                                            <td><span class="font-medium"><?php echo $std['position']; ?></span> </td>
                                            <td><span class="font-medium"><?php echo $std['sdate']; ?></span> </td>
                                            <td><span class="font-medium"><?php echo $std['closing_date']; ?></span> </td>
                                            <td><span class="font-medium"><?php echo $std['status']; ?></span> </td>
                                            <?php if((int)$std['company_id'] == ABM_COMANY_ID){ ?>
                                            <td><a href="jobs_edit.php?edit=<?php echo $std['id']?>#edit"><span class="label label-success label-rounded">Kemaskini</span></a></td>
                                            <?php } else echo '<td></td>'; ?>
                                            <td><a href="jobs.php?view=<?php echo $std['id']?>#edit"><span class="label label-success label-rounded">Papar</span></a></td>                                            
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            
            
            
            
            
            </div>
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