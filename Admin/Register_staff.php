<?php include_once("sessionStart.php"); 

 include_once('metadatda.php') ?>;
  <title>Register Staff</title>
  <!-- Tell ethe browser to be responsive to screen width -->
  <link rel="stylesheet" href="dist/css/stepform.css">
 <?php  include_once('links.php'); ?>
 
<head>
 
  
  
  <script type="text/javascript">
  
 
setTimeout(function(){
    $('#msgdiv').fadeOut('slow');
    
}, 4000);
</script>
</head>
<?php include_once('navBar.php'); ?>
<body>
<form id="regForm" action="../Control_classes/staff_controller.php" name="formVal" enctype="multipart/form-data" style="margin-top:1px;">
 <div class="col-md-12" align="center">
 <div class="btn btn-reddit btn-block"> <strong>STAFF REGISTRATION FORM:</strong> </div>
                     
                       
<div class="col-lg-10" align="center" id="msgdiv"><?php
include_once('../msg/messages.php'); ?>
</div>

  <!-- One "tab" for each step in the form: -->
  <div class="tab">Personal Info:
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
    <div class=" col-md-9"> <input type="date"  oninput="this.className = ''" name="date_birth" class="form-control"></div></div></p><br><br>
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
    <div class=" col-md-9"> <input type="date"  oninput="this.className = ''" name="year_graduation" class="form-control"></div></div></p><br><br>
       <p>
     <div class=" form-group">
     <div class=" col-md-3"><strong>Year of Appointment</strong></div>
      <div class=" col-md-9"> <input type="date"  oninput="this.className = ''" name="apointment_date" class="form-control"></div></div> </p><br><br><br><br>
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
</div>
</form>
 <?php include_once('footer.php'); ?>
          <?php include_once('footrJScripts.php'); ?>
<script src="dist/js/stepform.js"></script>
</body>

</html>
