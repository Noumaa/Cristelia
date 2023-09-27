<?php

namespace nouma\cristelia;

use Jibix\Forms\Forms;
use nouma\cristelia\commands\CristeliaCmd;
use nouma\cristelia\commands\HealCommand;
use nouma\cristelia\commands\MaintenanceCmd;
use nouma\cristelia\items\unclaimfinder\PlayerListener;
use nouma\cristelia\jobs\BreakEvent;
use nouma\cristelia\listeners\EnchantsListener;
use nouma\cristelia\listeners\JoinListener;
use nouma\cristelia\listeners\PopulatorListener;
use nouma\cristelia\listeners\PreLoginListener;
use nouma\cristelia\listeners\QuitListener;
use nouma\cristelia\permissions\Permissions;
use nouma\cristelia\registries\BlocksRegisters;
use nouma\cristelia\registries\EntitysRegisters;
use nouma\cristelia\registries\ItemsRegisters;
use nouma\cristelia\registries\RecipesRegisters;
use pocketmine\event\EventPriority;
use pocketmine\event\server\DataPacketSendEvent;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\SetTimePacket;
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

        ItemsRegisters::registerAll();
        BlocksRegisters::registerAll();
        EntitysRegisters::registerAll();
        RecipesRegisters::registerAll($this);

        $this->getServer()->getCommandMap()->register("cristelia", new MaintenanceCmd());
        $this->getServer()->getCommandMap()->register("cristelia", new CristeliaCmd());
        $this->getServer()->getCommandMap()->register("cristelia", new HealCommand());

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

        $this->initDayZone();

        parent::onEnable();
    }

    public function initDayZone() {
        $this->getServer()->getPluginManager()->registerEvent(DataPacketSendEvent::class, function(DataPacketSendEvent $event) : void {
            foreach ($event->getPackets() as $packet) {
                if ($packet instanceof SetTimePacket) {
                    $position = $event->getTargets()[0]->getPlayer()->getPosition();
                    if ($position->distance(new Vector3(-1, 63, 45)) > 20) return;
                    $packet->time = 6000;
                }
            }
        }, EventPriority::HIGHEST, $this);
    }
}