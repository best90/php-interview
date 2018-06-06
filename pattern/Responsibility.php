<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/25 0025
 * Time: 下午 23:12
 */

namespace Pattern;

class Request
{
    protected $level = [
        '请假'=>0,
        '休假'=>1,
        '辞职'=>2
    ];
    protected $request;
    public function __construct($resquest)
    {
        $this->request = $resquest;
    }

    public function getLever()
    {
        return array_key_exists($this->request,$this->level) ? $this->level[$this->request] : -1;
    }
}

abstract class Handler
{
    private $next_handler;
    private $lever = 0;

    abstract protected function response();

    public function setHandlerLevel($lever){
        $this->lever = $lever;
    }

    public function setNext(Handler $handler){
        $this->next_handler = $handler;
        $this->next_handler->setHandlerLevel($this->lever + 1);
    }

    final public function handlerMessage(Request $request){
        if ($this->lever == $request->getLever()){
            $this->response();
        }else{
            if ($this->next_handler != null){
                $this->next_handler->handlerMessage($request);
            }else{
                echo '洗洗睡吧，没人理你'.PHP_EOL;
            }
        }
    }
}

class HeadMan extends Handler
{
    protected function response(){
        echo '组长回复你：同意你的请求'.PHP_EOL;
    }
}

class Director extends Handler
{
    protected function response(){
        echo '主管回复你：知道了，退下'.PHP_EOL;
    }
}

class Manager extends Handler
{
    protected function response(){
        echo '经理回复你：容朕思虑，再议'.PHP_EOL;
    }
}

$headman = new HeadMan;
$director = new Director;
$manager = new Manager;

$headman->setNext($director);
$director->setNext($manager);

$headman->handlerMessage(new Request('请假'));
$headman->handlerMessage(new Request('休假'));
$headman->handlerMessage(new Request('辞职'));
$headman->handlerMessage(new Request('加薪'));
