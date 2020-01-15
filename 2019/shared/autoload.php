<?php declare(strict_types=1);
spl_autoload_register(
    static function ($classname) {
        /** @noinspection PhpIncludeInspection */
        require_once sprintf('%s/%s.php', __DIR__, str_replace('\\', DIRECTORY_SEPARATOR, $classname));
    }
);
