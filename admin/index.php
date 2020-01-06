<?PHP include 'att.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>后台管理</title>
    <link rel="stylesheet" href="css/both.css">
</head>

<body>
    <div class="nav-top">
        <span>欢迎你管理员：<?PHP echo $_SESSION['adminUser']?></span>|<a href="../index.php">前往前台首页</a>
    </div>
    <div class="nav-left">
        <div class="logo">后台管理</div>
        <br>
        <div class="menu"><a id="menu0" onclick="onClickA(0,'classMan.php')">》分类管理</a></div>
        <div class="menu"><a id="menu1" onclick="onClickA(1,'commMan.php')" >》商品管理</a></div>
        <div class="menu"><a id="menu2" onclick="onClickA(2,'orderMan.php')">》订单管理</a></div>
        <div class="menu"><a id="menu3" onclick="onClickA(3,'userMan.php')">》用户管理</a></div>
        <div class="menu"><a id="menu4" onclick="onClickA(4,'passMan.php')">》修改密码</a></div>
        <div class="menu"><a href="exit.php">》退出登录</a></div>
    </div>
    <div class="nav-right">
        <iframe id="iframe" style="width: 100%; border: none; height: 100%;" src=""></iframe>
    </div>
    <script>
        //读取cookies
        function getCookie(name)
        {
            var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
            if(arr=document.cookie.match(reg))
                return (arr[2]);
            else
                return null;
        }

        if(getCookie('thisUrl') == null || getCookie('thisUrlId') == null)
        {
            var frame = document.getElementById("iframe");
            frame.src = "classMan.php";
            document.cookie="thisUrlId=0";
            document.cookie="thisUrl=classMan.php";
            
        }else{
            var frame = document.getElementById("iframe");
            frame.src = getCookie('thisUrl');
            document.getElementById('menu'+getCookie('thisUrlId')).classList.add("active");
        }
       
        function onClickA(id,url)
        {
            var i=0;
            for(i=0; i<5; i++)
            {
                if(i != id)
                    document.getElementById('menu'+i).classList.remove("active");
            }
            document.getElementById('menu'+id).classList.add("active");
            var frame = document.getElementById("iframe");
            frame.src = url;
            document.cookie="thisUrlId=" + id;
            document.cookie="thisUrl=" + url;
        }
    </script>
</body>

</html>