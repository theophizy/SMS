<?php include_once("sessionStart.php"); ?>

<?php

//require_once('../classes/class.article.php');
require_once('../classes/class.Subject.php');
include_once('../classes/class.Classarm.php');

require_once('../classes/class.students.php');
$classarm = new ClassArm();
$studentAction = new Students();
$studentclass = new StudentClasses();




?>
<!-- Author: Anande Theophilus Terfa             -->
<?php  include_once('metadatda.php'); ?>
  <title>Import Students</title>
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
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
	
	function getarm(armid) {		
		
		var strURL="findarm.php?armid="+armid;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('classarmid').innerHTML=req.responseText;
												
					} else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
	function getsubject(classid) {		
		var strURL="findsubject.php?classid="+classid;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('subjectid').innerHTML=req.responseText;						
					} else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}
	function getCity(studentrec,subj) {		
		var strURL="findrecords.php?studentrec="+studentrec+"&subj="+subj;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('recdiv').innerHTML=req.responseText;						
					} else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}


setTimeout(function(){
    $('#displaydiv').fadeOut('slow');
    
}, 60000);
</script>
</head>
<?php include_once('navBar.php'); ?>

<body>

<div class="col-lg-10" align="center"><?php
include_once('../msg/messages.php');
?></div><div class="clearfix"></div>
        <!-- Left Panel -->

   

        <div class="content mt-12">

          
 <div class="col-lg-12">
 
                    <div class="card">
                      <div class="card-header" align="center">
                      <div class="btn btn-reddit btn-block"> <strong>Import Students from excel. pls save your file in cvs format (CSV Format)</strong>
                        
                       
                      <a href="downloadcsv.php"  class="btn btn-info" >Download CSV Format</a>
                      </div> <strong><hr></strong> 
                      
                      <div class="card-body card-block">
                        <form action="../Control_classes/student_controller.php?action=createstudent" method="POST" enctype="multipart/form-data" class="form-horizontal" name="postForm" onSubmit="return ValidatePost();">
                           
                            
                           
 
                          <div class="row form-group">
                           <div class="col col-md-3">
                           <?php echo $studentclass->classSelectField(); ?><font color="#FF0000">*</font></div>                
<div class="col col-md-2">     
       <select name="classarm" onselect="this.className" class="form-control">
      
      <?php
	  
	  foreach($classarm->viewAllClassarm() as $key => $val){ 
	  ?>
     <option value="<?php echo $val['class_arm_code'] ?>"><?php echo $val['class_arm_name'] ?></option>
    
     <?php
	
	  } ?>
     </select>
     </div>
     <div class=" col-md-3">
     <select name="year" onselect="this.className" class="form-control" required >
      <option value="">Year Addmitted </option>
     <?php for ($year = date('Y'); $year > date('Y')-100; $year--) { ?>
	<option value="<?php echo $year; ?>"><?php echo $year; ?></option>
	<?php } ?>
     </select></div>
       <div class="col col-md-3"> 
                           
                             <input type="file" name="file" id="file" required  class="form-control"></div>
                         
                          
     
                          
                          
                         
                         <div class="col col-md-1"> 
                           <!--<i class="fa fa-circle-o-notch fa-spin"></i>-->
                          <input type="submit" id="sub" name="post" value="Save" class="btn btn-success"> </div>
                         
                        </form>
                      </div>
                     
                    </div>
           
                <!-- /# card -->
            </div>
           
        </div> <!-- .content -->
         <?php
				if(isset($_GET['student_class'])){
			$studentAction->student_class = $_GET['student_class'];
			
			$studentAction->student_classarm = $_GET['student_class_arm'];
		
			?>
  <div class="btn btn-default" style="float:left;" id="displaydiv"><i class="fa fa-check"></i>
 <P>Students successfully imported</P>
 <?php  
 if(!empty($studentAction->viewStudentbyClassandClassarm())){
 foreach($studentAction->viewStudentbyClassandClassarm() as $key => $val){
	
	?>
   <p>
     <?php echo $val['student_regno']."   ".$val['last_name']." ".$val['first_name']?></p>

<?php  }}else{
	echo "Imported Students Already Exist";
	}} ?>
</div>
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

     <?php include_once('footer.php'); ?>
          <?php include_once('footrJScripts.php'); ?>
</body>
</html>
