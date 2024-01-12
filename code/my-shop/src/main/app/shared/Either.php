<?php

namespace shared;

class Either {
    private mixed $value;
    private bool $isLeft;

    private function __construct($value, $isLeft) {
        $this->value = $value;
        $this->isLeft = $isLeft;
    }

    public static function left($value): Either
    {
        return new self($value, true);
    }

    public static function right($value): Either
    {
        return new self($value, false);
    }

    public function isLeft(): bool {
        return $this->isLeft;
    }

    public function isRight(): bool
    {
        return !$this->isLeft;
    }

    public function getValue(): mixed {
        return $this->value;
    }

    public function fold(callable $leftFunction, callable $rightFunction) {
        return $this->isLeft() ? $leftFunction($this->getValue()) : $rightFunction($this->getValue());
    }
}
