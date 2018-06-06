<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/29 0029
 * Time: 下午 22:25
 */

namespace Pattern;


class Factor
{
    public static function createDB(){
        echo '生产一个DB实例';
        return new DB;
    }
}


class DB
{
    public function __construct()
    {
        echo __CLASS__.PHP_EOL;
    }
}

$db = Factor::createDB();