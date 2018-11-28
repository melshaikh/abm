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
                
                printABM("stats");
                ?>
                <div id="loginWrap">
                    <div class="overlay">
                            <div class="container">
                                <form action="tusbc.php" method="post">  

                                    
                                    <label class="moved">Pilih Kursus</label>
                                    <select name="course" class="form-control">
                                    <option>Course A</option>
                                        <option>Course B</option>
                                    </select>
                                   
                                    <label class="moved">Pilih Status</label>
                                    <select name="status" class="form-control">
                                    <option>BEKERJA</option>
                                        <option>TIDAK BEKERJA</option>
                                    </select>
                                    
                                    <fieldset id="group1" multiple>
                                        <br><br>
                                        <label class="moved">Select Students</label>
                                <table border="1">
                                    <thead>
                                        <tr>
                                            <th>Select</th>
                                            <th>Name</th>
                                            <th>Contact</th>
                                            <th>Status</th>
                                            <th>Course</th>
                                            <th>CGPA</th>
                                            <th>Skill</th>
                                            <th>Exper</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="checkbox" name="std_list[]" value="aa" /></td>
                                            <td>Ali Hassan</td>
                                            <td>PH:0123456 <br>E-mail:aaa@abc.com <br>Address: Changlun</td>
                                            <td>WORKING</td>
                                            <td>Electrical</td>
                                            <td>2.5</td>
                                            <td>CIDB Technical Staff</td>
                                            <td>3 Years</td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" name="std_list[]" value="aa" /></td>
                                            <td>Ali Hassan</td>
                                            <td>PH:0123456 <br>E-mail:aaa@abc.com <br>Address: Changlun</td>
                                            <td>WORKING</td>
                                            <td>Electrical</td>
                                            <td>2.5</td>
                                            <td>CIDB Technical Staff</td>
                                            <td>3 Years</td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" name="std_list[]" value="aa" /></td>
                                            <td>Ali Hassan</td>
                                            <td>PH:0123456 <br>E-mail:aaa@abc.com <br>Address: Changlun</td>
                                            <td>WORKING</td>
                                            <td>Electrical</td>
                                            <td>2.5</td>
                                            <td>CIDB Technical Staff</td>
                                            <td>3 Years</td>
                                        </tr>
                                    </tbody>
                                </table>
                                 </fieldset>  
                                   <div class="col-sm-8 col-sm-offset-2">
                                            <button type="submit" name="notifyAcompany" class="btn btn-primary btn-lg">Notify A company</button>
                                    </div>    
                                </form>
                            </div>
                    </div>
            </div> <!-- /TUSBWrap -->    
                    
                    
	
        
        
        
                
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