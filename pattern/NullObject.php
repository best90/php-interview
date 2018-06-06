<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/8 0008
 * Time: 下午 22:49
 */

namespace Pattern;

/*
 * 空对象模式
 */
class NullObject
{
    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        echo 'This is null object.';
    }
}

class Person
{
    public function code()
    {
        echo 'coding make me happy!';
    }
}

function getPerson($name)
{
    if ($name == 'PHPer') {
        return new Person;
    }else {
        return new NullObject;
    }
}

$person = getPerson('PHPers');
$person->code();