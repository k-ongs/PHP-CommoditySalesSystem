<?PHP 
	header("Content-type:text/html;charset=utf-8");
	session_start();
	include 'conn.php';
	include 'functions.php';
?>
<!doctype html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>首页</title>
	<link rel="stylesheet" href="css/both.css">
</head>

<body>
	<?PHP echoHead('index'); ?>
	<br>
	<table class="border" width="900" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td colspan="2">
				<table width="900" border="0" cellspacing="0" cellpadding="0">
					<tr class="border-bottom">
						<td class="padding-left-a border-bottom" height="40" style="font-size: 16px; font-weight: bold;">限时秒杀</td>
						<td align="right"><a href="seckill.php" style="padding-right: 10px;">更多&gt;&gt;</a></td>
					</tr>
					<tr class="border-bottom">         
						<td class="padding-a" height="100" colspan="2" nowrap>
							<?PHP
								foreach(select($mysql,'tb_seckill', 'a join tb_commodity b on a.cId = b.cId where a.startDate <=now() and a.endDate >= now() limit 8','a.nums,a.num,a.recommends,b.cId,b.name,b.price,b.figure') as $val)
								{
							?>
							<table class="seckill" width="293" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td style="border-right: 1px solid #999;font-size: 0px;" width="150" height="150" rowspan="4" align="center" valign="middle">
										<a href="details.php?type=2&id=<?PHP echo $val['cId'] ?>"><img src="<?PHP echo $val['figure'] ?>"></a>
									</td>
									<td class="padding-left-8" style="padding-top: 10px; font-size: 16px; font-weight: 600;" width="140" height="60" colspan="2" valign="top">
										<a href="details.php?type=2&id=<?PHP echo $val['cId'] ?>"><?PHP echo mb_substr($val['name'], 0, 16); ?></a>
									</td>
								</tr>
								<tr height="20">
									<td colspan="2">
										<div class="bars">
											<div style="width: <?PHP echo $val['num']/$val['nums'] * 100 ?>%;"></div>
										</div>
									</td>
								</tr>
								<tr height="30">
									<td class="padding-left-8"><?PHP echo $val['num']/$val['nums'] * 100 ?>%</td>
									<td style="font-size: 12px;">已抢<span style="font-size: 14px; color: tomato;"><?PHP echo $val['num'] ?></span>件</td>
								</tr>
								<tr>
									<td class="padding-left-8 price">￥<?PHP echo number_format(($val['recommends'] / 100) * $val['price'],'2'); ?></td>
									<td class="original">￥<?PHP echo $val['price'] ?></td>
								</tr>
							</table>
							<?PHP
								} 
							?>
							
						</td>
					</tr>
				</table>
				<table width="900" border="0" cellspacing="0" cellpadding="0">
					<tr class="border-bottom">
						<td class="padding-left-a" height="40" style="font-size: 16px; font-weight: bold;">热卖单品</td>
						<td align="right"><a href="classify.php" style="padding-right: 10px;">更多&gt;&gt;</a></td>
					</tr>
					<tr class="border-bottom">
						<td style="font-size: 0px; padding-bottom: 10px;" height="100" colspan="2">
							<?php
								foreach(select($mysql,'tb_commodity', 'order by sales desc limit 8') as $val)
								{
							?>
							<div class="hotCm">
								<table width="192" border="0" cellspacing="0" cellpadding="0">
									<tr>
									  <td class="comImg" height="192" colspan="2" align="center" valign="middle">
										<a href="details.php?id=<?PHP echo $val['cId'] ?>"><img src="<?PHP echo $val['figure'] ?>"></a>
									  </td>
									</tr>
									<tr>
									  <td height="38" width="90" valign="middle" class="price">￥<?PHP echo $val['price'] ?></td>
									  <td width="122" class="shou" align="right"><?PHP echo $val['sales'] ?> 销量</td>
									</tr>
									<tr>
									  <td width="192" colspan="2">
										  <div class="comTitle"><a href="details.php?id=<?PHP echo $val['cId'] ?>"><?PHP echo $val['name'] ?></a></div>
									  </td>
									</tr>
								  </table>
							</div>
							<?PHP 
								}
							?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<br>
	<?PHP echoFooter(); ?>
</body>

</html>