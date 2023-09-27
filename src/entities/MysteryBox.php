<?php

namespace nouma\cristelia\entities;

use pocketmine\entity\EntitySizeInfo;
use pocketmine\entity\Living;

class MysteryBox extends Living
{

    public static function getNetworkTypeId(): string
    {
        return "cristelia:mystery_box";
    }

    protected function getInitialSizeInfo(): EntitySizeInfo
    {
        return new EntitySizeInfo(1.8, 0.6);
    }

    public function getName(): string
    {
        return "Mystery Box";
    }
}