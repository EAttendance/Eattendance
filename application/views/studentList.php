 <?php if($_SESSION['logged_in']){
            include('header.php');
        } ?>

<div id="page-wrapper">

           

                <!-- Page Heading -->
                <div class="content-header content-header-media" style= "height: 130px;">
                 <div class="header-section">
            <div class="row">
                    <div class="col-md-12 col-lg-12 hidden-xs hidden-sm">
                            <h1> Welcome to E-Attendance <br>
                        </h1>
                        </div>

                        <div class="col-md-9 col-lg-6">
                   
                </div>
                    </div>
                </div>
                </div>
                
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>Current Study Period</strong><a href="http://startbootstrap.com/template-overviews/sb-admin-2" class="alert-link"> <?php echo $sp ?></a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
<!--                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-pencil-square fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">26</div>
                                        <div>Check Attendance</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>-->
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">12</div>
                                        <div>Manage Subjects</div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo site_url('admin/showSubjects'); ?>">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">124</div>
                                        <div>Manage Students</div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo site_url('admin/showStudent'); ?>">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-check-square fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">3</div>
                                        <div>Manage Lecturers</div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo site_url('admin/showLecturer'); ?>">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

             <div class="content-header content-header-media" style="height: 130px;">
                 <div class="header-section">
            <div class="row">
                    <div class="col-md-12 col-lg-12 hidden-xs hidden-sm text-center">
                            <h1> Students List<br>
                        </h1>
                        </div>

                        
                    </div>
                </div>
                </div>
                
                <!-- /.row -->

                <!-- /.row -->

                
                <!-- /.row -->
               
                <div class="row">
                    <div class="col-lg-12">
                        <a href="<?php echo site_url('admin/showUploadStudent'); ?>" class="btn btn-primary pull-right">Add Student</a>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-table-o fa-fw"></i> Student List</h3>
                            </div>
                            <div class="panel-body">
                                 <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Subject Id</th>
                                                <th>Family Name</th>
                                                <th>Given Name</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                   <?php if (count($students) != 0) {
                    foreach ($students as $s) {
                        ?>
                       <tr id="item_<?= $s->id?>"> 

                            <td><?php echo $s->id; ?></td>
                            <td><?php echo $s->lname; ?></td>
                            <td><?php echo $s->fname; ?></td> 					 				 
                            
                          
                           
                        </tr>
                        <?php
                    }
                } else {
                    echo '<tr><td colspan="10"> No Result Found.</td> </tr>';
                }
                ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <a href="#">View All Subjects <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>

       

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?php echo base_url("assests/js/jquery.js");?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url("assests/js/jquery.js");?>"></script>

    <!-- Morris Charts JavaScript -->
<!--    <script src="<?php //echo base_url("assests/js/plugins/morris/raphael.min.js");?>"></script>
    <script src="<?php //echo base_url("assests/js/plugins/morris/morris.min.js");?>"></script>
    <script src="<?php //echo base_url("assests/js/plugins/morris/morris-data.js");?>"></script>
   -->
</body>

</html>
