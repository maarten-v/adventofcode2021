<?php
$input = file('input2.txt');
$forward = 0;
$depth = 0;
$aim = 0;
foreach ($input as $line) {
    $value = explode(' ', $line)[1];
    if (strpos($line, 'forward') === 0) {
        $forward+= $value;
        $depth += ($value * $aim);
    }
    if (strpos($line, 'down') === 0) {
        $aim += $value;
    }
    if (strpos($line, 'up') === 0) {
        $aim -= $value;
    }
}
echo $forward * $depth;