<?php
include_once("sessionStart.php"); 

require_once('../classes/class.bank.php');
$availableBank = new Bank();
?>

<?php  include_once('metadatda.php'); ?>

  <title>List of Available Banks</title>

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
  <div class="btn btn-reddit btn-block"> <strong>List of  Banks Partnering with Us</strong> </div>
                     
                        <strong><hr></strong></strong>
                     
                        
                <div class="table-responsive" >  
                     <div align="right">  
                          <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Add new Bank</button>  
                     </div>  
                     <br />  
                   <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th>#</th>
                       <th>Bank Code</th>
                      <th>Bank Name</th>
                      <th>Bank Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                 
                  <?php
				  $sn=1;
				   if(!empty($availableBank->viewAllBanks())){
				  foreach($availableBank->viewAllBanks() as $key => $val){
				  ?>
                   
                      <th><?php echo $sn++ ?></th>
                      <th><?php echo $val['bank_code'] ?></th>
                      <th><?php echo $val['bank_name'] ?></th>
                      <th><?php echo $val['bank_status'] ?></th>
                     <td><button title="Edit Bank" class=" btn btn-success" data-toggle="modal" type="button" data-target="#update_modal<?php echo $val['bank_id']?>"><span class=" fa fa-pencil"></span></button>
                     <?php if($val['bank_status'] == "ACTIVE"){  ?>
                     <a href="../Control_classes/bank_controller.php?action=deactivatebank_bank&bank_id=<?php echo  $val['bank_id'] ?>" class="btn btn-danger" title="Deactivate bank" onClick="return confirm('Are you sure??');">Deactivate</a>
                     <?php }else{  ?>
                      <a href="../Control_classes/bank_controller.php?action=activatebank_bank&bank_id=<?php echo  $val['bank_id'] ?>" class="btn btn-primary" title="Reactivate bank" onClick="return confirm('Are you sure??');">Reactivate</a>
                       <?php }  ?>
                     </td> </tr>
  <div class="modal fade" id="update_modal<?php echo $val['bank_id']?>" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
<form method="POST" action="../Control_classes/bank_controller.php?action=Edit_bank">
				<div class="modal-header">
					  <div class="btn btn-reddit btn-block"> <strong>Edit Bank Info</strong> </div>
                     
                        <strong><hr></strong>
				</div>
				<div class="modal-body">
					
					<div class="col-md-12">
						<div class="form-group">
							<label>Bank Code</label>
							<input type="hidden" name="bank_id" value="<?php echo $val['bank_id']?>"/>
<input type="text" name="bank_code" value="<?php echo $val['bank_code']?>" class="form-control"  onkeyup="this.value= this.value.toUpperCase();" required />
						</div>
						
				</div>
                <div class="col-md-12">
						<div class="form-group">
							<label>Bank Name</label>
							
<input type="text" name="bank_name" value="<?php echo $val['bank_name']?>" class="form-control"  onkeyup="this.value= this.value.toUpperCase();" required />
						</div>
						
				</div>
				
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
                       <div class="btn btn-reddit btn-block"> <strong>Add New Bank</strong> </div>
                     
                        <strong><hr></strong>  
                       
                </div>  
                <div class="modal-body">  
                     <div class="card-body card-block">
                        <form action="../Control_classes/bank_controller.php?action=createbankfrommodal" method="post" enctype="multipart/form-data" class="form-horizontal" name="postForm" >
                           
                            
                           
 
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Bank Code</label></div>
                            <div class="col-3 col-md-8"><input type="text" id="bank_code" name="bank_code" placeholder="E.g FBN" class="form-control"  onKeyUp="this.value=this.value.toUpperCase();" required></div>
                          </div>
                          
                           <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Bank Name</label></div>
                            <div class="col-3 col-md-8"><input type="text" id="bank_name" name="bank_name" placeholder="E.g First Bank of Nigeria" class="form-control"  onKeyUp="this.value=this.value.toUpperCase();" required></div>
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
