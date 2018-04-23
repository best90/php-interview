<?php

/**
 * 插入排序法
 * 检查第i个数字，如果在它的左边的数字比它大，进行交换，这个动作一直继续下去，直到这个数字的左边数字比它还要小，就可以停止了。
 * @param array $list
 * @param int $point
 * @return array
 */
function insertSort(array &$list = [],int $point = 0) : array
{
    if ($point >= count($list) - 1) {
        return $list;
    }

    $next = $list[$point + 1];
    for ($i = $point; $i >= 0; --$i) {
        if ($list[$i] > $next) {
            $list[$i + 1] = $list[$i];
            if ($i === 0) {
                $list[$i] = $next;
                break;
            }
            continue;
        }
        $list[$i + 1] = $next;
        break;
    }
    $point += 1;
    insertSort($list, $point);
    return $list;
}

$list = [5,3,1,2,4];
var_dump(insertSort($list));


function forInsertSort(array &$list = []) : array
{
    $length = count($list);
    for ($i = 1;$i < $length; $i++) {
        $base = $list[$i];
        for($j = $i - 1; $j >= 0; $j--) {
            if ($base < $list[$j]) {
                $list[$j+1] = $list[$j];
                if ($j === 0) {
                    $list[$j] = $base;
                    break;
                }
                continue;
            }
            $arr[$j + 1] = $base;
            break;
        }
    }
    return $list;
}

$list = [5,3,1,2,4];
var_dump(forInsertSort($list));