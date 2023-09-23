<?php

namespace nouma\Cristelia\Jobs;

use Jibix\Forms\form\Form;
use Jibix\Forms\form\type\MenuForm;
use Jibix\Forms\menu\Button;
use Jibix\Forms\menu\Image;
use Jibix\Forms\menu\type\BackButton;
use Jibix\Forms\menu\type\CloseButton;
use nouma\Cristelia\Permission\Permissions;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class Jobs extends Command{

    public function __construct() {
        parent::__construct("jobs", "Permet de avoir les items, Blocks est entity Moddés du serveur");
        $this->setPermission(Permissions::JOBS);
    }
    public static function home() : Form {
        $onSubmit = function (Player $player, Button $selected) {
            $player->sendForm(self::detail($selected->getText(), $player));
        };

        return new MenuForm("Métiers", "", [
            new Button("Miner", $onSubmit, Image::path("textures/items/iron_pickaxe.png")),
            new Button("Farmer", $onSubmit, Image::path("textures/items/iron_hoe.png")),
            new Button("Hunter", $onSubmit, Image::path("textures/items/leather.png")),
            new Button("Alchimiste", $onSubmit, Image::detect("textures/items/blaze_rod.png")),
            new CloseButton('§cFermer')
        ]);
    }

    public static function detail(string $jobName, Player $player) : Form {
        $playerJob = new JobPlayer($player);

        $level = $playerJob->getLevel($jobName);
        $exp = $playerJob->getExperience($jobName);
        $maxExp = $playerJob->getMaximumExperience($jobName);

        return new MenuForm("Métiers", $jobName.' niveau '. $level, [
            new Button("Niveau d'expérience {$exp}/{$maxExp}"),
            new Button("Prochaine récompense : des trucs"),
            new Button("Récompenses"),
            new BackButton(),
        ]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
       if ($sender instanceof Player){
           $sender->sendForm(Jobs::home());
       }
    }
}