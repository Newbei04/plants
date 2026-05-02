<?php
$config['db_host']  = 'localhost';
$config['db_user']  = 'root';
$config['db_pass']  = '';
$config['db_name']  = 'mayuri_fitness';

foreach($config as $k => $v){
    define(strtoupper($k),$v);
}