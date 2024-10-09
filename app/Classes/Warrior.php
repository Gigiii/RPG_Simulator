<?php

namespace App\Classes;
class Warrior extends Character
{
    public function __construct($name)
    {
        parent::__construct($name, 120, 15);
    }

    public function attack()
    {
        $action = rand(0, 1);

        if ($action == 0) {
            return $this->swordAttack();
        } else {
            return $this->quickAttack();
        }
    }

    public function swordAttack()
    {
        $modifier = rand(0, 10);

        if ($modifier == 10) {
            $attack = $this->getBaseAttack() + $modifier + 5;
            return [
                "\033[33mCRITICAL HIT! \033[1m" . $this->getName() . "\033[0m attacks with a sword for \033[38;5;208m\033[1m" . $attack . "\033[0m\033[33m damage! 💥\033[0m",
                "Attack",
                $attack
            ]; // Yellow text
        } else {
            $attack = $this->getBaseAttack() + $modifier;
            return [
                "\033[32m" . $this->getName() . " attacks with a sword for \033[38;5;208m\033[1m" . $attack . "\033[0m\033[32m damage! ⚔️\033[0m",
                "Attack",
                $attack
            ]; // Green text
        }
    }

    public function quickAttack()
    {
        $attack = $this->getBaseAttack() + 4;
        return [
            "\033[36m" . $this->getName() . " attacks quickly for \033[38;5;208m\033[1m" . $attack . "\033[0m\033[36m damage! ⚡️\033[0m",
            "Attack",
            $attack
        ]; // Cyan text
    }
}