<?php
ini_set("display_errors",1);
error_reporting(E_ALL & -E_NOTICE);

class player {
	public $jersey_number = ""; //�y�縹�X
	public $name =  ""; //�y���W�r
	public $Pts = ""; //�o��
	function __construct(){
		$Pts = new Ptsd();
}
}
class Ptsd {
	public $__2ptM = ""; //����뤤
	public $__2ptA = ""; //�������
	public $__3ptM = ""; //�T���뤤
	public $__3ptA = ""; //�T������
	public $FtM = ""; //�@�y��
	public $Pta = ""; //�@�y����
}
$mysqli = new mysqli("localhost","root","crayon25","player");

if($mysqli->connect_errno)
	die("�L�k�إ߸�Ƴs��:".$mysqli->connect_error);

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