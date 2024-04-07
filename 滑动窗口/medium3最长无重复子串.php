<?php
function lengthOfLongestSubstring($s) {
    $window = array();

    $left = 0;
    $right = 0;
    $res = 0; // 记录结果
    $len = strlen($s);
    while ($right < $len) {
        $c = $s[$right];
        $right++;
        // 进行窗口内数据的一系列更新
        if (!isset($window[$c])) {
            $window[$c] = 1;
        } else {
            $window[$c]++;
        }
        // 判断左侧窗口是否要收缩
        while ($window[$c] > 1) {
            $d = $s[$left];
            $left++;
            // 进行窗口内数据的一系列更新
            $window[$d]--;
        }
        // 在这里更新答案
        $res = max($res, $right - $left);
    }
    return $res;
}
