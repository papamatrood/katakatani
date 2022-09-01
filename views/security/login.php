<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!empty($_SESSION['login'])) {
    header("Location: " . $router->url('home_katakatani'));
    exit();
}

use App\HTML\Form;
use App\Classes\Users;
use App\Table\TableUsers;

$user = new Users();

$errors = [];

$form = new Form($errors, $user);

if (!empty($_POST)) {
    $user
        ->setUsername($_POST['username']);
    $u = (new TableUsers())->findByUsername($_POST['username']);
    if($u === false) {
        $errors['username'] = 'Identifiant ou mot de passe incorrect !';
        header("Location: " . $router->url('login') . '?alert=1');
        exit;
    }else {
        if (password_verify($_POST['password'], $u->getPassword()) === false) {
            $errors['username'] = 'Identifiant ou mot de passe incorrect !';
            header("Location: " . $router->url('login') . '?alert=1');
            exit;
        }else {
            $_SESSION['login'] = 1;
            header("Location: " . $router->url('home'));
            exit();
        }
    }
}

?>

<h3>Se connecter</h3>
<br>

<?php if(isset($_GET['alert'])) : ?>
    <div class="alert alert-danger"><?= 'Identifiant ou mot de passe incorrect !' ?></div>
<?php endif; ?>

<form action="" method="post">
    <?= $form->input('username', 'Nom d\'utilisateur') ?>
    <?= $form->input('password', 'Mot de passe') ?>
    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>