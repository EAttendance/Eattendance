 <?php if($_SESSION['logged_in']){
            include('header.php');
         ?>

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
                            <i class="fa fa-info-circle"></i>  <strong>Current Study Period</strong> <?php echo $this->session->userdata('sp'); ?></a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                

             <div class="content-header content-header-media" style="height: 130px;">
                 <div class="header-section">
            <div class="row">
                    <div class="col-md-12 col-lg-12 hidden-xs hidden-sm text-center">
                            <h1> Subject List<br>
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
                           <a href="<?php echo site_url('admin/showUploadSubject'); ?>" class="btn btn-primary pull-right">Add Subjects</a>
                        
                           <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-table-o fa-fw"></i> Subject List</h3>
                            </div>
                            <div class="panel-body">
                                 <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Subject code</th>
                                                <th>Subject Name</th>
                                                <th>Add To Current SP</th>
                                                <th></th>
                                                <th></th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                   <?php if (count($sub) != 0) {
   
     
                    foreach ($sub as $s) {
                        ?>
                       <tr id="item_<?= $s->id?>"> 

                            <td><?php echo $s->id; ?></td>
                            <td><?php echo $s->subject_name; ?></td> 	
                            <?php if($s->check){ ?>
                            <td><input type="checkbox" class="addtoSP" id="chk_<?= $s->id ?>" data-id="<?= $s->id ?>" checked="checked"></td>
                    <?php } else{?>
                            <td><input type="checkbox" class="addtoSP" id="chk_<?= $s->id ?>" data-id="<?= $s->id ?>" ></td>
                    <?php }?>
                            <td></td>
                            <td></td>
                           
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
    
<script type="text/javascript">
   
    $('.addtoSP').click(function(e){
        var subCode=$(e.target).data('id');
        if($('#chk_'+subCode).is(':checked')){
       
        $.post("<?php echo site_url('admin/addSubToSp');?>",{subCode:subCode},function(resp){
          
                alert('Subject Added');
            });
    }
    else{
        
        $.post("<?php echo site_url('admin/deleteSubSP');?>",{subCode:subCode},function(resp){
               alert('Subject Deleted');
            
        });
    }
    });

</script>

    <!-- Morris Charts JavaScript -->
<!--    <script src="<?php //echo base_url("assests/js/plugins/morris/raphael.min.js");?>"></script>
    <script src="<?php //echo base_url("assests/js/plugins/morris/morris.min.js");?>"></script>
    <script src="<?php //echo base_url("assests/js/plugins/morris/morris-data.js");?>"></script>
   -->
</body>

</html>
<?php } else{ redirect(site_url('admin/index'));}?>