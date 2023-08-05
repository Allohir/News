<?php
/* Пути по-умолчанию для поиска файлов */
set_include_path(get_include_path()
    . PATH_SEPARATOR .'application/controllers'
    .PATH_SEPARATOR.'application/models'
    .PATH_SEPARATOR.'application/views');

/* Имена файлов: views */
const NEWS_LIST_PAGE = 'news.php';
const NEWS_ADD_PAGE = 'add_news.php';
const NEWS_PROFILE_PAGE = "news_profile.php";
const NEWS_COMMENTS = "comments.php";
/* Текстовая база данных пользователей */
const DB_NAME = 'data/news.db';
/* Автозагрузчик классов */

spl_autoload_register(function ($class) {
    require_once $class.'.php';
});

/* Инициализация и запуск FrontController */
$front = FrontController::getInstance();
$front->route();

/* Вывод данных */
echo $front->getBody();
