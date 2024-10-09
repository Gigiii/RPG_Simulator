<?php

namespace App\Classes;

class BattleSystem implements BattleInterface
{
    public function battle(array $characters)
    {
        if (count($characters) < 2) {
            echo "\033[31mThere must be at least 2 characters to fight! 🎮\033[0m\n"; // Red text
            return;
        }

        echo "\033[32mThe battle begins between " . count($characters) . " fighters! ⚔️\033[0m\n"; // Green text

        $turnCounter = 1;

        while (count($characters) > 1) {

            echo "\n\033[36m--- Turn $turnCounter ---\033[0m\n"; 

            foreach ($characters as $attacker) {
                if ($attacker->getHealth() <= 0) {
                    continue;
                }

                $defender = $this->getRandomDefender($characters, $attacker);

                if (!$defender) {
                    break;
                }

                $attackResult = $attacker->attack();
                $defender->takeDamage($attackResult[2]);

                // Bold orange for normal damage, bold red for critical hits
                $damageColor = ($attackResult[1] === "Attack" && $attackResult[2] > $attacker->getBaseAttack() + 10) ? "\033[31m" : "\033[38;5;208m"; // Orange color (ANSI 208)

                echo "\n" . $attackResult[0] . " (Defender: \033[33m" . $defender->getName() . " (" . basename(str_replace('\\', '/', get_class($defender))) . ")\033[0m | Health: " . $damageColor . "\033[1m" . $defender->getHealth() . "\033[0m\033[0m)\n"; // Blue for attack, yellow for defender name

                if ($defender->getHealth() <= 0) {
                    echo "\n💔 \033[31m" . $defender->getName() . " has fallen! 💔\033[0m\n"; // Red text

                    $defenderIndex = array_search($defender, $characters);

                    // Remove the fallen opponent from the array
                    unset($characters[$defenderIndex]);
                    // Re-index the array to prevent undefined index errors
                    $characters = array_values($characters);
                }

                $characters = array_filter($characters, fn($character) => $character->getHealth() > 0);

                if (count($characters) <= 1) {
                    break;
                }
            }

            $turnCounter++;
        }

        echo "\n\033[32m--- The Game Has Finished ---\033[0m\n"; 

        if (count($characters) == 1) {
            echo "\n🏆 \033[33m" . $characters[0]->getName() . " is the winner with " . $characters[0]->getHealth() . " HP remaining! 🏆\033[0m\n\n"; // Yellow text
        } else {
            echo "\n\033[31mNo winner! Everyone has fallen. ⚔️\033[0m\n\n"; // Red text
        }

        Character::incrementBattleCount();
        
        echo "⚔️  \033[36mTotal turns taken: " . $turnCounter . " ⚔️\033[0m\n\n"; // Add total turns statistic
        echo "⚔️  \033[36mTotal battles so far: " . Character::getBattleCount() . " ⚔️\033[0m\n\n"; // Cyan text

    }

    private function getRandomDefender(array $characters, Character $attacker)
    {
        $potentialDefenders = array_filter($characters, fn($character) => $character !== $attacker && $character->getHealth() > 0);
        if (empty($potentialDefenders)) {
            return null;
        }

        return $potentialDefenders[array_rand($potentialDefenders)];
    }
}
