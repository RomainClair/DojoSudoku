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

    /**
     * Add a number to the grid
     * Adding a number at invalid coordinates will throw an Exception
     * Adding an invalid number will throw an Exception
     */
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

    /**
     * Returns a simple string representation of the sudoku grid
     */
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

    /**
     * TODO : Complete the method
     */
    public function isInvalid(): bool
    {

    }
}
