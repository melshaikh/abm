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
    <script type="text/javascript">
function viewroom()
{
        
    var e = document.getElementById("selectyear");
    var yid = e.options[e.selectedIndex].value;
    window.location.href = "sesi.php?yid=" + yid;
    //alert(e);
    //
    
}
function viewbidang()
{
        
    var b = document.getElementById("selectbidang");
    var y = document.getElementById("selectyear");
    var yid = y.options[y.selectedIndex].value;
    var bid = b.options[b.selectedIndex].value;
    window.location.href = "students.php?bid=" + bid+"&yid="+yid;
    //alert(e);
    //
    
}
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
        if(isset($_POST['editsesi']))
        {
            $sname = $_POST['sdate'].' -- '.$_POST['edate'];
            $aid = getAreaByCourseId($_POST['tred_id'])['id'];
            $sql = "UPDATE `cohort` SET `name` = '".$sname."', `sdate` = '".$_POST['sdate']."', `edate` = '".$_POST['edate']."' "
                    . ", `area_id` = '".$aid."', `tred_id` = '".$_POST['tred_id']."' WHERE `id` = '".$_POST['sesi_id']."'";
            if($db->query($sql))
            {
                $error = 'KEMASKINI BERJAYA';
            }else $error = 'KEMASKINI TIDAK BERJAYA';
        }
        if(isset($_POST['addsesi']))
        {
            
                        $sname = $_POST['sdate'].' -- '.$_POST['edate'];
                        $aid = getAreaByCourseId($_POST['tred_id'])['id'];
                        $sql = "INSERT INTO `cohort` (`id`, `name`,`sdate`, `edate`,`area_id`,`tred_id`) "
                                . "VALUES (NULL, '".$sname."','".$_POST['sdate']."','".$_POST['edate']."', '".$aid."' ,'".$_POST['tred_id']."')";
                        $chk = "SELECT * FROM `cohort` WHERE `name` = '".$sname."' AND `tred_id` = '".$_POST['tred_id']."'";
                        $ck = $db->query($chk);
                        if($ck->num_rows < 1){
                        if($db->query($sql)){
                            updateyears($_POST['sdate']);
                            updateyears($_POST['edate']);
                            $error = 'Sesi baru telah di tambah';
                        }else  $error = 'SESI BARU TELAH DI TAMBAH';
                        }else $error = "SESI INI TELAH WUJUD";
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
                        <h4 class="page-title">MAKLUMAT SESI</h4>
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
                    $tred = getcohortbyid($_GET['edit']); ?>
                <!-- ======== Student Edit ================== -->
                <div class="row" id="edit">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Kemaskini Sesi</h4>
                            </div>
                            <form class="form-horizontal m-t-30" action="sesi.php" method="post">
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-1">Tarikh Mula Sesi</label>
                                    <input type="date" class="form-control col-sm-4" name="sdate" value="<?php echo $tred['sdate'] ?>">                                    
                                </div>
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-1">Tarikh Tamat Sesi</label>
                                    <input type="date" class="form-control col-sm-4" name="edate" value="<?php echo $tred['edate'] ?>">                                    
                                </div>
                                <div class="form-group row p-t-20">
                                    <?php $ts = getCourses(); ?>
                                    <label class="col-sm-1">Nama Tred</label>
                                    <select name="tred_id" class="custom-select col-sm-4" >
                                        <?php while($t = $ts->fetch_assoc()){ 
                                           if($t['id'] == $tred['tred_id']){ ?>
                                        <option selected value="<?php echo $t['id'] ?>"><?php echo $t['name'] ?></option>
                                           <?php } else { ?>
                                        <option value="<?php echo $t['id'] ?>"><?php echo $t['name'] ?></option>
                                           <?php }} ?>
                                    </select>
                                                                    
                                </div>
                                <div class="col-sm-4 offset-sm-2">
                                        <input type="hidden" name="sesi_id" value="<?php echo $tred['id'] ?>"/>
                                        <input type="submit"  class="btn btn-outline-cyan" value="Kemaskini" name="editsesi"/>
                                    </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
                <?php } ?>
                
                <!-- ======== Student List ================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">TAMBAH SESI</h4>
                            <?php if(isset($error)){ ?>
                                <h4 style="color: red;"><?php echo $error; unset($error); ?></h4>
                                <?php } ?>
                        </div>
                         <form class="form-horizontal m-t-30" action="sesi.php" method="post">
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-1">Tarikh Mula Sesi</label>
                                    <input type="date" class="form-control col-sm-4" name="sdate" required="">                                    
                                </div>
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-1">Tarikh Tamat Sesi</label>
                                    <input type="date" class="form-control col-sm-4" name="edate" required="">                                    
                                </div>
                                <div class="form-group row p-t-20">
                                    <?php $ts = getCourses(); ?>
                                    <label class="col-sm-1">Nama Tred</label>
                                    <select name="tred_id" class="custom-select col-sm-4" >
                                        <?php while($t = $ts->fetch_assoc()){ ?>
                                        <option value="<?php echo $t['id'] ?>"><?php echo $t['name'] ?></option>
                                           <?php } ?>
                                    </select>
                                                                    
                                </div>
                                <div class="col-sm-4 offset-sm-2">
                                        <input type="submit"  class="btn btn-outline-success" value="Tambah Sesi" name="addsesi"/>
                                    </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">PILIH TAHUN</h4>
                        </div>
                        <form>
                            <div class="form-group row p-t-20">
                                    
                                    <label id="addcode" class="col-sm-1">Pilih Tahun</label>
                                    <select id="selectyear" class="custom-select col-sm-4" name="year"  onChange="viewroom()">
                                        <option value="-1">All</option>
                                        <?php $bds = getYears();
                                            while ($bd = $bds->fetch_assoc()){ 
                                            if(isset($_GET['yid']))
                                            {   if(strcmp($_GET['yid'],'-1') != 0)
                                                    {
                                                if(strcmp($_GET['yid'],$bd['name']) == 0)
                                                        { ?>
                                                        <option value="<?php echo $bd['name']; ?>" selected ><?php echo $bd['name']; ?></option>
                                                <?php   } 
                                                else 
                                                        { ?> 
                                                        <option value="<?php echo $bd['name']; ?>"><?php echo $bd['name']; ?></option>
                                            <?php   }  
                                            
                                                    } else { ?> <option value="<?php echo $bd['name']; ?>"><?php echo $bd['name']; ?></option> <?php }
                                            } else 
                                            { ?>
                                                    <option value="<?php echo $bd['name']; ?>"><?php echo $bd['name']; ?></option>
                                    <?php   }  ?>
                                                    
                                            <?php } ?>
                                    </select>
                                </div>
                        </form>
                        </div>
                    </div>
                </div>
                
                <?php if(isset($_GET['yid'])) { ?>
                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><?php //echo $std_list; ?></h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <?php                     
                                        $std_list = getCohortBYYear($_GET['yid']);  
                                    ?>
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
                                            <td><span class="font-medium"><?php echo $std['name'].' - '. getCourseByID($std['tred_id'])['name']; ?></span> </td>
                                            <td><a href="sesi.php?edit=<?php echo $std['id']?>#edit"><span class="label label-success label-rounded">Edit</span></a></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
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