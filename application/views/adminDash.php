
<!-- Navigation -->
<?php
if ($_SESSION['logged_in']) {
    include('header.php');
}
?>

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
                            <div class="huge"><?= $subjectCount ?></div>
                            <div>Subjects</div>
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
                            <div class="huge"><?= $studentCount ?></div>
                            <div>Students</div>
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
                            <div class="huge"><?= $lecturerCount ?></div>
                            <div>Lecturers</div>
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
        <div class="col-md-12">
         <div class="col-md-4">   
        <a data-target="#lecturercsvModal" data-toggle="modal" class="btn btn-primary pull-right">Add Lecturers to Subjects</a>
        </div>
        <div class="col-md-4">  
        <a data-target="#studentCsvModal" data-toggle="modal" class="btn btn-primary pull-right">Add Student to Subjects</a>
        </div>
        <div class="col-md-4">  
        <a data-target="#subjectModal" data-toggle="modal" class="btn btn-primary pull-right">Add subject to current SP</a>
        </div>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-bar-table-o fa-fw"></i>Subject for this SP</h3>
                </div>
                <div class="panel-body">
<?php if (count($dashinfo) != 0) { ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Study Period</th>
                                        <th>Subject Name</th>
                                        <th>Lecturer's Name</th>
                                        <th>Change lecturer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                            <?php foreach ($dashinfo as $d) { ?>
                                        <tr>
                                            <td>
                                                <?php echo $d->sp; ?>
                                            </td>
                                            <td>
        <?php echo $d->sub; ?>
                                            </td>
                                            <td>

                                                <?php
                                                if (count($d->lecturer) != 0) {
                                                    echo '<ul>';
                                                    foreach ($d->lecturer as $l) {
                                                        echo '<li>' . $l->name . '</li>';
                                                    }
                                                    echo '</ul>';
                                                }
                                                ?>


                                            </td>
                                            <td><i class="glyphicon glyphicon-pencil modalShow text-center" data-id="<?= $d->id; ?>" ></i></td>
                                        </tr>
                        <?php } ?>
                                </tbody>
                            </table>
                        </div>
<?php } else { ?>
                        <b>There are no subject selected for this sp at the moment please select subject through manage subject link.</b>
<?php } ?>
                    <div class="text-right">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->


    <!-- /.row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<div class="modal fade" id="subjectModal" tabindex="-1" role="dialog" aria-labelledby="lecturerModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign Subject to Current SP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
<?php echo form_open_multipart('admin/insertSubjectDash'); ?>
                <input type="file" name="subject">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
<?php echo form_close() ?>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="lecturercsvModal" tabindex="-1" role="dialog" aria-labelledby="lecturerCsvModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign Lecturer and Subject</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
<?php echo form_open_multipart('admin/mapLecturerCsv'); ?>
                <input type="file" name="lecturer">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
<?php echo form_close() ?>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="studentCsvModal" tabindex="-1" role="dialog" aria-labelledby="studentCsvModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign Students and subjects</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
<?php echo form_open_multipart('admin/checkSubjectStudent'); ?>
                <input type="file" name="student">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
<?php echo form_close() ?>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="lecturerModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign Lecturer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label>Select Lecturer from List</label>
                <select multiple id="assign_lecturer" size="10">

<?php foreach ($allLecturer as $all): ?>
                        <option value="<?= $all->id; ?>"><?= $all->name ?></option>                      
<?php endforeach; ?>
                </select>
                <input type="hidden" id="hdn_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary saveModal">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>



</div>

</div>
<!-- /#wrapper -->


<script type="text/javascript">
    $(document).ready(function () {
        $('.modalShow').click(
                function (e) {

                    var id = $(e.target).data('id');
                    if (id != null) {
                        $.getJSON('<?php echo site_url('admin/getSubjectLecturer'); ?>', {subId: id}, function (result) {

                            $('#assign_lecturer').val(result);
                        })
                        $('#hdn_id').val(id);
                        $('#exampleModal').modal('show');

                    }
                });
        $('.saveModal').click(function () {
            var getlecturer = $('#assign_lecturer').val();
            var getid = $('#hdn_id').val();
            if (getlecturer != 0 && getid != null) {
                $.post("<?php echo site_url('admin/assignLecturer'); ?>", {id: getid, lecturer: getlecturer}).done(function (resp) {
                    if (resp) {
                        alert('Changes Saved');
                        window.location.reload();
                        $('#exampleModal').modal('hide');
                    }
                });
            }

        });
    });

</script>
<!-- Morris Charts JavaScript -->
<!--    <script src="<?php //echo base_url("assests/js/plugins/morris/raphael.min.js"); ?>"></script>
<script src="<?php //echo base_url("assests/js/plugins/morris/morris.min.js"); ?>"></script>
<script src="<?php //echo base_url("assests/js/plugins/morris/morris-data.js"); ?>"></script>
-->
</body>

</html>

/* 
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/

