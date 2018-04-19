<?php

/**
 * 二分法查找
 * 将表中间位置记录的关键字与查找关键字比较，如果两者相等，则查找成功；
 * 否则利用中间位置记录将表分成前、后两个子表，如果中间位置记录的关键字大于查找关键字，则进一步查找前一子表，否则进一步查找后一子表。
 * @param array $list
 * @param $target
 * @return float|null
 */
function binSearch(array $list, $target)
{
    $height = count($list) - 1;
    $low = 0;

    while ($low <= $height) {
        $mid = floor(($low + $height) / 2);
        if ($list[$mid] == $target) {
            return $mid;
        }elseif ($list[$mid] > $target) {
            $height = $mid - 1;
        }elseif ($list[$mid] < $target) {
            $low = $mid + 1;
        }
    }
    return null;
}

var_dump(binSearch([1,2,4,5], 4));