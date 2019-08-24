<?php
mysql_connect("localhost","root","crayon25");
mysql_select_db("work");
mysql_query("set names utf8");
$data=mysql_query("select * from member");
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>資料庫</title>
</head>

<body>
</body>
</html>
