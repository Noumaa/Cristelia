<?php

namespace nouma\cristelia\permissions;

use pocketmine\permission\Permission;
use pocketmine\permission\PermissionManager as PMPermissionManager;

class PermissionManager {

    public static function init() : void {
        $permissionManager = PMPermissionManager::getInstance();
        $permissionManager->addPermission(new Permission(Permissions::MAINTENANCE));
        $permissionManager->addPermission(new Permission(Permissions::CRISTELIA));
        $permissionManager->addPermission(new Permission(Permissions::JOBS));
    }
}