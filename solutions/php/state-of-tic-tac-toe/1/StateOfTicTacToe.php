<?php

/*
 * By adding type hints and enabling strict type checking, code can become
 * easier to read, self-documenting and reduce the number of potential bugs.
 * By default, type declarations are non-strict, which means they will attempt
 * to change the original type to match the type specified by the
 * type-declaration.
 *
 * In other words, if you pass a string to a function requiring a float,
 * it will attempt to convert the string value to a float.
 *
 * To enable strict mode, a single declare directive must be placed at the top
 * of the file.
 * This means that the strictness of typing is configured on a per-file basis.
 * This directive not only affects the type declarations of parameters, but also
 * a function's return type.
 *
 * For more info review the Concept on strict type checking in the PHP track
 * <link>.
 *
 * To disable strict typing, comment out the directive below.
 */

declare(strict_types=1);

enum State
{
    case Win;
    case Ongoing;
    case Draw;
}

class StateOfTicTacToe
{
    private $winner = null;
    public function gameState(array $board): State
    {
        $boardGood = [];
        foreach ($board as $el){
            $boardGood[] = str_split($el);
        }
        $numberOfX = $this->findX($boardGood);
        $numberOfO = $this->findO($boardGood);
        if($numberOfO > $numberOfX){
            throw new RuntimeException("Wrong turn order: O started");
        }
        if($numberOfX > $numberOfO + 1) {
            throw new RuntimeException("Wrong turn order: X went twice");
        }
        $numbersOfWinners = $this->searchWinners($boardGood);
        print_r('winners: '.$numbersOfWinners);
        if($numbersOfWinners > 2) {
            throw new RuntimeException("Impossible board: game should have ended after the game was won");
        }
        if($numbersOfWinners < 3 && $numbersOfWinners > 0) {
            return State::Win;
        }
        if($this->boardIsFull($boardGood)) {
            return State::Draw;
        }
        return State::Ongoing;
    }

    private function findX($board) {
        return $this->find($board, 'X');
    }

    private function findO($board) {
        return $this->find($board, 'O');
    }

    private function find(array $board, string $value) {
        $count = 0;
        foreach($board as $line){
            foreach($line as $el){
                if($el === $value) {
                    $count++;
                }
            }
        }
        return $count;
    }

    private function searchWinners(array $board) {
        $numberOfWinners = 0;
        $numberOfWinners += $this->searchWinnersH($board); 
        $numberOfWinners += $this->searchWinnersV($board);
        $numberOfWinners += $this->searchWinnersD($board);
        return $numberOfWinners;
    }

    private function searchWinnersH(array $board) {
        $count = 0;
        foreach($board as $line) {
            if($line[0] === $line[1] && $line[1] === $line[2] && $line[0] !== ' ') {
                print_r($line);
                if($this->winner !== null && $this->winner !== $line[0]) {
                    throw new RuntimeException("Impossible board: game should have ended after the game was won");
                }
                $count++;
                $this->winner = $line[0];
            }
        }
        return $count;
    }

    private function searchWinnersV(array $board) {
        $count = 0;
        for($i = 0; $i < 3; $i++) {
            if($board[0][$i] === $board[1][$i] && $board[1][$i] === $board[2][$i] && $board[0][$i] !== ' ') {
                if($this->winner !== null && $this->winner !== $board[0][$i]) {
                    throw new RuntimeException("Impossible board: game should have ended after the game was won");
                }
                $count++;
                $this->winner = $board[0][$i];
            }
        }
        return $count;
    }

    private function searchWinnersD(array $board) {
        $count = 0;
        if($board[0][0] === $board[1][1] && $board[1][1] === $board[2][2] && $board[0][0] !== ' '){
            if($this->winner !== null && $this->winner !== $board[0][0]) {
                throw new RuntimeException("Impossible board: game should have ended after the game was won");
            }
            $count++;
            $this->winner = $board[0][0];
        }
        if($board[0][2] === $board[1][1] && $board[1][1] === $board[2][0] && $board[0][2] !== ' '){
            if($this->winner !== null && $this->winner !== $board[0][2]) {
                throw new RuntimeException("Impossible board: game should have ended after the game was won");
            }
            $count++;
            $this->winner = $board[0][2];
        }
        return $count;
    }

    private function boardIsFull(array $board) {
        foreach($board as $line) {
            foreach($line as $el) {
                if($el === ' ') {
                    return false;
                }
            }
        }
        return true;
    }
}
