<?php

/* подключаем автозагрузчик классов */
require __DIR__.'/classes/Autoload.php';
spl_autoload_register(array('Autoload','Autoloader'));
session_start();

/* подключение ФРОНТконтроллера который   */
/* анализирует строку запроса и запускает */
/* нужный контроллер на выполнение        */
try {
    $fc = new FrontController;
    $fc->route();
} 
catch (MyException $e)
{
    $e->getException();
}