<?php

namespace nouma\cristelia\listeners;

use DaPigGuy\PiggyFactions\PiggyFactions;
use nouma\cristelia\Main;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\server\DataPacketSendEvent;
use pocketmine\network\mcpe\protocol\SetTimePacket;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\world\World;

class DayzoneListener implements Listener
{

    private array $players;

    public function __construct()
    {
        $this->players = [];
    }

    private function addPlayer(Player $player) {
        if (in_array($player, $this->players)) return;
        $this->players[] = $player;
        $this->updateTime($player);
    }

    private function removePlayer(Player $player) {
        $this->players = array_filter($this->players, static function ($element) use ($player) {
            return $element !== $player;
        });
        $this->updateTime($player);
    }

    private function updateTime(Player $player) {
        if (in_array($player, $this->players)) {
            $time = 6000;
        } else {
            $time = $player->getWorld()->getTime();
        }
        $player->getNetworkSession()->sendDataPacket(SetTimePacket::create($time));
    }

    public function onChunkChange(PlayerMoveEvent $event): void
    {
        $player = $event->getPlayer();
        $member = PiggyFactions::getInstance()->getPlayerManager()->getPlayer($player);
        if ($member == null) return;

        $claim = PiggyFactions::getInstance()->getClaimsManager()->getClaimByPosition($event->getTo());
        if ($claim == null) {
            if (in_array($player, $this->players))
                $this->removePlayer($player);
            return;
        }

        $faction = $claim->getFaction();

        if ($faction->getFlag('safezone')) {
            $this->addPlayer($player);
        } else if (in_array($player, $this->players)) {
            $this->removePlayer($player);
        }
    }

    public function onPacketSend(DataPacketSendEvent $event): void
    {
        foreach ($event->getPackets() as $packet) {
            if ($packet instanceof SetTimePacket) {
                if (in_array($event->getTargets()[0]->getPlayer(), $this->players)) $packet->time = 6000;
            }
        }
    }
}