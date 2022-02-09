<?php include_once("sessionStart.php"); ?>
<?php

require_once('../classes/class.Session.php');
require_once('../classes/class.term.php');
$sessions = new Session_class();
$term = new Term();

?>
<!-- Author: Anande Theophilus Terfa             -->
<?php  include_once('metadatda.php'); ?>
  <title>Create Fee Category</title>
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
                    <div class="btn btn-reddit btn-block"> <strong>Create Fee Category</strong> </div>
                        <strong><hr></strong> 
                      
                      
                      <div class="card-body card-block">
                        <form action="../Control_classes/feeitem_controller.php?action=createfeecat" method="post" enctype="multipart/form-data" class="form-horizontal" name="postForm" onSubmit="return ValidatePost();">
                           
                            
                           
 
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Fee Item Description</label></div>
                            <div class="col-3 col-md-4"><input type="text" id="fee_name" name="fee_name" placeholder="School fees or exam fee" class="form-control"  onKeyUp="this.value=this.value.toUpperCase();" required></div>
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
