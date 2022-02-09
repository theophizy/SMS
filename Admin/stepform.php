<?php
include_once("sessionStart.php"); 

require_once('../classes/class.Classarm.php');
include_once('../classes/class.term.php');
//include_once('../classes/class.students.php');
$classarm=new ClassArm();
//$studentAction = new Students();
$studentclass = new StudentClasses();
$availableSession = new Session_class();
$term=new Term();


?>

 <?php  include_once('metadatda.php'); ?>

  <title>Register Student </title>

  <link rel="stylesheet" href="dist/css/stepform.css">
  <?php  include_once('links.php'); ?>
  <head>
  <script type="text/javascript">
  function Validate(){
	  var password=document.formVal.pword.value;
	   var rpassword=document.formVal.rpword.value;
	   if(password!=rpasswrod){
	   alert('password mismatch');
	   document.formVal.rpassword.focus();
	   return false;
  }
  }
 
setTimeout(function(){
    $('#msgdiv').fadeOut('slow');
    
}, 4000);
</script>

</head>
<?php include_once('navBar.php'); ?>
<body>

<form id="regForm" action="../Control_classes/student_controller2.php" name="formVal" enctype="multipart/form-data" style="margin-top:1px;">
<div class="col-md-12" align="center">
<div class="btn btn-reddit btn-block"> <strong>STUDENT REGISTRATION FORM:</strong> </div>
<div class="col-lg-10" align="center"><?php
include_once('../msg/messages.php'); ?>
</div>
  
  
<div class="clearfix"></div>
  <!-- One "tab" for each step in the form: -->
  <div class="tab">Personal Info: &nbsp;&nbsp;&nbsp;&nbsp;  Fields with <font color="#FF0000">*</font> are mandatory
   
    <p><input placeholder="First name..." oninput="this.className = ''" name="first_name" class="form-control"><font color="#FF0000">*</font></p>
    <p><input placeholder="Middle name...OR N/A if you do not have a middle name"  name="middle_name" class="form-control"></p>
    
     <p><input placeholder=" Last Name or Surname..." oninput="this.className = ''" name="last_name" class="form-control"><font color="#FF0000">*</font></p>
     <p><input placeholder=" Nationality..." oninput="this.className = ''" name="nationality" class="form-control"><font color="#FF0000">*</font></p>
     <p><input placeholder=" State of Origin..." oninput="this.className = ''" name="state_origin" class="form-control"><font color="#FF0000">*</font></p>
     <p><input placeholder=" LGA..." oninput="this.className = ''" name="lga" class="form-control"><font color="#FF0000">*</font></p>
     
     <p>
     <div class=" form-group">
      <div class=" col-md-3"><strong>Date of Birth</strong></div>
    <div class=" col-md-3"><select name="day" onselect="this.className" class="form-control" required >
      <option value="0">DD</option>
    <?php for ($day = 1; $day <= 31; $day++) { ?>
	<option value="<?php echo strlen($day)==1 ? '0'.$day : $day; ?>"><?php echo strlen($day)==1 ? '0'.$day : $day; ?></option>
    	<?php } ?>
     </select>
     </div>
     <div class=" col-md-3"><select name="month" onselect="this.className" class="form-control" required >
      <option value="0">MM</option>
    <?php for ($month = 1; $month <= 12; $month++){ ?>
	<option value="<?php echo strlen($month)==1 ? '0'.$month : $month; ?>"><?php echo strlen($month)==1 ? '0'.$month : $month; ?></option>
	<?php } ?>
     </select></div>
    <div class=" col-md-3">
     <select name="year" onselect="this.className" class="form-control" required >
      <option value="">YYYY</option>
     <?php for ($year = date('Y'); $year > date('Y')-100; $year--) { ?>
	<option value="<?php echo $year; ?>"><?php echo $year; ?></option>
	<?php } ?>
     </select></div></div><font color="#FF0000">*</font></p><br><br>
     <p>
     <select name="sex" onselect="this.className" class="form-control" required >
      <option value="">Select your gender</option>
     <option value="Male">Male</option>
     <option value="Female">Female</option>
     </select>
     <font color="#FF0000">*</font>
     </p>
          <p>
          <select name="blood_group" onselect="this.className" class="form-control" >
          <option value="">Blood Group</option>
     <option value="A+">A+</option>
     <option value="A-">A-</option>
     <option value="B+">B+</option>
      <option value="B-">B-</option>
     <option value="AB+">AB+</option>
      <option value="AB-">AB-</option>
     <option value="O+">O+</option>
     <option value="O-">O-</option>
       
     </select>
     </p>

  </div>
   <div class="tab">Admission info:
    <p>
     <select name="year_admitted" onselect="this.className" class="form-control" required >
      <option value="">Year Addmitted </option>
     <?php for ($year = date('Y'); $year > date('Y')-100; $year--) { ?>
	<option value="<?php echo $year; ?>"><?php echo $year; ?></option>
	<?php } ?>
     </select><font color="#FF0000">*</font></p>
    <p><?php echo $studentclass->classSelectField(); ?><font color="#FF0000">*</font></p>
     <p><?php echo $classarm->classarmSelectField(); ?><font color="#FF0000">*</font></p>
      <p><?php echo $availableSession->sessionSelectField(); ?><font color="#FF0000">*</font></p>
       <p><?php echo $term->termSelectField(); ?><font color="#FF0000">*</font></p>
      <p><select name="student_class_admitted" onselect="this.className" class="form-control">
      <option>Class student was admitted into</option>
      <?php
	  
	  foreach($studentclass->viewAllClasses() as $key => $val){
	  ?>
     <option value="<?php echo $val['class_code'] ?>"><?php echo $val['class_name'] ?></option>
    
     <?php } ?>
     </select>
     <font color="#FF0000">*</font>
     </p>
     
  </div>
  <div class="tab">Guardian Info:
    <p><input placeholder=" Guardian Name..." oninput="this.className = ''" name="guardian_name"><font color="#FF0000">*</font></p>
     <p><input placeholder="Address..." oninput="this.className = ''" name="guardian_address"><font color="#FF0000">*</font></p>
     <p><input placeholder="Phone..." oninput="this.className = ''" name="guardian_phone"><font color="#FF0000">*</font></p>
      <p><input placeholder=" Guardian Email..." oninput="this.className = ''" name="guardian_email"></p>
     
  </div>
 <!--
  <div class="tab">Login Info:
    <p><input placeholder="Username..." oninput="this.className = ''" name="uname"></p>
    <p><input placeholder="Password..." oninput="this.className = ''" name="pword" type="password"></p>
    <p><input placeholder="Retype Password..." oninput="this.className = ''" name="rpword" type="password"></p>
  </div>
  -->
  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:30px;">
  <?php for($i=1;$i<4;$i++){ ?>
    <span class="step"><?php echo $i;  ?></span>
    <?php  } ?>
    </div>
    
</form>


</body>
<?php include_once('footer.php'); ?>
<script src="dist/js/stepform.js"></script>
    
          <?php include_once('footrJScripts.php'); ?>

</html>
