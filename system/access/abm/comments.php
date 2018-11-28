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
        if(isset($_POST['editaduan']))
        {
          $sql = "UPDATE `aduan` SET `answerby` = '".$loginuser['name']."', `answer` = '".$_POST['answer']."' ,`date_answer` = '".date('Y-m-d')."' WHERE `id` = '".$_POST['aduan_id']."'";  
          if($db->query($sql))
          {
              $error = 'JAWAB ADUAN DI BERJAYA';
              $adx = getAduanByid($_POST['aduan_id']);
              if(strcmp($adx['type'],'out') == 0)
                  $error = $error.' '.sendemailaduan($adx['email'],$adx['subject'],$_POST['answer'],date('Y-m-d'));
          }
           else $error = 'JAWAB ADUAN TIDAK BERJAYA';
        }
        if(isset($_POST['deleteaduan']))
        {
          $sql = "DELETE FROM `aduan` WHERE `id` = '".$_POST['aduan_id']."'";  
          if($db->query($sql))
              $error = 'PADAM ADUAN DI BERJAYA';
           else $error = 'PADAM ADUAN TIDAK BERJAYA';
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
                        <h4 class="page-title">MAKLUMAT ADUAN</h4>
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
                    $tred = getAduanByid($_GET['edit']); ?>
                <!-- ======== Student Edit ================== -->
                <div class="row" id="edit">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Kemaskini Aduan</h4>
                            </div>
                            <form class="form-horizontal m-t-30" action="comments.php" method="post">
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-1">Nama Pelatih</label>
                                    <input type="text" class="form-control col-sm-4" name="stdname" value="<?php echo getStudentByIC($tred['student_ic'])['name'] ?>" readonly>                                    
                                </div>
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-1">Tarikh Hantar</label>
                                    <input type="text" class="form-control col-sm-4" name="datein" value="<?php echo $tred['date_in'] ?>" readonly>                                    
                                </div>
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-1">Aduan</label>
                                    <textarea type="text" class="form-control col-sm-4" name="subject" readonly><?php echo $tred['subject'] ?></textarea>                                    
                                </div>
                                <?php if(strcmp($tred['answer'],'') != 0){ ?>
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-1">Jawab By</label>
                                    <input type="text" class="form-control col-sm-4" name="answerby" value="<?php echo $tred['answerby'] ?>">                                    
                                </div>
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-1">Jawaban</label>
                                    <input type="text" class="form-control col-sm-4" name="answer" value="<?php echo $tred['answer'] ?>">                                    
                                </div>
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-1">Tarikh Jawaban</label>
                                    <input type="date" class="form-control col-sm-4" name="dateanswer" value="<?php echo $tred['date_answer'] ?>">                                    
                                </div>
                                <?php } else { ?>
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-1">Jawab By</label>
                                    <input type="text" class="form-control col-sm-4" name="answerby" value="<?php echo $loginuser['name'] ?>">                                    
                                </div>
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-1">Jawaban</label>
                                    <textarea type="text" class="form-control col-sm-4" name="answer" required></textarea>                                   
                                </div>
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-1">Tarikh Jawaban</label>
                                    <input type="date" class="form-control col-sm-4" name="dateanswer" value="<?php echo date('Y-m-d') ?>">                                    
                                </div>                                
                                <?php } ?>
                                <div class="col-sm-4 offset-sm-2">
                                        <input type="hidden" name="aduan_id" value="<?php echo $tred['id'] ?>"/>
                                        <input type="submit"  class="btn btn-outline-cyan" value="Kemaskini" name="editaduan"/>
                                    </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php if(isset($_GET['delete'])){ 
                    $tred = getAduanByid($_GET['delete']); ?>
                <!-- ======== Student Edit ================== -->
                <div class="row" id="edit">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">ARE YOU SURE TO DELET ADUAN INI</h4>
                            </div>
                            <form class="form-horizontal m-t-30" action="comments.php" method="post">
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-1">Nama Pelatih</label>
                                    <input type="text" class="form-control col-sm-4" name="stdname" value="<?php echo getStudentByIC($tred['student_ic'])['name'] ?>" readonly>                                    
                                </div>
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-1">Tarikh Hantar</label>
                                    <input type="text" class="form-control col-sm-4" name="datein" value="<?php echo $tred['date_in'] ?>" readonly>                                    
                                </div>
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-1">Aduan</label>
                                    <textarea type="text" class="form-control col-sm-4" name="subject" readonly><?php echo $tred['subject'] ?></textarea>                                    
                                </div>
                                <?php if(strcmp($tred['answer'],'') != 0){ ?>
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-1">Jawab By</label>
                                    <input type="text" class="form-control col-sm-4" name="answerby" value="<?php echo $tred['answerby'] ?>" readonly>                                    
                                </div>
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-1">Jawaban</label>
                                    <input type="text" class="form-control col-sm-4" name="answer" value="<?php echo $tred['answer'] ?>" readonly>                                    
                                </div>
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-1">Tarikh Jawaban</label>
                                    <input type="date" class="form-control col-sm-4" name="dateanswer" value="<?php echo $tred['date_answer'] ?>" readonly>                                    
                                </div>
                                <?php } else { ?>
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-1">Jawab By</label>
                                    <input type="text" class="form-control col-sm-4" name="answerby" value="<?php echo $loginuser['name'] ?>" readonly>                                    
                                </div>
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-1">Jawaban</label>
                                    <textarea type="text" class="form-control col-sm-4" name="answer" readonly></textarea>                                   
                                </div>
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-1">Tarikh Jawaban</label>
                                    <input type="date" class="form-control col-sm-4" name="dateanswer" value="<?php echo date('Y-m-d') ?>" readonly>                                    
                                </div>                                
                                <?php } ?>
                                <div class="col-sm-4 offset-sm-2">
                                        <input type="hidden" name="aduan_id" value="<?php echo $tred['id'] ?>"/>
                                        <input type="submit"  class="btn btn-outline-danger" value="padam" name="deleteaduan"/>
                                    </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
                <?php } ?>
                
                <!-- ======== Student List ================== -->
                <?php if(isset($_POST['searchkata']) OR isset($_POST['searchdate'])) { ?>
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
                                    if(isset($_POST['searchkata']))
                                        $std_list =  getAduanByKata($_POST['kata']);
                                    else $std_list = getAduanByDate($_POST['sdate'],$_POST['edate']); 
                                    ?>
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">Nama Pelatih</th>
                                            <th class="border-top-0">Tarikh Hantar</th>
                                            <th class="border-top-0">Aduan</th>
                                            <th class="border-top-0">Dijawab oleh</th>
                                            <th class="border-top-0">Jawaban</th>
                                            <th class="border-top-0">Tarikh Jawaban</th>
                                            <th class="border-top-0">Jawab Balik</th>
                                            <th class="border-top-0">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if($std_list != NULL)
                                            while($std = $std_list->fetch_assoc()){ ?>
                                        <tr>    
                                            <td><span class="font-10"><?php if(strcmp($std['type'],'out') == 0) echo $std['name'];
                                                    else echo getStudentByIC($std['student_ic'])['name'] ?></span> </td>
                                            <td><span class="font-10"><?php echo $std['date_in'] ?></span> </td>
                                            <td><span class="font-10"><?php echo $std['subject'] ?></span> </td>
                                            <td><span class="font-10"><?php echo $std['answerby'] ?></span> </td>
                                            <td><span class="font-10"><?php echo $std['answer'] ?></span> </td>
                                            <td><span class="font-10"><?php echo $std['date_answer'] ?></span></td>                                                                                        
                                            <td><a href="comments.php?edit=<?php echo $std['id']?>#edit"><span class="label label-success label-rounded">Edit</span></a></td>
                                            <td><a href="comments.php?delete=<?php echo $std['id']?>#delete"><span class="label label-danger label-rounded">Delete</span></a></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Cari Aduan Mengikut Tarikh</h4>
                            <?php if(isset($error)){ ?>
                                <h4 style="color: red;"><?php echo $error; unset($error); ?></h4>
                                <?php } ?>
                        </div>
                            <form class="form-horizontal m-t-30" action="comments.php" method="post">
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-1">Tarikh Mula</label>
                                    <input type="date" class="form-control col-sm-4" value="<?php echo date('Y-m-d') ?>" name="sdate" required="">                                    
                                </div>
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-1">Tarikh Tamat</label>
                                    <input type="date" class="form-control col-sm-4" name="edate" value="<?php echo date('Y-m-d') ?>" required="">                                    
                                </div>
                                <div class="col-sm-4 offset-sm-2">
                                        <input type="submit"  class="btn btn-outline-success" value="Cari Aduan" name="searchdate"/>
                                    </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Cari Aduan</h4>
                        </div>
                        <form class="form-horizontal m-t-30" action="comments.php" method="post">
                                <div class="form-group row p-t-20">
                                    <label class="col-sm-1">Kata Carian</label>
                                    <input type="text" class="form-control col-sm-4" name="kata" >                                    
                                </div>
                                <div class="col-sm-4 offset-sm-2">
                                        <input type="submit"  class="btn btn-outline-success" value="Cari Aduan" name="searchkata"/>
                                    </div>
                                
                            </form>
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
    <script src="../../dist/js/pages/dashboards/dashboard1.js"></script>
</body>

</html><?php }else {header("Location:../../../index.php?error=Unauthorized Level of Access#services");}} else {header("Location:../../../index.php?error=Unauthorized Access#services");} ?>