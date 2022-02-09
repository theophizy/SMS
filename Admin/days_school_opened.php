<?php include_once("sessionStart.php"); ?>
<?php
require_once('../classes/class.term.php');
require_once('../classes/class.Session.php');
$term = new Term();
$availableSession = new Session_class();
?>
<!-- Author: Anande Theophilus Terfa             -->
<?php  include_once('metadatda.php'); ?>
  <title> Days School Was Opened </title>
  <!-- Tell ethe browser to be responsive to screen width -->
  
 <?php  include_once('links.php'); ?>

<head>
   

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<?php include_once('navBar.php'); ?>
<body>

<div class="col-lg-10" align="center"><?php
include_once('../msg/messages.php');
?></div><div class="clearfix"></div>
        <!-- Left Panel -->

   

        <div class="content mt-6">

          
 <div class="col-lg-10">
 
                    <div class="card">
                      <div class="btn btn-reddit btn-block"> <strong>Set number of days school opened </strong> </div>
                        <strong><hr></strong> 
                      </div>
                      
                      <div class="card-body card-block">
                        <form action="../Control_classes/schoolsetup_controller.php?action=createdayschoolopened" method="post" enctype="multipart/form-data" class="form-horizontal" name="postForm" onSubmit="return ValidatePost();">
                           
                            
                           
 
      <div class="row form-group">
     
    
    <div class=" col-md-3"><select name="term" onselect="this.className" class="form-control" required >
   
    <?php foreach ($term->viewAllTerm() as $key => $values) {
		$term->term_code = $values['term_code'];
		$term->viewTermByID();
		 ?>
	<option value="<?php echo $term->term_code; ?>"><?php echo $term->term_name; ?></option>
    	<?php } ?>
     </select>
     </div>
     <div class=" col-md-3"><select name="sessions" onselect="this.className" class="form-control" required >
   
    <?php foreach($availableSession->viewAllSession() as $key => $values){ 
	$availableSession->session_code = $values['session_code'];
	$availableSession->viewSessionByID();
	
	?>
	<option value="<?php echo $availableSession->session_code; ?>"><?php echo $availableSession->session_description; ?></option>
	<?php } ?>
     </select></div>
 
     <div class=" col-md-3"><label>Days School Opened</label></div>   
     <div class=" col-md-2"><input type="number" name="days" class="form-control" required></div>   
  </div>
     
                          
                          
                         
                          <div class="row form-group">
                           <div class="col-6 col-md-9" align="center">
                           <!--<i class="fa fa-circle-o-notch fa-spin"></i>-->
                           <i class="fa fa-refresh fa-spin"></i><input type="submit" id="sub" name="post" value="Save" class="btn btn-success">  <input type="reset" name="reset" value="RESET" class="btn btn-danger"></div>
                          </div>
                        </form>
                      </div>
                     
                    </div>
           
                <!-- /# card -->
            </div>


        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->
 <?php include_once('footer.php'); ?>
          <?php include_once('footrJScripts.php'); ?>
</body>
</html>
