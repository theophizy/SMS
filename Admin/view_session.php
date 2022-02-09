<?php
include_once("sessionStart.php"); 


require_once('../classes/class.Session.php');
$availableSession = new Session_class();
?>

<?php  include_once('metadatda.php'); ?>

  <title>Academic Sessions</title>

  <?php  include_once('links.php'); ?>  <!-- Custom styles for this template-->
  
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
