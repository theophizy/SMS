<?php
require_once('../classes/class.subject_class.php');
require_once('../classes/class.Subject.php');

//include_once('../classes/class.students.php');
$subject=new Subject();
$subject_classes = new Subject_class();

?>


<!-- Author: Anande Theophilus Terfa             -->
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->

 
<body>
<select name="subject" class="form-control" placeholder="select subject">
<option value=""></option>
<?php
$armid=$_POST['armid'];
$classid=$_POST['classid'];
if(isset($_POST['transferresult'])){
	foreach($subject_classes->binded_subject_class_field($classid.$armid) as $key => $val){
		?>
        <option value="<?php echo $val['class_sub_subject_code'] ?>"><?php echo $val['subject_name'] ?></option>
<?php        
}}else{
	if(isset($_POST['nochanges'])){
	$subject->subjectSelectField();	
	}}
?>
</select>
</body>
</html>