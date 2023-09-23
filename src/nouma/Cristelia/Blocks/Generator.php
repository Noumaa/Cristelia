<?php

namespace nouma\Cristelia\Blocks;

use customiesdevs\customies\block\CustomiesBlockFactory;
use Exception;
use pocketmine\event\Listener;
use pocketmine\event\world\ChunkPopulateEvent;

class Generator implements Listener {

    /**
     * @throws Exception
     */

    public function onChunkPopulate(ChunkPopulateEvent $event) {
        $chunk = $event->getChunk();

        if (mt_rand() / mt_getrandmax() <= 0.3)
            $chunk->setBlockStateId(random_int(0, 16), random_int(-64, -54), random_int(0, 16), CustomiesBlockFactory::getInstance()->get('cristelia:ruby_ore')->getStateId());
    }
}