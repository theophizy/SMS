<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<center >
	<table border=1 style=" max-width:2480px; width:100%" >
		<tr>
		<td>
			<table  width=100%>
			<tr>
				<td>
					<img src='images.jpg' width=120 height=120>
				</td>
				<td>
					<b><font size='5'>CENTRAL BOARD OF HIGHER EDUCATION gs xgax yabsdhyas  gysada dsgydsw yu yd</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><br><br>
					
				</td>
                <td>
               <img src='images.jpg' width=100 height=100>
               </td>
			</tr>
           
			</table>
		</td>
		</tr>
		<tr>
		<td>
			<table style="width:100%;" bgcolor="#7woh">
            <tr><td><table style="width:80%;">
				<tr><td>NAME:</td><td>Theophilus TERFA ANANDE</td><td>CLASS:</td><td>JSS2A</td><td>TERM:</td><td>THIRD TERM</td></tr>
				</table></td><td>
                <table style="width:80%">
				<tr><td>SESSION</td><td>2020/2021</td> <td>ATTENDANCE:</td><td>75%</td><td>POSITION:</td><td>1ST</td></tr>
				
                </table>
                </td></td></tr>
                <tr><td><table style="width:100%;">
				<tr><td>NAME:</td><td>Theophilus TERFA ANANDE</td><td>CLASS:</td><td>JSS2A</td><td>TERM:</td><td>THIRD TERM</td></tr>
				</table></td></td></tr>
			</table>
		</td>
		</tr>
		<tr>
		<td>
			<table border=1 width=100%>
           
				<tr><th><i>S/N</i></th><th><i>Subject name</i></th><th><i>CA1</i></th><th><i>CA2</i></th><th><i>EXAM</i></th><th><i>MAK OBTAINED</i></th><th><i>MARKS OBTAINED</i></th><th><i>MAX MARKS</i></th><th><i>HIGEST IN CLASS</i></th><th><i>LOWEST IN CLASS</i></th><th><i>POSITION IN CLASS</i></th><th><i>REMARK</i></th></tr>
    <?php  
	for($i=0; $i<=10; $i++){
		$secondrowcolor =  "#999";
		$firstrowcolor = "#C000";
		$bg_color = $i%2 == 0 ? $firstrowcolor: $secondrowcolor;
		
		 ?>
				<tr bgcolor="<?php echo $bg_color  ?>"><td>101</td><td>Hindi</td><td>35</td><td>100</td><td></td><td></td><td>101</td><td>Hindi</td><td>35</td><td>100</td><td></td><td></td></tr>
               
        
         <?php } ?>       
				
				<tr><td></td><td></td><td><b>Total</b></td><td><b>400</b></td><td></td><td></td></tr>
			</table>
		</td>
		</tr>

		<tr>
		<td>
			<table>
				<tr><td><b><font size='4'>Result:&nbsp;&nbsp;&nbsp;&nbsp;</font></b></td></tr>
			</table>
		</td>
		</tr>
	</table>
    <button onclick="window.print();" >print</button>
</center>


</body>
</html>
