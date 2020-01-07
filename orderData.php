<?PHP
    //包含验证登录文件和函数文件
    include 'att.php';
    include 'conn.php';
    include 'functions.php';

    //获取调用的mode方法
    @$mode = $_GET['mode'];
    //定义本页面使用的数据表名
    $tb = 'tb_user_order';
    //定义本页面跳转页面
    $toUrl = 'orders.php';
    if($mode == 'shouhuo')
    {
        //接收商品id
        @$id = (int)$_GET['id'];
        $comInfo = select($mysql, $tb, 'where oId=' . $id);
        if(!$comInfo)
            die(jumpMsg('该订单不存在！',$toUrl));

        if(update($mysql, $tb, array('status'=>'3'), 'where oId=' . $id))
            die(jumpMsg('收货成功！',$toUrl));
        else
            die(jumpMsg('收货失败！',$toUrl));
        //跳转页面
    }else if($mode == 'pingjia'){
        @$comm = addslashes($_POST['comm']);
        @$id = (int)$_GET['id'];
        if($comm == '')
            die(jumpMsg('评论内容不能为空',$toUrl));
        $comInfo = select($mysql, $tb, 'where oId=' . $id);
        if(!$comInfo)
            die(jumpMsg('该订单不存在！',$toUrl));
        $comInfo = $comInfo[0];

        if(!is_int(insert($mysql, 'tb_comment', array('uId'=>$comInfo['uId'],'cId'=>$comInfo['cId'],'oId'=>$comInfo['oId'],'content'=>$comm,'date'=>date("Y-m-d m:s:i")))))
            die(jumpMsg('评论失败！',$toUrl));
        if(update($mysql, $tb, array('status'=>'4'), 'where oId=' . $id))
            die(jumpMsg('评论成功！',$toUrl));
        else
            die(jumpMsg('评论失败！',$toUrl));
    }
    
    header("Location: " . $toUrl);
	exit;
    

?>