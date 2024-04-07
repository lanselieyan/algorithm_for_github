<?php
/**
 * 检查字符串 s 是否包含字符串 t 的排列
 * @param string $t 给定字符串
 * @param string $s 源字符串
 * @return bool 返回是否包含字符串 t 的排列
 */
function checkInclusion($t, $s) {
    $need = []; // 用于记录需要的字符和其出现的次数
    $window = []; // 当前窗口中的字符及其出现的次数
    // 统计 t 中各字符出现次数
    for ($i = 0; $i < strlen($t); $i++) {
        $c = $t[$i];
        $need[$c] = isset($need[$c]) ? $need[$c] + 1 : 1;
    }

    $left = 0;
    $right = 0;
    $valid = 0; // 窗口中满足需要的字符个数
    while ($right < strlen($s)) {
        // c 是将移入窗口的字符
        $c = $s[$right];
        // 扩大窗口
        $right++;
        // 进行窗口内数据的一系列更新
        if (isset($need[$c])) {
            $window[$c] = isset($window[$c]) ? $window[$c] + 1 : 1;
            if ($window[$c] == $need[$c]) {
                // 只有当 window[c] 和 need[c] 对应的出现次数一致时，才能满足条件，valid 才能 +1
                $valid++;
            }
        }

        // 判断左侧窗口是否要收缩
        while ($right - $left >= strlen($t)) {
            // 在这里判断是否找到了合法的子串
            if ($valid == count($need)) {
                return true;
            }
            // d 是将移出窗口的字符
            $d = $s[$left];
            // 缩小窗口
            $left++;
            // 进行窗口内数据的一系列更新
            if (isset($need[$d])) {
                if ($window[$d] == $need[$d]) {
                    // 只有当 window[d] 内的出现次数和 need[d] 相等时，才能 -1
                    $valid--;
                }
                $window[$d]--;
            }
        }
    }
    // 未找到符合条件的子串
    return false;
}