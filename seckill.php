<?PHP 
	header("Content-type:text/html;charset=utf-8");
	session_start();
	include 'conn.php';
	include 'functions.php';
	if(isset($_GET['page']))
	{
		$page = $_GET['page'];
	}else{
		$page = 1;
	}
?>
<!doctype html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>限时秒杀</title>
	<link rel="stylesheet" href="css/both.css">
</head>

<body>
	<?PHP echoHead(); ?>
	<br>
	<table class="border" width="900" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr class="border-bottom">
			<?PHP 
				$re = select($mysql,'tb_seckill', 'a join tb_commodity b on a.cId = b.cId where a.startDate <=now() and a.endDate >= now()','count(*)');
				if($re)
					$message_count = $re[0][0];
				else
					$message_count = 0;
			?>
            <td colspan="2" class="padding-left-a" height="40" style="font-size: 16px; font-weight: bold;">当前 <span style="color: #f00;"><?PHP echo $message_count; ?></span> 个商品正在限时秒杀：</td>
        </tr>
		<tr>
			<td class="padding-a" style="border:1px solid #000">
				<?PHP
					if($message_count == 0)
					{
						echo '<div style="font-size: 24px; text-align:center;">暂无商品<div>';
					}else{
						$page_count = ceil($message_count / 6);
						$page = $page > $page_count ? $page_count : $page;
						$offset = ($page-1) * 6;
						//分页查询 每页显示8条记录
						$re = select($mysql,'tb_seckill', 'a join tb_commodity b on a.cId = b.cId where a.startDate <=now() and a.endDate >= now() limit '. $offset .',6','a.nums,a.num,a.recommends,b.cId,b.name,b.price,b.figure');
						foreach($re as $val)
						{
				?>
				<table class="seckill" width="293" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td style="border-right: 1px solid #999;font-size: 0px;" width="150" height="150" rowspan="4" align="center" valign="middle">
							<a href="details.php?type=2&id=<?PHP echo $val['cId'] ?>"><img src="<?PHP echo $val['figure'] ?>"></a>
						</td>
						<td class="padding-left-8" style="padding-top: 10px; font-size: 16px; font-weight: 600;" width="140" height="60" colspan="2" valign="top">
							<a class="asdasjkls" href="details.php?type=2&id=<?PHP echo $val['cId'] ?>"><?PHP echo $val['name']; ?></a>
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
						<td class="seckill-price padding-left-8 price" >￥<?PHP echo number_format(($val['recommends'] / 100) * $val['price'],'2'); ?></td>
						<td class="original">￥<?PHP echo $val['price'] ?></td>
					</tr>
				</table>
				<?PHP
						}
					}
				?>
                </td>
		</tr>
	</table>
	<?PHP if($message_count > 0) echo makePage($page_count, $page, 'seckill.php?s=1'); ?>
	<br>
	<?PHP echoFooter(); ?>
</body>

</html>