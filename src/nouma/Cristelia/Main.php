<?php

namespace nouma\Cristelia;

use nouma\Cristelia\Commands\Staff\MaintenanceCmd;
use nouma\Cristelia\Commands\CristeliaCmd;
use nouma\Cristelia\Listener\JoinListener;
use nouma\Cristelia\Listener\PreLoginListener;
use nouma\Cristelia\Listener\QuitListener;
use nouma\Cristelia\Permission\Permissions;
use nouma\Cristelia\Registers\BlocksRegisters;
use nouma\Cristelia\Registers\EntitysRegisters;
use nouma\Cristelia\Registers\ItemsRegisters;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase{
    private static Main $instance;

    public static function getInstance(): Main {
        return Main::$instance;
    }
    protected function onEnable(): void {
        $this->getLogger()->notice("CristéliaCore On");

        self::$instance = $this;

        new ItemsRegisters();
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