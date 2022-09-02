<?php
$id = $params['id'];

use App\Auth;
use App\HTML\Form;
use App\Classes\Katakatani;
use App\Table\TableKatakatani;
use App\Validator\KatakataniValidator;

Auth::check();

$errors = [];

/**
 * @var Katakatani
 */
$katakatani = (new TableKatakatani())->find($id);

if (!empty($_POST)) {
    $katakatani
        ->setNumero($_POST['numero'])
        ->setMatricule($_POST['matricule'])
        ->setPrixAchat((int) $_POST['prix_achat'])
        ->setAcheterAt($_POST['acheter_at']);
    $v = new KatakataniValidator($_POST);
    if($v->validate()) {
        $id = (new TableKatakatani())->update($_POST, $id);
        header("Location: " . $router->url('home_katakatani') . '?edited=' . $id);
    } else {
        $errors = $v->errors();
    }
}

$form = new Form($errors, $katakatani);

?>

<form method="post">
    <?= $form->input('numero', 'Numero') ?>
    <?= $form->input('matricule', 'Matricule') ?>
    <?= $form->input('prix_achat', 'Prix d\'achat') ?>
    <?= $form->input('acheter_at', 'Date d\'achat') ?>
    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>
