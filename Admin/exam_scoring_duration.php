<?php include_once("sessionStart.php"); ?>

<?php


//Instantiate classes
require_once('../classes/class.Subject.php');
//include_once('../classes/class.Scores.php');
require_once('../classes/class.students.php');
$classarm=new ClassArm();
$studentAction = new Students();
$studentclass = new StudentClasses();
$availableSession = new Session_class();
$term=new Term();
$subject=new Subject();
$createscore = new Scores();
$database= new Database();


//$studentAction = new Students();

?>
<!-- Author: Anande Theophilus Terfa             -->
<?php  include_once('metadatda.php'); ?>
  <title>Set Scores Entry Duration</title>
  <!-- Tell ethe browser to be responsive to screen width -->
  
 <?php  include_once('links.php'); ?>


<?php include_once('navBar.php'); ?>
<body>

<div class="col-lg-10" align="center"><?php
include_once('../msg/messages.php');
?></div><div class="clearfix"></div>
        <!-- Left Panel -->

   

         <div class="content mt-3">

          
 <div class="col-lg-12">
 
                    <div class="card">
                     <div class="btn btn-reddit btn-block"> <strong>Set Score Entering Duration</strong> </div>
                      <div class="card-header" align="center">
                        <strong><hr></strong> 
                      </div>
                      
                      <div class="card-body card-block">
                        <form  action="../Control_classes/schoolsetup_controller.php?action=createscoreduration" method="post" enctype="multipart/form-data" class="form-horizontal" name="postForm" onSubmit="return ValidatePost();">
                           
         
                          
        <div class="row form-group">
        <div class="col col-md-2"><label>Session</label></div>
                            <div class="col col-md-3">
      <select name="duration_session" onselect="this.className" class="form-control">
     
      <?php
	  
	  foreach($availableSession->viewAllSession() as $key => $val){
	  ?>
     <option value="<?php echo $val['session_code'] ?>"><?php echo $val['session_description'] ?></option>
    
     <?php
	 
	  } ?>
     </select>
    </div>
     <div class="col col-md-2"><label>Term</label></div>
       <div class="col col-md-3">
      <select name="duration_term" onselect="this.className" class="form-control">
      
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
                            <div class="col col-md-2"><label>From Date</label></div>
                            <div class="col col-md-3">
                           <input   type="date" class="form-control" name="start_date" />
                          </div> 
                          <div class="col col-md-2"><label>To Date</label></div>
                            <div class="col col-md-3">
                           <input   type="date" class="form-control" name="end_date" />
                          </div> </div> 
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
          <?php include_once('footrJScripts.php'); ?>
</body>
</html>
