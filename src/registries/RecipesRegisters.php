<?php

namespace nouma\cristelia\registries;

use nouma\cristelia\blocks\RubyBlock;
use nouma\cristelia\items\DiamondUnclaimFinder;
use nouma\cristelia\items\EmeraldSword;
use nouma\cristelia\items\ruby\RubyAxe;
use nouma\cristelia\items\ruby\RubyHammer;
use nouma\cristelia\items\ruby\RubyPickaxe;
use nouma\cristelia\items\ruby\RubyShovel;
use nouma\cristelia\items\ruby\RubySword;

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