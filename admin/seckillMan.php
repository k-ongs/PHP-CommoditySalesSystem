<?PHP
    include 'att.php';
    include '../conn.php';

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>分类管理</title>
    <link rel="stylesheet" href="css/iframe.css">
</head>

<body>
    <div class="card">
        <div class="card-header">
            秒杀商品管理
        </div>
        <div class="card-body">
            <table class="table seckill" width="100%" border="0" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <td width="10%" align="center">ID</td>
                        <td width="30%" align="center">商品名</td>
                        <td width="5%" align="center">状态</td>
                        <td width="15%" align="center">开始时间</td>
                        <td width="15%" align="center">结束时间</td>
                        <td width="5%" align="center">数量</td>
                        <td width="5%" align="center">折扣率(%)</td>
                        <td width="20%" align="center">操作</td>
                    </tr>
                </thead>
                <tbody>
                    <?PHP 
                        foreach(select($mysql,'tb_commodity','a left join tb_seckill  b on a.cId = b.cId','a.cId,a.name,a.stock,b.sId,b.nums,b.recommends,b.startDate,b.endDate') as $val)
                        {

                    ?>
                    <tr>
                        <?PHP
                            if($val['sId'])
                            {
                        ?>
                        <form name="form<?PHP echo $val['sId']; ?>" id="form<?PHP echo $val['sId']; ?>" method="post" action="seckillManData.php?mode=edit&id=<?PHP echo $val['sId']; ?>">
                            <td><?PHP echo $val['sId']; ?></td>
                            <td><?PHP echo $val['name']; ?></td>
                            <td>已添加</td>
                            <td><input disabled type="datetime-local" name="staTime" id="staTime<?PHP echo $val['sId']; ?>" value="<?PHP echo date("Y-m-d\TH:m",strtotime($val['startDate'])); ?>" /></td>
                            <td><input disabled type="datetime-local" name="endTime" id="endTime<?PHP echo $val['sId']; ?>" value="<?PHP echo date("Y-m-d\TH:m",strtotime($val['endDate'])); ?>" /></td>
                            <td><input disabled type="text" name="num" id="num<?PHP echo $val['sId']; ?>" value="<?PHP echo $val['nums']; ?>" /></td>
                            <td><input disabled type="text" name="recom" id="recom<?PHP echo $val['sId']; ?>" value="<?PHP echo $val['recommends']; ?>" /></td>
                            <td>
                                <input type="button" class="button" onclick="onClickEdit('<?PHP echo $val['sId']; ?>')" name="button" id="button<?PHP echo $val['sId']; ?>" value="编辑">
                                <a class="button" href="seckillManData.php?mode=del&id=<?PHP echo $val['sId']; ?>">删除</a>
                            </td>
                        </form>
                        <?PHP
                            }else{
                        ?>
                        <form name="formc<?PHP echo $val['cId']; ?>" method="post" action="seckillManData.php?mode=add&id=<?PHP echo $val['cId']; ?>">
                            <td>暂未分配</td>
                            <td><?PHP echo $val['name']; ?></td>
                            <td>未添加</td>
                            <td><input type="datetime-local" name="staTime" id="staTime" value="<?PHP echo date("Y-m-d\TH:m"); ?>" /></td>
                            <td><input type="datetime-local" name="endTime" id="endTime" value="<?PHP echo date("Y-m-d\TH:m",strtotime("+1 month")); ?>" /></td>
                            <td><input type="text" name="num" id="num" value="100" /></td>
                            <td><input type="text" name="recom" id="recom" value="90" /></td>
                            <td>
                                <input type="submit" class="button" name="button" id="button" value="添加">
                            </td>
                        </form>
                        <?PHP
                            }
                        ?>
                    </tr>
                    <?PHP
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <script>
        function onClickEdit(sid)
        {
            document.getElementById('staTime'+sid).disabled = false;
            document.getElementById('endTime'+sid).disabled = false;
            document.getElementById('num'+sid).disabled = false;
            document.getElementById('recom'+sid).disabled = false;
            document.getElementById('button'+sid).setAttribute("value", "修改");
            document.getElementById('button'+sid).setAttribute("onclick","onSubmit('"+sid+"')");
        }
        function onSubmit(sid)
        {
            document.getElementById('form'+sid).submit();
        }
    </script>
</body>

</html>