<?php

class Sudoku4 {
	private $size = 16;
	private $subgridSize = 4;
	public function solveSudoku(&$grid) {
		$this->convertStringElementsToInt($grid);
		$result = $this->solve($grid);
		$this->convertIntElementsToString($grid);
		return $result;
	}
	private function solve(&$grid) {
		$emptyCell = $this->findEmptyCell($grid);
		if (!$emptyCell) {
			return true;
		}
		list($row, $col) = $emptyCell;
		for ($num = 1; $num <= $this->size; $num++) {
			if ($this->isSafe($grid, $row, $col, $num)) {
				$grid[$row][$col] = $num;

				if ($this->solve($grid)) {
					return true;
				}

				$grid[$row][$col] = 0; 
			}
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
	private function convertStringElementsToInt(&$grid) {
		for ($i = 0; $i < $this->size; $i++) {
			for ($j = 0; $j < $this->size; $j++) {
				if (is_string($grid[$i][$j])) {
					$grid[$i][$j] = intval($grid[$i][$j]);
				}
			}
		}
	}
	private function convertIntElementsToString(&$grid) {
		for ($i = 0; $i < $this->size; $i++) {
			for ($j = 0; $j < $this->size; $j++) {
				if (is_int($grid[$i][$j])) {
					$grid[$i][$j] = strval($grid[$i][$j]);
				}
			}
		}
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