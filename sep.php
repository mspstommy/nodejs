<?php
	//有用的範例
	$var = "var";
	$type = "string";

	if ($type == 'string'){
	$var = isset($var) ? filter_var($var,FILTER_SANITIZE_MAGIC_QUOTES) : '';
}elseif ($type == 'url'){
	$var = isset($var) ? filter_var($var,FILTER_VALIDATE_URL) : '';
}elseif ($type == 'email'){
	$var = isset($var) ? filter_var($var,FILTER_VALIDATE_EMAIL) : '';
}else {
	$var = isset($var) ? filter_var($var,FILTER_SANITIZE_NUMBER_INT) : '';
}

	$_POST['goods_title']= "牛角麵包";
	$_POST['goods_content']="一種用奶油烘烤出來的西式麵點";
	$_POST['goods_price']=100;
	$_POST['goods_sn']=1;
	//模擬表單送出後取得的變數
	foreach ($_POST as $key =>){
	$$key =filter_var($val, FILTER_SANITIZE_MAGIC_QUOTES);
	echo "{$key} = {$$key}";

	//觀看某一筆資料
	function display_goods($goods_sn='')
	{
	global $mysqli, $smarty;

	$sql="SELECT * FROM 'goods' WHERE 'goods_sn'='{$good_sn}'";
	$result = $mysqli->query($sql) or die($mysqli->connect_error);
	$goods=$result->fetch_assoc();
	$goods['pic']=get_goods_pic($goods_sn);
	$smarty->assign('goods_sn',$goods_sn);
	$smarty->assign('goods',$goods);
}
}
?>
<?php
	//筆記
	echo date("Y-m-d H:i:s"); //年月日 時分秒
	phpinfo(); //php基本設定 支援的延伸功能
	$var = "VAR";//字串用雙引號或單引號都可以 變數開頭大小寫不同為不同變數 變數名稱可以用底線為字首 可以用中文或特殊符號當變數名稱
	echo "用GET請求而來的變數{$_GET['var']}";
	echo "用POST請求而來的變數{$_POST['var']}";
	echo "{$_REQUEST['var']}"; //用$_REQUEST接收來自get post cookie的變數
	/*超級全域變數:$GLOBALS
		       $_SERVER
		       $_GET
		       $_POST
		       $_COOKIE
		       $_REQUEST
		       $_FILES
		       $_ENV
		       $_SESSION
*/
	/*預定義常數:__LINE__
		     __FILE__
		     __DIR__
		     __FUNCTION__
		     __CLASS__
		     __TRAIT__
		     __METHOD__
		     __NAMESPACE__
*/

?>
