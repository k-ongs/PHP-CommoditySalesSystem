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
        die(backMsg('加入购物车的数量超过了库存！'));

    if(is_int(insert($mysql, 'tb_user_shop', array('uId'=>$_SESSION['userId'],'cId'=>$comInfo['cId'],'nums'=>$num, 'type'=>$type))))
        die(jumpMsg('加入购物车成功！','shops.php'));
    else
        die(backMsg('加入购物车失败！'));
?>