<?PHP
    include 'att.php';
    @$mode = $_GET['mode'];
    include 'functions.php';
    if($mode == 'buy')
    {
        include 'conn.php';
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
        $userShop = select($mysql, 'tb_user_shop', 'where cId=' . $id . ' and uId=' . $_SESSION['userId']);
        if(!$userShop)
            die(backMsg('购物车中不存在该商品！'));
        $comInfo = $comInfo[0];
        if($num > $comInfo['stock'])
            die(backMsg('购买的数量超过了库存！'));
        if($num * $comInfo['price'] > $userinfo['balance'])
            die(backMsg('对不起，您的余额不足！'));
        
        $sql = 'update tb_commodity c,tb_s_user u set c.sales=c.sales+'.$num.',c.stock=c.stock-'.$num.',u.balance=u.balance-'.($num * $comInfo['price']).' where c.cId=' . $id . ' and u.uId='.$_SESSION['userId'];
        if(!$mysql->exec($sql))
            die(backMsg('购买失败！'));
        if(!is_int(insert($mysql, 'tb_user_order', array('uId'=>$_SESSION['userId'],'cId'=>$comInfo['cId'],'num'=>$num, 'type'=>$type, 'date'=>date("Y-m-d m:s:i")))))
            die(backMsg('购买失败！'));  
        if(delete($mysql,'tb_user_shop','where uId=' . $_SESSION['userId'] . ' and cId=' . $comInfo['cId']))
            die(jumpMsg('购买成功！','orders.php'));
    }else if($mode == 'quit')
    {
        include 'conn.php';
        @$id = (int)$_GET['id'];
        if(delete($mysql,'tb_user_shop','where uId=' . $_SESSION['userId'] . ' and cId=' . $id))
            die(backMsg('移除购物车成功！'));
        else
            die(backMsg('移除购物车失败！'));
    }

    header("Location: classify.php");
	exit;
	
?>