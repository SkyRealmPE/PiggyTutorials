<?php

namespace PiggyTutorials\Commands;

use PiggyTutorials\Main;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class TutorialCommand extends PluginCommand
{
    public function __construct(string $name, Main $plugin)
    {
        parent::__construct($name, $plugin);
        $this->setDescription("Go through the tutorial");
        $this->setUsage("/tutorial");
        $this->setPermission("piggytutorials.command.tutorial");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (!$this->testPermission($sender)) {
            return false;
        }
        $plugin = $this->getPlugin();
        if ($plugin instanceof Main) {
            if ($sender instanceof Player) {
                if (!$plugin->isInTutorialMode($sender)) {
                    $plugin->startTutorial($sender);
                    return true;
                }
                $sender->sendMessage(TextFormat::RED . "You are already in the tutorial.");
                return false;
            }
            $sender->sendMessage(TextFormat::RED . "Use this in-game.");
            return false;
        }
        return false;
    }
}