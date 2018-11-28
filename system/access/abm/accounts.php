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
        if(isset($_POST['addacount']))
        {
            $sql = "SELECT * FROM `omr_users` WHERE `ic` = '".$_POST['icn']."' AND `level` = '".$_POST['level']."' AND `email` = '".$_POST['email']."'";
            if($ck=$db->query($sql))
            {
                if($ck->num_rows < 1)
                {
                    if(strcmp($_POST['company_id'],ABM_COMANY_ID) == 0)
                    {
                        $cname = getCompanyByID(ABM_COMANY_ID)['name'];
                        //$cid = ABM_COMANY_ID;
                    } else {
                        $cname = getCompanyByID($_POST['company_id'])['name'];
                       // $cid = ABM_COMANY_ID;
                    }
                    
                    $pass = hash("sha512",$_POST['icn']);
                    $sql = "INSERT INTO `omr_users` (`id`, `name`, `password`, `email`, `u_name`, `u_id`, `level`, `ic`, `image`) "
                            . "VALUES (NULL,'".$_POST['name']."','".$pass."','".$_POST['email']."',"
                            . "'".$cname."','".$_POST['company_id']."','".$_POST['level']."','".$_POST['icn']."','')";
                    if($db->query($sql))
                        $error = 'Majikan Berjaya Di wujud';
                    else $error = 'ERROR: '.$sql;
                    
                }else $error = 'No. KP ini Telah Di Guna';
            }else $error = 'DB Connection Error: '.$sql;
        }
        if(isset($_POST['edituser']))
        {
            $sql = "UPDATE `omr_users` SET `name` = '".$_POST['name']."', `ic` = '".$_POST['icn']."', `email` = '".$_POST['email']."' WHERE `id` = '".$_POST['user_id']."'";
            if($db->query($sql))
                        $error = 'Akaun Berjaya Di Kemaskini';
                    else $error = 'ERROR: '.$sql;
        }
        if(isset($_POST['resetpass']))
        {
            $pass = hash("sha512",getUserById($_POST['user_id'])['ic']);
            $sql = "UPDATE `omr_users` SET `password` = '".$pass."'  WHERE `id` = '".$_POST['user_id']."'";
            if($db->query($sql))
                        $error = 'Katak Laluan Berjaya Di Reset to (No. KP Akaun)';
                    else $error = 'ERROR: PLEASE TRY AGAIN'.$sql;
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
                        <h4 class="page-title">MAKLUMAT PENGGUNA</h4>
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
                    $tred = getUserById($_GET['edit']); ?>
                <!-- ======== Student Edit ================== -->
                <div class="row" id="edit">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Kemaskini Akaun Pengguna</h4>
                            </div>
                            <form class="form-horizontal m-t-30" action="accounts.php" method="post">
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-1">Nama</label>
                                    <input type="hidden" name="user_id" value="<?php echo $tred['id'] ?>"/>
                                    <input type="text" class="form-control col-sm-4" name="name" value="<?php echo $tred['name'] ?>">                                    
                                </div>
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-1">No. KP</label>
                                    <input type="text" maxlength="12" class="form-control col-sm-4" name="icn" value="<?php echo $tred['ic'] ?>">                                    
                                </div>
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-1">Email</label>
                                    <input type="email" class="form-control col-sm-4" name="email" value="<?php echo $tred['email'] ?>">                                    
                                </div>
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-1">Jenis Akaun</label>
                                    <input type="text" class="form-control col-sm-4" name="edate" value="<?php echo getLevelByUserId($tred['id'])['description'] ?>" readonly="">                                    
                                </div>
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-1">Majikan</label>
                                    <input type="text" class="form-control col-sm-4" name="edate" value="<?php echo $tred['u_name'] ?>" readonly>                                    
                                </div>
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-1">Kata Laluan</label>
                                    <input type="submit"  class="btn btn-outline-danger" value="Reset Password" name="resetpass"/>                                   
                                </div>
                                <div class="form-group row p-t-20">
                                        <label class="col-sm-1"></label>                                        
                                        <input type="submit"  class="btn btn-outline-cyan" value="Kemaskini" name="edituser"/>
                                    </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
                <?php } ?>
                
                <!-- ======== Account List ================== -->
                <?php if(isset($_POST['addacountabm']) OR isset($_POST['addacountmajikan'])) { ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">TAMBAH AKAUN</h4>
                            <?php if(isset($error)){ ?>
                                <h4 style="color: red;"><?php echo $error; unset($error); ?></h4>
                                <?php } ?>
                        </div>
                         <form class="form-horizontal m-t-30" action="accounts.php" method="post">
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-2 offset-sm-1">Nama</label>
                                    <input type="text" class="form-control col-sm-4" name="name" required="">                                    
                                </div>
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-2 offset-sm-1">No. KP</label>
                                    <input type="number" maxlength="12" class="form-control col-sm-4" name="icn" required="">                                    
                                </div>
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-2 offset-sm-1">Email</label>
                                    <input type="email" class="form-control col-sm-4" name="email" required="">                                    
                                </div>
                                <div class="form-group row p-t-20">
                                <?php if(isset($_POST['addacountabm'])){ ?>
                                <input type="hidden" name="company_name" value=""/>
                                <input type="hidden" name="company_id" value="<?php echo ABM_COMANY_ID ?>"/>
                                <?php } else { ?>
                                <label class="col-sm-2 offset-sm-1">Nama Majikan</label>
                                <select name="company_id" class="custom-select col-sm-4">
                                    <?php $cxs = getComanyListByName('');
                                    if($cxs != NULL)
                                        while($cx = $cxs->fetch_assoc()){ ?>
                                    <option class="custom-select col-sm-4" value="<?php echo $cx['id'] ?>"><?php echo $cx['name'] ?></option>
                                        <?php } ?>
                                </select>
                                <?php } ?>
                                </div>
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-2 offset-sm-1">Level</label>
                                    <?php if(isset($_POST['addacountabm'])){ ?>
                                    <input name="level" class="form-control col-sm-4" value="abm" readonly>
                                    <?php } else { ?>
                                    <input name="level" class="form-control col-sm-4" value="tusb" readonly>
                                    <?php } ?>
                                </div>
                                <div class="form-group row p-t-20 col-sm-2 offset-sm-3">
                                    <input type="submit"  class="btn btn-outline-success " value="Tambah Akaun" name="addacount" readonly/>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">TAMBAH AKAUN</h4>
                            <?php if(isset($error)){ ?>
                                <h4 style="color: red;"><?php echo $error; unset($error); ?></h4>
                                <?php } ?>
                        </div>
                         <form class="form-horizontal m-t-30" action="accounts.php" method="post">
                             <div class="col-sm-4 offset-sm-2" style="display: inline">
                                        <input type="submit"  class="btn btn-outline-success" value="Tambah Akaun (ABM)" name="addacountabm"/>
                                        <input type="submit"  class="btn btn-outline-warning" value="Tambah Akaun (MAJIKAN)" name="addacountmajikan"/>
                                </div>                                
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">CARI AKAUN</h4>
                        </div>
                        <form class="form-horizontal m-t-30" action="accounts.php" method="post">
                            <div class="form-group row p-t-20">                                    
                                    <label id="addcode" class="col-sm-1">Carian</label>
                                    <input type="text" name="kata" />
                                </div>
                            <div class="col-sm-4 offset-sm-2">
                                        <input type="submit"  class="btn btn-outline-success" value="Cari" name="search"/>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                
                <?php if(isset($_POST['search'])) 
                    { ?>
                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Senarai Akaun</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <?php                     
                                        $std_list = getUsersBySearch($_POST['kata']);  
                                    ?>
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">Nama</th>
                                            <th class="border-top-0">No. KP</th>
                                            <th class="border-top-0">Email</th>
                                            <th class="border-top-0">Jenis Akaun</th>
                                            <th class="border-top-0">Kemaskini</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($std_list != NULL)
                                            while($std = $std_list->fetch_assoc()){ ?>
                                        <tr>    
                                            <td><span class="font-medium"><?php echo $std['name']; ?></span> </td>
                                            <td><span class="font-medium"><?php echo $std['ic']; ?></span> </td>
                                            <td><span class="font-medium"><?php echo $std['email']; ?></span> </td>
                                            <td><span class="font-medium"><?php echo getLevelByUserId($std['id'])['description']; ?></span> </td>
                                            <td><a href="accounts.php?edit=<?php echo $std['id']?>#edit"><span class="label label-success label-rounded">Edit</span></a></td>
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