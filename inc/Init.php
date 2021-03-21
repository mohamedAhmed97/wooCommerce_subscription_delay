<?php

namespace Inc;

final class Init
{
    public static function getServices()
    {
        return [
            classes\front\templates\Assetes::class,
            classes\front\templates\DelayButton::class,
        ];
    }
    public static function registerServices()
    {
        foreach (self::getServices()  as $class) {
            $service = self::getInstance($class);
            if (method_exists($service, 'register')) {
                $service->register();
            }
        }
    }
    private static function getInstance($class)
    {
        $instance = new $class();
        return $instance;
    }
}
