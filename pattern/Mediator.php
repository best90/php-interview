<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/5 0005
 * Time: 下午 22:34
 */

namespace Pattern;

//抽象同事类 ---电话机
abstract class Colleague
{
    protected $mediator;
    abstract public function sendMsg($num,$msg);
    abstract public function receiveMsg($msg);

    final public function setMediator(Mediator $mediator)
    {
        $this->mediator = $mediator;
    }
}

//抽象中介者类
abstract class Mediator
{
    abstract public function operation($id, $message);
    abstract public function register($id, Colleague $colleague);
}

class Phone extends Colleague
{
    public function sendMsg($num, $msg)
    {
        // TODO: Implement sendMsg() method.
        echo __CLASS__.'--发送声音：'.$msg.PHP_EOL;
        $this->mediator->operation($num, $msg);
    }

    public function receiveMsg($msg)
    {
        // TODO: Implement receiveMsg() method.
        echo __CLASS__.'--接收声音：'.$msg.PHP_EOL;
    }
}

class Telephone extends Colleague
{
    public function sendMsg($num, $msg)
    {
        // TODO: Implement sendMsg() method.
        echo __CLASS__.'--发送声音：'.$msg.PHP_EOL;
        $this->mediator->operation($num, $msg);
    }

    public function receiveMsg($msg)
    {
        // TODO: Implement receiveMsg() method.
        echo '响铃----'.PHP_EOL;
        echo __CLASS__.'--接收声音：'.$msg.PHP_EOL;
    }
}

class switches extends Mediator
{
    protected $colleagues = [];

    public function operation($id, $message)
    {
        // TODO: Implement operation() method.
        if (!array_key_exists($num, $this->colleagues)){
            echo __CLASS__.'--交换机内没有此号码信息，无法通话'.PHP_EOL;
        }else{
            $this->colleagues[$num]->recevieMsg($message);
        }
    }

    public function register($num, Colleague $colleague)
    {
        if (!in_array($colleague, $this->colleagues)){
            $this->colleagues[$num] = $colleague;
        }
        $colleague->setMediator($this);
    }
}

$phone = new Phone;
$telephone = new Telephone;

$switches = new Switches;

$switches->register(6666668, $phone);
$switches->register(18888888888, $telephone);

$phone->sendMsg(18888888888, 'hello world');
$telephone->sendMsg(6666668, '请说普通话');
