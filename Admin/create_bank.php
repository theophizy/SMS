<?php 
include_once("sessionStart.php"); 

 include_once('metadatda.php') ?>;
  <title>Create Bank</title>
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
                      
         <div class="btn btn-reddit btn-block"> <strong>Create Bank</strong> </div>
         <h3><strong><hr></strong></h3>
                      
                      <div class="card-body card-block">
                        <form action="../Control_classes/bank_controller.php?action=createbank" method="post" enctype="multipart/form-data" class="form-horizontal" name="postForm" >
                           
                            
                           
 
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Bank Code</label></div>
                            <div class="col-3 col-md-4"><input type="text" id="bank_code" name="bank_code" placeholder="E.g FBN" class="form-control"  onKeyUp="this.value=this.value.toUpperCase();" required></div>
                          </div>
                          
       <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Bank Name</label></div>
                            <div class="col-3 col-md-4"><input type="text" id="bank_name" name="bank_name" placeholder="E.g First Bank of Nigeria" class="form-control"  onKeyUp="this.value=this.value.toUpperCase();" required></div>
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
