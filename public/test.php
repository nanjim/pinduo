<?php

class PDOtest {
    private $dsn = 'mysql:host=192.168.10.10;dbname=homestead';
    private $user = 'homestead';
    private $password = 'secret';

    const HELL = 123;

    function add()
    {
        try {
            $db = new PDO($this->dsn, $this->user, $this->password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $db->prepare("select*from test where id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute(['id'=>5]);
            $res = $stmt->fetch();
            var_dump($res['num']);

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function listFiles($dir)
    {
        $files = array();
        $handle = opendir($dir);

        while ($file = readdir($handle)) {
            if ($file != '.' && $file != '..') {
                if (is_dir($dir.'/'.$file)) {
                    $files[$file] = $this->listFiles($dir.'/'.$file);
                } else {
                    $files[] = $file;
                }
            }
        }
        closedir($handle);
        return $files;
    }

    function quikSort($arr)
    {
        if (count($arr)>1) {
            $a = array();
            $b = array();
            $k = $arr[0];
            $size = count($arr);
            for ($i=1; $i<$size; $i++) {
                if ($arr[$i]<$k) {
                    $a[] = $arr[$i];
                } else {
                    $b[] = $arr[$i];
                }
            }
            $a = $this->quikSort($a);
            $b = $this->quikSort($b);
            return array_merge($a, array($k), $b);
        } else {
            return $arr;
        }
    }

    function test()
    {
        echo $_SERVER['SERVER_NAME'];
    }

}

$pdo = new PDOtest();
$pdo->test();


