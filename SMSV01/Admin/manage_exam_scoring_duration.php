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
$school_setup = new SchoolSetup();
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
  
</head>

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
?></div><div class="clearfix"></div>\
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
 
