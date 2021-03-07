<?php
[$N] = ints();
for($i = 0; $i < $N; $i++){
    [$x,$y,$r] = ints();
    $X[] = $x; $Y[] = $y; $R[] = $r; $I[] = $i;
}
$score1 = 0; 
$score2 = 0; 
$time = microtime(true);
$count = 0;
while(true){
    [$result11, $score11] = solve($X,$Y,$R,$I);
    if($score1 < $score11){$score1 = $score11; $result1 = $result11;}
    [$result21, $score21] = solve($Y,$X,$R,$I);
    if($score2 < $score21){$score2 = $score21; $result2 = $result21;}
    if(microtime(true) - $time > 4.8)break;
    $count++;
}
$flip = $score1 < $score2;
if($flip){
    $result = $result2;
    for($i = 0; $i < $N; $i++){
        [$result[$i][0],$result[$i][1],$result[$i][2],$result[$i][3]] = [$result[$i][1],$result[$i][0],$result[$i][3],$result[$i][2]]; 
    }
}else{
    $result = $result1;
}
for($i = 0; $i < $N; $i++){
    echo implode(" ", $result[$i]),"\n";
}
function solve($X,$Y,$R,$I){
    $N = count($X);
    for($i = 0; $i < $N; $i++){
        $map[$Y[$i]][$X[$i]] = 1;
    }
    $origR = $R;
    $origX = $X;
    array_multisort($R, $X, $Y, $I);

    for($i = 0; $i < $N; $i++){
        $yt = $Y[$i]; $yb = $Y[$i]+1;
        $xr = $X[$i]; $xl = $X[$i];
        $r = $R[$i];
        if(count($map[$yt]) == 1)$xr = 10000;
        while(!isset($map[$yt][$xr+1]) && $xr < 10000 && $xr - $X[$i] < $r){ // 右に伸ばす
            $xr++;
        }
        if(count($map[$yt]) == 1)$xl = 0;
        while(count($map[$yt]) == 1 && !isset($map[$yt][$xl-1]) && $xl > 0 && $xr - $xl < $r){ // 左に伸ばす
            $xl--;
        }
        $M = rand()%2;
        for($j = 0; $j < 2; $j++){
            if(($j+$M) % 2 == 0){
                while(!isset($map[$yt-1]) && $yt > 0 && ($yb-$yt)*($xr-$xl) < $r){ // 上に伸ばす
                    $yt--;
                    $map[$yt] = true;
                }
            }
            if(($j+$M) % 2 == 1){
                while(!isset($map[$yb+1]) && !isset($map[$yb]) && $yb < 10000 && ($yb-$yt)*($xr-$xl) < $r){ // 下に伸ばす
                    $map[$yb] = true;
                    $yb++;
                }
            }
        }
        $result[$I[$i]] = [$xl,$yt,$xr,$yb];
    }
    for($i = 0; $i < $N; $i++){
        $max = $origX[$i] - $result[$i][0];
        $best = floor($result[$i][2] - $result[$i][0] - $origR[$i] / ($result[$i][3]-$result[$i][1]));
        $result[$i][0] += max(0,min($best, $max));
        
        $max = $result[$i][2] - $origX[$i]-1;
        $best = floor($result[$i][2] - $result[$i][0] - $origR[$i] / ($result[$i][3]-$result[$i][1]));
        $result[$i][2] -= max(0,min($best, $max));
    }
    $sumP = 0;
    for($i = 0; $i < $N; $i++){
        $s = ($result[$i][3]-$result[$i][1])*($result[$i][2]-$result[$i][0]);
        $p = 1-(1-min($origR[$i], $s)/max($origR[$i], $s))**2;
        $sumP += $p;
    }
    $sumP/=$N;
    return [$result, $sumP];
}

function ints($n = false){
   return array_map('intval',explode(' ',trim(fgets(STDIN))));
}
function chmax(&$a,$b){if($a<$b){$a=$b;return 1;}return 0;}
function chmin(&$a,$b){if($a>$b){$a=$b;return 1;}return 0;}
function o(...$val){
  if(count($val)==1)$val=array_shift($val);
  echo debug_backtrace()[0]['line'].")";
  if(is_array($val)){
    if(count($val) == 0)echo "empty array\n";
    elseif(!is_array(current($val)))echo "array: ",implode(" ", addIndex($val)),"\n";
    else{
      echo "array:array\n";
      if(isCleanArray($val))foreach($val as $row)echo implode(" ", addIndex($row)),"\n";
      else foreach($val as $i => $row)echo "[".$i."] ".implode(" ", addIndex($row)),"\n";
    }
  }else echo $val."\n";
}
function addIndex($val){if(!isCleanArray($val)){$val = array_map(function($k, $v){return $k.":".$v;}, array_keys($val), $val);}return $val;}
function isCleanArray($array){$clean=true;$i = 0;foreach($array as $k=>$v){if($k != $i++)$clean = false;}return $clean;}
