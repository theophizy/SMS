 <?php session_start();
if(!isset($_SESSION['USERNAME'])){
echo "<script>
location='../'
</script>";	
}


$role = $_SESSION["ROLE"];
 ?>