<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/20 0020
 * Time: 下午 22:17
 */

namespace Pattern;

interface TV{
    public function open();
    public function watch();
}

class HaierTV implements TV{
    public function open()
    {
        // TODO: Implement open() method.
        echo 'open Haier TV.'
    }

    public function watch()
    {
        // TODO: Implement watch() method.
        echo 'I am watching TV.';
    }
}

interface PC{
    public function work();
    public function play();
}

class LenovoPC implements PC{
    public function work()
    {
        // TODO: Implement work() method.
        echo 'I am working.';
    }

    public function play()
    {
        // TODO: Implement play() method.
        echo 'I am playing.';
    }
}

abstract class Factory{
    abstract static function createTV();
    abstract static function createPC();
}

class ProductFactory extends Factory{
    public static function createTV()
    {
        return new HaierTV();
    }

    public static function createPC()
    {
        return new LenovoPC();
    }
}

$tv = ProductFactory::createTV();
$tv->open();
$tv->watch();

$pc = ProductFactory::createPC();
$pc->work();
$pc->play();