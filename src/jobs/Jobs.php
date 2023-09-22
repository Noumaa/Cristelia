<?php

namespace nouma\cristelia\jobs;

use Jibix\Forms\form\Form;
use Jibix\Forms\form\type\MenuForm;
use Jibix\Forms\menu\Button;
use Jibix\Forms\menu\Image;
use Jibix\Forms\menu\type\BackButton;
use Jibix\Forms\menu\type\CloseButton;
use pocketmine\player\Player;

class Jobs
{
    public static function home() : Form
    {
        $onSubmit = function (Player $player, Button $selected) {
            $player->sendForm(self::detail($selected->getText(), $player));
        };

        return new MenuForm("Métiers", "", [
            new Button("Mineur", $onSubmit, Image::path("textures/items/iron_pickaxe.png")),
            new Button("Farmer", $onSubmit, Image::path("textures/items/iron_hoe.png")),
            new Button("Hunter", $onSubmit, Image::path("textures/items/leather.png")),
            new Button("Alchimiste", $onSubmit, Image::detect("textures/items/blaze_rod.png")),
            new CloseButton('§cFermer')
        ]);
    }

    public static function detail(string $jobName, Player $player) : Form
    {
        $playerJob = new PlayerJob($player);

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
}