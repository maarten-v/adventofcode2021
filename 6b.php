<?php
$startTime = microtime(true);
$input = file('input6.txt');
//echo $input[0] . "\n";
$fishes = explode( ',', $input[0]);

$total = 0;
$totalDays = 256;
$cache = [];
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
        foreach($fishesToUnset as $fishToUnset) {
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