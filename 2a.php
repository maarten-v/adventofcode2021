<?php
$input = file('input2.txt');
$forward = 0;
$depth = 0;
foreach ($input as $line) {
    $value = explode(' ', $line)[1];
    if (strpos($line, 'forward') === 0) {
        $forward+= $value;
    }
    if (strpos($line, 'down') === 0) {
        $depth += $value;
    }
    if (strpos($line, 'up') === 0) {
        $depth -= $value;
    }
}
echo $forward * $depth;