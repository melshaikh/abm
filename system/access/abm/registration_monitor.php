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
    <link href="reg_switch_style.css" rel="stylesheet">
</head>
<script type="text/javascript">
function viewSesi()
{
    var y = document.getElementById("yselect");
    var yid = y.options[y.selectedIndex].value;
    if(yid != -1){
    window.location.href = "registration_monitor.php?year=" + yid;
    } else {
        window.location.href = "registration_monitor.php?error=SILA PILIH TAHUN";
    }    
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
function RegStudent(id,act,sid){
    
        if(act == 'reg')
            var urr = 'regstudent.php?reg=yes&sid='+id;
        if(act == 'unreg')
            var urr = 'regstudent.php?unreg=yes&sid='+id;
       
        var res = httpGet(urr);
    window.location.href = 'registration_monitor.php?edit=' +sid+'&errorx='+res;
    }
function padam(num){
    if (confirm("Are you sure you wont to delete this registration session!")) { 
            var ul = "deletesession.php?del="+num;
            var res = httpGet(ul);
            window.location.href = 'registration_monitor.php?error='+res;
            //alert("DELETE SESSION NUMBER : "+num);
            } 
    
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
        if(isset($_POST['addreg']))
        {
            $sql = "INSERT INTO `reg_session` (`id`,`name`,`staff_id`,`sesi_id`,`status`,`date`) "
                    . "VALUES (NULL,'".$loginuser['name']."', '".$loginuser['id']."', '".$_POST['sesi_id']."', 'ACTIVE', '".date('Y-m-d')."')";
            if($db->query($sql)){
                $id = $db->insert_id;
                $code = $id.$loginuser['name'].date('Y-m-d');
                $sql = "UPDATE `reg_session` SET `code` = '".$code."' WHERE `id` = '".$id."'";
                $db->query($sql);
                $error = "Sesi pendaftaran Baru telah di Berjaya";
            } else $error = "Sesi pendaftaran Baru telah di Gagal";
        }
             
        if(isset($_POST['stdedit']))
        {
            $stdo = getStudentByID($_POST['std_id']);
            $pass = $stdo['pass'];
            if(strcmp($stdo['ic'],$_POST['icn']) != 0)
            {
                $pass = hash("sha512",$_POST['icn']);;
            }
            $sql = "UPDATE `studentstemp` SET `name` = '".$_POST['name']."' ,`ic` = '".$_POST['icn']."' , `email` = '".$_POST['email']."' , `address` = '".$_POST['address']."' "
                    . ", `phone1` = '".$_POST['phone']."' ,`sesi_id` = '".$_POST['sesi_id']."' , `working_status` = '".$_POST['working_status']."' "
                    . ", `working_field` = '".$_POST['kerjaan']."' , `company` = '".$_POST['company']."' , `gaji` = '".$_POST['gaji']."' , `akad` = '".$_POST['akad']."' "
                    . ",`kadhijau` = '".$_POST['kadhijau']."' ,`pass` = '".$pass."' "
                    . "WHERE `id` = '".$_POST['std_id']."'";
            if($db->query($sql))
            {
                $error = 'Student records is changed';
            }else{
                $error = 'Problem: '.$sql;
            }
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
                
                
            <?php if(isset($_GET['edit'])) { 
                $regs = getRegSessionByID($_GET['edit']);
                $std_list = getListofStudentToRegByResSessionID($_GET['edit']);
                $sesi = getcohortbyid($regs['sesi_id']);
                ?>
            <div class="row" id="view">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Senari Pelatih Yang Daftar Untuk (<?php echo $sesi['name'].' - '. getTredAndAreaBySesiId($sesi['id'])['tred_name'] ?>) </h4>
                                <p class="float-right"> Pelatih Count <span class="label label-success label-rounded "><?php if($std_list != NULL) echo $std_list->num_rows; else echo '0';  ?></span></p>
                                <?php if(isset($_GET['errorx'])){
                                    echo'<p>'.$_GET['errorx'].'</P>';
                                    unset($_GET['errorx']);
                                } ?>
                            </div>
                            <div class="table-responsive">
                               <?php  if($std_list != NULL) { ?>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nama Pelatih</th>
                                            <th>No. KP Pelatih</th>
                                            <th>Kemaskini</th>
                                            <th>Daftar/Padam</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($std = $std_list->fetch_assoc()) { ?>
                                        <tr> 
                                            <td><?php echo $std['name']; ?></td>
                                            <td><?php echo $std['ic']; ?></td>
                                            <td><a href="registration_monitor.php?editstd=<?php echo $std['id']?>&s_id=<?php echo $sesi['id'] ?>#edit"><span class="label label-warning label-rounded">Kemaskini</span></a></td>
                                            <td>
                                                <?php if(strcmp($std['isregistered'],'1') == 0){ ?>
                                                <button type="button" class="btn btn-toggle active" data-toggle="button" aria-pressed="true" autocomplete="off" onclick="RegStudent(<?php echo "'".$std['id']."','unreg','".$_GET['edit']."'"; ?>);">
                                                <?php } else { ?>
                                                    <button type="button" class="btn btn-toggle" data-toggle="button" aria-pressed="false" autocomplete="off" onclick="RegStudent(<?php echo "'".$std['id']."','reg','".$_GET['edit']."'"; ?>);">
                                                <?php } ?>
                                                    <div class="handle"></div>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        
                                    </tbody>
                                </table>
                               <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            
            <?php if(isset($_GET['editstd'])){ ?>
            <?php 
                    $std = getUnregisteredStudentByID($_GET['editstd']); 
                    ?>
                <div class="row" id="kemas">
                    <!-- column -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">MAKLUMAT PELATIH</h4>
                                <div class="d-flex align-items-center flex-row m-t-30">
                                    <div class="display-5 text-info" style="width:20%; height: 20%; "><img  style="width:90%; height: auto; " src="<?php if(strcmp($std['image'],'') != 0) echo '../../../user_files/'.$std['image']; else echo '../../../user_files/unknown.png'; ?>"/> <span></span></div>
                                    <div class="m-l-10">
                                        <h3 class="m-b-0"><?php echo $std['name'] ?></h3>
                                    </div>
                                </div>
                                <form class="form-horizontal m-t-30" action="registration_monitor.php" method="post">
                                <table class="table table-row-variant table-striped m-t-20">
                                    <tbody>
                                        <tr>
                                            <td class="text-muted" style="width: 20%">NAMA</td>
                                            <td class="font-medium" ><input style="width: 50%" type="text" name="name" value="<?php echo $std['name'] ?>" /></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">No. KP</td>
                                            <td class="font-medium"><input style="width: 50%" type="text" name="icn" value="<?php echo $std['ic'] ?>" /></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Email</td>
                                            <td class="font-medium"><input style="width: 50%" type="text" name="email" value="<?php echo $std['email'] ?>" /></td>
                                        </tr>                                        
                                        <tr>
                                            <td class="text-muted">Sesi</td>
                                            <td class="font-medium">
                                                <select name="sesi_id">
                                                    <?php $ss = getCohortList('sdate');
                                                    while($s= $ss->fetch_assoc()){ 
                                                        if($std['sesi_id'] == $s['id']){
                                                        ?>
                                                    <option value="<?php echo $s['id']?>" selected=""><?php echo $s['name'].' - '. getCourseByID($s['tred_id'])['name'] ?></option>
                                                    <?php }else { ?>
                                                    <option value="<?php echo $s['id']?>"><?php echo $s['name'].' - '. getCourseByID($s['tred_id'])['name'] ?></option>
                                                    <?php } } ?>
                                                </select>
                                            </td>
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
                                            <td class="font-medium"><textarea style="width: 50%" type="text" name="address"><?php echo $std['address'] ?></textarea></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Telefon</td>
                                            <td class="font-medium"><input style="width: 50%" type="number" name="phone" value="<?php echo $std['phone1'] ?>" /></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Akademik</td>
                                            <td class="font-medium"><input style="width: 50%" type="text" name="akad" value="<?php echo $std['akad'] ?>" /></td>
                                        </tr>
                                        
                                        <tr>
                                            <td class="text-muted">Status Kad Hijau</td>
                                            <td class="font-medium"><input style="width: 50%" type="date" name="kadhijau" value="<?php echo $std['kadhijau'] ?>" /></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Status Pekerjaan</td>
                                            <td class="font-medium"><input style="width: 50%" type="text" name="working_status" value="<?php echo $std['working_status'] ?>" /></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Pekerjaan</td>
                                            <td class="font-medium"><input style="width: 50%" type="text" name="kerjaan" value="<?php echo $std['working_field'] ?>" /></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Syarikat</td>
                                            <td class="font-medium"><input style="width: 50%" type="text" name="company" value="<?php echo $std['company'] ?>" /></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Gaji (RM) </td>
                                            <td class="font-medium"><input style="width: 50%" type="number" name="gaji" value="<?php echo $std['gaji'] ?>" /></td>
                                        </tr>                                        
                                        <tr>
                                            <td class="text-muted">Resume Pelatih</td>
                                            <td class="font-medium"><?php if(strcmp($std['cv_file'],'') == 0) echo 'Not Found'; else echo '<a href="../../../user_files/'.$std['cv_file'].'">Download</a>'; ?></td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                                
                                <div class="col-sm-4 offset-sm-4">
                                    <input type="hidden" name="std_id" value="<?php echo $std['id'] ?>"/>
                                    <input style="margin-left: 5%" type="submit"  class="btn btn-outline-cyan" value="Kemaskini" name="stdedit"/>
                                    <!--<input type="submit"  class="btn btn-outline-cyan" value="Cetak" name="stdprint"/>--> 
                                </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            <?php } ?>    
                
                <!-- ======== Bidang List ================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Tambah Sesi Pendaftaran Baru</h4>
                                <?php if(isset($error)){ ?>
                                <h4 style="color: red;"><?php echo $error; unset($error); ?></h4>
                                <?php } ?>
                            </div>                            
                            <div class="table-responsive">
                                <div class="col-sm-12">
                                    <form class="form-horizontal form-material" action="registration_monitor.php" method="post">                                    
                                    <div class="form-group">
                                        <label class="col-md-12">Pilih Tahun</label>                                        
                                        <select name="year_id" class="custom-select col-sm-4" onChange="viewSesi()" id="yselect">
                                            <option value="-1">Pilih Tahun                                            
                                            </option>
                                            <?php
                                            $ys = getYears();
                                            if($ys != NULL)
                                                while($ya = $ys->fetch_assoc()){
                                                if(isset($_GET['year']))
                                                    {
                                                        if(strcmp($_GET['year'],$ya['name']) == 0)
                                                                echo '<option value="'.$ya['name'].'" selected>'.$ya['name'].'</option>';
                                                        else echo '<option value="'.$ya['name'].'">'.$ya['name'].'</option>';
                                                    }else 
                                                    { ?>
                                                        <option value="<?php echo $ya['name']?>"><?php echo $ya['name']?></option>                                            
                                              <?php } 
                                                 } ?>
                                        </select>                                        
                                    </div>
                                    <?php if(isset($_GET['year'])){ ?>
                                    <div class="form-group">
                                        <label class="col-md-12">Pilih Sesi</label>                                        
                                        <select name="sesi_id" class="custom-select col-sm-4">
                                            <?php
                                            $ss = getCohortBYYear($_GET['year']);
                                            if($ss != NULL)
                                                while($s = $ss->fetch_assoc()){
                                            ?>
                                            <option value="<?php echo $s['id']?>"><?php echo $s['name'].' - '.getCourseByID($s['tred_id'])['name']?></option>
                                                <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Nama</label>                                        
                                        <input type="text" placeholder="Nama Sesi Pendaftaran" class="form-control form-control-line" name="name" required>
                                        
                                    </div>
                                    
                                    <div class="form-group">                                        
                                            <input type="submit" name="addreg" class="btn btn-outline-cyan" value="Hantar"/>
                                    </div>
                                    <?php } ?>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            <!-- ================= LIST OF COMAPNY========================== -->
            <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Senarai Sesi Pendaftaran Yang aktif</h4>
                                <?php if(isset($_GET['error'])){ ?>
                                <h4 style="color: red;"><?php echo $_GET['error']; unset($_GET['error']); ?></h4>
                                <?php } ?>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <?php      
                                    $std_list = getRegSessionByStaffId($loginuser['id']);
                                    ?>
                                    <thead>
                                        <tr>
                                            <th class="border-top-0" style="width: 20%">Nama Sesi Pendaftaran</th>
                                            <th class="border-top-0" style="width: 30%">Sesi</th>
                                            <th class="border-top-0" style="width: 10%">Tarikh</th>
                                            <th class="border-top-0" style="width: 10%">Status</th>
                                            <th class="border-top-0" style="width: 10%">Kemaskini</th>
                                            <th class="border-top-0" style="width: 10%">Buka Sesi</th>
                                            <th class="border-top-0" style="width: 10%">Padam</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($std_list != NULL)
                                            while($std = $std_list->fetch_assoc()){ 
                                            $s = getcohortbyid($std['sesi_id']);
                                            ?>
                                        <tr>    
                                            <td><span class="font-medium"><?php echo $std['name']; ?></span> </td>
                                            <td><span class="font-medium"><?php echo $s['name'].' - '. getTredAndAreaBySesiId($s['id'])['tred_name']; ?></span> </td>
                                            <td><span class="font-medium"><?php echo $std['date']; ?></span> </td>
                                            <td><span class="font-medium"><?php echo $std['status']; ?></span> </td>
                                            <td><a href="registration_monitor.php?edit=<?php echo $std['id']?>#edit"><span class="label label-warning label-rounded">Kemaskini</span></a></td>
                                            <td><a target="_blank" href="registration_group.php?open=<?php echo $std['id']?>#view"><span class="label label-success label-rounded">Buka</span></a></td>                                            
                                            <td><button class="label label-danger label-rounded" onclick="padam(<?php echo $std['id']?>);">Padam</button></td>
                                            
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- ================= LIST OF COMAPNY========================== -->
            
            
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