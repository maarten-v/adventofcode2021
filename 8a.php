<?php
$startTime = microtime(true);
$input = file('input8.txt');

$count = 0;
foreach ($input as $index => $line) {
    $line = str_replace("\n", '', $line);
    $readings = explode(' ', substr($line, 61));

    foreach ($readings as $reading) {
        if (in_array(strlen($reading), [2, 4, 3, 7])) {
            $count++;
        }
    }
}

echo $count . PHP_EOL;
$endTime = microtime(true);
$executionTime = ($endTime - $startTime) * 1000;
echo "Execution time: " . round($executionTime, 2) . " ms" . PHP_EOL;