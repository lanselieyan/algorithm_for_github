<?php
function findRepeatedDnaSequences($s) {
    // 先把字符串转化成四进制的数字数组
    $nums = [];
    for ($i = 0; $i < strlen($s); $i++) {
        switch ($s[$i]) {
            case 'A':
                $nums[$i] = 0;
                break;
            case 'G':
                $nums[$i] = 1;
                break;
            case 'C':
                $nums[$i] = 2;
                break;
            case 'T':
                $nums[$i] = 3;
                break;
        }
    }
    // 记录重复出现的哈希值
    $seen = [];
    // 记录重复出现的字符串结果
    $res = [];

    // 数字位数
    $L = 10;
    // 进制
    $R = 4;
    // 存储 R^(L - 1) 的结果
    $RL = pow($R, $L - 1);
    // 维护滑动窗口中字符串的哈希值
    $windowHash = 0;

    // 滑动窗口代码框架，时间 O(N)
    $left = 0;
    $right = 0;
    while ($right < count($nums)) {
        // 扩大窗口，移入字符，并维护窗口哈希值（在最低位添加数字）
        $windowHash = $R * $windowHash + $nums[$right];
        $right++;

        // 当子串的长度达到要求
        if ($right - $left === $L) {
            // 根据哈希值判断是否曾经出现过相同的子串
            if (array_key_exists($windowHash, $seen)) {
                // 当前窗口中的子串是重复出现的
                $res[] = substr($s, $left, $right - $left);
            } else {
                // 当前窗口中的子串之前没有出现过，记下来
                $seen[$windowHash] = true;
            }
            // 缩小窗口，移出字符，并维护窗口哈希值（删除最高位数字）
            $windowHash = $windowHash - $nums[$left] * $RL;
            $left++;
        }
    }
    // 转化成题目要求的 List 类型
    return $res;
}

