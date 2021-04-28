<?php

$connection  = pg_connect('host=localhost port=5432 dbname=haudi user=postgres password=password');
session_start();

if (!$connection) {
    echo 'Не удалось подключиться к бд';
    exit(); 
}