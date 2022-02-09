<?php include_once("sessionStart.php"); ?>
<?php

require_once('../classes/class.Subject.php');
//Instantiate classes
$classarm = new ClassArm();
$studentclass = new StudentClasses();
$subjects = new Subject();
?>
<!-- Author: Anande Theophilus Terfa             -->
 <?php  include_once('metadatda.php'); ?>
  <title>Bind Subject To Classes</title>
  <!-- Tell the browser to be responsive to screen width -->
  
 <?php  include_once('links.php'); ?> <!--<![endif]-->
<head>
   

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
<script type="text/javascript">
function ValidatePost(){
var class_name=document.postForm.class_name.value;

if(class_name==""){
	//alert("Enter the title of the post");
	document.postForm.class_name.focus();
	return false;	
}
}

</script>
</head>
<?php include_once('navBar.php'); ?>
<body>

<div class="col-lg-10" align="center"><?php
include_once('../msg/messages.php');
?></div><div class="clearfix"></div>
        <!-- Left Panel -->

   

        <div class="content mt-6">

          <div class="btn btn-reddit btn-block"> <strong>Bind subject to classes</strong> </div><strong><hr></strong>
 <div class="col-lg-10">
 
                    <div class="card">
                      <div class="card-header" align="center">
                      
                      </div>
                      
                      <div class="card-body card-block">
                        <form action="../Control_classes/class_subject_controller.php?action=bindclasstosubjects" method="post" enctype="multipart/form-data" class="form-horizontal" name="postForm" onSubmit="return ValidatePost();">
                           
                            
                        
 
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Select Class <font color="#FF0000">*</font> </label></div>
                            <div class="col-3 col-md-4"><?php echo $studentclass->classSelectField(); ?></div>
                          </div>
                          
                          <div class="row form-group">
                           
                          <br>
                         <div class="row col-lg-12">
                         <strong><hr></strong>
                            <?php
							$i=0;
							foreach($subjects->viewAllSubject() as $key => $val){
								if($i % 5 == 0)
									echo '<div class="row form-group">';
									?>
                                    
                                    <div class="col col-md-4" align="left">
                                     <input type="checkbox" name="cls[]" value="<?php echo $val["subject_id"]?>"><strong><strong><?php echo $val["subject_name"]?></strong></strong></div>&nbsp;&nbsp;
                                   
                                    <?php
									if($i % 5 == 0)
									echo '</div>';
									
									 	$i++;
									}
								
									?>
                                    
								
                       </div>
                        <strong><hr></strong>
                       </div>
                          <div class="clearfix"></div>
                          <br>
                         
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
 <?php include_once('footerTableScript.php'); ?>

</body>
</html>
