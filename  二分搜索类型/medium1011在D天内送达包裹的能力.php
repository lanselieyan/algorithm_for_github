<?php
function shipWithinDays($weights, $days) {
    $left = 0;
    $right = 1;
    foreach ($weights as $w) {
        $left = max($left, $w);
        $right += $w;
    }

    while ($left < $right) {
        $mid = $left + intval(($right - $left) / 2);
        if (f($weights, $mid) <= $days) {
            $right = $mid;
        } else {
            $left = $mid + 1;
        }
    }

    return $left;
}

// 定义：当运载能力为 x 时，需要 f(x) 天运完所有货物
// f(x) 随着 x 的增加单调递减
function f($weights, $x) {
    $days = 0;
    $i = 0;
    while ($i < count($weights)) {
        // 尽可能多装货物
        $cap = $x;
        while ($i < count($weights)) {
            if ($cap < $weights[$i]) {
                break;
            } else {
                $cap -= $weights[$i];
                $i++;
            }
        }
        $days++;
    }
    return $days;
}

