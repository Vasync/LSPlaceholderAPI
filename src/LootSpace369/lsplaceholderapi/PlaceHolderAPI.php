<?php

declare(strict_types=1);

namespace LootSpace369\lsplaceholderapi;

use pocketmine\plugin\PluginBase;

class PlaceHolderAPI {
    
    private static array $placeholder = [];
    
    /**
     * @param Config $cfg
     */
    public static function init(PluginBase $plugin): void {
        $plugin->getServer()->getPluginManager()->registerEvents(new EventListener(), $plugin);
    }
    
    /**
     * @param string|int $placeholder
     * @param string|int $replace
     */
    public static function register(string|int $placeholder, string|int $replace): void {
        self::$placeholder[$placeholder] = $replace;
    }
    
    /**
     * @param string|int $str
     */
    public static function replace(string|int $str): string {
        
        if (is_numeric($str)) {
            $str = (string)$str;
        }
        
        foreach (self::$placeholder as $find => $replace) {
            $str = str_replace($find, $replace, $str);
        }
        return $str;
    }
}