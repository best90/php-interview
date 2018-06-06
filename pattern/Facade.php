<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017-06-02
 * Time: 15:55
 */

namespace Pattern;

class Doctor
{
    public $name;
    public function __construct($name)
    {
        $this->name = $name;
    }

    public function prescribe($data)
    {
        echo __CLASS__.': 开个处方给你'.PHP_EOL;
        return '祖传秘方，药到病除';
    }
}

class DoctorSystem
{
    static public function getDoctor($name)
    {
        echo __CLASS__.':'.$name.'医生,挂你号'.PHP_EOL;
        return new Doctor($name);
    }
}

class SufferSystem
{
    static public function getData($suffer)
    {
        $data = $suffer.'资料';
        echo __CLASS__.':'.$suffer.'的资料是这些'.PHP_EOL;
        return $data;
    }
}

class MedicineSystem
{
    static public function register($prescribe)
    {
        echo __CLASS__.':拿到处方：'.$prescribe.'---------通知药房发药了'.PHP_EOL;
        Shop::setMedicine('枸杞1千克');
    }
}

class Shop
{
    static public $medicine;
    static public function setMedicine($medicine)
    {
        self::$medicine = $medicine;
    }

    static public function getMedicine()
    {
        echo __CLASS__.':'.self::$medicine.PHP_EOL;
    }
}

$doct = DoctorSystem::getDoctor('顾医生');
$data = SufferSystem::getData('病人甲');
$prescribe = $doct->prescribe($data);
MedicineSystem::register($prescribe);
Shop::getMedicine();

echo PHP_EOL.'------有了挂号系统以后------'.PHP_EOL;

class Facade
{
    static public function regist($suffer, $doct)
    {
        $doct = DoctorSystem::getDoctor($doct);
        $data = SufferSystem::getData($suffer);
        $prescribe = $doct->prescribe($data);
        MedicineSystem::register($prescribe);

        Shop::getMedicine();
    }
}

Facade::regist('病人已','刘医生');