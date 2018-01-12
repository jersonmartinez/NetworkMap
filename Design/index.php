<?php
    include ("php/ssh.class.php");
    $CN = new ConnectSSH();

    $R = $CN->getAllHost();
?>

<!DOCTYPE html>
<html>

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>NetowrkMap</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="css/fonts.css" rel="stylesheet" type="text/css">
    <link href="css/icons.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Por favor, espere...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="./">Network Map</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->
                    <!-- Notifications -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                            <span class="label-count">7</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFICATIONS</li>
                            <li class="body">
                                <ul class="menu">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">person_add</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>12 new members joined</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 14 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-cyan">
                                                <i class="material-icons">add_shopping_cart</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>4 sales made</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 22 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-red">
                                                <i class="material-icons">delete_forever</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Nancy Doe</b> deleted account</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 3 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-orange">
                                                <i class="material-icons">mode_edit</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Nancy</b> changed name</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 2 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-blue-grey">
                                                <i class="material-icons">comment</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>John</b> commented your post</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 4 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">cached</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>John</b> updated status</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 3 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-purple">
                                                <i class="material-icons">settings</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>Settings updated</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> Yesterday
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Notifications</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Notifications -->
                    <!-- Tasks -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">flag</i>
                            <span class="label-count">9</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">TASKS</li>
                            <li class="body">
                                <ul class="menu tasks">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Footer display issue
                                                <small>32%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-pink" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 32%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Make new buttons
                                                <small>45%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-cyan" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Create new dashboard
                                                <small>54%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-teal" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 54%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Solve transition issue
                                                <small>65%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 65%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Answer GitHub questions
                                                <small>92%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 92%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Tasks -->
                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Jerson Martínez</div>
                    <div class="email">jersonmartinez@networkmap.com</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">NAVEGACIÓN PRINCIPAL</li>
                    <li class="active">
                        <a href="./index.php">
                            <i class="material-icons">devices_other</i>
                            <span>Dispositivos</span>
                        </a>
                    </li>
                    <li>
                        <a href="./networkmap.php">
                            <i class="material-icons">device_hub</i>
                            <span>Mapa de red</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2017 - 2018 <a href="javascript:void(0);">NetworkMap</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">
                        <li data-theme="red" class="active">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                        <li data-theme="pink">
                            <div class="pink"></div>
                            <span>Pink</span>
                        </li>
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>
                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span>
                        </li>
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                            <span>Indigo</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="light-blue">
                            <div class="light-blue"></div>
                            <span>Light Blue</span>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="teal">
                            <div class="teal"></div>
                            <span>Teal</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="light-green">
                            <div class="light-green"></div>
                            <span>Light Green</span>
                        </li>
                        <li data-theme="lime">
                            <div class="lime"></div>
                            <span>Lime</span>
                        </li>
                        <li data-theme="yellow">
                            <div class="yellow"></div>
                            <span>Yellow</span>
                        </li>
                        <li data-theme="amber">
                            <div class="amber"></div>
                            <span>Amber</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="deep-orange">
                            <div class="deep-orange"></div>
                            <span>Deep Orange</span>
                        </li>
                        <li data-theme="brown">
                            <div class="brown"></div>
                            <span>Brown</span>
                        </li>
                        <li data-theme="grey">
                            <div class="grey"></div>
                            <span>Grey</span>
                        </li>
                        <li data-theme="blue-grey">
                            <div class="blue-grey"></div>
                            <span>Blue Grey</span>
                        </li>
                        <li data-theme="black">
                            <div class="black"></div>
                            <span>Black</span>
                        </li>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">
                    <div class="demo-settings">
                        <p>GENERAL SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Report Panel Usage</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Email Redirect</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Notifications</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Auto Updates</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Offline</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Location Permission</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="row clearfix">
                <!-- Task Info -->

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">

                       
                        <div class="header">
                            <i class="material-icons">devices</i> <h2 style="position: absolute; top: 23px; left: 50px;">LISTA DE DISPOSITIVOS</h2>
                            <!-- <h2>
                                EXAMPLE TAB
                                <small>Add quick, dynamic tab functionality to transition through panes of local content</small>
                            </h2> -->
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="./networkmap.php" class=" waves-effect waves-block">Mapa de red</a></li>
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" style="margin-top: -20px;" role="tablist">
                                <li role="presentation" class="active"><a href="#home" data-toggle="tab" aria-expanded="true"><i class="material-icons">devices</i> DISPOSITIVOS</a></li>
                                <li role="presentation" class=""><a href="#profile" data-toggle="tab" aria-expanded="false"><i class="material-icons">computer</i> EQUIPOS</a></li>
                                <li role="presentation" class=""><a href="#messages" data-toggle="tab" aria-expanded="false"><i class="material-icons">swap_vertical_circle</i> ENRUTADORES</a></li>
                                <li role="presentation" class=""><a href="#settings_two" data-toggle="tab" aria-expanded="false"><i class="material-icons">device_hub</i> CONMUTADORES</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="home">
                                    
                                    <?php
                                        if ($CN->getAllHost()->num_rows > 0){
                                            ?>
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover dashboard-task-infos">
                                                            <thead>
                                                                <tr>
                                                                    <th>Dirección de red</th>
                                                                    <th>IP (Terminal)</th>
                                                                    <th>Tipo</th>
                                                                    <th>Próxima red</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                    if ($R->num_rows > 0){
                                                                        while ($row = $R->fetch_array(MYSQLI_ASSOC)){
                                                                            ?>
                                                                                <tr>
                                                                                    <td><?php echo $row['ip_net']; ?></td>
                                                                                    <td><?php echo $row['ip_host']; ?></td>
                                                                                    <td>
                                                                                        <?php 
                                                                                            if ($row['router']){
                                                                                                ?>
                                                                                                    <i class="material-icons">swap_vertical_circle</i> <span class="label bg-orange"> Enrutador</span>
                                                                                                <?php
                                                                                            } else {

                                                                                                if ($CN->getMyIPServer() == $row['ip_host']){
                                                                                                    ?>
                                                                                                        <i class="material-icons">dns</i> <span class="label bg-blue"> Servidor</span>
                                                                                                    <?php
                                                                                                } else {
                                                                                                    ?>
                                                                                                        <i class="material-icons">computer</i> <span class="label bg-green"> Equipo</span>
                                                                                                    <?php
                                                                                                }

                                                                        
                                                                                            }
                                                                                        ?>
                                                                                    </td>
                                                                                    <td><?php echo $row['net_next']; ?></td>
                                                                                    <?php
                                                                                        if ($row['net_next'] != "-"){
                                                                                            ?>
                                                                                                <td>
                                                                                                    <i class="material-icons">device_hub</i>
                                                                                                </td>
                                                                                            <?php
                                                                                        } else {
                                                                                            ?>
                                                                                                <td>
                                                                                                    <div class="progress">
                                                                                                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%"></div>
                                                                                                    </div>
                                                                                                </td>
                                                                                            <?php

                                                                                        }
                                                                                    ?>
                                                                                </tr>
                                                                            <?php
                                                                        }
                                                                    }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- #END# Browser Usage -->


                                                
                                            <?php
                                        } else {
                                            ?>
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                    <div class="card">
                                                        <div class="header">
                                                            <h2>APLIQUE EL AUTODESCUBRIMIENTO (SONDEO DE RED)</h2>
                                                            <ul class="header-dropdown m-r--5">
                                                                <li class="dropdown">
                                                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="material-icons">more_vert</i>
                                                                    </a>
                                                                    <ul class="dropdown-menu pull-right">
                                                                        <li><a href="javascript:void(0);">Agregar host</a></li>
                                                                        <li><a href="./networkmap.php">Mapa de red</a></li>
                                                                        <li><a href="javascript:void(0);">Propiedades</a></li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="body">
                                                            <div class="table-responsive">
                                                                <h4>¡Te esperamos!...</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                        }
                                    ?>

                                    <b>Descripción</b>
                                    <p>Lista todos las terminales escaneadas durante el sondeo de red, obteniendo deatos de quipos o host finales como: computadoras, impresoras, teléfono, tabletas u otra terminal; además de los dispositivos físicos a nivel de red y enlace para la comunicación en el mapa de red.</p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="profile">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover dashboard-task-infos">
                                                <thead>
                                                    <tr>
                                                        <th>Dirección de red</th>
                                                        <th>IP (Terminal)</th>
                                                        <th>Enrutador</th>
                                                        <th>Próxima red</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $Machines = $CN->getHostTypeHost();
                                                        
                                                        if ($Machines->num_rows > 0){
                                                            while ($rm = $Machines->fetch_array(MYSQLI_ASSOC)){
                                                                // echo "Red: ".$rm['ip_net']." | IP Host: ".$rm['ip_host']."<br/>";
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo $rm['ip_net']; ?></td>
                                                                        <td><?php echo $rm['ip_host']; ?></td>
                                                                        <td>
                                                                            <?php 
                                                                                if ($rm['router']){
                                                                                    ?>
                                                                                        <span class="label bg-green">SÍ</span>
                                                                                    <?php
                                                                                } else {
                                                                                    ?>
                                                                                        <span class="label bg-red">NO</span>
                                                                                    <?php
                                                                                }
                                                                            ?>
                                                                        </td>
                                                                        <td><?php echo $rm['net_next']; ?></td>
                                                                        <?php
                                                                            if ($rm['net_next'] != "-"){
                                                                                ?>
                                                                                    <td>
                                                                                        <div class="progress">
                                                                                            <div class="progress-bar bg-green" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%"></div>
                                                                                        </div>
                                                                                    </td>
                                                                                <?php
                                                                            }
                                                                        ?>
                                                                    </tr>
                                                                <?php
                                                            }
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <b>Descripción</b>
                                    <p>Los equipos o host finales como: computadoras, impresoras, teléfono, tabletas u otra terminal.</p>
                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="messages">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover dashboard-task-infos">
                                                <thead>
                                                    <tr>
                                                        <th>Dirección de red</th>
                                                        <th>IP (Terminal)</th>
                                                        <th>Enrutador</th>
                                                        <th>Próxima red</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $Routers = $CN->getHostTypeRouter();

                                                        if ($Routers->num_rows > 0){
                                                            while ($r = $Routers->fetch_array(MYSQLI_ASSOC)){
                                                                
                                                                // echo "Red: ".$r['ip_net']." | Next: ".$r['net_next']." siga: ".implode("", explode(".", implode("", explode("/", $r['net_next']))))."<br/>";
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo $r['ip_net']; ?></td>
                                                                        <td><?php echo $r['ip_host']; ?></td>
                                                                        <td>
                                                                            <?php 
                                                                                if ($r['router']){
                                                                                    ?>
                                                                                        <span class="label bg-green">SÍ</span>
                                                                                    <?php
                                                                                } else {
                                                                                    ?>
                                                                                        <span class="label bg-red">NO</span>
                                                                                    <?php
                                                                                }
                                                                            ?>
                                                                        </td>
                                                                        <td><?php echo $r['net_next']; ?></td>
                                                                        <?php
                                                                            if ($r['net_next'] != "-"){
                                                                                ?>
                                                                                    <td>
                                                                                        <div class="progress">
                                                                                            <div class="progress-bar bg-green" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%"></div>
                                                                                        </div>
                                                                                    </td>
                                                                                <?php
                                                                            }
                                                                        ?>
                                                                    </tr>
                                                                <?php
                                                            }
                                                        }

                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <b>Descripción</b>
                                    <p>
                                       Se listan todos los enrutadores (routers) encontrados durante el sondeo de red.
                                    </p>
                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="settings_two">

                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover dashboard-task-infos">
                                                <thead>
                                                    <tr>
                                                        <th>Dirección de red</th>
                                                        <!-- <th>IP (Terminal)</th>
                                                        <th>Enrutador</th>
                                                        <th>Próxima red</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                        $ReturnIPNets = $CN->getIPNet();

                                                        if ($ReturnIPNets->num_rows > 0){
                                                            while ($RIP = $ReturnIPNets->fetch_array(MYSQLI_ASSOC)){

                                                                $Switches = $CN->getHostTypeSwitch($RIP['ip_net']);

                                                                if ($Switches->num_rows >= 2){
                                                                    // echo "Red: ".$RIP['ip_net']."<br/>";

                                                                    ?>
                                                                        <tr>
                                                                            <td><?php echo $RIP['ip_net']; ?></td>
                                                                            <td>
                                                                                <div class="progress">
                                                                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%"></div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php

                                                                }
                                                                
                                                            }
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <b>Descripción</b>
                                    <p>
                                       Se listan todos los conmutadores (switches) encontrados durante el sondeo de red.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Morris Plugin Js -->
    <script src="plugins/raphael/raphael.min.js"></script>
    <script src="plugins/morrisjs/morris.js"></script>

    <!-- ChartJs -->
    <script src="plugins/chartjs/Chart.bundle.js"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="plugins/flot-charts/jquery.flot.js"></script>
    <script src="plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="plugins/flot-charts/jquery.flot.time.js"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="plugins/jquery-sparkline/jquery.sparkline.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/index.js"></script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>
</body>
</html>