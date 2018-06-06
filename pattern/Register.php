<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/30 0030
 * Time: 下午 20:12
 */

namespace Pattern;


class Register
{
    protected static $objects;
    public static function set($alias, $object)
    {
        self::$objects[$alias] = $object;
    }

    public static function get($alias)
    {
        return self::$objects[$alias];
    }

    public static function _unset($alias)
    {
        unset(self::$objects[$alias]);
    }
}

Register::set('factory',Factor::createDB());