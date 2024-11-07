<?php
$startTime = microtime(true);
$input = file('input6.txt');
//echo $input[0] . "\n";
$fishes = explode(',', $input[0]);

$total = 0;
$totalDays = 256;
$totals = [0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0];
$nextStep = [0 => [6, 8], 1 => [0], 2 => [1], 3 => [2], 4 => [3], 5 => [4], 6 => [5], 7 => [6], 8 => [7]];
for ($days = 2; $days <= $totalDays; $days *= 2) {
    for ($fish = 0; $fish <= 8; $fish++) {
        if ($days === $totalDays && $fish > max($fishes)) {
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
        $newNextStepArray[$fish] = $newArray;
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
exit();









//alternative:


foreach ($fishes as $fish) {
    $currentFishes = [$fish];
    $currentFishTotal = 0;
    $fishesAreRemoved = false;
    for ($day = 1; $day <= $totalDays; $day++) {
        $fishesCount = count($currentFishes);
        $daysToGo = $totalDays - $day;
        if ($fishesCount === 0) {
            if (!isset($cache[$fish][$day])) {
                $cache[$fish][$totalDays] = $currentFishTotal + count($currentFishes);
            }
            break;
        }
        $fishesToUnset = [];
        for ($fishCounter = 0; $fishCounter < $fishesCount; $fishCounter++) {
            $currentFish = $currentFishes[$fishCounter];
            if (isset($cache[$currentFish][$daysToGo + 1])) {
                $currentFishTotal += $cache[$currentFish][$daysToGo + 1];
                $fishesAreRemoved = true;
                $fishesToUnset[] = $fishCounter;
                continue;
            }
            if ($currentFish === 0) {
                $currentFishes[] = 8;
                $currentFishes[$fishCounter] = 6;
            } else {
                $currentFishes[$fishCounter]--;
            }
        }
        foreach ($fishesToUnset as $fishToUnset) {
            unset($currentFishes[$fishToUnset]);
        }
        if ($fishesAreRemoved) {
            $currentFishes = array_values($currentFishes);
        } elseif (!isset($cache[$fish][$day])) {
            $cache[$fish][$day] = count($currentFishes);
        }
    }
    $total += $currentFishTotal + count($currentFishes);
}
echo $total . PHP_EOL;

$endTime = microtime(true);
$executionTime = ($endTime - $startTime) * 1000;
echo "Execution time: " . round($executionTime, 2) . " ms" . PHP_EOL;