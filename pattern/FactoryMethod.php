<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/20 0020
 * Time: 下午 21:20
 */

namespace Pattern;


interface Animal{
    public function run();
    public function say();
}

class Dog implements Animal{
    public function run()
    {
        // TODO: Implement run() method.
        echo 'I am running fast!';
    }

    public function say()
    {
        // TODO: Implement say() method.
        echo 'I am Dog class.';
    }
}

class Cat implements Animal{
    public function run()
    {
        // TODO: Implement run() method.
        echo 'I am running slowly!';
    }

    public function say()
    {
        // TODO: Implement say() method.
        echo 'I am Cat class.';
    }
}

abstract Factory{
    abstract static function create();
}

class DogFactory extends Factory{
    public static function create()
    {
        // TODO: Implement create() method.
        return new Dog();
    }
}

class CatFactory extends Factory{
    public static function create()
    {
        // TODO: Implement create() method.
        return new Cat();
    }
}

$dog = DogFactory::create();
$dog->run();
$dog->say();

$cat = CatFactory::create();
$cat->run();
$cat->say();