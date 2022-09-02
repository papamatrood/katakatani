<?php

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
$chauffeur = new Chauffeur();

$katakatanis = (new TableKatakatani())->allIdsNumeros();

if (!empty($_POST)) {
    $chauffeur
        ->setPrenom($_POST['prenom'])
        ->setNom($_POST['nom'])
        ->setAdresse($_POST['adresse'])
        ->setTelephone1($_POST['telephone1'])
        ->setTelephone2($_POST['telephone2'])
        ->setDebutAt((int) $_POST['debut_at'])
        ->setFinAt($_POST['fin_at'])
        ->setKatakataniId($_POST['katakatani_id']);
    $v = new ChauffeurValidator($_POST);
    if ($v->validate()) {
        $id = (new TableChauffeur())->create($_POST);
        header("Location: " . $router->url('home_chauffeur') . '?created=' . $id);
    } else {
        $errors = $v->errors();
    }
}

$form = new Form($errors, $chauffeur);

?>

<br>

<h3>Ajouter un chauffeur</h3>
<?php if (!empty($errors)) : ?>
    <div class="alert alert-danger">
        Veuillez corriger les erreurs !!!
    </div>
<?php endif; ?>
<br>

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
    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>