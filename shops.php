<?PHP
	include 'att.php';
	include 'functions.php';
	include 'conn.php';
	$comInfo = select($mysql, 'tb_user_shop', 'a join tb_commodity b on a.cId = b.cId left join tb_seckill d on a.cId = d.cId and a.type = 2  where uId=' . $_SESSION['userId'],'a.*,b.*,d.recommends');
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
                                <input onclick="onSele(this,'<?PHP echo $val['cId']; ?>')" type="checkbox"
                                    name="checkbox2" id="checkbox2">
                            <td width="100" rowspan="2" align="center"><img src="<?PHP echo $val['figure'] ?>"
                                    width="80%"></td>
                            <td class="cotitle" height="30">
                                <?PHP echo $val['name'] ?>
                            </td>
                            <td class="price" width="150">￥<span id="sprice<?PHP echo $val['cId']; ?>"><?PHP if($val['type'] == 2) echo number_format(($val['recommends'] / 100) * $val['price'],'2') *$val['nums'] ;else echo $val['price']*$val['nums']; ?></span><?PHP if($val['type'] == 2) echo '<span style="padding-left:10px; color: #888; font-size:13px;text-decoration: line-through;">￥'.$val['price'].'</span>'; ?></td>
                        </tr>
                        <tr>
                            <td class="quantity" colspan="2">
                                <span class="<?PHP echo $val['nums'] == 1 ? 'none ' : ''?>reduce" onclick="onSub('<?PHP echo $val['cId']; ?>',<?PHP if($val['type'] == 2) echo number_format(($val['recommends'] / 100) * $val['price'],'2') ;else echo $val['price']; ?>,<?PHP echo $val['stock']; ?>)" id="reduce<?PHP echo $val['cId']; ?>">-减少</span>
                                <span id="nums<?PHP echo $val['cId']; ?>" class="nums"><?PHP echo $val['nums'] ?></span>
                                <span class="<?PHP echo $val['nums'] < $val['stock'] ? '' : 'none '?>increase"
                                    onclick="onAdd('<?PHP echo $val['cId']; ?>',<?PHP if($val['type'] == 2) echo number_format(($val['recommends'] / 100) * $val['price'],'2') ;else echo $val['price']; ?>,<?PHP echo $val['stock']; ?>)"
                                    id="increase<?PHP echo $val['cId']; ?>">+添加</span>
                                <a href="javascript:void(0)" onclick="quitShop('<?PHP echo $val['cId']; ?>')">删除</a>
                                <a href="javascript:void(0)" onclick="buyNow('<?PHP echo $val['cId']; ?>'<?PHP if($val['type']==2) echo ',2' ?>)">购买</a></td>
                        </tr>
                    </table>
                </div>
                <?PHP
						}
				?>
                <div class="biank border">
                    <table width="600" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td height="30" style="padding-left: 10px;">已选中个数：<span id="zongge" class="price">0</span>
                            </td>
                            <td class="buttona" width="150" align="center">
							<a id="delSelect" onclick="delSelect()" href="javascript:void(0)" class="none">删除</a>
							</td>
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
    <script>
    function count(o) {
        var t = typeof o;
        if (t == 'string') {
            return o.length;
        } else if (t == 'object') {
            var n = 0;
            for (var i in o) {
                n++;
            }
            return n;
        }
        return false;
    }
    var zongComs = [];

    function onAdd(id, price, stock) {
        var pri = document.getElementById('sprice' + id);
        var Dnums = document.getElementById('nums' + id);
        var reduce = document.getElementById('reduce' + id);
        var increase = document.getElementById('increase' + id);

        var nums = parseInt(Dnums.innerText);
        if (nums < stock) {
            nums = nums + 1;
            Dnums.innerText = nums;
			if (nums >= stock)
			{
				increase.classList.add('none');
			}else{
				reduce.classList.remove('none');
			}
            pri.innerText = (nums * price).toFixed(2);
        }
    }

    function onSub(id, price, stock) {
        var pri = document.getElementById('sprice' + id);
        var Dnums = document.getElementById('nums' + id);
        var reduce = document.getElementById('reduce' + id);
        var increase = document.getElementById('increase' + id);

        var nums = parseInt(Dnums.innerText);
        if (nums > 1) {
            nums = nums - 1;
            Dnums.innerText = nums;
            if (nums == 1)
				reduce.classList.add('none');
			else{
				increase.classList.remove('none');
				reduce.classList.remove('none');
			}
            pri.innerText = (nums * price).toFixed(2);
        }
    }

    function quitShop(cid) {
        if (confirm("确定要将此商品移除购物车吗？")) {
            window.location.href = "shopData.php?mode=quit&id=" + cid;
        }
    }

    function buyNow(cid,type=1) {
        if (confirm("确定要购买该商品吗？")) {
            var nums = document.getElementById('nums' + cid).innerText;
            window.location.href = "shopData.php?type="+type+"&mode=buy&id=" + cid + "&num=" + nums;
        }
    }

    function onSele(that, cid) {
        if (that.checked == true) {
            var Dnums = document.getElementById('nums' + cid);
            var pri = document.getElementById('sprice' + cid);
            zongComs[cid] = parseInt(Dnums.innerText);
        } else {
            delete zongComs[cid];
        }
   
        if (count(zongComs) > 0)
            document.getElementById('delSelect').classList.remove('none');
        else 
            document.getElementById('delSelect').classList.add('none');
        
        document.getElementById('zongge').innerText = count(zongComs);
    }

    function delSelect() {
		if(count(zongComs) > 0)
		{
			if (confirm("确定要从购物车中删除选中的商品吗？")) {
				var data = [];
				for (var key in zongComs)
				{
					data.push(key);
				}

				window.location.href = "shopDataSel.php?mode=quit&data=" + data.join(',');
			}
		}
    }
    </script>
</body>

</html>