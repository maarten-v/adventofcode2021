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
        $distance = abs($crab - $i);
        if (isset($stepsCache[$distance])) {
            $fuel[$i] += $stepsCache[$distance];
            continue;
        }
        $fuelForCrab = 0;
        for ($step = 1; $step <= $distance; $step++) {
             $fuelForCrab += $step;
        }
        $fuel[$i] += $fuelForCrab;
        $stepsCache[$distance] = $fuelForCrab;
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