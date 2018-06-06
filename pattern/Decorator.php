<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017-05-31
 * Time: 18:20
 */

namespace Pattern;


interface Decorator
{
    public function beforeDraw();
    public function afterDraw();
}

class AstronautDecorator implements Decorator
{
    public function beforeDraw()
    {
        // TODO: Implement beforeDraw() method.
        echo '穿上T恤'.PHP_EOL;
    }

    public function afterDraw()
    {
        // TODO: Implement afterDraw() method.
        echo '穿上宇航服'.PHP_EOL;
        echo '穿戴完毕'.PHP_EOL;
    }
}

class PoliceDecorator implements Decorator
{
    public function beforeDraw()
    {
        // TODO: Implement beforeDraw() method.
        echo '穿上警服'.PHP_EOL;
    }

    public function afterDraw()
    {
        // TODO: Implement afterDraw() method.
        echo '穿上防弹衣'.PHP_EOL;
        echo '穿戴完毕'.PHP_EOL;
    }
}

class Person
{
    protected $decorators = [];

    //添加装饰器
    public function addDecorator(Decorator $decorator)
    {
        $this->decorators[] = $decorator;
    }

    public function beforeDraw()
    {
        foreach ($this->decorators as $decorator)
        {
            $decorator->beforeDraw();
        }
    }

    public function afterDraw()
    {
        $decorators = array_reverse($this->decorators);
        foreach ($decorators as $decorator)
        {
            $decorator->afterDraw();
        }
    }

    public function clothes()
    {
        $this->beforeDraw();
        echo '穿上长衫'.PHP_EOL;
        $this->afterDraw();
    }
}

$police = new Person;
$police->addDecorator(new  PoliceDecorator);
$police->clothes();

$astronaut = new Person;
$astronaut->addDecorator(new AstronautDecorator);
$astronaut->clothes();

$madman = new Person;
$madman->addDecorator(new PoliceDecorator);
$madman->addDecorator(new AstronautDecorator);
$madman->clothes();