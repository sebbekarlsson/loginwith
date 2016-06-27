<?php

$db = new PDO(
    'mysql:host='.
    $config['mysql_host'].
    ';dbname='.
    $config['mysql_dbname'].
    ';charset=utf8mb4',
    $config['mysql_username'],
    $config['mysql_password']
);
