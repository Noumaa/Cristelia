<?php

namespace nouma\Cristelia\Entities;

use pocketmine\entity\EntitySizeInfo;
use pocketmine\entity\Living;

class RubyGolem extends Living {

    public static function getNetworkTypeId(): string {
        return "cristelia:ruby_golem";
    }

    protected function getInitialSizeInfo(): EntitySizeInfo {
        return new EntitySizeInfo(1.8, 0.6);
    }

    public function getName(): string {
        return "Ruby Golem";
    }
}