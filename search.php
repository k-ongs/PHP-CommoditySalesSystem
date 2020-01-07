<?PHP 
    header("Content-type:text/html;charset=utf-8");
	session_start();
	include 'conn.php';
    include 'functions.php';
	
	if(isset($_POST['search']))
	{
		@$search = $_POST['search'];
	}else{
		$search = '';
	}
	//查询总记录条数
	$re = select($mysql,'tb_commodity','where name like "%'.$search.'%"','count(*)');
	if($re)
		$message_count = $re[0][0];
	else
		$message_count = 0;
?>
<!doctype html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>商品搜索</title>
	<link rel="stylesheet" href="css/both.css">
</head>

<body>
	<?PHP echoHead(); ?>
	<br>
	<table class="border" width="900" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td colspan="2">
				<table width="900" border="0" cellspacing="0" cellpadding="0">
					<tr class="border-bottom">
						<td colspan="2" class="padding-left-a" height="40" style="font-size: 16px; font-weight: bold;">已搜索到<span style="color: #f00;"><?PHP echo $message_count; ?></span>条相关记录：</td>
					</tr>
					<tr>
						<td style="font-size: 0px; padding-bottom: 10px;" height="100" colspan="2">
							<?PHP
								if($message_count == 0)
								{
									echo '<div style="font-size: 24px; text-align:center;">暂无相关记录<div>';
								}else{
								$re = select($mysql,'tb_commodity','where name like "%'.$search.'%"');
								foreach($re as $val)
								{
							?>
							<div class="hotCm">
								<table width="192" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td class="comImg" height="192" colspan="2" align="center" valign="middle">
										<a href="details.php?id=<?PHP echo $val['cId'] ?>"><img src="<?php echo $val['figure'] ?>"></a>
										</td>
									</tr>
									<tr>
										<td height="38" width="90" valign="middle" class="price">￥<?php echo $val['price'] ?></td>
										<td width="122" class="shou" align="right"><?PHP echo $val['sales'] ?> 销量</td>
									</tr>
									<tr>
										<td width="192" colspan="2">
											<div class="comTitle"><a href="details.php?id=<?PHP echo $val['cId'] ?>"><?php echo $val['name'] ?></a></div>
										</td>
									</tr>
									</table>
							</div>
							<?php
								}
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