<?php


namespace nouma\cristelia\registries;

use customiesdevs\customies\entity\CustomiesEntityFactory;
use nouma\cristelia\entities\MysteryBox;
use nouma\cristelia\entities\RubyGolem;

class EntitysRegisters {

    public static function registerAll()
    {
        CustomiesEntityFactory::getInstance()->registerEntity(RubyGolem::class, "cristelia:ruby_golem");
        CustomiesEntityFactory::getInstance()->registerEntity(MysteryBox::class, "cristelia:mystery_box");
    }
}