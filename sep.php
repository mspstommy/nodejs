<?php
	//���Ϊ��d��
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

	$_POST['goods_title']= "�����ѥ]";
	$_POST['goods_content']="�@�إΥ��o�M�N�X�Ӫ��覡���I";
	$_POST['goods_price']=100;
	$_POST['goods_sn']=1;
	//�������e�X����o���ܼ�
	foreach ($_POST as $key =>){
	$$key =filter_var($val, FILTER_SANITIZE_MAGIC_QUOTES);
	echo "{$key} = {$$key}";

	//�[�ݬY�@�����
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
	//���O
	echo date("Y-m-d H:i:s"); //�~��� �ɤ���
	phpinfo(); //php�򥻳]�w �䴩�������\��
	$var = "VAR";//�r������޸��γ�޸����i�H �ܼƶ}�Y�j�p�g���P�����P�ܼ� �ܼƦW�٥i�H�Ω��u���r�� �i�H�Τ���ίS��Ÿ����ܼƦW��
	echo "��GET�ШD�ӨӪ��ܼ�{$_GET['var']}";
	echo "��POST�ШD�ӨӪ��ܼ�{$_POST['var']}";
	echo "{$_REQUEST['var']}"; //��$_REQUEST�����Ӧ�get post cookie���ܼ�
	/*�W�ť����ܼ�:$GLOBALS
		       $_SERVER
		       $_GET
		       $_POST
		       $_COOKIE
		       $_REQUEST
		       $_FILES
		       $_ENV
		       $_SESSION
*/
	/*�w�w�q�`��:__LINE__
		     __FILE__
		     __DIR__
		     __FUNCTION__
		     __CLASS__
		     __TRAIT__
		     __METHOD__
		     __NAMESPACE__
*/

?>
