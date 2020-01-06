<?PHP
    //包含登录验证文件和函数文件
    include 'att.php';
    include '../functions.php';
    if(isset($_POST['submit']))
    {	
        $toUrl = 'passMan.php';
        //接受并过滤参数
        $oldpass = htmlspecialchars(addslashes($_POST['oldpass']));
        $user = htmlspecialchars(addslashes($_POST['user']));
        $newpass = htmlspecialchars(addslashes($_POST['newpass']));
        $reppass = htmlspecialchars(addslashes($_POST['reppass']));
        //判断参数是否为空
        if($oldpass == '' || $user == '' || $newpass == '' || $reppass == '')
            die(jumpMsg('请将信息填写完毕！', $toUrl));
        //判断密码是否正确
        if($oldpass != $_SESSION['adminPass'])
            die(jumpMsg('原密码错误！', $toUrl));
        //判断两次输入密码是否一致
        if($newpass != $reppass)
            die(jumpMsg('两次输入密码不一致！', $toUrl));
        
        //将配置信息写入文件
        if(file_put_contents("config.php","<?PHP \r\n \$adminUserName = \"admin\";/*管理员账号*/\r\n \$adminPassWord = \"123456\";/*管理员密码*/\r\n?>"))
        {
            //删除所有的session变量
            $_SESSION = array();
            //删除包含session id的cookie
            if (isset($_COOKIE[session_name()]))
                setcookie(session_name(), '', time()-42000, '/');
            // 最后彻底销毁session
            session_destroy();
            //弹窗，跳转页面
            die(jumpMsg('修改密码成功，请重新登录！', 'login.php', true));
        }
        else
            die(jumpMsg('修改密码失败！', $toUrl));
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/iframe.css">
</head>

<body>
    <div class="card">
        <div class="card-header">
            <h3>管理员修改密码</h3>
        </div>
        <div class="card-body">
            <form name="formEdit" method="post" action="">
            <table style="position: fixed; top: 50%; left: 50%; width: 400px; margin-left: -200px; margin-top: -100px;" class="table" width="" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="60">旧的密码</td>
                    <td class="textCpass"><input type="text" name="oldpass" value="" ></td>
                </tr>
                <tr>
                    <td>登录名</td>
                    <td class="textCpass"><input type="text" name="user" value="<?PHP echo $_SESSION['adminUser']?>" ></td>
                </tr>
                <tr>
                    <td>新密码</td>
                    <td class="textCpass"><input type="password" name="newpass" value="" ></td>
                </tr>
                <tr>
                    <td>确认密码</td>
                    <td class="textCpass"><input type="password" name="reppass" value="" ></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input style="width: 200px; height: 30px;" type="submit" name="submit" value="修改密码">
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</body>

</html>