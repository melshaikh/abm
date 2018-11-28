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
                <div id="loginWrap">
                    <div class="overlay">
                            <div class="container">
                                <form action="abmjobn.php" method="post">  

                                    
                                    <label class="moved">Carian Berdasarkan Sesi</label>
                                    <?php $aa = getCohortList('tred_id');
                                    ?>
                                    <select name="area" class="form-control">
                                        <?php while ($ax = $aa->fetch_assoc()){ 
                                            $tnam = getCourseByID($ax['tred_id'])['name']; ?>
                                        <option value="<?php echo $ax['id']; ?>"><?php echo $tnam.'('.$ax['name'].')'; ?></option>
                                       
                                        <?php } ?>
                                    </select>
                                    <div class="col-sm-8 col-sm-offset-2">
                                            <button type="submit" name="byarea" class="btn btn-primary btn-lg">Cari</button>
                                    </div>
                                </form>
                                
                                <?php if(isset($_POST['bycourse']) OR isset($_POST['byarea'])){
                                    if(isset($_POST['byarea']))
                                        $slist=getStudentListByArea($_POST['area']);
                                    if(isset($_POST['bycourse']))
                                        $slist=getStudentListByCourse($_POST['course']);
                                    ?>
                                <form action="abmjobn.php" method="post"> 
<!--                                    <label class="moved">Select a Status</label>
                                    <select name="status" class="form-control">
                                    <option>WORKING</option>
                                        <option>NOT WORKING</option>
                                    </select>-->
<br>
                                    <label class="moved">Select Students</label>
                                    <fieldset id="group1" multiple>
                                        <br><br>
                                        
                                <table border="1">
                                    <thead>
                                        <tr>
                                            <th>Select</th>
                                            <th>Name</th>
                                            <th>Contact</th>
                                            <th>Status</th>
                                            <th>Course</th>
                                            <th>Area</th>
                                            <th>Skill</th>
                                            <th>Exper</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($std=$slist->fetch_assoc()){
                                            $chot = getcohortbyid($std['sesi_id']);
                                            $exp = getStudentExp($std['id']);
                                            ?>
                                        <tr>
                                            <td><input type="checkbox" name="std_list[]" value="<?php echo $std['id']; ?>" /></td>
                                            <td><?php echo $std['name']; ?></td>
                                            <td>PH:<?php echo $std['phone1']; ?> <br>E-mail:<?php echo $std['email']; ?> <br>Address: <?php echo $std['address']; ?></td>
                                            <td><?php echo $std['working_status']; ?></td>
                                            <td><?php echo getCourseByID($chot['tred_id'])['name']; ?></td>
                                            <td><?php echo getAreaByID($chot['area_id'])['name']; ?></td>
                                            <td><?php
                                            if($exp != NULL){
                                                while($e=$exp->fetch_assoc()){
                                                    echo $e['company'].'<br>';
                                                }
                                            }else  echo 'NONE';                                            
                                            ?></td>
                                            <td>3 Years</td>
                                        </tr>
                                        <?php }  ?>
                                        
                                    </tbody>
                                </table>
                                <?php $jobs = getJobsList();?>        
                                 </fieldset> 
                                    <label class="moved">Select job</label>
                                    <fieldset id="group1" multiple>
                                        <br><br>
                                <form action="abmjobn.php" method="post">         
                                <table border="1">
                                    <thead>
                                        <tr>
                                            <th>Select</th>
                                            <th>Name</th>
                                            <th>Company</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                
                                <?php
                                    while($j = $jobs->fetch_assoc()){ ?>
                                    <tr>
                                            <td><input type="checkbox" name="job_list[]" value="<?php echo $j['id']; ?>" /></td>
                                            <td><?php echo $j['name']; ?></td>
                                            <td><?php echo $j['company']; ?></td>
                                            <td><?php echo $j['detail']; ?></td>                                            
                                        </tr>    
                                    <?php } ?>  
                                    </tbody>
                                </table>
                                  <div class="col-sm-8 col-sm-offset-2">
                                            <button type="submit" name="notify" class="btn btn-primary btn-lg">Notify</button>
                                    </div>     
                                </form>
                                <?php } elseif (isset ($_POST['notify'])) {
                                    echo '<h1> Students: </h1>';
                                   $ns = count($_POST['std_list']);
                                   $nj = count($_POST['job_list']);
                                  for($i=0; $i < $ns; $i++)
                                  {
                                      for($j=0;$j<$nj;$j++){
                                          notify($_POST['std_list'][$i],$_POST['job_list'][$j]);
                                   echo($_POST['std_list'][$i] . " ");
                                      }
   
                                  }         
                                }
                               ?>
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