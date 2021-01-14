# A Sudoku checker

## Skills & concepts

* Arrays & loops
* OOP

## Set-up

This Dojo uses PHPunit for unit testing. After cloning the repository, you need to install it using composer :
```bash
composer install
```

## Goals

The goal of this Dojo is the validation of a sudoku grid.

To do that :

* Complete the SudokuGrid::isInvalid() method to tell if the grid contains more than one time each value (1 to 9 there could be more than one 0 on a valid grid) on any line, column any one of the nine 3*3 square.

## Test

You can run some predefined tests on your function using 
```bash
vendor/bin/phpunit
```