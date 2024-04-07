<?php
class solution {
    //上下左右全部淹掉
    public function dfs($arr,$i,$j){
        $m = count($arr);
        $n = count($arr[0]);
        if($i<0||$i>$m-1||$j<0||$j>$n-1){
            return;
        }
        if($arr[$i][$j]==0){
            return;
        }

        $arr[$i][$j]=0;
        $this->dfs($arr,$i-1,$j);
        $this->dfs($arr,$i+1,$j);
        $this->dfs($arr,$i,$j-1);
        $this->dfs($arr,$i,$j+1);

    }


    //求岛屿数量
    public function solutionIslands($arr){
        $m = count($arr);
        $n = count($arr[0]);
        $res = 0;
        for($i=0;$i<$m;$i++){
            for($j=0;$j<$n;$j++){
                 if($arr[$i][$j]=='1'){
                     $res++;
                     $this-> dfs($arr,$i,$j);
                 }
            }
        }
        return $res;
    }

    //求封闭岛屿的数量
    public function solutionfengbiIslands($arr){
        $m = count($arr);
        $n = count($arr[0]);
        $res = 0;
        for($i=0;$i<$m;$i++){
            $this-> dfs($arr,$i,0);
            $this-> dfs($arr,$i,$n-1);
        }
        for($j=0;$j<$n;$j++){
            $this-> dfs($arr,0,$j);
            $this-> dfs($arr,$m-1,$j);
        }
        for($i=0;$i<$m;$i++){
            for($j=0;$j<$n;$j++){
                if($arr[$i][$j]==1){
                    $res++;
                    $this->dfs($arr,$i,$j);
                }
            }
        }
        return $res;
    }

    //求封闭岛屿的面积
    public function solutionaReIsalnds($arr){
        $m = count($arr);
        $n = count($arr[0]);
        $res = 0;
        for($i=0;$i<$m;$i++){
            $this-> dfs($arr,$i,0);
            $this-> dfs($arr,$i,$n-1);
        }
        for($j=0;$j<$n;$j++){
            $this-> dfs($arr,0,$j);
            $this-> dfs($arr,$m-1,$j);
        }
        for($i=0;$i<$m;$i++){
            for($j=0;$j<$n;$j++){
                if($arr[$i][$j]==1){
                    $res++;
                }
            }
        }
        return $res;
    }

    //求封闭岛屿的面积
    public function solutionMaxIsalnds($arr){
        $m = count($arr);
        $n = count($arr[0]);
        $res = 0;
        for($i=0;$i<$m;$i++){
            $this-> dfs($arr,$i,0);
            $this-> dfs($arr,$i,$n-1);
        }
        for($j=0;$j<$n;$j++){
            $this-> dfs($arr,0,$j);
            $this-> dfs($arr,$m-1,$j);
        }
        for($i=0;$i<$m;$i++){
            for($j=0;$j<$n;$j++){
                if($arr[$i][$j]==1){
                    //逐个加即可，此刻不需要多余淹没
                    $res++;
                }
            }
        }
        return $res;
    }

    //岛屿的最大面积
    public function sloutionMaxIslands($arr){
        $m = count($arr);
        $n = count($arr[0]);
        $res = 0;
        for($i=0;$i<$m;$i++){
            for($j=0;$j<$n;$j++){
                if($arr[$i][$j]==1){
                    $area = $this-> maxdfs($arr,$i,$j);
                    $res = $area>$res?$area:$res;
                }
            }
        }
        return $res;
    }

    //上下左右全部淹掉, 同时返回岛屿面积
    public function maxdfs($arr,$i,$j){
        $m = count($arr);
        $n = count($arr[0]);
        if($i<0||$i>$m-1||$j<0||$j>$n-1){
            return 0;
        }
        if($arr[$i][$j]==0){
            return 0;
        }

        $arr[$i][$j]=0;
        return $this->dfs($arr,$i-1,$j)
            +  $this->dfs($arr,$i+1,$j)
            +  $this->dfs($arr,$i,$j-1)
            +  $this->dfs($arr,$i,$j+1)
            +1;
    }


    //求arr2中子岛屿的数量
    public function sonIslands($arr1,$arr2){
        $m = count($arr2);
        $n = count($arr2[0]);
        for($i=0;$i<$m;$i++){
            for($j=0;$j<$n;$j++){
                if($arr2[$m][$n]==1&&$arr1[$m][$n]==0){
                    // 发现不是子岛屿，淹掉
                    $this->dfs($arr2,$i,$j);
                }
            }
        }

        // 最后没有淹掉的就是子岛屿了；
        for($i=0;$i<$m;$i++){
            for($j=0;$j<$n;$j++){
                if($arr2[$m][$n]==1){
                   $res++;
                }
            }
        }
        return $res;
    }

    //不同岛屿的数量
    public function solutionDiffIsland($arr){
        $m = count($arr);
        $n = count($arr[0]);
        for($i=0;$i<$m;$i++){
            for($j=0;$j<$n;$j++){
                if($arr[$m][$n]==1){
                    // 发现不是子岛屿，淹掉
                    $str = '';
                    $this->diffpathdfs($arr,$i,$j,$str,666);
                    $res[] = $str;
                }
            }
        }
        return count(array_unique($res));
    }


    //上下左右全部淹掉,同时保存路径
    public function diffpathdfs($arr,$i,$j,&$str,$dir){
        $m = count($arr);
        $n = count($arr[0]);
        if($i<0||$i>$m-1||$j<0||$j>$n-1){
            return;
        }
        if($arr[$i][$j]==0){
            return;
        }
        $str.=$dir;

        $arr[$i][$j]=0;
        $this->diffpathdfs($arr,$i-1,$j,$str,1);
        $this->diffpathdfs($arr,$i+1,$j,$str,2);
        $this->diffpathdfs($arr,$i,$j-1,$str,3);
        $this->diffpathdfs($arr,$i,$j+1,$str,4);
        $str.=-$dir;
    }


}


