<?PHP
	header("Content-type:text/html;charset=utf-8");
	session_start();
    if(!isset($_SESSION['adminPass']) || !isset($_SESSION['adminUser']))
	{
		header("Location: login.php");
		exit;
    }