<?php include_once("sessionStart.php"); ?>

<?php

//include_once('../classes/class.studentclasses.php');

include_once('../classes/class.Classarm.php');
//include_once('../classes/class.staff.php');

$classarm = new ClassArm();
$studentclass = new StudentClasses();
//$staff = new Staff();

?>
<!-- Author: Anande Theophilus Terfa             -->
 <?php  include_once('metadatda.php'); ?>
  <title>Asign Class Teacher </title>
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

          
 <div class="col-lg-12">
  <div class="btn btn-reddit btn-block"> <strong>Asign Formater</strong> </div>
         <h3><strong><hr></strong></h3>
                    <div class="card">
                    
                      
                      <div class="card-body card-block">
                        <form  action="../Control_classes/formmaster_controller.php?action=asign_form_master" method="post" id="form1"   enctype="multipart/form-data" class="form-horizontal" name="postForm" >
                           
         <div class="row form-group">
         <div class="col col-md-2">
                          <select name="student_class" onselect="this.className" class="form-control">
     
      <?php
	  
	  foreach($studentclass->viewAllClasses() as $key => $val){
	  ?>
     <option value="<?php echo $val['class_code'] ?>"><?php echo $val['class_name'] ?></option>
    
     <?php
	 
	  } ?>
     </select>
                          </div> 
                          
         <div class="col col-md-2">
                          <select name="class_arm" onselect="this.className" class="form-control">
     
      <?php
	  
	  foreach($classarm->viewAllClassarm() as $key => $val){ 
	  ?>
     <option value="<?php echo $val['class_arm_code'] ?>"><?php echo $val['class_arm_name'] ?></option>
    
     <?php
	 
	  } ?>
     </select>
                          </div> 
                      <div class="col col-md-4">
                          <select name="staff_id" onselect="this.className" class="form-control">
     
      <?php
	  
	  foreach($classarm->viewActiveStaff() as $key => $val){ 
	  ?>
     <option value="<?php echo $val['staff_id'] ?>"><?php echo $val['staff_last_name']. "   ".$val['staff_first_name'] ?></option>
    
     <?php
	 
	  } ?>
     </select>
                          </div>  
                                             
  
    <div class="col col-md-3">
     
                           
                           <!--<i class="fa fa-circle-o-notch fa-spin"></i>-->
                           <button  type="submit" id="sub"  name="send" class=" btn btn-primary" onClick="return confirm('Are you sure?')">Asing Form Master</button> </div>
       </div>                   
</form>
    
  </div>
      
  
     
    

    <!-- Right Panel -->
  </section>  
         <?php include_once('footer.php'); ?>
          <?php include_once('footrJScripts.php'); ?>
          </body>
</html>
