<?php

use App\Connection;

$pdo = Connection::getPDO();

$query = $pdo->query(
    "SELECT compt.*, chauf.prenom, chauf.nom, k.matricule 
    FROM comptabilite compt
    JOIN katakatani k     ON k.id = compt.katakatani_id
    JOIN chauffeur chauf  ON chauf.katakatani_id = compt.katakatani_id
    ORDER BY compt.date_at DESC
    LIMIT 12");

$liste = $query->fetchAll(PDO::FETCH_OBJ);

?>

<table class="table table-striped table-hover table-bordered">
    <thead>
        <tr>
            <th>Matricle</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Motif</th>
            <th>Dépense</th>
            <th>Recette</th>
            <th>Détail</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        <?php foreach($liste as $contenu) : ?>
            <tr>
                <td><?= $contenu->matricule ?></td>
                <td><?= $contenu->prenom ?></td>
                <td><?= $contenu->nom ?></td>
                <td><?= $contenu->motif ?></td>
                <td><?= $contenu->depense ?></td>
                <td><?= $contenu->recette ?></td>
                <td><?= $contenu->details ?></td>
                <td><?= (new DateTime($contenu->date_at))->format('Y-m-d') ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>