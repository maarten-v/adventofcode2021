<?php
$startTime = microtime(true);
$input = file('testinput9.txt');

$heights = [];
foreach ($input as $index => $line) {
    $heights[$index] = str_split(str_replace("\n",'',$line));
}
$nrOfLines = count($heights);
for ($row = 0; $row <= $nrOfLines; $row++) {
    for ($col = 0; $col < count($heights[$i]); $col++) {
        if ($heights[$row - 1]?[$col] && $heights[$row - 1]?[$col] )
    }
}