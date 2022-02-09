<?php include_once("sessionStart.php"); ?>

<?php

require_once('../classes/class.school_setup.php');

$schoolsetup = new SchoolSetup();
?>

<?php  include_once('metadatda.php'); ?>
  <title>Manage Class Teacher's Remark</title>
  <!-- Tell ethe browser to be responsive to screen width -->
  
 <?php  include_once('links.php'); ?>

  <!-- Custom styles for this template-->
  <script type="text/javascript">

		  function isNumber(evt){
			  evt = (evt) ? evt : window.event;
		 var charCode=(evt.which)? evt.which : evt.keyCode;
		 if(charCode > 31 && (charCode < 46 || charCode >57))
		 return false;
		 else
		 return true;
		
		 }

</script>

</head>
<?php include_once('navBar.php'); ?>

<body>
 <div class="container" style="width:700px;">  
 <div class="col-lg-10" align="center"><?php
include_once('../msg/messages.php');
?></div><div class="clearfix"></div>
 <div class="col-lg-12">
 
                    <div class="card">
                     <div class="btn btn-reddit btn-block"> <strong>Manage Formater's Result Remarks</strong> </div>
 <strong><hr /></strong>
                                          
      
   <?php
  
  		 
	if(!empty($schoolsetup->view_form_MastersRemarkByTermandSession())){
	
   ?>
               
                <div class="table-responsive" >  
                     <div align="right">  
                       
                     </div>  
                     <br />  
                   <div class="box">
            <div class="box-header">
         
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th>#</th>
                      <th>Min Marks</th>
                      <th>Max Marks</th>
                      <th>Remarks</th>
                     
                      <th>Action</th>
                    </tr>
                  </thead>
                 
                  <?php
				  $sn = 1;
				
				  foreach($schoolsetup->view_form_MastersRemarkByTermandSession() as $key => $val){
					 
				  ?>	

                   
                      <th><?php echo $sn++ ?></th>
                      <th><?php echo $val['remark_min_mark'] ?></th>
                      <th><?php echo $val['remark_max_mark'] ?></th>
                      <th><?php echo $val['remark'] ?></th>
                      
                     <td><button title="Edit" class="btn-success" data-toggle="modal" type="button" data-target="#update_modal<?php echo $val['remark_code']?>"><span class=" fa fa-pencil"></span></button></td> </tr>
  <div class="modal fade" id="update_modal<?php echo $val['remark_code']?>" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
<form method="POST" action="../Control_classes/schoolsetup_controller.php?action=Edit_remark">
				<div class="modal-header">
                 <div class="btn btn-reddit btn-block"> <strong>Edit Remarks</strong> </div>
 <strong><hr /></strong>
					
				</div>
	<div class="modal-body">
					
					
						<div class=" row form-group">
							<input type="hidden" name="remark_code" value="<?php echo $val['remark_code']?>"/>
                            <div class="col col-md-3"><label>Minimum Mark</label></div>
                            <div class="col col-md-9">
							<input type="number" name="remark_min_mark" value="<?php echo $val['remark_min_mark']?>" class="form-control" required="required"  onKeyPress="return isNumber(event)"/></div></div>
                            <div class=" row form-group">
                           <div class="col col-md-3"> <label>Maximun Mark</label></div>
                           <div class="col col-md-9">
  <input type="number" name="remark_max_mark" value="<?php echo $val['remark_max_mark']?>" class="form-control" required="required"  onKeyPress="return isNumber(event)"/>
  </div></div>
 <div class="row form-group">
 
 <div class="col col-md-3"><label>Remark</label></div>
 <div class="col col-md-9">  <textarea  name="remark"  class="form-control" required="required" ><?php echo $val['remark']?></textarea></div>
   </div>

				
				<div class="modal-footer">
					<button name="update" type="submit" class="btn btn-primary"></span> Update</button>
					<button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                    </div> </div>
                    </form>
				</div></div></div>
                    <?php  }}else{ echo "No Records for the selected term and session";} ?>
                  </tbody>
                </table>
              </div>
                </div>  
          
     
 
 </div>  
      
      </div>  
 </div>  
 
    <?php include_once('footer.php'); ?>
 <?php include_once('footerTableScript.php'); ?> 
 </body>
 
 </html>
