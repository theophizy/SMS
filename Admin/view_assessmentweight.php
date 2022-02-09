<?php
include_once("sessionStart.php"); 

require_once('../classes/class.Grades.php');
$grade = new Grade() ;
?>

<?php  include_once('metadatda.php'); ?>

  <title>View Assessment </title>

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
                <div class="table-responsive" > 
                <div class="btn btn-reddit btn-block"> <strong>Availabe Assessments</strong> </div>
                <strong><hr /> </strong>
                     <div align="right">  
                        <!--  <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Add new Grade</button>  -->
                     </div>  
                     <br />  
                   <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th>#</th>
                      <th>Exam Name</th>
                      <th>Exam Weight</th>
                       <th>Exam Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                 
                  <?php
				  $sn=1;
				  if(!empty($grade->viewAllExamType())){
				  foreach($grade->viewAllExamType() as $key => $val){
				  ?>	

                   
                      <th><?php echo $sn++ ?></th>
                      <th><?php echo $val['exam_name'] ?></th>
                      <th><?php echo $val['exam_marks'] ?></th>
                      <th><?php echo $val['exam_status'] ?></th>
                      
                  
                     <td><button title="Edit" class="btn-success" data-toggle="modal" type="button" data-target="#update_modal<?php echo $val['exam_code']?>"><span class=" fa fa-pencil"></span></button></td> </tr>
  <div class="modal fade" id="update_modal<?php echo $val['exam_code']?>" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
<form method="POST" action="../Control_classes/grade_controller.php?action=Edit_exam_type">
				<div class="modal-header">
                 <div class="btn btn-reddit btn-block"> <strong>Edit Assessments</strong> </div>
					<h3><strong><hr /></strong></h3>
				</div>
	<div class="modal-body">
					
					<div class="col-md-11">
						<div class="form-group">
							<input type="hidden" name="exam_code" value="<?php echo $val['exam_code']?>"/><label>Exam Name</label>
							<input type="text" name="exam_name" value="<?php echo $val['exam_name']?>" class="form-control" required="required"  /></div>
                            <div class="form-group">
                            <label>Exam Weight(Maximum Marks)</label>
  <input type="number" name="exam_marks" value="<?php echo $val['exam_marks']?>" class="form-control" required="required"  onKeyPress="return isNumber(event)"/>
  </div>
 
			
						</div>
				
				<div class="modal-footer">
					<button name="update" type="submit" class="btn btn-primary"></span> Update</button>
					<button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                    </div> 
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
                     <h4 class="modal-title">Add New Grade</h4>  
                </div>  
                <div class="modal-body">  
                     <div class="card-body card-block">
                        
                           
                            
                         <form action="../Control_classes/grade_controller.php?action=creategradefrommodal" method="post" enctype="multipart/form-data" class="form-horizontal" name="postForm" onSubmit="return ValidatePost();">
                           
                            
                           <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label"> Minimun Mark</label></div>
                            <div class="col-3 col-md-4"><input type="number" id="grade_min_mark" name="grade_min_mark" placeholder="E.g 0" class="form-control"  onKeyUp="this.value=this.value.toUpperCase();" onKeyPress="return isNumber(event)" required></div>
                          </div>
 
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Maximun Mark</label></div>
                            <div class="col-3 col-md-4"><input type="number" id="grade_max_mark" name="grade_max_mark" placeholder="E.g 40 " class="form-control"  onKeyUp="this.value=this.value.toUpperCase();" onKeyPress="return isNumber(event)" required></div>
                          </div>
                          
      <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Grade Description</label></div>
                            <div class="col-3 col-md-4"><input type="text" id="grade_name" name="grade_name" placeholder="E.g F" class="form-control"  onKeyUp="this.value=this.value.toUpperCase();" required></div>
                          </div>
 
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Grade Remark eg excellent</label></div>
                            <div class="col-3 col-md-4"><input type="text" id="grade_remark" name="grade_remark" placeholder="E.g FAIL" class="form-control"  onKeyUp="this.value=this.value.toUpperCase();" required></div>
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
