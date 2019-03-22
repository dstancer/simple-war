<?php

namespace App;


class Soldier
{
    public $id;
    public $level;
    public $health;
    public $exp;
    public $init;

    public function __construct($level)
    {
        $this->level = $level;
        $this->id = md5(random_bytes(12));
        $this->exp = 1;
        $this->init = config('war.levels.'. $level . '.bonus.init');
        $this->health = config('war.health') * $this->init;
    }
}