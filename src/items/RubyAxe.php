<?php

namespace nouma\cristelia\items;

use customiesdevs\customies\item\component\CreativeGroupComponent;
use customiesdevs\customies\item\component\DiggerComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\CustomiesItemFactory;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\crafting\ExactRecipeIngredient;
use pocketmine\crafting\ShapedRecipe;
use pocketmine\item\Axe;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\Pickaxe;
use pocketmine\item\Sword;
use pocketmine\item\ToolTier;
use pocketmine\item\VanillaItems;
use pocketmine\plugin\PluginBase;

class RubyAxe extends Axe implements ItemComponents
{
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Unknown") {
        parent::__construct($identifier, $name, ToolTier::NETHERITE());
        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT);
        $this->initComponent("ruby_axe", $creativeInfo);
        $this->addComponent((new DiggerComponent())->withTags(10, "log"));
    }

    public static function registerRecipes(PluginBase $main) {
        $main->getServer()->getCraftingManager()->registerShapedRecipe(new ShapedRecipe(
            [
                "RR ",
                "RS ",
                " S "
            ],
            [
                "R" => new ExactRecipeIngredient(CustomiesItemFactory::getInstance()->get("cristelia:ruby")),
                "S" => new ExactRecipeIngredient(VanillaItems::STICK()),
            ],
            [CustomiesItemFactory::getInstance()->get("cristelia:ruby_axe")]
        ));
    }
}