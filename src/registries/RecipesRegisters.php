<?php

namespace nouma\cristelia\registries;

use nouma\cristelia\blocks\RubyBlock;
use nouma\cristelia\items\DiamondUnclaimFinder;
use nouma\cristelia\items\ruby\RubyAxe;
use nouma\cristelia\items\ruby\RubyHammer;
use nouma\cristelia\items\ruby\RubyPickaxe;
use nouma\cristelia\items\ruby\RubyShovel;
use nouma\cristelia\items\ruby\RubySword;
use nouma\cristelia\Main;

class RecipesRegisters {

    public static function registerAll(Main $main): void
    {
        RubyBlock::registerRecipes($main);

        RubySword::registerRecipes($main);
        RubyPickaxe::registerRecipes($main);
        RubyAxe::registerRecipes($main);
        RubyShovel::registerRecipes($main);
        RubyHammer::registerRecipes($main);

        DiamondUnclaimFinder::registerRecipes($main);
    }
}