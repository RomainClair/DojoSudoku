<?php
/**
 * Quick test script for the SudokuGrid
 */

require_once 'SudokuGrid.php';

$sudoku = new SudokuGrid();
if ($sudoku->isInvalid()) {
    echo "Empty grid should be valid !!" . PHP_EOL;
} else {
    echo "Empty grid is valid  : OK" . PHP_EOL;
}
$sudoku->write(1, 0, 0);
$sudoku->write(1, 0, 3);
if ($sudoku->isInvalid()) {
    echo "Two ones on the same column is invalid : OK" . PHP_EOL;
} else {
    echo "Two ones on the same column should be invalid !!" . PHP_EOL;
}

$sudoku = new SudokuGrid();
$sudoku->write(1, 0, 0);
$sudoku->write(1, 3, 0);
if ($sudoku->isInvalid()) {
    echo "Two ones on the same row is invalid : OK" . PHP_EOL;
} else {
    echo "Two ones on the same row should be invalid !!" . PHP_EOL;
}

if (count($argv) > 1 && $argv[1] === "--with-square") {
    $sudoku = new SudokuGrid();
    $sudoku->write(1, 0, 0);
    $sudoku->write(1, 1, 1);
    if ($sudoku->isInvalid()) {
        echo "Two ones on the same square is invalid : OK" . PHP_EOL;
    } else {
        echo "Two ones on the same square should be invalid !!" . PHP_EOL;
    }
}