<?php
$input = file('input4.txt');
$drawn = explode(',', $input[0]);

$gameNumber = 0;
$games = [];
$row = 0;
$iMax = count($input);
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
    echo "draw number $drawnNumber \n";
    $finishedGames = [];
    $drawnNumber = str_replace("\n", '', $drawnNumber);
    foreach ($games as $gameIndex => $game) {
        filterArray($gameIndex, 'rows', $drawnNumber);
        filterArray($gameIndex, 'columns', $drawnNumber);
    }
    $finishedGames = array_unique($finishedGames);
    echo "aantal games gefinished: ". count($finishedGames) . "\n";
    foreach ($finishedGames as $game) {
        echo "finished game $game\n";
        if (count($games) === 1) {
            finish($drawnNumber);
        }
        unset($games[$game]);
        echo "remaining games: ". count($games) . "\n";
    }

}

function filterArray($gameIndex, $type, $drawnNumber) {
    global $games, $finishedGames;
    foreach ($games[$gameIndex][$type] as $index => $row) {
        $games[$gameIndex][$type][$index] = array_filter($row, static function ($number) use ($drawnNumber) {
            return $number !== $drawnNumber;
        });
        if (empty($games[$gameIndex][$type][$index])) {
            $finishedGames[] = $gameIndex;
        }
    }
}

function finish($drawnNumber) {
    global $games;
    $total = 0;
    foreach (array_values($games)[0]['rows'] as $row) {
        $total += array_sum($row);
    }
    echo $total * $drawnNumber;
    exit();
}