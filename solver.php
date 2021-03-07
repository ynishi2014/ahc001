<?php
[$N] = ints();
for($i = 0; $i < $N; $i++){
    [$x,$y,$r] = ints();
    $map[$y][$x] = $r;
    $X[] = $x; $Y[] = $y; $R[] = $r; $I[] = $i;
}
array_multisort($R, $X, $Y, $I);

for($i = 0; $i < $N; $i++){
  $yt = $Y[$i]; $yb = $Y[$i]+1;
  $xr = $X[$i]; $xl = $X[$i];
  $r = $R[$i];
  while(!isset($map[$yt][$xr+1]) && $xr < 10000 && $xr - $X[$i] < $r){
    $xr++;
  }
  while(count($map[$yt]) == 1 && !isset($map[$yt][$xl-1]) && $xl > 0 && $xr - $xl < $r){
    $xl--;
  }
  while(!isset($map[$yt-1]) && $yt > 0 && ($yb-$yt + 0.5)*($xr-$xl) < $r){
    $yt--;
    $map[$yt] = true;
  }
  while(!isset($map[$yb+1]) && !isset($map[$yb]) && $yb < 10000 && ($yb-$yt+0.5)*($xr-$xl) < $r){
    $yb++;
    $map[$yb] = true;
  }
  $result[$I[$i]] = [$xl,$yt,$xr,$yb];
}
for($i = 0; $i < $N; $i++){
    echo implode(" ", $result[$i]),"\n";
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
