<?php
namespace Sean_M\DeathPopup;

use pocketmine\Player;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByBlockEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;

class Main extends PluginBase implements Listener{
  
  public function onEnable(){      
    $this->getServer()->getPluginManager()->registerEvents($this);
    $this->getLogger()->info("DeathPopup enabled!");
  }
  public function onPlayerDeath(PlayerDeathEvent $event){
  $p = $event->getPlayer();
  $causeId = $p->getLastDamageCause()->getCause();
  $cause = $p->getLastDamageCause();
  switch($causeId){
    case EntityDamageEvent::CAUSE_DROWNING:
      $p->sendPopup("You drowned!");
      break;
    case EntityDamageEvent::CAUSE_FALL:
      $p->sendPopup("You fell from a high place!");
      break;
    case EntityDamageEvent::CAUSE_LAVA:
      $p->sendPopup("You tried to swim in lava!");
      break;
    case EntityDamageEvent::CAUSE_FIRE:
      $p->sendPopup("You burned to death!");
      break;
    case EntityDamageEvent::CAUSE_FIRE_TICK:
      $p->sendPopup("You burned to death!");
      break;
    case EntityDamageEvent::CAUSE_SUICIDE:
      $p->sendPopup("You died!");
      break;
    case EntityDamageEvent::CAUSE_CONTACT:
	if($cause instanceof EntityDamageByBlockEvent){
	        if($cause->getDamager()->getId() === Block::CACTUS){
		       $p->sendPopup("You got pricked to death!");
		}
	}
      break;
    case EntityDamageEvent::CAUSE_PROJECTILE:
	if($cause instanceof EntityDamageByEntityEvent){
            $e = $cause->getDamager();
		if($e instanceof Living){
			$p->sendPopup("You were shot by {$e->getName()}!");
                        if($e instanceof Player) $e->sendMessage("You shot {$p->getName()}!");
		}else{
			  $p->sendPopup("An unknown force has shot you!");
                }
        }
      break;
    case EntityDamageEvent::CAUSE_ENTITY_ATTACK:
        if($cause instanceof EntityDamageByEntityEvent){
                if($e instanceof Living){
                        $p->sendPopup("You were slain by {$e->getName()}!");
                        if($e instanceof Player) $e->sendPopup("You shot {$p->getName()}");
                }else{
                          $p->sendPopup("An unknown force has slain you!");
                        }
		}
	}
	break;		
  }
 }
}
