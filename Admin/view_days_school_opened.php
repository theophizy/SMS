<?php
include_once("sessionStart.php"); 

require_once('../classes/class.school_setup.php');
require_once('../classes/class.term.php');
include_once('../classes/class.Session.php');

$schoolsetup = new SchoolSetup();
$availableSession = new Session_class();
$term = new Term();

?>

<?php  include_once('metadatda.php'); ?>

  <title>Days School Was Opened</title>

  <?php  include_once('links.php'); ?>  <!-- Custom styles for this template-->
  
</head>
<?php include_once('navBar.php'); ?>

<body>
 <div class="container" style="width:700px;">  
               <div class="col-lg-10" align="center"><?php
include_once('../msg/messages.php');
?></div><div class="clearfix"></div>

 <div class="card">
   <div class="btn btn-reddit btn-block"><strong>Available Number of Days Schooled was Opened</strong></div> <hr>
                     
    
 
      
   <?php
  
   
		
		if(!empty($schoolsetup->viewAllDaysSchoolOpened())){
		
		
	//get Term  description using its id
		

	//$position_in_class = $createscore->position_in_class($login);
	
	
	//get total number of students who sat for exams in a term, session, class and class arm
	
   ?>
                <div class="table-responsive" >  
                     <div align="right">  
                         <!--    <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Add new subject</button>  __
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
                     
                      <th>Term</th>
                      <th>Session</th>
                      <th>Number of Days School opened</th>
                       
                    
                      <th>Action</th>
                    </tr>
                  </thead>
                 
                  <?php
				  $sn=1;
				  if(!empty($schoolsetup->viewAllDaysSchoolOpened())){
				  foreach($schoolsetup->viewAllDaysSchoolOpened() as $key => $val){
					  $schoolsetup->schoolopen_id = $val['schoolopen_id'];
					  $schoolsetup->viewSchoolOpenedbyID(); 
					 
					 
					  $term->term_code = $schoolsetup->cog_student_term;
					  $term->viewTermByID();
					  $availableSession->session_code = $schoolsetup->cog_student_session;					  $availableSession->viewSessionByID();
				  ?>
                   
                      <th><?php echo $sn++ ?></th>
                     
                      <th><?php echo $term->term_name ?></th>
                      <th><?php echo $availableSession->session_description ?></th>
                      <th><?php echo $schoolsetup->days_school_opened ?></th>
                    
                     <th><button title="Edit" class="btn btn-success" data-toggle="modal" type="button" data-target="#update_modal<?php echo$schoolsetup->schoolopen_id?>"><span class=" fa fa-pencil"></span></button>
                  
                     </th> </tr>
  <div class="modal fade" id="update_modal<?php echo $schoolsetup->schoolopen_id?>" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
<form method="POST" action="../Control_classes/schoolsetup_controller.php?action=updatedaysschoolopened">
				<div class="modal-header">
					<div class="btn btn-reddit btn-block"> <strong>Edit  Info</strong> </div>
                     
                        <strong><hr></strong>
				</div>
				<div class="modal-body">
					
					
						<div class="row form-group">
                       <div class="col-md-6">
							<label>Number of days school opened</label>
							<input type="hidden" name="schoolopened_id" value="<?php echo $schoolsetup->schoolopen_id?>"/></div><div class="col-md-4">
							<input type="number" name="days" value="<?php echo $schoolsetup->days_school_opened?>" class="form-control" required="required" />
                          
						</div></div>
                        
                       <div class="row form-group">
                       <div class="col-md-6">
							<label>Term</label>
							</div>
                            <div class="col-md-6">
							<input type="text"  value="<?php echo $term->term_name?>" class="form-control"  readonly="readonly" />
                          
						</div>
						
				</div>
                 <div class="row form-group">
                       <div class="col-md-6">
							<label>Session</label>
							</div>
                            <div class="col-md-6">
							<input type="text"  value="<?php echo $availableSession->session_description ?>" class="form-control"  readonly="readonly" />
                          
						</div>
						
				</div>
				 <div class="row form-group">
                       <div class="col-md-4"></div>
				<div class="modal-footer">
					<button name="update" type="submit" class="btn btn-primary"></span> Update</button>
					<button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                    </div></div>
                    </form>
				</div></div></div>
                    <?php  }} ?>
                  </tbody>
                </table>
              </div>
                </div>  
            <?php  }else{ echo "No Record Found";} ?>
     
  
      
      </div>  
 </div>  
 </body>
 
    <?php include_once('footer.php'); ?>
 <?php include_once('footerTableScript.php'); ?>

 </html>
