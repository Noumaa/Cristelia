<?php

namespace nouma\cristelia\listeners;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\Server;


class QuitListener implements Listener {

    public function onQuit(PlayerQuitEvent $quitEvent): void {
        $quitEvent->setQuitMessage("");
        $player = $quitEvent->getPlayer();
        Server::getInstance()->broadcastTip("§1- " .$player->getName());
    }
}