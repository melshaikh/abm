<!DOCTYPE html>
<?php
include './headl.inc.php';
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
                        ?>
                </div>
                <?php
                
                printABM("job");
                ?>
                <div id="featureWrap">
                        <div class="container">
                                <div class="row">
                                        <div class="col-sm-5 text-center feature">
                                            <a href="abmjoba.php"><i class="fa fa-plus icon"></i></a>
                                            <h3>Tambah Tawaran Perkerjaan</h3>
                                        </div>
                                        <div class="col-sm-5 text-center feature">
                                            <a href="abmjobn.php"><i href="#featureWrap" class="fa fa-cog icon"></i></a>                                                
                                                <h3>Iklan kepada Pelajar</h3>
                                        </div>
                                        
                                </div>
                        </div>
                </div> <!-- /featureWrap -->
                <div id="contactWrap">
                        <div class="overlay">
                                <div class="container">
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
                                                                if(isset($_POST['position']))
                                                                    $position= $_POST['position'];
                                                                if(isset($_POST['description']))
                                                                   $description = $_POST['description'];
                                                                
                                                                
                                                                
                                                                $sql="INSERT INTO `jobs` (`id`, `name`, `company`, `position`, `detail`)"
                                                                        . " VALUES (NULL, '".$_POST['name']."', '".$company."', '".$position."', '".$description."');";
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
                                                        }else{
                                                            echo '<div class="row">
                                                                            <div class="col-xs-12">
                                                                            <h2 class="sectionTitle">Tawaran Kerja Baru</h2>
                                                                    </div>
                                                            </div>';
                                                        }
                                                        ?>
                                        
                                    <form action="abmjoba.php" method="POST">
                                                <div class="row">
                                                        <div class="col-sm-4 col-sm-offset-2">
                                                                <div class="inputContainer">
                                                                <label>Nama</label>
                                                                        <input type="text" name="name" id="contactName" value="" class="form-control" autocomplete="off" />
                                                                </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                                <div class="inputContainer">
                                                                <label class="screen-reader-text">Syarikat</label>
                                                                        <input type="text" name="company" id="email" value="" class="form-control" autocomplete="off"  />
                                                                </div>
                                                        </div>
                                                        <div class="col-sm-4 col-sm-offset-2">
                                                                <div class="inputContainer">
                                                                <label>Jawatan</label>
                                                                        <input type="text" name="position" id="contactName" value="" class="form-control" autocomplete="off" />
                                                                </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                                <div class="inputContainer">
                                                                <label class="screen-reader-text">Deskripsi</label>
                                                                        <input type="text" name="description" id="email" value="" class="form-control" autocomplete="off"  />
                                                                </div>
                                                        </div>
                                                        
                                                        <div class="col-sm-8 col-sm-offset-2">
                                                                <button name="addjob" type="submit" class="btn btn-primary btn-lg">Tambah Rekod</button>
                                                        </div>
                                                    
                                                        
                                                        
                                                    
                                                </div>
                                        </form>
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
</html>