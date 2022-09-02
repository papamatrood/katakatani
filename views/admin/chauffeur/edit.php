<?php
$id = $params['id'];

use App\Auth;
use App\HTML\Form;
use App\Classes\Chauffeur;
use App\Table\TableChauffeur;
use App\Table\TableKatakatani;
use App\Validator\ChauffeurValidator;

Auth::check();

$errors = [];

/**
 * @var Chauffeur
 */
$chauffeur = (new TableChauffeur())->find($id);

$katakatanis = (new TableKatakatani())->allIdsNumeros();

if (!empty($_POST)) {
    $chauffeur
        ->setPrenom($_POST['prenom'])
        ->setNom($_POST['nom'])
        ->setAdresse($_POST['adresse'])
        ->setTelephone1(replaceSpaceInNumber($_POST['telephone1']))
        ->setTelephone2(replaceSpaceInNumber($_POST['telephone2']))
        ->setDebutAt((int) $_POST['debut_at'])
        ->setFinAt($_POST['fin_at'])
        ->setKatakataniId($_POST['katakatani_id']);
    $v = new ChauffeurValidator($_POST);
    if($v->validate()) {
        $id = (new TableChauffeur())->update($_POST, $id);
        header("Location: " . $router->url('home_chauffeur') . '?edited=' . $id);
    } else {
        $errors = $v->errors();
    }
}

$form = new Form($errors, $chauffeur);

?>

<form method="post">
    <div class="row">
        <div class="col">
            <?= $form->input('prenom', 'Prénom') ?>
            <?= $form->input('adresse', 'Adresse') ?>
            <?= $form->input('telephone1', 'Téléphone 1') ?>
            <?= $form->input('telephone2', 'Téléphone 2') ?>
        </div>
        <div class="col">
            <?= $form->input('nom', 'Nom') ?>
            <?= $form->input('debut_at', 'Date de début') ?>
            <?= $form->input('fin_at', 'Date de Fin') ?>
            <?= $form->select('katakatani_id', 'Katakatani N°', $katakatanis) ?>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Éditer</button>
</form>