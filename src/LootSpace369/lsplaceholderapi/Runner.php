<?php

declare(strict_types=1);

namespace LootSpace369\lsplaceholderapi;

class Runner extends \pocketmine\plugin\PluginBase {

    public function onEnable(): void {
        $this->getLogger()->notice("LSPlaceHolderAPIThinText has onEnable!");
        $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
    }
}
