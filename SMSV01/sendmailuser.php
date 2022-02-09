<?php
include("../../../Users/User/Desktop/xampprojects/Theo/healthcareersafrica/lib/config.php");
	
	//newly added 
	if(!$_SESSION['valid_user'])
	{
	header("Location: login.php");

    echo "<script>window.location='login.php'</script>";
	}	
	include("../../../Users/User/Desktop/xampprojects/Theo/healthcareersafrica/admin/privilage_file.php");	
	
	if($_REQUEST['access'])
	{
		echo"Access Denide User";
	}
	
	if($res_privilage['admin_type']=='1' || $res_privilage['admin_type']==null )
	{
		$titlepart = "Send mail to searched users";
	} else{
		$titlepart = "Send mail to searched users";
	}
	
	$leftmenuflag = "1";
	
if(isset($_REQUEST['sendmail'])) {
	$page=$_REQUEST['page'];
	$ids=explode(",",$_SESSION['mailidslist']);
	$emailcontent=mysql_real_escape_string($_REQUEST['emailcontent']);
	$emailcontent=str_replace("\r\n","",$emailcontent);
	$emailsubject=mysql_real_escape_string($_REQUEST['emailsubject']);
	
	// $page." - ".$_SESSION['mailidslist']." - ".$emailcontent." - ".$emailsubject;
	
	//require_once("../../../Users/User/Desktop/xampprojects/Theo/healthcareersafrica/mailer/class.phpmailer.php");
	
	$mailsubject=$emailsubject;
	//echo $emailcontent;
	 $msg=str_replace("\\r\\n","",$emailcontent);
	
	foreach($ids as $id) {
		$seekermail=$id;
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .=	'Return-Path: '.$website_team.' <'.$mail_url.'>' ."\r\n";
		$headers .= 'Return-Receipt-To: '.$website_team.' <'.$seekermail.'>' ."\r\n";
		$headers .= 'From: '.$website_team.' <'.$mail_url.'>'. "\r\n";
		
		//echo $msg."<br><br>";
		
		@mail($seekermail,$mailsubject,$msg,$headers);
		
		/*$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Host = "mail.rekruitin.com"; // SMTP server
		$mail->SMTPAuth = true;
		$mail->Username = "info@rekruitin.com";
		$mail->Password = "info123";
	
		$mail->From = $website_admin;
		$mail->FromName = $website_team;
	
		$mail->AddAddress($seekermail);
		$mail->AddReplyTo($website_admin);
		$mail->AddCustomHeader('Return-path:'.$website_admin);
		$mail->Sender = $website_admin;
		$mail->Subject = $mailsubject;
		$mail->Body = $msg;
		$mail->WordWrap = 50;
		$mail->Send();*/
	}
	header("Location:$page?mailsent");exit;
}
	include("../../../Users/User/Desktop/xampprojects/Theo/healthcareersafrica/admin/header.php");

?>
<script type='text/javascript' src='../../../Users/User/Desktop/xampprojects/Theo/healthcareersafrica/tinymce/jscripts/tiny_mce/tiny_mce.js'></script>
 <script type='text/javascript'>
	tinyMCE.init({
		// General options
		mode : 'textareas',
		theme : 'advanced',
		

		plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage,|,forecolor,backcolor,|,fullscreen",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : false,
		
		// Drop lists for link/image/media/template dialogs
		/*template_external_list_url : 'lists/template_list.js',
		external_link_list_url :'lists/link_list.js',
		external_image_list_url : 'lists/image_list.js',
		media_external_list_url : 'lists/media_list.js',*/

		// Style formats
		/*style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],*/

	});
</script>
<style type="text/css">
	h2 {
		font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
		font-size: 13pt;
		color: navy;
		padding-top: 12px;
		padding-bottom: 3px;
		margin:5px;
	}
	
	table tr td {
		padding:7px;
	}
	
	.emailidslist {
		width:100%;
		overflow-y: scroll;
		max-height:70px;
	}
	
	.emailidslist span {
		background-color:#CCEEFF;
		padding: 2px 8px;
		margin: 2px;
		border-radius: 5px;
		display: inline-block;
	}
</style>
<script language="javascript">
function validate() {
	// Saves all contents
	tinyMCE.triggerSave();
	//alert("ckdg");
	var emailsubject = document.getElementById('emailsubject').value;
	var emailcontent = document.getElementById('emailcontent').value;
	
	if(emailsubject=="") {
		alert("Enter the subject to continue!!!");
		return false;
	}
	
	if(emailcontent=="") {
		alert("Enter the messaeg content to continue!!!");
		return false;
	}
	
}
</script>
<fieldset style="width: 97%; margin-left: 8px;">
<legend style="margin-left: 12px; width: 62px;"><strong style="font-size:14px;">Mail edit</strong></legend>
<form action="../../../Users/User/Desktop/xampprojects/Theo/healthcareersafrica/admin/sendmailuser.php" name="search_seekers" method="post" style="padding:0;" onsubmit="return validate();">
<table>
<tr>
	<td>
		<div class="emailidslist">
			<?php 
			$ids=explode(",",$_SESSION['mailidslist']);
			$i=1;
			foreach($ids as $id) {
			?>
			<span><?=$i." - ".$id?></span>
			<?php $i++; } ?>
		</div>
	</td>
</tr>
<tr>
	<td>
		<span><strong>Email Subject :</strong></span>
		<input type="text" name="emailsubject" id="emailsubject" style="width:99%;" />
	</td>
</tr>
<tr>
	<td>
		<span><strong>Email Content :</strong></span>
		<textarea name="emailcontent" id="emailcontent" rows="30" cols="50"></textarea>
	</td>
</tr>
<tr>
	<td align="center">
		<input type="hidden" name="page" value="<?=$_REQUEST['page']?>" />
		<input type="submit" name="sendmail" value="Send Mail" />
		<input type="button" onclick="history.go(-1);" name="back" value="Back" />
	</td>
</tr>
</table>
</form>
</fieldset>