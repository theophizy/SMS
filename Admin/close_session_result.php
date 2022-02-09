<?php include_once("sessionStart.php"); ?>
<?php

include_once('../classes/class.school_setup.php');


$studentclass = new StudentClasses();

$school_setup = new SchoolSetup();



//$studentAction = new Students();

?>
<!-- Author: Anande Theophilus Terfa             -->
<?php  include_once('metadatda.php'); ?>
  <title>Closs Term Result Sheet</title>
  <!-- Tell the browser to be responsive to screen width -->
  
 <?php  include_once('links.php'); ?>

  
</head>
<?php include_once('navBar.php'); ?>
<body>

<div class="col-lg-10" align="center"><?php
include_once('../msg/messages.php');
?></div><div class="clearfix"></div>
        <!-- Left Panel -->

   

         <div class="content mt-12">
         <div class="btn btn-reddit btn-block"> <strong>Close each class result at the end of each term</strong> </div>
         <h3><strong><hr></strong></h3>
<?php if(!empty($school_setup->viewAllStudentCognitiveDistinct())){ ?>
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
				   if(!empty($school_setup->viewAllStudentCognitiveDistinct())){
						   foreach($school_setup->viewAllStudentCognitiveDistinct() as $key => $values)  {
							  
						   $studentclass->class_code = $values['cog_student_class'];
						   //get subject name by its id
						 $studentclass->viewclassByID();
						  
				  ?>
                   
                      <td><?php echo $sn++ ?></td>
                      <td><?php echo $studentclass->class_name?></td>
                      <td><a title="Close Class Scores" class="btn btn-success" href="../Control_classes/schoolsetup_controller.php?action=close_cognitive&cognitive_class=<?php echo $values['cog_student_class'] ?>" onClick="return confirm('Are you sure?');">Close Result</a></td>
                       
                      
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
