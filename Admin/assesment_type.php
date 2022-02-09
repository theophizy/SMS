<?php

require_once('../classes/class.Grades.php');
$grade = new Grade() ;
?>

<?php  include_once('metadatda.php'); ?>
<title>Assestment Type</title>
 <?php  include_once('links.php'); ?>
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

 <div class="container" style="width:700px;">  
               <div class="col-lg-10" align="center"><?php
include_once('../msg/messages.php');
?></div><div class="clearfix"></div>
                <div class="table-responsive" >  
                     <div align="right">  
                        <!--  <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Add new Grade</button>  -->
                     </div>  
                     <br />  
                   <div class="box">
            <div class="box-header">
              <h3 class="box-title">Availabe Grades</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th>#</th>
                      <th>Exam Name</th>
                      <th>Exam Weight</th>
                       <th>Exam Status</th>
                   
                    </tr>
                  </thead>
                 
                  <?php
				  $sn=1;
				  if(!empty($grade->viewAllExamType())){
				  foreach($grade->viewAllExamType() as $key => $val){
				  ?>	

                   
                      <th><?php echo $sn++ ?></th>
                      <th><?php echo $val['exam_name'] ?></th>
                      <th><?php echo $val['exam_marks'] ?></th>
                      <th><?php echo $val['exam_status'] ?></th>
                      
                  
                     </tr>
  
                    <?php  }} ?>
                  </tbody>
                </table>
              </div>
                </div>  
          
     
  
 </div>  
 <?php include_once('footer.php'); ?>
 <?php include_once('footerTableScript.php'); ?>

</script>
</body>
</html>
