<?PHP
	include 'att.php';
	include 'functions.php';
	if(isset($_POST['button']))
	{
		$address = htmlspecialchars(addslashes($_POST['address']));
		$sex = htmlspecialchars(addslashes($_POST['sex']));
		if($sex == '')
			die(jumpMsg('性别不能为空！', 'userinfo.php'));
		include 'conn.php';
		if(is_int(update($mysql, 'tb_s_user', array('sex'=>$sex, 'address'=>$address), 'where uId=' . $_SESSION['userId'])))
			die(jumpMsg('修改用户信息成功！', 'userinfo.php'));
		else
			die(jumpMsg('修改用户信息失败！', 'userinfo.php'));
	}
	include 'conn.php';

	$userinfo = select($mysql,'tb_s_user', 'where uId=' . $_SESSION['userId']);
	if(!$userinfo || empty($userinfo))
		die('用户信息查询失败！');
	else
		$userinfo = $userinfo[0];
?>
<!doctype html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>个人信息</title>
	<link rel="stylesheet" href="css/both.css">
	<link rel="stylesheet" href="css/uboth.css">
</head>

<body>
	<?PHP echoHead('userinfo',800); ?>
	<br>
	<table class="border" width="800" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td class="menu" width="200" align="left" valign="top">
				<div><a class="active">个人信息</a></div>
				<div><a href="shops.php">购 物 车</a></div>
				<div><a href="orders.php">订单信息</a></div>
				<div><a href="changepass.php">修改密码</a></div>
				<div><a href="exit.php">退出登录</a></div>
			</td>
			<td valign="top" style="padding: 20px;">
				<form name="form1" id="form1" method="POST">
				<table class="border" width="560" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td style="padding-left: 10px; padding-top: 10px;" height="40">用户名：<?PHP echo $userinfo['userName']; ?></td>
						<td style="padding-left: 10px; padding-top: 10px;" height="40">等级：<?PHP echo $userinfo['level']; ?>级</td>
						<td style="padding-left: 10px; padding-top: 10px;" height="40">余额：<?PHP echo $userinfo['balance']; ?></td>
					</tr>
					<tr>
						<td style="padding-left: 10px;" height="30">性别：
							<select name="sex" id="sex" style="height: 30px; width: 50px;">
								<option <?PHP echo $userinfo['sex'] == '男' ? 'selected' : ''; ?> value="男">男</option>
								<option <?PHP echo $userinfo['sex'] == '女' ? 'selected' : ''; ?> value="女">女</option>
							</select></td>
						<td style="padding-left: 10px;" height="30" colspan="2">注册日期： <?PHP echo $userinfo['time']; ?></td>
					</tr>
					<tr>
						<td style="padding-left: 10px;" height="60" colspan="3">送货地址：
							<input type="text" value="<?PHP echo $userinfo['address']; ?>" name="address" id="address"></td>
					</tr>
					<tr>
						<td colspan="3" align="center"><input type="submit" name="button" id="button" value="修改"></td>
					</tr>
				</table>
				</form>
			</td>
		</tr>
	</table>
	<br>
	<?PHP echoFooter(800); ?>
</body>

</html>