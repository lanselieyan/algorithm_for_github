<?php
class Solution {
    public function minOperations($nums, $x) {
        $n = count($nums);
        $sum = 0;
        for ($i = 0; $i < $n; $i++) {
            $sum += $nums[$i];
        }
        // 滑动窗口需要寻找的子数组目标和
        $target = $sum - $x;

        $left = 0;
        $right = 0;
        // 记录窗口内所有元素和
        $windowSum = 0;
        // 记录目标子数组的最大长度
        $maxLen = PHP_INT_MIN;
        // 开始执行滑动窗口框架
        while ($right < $n) {
            // 扩大窗口
            $windowSum += $nums[$right];
            $right++;

            while ($windowSum > $target && $left < $right) {
                // 缩小窗口
                $windowSum -= $nums[$left];
                $left++;
            }
            // 寻找目标子数组
            if ($windowSum == $target) {
                $maxLen = max($maxLen, $right - $left);
            }
        }
        // 目标子数组的最大长度可以推导出需要删除的字符数量
        return $maxLen == PHP_INT_MIN ? -1 : $n - $maxLen;
    }
}
