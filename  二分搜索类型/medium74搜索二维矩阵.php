<?php
class Solution {
    public function searchMatrix($matrix, $target) {
        $m = count($matrix);
        $n = count($matrix[0]);
        // 把二维数组映射到一维
        $left = 0;
        $right = $m * $n - 1;
        // 前文讲的标准的二分搜索框架
        while ($left <= $right) {
            $mid = $left + intval(($right - $left) / 2);
            if ($this->get($matrix, $mid) == $target)
                return true;
            elseif ($this->get($matrix, $mid) < $target)
                $left = $mid + 1;
            elseif ($this->get($matrix, $mid) > $target)
                $right = $mid - 1;
        }
        return false;
    }

    // 通过一维坐标访问二维数组中的元素
    public function get($matrix, $index) {
        $m = count($matrix);
        $n = count($matrix[0]);
        // 计算二维中的横纵坐标
        $i = intval($index / $n);
        $j = $index % $n;
        return $matrix[$i][$j];
    }
}
