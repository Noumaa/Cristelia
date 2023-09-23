<?php

namespace nouma\Cristelia\Blocks;

use customiesdevs\customies\item\CustomiesItemFactory;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockTypeIds;
use pocketmine\block\BlockTypeInfo;
use pocketmine\crafting\ExactRecipeIngredient;
use pocketmine\crafting\ShapedRecipe;
use pocketmine\crafting\ShapelessRecipe;
use pocketmine\crafting\ShapelessRecipeType;
use pocketmine\item\ToolTier;
use pocketmine\plugin\PluginBase;

class RubyBlock extends Block {
    public function __construct() {
        parent::__construct(
            new BlockIdentifier(BlockTypeIds::newId()),
            "Ruby Block",
            new BlockTypeInfo(BlockBreakInfo::pickaxe(1.0, ToolTier::IRON()))
        );
    }

    public static function registerRecipes(PluginBase $main) {
        $main->getServer()->getCraftingManager()->registerShapedRecipe(new ShapedRecipe(
            [
                "RRR",
                "RRR",
                "RRR"
            ],
            [
                "R" => new ExactRecipeIngredient(CustomiesItemFactory::getInstance()->get("cristelia:ruby")),
            ],
            [CustomiesItemFactory::getInstance()->get("cristelia:ruby_block")]
        ));
        $main->getServer()->getCraftingManager()->registerShapelessRecipe(new ShapelessRecipe(
            [new ExactRecipeIngredient(CustomiesItemFactory::getInstance()->get("cristelia:ruby_block"))],
            [CustomiesItemFactory::getInstance()->get("cristelia:ruby")->setCount(9)],
            ShapelessRecipeType::CRAFTING()
        ));
    }
}