<?php


namespace nouma\Cristelia\Registers;

use customiesdevs\customies\block\CustomiesBlockFactory;
use customiesdevs\customies\block\Material;
use customiesdevs\customies\block\Model;
use nouma\Cristelia\blocks\RubyBlock;
use nouma\Cristelia\blocks\RubyOre;
use pocketmine\math\Vector3;

class BlocksRegisters {
    public function __construct() {
        $material = new Material(Material::TARGET_ALL, "ruby_ore", Material::RENDER_METHOD_BLEND);
        $model = new Model([$material], "geometry.ruby_ore", new Vector3(-8, 0, -8), new Vector3(16, 16, 16));
        CustomiesBlockFactory::getInstance()->registerBlock(static fn() => new RubyOre(), "cristelia:ruby_ore", $model);

        $material = new Material(Material::TARGET_ALL, "ruby_block", Material::RENDER_METHOD_ALPHA_TEST);
        $model = new Model([$material], "geometry.ruby_ore", new Vector3(-8, 0, -8), new Vector3(16, 16, 16));
        CustomiesBlockFactory::getInstance()->registerBlock(static fn() => new RubyBlock(), "cristelia:ruby_block", $model);
    }
}