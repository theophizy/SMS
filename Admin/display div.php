<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<a onclick="switchView('student.php')">Students</a>
<div class="md-col-12" id="container"></div>
</body>
<script>
function switchView(view)
{
$.get(
{
	url: view,
	cache: false,
}
)
.then(function (data)
 {
	 $("#container").html(data);

 });
}
</script>
</html>