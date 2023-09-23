<?php

namespace nouma\cristelia\commands;

use customiesdevs\customies\block\CustomiesBlockFactory;
use customiesdevs\customies\item\CustomiesItemFactory;
use nouma\cristelia\Entities\RubyGolem;
use nouma\cristelia\permissions\Permissions;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class CristeliaCmd extends Command
{

    public function __construct() {
        parent::__construct("cristelia", "Permet de avoir les items, Blocks est entity Moddés du serveur");
        $this->setPermission(Permissions::CRISTELIA);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {

        if ($sender instanceof Player) {
            $sender->getInventory()->addItem(CustomiesBlockFactory::getInstance()->get("cristelia:ruby_ore")->asItem());
            $sender->getInventory()->addItem(CustomiesBlockFactory::getInstance()->get("cristelia:ruby_block")->asItem());
            $sender->getInventory()->addItem(CustomiesItemFactory::getInstance()->get("cristelia:ruby"));
            $sender->getInventory()->addItem(CustomiesItemFactory::getInstance()->get("cristelia:ruby_sword"));
            $sender->getInventory()->addItem(CustomiesItemFactory::getInstance()->get("cristelia:ruby_pickaxe"));
            $sender->getInventory()->addItem(CustomiesItemFactory::getInstance()->get("cristelia:ruby_axe"));
            $sender->getInventory()->addItem(CustomiesItemFactory::getInstance()->get("cristelia:ruby_shovel"));
            $sender->getInventory()->addItem(CustomiesItemFactory::getInstance()->get("cristelia:diamond_unclaim_finder"));
            $entity = new RubyGolem($sender->getLocation());
            $entity->spawnToAll();
        }
        return true;
    }

}