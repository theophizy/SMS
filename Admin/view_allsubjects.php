<?php
include_once("sessionStart.php"); 

require_once('../classes/class.Subject.php');
$subject = new Subject();
?>

<?php  include_once('metadatda.php'); ?>

  <title>Available Subjects </title>

  <?php  include_once('links.php'); ?>
  <!-- Custom styles for this template-->
  
</head>
<?php include_once('navBar.php'); ?>

<body>
 <div class="container" style="width:700px;">  
               <div class="col-lg-10" align="center"><?php
include_once('../msg/messages.php');
?></div><div class="clearfix"></div>
                <div class="table-responsive" >  
                        <div class="btn btn-reddit btn-block"> <strong>Availabe Subjcts</strong> </div>
                     
                        <strong><hr></strong> 
                     
                   <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th>#</th>
                      <th>Subject Code</th>
                      <th>Subject Name</th>
                      <th>Subject Status</th>
                     
                    </tr>
                  </thead>
                 
                  <?php
				  $sn=1;
				  if(!empty($subject->viewAllSubject())){
				  foreach($subject->viewAllSubject() as $key => $val){
				  ?>
                   
                      <th><?php echo $sn++ ?></th>
                      <th><?php echo $val['subject_code'] ?></th>
                      <th><?php echo $val['subject_name'] ?></th>
                      <th><?php echo $val['subject_status'] ?></th>
                     </tr>
 
                    <?php  }} ?>
                  </tbody>
                </table>
              </div>
                </div>  
          
     
 
 </div>  
 </body>
    <?php include_once('footer.php'); ?>
 <?php include_once('footerTableScript.php'); ?>
 </html>

 
