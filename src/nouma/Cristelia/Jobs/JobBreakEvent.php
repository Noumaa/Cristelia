<?php

namespace nouma\Cristelia\Jobs;

use nouma\Cristelia\BossBar\BossBarAPI;
use nouma\Cristelia\Main;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\scheduler\Task;

class JobBreakEvent implements Listener {
    private array $lastBreak = [];

    public function onBlockBreak(BlockBreakEvent $e) {
        $player = $e->getPlayer();
        $blockName = $e->getBlock()->getName();

        $config = Main::getInstance()->getConfig();

        if ($config->getNested("jobs.mineur.BREAK.$blockName") != null) {
            $expToAdd = (int) $config->getNested("jobs.mineur.BREAK.$blockName");

            $playerJob = new JobPlayer($player);
            $playerJob->addExperience('mineur', $expToAdd);

            $exp = $playerJob->getExperience('mineur');
            $maxExp = $playerJob->getMaximumExperience('mineur');
            $level = $playerJob->getLevel('mineur');

            BossBarAPI::getInstance()->sendBossBar(
                $player,
                "Mineur $exp/$maxExp (+$expToAdd)",
                0,
                $exp / $maxExp
            );

            if (key_exists($player->getName(), $this->lastBreak)) $this->lastBreak[$player->getName()]->cancel();

            $this->lastBreak[$player->getName()] = Main::getInstance()->getScheduler()->scheduleDelayedTask(new class($player) extends Task {

                private Player $player;

                public function __construct(Player $player) {
                    $this->player = $player;
                }

                public function onRun(): void {
                    BossBarAPI::getInstance()->hideBossBar($this->player);
                }
            }, 5*10);
        }
    }
}