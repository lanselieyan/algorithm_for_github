<?php
function advantageCount($nums1, $nums2) {
    $n = count($nums1);
    // 定义最大堆
    $maxpq = new SplPriorityQueue();
    $maxpq->setExtractFlags(SplPriorityQueue::EXTR_DATA); // 设置仅提取值，不提取优先级

    // 将 nums2 按降序插入最大堆
    for ($i = 0; $i < $n; $i++) {
        $maxpq->insert([$i, $nums2[$i]], $nums2[$i]);
    }

    // 对 nums1 升序排序
    sort($nums1);

    // 初始化结果数组和左右指针
    $res = array_fill(0, $n, 0);
    $left = 0;
    $right = $n - 1;

    // 循环处理最大堆
    while (!$maxpq->isEmpty()) {
        $pair = $maxpq->extract();
        // $pair[0] 是索引，$pair[1] 是最大值
        $i = $pair[0];
        $maxval = $pair[1];

        if ($maxval < $nums1[$right]) {
            // 如果 nums1[$right] 能胜过 $maxval，那就用 $nums1[$right]
            $res[$i] = $nums1[$right];
            $right--;
        } else {
            // 否则用最小值混一下，养精蓄锐
            $res[$i] = $nums1[$left];
            $left++;
        }
    }

    return $res;
}

// 示例使用
$nums1 = [2, 7, 11, 15];
$nums2 = [1, 10, 4, 11];
$result = advantageCount($nums1, $nums2);
print_r($result);


