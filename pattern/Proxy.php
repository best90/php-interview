<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017-06-01
 * Time: 9:29
 */

namespace Pattern;

/**
 * 示例一
 * Interface shop
 * @package Pattern
 */
interface shop
{
    public function buy($title);
}

class CDshop implements shop
{
    public function buy($title)
    {
        // TODO: Implement buy() method.
        echo '购买成功，这是你的《'.$title.'》唱片。'.PHP_EOL;
    }
}

class Proxy implements shop
{
    public function buy($title)
    {
        // TODO: Implement buy() method.
        $this->go();
        $CDshop = new CDshop;
        $CDshop->buy($title);
    }

    public function go()
    {
        echo '跑去香港代购'.PHP_EOL;
    }
}

$CDshop = new CDshop;
$CDshop->buy('吻别');

//14年你想买张 醒着做梦 找不到CD商店了，和做梦似的，不得不找了个代理去香港帮你代购。
$proxy = new Proxy;
$proxy->buy('醒着做梦');


/**
 * 示例二
 */

class DBProxy
{
    protected $reader;
    protected $writer;

    public function __construct()
    {
        $this->reader = new \PDO('mysql:host=127.0.0.1;port=3306;dbname=CD;','root','root');
        $this->writer = new \PDO('mysql:host=127.0.0.2;port=3306;dbname=CD;','root','root');
    }

    public function query($sql)
    {
        if(substr($sql, 0,6) == 'select') {
            echo '读操作：'.PHP_EOL;
            return $this->reader->query($sql);
        } else {
            echo '写操作：'.PHP_EOL;
            return $this->writer->query($sql);
        }
    }
}

$DBproxy = new DBProxy;
$DBproxy->query('SELECT * FROM table');
$DBproxy->query("INSERT INTO table SET title = 'hello' where id = 1");