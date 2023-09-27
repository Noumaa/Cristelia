<?php

namespace nouma\cristelia\commands;

use customiesdevs\customies\block\CustomiesBlockFactory;
use customiesdevs\customies\item\CustomiesItemFactory;
use nouma\cristelia\entities\MysteryBox;
use nouma\cristelia\Entities\RubyGolem;
use nouma\cristelia\permissions\Permissions;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\network\mcpe\protocol\SetTimePacket;
use pocketmine\player\Player;

class CristeliaCmd extends Command
{

    public function __construct() {
        parent::__construct("cristelia", "Permet de avoir les items, Blocks est entity Moddés du serveur");
        $this->setPermission(Permissions::CRISTELIA);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool
    {
        if ($sender instanceof Player) {
            if (sizeof($args) == 0 || !in_array(strtolower($args[0]), ["setdayzone", "spawncrate"])) {
                $sender->sendMessage("/cristelia <setDayZone/spawnCrate>");
                return true;
            } else if (strtolower($args[0]) == "setdayzone") {
                try {
                    $sender->getNetworkSession()->sendDataPacket(SetTimePacket::create((int)$args[1]));
                } catch (\Exception $e) {
                    $sender->sendMessage("§cErreur : " . $e->getMessage());
                }
            } else if (strtolower($args[0]) == "spawncrate") {
                $crate = new MysteryBox($sender->getLocation());
                $crate->spawnToAll();
            } else return false;
        }
        return true;
    }

}