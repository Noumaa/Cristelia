<?php

namespace nouma\cristelia\permissions;

use pocketmine\permission\DefaultPermissionNames;
use pocketmine\permission\Permission;
use pocketmine\permission\PermissionManager as PMPermissionManager;
use pocketmine\permission\PermissionParser;

class Permissions {

    const MAINTENANCE = "maintenance.cmd";
    const CRISTELIA = "crestelia.cmd";
    const JOBS = "jobs.cmd";
    const HEAL_SELF = "cristelia.heal.self";
    const HEAL_OTHER = "cristelia.heal.other";

    public static function init() : void {
        $permissionManager = PMPermissionManager::getInstance();
        foreach ([
            self::MAINTENANCE,
            self::CRISTELIA,
            self::JOBS,
            self::HEAL_SELF,
            self::HEAL_OTHER,
        ] as $permissionName) {
            $root = $permissionManager::getInstance()->getPermission(DefaultPermissionNames::GROUP_OPERATOR);
            $permissionManager::getInstance()->addPermission(new Permission($permissionName));
            $root->addChild($permissionName, true);
        }
    }
}