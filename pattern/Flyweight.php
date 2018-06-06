<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/10 0010
 * Time: 下午 12:46
 */

namespace Pattern;


abstract class Flyweight
{
    public $address;
    public function __construct($address)
    {
        $this->address = $address;
    }
}

//具体享元角色
class ConcreteFlyweight extends Flyweight
{
    public function register()
    {
        echo '我报考的考点是'.$this->address.PHP_EOL;
    }

    public function quit()
    {
        unset($this);
    }
}

//享元工厂类
class FlyweightFactor
{
    static private $students = [];
    static public function getStudent($address)
    {
        $students = self::$students;
        if(array_key_exists($address, $students)){
            echo '缓存池有考点为'.$address.',从池中直接取'.PHP_EOL;
        }else{
            echo '缓存池没有，创建考点为'.$address.'的对象并放到池中'.PHP_EOL;
            self::$students[$address] = new ConcreteFlyweight($address);
        }
        return self::$students[$address];
    }
}

//实例化学生对象
$student_1 = FlyweightFactor::getStudent('上海');
//报考
$student_1->register();
//退出
$student_1->quit();

$student_2 = FlyweightFactor::getStudent('广州');
$student_2 ->register();
$student_2->quit();


