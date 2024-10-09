<?php

namespace App\Classes;

abstract class Character{
    private $name;
    private $health;
    private $baseAttack;

    private static $names = [
        "Thorin", "Aragorn", "Legolas", "Gandalf", "Frodo",
        "Samwise", "Gimli", "Boromir", "Eowyn", "Bilbo",
        "Sauron", "Saruman", "Gollum", "Galadriel", "Elrond"
    ];

    private static $battleCountFile = 'battle_count.txt';


   public function __construct($name = null, $health = 100, $baseAttack = 10)
    {
        $this->name = $name ?: $this->getRandomName();
        $this->health = $health;
        $this->baseAttack = $baseAttack;
    }

    
    //Functions

    abstract public function attack();

    private function getRandomName()
    {
        return self::$names[array_rand(self::$names)];
    }

    //Getters and Setters

    public static function incrementBattleCount()
    {
        $count = self::getBattleCount();
        $count++;
        file_put_contents(storage_path(self::$battleCountFile), $count);
    }

    public static function getBattleCount()
    {
        $filePath = storage_path(self::$battleCountFile);
        if (file_exists($filePath)) {
            return (int) file_get_contents($filePath);
        }

        return 0;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getHealth()
    {
        return $this->health;
    }

    public function setHealth($health)
    {
        if ($health < 0) {
            $health = 0;
        }
        $this->health = $health;
    }

    public function takeDamage($damage)
    {
        $newHealth = $this->getHealth() - $damage;
        $this->setHealth($newHealth);
    }

    public function getBaseAttack()
    {
        return $this->baseAttack;
    }

    public function setBaseAttack($baseAttack)
    {
        $this->baseAttack = $baseAttack;
    }

}