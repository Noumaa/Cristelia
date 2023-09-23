<?php

namespace nouma\Cristelia\Registers;

use customiesdevs\customies\item\CustomiesItemFactory;
use nouma\Cristelia\Customies\Items\Ruby\Ruby;
use nouma\Cristelia\Customies\Items\Ruby\RubyAxe;
use nouma\Cristelia\Customies\Items\Ruby\RubyPickaxe;

class ItemsRegisters {
    public function __construct() {
        CustomiesItemFactory::getInstance()->registerItem(Ruby::class, "cristelia:ruby", "Ruby");
        CustomiesItemFactory::getInstance()->registerItem(RubyAxe::class, "cristelia:ruby_axe", "Ruby Axe");
        CustomiesItemFactory::getInstance()->registerItem(RubyPickaxe::class, "cristelia:ruby_pickaxe", "Ruby Pickaxe");
    }
}