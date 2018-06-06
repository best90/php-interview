<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/4 0004
 * Time: 下午 21:47
 */

namespace Pattern;

//抽象状态类
abstract class State
{
    abstract function handle();
}

class Solid extends State
{
    public function handle()
    {
        // TODO: Implement handle() method.
        echo '固态 => 融化 => 液态转化中'.PHP_EOL;
    }
}

class Liquid extends State
{
    public function handle()
    {
        // TODO: Implement handle() method.
        echo '液态 => 蒸发 => 气态转化中'.PHP_EOL;
    }
}

class Gas extends State
{
    public function handle()
    {
        // TODO: Implement handle() method.
        echo '气态 => 凝华 => 固态转化中'.PHP_EOL;
    }
}

//context 环境类 ---- water
class Water
{
    protected $states = [];
    protected $current = 0;

    public function __construct()
    {
        $this->states[] = new Solid;
        $this->states[] = new Liquid;
        $this->states[] = new Gas;
    }

    public function change()
    {
        echo '当前所处状态'.get_class($this->states[$this->current]).PHP_EOL;
        $this->states[$this->current]->handle();
        $this->changeState();
    }

    public function changeState()
    {
        $this->current++ = 2 && $this->current = 0;
    }
}

$water = new Water;
$water->change();
$water->change();
$water->change();
$water->change();