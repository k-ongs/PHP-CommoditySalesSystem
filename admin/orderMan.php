<?PHP
include 'att.php';
include '../functions.php';
include '../conn.php';
$comInfo = select($mysql, 'tb_user_order', 'a join tb_commodity b on a.cId = b.cId join tb_s_user c on a.uId = c.uId');
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
            <form name="formAdd" method="post" action="">添加分类：<input class="inText" type="text" name="classname"> <input type="submit" class="button" name="button" id="button" value="添加"></form>
        </div>
        <div class="card-body">
            <table class="table" width="100%" border="0" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <td width="10%" align="center">ID</td>
                        <td>用户名</td>
                        <td>商品名</td>
                        <td>数量</td>
                        <td>类型</td>
                        <td>总价</td>
                        <td>订单状态</td>
                        <td width="30%" align="center">操作</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if($comInfo){
                            foreach($comInfo as $val)
                            {
                    ?>
                    <tr>
                        <td><?PHP echo $val['oId']; ?></td>
                        <td><?PHP echo $val['userName']; ?></td>
                        <td><?PHP echo $val['name']; ?></td>
                        <td><?PHP echo $val['num']; ?></td>
                        <td><?PHP echo $val['type']==1 ? '正常商品' : '秒杀商品'; ?></td>
                        <td>￥<?PHP echo $val['num'] * $val['price']; ?></td>
                        <?PHP
                            if($val['status'] == '1')
                            {
                                echo '<td><a>等待发货</a></td><td><a href="orderManData.php?id='.$val['oId'].'" class="button">现在发货</a></td>';
                            }else if($val['status'] == '2')
                            {
                                echo '<td><a>等待收货</a></td><td><a class="button none">等待收货</a></td>';
                            }else if($val['status'] == '3')
                            {
                                echo '<td><a href="#">等待评价</a></td><td><a class="button none">等待评价</a></td>';
                            }else
                            {
                                echo '<td><a>已完成</a></td><td><a class="button none">已完成</a></td>';
                            }
                        ?>
                    </tr>
                    <?PHP
                            }
                        }else{
                            echo '<tr><td class="biank border" style="text-align:center;">购物车暂无商品</div></td>';
                        }
				    ?>
                    <!-- <tr>
                        <form name="form1" id="form1" method="post" action="">
                        <td>2</td>
                        <td>用户二</td>
                        <td>蕾姆手办</td>
                        <td>等待发货</td >
                        <td>
                            <a class="button" href="#">现在发货</a>
                        </td>
                        </form>
                    </tr>
                    <tr>
                        <form name="form1" id="form1" method="post" action="">
                        <td>2</td>
                        <td>用户二</td>
                        <td>蕾姆手办</td>
                        <td>完成</td >
                        <td>
                            <a class="button none">已完成</a>
                        </td>
                        </form>
                    </tr> -->
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>