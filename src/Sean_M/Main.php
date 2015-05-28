<?php
namespace Sean_M\DeathPopup;

use pocketmine\Player;
use pocketmine\event\player\PlayerDeathEvent;

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
  }
  if(isset($text)) $p->sendPopup($text);
