<?PHP
    //包含验证登录文件和函数文件
    include 'att.php';
    include '../functions.php';
    //获取调用的mode方法
    @$mode = $_GET['mode'];
    //定义本页面使用的数据表名
    $tb = 'tb_s_user';
    //定义本页面跳转页面
    $toUrl = 'userMan.php';
    if($mode == 'edit')
    {
        @$id = (int)$_GET['id'];
        if($id != 0)
        {
            //接受并过滤参数
            $pass = htmlspecialchars(addslashes($_POST['pass']));
            $sex = htmlspecialchars(addslashes($_POST['sex']));
            $balance = htmlspecialchars(addslashes($_POST['balance']));
            if($pass == '' || $sex == '' || $balance == '')
                die(jumpMsg('请将修改信息填写完整！', $toUrl));
            //载入数据库连接文件
            $sex = $sex == '男' ? '男' : '女';
            include '../conn.php';
            //更新用户信息 
            if(update($mysql, $tb, array('userPass'=>$pass,'sex'=>$sex, 'balance'=>$balance), 'where uId=' . $id))
                die(jumpMsg('修改用户信息成功！', $toUrl));
            else
                die(jumpMsg('修改用户信息失败！', $toUrl));
        }
    }else if($mode == 'del')
    {
        @$id = (int)$_GET['id'];
        if($id != 0)
        {
            //载入数据库连接文件
            include '../conn.php';
             //删除类名 
            if(delete($mysql, $tb, 'where uId=' . $id))
                die(jumpMsg('删除用户成功！', $toUrl));
            else
                die(jumpMsg('删除用户成功！', $toUrl));
        }
    }

    //跳转页面
    header("Location: " . $toUrl);
	exit;
    

?>