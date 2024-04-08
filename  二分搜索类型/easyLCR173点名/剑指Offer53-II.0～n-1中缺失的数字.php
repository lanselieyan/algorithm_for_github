<?php
class Solution {
    public function missingNumber($nums) {
        // 搜索左侧的二分搜索
        $left = 0;
        $right = count($nums) - 1;
        while ($left <= $right) {
            $mid = $left + floor(($right - $left) / 2);
            if ($nums[$mid] > $mid) {
                // mid 和 nums[mid] 不对应，说明左边有元素缺失
                $right = $mid - 1;
            } else {
                // mid 和 nums[mid] 对应，说明元素缺失在右边
                $left = $mid + 1;
            }
        }
        return $left;
    }
}
