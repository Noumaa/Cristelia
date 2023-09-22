<?php

namespace nouma\cristelia\items\ruby;

use customiesdevs\customies\item\component\CreativeGroupComponent;
use customiesdevs\customies\item\component\DiggerComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\CustomiesItemFactory;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use nouma\cristelia\Main;
use pocketmine\block\Block;
use pocketmine\block\VanillaBlocks;
use pocketmine\crafting\ExactRecipeIngredient;
use pocketmine\crafting\ShapedRecipe;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\Pickaxe;
use pocketmine\item\Sword;
use pocketmine\item\ToolTier;
use pocketmine\item\VanillaItems;
use pocketmine\plugin\PluginBase;

class RubyHammer extends Pickaxe implements ItemComponents, Listener
{
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Unknown") {
        parent::__construct($identifier, $name, ToolTier::NETHERITE());
        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT);
        $this->initComponent("ruby_hammer", $creativeInfo);
        $this->addComponent((new DiggerComponent())->withTags(10, "stone", "metal", "diamond_pick_diggable"));
    }

    public function onDestroyBlock(Block $block, array &$returnedItems): bool
    {
        $level = $block->getPosition()->getWorld();
        $x = $block->getPosition()->getX();
        $y = $block->getPosition()->getY();
        $z = $block->getPosition()->getZ();

        $count = 0;

        for ($dx = -1; $dx <= 1; $dx++) {
            for ($dy = -1; $dy <= 1; $dy++) {
                for ($dz = -1; $dz <= 1; $dz++) {
                    $targetBlock = $level->getBlockAt($x + $dx, $y + $dy, $z + $dz);
                    if (!($targetBlock instanceof (VanillaBlocks::AIR()))) {

                        foreach ($level->getBlockAt($x + $dx, $y + $dy, $z + $dz)->getDrops($this) as $drop)
                            $level->dropItem($block->getPosition(), $drop);

                        $level->setBlockAt($x + $dx, $y + $dy, $z + $dz, VanillaBlocks::AIR());
                        $count++;
                    }
                }
            }
        }

        if(!$block->getBreakInfo()->breaksInstantly()){
            return $this->applyDamage($count);
        }
        return false;
    }

    public static function registerRecipes(PluginBase $main) {
        $main->getServer()->getCraftingManager()->registerShapedRecipe(new ShapedRecipe(
            [
                "RRR",
                "RRR",
                " S "
            ],
            [
                "R" => new ExactRecipeIngredient(CustomiesItemFactory::getInstance()->get("cristelia:ruby")),
                "S" => new ExactRecipeIngredient(VanillaItems::STICK()),
            ],
            [CustomiesItemFactory::getInstance()->get("cristelia:ruby_hammer")]
        ));
    }
}