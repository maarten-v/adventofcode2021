<?php
$input = file('testinput5.txt');

$grid = [];
foreach ($input as $line) {
    $line = str_replace("\n", '', trim($line));
    echo $line;
}