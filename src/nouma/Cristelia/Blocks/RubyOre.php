<?php

namespace nouma\Cristelia\Blocks;

use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockTypeIds;
use pocketmine\block\BlockTypeInfo;
use pocketmine\item\ToolTier;

class RubyOre extends Block {
    public function __construct()
    {
        parent::__construct(
            new BlockIdentifier(BlockTypeIds::newId()),
            "Ruby Ore",
            new BlockTypeInfo(BlockBreakInfo::pickaxe(1.0, ToolTier::IRON()))
        );
    }
}