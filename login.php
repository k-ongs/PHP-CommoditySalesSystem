<?PHP
header("Content-type:text/html;charset=utf-8");
session_start();
$toUrlArr = array('index.php','login.php','register.php','classify.php','details.php');
@$to = (int)$_GET['to'];
@$id = (int)$_GET['id'];

$toUrl = $toUrlArr[$to];
if($id)
	$toUrl .= '?id=' . $id;

if(isset($_SESSION['userPass']) && isset($_SESSION['userName']) && isset($_SESSION['userId']))
{
	header("Location: " . $toUrl);
	exit;
}
if(@$_POST['button'])
{
	include 'conn.php';
	include 'functions.php';
	@$user = $_POST['user'];
	@$pass = $_POST['pass'];
	if($user == "" || $user == "")
		die(jumpMsg('用户名或密码不能为空！', 'login.php'));
	$userinfo = select($mysql, 'tb_s_user', 'where userName="'.$user.'" and userPass="'. $pass . '"');
	if(!$userinfo)
		die(jumpMsg('用户名或密码不正确！', 'login.php'));
		
	$_SESSION['userId'] = $userinfo[0]['uId'];
	$_SESSION['userName'] = $userinfo[0]['userName'];
	$_SESSION['userPass'] = $userinfo[0]['userPass'];

	die(jumpMsg('登录成功！',$toUrl));
}

?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>用户登录</title>
	<style>
		a{
			text-decoration: none;
		}
		.win{
			width: 300px;
			height: 300px;
			border: 1px solid #000;
			position: fixed;
			top: 50%;
			left: 50%;
			margin-top: -150px;
			margin-left: -150px;
		}

		.win > .title{
			height: 70px;
			line-height: 70px;
			font-size: 30px;
			font-weight: bold;
			text-align: center;
		}
		.mode{
			font-size: 0px;
			height: 35px;
			margin: 5px 10px;
		}
		.mode .title{
			font-size: 16px;
			display: inline-block;
			height: 35px;
			text-align: justify;
			text-align-last: justify;
			line-height: 35px;
			width: 60px;
			vertical-align: top;
		}
		.mode .content{
			font-size: 16px;
			display: inline-block;
			height: 35px;
			line-height: 35px;
			width: 220px;
			vertical-align: top;
		}
		.mode .content input{
			height: 18px;
			padding: 5px;
			width: 190px;
			margin-left: 10px;
			border: 1px solid #000;
		}
		.center{
			text-align: center;
		}

		#button {
			height: 35px;
			width: 100%;
			color: #FFF;
			box-sizing: border-box;
			border: none;
			font-size: 14px;
			line-height: 35px;
			font-weight: 700;
			vertical-align: top;
			background: #000;
		}

		#button:hover {
			cursor: pointer;
			background-color: rgb(29, 29, 29);
		}

		#button:active {
			background-color: rgb(24, 23, 23);
		}
		.register{
			margin-top: 20px;
			text-align: right;
			padding-right: 20px;
			font-size: 13px;
		}
	</style>
</head>

<body>
<form name="form1" id="form1" method="POST">
	<div class="win">
		<div class="title">登录</div>
		<br>
		<div class="mode">
			<span class="title">用户名:</span>
			<span class="content"><input type="text" name="user" id="user"></span>
		</div>
		<div class="mode">
			<span class="title">密码:</span>
			<span class="content"><input type="password" name="pass" id="pass"></span>
		</div>
		<br>
		<div class="mode">
			<div class="center">
				<input type="submit" name="button" id="button" value="登录">
			</div>
		</div>
		<div class="register"><a href="register.php">点击这里注册>></a></div>
	</div>
</form>
</body>

</html>