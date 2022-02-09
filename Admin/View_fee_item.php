<?php
include_once("sessionStart.php"); 

require_once('../classes/class.Classarm.php');
require_once('../classes/class.Feeitem.php');
//include_once('../classes/class.school_setup.php');
require_once('../classes/class.Session.php');
require_once('../classes/class.term.php');
$sessions = new Session_class();
$term = new Term();
$feeitems = new FeeItem();
$classarm=new ClassArm();
$studentclass = new StudentClasses();
?>

<?php  include_once('metadatda.php'); ?>

  <title>Fee Items </title>

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
                <div class="table-responsive" > 
                              
         <div class="btn btn-reddit btn-block"> <strong>Asigned  Fees for each Class  </strong> </div>
         <h3><strong><hr></strong></h3> 
                     <div align="right">  
                          <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Add New Fee Item </button>  
                     </div>  
                     <br />  
                   <div class="box">
           
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th>#</th>
                      <th> Name</th>
                      <th>Class</th>
                       <th>Class Arm</th>
                      <th>Amount</th>
                      <th>Session</th>
                      <th>Term</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                 
                  <?php
				  $sn=1;
				  if(!empty($feeitems->viewAllFeeitems())){
				  foreach($feeitems->viewAllFeeitems() as $key => $val){
					$feeitems->fee_item_id = $val['fee_item_id'];
					$feeitems->viewfeeitemyID();
				  ?>
                  <tbody>
                   <tr>
                      <th><?php echo $sn++ ?></th>
                      <th><?php echo $feeitems->fee_item_description ?></th>
                        <th><?php echo $feeitems->fee_item_classid ?></th>
                          <th><?php echo $feeitems->fee_item_classarm ?></th>
                       <th><?php echo $feeitems->fee_item_amount ?></th>
                        <th><?php echo $feeitems->fee_item_session ?></th>
                         <th><?php echo $feeitems->fee_item_term ?></th>
                      <th><?php echo $feeitems->fee_item_status ?></th>
                     <td><button title="Edit" class="btn-success" data-toggle="modal" type="button" data-target="#update_modal<?php echo $feeitems->fee_item_id ?>"><span class=" fa fa-pencil"></span></button></td> </tr>
  <div class="modal fade" id="update_modal<?php echo $feeitems->fee_item_id?>" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
<form method="POST" action="../Control_classes/feeitem_controller.php?action=Edit_feeitem">
				<div class="modal-header">
					<h3 class="modal-title">Modify Amount of Money to be Paid </h3>
				</div>
				<div class="modal-body">
					
					<div class="col-md-8">
						<div class="form-group">
							<label>Fee Item Description </label>
							<input type="hidden" name="fee_id" value="<?php echo $feeitems->fee_item_id?>"/>
<input type="text" name="description" value="<?php echo $feeitems->fee_item_description?>" class="form-control" onkeyup="this.value= this.value.toUpperCase();" readonly />
						</div>

						
				</div>
                <div class="col-md-8">
						<div class="form-group">
							<label>Class </label>
							
<input type="text" name="amount" value="<?php echo $feeitems->fee_item_classid ?>" class="form-control"  readonly />
						</div>

						
				</div><div class="col-md-8">
						<div class="form-group">
							<label>Class Arm </label>
							
<input type="text" name="amount" value="<?php echo $feeitems->fee_item_classarm ?>" class="form-control"  readonly />
						</div>

						
				</div>
				
                <div class="col-md-8">
						<div class="form-group">
							<label>Academic Session </label>
							
<input type="text" name="fee_session" value="<?php echo $feeitems->fee_item_session ?>" class="form-control" readonly="readonly"   />
						</div>

						
				</div>
                <div class="col-md-8">
						<div class="form-group">
							<label>Term </label>
							
<input type="text" name="term" value="<?php echo $feeitems->fee_item_term ?>" class="form-control" readonly   />
						</div>

						
				</div>
                <div class="col-md-8">
						<div class="form-group">
							<label>Amount </label>
							
<input type="number" name="amount" value="<?php echo $feeitems->fee_item_amount ?>" onKeyPress="return isNumber(event)" class="form-control" />
						</div>

						
				</div>
				
				<div class="modal-footer">
					<div class="col-md-8">
						<div class="form-group">
						<button name="update" type="submit" class="btn btn-primary"></span> Update</button>
                        <button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
						</div>

						
				</div>
					
                    </div></div>
                    </form>
				</div></div></div>
                    <?php  }}  ?>
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
                     <h4 class="modal-title">Add New Fee Item</h4>  
                </div>  
                <div class="modal-body">  
                     <div class="card-body card-block">
                        <form action="../Control_classes/feeitem_controller.php?action=createfeeitemfrommodal" method="post" enctype="multipart/form-data" class="form-horizontal" name="postForm" onSubmit="return ValidatePost(); ">
                           
                            
                           
 
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Fee Item Description</label></div>
                              <div class="col-3 col-md-4"><?php echo $feeitems->feecatSelectField() ?></div>
                          </div>
                           <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Class </label></div>
                            <div class="col-3 col-md-4"> <?php echo $studentclass->classSelectField();?></div>
                          </div>
                           <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Class Arm</label></div>
                            <div class="col-3 col-md-4"> <?php echo $classarm->classarmSelectField(); ?></div>
                          </div>
      <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Amount</label></div>
                            <div class="col-3 col-md-4"><input type="number" id="amount" name="amount" placeholder="Amount to be paid" class="form-control"  required></div>
                          </div>
                           <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Academic Session</label></div>
                            <div class="col-3 col-md-4"><?php echo $sessions->sessionSelectField() ?></div>
                          </div>
                           <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Term </label></div>
                            <div class="col-3 col-md-4"><?php echo $term->termSelectField() ?></div>
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
 