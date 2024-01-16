<?php

class Sudoku3 {
/**
 * @param String[][] $board
 * @return NULL
*/
	function checkInput($board) {
		if(is_array($board)) {
			if(count($board) == 9) {
				for($i = 0; $i < 9; $i++) {
					if(count($board[$i]) != 9)
						return false;
				}
			}
			else
				return false;
		}
		else
			return false;
		return true;
	}
	function checkValue($val) {
		if( $val == 1 || $val == 2 || $val == 3 || 
			$val == 4 || $val == 5 || $val == 6 || 
			$val == 7 || $val == 8 || $val == 9 ) {
			return true;
		} else
			return false;
	}
	function solvePuzzle(&$board) {
		if($this->checkInput($board) == false) {
			echo "Invalid input board dimensions.";
			echo '</br>';
			return;
		}
		else {
			$dimension = 9;
			$this->backTracking($board, 0, 0, $dimension);
		}
	}
	function backTracking(&$board, $row, $col, $dimension){
		if( $row == $dimension - 1 && $col == $dimension )
			return true;
		if( $col == $dimension ){
			$row++;
			$col = 0;
		}
		if($this->checkValue($board[$row][$col]) == true) {
			return $this->backTracking($board, $row, $col+1, $dimension );
		}
		for($val = 1; $val <= 9; $val++){
			if($this->checkSolution($board, $row, $col, $val)){
				$board[$row][$col] = $val;
			if($this->backTracking($board, $row, $col+1, $dimension ) == true)
				return true;
			}
			$board[$row][$col] = 0;
		}
		return false;
	}
	function checkSolution($board, $row, $col, $val){
		for($counter = 0; $counter < 9; $counter++)
			if($board[$row][$counter] == $val)
				return false;
		for($counter = 0; $counter < 9; $counter++)
			if($board[$counter][$col] == $val)
				return false;
		$startRow = $row - $row % 3;
		$startCol = $col - $col % 3;
		for($rowCounter = 0; $rowCounter < 3; $rowCounter++)
			for($colCounter = 0; $colCounter < 3; $colCounter++)
				if($board[$rowCounter + $startRow ][$colCounter + $startCol] == $val)
					return false;
		return true;
	}
	function displayBoard($board, $string) {
		if($this->checkInput($board) == false) {
			echo "Invalid input board dimensions.";
			echo '</br>';
			return;
		}
		else {
			echo $string;
			echo '</br>';
			for($row = 0; $row < 9; $row++){
					for($col =0; $col <9; $col++){
						echo ' | '.$board[$row][$col].' ';
				}
				echo '|';
				echo '</br>';
			}
		}
	}
}
$board = [
["1","5","0","4","0","0","0","0","0"],
["0","0","0","0","8","0","2","0","0"],
["0","0","0","0","0","0","0","4","0"],
["0","9","0","0","0","0","0","0","0"],
["0","0","0","0","5","0","0","0","1"],
["0","0","4","0","0","0","3","0","0"],
["7","0","0","0","0","2","0","0","0"],
["0","1","0","6","0","9","0","0","5"],
["0","0","0","0","1","0","0","7","2"]];

$solution = new Sudoku3;
$solution->displayBoard($board, 'Board Unsolved');
$time_start = microtime(true);
$solution->solvePuzzle($board);
$solution->displayBoard($board, 'Board Solved');
$time_end = microtime(true);
$execution_time = ($time_end - $time_start);
echo 'Execution Time: '.$execution_time.'s';
?>