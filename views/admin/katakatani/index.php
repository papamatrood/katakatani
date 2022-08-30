<?php

use App\Auth;
use App\Connection;
use App\Classes\Katakatani;

Auth::check();

$pdo = Connection::getPDO();

$query = $pdo->query("SELECT * FROM katakatani ORDER BY acheter_at DESC LIMIT 12");

/**
 * @var Katakatani[]
 */
$katakatanis = $query->fetchAll(PDO::FETCH_CLASS, Katakatani::class);

?>

<h3>Liste des katakatanis</h3>
<br>
<?php if(isset($_GET['created'])) : ?>
    <div class="alert alert-success">
        Un nouveau katakatani a été ajouté avec succès !
    </div>
<?php endif; ?>
<br>
<?php if(isset($_GET['edited'])) : ?>
    <div class="alert alert-success">
        Modification effectuée avec succès !
    </div>
<?php endif; ?>
<br>
<?php if(isset($_GET['delete'])) : ?>
    <div class="alert alert-success">
        Suppression effectuée avec succès !
    </div>
<?php endif; ?>
<br>

<table class="table table-striped table-hover table-bordered">
    <thead>
        <tr>
            <th>Matricle</th>
            <th>Prix d'achat</th>
            <th>Date d'achat</th>
            <th>
                <a href="<?= $router->url('add_katakatani') ?>" class="btn btn-primary">Ajouter</a>
            </th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        <?php foreach($katakatanis as $katakatani) : ?>
            <tr>
                <td><?= $katakatani->getMatricule() ?></td>
                <td><?= $katakatani->Prix() ?></td>
                <td><?= $katakatani->getAcheterAt()->format('Y-m-d') ?></td>
                <td>
                    <a href="<?=$router->url('edit_katakatani', ['id'=>$katakatani->getId()])?>" class="btn btn-primary">Éditer</a>
                    <form action="<?=$router->url('delete_katakatani', ['id'=>$katakatani->getId()])?>" method="post" onsubmit="return confirm('Êtes-vous sûr de la suppression ?')" style="display: inline-block;">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>