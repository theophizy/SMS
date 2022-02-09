<!-- ==============================================
//  Created by PHP Dev Zone           			 ||
//	http://php-dev-zone.blogspot.com             ||
//  Contact for any Web Development Stuff        ||
//  Email: ketan32.patel@gmail.com     			 ||
//=============================================-->
<link type="text/css" href="css/style.css" rel="stylesheet"/>


<?php 
require_once('../classes/class.Students.php');
$student = new Students();
$student->student_class = $student->Escape($_GET['armid']);

?>
<select name="classarm" class="form-control" onChange="getstudent(this.value)" required>
<option value="0">Select class arm</option>
<?php foreach($student->viewStudentbyClass() as $key => $val) { 

?>
<option value="<?php echo $val['student_classarm']?>"><?php echo $val['class_arm_name']?></option>
<?php 
 

} ?>
</select><font color="#FF0000">*</font>
