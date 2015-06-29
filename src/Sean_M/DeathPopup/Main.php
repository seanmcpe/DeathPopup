<?php
namespace Sean_M\DeathPopup;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByBlockEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;

class Main extends PluginBase implements Listener{
  
  public function onEnable(){      
    $this->getServer()->getPluginManager()->registerEvents($this);
    $this->getLogger()->info("DeathPopup enabled!");
  }
    
  public function onDisable(){
    $this->getLogger()->info("DeathPopup disabled!");
  }

  public function onPlayerDeath(PlayerDeathEvent $event){
  $p = $event->getPlayer();
  $causeId = $p->getLastDamageCause()->getCause();
  $cause = $p->getLastDamageCause();
  switch($causeId){
    case EntityDamageEvent::CAUSE_DROWNING:
      $p->sendPopup("§6§lYou drowned!");
      break;
    case EntityDamageEvent::CAUSE_FALL:
      $p->sendPopup("§6§lYou fell from a high place!");
      break;
    case EntityDamageEvent::CAUSE_LAVA:
      $p->sendPopup("§6§lYou tried to swim in lava!");
      break;
    case EntityDamageEvent::CAUSE_FIRE:
      $p->sendPopup("§6§lYou burned to death!");
      break;
    case EntityDamageEvent::CAUSE_FIRE_TICK:
      $p->sendPopup("§6§lYou burned to death!");
      break;
    case EntityDamageEvent::CAUSE_SUICIDE:
      $p->sendPopup("§6§lYou died!");
      break;
    case EntityDamageEvent::CAUSE_CONTACT:
	if($cause instanceof EntityDamageByBlockEvent){
	        if($cause->getDamager()->getId() === Block::CACTUS){
		       $p->sendPopup("§6§lYou have been pricked to death!");
		}
	}
      break;
    case EntityDamageEvent::CAUSE_PROJECTILE:
	if($cause instanceof EntityDamageByEntityEvent){
            $e = $cause->getDamager();
		if($e instanceof Living){
			$p->sendPopup("§6§lYou were shot by §a{$e->getName()}§6!");
                        if($e instanceof Player) $e->sendMessage("§6§lYou shot §a{$p->getName()}§6!");
		}else{
			  $p->sendPopup("§6§lAn §o§aunknown force §r§l§6has shot you!");
                }
        }
      break;
    case EntityDamageEvent::CAUSE_ENTITY_ATTACK:
        if($cause instanceof EntityDamageByEntityEvent){
                if($e instanceof Living){
                        $p->sendPopup("§6§lYou were slain by §6{$e->getName()}§a!");
                        if($e instanceof Player) $e->sendPopup("§6§lYou slayed §a{$p->getName()}§6!");
                }else{
                          $p->sendPopup("§6§lAn §o§aunknown force §r§l§6has slain you!");
                        }
		}
	}
	break;		
  }
 }
