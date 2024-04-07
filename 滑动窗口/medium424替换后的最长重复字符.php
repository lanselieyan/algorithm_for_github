<?php
class Solution {
    public function characterReplacement($s, $k) {
        $left = 0;
        $right = 0;
        // 统计窗口中每个字符的出现次数
        $windowCharCount = array_fill(0, 26, 0);
        // 记录窗口中字符的最多重复次数
        // 记录这个值的意义在于，最划算的替换方法肯定是把其他字符替换成出现次数最多的那个字符
        // 所以窗口大小减去 windowMaxCount 就是所需的替换次数
        $windowMaxCount = 0;
        // 记录结果长度
        $res = 0;

        // 开始滑动窗口模板
        while ($right < strlen($s)) {
            // 扩大窗口

            //在 PHP 中使用一个数组 $windowCharCount 来记录窗口中不同字符出现的次数。
            //$s[$right] 是指字符串 $s 中索引为 $right 的字符，ord() 函数返回字符的 ASCII 值，
            //通过减去 'A' 的 ASCII 值可以将大写字母映射到 0-25 的范围内（因为大写字母的 ASCII 值是连续的），
            //然后将对应位置的计数加一，从而记录窗口中字符的出现次数。
            $windowCharCount[ord($s[$right]) - ord('A')]++;
            $windowMaxCount = max($windowMaxCount, $windowCharCount[ord($s[$right]) - ord('A')]);
            $right++;

            while ($right - $left - $windowMaxCount > $k) {
                // 缩小窗口
                $windowCharCount[ord($s[$left]) - ord('A')]--;
                $left++;
                // 这里不用更新 windowMaxCount
                // 因为只有 windowMaxCount 变得更大的时候才可能获得更长的重复子串，才会更新 res
            }
            // 此时一定是一个合法的窗口
            $res = max($res, $right - $left);
        }
        return $res;
    }
}
