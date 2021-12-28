<?php

$input = file('testinput6.txt');
//echo $input[0] . "\n";
$fishes = explode( ',', $input[0]);

for ($i = 1; $i <= 80; $i++) {
    $newFishes = [];
    array_walk($fishes, function (&$fish) {
        global $newFishes;
        if ($fish === 0) {
            $newFishes[] = 8;
            $fish = 6;
            return;
        }
        $fish--;
    });
    $fishes = [...$fishes, ...$newFishes];
    //echo implode(',', $fishes) . "\n";
}

echo 'total: ' . count($fishes);