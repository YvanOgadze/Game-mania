<?php
//Service/LievelingsGameService
declare(strict_types=1);

namespace Business;

use Data\LievelingsGameDAO;

class LievelingsGameService {
    public function getLievelingsGameLijst() : array {
        $LievelingsGameDAO = new LievelingsGameDAO();
        $lijst = $LievelingsGameDAO->getLievelingsGameLijst();
        return $lijst;
    }
    public function getLievelingsGameByGameId(int $game_id) : array {
        $LievelingsGameDAO = new LievelingsGameDAO();
        $lijst = $LievelingsGameDAO->getLievelingsGameByGameId($game_id);
        return $lijst;
    }
    public function getLievelingsGameByUserId(int $user_id) : array {
        $LievelingsGameDAO = new LievelingsGameDAO();
        $lijst = $LievelingsGameDAO->getLievelingsGameByUserId($user_id);
        return $lijst;
    }
    public function createLievelingsGame(int $game_id, int $user_id) {
        $LievelingsGameDAO = new LievelingsGameDAO();
        $LievelingsGameDAO->createLievelingsGame($game_id, $user_id);
    }
    public function deleteLievelingsGame(int $game_id, int $user_id) {
        $LievelingsGameDAO = new LievelingsGameDAO();
        $LievelingsGameDAO->deleteLievelingsGame($game_id, $user_id);
    }
}