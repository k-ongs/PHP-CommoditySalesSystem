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
            <form name="formAdd" method="post" action="classManData.php?mode=add">添加分类：<input class="inText" type="text" name="classname"> <input type="submit" class="button" name="button" id="button" value="添加"></form>
        </div>
        <div class="card-body">
            <table class="table" width="100%" border="0" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <td width="10%" align="center">ID</td>
                        <td width="60%" align="center">分类名</td>
                        <td width="30%" align="center">操作</td>
                    </tr>
                </thead>
                <tbody>
                    <?PHP 
                        foreach(select($mysql,'tb_commodit_class') as $val)
                        {
                    ?>
                    <tr>
                        <form name="form<?PHP echo $val['ucId']; ?>" id="form<?PHP echo $val['ucId']; ?>" method="post" action="classManData.php?mode=edit&id=<?PHP echo $val['ucId']; ?>">
                        <td><?PHP echo $val['ucId']; ?></td>
                        <td><input class="inputText" type="text" id="className<?PHP echo $val['ucId']; ?>" name="className" disabled value="<?PHP echo $val['ccName']; ?>"></td >
                        <td>
                            <input type="button" class="button" onclick="onClickEdit('<?PHP echo $val['ucId']; ?>')" name="button" id="button<?PHP echo $val['ucId']; ?>" value="编辑">
                            <a class="button" href="classManData.php?mode=del&id=<?PHP echo $val['ucId']; ?>">删除</a>
                        </td>
                        </form>
                    </tr>
                    <?PHP
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <script>
        function onClickEdit(ucid)
        {
            document.getElementById('className'+ucid).disabled = false;
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