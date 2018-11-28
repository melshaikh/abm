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
                
                        printZAH("newuser");
                ?>
                    <?php if(isset($_POST['createuser'])){
                        
                        $pass = hash("sha512", $_POST['ic']);
                        
                        $sql = "INSERT INTO `omr_users` (`id`, `name`, `password`, `email`, `u_name`, `u_id`, `level`, `ic`) "
                                . "VALUES (NULL, '".$_POST['name']."', '".$pass."', '".$_POST['email']."', '', '', '".$_POST['level']."', '".$_POST['ic']."');";
                        $chk = "SELECT * FROM `omr_users` WHERE `email` = '".$_POST['email']."'";
                        $ck = $db->query($chk);
                        if($ck->num_rows < 1){
                        if($db->query($sql)){
                            //add company 
                            $indexi = $db->insert_id;
                            if(strcmp($_POST['level'],'tusb') == 0)
                            {
                                $sql = "INSERT INTO `company` (`id`,`name`,`email`,`user_id`)"
                                        . "VALUES (NULL, '".$_POST['name']."','".$_POST['email']."','".$indexi."')";
                               if($db->query($sql)){
                                $cid = $db->insert_id;
                                $sql = "UPDATE `omr_users` SET `u_id` = '".$cid."' WHERE `id` = ".$indexi;
                                $db->query($sql);
                               
                               }
                            }
                            echo '<h1> USER IS SUCCESSFULLY REGISTERED</h1>';
                        }else  echo '<h1> USER IS REGISTERED BEFORE </h1>';
                        }
                    }?>
                    <?php if(isset($_POST['newuserform'])){?>
                    <div id="contactWrap">
                        <div class="overlay">
                                <div class="container">
                                    
                                    <table class="table table-condensed table-striped table-bordered">
                                        <form action="newuserz.php" method="post">
                                        <tr>
                                            <td>Name</td><td><input type="text" name="name" required/></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td><td><input type="text" name="email" required/></td>
                                        </tr>
                                        <tr>
                                            <td>IC</td><td><input type="text" name="ic" required/></td>
                                        </tr>
                                        <tr>
                                            <td>Level</td><td>
                                                <select name="level">
                                                    <option value="abm">ABM</option>
                                                    <option value="tusb">COMPANY</option>
                                                    <option value="key">KEY</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr><td colspan="2"><input type="submit" name="createuser" value="SUBMIT" style="width: 80%; margin-left: 10%; margin-right: 10%;"/></td></tr>
                                    </form>
                                    </table>
                                    
                                </div>
                        </div>
                </div> <!-- /contactWrap -->  
                    <?php } ?>
                <div style="margin: 3%;">
                        <div class="overlay">
                                <div class="container">
                                    <form action="newuserz.php" method="post">
                                        <input type="submit" name="newuserform" value="create new user"/>
                                    </form>
                                </div>
                        </div>
                </div> <!-- /contactWrap --> 
                <!--<div>-->
                        <div class="overlay">
                                <div class="container">
                                    <h1>List of Users </h1>
                                    <?php $userlist = getListofUsers();?>
                                    <table class="table table-condensed table-striped table-bordered">
                                        <thead><tr><th>Name</th><th>IC</th><th>Level</th><th>KEYIN Count</th><th>Edit</th><th>Delete</th></tr></thead>
                                        <tbody>
                                        <tr>
                                            <?php   while ($us = $userlist->fetch_assoc()){ ?>
                                            <tr><td><?php echo $us['name']; ?></td>
                                                <td><?php echo $us['ic']; ?></td>
                                                <td><?php echo $us['level']; ?></td>
                                                <td><?php echo getUserKeyCount($us['id']); ?></td>
                                                <td><a href="newuserz.php?edit=<?php echo $us['id']; ?>">EDIT</a></td>
                                                <td><a href="newuserz.php?del=<?php echo $us['id']; ?>">DELETE</a></td>
                                            <?php } ?>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                <!--</div>  /contactWrap -->  
                
                    
                    
	
        
        
        
                
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