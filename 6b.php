<?php

$input = file('input6.txt');
//echo $input[0] . "\n";
$fishes = explode( ',', $input[0]);

//$fishes = [8, 8];

$total = 0;
$totalDays = 256;
$cache = [];
$globalFishCounter = 0;
foreach ($fishes as $fish) {
    $globalFishCounter++;
    $currentFishes = [$fish];
    $currentFishTotal = 0;
    $numberOfRemovedFishes = 0;
    //echo $globalFishCounter . PHP_EOL;
    for ($day = 1; $day <= $totalDays; $day++) {
        //echo PHP_EOL;
        $fishesCount = count($currentFishes);
        if ($fishesCount === 0) {
            //echo 'finished for this fish, continue to next one' . PHP_EOL;
            continue;
        }
        $daysToGo = $totalDays - $day;
        //echo 'fish count: ' . $fishesCount . PHP_EOL;
        //echo 'fishes: ' . implode(',', $currentFishes) . PHP_EOL;
        //echo 'days to go: '. $daysToGo  . PHP_EOL;
        //echo 'current day: ' . $day . ' fish: ' . $globalFishCounter . ' from ' . count($fishes) .  PHP_EOL;
        $fishesToUnset = [];
        for ($fishCounter = 0; $fishCounter < $fishesCount; $fishCounter++) {
            //echo implode(', ', $currentFishes) . PHP_EOL;
            $currentFish = $currentFishes[$fishCounter];
            if (isset($cache[$currentFish][$daysToGo + 1])) {
                //echo "for $currentFish with days {($daysToGo + 1)} to go add to total: " . $cache[$currentFish][$daysToGo + 1] . PHP_EOL;
                //var_dump($cache);exit();
                //$total += $cache[$currentFish][$daysToGo + 1];
                $currentFishTotal += $cache[$currentFish][$daysToGo + 1];
                $numberOfRemovedFishes++;
                $fishesToUnset[] = $fishCounter;
                continue;
            }
            if ($currentFish === 0) {
                $currentFishes[] = 8;
                $currentFishes[$fishCounter] = 6;
            } else {
                $currentFishes[$fishCounter] = $currentFish - 1;
            }
        }
        foreach($fishesToUnset as $fishToUnset) {
            unset($currentFishes[$fishToUnset]);
        }
        if (!isset($cache[$fish][$day]) && $numberOfRemovedFishes === 0) {
            //echo "count current fishes " . count($currentFishes) . PHP_EOL;
            //echo "currentfishtotal " . $currentFishTotal . PHP_EOL;
            //var_dump($currentFishes);
            //echo "fishes to unset " . count($fishesToUnset) . PHP_EOL;
            //echo "number of removed fishes " . $numberOfRemovedFishes . PHP_EOL;
            //echo 'zet in cache ' . $fish . ' ' . $day . ' ' . (count($currentFishes)) . PHP_EOL;
            $cache[$fish][$day] = count($currentFishes) + $numberOfRemovedFishes;
        } elseif (!isset($cache[$fish][$day]) && $daysToGo === 0) {
            //echo 'zet in cache totaal ' . $fish . ' ' . $day . ' ' . ($currentFishTotal + count($currentFishes)) . PHP_EOL;
            $cache[$fish][$day] = $currentFishTotal + count($currentFishes);
        }
        $currentFishes = array_values($currentFishes);
        //echo 'fishes end of day: ' . implode(',', $currentFishes) . PHP_EOL;
        //echo 'in current total: ' . $currentFishTotal . PHP_EOL;
    }
    //echo "add to total remaining number of fishes: " . $currentFishTotal . PHP_EOL . PHP_EOL;
    $total += $currentFishTotal + count($currentFishes);
}

echo $total;