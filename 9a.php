<?php
$startTime = microtime(true);
$input = file('input9.txt');

$heights = array_map(static function ($line) {
    return str_split(str_replace("\n", '', $line));
}, $input);
$nrOfLines = count($heights);
$total = 0;
$lineLength = count($heights[0]);
for ($row = 0; $row < $nrOfLines; $row++) {
    for ($col = 0; $col < $lineLength; $col++) {
        $higherFound = false;
        $lowerFound = false;
        checkHeight($heights[$row][$col], $heights[$row - 1][$col] ?? null, $higherFound, $lowerFound);
        checkHeight($heights[$row][$col], $heights[$row][$col - 1] ?? null, $higherFound, $lowerFound);
        checkHeight($heights[$row][$col], $heights[$row][$col + 1] ?? null, $higherFound, $lowerFound);
        checkHeight($heights[$row][$col], $heights[$row + 1][$col] ?? null, $higherFound, $lowerFound);
        if (!$higherFound || $lowerFound) {
            continue;
        }
        $total += 1 + $heights[$row][$col];
    }
}

function checkHeight($selfHeight, $surroundingHeight, &$higherFound, &$lowerFound): void
{
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