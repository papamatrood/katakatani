<?php
$id = $params['id'];

use App\Auth;
use App\HTML\Form;
use App\Classes\Comptabilite;
use App\Table\TableChauffeur;
use App\Table\TableComptabilite;
use App\Validator\ComptabiliteValidator;

Auth::check();

$errors = [];

/**
 * @var Comptabilite
 */
$comptabilite = (new TableComptabilite())->find($id);

$katakatanis = (new TableChauffeur())->allKatakataniIdName();

if (!empty($_POST)) {
    $comptabilite
        ->setMotif($_POST['motif'])
        ->setMontant($_POST['montant'])
        ->setDetails($_POST['details'])
        ->setDateAt((int) $_POST['date_at'])
        ->setKatakataniId($_POST['katakatani_id']);
    $v = new ComptabiliteValidator($_POST);
    if($v->validate()) {
        $id = (new TableComptabilite())->update($_POST, $id);
        header("Location: " . $router->url('home_comptabilite') . '?edited=' . $id);
    } else {
        $errors = $v->errors();
    }
}

$form = new Form($errors, $comptabilite);

?>

<form method="post">
    <div class="row">
        <div class="col">
            <?= $form->select('motif', 'Motif', MOTIFS) ?>
            <?= $form->textarea('details', 'Détails') ?>
        </div>
        <div class="col">
            <?= $form->input('montant', 'Montant') ?>
            <?= $form->select('katakatani_id', 'Katakatani N°', $katakatanis) ?>
            <?= $form->input('date_at', 'Date') ?>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Modifier</button>
</form>