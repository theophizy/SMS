<?php  
include_once ('../classes/class.article.php');
include_once ('../classes/class.Database.php');
//include_once ('../Admin/links.php');
$addnew_article=new Article();
	$database=new Database();
	$outputmsg=$addnew_article->outputmsg;
/**
* *********************Adding New Staff /NonStaff *******************
*/

$action=$_GET['action'];


switch($action){

	case "createpost":
		
	if (isset($_POST['post']) ){
	 //set values to the variables
		$addnew_article->article_id=$database->GenCode(6);
	
	if (isset($_POST['post_title'])){
		$addnew_article->article_title=$_POST['post_title'];
	}
	
	if (isset($_POST['post_body'])){
		$addnew_article->article_content =$_POST['post_body'];;
	}
	
		$addnew_article->status= 1;
	
	
	
	$addnew_article->date_posted=date('Y/m/d');
	
	$image = $_FILES['file']['name'];
		if(is_uploaded_file($_FILES['file']['tmp_name'])) {	
			//$ext=explode(".",$_FILES['file']['name']);
			$extension = strtolower(substr($image,strpos($image,".")+1));
			$updir = "../imageupload/";
			$size =$_FILES["file"]["size"];
			$uppath ="$updir$image";
			$maximun_size=134642;//92458;
			$picture_size=floor($maximun_size/1024);
			if($extension!='jpg' && $extension!='png' && $extension!='jpeg' && $extension!='gif' && $image!==""){
			 header("location:../Admin/create_article.php?err=1");
			exit;
			}elseif($size>$maximun_size){
				 header("location:../Admin/create_article.php?err=2");
			exit;
			}else{
			move_uploaded_file($_FILES['file']['tmp_name'],$updir.$image);
			$image_insert=$uppath;
			}
		}
		
		
	$addnew_article->image = $image_insert;
	 
	 $getarticle=$addnew_article->AvoidDuplicate(); 

	 if( isset($getarticle)&& $getarticle>0) {
			
	  header("location:..Admin/create_article.php&err=3");
		} 
	 else {

   $insetid = $addnew_article->Save();
  if($insetid==true){

	
	header("location:../Admin/create_article.php?emsg=1");
	
	
			exit;
  }else{
	 	 header("location:../Admin/create_article.php?err=10");
 exit;
  }
 
		  }
		
	    }
break;
	case "deletearticle":
	$addnew_article->article_id=$_GET['id'];
	$deleted=$addnew_article->Delete();
	 if($deleted==true){
	  
		 	 header("location:?pid=2&action=View_articles&emsg=3");
			exit;
  }else{
	 header("location:?pid=2&action=View_articles&err=10");
  }
  exit;
  case "Edit_article":
  
  if (isset($_POST['post']) ){
	 //set values to the variables
	 
		$addnew_article->article_id=$_GET['id'];
	
	if (isset($_POST['post_title'])){
		$addnew_article->article_title=$_POST['post_title'];
	}
	
	if (isset($_POST['post_body'])){
		$addnew_article->article_content =$_POST['post_body'];
	}
	
		$addnew_article->status= 1;
	
	
	
	$addnew_article->date_posted=date('Y/m/d');
	if(isset($_FILES['file']['name'])){
	$image = $_FILES['file']['name'];
		if(is_uploaded_file($_FILES['file']['tmp_name'])) {	
			//$ext=explode(".",$_FILES['file']['name']);
			$extension = strtolower(substr($image,strpos($image,".")+1));
			$updir = "../imageupload/";
			$size =$_FILES["file"]["size"];
			$uppath ="$updir$image";
			$maximun_size=134642;//92458;
			$picture_size=floor($maximun_size/1024);
			if($extension!='jpg' && $extension!='png' && $extension!='jpeg' && $extension!='gif' && $image!==""){
				 header("location:?pid=3&action=createpost&err=1");
			exit;
			}elseif($size>$maximun_size){
				 header("location:?pid=3&action=createpost&err=2");
			exit;
			}else{
			move_uploaded_file($_FILES['file']['tmp_name'],$updir.$image);
			$image_insert=$uppath;
			}}
		
		
		
	$addnew_article->image = $image_insert;
	
	}


   $insetid = $addnew_article->Save();
  if($insetid==true){
	
		 header("location:?pid=2&emsg=2");
			exit;
  }else{
		 header("location:?pid=3&action=createpost&err=10"); 
  }
  exit;
	 }
}
?>