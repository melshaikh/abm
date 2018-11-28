<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>e-GotJob</title>

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/theme.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/animate.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    	<link rel="shortcut icon" href="img/icons/favicon.ico">
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="css/flexslider.css" rel="stylesheet">
	<link href="css/jquery.bxslider.css" rel="stylesheet">
	<link href="css/layerslider.css" rel="stylesheet">

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<script type="text/javascript">
    function setcomment()
{
        
    var ename = document.getElementById("name");
    var eemail = document.getElementById("email");
    var ephone = document.getElementById("phone");
    var emessage = document.getElementById("message");
    var urll = "sendcomment.php?name="+ename.value+"&email="+eemail.value+"&phone="+ephone.value+"&message="+emessage.value;
    var res = httpGet(urll);
    alert(res.trim());
    windows.location.href = "index.php?yid=good#contact"
    
}
function httpGet(theUrl)
        {
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
            xmlHttp.send( null );
            return xmlHttp.responseText;
        }
</script>
<body id="page-top" class="index">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">e-GOTJOB</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="">
                        <a class="page-scroll hvrNav-stat" href="#about">TENTANG KAMI</a>
                    </li>
                    <li class="">
                        <a class="page-scroll hvrNav-stat" href="abmin.php#services">STAF ABM</a>
                    </li>
                    <li class="">
                        <a class="page-scroll hvrNav-stat" href="majikan.php#services">MAJIKAN</a>
                    </li>
                    <li class="">
                        <a class="page-scroll hvrNav-stat" href="pelatih.php#services">PELATIH</a>
                    </li>
                    <li class="">
                        <a class="page-scroll hvrNav-stat" href="#contact">HUBUNGI KAMI</a>
                    </li>                   
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

<!--=== Slider ===-->
<div class="layer_slider">
    <div id="layerslider-container-fw">        
        <div id="layerslider" style="width: 100%; height: 550px; margin: 0px auto; ">
            <!--First Slide-->
            <div class="ls-layer" style="slidedirection: right; transition2d: 24,25,27,28; ">

                <img src="img/bg/5.jpg" class="ls-bg img-responsive" alt="Slide background">

                <img src="img/mockup/white-iphone.png" alt="Slider Image" class="ls-s-1" style=" top:110px; left: 240px; slidedirection : left; slideoutdirection : bottom; durationin : 1500; durationout : 1500; ">

                <img src="img/mockup/black-iphone.png" alt="Slider image" class="ls-s-1" style=" top:60px; left: 40px; slidedirection : left; slideoutdirection : bottom; durationin : 2500; durationout : 2500; ">

                <span class="ls-s-1" style=" text-transform: uppercase; line-height: 45px; font-size:35px; color:#fff; top:200px; left: 590px; slidedirection : top; slideoutdirection : bototm; durationin : 3500; durationout : 3500; ">
                    MUAT TURUN<br> APLIKASI E-GOTJOB
                </span>

                <a class="btn-u btn-success ls-s1" href="apis/app-debug.apk" style=" padding: 9px 20px; font-size:25px; top:340px; left: 590px; slidedirection : bottom; slideoutdirection : top; durationin : 3500; durationout : 3500; ">
                    Download now
                </a>
            </div>
            <!--End First Slide-->

            <!--Second Slide-->
            <div class="ls-layer" style="slidedirection: top; ">
                <img src="img/bg/5.jpg" class="ls-bg img-responsive" alt="Slide background">

                <i class="icon-chevron-sign-right ls-s-1" style=" color: #fff; font-size: 24px; top:70px; left: 40px; slidedirection : left; slideoutdirection : top; durationin : 1500; durationout : 500; "></i> 

                <span class="ls-s-2" style=" color: #fff; font-weight: 200; font-size: 30px; top:100px; left: 70px; slidedirection : top; slideoutdirection : bottom; durationin : 1500; durationout : 500; ">
                 Membina Harapan Merealisasikan Impian
                </span>

               <span class="ls-s-2" style=" color: #fff; font-weight: 200; font-size: 22px; top:150px; left: 70px; slidedirection : top; slideoutdirection : bottom; durationin : 2500; durationout : 1500; ">
                <i class="fa fa-check"></i>
                  Mencari Peluang Pekerjaan
                </span>

                <span class="ls-s-2" style=" color: #fff; font-weight: 200; font-size: 22px; top:200px; left: 70px; slidedirection : top; slideoutdirection : bottom; durationin : 3500; durationout : 2500; ">
                <i class="fa fa-check"></i>
                    Kemaskini Maklumat Alumni
                </span>

                <img src="img/mockup/white-iphone.png" alt="Slider Image" class="ls-s-1" style=" top:30px; left: 650px; slidedirection : right; slideoutdirection : bottom; durationin : 1500; durationout : 1500; ">
            </div>
            <!--End Second Slide-->

            <!--Third Slide-->
            <div class="ls-layer" style="slidedirection: right; transition2d: 92,93,105; ">
                <img src="img/bg/5.jpg" class="ls-bg img-responsive" alt="Slide background">

                <span class="ls-s-1" style=" color: #fff; line-height:45px; font-weight: 200; font-size: 35px; top:100px; left: 50px; slidedirection : top; slideoutdirection : bottom; durationin : 1000; durationout : 1000; ">
                    APLIKASI E-GOTJOB <br>
                </span>

                <a class="btn-u btn-primary ls-s-1" href="https://www.abmutara.com.my/" target="blank" style=" padding: 9px 20px; font-size:25px; top:220px; left: 50px; slidedirection : bottom; slideoutdirection : bottom; durationin : 2000; durationout : 2000; border-radius:2px; border: 2px solid #00A8E0;">
                    Find Out More
                </a>

                <img src="img/mockup/black-iphone.png" alt="Slider Image" class="ls-s-1" style=" top:30px; left: 670px; slidedirection : right; slideoutdirection : bottom; durationin : 3000; durationout : 3000; ">
            </div>
            <!--End Third Slide-->
        </div>         
    </div>
</div><!--/layer_slider-->
<!--=== End Slider ===-->

<div class="container"> 
    <!-- Service Blocks -->
    <div class="row">
        <div class="col-sm-6 intro wow animated fadeInUp animated animation-delay-3">
            <div class="service app-block">
                <i class="fa fa-mobile zservice-icon"></i>
                <div class="desc">
                    <h4>Aplikasi E-GotJob</h4>
                    <p>Aplikasi E-GotJob memberi peluang kepada para alumni ABM Utara untuk mencari peluang pekerjaan dan mengemaskini maklumat mereka.</p>
                </div>
            </div>  
        </div>
        <div class="col-sm-6 intro wow animated fadeInUp animated animation-delay-6">
            <div class="service app-block">
                <i class="fa fa-cogs zservice-icon"></i>
                <div class="desc">
                    <h4>Program Perantisan</h4>
                    <p>Program ini bertujuan untuk mempertemukan pelatih lepasan Akademi Binaan Malaysia (Wilayah Utara) dengan majikan/syarikat yang berpotensi dan menepati syarat serta garis panduan yang telah ditetapkan oleh CIDB, dan dalam masa yang sama membantu majikan/syarikat mendapatkan pekerja tempatan, bertaraf pekerja mahir dan kompeten, serta telah memenuhi segala keperluan yang ditetapkan oleh pihak kerajaan untuk bekerja di dalam industri.</p>
                </div>
            </div>  
        </div>
        <div class="col-sm-6 intro">
         <div class="app-block  wow animated fadeInUp animated animation-delay-9">
              <i class="fa fa-angellist"></i>
                    <h4>Majikan</h4>
                    <p> Syarikat yang mendaftar CIDB dapat mengiklankan Jawatan Kosong melalui sistem dan disokong oleh skim perantis CIDB.</p>
            </div>           
        </div>       
        <div class="col-sm-6 intro">
         <div class="app-block  wow animated fadeInUp animated animation-delay-12">
              <i class="fa fa-bolt"></i>
                    <h4>Para Alumni</h4>
                    <p>Mendapat manfaat melalui sistem ini dengan peluang pekerjaan yang disediakan oleh majikan yang mendaftar.</p>
            </div>           
        </div>       
    </div><!--/row-->
    <!-- End Service Blokcs -->
</div>

    <!-- About Section -->
    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h2 class="section-heading wow animated pulse animated">Akademi Binaan Malaysia Wilayah Utara</h2><hr />
                    <h3 class="section-subheading text-muted wow animated pulse animated">Akademi Binaan Malaysia (ABM) adalah pusat penilaian dan latihan CIDB, ​​yang memenuhi keperluan untuk pembangunan dan peningkatan kemahiran untuk pekerja binaan. ABM memberi tumpuan kepada melengkapkan personel binaan dengan kompetensi yang sesuai mengikut standard oleh industri.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                      <div class="about-image">
                          <img class="img-circle img-responsive" src="img/about/imagee.jpg" alt="">
                      </div>
                   </div>
                   <div class="col-sm-8">
                      <div class="about-panel">
                          <div class="about-heading">
                              <h4 class="subheading">e-GotJob</h4>
                          </div>
                          <div class="about-body">
                              <p class="text-muted">e-GotJob adalah sebuah sistem dan aplikasi yang memberi akses kepada para alumni dan majikan dalam mencari dan menawarkan peluang pekerjaan.</p>
                                    <p class="text-muted">Ini bertujuan untuk mempertemukan pelatih lepasan Akademi Binaan Malaysia (Wilayah Utara) dengan majikan/syarikat yang berpotensi dan menepati syarat serta garis panduan yang telah ditetapkan oleh CIDB, dan dalam masa yang sama membantu majikan/syarikat mendapatkan pekerja tempatan, bertaraf pekerja mahir dan kompeten, serta telah memenuhi segala keperluan yang ditetapkan oleh pihak kerajaan untuk bekerja di dalam industri.
                                    </p>
                                    <p class="text-muted"></p>
                                    <p class="text-muted"></p>
                          </div>
                      </div>
                </div>
<!--                <div class="col-sm-10">
                      <div class="about-panel">
                          <div class="about-heading">
                              <h4 class="subheading"></h4>
                          </div>
                          <div class="about-body">
                              <p class="text-muted"></p>
                          </div>
                          
                          <div class="about-heading">
                              <h4 class="subheading"></h4>
                          </div>
                          <div class="about-body">
                              <p class="text-muted"></p>
                          </div>
                      </div>
                </div>-->
                           
            </div>           
        </div>
    </section>



    
    
    <!-- Contact Section -->
    <section id="contact" class="">        
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h2 class="section-heading wow animated pulse animated">HUBUNGI KAMI</h2><hr />
                    <h3 class="section-subheading text-muted wow animated pulse animated">Sebarang masalah atau cadangan berkenaan sistem kami sila hubungi kami :</h3>
                    <?php if(isset($_GET['yid'])){ ?>
                    <h3 class="section-subheading text-muted wow animated pulse animated"><?php echo $_GET['yid'] ?></h3>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
				<div class="col-sm-4 contact-icon">
                                    <a href="https://www.abmutara.com.my/" target="blank"><i class="fa fa-search  wow animated zoomIn animation-delay-4"> ABM Utara</i></a>
				</div>
				<div class="col-sm-4 contact-icon">
					<i class="fa fa-phone  wow animated zoomIn animation-delay-4"> 04-9242200</i>
				</div>
				<div class="col-sm-4 contact-icon">
					<i class="fa fa-envelope  wow animated zoomIn animation-delay-5"> abm.utara@gmail.com</i>
				</div>
                    <form name="sentMessage" id="contactForm" novalidate>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Nama *" id="name" required data-validation-required-message="Please enter your name.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email *" id="email" required data-validation-required-message="Please enter your email address.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control" placeholder="No Telefon *" id="phone" required data-validation-required-message="Please enter your phone number.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Masalah / Cadangan *" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-12 text-center">
                                <div id="success"></div>
						<div class="skill-btn">
                                                    <button type="submit" class="hvr-bounce-to-right scroll btn btn-xl" onClick="setcomment()"> Submit </button>
						</div>
                                
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <span class="copyright-header">Copyright &copy; 2018</span>
                </div>
                <div class="col-sm-4">
                    <ul class="list-inline social-buttons">
                        <li><a class="twitter wow animated bounceInDown animated animation-delay-3" href="https://twitter.com/ABMUTARA"  target="blank"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li><a class="facebook wow animated bounceInDown animated animation-delay-4" href="https://www.facebook.com/akademibinaanmalaysiaofficials/"  target="blank"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li><a class="linkedin wow animated bounceInDown animated animation-delay-5" href="https://instagram.com/abmutara"  target="blank"><i class="fa fa-instagram"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-4">
                    <ul class="list-inline quicklinks">
                        <li><a href="#">Privacy Policy</a>
                        </li>
                        <li><a href="#">Terms of Use</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/agency.js"></script>
    <script src="js/jquery-migrate-1.2.1.min.js"></script>
    <script src="js/jquery.bxslider.js"></script>
    <script src="js/jquery.flexslider-min.js"></script>
    <script src="js/jquery-easing-1.3.js"></script>
    <script src="js/jquery-transit-modified.js"></script>
    <script src="js/layerslider.transitions.js"></script>
    <script src="js/layerslider.kreaturamedia.jquery.js"></script>
    <script src="js/app.js"></script>
    <script src="js/index.js"></script>
    <script src="js/wow.js"></script>

<script type="text/javascript">
    jQuery(document).ready(function() {
      	App.init();
        App.initSliders();
        App.initBxSlider();
        Index.initLayerSlider();
    });
</script>

<script> new WOW().init();</script>
</body>

</html>