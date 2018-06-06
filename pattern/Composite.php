<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/4 0004
 * Time: 下午 21:55
 */

namespace Pattern;

interface Gm
{
    public function add(Staff $staff);
    public function getNodes();
}

interface Staff
{
    public function work();
}

class Manager
{
    public $name;
    protected $nodes = []; //存放子节点

    //添加部门经理
    public function addGm(Gm $gm)
    {
        $this->nodes[] = $gm;
    }

    public function addStaff(Staff $staff)
    {
        $this->nodes[] = $staff;
    }

    public function getNodes()
    {
        return $this->nodes;
    }
}

class SaleGm implements Gm
{
    public $name;
    protected $nodes = [];
    public function __construct($name)
    {
        $this->name = $name;
    }

    public function add(Staff $staff)
    {
        // TODO: Implement add() method.
        $this->nodes = $staff;
    }

    public function getNodes()
    {
        return $this->nodes;
    }

    public function sell()
    {
        echo  '安利一下我司的产品';
    }
}

class SaleStaff implements Staff
{
    public $name;
    public function work()
    {
        echo '在销售经理带领下，安利全世界';
    }
}

$manager = new Manager('总经理');
$saleGm = new SaleGm('销售经理');
$staff = new SaleStaff('小马');

//组装成树
$manager->addGm($saleGm);
$saleGm->add($staff);