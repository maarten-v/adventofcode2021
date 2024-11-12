<?php
$startTime = microtime(true);
$input = file('input8.txt');

$output = [];
foreach ($input as $index => $line) {
    $line = str_replace("\n", '', $line);
    $patterns = explode(' ', substr($line, 0, 58));
    $readings = explode(' ', substr($line, 61));

    $numbers = [];
    $conversion = [];
    $patternsByLength = array_fill(2, 6, []);
    foreach ($patterns as $pattern) {
        $patternsByLength[strlen($pattern)][] = str_split($pattern);
    }
    $numbers[1] = $patternsByLength[2][0];
    $numbers[4] = $patternsByLength[4][0];
    $numbers[7] = $patternsByLength[3][0];
    $numbers[8] = $patternsByLength[7][0];
    $numbers[3] = max(array_filter($patternsByLength[5], static fn($i) => array_diff($numbers[7], $i) === []));
    $numbers[9] = max(array_filter($patternsByLength[6], static fn($i) => array_diff($numbers[3], $i) === []));
    $numbers[5] = max(array_filter($patternsByLength[5], static fn($i) => array_diff(array_merge($numbers[7], $i), $numbers[9]) === [] && array_diff($numbers[3], $i) !== []));
    $numbers[2] = max(array_filter($patternsByLength[5], static fn($i) => array_diff($numbers[3], $i) !== [] && array_diff($numbers[5], $i) !== []));
    $numbers[6] = max(array_filter($patternsByLength[6], static fn($i) => array_diff($numbers[9], $i) !== [] && array_diff($numbers[5], $i) === []));
    $numbers[0] = max(array_filter($patternsByLength[6], static fn($i) => array_diff($numbers[6], $i) !== [] && array_diff($numbers[9], $i) !== []));

    $total = '';
    foreach ($readings as $reading) {
        $readingArray = str_split($reading);
        sort($readingArray);
        for ($i = 0; $i <= 9; $i++) {
            sort($numbers[$i]);
            if ($readingArray === $numbers[$i]) {
                $total .= $i;
                break;
            }
        }
    }
    $output[] = $total;
}
echo array_sum($output) . PHP_EOL;
$endTime = microtime(true);
$executionTime = ($endTime - $startTime) * 1000;
echo "Execution time: " . round($executionTime, 2) . " ms" . PHP_EOL;
