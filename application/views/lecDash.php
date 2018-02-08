
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
                            <h2 class="animation-hatch"><strong><?php echo count($students)?></strong><br>
                                <small><i class="fa fa-book"></i> <a href="/class/list">Students</a></small>
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
                            <i class="fa fa-info-circle"></i>  <strong>Current Study Period</strong> <?php echo $sp ?></a>
                        <span class="pull-right">
                               <?php echo $this->session->userdata('username') ?>  <i class="pull-right fa fa-user"></i></span>
                        </div>
                        
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-md-12">
                        Study Week:
                        <select id="weekSelect">
                            <option  selected="selected" value="0" >Select Week</option>
                            <option value="1">Week 1</option>
                            <option value="2">Week 2</option>
                            <option value="3">Week 3</option>
                            <option value="4">Week 4</option>  
                            <option value="5">Week 5</option>
                            <option value="6">Week 6</option>
                            <option value="7">Week 7</option>
                            <option value="8">Week 8</option>  
                            <option value="9">Week 9</option>
                            <option value="10">Week 10</option>
                        </select>
                    </div>
                     <div class="col-lg-12">
                        <div class="panel panel-default">
                           
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-table-o fa-fw"></i>Students for this Subject</h3>
                            </div>
                            <div class="panel-body">
                                <?php  if (count($students) != 0){ ?>
                                 <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Student Id</th>
                                                <th>Student First Name</th>
                                                <th>Student Last Name</th>
                                                <th>Present</th>
                                                <!--<th>Note</th>-->
                                            </tr>
                                        </thead>
                                        <tbody>

                                                <?php foreach ($students as $d) { ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $d->id; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $d->fname; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $d->lname; ?>
                                                        </td>
                                                        <td><input type="checkbox" class="doattendance" id="chk_<?= $d->id; ?>" data-id="<?= $d->id; ?>" style="display:none;"></td>
                                                        <!--<td><i class="glyphicon glyphicon-pencil modelNote" data-id="<?= $d->id; ?>" ></i></td>-->
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                    </table>
                                </div>
                                <?php }else{?>
                                <b>There are no students selected for this subject at the moment .</b>
                                <?php }?>
                                <div class="text-right">
                                 
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
                <label>Comment</label>
                <textarea rows="5" id="comment"></textarea>
                <input type="hidden" id="hdn_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary saveModal">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
  <script type="text/javascript">
        $(document).ready(function(){
    $('.modelNote').click(
        function(e){
           
            var id=$(e.target).data('id');
            if(id!==null){
                $('#hdn_id').val(id);
                $('#exampleModal').modal();
            }
        });
     $('#weekSelect').change(function(){
         
         var value=$('#weekSelect :selected').val();
         if(value!=0){
             $('.doattendance').prop('checked',false);
             $.getJSON('<?php echo site_url('admin/getAttendance'); ?>',{week_no:value},function(result){
                 $.each( result, function( index,value ){
                     if(value.attendance){
                         $('#chk_'+value.student_id).prop('checked',true);
                     }
                  });
             
             $('.doattendance').show();
             });
         }
         else{
              $('.doattendance').hide();
         }
         
     });
    $('.doattendance').click(function(e){
            var week=$('#weekSelect :selected').val();
            var getid=$(e.target).data('id');
            if(week!==0 && getid!==null){
                
            
            $.post("<?php echo site_url('admin/doAttendance');?>",{studentId:getid,week_no:week}).done(function(resp){
                
               
            });
        
        }
           
    });
    });
    
    </script>
</body>

</html>

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

