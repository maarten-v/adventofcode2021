<?php
$startTime = microtime(true);
$input = file('input7.txt');
$crabs = explode(',', $input[0]);

$fuel = [];
for ($i = min($crabs); $i < max($crabs); $i++) {
    if (isset($cache[$i])) {
        $fuel += $cache[$i];
        continue;
    }
    $fuel[$i] = 0;
    foreach ($crabs as $crab) {
        $fuel[$i] += abs($crab - $i);
    }
    if (isset($fuel[$i - 1]) && $fuel[$i] > $fuel[$i - 1]) {
        break;
    }
    $cache[$i] = $fuel[$i];
}

echo min($fuel) . PHP_EOL;
$endTime = microtime(true);
$executionTime = ($endTime - $startTime) * 1000;
echo "Execution time: " . round($executionTime, 2) . " ms" . PHP_EOL;