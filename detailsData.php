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
        $type = $type == 2 ? 2 : 1;
        $userinfo = select($mysql,'tb_s_user', 'where uId=' . $_SESSION['userId']);
        if(!$userinfo)
            die('用户信息查询失败！');
        $userinfo = $userinfo[0];
        if($type == 1)
            $comInfo = select($mysql, 'tb_commodity', 'where cId=' . $id);
        else
            $comInfo = select($mysql,'tb_seckill', 'a join tb_commodity b on a.cId = b.cId where a.startDate <=now() and a.endDate >= now() and a.cId=' . $id,'a.nums,a.num,a.recommends,b.cId,b.name,b.price,b.figure,b.ucId,b.sales,b.stock,b.sales');
        if(!$comInfo)
            die(backMsg('该商品不存在！'));
        $comInfo = $comInfo[0];
        if($num > $comInfo['stock'])
            die(backMsg('购买的数量超过了库存！'));
        
        if($type == 1)
        {
            if($num * $comInfo['price'] > $userinfo['balance'])
                die(backMsg('对不起，您的余额不足！'));
            $sql = 'update tb_commodity c,tb_s_user u set c.sales=c.sales+'.$num.',c.stock=c.stock-'.$num.',u.balance=u.balance-'.($num * $comInfo['price']).' where c.cId=' . $id . ' and u.uId='.$_SESSION['userId'];
            if(!$mysql->exec($sql))
                die(backMsg('购买失败！'));
        }else{
            if($num * number_format(($comInfo['recommends'] / 100) * $comInfo['price']) > $userinfo['balance'])
                die(backMsg('对不起，您的余额不足！'));
            $sql = 'update tb_commodity c,tb_s_user u,tb_seckill s set s.num=s.num+'.$num.',c.sales=c.sales+'.$num.',c.stock=c.stock-'.$num.',u.balance=u.balance-'.($num * $comInfo['price']).' where s.cId=' . $id . ' and c.cId=' . $id . ' and u.uId='.$_SESSION['userId'];
            if(!$mysql->exec($sql))
                die(backMsg('购买失败！'));
        }
        if(is_int(insert($mysql, 'tb_user_order', array('uId'=>$_SESSION['userId'],'cId'=>$comInfo['cId'],'num'=>$num, 'type'=>$type, 'date'=>date("Y-m-d m:s:i")))))
            die(jumpMsg('购买成功！','orders.php'));
        else
            die(backMsg('购买失败！'));
    }else if($mode == 'join')
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
        $comInfo = $comInfo[0];
        if($num > $comInfo['stock'])
            die(backMsg('加入购物车的数量超过了库存！'));

        if(is_int(insert($mysql, 'tb_user_shop', array('uId'=>$_SESSION['userId'],'cId'=>$comInfo['cId'],'nums'=>$num, 'type'=>$type))))
            die(backMsg('加入购物车成功！'));
        else
            die(backMsg('加入购物车失败！'));
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