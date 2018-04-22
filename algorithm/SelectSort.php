<?php

/**
 * 选择排序
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