<?php include_once("sessionStart.php"); ?>

<?php
//require_once('../classes/class.article.php');

require_once('../classes/class.term.php');
require_once('../classes/class.Session.php');

$term = new Term();
$availablesession = new Session_class();

?>
<!-- Author: Anande Theophilus Terfa             -->
<?php  include_once('metadatda.php'); ?>
  <title>Class Teacher Remark</title>
  <!-- Tell ethe browser to be responsive to screen width -->
  
 <?php  include_once('links.php'); ?>
<head>
   

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
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

<body>

<div class="col-lg-10" align="center"><?php
include_once('../msg/messages.php');
?></div><div class="clearfix"></div>
        <!-- Left Panel -->

   

        <div class="content mt-10">

          
 <div class="col-lg-10">
 
                    <div class="card">
                       <div class="btn btn-reddit btn-block"> <strong>Create Remarks E.g from min - max(0 - 40) exam average  is failed result, sit up</strong> </div>
                        <strong><hr></strong>
                       
                      
                      <div class="card-body card-block">
                        <form action="../Control_classes/schoolsetup_controller.php?action=createremark" method="post" enctype="multipart/form-data" class="form-horizontal" name="postForm" onSubmit="return ValidatePost();">
                           
                            
                           <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label"> Minimun Mark</label></div>
                            <div class="col-3 col-md-6"><input type="number" id="remark_min_mark" name="remark_min_mark" placeholder="E.g 0" class="form-control"   onKeyPress="return isNumber(event)" required></div>
                          </div>
 
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Maximun Mark</label></div>
                            <div class="col-3 col-md-6"><input type="number" id="remark_max_mark" name="remark_max_mark" placeholder="E.g 40 " class="form-control"   onKeyPress="return isNumber(event)" required></div>
                          </div>
                          
     
 
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Remark</label></div>
                            <div class="col-3 col-md-6"><textarea  name="remark" placeholder="E.g Very Poor Performance, Pls Sit Up" class="form-control"   required></textarea></div>
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
