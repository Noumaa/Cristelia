<?php

namespace nouma\cristelia\items\unclaimfinder;

use pocketmine\player\Player;
use pocketmine\scheduler\Task;

class UnclaimFinderTask extends Task
{

    private Player $player;

    public function __construct(Player $player) {
        $this->player = $player;
    }

    public function onRun(): void
    {
        $position = $this->player->getPosition();
        $world = $this->player->getWorld();

        $chunkX = $position->getFloorX() >> 4;
        $chunkZ = $position->getFloorZ() >> 4;

        $tiles = sizeof($world->getChunk($chunkX, $chunkZ)->getTiles());

        $this->player->sendActionBarMessage("Unclaim finder : {$tiles}");
    }
}