<?php
$input = file('input1.txt');
$prevLine = 999999;
$counter = 0;
foreach ($input as $line) {
    if ($line > $prevLine) {
        $counter++;
    }
    $prevLine = $line;
}
echo $counter;