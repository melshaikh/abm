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
</head>
<?php   
        if(isset($_POST['changeimage']) AND isset($_FILES["fileToUpload"]))
        {
            $target_dir = "../../../user_files/pimage_";
            
            $uploadOk = 1;
            $already = 1;
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $thefile = 'pimage_'. $std['ic'].'.'.$imageFileType;
            $target_file = $target_dir . $std['ic'].'.'.$imageFileType;
            $error = '';
            // Check if image file is a actual image or fake image
            if(isset($_POST["changeimage"]) AND !empty($_FILES["fileToUpload"]["tmp_name"])) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    $error = $error . "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    $error = $error . "File is not an image / File Not selected.";
                    $uploadOk = 0;
                }
             
            // Check if file already exists
            if (file_exists($target_file)) {
               // $error = $error . "Sorry, file already exists.";
                $already = 0;
            }
            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 1000000) {
                $error = $error . "Sorry, your file is too large.";
                $uploadOk = 0;
                return;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                $error = $error . "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
                return;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $error = $error . "Sorry, your file was not uploaded.";
                return;
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $sql = "UPDATE `students` SET `image` = '".$thefile."' WHERE `ic` = '".$std['ic']."'";
                    $db->query($sql);
                    $std = isStudentLoggedIn();
                    $error = $error . "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                } else {
                    $error = $error . "Sorry, there was an error uploading your file.";
                }
            }
            }
        }
        if(isset($_POST['changecv']) AND isset($_FILES["cvToUpload"]["name"]))
        {
            $target_dir = "../../../user_files/cv_";
            
            $uploadOk = 1;
            $already = 1;
            $target_file = $target_dir . basename($_FILES["cvToUpload"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $thefile = 'cv_'. $std['ic'].'.'.$imageFileType;
            $target_file = $target_dir . $std['ic'].'.'.$imageFileType;
            $error = '';
            // Check if image file is a actual image or fake image
            
            // Check if file already exists
            if (file_exists($target_file)) {
               // $error = $error . "Sorry, file already exists.";
                $already = 0;
            }
            // Check file size
            if ($_FILES["cvToUpload"]["size"] > 1000000) {
                $error = $error . "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "pdf") {
                $error = $error . "Sorry, only pdf files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $error = $error . "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["cvToUpload"]["tmp_name"], $target_file)) {
                    $sql = "UPDATE `students` SET `cv_file` = '".$thefile."' WHERE `ic` = '".$std['ic']."'";
                    $db->query($sql);
                    $std = isStudentLoggedIn();
                    $error = $error . "The file ". basename( $_FILES["cvToUpload"]["name"]). " has been uploaded.";
                } else {
                    $error = $error . "Sorry, there was an error uploading your file.";
                }
            }
        }
        if(isset($_POST['stdedit']))
        {
            $stdo = getStudentByID($_POST['std_id']);
            $pass = $stdo['pass'];
            if(strcmp($stdo['ic'],$_POST['icn']) != 0)
            {
                $pass = hash("sha512",$_POST['icn']);;
            }
            $sql = "UPDATE `students` SET `email` = '".$_POST['email']."' , `address` = '".$_POST['address']."' "
                    . ", `phone1` = '".$_POST['phone']."' , `working_status` = '".$_POST['working_status']."' "
                    . ", `working_field` = '".$_POST['kerjaan']."' , `company` = '".$_POST['company']."' , `gaji` = '".$_POST['gaji']."' , `akad` = '".$_POST['akad']."' "
                    . ",`kadhijau` = '".$_POST['kadhijau']."' ,`pass` = '".$pass."' "
                    . "WHERE `id` = '".$_POST['std_id']."'";
            if($db->query($sql))
            {
                setBidangByShortAndIC($_POST['wclass'], $std['ic']);
                $error = 'Maklumat Anda telah di Kemaskini ';
                
                $std = isStudentLoggedIn();
            }else{
                $error = 'Problem: '.$sql;
            }
        }
        ?>
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
                <?php if(isset($_POST['kemas'])) { ?>
                <!-- ============================================================== -->
               <div class="row" id="view">
                    <!-- column -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">MAKLUMAT PELATIH</h4>
                                <div class="d-flex align-items-center flex-row m-t-30">
                                    <div class="display-5 text-info" style="width:20%; height: 20%; "><img  style="width:70%; height: auto; " src="<?php if(strcmp($std['image'],'') != 0) echo '../../../user_files/'.$std['image']; else echo '../../../user_files/unknown.png'; ?>"/> <span></span></div>
                                    <div class="m-l-10">
                                        <h3 class="m-b-0"><?php echo $std['name'] ?></h3>
                                    </div>                                    
                                </div>
                                <form class="form-horizontal m-t-30" action="profile.php" method="post">
                                <table class="table table-row-variant table-striped m-t-20">
                                    <tbody>
                                        <tr>
                                            <td class="text-muted" style="width: 20%">Nama</td>
                                            <td class="font-medium" ><input style="width: 50%" type="text" name="name" value="<?php echo $std['name'] ?>" readonly /></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">No. KP</td>
                                            <td class="font-medium"><input style="width: 50%" type="text" name="icn" value="<?php echo $std['ic'] ?>" readonly/></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Email</td>
                                            <td class="font-medium"><input style="width: 50%" type="text" name="email" value="<?php echo $std['email'] ?>" /></td>
                                        </tr>                                        
                                        <tr>
                                            <td class="text-muted">Sesi</td>
                                            <td class="font-medium"><?php 
                                            $s= getSesiBYStudentIC($std['ic']);
                                            if($s != NULL)
                                                while ($ss = $s->fetch_assoc())
                                            echo $ss['name'].' - '. getCourseByID($ss['tred_id'])['name'] ?>
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
                                            <td class="font-medium"><input style="width: 50%" type="text" name="akad" value="<?php echo $std['akad'] ?>" readonly/></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Kerjaan</td>
                                            <td class="font-medium">
                                                <select name="wclass">
                                                    <option value="BDB" <?php if($std['bdb'] == 1) echo 'selected'; ?>>Bekerja Dalam Bidang</option>
                                                    <option value="BLB" <?php if($std['blb'] == 1) echo 'selected'; ?>>Bekerja Luar Bidang</option>
                                                    <option value="BSDB" <?php if($std['bsdb'] == 1) echo 'selected'; ?>>Bekerja Sendiri Dalam Bidang</option>
                                                    <option value="BSLB" <?php if($std['bslb'] == 1) echo 'selected'; ?>>Bekerja Sendiri Luar Bidang</option>
                                                    <option value="SBDB" <?php if($std['sbdb'] == 1) echo 'selected'; ?>>Sambung Belajar Dalam Bidang</option>
                                                    <option value="SBLB" <?php if($std['sblb'] == 1) echo 'selected'; ?>>Sambung Belajar Luar Bidang</option>
                                                    <option value="TB" <?php if($std['tb'] == 1) echo 'selected'; ?>>Tidak Bekerja</option>
                                                    <option value="LL" <?php if($std['ll'] == 1) echo 'selected'; ?>>Lain Lain</option>
                                                </select>
                                            </td>
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
                                            <td class="font-medium"><?php if(strcmp($std['cv_file'],'') == 0) echo 'Tiada'; else echo '<a href="../../../user_files/'.$std['cv_file'].'">Download</a>'; ?></td>
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
                <!-- ============================================================== -->
                <!-- view -->
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
                                    <div class="display-5 text-info" style="width:20%; height: 20%; "><img  style="width:70%; height: auto; " src="<?php if(strcmp($std['image'],'') != 0) echo '../../../user_files/'.$std['image']; else echo '../../../user_files/unknown.png'; ?>"/> <span></span></div>
                                    <div class="m-l-10">
                                        <h3 class="m-b-0"><?php echo $std['name'] ?></h3>
                                    </div>                                    
                                </div>
                                <div class="col-md-12 offset-md-2 justify-content-center"> 
                                    <form method="post" action="resetpass.php">
                                            <input class="btn btn-outline-danger"  style="width: 20%;" type="submit" name="changepass" value="Tukar Kata Laluan"/>
                                    </form>
                                </div>
                                <div class="col-md-12 offset-md-2 justify-content-center"> 
                                    <form method="post" action="profile.php" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label class="btn btn-outline-success btn-file" style="width: 20%;">
                                                Pilih Resume File <input type="file" name="cvToUpload" style="display: none;">
                                        </label>
                                            <!--<input class="btn btn-outline-success" type="file" name="cvToUpload" value="Pilih Gambar" id="fileToUpload">-->
                                            <input class="btn btn-success" type="submit" name="changecv" value="Tukar Resume"/>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-12 offset-md-2 justify-content-center"> 
                                    <form method="post" action="profile.php" enctype="multipart/form-data">
                                        <label class="btn btn-outline-cyan btn-file" style="width: 20%;">
                                                Pilih Gambar File <input type="file" name="fileToUpload" style="display: none;">
                                        </label>
                                        <input class="btn btn-cyan" type="submit" name="changeimage" value="Tukar Gambar"/>
                                    </form>
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
                                            <td class="font-medium"><?php if(strcmp($std['cv_file'],'') !=0) { ?>
                                            <a href="../../../user_files/<?php echo $std['cv_file'] ?>">download resume</a> <?php } else { ?> Tiada <?php } ?></td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                                <form class="form-horizontal m-t-30" action="profile.php" method="post" id="printform">
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

</html><?php } else {header("Location:../../../pelatih.php?error=Unauthorized Access#services");} ?>