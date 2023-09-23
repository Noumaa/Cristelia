<?php


namespace nouma\Cristelia\Registers;

use customiesdevs\customies\entity\CustomiesEntityFactory;
use nouma\Cristelia\entities\RubyGolem;

class EntitysRegisters {
    public function __construct(){
        CustomiesEntityFactory::getInstance()->registerEntity(RubyGolem::class, "cristelia:ruby_golem");
    }
}