<?PHP

    //返回JS弹窗与跳转页面代码
    function jumpMsg($msg, $url, $parent=false){
        if($parent)
        {
            return '<script>alert("'.$msg.'"); parent.window.location.href = "'.$url.'";</script>';   
        }
        return '<script>alert("'.$msg.'");window.location.href = "'.$url.'";</script>';
    }

    //返回JS弹窗与返回上一页代码
    function backMsg($msg)
    {
        return '<script>alert("'.$msg.'");window.history.back(-1);</script>';
    }

    //生成下拉框
    function makeSelect($data, $classVal, $nameVal, $idVal, $keySelected = '', $disabled = false)
    {
        $html = '<select class="' . $classVal . '" name="' . $nameVal . '" id="' . $idVal . '" ' . ($disabled ? 'disabled' : '') . '>';
            // <option>分类A</option>
        foreach($data as $val)
        {
            $html .= '<option value="' . $val['ucId'] . '" ' . ($val['ucId'] == $keySelected ? 'selected' : '') . '>'.$val['ccName'].'</option>';
        }
        $html .= '</select>';
        return $html;
    }

    //检查的图片类型,返回图片后缀
    function checkIsImage($filename){
        $alltypes = array('.jpg','.jpeg','.png');
        $arr = explode('.', $filename);
        @$ext = '.'.$arr[count($arr)-1];
        if(in_array($ext,$alltypes))
            return $ext;
        return false;
    }

    //判断ke有没有在二维数组里面
    function inTwoArray($ke, $arr)
    {
        foreach($arr as $val)
        {
            if(in_array($ke,array_values($val)))
                return true;
        }
        return false;
    }

    function echoHead($page = 'none', $width=900)
    {
        echo '<table class="border" width="'.$width.'" border="0" align="center" cellpadding="0" cellspacing="0">';
        echo '	<tr>';
        echo '		<td height="40" colspan="2">';
        echo '			<table class="nav-bd border-bottom" width="100%" border="0" cellspacing="0" cellpadding="0">';
        echo '				<tr>';
        echo '					<td height="40" class="nav-user">';
        if(isset($_SESSION['userName']))
        {
            echo "欢迎你，" . $_SESSION['userName'] . '<a style="padding-left: 20px;" ' . ($page == 'userinfo' ? 'class="active"' : 'href="userinfo.php"') . '>我的信息</a><a style="padding-left: 20px;" href="exit.php">点击退出</a>';
        }else{
            echo '<a target="_blank" class="nav-a-login" href="login.php">亲，请登录</a> <a  target="_blank" class="nav-a-reg" href="register.php">免费注册</a>';
        }
        echo '					</td>';
        echo '					<td width="60" align="right"><a ' . ($page == 'index' ? 'class="active"' : 'href="index.php"') . '>首页</a></td>';
        echo '					<td width="60" align="right"><a ' . ($page == 'classify' ? 'class="active"' : 'href="classify.php"') . '>分类</a></td>';
        echo '					<td width="200" align="center"><a ' . ($page == 'shops' ? 'class="active"' : 'href="shops.php"') . '>购物车</a></td>';
        echo '				</tr>';
        echo '			</table>';
        echo '		</td>';
        echo '	</tr>';
        echo '	<tr class="border-bottom">';
        echo '		<td class="logo" width="230" height="90" align="center" valign="middle"><img src="img/logo.png"></td>';
        echo '		<td align="center" valign="middle" class="search">';
        echo '			<form name="form1" method="post" action="search.php">';
        echo '				<input type="text" name="search" id="search">';
        echo '				<input type="submit" name="button" id="button" style="margin: 0px;" value="搜索">';
        echo '		</form>';
        echo '		</td>';
        echo '	</tr>';
        echo '</table>';
    }

    function echoFooter($width=900)
    {
        echo'    <table class="border" width="'.$width.'" border="0" align="center" cellpadding="0" cellspacing="0">';
        echo'        <tr>';
        echo'            <td colspan="2" align="center">';
        echo'                <p><a href="admin/login.php">管理入口</a></p>';
        echo'                <p>（渝ICP备18014910号）</p>';
        echo'            </td>';
        echo'        </tr>';
        echo'    </table>';
    }
    
    //生成分页部分
    function makePage($page_count, $page, $url)
    {
        $html = '<table class="border" style="margin-top: 10px;" width="900" border="0" align="center" cellpadding="0" cellspacing="0">';
		$html .= '<tr>';
		$html .= '<td class="turn" align="center">';
		$html .= '<a '. ($page == 1 ? 'class="none"' : 'href="' . $url . '&page=1"') . '>首页</a>';
        $html .= '<a ' . ($page <= 1 ? 'class="none"' : 'href="' . $url . '&page=' . ($page-1) . '"') . '>上一页</a>';
		if($page == $page_count && $page - 2 > 0)
            $html .= '<a href="' . $url . '&page=' . ($page-2) . '">' . ($page-2) . '</a>';
		if($page - 1 > 0)
            $html .= '<a href="' . $url . '&page='. ($page-1) . '">' . ($page - 1) . '</a>';
        $html .= '<a class="active">' . $page . '</a>';
        if($page + 1 <= $page_count)
            $html .= '<a href="' . $url . '&page=' . ($page+1).'">' . ($page + 1) . '</a>';
		if($page == 1 && $page + 2 <= $page_count)
            $html .= '<a href="' . $url . '&page=3">3</a>';
				
        $html .= '<a ' . ($page >= $page_count ? 'class="none"' : 'href="' . $url . '&page='.($page+1).'"') .' >下一页</a>';
        $html .= '<a ' . ($page == $page_count ? 'class="none"' : 'href="' . $url . '&page='.$page_count.'"') . '>尾页</a>';
		$html .= '</td>';
		$html .= '</tr>';
        $html .= '</table>';
        return $html;
    }