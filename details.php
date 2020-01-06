<?PHP 
	header("Content-type:text/html;charset=utf-8");
	session_start();
	include 'conn.php';
    include 'functions.php';
    @$id = (int)$_GET['id'];
    $userinfo = select($mysql, 'tb_commodity', 'where cId=' . $id);
    if(!$userinfo)
    {
        header("Location: classify.php");
		exit;
    }
    $userinfo = $userinfo[0];
    $comments = select($mysql, 'tb_comment', 'a join tb_s_user b on a.uId=b.uId where cId=' . $id,'a.*,b.userName');
    $similar = select($mysql, 'tb_commodity', 'where  ucId='. $userinfo['ucId'] .' and cId!=' . $id . ' limit 2');
    $pics = select($mysql,'tb_commodit_imgs', 'where cId='.$userinfo['cId']);
?>
<!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>商品详情</title>
    <link rel="stylesheet" href="css/both.css">
    <link rel="stylesheet" href="css/details.css">
</head>

<body>
    <?PHP echoHead(); ?>
    <br>
    <table class="border" width="900" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <table style="margin-bottom:10px;" width="900" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="300" height="360" valign="top">
                            <table width="300" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="300" height="300" align="center" valign="middle">
                                        <img id="showImg" src="<?PHP echo $userinfo['figure'] ?>" width="90%">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="250" height="60" valign="bottom" style="overflow:hidden;">
                                        <div class="showPicture">
                                        <img class="showPictureImg active" onmouseover="comIn(this)" onclick="comIn(this.src)" src="<?PHP echo $userinfo['figure'] ?>" width="50">
                                            <?php
                                                foreach($pics as $val)
                                                {
                                                    echo '<img class="showPictureImg" onmouseover="comIn(this)" onclick="comIn(this.src)" src="'.$val['iAddress'].'" width="50">';
                                                }
                                            ?>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td valign="middle">
                            <table width="600" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td class="showTil" height="70" colspan="2" valign="top"><?PHP echo $userinfo['name'] ?></td>
                                </tr>
                                <tr>
                                    <td width="50" height="35" align="right">价格：</td>
                                    <td class="showprice">￥<span id="sprice"><?PHP echo $userinfo['price'] ?></span></td>
                                </tr>
                                <tr>
                                    <td style="border-bottom: 1px solid #ccc;" height="70" colspan="2">
                                        <div class="showM">销量 <?PHP echo $userinfo['sales'] ?></div>
                                        <div class="showM">库存 <?PHP echo $userinfo['stock'] ?></div>
                                        <div class="showM">评价 <?PHP echo count($comments); ?></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="60" align="right" valign="middle">数量：</td>
                                    <td class="quantity" height="60" valign="middle">
                                        <span onclick="onSub()" class="none" id="reduce">-减少</span>
                                        <span id="Dnums" class="nums">1</span>
                                        <span onclick="onAdd()" id="increase">+添加</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="50" colspan="2" align="center" valign="middle">
                                        <input onclick="buyNow()" class="buyNow" type="submit" name="button2" id="button2" value="立即购买">
                                        <input onclick="joinShop()" class="joinShop" type="submit" name="button3" id="button3" value="加入购物车">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <table style="border-top:1px solid #000;" width="900" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="232" style="border-right:1px solid #000;">
                            <div style=" border-bottom:1px solid #000; font-size:16px; font-weight:bold; padding:10px;">
                                相似商品：</div>
                            <?PHP
                                foreach($similar as $val)
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
                        <td align="center" valign="top">
                            <div
                                style=" text-align:left; border-bottom:1px solid #000; font-size:16px; font-weight:bold; padding:10px;">
                                商品评论(<?PHP echo count($comments); ?>)：</div>
                            <br>
                            <?PHP
                                if(count($comments) > 0)
                                {
                                    foreach($comments as $key => $val)
                                    {
                            ?>
                            <table style="border:1px solid #ccc; margin-bottom:10px;" width="640" border="0"
                                cellspacing="0" cellpadding="0">
                                <tr style="border-bottom:1px solid #ccc;">
                                    <td style="padding-left:10px; border-right:1px solid #ccc;">#<?PHP echo $key+1 ?>楼</td>
                                    <td style="padding-left:10px; border-right:1px solid #ccc;" width="200" height="40">用户名：<?PHP echo $val['userName'] ?></td>
                                    <td style="padding-left:10px;">时间：<?PHP echo $val['date'] ?></td>
                                </tr>
                                <tr>
                                    <td style="padding:20px 10px;" colspan="3" valign="top"><?PHP echo $val['content'] ?></td>
                                </tr>
                            </table>
                            <?PHP
                                    }
                                }else{
                                    echo '<div style="font-size: 20px; font-weight: bold">暂无评论</div>';
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
    <script>
        var loginEd = <?PHP if(!isset($_SESSION['userPass']) || !isset($_SESSION['userName']) || !isset($_SESSION['userId'])) echo 0; else echo 1;?>;
        var price = <?PHP echo $userinfo['price'] ?>;
        var stock = <?PHP echo $userinfo['stock'] ?>;
        function onAdd(){
            var pri = document.getElementById('sprice');
            var Dnums = document.getElementById('Dnums');
            var reduce = document.getElementById('reduce');
            var increase = document.getElementById('increase');
            
            var nums = parseInt(Dnums.innerText);
            if(nums < stock)
            {
                nums = nums + 1;
                Dnums.innerText = nums;
                if(nums == stock)
                    increase.classList.add('none');
                if(nums == 2)
                    reduce.classList.remove('none');
                pri.innerText = (nums * price).toFixed(2);
            }
        }
        function onSub(){
            var pri = document.getElementById('sprice');
            var Dnums = document.getElementById('Dnums');
            var reduce = document.getElementById('reduce');
            var increase = document.getElementById('increase');
            
            var nums = parseInt(Dnums.innerText);
            if(nums > 1)
            {
                nums = nums - 1;
                Dnums.innerText = nums;
                if(nums == 1)
                    reduce.classList.add('none');
                if(nums < stock)
                    increase.classList.remove('none');
                pri.innerText = (nums * price).toFixed(2);
            }
        }
        function comIn(thisImg)
        {
            var imgs = document.getElementsByClassName('showPictureImg');
            for(i=0; i < imgs.length; i++)
                imgs[i].classList.remove('active');
            document.getElementById('showImg').src = thisImg.src;
            thisImg.classList.add('active');
        }
        function buyNow()
        {
            if(loginEd){
                if(confirm("确定要购买该商品吗？"))
                {
                    var nums = document.getElementById('Dnums').innerText;
                    var id = <?PHP echo $userinfo['cId'] ?>;
                    window.location.href = "detailsBuy.php?id="+id+"&num="+nums;
                }
            }else{
                alert("您还未登录，请先登录！");
                window.location.href = "login.php";
            }
        }
        function joinShop()
        {
            if(loginEd){
                if(confirm("确定要将此商品加入购物车吗？"))
                {
                    var nums = document.getElementById('Dnums').innerText;
                    var id = <?PHP echo $userinfo['cId'] ?>;
                    window.location.href = "detailsJoinShop.php?id="+id+"&num="+nums;
                }
            }else{
                alert("您还未登录，请先登录！");
                window.location.href = "login.php";
            }
        }
    </script>
</body>

</html>