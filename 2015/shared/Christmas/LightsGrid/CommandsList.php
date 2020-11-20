<?php declare(strict_types=1);

namespace Christmas\LightsGrid;

final class CommandsList
{
    public static function parse(array $commands)
    {
        $commandlist = [];
        foreach ($commands as $command) {
            $commandlist[] = Command::parse($command);
        }

        return $commandlist;
    }
}
