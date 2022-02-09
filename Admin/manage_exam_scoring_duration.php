<?php include_once("sessionStart.php"); ?>

<?php
require_once('../classes/class.school_setup.php');
require_once('../classes/class.term.php');
require_once('../classes/class.Session.php');
$school_setup = new SchoolSetup();
$term = new Term();
$availablesession = new Session_class();

?>
<?php  include_once('metadatda.php'); ?>
  <title>Manage Scoring Duration </title>
  <!-- Tell ethe browser to be responsive to screen width -->
  
 <?php  include_once('links.php'); ?>
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
               <div class="col-lg-10" align="center">
			   <?php include_once('../msg/messages.php');?> 
 </div><div class="clearfix"></div>
 <div class="btn btn-reddit btn-block"> <strong>Manange Score Entering Duration</strong> </div>
 <strong><hr /></strong>
                <div class="table-responsive" >  
                     
                   
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
                      <th>Term</th>
                      <th>Session</th>
                       <th>Start Date</th>
                      <th>End Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                 
                  <?php
				  $sn=1;
				  if(!empty($school_setup->viewAllScoreDuration())){
				  foreach($school_setup->viewAllScoreDuration() as $key => $val){
					$term->term_code =  $val['duration_term'];
					$term->viewTermByID();
					$availablesession->session_code = $val['duration_session'];
					$availablesession->viewSessionByID();
				  ?>
                  <tbody>
                   <tr>
                      <th><?php echo $sn++ ?></th>
                      <th><?php echo $term->term_name; ?></th>
                      <th><?php echo $availablesession->session_description; ?></th>
                       <th><?php echo  $val['start_date']; ?></th>
                      <th><?php echo  $val['end_date']; ?></th>
                     <td><button title="Edit" class="btn-success" data-toggle="modal" type="button" data-target="#update_modal<?php echo $val['duration_id']?>"><span class=" fa fa-pencil"></span></button></td> </tr>
  <div class="modal fade" id="update_modal<?php echo $val['duration_id']?>"  aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
<form method="POST" action="../Control_classes/schoolsetup_controller.php?action=updatescoreduration">
				<div class="modal-header">
                <div class="btn btn-reddit btn-block"> <strong>Reset Duration</strong> </div>
 <strong><hr /></strong>
					
				</div>
				<div class="modal-body">
					
					
						
				<div class=" row form-group">
						<div class="col col-md-3">
							<label>Start Date</label></div>
                             <div class="col col-md-9"> 
							<input type="hidden" name="duration_id" value="<?php echo $val['duration_id']?>"/> 
                            <input type="hidden" name="duration_term" value="<?php echo $val['duration_term']?>"/>
                              <input type="hidden" name="duration_session" value="<?php echo $val['duration_session']?>"/>
<input type="date" name="start_date"  class="form-control" value="<?php echo $val['start_date']?>" required />
						</div>

						</div>
				
				<div class=" row form-group">
						<div class="col col-md-3">
							<label>End Date</label>
							</div>
                           <div class="col col-md-9"> 
<input type="date" name="end_date"  class="form-control" value="<?php echo $val['end_date']?>" required  />
						</div>

				</div>
               
                <div class=" row form-group">
						<div class="col col-md-3">
							<label>Term</label>
							</div>
                          	<div class="col col-md-9">	  
<input type="text"   class="form-control" readonly="readonly" value="<?php echo $term->term_name ?>"  />
						</div>
</div>
				
                <div class=" row form-group">
						<div class="col col-md-3">	<label>Session</label></div>
						<div class="col col-md-9">	
<input type="text"   class="form-control" readonly="readonly" value="<?php echo $availablesession->session_description ?>"  />
</div>
						</div>

				<div class=" row form-group">
						<div class="col col-md-3"></div>
                        <div class="col col-md-9">
				<div class="modal-footer">
					<button name="update" type="submit" class="btn btn-primary"></span> Update</button>
					<button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                 </div> </div></div></div>
                    </form>
				</div></div>
                    <?php } } ?>
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
  
 </div>  
 
 <?php include_once('footer.php'); ?>
 <?php include_once('footerTableScript.php'); ?>
 </body>
</html>

