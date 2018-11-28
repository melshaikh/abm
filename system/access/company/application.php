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
    <link href="switch_style.css" rel="stylesheet">
</head>
<script>
    function printDiv(divName){
                        
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
                        var x = document.getElementById("printform");
                        x.style.display = "none";
			window.print();
			document.body.innerHTML = originalContents;
		}
    function changeStudent(ic,jid,act){
        if(act == 'REJECT')
            var urr = '../../../apis/api/studenttojob.php?jobdoo=x&jobact=REJECTED&std_ic='+ic+'&job_id='+jid;
        else 
            var urr = '../../../apis/api/studenttojob.php?jobdoo=x&jobact=ACCEPTED&std_ic='+ic+'&job_id='+jid;
            var res = httpGet(urr);
            window.location.href = 'jobs_application.php?jid=' +jid+'&application=a&error='+res;
    }
    function httpGet(theUrl)
        {
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
            xmlHttp.send( null );
            return xmlHttp.responseText;
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
                
                
                <?php if(isset($_GET['application'])){ 
                    $jx = getJobsById($_GET['jid']);
                    $j_list = getApplicationListByJobId($_GET['jid']);
                    ?>
                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Senarai Pemohon</h4>
                                <b> <?php echo $jx['position'].' ('.$jx['company'].')' ?></b>
                                <br><p> <?php echo $jx['name'].' ('.$jx['date'].')' ?></p>
                                <?php if(isset($error)){ ?>
                                <h4 style="color: red;"><?php echo $error; unset($error); ?></h4>
                                <?php } ?>
                                <?php if(isset($_GET['error'])){ ?>
                                <p style="color: red;"><?php echo $_GET['error']; unset($_GET['error']);?></p>
                                <?php } ?>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">Nama Pelatih</th>
                                            <th class="border-top-0">No. KP</th>
                                            <th class="border-top-0">Tarikh Permohonan</th>
                                            <th class="border-top-0">Status Permohonan</th>
                                            <th class="border-top-0">Profil Pelatih </th>
                                            <th class="border-top-0">Tawar/Tolak</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($j_list != NULL)
                                            while($x = $j_list->fetch_assoc()){ ?>
                                        <tr>
                                            <td><?php echo $x['name']?></td>
                                            <td><?php echo $x['ic']?></td>
                                            <td><?php echo $x['date']?></td>
                                            <td><?php echo $x['status']?></td>
                                            <td><a href="jobs_application.php?jid=<?php echo $jx['id']?>&view=<?php echo $x['id']?>#view"><span class="label label-info label-rounded">View</span></a></td>
                                            <td>
                                                <?php if(strcmp($x['status'],'ACCEPTED') == 0 OR strcmp($x['status'],'CONFIRMED') == 0){ ?>
                                                <button type="button" class="btn btn-toggle active" data-toggle="button" aria-pressed="true" autocomplete="off" onclick="changeStudent(<?php echo "'".$x['ic']."','".$jx['id']."','REJECT'"; ?>);">
                                                <?php } else { ?>
                                                    <button type="button" class="btn btn-toggle" data-toggle="button" aria-pressed="false" autocomplete="off" onclick="changeStudent(<?php echo "'".$x['ic']."','".$jx['id']."','ACCEPT'"; ?>);">
                                                <?php } ?>
                                                    <div class="handle"></div>
                                                </button>
                                            </td>
                                        </tr>
                                            <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php if(isset($_GET['view']))
                    { 
                    $std = getStudentByID($_GET['view']); ?>
                <div class="row" id="view">
                    <!-- column -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">MAKLUMAT PELATIH</h4>
                                <?php if(isset($error)){ ?>
                                <p style="color: red;"><?php echo $error; ?></p>
                                <?php } ?>
                                <div class="d-flex align-items-center flex-row m-t-30">
                                    <div class="col-sm-2 text-info" style="width:20%; height: 20%; "><img  style="width:70%; height: auto; " src="<?php if(strcmp($std['image'],'') != 0) echo '../../../user_files/'.$std['image']; else echo '../../../user_files/unknown.png'; ?>"/> <span></span></div>
                                    <div class="m-l-10">
                                        <h3 class="m-b-0"><?php echo $std['name'] ?></h3>
                                    </div>
                                </div>
                                <table class="table table-row-variant m-t-20">
                                    <tbody>
                                        <tr>
                                            <td>Terima/Tolak</td>
                                            <td>
                                                <?php
                                                $sql = "SELECT * FROM `jobtostudent` WHERE `student_ic` = '".$std['ic']."' AND `job_id` = '".$_GET['jid']."'";
                                                $x = $db->query($sql)->fetch_assoc();
                                                if(strcmp($x['status'],'ACCEPTED') == 0 OR strcmp($x['status'],'CONFIRMED') == 0){ ?>
                                                <button type="button" class="btn btn-toggle active" data-toggle="button" aria-pressed="true" autocomplete="off" onclick="changeStudent(<?php echo "'".$std['ic']."','".$_GET['jid']."','REJECT'"; ?>);">
                                                <?php } else { ?>
                                                    <button type="button" class="btn btn-toggle" data-toggle="button" aria-pressed="false" autocomplete="off" onclick="changeStudent(<?php echo "'".$std['ic']."','".$_GET['jid']."','ACCEPT'"; ?>);">
                                                <?php } ?>
                                                    <div class="handle"></div>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted" style="width: 20%">NAMA</td>
                                            <td class="font-medium"><?php echo $std['name'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">No. KP</td>
                                            <td class="font-medium"><?php echo $std['ic'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Email</td>
                                            <td class="font-medium"><?php echo $std['email'] ?></td>
                                        </tr>                                        
                                        <tr>
                                            <td class="text-muted">Sesi</td>
                                            <td class="font-medium"><?php echo getcohortbyid($std['sesi_id'])['name'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Tred</td>
                                            <td class="font-medium"><?php echo getTredBYStudentID($std['id'])['name'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Bidang</td>
                                            <td class="font-medium"><?php echo getBidangBYStudentID($std['id'])['name'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Alamat</td>
                                            <td class="font-medium"><?php echo $std['address'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Telefon</td>
                                            <td class="font-medium"><?php echo $std['phone1'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Akademik</td>
                                            <td class="font-medium"><?php echo $std['akad'] ?></td>
                                        </tr>
                                        
                                        <tr>
                                            <td class="text-muted">Status Kad Hijau</td>
                                            <td class="font-medium"><?php echo $std['kadhijau'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Status Pekerjaan</td>
                                            <td class="font-medium"><?php echo $std['working_status'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Pekerjaan</td>
                                            <td class="font-medium"><?php echo $std['working_field'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Syarikat</td>
                                            <td class="font-medium"><?php echo $std['company'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Gaji</td>
                                            <td class="font-medium"><?php echo $std['gaji'] ?></td>
                                        </tr>                                        
                                        <tr>
                                            <td class="text-muted">Resume Pelatih</td>
                                            <td class="font-medium"><?php if(strcmp($std['cv_file'],'') != 0) { ?>
                                                <a href="../../../user_files/<?php echo $std['cv_file'] ?>">Muat Turun CV</a>
                                            <?php } else     echo 'N/A'; ?></td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                                <form class="form-horizontal m-t-30" action="jobs_application.php" method="post" id="printform">
                                <div class="col-sm-4 offset-sm-4">
                                    <button type="submit"  class="btn btn-outline-cyan" value="Cetak" name="printstd" onclick="printDiv('view')">Cetak</button> 
                                </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                <?php } 
                ?>
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