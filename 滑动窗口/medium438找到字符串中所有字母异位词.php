<?php
function findAnagrams($s, $t) {
    $need = [];
    $window = [];
    for ($i = 0; $i < strlen($t); $i++) {
        $c = $t[$i];
        if (!isset($need[$c])) {
            $need[$c] = 1;
        } else {
            $need[$c]++;
        }
    }

    $left = 0;
    $right = 0;
    $valid = 0;
    $res = []; // 记录结果
    while ($right < strlen($s)) {
        $c = $s[$right];
        $right++;
        // 进行窗口内数据的一系列更新
        if (isset($need[$c])) {
            if (!isset($window[$c])) {
                $window[$c] = 1;
            } else {
                $window[$c]++;
            }
            if ($window[$c] === $need[$c]) {
                $valid++;
            }
        }
        // 判断左侧窗口是否要收缩
        while ($right - $left >= strlen($t)) {
            // 当窗口符合条件时，把起始索引加入 res
            if ($valid === count($need)) {
                $res[] = $left;
            }
            $d = $s[$left];
            $left++;
            // 进行窗口内数据的一系列更新
            if (isset($need[$d])) {
                if ($window[$d] === $need[$d]) {
                    $valid--;
                }
                $window[$d]--;
            }
        }
    }
    return $res;
}
