<?php

/**
 * 冒泡排序的原理：一组数据，比较相邻数据的大小，将值小数据在前面，值大的数据放在后面。
 * @param array $array
 * @return array
 */
function bubbleSort(array $array) : array
{
    $count = count($array);
    if ($count == 0) {
        return [];
    }

    for ($i = 0; $i < $count; $i++) {
        for ($j = 0; $j < $count-1-$i; $j++) {
            if ($array[$j] > $array[$j + 1]) {
                $temp = $array[$j];
                $array[$j] = $array[$j + 1];
                $array[$j + 1] = $temp;
            }
        }
    }
    return $array;
}

var_dump(bubbleSort([6, 3, 8, 2, 9, 1]));