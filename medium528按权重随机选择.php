<?php
class Solution {
    // 前缀和数组
    private $preSum;
    private $rand;

    public function __construct($w) {
        $n = count($w);
        // 构建前缀和数组，偏移一位留给 preSum[0]
        $this->preSum = array();
        $this->preSum[0] = 0;
        // preSum[i] = sum(w[0..i-1])
        for ($i = 1; $i <= $n; $i++) {
            $this->preSum[$i] = $this->preSum[$i - 1] + $w[$i - 1];
        }
        $this->rand = new Random(); // 使用 PHP 的随机数生成器
    }

    public function pickIndex() {
        $n = count($this->preSum);
        // PHP 的 rand($min, $max) 方法在 [$min, $max] 中生成一个随机整数
        // 再加一就是在闭区间 [1, preSum[n - 1]] 中随机选择一个数字
        $target = rand(1, $this->preSum[$n - 1]);
        // 获取 target 在前缀和数组 preSum 中的索引
        // 别忘了前缀和数组 preSum 和原始数组 w 有一位索引偏移
        return $this->left_bound($this->preSum, $target) - 1;
    }

    // 搜索左侧边界的二分搜索
    private function left_bound($nums, $target) {
        // 见上文
    }
}
