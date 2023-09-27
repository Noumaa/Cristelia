<?php

namespace nouma\cristelia;

use Jibix\Forms\Forms;
use nouma\cristelia\commands\CristeliaCmd;
use nouma\cristelia\commands\MaintenanceCmd;
use nouma\cristelia\items\unclaimfinder\PlayerListener;
use nouma\cristelia\jobs\BreakEvent;
use nouma\cristelia\listeners\EnchantsListener;
use nouma\cristelia\listeners\JoinListener;
use nouma\cristelia\listeners\PopulatorListener;
use nouma\cristelia\listeners\PreLoginListener;
use nouma\cristelia\listeners\QuitListener;
use nouma\cristelia\permissions\PermissionManager;
use nouma\cristelia\permissions\Permissions;
use nouma\cristelia\registries\BlocksRegisters;
use nouma\cristelia\registries\EntitysRegisters;
use nouma\cristelia\registries\ItemsRegisters;
use nouma\cristelia\registries\RecipesRegisters;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase
{
    private static Main $instance;

    public static function getInstance(): Main {
        return Main::$instance;
    }

    protected function onEnable(): void {
        self::$instance = $this;

        Permissions::init();
        PermissionManager::init();

        ItemsRegisters::registerAll();
        BlocksRegisters::registerAll();
        EntitysRegisters::registerAll();
        RecipesRegisters::registerAll($this);

        $this->getServer()->getCommandMap()->register("cristelia", new MaintenanceCmd());
        $this->getServer()->getCommandMap()->register("cristelia", new CristeliaCmd());

        if (!is_dir(Main::getInstance()->getDataFolder() . "players/"))
            mkdir(Main::getInstance()->getDataFolder() . "players/");

        $this->saveDefaultConfig();

        Forms::register($this);
        Forms::setAutoBack(true);

        // Listeners
        $this->getServer()->getPluginManager()->registerEvents(new PopulatorListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new JoinListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new QuitListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new PreLoginListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new PlayerListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new BreakEvent(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new EnchantsListener(), $this);

        parent::onEnable();
    }
}