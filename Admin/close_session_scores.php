<?php include_once("sessionStart.php"); ?>
<?php
include_once('../classes/class.Classarm.php');

include_once('../classes/class.studentclasses.php');
include_once('../classes/class.Scores.php');
//include_once('../classes/class.term.php');

//include('../classes/class.Database.php');
//include_once ('../Admin/links.php');



$scores = new Scores();
$studentclass = new StudentClasses();
$arm = new ClassArm();
//$school_setup = new SchoolSetup();



//$studentAction = new Students();

?>
<!-- Author: Anande Theophilus Terfa             -->
<?php  include_once('metadatda.php'); ?>
  <title>Closs Term Scores Sheet</title>
  <!-- Tell the browser to be responsive to screen width -->
  
 <?php  include_once('links.php'); ?>
</head>
<?php include_once('navBar.php'); ?>


<div class="col-lg-10" align="center"><?php
include_once('../msg/messages.php');
?></div><div class="clearfix"></div>
        <!-- Left Panel -->

   

         <div class="content mt-12">
         <div class="btn btn-reddit btn-block"> <strong>Close each class scores at the end of each term</strong> </div>
         <h3><strong><hr></strong></h3>
<?php if(!empty($scores->viewAllScoresDisticntClass())){ ?>
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
                      <th>Class</th>
                      <th> Action</th>
                      
                     
                    
                    </tr>
                  </thead>
                 <tbody>
                 <tr>
                  <?php
				  $sn=1;
				   if(!empty($scores->viewAllScoresDisticntClass())){
						   foreach($scores->viewAllScoresDisticntClass() as $key => $values)  {
							  
						   $studentclass->class_code = $values['score_class'];
						  $arm->class_arm_code = $values['score_class_arm'];
						  $arm->viewClassArmByID();
						   //get subject name by its id
						 $studentclass->viewclassByID();
						  
				  ?>
                   
                      <td><?php echo $sn++ ?></td>
                      <td><?php echo $studentclass->class_name,$arm->class_arm_name?></td>
                      <td><a title="Close Class Scores" class="btn btn-success" href="../Control_classes/Scores_controller.php?action=close_scores&score_class=<?php echo $values['score_class']?>&classarm=<?php echo $values['score_class_arm'] ?>" onClick="return confirm('Are you sure?');">Close Scores</a></td>
                       
                      
                     </tr>
 <?php  }}?>
            
     
   
			
  	
		
                  </tbody>
                </table>
       </div>


 <?php }else{ echo "No Records Found for the Selected Items"; 
 }  ?>
     
        </div> <!-- .content -->
    </div><!-- /#right-panel -->
    
  </div>
      
  
     
       <!-- Right Panel -->
 <?php include_once('footer.php'); ?>
 <?php include_once('footerTableScript.php'); ?> 

  
</body>
</html>
