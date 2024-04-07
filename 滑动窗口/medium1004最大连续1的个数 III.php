<?php
class Solution {
    public function longestOnes($nums, $k) {
        $left = 0;
        $right = 0;
        // 记录窗口中 1 的出现次数
        $windowOneCount = 0;
        // 记录结果长度
        $res = 0;

        // 开始滑动窗口模板
        while ($right < count($nums)) {
            // 扩大窗口
            if ($nums[$right] == 1) {
                $windowOneCount++;
            }
            $right++;

            while ($right - $left - $windowOneCount > $k) {
                // 当窗口中需要替换的 0 的数量大于 k，缩小窗口
                if ($nums[$left] == 1) {
                    $windowOneCount--;
                }
                $left++;
            }
            // 此时一定是一个合法的窗口，求最大窗口长度
            $res = max($res, $right - $left);
        }
        return $res;
    }
}
