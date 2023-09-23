<?php

namespace nouma\cristelia\registries;

use customiesdevs\customies\item\CustomiesItemFactory;
use nouma\cristelia\items\ruby\Ruby;
use nouma\cristelia\items\ruby\RubyAxe;
use nouma\cristelia\items\ruby\RubyPickaxe;

class ItemsRegisters {

    public static function registerAll(): void
    {
        CustomiesItemFactory::getInstance()->registerItem(Ruby::class, "cristelia:ruby", "Ruby");
        CustomiesItemFactory::getInstance()->registerItem(RubyAxe::class, "cristelia:ruby_axe", "Ruby Axe");
        CustomiesItemFactory::getInstance()->registerItem(RubyPickaxe::class, "cristelia:ruby_pickaxe", "Ruby Pickaxe");
    }
}