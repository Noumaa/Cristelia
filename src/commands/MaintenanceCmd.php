<?php

namespace nouma\cristelia\commands;

use nouma\cristelia\permissions\Permissions;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\console\ConsoleCommandSender;
use pocketmine\Server;

class MaintenanceCmd extends Command{

    public function __construct(){

        parent::__construct("maintenance", "Permet de mettre en maintenance le serveur");
        $this->setPermission(Permissions::MAINTENANCE);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){

        if(isset($args[0])) {
            if ($args[0] === "on") {
                if (isset($args[1])) {

                    $reason = $args;
                    unset($reason[0]);
                    $reason = implode(" ", $reason);

                    $server = $sender->getServer();
                    $server->getConfigGroup()->setConfigBool("white-list", true);
                    $server->getConfigGroup()->setConfigString("raison", $reason);
                    $server->getConfigGroup()->save();
                    $this->kickNonWhitelistedPlayers($server, $reason);
                    $sender->sendMessage("Le serveur est désormé en maintenance pour la raison: '" . $reason . "'");
                } else {
                    $sender->sendMessage("Mettre la raison de la maintenance");
                }
            } else if ($args[0] === "off"){
                $sender->getServer()->getConfigGroup()->setConfigBool("white-list", false);
                $sender->sendMessage("Le serveur n'est désormé plus en maintenance");
            } else {
                $sender->sendMessage("/maintenance [on|off]");
            }
        } else {
            $sender->sendMessage("/maintenance [on|off]");
        }

    }
    private function kickNonWhitelistedPlayers(Server $server, string $reason) : void{
        $message = "§7================================\n                    §9Cristélia\n                 §bMaintenance\n" . $reason . "\n§7================================";
        foreach($server->getOnlinePlayers() as $player){
            if(!$server->isWhitelisted($player->getName())){
                $player->kick($message);
            }
        }
    }

    public function testPermissionSilent(CommandSender $target, ?string $permission = null): bool{
        return parent::testPermissionSilent($target, $permission) || $target instanceof ConsoleCommandSender;
    }

}