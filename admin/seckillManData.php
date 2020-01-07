<?PHP
    //包含验证登录文件和函数文件
    include 'att.php';
    include '../conn.php';
    include '../functions.php';
    //接收商品id
    @$mode = $_GET['mode'];
    //定义本页面使用的数据表名
    $tb = 'tb_seckill';
    //定义本页面跳转页面
    $toUrl = 'seckillMan.php';
    if($mode == 'add')
    {
        if(isset($_POST['button']) && isset($_GET['id']))
        {
            @$id = (int)$_GET['id'];
            //接受并过滤参数
            $staTime = strtotime(htmlspecialchars(addslashes($_POST['staTime'])));
            $endTime = strtotime(htmlspecialchars(addslashes($_POST['endTime'])));
            $num = (int)$_POST['num'];
            $recom = (float)$_POST['recom'];
            if(!$staTime || !$endTime)
                die(jumpMsg('时间参数不正确',$toUrl));
            if($staTime > $endTime)
                die(jumpMsg('结束时间不能小于开始时间',$toUrl));
            if(!$num)
                die(jumpMsg('商品数量能少于1',$toUrl));
            if(!$recom || $recom > 100)
                die(jumpMsg('折扣率不能小于1，大于100',$toUrl));
            $comInfo = select($mysql, 'tb_commodity', 'where cId=' . $id);
            if(!$comInfo)
                die(jumpMsg('该商品不存在！',$toUrl));
            $comInfo = $comInfo[0];
            if($num > $comInfo['stock'])
                die(jumpMsg('秒杀的个数不能大于库存',$toUrl));
            $ordInfo = select($mysql, $tb, 'where cId=' . $id);
            if($ordInfo)
                die(jumpMsg('该商品秒杀已存在！',$toUrl));
            if(insert($mysql, $tb, array('cId'=>$id,'nums'=>$num,'recommends'=>$recom,'startDate'=> date("Y-m-d m:s:i",$staTime),'endDate'=> date("Y-m-d m:s:i",$endTime) )))
                die(jumpMsg('添加商品秒杀成功！', $toUrl));
            else
                die(jumpMsg('添加商品秒杀失败！', $toUrl));
        }
    }else if($mode == 'del')
    {
        @$id = (int)$_GET['id'];
        if($id != 0)
        {
             //删除类名 
            if(delete($mysql, $tb, 'where sId=' . $id))
                die(jumpMsg('删除商品秒杀成功！', $toUrl));
            else
                die(jumpMsg('删除商品秒杀成功！', $toUrl));
        }
    }else if($mode == 'edit')
    {
        @$id = (int)$_GET['id'];
        //接受并过滤参数
        $staTime = strtotime(htmlspecialchars(addslashes($_POST['staTime'])));
        $endTime = strtotime(htmlspecialchars(addslashes($_POST['endTime'])));
        $num = (int)$_POST['num'];
        $recom = (float)$_POST['recom'];
        if(!$staTime || !$endTime)
            die(jumpMsg('时间参数不正确',$toUrl));
        if($staTime > $endTime)
            die(jumpMsg('结束时间不能小于开始时间',$toUrl));
        if(!$num)
            die(jumpMsg('商品数量能少于1',$toUrl));
        if(!$recom || $recom > 100)
            die(jumpMsg('折扣率不能小于1，大于100',$toUrl));
        $ordInfo = select($mysql, $tb, 'where sId=' . $id);
        if(!$ordInfo)
            die(jumpMsg('该商品秒杀不存在！',$toUrl));
        $ordInfo = $ordInfo[0];
        $comInfo = select($mysql, 'tb_commodity', 'where cId=' . $ordInfo['cId']);
        if(!$comInfo)
            die(jumpMsg('该商品不存在！',$toUrl));
        $comInfo = $comInfo[0];
        if($num > $comInfo['stock'])
            die(jumpMsg('秒杀的个数不能大于库存',$toUrl));

        if(is_int(update($mysql, $tb, array('nums'=>$num,'recommends'=>$recom,'startDate'=> date("Y-m-d m:s:i",$staTime),'endDate'=> date("Y-m-d m:s:i",$endTime) ), 'where sId=' . $id)))
            die(jumpMsg('商品秒杀更新成功！', $toUrl));
        else
            die(jumpMsg('商品秒杀更新失败！', $toUrl));
    }
    
        // die(jumpMsg('发货失败！',$toUrl));
    //跳转页面
    header("Location: " . $toUrl);
	exit;
    

?>