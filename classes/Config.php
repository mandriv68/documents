<?php


class Config {
    private static $config = [];
    
    public static function getConfig() {
        self::$config = include __DIR__.'/../config.php';
        return self::$config;
    }
    
    public static function getDbConfig() {
        return self::getConfig()['db'];
    }
    
    public static function getReferenceConfig() {
        return self::getConfig()['reference'];
    }
    
    public static function getSectionsConfig() {
        return self::getConfig()['sections'];
    }
    
    public static function getDocConfig() {
        return self::getConfig()['documents'];
    }
    
    public static function getArchivesConfig() {
        return self::getConfig()['archives'];
    }
    
}
