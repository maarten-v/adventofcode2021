<?php
$input = file('input1.txt');
$prevSum = 999999;
$counter = 0;
foreach ($input as $index => $line) {
    if (!isset($input[$index+2])) {
        continue;
    }
    $sum = $line + $input[$index+1] + $input[$index+2];
    if ($sum > $prevSum) {
        $counter++;
    }
    $prevSum = $sum;
}
echo $counter;