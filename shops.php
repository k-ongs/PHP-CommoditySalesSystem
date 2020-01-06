<?PHP
	include 'att.php';
	include 'functions.php';
	include 'conn.php';
	$comInfo = select($mysql, 'tb_user_shop', 'a join tb_commodity b on a.cId = b.cId where uId=' . $_SESSION['userId']);
?>
<!doctype html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>购物车</title>
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
				<div><a class="active">购 物 车</a></div>
				<div><a href="orders.php">订单信息</a></div>
				<div><a href="changepass.php">修改密码</a></div>
				<div><a href="exit.php">退出登录</a></div>
			</td>
			<td valign="top" style="padding: 20px;">
				<?php
					if($comInfo){
						foreach($comInfo as $val)
						{
				?>
				<div class="biank border">
					<table width="600" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="30" rowspan="2" align="center" valign="middle">
								<input type="checkbox" name="checkbox2" id="checkbox2">
								<label for="checkbox2"></label></td>
							<td width="100" rowspan="2" align="center"><img src="<?PHP echo $val['figure'] ?>" width="80%"></td>
							<td class="cotitle" height="30"><?PHP echo $val['name'] ?></td >
							<td class="price" width="150">￥<?PHP echo $val['price']*$val['nums'] ?></td>
						</tr>
						<tr>
							<td class="quantity" colspan="2">
								<span class="none" id="reduce">-减少</span>
								<span class="nums"><?PHP echo $val['nums'] ?></span>
								<span id="increase">+添加</span>
								<a href="#">删除</a>
								<a href="#">购买</a></td>
						</tr>
					</table>
				</div>
				<?PHP
						}
				?>
					<div class="biank border">
						<table width="600" border="0" cellspacing="0" cellpadding="0">
							<tr>
							<td height="30" style="padding-left: 10px;"> 总额：<span class="price">￥0</span></td>
							<td class="buttona" width="150" align="right">
								<a href="#">删除</a>
								</td>
							<td class="buttona" width="150" align="center"><a href="#">购买</a></td>
							</tr>
						</table>
					</div>
				<?PHP
					}else{
						echo '<div class="biank border" style="text-align:center;">购物车暂无商品</div>';
					}
				?>
			</td>
		</tr>
	</table>
	<br>
	<?PHP echoFooter(800); ?>
</body>

</html>