<?PHP
	include 'att.php';
	include 'functions.php';
	if(isset($_POST['button']))
	{
		$oldpass = htmlspecialchars(addslashes($_POST['oldpass']));
		$newpass = htmlspecialchars(addslashes($_POST['newpass']));
		$reppass = htmlspecialchars(addslashes($_POST['reppass']));
		if($oldpass == '' || $newpass == '' || $reppass == '')
			die(jumpMsg('性别不能为空！', 'changepass.php'));
		if($oldpass != $_SESSION['userPass'])
			die(jumpMsg('原密码错误！', 'changepass.php'));
		if($newpass != $reppass)
			die(jumpMsg('两次密码输入不一样！', 'changepass.php'));
		include 'conn.php';
		if(is_int(update($mysql, 'tb_s_user', array('userPass'=>$newpass), 'where uId=' . $_SESSION['userId'])))
		{
			//删除所有的session变量
			$_SESSION = array();
			//删除包含session id的cookie
			if (isset($_COOKIE[session_name()]))
				setcookie(session_name(), '', time()-42000, '/');
			// 最后彻底销毁session
			session_destroy();
			die(jumpMsg('修改用户密码成功，请重新登录！', 'userinfo.php'));
		}
		else
			die(jumpMsg('修改用户密码失败！', 'userinfo.php'));
	}
?>
<!doctype html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>修改密码</title>
	<link rel="stylesheet" href="css/both.css">
	<link rel="stylesheet" href="css/uboth.css">
</head>

<body>
	<?PHP echoHead('',800); ?>
	<br>
	<table class="border" width="800" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td class="menu" width="200" align="left" valign="top">
				<div><a href="userinfo.php">个人信息</a></div>
				<div><a href="shops.php">购 物 车</a></div>
				<div><a href="orders.php">订单信息</a></div>
				<div><a class="active">修改密码</a></div>
				<div><a href="exit.php">退出登录</a></div>
			</td>
			<td valign="top" style="padding: 20px;">
				<div class="biank border">
				<form name="form1" id="form1" method="POST">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td height="40" align="center">旧的密码
								<input type="text" name="oldpass" id="oldpass"></td>
						</tr>
						<tr>
							<td height="40" align="center">新的密码
								<input type="password" name="newpass" id="newpass"></td>
						</tr>
						<tr>
							<td height="40" align="center">确认密码
								<input type="password" name="reppass" id="reppass"></td>
						</tr>
						<tr>
							<td height="40" align="center"><input type="submit" name="button" id="button" value="修改">
							</td>
						</tr>
					</table>
				</form>
				</div>
			</td>
		</tr>
	</table>
	<br>
	<?PHP echoFooter(800); ?>
</body>

</html>