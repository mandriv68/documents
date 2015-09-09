<?php


class Autoload {
    
    private static $className;
    private static $mapFiles = [];
    private static $path;

//
//    public function __construct($class) {
//        self::$className = $class;
//        self::$path = realpath(__DIR__.'/..');
//        self::$mapFiles = self::getMapFiles(self::$path);
//    }
    
    private static function getMapFiles() {
        $ext = 'php';
        $mapFiles = [];
        $directory = new RecursiveDirectoryIterator(__DIR__);
        foreach (new RecursiveIteratorIterator($directory) as $file) {
            if ($file->isFile()){
                if ($file->getExtension() != $ext) continue;
                $class = rtrim($file->getBasename($ext), '.');
                $fullPath = $file->getPathname();
                $mapFiles[$class] = $fullPath;
            }
        }
        return $mapFiles;
    }
    
    public static function prnt() {
        $mapFiles = self::getMapFiles();
        echo '<pre>';
        var_dump($mapFiles);
    }

    public static function Autoloader($className) {
        $mapFiles = self::getMapFiles();
        if (array_key_exists($className, $mapFiles)) {
            require_once $mapFiles[$className];
        }
    }
}
