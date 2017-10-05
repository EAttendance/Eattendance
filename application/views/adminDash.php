
        <!-- Navigation -->
        <?php if($_SESSION['logged_in']){
            include('header.php');
        } ?>

        <div id="page-wrapper">

           

                <!-- Page Heading -->
                <div class="content-header content-header-media" style= "height: 130px;">
                 <div class="header-section">
            <div class="row">
                    <div class="col-md-4 col-lg-6 hidden-xs hidden-sm">
                            <h1> Welcome to E-Attendance <br>
                        </h1>
                        </div>

                        <div class="col-md-9 col-lg-6">
                    <div class="row text-center">
                        <div class="col-xs-3 col-sm-4">
                            <h2 class="animation-hatch"><strong>54</strong><br>
                                <small><i class="fa fa-book"></i> <a href="/class/list">Subjects</a></small>
                            </h2>
                        </div> 
                                                                 <!-- We hide the last stat to fit the other 3 on small devices -->
                                            </div>
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
                            <a href="#">
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
                            <a href="#">
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
                            <a href="#">
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

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-table-o fa-fw"></i> Details</h3>
                            </div>
                            <div class="panel-body">
                                 <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Study Period</th>
                                                <th>Subject</th>
                                                <th>Students Enrolled</th>
                                                <th>Lecturer</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>SP22-2017</td>
                                                <td>ICT Project 1</td>
                                                <td>8</td>
                                                <td>Laura Antochi</td>
                                            </tr>
                                            <tr>
                                                <td>SP22-2017</td>
                                                <td>HCI</td>
                                                <td>24</td>
                                                <td>Laura Antochi</td>
                                            </tr>
                                            <tr>
                                                <td>SP22-2017</td>
                                                <td>Mobile Programming</td>
                                                <td>25</td>
                                                <td>Cue Nguyen</td>
                                            </tr>
                                            <tr>
                                                <td>SP22-2017</td>
                                                <td>Data Analysis</td>
                                                <td>17</td>
                                                <td>Paul Darwin</td>
                                            </tr>
                                            <tr>
                                                <td>SP23-2017</td>
                                                <td>ICT Project 2</td>
                                                <td>8</td>
                                                <td>Laura Antochi</td>
                                            </tr>
                                            <tr>
                                                <td>SP23-2017</td>
                                                <td>Database</td>
                                                <td>10</td>
                                                <td>Cue Nguyen</td>
                                            </tr>
                                            <tr>
                                                <td>SP23-2017</td>
                                                <td>E-Security</td>
                                                <td>13</td>
                                                <td>Paul Darwin</td>
                                            </tr>
                                            <tr>
                                                <td>SP21-2017</td>
                                                <td>E-Business</td>
                                                <td>15</td>
                                                <td>Cue Nguyen</td>
                                            </tr>
                                            <tr>
                                                <td>SP21-2017</td>
                                                <td>HCI</td>
                                                <td>22</td>
                                                <td>Paul Darwin</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <a href="#">View All Subjects <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i> Attendance Report</h3>
                            </div>
                            <div class="panel-body">
                                <div id="morris-area-chart"></div>
                                <div class="text-right">
                                    <a href="#">View Full Report <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Tasks Panel</h3>
                            </div>
                            <div class="panel-body">
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <span class="badge">just now</span>
                                        <i class="fa fa-fw fa-calendar"></i> Calendar updated
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">4 minutes ago</span>
                                        <i class="fa fa-fw fa-comment"></i> Commented on a post
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">1 hour ago</span>
                                        <i class="fa fa-fw fa-user"></i> A new Lecturer has been added
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">2 hours ago</span>
                                        <i class="fa fa-fw fa-check"></i> Completed task: "Updating student details"
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">yesterday</span>
                                        <i class="fa fa-fw fa-globe"></i> Synced data
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">two days ago</span>
                                        <i class="fa fa-fw fa-check"></i> Completed task: "fix error on login page"
                                    </a>
                                </div>
                                <div class="text-right">
                                    <a href="#">View All Activity <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
                <!-- /.row -->

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

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

