<?php

namespace nouma\Cristelia\Registers;

use nouma\Cristelia\Customies\Items\Ruby\RubyAxe;

class RecipesRegisters {
    public function __construct() {
        RubyBlock::registerRecipes($this);

        RubySword::registerRecipes($this);
        RubyPickaxe::registerRecipes($this);
        RubyAxe::registerRecipes($this);
        RubyShovel::registerRecipes($this);
        RubyHammer::registerRecipes($this);
        EmeraldSword::registerRecipes($this);

        DiamondUnclaimFinder::registerRecipes($this);
    }
}