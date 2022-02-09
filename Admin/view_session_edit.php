<?php
include_once("sessionStart.php"); 

require_once('../classes/class.Session.php');
$availableSession = new Session_class();
?>

<?php  include_once('metadatda.php'); ?>

  <title>Academic Sessions</title>

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
<div class="btn btn-reddit btn-block"> <strong>Availabe Academic Sessions</strong> </div>
                     
                        <strong><hr></strong>
                <div class="table-responsive" >  
                     <div align="right">  
                          <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Add new Sessioin</button>  
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
                      <th>Session</th>
                      <th>Session Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                 
                  <?php
				  $sn=1;
				   if(!empty($availableSession->viewAllSession())){
				  foreach($availableSession->viewAllSession() as $key => $val){
				  ?>
                   
                      <th><?php echo $sn++ ?></th>
                      <th><?php echo $val['session_description'] ?></th>
                      <th><?php echo $val['session_status'] ?></th>
                     <td><button title="Edit" class="btn-success" data-toggle="modal" type="button" data-target="#update_modal<?php echo $val['session_code']?>"><span class=" fa fa-pencil"></span></button></td> </tr>
  <div class="modal fade" id="update_modal<?php echo $val['session_code']?>" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content" >
<form method="POST" action="../Control_classes/session_controller.php?action=Edit_session">
				<div class="modal-header">
                <div class="btn btn-reddit btn-block"> <strong>Edit Session</strong> </div>
                     
                        <strong><hr></strong>
					
				</div>
				<div class="modal-body">
					
					
						<div class="row form-group">
							<div class="col-3 col-md-3">Session</div>
							<input type="hidden" name="session_code" value="<?php echo $val['session_code']?>"/>
                            <div class="col-3 col-md-8">
<input type="text" name="session_description" value="<?php echo $val['session_description']?>" class="form-control"  onkeyup="this.value= this.value.toUpperCase();" required />
						</div>
						
				</div>
				
						<div class="row form-group">
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
                      <div class="btn btn-reddit btn-block"> <strong>Add New session</strong> </div>
                     
                        <strong><hr></strong> 
                 
                </div>  
                <div class="modal-body">  
                     <div class="card-body card-block">
                        <form action="../Control_classes/session_controller.php?action=createsessionfrommodal" method="post" enctype="multipart/form-data" class="form-horizontal" name="postForm" onSubmit="return ValidatePost(); ">
                           
                            
                           
 
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Session</label></div>
                            <div class="col-3 col-md-8"><input type="text" id="session_description" name="session_description" placeholder="E.g 2017/2018" class="form-control"  onKeyUp="this.value=this.value.toUpperCase();" required></div>
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
