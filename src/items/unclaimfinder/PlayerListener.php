<?php

namespace nouma\cristelia\items\unclaimfinder;

use customiesdevs\customies\item\CustomiesItemFactory;
use nouma\cristelia\Main;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemHeldEvent;

class PlayerListener implements Listener
{

    private array $playersUnclaimFinderTasks = [];

    public function onItemHeld(PlayerItemHeldEvent $event) {
        $player = $event->getPlayer();
        $item = $event->getItem();

        if (key_exists($player->getName(), $this->playersUnclaimFinderTasks)) $this->playersUnclaimFinderTasks[$player->getName()]->cancel();

        if ($item->getTypeId() == CustomiesItemFactory::getInstance()->get('cristelia:diamond_unclaim_finder')->getTypeId()) {
            $this->playersUnclaimFinderTasks[$player->getName()] = Main::getInstance()->getScheduler()->scheduleRepeatingTask(new UnclaimFinderTask($player), 2*20);
        }
    }
}