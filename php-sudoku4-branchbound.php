<?php

class Sudoku4 {
	private $grid;
	private $size;
	private $blockSize;
	public function __construct($inputGrid)
	{
		// Validate the input grid
		if (!$this->validateGrid($inputGrid)) {
			throw new InvalidArgumentException("Invalid input grid.");
		}
		$this->grid = $inputGrid;
		$this->size = count($inputGrid);
		$this->blockSize = sqrt($this->size);
	}
	public function solve()
	{
		$emptyCell = $this->findEmptyCell();
		
		// If no empty cells are found, the puzzle is solved
		if (!$emptyCell) {
			return true;
		}
		list($row, $col) = $emptyCell;
		for ($num = 1; $num <= $this->size; $num++) {
			if ($this->isSafe($row, $col, $num)) {
				$this->grid[$row][$col] = $num;
				if ($this->solve()) {
					return true;
				}
				$this->grid[$row][$col] = 0; // Backtrack
			}
		}
		return false; // No solution found
	}
	private function findEmptyCell()
	{
		for ($row = 0; $row < $this->size; $row++) {
			for ($col = 0; $col < $this->size; $col++) {
				if ($this->grid[$row][$col] === 0) {
					return [$row, $col];
				}
			}
		}
		return null; // No empty cell found
	}
	private function isSafe($row, $col, $num)
	{
		return !$this->usedInRow($row, $num) &&
			   !$this->usedInCol($col, $num) &&
			   !$this->usedInBlock($row - $row % $this->blockSize, $col - $col % $this->blockSize, $num);
	}
	private function usedInRow($row, $num)
	{
		return in_array($num, $this->grid[$row]);
	}
	private function usedInCol($col, $num)
	{
		for ($row = 0; $row < $this->size; $row++) {
			if ($this->grid[$row][$col] === $num) {
				return true;
			}
		}
		return false;
	}
	private function usedInBlock($startRow, $startCol, $num)
	{
		for ($row = 0; $row < $this->blockSize; $row++) {
			for ($col = 0; $col < $this->blockSize; $col++) {
				if ($this->grid[$row + $startRow][$col + $startCol] === $num) {
					return true;
				}
			}
		}
		return false;
	}
	private function validateGrid($inputGrid)
	{
		if (!is_array($inputGrid) || empty($inputGrid)) {
			return false;
		}
		$size = count($inputGrid);
		// Check if the grid is a square
		if ($size !== count($inputGrid[0])) {
			return false;
		}
		// Validate each element in the grid
		foreach ($inputGrid as $row) {
			if (!is_array($row) || count($row) !== $size) {
				return false;
			}
			foreach ($row as $element) {
				if (!is_int($element) && !is_string($element)) {
					return false;
				}
			}
		}
		return true;
	}
	public function displayPuzzle($message) {
		echo $message;
		$board = $this->grid;
		echo "</br>";
		for($i = 0;$i < 16; $i++) {
			for($j = 0; $j < 16; $j++) {
				echo '| '.str_pad($board[$i][$j], 2, '0', STR_PAD_LEFT).' ';
			}
			echo "|";
			echo "</br>";
		}
	}
}

$board = [
[2, 0, 0, 3, 0, 0, 0, 0, 10, 0, 0, 0, 0, 0, 5, 0],
[0, 0, 0, 0, 0, 0, 0, 0, 8, 0, 0, 0, 0, 0, 6, 0],
[0, 12, 0, 0, 0, 5, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0],
[4, 0, 0, 0, 0, 0, 15, 0, 0, 0, 0, 0, 0, 0, 2, 0],
[0, 8, 0, 0, 0, 0, 0, 0, 14, 0, 0, 0, 0, 0, 0, 0],
[0, 0, 0, 0, 0, 0, 0, 0, 9, 0, 0, 0, 0, 7, 0, 0],
[0, 0, 5, 0, 0, 12, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0],
[0, 0, 0, 0, 0, 0, 0, 0, 16, 0, 0, 0, 0, 0, 11, 0],
[10, 0, 0, 0, 15, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
[0, 14, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 6, 0, 0],
[0, 0, 7, 0, 0, 4, 0, 0, 0, 0, 0, 0, 0, 13, 0, 0],
[0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 9, 0],
[0, 1, 0, 0, 0, 0, 0, 0, 0, 13, 0, 0, 0, 0, 0, 0],
[0, 0, 0, 8, 0, 0, 0, 0, 4, 0, 0, 0, 0, 0, 12, 0],
[0, 0, 0, 0, 0, 3, 0, 0, 0, 0, 0, 0, 0, 5, 0, 0],
[0, 0, 0, 0, 0, 0, 10, 0, 0, 0, 0, 0, 0, 0, 0, 14]
];

$quiz = new Sudoku4($board);
$quiz->displayPuzzle("Board Unsolved");
$time_start = microtime(true);
if ($quiz->solve($board)) {
	$quiz->displayPuzzle("Board Solved");
}
else {
	echo "No solution exists.\n";
}
$time_end = microtime(true);
$execution_time = ($time_end - $time_start);
echo 'Execution Time: '.$execution_time.'s';
?>