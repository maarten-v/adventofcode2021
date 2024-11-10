<?php
$startTime = microtime(true);
$input = file('input6.txt');
$fishes = explode( ',', $input[0]);
$cache = [];
$total = 0;
foreach ($fishes as $fish) {
    if (isset($cache[$fish])) {
        $total += $cache[$fish];
        continue;
    }
    $fishesForDay = [$fish];
    for ($day = 1; $day <= 80; $day++) {
        $newFishes = [];
        $countFishesForDay = count($fishesForDay);
        for ($fishForDay = 0; $fishForDay < $countFishesForDay; $fishForDay++) {
            if ($fishesForDay[$fishForDay] === 0) {
                $newFishes[] = 8;
                $fishesForDay[$fishForDay] = 6;
                continue;
            }
            $fishesForDay[$fishForDay]--;
        }
        array_push($fishesForDay, ...$newFishes);
    }
    $cache[$fish] = count($fishesForDay);
    $total += $cache[$fish];
}

echo 'total: ' . $total . PHP_EOL;
$endTime = microtime(true);
$executionTime = ($endTime - $startTime) * 1000;
echo "Execution time: " . round($executionTime, 2) . " ms" . PHP_EOL;