<?php include_once("sessionStart.php"); ?>

<?php  include_once('metadatda.php'); ?>
  <title>Change Password</title>
  <!-- Tell the browser to be responsive to screen width -->
  
 <?php  include_once('links.php'); ?><head>
   

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
                     <div class="btn btn-reddit btn-block"> <strong>Change Password</strong> </div>
                     <h3><strong><hr></strong></h3>
                      
                      <div class="card-body card-block">
                       <form method="POST" action="../Control_classes/user_controller.php?action=changePassword">
				<div class="modal-header">
					<h3 class="modal-title">Change Password </h3>
				</div>
				<div class="modal-body">
					
					  <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Old Password </label></div>
                          <input type="hidden" id="username" name="username" class="form-control" value="<?php echo $_SESSION['USERNAME']; ?>" > 
                            <div class="col-3 col-md-9"><input type="password" id="" name="old_password" class="form-control"   required></div>
                          </div>
                          
					  <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">New Password </label></div>
                           
                            <div class="col-3 col-md-9"><input type="password" id="" name="new_password" class="form-control"   required></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Confirm New Password </label></div>
                           
                            <div class="col-3 col-md-9"><input type="password" id="" name="confirm_password" class="form-control"   required></div>
                          </div>
				
				<div class="modal-footer">
                <div class="row form-group">
                <div class="col col-md-3"></div>
					<div class="col col-md-9"><button name="update" type="submit" class="btn btn-primary btn-block"></span> Submit</button></div>
					<div class="col col-md-3"></div>
                    </div></div>
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
