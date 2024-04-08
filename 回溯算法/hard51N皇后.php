<?php
class Solution {
    public $res;

    /* 输入棋盘边长 n，返回所有合法的放置 */
    public function solveNQueens($n) {
        $this->res = [];
        // 初始化空棋盘
        $board = array_fill(0, $n, str_repeat('.', $n));
        $this->backtrack($board, 0);
        return $this->res;
    }

    // 路径：board 中小于 row 的那些行都已经成功放置了皇后
    // 选择列表：第 row 行的所有列都是放置皇后的选择
    // 结束条件：row 超过 board 的最后一行
    private function backtrack(&$board, $row) {
        // 触发结束条件
        if ($row == count($board)) {
            $this->res[] = $board;
            return;
        }

        $n = strlen($board[$row]);
        for ($col = 0; $col < $n; $col++) {
            // 排除不合法选择
            if (!$this->isValid($board, $row, $col)) {
                continue;
            }
            // 做选择
            $board[$row][$col] = 'Q';
            // 进入下一行决策
            $this->backtrack($board, $row + 1);
            // 撤销选择
            $board[$row][$col] = '.';
        }
    }

    // 判断在 board[row][col] 放置皇后是否合法
    private function isValid(&$board, $row, $col) {
        $n = count($board);
        // 检查列是否有皇后互相冲突
        for ($i = 0; $i < $n; $i++) {
            if ($board[$i][$col] == 'Q') return false;
        }
        // 检查右上方是否有皇后互相冲突
        for ($i = $row - 1, $j = $col + 1; $i >= 0 && $j < $n; $i--, $j++) {
            if ($board[$i][$j] == 'Q') return false;
        }
        // 检查左上方是否有皇后互相冲突
        for ($i = $row - 1, $j = $col - 1; $i >= 0 && $j >= 0; $i--, $j--) {
            if ($board[$i][$j] == 'Q') return false;
        }
        return true;
    }
}
