<?PHP
    //包含验证登录文件和函数文件
    include 'att.php';
    include '../functions.php';
    //获取调用的mode方法
    @$mode = $_GET['mode'];
    //定义本页面使用的数据表名
    $tb = 'tb_commodity';
    //定义本页面跳转页面
    $toUrl = 'commMan.php';
    $imagePath = 'img/upload/';
    if($mode == 'add')
    {
        if(isset($_POST['button']))
        {
            //接受并过滤参数
            if(empty($_FILES['file1']['tmp_name']))
                die(jumpMsg('必须上传商品首图！', $toUrl));
            $file1 = $_FILES['file1'];
            $ext = checkIsImage($file1['name']);
            if(!$ext)
                die(jumpMsg('上传图片格式不正确！', $toUrl));
            $file1Path = $imagePath . md5($file1['name'] . time()) . $ext;
            if(!move_uploaded_file($file1['tmp_name'], '../' .$file1Path))
                die(jumpMsg('上传首图失败！', $toUrl));
            //接受并过滤参数
            //商品名
            $name = htmlspecialchars(addslashes($_POST['name']));
            //价格
            $price = (float)$_POST['price'];
            //库存
            $stock = (int)$_POST['stock'];
            //分类ID
            $className = htmlspecialchars(addslashes($_POST['className']));
            //商品详情
            $details = htmlspecialchars(addslashes($_POST['details']));
            if($name == '' || $price == '' || $stock == '' || $className == '')
                die(jumpMsg('请将信息填写完整！', $toUrl));
            //载入数据库连接文件
            include '../conn.php';
            //插入商品信息
            if(!insert($mysql, $tb, array('name'=>$name,'details'=>$details,'figure'=>$file1Path,'price'=>$price,'stock'=>$stock,'ucId'=>$className)))
                die(jumpMsg('添加商品信息失败！', $toUrl));
            // print_r($mysql->lastInsertId());
            $cId = $mysql->lastInsertId();
            for($i=2;$i<7;$i++)
            {
                if(!empty($_FILES['file'.$i]['tmp_name']))
                {
                    $fileTemp = $_FILES['file'.$i];
                    $ext = checkIsImage($fileTemp['name']);
                    if($ext)
                    {
                        $fileTempPath = $imagePath . md5($fileTemp['name'] . uniqid(microtime(true),true)) . $ext;
                        if(move_uploaded_file($fileTemp['tmp_name'], '../' .$fileTempPath))
                        {
                            insert($mysql, 'tb_commodit_imgs', array('cId'=>$cId,'iAddress'=>$fileTempPath));
                        }
                    }
                }
            }
            //die(jumpMsg('添加商品信息成功！', $toUrl));
        }
    }else if($mode == 'edit')
    {
        @$id = (int)$_GET['id'];
        if($id != 0)
        {
            //接受并过滤参数
            if(!empty($_FILES['file1']['tmp_name']))
            {
                $file1 = $_FILES['file1'];
                $ext = checkIsImage($file1['name']);
                if(!$ext)
                    die(jumpMsg('上传图片格式不正确！', $toUrl));
                $file1Path = $imagePath . md5($file1['name'] . time()) . $ext;
                if(!move_uploaded_file($file1['tmp_name'], '../' .$file1Path))
                    die(jumpMsg('上传首图失败！', $toUrl));
            }
            //接受并过滤参数
            //商品名
            $name = htmlspecialchars(addslashes($_POST['name']));
            //价格
            $price = (float)$_POST['price'];
            //库存
            $stock = (int)$_POST['stock'];
            //分类ID
            $className = htmlspecialchars(addslashes($_POST['className']));
            //商品详情
            $details = htmlspecialchars(addslashes($_POST['details']));
            if($name == '' || $price == '' || $stock == '' || $className == '')
                die(jumpMsg('请将信息填写完整！', $toUrl));
            //载入数据库连接文件
            include '../conn.php';
            //更新商品信息 
            if(!empty($_FILES['file1']['tmp_name']))
                $datas = array('name'=>$name,'price'=>$price,'stock'=>$stock,'figure'=>$file1Path,'details'=>$details,'ucId'=>$className);
            else
                $datas = array('name'=>$name,'price'=>$price,'stock'=>$stock,'details'=>$details,'ucId'=>$className);
            update($mysql, $tb, $datas);
            for($i=2;$i<7;$i++)
            {
                if(!empty($_FILES['file'.$i]['tmp_name']))
                {
                    $fileTemp = $_FILES['file'.$i];
                    $ext = checkIsImage($fileTemp['name']);
                    if($ext)
                    {
                        $fileTempPath = $imagePath . md5($fileTemp['name'] . uniqid(microtime(true),true)) . $ext;
                        if(move_uploaded_file($fileTemp['tmp_name'], '../' .$fileTempPath))
                        {
                            insert($mysql, 'tb_commodit_imgs', array('cId'=>$id,'iAddress'=>$fileTempPath));
                        }
                    }
                }
            }

            die(jumpMsg('修改商品信息成功！', $toUrl));
        }
    }else if($mode == 'del')
    {
        @$id = (int)$_GET['id'];
        if($id != 0)
        {
            //载入数据库连接文件
            include '../conn.php';
             //删除类名 
            if(delete($mysql, $tb, 'where cId=' . $id))
                die(jumpMsg('删除商品成功！', $toUrl));
            else
                die(jumpMsg('删除商品失败！', $toUrl));
        }
    }

    //跳转页面
    header("Location: " . $toUrl);
	exit;
    

?>