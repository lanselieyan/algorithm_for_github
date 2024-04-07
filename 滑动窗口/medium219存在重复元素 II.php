<?php
class Solution {
    public function containsNearbyDuplicate($nums, $k) {
        $left = 0;
        $right = 0;
        $window = array();

        // 滑动窗口算法框架，维护一个大小为 k 的窗口
        while ($right < count($nums)) {
            // 扩大窗口
            if (in_array($nums[$right], $window)) {
                return true;
            }
            array_push($window, $nums[$right]);
            $right++;

            if ($right - $left > $k) {
                // 当窗口的大小大于 k 时，缩小窗口
                $index = array_search($nums[$left], $window);
                if ($index !== false) {
                    array_splice($window, $index, 1);
                }
                $left++;
            }
        }
        return false;
    }
}
