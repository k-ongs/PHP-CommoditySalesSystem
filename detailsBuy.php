<?PHP
    include 'att.php';
	include 'conn.php';
    include 'functions.php';
    @$id = (int)$_GET['id'];
    @$num = (int)$_GET['num'];
    @$type = (int)$_GET['type'];
    $num = $num == 0 ? 1 : $num;
    $type = ($type == 0 || $type == 1) ? 1 : 2;
    $userinfo = select($mysql,'tb_s_user', 'where uId=' . $_SESSION['userId']);
	if(!$userinfo)
        die('用户信息查询失败！');
    $userinfo = $userinfo[0];
    $comInfo = select($mysql, 'tb_commodity', 'where cId=' . $id);
    if(!$comInfo)
        die(backMsg('该商品不存在！'));
    $comInfo = $comInfo[0];
    if($num > $comInfo['stock'])
        die(backMsg('购买的数量超过了库存！'));
    if($num * $comInfo['price'] > $userinfo['balance'])
        die(backMsg('对不起，您的余额不足！'));

    if(!is_int(update($mysql, 'tb_commodity', array('sales'=>'sales+1'), 'where cId=' . $id)))
        die(backMsg('购买失败！'));
    if(is_int(insert($mysql, 'tb_user_order', array('uId'=>$_SESSION['userId'],'cId'=>$comInfo['cId'],'num'=>$num, 'type'=>$type, 'date'=>date("Y-m-d m:s:i")))))
        die(jumpMsg('购买成功！','orders.php'));
    else
        die(backMsg('购买失败！'));
?>