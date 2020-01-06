<?PHP
    include 'att.php';
    include '../conn.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>用户管理</title>
    <link rel="stylesheet" href="css/iframe.css">
</head>

<body>
    <div class="card">
        <div class="card-body">
            <table class="table" width="100%" border="0" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <td width="10%">ID</td>
                        <td>用户名</td>
                        <td>密码</td>
                        <td>性别</td>
                        <td width="10%">余额</td>
                        <td width="30%">操作</td>
                    </tr>
                </thead>
                <tbody>
                    <?PHP
                        foreach(select($mysql,'tb_s_user') as $val)
                        {
                    ?>
                    <tr>
                        <form name="form<?php echo $val['uId'];?>" id="form<?php echo $val['uId'];?>" method="post" action="userManData.php?mode=edit&id=<?PHP echo $val['uId']; ?>">
                        <td><?php echo $val['uId'];?></td>
                        <td><?php echo $val['userName'];?></td>
                        <td><input class="inputText" type="text" id="pass<?php echo $val['uId'];?>" name="pass" disabled value="<?php echo $val['userPass'];?>"></td>
                        <td>
                            <select name="sex" id="sex<?php echo $val['uId'];?>" class="inputText" disabled>
                                <option value="男" <?PHP echo $val['sex'] == '男' ? 'selected' : '' ?> >男</option>
                                <option value="女" <?PHP echo $val['sex'] == '女' ? 'selected' : '' ?>>女</option>
                            </select>
                        </td>
                        <td><input class="inputText" type="text" id="balance<?php echo $val['uId'];?>" name="balance" disabled value="<?php echo $val['balance'];?>"></td >
                        <td>
                            <input type="button" class="button" onclick="onClickEdit('<?php echo $val['uId'];?>')" name="button" id="button<?php echo $val['uId'];?>" value="编辑">
                            <a class="button" href="userManData.php?mode=del&id=<?PHP echo $val['uId']; ?>">删除</a>
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
            document.getElementById('sex'+ucid).disabled = false;
            document.getElementById('pass'+ucid).disabled = false;
            document.getElementById('balance'+ucid).disabled = false;
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