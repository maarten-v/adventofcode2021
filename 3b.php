<?php
$inputOxygen = file('input3.txt');
$inputScrubber = $inputOxygen;
echo calculate($inputOxygen, 'oxygen') * calculate($inputScrubber, 'scrubber');

function calculate($input, $type) {
    $character=0;
    while (count($input) > 1) {
        $binaryCount = [];
        foreach ($input as $line) {
            $line = str_replace("\n", '', $line);
            $value = str_split($line)[$character];
            if (!isset($binaryCount[$value])) {
                $binaryCount[$value] = 0;
            }
            $binaryCount[$value]++;
        }
        if ($type === 'oxygen') {
            $popular = ($binaryCount['1'] >= $binaryCount['0']) ? '1' : '0';
        } elseif ($type === 'scrubber') {
            $popular = ($binaryCount['1'] < $binaryCount['0']) ? '1' : '0';
        }
        $input = array_filter($input, static function($line) use ($character, $popular) {
            return str_split($line)[$character] === $popular;
        });
        $character++;
    }
    return (bindec(array_values($input)[0]));
}



