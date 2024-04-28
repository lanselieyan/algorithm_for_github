<?php


class HitCounter
{
    private $q;

    public function __construct()
    {
        $this->q = new SplQueue();
    }

    public function hit($timestamp)
    {
        $this->q->enqueue($timestamp);
    }

    public function getHits($timestamp)
    {
        // 留队列中最近 300 秒的数据即可
        while (!$this->q->isEmpty() && $timestamp - $this->q->bottom() >= 300) {
            $this->q->dequeue();
        }
        return $this->q->count();
    }

    public  function findMinAbs($sortArr){
        $left = 0;
        $right =count($sortArr)-1;

        while($left <= $right) {
           $mid = $left + ($right-$left)/2;
           if($sortArr[$mid]==0){
               return $sortArr[$mid];
           }
           if(abs($sortArr[$mid-1])<abs($sortArr[$mid])){
               $right = $mid-1;
           }else{
               $left = $mid;
           }

        }
        return $sortArr[$right];
    }



    function countWays($k) {
//        $dp = array_fill(0, $k + 1, 0);
        //base case 为0 ，一种走法
        $dp[0] = 1;

        //递归，自低向上
        for ($i = 1; $i <= $k; $i++) {
            if ($i >= 1) {
                //走一步，相当于加上前面少走一步路程需要的方法
                $dp[$i] += $dp[$i - 1];
            }
            if ($i >= 3) {
                //走三步，相当于加上前面少走一步路程需要的方法
                $dp[$i] += $dp[$i - 3];
            }
        }

        return $dp[$k];
    }


}







