<?php

function test ()
{
    $res = file_get_contents("http://mrw.so/api.php?url=http%3A%2F%2Fwww.baidu.com");
    echo $res;
    $a = substr($res, 0, 4);
    if ( $a == 'http') {
        echo $res;
    } else {
        echo 'err';
        test();
    }

}


