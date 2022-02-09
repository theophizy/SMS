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
$subject_classes->class_sub_class_code=$subject_classes->Escape($_GET['armid']);


?>
<select name="classarm" class="form-control" onChange="getsubject(this.value)" required>
<option value="0">Select class arm</option>
<?php foreach($subject_classes->binded_subject_classarm_field() as $key => $val) { 

?>
<option value="<?php echo $val['class_sub_class_arm']?>"><?php echo $val['class_arm_name']?></option>
<?php 
 

} ?>
</select><font color="#FF0000">*</font>
