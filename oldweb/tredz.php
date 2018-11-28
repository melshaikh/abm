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
                
                        printZAH("tred");
                ?>
                    <?php if(isset($_POST['createuser'])){
                        
                        $sql = "INSERT INTO `courses` (`id`, `name`,`area`) "
                                . "VALUES (NULL, '".$_POST['name']."', '".$_POST['bidid']."')";
                        $chk = "SELECT * FROM `courses` WHERE `name` = '".$_POST['name']."'";
                        $ck = $db->query($chk);
                        if($ck->num_rows < 1){
                        if($db->query($sql)){
                            echo '<h1> SUCCESSFULLY CREATED</h1>';
                        }else  echo '<h1> THIS TRED IS ADDED BEFORE </h1>';
                        }
                    }?>
                    <?php if(isset($_POST['newuserform'])){?>
                    <div id="contactWrap">
                        <div class="overlay">
                                <div class="container">
                                    <form action="tredz.php" method="post">
                                        <h3>New Tred FORM </h3>
                                    <table class="table table-condensed table-striped table-bordered">
                                        <tr>
                                            <td>Name</td><td><input type="text" name="name" required/></td>
                                        </tr>
                                        <tr>
                                            <td>Bidang</td>
                                            <td>
                                                <select name="bidid">
                                                    <?php $alist = getArea();
                                                    while($ar = $alist->fetch_assoc()){
                                                        ?>
                                                    <option value="<?php echo $ar['id'] ?>"><?php echo $ar['name'] ?></option>
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
                        
                        $sql = "UPDATE `courses` SET `name` = '".$_POST['name']."', `area` = '".$_POST['bidid']."' WHERE `courses`.`id` = ".$_POST['cid'];
                        $db->query($sql);
                        
                    }
                if(isset($_GET['edit'])){
                    $bid = getCourseByID($_GET['edit']);
                ?>
                   <div style="margin: 3%;">
                        <div class="overlay">
                                <div class="container">
                                    <form action="tredz.php" method="post">
                                        <table class="table table-condensed table-striped table-bordered">
                                            <tr><td>Name</td><td><input type="text" name="name" value="<?php echo $bid['name'];?>"/></td></tr>
                                            <tr><td>Bidang</td><td>
                                                    <select name="bidid">
                                                        <?php $as = getArea();
                                                        while($ar = $as->fetch_assoc()){
                                                            if($ar['id'] == $bid['area'])
                                                        echo '<option value="'.$ar['id'].'" selected>'.$ar['name'].'</option>';
                                                            else echo '<option value="'.$ar['id'].'" >'.$ar['name'].'</option>';
                                                        }?>
                                                    </select>
                                                </td></tr>
                                        <input type="hidden" value="<?php echo $bid['id'];?>" name="cid"/>
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
                                    <form action="tredz.php" method="post">
                                        <input type="submit" name="newuserform" value="create new Tred"/>
                                    </form>
                                </div>
                        </div>
                </div> <!-- /contactWrap --> 
                <div>
                        <div class="overlay">
                                <div class="container">
                                    <h1>List of Treds </h1>
                                    <?php $userlist = getCourses();?>
                                    <table class="table table-condensed table-striped table-bordered">
                                        <thead><tr><th>Name</th><th>Bidang</th><th>Edit</th><th>Delete</th></tr></thead>
                                        <tbody>
                                        <tr>
                                            <?php   while ($us = $userlist->fetch_assoc()){ ?>
                                            <tr><td><?php echo $us['name']; ?></td>
                                                <td><?php echo getAreaByID($us['area'])['name']; ?></td>
                                                <td><a href="tredz.php?edit=<?php echo $us['id']; ?>">EDIT</a></td>
                                                <td><a href="tredz.php?del=<?php echo $us['id']; ?>">DELETE</a></td>
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