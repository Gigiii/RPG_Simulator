<?php


namespace App\Classes;

class Archer extends Character
{
    public function __construct($name)
    {
        parent::__construct($name, 100, 18);
    }

    public function attack()
    {
        $action = rand(0, 2);

        if ($action == 0) {
            return $this->shootArrow();
        } elseif ($action == 1) {
            return $this->powerShot();
        } else {
            return $this->multiShot();
        }
    }

    public function shootArrow()
    {
        $attack = $this->getBaseAttack() + rand(0, 5);
        return [
            "\033[36m" . $this->getName() . " shoots an arrow for \033[38;5;208m\033[1m" . $attack . "\033[0m\033[36m damage!\033[0m",
            "Attack",
            $attack
        ]; // Cyan text
    }

    public function powerShot()
    {
        $attack = $this->getBaseAttack() + rand(5, 10);
        return [
            "\033[36m" . $this->getName() . " fires a powerful shot for \033[38;5;208m\033[1m" . $attack . "\033[0m\033[36m damage!\033[0m",
            "Attack",
            $attack
        ]; // Cyan text
    }

    public function multiShot()
    {
        $damage = 0;
        for ($i = 0; $i < 3; $i++) {
            $damage += $this->getBaseAttack() + rand(0, 5);
        }
        return [
            "\033[36m" . $this->getName() . " unleashes a multi-shot for \033[38;5;208m\033[1m" . $damage . "\033[0m\033[36m damage!\033[0m",
            "Attack",
            $damage
        ]; // Cyan text
    }
}
