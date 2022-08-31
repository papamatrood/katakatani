<?php 
require 'vendor/autoload.php';

$pdo = new PDO('mysql:dbname=katakatani;host=localhost:3308', 'root', null,
[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
$pdo->exec("TRUNCATE TABLE katakatani");
$pdo->exec("TRUNCATE TABLE chauffeur");
$pdo->exec("TRUNCATE TABLE comptabilite");
$pdo->exec("SET FOREIGN_KEY_CHECKS = 1");

$faker = Faker\Factory::create('fr_FR');

$katakatani_ids = [];

for ($i=0; $i <3; $i++) { 
    $date = $faker->date() . ' ' . $faker->time();
    $pdo->exec("INSERT INTO katakatani SET matricule = '{$faker->ean13()}', acheter_at = '{$date}', prix_achat = '1185000'");
    $katakatani_ids[] = $pdo->lastInsertId();
}

for ($i=0; $i <3; $i++) { 
    $date = $faker->date() . ' ' . $faker->time();
    $prenom = $faker->firstName('male');
    $nom = $faker->lastName();
    $pdo->exec("INSERT INTO chauffeur SET prenom = '{$prenom}', nom = '{$nom}', adresse = '{$faker->address()}', telephone1 = '{$faker->phoneNumber()}', telephone2 = '{$faker->phoneNumber()}', debut_at = '{$date}', fin_at = NULL, katakatani_id = '{$katakatani_ids[$i]}'");
}

for ($i=0; $i <3; $i++) { 
    $motif = $i < 2 ? $i + 1 : 1;
    $date = $faker->date() . ' ' . $faker->time();
    $pdo->exec("INSERT INTO comptabilite SET motif = '{$motif}', date_at = '{$date}', montant = '15000', details = NULL, katakatani_id = '{$katakatani_ids[$i]}'");
}

$username = 'admin';
$password = password_hash('admin', PASSWORD_BCRYPT);
$role = 'administrateur';
$pdo->exec("INSERT INTO users SET username = '{$username}', password = '{$password}', roles = 'administrateur'");
