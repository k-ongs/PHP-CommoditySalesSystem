<?PHP
    include 'att.php';
    @$mode = $_GET['mode'];
    include 'functions.php';
    if($mode == 'quit')
    {
        include 'conn.php';
        @$data = $_GET['data'];
        $dataArr = explode(',',$data);
        $dataTemp = array();
        foreach($dataArr as $dataVal)
        {
            if((int)$dataVal)
                $dataTemp[] = (int)$dataVal;
        }
        if(empty($dataTemp))
            die(backMsg('没有商品移除购物车！'));
        
        if(delete($mysql,'tb_user_shop','where uId=' . $_SESSION['userId'] . ' and cId in (' . join(',',$dataTemp) . ')'))
            die(backMsg('移出购物车成功！'));
        else
            die(backMsg('移出购物车失败！'));
    }

    header("Location: classify.php");
	exit;
	
?>