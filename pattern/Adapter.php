<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/29 0029
 * Time: 下午 21:22
 */

namespace Pattern;


interface Target
{
    public function connect($host,$user,$passwd,$dbname)
    {
    }

    public function query($sql)
    {
    }

    public function close()
    {
    }
}

class MySQLAdapter implements Target
{
    protected $conn;
    public function connect($host, $user, $passwd, $dbname)
    {
        // TODO: Implement connect() method.
        $conn = mysql_connect($host,$user, $passwd);
        mysql_select_db($dbname, $conn);
        $this->conn = $conn;
    }

    public function query($sql)
    {
        // TODO: Implement query() method.
        $result = mysql_query($sql, $this->conn);
        return $result;
    }

    public function close()
    {
        // TODO: Implement close() method.
        mysql_close($this->conn);
    }
}

class MySQLiAdapter implements Target
{
    protected $conn;
    public function connect($host, $user, $passwd, $dbname)
    {
        // TODO: Implement connect() method.
        $conn = mysqli_connect($host, $user, $passwd);
        mysqli_select_db($dbname, $conn);
        $this->conn = $conn;
    }

    public function query($sql)
    {
        // TODO: Implement query() method.
        $result = mysqli_query($sql, $this->conn);
        return $result;
    }

    public function close()
    {
        // TODO: Implement close() method.
        mysqli_close($this->conn);
    }
}

class DataBase implements Target
{
    protected $db;
    public function __construct($type)
    {
        $type = $type.'Adapter';
        $this->db = new $type;
    }

    public function connect($host, $user, $passwd, $dbname)
    {
        // TODO: Implement connect() method.
        $this->db->connect($host, $user, $passwd, $dbname);
    }

    public function query($sql)
    {
        // TODO: Implement query() method.
        return $this->db->query($sql);
    }

    public function close()
    {
        // TODO: Implement close() method.
        $this->db->close();
    }
}

$db1 = new DataBase('MySQL');
$db1->connect('127.0.0.1', 'root','root','myDB');
$db1->query('select * from test');
$db1->close();

$db2 = new DataBase('MySQLi');
$db2->connect('127.0.0.1', 'root','root','myDB');
$db2->query('select * from test');
$db2->close();
