<?php

namespace nouma\Cristelia\Jobs;

use JsonException;
use nouma\Cristelia\Main;
use pocketmine\player\Player;
use pocketmine\utils\Config;

class JobPlayer {
    private Player $player;
    private Config $config;

    public function __construct(Player $player) {
        $playerName = $player->getName();

        $this->player = $player;
        $this->config = new Config(Main::getInstance()->getDataFolder() . "players/" . strtolower($playerName) . ".yml", Config::YAML);
    }

    public function getLevel(string $jobName): int {
        return $this->config->getNested(strtolower($jobName).'.level', 0);
    }

    public function getExperience(string $jobName): int {
        return $this->config->getNested(strtolower($jobName).'.exp', 0);
    }

    public function getMaximumExperience(string $jobName): int {
        return ($this->getLevel($jobName) + 1) * ($this->getLevel($jobName) + 1) * 40;
    }

    public function setLevel(string $jobName, int $level): void {
        $this->config->setNested(strtolower($jobName).'.level', $level);
    }

    /**
     * @throws JsonException
     */
    public function setExperience(string $jobName, int $exp): void {
        $this->config->setNested(strtolower($jobName).'.exp', $exp);
    }

    /**
     * @throws JsonException
     */
    public function addExperience(string $jobName, int $exp): void {
        $actualExp = $this->getExperience($jobName);
        $actualLevel = $this->getLevel($jobName);
        $actualMaxExp = $this->getMaximumExperience($jobName);

        if ($exp + $actualExp < $actualMaxExp) {
            $this->setExperience(strtolower($jobName), $this->getExperience($jobName) + $exp);
            $this->save();
            return;
        }

        $this->setLevel($jobName, ++$actualLevel);

        $difference = $actualMaxExp - $actualExp;

        $this->setExperience($jobName, 0);
        $this->addExperience($jobName, $exp - $difference);
        $this->save();

        $this->player->sendMessage("Vous êtes maintenant niveau {$this->getLevel($jobName)} dans le métier $jobName");
    }

    /**
     * @throws JsonException
     */
    public function save(): void {
        $this->config->save();
    }
}