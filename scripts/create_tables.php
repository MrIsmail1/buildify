<?php

$host = 'localhost';
$db = 'mydatabase';
$user = 'myuser';
$pass = 'mypassword';

$dsn = "pgsql:host=$host;dbname=$db";
$pdo = new PDO($dsn, $user, $pass);

$sql = file_get_contents('create_tables.sql');

$pdo->exec($sql);
