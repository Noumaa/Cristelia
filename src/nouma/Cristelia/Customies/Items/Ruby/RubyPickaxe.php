<?php

namespace nouma\Cristelia\Customies\Items\Ruby;

use customiesdevs\customies\item\component\AllowOffHandComponent;
use customiesdevs\customies\item\component\DiggerComponent;
use customiesdevs\customies\item\component\DurabilityComponent;
use customiesdevs\customies\item\component\HandEquippedComponent;
use customiesdevs\customies\item\component\MaxStackSizeComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;

class RubyPickaxe extends Item implements ItemComponents {
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Unknown") {
        parent::__construct($identifier, $name);
        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT, CreativeInventoryInfo::GROUP_PICKAXE);
        $this->initComponent("ruby_pickaxe", $creativeInfo);
        $this->addComponent(new AllowOffHandComponent(true));
        $this->addComponent(new MaxStackSizeComponent(1));
        $this->addComponent(new DurabilityComponent(2064));
        $this->addComponent(new HandEquippedComponent(true));
        $this->addComponent((new DiggerComponent())->withBlocks(11,
            VanillaBlocks::STONE(),
            VanillaBlocks::STONE_STAIRS(),
            VanillaBlocks::STONE_SLAB(),
            #Cobble
            VanillaBlocks::COBBLESTONE(),
            VanillaBlocks::COBBLESTONE_SLAB(),
            VanillaBlocks::COBBLESTONE_STAIRS(),
            VanillaBlocks::COBBLESTONE_WALL(),
            #Mossy
            VanillaBlocks::MOSSY_COBBLESTONE(),
            VanillaBlocks::MOSSY_COBBLESTONE_SLAB(),
            VanillaBlocks::MOSSY_COBBLESTONE_STAIRS(),
            VanillaBlocks::MOSSY_COBBLESTONE_WALL(),
            #Andesite
            VanillaBlocks::ANDESITE(),
            VanillaBlocks::ANDESITE_SLAB(),
            VanillaBlocks::ANDESITE_STAIRS(),
            VanillaBlocks::ANDESITE_WALL(),
            #diorite
            VanillaBlocks::DIORITE(),
            VanillaBlocks::DIORITE_SLAB(),
            VanillaBlocks::DIORITE_STAIRS(),
            VanillaBlocks::DIORITE_WALL(),
            #Granite
            VanillaBlocks::GRANITE(),
            VanillaBlocks::GRANITE_SLAB(),
            VanillaBlocks::GRANITE_STAIRS(),
            VanillaBlocks::GRANITE_WALL(),
            #Polished
            VanillaBlocks::POLISHED_ANDESITE_SLAB(),
            VanillaBlocks::POLISHED_ANDESITE_STAIRS(),
            VanillaBlocks::POLISHED_ANDESITE(),
            VanillaBlocks::POLISHED_DIORITE(),
            VanillaBlocks::POLISHED_DIORITE_SLAB(),
            VanillaBlocks::POLISHED_DIORITE_STAIRS(),
            VanillaBlocks::POLISHED_GRANITE(),
            VanillaBlocks::POLISHED_GRANITE_SLAB(),
            VanillaBlocks::POLISHED_GRANITE_STAIRS(),
            #StoneBrick
            VanillaBlocks::STONE_BRICKS(),
            VanillaBlocks::STONE_BRICK_SLAB(),
            VanillaBlocks::STONE_BRICK_STAIRS(),
            VanillaBlocks::CRACKED_STONE_BRICKS(),
            #MossyStoneBricks

            VanillaBlocks::MOSSY_STONE_BRICKS(),
            VanillaBlocks::MOSSY_STONE_BRICK_SLAB(),
            VanillaBlocks::MOSSY_STONE_BRICK_STAIRS(),
            VanillaBlocks::MOSSY_STONE_BRICK_WALL(),

            #Other
            VanillaBlocks::FURNACE(),
            VanillaBlocks::STONECUTTER(),
            VanillaBlocks::ENDER_CHEST(),
            VanillaBlocks::ANVIL(),

            #Quartz
            VanillaBlocks::QUARTZ(),
            VanillaBlocks::QUARTZ_PILLAR(),
            VanillaBlocks::QUARTZ_SLAB(),
            VanillaBlocks::QUARTZ_STAIRS(),
            VanillaBlocks::SMOOTH_QUARTZ(),
            VanillaBlocks::CHISELED_QUARTZ(),
            VanillaBlocks::NETHER_QUARTZ_ORE(),
            VanillaBlocks::SMOOTH_QUARTZ_SLAB(),
            VanillaBlocks::SMOOTH_QUARTZ_STAIRS(),

            #Nether
            VanillaBlocks::NETHER_BRICK_FENCE(),
            VanillaBlocks::NETHER_BRICKS(),
            VanillaBlocks::NETHER_BRICK_SLAB(),
            VanillaBlocks::NETHER_BRICK_STAIRS(),
            VanillaBlocks::NETHER_BRICK_WALL(),
            VanillaBlocks::RED_NETHER_BRICK_SLAB(),
            VanillaBlocks::RED_NETHER_BRICK_STAIRS(),
            VanillaBlocks::RED_NETHER_BRICK_WALL(),

            #EndStone
            VanillaBlocks::END_STONE(),
            VanillaBlocks::END_STONE_BRICK_SLAB(),
            VanillaBlocks::END_STONE_BRICK_STAIRS(),
            VanillaBlocks::END_STONE_BRICK_WALL(),
            VanillaBlocks::END_STONE_BRICKS(),

            #Ore
            VanillaBlocks::IRON_ORE(),
            VanillaBlocks::DIAMOND_ORE(),
            VanillaBlocks::EMERALD_ORE(),
            VanillaBlocks::COAL_ORE(),
            VanillaBlocks::GOLD_ORE(),
            VanillaBlocks::REDSTONE_ORE(),
            VanillaBlocks::LAPIS_LAZULI_ORE(),



            #BlockOre
            VanillaBlocks::IRON(),
            VanillaBlocks::DIAMOND(),
            VanillaBlocks::EMERALD(),
            VanillaBlocks::COAL(),
            VanillaBlocks::GOLD(),
            VanillaBlocks::REDSTONE(),
            VanillaBlocks::LAPIS_LAZULI()

        ));
    }
    public function getMaxDurability(): int {
        return 2064;
    }

    public function getAttackPoints(): int {
        return 3;
    }
    public function getMaxStackSize(): int {
        return 1;
    }
}