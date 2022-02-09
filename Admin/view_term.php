<?php
include_once("sessionStart.php"); 

require_once('../classes/class.term.php');
$availableTerm = new Term();
?>

<?php  include_once('metadatda.php'); ?>

  <title>Available Terms</title>

  <?php  include_once('links.php'); ?>
  <!-- Custom styles for this template-->
  
</head>
<?php include_once('navBar.php'); ?>

<body>


 <div class="container" style="width:700px;">  
               <div class="col-lg-10" align="center"><?php
include_once('../msg/messages.php');
?></div><div class="clearfix"></div>
 <div class="btn btn-reddit btn-block"> <strong>Availabe Terms</strong> </div>
                     
                        <strong><hr></strong> 
                <div class="table-responsive" >  
                      
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
                      <th>Term Name</th>
                      <th>Term Status</th>
                     
                    </tr>
                  </thead>
                 
                  <?php
				  $sn=1;
				   if(!empty($availableTerm->viewAllTerm())){
				  foreach($availableTerm->viewAllTerm() as $key => $val){
				  ?>
                   
                      <th><?php echo $sn++ ?></th>
                      <th><?php echo $val['term_name'] ?></th>
                      <th><?php echo $val['term_status'] ?></th>
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
