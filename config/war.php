<?php


return [
    'n' => [
        'min' => 10,            // Minimum number of soldiers in one army
        'max' => 100,           // Maximum number of soldiers in one army
    ],
    'mode' => 1,                // How to determine the winner of a fight: 1 - coin flip, 2 - more health wins
    'maxDiff' => 20,            // Maximum difference between armies (in percentage)
    'health' => 100,            // Base health amount for all soldiers
    'strike' => 25,             // TODO
    'heal' => 0,                // TODO
    'levels' => [
        '1' => [
            'bonus' => [
                'exp' => 1.1,   // TODO
                'init' => 1,    // Maximum number of level 1 soldiers (in percentage)
            ],
            'maxPerc' => 100,   // Initial health factor for level 1 soldiers
        ],
        '2' => [
            'bonus' => [
                'exp' => 1.05,
                'init' => 1.1,
            ],
            'maxPerc' => 9,
        ],
        '3' => [
            'bonus' => [
                'exp' => 1.05,
                'init' => 1.2,
            ],
            'maxPerc' => 3,
        ],
    ],
];