<?php

/**
 * @author Rodrigo Tejedor
 * n queens problem
 * usage: php <file> <number-of-queens>
 */

define('N', $argv[1] ?: 8);

if ($solution = placeQueen(array(), 0, array(), array(), array())) {
    printSolution($solution);
} else {
    echo "No solution";
}

function placeQueen($positions, $index, $columns, $ascDiagonals, $descDiagonals)
{
    if ($index == N) return $positions;

    for ($i = 0; $i < N; $i++) {
        if ($columns[$i] || $ascDiagonals[$i + $index] || $descDiagonals[N + $i - $index]) {
            continue;
        }

        $positions[$index] = $i;
        $columns[$i] = true;
        $ascDiagonals[$i + $index] = true;
        $descDiagonals[N + $i - $index] = true;

        if ($solution = placeQueen($positions, $index + 1, $columns, $ascDiagonals, $descDiagonals)) {
            return $solution;
        }

        $columns[$i] = false;
        $ascDiagonals[$i + $index] = false;
        $descDiagonals[N + $i - $index] = false;
    }
}

function printSolution($positions)
{
    foreach ($positions as $position) {
        echo sprintf(
            "%sQ%s\r\n",
            str_repeat('.', $position),
            str_repeat('.', N - $position)
        );
    }
    echo "\r\n";
    echo "[" . implode(',', $positions) . "]";
}