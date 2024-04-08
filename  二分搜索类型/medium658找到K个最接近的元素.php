<?php
class Solution {
    public function findClosestElements($arr, $k, $x) {
        // 二分搜索找到 x 的位置
        $p = $this->left_bound($arr, $x);
        // 两端都开的区间 (left, right)
        $left = $p - 1;
        $right = $p;
        $res = array();
        // 扩展区间，直到区间内包含 k 个元素
        while ($right - $left - 1 < $k) {
            if ($left == -1) {
                array_push($res, $arr[$right]);
                $right++;
            } else if ($right == count($arr)) {
                array_unshift($res, $arr[$left]);
                $left--;
            } else if ($x - $arr[$left] > $arr[$right] - $x) {
                array_push($res, $arr[$right]);
                $right++;
            } else {
                array_unshift($res, $arr[$left]);
                $left--;
            }
        }
        return $res;
    }

    // 搜索左侧边界的二分搜索
    function left_bound($nums, $target) {
        $left = 0;
        $right = count($nums);

        while ($left < $right) {
            $mid = $left + floor(($right - $left) / 2);
            if ($nums[$mid] == $target) {
                $right = $mid;
            } else if ($nums[$mid] < $target) {
                $left = $mid + 1;
            } else if ($nums[$mid] > $target) {
                $right = $mid;
            }
        }
        return $left;
    }
}
