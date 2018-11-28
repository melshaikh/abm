<?php
function printFooter(){
    echo '<footer class="footer text-center">
                All Rights Reserved by ABM UTARA. Designed and Developed by
                <a href="#">Mohamed Elshaikh@TUSB UniMAP</a>.
            </footer>';
}
function printsidebar()
{
    echo '<aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.php" aria-expanded="false">
                                <i class="fas fa-home"></i>
                                <span class="hide-menu">HOME</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="jobs.php" aria-expanded="false">
                                <i class="fas fa-id-card"></i>
                                <span class="hide-menu">TAWARAN KERJA</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../../logout.php" aria-expanded="false">
                                <i class="fas fa-sign-out-alt"></i>
                                <span class="hide-menu">LOGOUT</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>';
}
function printpagehead($image)
{
    if(strcmp($image,'') == 0)
      $image = 'users_files/unknown.jpg';
    else $image = 'users_files/'.$image;
    

    echo '<header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header" data-logobg="skin5">
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                        <i class="ti-menu ti-close"></i>
                    </a>
                    <div class="navbar-brand">
                        <a href="index.php" class="logo">
                            <b class="logo-icon">
                                <img src="../../assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                                <!-- Light Logo icon -->
                                <img src="../../assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                            </b>
                            <!--End Logo icon -->
                            <!-- Logo text -->
                            <span class="logo-text">
                                <!-- dark Logo text -->
                                <img src="../../assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                                <!-- Light Logo text -->
                                <b style="color: white">ABM</b>
                                <!--<img src="../../assets/images/logo-light-text.png" class="light-logo" alt="homepage" />-->
                            </span>
                        </a>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ti-more"></i>
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin6">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item search-box">
                            
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img style="padding-top: 30%" src="'.$image.'" alt="user" class="rounded-circle" width="31"></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated" >
                                <a class="dropdown-item" href="index.php"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                                <a class="dropdown-item" href="changepass.php"><i class="ti-wallet m-r-5 m-l-5"></i> Kata Laluan</a>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>';
}
function printCompany($page)
{
    $list = '';
    $baru = '';
    $kemas = '';
    switch ($page)
    {
        case 'list': $list = ' active '; break;
        case 'baru': $baru = ' active '; break;
        case 'kemas': $kemas = ' active '; break;
    }
    echo '  <div class="col-md-12">
                    <ul class="list-inline row">
                        <li class="'.$list.' btn btn-outline-cyan" style="width: 10%">
                            <a href="company.php">Senarai Majikan</a>
                        </li>
                        <li class="'.$baru.'btn btn-outline-cyan" style="width: 10%">
                            <a href="company_new.php" >Majikan Baru</a>
                        </li>
                    </ul>
            </div>';
}
function printJobs($page)
{
    $list = '';
    $baru = '';
    $kemas = '';
    $mohon = '';
    switch ($page)
    {
        case 'list': $list = ' active '; break;
        case 'baru': $baru = ' active '; break;
        case 'kemas': $kemas = ' active '; break;
        case 'mohon': $mohon = ' active '; break;
    }
    echo '<div class="col-md-12">
                    <ul class="list-inline row">
                        <li class="'.$list.' btn btn-outline-cyan" >
                            <a href="jobs.php">Senarai Tawaran</a>
                        </li>
                        <li class="'.$baru.'btn btn-outline-cyan" >
                            <a href="jobs_new.php" >Tawaran Baru</a>
                        </li>
                    </ul>
                </div>';
}