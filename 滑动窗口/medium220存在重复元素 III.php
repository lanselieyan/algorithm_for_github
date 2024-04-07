<?php
class Solution {
    public function containsNearbyAlmostDuplicate($nums, $k, $t) {
        $window = new \TreeSet();
        $left = 0;
        $right = 0;
        while ($right < count($nums)) {
            // 为了防止 $i == $j，所以在扩大窗口之前先判断是否有符合题意的索引对 ($i, $j)
            // 查找略大于 $nums[$right] 的那个元素
            $ceiling = $window->ceiling($nums[$right]);
            if ($ceiling !== null && ($ceiling - $nums[$right]) <= $t) {
                return true;
            }
            // 查找略小于 $nums[$right] 的那个元素
            $floor = $window->floor($nums[$right]);
            if ($floor !== null && ($nums[$right] - $floor) <= $t) {
                return true;
            }

            // 扩大窗口
            $window->add($nums[$right]);
            $right++;

            if ($right - $left > $k) {
                // 缩小窗口
                $window->remove($nums[$left]);
                $left++;
            }
        }
        return false;
    }
}
