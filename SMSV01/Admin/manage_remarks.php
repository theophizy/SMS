<?php
session_start();
if(!isset($_SESSION['USERNAME'])){
echo "<script>
location='../'
</script>";	
}
require_once('../classes/class.school_setup.php');
require_once('../classes/class.term.php');
require_once('../classes/class.Session.php');

$schoolsetup = new SchoolSetup();
$term = new Term();
$availablesession = new Session_class();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
 <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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

<body>
 <div class="container" style="width:700px;">  
 <div class="col-lg-10" align="center"><?php
include_once('../msg/messages.php');
?></div><div class="clearfix"></div>
 <div class="col-lg-12">
 
                    <div class="card">
                     <div class="btn btn-reddit btn-block"> <strong>Manage Formater's Result Remarks</strong> </div>
 <strong><hr /></strong>
                                           <div class="card-body card-block">
                        <form  action="" method="post" id="form1"   enctype="multipart/form-data" class="form-horizontal" name="postForm" >
                           
         <div class="row form-group">
        
                          
         
          <div class="col col-md-3">
                          <select name="remark_term" onselect="this.className" class="form-control">
     
      <?php
	  
	  foreach($term->viewAllTerm() as $key => $val){ 
	  ?>
     <option value="<?php echo $val['term_code'] ?>"><?php echo $val['term_name'] ?></option>
    
     <?php
	 
	  } ?>
     </select>
                          </div>  
                            <div class="col col-md-3">
                          <select name="remark_session" onselect="this.className" class="form-control">
      
      <?php
	  
	  foreach($availablesession->viewAllSession() as $key => $val){
	  ?>
     <option value="<?php echo $val['session_code'] ?>"><?php echo $val['session_description'] ?></option>
    
     <?php
	 
	  } ?>
     </select>
                          </div>                
  
    <div class="col col-md-1">
     
                       
     <button  type="submit" id="sub"  name="search" class=" btn btn-primary"><i  class="fa fa-search" ></i></button> </div>
       </div>                   
</form>
    
  </div>
      
   <?php
  
   if(isset($_POST['search'])){
	  
					  $schoolsetup->remark_term = $_POST['remark_term'];
			  $schoolsetup->remark_session = $_POST['remark_session'];
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
					  $term->term_code = $val['remark_term'];
					  $term->viewTermByID();
					  $availablesession->session_code =$val['remark_session'];
					  $availablesession->viewSessionByID();
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
 <div class="row form-group">
 <div class="col col-md-3"><label> Term</label></div>
  <input type="hidden" name="remark_term" value="<?php echo $val['remark_term']?>" class="form-control"  />
 <div class="col col-md-9"> <input type="text"  value="<?php echo $term->term_name?>" class="form-control" readonly="readonly" />
						</div>
						</div>
			<div class="row form-group">
 <div class="col col-md-3"><label> Session</label></div>
  <input type="hidden" name="remark_session" value="<?php echo $val['remark_session']?>" class="form-control"  />
 <div class="col col-md-9"> <input type="text"  value="<?php echo $availablesession->session_description?>" class="form-control" readonly="readonly" />
						</div>
						</div>
				
				<div class="modal-footer">
					<button name="update" type="submit" class="btn btn-primary"></span> Update</button>
					<button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                    </div> </div>
                    </form>
				</div></div></div>
                    <?php  }}else{ echo "No Records for the selected term and session";}} ?>
                  </tbody>
                </table>
              </div>
                </div>  
          
     
 
 </div>  
      
      </div>  
 </div>  
 </body>
 
 </html>
 <script>  
 $(document).ready(function(){  
      $('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
      });  
 });
 </script>

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
 
