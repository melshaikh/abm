<!DOCTYPE html>
<?php
include './headl.inc.php';
include 'navi.php';
if (isset($_POST['login']))
{
    if(isset($_POST['name']) AND isset($_POST['pass']))
                    {
                        $pass = hash("sha512",$_POST['pass']);
                        $sql = "SELECT `id` FROM `omr_users` WHERE `name`= '".$_POST['name']."' AND `password` = '".$pass."' LIMIT 1";
                        $query = $db->query($sql);
                        if($query->num_rows)
                            {
                            $sessionID = session_id();
                            $hash = hash("sha512",$sessionID.$_SERVER['HTTP_USER_AGENT']);

                            $userData = $query->fetch_assoc();
                            $expires = time()+(15*60);
                            $sqsl = "SELECT `id` FROM `omr_active_users` WHERE `user`= '".(int)$userData['id']."' LIMIT 1";
                            $aq = $db->query($sqsl);
                            if($l = $aq->fetch_assoc())
                            {
                            $new_sql = "UPDATE `omr_active_users` SET `user`='".(int)$userData['id']."',`session_id`='".$sessionID."',`hash`='".$hash."',`expires`= '".$expires."' WHERE `user` =".(int)$userData['id'];
                            }
                            else 
                            {
                            $new_sql = "INSERT INTO `omr_active_users`(`user`, `session_id`, `hash`, `expires`) VALUES ('".(int)$userData['id']."','".$sessionID."','".$hash."','".$expires."')";
                            }
                            $db->query($new_sql);
                            // if I admin go to admin page
                            $f = getLecturer();
                            if((int)$f['level'] == 0)
                            {
                                header("Location: test.php");
                            } else if((int)$f['level'] == 1)
                            {
                                header("Location: test.php");
                            }
                            else
                            
                                print("Welcom: ".  $f['name']);
                            }
                            else
                            {
                              
                            }
                    }
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
                <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                        <?php
                        printHead();
                        ?>
                </div>
                <?php                
                printTUSB("pelajar");
                $comp = getCompanyByUserId(isLecturerLoggedIn());
                ?>
                   
        <div class="container" style="margin-top: 2%;">
            <div class="row" style="margin-right: 2%;">
                <div class="col-sm-2" style="margin-right: 1%;">
                    <ul class="navs" >
                        <li style="width: 100%"><a href="tusbpedite.php">Edit Offers</a></li>
                        <li style="width: 100%"><a href="tusbp.php" class="active">New Offer</a></li>                        
                    </ul>                 
                </div>
                <div class="col-sm-7" style="margin-right: 2%;">
            <?php 
            if(isset($_POST['addjob']))
            {
                if(isset($_POST['name']) AND isset($_POST['company']))
                    {
                    $company = "";
                    $position = "";
                    $description = "";
                    if(isset($_POST['company']))
                        $company= $_POST['company'];
                    if(isset($_POST['address']))
                        $position= $_POST['address'];
                    if(isset($_POST['description']))
                        $description = $_POST['description'];
                        $sql="INSERT INTO `jobs` (`id`, `name`, `company`, `position`, `detail`,`email`,`company_id`,`bidang_id`,`date`)"
                            . " VALUES (NULL, '".$_POST['name']."', '".$company."', '".$position."', '".$description."',"
                                . "'".$_POST['email']."','".$comp['id']."','".$_POST['bidang']."','". date("Y-m-d")."');";
                    if(mysqli_query($db, $sql))
                        {
                        echo '<div class="row">
                                <div id="coment" class="col-xs-12">
                                        <h2 class="sectionTitle">Successfully Job Record is Added</h2>
                                        <h2 class="sectionTitle">Add New Record</h2>
                                </div>
                        </div>';
                        }
                    else{
                        echo '<div class="row">
                                    <div  id="coment" class="col-xs-12">

                                            <h2 class="sectionTitle">Not Successful ('.$sql.'</h2>
                                    </div>
                            </div>';
                        }
                    }
            }
            ?>
                    <form action="tusbpedite.php" method="POST">
                    <table class="table table-striped table-striped table-bordered">
                        <tbody>
                            <tr>
                                <td style="width: 25%; padding-left: 2%;">Job Title</td>
                                <td><input type="text" name="name" id="contactName" value="" class="form-control" autocomplete="off" /></td>                                            
                            </tr>
                            <tr>
                                <td style="width: 25%; padding-left: 2%;">Company</td>
                                <td><input type="text" name="company" id="email" value="<?php echo $comp['name'] ?>" class="form-control" autocomplete="off"  /></td>                                            
                            </tr>
                            <tr>
                                <td style="width: 25%; padding-left: 2%;">Address</td>
                                <td><input type="text" name="address" value="<?php echo $comp['address'] ?>" class="form-control" autocomplete="off"  /></td>                                            
                            </tr>
                            <tr>
                                <td style="width: 25%; padding-left: 2%;">Email</td>
                                <td><input type="text" name="email" value="<?php echo $comp['email'] ?>" class="form-control" autocomplete="off"  /></td>                                            
                            </tr>
                            <tr>
                                <td style="width: 25%; padding-left: 2%;">Deskripsi</td>
                                <td><input type="text" name="description"  value="" class="form-control" autocomplete="off"  /></td>                                            
                            </tr>
                            <tr>
                                <td style="width: 25%; padding-left: 2%;">Bidang</td>
                                <td>
                                    <select name="bidang" class="btn btn-primary btn-sm" style="width: 50%; float: left; ">
                                        <?php
                                        $pids = getArea();
                                        while($pp = $pids->fetch_assoc()){
                                        ?>
                                        <option class="btn btn-primary btn-sm" value="<?php echo $pp['id'] ?>" style="width: 50%; float: right;"><?php echo $pp['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </td>                                            
                            </tr>
                            <tr>
                                <td style="padding-left: 2%;" colspan="2">
                                    <button style="width: 50%; float: right;" name="addjob" type="submit" class="btn btn-primary btn-lg">Tambah Rekod</button>
                                </td>                                           
                            </tr>
                        </tbody>
                    </table>
                    </form>
                    
                </div>
            </div>
        </div>     
	
        
        
        
	
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
</html>