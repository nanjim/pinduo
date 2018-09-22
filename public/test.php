<?php

function test ()
{



        $res = file_get_contents("http://mrw.so/api.php?url=http%3A%2F%2Fwww.baidu.com");
        $a = substr($res, 0, 4);
        if ( $a == 'http') {
            return $res;
        }


}
echo test();


