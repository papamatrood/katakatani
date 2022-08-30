<?php

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
$katakatani = new Katakatani();

if (!empty($_POST)) {
    $katakatani
        ->setMatricule($_POST['matricule'])
        ->setPrixAchat((int) $_POST['prix_achat'])
        ->setAcheterAt($_POST['acheter_at']);
    $v = new KatakataniValidator($_POST);
    if($v->validate()) {
        $id = (new TableKatakatani())->create($_POST);
        header("Location: " . $router->url('home_katakatani') . '?created=' . $id);
    } else {
        $errors = $v->errors();
    }
}

$form = new Form($errors, $katakatani);

?>

<h3>Ajouter un katakatani</h3>
<br>
<?php if(!empty($errors)): ?>
    <div class="alert alert-danger">
        Veuillez corriger les erreurs !!!
    </div>
<?php endif; ?>
<br>

<form method="post">
    <?= $form->input('matricule', 'Matricule') ?>
    <?= $form->input('prix_achat', 'Prix d\'achat') ?>
    <?= $form->input('acheter_at', 'Date d\'achat') ?>
    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>
