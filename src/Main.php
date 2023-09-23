<?php

namespace nouma\cristelia;

use Jibix\Forms\Forms;
use nouma\cristelia\blocks\Generator;
use nouma\cristelia\commands\Staff\MaintenanceCmd;
use nouma\cristelia\commands\CristeliaCmd;
use nouma\cristelia\items\unclaimfinder\PlayerListener;
use nouma\cristelia\jobs\BreakEvent;
use nouma\cristelia\listeners\JoinListener;
use nouma\cristelia\listeners\PreLoginListener;
use nouma\cristelia\listeners\QuitListener;
use nouma\cristelia\permissions\PermissionManager;
use nouma\cristelia\permissions\Permissions;
use nouma\cristelia\registries\BlocksRegisters;
use nouma\cristelia\registries\EntitysRegisters;
use nouma\cristelia\registries\ItemsRegisters;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase
{
    private static Main $instance;

    public static function getInstance(): Main {
        return Main::$instance;
    }

    protected function onEnable(): void {
        self::$instance = $this;

        PermissionManager::init();

        ItemsRegisters::registerAll();
        new BlocksRegisters();
        new EntitysRegisters();

        $this->getServer()->getPluginManager()->registerEvents(new JoinListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new QuitListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new PreLoginListener(), $this);

        Permissions::init();

        $this->getServer()->getCommandMap()->register("cristelia", new MaintenanceCmd());
        $this->getServer()->getCommandMap()->register("cristelia", new CristeliaCmd());

        if (!is_dir(Main::getInstance()->getDataFolder() . "players/"))
            mkdir(Main::getInstance()->getDataFolder() . "players/");

        $this->saveDefaultConfig();

        Forms::register($this);
        Forms::setAutoBack(true);

        // Listeners
        $this->getServer()->getPluginManager()->registerEvents(new PlayerListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new Generator(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new BreakEvent(), $this);

        parent::onEnable();
    }
}