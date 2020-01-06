<?PHP
header("Content-type:text/html;charset=utf-8");
session_start();
if(isset($_SESSION['userPass']) && isset($_SESSION['userName']) && isset($_SESSION['userId']))
{
	header("Location: index.php");
	exit;
}
if(@$_POST['button'])
{
	include 'conn.php';
	include 'functions.php';
	@$user = $_POST['user'];
	@$pass = $_POST['pass'];
	@$repass = $_POST['repass'];
	if($user == "" || $user == "" || $repass == '')
		die(jumpMsg('用户名或密码不能为空！', 'register.php'));
	$userinfo = select($mysql, 'tb_s_user', 'where userName="'.$user.'"');
	if($userinfo)
		die(jumpMsg('用户名已被占用！', 'register.php'));
	if(insert($mysql, 'tb_s_user', array('userName'=>$user,'userPass'=>$pass,'time'=>date("Y-m-d m:s:i"))))
		die(jumpMsg('注册成功！', 'login.php'));
	else
		die(jumpMsg('注册失败！', 'register.php'));
}

?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>用户注册</title>
	<style>
		a{
			text-decoration: none;
		}
		.win{
			width: 320px;
			height: 320px;
			border: 1px solid #000;
			position: fixed;
			top: 50%;
			left: 50%;
			margin-top: -160px;
			margin-left: -160px;
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
			width: 80px;
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
		<div class="title">注册</div>
		<br>
		<div class="mode">
			<span class="title">用户名:</span>
			<span class="content"><input type="text" name="user" id="user"></span>
		</div>
		<div class="mode">
			<span class="title">密码:</span>
			<span class="content"><input type="password" name="pass" id="pass"></span>
		</div>
		<div class="mode">
			<span class="title">确认密码:</span>
			<span class="content"><input type="password" name="repass" id="repass"></span>
		</div>
		<br>
		<div class="mode">
			<div class="center">
				<input type="submit" name="button" id="button" value="注册">
			</div>
		</div>
		<div class="register"><a href="login.php">点击这里登录>></a></div>
	</div>
</form>
</body>

</html>