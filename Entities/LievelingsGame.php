<?php
//Entities/LievelingsGame.php
declare(strict_types=1);

namespace Entities;

class LievelingsGame {
    private $lievelingsGame_id;
    private $game_id;
    private $user_id;
    //Constructor
    public function __construct(int $lievelingsGame_id, int $game_id, int $user_id) {
        $this->lievelingsGame_id = $lievelingsGame_id;
        $this->game_id = $game_id;
        $this->user_id = $user_id;
    }
    //Getters
    public function getLievelingsGameId() : int {
        return $this->lievelingsGame_id;
    }
    public function getGameId() : int {
        return $this->game_id;
    }
    public function getUserId() : int {
        return $this->user_id;
    }
    //Setters
    public function setGameId(int $game_id) {
        $this->game_id = $game_id;
    }
    public function setUserId(int $user_id) {
        $this->user_id = $user_id;
    }
}