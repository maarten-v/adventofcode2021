<?php

$input = file('testinput6.txt');
//echo $input[0] . "\n";
$startFishes = explode( ',', $input[0]);
array_walk($startFishes, function (&$fish) {
    $fish = (int) $fish;
});
$total = 0;
foreach ($startFishes as $startFish) {
    $fishes = [$startFish];
    for ($i = 1; $i <= 128; $i++) {
        echo "$i ";
        $newFishes = 0;
        $newDayOldFishes = 0;
        array_walk($fishes, function (&$fish) {
            if ($fish === 0) {
                global $newFishes;
                $newFishes++;
                $fish = 5;
                return;
            }
            if ($fish === 1) {
                global $newDayOldFishes;
                $newDayOldFishes++;
                $fish = 6;
                return;
            }
            $fish -= 2;
        });
        for ($j = 0; $j < $newFishes; $j++) {
            $fishes[] = 7;
        }
        for ($j = 0; $j < $newDayOldFishes; $j++) {
            $fishes[] = 8;
        }
//    echo implode(',', $fishes) . "\n";
    }
    echo 'total: ' . count($fishes) . "\n";
    $total += count($fishes);
}

echo 'total: ' . $total;