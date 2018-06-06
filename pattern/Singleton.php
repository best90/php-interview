<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/27 0027
 * Time: 下午 20:17
 */

namespace Pattern;


class Singleton
{
    //存放实例
    private static $_instance = null;

    //私有化构造方法
    private function __construct()
    {
        echo '单例模式构造方法';
    }

    //私有化克隆方法
    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    //公开获取实例方法
    public static function getInstance()
    {
        if(self::$_instance instanceof Singleton){
            self::$_instance = new Singleton();
        }
        return self::$_instance;
    }
}