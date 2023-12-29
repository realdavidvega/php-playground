<?php

// Some interface
// No error handling when negative values happen / corner cases
interface Vehicle {
    public function brake(int $speed): string;
    public function accelerate(int $speed): string;
}

class Car implements Vehicle {
    private static int $speed = 0;
    private int $maximumSpeed = 140;

    public function brake(int $speed): string {
        $brakeThreshold = 10;
        self::$speed = self::$speed - $speed - $brakeThreshold;
        return "The car is braking and the speed is " . self::$speed . " km/h";
    }

    public function accelerate(int $speed): string {
        if (self::$speed + $speed > $this->maximumSpeed) {
            self::$speed = $this->maximumSpeed;
        } else {
            self::$speed += $speed;
        }
        return "The car is accelerating and the speed is " . self::$speed . " km/h";
    }
}

class Motorbike implements Vehicle {
    private static int $speed = 0;
    private int $maximumSpeed = 180;

    public function brake(int $speed): string {
        $brakeThreshold = 20;
        self::$speed = self::$speed - $speed - $brakeThreshold;
        return "The motorbike is braking and the speed is " . self::$speed . " km/h";
    }

    public function accelerate(int $speed): string {
        if (self::$speed + $speed > $this->maximumSpeed) {
            self::$speed = $this->maximumSpeed;
        } else {
            self::$speed += $speed;
        }
        return "The motorbike is accelerating and the speed is " . self::$speed . " km/h";
    }
}

$car = new Car();
echo $car->accelerate(100) . "<br>";
echo $car->brake(20) . "<br>";

$motorbike = new Motorbike();
echo $motorbike->accelerate(70) . "<br>";
echo $motorbike->brake(10) . "<br>";
