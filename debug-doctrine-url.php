<?php
require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
// Charge le fichier .env.test et force APP_ENV à "test"
$dotenv->loadEnv(__DIR__.'/.env.test', 'test');

echo "APP_ENV = " . getenv('APP_ENV') . PHP_EOL;
echo "DATABASE_URL = " . getenv('DATABASE_URL') . PHP_EOL;