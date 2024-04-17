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
}


