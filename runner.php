<?php
echo "Hello Runner\n";
$sum = 0;
for($i = 0; $i < 50; $i++){
    echo "solve $i .. ";
    exec(sprintf("php solver.php < in/%04d.txt > %04d.txt", $i, $i));
    echo "done\n";
    unset($a);
    exec(sprintf("cargo run --release --bin vis in/%04d.txt %04d.txt", $i, $i), $a);
    $score[] = intval($a[0]);
    exec(sprintf("copy out.svg %04d.svg", $i));
}
echo implode("\n", $score),"\n";
echo array_sum($score);
