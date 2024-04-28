<?php
function multiply($num1, $num2) {
    $m = strlen($num1);
    $n = strlen($num2);
    // 结果最多为 m + n 位数
    $res = array_fill(0, $m + $n, 0);
    // 从个位数开始逐位相乘
    for ($i = $m - 1; $i >= 0; $i--) {
        for ($j = $n - 1; $j >= 0; $j--) {
            $mul = (int)($num1[$i]) * (int)($num2[$j]);
            // 乘积在 res 对应的索引位置
            $p1 = $i + $j;
            $p2 = $i + $j + 1;
            // 叠加到 res 上
            $sum = $mul + $res[$p2];
            $res[$p2] = $sum % 10;
            $res[$p1] += (int)($sum / 10);
        }
    }
    // 结果前缀可能存的 0（未使用的位）
    $i = 0;
    while ($i < count($res) && $res[$i] == 0) {
        $i++;
    }
    // 将计算结果转化成字符串
    $str = '';
    for (; $i < count($res); $i++) {
        $str .= (string)($res[$i]);
    }

    return strlen($str) == 0 ? "0" : $str;
}
