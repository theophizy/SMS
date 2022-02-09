<!-- ==============================================
//  Created by PHP Dev Zone           			 ||
//	http://php-dev-zone.blogspot.com             ||
//  Contact for any Web Development Stuff        ||
//  Email: ketan32.patel@gmail.com     			 ||
//=============================================-->
<link type="text/css" href="css/style.css" rel="stylesheet"/>


<?php 
require_once('../classes/class.subject_class.php');

$subject_classes = new Subject_class();

//bind class arm selected to its variable
$subject_classes->class_sub_class_arm=$subject_classes->Escape($_GET['classid']);
?>
<select name="subject" class="form-control">
<option>Select Subject</option>
<?php foreach($subject_classes->binded_subject_class_field() as $key => $val) { 
?>
<option value="<?php echo $val['class_sub_subject_code']?>"><?php echo $val['subject_name']?></option>
<?php 
 $_SESSION['subjectselected'] = $val['subject_name'];
  } ?>
</select><font color="#FF0000">*</font>
