<?php

namespace KillEffects;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;

use pocketmine\player\Player;

use pocketmine\entity\effect\VanillaEffects;
use pocketmine\entity\effect\EffectInstance;

class Main extends PluginBase implements Listener {

    public function onEnable() : void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);

        $this->getLogger()->info("KillEffects Enabled!");
    }

    public function onDeath(PlayerDeathEvent $event) : void {

        $victim = $event->getPlayer();
        $cause = $victim->getLastDamageCause();

        if($cause instanceof EntityDamageByEntityEvent){

            $killer = $cause->getDamager();

            if($killer instanceof Player){

                // SPEED II FOR 10 SECONDS
                $killer->getEffects()->add(
                    new EffectInstance(
                        VanillaEffects::SPEED(),
                        20 * 10,
                        1
                    )
                );

                // REGENERATION I FOR 5 SECONDS
                $killer->getEffects()->add(
                    new EffectInstance(
                        VanillaEffects::REGENERATION(),
                        20 * 5,
                        0
                    )
                );

                // MESSAGE
                $killer->sendMessage("§a+ Kill Effect Activated!");

            }
        }
    }
}
