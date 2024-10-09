<?php

namespace App\Classes;
class Berserker extends Character
{
    public function __construct($name)
    {
        parent::__construct($name, 150, 25);
    }

    public function attack()
    {
        $action = rand(0, 2);

        if ($action == 0) {
            return $this->rageAttack();
        } elseif ($action == 1) {
            return $this->doubleSwing();
        } else {
            return $this->berserkMode();
        }
    }

    public function rageAttack()
    {
        $attack = $this->getBaseAttack() + rand(5, 10);
        return [
            "\033[31m" . $this->getName() . " unleashes a rage attack for " . $attack . " damage!\033[0m",
            "Attack",
            $attack
        ];
    }

    public function doubleSwing()
    {
        $hit1 = $this->attackWithChance();
        $hit2 = $this->attackWithChance();

        // Calculate total damage only if both hits are successful
        $totalDamage = ($hit1 !== 0 ? $hit1 : 0) + ($hit2 !== 0 ? $hit2 : 0);

        // Output message indicating hits and misses
        $messages = [];
        if ($hit1 > 0) {
            $messages[] = "\033[34m" . $this->getName() . " swings twice, dealing " . $hit1 . " damage!\033[0m";
        } else {
            $messages[] = "\033[34m" . $this->getName() . " misses the first swing!\033[0m";
        }

        if ($hit2 > 0) {
            $messages[] = "\033[34m" . $this->getName() . " deals " . $hit2 . " damage on the second swing!\033[0m";
        } else {
            $messages[] = "\033[34m" . $this->getName() . " misses the second swing!\033[0m";
        }

        // Join the messages into a single output
        return [
            implode(" ", $messages) . " Total damage: " . $totalDamage . " damage!",
            "Attack",
            $totalDamage
        ];
    }

    private function attackWithChance()
    {
        // 70% chance to hit
        $hitChance = rand(1, 100);
        if ($hitChance <= 70) { // Adjust this value for different hit chances
            return $this->getBaseAttack() + rand(0, 5);
        } else {
            return 0; // Miss
        }
    }

    public function berserkMode()
    {
        $chance = rand(0, 1);
        if ($chance == 1) {
            $damage = $this->getBaseAttack() + rand(10, 15);
            return [
                "\033[35m" . $this->getName() . " goes berserk and hits for " . $damage . " damage!\033[0m",
                "Attack",
                $damage
            ];
        } else {
            return [
                "\033[31m" . $this->getName() . " misses in a berserk frenzy!\033[0m",
                "Miss",
                0
            ];
        }
    }
}