<?php
include_once("sessionStart.php"); 

require_once('../classes/class.form_master.php');

$availableFormTeacher = new ClassFormMaster();
?>
<?php  include_once('metadatda.php'); ?>

  <title>Class Teacher</title>

  <?php  include_once('links.php'); ?>
  <!-- Custom styles for this template-->
  
</head>
<?php include_once('navBar.php'); ?>

<body>

<?php
/*
$variable="theo";
$encode= BASE64_ENCODE($variable);
$decode= BASE64_DECODE($encode);
echo $encode."==decoded valew==".$decode;
*/
?>

   <div class="container" style="width:700px;">  
               <div class="col-lg-10" align="center"><?php
include_once('../msg/messages.php');
?></div><div class="clearfix"></div>
<div class="btn btn-reddit btn-block"> <strong>Availabe Class Teachers</strong> </div>
                     
                        <strong><hr></strong> 
                <div class="table-responsive" >  
                     
                     <br />  
                   <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th>#</th>
                      <th>Teacher</th>
                      <th>Class</th>
                      <th>Date Asign</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                 
                  <?php
				  $sn=1;
				   if(!empty($availableFormTeacher->viewAllClassMaster())){
				  foreach($availableFormTeacher->viewAllClassMaster() as $key => $val){
					  $availableFormTeacher->formaster_code = $val['formaster_code'];
					  $availableFormTeacher->viewClassMasterByID();
				  ?>
                   
                      <th><?php echo $sn++ ?></th>
                                         <th><?php echo $availableFormTeacher->formaster_staffid; ?></th>
                      <th><?php echo $availableFormTeacher->formaster_class_code . $availableFormTeacher->formaster_class_arm;?></th>
   					 <th><?php echo $availableFormTeacher->date_from; ?></th>
                     <td><button title="Edit" class="btn-success" data-toggle="modal" type="button" data-target="#update_modal<?php echo $val['formaster_code']?>"><span class=" fa fa-pencil"></span></button></td> </tr>
  <div class="modal fade" id="update_modal<?php echo $val['formaster_code']?>" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
<form method="POST" action="../Control_classes/formmaster_controller.php?action=Change_formmaster">
				<div class="modal-header">
                <div class="btn btn-reddit btn-block"> <strong>Edit Class Teacher</strong> </div>
                     
                        <strong><hr></strong> 
					
				</div>
				<div class="modal-body">
					
					  <div class="row form-group">
                            <div class="col-3 col-md-3"><label>Current Form Master </label></div>
							
                            <div class="col-3 col-md-8">
 <input type="text"  class="form-control" value="<?php echo $availableFormTeacher->formaster_staffid;?>" readonly="readonly"/></div>
     
    
	 </div>
							  <div class="row form-group">
                            <div class="col-3 col-md-3"><label>Staff List </label>
							<input type="hidden" name="formaster_code" value="<?php echo $val['formaster_code']?>"/></div>
                             
                            <div class="col-3 col-md-8">
  <select name="staff_id" onselect="this.className" class="form-control">
     
      <?php
	  
	  foreach($availableFormTeacher->viewActiveStaff() as $key => $vals){ 
	  ?>
     <option value="<?php echo $vals['staff_id'] ?>"><?php echo $vals['staff_last_name']. "   ".$vals['staff_first_name'] ?></option>
    
     <?php
	 
	  } ?>
     </select>
						</div>
						
				</div>
                
                  <div class="row form-group">
                            <div class="col-3 col-md-3"><label>Class </label></div>
							
                             
                            <div class="col-3 col-md-8">
 <input type="text"  class="form-control" value="<?php echo $availableFormTeacher->formaster_class_code . $availableFormTeacher->formaster_class_arm;?>" readonly="readonly"/></div>
     
    
	 
						</div>
						
				</div>
				 <div class="row form-group">
				<div class="modal-footer" align="center">
					<button name="update" type="submit" class="btn btn-primary"> Submit</button>
					<button class="btn btn-danger" type="button" data-dismiss="modal"> Close</button>
                    </div></div>
                    </form>
				</div></div></div>
                    <?php  }} ?>
                  </tbody>
                </table>
              </div>
                </div>  
          
     
 <div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title"></h4>  
                </div>  
                <div class="modal-body" id="employee_detail">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  
 <div id="add_data_Modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <div class="btn btn-reddit btn-block"> <strong>Add New Term</strong> </div>
                     
                        <strong><hr></strong> 
                    
                </div>  
                <div class="modal-body">  
                     <div class="card-body card-block">
                        <form action="../Control_classes/term_controller.php?action=createtermfrommodal" method="post" enctype="multipart/form-data" class="form-horizontal" name="postForm" onSubmit="return ValidatePost(); ">
                           
                            
                           
 
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Term Name</label></div>
                            <div class="col-3 col-md-9"><input type="text" id="term_name" name="term_name" placeholder="E.g First Term" class="form-control"  onKeyUp="this.value=this.value.toUpperCase();" required></div>
                          </div>
                          <div class="row form-group">
                           <div class="col-6 col-md-9" align="center">
                           <!--<i class="fa fa-circle-o-notch fa-spin"></i>-->
                           <i class="fa fa-refresh fa-spin"></i><input type="submit" id="sub" name="post" value="Save" class="btn btn-success">  <input type="reset" name="reset" value="RESET" class="btn btn-danger"></div>
                          </div>
                        </form>
                      </div>
                     
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  
      
      </div>  
 </div>  
 </body>
     <?php include_once('footer.php'); ?>
 <?php include_once('footerTableScript.php'); ?>
 </html>
