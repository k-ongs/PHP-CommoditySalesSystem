<?PHP
    //包含验证登录文件和函数文件
    include 'att.php';
    include '../conn.php';
    include '../functions.php';
    //接收商品id
    @$id = (int)$_GET['id'];
    //定义本页面使用的数据表名
    $tb = 'tb_user_order';
    //定义本页面跳转页面
    $toUrl = 'orderMan.php';
    
    $comInfo = select($mysql, $tb, 'where oId=' . $id);
    if(!$comInfo)
        die(jumpMsg('该订单不存在！',$toUrl));

    if(update($mysql, $tb, array('status'=>'2'), 'where oId=' . $id))
        die(jumpMsg('发货成功！',$toUrl));
    else
        die(jumpMsg('发货失败！',$toUrl));
    //跳转页面
    header("Location: " . $toUrl);
	exit;
    

?>