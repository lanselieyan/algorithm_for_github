<?php
class Solution {
    /**
     * @param Integer[] $nums
     * @return Boolean
     */
    function PredictTheWinner($nums) {
        if ($nums == null || count($nums) < 1) {
            return false;
        }
        return $this->first($nums, 0, count($nums) - 1) >= $this->last($nums, 0, count($nums) - 1);
    }

    function first($nums, $l, $r) {
        if ($l == $r) {
            return $nums[$l];
        }
        return max($nums[$l] + $this->last($nums, $l + 1, $r), $nums[$r] + $this->last($nums, $l, $r - 1));
    }
    function last($nums, $l, $r) {
        if ($l == $r) {
            return 0;
        }
        return min($this->first($nums, $l + 1, $r), $this->first($nums, $l, $r - 1));
    }
}