<?php

namespace App\Classes;

class Mage extends Character
{
    public function __construct($name)
    {
        parent::__construct($name, 80, 20);
    }

    public function attack()
    {
        $action = rand(0, 2);

        if ($action == 0) {
            return $this->fireball();
        } elseif ($action == 1) {
            return $this->lightningBolt();
        } else {
            return $this->heal();
        }
    }

    public function fireball()
    {
        $modifier = rand(0, 10);

        if ($modifier == 10) {
            $attack = $this->getBaseAttack() + $modifier + 5;
            return [
                "\033[35m🔥 CRITICAL FIREBALL! \033[1m" . $this->getName() . "\033[0m \033[35mcasts a fireball for \033[38;5;208m\033[1m" . $attack . "\033[0m\033[35m damage! 🔥\033[0m",
                "Attack",
                $attack
            ]; // Magenta text
        } else {
            $attack = $this->getBaseAttack() + $modifier;
            return [
                "\033[33m" . $this->getName() . " casts a fireball for \033[38;5;208m\033[1m" . $attack . "\033[0m\033[33m damage! 🔥\033[0m",
                "Attack",
                $attack
            ]; // Yellow text
        }
    }

    public function lightningBolt()
    {
        $modifier = rand(0, 10);

        if ($modifier == 10) {
            $attack = $this->getBaseAttack() + $modifier + 5;
            return [
                "\033[34m⚡️ CRITICAL LIGHTNING BOLT! \033[1m" . $this->getName() . "\033[0m \033[34mstrikes with a lightning bolt for \033[38;5;208m\033[1m" . $attack . "\033[0m\033[34m damage! ⚡️\033[0m",
                "Attack",
                $attack
            ]; // Blue text
        } else {
            $attack = $this->getBaseAttack() + $modifier;
            return [
                "\033[34m" . $this->getName() . " strikes with a lightning bolt for \033[38;5;208m\033[1m" . $attack . "\033[0m\033[34m damage! ⚡️\033[0m",
                "Attack",
                $attack
            ]; // Blue text
        }
    }

    public function heal()
    {
        $modifier = rand(0, 10);

        if ($modifier == 10) {
            $heal = $this->getBaseAttack() + $modifier + 5;
            return [
                "\033[32m💚 CRITICAL HEAL! \033[1m" . $this->getName() . "\033[0m \033[32mheals for \033[38;5;208m\033[1m" . $heal . "\033[0m\033[32m health! 💚\033[0m",
                "Heal",
                $heal
            ]; // Green text
        } else {
            $heal = $this->getBaseAttack() + $modifier;
            return [
                "\033[32m" . $this->getName() . " heals for \033[38;5;208m\033[1m" . $heal . "\033[0m\033[32m health! 💚\033[0m",
                "Heal",
                $heal
            ]; // Green text
        }
    }
}
