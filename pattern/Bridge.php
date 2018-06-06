<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/3 0003
 * Time: 下午 23:04
 */

namespace Pattern;

//抽象化角色
abstract class MiPhone
{
    protected $_audio;
    abstract function output();
    public function __construct($audio)
    {
        $this->_audio = $audio;
    }
}

//具体手机
class Mix extends MiPhone
{
    public function output()
    {
        // TODO: Implement output() method.
        $this->_audio->output();
    }
}
class Note extends MiPhone
{
    public function output()
    {
        // TODO: Implement output() method.
        $this->_audio->output();
    }
}

//实现化角色 功能实现者
abstract class Audio
{
    abstract function output();
}
//骨传导音频输出
class Osteophony extends Audio
{
    public function output()
    {
        // TODO: Implement output() method.
        echo '骨传导输出的声音-----哈哈'.PHP_EOL;
    }
}
//普通音频输出
class Cylinder extends Audio
{
    public function output()
    {
        // TODO: Implement output() method.
        echo '声筒输出的声音-----呵呵'.PHP_EOL;
    }
}

$mix = new Mix(new Osteophony);
$mix->output();

$note = new Note(new Cylinder);
$note->output();