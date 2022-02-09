<?
class sqlOperation{
public function Rfectch(){
	return mysql_fetch_array;
}
public function SqlQ(){
	return mysql_query;
}
public function Rows(){
return mysql_num_rows;
}
public function StrposR($values){
	$strP=strpos($values,'.');
	return $strP;
}
public function SubstringR($subid){
	$substR=substr($subid,0,5);
	return $substR;
}
public function FormatCur($amount){
	$formated=number_format($amount,2,".",",");
	return $formated;
}
public function ExplodeR($exp){
	$explodeR=explode('.',$exp);
	return $explodeR;
}
public function str_splitR($split){
$splitid=str_split($split);
return $splitid;	
}
}
?>