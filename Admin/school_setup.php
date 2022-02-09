<?php
include_once("sessionStart.php"); 

require_once('../classes/class.school_setup.php');
require_once('../classes/class.Database.php');
$availablecognitiveskills = new SchoolSetup();
?>
<!-- Author: Anande Theophilus Terfa             -->
<?php  include_once('metadatda.php'); ?>

  <title>School Settings </title>

  <?php  include_once('links.php'); ?>
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

          
 
                    <div class="card">
                      <div class="btn btn-reddit btn-block"> <strong>SET UP SCHOOL DETAILS</strong> </div>
                        <strong><hr></strong> 
                        <br>
                      </div>
                      
                      <div class="card-body card-block">
                        <form action="../Control_classes/schoolsetup_controller.php?action=Update_school" method="post" enctype="multipart/form-data" class="form-horizontal" name="postForm" onSubmit="return ValidatePost();">
                           
                            <?php $availablecognitiveskills->viewSchoolSetup(); ?>
                           <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">SCHOOL NAME</label></div>
                            <input type="hidden" id="school_id" name="school_id" class="form-control" value="<?php echo $availablecognitiveskills->school_id  ?>" >
                            <div class="col-3 col-md-6"><input type="text" id="school_name" name="school_name" class="form-control" value="<?php echo $availablecognitiveskills->school_name  ?>"  onKeyUp="this.value=this.value.toUpperCase();" required></div>
                          </div>
 
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">SCHOOL ADDRESS</label></div>
                            <div class="col-3 col-md-6"><textarea  id="school_address" name="school_address" class="form-control" required> <?php echo $availablecognitiveskills->school_address ?></textarea></div>
                          </div>
                          <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">SCHOOL PHONE</label></div>
                            <div class="col-3 col-md-6"><input type="number" id="school_phone" name="school_phone" class="form-control"  value="<?php echo $availablecognitiveskills->school_phone  ?>"  required></div></div>
                          
                          <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">SCHOOL EMAIL</label></div>
                            <div class="col-3 col-md-6"><input type="email" id="school_email" name="school_email" class="form-control"  value="<?php echo $availablecognitiveskills->school_email  ?>"   required></div>
                          </div>
                          <div class="row form-group">
                           <div class="col col-md-3"><label for="text-input" class=" form-control-label">SCHOOL LOGO</label></div>
                            <div class="col-3 col-md-6"><input type="file" name="file" class="form-control" value="<?php echo $availablecognitiveskills->school_logo ?>" > <img class="user-avatar rounded-circle" src="<?php echo $availablecognitiveskills->school_logo?>" style="height:40; width:40px;"  alt="User Avatar"></div>
                          </div>
                          
     
                          
                          
                         
                          <div class="row form-group">
                           <div class="col-6 col-md-9" align="center">
                           <!--<i class="fa fa-circle-o-notch fa-spin"></i>-->
                         <input type="submit" id="sub" name="post" value="Save" class="btn btn-success">  <input type="reset" name="reset" value="RESET" class="btn btn-danger"></div>
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
