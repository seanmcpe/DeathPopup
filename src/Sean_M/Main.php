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

  $p = $event->getPlayer();
  $causeId = $p->getLastDamageCause()->getCause();
  switch($causeId){
    case EntityDamageEvent::CAUSE_DROWNING:
      $text = "You drowned!";
      break;
    case EntityDamageEvent::CAUSE_FALL:
      $text = "You fell from a high place!";
      break;
    case EntityDamageEvent::CAUSE_LAVA:
      $text = "You tried to swim in lava!";
      break;
    case EntityDamageEvent::CAUSE_FIRE:
      $text = "You burned to death!";
      break;
    case EntityDamageEvent::CAUSE_FIRE_TICK:
      $text = "You burned to death!";
      break;
    case EntityDamageEvent::CAUSE_SUICIDE:
      $text = "You died!"
      break;
    case EntityDamageEvent::CAUSE_CONTACT:
	if($cause instanceof EntityDamageByBlockEvent){
	        if($cause->getDamager()->getId() === Block::CACTUS){
		       $text = "You got pricked to death!";
		}
	}
      break;
    case EntityDamageEvent::CAUSE_PROJECTILE:
	if($cause instanceof EntityDamageByEntityEvent){
	$e = $cause->getDamager();
		if($e instanceof Living){
			$text = "You were shot by $params[]!";
			$params[] = $e->getName();
			break;
		        }else{
			$params[] = "Unknown";
      break;
    case EntityDamageEvent::CAUSE_ENTITY_ATTACK:
        if($cause instanceof EntityDamageByEntityEvent){
                if($e instanceof Living){
                        $text = "You were slain by $params[]!";
                        $param[] = $e->getName();
                        break;
                        }else{
                        $params[] = "Unknown";
		}
	}
	break;		
  }
  if(isset($text)) $p->sendPopup($text);
