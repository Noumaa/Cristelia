<?php

declare(strict_types = 1);

namespace nouma\Cristelia\BossBar;

use pocketmine\event\EventPriority;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\plugin\Plugin;
use pocketmine\Server;

final class BossBarHandler {

    private static bool $delete = false;

    public static function autoDeleteData(Plugin $plugin) :void {
        if(self::$delete) return;
        Server::getInstance()->getPluginManager()->registerEvent(PlayerQuitEvent::class, function(PlayerQuitEvent $ev) :void {
            BossBarAPI::getInstance()->deleteData($ev->getPlayer());
        }, EventPriority::MONITOR, $plugin);
        self::$delete = true;
    }

}
