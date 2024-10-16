<?php
require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
// CONNECTION 

// new PDO crée une instance de la classe PDO pour établir une connexion à la base de données. 
//infos récupérées depuis le fichier .env 
//infos sensiplbles non présents dans le code

try {
    $dbCo = new PDO(
        'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';charset=utf8',
        $_ENV['DB_USER'],
        $_ENV['DB_PWD']
    );
    $dbCo->setAttribute(
        PDO::ATTR_DEFAULT_FETCH_MODE,
        PDO::FETCH_ASSOC
    );
} catch (EXCEPTION $error) {
    die('Échec de la connexion à la base de donnée.' . $error->getMessage());
}return $dbCo;

