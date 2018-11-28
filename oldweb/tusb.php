<!DOCTYPE html>
<?php
include './headl.inc.php';
if(isLecturerLoggedIn()){
    if(strcmp(getUserById(isLecturerLoggedIn())['level'],'tusb') == 0)
        {
include 'navi.php';
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
                
                printTUSB("profile");
                $comp = getCompanyByUserId(isLecturerLoggedIn());
                ?>
        <div class="container">
             <div class="row" style="margin-left: 1%; margin-right: 1%;">
                 <h1 class="sectionTitle">COMPANY PROFILE</h1>
                                <table class="table table-striped table-striped table-bordered">
                                    <tbody>
                                        <tr>
                                            <td style="width: 25%; padding-left: 2%;">Company Name</td>
                                            <td><?php echo $comp['name'] ?></td>                                            
                                        </tr>
                                        <tr>
                                            <td style="width: 25%; padding-left: 2%;">Address</td>
                                            <td><?php echo $comp['address'] ?></td>                                            
                                        </tr>
                                        <tr>
                                            <td style="width: 25%; padding-left: 2%;">Website</td>
                                            <td><?php echo $comp['website'] ?></td>                                            
                                        </tr>
                                        <tr>
                                            <td style="width: 25%; padding-left: 2%;">Phone</td>
                                            <td><?php echo $comp['phone'] ?></td>                                            
                                        </tr>
                                        <tr>
                                            <td style="width: 25%; padding-left: 2%;">Email</td>
                                            <td><?php echo $comp['email'] ?></td>                                            
                                        </tr>
                                    </tbody>
                                </table>
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
    <?php }else header("Location:index.php?login=Please Login2");
}else header("Location:index.php?login=Please Login1");?>