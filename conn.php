<?php
    try {
        $mysql = new PDO("mysql:host=127.0.0.1;dbname=A100086", 'A100086', 'Z0H6O1U6X2I0');
    } catch (PDOException $e) {
        echo '数据库服务器连接错误: ' . $e->getMessage();
    }
    $mysql -> query("set names utf8");

    //给字段和表名添加 `符号
    function _addChar($value)
    { 
		if ($value == '*' || strpos($value, '(') !== false || strpos($value, '.') !== false || strpos($value, '`') !== false) { 
			//如果包含*或者使用了sql方法则不作处理 
		} elseif (false === strpos($value,'`') ) { 
			$value = '`'.trim($value).'`';
		} 
		return $value; 
    }
    //过滤并格式化数据表字段
    function _dataFormat($data)
    {
        if (!is_array($data)) return false;
		$ret=array();
		foreach ($data as $key=>$val) {
			$key = _addChar($key);
			if (is_int($val)) { 
				$val = intval($val); 
			} elseif (is_float($val)) { 
				$val = floatval($val); 
			} elseif (preg_match('/^\(\w*(\+|\-|\*|\/)?\w*\)$/i', $val)) {
				$val = $val;
			} elseif (is_string($val)) { 
				$val = '"'.addslashes($val).'"';
			}
			$ret[$key] = $val;
		}
        return $ret;
    }

    //自定义sql查询函数
    function select($mysql, $tb, $factor = '', $field='*')
    {
        //组成sql语句
        $sql = 'select ' . $field . ' from ' . $tb . ' ' . $factor;
        //执行sql语句
        $result= $mysql -> query($sql);
        //判断返回条数
        if(!$result || ! $result -> rowCount())
            return array();
        //循环将查询到的记录放入数组
        $array = array();
        foreach ($result as $v) {
            $array[] = $v;
        }
        return $array;
    }

    //自定义sql插入函数
    function insert($mysql, $tb, $data)
    {
        //格式化数据
        $data = _dataFormat($data);
        if (!$data) return false;
        //组成sql语句
		$sql = 'insert into ' . $tb . '(' . implode(',', array_keys($data)) . ') values(' . implode(',', array_values($data)) . ')';
        //执行sql语句
        return $mysql -> exec($sql);
    }

    //自定义sql删除函数
    function delete($mysql, $tb, $factor = '')
    {
        //组成sql语句
        $sql = 'delete from ' . $tb . ' ' . $factor;
        //执行sql语句
        return $mysql -> exec($sql);
    }
    
    //自定义sql更新函数
    function update($mysql, $tb, $data, $factor='')
    {
        //格式化数据
        $data = _dataFormat($data);
        if (!$data) return false;
        $valArr = array();
        foreach($data as $k => $v){
            $valArr[] = $k . '=' . $v;
        }
        $valStr = implode(',', $valArr);
        //组成sql语句
        $sql = 'update ' . trim($tb) . ' set ' . trim($valStr) . " " . $factor;
		//执行sql语句
        return $mysql -> exec($sql);
    }
?>