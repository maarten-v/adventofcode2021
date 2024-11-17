<?php
$startTime = microtime(true);
$input = file('input9.txt');

$heights = [];
foreach ($input as $index => $line) {
    $heights[$index] = str_split(str_replace("\n",'',$line));
}
$nrOfLines = count($heights);
$total = 0;
for ($row = 0; $row < $nrOfLines; $row++) {
    for ($col = 0; $col < count($heights[$row]); $col++) {
        $higherFound = false;
        $lowerFound = false;
        checkHeight($heights[$row][$col], $heights[$row - 1][$col], $higherFound, $lowerFound);
        checkHeight($heights[$row][$col], $heights[$row - 1][$col], $higherFound, $lowerFound);
        checkHeight($heights[$row][$col], $heights[$row - 1][$col], $higherFound, $lowerFound);
        checkHeight($heights[$row][$col], $heights[$row - 1][$col], $higherFound, $lowerFound);

        if (isset($heights[$row - 1][$col])) {
            if ($heights[$row - 1][$col] > $heights[$row][$col]) {
                $higherFound = true;
            } elseif ($heights[$row - 1][$col] < $heights[$row][$col]) {
                continue;
            }
        }
        if (!$higherFound) {
            continue;
        }
        echo $row . '-' . $col. PHP_EOL;
        $total += 1 + $heights[$row][$col];
    }
}

function checkHeight($selfHeight, $surroundingHeight, &$higherFound, &$lowerFound) {
    if ($lowerFound) {
        return;
    }
    if (isset($surroundingHeight)) {
        if ($surroundingHeight > $selfHeight) {
            $higherFound = true;
        }
        if ($surroundingHeight < $selfHeight) {
            $lowerFound = true;
        }
    }
}

echo $total . PHP_EOL;
$endTime = microtime(true);
$executionTime = ($endTime - $startTime) * 1000;
echo "Execution time: " . round($executionTime, 2) . " ms" . PHP_EOL;