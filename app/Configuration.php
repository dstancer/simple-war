<?php

namespace App;


class Configuration
{
    public $description = [
        'n.min' => 'Minimum number of soldiers in one army',
        'n.max' => 'Maximum number of soldiers in one army',
        'maxDiff' => 'Maximum difference between armies (in percentage)',
        'mode' => 'How to determine the winner of a fight: 1 - coin flip, 2 - more health wins',
        'health' => 'Base health amount for all soldiers',
        'levels.1.maxPerc' => 'Maximum number of level 1 soldiers (in percentage)',
        'levels.1.bonus.init' => 'Initial health factor for level 1 soldiers',
        'levels.2.maxPerc' => 'Maximum number of level 2 soldiers (in percentage)',
        'levels.2.bonus.init' => 'Initial health factor for level 2 soldiers',
        'levels.3.maxPerc' => 'Maximum number of level 3 soldiers (in percentage)',
        'levels.3.bonus.init' => 'Initial health factor for level 3 soldiers',
    ];
}