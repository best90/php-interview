<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/3 0003
 * Time: 下午 22:02
 */

namespace Pattern;

//备忘录角色
class Memento
{
    private $state;

    public function __construct($state)
    {
        $this->state = $state;
    }

    public function getState()
    {
        return $this->state;
    }
}

//备忘录管理者
class Caretaker
{
    private $memento;

    public function setMemento(Memento $memento)
    {
        $this->memento = $memento;
    }

    public function getMemento()
    {
        return $this->memento;
    }
}

//发起人，所需备份者
class Originator
{
    private $state;

    public function setState($state)
    {
        $this->state = $state;
    }

    public function getState()
    {
        echo $this->state.PHP_EOL;
    }

    public function createMemento()
    {
        return new Memento($this->state);
    }

    public function restoreMemento(Memento $memento)
    {
        $this->state = $memento->getState();
    }
}

$role = new Originator;
$role->setState('满血');

$caretaker = new Caretaker;
$caretaker->setMemento($role->createMemento());

$role->setState('死亡');
$role->getState();

$role->restoreMemento($caretaker->getMemento());
$role->getState();