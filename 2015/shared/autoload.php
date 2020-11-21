<?php declare(strict_types=1);
require_once __DIR__.'/functions.php';
spl_autoload_register(
    static function ($classname) {
        $filename = sprintf('%s/%s.php', __DIR__, str_replace('\\', DIRECTORY_SEPARATOR, $classname));
        if (is_file($filename)) {
            /** @noinspection PhpIncludeInspection */
            /** @noinspection UsingInclusionReturnValueInspection */
            return require $filename;
        }
        return false;
    }
);
