<?php
class Solution {
    public function longestSubstring($s, $k) {
        $len = 0;
        for ($i = 1; $i <= 26; $i++) {
            // 限制窗口中只能有 i 种不同字符
            $len = max($len, $this->logestKLetterSubstr($s, $k, $i));
        }
        return $len;
    }

    // 寻找 s 中含有 count 种字符，且每种字符出现次数都大于 k 的子串
    private function logestKLetterSubstr($s, $k, $count) {
        // 记录答案
        $res = 0;
        // 快慢指针维护滑动窗口，左闭右开区间
        $left = 0;
        $right = 0;
        // 题目说 s 中只有小写字母，所以用大小 26 的数组记录窗口中字符出现的次数
        $windowCount = array_fill(0, 26, 0);
        // 记录窗口中存在几种不同的字符（字符种类）
        $windowUniqueCount = 0;
        // 记录窗口中有几种字符的出现次数达标（大于等于 k）
        $windowValidCount = 0;
        // 滑动窗口代码模板
        while ($right < strlen($s)) {
            // 移入字符，扩大窗口
            $c = $s[$right];
            if ($windowCount[ord($c) - ord('a')] == 0) {
                // 窗口中新增了一种字符
                $windowUniqueCount++;
            }
            $windowCount[ord($c) - ord('a')]++;
            if ($windowCount[ord($c) - ord('a')] == $k) {
                // 窗口中新增了一种达标的字符
                $windowValidCount++;
            }
            $right++;

            // 当窗口中字符种类大于 k 时，缩小窗口
            while ($windowUniqueCount > $count) {
                // 移出字符，缩小窗口
                $d = $s[$left];
                if ($windowCount[ord($d) - ord('a')] == $k) {
                    // 窗口中减少了一种达标的字符
                    $windowValidCount--;
                }
                $windowCount[ord($d) - ord('a')]--;
                if ($windowCount[ord($d) - ord('a')] == 0) {
                    // 窗口中减少了一种字符
                    $windowUniqueCount--;
                }
                $left++;
            }

            // 当窗口中字符种类为 count 且每个字符出现次数都满足 k 时，更新答案
            if ($windowValidCount == $count) {
                $res = max($res, $right - $left);
            }
        }
        return $res;
    }
}
