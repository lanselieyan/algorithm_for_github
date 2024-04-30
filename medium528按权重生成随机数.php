<?php
function weighted_random($weights) {
    // 计算权重总和
    $total_weight = array_sum($weights);

    // 生成一个随机数，范围在0到权重总和之间
    $random_number = mt_rand(1, $total_weight);

    // 遍历权重数组，并返回第一个累积权重大于或等于随机数的索引
    $weight_sum = 0;
    foreach ($weights as $index => $weight) {
        $weight_sum += $weight;
        if ($weight_sum >= $random_number) {
            return $index;
        }
    }

    // 如果未能找到索引，则返回最后一个索引（这通常不会发生）
    return count($weights) - 1;
}

// 示例使用
$weights = [1, 2, 3, 4];
$index = weighted_random($weights);
echo "Random index: " . $index;

