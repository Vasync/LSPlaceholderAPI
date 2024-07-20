<?php

declare(strict_types=1);

namespace LootSpace369\lsplaceholderapi;

use LootSpace369\lsplaceholderapi\PlaceHolderAPI;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\entity\EntitySpawnEvent;
use pocketmine\event\server\DataPacketSendEvent;
use pocketmine\network\mcpe\protocol\TextPacket;
use pocketmine\network\mcpe\protocol\ModalFormRequestPacket;
use pocketmine\lang\Translatable;

class EventListener implements Listener {
    
    /**
    * @param DataPacketSendEvent $event
    */
    public function onDataPacketSend(DataPacketSendEvent $event): void {
        foreach ($event->getTargets() as $target) {
            foreach ($event->getPackets() as $packet) {
                if ($packet instanceof TextPacket) $packet->message = PlaceHolderAPI::replace($packet->message);
                if ($packet instanceof ModalFormRequestPacket) {
                    $formData = json_decode($packet->formData, true);
                    $fData = fn(string $str) => $formData[$str] = PlaceHolderAPI::replace($formData[$str]);
                    
                    if (isset($formData["title"])) $fData("title");
                    if (isset($formData["body"])) $fData("body");
                    if (isset($formData["button"])) $fData("button");
                    if (isset($formData["button1"])) $fData("button1");
                    if (isset($formData["button2"])) $fData("button2");
                    $packet->formData = json_encode($formData);
                }
            }
        }
    }

    /**
     * @param EntitySpawnEvent $event
     */
    public function onEntitySpawn(EntitySpawnEvent $event): void {
        $entity = $event->getEntity();
        $nameTag = $entity->getNameTag();
        $entity->setNameTag(PlaceHolderAPI::replace($nameTag));
    }

    /**
     * @param PlayerJoinEvent $event
     */
    public function onPlayerJoin(PlayerJoinEvent $event): void {
        if (!$event->getJoinMessage() instanceof Translatable) {
            $event->setJoinMessage(PlaceHolderAPI::replace($event->getJoinMessage()));
        }
    }
}
