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
                
                        printKEY2("list");
                ?>
                
                <!--<div id="contactWrap">-->
                        
                <div class="container-fluid">
                                    
                    <div class="row">
                                        <table class="table table-condensed table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>TRED - SESI</th>
                                                                <th>NAMA</th>
                                                                <th>No. Kad Pengenalan</th>
                                                                <th>No. Tel Pelatih</th>
                                                                <th>No. Tel Waris</th>
                                                                <th>ALAMAT</th>
                                                                <th>POSTKOD</th>
                                                                <th>Negri</th>
                                                                <th>Pencapaian Akademik<br>(PMR/SPM)</th>
                                                                <th>Pekerjaan</th>
                                                                <th>BDB</th>
                                                                <th>BLB</th>
                                                                <th>BSDB</th>
                                                                <th>BSLB</th>
                                                                <th>SBDB</th>
                                                                <th>SBLB</th>
                                                                <th>TB</th>
                                                                <th>LL</th>
                                                                <th>Alamat Syarikat</th>
                                                                <th>Tarikh Mula Bekerja</th>
                                                                <th>Gaji</th>
                                                                <th>Catatan</th>
                                                                <th>EDIT</th>
                                                                
                                                            </tr>
                                                        </thead>
                                                        <?php 
                                                        $sql = "SELECT * FROM `students` WHERE `addby` = '".$user['id']."'";
                                                        $slist = $db->query($sql);
                                                        $nn = 1;
                                                        while($s = $slist->fetch_assoc()){
                                                            $coh = getcohortbyid($s['sesi_id']);
                                                            $tred = getCourseByID($coh['tred_id']);
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $nn;?></td>
                                                            <td><?php echo $tred['name'].' - '.$coh['name'];?></td>
                                                            <td><?php echo $s['name'];?></td>
                                                            <td><?php echo $s['ic'];?></td>
                                                            <td><?php echo $s['phone1'];?></td>
                                                            <td><?php echo $s['phone2'];?></td>
                                                            <td><?php echo $s['address'];?></td>
                                                            <td><?php echo $s['postcode'];?></td>
                                                            <td><?php echo $s['negri'];?></td>
                                                            <td><?php echo $s['akad'];?></td>
                                                            <td><?php echo $s['working_field'];?></td>
                                                            <td><?php echo $s['bdb'];?></td>
                                                            <td><?php echo $s['blb'];?></td>
                                                            <td><?php echo $s['bsdb'];?></td>
                                                            <td><?php echo $s['bslb'];?></td>
                                                            <td><?php echo $s['sbdb'];?></td>
                                                            <td><?php echo $s['sblb'];?></td>
                                                            <td><?php echo $s['tb'];?></td>
                                                            <td><?php echo $s['ll'];?></td>
                                                            <td><?php echo $s['company'];?></td>
                                                            <td><?php echo $s['companydate'];?></td>
                                                            <td><?php echo $s['gaji'];?></td>
                                                            <td><?php echo $s['coment'];?></td>
                                                            <td><a href="keyg.php?edit=<?php echo $s['id'];?>">EDIT</a></td>
                                                        </tr>
                                                        <?php $nn++;} ?>
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