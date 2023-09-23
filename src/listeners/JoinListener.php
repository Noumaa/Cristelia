<?php

namespace nouma\cristelia\listeners;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\Server;

class JoinListener implements Listener {

    public function onJoin(PlayerJoinEvent $joinEvent): void {
        $joinEvent->setJoinMessage("");
        $player = $joinEvent->getPlayer();
        Server::getInstance()->broadcastTip("§a+ " .$player->getName());
    }
}