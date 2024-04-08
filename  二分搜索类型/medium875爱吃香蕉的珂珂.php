<?php
function minEatingSpeed($piles, $H) {
    $left = 1;
    $right = 1000000000 + 1;

    while ($left < $right) {
        $mid = $left + intval(($right - $left) / 2);
        if (f($piles, $mid) == $H) {
            // 搜索左侧边界，则需要收缩右侧边界
            $right = $mid;
        } else if (f($piles, $mid) < $H) {
            // 需要让 f(x) 的返回值大一些
            $right = $mid;
        } else if (f($piles, $mid) > $H) {
            // 需要让 f(x) 的返回值小一些
            $left = $mid + 1;
        }
    }
    return $left;
}

function f($piles, $K) {
    $hours = 0;
    foreach ($piles as $pile) {
        $hours += ceil($pile / $K);
    }
    return $hours;
}
