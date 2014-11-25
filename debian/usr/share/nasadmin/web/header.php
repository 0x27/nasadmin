<?php

switch ($page_id) {
  case 0:
    $_title="Dashboard";
    $_icon="tachometer";
    break;

  case 1:
    $_title="System Information";
    $_icon="tasks";
    break;

  case 2:
    $_title="Messages";
    $_icon="envelope";
    break;

  case 3:
    $_title="Physical Disks";
    $_icon ="hdd-o";
    break;

  case 4:
    $_title="Software RAID";
    $_icon ="database";
    break;

  case 5:
    $_title="File Systems";
    $_icon ="folder-open";
    break;

  case 6:
    $_title="Users";
    $_icon ="user";
    break;

  case 7:
    $_title="Roles";
    $_icon ="users";
    break;

  case 8:
    $_title="Services";
    $_icon ="cubes";
    break;

  case 9:
    $_title="System Configuration";
    $_icon ="cogs";
    break;

  default:
    $_title="New Page";
    $_icon="help";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $_title; ?> | NAS Admin</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="css/plugins/timeline.css" rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">

    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">NAS Admin</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-power-off fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-pause fa-fw"></i> Standby</a></li>
                        <li><a href="#"><i class="fa fa-refresh fa-fw"></i> Reboot</a></li>
                        <li class="divider"></li>
                        <li><a href="#" data-toggle="modal" data-target="#shutdownModal"><i class="fa fa-power-off fa-fw"></i> Power Off</a></li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->

            </ul>
            <!-- /.navbar-top-links -->




<!-- START OF SIDEBAR -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>

                        <li>
                            <a <?php if ($page_id==0) echo 'class="active" '; ?>href="/"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>

                        <li>
                            <a <?php if ($page_id==1) echo 'class="active" '; ?>href="sysinfo.php"><i class="fa fa-tasks fa-fw"></i> System Information</a>
                        </li>

                        <li>
                            <a <?php if ($page_id==2) echo 'class="active" '; ?>href="messages.php"><i class="fa fa-envelope fa-fw"></i> Messages</a>
                        </li>

                        <li<?php if ($page_id>2 && $page_id<6) echo ' class="active"'; ?>>
                            <a href="#"><i class="fa fa-database fa-fw"></i> Storage<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a <?php if ($page_id==3) echo 'class="active" '; ?>href="disks.php"><i class="fa fa-hdd-o fa-fw"></i> Physical Disks</a>
                                </li>
                                <li>
                                    <a <?php if ($page_id==4) echo 'class="active" '; ?>href="raid.php"><i class="fa fa-database fa-fw"></i> Software RAID</a>
                               </li>
                                <li>
                                    <a <?php if ($page_id==5) echo 'class="active" '; ?>href="filesystems.php"><i class="fa fa-folder-open fa-fw"></i> File Systems</a>
                               </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li<?php if ($page_id==6||$page_id==7) echo ' class="active"'; ?>>
                            <a href="#"><i class="fa fa-user fa-fw"></i> Users and Roles<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a <?php if ($page_id==6) echo 'class="active" '; ?>href="users.php"><i class="fa fa-user fa-fw"></i> Users</a>
                                </li>
                                <li>
                                    <a <?php if ($page_id==7) echo 'class="active" '; ?>href="roles.php"><i class="fa fa-users fa-fw"></i> Roles</a>
                               </li>
                            </ul>
                        </li>

                        <li>
                            <a <?php if ($page_id==8) echo 'class="active" '; ?>href="services.php"><i class="fa fa-cubes fa-fw"></i> Services</a>
                        </li>
                        <li>
                            <a <?php if ($page_id==9) echo 'class="active" '; ?>href="sysconfig.php"><i class="fa fa-cogs fa-fw"></i> System Configuration</a>
                        </li>
                        <li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="fa fa-<?php echo $_icon; ?> fa-fw"></i> <?php echo $_title; ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
