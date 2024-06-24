<?php

require '../bootstrap.php';

//DBクラスの使い方

$db_manager = new DbManager();
$db_manager->connect('master', array(
    'dsn'       => 'mysql:dbname=online_bbs;host=localhost',
    'user'      => 'root',
    'password'  => '',
));
$db_manager->getConnection('master');
$db_manager->getConnection();