<?PHP
	header("Content-type:text/html;charset=utf-8");
	session_start();
    if(!isset($_SESSION['userPass']) || !isset($_SESSION['userName']) || !isset($_SESSION['userId']))
	{
		echo '<script>alert("还没登录，请先登录！");window.location.href = "login.php";</script>';
		exit;
    }