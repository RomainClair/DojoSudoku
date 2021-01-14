<?php

declare(strict_types=1);

namespace App\Tests\Model;

use App\Model\SudokuGrid;
use PHPUnit\Framework\TestCase;

final class SudokuGridTest extends TestCase
{
    /**
     * @dataProvider validGrids
     */
    public function testValidGrids(SudokuGrid $grid, string $errorMessage)
    {
        $this->assertFalse($grid->isInvalid(), $errorMessage);
    }

    public function validGrids()
    {
        return [
            "Empty grid" => [(new SudokuGrid()), "An empty grid should be valid"],
            "Grid with a 1 at [0,0]" => [(new SudokuGrid())->write(1,0,0), "A grid with only one 1 should be valid"],
            "Grid with a full valid row" => [
                (new SudokuGrid())->write(1,0,0)
                                  ->write(2,0,1)
                                  ->write(3,0,2)
                                  ->write(4,0,3)
                                  ->write(5,0,4)
                                  ->write(6,0,5)
                                  ->write(7,0,6)
                                  ->write(8,0,7)
                                  ->write(9,0,8)
                                  ,
                "A grid with only one valid row should be valid"
            ],
            "Grid with a full valid column" => [
                (new SudokuGrid())->write(1,0,0)
                                  ->write(2,1,0)
                                  ->write(3,2,0)
                                  ->write(4,3,0)
                                  ->write(5,4,0)
                                  ->write(6,5,0)
                                  ->write(7,6,0)
                                  ->write(8,7,0)
                                  ->write(9,8,0)
                                  ,
                "A grid with only one valid column should be valid"
            ],
            "Grid with a full valid square" => [
                (new SudokuGrid())->write(1,3,3)
                                  ->write(2,3,4)
                                  ->write(3,3,5)
                                  ->write(4,4,3)
                                  ->write(5,4,4)
                                  ->write(6,4,5)
                                  ->write(7,5,3)
                                  ->write(8,5,4)
                                  ->write(9,5,5)
                                  ,
                "A grid with only one valid square should be valid"
            ],
            "Fully completed valid grid" => [
                (new SudokuGrid())->write(7,0,0) // First Column
                                  ->write(9,1,0)
                                  ->write(2,2,0)
                                  ->write(5,3,0)
                                  ->write(8,4,0)
                                  ->write(3,5,0)
                                  ->write(6,6,0)
                                  ->write(4,7,0)
                                  ->write(1,8,0)
                                  ->write(6,0,1) // Colum 2
                                  ->write(5,1,1)
                                  ->write(3,2,1)
                                  ->write(4,3,1)
                                  ->write(9,4,1)
                                  ->write(1,5,1)
                                  ->write(8,6,1)
                                  ->write(2,7,1)
                                  ->write(7,8,1)
                                  ->write(8,0,2) // Column 3
                                  ->write(4,1,2)
                                  ->write(1,2,2)
                                  ->write(6,3,2)
                                  ->write(7,4,2)
                                  ->write(2,5,2)
                                  ->write(5,6,2)
                                  ->write(9,7,2)
                                  ->write(3,8,2)
                                  ->write(4,0,3) // Column 4
                                  ->write(1,1,3)
                                  ->write(8,2,3)
                                  ->write(7,3,3)
                                  ->write(2,4,3)
                                  ->write(6,5,3)
                                  ->write(9,6,3)
                                  ->write(3,7,3)
                                  ->write(5,8,3)
                                  ->write(3,0,4) // Column 5
                                  ->write(7,1,4)
                                  ->write(9,2,4)
                                  ->write(1,3,4)
                                  ->write(5,4,4)
                                  ->write(8,5,4)
                                  ->write(4,6,4)
                                  ->write(6,7,4)
                                  ->write(2,8,4)
                                  ->write(2,0,5) // Column 6
                                  ->write(6,1,5)
                                  ->write(5,2,5)
                                  ->write(3,3,5)
                                  ->write(4,4,5)
                                  ->write(9,5,5)
                                  ->write(7,6,5)
                                  ->write(1,7,5)
                                  ->write(8,8,5)
                                  ->write(9,0,6) // Column 7
                                  ->write(8,1,6)
                                  ->write(6,2,6)
                                  ->write(2,3,6)
                                  ->write(1,4,6)
                                  ->write(5,5,6)
                                  ->write(3,6,6)
                                  ->write(7,7,6)
                                  ->write(4,8,6)
                                  ->write(1,0,7) // Column 8
                                  ->write(3,1,7)
                                  ->write(4,2,7)
                                  ->write(8,3,7)
                                  ->write(6,4,7)
                                  ->write(7,5,7)     
                                  ->write(2,6,7)
                                  ->write(5,7,7)
                                  ->write(9,8,7)
                                  ->write(5,0,8) // Last column
                                  ->write(2,1,8)
                                  ->write(7,2,8)
                                  ->write(9,3,8)
                                  ->write(3,4,8)
                                  ->write(4,5,8)
                                  ->write(1,6,8)
                                  ->write(8,7,8)
                                  ->write(6,8,8)
                                  ,
                "A fully completed valid grid should be valid"
            ],
        ];
    }

    /**
     * @dataProvider invalidGrids
     */
    public function testInvalidGrids(SudokuGrid $grid, string $errorMessage)
    {
        $this->assertTrue($grid->isInvalid(), $errorMessage);
    }

    public function invalidGrids()
    {
        return [
            "Grid with a two one on the first row" => [
                (new SudokuGrid())->write(1,0,0)
                                  ->write(1,0,1)
                                  ,
                "A grid with two 1 on the same row should be invalid"
            ],
            "Grid with a two 5 on the last row" => [
                (new SudokuGrid())->write(5,8,0)
                                  ->write(5,8,1)
                                  ,
                "A grid with two 5 on the same row should be invalid"
            ],
            "Grid with a two 8 on a row" => [
                (new SudokuGrid())->write(8,4,2)
                                  ->write(8,4,7)
                                  , 
                "A grid with two 8 on the same row should be invalid"
            ],
            "Grid with a full row of 3" => [
                (new SudokuGrid())->write(3,5,0)
                                  ->write(3,5,1)
                                  ->write(3,5,2)
                                  ->write(3,5,3)
                                  ->write(3,5,4)
                                  ->write(3,5,5)
                                  ->write(3,5,6)
                                  ->write(3,5,7)
                                  ->write(3,5,8)
                                  ,           
                "A grid with full row of 3 should be invalid"
            ],
            "Grid with a two 2 on the first column" => [
                (new SudokuGrid())->write(2,0,0)
                                  ->write(2,1,0)
                                  ,
                "A grid with two 2 on the same column should be invalid"
            ],
            "Grid with a two 4 on the last column" => [
                (new SudokuGrid())->write(4,3,8)
                                  ->write(4,5,8)
                                  ,
                "A grid with two 4 on the same column should be invalid"
            ],
            "Grid with a two 6 on a column" => [
                (new SudokuGrid())->write(6,6,4)
                                  ->write(6,2,4)
                                  , 
                "A grid with two 6 on the same column should be invalid"
            ],
            "Grid with a full column of 7" => [
                (new SudokuGrid())->write(7,0,6)
                                  ->write(7,1,6)
                                  ->write(7,2,6)
                                  ->write(7,3,6)
                                  ->write(7,4,6)
                                  ->write(7,5,6)
                                  ->write(7,6,6)
                                  ->write(7,7,6)
                                  ->write(7,8,6)
                                  ,           
                "A grid with full column of 7 should be invalid"
            ],
            "Grid with a two 8 on the same square" => [
                (new SudokuGrid())->write(8,2,2)
                                  ->write(8,0,1)
                                  , 
                "A grid with two 8 on the same square should be invalid"
            ],
            "Grid with a two 4 on the same square" => [
                (new SudokuGrid())->write(4,3,0)
                                  ->write(4,4,1)
                                  , 
                "A grid with two 4 on the same square should be invalid"
            ],
            "Grid with a two 5 on the same square" => [
                (new SudokuGrid())->write(5,4,8)
                                  ->write(5,5,6)
                                  , 
                "A grid with two 5 on the same square should be invalid"
            ],
        ];
    }

}

