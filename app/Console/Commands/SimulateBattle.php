<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Classes\BattleSystem;
use App\Classes\Warrior;
use App\Classes\Mage;
use App\Classes\Archer;
use App\Classes\Berserker;
use function Laravel\Prompts\text;
use function Laravel\Prompts\confirm;
use function Laravel\Prompts\select;


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

        $confirmed = confirm(
            label: 'Do you want to add your own character?',
            default: false,
            yes: 'Yes',
            no: 'No',
        );

        $characters = [];
        if($confirmed == True){
            $name = $this->ask("Please enter the name of the character: ", "Warrior");
            $role = select("Please Select the Character's Class ",    options: ['Mage', 'Warrior', 'Berserker', 'Archer'],
            default: 'Warrior',);
            switch ($role) {
                case 'Warrior':
                    $characters[] = new Warrior($name);
                    break;

                case 'Mage':
                    $characters[] = new Mage($name);
                    break;

                case 'Archer':
                    $characters[] = new Archer($name);
                    break;

                case 'Berserker':
                    $characters[] = new Berserker($name);
                    break;

                default:
                    $this->error("Invalid class selected.");
                    break;
            }
            $numberOfFighters--;
        }
        
        
        for ($i = 0; $i < $numberOfFighters; $i++) {
            $characterType = $this->getRandomCharacterType();
            $characters[] = new $characterType(null);
        }


        $battleSystem = new BattleSystem();
        $battleSystem->battle($characters);
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
