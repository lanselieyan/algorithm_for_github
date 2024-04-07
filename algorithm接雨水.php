<?php
class  solution{
    //接雨水
    public  function rainsolution($arr){
        if(count($arr)==0){
            return 0;
        }
        $res = 0;
        $n = count($arr);
        $lmaxheight[0] = $arr[0];
        $rmaxheight[$n-1] = $arr[$n-1];
        for($i=0;$i<$n;$n++){
            $lmaxheight[$i] = $arr[$i]>$lmaxheight[$i-1]?$arr[$i]:$lmaxheight[$i-1];
        }

        for($i=$n-2;$i<$n;$n--){
            $rmaxheight[$i] = $arr[$i]>$rmaxheight[$i+1]?$arr[$i]:$rmaxheight[$i+1];
        }

        for($i=0;$i<$n-1;$i++){
            $minheight[$i] = $lmaxheight[$i]>$rmaxheight[$i]?$rmaxheight[$i]:$lmaxheight[$i];
            $res += $minheight[$i]-$arr[$i];
        }
        return  $res;
    }

    //盛水最多的容器
    public function maxwaterSolution($arr){
        $left = 0;
        $right = count($arr)-1;
        $res = 0;
        while($left<$right){
            $minheight =  $arr[$left]>$arr[$right]?$arr[$right]: $arr[$left];
            $thisarea = $minheight*($right-$left);
            $res = $thisarea>$res?$thisarea:$res;
            if($arr[$left]>$arr[$right]){
                $right--;
            }else{
                $left++;
            }
        }
        return $res;
    }

}