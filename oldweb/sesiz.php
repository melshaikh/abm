<!DOCTYPE html>
<?php
include './headl.inc.php';if(isLecturerLoggedIn()){
    if(strcmp(getUserById(isLecturerLoggedIn())['level'],'zah') == 0){
include 'navi.php';
if (isset($_POST['login']))
{
    echo 'My Name';
}

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
                        $zah = getLecturer();
                        ?>
                </div>
                <?php
                
                        printZAH("sesi");
                ?>
                    <?php if(isset($_POST['createuser'])){
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
                            echo '<h1> SUCCESSFULLY CREATED</h1>';
                        }else  echo '<h1> BIDANG IS ADDED BEFORE </h1>';
                        }
                    }?>
                    <?php if(isset($_POST['newuserform'])){?>
                    <div id="contactWrap">
                        <div class="overlay">
                                <div class="container">
                                    <form action="sesiz.php" method="post">
                                    <table class="table table-condensed table-striped table-bordered">
                                        <tr>
                                            <td>TARIKH MULA</td><td><input type="date" name="sdate" required/></td>
                                            <td>TARIKH TAMAT</td><td><input type="date" name="edate" required/></td>
                                            <td>TRED</td>
                                            <td>
                                                <select name="tred_id">
                                                    <?php $treds = getCourses();
                                                    while($cr = $treds->fetch_assoc()){?>
                                                    <option value="<?php echo $cr['id']?>"><?php echo $cr['name'];?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr><td colspan="2"><input type="submit" name="createuser" value="SUBMIT" style="width: 80%; margin-left: 10%; margin-right: 10%;"/></td></tr>
                                    </table>
                                    </form>
                                </div>
                        </div>
                </div> <!-- /contactWrap -->  
                    <?php } if(isset($_POST['editbidang'])){
                        $sname = $_POST['sdate'].' -- '.$_POST['edate'];
                        $aid = getAreaByCourseId($_POST['tred_id'])['id'];
                        $sql = "UPDATE `cohort` SET `name` = '".$sname."' , `edate` = '".$_POST['edate']."', `sdate`= '".$_POST['sdate']."', `tred_id` = '".$_POST['tred_id']."' , `area_id` = '".$aid."' WHERE `cohort`.`id` = ".$_POST['bidid'];
                        $db->query($sql);
                        
                    }
                if(isset($_GET['edit'])){
                    $bid = getcohortbyid($_GET['edit']);
                ?>
                   <div style="margin: 3%;">
                        <div class="overlay">
                                <div class="container">
                                    <form action="sesiz.php" method="post">
                                        <table class="table table-condensed table-striped table-bordered">
                                            <tr><td>NAMA</td><td><input type="text" name="name" value="<?php echo $bid['name'];?>"/></td></tr>
                                            <tr><td>MULA</td><td><input type="date" name="sdate" value="<?php echo $bid['sdate'];?>"/></td></tr>
                                            <tr><td>TAMAT</td><td><input type="date" name="edate" value="<?php echo $bid['edate'];?>"/></td></tr>
                                            <tr><td>TRED</td>
                                                <td>
                                                    <select name="tred_id">
                                                        <?php $treds = getCourses();
                                                        while($tr = $treds->fetch_assoc()){
                                                            if($tr['id'] == $bid['tred_id'])
                                                        echo'<option value="'.$tr['id'].'" selected>'.$tr['name'].'</option>';
                                                            else echo'<option value="'.$tr['id'].'" >'.$tr['name'].'</option>';
                                                         } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                        <input type="hidden" value="<?php echo $bid['id'];?>" name="bidid"/>
                                        <tr><td colspan="2"><input type="submit" name="editbidang" value="CHANGE"/></td></tr>
                                        </table>
                                    </form>
                                </div>
                        </div>
                </div> <!-- /contactWrap --> 
                    
                    
                <?php } ?>
                <div style="margin: 3%;">
                        <div class="overlay">
                                <div class="container">
                                    <form action="sesiz.php" method="post">
                                        <input type="submit" name="newuserform" value="TAMBAH SESI BHARU"/>
                                    </form>
                                </div>
                        </div>
                </div> <!-- /contactWrap --> 
                <div>
                        <div class="overlay">
                                <div class="container">
                                    <h1>List of Sesi </h1>
                                    <?php $userlist = getCohortList('sdate');?>
                                    <table class="table table-condensed table-striped table-bordered">
                                        <thead><tr><th>Name</th><th>MULA</th><th>TAMAT</th><th>BIDANG</th><th>TRED</th><th>EDIT</th></tr></thead>
                                        <tbody>
                                        <tr>
                                            <?php   while ($us = $userlist->fetch_assoc()){ ?>
                                            <tr><td><?php echo $us['name']; ?></td>
                                                <td><?php echo $us['sdate']; ?></td>
                                                <td><?php echo $us['edate']; ?></td>
                                                <td><?php echo getAreaByID($us['area_id'])['name']; ?></td>
                                                <td><?php echo getCourseByID($us['tred_id'])['name']; ?></td>
                                                <td><a href="sesiz.php?edit=<?php echo $us['id']; ?>">EDIT</a></td>
                                                <td><a href="sesiz.php?del=<?php echo $us['id']; ?>">DELETE</a></td>
                                            <?php } ?>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                </div> <!-- /contactWrap -->  
                
                    
                    
	
        
        
        
                
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