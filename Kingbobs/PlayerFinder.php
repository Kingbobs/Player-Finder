<?php

namespace Kingbobs;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;

class PlayerFinderPlugin extends PluginBase {

    public function onEnable() {
        $this->getLogger()->info("PlayerFinderPlugin enabled!");
    }

    public function onDisable() {
        $this->getLogger()->info("PlayerFinderPlugin disabled!");
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        if ($command->getName() === "findplayer") {
            if (!$sender instanceof Player) {
                $sender->sendMessage("This command can only be used in-game.");
                return true;
            }

            if (count($args) === 0) {
                $sender->sendMessage("Usage: /findplayer <player>");
                return true;
            }

            $playerName = $args[0];
            $player = $this->getServer()->getPlayerExact($playerName);

            if ($player instanceof Player) {
                $sender->sendMessage("Player $playerName is online!");
                $sender->teleport($player);
            } else {
                $sender->sendMessage("Player $playerName is not online.");
            }
            return true;
        }
        return false;
    }

}
