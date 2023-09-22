<?php

namespace nouma\cristelia\commands;

use customiesdevs\customies\block\CustomiesBlockFactory;
use customiesdevs\customies\item\CustomiesItemFactory;
use Jibix\Forms\form\type\MenuForm;
use Jibix\Forms\menu\Button;
use Jibix\Forms\menu\Image;
use Jibix\Forms\menu\type\BackButton;
use nouma\cristelia\entities\RubyGolem;
use nouma\cristelia\jobs\Jobs;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class CristeliaCommand
{
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool
    {
        switch ($command->getName()) {
            case 'cristelia':
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

            case 'jobs':
                $sender->sendForm(Jobs::home());
        }
        return true;
    }
}