<?php

namespace nouma\cristelia\commands;

use nouma\cristelia\permissions\Permissions;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class HealCommand extends Command
{

    public function __construct() {
        parent::__construct("heal", "Se soigner soi-même ou quelqu'un");
        $this->setPermission(Permissions::HEAL_SELF);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (!($sender instanceof Player)) {
            $sender->sendMessage("§cSeuls les joueurs peuvent se soigner !");
            return;
        }

        $sender->setHealth(20);
        $sender->getHungerManager()->setFood(20);
        $sender->getHungerManager()->setSaturation(20);
        $sender->sendMessage("§7Comme neuf !");
    }
}