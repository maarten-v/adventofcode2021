<?php
$input = file('input3.txt');
$binary = [];
foreach ($input as $line) {
    $line = str_replace("\n", '', $line);
    foreach (str_split($line) as $index => $character) {
        if (!isset($binary[$index][$character])) {
            $binary[$index][$character] = 0;
        }
        $binary[$index][$character]++;
    }
}
$gamma = '';
$epsilon = '';
foreach ($binary as $position) {
    $gamma .= ($position['1'] > $position['0']) ? '1' : '0';
    $epsilon .= ($position['1'] > $position['0']) ? '0' : '1';
}

echo bindec($gamma) * bindec($epsilon);