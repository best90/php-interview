<?php

function mergeSort(&$array)
{
    $length = count($array);
    mSort($array, 0, $length-1);
}

function mSort(&$array, $left, $right)
{
    if ($left < $right) {
        $center = floor(($left + $right)/2);
        mSort($array, $left, $center);
        mSort($array, $center+1, $right);
        mergeArray($array, $left, $center, $right);
    }
}

function mergeArray(&$array, $left, $center, $right)
{
    $i = $left;
    $j = $center + 1;
    $temp = [];
    while ($i <= $center && $j <= $right) {
        if ($array[$i] < $array[$j]) {
            $temp[] = $array[$i++];
        }else{
            $temp[] = $array[$j++];
        }
    }

    while ($i <= $center) {
        $temp[] = $array[$i++];
    }

    while ($j <= $right) {
        $temp[] = $array[$j++];
    }

    for ($k = 0,$length = count($temp); $k < $length; $k++){
        $array[$left+$k] = $temp[$k];
    }
}

$array = [4, 7, 6, 3, 9, 5, 8];
mergeSort($array);
print_r($array);