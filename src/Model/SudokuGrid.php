<?php

declare(strict_types=1);

namespace App\Model;

/**
 * A SudokuGrid is a 9*9 integer square
 */
class SudokuGrid
{
    const EMPTY = 0;
    private array $grid;

    public function __construct()
    {
        $this->grid = [
            [self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY],
            [self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY],
            [self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY],
            [self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY],
            [self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY],
            [self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY],
            [self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY],
            [self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY],
            [self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY,self::EMPTY]
        ];
    }

    public function write(int $number, int $x, int $y): SudokuGrid
    {
        if ($number < 1 || $number > 9) {
            throw new \Exception("You can only write a number between 1 and 9 included");
        }
        if ($x < 0 || $x > 8 || $y < 0 || $y > 8) {
            throw new \Exception("The grid coordinates are between 0 and 8 included");
        }
        $this->grid[$x][$y] = $number;
        return $this;
    }

    private function numberAbsent() : array
    {
        return [
            1 => false,
            2 => false,
            3 => false,
            4 => false,
            5 => false,
            6 => false,
            7 => false,
            8 => false,
            9 => false
        ];
    }

    public function __toString(): string
    {
        $result = "";
        foreach ($this->grid as $line) {
            foreach ($line as $square) {
                $result .= $square . " ";
            }
            $result .= PHP_EOL;
        }
        return $result;
    }

    public function isInvalid(): bool
    {
        // Check lines
        foreach ($this->grid as $line) {
            $presentNumbers = $this->numberAbsent();
            foreach ($line as $number) {
                if ($number !== self::EMPTY) {
                    if ($presentNumbers[$number]) {
                        return true;
                    }
                    $presentNumbers[$number] = true;
                }
            }
        }
        // Check columns
        for ($i = 0; $i < 9; $i++) {
            $presentNumbers = $this->numberAbsent();
            for ($j = 0; $j < 9; $j++) {
                if ($this->grid[$j][$i] !== self::EMPTY) {
                    if ($presentNumbers[$this->grid[$j][$i]]) {
                        return true;
                    }
                    $presentNumbers[$this->grid[$j][$i]] = true;
                }
            }
        }
        // Check squares
        for ($squareX = 0; $squareX < 3; $squareX++) {
            for ($squareY = 0; $squareY < 3; $squareY++) {
                $presentNumbers = $this->numberAbsent();
                for ($x = $squareX*3; $x < $squareX*3 + 3; $x++) {
                    for ($y = $squareY*3; $y < $squareY*3 + 3; $y++) {
                        if ($this->grid[$x][$y] !== self::EMPTY) {
                            if ($presentNumbers[$this->grid[$x][$y]]) {
                                return true;
                            }
                            $presentNumbers[$this->grid[$x][$y]] = true;
                        }
                    }
                }
            }
        }
        return false;
    }


}
