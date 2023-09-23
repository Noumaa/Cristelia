<?php

namespace nouma\Cristelia\Customies\Items\Ruby;

use customiesdevs\customies\item\component\AllowOffHandComponent;
use customiesdevs\customies\item\component\DiggerComponent;
use customiesdevs\customies\item\component\DurabilityComponent;
use customiesdevs\customies\item\component\HandEquippedComponent;
use customiesdevs\customies\item\component\MaxStackSizeComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\CustomiesItemFactory;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\block\VanillaBlocks;
use pocketmine\crafting\ExactRecipeIngredient;
use pocketmine\crafting\ShapedRecipe;
use pocketmine\item\Axe;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ToolTier;
use pocketmine\item\VanillaItems;
use pocketmine\plugin\PluginBase;

class RubyAxe extends Axe implements ItemComponents
{
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Unknown") {
        parent::__construct($identifier, $name, ToolTier::NETHERITE());
        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT, CreativeInventoryInfo::GROUP_AXE);
        $this->initComponent("ruby_axe", $creativeInfo);
        $this->addComponent(new AllowOffHandComponent(true));
        $this->addComponent(new MaxStackSizeComponent(1));
        $this->addComponent(new DurabilityComponent(2064));
        $this->addComponent(new HandEquippedComponent(true));
        $this->addComponent((new DiggerComponent())->withTags(10,

         /*Bois de chene*/

        VanillaBlocks::OAK_LOG(),
        VanillaBlocks::OAK_PLANKS(),
        VanillaBlocks::OAK_SLAB(),
        VanillaBlocks::OAK_DOOR(),
        VanillaBlocks::OAK_FENCE(),
        VanillaBlocks::OAK_FENCE_GATE(),
        VanillaBlocks::OAK_STAIRS(),
        VanillaBlocks::OAK_PRESSURE_PLATE(),
        VanillaBlocks::OAK_TRAPDOOR(),
        VanillaBlocks::OAK_WALL_SIGN(),
        VanillaBlocks::OAK_SIGN(),

        /*Birch wood*/

        VanillaBlocks::BIRCH_LOG(),
        VanillaBlocks::BIRCH_PLANKS(),
        VanillaBlocks::BIRCH_SLAB(),
        VanillaBlocks::BIRCH_DOOR(),
        VanillaBlocks::BIRCH_FENCE(),
        VanillaBlocks::BIRCH_FENCE_GATE(),
        VanillaBlocks::BIRCH_STAIRS(),
        VanillaBlocks::BIRCH_PRESSURE_PLATE(),
        VanillaBlocks::BIRCH_TRAPDOOR(),
        VanillaBlocks::BIRCH_WALL_SIGN(),
        VanillaBlocks::BIRCH_SIGN(),

        /*acacia wood*/

        VanillaBlocks::ACACIA_LOG(),
        VanillaBlocks::ACACIA_PLANKS(),
        VanillaBlocks::ACACIA_SLAB(),
        VanillaBlocks::ACACIA_DOOR(),
        VanillaBlocks::ACACIA_FENCE(),
        VanillaBlocks::ACACIA_FENCE_GATE(),
        VanillaBlocks::ACACIA_STAIRS(),
        VanillaBlocks::ACACIA_PRESSURE_PLATE(),
        VanillaBlocks::ACACIA_TRAPDOOR(),
        VanillaBlocks::ACACIA_WALL_SIGN(),
        VanillaBlocks::ACACIA_SIGN(),

        /*jungle wood*/

        VanillaBlocks::JUNGLE_LOG(),
        VanillaBlocks::JUNGLE_PLANKS(),
        VanillaBlocks::JUNGLE_SLAB(),
        VanillaBlocks::JUNGLE_DOOR(),
        VanillaBlocks::JUNGLE_FENCE(),
        VanillaBlocks::JUNGLE_FENCE_GATE(),
        VanillaBlocks::JUNGLE_STAIRS(),
        VanillaBlocks::JUNGLE_PRESSURE_PLATE(),
        VanillaBlocks::JUNGLE_TRAPDOOR(),
        VanillaBlocks::JUNGLE_WALL_SIGN(),
        VanillaBlocks::JUNGLE_SIGN(),

        /*spruce wood*/

        VanillaBlocks::SPRUCE_LOG(),
        VanillaBlocks::SPRUCE_PLANKS(),
        VanillaBlocks::SPRUCE_SLAB(),
        VanillaBlocks::SPRUCE_DOOR(),
        VanillaBlocks::SPRUCE_FENCE(),
        VanillaBlocks::SPRUCE_FENCE_GATE(),
        VanillaBlocks::SPRUCE_STAIRS(),
        VanillaBlocks::SPRUCE_PRESSURE_PLATE(),
        VanillaBlocks::SPRUCE_TRAPDOOR(),
        VanillaBlocks::SPRUCE_WALL_SIGN(),
        VanillaBlocks::SPRUCE_SIGN(),

        /*spruce wood*/

        VanillaBlocks::SPRUCE_LOG(),
        VanillaBlocks::SPRUCE_PLANKS(),
        VanillaBlocks::SPRUCE_SLAB(),
        VanillaBlocks::SPRUCE_DOOR(),
        VanillaBlocks::SPRUCE_FENCE(),
        VanillaBlocks::SPRUCE_FENCE_GATE(),
        VanillaBlocks::SPRUCE_STAIRS(),
        VanillaBlocks::SPRUCE_PRESSURE_PLATE(),
        VanillaBlocks::SPRUCE_TRAPDOOR(),
        VanillaBlocks::SPRUCE_WALL_SIGN(),
        VanillaBlocks::SPRUCE_SIGN(),

        /*dark oak wood*/

        VanillaBlocks::DARK_OAK_LOG(),
        VanillaBlocks::DARK_OAK_PLANKS(),
        VanillaBlocks::DARK_OAK_SLAB(),
        VanillaBlocks::DARK_OAK_DOOR(),
        VanillaBlocks::DARK_OAK_FENCE(),
        VanillaBlocks::DARK_OAK_FENCE_GATE(),
        VanillaBlocks::DARK_OAK_STAIRS(),
        VanillaBlocks::DARK_OAK_PRESSURE_PLATE(),
        VanillaBlocks::DARK_OAK_TRAPDOOR(),
        VanillaBlocks::DARK_OAK_WALL_SIGN(),
        VanillaBlocks::DARK_OAK_SIGN(),

        /*Autre*/
        VanillaBlocks::PUMPKIN(),
        VanillaBlocks::MELON(),
        VanillaBlocks::CRAFTING_TABLE(),
        VanillaBlocks::FLETCHING_TABLE(),
        VanillaBlocks::CHEST(),
        VanillaBlocks::BARREL(),
        VanillaBlocks::BANNER(),
        VanillaBlocks::CARVED_PUMPKIN()
        ));

    }
    public function getAttackPoints(): int {
        return 6;
    }
    public function getMaxDurability(): int {
        return 2064;
    }
    public function getMaxStackSize(): int {
        return 1;
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