<?php
namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Unit extends \Codeception\Module
{

    /**
     * @return array|mixed
     */
    public static function getConfigLocal(): array
    {
        if (is_file(__DIR__ . '/../../../config.php')) {
            return include __DIR__ . '/../../../config.php';
        }

        return [];
    }
}
