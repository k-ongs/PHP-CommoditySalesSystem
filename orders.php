<?PHP
	include 'att.php';
	include 'functions.php';
	include 'conn.php';
	$comInfo = select($mysql, 'tb_user_order', 'a join tb_commodity b on a.cId = b.cId left join tb_comment c on a.oId = c.oId left join tb_seckill d on a.cId = d.cId and a.type = 2  where a.uId=' . $_SESSION['userId']. ' order by a.date desc', 'a.*,b.*,c.content,d.recommends');
?>
<!doctype html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>订单信息</title>
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
				<div><a class="active">订单信息</a></div>
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
							<td width="1" rowspan="2" align="center" valign="middle"></td>
							<td width="100" rowspan="2" align="center"><img src="<?PHP echo $val['figure'] ?>" width="80%"></td>
							<td class="cotitle" height="30"><?PHP echo $val['name'] ?></td ><td class="price" width="150">￥<?PHP if($val['type'] == 2) echo number_format(($val['recommends'] / 100) * $val['price'],'2') *$val['num'];else echo $val['price']*$val['num']; ?><?PHP if($val['type'] == 2) echo '<span style="padding-left:10px; color: #888; font-size:13px;text-decoration: line-through;">￥'.$val['price']*$val['num'].'</span>'; ?></td>
						</tr>
						<tr>
							<?PHP
								if($val['status'] == '1')
								{
									echo '<td class="quantity" colspan="2"><a class="none">等待发货</a></td>';
								}else if($val['status'] == '2')
								{
									echo '<td class="quantity" colspan="2"><a href="orderData.php?mode=shouhuo&id='.$val['oId'].'">确认收货</a></td>';
								}else if($val['status'] == '3')
								{
									echo '<td><form name="form'.$val['oId'].'" id="form'.$val['oId'].'" action="orderData.php?mode=pingjia&id='.$val['oId'].'" method="POST"><textarea id="comm'.$val['oId'].'" placeholder="评价内容" name="comm"></textarea></form><td><td class="quantity"><a onclick="pingjia(\''.$val['oId'].'\')" href="javascript:void(0)">评价</a></td>';
								}else if($val['status'] == '4')
								{
									echo '<td>'.$val['content'].'</td><td class="quantity"><a class="none">已完成</a></td>';
								}
							?>
						</tr>
					</table>
				</div>
				<?PHP
						}
					}else{
						echo '<div class="biank border" style="text-align:center;">购物车暂无商品</div>';
					}
				?>
			</td>
		</tr>
	</table>
	<br>
	<?PHP echoFooter(800); ?>
	<script>
		function pingjia(id)
		{
			if(document.getElementById('comm'+id).value == '')
			{
				alert("评论内容不能为空");
			}else{
				if (confirm("一旦评论将无法修改，确认要评论吗？")) {
					document.getElementById('form'+id).submit();
				}
			}
		}
	</script>
</body>

</html>