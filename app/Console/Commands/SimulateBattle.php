<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Classes\BattleSystem;
use App\Classes\Warrior;
use App\Classes\Mage;
use App\Classes\Archer;
use App\Classes\Berserker;

class SimulateBattle extends Command
{
    protected $signature = 'simulate:battle {numberOfFighters=2}';
    protected $description = 'Simulate a battle between multiple characters';

    public function handle()
    {
        $numberOfFighters = $this->argument('numberOfFighters');
        
        if ($numberOfFighters < 2) {
            $this->error('Number of fighters must be 2 or more!');
            return;
        }

        $characters = [];
        
        for ($i = 0; $i < $numberOfFighters; $i++) {
            $characterType = $this->getRandomCharacterType();
            $characters[] = new $characterType(null);
        }

        $fighters = array_slice($characters, 0, $numberOfFighters);

        $battleSystem = new BattleSystem();
        $battleSystem->battle($fighters);
    }

    private function getRandomCharacterType()
    {
        $characterTypes = [
            Warrior::class,
            Mage::class,
            Archer::class,
            Berserker::class
        ];

        return $characterTypes[array_rand($characterTypes)];
    }

}
