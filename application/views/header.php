<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

   
        <?php 
        
        if($_SESSION['isLecturer']) {?>
     <title>E-Attendance Lecturer</title>
                
                <?php } else {?>
               <title>E-Attendance Administration</title>
                <?php }?>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url("assests/css/bootstrap.min.css");?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url("assests/css/sb-admin.css");?>" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url("assests/css/plugins/morris.css");?>" rel="stylesheet">
    <link href="<?php echo base_url("assests/font-awesome/css/font-awesome.min.css");?>" rel="stylesheet">
     <script src="<?php echo base_url("assests/js/jquery.js");?>"></script>
    <script src="<?php echo base_url("assests/js/bootstrap.js");?>"></script>
    <!-- Custom Fonts -->
  
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
`
</head>

<body>

    <div id="wrapper">

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php if($_SESSION['isLecturer']) {?>
                <a class="navbar-brand" href="index.html">E-Attendance Lecturer</a>
                <?php } else {?>
                 <a class="navbar-brand" href="index.html">E-Attendance Administration</a>
                <?php }?>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
              
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-target="#check"><i class="fa fa-user"></i><?php if($_SESSION['isLecturer']) {echo "Lecturer";}else{echo "Admin";}?> </a>
                
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                   <?php if($_SESSION['isLecturer']) {?>
                     <li class="active">
                        <a href="<?php echo site_url('admin/showLectDash');?>
                           "><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                      <li>
                            <a href="<?php echo site_url('admin/logout');?>"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                    
                    <?php }else{?>
                    
                    <li class="active">
                        <a href="<?php echo site_url('admin/showAdminDash');?>"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                     
                    <li>
                        <a href="<?php echo site_url('admin/showStudent');?>"><i class="fa fa-fw fa-bar-chart-o"></i>Manage Students</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin/showLecturer'); ?>" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-users"></i> Manage Lecturers </a>
                    </li>
                   
                    
                        <li>
                        <a href="<?php echo site_url('admin/showSubjects');?>" data-toggle="collapse" data-target="#demo2"><i class="fa fa-fw fa-book"></i>Manage Subjects</a>
                        
                    </li>
<!--                 <li>
                        <a href="<?php echo site_url('admin/showUser'); ?>" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-users"></i> Manage Users </a>
                    </li>-->
                     <li>
                            <a href="<?php echo site_url('admin/logout');?>"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                     
                    
                    <?php } ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        