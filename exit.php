<?php
   //设置编码
   header("Content-type:text/html;charset=utf-8");
   // 初始化session.
   session_start();
   unset($_SESSION['userPass']);
   unset($_SESSION['userName']);
   unset($_SESSION['userId']);
   echo '<script>alert("退出成功！");window.location.href = "index.php";</script>';
?>