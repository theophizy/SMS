<?php
include_once("sessionStart.php"); 

include_once('../classes/class.subject_class.php');

//require_once('../classes/class.students.php');
$subject_class = new Subject_class();
$studentclass = new StudentClasses();




//$studentAction = new Students();

?>
<!-- Author: Anande Theophilus Terfa             -->
<?php  include_once('metadatda.php'); ?>

  <title>Subject to Classes</title>

  <?php  include_once('links.php'); ?>
<?php include_once('navBar.php'); ?>

<body>

<div class="col-lg-10" align="center"><?php
include_once('../msg/messages.php');
?></div><div class="clearfix"></div>
        <!-- Left Panel -->

   

         <div class="content mt-12">

            <div class="btn btn-reddit btn-block"> <strong>List of Subjects Offered by the Selected Class</strong> </div>
                     
                        <strong><hr></strong>
 <div class="col-lg-12">
 
                    <div class="card">
                      <div class="card-header" align="center">
                       
                      </div>
                      
                      <div class="card-body card-block">
                        <form  action="" method="post" enctype="multipart/form-data" class="form-horizontal" name="postForm" onSubmit="return ValidatePost();">
                           
         <div class="row form-group">
                                      
   <div class="col col-md-6">
                           <select name="class" onChange="this.form.submit();" onselect="this.className" class="form-control" required >
      <option value="0">--Select Class--</option>
      <?php foreach($studentclass->viewAllClasses() as $key =>$val){
		  $studentclass->class_code = $val['class_code'];
		  $studentclass->viewclassByID()
		   ?>
     <option value="<?php echo $studentclass->class_code ?>"><?php  echo $studentclass->class_name?></option>
    
	   <?php } ?>
     </select></div>                
       
      
    <div class="col col-md-1">
     
                           
                           <!--<i class="fa fa-circle-o-notch fa-spin"></i>
                           <button  type="submit" id="sub" name="search" class=" btn btn-primary"><i  class="fa fa-search" ></i></button> </div>-->
                           </div></div>
</form>
    
 
      
   <?php
  
  // if(isset($_POST['search'])){
	   
		
		  if(isset($_POST['class'])){
			 $subject_class->class_sub_class_code = $_POST['class'];
		  }
		
		if(!empty($subject_class->binded_subject_class_field())){
		
		 
	//get Term  description using its id
		

	//$position_in_class = $createscore->position_in_class($login);
	
	
	//get total number of students who sat for exams in a term, session, class and class arm
	
   ?>
     
     <div class="table-responsive" >  
                     
                     <br />  
                   <div class="box">
            <div class="box-header">
               <div class="btn btn-reddit btn-block">CLASS:  <?php   $studentclass->class_code =  $subject_class->class_sub_class_code;
		  $studentclass->viewclassByID(); echo $studentclass->class_name; ?> </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th>#</th>
                      <th>Subject code</th>
                      <th> Subject Name</th>
                       
                      <th>Action</th>
                    
                    </tr>
                  </thead>
                 <tbody>
                 <tr>
                  <?php
				  $sn=1;
				  
                    
                  // if(!empty($studentAction->viewStudentbyClassandClassarm())){
 foreach($subject_class->binded_subject_class_field() as $key => $values){
							
							
						   //get sudent name by his/her admission number
						 
				
						  
				  ?>
                   
                      <td><?php echo $sn++;?></td>
                      <td><?php echo $values['class_sub_subject_code'] ;?></td>
                      <td><?php echo $values['subject_name'] ?></td>
 
                     
                   <td> <a href="../Control_classes/class_subject_controller.php?action=unbind_subject&bind_code=<?php echo  $values['class_sub_code']  ?> " title="Unbind Subject"  class="btn btn-danger" onClick="return confirm('Are you sure?')"><span class=" fa fa-trash"></span></a> 
                   
                   </td>
                     </tr>
                              
  
 <?php }//} ?>       
				
		
                  </tbody>
                </table>
  
 <?php }else{ echo "No Records Found for the Selected Items";} //} ?>
     
     </div>

        </div> <!-- .content -->
    </div><!-- /#right-panel -->
 

    <!-- Right Panel -->

    
     
    <?php include_once('footer.php'); ?>
 <?php include_once('footerTableScript.php'); ?>
</body>
</html>
