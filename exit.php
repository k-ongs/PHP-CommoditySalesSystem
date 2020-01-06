<?php
    //设置编码
    header("Content-type:text/html;charset=utf-8");
    // 初始化session.
    session_start();
    //删除所有的session变量
     $_SESSION = array();
     //删除包含session id的cookie
     if (isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time()-42000, '/');
     // 最后彻底销毁session
     session_destroy();
     echo '<script>alert("退出成功！");window.location.href = "index.php";</script>';
?>