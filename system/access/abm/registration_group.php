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

function printDiv(divName){
                        
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
                        var x = document.getElementById("printform");
                        x.style.display = "none";
			window.print();
			document.body.innerHTML = originalContents;
		}
function confm(){
            if (confirm("Are you sure you wont to save!")) {                
            RegStudent();
            } else {
                //txt = "You pressed Cancel!";
            }

}
function RegStudent(){
    
        var name = document.getElementById("std_name").value;
        var ic = document.getElementById("std_icn").value;
        var phone = document.getElementById("std_phone").value;
        var phone2 = document.getElementById("std_phone2").value;
        var address = document.getElementById("std_address").value;
        var gender = document.getElementById("std_gender").value;
        var akad = document.getElementById("std_akad").value;
        var email = document.getElementById("std_email").value;
        var ul = "addnewreg.php?stdsave=<?php echo $loginuser['id'] ?>&name="+name+"&icn="+ic+"&phone="+phone+"&phone2="+phone2+"&address="+address+"&gender="+gender+"&akad="+akad+"&email="+email+"";
        var x = httpGet(ul);
        window.location.href = 'registration_group.php?next=a&error='+x;
    }
function httpGet(theUrl)
        {
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
            xmlHttp.send( null );
            return xmlHttp.responseText;
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
        <?php 
        //printpagehead(isLecturerLoggedIn()['image']);
        //printsidebar(); 
        ?>
        
        <?php        
        if(isset($_POST['stdsave']))
        {
            $sql = "SELECT * FROM `studentstemp` WHERE `ic` = '".$_POST['icn']."' AND `reg_id` = '".$_SESSION['reg_id']."'";
            $ck = $db->query($sql);
            if($ck->num_rows < 1){
                $pass = hash("sha512",$_POST['icn']);
                $sql = "INSERT INTO `studentstemp` (`id`, `name`,`ic`,`phone1`,`phone2`,`address`,`gender`,`akad`,`email`, `reg_id`"
                        . ", `isfirst`, `pass`, `addby`) "
                        . "VALUES (NULL, '".$_POST['name']."', '".$_POST['icn']."', '".$_POST['phone']."', '".$_POST['phone2']."'"
                        . ", '".$_POST['address']."', '".$_POST['gender']."', '".$_POST['akad']."', '".$_POST['email']."', '".$_SESSION['reg_id']."'"
                        . ", 'yes', '".$pass."', '".$loginuser['id']."')";
                if($db->query($sql))
                    $_SESSION['error'] = 'MAKULUMAT PELATIH BERJAYA SIMPAN';
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
            <?php 
            if(isset($_GET['open']))
                $_SESSION['reg_id'] = $_GET['open'];
            $std_list = getListofStudentToRegByResSessionID($_SESSION['reg_id']);
            ?>
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-lg-7 align-self-center">
                        <h4 class="page-title">Daftar Pelatih Baru</h4>
                        <p class="float-right"> Pelatih Count <span class="label label-success label-rounded "><?php if($std_list != NULL) echo $std_list->num_rows; else echo '0';  ?></span></p>
                        
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
                <!-- ======== Student List ================== -->
               
               
                <?php if(isset($_GET['open']) OR isset($_POST['stdsave']) OR isset($_GET['next'])){   
                    if(isset($_GET['open']))
                    $_SESSION['reg_id'] = $_GET['open'];
                    ?>
                <div class="row" id="kemas">
                    <!-- column -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">MAKLUMAT PELATIH</h4>
                                <?php if(isset($error)){ ?>
                                <h4 style="color: red;"><?php echo $error; unset($error); ?></h4>
                                <?php } ?>
                                <?php if(isset($_SESSION['error'])){ ?>
                                <h4 style="color: red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></h4>
                                <?php } ?>
                                <?php if(isset($_GET['error'])){ ?>
                                <h4 style="color: red;"><?php echo $_GET['error']; unset($_GET['error']); ?></h4>
                                <?php } ?>
                                <form class="form-horizontal m-t-30" action="registration_group.php" method="post">
                                <table class="table table-row-variant table-striped m-t-20">
                                    <tbody>
                                        <tr>
                                            <td class="text-muted" style="width: 20%">NAMA</td>
                                            <td class="font-medium" ><input style="width: 50%" type="text" id="std_name" name="name" required /></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">No. KP</td>
                                            <td class="font-medium"><input style="width: 50%" pattern=".{12,12}" minlength="12" type="text" id="std_icn" name="icn" required /></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Email</td>
                                            <td class="font-medium"><input style="width: 50%" type="email" id="std_email" name="email" required /></td>
                                        </tr>   
                                        <tr>
                                            <td class="text-muted">No. Telefon</td>
                                            <td class="font-medium"><input style="width: 50%" type="number" id="std_phone" name="phone" required /></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">No. Tel WARIS</td>
                                            <td class="font-medium"><input style="width: 50%" type="number" id="std_phone2" name="phone2" required /></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Alamat</td>
                                            <td class="font-medium"><textarea style="width: 50%" type="text" id="std_address" name="address"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Jantina</td>
                                            <td class="font-medium">
                                                <select name="gender" id="std_gender" class="custom-select col-sm-2">
                                                    <option value="Lelaki">Lelaki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                            </td>
                                        </tr>                                        
                                        <tr>
                                            <td class="text-muted">Akademik</td>
                                            <td class="font-medium"><input style="width: 50%" type="text" id="std_akad" name="akad" required /></td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                                <div class="col-sm-4 offset-sm-4">
                                    <Button style="margin-left: 5%" type="button"  class="btn btn-outline-cyan" value="Simpan" name="stdsave" onclick="confm();">Simpan</button>
                                    <!--<input type="submit"  class="btn btn-outline-cyan" value="Cetak" name="stdprint"/>--> 
                                </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                <?php } ?>
                
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