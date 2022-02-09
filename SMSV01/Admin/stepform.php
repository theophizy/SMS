<?php
session_start();
if(!isset($_SESSION['USERNAME'])){
echo "<script>
location='../'
</script>";	
}
require_once('../classes/class.Classarm.php');
include_once('../classes/class.term.php');
//include_once('../classes/class.students.php');
$classarm=new ClassArm();
//$studentAction = new Students();
$studentclass = new StudentClasses();
$availableSession = new Session_class();
$term=new Term();


?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
  <link rel="stylesheet" href="dist/css/stepform.css">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  
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
<body>

<form id="regForm" action="../Control_classes/student_controller2.php" name="formVal" enctype="multipart/form-data">
<h1>STUDENT REGISTRATION FORM:</h1>
<div class="col-lg-10" align="center"><?php
include_once('../msg/messages.php'); ?>
</div>
  
  
<div class="clearfix"></div>
  <!-- One "tab" for each step in the form: -->
  <div class="tab">Personal Info: &nbsp;&nbsp;&nbsp;&nbsp;  Fields with <font color="#FF0000">*</font> are mandatory
   <p><input placeholder="Admission Number..." oninput="this.className = ''" name="student_regno" class="form-control"></p>
    <p><input placeholder="First name..." oninput="this.className = ''" name="first_name" class="form-control"></p>
    <p><input placeholder="Middle name...OR N/A if you do not have a middle name"  name="middle_name" class="form-control"></p>
    
     <p><input placeholder=" Last Name or Surname..." oninput="this.className = ''" name="last_name" class="form-control"></p>
     <p><input placeholder=" Nationality..." oninput="this.className = ''" name="nationality" class="form-control"></p>
     <p><input placeholder=" State of Origin..." oninput="this.className = ''" name="state_origin" class="form-control"></p>
     <p><input placeholder=" LGA..." oninput="this.className = ''" name="lga" class="form-control"></p>
     
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
     </select></div></div></p><br><br>
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
   <div class="tab">Admission infor:
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
    <p><input placeholder=" Guardian Name..." oninput="this.className = ''" name="guardian_name"></p>
     <p><input placeholder="Address..." oninput="this.className = ''" name="guardian_address"></p>
     <p><input placeholder="Phone..." oninput="this.className = ''" name="guardian_phone"></p>
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
<script src="dist/js/stepform.js"></script>

</html>
