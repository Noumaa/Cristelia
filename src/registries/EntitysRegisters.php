<?php


namespace nouma\cristelia\registries;

use customiesdevs\customies\entity\CustomiesEntityFactory;
use nouma\cristelia\entities\RubyGolem;

class EntitysRegisters {
    public function __construct(){
        CustomiesEntityFactory::getInstance()->registerEntity(RubyGolem::class, "cristelia:ruby_golem");
    }
}