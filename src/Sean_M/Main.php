<?php
namespace Sean_M\DeathPopup;

use pocketmine\Player;
use pocketmine\event\player\PlayerDeathEvent;

class Main extends PluginBase implements Listener{
  
  public function onEnable(){      
    $this->getServer()->getPluginManager()->registerEvents($this);
    $this->getLogger()->info("DeathPopup enabled!");
  }
