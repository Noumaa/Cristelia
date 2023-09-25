<?php

namespace nouma\cristelia\listeners;

use Jibix\Forms\form\type\MenuForm;
use Jibix\Forms\menu\Button;
use Jibix\Forms\menu\type\CloseButton;
use pocketmine\block\VanillaBlocks;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\SharpnessEnchantment;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\item\Item;
use pocketmine\item\Sword;

class EnchantsListener implements Listener
{

    public function onRightClickOnEnchantingTable(PlayerInteractEvent $event) {
        $player = $event->getPlayer();
        $block = $event->getBlock();
        $item = $player->getInventory()->getItemInHand();

        if ($block->getTypeId() != VanillaBlocks::ENCHANTING_TABLE()->getTypeId()) return;
        $event->cancel();

        $buttons = [new CloseButton("§cFermer")];

        if ($item instanceof Sword) {
            $sharpness = $item->getEnchantmentLevel(VanillaEnchantments::SHARPNESS()) + 1;
            $unbreaking = $item->getEnchantmentLevel(VanillaEnchantments::UNBREAKING()) + 1;
            $fire_aspect = $item->getEnchantmentLevel(VanillaEnchantments::FIRE_ASPECT()) + 1;
            
            $buttons[] = new Button("§eTranchant $sharpness §r- §e" . $sharpness * 8 . " niveaux");
            $buttons[] = new Button("§eSolidité $unbreaking §r- §e" . $unbreaking * 8 . " niveaux");
            $buttons[] = new Button("§eAura de feu $fire_aspect §r- §e" . $fire_aspect * 8 . " niveaux");
        } else {
            $player->sendMessage("§cVotre item ne peut pas être enchanté !");
            return;
        }

        $form = new MenuForm("Table d'enchantement", "Enchantez votre {$item->getName()}", $buttons);
        $player->sendForm($form);
    }
}