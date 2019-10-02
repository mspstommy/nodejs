<?php
ini_set("display_errors",1);
error_reporting(E_ALL & -E_NOTICE);

class player {
	public $jersey_number = ""; //球衣號碼
	public $name =  ""; //球員名字
	public $Pts = ""; //得分
	function __construct(){
		$Pts = new Ptsd();
}
}
class Ptsd {
	public $__2ptM = ""; //兩分投中
	public $__2ptA = ""; //兩分未中
	public $__3ptM = ""; //三分投中
	public $__3ptA = ""; //三分未中
	public $FtM = ""; //罰球中
	public $Pta = ""; //罰球未中
}
$mysqli = new mysqli("localhost","root","crayon25","player");

if($mysqli->connect_errno)
	die("無法建立資料連接:".$mysqli->connect_error);

$mysqli->query("SET NAMES utf8");

$in = $mysqli->query("SELECT * FROM ID from data"

$result = $mysqli->query("SELECT*FROM data WHERE M1 = '$in'");

echo"<table border ='1'align='center'><tr align='center'>";

while($field = $result->fetch_field())
	echo"<td>".$field->name."</td>";

echo"</tr>";

while($row = $result->fetch_row())
{
	echo"<tr>";
	for($i = 0;$i<$result->field_count;$i++)
		echo"<td>".$row[$i]."</td>";
	echo"</tr>";
}

echo"</table>";

$result->free();

$mysqli->close();
?>