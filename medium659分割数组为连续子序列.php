<?php
class Solution {
    function isPossible($nums) {
        $freq = [];
        $need = [];

        // 统计 nums 中元素的频率
        foreach ($nums as $v) {
            if (!isset($freq[$v])) {
                $freq[$v] = 0;
            }
            $freq[$v]++;
        }

        foreach ($nums as $v) {
            if ($freq[$v] == 0) {
                // 已经被用到其他子序列中
                continue;
            }
            // 先判断 v 是否能接到其他子序列后面
            if (isset($need[$v]) && $need[$v] > 0) {
                // v 可以接到之前的某个序列后面
                $freq[$v]--;
                // 对 v 的需求减一
                $need[$v]--;
                // 对 v + 1 的需求加一
                $need[$v + 1]++;
            } elseif ($freq[$v] > 0 && isset($freq[$v + 1]) && $freq[$v + 1] > 0 && isset($freq[$v + 2]) && $freq[$v + 2] > 0) {
                // 将 v 作为开头，新建一个长度为 3 的子序列 [v,v+1,v+2]
                $freq[$v]--;
                $freq[$v + 1]--;
                $freq[$v + 2]--;
                // 对 v + 3 的需求加一
                $need[$v + 3]++;
            } else {
                // 两种情况都不符合，则无法分配
                return false;
            }
        }

        return true;
    }

}
