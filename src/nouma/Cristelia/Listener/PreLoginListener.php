<?php

namespace nouma\Cristelia\Listener;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerPreLoginEvent;
use pocketmine\Server;

class PreLoginListener implements Listener{

    public function whitelistMessage(PlayerPreLoginEvent $loginEvent){

        $player = $loginEvent->getPlayerInfo();
        if (!Server::getInstance()->isWhitelisted($player->getUsername())){
            $reason = Server::getInstance()->getConfigGroup()->getConfigString("raison");
            $loginEvent->setKickFlag(PlayerPreLoginEvent::KICK_FLAG_SERVER_WHITELISTED, "§7================================\n                    §bMaintenance : \n                       " . $reason . "\n§7================================");
        }
    }
}