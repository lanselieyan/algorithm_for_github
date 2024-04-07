<?php
class solution{

    /****编辑距离****/
    private $memo = [];
    public  function editdistance($str1,$str2){
        $len1 = strlen($str1);
        $len2 = strlen($str2);
        $res =  $this->dp($str1,$len1-1,$str2,$len2-1);

        return $res;
    }

    public function dp($str1,$i,$str2,$j)
    {
        if($i==-1){
            return $j+1;
        }
        if($j==-1){
            return $i+1;
        }
        if(isset($this->memo[$i][$j])){
            return $this->memo[$i][$j];
        }

        if($str1[$i]==$str2[$j]){
            $this->memo[$i][$j] =$this-> dp($str1,$i-1,$str2,$j-1);
        }else{
            $this->memo[$i][$j] =$this->min(
                $this-> dp($str1,$i-1,$str2,$j-1),   //替换
                $this-> dp($str1,$i-1,$str2,$j),          //删除
                $this-> dp($str1,$i,$str2,$j-1)            //插入
            )+1;
        }
        return $this->memo[$i][$j] ;
    }

    public function min($a,$b,$c){
        if($a>$b){
            $min = $b;
        }else{
            $min = $a;
        }
        if($min>$c){
            $min = $c;
        }
        return $min;
    }

    /****编辑距离***/
    public function mindaistance($str1,$str2){
        $len1 = strlen($str1);
        $len2 = strlen($str2);
        for($i=1;$i<$len1;$i++){
            $dp[$i][0] = $i;
        }
        for($j=1;$j<$len1;$j++){
            $dp[0][$j] = $j;
        }
        for($i=1;$i<=$len1;$i++){
            for($j=1;$j<=$len1;$j++){
                if($str1[$i]==$str2[$j]){
                    $dp[$i][$j] = $dp[$i-1][$j-1];
                }else{
                    $dp[$i][$j] =
                        $this->min($dp[$i-1][$j-1]+1,  //替换
                            $dp[$i][$j-1]+1,          //插入
                            $dp[$i-1][$j]+1
                        );
                }
            }
        }
        return $dp[$len1][$len2];
    }

    /***最长递增子序列***/
    public function longestsubsequence($arr){
        $len = count($arr);
        $dp = [];
        for($i=0;$i<$len;$i++){
            $dp[$i] =1;
        }
        //从最开始的地方严格递增，即可求出每个对应结尾的递增序列
        for($i=0;$i<$len;$i++){
            for($j=0;$j<$i;$j++){
                if($arr[$i]>$arr[$j]){
                    $dp[$i] = $dp[$i]>$dp[$j]+1? $dp[$i]:$dp[$j]+1;
                }
            }
        }
        //找出最大的
        $res =1;
        for($i=0;$i<$len;$i++){
            $res =  $dp[$i]>$res?$dp[$i]:$res;
        }
    }

    //俄罗斯信封
    public function longestenvelop($arr){
        //先进行排序，第一个元素正序排，第一个元素相同时倒序排
        foreach($arr as $v){
            $first[] = $v[0];
            $second[] = $v[1];
        }
        array_multisort( $first,SORT_ASC,$second,SORT_DESC,$arr);

        //问题演变成从第二个元素中寻找最长递增子序列
        foreach($arr as $v){
            $temp[] =$v[1];
        }
        $arr = $temp;
        $len = count($arr);
        $dp = [];
        for($i=0;$i<$len;$i++){
            $dp[$i] =1;
        }
        //从最开始的地方严格递增，即可求出每个对应结尾的递增序列
        for($i=0;$i<$len;$i++){
            for($j=0;$j<$i;$j++){
                if($arr[$i]>$arr[$j]){
                    $dp[$i] = $dp[$i]>$dp[$j]+1? $dp[$i]:$dp[$j]+1;
                }
            }
        }
        //找出最大的
        $res =1;
        for($i=0;$i<$len;$i++){
            $res = $dp[$i]>$res?$dp[$i]:$res;
        }
    }

    /**********最大子数组和*************/
    public function maxArray($arr){
        $len = count($arr);
        if($len==0){
            return 0;
        }
        $dp = [];
        $dp[0] = $arr[0];
        for($i=0;$i<$len-1;$i++){
            $dp[$i] = $arr[$i]> $dp[$i-1]+$arr[$i]?$arr[$i]:$dp[$i-1]+$arr[$i];
        }
        $res = $arr[0];
        for($i=0;$i<$len-1;$i++){
            $res =$res>$dp[$i]?$res:$dp[$i];
        }
        return $res;
    }

    /***最长公共子序列**/
    public  function lonestcommonseq($arr1,$arr2){
        $len1 = count($arr1);
        $len2 = count($arr2);
        $dp = [];
        for($i=0; $i<$len1;$i++){
            $dp[$i][0] = 0;
        }
        for($j=0;$j<$len2;$j++){
            $dp[0][$j] = 0;
        }

        for($i=0; $i<$len1;$i++){
            for($j=0;$j<$len2;$j++){
                if($arr1[$i]==$arr2[$j]){
                    $dp[$i][$j] = $dp[$i-1][$j-1]+1;
                }else{
                    $dp[$i][$j] = $this->max(
                        $dp[$i-1][$j],   //$i在序列中
                        $dp[$i][$j-1]    //$j在序列中
                    );
                }
            }
        }
        return $dp[$i][$j];
    }

    public function max($a,$b){
        return $a>$b?$a:$b;
    }


    /****最小删除公共序列***/
    public function leastdelete($arr1,$arr2){
        $len1 = count($arr1);
        $len2 =count($arr2);
        $lcs = $this->lonestcommonseq($arr1,$arr2);
        return $len1-$lcs+$len2-$lcs;
    }

    /***最长回文子序列***/
    public function longhuiwenseq($str){
        $len = strlen($str);
        for($i=0;$i<$len-1;$i++){
            $dp[$i][$i] = 1;
        }
        for($i=$len-1;$i>=0;$i--){
            for($j=$i+1;$j<$len-1;$j++){
                if($str[$i]==$str[$j]){
                    $dp[$i][$j] = $dp[$i+1][$j-1]+2;
                }else{
                    $dp[$i][$j] = $dp[$i+1][$j]>$dp[$i][$j-1]?$dp[$i+1][$j]:$dp[$i][$j-1];
                }
            }
        }
        return  $dp[0][$len-1];
    }

    /****变成回文字符串最小插入***/
    public function leastinsert($str){
        $len = count($str);
        for($i=0;$i<$len;$i++){
            $dp[$i][$i] = 0;
        }
        for($i=0;$i<$len;$i++){
            for($j=$len-1;$j>0;$j--){
                if($str[$i]==$str[$j]){
                    $dp[$i][$j]= $dp[$i+1][$j-1];
                }else{
                    $dp[$i][$j] = $this->minsert(
                        $dp[$i+1][$j],
                        $dp[$i][$j-1]
                    )+1;
                }
            }
        }
        return $dp[0][$len-1];
    }

    public function minsert($a,$b){
        return $a<$b?$a:$b;
    }



}