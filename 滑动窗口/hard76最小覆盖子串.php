<?php
class window {
   //力扣第 76 题「最小覆盖子串」难度 Hard：
    //最小覆盖子串
   public  function  minwindow($s ,$t){
        $strlenT = strlen($t);
        $strlenS = strlen($s);
        $need = [];
        $window = [];
       // 统计 t 中各字符出现次数
        for($i=0;$i<$strlenT;$i++){
           $need[$t[$i]] = +1;
        }
        $left = 0 ;$right = 0;
        $valid = 0;//窗口中满足需要的字符个数
        $minlen = $strlenS+1;//初始化最小字符长度

       while($right<$strlenS){
          //移入窗口的字符
           $str = $s[$right];
           $right++;
           //窗口匹配更新
           if(isset($need[$str])){
               //匹配成功了，来累计窗口
               $window[$str] = isset($window[$str]) ? $window[$str] + 1 : 1;
               if($window[$str] ==$need[$str]){
                   //当某一个字符出现的次数 ===匹配的模式出现的字符相同时，代表这个字符已经匹配完成，可以累计➕1
                   $valid ++;
               }
           }

           //判断左侧窗口是否需要收缩
           while($valid == count($need)){   //代表每一个字符串均完成匹配，此时可以考虑收缩
               //更新记录一下目前的窗口边界
               if($right-$left<$minlen){
                   $start = $left;        //左边界
                   $minlen = $right-$left;   //目前记录的最小有效窗口，后续如果有更小的，也会被更新
               }

               //从左边开始移除窗口
               $d = $s[$left];
               // 缩小窗口
               $left++;
               //进行窗口判断更新
               if(isset($need[$d])){   //被移除的字符正好是要相互匹配的
                    if($need[$d]==$window[$d]){
                        //  window[d] 内的出现次数和 need[d] 相等时，才能 -1
                        $valid--;
                    }
                    $window[$d]--;     //出现一次减一次，表示此字符串不参与匹配了
               }
           }
       }
       //匹配完成之后,返回
       return $minlen == PHP_INT_MAX ?
           "":substr($s, $start, $minlen);
   }
}