<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/2 0002
 * Time: 下午 17:52
 */

namespace Pattern;

//命令接收者
class TV
{
    public function action()
    {
        echo '接收到命令，执行成功'.PHP_EOL;
    }
}

//抽象命令角色
abstract class Command
{
    protected $receiver;
    public function __construct(TV $receiver)
    {
        $this->receiver = $receiver;
    }

    abstract public function execute();
}

//具体命令角色 开机命令
class CommandOn extends Command
{
    public function execute()
    {
        // TODO: Implement execute() method.
        $this->receiver->action();
    }
}

//具体命令角色  关机命令
class CommandOff extends Command
{
    public function execute()
    {
        // TODO: Implement execute() method.
        $this->receiver->action();
    }
}

//命令发送者  --遥控器
class Invoker
{
    protected $command;
    public function setCommand(Command $command)
    {
        $this->command = $command;
    }

    public function send()
    {
        $this->command->execute();
    }
}

//买一台电视机
$receiver = new TV();
//配一个遥控器
$invoker = new Invoker();
//设置遥控器按键匹配电视机
$commandOn = new CommandOn($receiver);
$commandOff = new CommandOff($receiver);

//按下开机按钮
$invoker->setCommand($commandOn);
$invoker->send();
//按下关机按钮
$invoker->setCommand($commandOff);
$invoker->send();