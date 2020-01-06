<?PHP
    //包含验证登录文件和函数文件
    include 'att.php';
    include '../functions.php';
    //获取调用的mode方法
    @$mode = $_GET['mode'];
    //定义本页面使用的数据表名
    $tb = 'tb_commodit_class';
    //定义本页面跳转页面
    $toUrl = 'classMan.php';
    if($mode == 'add')
    {
        if(isset($_POST['button']))
        {
            //接受并过滤参数
            $classname = htmlspecialchars(addslashes($_POST['classname']));
            if($classname == '')
                die(jumpMsg('分类名不能为空！', $toUrl));
            //载入数据库连接文件
            include '../conn.php';
            //查询类名是否存在
            if(select($mysql, $tb, 'where ccName="' . $classname . '"'))
                die(jumpMsg('分类名已存在！', $toUrl));
            //插入类名
            if(insert($mysql, $tb, array('ccName'=>$classname)))
                die(jumpMsg('添加分类成功！', $toUrl));
            else
                die(jumpMsg('添加分类失败！', $toUrl));
        }
    }else if($mode == 'edit')
    {
        @$id = (int)$_GET['id'];
        if($id != 0)
        {
            //接受并过滤参数
            $classname = htmlspecialchars(addslashes($_POST['className']));
            if($classname == '')
                die(jumpMsg('分类名不能为空！', $toUrl));
            //载入数据库连接文件
            include '../conn.php';
            //查询类名是否存在
            if(select($mysql, $tb, 'where ccName="' . $classname . '"'))
                die(jumpMsg('此分类名已存在！', $toUrl));
            //更新类名信息 
            if(update($mysql, $tb, array('ccName'=>$classname), 'where ucId=' . $id))
                die(jumpMsg('修改分类成功！', $toUrl));
            else
                die(jumpMsg('修改分类失败！', $toUrl));
        }
    }else if($mode == 'del')
    {
        @$id = (int)$_GET['id'];
        if($id != 0)
        {
            //载入数据库连接文件
            include '../conn.php';
             //删除类名 
            if(delete($mysql, $tb, 'where ucId=' . $id))
                die(jumpMsg('删除分类成功！', $toUrl));
            else
                die(jumpMsg('删除分类成功！', $toUrl));
        }
    }

    //跳转页面
    header("Location: " . $toUrl);
	exit;
    

?>