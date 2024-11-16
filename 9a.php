<?php
$startTime = microtime(true);
$input = file('testinput9.txt');

$heights = [];
foreach ($input as $index => $line) {
    $heights[$index] = str_split(str_replace("\n",'',$line));
}
$nrOfLines = count($heights);
$total = 0;
for ($row = 0; $row < $nrOfLines; $row++) {
    for ($col = 0; $col < count($heights[$row]); $col++) {
        if (isset($heights[$row - 1][$col]) && ($heights[$row - 1][$col] < $heights[$row][$col])) {
            continue;
        }
        if (isset($heights[$row][$col - 1]) && ($heights[$row][$col - 1] < $heights[$row][$col])) {
            continue;
        }
        if (isset($heights[$row][$col + 1]) && ($heights[$row][$col + 1] < $heights[$row][$col])) {
            continue;
        }
        if (isset($heights[$row + 1][$col]) && ($heights[$row + 1][$col] < $heights[$row][$col])) {
            continue;
        }
        $total += 1 + $heights[$row][$col];
    }
}
echo $total . PHP_EOL;
$endTime = microtime(true);
$executionTime = ($endTime - $startTime) * 1000;
echo "Execution time: " . round($executionTime, 2) . " ms" . PHP_EOL;