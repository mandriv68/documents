<?php

return array(
    /* конфигурация БД */
    'db' => [
        'dbname'   => 'documents',
        'host'     => 'localhost',
        'login'    => 'root',
        'password' => '',
        'charset'  => 'utf8',
    ],
    /* справочники - исп. для вывода меню */
    /* ключи повторяют имена таблиц БД    */
    /* с комментарием 'справочники'       */
    'reference' => [
        'emploees'      => ['fa fa-group'=>'сотрудники'],
        'posts'         => ['fa fa-male'=>'должности'],
        'company'       => ['fa fa-database'=>'контрагенты'],
        'bamcaccounts'  => ['fa fa-credit-card'=>'рассчётные счета'],
        'accountstatus' => ['fa fa-credit-card'=>'назначение счета'],
        'currency'      => ['fa fa-money'=>'валюты'],
        'banks'         => ['fa fa-bank'=>'банки'],
        'banksfilial'   => ['fa fa-bank'=>'филиалы банков'],
        'users'         => ['fa fa-user-secret'=>'пользователи'],
    ],
    /* секции */
    'sections' => [
        'reference' => ['fa fa-hdd-o'=>'справочники'],
        'doc'       => ['fa fa-file-text-o'=>'документы'],
        'archives'  => ['fa fa-file-archive-o'=>'архив документов'],
    ],
    /* докумены */
    'documents' => [
        'pob' => ['fa fa-file-text'=>'объявки'],
        'report' => ['fa fa-file-text'=>'отчёты по эл-ву'],
        'contracts' => ['fa fa-file-text'=>'договоры'],
        'letters' => ['fa fa-file-text'=>'письма'],
    ],
    
    /* архивы */
    'archives' => [
        'arcpob' => ['fa fa-archive'=>'объявки'],
        'arcreport' => ['fa fa-archive'=>'отчёты по эл-ву'],
        'arccontracts' => ['fa fa-archive'=>'договоры'],
        'arcletters' => ['fa fa-archive'=>'письма'],
    ],
);


