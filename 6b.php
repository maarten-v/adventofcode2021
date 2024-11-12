<?php
$startTime = microtime(true);
$input = file('input6.txt');
$fishes = explode(',', $input[0]);


$total = 0;
$totalDays = 8;
$totals = array_fill(0, 9, 0);

foreach ($fishes as $fish) {
    $totals[$fish]++;
}

$nextStep = [
    [0, 0, 0, 0, 0, 0, 1, 0, 1],
    [1, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 1, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 1, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 1, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 1, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 1, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 1, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 1, 0],
    ];
$maxFish = max($fishes);
$lastDay = false;
$totals = [0,0,0,0,0,0,0,0,1];

for ($days = 2; $days <= $totalDays; $days *= 2) {
    for ($i = 0; $i <= 8; $i++) {
        $newArray = $totals;
        for ($age = 0; $age <= 8; $age++) {
            if ($nextStep[$i][$age] > 0 && $totals[$i] > 0) {
                echo 'add to ' . $age . ($totals[$i] * $nextStep[$i][$age]) .  PHP_EOL;
                $newArray[$age] = $totals[$i] * $nextStep[$i][$age];
            }
        }
        $newArray[$i] = 0;
        echo PHP_EOL .  implode($newArray) . PHP_EOL;
        $totals = $newArray;
    }
    $nextStep[8] = $newArray;
    echo implode($totals) . PHP_EOL;
}
//
//
//    for ($fish = 0; $fish <= 8; $fish++) {
//        if ($lastDay && $fish > $maxFish) {
//            continue;
//        }
//        $newArray = [];
//        foreach ($nextStep[$fish] as $currentFish) {
//            if ($days === $totalDays) {
//                $totals[$fish] += count($nextStep[$currentFish]);
//            } else {
//                array_push($newArray, ...$nextStep[$currentFish]);
//            }
//        }
//        if ($lastDay) {
//            continue;
//        }
//        $newNextStepArray[$fish] = $newArray;
//    }
//    if ($lastDay) {
//        continue;
//    }
//    $nextStep = $newNextStepArray;
//}
//foreach ($fishes as $fish) {
//    $total += $totals[$fish];
//}
echo $total . PHP_EOL;
$endTime = microtime(true);
$executionTime = ($endTime - $startTime) * 1000;
echo "Execution time: " . round($executionTime, 2) . " ms" . PHP_EOL;
