<?PHP 
	header("Content-type:text/html;charset=utf-8");
	session_start();
	include 'conn.php';
	include 'functions.php';
	$commodit_class = select($mysql,'tb_commodit_class');
	if(isset($_GET['class']))
	{
		$class = $_GET['class'];
		if(!inTwoArray($class, $commodit_class))
			$class = 'all';
	}else{
		$class = 'all';
	}
	if(isset($_GET['sort']))
	{
		$sort = $_GET['sort'];
		if(!in_array($sort,array(1,2,3)))
		$sort = 1;
		
	}else{
		$sort = 1;
	}
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
	<title>商品分类</title>
	<link rel="stylesheet" href="css/both.css">
	<style>
		.classify .menu a{
			padding-left: 10px;
		}
	</style>
</head>

<body>
	<?PHP echoHead('classify'); ?>
	<br>
	<table class="border classify" width="900" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr style="border-bottom: 1px solid #ccc;">
			<td style="padding: 10px;" width="70">
				商品分类
			</td>
			<td class="menu">
				<a <?PHP echo ($class == 'all' ? 'class="active"' : '') ?> href="<?PHP echo 'classify.php?class=all&sort='.$sort; ?>">全部</a>
				<?PHP
					foreach(select($mysql,'tb_commodit_class') as $val)
					{
						echo '<a ' . ($class == $val['ucId'] ? 'class="active"' : '') . ' href="classify.php?class='.$val['ucId'].'&sort='.$sort.'">'.$val['ccName'].'</a>';
					}
				?>
				
			</td>
		</tr>
		<tr style="border-bottom: 1px solid #ccc;">
			<td style="padding: 10px;">
				排序方法
			</td>
			<td class="menu">
				<a <?PHP echo ($sort == '1' ? 'class="active"' : '') ?> href="classify.php?class=<?PHP echo $class; ?>&sort=1">按价格升序</a>
				<a <?PHP echo ($sort == '2' ? 'class="active"' : '') ?> href="classify.php?class=<?PHP echo $class; ?>&sort=2">按价格降序</a>
				<a <?PHP echo ($sort == '3' ? 'class="active"' : '') ?> href="classify.php?class=<?PHP echo $class; ?>&sort=3">按照销售量降序</a>
			</td>
		</tr>
		<tr>
			<td style="font-size: 0px;padding-top: 10px; padding-bottom: 10px;" height="100" colspan="2">
				<?PHP
					//分类条件
					$where = '';
					if($class != 'all')
						$where = 'where ucId = ' . $class;
					//排序
					if($sort == 2)
						$sqlSort = ' order by price desc';//按价格降序
					else if($sort == 3)
						$sqlSort = ' order by sales desc';//按销量降序
					else
						$sqlSort = ' order by price asc';//按价格升序
					//查询总记录条数
					$re = select($mysql,'tb_commodity',$where.$sqlSort,'count(*)');
					if($re)
						$message_count = $re[0][0];
					else
						$message_count = 0;

					if($message_count == 0)
					{
						echo '<div style="font-size: 24px; text-align:center;">暂无商品<div>';
					}else{
						$page_count = ceil($message_count / 8);
						$page = $page > $page_count ? $page_count : $page;
						$offset = ($page-1) * 8;
						//分页查询 每页显示8条记录
						$re = select($mysql,'tb_commodity',$where.$sqlSort.'  limit '. $offset .',8');
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
	<?PHP if($message_count > 0) echo makePage($page_count, $page, 'classify.php?class=' . $class . '&sort=' . $sort); ?>
	<br>
	<?PHP echoFooter(); ?>
</body>

</html>