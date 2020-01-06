<?PHP
    include 'att.php';
	include '../conn.php';
	include '../functions.php';
	$commodit_class = select($mysql,'tb_commodit_class');
	
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="css/iframe.css">
</head>

<body>
	<div class="card">
		<div class="card-header">
			<h2>商品管理</h2>
		</div>
		<div class="card-body">
			<form name="formAdd" action="commManData.php?mode=add" method="POST" enctype="multipart/form-data">
				<input type="file" id="fileAdd1" name="file1" class="fileImg" accept="image/jpeg, image/PNG">
				<input type="file" id="fileAdd2" name="file2" class="fileImg" accept="image/jpeg, image/png">
				<input type="file" id="fileAdd3" name="file3" class="fileImg" accept="image/jpeg, image/png">
				<input type="file" id="fileAdd4" name="file4" class="fileImg" accept="image/jpeg, image/png">
				<input type="file" id="fileAdd5" name="file5" class="fileImg" accept="image/jpeg, image/png">
				<input type="file" id="fileAdd6" name="file6" class="fileImg" accept="image/jpeg, image/png">
				<table class="border commMan" width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="140" height="140" rowspan="2" align="center"><img id="imgAdd1" class="onedit" onclick="uploadImg('Add1')" width="126" height="126" src="img/uplod.jpg"></td>
						<td>
							<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td height="40" class="name">商品名<input type="text" name="name" ></td>
									<td width="50">价格：</td>
									<td width="60"><input type="text" name="price" ></td>
									<td width="50">库存：</td>
									<td width="60"><input type="text" name="stock" ></td>
									<td width="50">分类：</td>
									<td width="60">
										<?PHP echo makeSelect($commodit_class, 'className', 'className', ''); ?>
									</td>
								</tr>
							</table>
						</td>
						<td width="100" rowspan="2" align="center">
							<input type="submit" class="button" name="button" id="button" value="添加">
						</td>
					</tr>
					<tr>
						<td valign="bottom">
							<div>
								<textarea placeholder="商品简介，显示商品信息" name="details"></textarea>
							</div>
							<table width="300" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="60" height="50" align="center"><img class="onedit" onclick="uploadImg('Add2')" id="imgAdd2" src="img/uplod.jpg" width="50" height="50"></td>
									<td width="60" height="50" align="center"><img class="onedit" onclick="uploadImg('Add3')" id="imgAdd3" src="img/uplod.jpg" width="50" height="50"></td>
									<td width="60" height="50" align="center"><img class="onedit" onclick="uploadImg('Add4')" id="imgAdd4" src="img/uplod.jpg" width="50" height="50"></td>
									<td width="60" height="50" align="center"><img class="onedit" onclick="uploadImg('Add5')" id="imgAdd5" src="img/uplod.jpg" width="50" height="50"></td>
									<td width="60" height="50" align="center"><img class="onedit" onclick="uploadImg('Add6')" id="imgAdd6" src="img/uplod.jpg" width="50" height="50"></td>
								</tr>
							</table>

						</td>
					</tr>
				</table>
			</form>
			<?PHP 
				foreach(select($mysql,'tb_commodity','order by cId desc') as $val)
				{
					$pics = select($mysql,'tb_commodit_imgs', 'where cId='.$val['cId'], '*');
			?>
			<form name="form<?php echo $val['cId']; ?>" id="form<?php echo $val['cId']; ?>" method="POST" action="commManData.php?mode=edit&id=<?PHP echo $val['cId']; ?>" enctype="multipart/form-data">
				<table class="border commMan" width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
					<input type="file" id="file<?php echo $val['cId']; ?>1" name="file1" class="fileImg" accept="image/jpeg, image/png">
						<td width="140" height="140" rowspan="2" align="center"><img id="img<?php echo $val['cId']; ?>1" width="126" height="126" src="../<?php echo $val['figure']; ?>"></td>
						<td>
							<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td height="40" class="name"><input type="text" name="name" id="name<?php echo $val['cId']; ?>" value="<?php echo $val['name']; ?>" disabled></td>
									<td width="50">价格：</td>
									<td width="60"><input type="text" name="price" id="price<?php echo $val['cId']; ?>" value="<?php echo $val['price']; ?>" disabled></td>
									<td width="50">库存：</td>
									<td width="60"><input type="text" name="stock" id="stock<?php echo $val['cId']; ?>" value="<?php echo $val['stock']; ?>" disabled></td>
									<td width="50">分类：</td>
									<td width="60">
										<?PHP echo makeSelect($commodit_class, 'className', 'className', 'className'.$val['cId'],$val['ucId'],true); ?>
									</td>
								</tr>
							</table>
						</td>
						<td width="100" rowspan="2" align="center">
							<input type="button" class="button" onclick="onClickEdit('<?php echo $val['cId'] . '\',' .count($pics) ; ?>)" name="button" id="button<?php echo $val['cId']; ?>"
							value="编辑"><a class="button" href="commManData.php?mode=del&id=<?php echo $val['cId']; ?>">删除</a>
						</td>
					</tr>
					<tr>
						<td valign="bottom">
							<div>
								<textarea placeholder="商品简介，显示商品信息" name="details" id="details<?php echo $val['cId']; ?>" disabled><?php echo $val['details']; ?></textarea>
							</div>
							<table width="300" border="0" cellspacing="0" cellpadding="0">
								<tr>
								<?PHP
									for($i=0;$i<count($pics);$i++)
									{
										echo '<td width="60" height="50" align="center"><input type="file" id="file'. $val['cId'] . ($i + 2) . '" name="file'.($i + 2).'" class="fileImg" accept="image/jpeg, image/PNG"><img id="img'. $val['cId'] . ($i + 2) . '" src="../'.$pics[$i]['iAddress'].'" width="50" height="50"></td>';
									}
									for($i=count($pics); $i<5; $i++)
									{
										echo '<td width="60" height="50" align="center"><input type="file" id="file'. $val['cId'] . ($i + 2) . '" name="file'.($i + 2).'" class="fileImg" accept="image/jpeg, image/PNG"><img id="img'. $val['cId'] . ($i + 2) . '" src="img/uplod.jpg" width="50" height="50"></td>';	
									}
								?>
								</tr>
							</table>

						</td>
					</tr>
				</table>
			</form>
			<?PHP 
				}
			?>
		</div>
	</div>
	<script>
		function uploadImg(id)
		{
			//获取对应文件表单元素
			var file = document.getElementById('file'+id);
			file.onchange = function () {
				/*初始化一个文件读取对象*/
				var reader = new FileReader();
				/*读取文件数据  this.files[0] 文件表单元素选择的第一个文件 */
				reader.readAsDataURL(this.files[0]);
				/*读取文件*/
				reader.onload = function () {
					/*读取完毕 base64位数据  表示图片*/
					document.getElementById('img'+id).src = this.result;
				}
			}
			file.click();
		}
		function onClickEdit(ucid, picsC=2)
        {
            document.getElementById('name'+ucid).disabled = false;
			document.getElementById('price'+ucid).disabled = false;
			document.getElementById('stock'+ucid).disabled = false;
			document.getElementById('details'+ucid).disabled = false;
			document.getElementById('className'+ucid).disabled = false;
			document.getElementById('img'+ucid+'1').classList.add('onedit');
			document.getElementById('img'+ucid+'1').setAttribute("onclick","uploadImg('"+ucid+"1')");
			
			for(i=2+picsC;i<7;i++)
			{
				document.getElementById('img'+ucid+i).classList.add('onedit');
				document.getElementById('img'+ucid+i).setAttribute("onclick","uploadImg('"+ucid+i+"')");
			}
            document.getElementById('button'+ucid).setAttribute("value", "修改");
            document.getElementById('button'+ucid).setAttribute("onclick","onSubmit('"+ucid+"')");
        }
        function onSubmit(ucid)
        {
            document.getElementById('form'+ucid).submit();
        }
	</script>
</body>

</html>