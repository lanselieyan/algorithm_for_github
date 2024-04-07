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
                    //array_splice() 函数是 PHP 中用于对数组进行删除、插入和替换操作的函数之一。
                    //在这种情况下，array_splice($window, $index, 1) 表示从数组 $window 中删除指定索引位置 $index 处的元素，
                    //并且只删除一个元素（第三个参数为1）。
                    //删除后，数组中的其他元素会向前移动以填补空缺。该函数的返回值是被删除的元素（以数组形式返回）。
                    //简而言之，array_splice($window, $index, 1) 的作用是从数组中删除指定索引位置的一个元素。
                    array_splice($window, $index, 1);
                }
                $left++;
            }
        }
        return false;
    }
}
