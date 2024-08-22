<?php

declare(strict_types=1);

namespace LootSpace369\lsplaceholderapi;

use LootSpace369\lsplaceholderapi\PlaceHolderAPI;
use pocketmine\event\Listener;
use pocketmine\event\player\{
    PlayerJoinEvent,
    PlayerQuitEvent
};
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
                    
                    if (isset($formData["title"])) $formData["title"] = PlaceHolderAPI::replace($formData["title"]);
                    if (!is_array($formData["content"])) {
                        if (isset($formData["content"])) $formData["content"] = PlaceHolderAPI::replace($formData["content"]);
                    }else{
                        foreach ($formData["content"] as $content => $value) if (isset($formData["content"][$content]["text"])) $formData["content"][$content]["text"] = PlaceHolderAPI::replace($formData["content"][$content]["text"]);
                    }
                    if (isset($formData["buttons"])) {
                        foreach ($formData["buttons"] as $button => $value) if (isset($formData["buttons"][$button]["text"])) $formData["buttons"][$button]["text"] = PlaceHolderAPI::replace($formData["buttons"][$button]["text"]);
                    }
                    if (isset($formData["button1"])) $formData["button1"] = PlaceHolderAPI::replace($formData["button1"]);
                    if (isset($formData["button2"])) $formData["button2"] = PlaceHolderAPI::replace($formData["button2"]);
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

    /**
     * @param PlayerQuitEvent $event
     */
    public function onPlayerQuit(PlayerQuitEvent $event): void {
        if (!$event->getQuitMessage() instanceof Translatable) {
            $event->setQuitMessage(PlaceHolderAPI::replace($event->getQuitMessage()));
        }
    }
}
