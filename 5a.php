<?php
$input = file('input5.txt');
$maxX=0;
$maxY=0;
$grid = [];
foreach ($input as $line) {
    $line = str_replace("\n", '', trim($line));
    $coords = explode(' ', $line);
    $start = $coords[0];
    $end = $coords[2];
    [$xstart, $ystart] = explode(',', $start);
    [$xend, $yend] = explode(',', $end);
    if ($ystart === $yend && $xstart !== $xend) {
        draw($xstart, $xend, $ystart, 'X');
    }
    if ($ystart !== $yend && $xstart === $xend) {
        draw($ystart, $yend, $xstart, 'Y');
    }
}

function draw($startVar, $endVar, $fixed, $varType) {
    global $grid, $maxX, $maxY;
    if ($fixed > ${'max' . ($varType === 'X' ? 'Y' : 'X')}) {
        ${'max' . ($varType === 'X' ? 'Y' : 'X')} = $fixed;
    }
    if ($startVar > $endVar) {
        [$startVar, $endVar] = [$endVar, $startVar];
    }
    for ($i = $startVar; $i <= $endVar; $i++) {
        if (!isset($grid[$i])) {
            $grid[$i] = [];
        }
        if ($varType === 'X') {
            if (!isset($grid[$i][$fixed])) {
                $grid[$i][$fixed] = 0;
            }
            $grid[$i][$fixed]++;
        } elseif ($varType === 'Y') {
            if (!isset($grid[$fixed][$i])) {
                $grid[$fixed][$i] = 0;
            }
            $grid[$fixed][$i]++;
        }
        if ($i > ${'max' . $varType}) {
            ${'max' . $varType} = $i;
        }
    }
}

$twoOrGreater = 0;
for ($j=0; $j <= $maxY; $j++) {
    for ($x=0; $x <= max(array_keys($grid)); $x++) {
        if (!isset($grid[$x][$j]) || $grid[$x][$j] === 0) {
            echo '.';
        } else {
            if ($grid[$x][$j] >= 2) {
                $twoOrGreater++;
            }
            echo $grid[$x][$j];
        }
    }
    echo "\n";
}
echo "result: $twoOrGreater";