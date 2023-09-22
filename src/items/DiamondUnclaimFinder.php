<?php

namespace nouma\cristelia\items;

use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\CustomiesItemFactory;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\crafting\ExactRecipeIngredient;
use pocketmine\crafting\ShapedRecipe;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\VanillaItems;
use pocketmine\plugin\PluginBase;

class DiamondUnclaimFinder extends Item implements ItemComponents
{
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Unknown") {
        parent::__construct($identifier, $name);
        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS);
        $this->initComponent("diamond_unclaim_finder", $creativeInfo);
    }

    public static function registerRecipes(PluginBase $main) {
        $main->getServer()->getCraftingManager()->registerShapedRecipe(new ShapedRecipe(
            [
                "D D",
                " E ",
                "D D"
            ],
            [
                "D" => new ExactRecipeIngredient(VanillaItems::DIAMOND()),
                "E" => new ExactRecipeIngredient(VanillaItems::EMERALD()),
            ],
            [CustomiesItemFactory::getInstance()->get("cristelia:diamond_unclaim_finder")]
        ));
    }
}