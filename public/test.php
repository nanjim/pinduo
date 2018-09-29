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
        $subject = "www.php.aaa.net";
//        $pattern = "#^(?:http://)?([^/]+)#i";
        $pattern = "/[^.]+\.[^.]+/";
        preg_match_all($pattern, $subject, $matchs);
        var_dump($matchs);
    }

    function test1()
    {
        $sub = "aabbaacc";
        $patt = "/aa(?:b|c)/";
        preg_match_all($patt, $sub, $matchs);
        var_dump($matchs);
    }

    function hshs()
    {
        $a = ['a'=>12];
        $b = ['a'=>45];
        var_dump($a+$b);
    }




}

$pdo = new PDOtest();
$pdo->hshs();


