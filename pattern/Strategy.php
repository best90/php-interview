<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/11 0011
 * Time: 上午 10:05
 */

namespace Pattern;

abstract class Strategy
{
    abstract function peddle();
}

class FemaleStrategy extends Strategy
{
    public function peddle()
    {
        // TODO: Implement peddle() method.
        echo '夏季女装流行风尚标'.PHP_EOL;
    }
}

class MaleStrategy extends Strategy
{
    public function peddle()
    {
        // TODO: Implement peddle() method.
        echo '夏季精品男装推荐'.PHP_EOL;
    }
}

class UnknownStrategy extends Strategy
{
    public function peddle()
    {
        // TODO: Implement peddle() method.
        echo '夏季男女款推荐'.PHP_EOL;
    }
}

class Context
{
    protected $strategy;
    public function __construct(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function request()
    {
        $this->strategy->peddle();
    }
}

//女性用户环境
$female_strategy = new Context(new FemaleStrategy);
$female_strategy->request();

//男性用户环境
$male_strategy = new Context(new MaleStrategy);
$male_strategy->request();

//未知环境
$unknown_strategy = new Context(new UnknownStrategy);
$unknown_strategy->request();