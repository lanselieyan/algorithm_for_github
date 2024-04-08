<?php
class Solution {
    public function findPeakElement($nums) {
        // 取两端都闭的二分搜索
        $left = 0;
        $right = count($nums) - 1;
        // 因为题目必然有解，所以设置 left == right 为结束条件
        while ($left < $right) {
            $mid = $left + floor(($right - $left) / 2);
            if ($nums[$mid] > $nums[$mid + 1]) {
                // mid 本身就是峰值或其左侧有一个峰值
                $right = $mid;
            } else {
                // mid 右侧有一个峰值
                $left = $mid + 1;
            }
        }
        return $left;
    }
}
