<?php

header('Content-Type: text/plain');

/*
    $a = [1, 'two', 'three', 4];

    foreach($a as $value) {
        echo $value . ', ';
    }

    foreach($a as $key => $value) {
        var_dump($value);
    }

    $a2 = [
        'key_1' => 'one',
        'key_2' => 'two',
        'key_3' => 'three'
    ];

    for($i = 0; $i < 10; $i++) {

    }

    // break: break 2 (izlazi iz 2 bloka), continue;
    // while, do-while
*/

// Task #1

$list = [
    '<a> - anchor',
    '<p> - paragraph',
    '<ul> - unordered list',
    '<table> - table'
];

foreach($list as $value) {
    $explodedValue = explode(" - ", $value);
    echo $explodedValue[0] . "\t" . $explodedValue[1] . "\n";
}