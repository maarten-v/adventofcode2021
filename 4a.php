<?php
$input = file('input4.txt');
$drawn = explode(',', $input[0]);

$iMax = count($input);
$gameNumber = 0;
$games = [];
$row = 0;
for ($i = 2; $i < $iMax; $i++) {
    $cleanInput = str_replace("\n", '', trim($input[$i]));
    if ($cleanInput === '') {
        $gameNumber++;
        $row=0;
        continue;
    }
    $rowArray = preg_split('/ +/', $cleanInput);
    $games[$gameNumber]['rows'][$row] = $rowArray;
    foreach ($rowArray as $index => $number) {
        $games[$gameNumber]['columns'][$index][] = $rowArray[$index];
    }

    $row++;
}

foreach ($drawn as $drawnNumber) {
    foreach ($games as $gameIndex => $game) {
        filterArray($gameIndex, 'rows', $drawnNumber);
        filterArray($gameIndex, 'columns', $drawnNumber);
    }
}

function filterArray($gameIndex, $type, $drawnNumber) {
    global $games;
    foreach ($games[$gameIndex][$type] as $index => $row) {
        $games[$gameIndex][$type][$index] = array_filter($row, static function ($number) use ($drawnNumber) {
            return $number !== $drawnNumber;
        });
        if (empty($games[$gameIndex][$type][$index])) {
            finish($gameIndex, $drawnNumber);
        }
    }
}

function finish($gameIndex, $drawnNumber) {
    global $games;
    $total = 0;
    foreach ($games[$gameIndex]['rows'] as $row) {
        $total += array_sum($row);
    }
    echo($total * $drawnNumber);
    exit();
}

var_dump($games[2]['rows']);



