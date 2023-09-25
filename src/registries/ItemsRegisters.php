<?php

namespace nouma\cristelia\registries;

use customiesdevs\customies\item\CustomiesItemFactory;
use nouma\cristelia\items\DiamondUnclaimFinder;
use nouma\cristelia\items\ruby\Ruby;
use nouma\cristelia\items\ruby\RubyAxe;
use nouma\cristelia\items\ruby\RubyHammer;
use nouma\cristelia\items\ruby\RubyPickaxe;
use nouma\cristelia\items\ruby\RubyShovel;
use nouma\cristelia\items\ruby\RubySword;

class ItemsRegisters {

    public static function registerAll(): void
    {
        CustomiesItemFactory::getInstance()->registerItem(Ruby::class, "cristelia:ruby", "Ruby");
        CustomiesItemFactory::getInstance()->registerItem(RubyAxe::class, "cristelia:ruby_axe", "Ruby Axe");
        CustomiesItemFactory::getInstance()->registerItem(RubyHammer::class, "cristelia:ruby_hammer", "Ruby Hammer");
        CustomiesItemFactory::getInstance()->registerItem(RubyPickaxe::class, "cristelia:ruby_pickaxe", "Ruby Pickaxe");
        CustomiesItemFactory::getInstance()->registerItem(RubyShovel::class, "cristelia:ruby_shovel", "Ruby Shovel");
        CustomiesItemFactory::getInstance()->registerItem(RubySword::class, "cristelia:ruby_sword", "Ruby Sword");

        CustomiesItemFactory::getInstance()->registerItem(DiamondUnclaimFinder::class, "cristelia:diamond_unclaim_finder", "Diamond Unclaim Finder");
    }
}