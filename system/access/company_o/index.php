<?php include '../tols/headl.inc.php'; if(isLecturerLoggedIn()){if(strcmp(isLecturerLoggedIn()['level'],'tusb') == 0 ){
    $loginuser = isLecturerLoggedIn();
    $comp = getCompanyByID($loginuser['u_id']);
?>
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
        <?php   
        if(isset($_POST['changeimage']) AND isset($_FILES["fileToUpload"]["name"]))
        {
            $target_dir = "users_files/image_";
            
            $uploadOk = 1;
            $already = 1;
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $thefile = 'image_'. $loginuser['id'].'.'.$imageFileType;
            $target_file = $target_dir . $loginuser['id'].'.'.$imageFileType;
            $error = '';
            // Check if image file is a actual image or fake image
            if(isset($_POST["changeimage"])) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    $error = $error . "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    $error = $error . "File is not an image.";
                    $uploadOk = 0;
                }
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
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                $error = $error . "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $error = $error . "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $sql = "UPDATE `omr_users` SET `image` = '".$thefile."' WHERE `id` = '".$loginuser['id']."'";
                    $db->query($sql);
                    $loginuser = isLecturerLoggedIn();
                    $error = $error . "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                } else {
                    $error = $error . "Sorry, there was an error uploading your file.";
                }
            }
        }
        ?>

        <?php printpagehead(isLecturerLoggedIn()['image']);
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
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body row">
                                <div class="col-sm-3" style="max-height: 300">
                                    <img class="rounded-circle" src="users_files/<?php if(strcmp($loginuser['image'],'') != 0)echo $loginuser['image'];else echo '/unknown.jpg'; ?> " style="width: inherit; max-height: inherit">
                                </div>
                                <div class="col-sm-8">
                                <div class="table-responsive">
                                
                                <table class="table table-hover">
                                    <tbody>
                                        <tr><td colspan="2">Profil Pengunna</td></tr>
                                        <tr>                                            
                                            <td class="txt-oflo" style="width: 20%">Nama</td>
                                            <td><span class="font-medium"><?php echo $loginuser['name'] ?></span></td>
                                        </tr>
                                        <tr>                                            
                                            <td class="txt-oflo">Email</td>
                                            <td><span class="font-medium"><?php echo $loginuser['email'] ?></span></td>
                                        </tr>                                        
                                        <tr>                                            
                                            <td class="txt-oflo">No. KP</td>
                                            <td><span class="font-medium"><?php echo $loginuser['ic'] ?></span></td>
                                        </tr>
                                        <tr>                                            
                                            <td class="txt-oflo">Gambar Profil</td>
                                            <td>
                                                <form method="post" action="index.php"  enctype="multipart/form-data">
                                                    <label class="btn btn-outline-success btn-file" style="width: 20%;">
                                                            Pilih Gambar <input type="file" name="fileToUpload" style="display: none;">
                                                    </label>
                                                    <input class="btn btn-success" type="submit" name="changeimage" value="Upload Profile Picture"/>
                                                </form>
                                            </td>
                                        </tr>                                                                                
                                        <tr>                                            
                                            <td class="txt-oflo">Kata Laluan</td>
                                            <td>
                                                <form method="post" action="changepass.php">
                                                    <input class="btn btn-outline-danger" type="submit" name="changepass" value="Tukar Kata Laluan"/>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body row">
                                <div class="col-sm-8">
                                <div class="table-responsive">
                                
                                <table class="table table-hover">
                                    <tbody>
                                        <tr><td colspan="2">Profil Majikan</td></tr>
                                        <tr>                                            
                                            <td class="txt-oflo" style="width: 20%">Nama Majikan</td>
                                            <td><span class="font-medium"><?php echo $comp['name'] ?></span></td>
                                        </tr>
                                        <tr>                                            
                                            <td class="txt-oflo">Laman Web</td>
                                            <td><span class="font-medium"><?php echo $comp['website'] ?></span></td>
                                        </tr>                                        
                                        <tr>                                            
                                            <td class="txt-oflo">Email</td>
                                            <td><span class="font-medium"><?php echo $comp['email'] ?></span></td>
                                        </tr>
                                        <tr>                                            
                                            <td class="txt-oflo">Alamat</td>
                                            <td><span class="font-medium"><?php echo $comp['address'] ?></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Email campaign chart -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Ravenue - page-view-bounce rate -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Ravenue - page-view-bounce rate -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
                <!-- ============================================================== -->
                
                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
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

</html><?php }else {header("Location:../../../majikan.php?error=Unauthorized Level of Access#services");}} else {header("Location:../../../majikan.php?error=Unauthorized Access#services");} ?>