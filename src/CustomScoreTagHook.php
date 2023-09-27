<?php

namespace nouma\cristelia;

use DaPigGuy\PiggyFactions\PiggyFactions;
use Joshet18\CustomScoreboard\PlayerScoreTagEvent;
use pocketmine\event\Listener;
use pocketmine\player\Player;

class CustomScoreTagHook implements Listener
{

    public function onPlayerTags(PlayerScoreTagEvent $ev): void {
        $ev->setTags($this->processTags($ev->getPlayer(), $ev->getTags()));
    }

    private function processTags(Player $player, array $tags):array{
        $faction = PiggyFactions::getInstance()->getPlayerManager()->getPlayer($player)->getFaction();

        $result = [];
        foreach($tags as $tag){
            $result[] = str_replace([
                "{piggyfactions.faction}"
            ],[
                $faction == null ? "§7Aucune" : PiggyFactions::getInstance()->getPlayerManager()->getPlayer($player)->getFaction()->getName()
            ], $tag);
        }
        return $result;
    }

}