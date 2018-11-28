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
        if(isset($_POST['company_edit']))
        {
            $sql = "UPDATE `company` SET `name` = '".$_POST['name']."' , `address` = '".$_POST['address']."', `website` = '".$_POST['website']."',"
                    . " `phone` = '".$_POST['phone']."', `rank` = '".$_POST['rank']."' WHERE `id` = '".$_POST['company_id']."'";
            if($db->query($sql)){
                $sql = "UPDATE `omr_users` SET `name` = '".$_POST['user_name']."', `email` = '".$_POST['user_email']."' WHERE `id` = '".$_POST['user_id']."'";
                if($db->query($sql))
                $error = "Majikan dan PIC Majikan Profil Berjaya di kemaskini";
                else $error = "Majikan Profil Berjaya di kemaskini, PIC Majikan Tidak Berjaya di kemaskini";
            }
            else $error = "Majikan dan PIC Majikan Profil Tidak Berjaya di kemaskini";
        }
        if(isset($_POST['company_add']))
        {
            $name_is_wujud = FALSE;
            $user_is_wujud = FALSE;
            $sql = "SELECT * FROM `company` WHERE `name` = '".$_POST['name']."'";
            if($ck = $db->query($sql))
                    if($ck->num_rows > 0)
                        $name_is_wujud = TRUE;
                    $sql = "SELECT * FROM `omr_users` WHERE `ic` = '".$_POST['user_ic']."' AND `email` = '".$_POST['user_email']."'";
            if($ck = $db->query($sql))
                    if($ck->num_rows > 0)
                        $name_is_wujud = TRUE;
            if($name_is_wujud OR $user_is_wujud)
            {
                $error = "NAMA MAJIKAN ATAU PIC MAJIKAN TELAH DI WUJUD";
            } 
            else 
            {
                $pass = hash("sha512",$_POST['user_ic']);
                $sql = "INSERT INTO `omr_users` (`id`, `name`, `password`, `email`, `u_name`, `u_id`, `level`, `ic`) "
                        . "VALUES (NULL,'".$_POST['user_name']."','".$pass."','".$_POST['user_email']."','".$_POST['name']."','0','tusb','".$_POST['user_ic']."')";
                $userid = -1;
                if($db->query($sql))
                    $userid = $db->insert_id;
                if($userid > 0)
                    {
                    $sql = "INSERT INTO `company` (`id`,`name`,`address`,`website`, `user_id`,`phone`,`email`,`rank`) "
                            . "VALUES (NULL,'".$_POST['name']."','".$_POST['address']."','".$_POST['website']."', '".$userid."','".$_POST['phone']."'"
                            . ",'".$_POST['email']."','1')";
                        if($db->query($sql))
                        {
                            $companyid = $db->insert_id;
                            $sql="UPDATE `omr_users` SET `u_id` = '".$companyid."' WHERE `id` = '".$userid."'";
                            if($db->query($sql))
                               $error = "MAJIKAN DAN PIC BERJAYA DI WUJUD"; 
                        } else $error = "MAJIKAN ERROR";
                        
                    }
                else
                    {
                    $error = "PIC MAJIKAN ERROR";
                    }
                
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
                <?php  printCompany('list'); ?>
                
                
                
                <!-- ======== Bidang List ================== -->
                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Cari Majikan</h4>
                                <?php if(isset($error)){ ?>
                                <h4 style="color: red;"><?php echo $error; unset($error); ?></h4>
                                <?php } ?>
                            </div>                            
                            <div class="table-responsive">
                                <form class="form-horizontal form-material" action="company.php" method="post">
                                    <div class="form-group">
                                        <label class="col-md-12">Nama Majikan</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Nama Majikan" class="form-control form-control-line" name="name" required>
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
                
            <!-- ================= LIST OF COMAPNY========================== -->
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
                                    if(isset($_POST['search']))
                                        $std_list = getComanyListByName($_POST['name']);
                                    else $std_list = getComanyListByName(NULL);
                                    ?>
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">Nama Majikan</th>
                                            <th class="border-top-0">MYCOID</th>
                                            <th class="border-top-0">PIC Majikan</th>
                                            <th class="border-top-0">Telefon</th>
                                            <th class="border-top-0">Email</th>
                                            <th class="border-top-0">Kemaskini</th>
                                            <th class="border-top-0">Papar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($std_list != NULL)
                                            while($std = $std_list->fetch_assoc()){ ?>
                                        <tr>    
                                            <td><span class="font-medium"><?php echo $std['name']; ?></span> </td>
                                            <td><span class="font-medium"><?php echo $std['mycoid']; ?></span> </td>
                                            <td><span class="font-medium"><?php echo getUser($std['user_id'], 'omr_users')['name']; ?></span> </td>
                                            <td><span class="font-medium"><?php echo $std['phone']; ?></span> </td>
                                            <td><span class="font-medium"><?php echo $std['email']; ?></span> </td>
                                            <td><a href="company_edit.php?company_edit=<?php echo $std['id']?>#edit"><span class="label label-danger label-rounded">Kemaskini</span></a></td>
                                            <td><a href="company.php?company_view=<?php echo $std['id']?>#view"><span class="label label-success label-rounded">Papar</span></a></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- ================= LIST OF COMAPNY========================== -->
            <?php if(isset($_GET['company_view'])) { 
                $cx = getCompanyByID($_GET['company_view']);
                ?>
            <div class="row" id="view">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" style="text-align: center">PROFIL MAJIKAN (<?php echo $cx['name']; ?>)</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>    
                                            <td><span class="font-medium">Nama Majikan</span> </td>
                                            <td><?php echo $cx['name']; ?></td>
                                            
                                        </tr>
                                        <tr>    
                                            <td><span class="font-medium">MYCOID Majikan</span> </td>
                                            <td><?php echo $cx['mycoid']; ?></td>
                                            
                                        </tr>
                                        <tr>    
                                            <td><span class="font-medium">Alamat Majikan</span> </td>
                                            <td><?php echo $cx['address']; ?></td>                                            
                                        </tr>
                                        <tr>    
                                            <td><span class="font-medium">Laman Web Majikan</span> </td>
                                            <td><?php echo $cx['website']; ?></td>                                            
                                        </tr>
                                        <tr>    
                                            <td><span class="font-medium">PIC Majikan (Nama)</span> </td>
                                            <td><?php echo getUserById($cx['user_id'])['name']; ?></td>                                            
                                        </tr>
                                        <tr>    
                                            <td><span class="font-medium">PIC Majikan (Email)</span> </td>
                                            <td><?php echo getUserById($cx['user_id'])['email']; ?></td>                                            
                                        </tr>
                                        <tr>    
                                            <td><span class="font-medium">PIC Majikan (No. KP)</span> </td>
                                            <td><?php echo getUserById($cx['user_id'])['ic']; ?></td>                                            
                                        </tr>
                                        <tr>    
                                            <td><span class="font-medium">Telefon Majikan</span> </td>
                                            <td><?php echo $cx['phone']; ?></td>                                            
                                        </tr>
                                        <tr>    
                                            <td><span class="font-medium">Email Majikan</span> </td>
                                            <td><?php echo $cx['email']; ?></td>                                            
                                        </tr>
                                        
                                        <tr>    
                                            <td><span class="font-medium">Alamat Majikan</span> </td>
                                            <td><?php echo $cx['address']; ?></td>                                            
                                        </tr>
                                        <tr>    
                                            <td><span class="font-medium">Rank Majikan</span> </td>
                                            <td><?php echo $cx['rank']; ?></td>                                            
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                              <form class="form-horizontal m-t-30" action="company.php" method="post" id="printform">
                                                <div class="col-sm-4 offset-sm-4">
                                                    <button type="submit"  class="btn btn-outline-cyan" value="Cetak" name="printstd" onclick="printDiv('view')">Cetak</button> 
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