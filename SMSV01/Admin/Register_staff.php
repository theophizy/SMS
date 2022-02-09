<?php
session_start();
if(!isset($_SESSION['USERNAME'])){
echo "<script>
location='../'
</script>";	
}



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

<form id="regForm" action="../Control_classes/staff_controller.php" name="formVal" enctype="multipart/form-data">
 <div class="btn btn-reddit btn-block"> <strong>STAFF REGISTRATION FORM:</strong> </div>
                     
                        <strong><hr></strong> 
<div class="col-lg-10" align="center" id="msgdiv"><?php
include_once('../msg/messages.php'); ?>
</div>
  
  
<div class="clearfix"></div>

  <!-- One "tab" for each step in the form: -->
  <div class="tab">Personal Info: &nbsp;&nbsp;&nbsp;&nbsp; 
   <p><input placeholder="Staff Number..." oninput="this.className = ''" name="staff_id" class="form-control"></p>
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
      <option value="">YYY</option>
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
     <select name="marital" onselect="this.className" class="form-control" required >
      <option value="">Select your marital status</option>
     <option value="Single">Single</option>
     <option value="Married">Married</option>
     <option value="Divorce">Divorce</option>
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
   <div class="tab">Education Info:
   
     <p><input placeholder="Highest Qualification..." oninput="this.className = ''" name="qualification"></p>
     <p><input placeholder="Institution..." oninput="this.className = ''" name="staff_institution"></p>
      <p><input placeholder=" Course of study..." oninput="this.className = ''" name="staff_course"></p>
       <p>
     <div class=" form-group">
      <div class=" col-md-3"><strong>Year of Graduation</strong></div>
    <div class=" col-md-3"><select name="day_graduated" onselect="this.className" class="form-control" required >
      <option value="0">DD</option>
    <?php for ($day = 1; $day <= 31; $day++) { ?>
	<option value="<?php echo strlen($day)==1 ? '0'.$day : $day; ?>"><?php echo strlen($day)==1 ? '0'.$day : $day; ?></option>
    	<?php } ?>
     </select>
     </div>
     <div class=" col-md-3"><select name="month_graduated" onselect="this.className" class="form-control" required >
      <option value="0">MM</option>
    <?php for ($month = 1; $month <= 12; $month++){ ?>
	<option value="<?php echo strlen($month)==1 ? '0'.$month : $month; ?>"><?php echo strlen($month)==1 ? '0'.$month : $month; ?></option>
	<?php } ?>
     </select></div>
    <div class=" col-md-3">
     <select name="year_graduated" onselect="this.className" class="form-control" required >
      <option value="">YYYY</option>
     <?php for ($year = date('Y'); $year > date('Y')-100; $year--) { ?>
	<option value="<?php echo $year; ?>"><?php echo $year; ?></option>
	<?php } ?>
     </select></div></div></p><br><br>
       <p>
     <div class=" form-group">
      <div class=" col-md-3"><strong>Date of Apointment</strong></div>
    <div class=" col-md-3"><select name="apointment_day" onselect="this.className" class="form-control" required >
      <option value="0">DD</option>
    <?php for ($day = 1; $day <= 31; $day++) { ?>
	<option value="<?php echo strlen($day)==1 ? '0'.$day : $day; ?>"><?php echo strlen($day)==1 ? '0'.$day : $day; ?></option>
    	<?php } ?>
     </select>
     </div>
     <div class=" col-md-3"><select name="apointment_month" onselect="this.className" class="form-control" required >
      <option value="0">MM</option>
    <?php for ($month = 1; $month <= 12; $month++){ ?>
	<option value="<?php echo strlen($month)==1 ? '0'.$month : $month; ?>"><?php echo strlen($month)==1 ? '0'.$month : $month; ?></option>
	<?php } ?>
     </select></div>
    <div class=" col-md-3">
     <select name="apointment_year" onselect="this.className" class="form-control" required >
      <option value="">YYYY</option>
     <?php for ($year = date('Y'); $year > date('Y')-100; $year--) { ?>
	<option value="<?php echo $year; ?>"><?php echo $year; ?></option>
	<?php } ?>
     </select></div></div></p><br><br>
     
  </div>
  <div class="tab">Contact Info:
   
     <p><input placeholder="Address..." type="tex" oninput="this.className = ''" name="staff_address"></p>
     <p><input placeholder="Phone..." oninput="this.className = ''" name="staff_phone"></p>
      <p><input placeholder="  Email..." type="email" oninput="this.className = ''" name="staff_email"></p>
     
  </div>
  <div class="tab">Next of Kin Info:
    <p><input placeholder="  Name..." oninput="this.className = ''" name="nextofkin_name"></p>
     <p><input placeholder="Address..." oninput="this.className = ''" name="nextofkin_address"></p>
     <p><input placeholder="Phone..." oninput="this.className = ''" name="nextofkin_phone"></p>
      <p><input placeholder="  Email..." type="email" oninput="this.className = ''" name="nextofkin_email"></p>
     
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
  <?php for($i=1;$i<5;$i++){ ?>
    <span class="step"><?php echo $i;  ?></span>
    <?php  } ?>
    </div>

</form>


</body>
<script src="dist/js/stepform.js"></script>
</html>
