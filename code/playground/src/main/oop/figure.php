<?php

abstract class Figure {
    protected float $positionX;
    protected float $positionY;

    public function __construct($positionX, $positionY) {
        $this->positionX = $positionX;
        $this->positionY = $positionY;
    }

    abstract public function calculateArea(): float;
}

class Square extends Figure {
    private static float $side;

    public function __construct($positionX, $positionY, $side) {
        parent::__construct($positionX, $positionY);
        self::$side = $side;
    }

    public function calculateArea(): float {
        return self::$side ** 2;
    }
}

class Circle extends Figure {
    private static float $radius;

    public function __construct($positionX, $positionY, $radius) {
        parent::__construct($positionX, $positionY);
        self::$radius = $radius;
    }

    public function calculateArea(): float {
        return pi() * self::$radius ** 2;
    }
}

$square = new Square(0, 0, 4);
echo "Square area: " . $square->calculateArea() . "<br>";

$circle = new Circle(0, 0, 4);
echo "Circle area: " . $circle->calculateArea() . "<br>";
