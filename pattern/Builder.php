<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/21 0021
 * Time: 下午 17:06
 */

namespace Pattern;


abstract class Builder
{
    protected $car;
    abstract public function buildPartA();
    abstract public function buildPartB();
    abstract public function buildPartC();
    abstract public function getResult();
}

class Car{
    protected $partA;
    protected $partB;
    protected $partC;

    public function setPartA($str)
    {
        $this->partA = $str;
    }

    public function setPartB($str)
    {
        $this->partB = $str;
    }

    public function setPartC($str)
    {
        $this->partC = $str;
    }

    public function show()
    {
        echo '这辆车由：'.$this->partA.','.$this->partB.','.$this->partC.'组成';
    }
}

class CarBuilder extends Builder
{
    public function __construct()
    {
        $this->car = new Car();
    }

    public function buildPartA()
    {
        // TODO: Implement buildPartA() method.
        $this->car->setPartA('发动机');
    }

    public function buildPartB()
    {
        // TODO: Implement buildPartB() method.
        $this->car->setPartB('轮子');
    }

    public function buildPartC()
    {
        // TODO: Implement buildPartC() method.
        $this->car->setPartC('其他零件');
    }

    public function getResult()
    {
        // TODO: Implement getResult() method.
        return $this->car;
    }
}

class Director
{
    public $myBuilder;

    public function startBuilder()
    {
        $this->myBuilder->buildPartA();
        $this->myBuilder->buildPartB();
        $this->myBuilder->buildPartC();
        return $this->myBuilder->getResult();
    }

    public function setBuilder(Builder $builder)
    {
        $this->myBuilder = $builder;
    }
}


$carBuilder = new CarBuilder();
$director = new Director();
$director->setBuilder($carBuilder);
$newCar = $director->startBuilder();
$newCar->show();
