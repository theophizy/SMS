<?php include_once("sessionStart.php"); ?>
<?php

require_once('../classes/class.school_setup.php');

$school_setup = new SchoolSetup();

?>
<!-- Author: Anande Theophilus Terfa             -->
<?php  include_once('metadatda.php'); ?>
  <title> Next Term Beginning </title>
  <!-- Tell ethe browser to be responsive to screen width -->
  
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

          
 <div class="col-lg-10">
 
                    <div class="card">
                      <div class="btn btn-reddit btn-block"> <strong>Next Term Begin</strong> </div>
                        <strong><hr></strong> 
                     
                      
                      <div class="card-body card-block">
                        <form action="../Control_classes/schoolsetup_controller.php?action=createnextterm" method="post" enctype="multipart/form-data" class="form-horizontal" name="postForm" onSubmit="return ValidatePost();">
                           
                            
                           
 
                          <?php
						 foreach($school_setup->viewNextTermBegin() as $key => $val){
						 $dob = $val['next_date']; 
	 $orderdate = explode('/',$dob);
	 ?>
      <div class="row form-group">
      <input type="hidden" name="next_id" value="<?php echo $val['next_id']; ?>">
      <div class=" col-md-3"><strong>Next Term Begin</strong></div>
    <div class=" col-md-3"><select name="day" onselect="this.className" class="form-control" required >
     <option value="<?php echo $orderdate[0]; ?> "><?php echo $orderdate[0]; ?></option> 
    <?php for ($day = 1; $day <= 31; $day++) { ?>
	<option value="<?php echo strlen($day)==1 ? '0'.$day : $day; ?>"><?php echo strlen($day)==1 ? '0'.$day : $day; ?></option>
    	<?php } ?>
     </select>
     </div>
     <div class=" col-md-3"><select name="month" onselect="this.className" class="form-control" required >
    <option value="<?php echo $orderdate[1]; ?>"><?php echo $orderdate[1]; ?></option>
    <?php for ($month = 1; $month <= 12; $month++){ ?>
	<option value="<?php echo strlen($month)==1 ? '0'.$month : $month; ?>"><?php echo strlen($month)==1 ? '0'.$month : $month; ?></option>
	<?php } ?>
     </select></div>
    <div class=" col-md-3">
     <select name="year" onselect="this.className" class="form-control" required >
      <option value="<?php echo $orderdate[2]; ?>"><?php echo $orderdate[2]; ?></option> 
     <?php for ($year = date('Y'); $year > date('Y')-100; $year--) { ?>
	<option value="<?php echo $year+1; ?>"><?php echo $year+1; ?></option>
	<?php } ?>
     </select></div></div></p>
    	<?php } ?>
         
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
