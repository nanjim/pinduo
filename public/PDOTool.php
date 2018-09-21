<?php
/**
 * Created by PhpStorm.
 * User: lewishgl
 * Date: 2016/8/31
 * Time: 11:13 上午
 */

//使用pdo连接数据库 封装增删改查

class PDOTool{

//定义私有属性
    private $host = '192.168.10.10';
    private $port = 3306;
    private $username = 'homestead';
    private $password = 'secret';
    private $dbname = 'homestead';
    private $dbtype = 'mysql';
    public $pdo;

//定义构造函数自动加载配置文件
    function __construct(){

//pdo连接数据库
        $this->pdo = new PDO("$this->dbtype:host=$this->host;dbname=$this->dbname","$this->username","$this->password");
//发送编码
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->query("set names utf8");
    }

    /**
     *   定义执行查询sql语句的方法
     *   参数： 查询sql语句
     *   返回： 二维关联数组
     */
    public function query($sql){
        $res = $this->pdo->query($sql);
        $res->setFetchMode(PDO::FETCH_ASSOC);
        $arr = $res->fetchAll();
        return $arr;
    }


    /**
     *   查询一行记录的方法
     *   参数：表名  条件(不包含where)
     *   返回：一维关联数组
     */
    public function getRow($tablename,$where){
//组装sql语句
        $sql = "select * from $tablename where $where";
//查询
        $res = $this->pdo->query($sql);
        $res->setFetchMode(PDO::FETCH_ASSOC);
        $arr = $res->fetch();
        return $arr;
    }


    /**
     *   查询全部记录
     *   参数：表名
     *   返回：二维关联数组
     */
    public function getAll($tablename){
        $res = $this->pdo->query("select * from $tablename");
        $res->setFetchMode(PDO::FETCH_ASSOC);
        $arr = $res->fetchAll();
        return $arr;
    }

    /**
     *   查询某个字段
     *   参数： 字段名(多个的话用逗号隔开) 表名 条件（不含where）
     *   返回： 二维关联数组
     */
    public function getOne($column,$tablename,$where="1"){
//拼接sql语句
        $sql = "select $column from $tablename where $where";
        $rs = $this->pdo->query($sql);
        $rs->setFetchMode(PDO::FETCH_ASSOC);
//$col = $rs->fetchColumn();
        $col = $rs->fetchAll();
        return  $col;
    }


    /**
     *   查询最后一次插入的数据
     *   参数：表名
     *   返回：数组
     */
    public function getlastone($tablename){
        $sql = "select * from $tablename where id=(select max(id) from $tablename)";
        $res = $this->pdo->query($sql);
        $res->setFetchMode(PDO::FETCH_ASSOC);
        $arr = $res->fetch();
        return $arr;
    }


    /**
     *  向数据库中添加一条信息
     *  参数：表名 一维关联数组
     *  返回: 布尔值
     */
    public function insert($tablename,$arr){
//拿到数组之后先处理数组  过滤字段
        //取出表中的字段
        $sql = "select COLUMN_NAME from information_schema.COLUMNS where table_name = '$tablename' and table_schema ='$this->dbname'";
        $columns = $this->pdo->query($sql);
        $columns->setFetchMode(PDO::FETCH_ASSOC);
        $columns = $columns->fetchAll();
        $cols = array(); //存储表中的全部字段
        foreach($columns as $key=>$val){
            $cols[] = $val['COLUMN_NAME'];
        }
//将要入库的数组进行键值分离
        $keys = array();
        $values = '';
        foreach($arr as $k=>$v){
            if(!in_array($k,$cols)){
                unset($arr[$k]);
            }else{
                $keys[] = '`'.$k.'`';
                $values .= "'".$v."',";
            }
        }
        $column = implode(',',$keys);var_dump($column);
        $values = substr($values,0,-1);
//拼接sql语句
        $sql = "insert into $tablename($column) values ($values)";var_dump($sql);
        try {
            $res = $this->pdo->exec($sql);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $res;
    }

    public function insertBatch($tablename,$arr){
//拿到数组之后先处理数组  过滤字段
        //取出表中的字段
        $sql = "select COLUMN_NAME from information_schema.COLUMNS where table_name = '$tablename' and table_schema ='$this->dbname'";
        $columns = $this->pdo->query($sql);
        $columns->setFetchMode(PDO::FETCH_ASSOC);
        $columns = $columns->fetchAll();
        $cols = array(); //存储表中的全部字段
        foreach($columns as $key=>$val){
            $cols[] = $val['COLUMN_NAME'];
        }
        unset($cols[0]);
        unset($cols[22]);
        unset($cols[23]);

//将要入库的数组进行键值分离
        $keys = array();
        $values = '';
        foreach($arr as $val){
            $value = '';
            foreach ($val as $k=>$v) {
                if(!in_array($k,$cols)){
                    unset($arr[$k]);
                }else{
                    $keys[] = $k;
                    if (is_string($v)) {
                        $value .= "'".$v."',";
                    } else {
                        $value .= $v.",";
                    }

                }
            }
            $value = substr($value, 0, -1);
            $values .= '('.$value.'),';
        }

        foreach ($cols as $k=>$col) {
            $cols[$k] = '`'.$col.'`';
        }

        $column = implode($cols, ',');var_dump($column);
        $values = substr($values,0,-1);

//拼接sql语句
        $sql = "insert into $tablename($column) values $values";
//        echo $sql;exit();
        try {
            $res = $this->pdo->exec($sql);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $res;
    }

    /**
     *   删除数据 其实就是改变字段值使之不被查询
     *   参数：表名 条件(不含where)
     *   返回：布尔
     */
    public function delete($tablename,$where){
        $sql = "update $tablename set is_del=1 where $where";
        $res = $this->pdo->exec($sql);
        return $res;
    }


    /**
     *   修改数据
     *   参数：表名  要修改的数据的数组
     *   返回：布尔
     */
    public function update($tablename,$arr,$where){
//处理传过来的数组
        $str = "";
        foreach($arr as $k=>$v){
            $str .= "$k='".$v."',";
        }
//截取字符串
        $str = substr($str,0,-1);
//拼接sql语句
        $sql = "update $tablename set $str where $where";
        $res = $this->pdo->exec($sql);
        return $res;
    }
}