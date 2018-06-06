<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/7 0007
 * Time: 下午 22:58
 */

namespace Pattern;


class User
{
    protected $id;
    protected $data;
    protected $db;
    protected $change = false;

    public function __construct($id)
    {
        $this->id = $id;
        $this->db = Factory::getDatabase();
        $this->data = $this->db->query('SELECT * FROM user WHERE id='.$id.' LIMIT 1');
    }

    public function __get($key)
    {
        // TODO: Implement __get() method.
        if (isset($this->data[$key]))
        {
            return $this->data[$key];
        }
    }

    public function __set($key, $value)
    {
        // TODO: Implement __set() method.
        $this->data[$key] = $value;
        $this->change = true;
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->change && $this->update();
    }

    public function update()
    {
        foreach ($this->data as $k => $v){
            $fields[] = "$k = '{$v}'";
        }

        $this->db->query("UPDATE user SET ".implode(',', $fields))." WHERE $id = {$this->db} LIMIT 1");
    }
}

$user = new User(1);
$user->name = 'admin';