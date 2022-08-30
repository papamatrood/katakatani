<?php

use App\Auth;
use App\Connection;
use App\Classes\Comptabilite;

Auth::check();

$pdo = Connection::getPDO();

$query = $pdo->query(
    "SELECT c.*, ch.prenom, ch.nom, ch.telephone1
    FROM comptabilite c
    JOIN chauffeur ch ON c.katakatani_id = ch.katakatani_id
    ORDER BY date_at DESC
    LIMIT 12");

/**
 * @var Comptabilite[]
 */
$comptabilites = $query->fetchAll(PDO::FETCH_CLASS, Comptabilite::class);

?>

<br>
<h3>Liste des comptabilites</h3>
<?php if(isset($_GET['created'])) : ?>
    <div class="alert alert-success">
        Un nouveau comptabilite a été ajouté avec succès !
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

<table class="table table-striped table-hover table-bordered" style="width:100%">
    <thead>
        <tr>
            <th style="width:10%">Katakani N°#</th>
            <th style="width:10%">Prénom & Nom</th>
            <th style="width:8%">Motif</th>
            <th style="width:10%">Dépense</th>
            <th style="width:10%">Recette</th>
            <th style="width:25%">Détails</th>
            <th style="width:10%">Date</th>
            <th style="width:17%">
                <a href="<?= $router->url('add_comptabilite') ?>" class="btn btn-primary">Ajouter</a>
            </th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        <?php foreach($comptabilites as $comptabilite) : ?>
            <tr>
                <td>#<?= $comptabilite->getKatakataniId() ?></td>
                <td><?= $comptabilite->getNomComplet() ?></td>
                <td><?= $comptabilite->getMotif() ?></td>
                <td><?= number_format($comptabilite->getDepense(), '0', '', ' ') ?> FCFA</td>
                <td><?= number_format($comptabilite->getRecette(), '0', '', ' ') ?> FCFA</td>
                <td><?= nl2br(htmlentities($comptabilite->getDetails())) ?></td>
                <td><?= $comptabilite->getDateAt()->format('Y-m-d') ?></td>
                <td>
                    <a href="<?=$router->url('edit_comptabilite', ['id'=>$comptabilite->getId()])?>" class="btn btn-primary">Éditer</a>
                    <form action="<?=$router->url('delete_comptabilite', ['id'=>$comptabilite->getId()])?>" method="post" onsubmit="return confirm('Êtes-vous sûr de la suppression ?')" style="display: inline-block;">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>