<!DOCTYPE html>
<?php
include './headl.inc.php';
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
                        <div class="container">
                                <div class="navbar-header">
                                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                                <span class="sr-only">Toggle navigation</span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                        </button>
                                        <a class="navbar-brand" href="#topWrap">
                                                <span class="fa-stack fa-lg">
                                                        <i class="fa fa-circle fa-stack-2x"></i>
                                                        <i class="fa fa-mobile fa-stack-1x fa-inverse"></i>
                                                </span>
                                                e-<span class="title">GOTJOB</span>
                                        </a>
                                </div>
                                <div class="collapse navbar-collapse appiNav">
                                        <ul class="nav navbar-nav">
                                                <li><a href="index.php#whoWrap">Who We Are</a></li>
                                                <li><a href="index.php#latihWrap">Pelatih</a></li>
                                                <li><a href="index.php#loginWrap">Login</a></li>

                                        </ul>
                                </div><!--/.nav-collapse -->
                        </div>
                </div>
                <div id="topWrap" class="jumbotron">
                    <div class="container">   
                        <div class="example">
                            <ul class="navs">
                                <li><a href="system.php#">Home</a></li>
                                <li><a href="system.php#">Home</a></li>
                                <li><a href="system.php#">Home</a></li>
                                <li><a href="system.php#">Home</a></li>
                                <li><a href="system.php#">Tutorials</a>
                                    <ul class="subs">
                                        <li><a href="system.php#">HTML / CSS</a></li>
                                        <li><a href="system.php#">XHTML / CSS</a></li>
                                    </ul>
                                </li>
                                <li><a href="system.php#">Back</a></li>
                            </ul>
                            <div style="clear:both"></div>
                        </div>	
                    </div> 
                </div>
                    
           
                    
	
        
        
        
	
                <footer>
                        <div class="container">
                                <div class="row">
                                        <div class="col-xs-12 text-center">
                                                <p>Copyright &copy; 2014 AppBay - Responsive App Landing Page Template. Built by <a href="http://bootstrapbay.com">BootstrapBay</a>. All Rights Reserved</p>
                                                <p class="social">
                                                        <a href="https://www.facebook.com/bootstrapbay">
                                                                <span class="fa-stack fa-lg">
                                                                        <i class="fa fa-circle fa-stack-2x"></i>
                                                                        <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                                                </span>
                                                        </a>
                                                        <a href="https://twitter.com/bootstrapbay">
                                                                <span class="fa-stack fa-lg">
                                                                        <i class="fa fa-circle fa-stack-2x"></i>
                                                                        <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                                                </span>
                                                        </a>
                                                        <a href="https://plus.google.com/+BootstrapbayThemes">
                                                                <span class="fa-stack fa-lg">
                                                                        <i class="fa fa-circle fa-stack-2x"></i>
                                                                        <i class="fa fa-google-plus fa-stack-1x fa-inverse"></i>
                                                                </span>
                                                        </a>
                                                        <a href="http://www.youtube.com/user/bootstrapbayofficial">
                                                                <span class="fa-stack fa-lg">
                                                                        <i class="fa fa-circle fa-stack-2x"></i>
                                                                        <i class="fa fa-youtube fa-stack-1x fa-inverse"></i>
                                                                </span>
                                                        </a>
                                                </p>
                                        </div>
                                </div>
                        </div>
                </footer>


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