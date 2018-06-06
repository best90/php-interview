<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/18 0018
 * Time: 下午 22:57
 */

namespace Pattern;


abstract class Template
{
    protected $balance = 100;
    //结算方法
    abstract protected function adjust($num);
    //支付信息显示
    abstract protected function display($num);

    final public function apply($num)
    {
        $this->adjust($num);
        $this->display($num);
    }
}

class Account extends Template
{
    protected $flag;

    protected function adjust($num)
    {
        // TODO: Implement adjust() method.
        if ($this->balance > $num){
            $this->balance -= $num;
            $this->flag = true;
        }else{
            $this->flag = false;
        }
    }

    protected function display($num)
    {
        if($this->flag){
            echo '支付成功，当前余额为'.$this->balance.PHP_EOL;
        }else{
            echo '余额不足，支付失败。'.PHP_EOL;
        }
    }
}

class Credit extends Template
{
    protected function adjust($num)
    {
        $this->balance -= $num;
    }

    protected function display($num)
    {
        echo '感谢您使用信用卡支付，所剩余额为'.$this->balance.PHP_EOL;
    }
}

//普通账户使用
$account = new Account;
$account->apply(80);
$account->apply(30);

//信用卡支付使用
$credit = new Credit;
$credit->apply(200);