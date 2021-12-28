<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>JLE MARKETING PRIVATE LIMITED</title>

    <link rel="stylesheet" href="asset/vendors/feather/feather.css">
    <link rel="stylesheet" href="asset/vendors/ti-icons/css/themify-icons.css">

    <link rel="stylesheet" href="asset/css/vertical-layout-light/style.css">

    <link rel="shortcut icon" href="asset/image/logo/jle.svg"/>

    <link rel="stylesheet" href="asset/css/admin.css"/>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>


<body>
<div class="container-scroller">

    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo mr-5" href="home"><img src="asset/image/logo/jle.svg" width="50px"
                                                                         class="mr-2" alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini" href="home"><img src="asset/image/logo/jle.svg" width="50px"
                                                                         alt="logo"/></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">

            <ul class="navbar-nav mr-lg-2">
                <li class="nav-item nav-search d-none d-lg-block">
                    <div class="input-group">
                        <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <i class="icon-search"></i>
                </span>
                        </div>
                        <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now"
                               aria-label="search" aria-describedby="search">
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" id="profileDropdown">
                        <img src="asset/image/icon/profile.png" alt="profile"/>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="profile">
                            <i class="ti-settings text-primary"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="logout">
                            <i class="ti-power-off text-primary"></i>
                            Logout
                        </a>
                        
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                <span class="icon-menu"></span>
            </button>
        </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">


        <?php

        $MHome = null;
        $MPMF= null;

        if (!isset($page))
        {
            $page = null;
        }

        switch ($page) {
            case "Home":
                $MHome = 'active';
                break;
            case "PMF":
                $MPMF = 'active' ;
                break;
            case "green":
                echo "Your favorite color is green!";
                break;
            default:
                echo "";
        }

        ?>

        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item <?php echo $MHome ;?>">
                    <a class="nav-link" href="home">
                        <i class="icon-grid menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item <?php echo $MPMF ;?>">
                    <a class="nav-link" href="psc">
                        <i class="icon-layout menu-icon"></i>
                        <span class="menu-title">PCS</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false"
                       aria-controls="form-elements">
                        <i class="icon-columns menu-icon"></i>
                        <span class="menu-title">Help</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="form-elements">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="GiveHelp">Give Help</a></li>
                            <li class="nav-item"><a class="nav-link" href="rhelp">Receive Help</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Open Help</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Transaction History</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="myConnects">
                        <i class="icon-bar-graph menu-icon"></i>
                        <span class="menu-title">My Referees</span>
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="receipt">
                        <i class="icon-grid-2 menu-icon"></i>
                        <span class="menu-title">Payment Receipt</span>
                    </a>
                </li>
            </ul>
        </nav>