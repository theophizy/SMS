<?php
include_once("sessionStart.php"); 


//Instantiate classes

require_once('../classes/class.Subject.php');
require_once('../classes/class.term.php');
include_once('../classes/class.Session.php');
require_once('../classes/class.studentclasses.php');
//require_once('../classes/class.Classarm.php');
$classarm = new ClassArm();
$studentclass = new StudentClasses();
$availableSession = new Session_class();
$term = new Term();

$database= new Database();


//$studentAction = new Students();

?>
<!-- Author: Anande Theophilus Terfa             -->
<?php  include_once('metadatda.php'); ?>

  <title>Subjects Limits in a Term</title>

  <?php  include_once('links.php'); ?>
<head>
   

    

</head>
<?php include_once('navBar.php'); ?>

<body>

<div class="col-lg-10" align="center"><?php
include_once('../msg/messages.php');
?></div><div class="clearfix"></div>
        <!-- Left Panel -->

   

         <div class="content mt-6">

           <div class="btn btn-reddit btn-block"><strong>Set maximum and minimum number of subjects each student in each class is to offer  </strong></div> <hr>

 
                    <div class="card">
                      <div class="card-header" align="center">
                       
                      </div>
                      
                      <div class="card-body card-block">
                        <form  action="../Control_classes/subject_controller.php?action=createsubjectlimit" method="post" enctype="multipart/form-data" class="form-horizontal" name="postForm" onSubmit="return ValidatePost();">
                           
         
                          
        <div class="row form-group">
        <div class="col col-md-2"><label>Session</label></div>
                            <div class="col col-md-4">
      <select name="session_limit" onselect="this.className" class="form-control">
     
      <?php
	  
	  foreach($availableSession->viewAllSession() as $key => $val){
	  ?>
     <option value="<?php echo $val['session_code'] ?>"><?php echo $val['session_description'] ?></option>
    
     <?php
	 
	  } ?>
     </select>
    </div>
     <div class="col col-md-2"><label>Term</label></div>
       <div class="col col-md-4">
      <select name="term_limt" onselect="this.className" class="form-control">
      
      <?php
	  
	  foreach($term->viewAllTerm() as $key => $val){
	  ?>
     <option value="<?php echo $val['term_code'] ?>"><?php echo $val['term_name'] ?></option>
    
     <?php
	
	  } ?>
     </select>
    </div>
     </div>
     
     <div class="row form-group">
        <div class="col col-md-2"><label>Class</label></div>
                            <div class="col col-md-4">
      <select name="class_limit" onselect="this.className" class="form-control">
     
      <?php
	  
	  foreach($studentclass->viewAllClasses() as $key => $val){ 
	  ?>
     <option value="<?php echo $val['class_code'] ?>"><?php echo $val['class_name'] ?></option>
    
     <?php
	 
	  } ?>
     </select>
    </div>
     <div class="col col-md-2"><label>Class Arm</label></div>
       <div class="col col-md-4">
      <select name="classarm_limit" onselect="this.className" class="form-control">
      
      <?php
	  
	  foreach($classarm->viewAllClassarm() as $key => $val){ 
	  ?>
     <option value="<?php echo $val['class_arm_code'] ?>"><?php echo $val['class_arm_name'] ?></option>
    
     <?php
	
	  } ?>
     </select>
    </div>
     </div>
     
     <div class="row form-group">
     <div class="col col-md-2"><label>Minimum number of subjects</label></div>
                            <div class="col col-md-4">
                           <input   type="number" class="form-control" name="min_limit" />
                          </div>
                            <div class="col col-md-2"><label>Maximun number of subjects</label></div>
                            <div class="col col-md-4">
                           <input   type="number" class="form-control" name="max_limit" />
                          </div> 
                           </div> 
        <div class="row form-group">
                            <div class="col col-md-2"></div>
    <div class="col col-md-9">
     
                           
                           <!--<i class="fa fa-circle-o-notch fa-spin"></i>-->
                           <button title="send" type="submit" id="sub" name="post" class=" btn btn-primary btn-block">Submit</button> </div>
                           </div>
</form>
    
 
      
  
     </div>

        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

   
    <?php include_once('footer.php'); ?>
 <?php include_once('footerTableScript.php'); ?>
</body>
</html>
