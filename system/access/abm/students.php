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
    window.location.href = "students.php?yid=" + yid;
    //alert(e);
    //
    
}
function viewyearss()
{
    var e = document.getElementById("selectyearss");
    var yid = e.options[e.selectedIndex].value;
    window.location.href = "students.php?yidss=" + yid;
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
        
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!--side bar here-->
        <?php printpagehead(isLecturerLoggedIn()['image']);
        printsidebar(); ?>
        
        <?php
            function setBidang($bidang,$sid){
                include '../tols/config.php';
                $sql = NULL;
                if(strcmp($bidang,"bdb")==0)
                $sql = "UPDATE `students` SET `bdb` = '1', `blb` = '0' , `bsdb` = '0',`bslb`='0',`sbdb`='0',`sblb`='0',`tb`='0',`ll`='0' WHERE `students`.`id` = ".$sid;
                if(strcmp($bidang,"blb")==0)
                $sql = "UPDATE `students` SET `bdb` = '0', `blb` = '1' , `bsdb` = '0',`bslb`='0',`sbdb`='0',`sblb`='0',`tb`='0',`ll`='0' WHERE `students`.`id` = ".$sid;
                if(strcmp($bidang,"bsdb")==0)
                $sql = "UPDATE `students` SET `bdb` = '0', `blb` = '0' , `bsdb` = '1',`bslb`='0',`sbdb`='0',`sblb`='0',`tb`='0',`ll`='0' WHERE `students`.`id` = ".$sid;
                if(strcmp($bidang,"bslb")==0)
                $sql = "UPDATE `students` SET `bdb` = '0', `blb` = '0' , `bsdb` = '0',`bslb`='1',`sbdb`='0',`sblb`='0',`tb`='0',`ll`='0' WHERE `students`.`id` = ".$sid;
                if(strcmp($bidang,"sbdb")==0)
                $sql = "UPDATE `students` SET `bdb` = '0', `blb` = '0' , `bsdb` = '0',`bslb`='0',`sbdb`='1',`sblb`='0',`tb`='0',`ll`='0' WHERE `students`.`id` = ".$sid;
                if(strcmp($bidang,"sblb")==0)
                $sql = "UPDATE `students` SET `bdb` = '0', `blb` = '0' , `bsdb` = '0',`bslb`='0',`sbdb`='0',`sblb`='1',`tb`='0',`ll`='0' WHERE `students`.`id` = ".$sid;
                if(strcmp($bidang,"tb")==0)
                $sql = "UPDATE `students` SET `bdb` = '0', `blb` = '0' , `bsdb` = '0',`bslb`='0',`sbdb`='0',`sblb`='0',`tb`='1',`ll`='0' WHERE `students`.`id` = ".$sid;
                if(strcmp($bidang,"ll")==0)
                $sql = "UPDATE `students` SET `bdb` = '0', `blb` = '0' , `bsdb` = '0',`bslb`='0',`sbdb`='0',`sblb`='0',`tb`='0',`ll`='1' WHERE `students`.`id` = ".$sid;

                if($sql != NULL){
                    if($db->query($sql))
                        return 0;
                    else return 1;
                }else        return 1;



            }        
        if(isset($_POST['stdedit']))
        {
            $stdo = getStudentByID($_POST['std_id']);
            $pass = $stdo['pass'];
            if(strcmp($stdo['ic'],$_POST['icn']) != 0)
            {
                $pass = hash("sha512",$_POST['icn']);;
            }
            $sql = "UPDATE `students` SET `name` = '".$_POST['name']."' ,`ic` = '".$_POST['icn']."' , `email` = '".$_POST['email']."' , `address` = '".$_POST['address']."' "
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
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">MAKLUMAT PELATIH</h4>
                        
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
                <div class="row">
                    <div class="col-6">
                        <div class="card card-body">
                            <h4 class="card-title">Cari Pelatih</h4>
                            <form class="form-horizontal m-t-30" action="students.php" method="post">
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-2">KP Pelatih</label>
                                    <input type="text" class="form-control col-sm-6" name="icn">                                    
                                </div>
                                <div class="col-sm-6 offset-sm-2">
                                        <input type="submit"  class="btn btn-outline-cyan" value="Cari" name="searchbyic"/>
                                    </div>
                                <div class="form-group row p-t-20">
                                    
                                    <label id="addcode" class="col-sm-2">Pilih Tahun</label>
                                    <select id="selectyear" class="custom-select col-sm-6" name="year"  onChange="viewroom()">
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
                                <?php if(isset($_GET['yid'])) { ?>
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-1">Pilih Bidang</label>
                                    <select id="selectbidang" class="custom-select col-sm-6" name="bidang"  onChange="viewbidang()">
                                        <option value="-1">All</option>
                                        <?php $bds = getAreaByYear($_GET['yid']);
                                            while ($bd = $bds->fetch_assoc()){ 
                                            if(isset($_GET['bid']))
                                            {
                                                if(strcmp($_GET['yid'],'-1') != 0){
                                                if(strcmp($_GET['bid'],$bd['id']) == 0)
                                                        { ?>
                                                        <option value="<?php echo $bd['id']; ?>" selected ><?php echo $bd['name']; ?></option>
                                                <?php   } 
                                                else 
                                                        { ?> 
                                                        <option value="<?php echo $bd['id']; ?>"><?php echo $bd['name']; ?></option>
                                                <?php   }  
                                            }else { ?> <option value="<?php echo $bd['id']; ?>"><?php echo $bd['name']; ?></option> <?php }
                                            } else 
                                            { ?>
                                                    <option value="<?php echo $bd['id']; ?>"><?php echo $bd['name']; ?></option>
                                    <?php   }  ?>
                                                    
                                            <?php } ?>
                                    </select>
                                </div>
                                <?php } ?>
                                <?php if(isset($_GET['bid'])) { ?>
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-1">Pilih Tred</label>
                                    <select id="selectbidang" class="custom-select col-sm-6" name="tred">
                                        <option value="-1">All</option>
                                        <?php $bds = getTredByYearAndBidang($_GET['yid'],$_GET['bid']);
                                            while ($bd = $bds->fetch_assoc()){ 
                                            if(isset($_GET['bid']))
                                            {
                                                if(strcmp($_GET['bid'],'-1') != 0){
                                                if(strcmp($_GET['bid'],$bd['id']) == 0)
                                                        { ?>
                                                        <option value="<?php echo $bd['id']; ?>" selected ><?php echo $bd['name']; ?></option>
                                                <?php   } 
                                                else 
                                                        { ?> 
                                                        <option value="<?php echo $bd['id']; ?>"><?php echo $bd['name']; ?></option>
                                                <?php   } 
                                            } else { ?> <option value="<?php echo $bd['id']; ?>"><?php echo $bd['name']; ?></option> <?php } 
                                            } else 
                                            { ?>
                                                    <option value="<?php echo $bd['id']; ?>"><?php echo $bd['name']; ?></option>
                                    <?php   }  ?>
                                                    
                                            <?php } ?>
                                    </select>
                                </div>
                                <?php } ?>                                
                                <div class="form-group row p-t-20">
                                <div class="col-sm-8 offset-sm-2">
                                    <input type="submit" class="btn btn-outline-primary" value="Cari" name="searchbtn"/>
                                </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card card-body">
                            <h4 class="card-title">Cari Pelatih</h4>
                            <form class="form-horizontal m-t-30" action="students.php" method="post">
                                
                                <div class="form-group row p-t-20">
                                    
                                    <label id="addcode" class="col-sm-2">Pilih Tahun</label>
                                    <select id="selectyearss" class="custom-select col-sm-6" name="year"  onChange="viewyearss()">
                                        <option value="-1">All</option>
                                        <?php $bds = getYears();
                                            while ($bd = $bds->fetch_assoc()){ 
                                            if(isset($_GET['yidss']))
                                            {   if(strcmp($_GET['yidss'],'-1') != 0)
                                                    {
                                                if(strcmp($_GET['yidss'],$bd['name']) == 0)
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
                                <?php if(isset($_GET['yidss'])) { ?>
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-2">Pilih Sesi - Tred</label>
                                    <select id="selectbidang" class="custom-select col-sm-6" name="sesi_id"  >
                                        <option value="-1">All</option>
                                        <?php $bds = getCohortBYYear($_GET['yidss']);
                                            while ($bd = $bds->fetch_assoc()){ 
                                            if(isset($_GET['bid']))
                                            {
                                                if(strcmp($_GET['yid'],'-1') != 0){
                                                if(strcmp($_GET['bid'],$bd['id']) == 0)
                                                        { ?>
                                        <option value="<?php echo $bd['id']; ?>" selected ><?php echo $bd['name'].' - '. getTredAndAreaBySesiId($bd['id'])['tred_name']; ?></option>
                                                <?php   } 
                                                else 
                                                        { ?> 
                                                        <option value="<?php echo $bd['id']; ?>"><?php echo $bd['name'].' - '. getTredAndAreaBySesiId($bd['id'])['tred_name']; ?></option>
                                                <?php   }  
                                            }else { ?> <option value="<?php echo $bd['id']; ?>"><?php echo $bd['name'].' - '. getTredAndAreaBySesiId($bd['id'])['tred_name']; ?></option> <?php }
                                            } else 
                                            { ?>
                                                    <option value="<?php echo $bd['id']; ?>"><?php echo $bd['name'].' - '. getTredAndAreaBySesiId($bd['id'])['tred_name']; ?></option>
                                    <?php   }  ?>
                                                    
                                            <?php } ?>
                                    </select>
                                </div>
                                <?php } ?>
                                                                
                                <div class="form-group row p-t-20">
                                <div class="col-sm-8 offset-sm-2">
                                    <input type="submit" class="btn btn-outline-primary" value="Cari" name="searchbtnsesi"/>
                                </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
                
                <?php if(isset($_POST['searchbtn']) OR isset($_POST['searchbyic']) OR isset($_POST['searchbtnsesi'])){
                    if(!isset($_POST['year']))
                        $yy = '-1';
                    else $yy = $_POST['year'];
                    if(!isset($_POST['bidang']))
                        $_POST['bidang'] = '-1';
                    if(!isset($_POST['tred']))
                        $_POST['tred'] = '-1';
                    if(isset($_POST['searchbtn']))                    
                        { 
                        $std_list = getStudentList($yy,$_POST['tred'],$_POST['bidang']);                          
                        }
                    if(isset($_POST['searchbyic'])) { 
                        $std_list = getStudentListByIC($_POST['icn']); 
                        
                    }
                    
                    if(isset($_POST['searchbtnsesi'])) { 
                        $std_list = getStudentListBySesiID($_POST['sesi_id']); 
                        
                    }
                 ?>
                <!-- ======== Student List ================== -->
                <div class="row" id="printlist">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Senarai Pelatih</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">Nama</th>
                                            <th class="border-top-0">No. KP</th>
                                            <th class="border-top-0">Tred</th>
                                            <th class="border-top-0">Kemaskini</th>
                                            <th class="border-top-0">Papar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($std_list != NULL)
                                            while($std = $std_list->fetch_assoc()){ ?>
                                        <tr>                                            
                                            <td class="txt-oflo"><?php echo $std['name'] ?></td>
                                            <td><span class="font-medium"><?php echo $std['ic'] ?></span> </td>
                                            <td><span class="font-medium"><?php echo getTredBYStudentID($std['id'])['name'] ?></span> </td>
                                            <td><a href="students.php?edit=<?php echo $std['id'] ?>#edit"><span class="label label-success label-rounded">Edit</span></a></td>
                                            <td><a href="students.php?view=<?php echo $std['id']?>#view"><span class="label label-info label-rounded">Papar</span></a></td>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <td colspan="2">
                                              <form class="form-horizontal m-t-30" action="students.php" method="post" id="printform">
                                                <div class="col-sm-4 offset-sm-4">
                                                    <button type="submit"  class="btn btn-outline-cyan" value="Cetak" name="printstd" onclick="printDiv('printlist')">Cetak</button> 
                                                </div>
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
                <?php if(isset($_GET['edit']) OR isset($_POST['kemas'])){
                    if(isset($_GET['edit']))
                    $std = getStudentByID($_GET['edit']);
                    else $std = getStudentByID($_POST['std_id']);
                    ?>
                <div class="row" id="view">
                    <!-- column -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">MAKLUMAT PELATIH</h4>
                                <div class="d-flex align-items-center flex-row m-t-30">
                                        <img  class="img-circle img-responsive" style="max-width: 20%;" src="<?php if(strcmp($std['image'],'') != 0) 
                                                echo '../../../user_files/'.$std['image']; else echo '../../../user_files/unknown.png'; ?>"/>
                                    
                                    <div class="m-l-10">
                                        <h3 class="m-b-0"><?php echo $std['name'] ?></h3>
                                    </div>
                                </div>
                                <form class="form-horizontal m-t-30" action="students.php" method="post">
                                <table class="table table-row-variant table-striped m-t-20">
                                    <tbody>
                                        <tr>
                                            <td class="text-muted" style="width: 20%">Nama</td>
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
                                            <td class="text-muted">Result</td>
                                            <td class="font-medium">
                                                <select name="result">
                                                    <option value="SEDANG PELAJAR" <?php if(strcasecmp($std['result'],'SEDANG PELAJAR') == 0) echo 'selected';  ?>>SEDANG PELAJAR</option>
                                                    <option value="LULUS" <?php if(strcmp($std['result'],'LULUS') == 0) echo 'selected';  ?>>LULUS</option>
                                                    <option value="GAGAL" <?php if(strcmp($std['result'],'GAGAL') == 0) echo 'selected';  ?>>GAGAL</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">GENDER</td>
                                            <td class="font-medium">
                                                <select name="gender">
                                                    <option value="LELAKI" <?php if(strcmp($std['gender'],'LELAKI') == 0) echo 'selected';  ?>>LELAKI</option>
                                                    <option value="PERMPUAN" <?php if(strcmp($std['gender'],'PERMPUAN') == 0) echo 'selected';  ?>>PERMPUAN</option>
                                                </select>
                                            </td>
                                        </tr>                                        
                                        <tr>
                                            <td class="text-muted">Sponsor</td>
                                            <td class="font-medium"><input style="width: 50%" type="text" name="sponsor" value="<?php echo $std['sponsor'] ?>" /></td>
                                        </tr>                                        
                                        <tr>
                                            <td class="text-muted">Status Kad Hijau</td>
                                            <td class="font-medium"><input style="width: 50%" type="date" name="kadhijau" value="<?php echo $std['kadhijau'] ?>" /></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Status Pekerjaan</td>
                                            <td class="font-medium">
                                                <select name="working_status">
                                                    <option value="bdb" <?php if(strcmp($std['bdb'],'1') == 0) echo 'selected';  ?>>BEKERJA DB</option>
                                                    <option value="blb" <?php if(strcmp($std['blb'],'1') == 0) echo 'selected';  ?>>BEKERJA LB</option>
                                                    <option value="bsdb" <?php if(strcmp($std['bsdb'],'1') == 0) echo 'selected';  ?>>BEKERJA SENDIRI DB</option>
                                                    <option value="bslb" <?php if(strcmp($std['bslb'],'1') == 0) echo 'selected';  ?>>BEKERJA SENDIRI LB</option>
                                                    <option value="sbdb" <?php if(strcmp($std['sbdb'],'1') == 0) echo 'selected';  ?>>SAMPUNG BELAJAR DB</option>
                                                    <option value="sblb" <?php if(strcmp($std['sblb'],'1') == 0) echo 'selected';  ?>>SAMPUNG BELAJAR LB</option>
                                                    <option value="tb" <?php if(strcmp($std['tb'],'1') == 0) echo 'selected';  ?>>TIADA BEKERJA</option>
                                                    <option value="ll" <?php if(strcmp($std['ll'],'1') == 0) echo 'selected';  ?>>LAIN LAIN</option>                                                    
                                                </select></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Jawatan</td>
                                            <td class="font-medium"><input style="width: 50%" type="text" name="kerjaan" value="<?php echo $std['working_field'] ?>" /></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Syarikat</td>
                                            <td class="font-medium"><input style="width: 50%" type="text" name="company" value="<?php echo $std['company'] ?>" /></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Alamat Syarikat</td>
                                            <td class="font-medium"><textarea style="width: 50%" type="text" name="company_address"><?php echo $std['company_address'] ?></textarea></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Lokasi Syarikat</td>
                                            <td class="font-medium"><input style="width: 50%" type="text" name="company_state" value="<?php echo $std['company_state'] ?>" /></td>
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
                <!-- ======== Student View ================== -->
                <?php if(isset($_GET['view']) OR isset($_POST['stdedit']))
                    { 
                    if(isset($_GET['view']))
                    $std = getStudentByID($_GET['view']);
                    else $std = getStudentByID($_POST['std_id']); ?>
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
                                    <div class="display-5 text-info" style="width:20%; height: 20%; "><img  style="width:90%; height: auto; " src="<?php if(strcmp($std['image'],'') != 0) echo '../../../user_files/'.$std['image']; else echo '../../../user_files/unknown.png'; ?>"/> <span></span></div>
                                    <div class="m-l-10">
                                        <h3 class="m-b-0"><?php echo $std['name'] ?></h3>
                                    </div>
                                </div>
                                <table class="table table-row-variant m-t-20">
                                    <tbody>
                                        <tr>
                                            <td class="text-muted" style="width: 20%">Nama</td>
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
                                            <td class="font-medium"><?php echo $std['cv_file'] ?></td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                                <form class="form-horizontal m-t-30" action="students.php" method="post" id="printform">
                                <div class="col-sm-4 offset-sm-4">
                                    <input style="margin-left: 5%" type="submit"  class="btn btn-outline-cyan" value="Kemaskini" name="kemas"/>
                                    <input type="hidden" name="std_id" value="<?php echo $std['id']?> " />
                                    <button type="submit"  class="btn btn-outline-cyan" value="Cetak" name="printstd" onclick="printDiv('view')">Cetak</button> 
                                </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                <?php } 
                ?>
                <!-- ======== Search Form ================== -->
                
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