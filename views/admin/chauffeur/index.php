<?php

use App\Auth;
use App\Connection;
use App\Classes\Chauffeur;

Auth::check();

$pdo = Connection::getPDO();

$query = $pdo->query(
    "SELECT c.*
    FROM chauffeur c
    JOIN katakatani k ON c.katakatani_id = k.id
    LIMIT 12");

/**
 * @var Chauffeur[]
 */
$chauffeurs = $query->fetchAll(PDO::FETCH_CLASS, Chauffeur::class);

?>

<br>
<h3>Liste des chauffeurs</h3>
<?php if(isset($_GET['created'])) : ?>
    <div class="alert alert-success">
        Un nouveau chauffeur a été ajouté avec succès !
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
            <th>Katakani N°#</th>
            <th>Prénom & Nom</th>
            <th>Téléphone 1</th>
            <th>Téléphone 2</th>
            <th>Adresse</th>
            <th>Date de début</th>
            <th>Date de fin</th>
            <th>
                <a href="<?= $router->url('add_chauffeur') ?>" class="btn btn-primary">Ajouter</a>
            </th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        <?php foreach($chauffeurs as $chauffeur) : ?>
            <tr>
                <td>#<?= $chauffeur->getKatakataniId() ?></td>
                <td><?= $chauffeur->getPrenom() ?> <?= $chauffeur->getNom() ?></td>
                <td><?= $chauffeur->getTelephone1() ?></td>
                <td><?= $chauffeur->getTelephone2() ?></td>
                <td><?= $chauffeur->getAdresse() ?></td>
                <td><?= $chauffeur->getDebutAt()->format('Y-m-d') ?></td>
                <td><?= $chauffeur->getFinAt()->format('Y-m-d') ?></td>
                <td>
                    <a href="<?=$router->url('edit_chauffeur', ['id'=>$chauffeur->getId()])?>" class="btn btn-primary">Éditer</a>
                    <form action="<?=$router->url('delete_chauffeur', ['id'=>$chauffeur->getId()])?>" method="post" onsubmit="return confirm('Êtes-vous sûr de la suppression ?')" style="display: inline-block;">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>