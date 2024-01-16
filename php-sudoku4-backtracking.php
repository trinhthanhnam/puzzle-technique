<?php

class Sudoku4 {
	private $size = 16;
	private $subgridSize = 4;
	public function solveSudoku(&$grid) {
		$emptyCell = $this->findEmptyCell($grid);
		if (!$emptyCell) {
			return true;
		}
		list($row, $col) = $emptyCell;
		$possibleValues = $this->getPossibleValues($grid, $row, $col);
		arsort($possibleValues); // Sort values by least constraining first
		foreach ($possibleValues as $num => $count) {
		$grid[$row][$col] = $num;
			if ($this->solveSudoku($grid)) {
				return true;
			}
			$grid[$row][$col] = 0; // Backtrack
		}
		return false;
	}
	private function findEmptyCell(&$grid) {
		for ($row = 0; $row < $this->size; $row++) {
			for ($col = 0; $col < $this->size; $col++) {
				if ($grid[$row][$col] == 0) {
					return [$row, $col];
				}
			}
		}
		return null; // All cells filled
	}
	private function getPossibleValues(&$grid, $row, $col) {
		$possibleValues = [];
		for ($num = 1; $num <= $this->size; $num++) {
			if ($this->isSafe($grid, $row, $col, $num)) {
				$possibleValues[$num] = $this->countConstraints($grid, $row, $col, $num);
			}
		}
		return $possibleValues;
	}
	private function isSafe(&$grid, $row, $col, $num) {
		for ($i = 0; $i < $this->size; $i++) {
			if ($grid[$row][$i] == $num || $grid[$i][$col] == $num) {
				return false;
			}
		}
		$startRow = $row - ($row % $this->subgridSize);
		$startCol = $col - ($col % $this->subgridSize);

		for ($i = 0; $i < $this->subgridSize; $i++) {
			for ($j = 0; $j < $this->subgridSize; $j++) {
				if ($grid[$i + $startRow][$j + $startCol] == $num) {
					return false;
				}
			}
		}
		return true;
	}
	private function countConstraints(&$grid, $row, $col, $num) {
		$count = 0;
		for ($i = 0; $i < $this->size; $i++) {
			if ($grid[$row][$i] == 0 && $this->isSafe($grid, $row, $i, $num)) {
				$count++;
			}
			if ($grid[$i][$col] == 0 && $this->isSafe($grid, $i, $col, $num)) {
				$count++;
			}
		}
		$startRow = $row - ($row % $this->subgridSize);
		$startCol = $col - ($col % $this->subgridSize);
		for ($i = 0; $i < $this->subgridSize; $i++) {
			for ($j = 0; $j < $this->subgridSize; $j++) {
				if ($grid[$i + $startRow][$j + $startCol] == 0 && $this->isSafe($grid, $i + $startRow, $j + $startCol, $num)) {
					$count++;
				}
			}
		}
		return $count;
	}
	public function displayPuzzle($board, $message) {
		echo $message;
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

$quiz = new Sudoku4();
$quiz->displayPuzzle($board, "Board Unsolved");
$time_start = microtime(true);
if ($quiz->solveSudoku($board)) {
	$quiz->displayPuzzle($board, "Board Solved");
}
else {
	echo "No solution exists.\n";
}
$time_end = microtime(true);
$execution_time = ($time_end - $time_start);
echo 'Execution Time: '.$execution_time.'s';
?>