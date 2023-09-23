<?php
declare(strict_types=1);

namespace nouma\cristelia;

use customiesdevs\customies\block\CustomiesBlockFactory;
use customiesdevs\customies\block\Material;
use customiesdevs\customies\block\Model;
use customiesdevs\customies\entity\CustomiesEntityFactory;
use customiesdevs\customies\item\CustomiesItemFactory;
use Jibix\Forms\Forms;
use nouma\cristelia\blocks\Generator;
use nouma\cristelia\blocks\RubyBlock;
use nouma\cristelia\blocks\RubyOre;
use nouma\cristelia\commands\CristeliaCommand;
use nouma\cristelia\entities\RubyGolem;
use nouma\cristelia\items\DiamondUnclaimFinder;
use nouma\cristelia\items\EmeraldSword;
use nouma\cristelia\items\ruby\Ruby;
use nouma\cristelia\items\ruby\RubyAxe;
use nouma\cristelia\items\ruby\RubyHammer;
use nouma\cristelia\items\ruby\RubyPickaxe;
use nouma\cristelia\items\ruby\RubyShovel;
use nouma\cristelia\items\ruby\RubySword;
use nouma\cristelia\items\unclaimfinder\PlayerListener;
use nouma\cristelia\jobs\BreakEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\math\Vector3;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase {

    private static Main $instance;

    public static function getInstance(): Main
    {
        return Main::$instance;
    }

    protected function onEnable(): void
    {
        self::$instance = $this;

        ResourcePackGenerator::generate();

        if (!is_dir(Main::getInstance()->getDataFolder() . "players/"))
            mkdir(Main::getInstance()->getDataFolder() . "players/");

        $this->saveDefaultConfig();

        Forms::register($this);
        Forms::setAutoBack(true);

        // Blocks
        $material = new Material(Material::TARGET_ALL, "ruby_ore", Material::RENDER_METHOD_BLEND);
        $model = new Model([$material], "geometry.ruby_ore", new Vector3(-8, 0, -8), new Vector3(16, 16, 16));
        CustomiesBlockFactory::getInstance()->registerBlock(static fn() => new RubyOre(), "cristelia:ruby_ore", $model);

        $material = new Material(Material::TARGET_ALL, "ruby_block", Material::RENDER_METHOD_ALPHA_TEST);
        $model = new Model([$material], "geometry.ruby_ore", new Vector3(-8, 0, -8), new Vector3(16, 16, 16));
        CustomiesBlockFactory::getInstance()->registerBlock(static fn() => new RubyBlock(), "cristelia:ruby_block", $model);

        // Items
        CustomiesItemFactory::getInstance()->registerItem(Ruby::class, "cristelia:ruby", "Ruby");

        CustomiesItemFactory::getInstance()->registerItem(RubySword::class, "cristelia:ruby_sword", "Ruby Sword");
        CustomiesItemFactory::getInstance()->registerItem(RubyPickaxe::class, "cristelia:ruby_pickaxe", "Ruby Pickaxe");
        CustomiesItemFactory::getInstance()->registerItem(RubyAxe::class, "cristelia:ruby_axe", "Ruby Axe");
        CustomiesItemFactory::getInstance()->registerItem(RubyShovel::class, "cristelia:ruby_shovel", "Ruby Shovel");
        CustomiesItemFactory::getInstance()->registerItem(RubyHammer::class, "cristelia:ruby_hammer", "Ruby Hammer");
        CustomiesItemFactory::getInstance()->registerItem(EmeraldSword::class, "cristelia:emerald_sword", "Emerald Sword");

        CustomiesItemFactory::getInstance()->registerItem(DiamondUnclaimFinder::class, "cristelia:diamond_unclaim_finder", "Diamond Unclaim Finder");

        // Recipes
        RubyBlock::registerRecipes($this);

        RubySword::registerRecipes($this);
        RubyPickaxe::registerRecipes($this);
        RubyAxe::registerRecipes($this);
        RubyShovel::registerRecipes($this);
        RubyHammer::registerRecipes($this);
        EmeraldSword::registerRecipes($this);

        DiamondUnclaimFinder::registerRecipes($this);

        // Entities
        CustomiesEntityFactory::getInstance()->registerEntity(RubyGolem::class, "cristelia:ruby_golem");

        // Listeners
        $this->getServer()->getPluginManager()->registerEvents(new PlayerListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new Generator(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new BreakEvent(), $this);

        parent::onEnable();
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        return (new CristeliaCommand())->onCommand($sender, $command, $label, $args);
    }
}
