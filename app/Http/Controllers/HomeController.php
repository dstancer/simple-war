<?php

namespace App\Http\Controllers;

use App\Army;
use App\Configuration;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    protected $army1;
    protected $army2;
    protected $battles = [];

    public function index(Request $request)
    {
        $war = [];
        list($errorMessages, $n1, $n2) = $this->checkParameters($request);

        $configuration = (new Configuration())->description;

        if (empty($errorMessages)) {
            $this->army1 = new Army($n1);
            $this->army2 = new Army($n2);

            $this->storeState();
            do {
                $this->battle();
                $this->storeState();

            } while ($this->bothArmiesExist());

            $finalMessage = $this->handleMessageData();
            $war = $this->battles;
        }

        return view('home')->with(compact('errorMessages', 'war', 'finalMessage'))
            ->with(compact('configuration'));
    }

    protected function bothArmiesExist()
    {
        return (count($this->army1->get()) > 0) && (count($this->army2->get()) > 0);
    }

    protected function battle()
    {
        $armyOne = $this->army1->get();
        $armyTwo = $this->army2->get();

        if (count($this->army1->get()) >= count($this->army2->get())) {
            $armyOne = $this->army2->get();
            $armyTwo = $this->army1->get();
        }

        foreach ($armyOne as $soldierOne) {
            $soldierTwo = $armyTwo->random();
            if ($this->firstSoldierWins($soldierOne, $soldierTwo)) {
                $armyTwo->pull($soldierTwo->id);
            } else {
                $armyOne->pull($soldierOne->id);
            }
        }
    }

    protected function firstSoldierWins($soldier1, $soldier2)
    {
        if(config('war.mode') === 1) {
            if (rand(0, 1) === 1) {
                return true;
            }
        } else {
            if ($soldier1->health > $soldier2->health) {
                return true;
            }
        }

        return false;
    }


    protected function handleMessageData()
    {
        if(count($this->army1->get()) === 0){
            $message =  'Amry 2';
            $winColor = 'secondary';
        } else {
            $message =  'Army 1';
            $winColor = 'primary';
        }

        $message .= ' wins after ' . (count($this->battles) - 1) . ' battles!';
        return ['message' => $message, 'color' => $winColor];
    }
    
    protected function storeState()
    {
        $this->battles[] = [
            'army1' => [
                'all' => clone $this->army1->get(),
                'level1' => clone $this->army1->getLevel(1),
                'level2' => clone $this->army1->getLevel(2),
                'level3' => clone $this->army1->getLevel(3),
            ],
            'army2' => [
                'all' => clone $this->army2->get(),
                'level1' => clone $this->army2->getLevel(1),
                'level2' => clone $this->army2->getLevel(2),
                'level3' => clone $this->army2->getLevel(3),
            ],
        ];
    }

    protected function checkParameters(Request $request)
    {
        $messages = [];
        $army1 = 0;
        $army2 = 0;
        if (!$request->has('army1')) {
            $messages[] = 'Parameter <em>army1</em> is missing';
        } else {
            $army1 = (int)$request->get('army1');
        }
        if (!$request->has('army2')) {
            $messages[] = 'Parameter <em>army2</em> is missing';
        } else {
            $army2 = (int)$request->get('army2');
        }

        if (empty($messages)) {
            $nMin = config('war.n.min');
            $nMax = config('war.n.max');
            if ($army1 < $nMin) {
                $messages[] = 'Army 1 has to few soldiers: ' . $army1 . ' (>= ' . $nMin . ')';
            }
            if ($army2 < $nMin) {
                $messages[] = 'Army 2 has to few soldiers: ' . $army2 . ' (>= ' . $nMin . ')';
            }
            if ($army1 > $nMax) {
                $messages[] = 'Army 1 has to many soldiers: ' . $army1 . ' (<= ' . $nMax . ')';
            }
            if ($army2 > $nMax) {
                $messages[] = 'Army 2 has to many soldiers: ' . $army2 . ' (<= ' . $nMax . ')';
            }
        }

        if (empty($messages)) {
            $diff = abs($army1 - $army2);
            $num = min($army1, $army2);

            $perc = round(100 * ($diff / $num));
            $maxDiff = config('war.maxDiff');
            if ($perc > $maxDiff) {
                $messages[] = 'Armies are too unbalanced (' . $army1 . ' vs ' . $army2 . '). The difference should be less than ' . $maxDiff . '% of the smaller army (it is ' . $perc . '% now).';
            }
        }

        return [$messages, $army1, $army2];
    }
}
