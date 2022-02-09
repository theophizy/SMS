<?php
include('class.Database.php');
//include('../includes/constants.inc.php');
class Article extends Database{
public $article_id;
public $article_title;
public $article_content;
public $image;
public $status=1;
public $date_posted;
public $query;



 function article($article_id='',$article_title='',$article_content='',$image='',$status=1,$date_posted=''){
	$this->article_id=$article_id;
	$this->article_title=$article_title;
	$this->article_content=$article_content;
	$this->image=$image;
	$this->status=$status;
	$this->date_posted=$date_posted; 
 }
 //mutator

 public function __construct()
	{
		parent::__construct();
	}
	
 
	function GetArticle($article_id){
		$this->query="SELECT * FROM `breaking_news` WHERE `article_id`='".$this->Escape($article_id)."'";
	//invoke method to return the array of the fetched result from the database class
		
		foreach($this->Resultset($this->query) as $key=>$value){
		$this->article_id=$value['article_id'];
		$this->article_title=$value['article_title'];
		$this->article_content=$value['article_content'];
		$this->image=$value['image'];
		$this->status=$value['status'];
		$this->date_posted=$value['date_posted'];
			
	}
	return $this;
	}
	function ArticleList(){
		
		 $msg="";
		$this->query="SELECT * FROM `breaking_news` ";
		 
		$msg=' <div class="card-header" id="dataTabless">
                        <strong>View Article</strong> 
                      </div>
					         
 <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
<div class="card">
                        
                        <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                      <th>#</th>
                       <th>Image</th>
                        <th> Article Title</th>
                         <th>Content </th>
      
                        <th>Date Posted</th>
                        <th>Article Status</th>
                        <th>Action </th>
						<th></th>
                       
                      </tr>
                    </thead>
                    <tbody>
                      ';
					  $sno=1;
					  $onclick="Deleted?";
		foreach( $this->Resultset($this->query) as $key=>$value){
			$msg.='
			
		   <tr>
                      <td>'.  $sno++.'</td>
                       <td><img src="'.substr($value['image'],3).'" width="50" height="50"></td>
                        <td>'.   $value['article_title'].'</td>
                        <td>'.substr($value['article_content'],0,25).'...</td>
                        <td>'.$value['date_posted'].'</td>
                         
                           <td>'.$this->printStatus($value['status']).'</td>
                          
						   
						  
						  
                          <td><a  title="Delete comment" href="?action=detelearticle&id='. $value['article_id'].'" ><i class="fa fa-trash btn btn-danger"></i></a></td>
						    <td><a  title="Edit article" href="edit.php?action=Edit&id='. $value['article_id'].'" ><i class="fa fa-pencil btn btn-primary"></i></a></td>
                           
                          
                      </tr>'; 
					  }
					  $msg.='
                    </tbody>
                  </table>
                        </div>
                    </div></div></div></div>';	
		return $msg;
	}
	//return status as string
	function printStatus($status){
		return ($status==1)?'Active':'Deactivated';
	}
	//function for both create and update article
	function Save(){
	$this->query="SELECT `article_id` FROM `breaking_news` WHERE `article_id`='".$this->article_id."' LIMIT 1";
	$number_rows=$this->Query($this->query);
	if($number_rows>0){
		//if an image is not selected
		if(!empty($this->image)){
		$this->query="UPDATE `breaking_news` SET `article_title`='".$this->Escape($this->article_title)."',`article_content`='".$this->Escape($this->article_content)."',`image`='".$this->Escape($this->image)."',`status`='".$this->Escape($this->status)."',`date_posted`='".$this->Escape($this->date_posted)."' WHERE `article_id`='".$this->article_id."'";
		}else{
			//when an image is selected
		$this->query="UPDATE `breaking_news` SET `article_title`='".$this->Escape($this->article_title)."',`article_content`='".$this->Escape($this->article_content)."',`status`='".$this->Escape($this->status)."',`date_posted`='".$this->Escape($this->date_posted)."' WHERE `article_id`='".$this->article_id."'";	
		}
		
	}else{
	$this->query="INSERT INTO `breaking_news`(`article_id`,`article_title`,`article_content`,`image`,`status`,`date_posted`) VALUES('".$this->Escape($this->article_id)."','".$this->Escape($this->article_title)."','".$this->Escape($this->article_content)."','".$this->Escape($this->image)."','".$this->Escape($this->status)."','".$this->Escape($this->date_posted)."')";	
	}
	$insertid=$this->InsertOrUpdate($this->query);
	return $insertid;
	}
	function Delete(){
		 
				$this->query="DELETE FROM `breaking_news` WHERE `article_id`='".$this->Escape($this->article_id)."'";
		return $this->Reader($this->query);
		
	}
	//check if primary key exist to avoid mysql duplicate error 
	function AvoidDuplicate(){
		$this->query="SELECT * FROM breaking_news WHERE `article_id` = '".$this->article_id."'";
		return $this->Query($this->query); 
	}
	//populate controller select field
	function Controllerselectfieild(){
		
		$this->query="SELECT * FROM controllers";
		
		
	$msg='<select data-placeholder="" class="form-control"  tabindex="1" name="controller">
                                  <option value=""></option> ';
                                   
								   foreach($this->Resultset($this->query) as $key=> $value){
								   
								   $msg.='<option value="'.  $value['controller_id'].'">'.  $value['name'].'</option>';
								   }
                                
                                $msg.='</select>';	
		 
		 return $msg;	
		 }
		 
		
		function Articleselectfieild(){
		
		$this->query="SELECT * FROM `breaking_news`";
								 						 
		$msg='<select data-placeholder="" class="form-control"  tabindex="1" name="controller" id="article_id">
                                  <option value=""></option> ';
                                   
								   foreach($this->Resultset($this->query) as $key=> $value){
								   
								   $msg.='<option value="'.  $value['article_id'].'">'.  $value['article_id'].'</option>';
								   }
                                
                                $msg.='</select>';	
		 
		 return $msg;	
		 }
		 function GeneralViewList($sql){
		
		$this->query=$sql;
								 						 
		 return  $this->Resultset($this->query);
								   
		 
		 }
		 
}
?>