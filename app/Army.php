<?php

namespace App;

class Army
{
    protected $army;
    protected $size;

    public function __construct($size)
    {
        $this->army = collect([]);
        $this->size = $size;
        foreach (range(1, $this->size) as $i) {
            $level = rand(1,3);
            if ($this->canAddMore($level)) {
                $soldier = $this->addToArmy($level);
            } else {
                $soldier = $this->addToArmy(1);
            }
            $this->army->put($soldier->id, $soldier);
        }
    }

    public function get()
    {
        return $this->army;
    }

    protected function canAddMore($level)
    {
        $sameLevel = count($this->getLevel($level));
        $max = config('war.levels.' . $level . '.maxPerc');
        $perc = round(100 * ($sameLevel / $this->size));
        return $perc < $max;
    }

    protected function addToArmy($level)
    {
        return new Soldier($level);
    }

    public function getLevel($level)
    {
        return $this->army->filter(function ($value) use ($level) {
            return $value->level === $level;
        });
    }
}