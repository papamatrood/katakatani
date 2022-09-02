<?php

use App\Auth;
use App\Connection;
use App\Help\NumberHelper;

Auth::check();

$pdo = Connection::getPDO();

$limit  = 12;
$page   = NumberHelper::getPositive('page', 1);
$offset = $limit * ($page - 1);

$count = (int) $pdo->query(
    "SELECT COUNT(compt.id)
    FROM comptabilite compt
    JOIN katakatani k     ON k.id = compt.katakatani_id
    JOIN chauffeur chauf  ON chauf.katakatani_id = compt.katakatani_id"
)->fetch()[0];

$pages = (int) ceil($count / $limit);

if ($page > $pages) throw new Exception('Cette page n\'existe pas !');

$query = $pdo->query(
    "SELECT compt.*, chauf.prenom, chauf.nom, k.matricule 
    FROM comptabilite compt
    JOIN katakatani k     ON k.id = compt.katakatani_id
    JOIN chauffeur chauf  ON chauf.katakatani_id = compt.katakatani_id
    ORDER BY compt.date_at DESC
    LIMIT {$limit}
    OFFSET {$offset}"
);

$liste = $query->fetchAll(PDO::FETCH_OBJ);

$url   = $router->url('home');

?>

<table class="table table-striped table-hover table-bordered">
    <caption class="caption-top">Les derniéres activités</caption>
    <thead>
        <tr>
            <th>Prénom & Nom</th>
            <th>Motif</th>
            <th>Montant</th>
            <th>Détail</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        <?php foreach ($liste as $contenu) : ?>
            <tr>
                <td><?= $contenu->prenom . ' ' . $contenu->nom ?></td>
                <td><?= $contenu->motif ?></td>
                <td><?= number_format($contenu->montant, '0', '', ' ') ?> FCFA</td>
                <td><?= $contenu->details ?></td>
                <td><?= (new DateTime($contenu->date_at))->format('Y-m-d') ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="d-flex justify-content-between">
    <?php
    if ($page > 1) :
        $lien = $url;
        if ($page > 2) $lien .= '?page=' . ($page - 1);
    ?>
        <a href="<?= $lien ?>" class="btn btn-primary">&laquo; Précédent</a>
    <?php endif; ?>
    <?php if ($page < $pages) : ?>
        <a href="<?= $url ?>?page=<?= $page + 1 ?>" class="btn btn-primary ms-auto">&raquo; Suivant</a>
    <?php endif; ?>
</div>