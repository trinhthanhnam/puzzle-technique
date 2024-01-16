# Intro

An sample puzzle Backtracking and Branch &amp; Bound technique

# Defination


| Parameter                                                                                                                                                                                                                                                 | Backtracking                                                                                                                                                                                                                                                 |  Branch and Bound |
| ------------ | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| Approach                 |  Backtracking is used to find all possible solutions available to a problem. When it realises that it has made a bad choice, it undoes the last choice by backing it up. It searches the state space tree until it has found a solution for the problem.                                                                                                                                                                                                                                                           |  Branch-and-Bound is used to solve optimisation problems. When it realises that it already has a better optimal solution that the pre-solution leads to, it abandons that pre-solution. It completely searches the state space tree to get optimal solution.                                                                                                                                                                                                                                                             |
| Traversal                |  Backtracking traverses the state space tree by DFS(Depth First Search) manner.                                                                                                                                                                                                                                                                                                                                                                                                                                    |  Branch-and-Bound traverse the tree in any manner, DFS or BFS.                                                                                                                                                                                                                                                                                                                                                                                                                                                           |
| Function                 | Backtracking involves feasibility function.                                                                                                                                                                                                                                                                                                                                                                                                                                                                        |  Branch-and-Bound involves a bounding function.                                                                                                                                                                                                                                                                                                                                                                                                                                                                          |
| Problems                 | Backtracking is used for solving Decision Problem.                                                                                                                                                                                                                                                                                                                                                                                                                                                                 |  Branch-and-Bound is used for solving Optimisation Problem.                                                                                                                                                                                                                                                                                                                                                                                                                                                              |
| Searching                |  In backtracking, the state space tree is searched until the solution is obtained.                                                                                                                                                                                                                                                                                                                                                                                                                                 |  In Branch-and-Bound as the optimum solution may be present any where in the state space tree, so the tree need to be searched completely.                                                                                                                                                                                                                                                                                                                                                                               |
| Efficiency               |  Backtracking is more efficient.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   |  Branch-and-Bound is less efficient.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     |
| Applications             | Useful in solving N-Queen Problem, Sum of subset, Hamilton cycle problem, graph coloring problem                                                                                                                                                                                                                                                                                                                                                                                                                   |  Useful in solving Knapsack Problem, Travelling Salesman Problem.                                                                                                                                                                                                                                                                                                                                                                                                                                                        |
| Solve                    |  Backtracking can solve almost any problem. (chess, sudoku, etc ).                                                                                                                                                                                                                                                                                                                                                                                                                                                 |  Branch-and-Bound can not solve almost any problem.                                                                                                                                                                                                                                                                                                                                                                                                                                                                      |
| Used for                 |  Typically backtracking is used to solve decision problems.                                                                                                                                                                                                                                                                                                                                                                                                                                                        | Branch and bound is used to solve optimization problems.                                                                                                                                                                                                                                                                                                                                                                                                                                                                 |
| Nodes                    |  Nodes in stat  space tree are explored in depth first tree.                                                                                                                                                                                                                                                                                                                                                                                                                                                       |  Nodes in tree may be explored in depth-first or breadth-first order.                                                                                                                                                                                                                                                                                                                                                                                                                                                    |
| Next move                |  Next move from current state can lead to bad choice.                                                                                                                                                                                                                                                                                                                                                                                                                                                              |  Next move is always towards better solution.                                                                                                                                                                                                                                                                                                                                                                                                                                                                            |
| Solution                 |  On successful search of  solution in state space tree, search stops.                                                                                                                                                                                                                                                                                                                                                                                                                                              |  Entire state space tree is search in order to find optimal solution.                                                                                                                                                                                                                                                                                                                                                                                                                                                    |


Source: https://www.geeksforgeeks.org/difference-between-backtracking-and-branch-n-bound-technique/

Layout: https://codebeautify.org/markdown-table-generator/

# Demo

PHP Class Sudoku3

Board Unsolved

| 1 | 5 | 0 | 4 | 0 | 0 | 0 | 0 | 0 |</br>
| 0 | 0 | 0 | 0 | 8 | 0 | 2 | 0 | 0 |</br>
| 0 | 0 | 0 | 0 | 0 | 0 | 0 | 4 | 0 |</br>
| 0 | 9 | 0 | 0 | 0 | 0 | 0 | 0 | 0 |</br>
| 0 | 0 | 0 | 0 | 5 | 0 | 0 | 0 | 1 |</br>
| 0 | 0 | 4 | 0 | 0 | 0 | 3 | 0 | 0 |</br>
| 7 | 0 | 0 | 0 | 0 | 2 | 0 | 0 | 0 |</br>
| 0 | 1 | 0 | 6 | 0 | 9 | 0 | 0 | 5 |</br>
| 0 | 0 | 0 | 0 | 1 | 0 | 0 | 7 | 2 |</br>

Board Solved

| 1 | 5 | 2 | 4 | 3 | 6 | 7 | 8 | 9 |</br>
| 3 | 4 | 7 | 9 | 8 | 1 | 2 | 5 | 6 |</br>
| 9 | 8 | 6 | 5 | 2 | 7 | 1 | 4 | 3 |</br>
| 8 | 9 | 1 | 7 | 6 | 3 | 5 | 2 | 4 |</br>
| 6 | 7 | 3 | 2 | 5 | 4 | 8 | 9 | 1 |</br>
| 5 | 2 | 4 | 1 | 9 | 8 | 3 | 6 | 7 |</br>
| 7 | 6 | 5 | 3 | 4 | 2 | 9 | 1 | 8 |</br>
| 2 | 1 | 8 | 6 | 7 | 9 | 4 | 3 | 5 |</br>
| 4 | 3 | 9 | 8 | 1 | 5 | 6 | 7 | 2 |</br>


PHP Class Sudoku4

Board Unsolved

| 02 | 00 | 00 | 03 | 00 | 00 | 00 | 00 | 10 | 00 | 00 | 00 | 00 | 00 | 05 | 00 |</br>
| 00 | 00 | 00 | 00 | 00 | 00 | 00 | 00 | 08 | 00 | 00 | 00 | 00 | 00 | 06 | 00 |</br>
| 00 | 12 | 00 | 00 | 00 | 05 | 00 | 00 | 00 | 00 | 00 | 00 | 00 | 01 | 00 | 00 |</br>
| 04 | 00 | 00 | 00 | 00 | 00 | 15 | 00 | 00 | 00 | 00 | 00 | 00 | 00 | 02 | 00 |</br>
| 00 | 08 | 00 | 00 | 00 | 00 | 00 | 00 | 14 | 00 | 00 | 00 | 00 | 00 | 00 | 00 |</br>
| 00 | 00 | 00 | 00 | 00 | 00 | 00 | 00 | 09 | 00 | 00 | 00 | 00 | 07 | 00 | 00 |</br>
| 00 | 00 | 05 | 00 | 00 | 12 | 00 | 00 | 00 | 00 | 00 | 00 | 00 | 02 | 00 | 00 |</br>
| 00 | 00 | 00 | 00 | 00 | 00 | 00 | 00 | 16 | 00 | 00 | 00 | 00 | 00 | 11 | 00 |</br>
| 10 | 00 | 00 | 00 | 15 | 00 | 00 | 00 | 00 | 00 | 00 | 00 | 00 | 00 | 00 | 00 |</br>
| 00 | 14 | 00 | 00 | 00 | 00 | 00 | 00 | 00 | 00 | 00 | 00 | 00 | 06 | 00 | 00 |</br>
| 00 | 00 | 07 | 00 | 00 | 04 | 00 | 00 | 00 | 00 | 00 | 00 | 00 | 13 | 00 | 00 |</br>
| 00 | 00 | 00 | 00 | 00 | 00 | 00 | 00 | 02 | 00 | 00 | 00 | 00 | 00 | 09 | 00 |</br>
| 00 | 01 | 00 | 00 | 00 | 00 | 00 | 00 | 00 | 13 | 00 | 00 | 00 | 00 | 00 | 00 |</br>
| 00 | 00 | 00 | 08 | 00 | 00 | 00 | 00 | 04 | 00 | 00 | 00 | 00 | 00 | 12 | 00 |</br>
| 00 | 00 | 00 | 00 | 00 | 03 | 00 | 00 | 00 | 00 | 00 | 00 | 00 | 05 | 00 | 00 |</br>
| 00 | 00 | 00 | 00 | 00 | 00 | 10 | 00 | 00 | 00 | 00 | 00 | 00 | 00 | 00 | 14 |</br>

Board Solved

| 02 | 11 | 16 | 03 | 09 | 07 | 14 | 13 | 10 | 15 | 06 | 01 | 04 | 08 | 05 | 12 |</br>
| 09 | 13 | 10 | 07 | 11 | 16 | 02 | 01 | 08 | 05 | 12 | 04 | 03 | 14 | 06 | 15 |</br>
| 06 | 12 | 14 | 15 | 03 | 05 | 08 | 04 | 07 | 11 | 16 | 02 | 10 | 01 | 13 | 09 |</br>
| 04 | 05 | 08 | 01 | 06 | 10 | 15 | 12 | 03 | 09 | 13 | 14 | 16 | 11 | 02 | 07 |</br>
| 03 | 08 | 04 | 06 | 01 | 13 | 05 | 16 | 14 | 07 | 02 | 11 | 09 | 12 | 15 | 10 |</br>
| 15 | 02 | 13 | 10 | 08 | 06 | 03 | 11 | 09 | 01 | 05 | 12 | 14 | 07 | 04 | 16 |</br>
| 07 | 16 | 05 | 11 | 10 | 12 | 09 | 14 | 06 | 03 | 04 | 15 | 01 | 02 | 08 | 13 |</br>
| 12 | 09 | 01 | 14 | 02 | 15 | 04 | 07 | 16 | 08 | 10 | 13 | 05 | 03 | 11 | 06 |</br>
| 10 | 03 | 11 | 16 | 15 | 01 | 12 | 05 | 13 | 06 | 08 | 09 | 07 | 04 | 14 | 02 |</br>
| 05 | 14 | 12 | 02 | 16 | 09 | 13 | 03 | 11 | 04 | 01 | 07 | 15 | 06 | 10 | 08 |</br>
| 08 | 06 | 07 | 09 | 14 | 04 | 11 | 02 | 05 | 16 | 15 | 10 | 12 | 13 | 01 | 03 |</br>
| 01 | 04 | 15 | 13 | 07 | 08 | 06 | 10 | 02 | 12 | 14 | 03 | 11 | 16 | 09 | 05 |</br>
| 11 | 01 | 06 | 05 | 12 | 14 | 07 | 08 | 15 | 13 | 09 | 16 | 02 | 10 | 03 | 04 |</br>
| 16 | 10 | 03 | 08 | 05 | 02 | 01 | 15 | 04 | 14 | 07 | 06 | 13 | 09 | 12 | 11 |</br>
| 14 | 15 | 02 | 04 | 13 | 03 | 16 | 09 | 12 | 10 | 11 | 08 | 06 | 05 | 07 | 01 |</br>
| 13 | 07 | 09 | 12 | 04 | 11 | 10 | 06 | 01 | 02 | 03 | 05 | 08 | 15 | 16 | 14 |</br>

Enjoy!