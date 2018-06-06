<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/19 0019
 * Time: 下午 21:17
 */

namespace Pattern;

//观察者接口
interface Observer
{
    public function update();
}

class Wechat implements Observer
{
    public function update()
    {
        // TODO: Implement update() method.
        echo '通知已接收,微信更新完毕'.PHP_EOL;
    }
}

class Web implements Observer
{
    public function update()
    {
        // TODO: Implement update() method.
        echo '通知已接收，web端系统更新中'.PHP_EOL;
    }
}

class App implements Observer
{
    public function update()
    {
        // TODO: Implement update() method.
        echo '通知已接收，APP稍后更新'.PHP_EOL;
    }
}

//抽象被观察者
abstract class Subject
{
    private $observers = [];

    public function addObserver(Observer $observer)
    {
        $this->observers[] = $observer;
        echo '添加观察者成功'.PHP_EOL;
    }

    public function delObserver(Observer $observer)
    {
        $key = array_search($observer, $this->observers);
        if ($observer === $this->observers[$key]){
            unset($this->observers[$key]);
            echo '删除观察者成功'.PHP_EOL;
        }else{
            echo '观察者不存在，无需删除'.PHP_EOL;
        }
    }

    public function notifyObservers()
    {
        foreach ($this->observers as $observer) {
            $observer->update();
        }
    }
}

class Server extends Subject
{
    public function publish()
    {
        echo '今天天气很好，我发布了更新包'.PHP_EOL;
        $this->notifyObservers();
    }
}

$server = new Server;
$wechat = new Wechat;
$web = new Web;
$app = new App;

$server->addObserver($wechat);
$server->addObserver($web);
$server->addObserver($app);

$server->publish();

$server->delObserver(new Web);
$server->publish();