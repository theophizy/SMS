<?php
include_once("sessionStart.php"); 
require_once('../classes/class.term.php');
require_once('../classes/class.Session.php');
$term = new Term();
$availableSession = new Session_class();
?>
<!-- Author: Anande Theophilus Terfa             -->
<?php  include_once('metadatda.php'); ?>

  <title>Set Current Academic Session</title>

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
                      <div class="btn btn-reddit btn-block"> <strong>Set Current Term and Session</strong> </div>
                        <strong><hr></strong> 
                      </div>
                      
                      <div class="card-body card-block">
                        <form action="../Control_classes/term_controller.php?action=createcurrentterm" method="post" enctype="multipart/form-data" class="form-horizontal" name="postForm" onSubmit="return ValidatePost();">
                           
                            
                           
 
                          <?php
						   foreach($term->viewCurrentTermAndSession() as $key => $val){
						$term->term_code = $val['current_term'];
						$availableSession->session_code = $val['current_session'];
						$term->viewTermByID();
						$availableSession->viewSessionByID();
						
	 ?>
      <div class="row form-group">
      <input type="hidden" name="current_id" value="<?php echo $val['current_id']; ?>">
      <div class=" col-md-3"><strong>Current Term and Session </strong></div>
    <div class=" col-md-3"><select name="term" onselect="this.className" class="form-control" required >
     <option value="<?php echo $val['current_term']; ?> "><?php echo $term->term_name; ?></option> 
    <?php foreach ($term->viewAllTerm() as $key => $values) {
		$term->term_code = $values['term_code'];
		$term->viewTermByID();
		 ?>
	<option value="<?php echo $term->term_code; ?>"><?php echo $term->term_name; ?></option>
    	<?php } ?>
     </select>
     </div>
     <div class=" col-md-3"><select name="sessions" onselect="this.className" class="form-control" required >
    <option value="<?php echo $val['current_session']; ?>"><?php echo $availableSession->session_description; ?></option>
    <?php foreach($availableSession->viewAllSession() as $key => $values){ 
	$availableSession->session_code = $values['session_code'];
	$availableSession->viewSessionByID();
	
	?>
	<option value="<?php echo $availableSession->session_code; ?>"><?php echo $availableSession->session_description; ?></option>
	<?php } ?>
     </select></div>
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
