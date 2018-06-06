<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/21 0021
 * Time: 下午 17:37
 */

namespace Pattern;

//抽象原型类
abstract class Prototype
{
    abstract function __clone();
}

//具体原型类
class Map extends Prototype
{
    public $width;
    public $height;
    public $sea;

    public function setAtttibute(array $attributes)
    {
        foreach ($attributes as $key => $val){
            $this->$key = $val;
        }
    }

    public function __clone()
    {
        // TODO: Implement __clone() method.
    }
}

//海洋类
class Sea
{

}

//使用原型模式创建对象方法如下
//先创建一个原型对象
$map_prototype = new Map();
$attributes = [
    'width' => 40,
    'height' => 60,
    'sea' => (new Sea)
];
$map_prototype->setAtttibute($attributes);

//现在已经创建好原型对象。如果我们要创建新的map对象只需要克隆一下
$new_map = clone $map_prototype;

var_dump($new_map);
var_dump($map_prototype);