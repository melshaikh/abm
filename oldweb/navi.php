<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function printlogin()
{
    echo '<div id="loginWrap">
                    <div class="overlay">
                            <div class="container">
                                    <div class="row">
                                                    <div class="col-xs-12">
                                                    <h2 class="sectionTitle">Log Masuk</h2>
                                            </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-xs-12 text-center">
                                                    <div class="blurb">
                                                    Sistem E-GOTJOB
                                                    </div>
                                            </div>
                                    </div>
                                <div class="row">
                                <form action="login.php" method="POST">
                                
                                 
                                                
                                                    <div class="col-sm-6 moved">
                                                            <div class="inputContainer">
                                                                <label class="moved">Email/ID</label>
                                                                    <input type="text" name="name" id="contactName" value="" class="form-control" autocomplete="off" />
                                                            </div>
                                                    </div>
                                                    
                                                    <div class="col-sm-6 moved">
                                                            <div class="inputContainer">
                                                            <label class="moved" class="screen-reader-text">Kata Laluan</label>
                                                                    <input type="password" name="pass" id="email" value="" class="form-control" autocomplete="off"  />
                                                            </div>
                                                    </div>

                                                    <div class="col-sm-5 moved">
                                                            <button type="submit" name="login" class="btn btn-primary btn-lg moved" >Hantar</button>
                                                    </div>
                                               
                                            
                                    </form>
                                    <form action="index.php#forget" method="POST">
                                    <div class="col-sm-5 moved">
                                        <button type="submit" name="loginx" class="btn btn-primary btn-lg moved" style="background-color:red;" >Forget your password</button>
                                    </div>
                                    </form>
                                    </div>
                            </div>
                    </div>
            </div> <!-- /TUSBWrap -->';
}
function printHead()
{
    echo '<div class="row">
                            <div class="container">
                                <div class="navbar-header">
                                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                                <span class="sr-only">Toggle navigation</span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                        </button>
                                        <a class="navbar-brand" href="index.php#topWrap">
                                                <span class="fa-stack fa-lg">
                                                        <i class="fa fa-circle fa-stack-2x"></i>
                                                        <i class="fa fa-mobile fa-stack-1x fa-inverse"></i>
                                                </span>
                                                e-<span class="title">GOTJOB</span>
                                        </a>
                                </div>
                                <div class="collapse navbar-collapse appiNav">
                                        <ul class="nav navbar-nav">
                                                <li><a href="index.php#whoWrap">e-GOTJOB</a></li>';
                                               
                                                if(!isLecturerLoggedIn())
                                                    echo '<li><a href="index.php#loginWrap">Log Masuk</a></li>';
                                                else                                                    
                                                    echo '<li><a href="logout.php">Log Keluar</a></li>';
                                                
                                                

                                        echo '</ul>
                                </div>
                            </div>
            </div><!--/.nav-collapse -->';
//        </div>';
}
function printFooter()
{
    echo '<footer>
                        <div class="container">
                                <div class="row">
                                        <div class="col-xs-12 text-center">
                                                <p>Copyright &copy; 2017 ABM. Built by <a href="http://www.unimap.edu.my">UniMAP</a>. All Rights Reserved</p>
                                                <p class="social">
                                                        <a href="https://www.unimap.edu.my">
                                                                <span>
                                                                        <img class="icons" src="assets/img/unimap.png" >
                                                                        
                                                                </span>
                                                        </a>
                                                    <a href="https://www.akademibinaan.com.my/abmweb/index.php/mengenai-abm/kampus/abm-wilayah-utara">
                                                                <span>
                                                                        <img class="icons" src="assets/img/abm2.png" >
                                                                        
                                                                </span>
                                                        </a>
                                                    
                                                        
                                                </p>
                                        </div>
                                </div>
                        </div>
                </footer>';
}
function printTUSB($page)
{
    
    $syarikat = '';
    $pelajar = '';
    $profile = '';
    
    switch($page)
    {
        case 'syarikat':
            $syarikat = 'class="active"';
            break;
        case 'pelajar':
            $pelajar= 'class="active"';
            break;
        case 'profile':
            $profile= 'class="active"';
            break;
        
        
            
    }
    
    
    echo '
                    <div class="container">   
                        <div id="navss" class="jumbotron">
                            <ul class="navs">
                                <li><a href="tusb.php#" '.$profile.'>Profile</a></li>
                                <li ><a href="tusbp.php#" '.$pelajar.'>Job Offer</a></li>
                                <li><a href="tusbc.php#" '.$syarikat.'>Application</a></li>
                                
                            </ul>
                            <div style="clear:both"></div>
                        	
                    </div> 
                </div>';
}

function printABM($page)
{
    
    $graduan = '';
    $pelajar = '';
    $stats ='';
    $course = '';
    $job = '';
    
    
    switch($page)
    {
        case 'graduan':
            $graduan = 'class="active"';
            break;
        case 'pelajar':
            $pelajar= 'class="active"';
            break;
        case 'course':
            $course= 'class="active"';
            break;
        case 'stats':
            $stats= 'class="active"';
            break;
        case 'job':
            $job= 'class="active"';
            break;
        
        
            
    }
    
    
    echo '
                    <div class="row" style="margin-bottom:5px; background:#f4fcff;">
                    <div class="container">
                        <div id="navss" >
                            <ul class="navs">
                                <li ><a href="abmp.php#" '.$pelajar.'>Pelajar</a></li>
                                <li><a href="abmg.php#" '.$graduan.'>Graduan</a></li>
                                <li><a href="abmc.php#" '.$course.'>Kursus</a></li>
                                <li><a href="abmjob.php#" '.$job.'>Tawaran Kerja</a></li>'
            . '<li><a href="abms.php#" '.$stats.'>Statistik</a></li>
                                    
                                
                            </ul>
                            <div style="clear:both"></div>
                        	
                    </div> 
                </div>';
}
function printKEY($page)
{
    
    $profile = '';
    $pelajar = '';
    $stats ='';
    $list = '';
    $job = '';
    
    
    switch($page)
    {
        case 'profile':
            $profile = 'class="active"';
            break;
        case 'keyp':
            $keyp= 'class="active"';
            break;
        case 'list':
            $list= 'class="active"';
            break;
        case 'stats':
            $stats= 'class="active"';
            break;
        case 'job':
            $job= 'class="active"';
            break;
        
        
            
    }
    
    
    echo '
                <div class="container">
                    <div class="row">
                        <div id="navss" class="jumbotron">
                            <ul class="navs">
                                <li ><a href="keyinuser.php" '.$profile.'>Profile</a></li>
                                <li ><a href="keyp.php#" '.$keyp.'>Pelajar Key-IN</a></li>
                                <li><a href="keyg.php#" '.$list.'>List/Edit</a></li>
                            </ul>
                        </div>                        	
                    </div> 
                </div>';
}
function printKEY2($page)
{
    
    $profile = '';
    $pelajar = '';
    $keyp ='';
    $list = '';
    $job = '';
    
    
    switch($page)
    {
        case 'profile':
            $profile = 'class="active"';
            break;
        case 'keyp':
            $keyp= 'class="active"';
            break;
        case 'list':
            $list= 'class="active"';
            break;
        case 'stats':
            $stats= 'class="active"';
            break;
        case 'job':
            $job= 'class="active"';
            break;
        
        
            
    }
    
    
    echo '
                <div class="row" style="margin-bottom:5px; background:#f4fcff;">
                    <div class="container">
                        <div id="navss" >
                            <ul class="navs">
                                <li ><a href="keyinuser.php" '.$profile.'>Profile</a></li>
                                <li ><a href="keyp.php#" '.$keyp.'>Pelajar Key-IN</a></li>
                                <li><a href="keyg.php#" '.$list.'>List/Edit</a></li>
                            </ul>
                        </div>                        	
                    </div> 
                </div>';
}
function printZAH($page)
{
    
    $sesi = '';
    $profile = '';
    $tred ='';
    $bidang = '';
    $job = '';
    $newuser = '';
    
    
    switch($page)
    {
        case 'newuser':
            $newuser = 'class="active"';
            break;
        case 'profile':
            $profile= 'class="active"';
            break;
        case 'bidang':
            $bidang= 'class="active"';
            break;
        case 'tred':
            $tred= 'class="active"';
            break;
        case 'sesi':
            $sesi= 'class="active"';
            break;
        
        
            
    }
    
    
    echo '
                    <div class="row" style="margin-bottom:5px; background:#f4fcff;">
                    <div class="container">
                        <div id="navss" >
                            <ul class="navs">
                                <li ><a href="zah.php" '.$profile.'>Profile</a></li>'
            . '<li ><a href="newuserz.php#" '.$newuser.'>Create User</a></li>
                                <li><a href="sesiz.php#" '.$sesi.'>SESI</a></li>
                                <li><a href="tredz.php#" '.$tred.'>TRED</a></li>'
            . '<li><a href="bidangz.php#" '.$bidang.'>BIDANG</a></li>'
            . '</ul>
                            <div style="clear:both"></div>
                        	
                    </div> 
                </div>';
}