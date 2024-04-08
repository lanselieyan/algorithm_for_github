<?php
class Solution {
    public function searchMatrix($matrix, $target) {
        $m = count($matrix);
        $n = count($matrix[0]);
        // 初始化在右上角       /****核心就是这个****/
        $i = 0;
        $j = $n - 1;
        while ($i < $m && $j >= 0) {
            if ($matrix[$i][$j] == $target) {
                return true;
            }
            if ($matrix[$i][$j] < $target) {
                // 需要大一点，往下移动
                $i++;
            } else {
                // 需要小一点，往左移动
                $j--;
            }
        }
        // while 循环中没有找到，则 target 不存在
        return false;
    }
}

