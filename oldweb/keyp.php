<!DOCTYPE html>
<?php
include './headl.inc.php';if(isLecturerLoggedIn()){
    if(strcmp(getUserById(isLecturerLoggedIn()),'key') == 0){
include 'navi.php';
$user = getLecturer();

        if (isset($_POST['notifyAcompany']))
            {
            if(isset($_POST['std_list']))
               $std_list = count($_POST['std_list']);
                    foreach($_POST['std_list'] as $value)
                    echo $value;
                
            }
        
?>
	<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
			<meta name="description" content="A Bootstrap based app landing page template">
			<meta name="author" content="">
			<link rel="shortcut icon" href="assets/ico/favicon.ico">

			<title>e-GOTJOB</title>

			<!-- Bootstrap core CSS -->
			<link href="css/bootstrap.min.css" rel="stylesheet">

			<!-- Custom styles for this template -->
			<link href="css/custom.css" rel="stylesheet">
			<link href="css/flexslider.css" rel="stylesheet">
			<link rel="stylesheet" href="css/nav.css" type="text/css" media="all">
			<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
			<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,700' rel='stylesheet' type='text/css'>
			<link href='http://fonts.googleapis.com/css?family=Noto+Sans:400,700' rel='stylesheet' type='text/css'>

			<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
			<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
			<![endif]-->
		</head>

		<body>
                <div class="navbar navbar-inverse" role="navigation">
                        <?php
                        printHead();
                        ?>
                </div>
                <?php
                
                        printKEY2("keyp");
                        if(isset($_POST['newstudent'])){
                            $nnn = mysqli_real_escape_string($db,$_POST['name']);
                            $cnn = mysqli_real_escape_string($db,$_POST['company']);
                            $alamat = mysqli_real_escape_string($db,$_POST['address']);
                            $ric = preg_replace("/[^0-9,.]/", "", $_POST['ic']);
                        $sql = "INSERT INTO `students` (`id`, `name`, "
                                . " `address`, `phone1`, `ic`, "
                                . " `bdb`, `blb`, `bsdb`, `bslb`,"
                                . " `sbdb`, `sblb`, `tb`, `ll`,"
                                . " `working_field`, `negri`, `company`, `gaji`,"
                                . " `coment`, `companydate`, `phone2`, `akad`, `addby`, `postcode`, `sesi_id`) "
                                . "VALUES "
                                . "(NULL, '".$nnn."', "
                                . " '".$alamat."', '".$_POST['phone1']."', '".$ric."', "
                                . " '".$_POST['bdb']."', '".$_POST['blb']."', '".$_POST['bsdb']."', '".$_POST['bslb']."',"
                                . " '".$_POST['sbdb']."', '".$_POST['sblb']."', '".$_POST['tb']."', '".$_POST['ll']."',"
                                . " '".$_POST['kerja']."', '".$_POST['negri']."', '".$cnn."', '".$_POST['gaji']."',"
                                . " '".$_POST['coment']."', '".$_POST['companydate']."', '".$_POST['phone2']."', '".$_POST['akad']."' , '".$user['id']."', '".$_POST['postkod']."' , '".$_POST['sesi_id']."')";    
                                $ssl = "SELECT * FROM `students` WHERE `ic` = '".$_POST['ic']."' AND `sesi_id` = '".$_POST['sesi_id']."'";
                                $ck = $db->query($ssl);
                                if($ck->num_rows < 1){
                                    if($db->query($sql))
                                        echo '<h1 style="color=green;"> THIS STUDENT IS SUCCESSFULLY ADDED</h1>';
                                    else echo '<br>'.$sql;
                                }else{
                                    echo '<h1 style="color=red;"> THIS STUDENT WAS ADDED BEFORE</h1>';
                                }
                        }
                ?>
                
                <!--<div id="contactWrap">-->
                        <div class="container">
                            <div class="row">
                            <h2>NEW STUDENT FORM</h2>
                            <form action="keyp.php" method="post">
                                <table class="table table-condensed table-bordered"style="width: 80%;">
                                    <tr><td>SESI</td>
                                        <td>
                                            <select name="sesi_id" style="width: 100%;">
                                                <?php $cots = getCohortList('tred_id');
                                                while($cc = $cots->fetch_assoc()){
                                                echo '<option value="'.$cc['id'].'">'. getCourseByID($cc['tred_id'])['name'].' - '. $cc['name'].'</option>';
                                                }?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr><td>NAMA</td><td style="width: 70%;"><input type="text" name="name" required style="width: 100%;"></td></tr>
                                <tr><td> No. Kad Pengenalan</td><td><input type="text" name="ic" required  style="width: 100%;"></td></tr>
                                <tr><td>No. Tel Pelatih</td><td><input type="text" name="phone1" required  style="width: 100%;"></td></tr>
                                <tr><td>No. Tel Waris</td><td><input type="text" name="phone2" style="width: 100%;"></td></tr>
                                <tr><td>ALAMAT</td><td><textarea type="text" name="address" required  style="width: 100%;" rows="4"></textarea></td></tr>
                                <tr><td>POSTKOD</td><td><input type="text" name="postkod" required  style="width: 100%;"></td></tr> 
                                <tr><td>Negri</td><td><input type="text" name="negri" style="width: 100%;"></td></tr>
                                <tr><td>Pencapaian Akademik (PMR/SPM)</td><td><input type="text" name="akad" required  style="width: 100%;"></td></tr>
                                <tr><td>Pekerjaan</td><td><input type="text" name="kerja"  style="width: 100%;"></td></tr>
                                <tr><td>Bekerja Majikan Dlm Bidang BDB</td><td><input type="text" name="bdb" style="width: 10%; float: left;"></td></tr>
                                <tr><td>Bekerja Majikan Dlm Bidang BLB</td><td><input type="text" name="blb" style="width: 10%; float: left;"></td></tr>
                                <tr><td>Bekerja Majikan Dlm Bidang BSDB</td><td><input type="text" name="bsdb" style="width: 10%; float: left;"></td></tr>
                                <tr><td>Bekerja Majikan Dlm Bidang BSLB</td><td><input type="text" name="bslb"  style="width: 10%; float: left;"></td></tr>
                                <tr><td>Bekerja Majikan Dlm Bidang SBDB</td><td><input type="text" name="sbdb"  style="width: 10%; float: left;"></td></tr>
                                <tr><td>Bekerja Majikan Dlm Bidang SBLB</td><td><input type="text" name="sblb"  style="width: 10%; float: left;"></td></tr>
                                <tr><td>Bekerja Majikan Dlm Bidang TB</td><td><input type="text" name="tb"  style="width: 10%; float: left;"></td></tr>
                                <tr><td>Lain - Lain LL</td><td><input type="text" name="ll"  style="width: 10%; float: left;"></td></tr>
                                <tr><td>Alamat Syarikat</td><td><textarea type="text" name="company"   style="width: 100%;"></textarea></td></tr>
                                <tr><td>Tarikh Mula Bekerja</td><td><input type="date" name="companydate"  style="width: 20%; float: left;"></td></tr>
                                <tr><td>Gaji</td><td><input type="text" name="gaji" style="width: 100%;"></td></tr>
                                <tr><td>Catatan </td><td><input type="text" name="coment"  style="width: 100%;"></td></tr>
                                <tr><td colspan="2"><input type="submit" name="newstudent" value="submit" style="width: 70%; float: right;"/></td></tr>
                            </table>
                            </form>
                            </div>
                        </div>
                <!-- /contactWrap -->  
                    
                    
	
        
        
        
                
                <?php
                printFooter();
                ?>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/flexslider.js"></script>
	
<script type="text/javascript">
$(document).ready(function() {

	$('.mobileSlider').flexslider({
		animation: "slide",
		slideshowSpeed: 3000,
		controlNav: false,
		directionNav: true,
		prevText: "&#171;",
		nextText: "&#187;"
	});
	$('.flexslider').flexslider({
		animation: "slide",
		directionNav: false
	});
		
	$('a[href*=#]:not([href=#])').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') || location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if ($(window).width() < 768) {
				if (target.length) {
					$('html,body').animate({
						scrollTop: target.offset().top - $('.navbar-header').outerHeight(true) + 1
					}, 1000);
					return false;
				}
			}
			else {
				if (target.length) {
					$('html,body').animate({
						scrollTop: target.offset().top - $('.navbar').outerHeight(true) + 1
					}, 1000);
					return false;
				}
			}

		}
	});
	
	$('#toTop').click(function() {
		$('html,body').animate({
			scrollTop: 0
		}, 1000);
	});
	
	var timer;
    $(window).bind('scroll',function () {
        clearTimeout(timer);
        timer = setTimeout( refresh , 50 );
    });
    var refresh = function () {
		if ($(window).scrollTop()>100) {
			$(".tagline").fadeTo( "slow", 0 );
		}
		else {
			$(".tagline").fadeTo( "slow", 1 );
		}
    };
		
});
</script>
  </body>
</html><?php }}else header("Location:index.php?login=Please Login");?>