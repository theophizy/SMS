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
$student->student_classarm  = $student->Escape($_GET['classarm']);


?>
<select name="admission_no" class="form-control" onChange="getsubject(this.value)" required>
<option value="0">Select Student</option>
<?php foreach($student->viewStudentbyClassarm() as $key => $val) { 
$student->student_regno = $val['student_regno'];
$student->viewStudentbyID();

?>
<option value="<?php echo $student->student_regno ?>"><?php echo $student->student_regno." ". $student->last_name;?></option>
<?php 
 

} ?>
</select><font color="#FF0000">*</font>
