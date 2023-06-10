<?php
require_once __DIR__.'/../vendor/autoload.php';  // Chemin vers autoload.php si vous utilisez Composer

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');  // Chemin vers le répertoire contenant le fichier .env
$dotenv->load();