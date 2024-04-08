<?php
class Solution {
    public $res = [];

    /* 主函数，输入一组不重复的数字，返回它们的全排列 */
    public function permute($nums) {
        // 记录「路径」
        $track = [];
        // 「路径」中的元素会被标记为 true，避免重复使用
        $used = array_fill(0, count($nums), false);

        $this->backtrack($nums, $track, $used);
        return $this->res;
    }

    // 路径：记录在 track 中
    // 选择列表：nums 中不存在于 track 的那些元素（used[i] 为 false）
    // 结束条件：nums 中的元素全都在 track 中出现
    public function backtrack($nums, $track, $used) {
        // 触发结束条件
        if (count($track) == count($nums)) {
            array_push($this->res, $track);
            return;
        }

        for ($i = 0; $i < count($nums); $i++) {
            // 排除不合法的选择
            if ($used[$i]) {
                // nums[$i] 已经在 track 中，跳过
                continue;
            }
            // 做选择
            array_push($track, $nums[$i]);
            $used[$i] = true;
            // 进入下一层决策树
            $this->backtrack($nums, $track, $used);
            // 取消选择
            array_pop($track);
            $used[$i] = false;
        }
    }
}
