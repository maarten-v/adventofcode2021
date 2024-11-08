<?php
$startTime = microtime(true);
$input = file('input6.txt');
$fishes = explode(',', $input[0]);

$total = 0;
$totalDays = 256;
$totals = [0, 0, 0, 0, 0, 0, 0, 0, 0];
$nextStep = [[6, 8], [0], [1], [2], [3], [4], [5], [6], [7]];
$maxFish = max($fishes);
$lastDay = false;
for ($days = 2; $days <= $totalDays; $days *= 2) {
    if ($days === $totalDays) {
        $lastDay = true;
    }
    for ($fish = 0; $fish <= 8; $fish++) {
        if ($lastDay && $fish > $maxFish) {
            continue;
        }
        $newArray = [];
        foreach ($nextStep[$fish] as $currentFish) {
            if ($days === $totalDays) {
                $totals[$fish] += count($nextStep[$currentFish]);
            } else {
                array_push($newArray, ...$nextStep[$currentFish]);
            }
        }
        if ($lastDay) {
            continue;
        }
        $newNextStepArray[$fish] = $newArray;
    }
    if ($lastDay) {
        continue;
    }
    $nextStep = $newNextStepArray;
}
foreach ($fishes as $fish) {
    $total += $totals[$fish];
}
echo $total . PHP_EOL;
$endTime = microtime(true);
$executionTime = ($endTime - $startTime) * 1000;
echo "Execution time: " . round($executionTime, 2) . " ms" . PHP_EOL;
