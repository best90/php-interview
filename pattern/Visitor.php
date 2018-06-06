<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/5 0005
 * Time: 下午 22:22
 */

namespace Pattern;


class Visitor
{
    public function doSomething($object)
    {
        echo '我可以返老返童到'.$object->age = 18;
    }
}

class Superman
{
    public $name;

    public function doSomethin()
    {
        echo '我是超人，我会飞。'.PHP_EOL;
    }

    public function accept(Visitor $visitor)
    {
        $visitor->doSomething($this);
    }
}

$superman = new Superman;
$superman->doSomethin();
$superman->accept(new Visitor);