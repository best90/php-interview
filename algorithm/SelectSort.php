<?php

/**
 * 选择排序
 * 每一次从待排序的数据元素中选出最小（或最大）的一个元素，存放在序列的起始位置，直到全部待排序的数据元素排完
 * @param array $array
 * @return array
 */
function selectSort(array &$array) : array
{
    $length = count($array) - 1;
    for ($i = 0; $i < $length; $i++) {
        $point = $i;
        for ($j = $i + 1; $j <= $length; $j++) {
            if ($array[$point] > $array[$j]) {
                $point = $j;
            }
        }
        $tmp = $array[$i];
        $array[$i] = $array[$point];
        $array[$point] = $tmp;
    }
    return $array;
}
$array = [1,4,2,5,3];
selectSort($array);
var_dump($array);