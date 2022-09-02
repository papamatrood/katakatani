<?php

use App\Auth;
use App\Connection;
use App\Classes\Chauffeur;
use App\Help\NumberHelper;
use App\Classes\Comptabilite;

Auth::check();

$pdo = Connection::getPDO();

$limit  = 6;
$page   = NumberHelper::getPositive('page', 1);
$offset = $limit * ($page - 1);

$queryCount = "SELECT COUNT(c.id) FROM comptabilite c JOIN chauffeur ch ON c.katakatani_id = ch.katakatani_id";

$query = "SELECT c.*, ch.prenom, ch.nom FROM comptabilite c JOIN chauffeur ch ON c.katakatani_id = ch.katakatani_id";

$params = [];
$month = null;
$year = null;
$chauff = null;
$act = null;

if (!empty($_POST)) {
    $month = $_POST['mois'];
    $year = $_POST['annee'];
    $chauff = $_POST['chauffeur'] ?? null;
    $act = $_POST['motif'] ?? null;
    $date_at = $year . '-' . $month;

    $queryCount .= " WHERE date_at LIKE :date_at";
    $query .= " WHERE date_at LIKE :date_at";
    $params['date_at'] = '%' . $date_at . '%';

    if (!is_null($chauff)) {
        $queryCount .= " AND c.katakatani_id = :katakatani_id";
        $query .= " AND c.katakatani_id = :katakatani_id";
        $params['katakatani_id'] = (int) $chauff;
    }

    if (!is_null($act)) {
        $queryCount .= " AND c.motif = :motif";
        $query .= " AND c.motif = :motif";
        $params['motif'] = $act;
    }
}

$query .= " ORDER BY date_at DESC LIMIT {$limit} OFFSET {$offset}";

$prepareCount = $pdo->prepare($queryCount);
$prepare = $pdo->prepare($query);

$prepareCount->execute($params);
$prepare->execute($params);

$count = (int) $prepareCount->fetch()[0];

$pages = (int) ceil($count / $limit);

if ($page > $pages) throw new Exception('Cette page n\'existe pas !');

/**
 * @var Chauffeur[]
 */
$chauffeurs = $pdo->query("SELECT katakatani_id, prenom, nom FROM chauffeur")->fetchAll(PDO::FETCH_CLASS, Chauffeur::class);


/**
 * @var Comptabilite[]
 */
$comptabilites = $prepare->fetchAll(PDO::FETCH_CLASS, Comptabilite::class);

$url   = $router->url('home_comptabilite');

?>

<br>
<h3>Liste des comptabilites</h3>
<?php if (isset($_GET['created'])) : ?>
    <div class="alert alert-success">
        Un nouveau comptabilite a été ajouté avec succès !
    </div>
<?php endif; ?>
<br>
<form method="post">
    <fieldset class="border rounded-3 p-3">
        <legend class="float-none w-auto px-3">Filtre</legend>
        <div class="row">
            <div class="col">
                <div class="input-group mb-3">
                    <span class="input-group-text">Action</span>
                    <select name="motif" class="form-select form-select-sm">
                        <option value="" selected disabled hidden>Sélectionner une action</option>
                        <?php foreach (MOTIFS as $key => $action) : ?>
                            <?php $selected = $action !== $act ? null : 'selected' ?>
                            <option value="<?= $action ?>" <?= $selected ?>>
                                <?= $action ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="input-group-text">Chauffeur</span>
                    <select name="chauffeur" class="form-select form-select-sm">
                        <option value="" selected disabled hidden>Sélectionner un chauffeur</option>
                        <?php foreach ($chauffeurs as $chauffeur) : ?>
                            <?php $selected = $chauffeur->getKatakataniId() !== (int) $chauff ? null : 'selected' ?>
                            <option value="<?= $chauffeur->getKatakataniId() ?>" <?= $selected ?>>
                                <?= $chauffeur->getPrenom() . ' ' . $chauffeur->getNom() ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="input-group mb-3">
                    <span class="input-group-text">Date</span>
                    <select name="mois" class="form-select form-select-sm" required>
                        <option value="" selected disabled hidden>Sélectionner un mois</option>
                        <?php foreach (MONTHS as $numero => $mois) : ?>
                            <?php $selected = $numero !== $month ? null : 'selected' ?>
                            <option value="<?= $numero ?>" <?= $selected ?>>
                                <?= $mois ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <select name="annee" class="form-select form-select-sm" required>
                        <option value="" selected disabled hidden>Sélectionner une année</option>
                        <?php foreach (YEARS as $annee) : ?>
                            <?php $selected = $annee !== (int) $year ? null : 'selected' ?>
                            <option value="<?= $annee ?>" <?= $selected ?>>
                                <?= $annee ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-primary">Filtrer</button>
                </div>
            </div>
        </div>
    </fieldset>
</form>
<?php if (isset($_GET['edited'])) : ?>
    <div class="alert alert-success">
        Modification effectuée avec succès !
    </div>
<?php endif; ?>
<br>
<?php if (isset($_GET['delete'])) : ?>
    <div class="alert alert-success">
        Suppression effectuée avec succès !
    </div>
<?php endif; ?>
<br>

<table class="table table-striped table-hover table-bordered" style="width:100%">
    <thead>
        <tr>
            <th style="width:10%">Katakani N°#</th>
            <th style="width:15%">Prénom & Nom</th>
            <th style="width:8%">Motif</th>
            <th style="width:10%">Montant</th>
            <th style="width:30%">Détails</th>
            <th style="width:10%">Date</th>
            <th style="width:17%">
                <a href="<?= $router->url('add_comptabilite') ?>" class="btn btn-primary">Ajouter</a>
            </th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        <?php if (!empty($comptabilites)) : ?>
            <?php foreach ($comptabilites as $comptabilite) : ?>
                <tr>
                    <td>#<?= $comptabilite->getKatakataniId() ?></td>
                    <td><?= $comptabilite->getNomComplet() ?></td>
                    <td><?= $comptabilite->getMotif() ?></td>
                    <td><?= number_format($comptabilite->getMontant(), '0', '', ' ') ?> FCFA</td>
                    <td><?= nl2br(htmlentities($comptabilite->getDetails())) ?></td>
                    <td><?= $comptabilite->getDateAt()->format('Y-m-d') ?></td>
                    <td>
                        <a href="<?= $router->url('edit_comptabilite', ['id' => $comptabilite->getId()]) ?>" class="btn btn-primary">Éditer</a>
                        <form action="<?= $router->url('delete_comptabilite', ['id' => $comptabilite->getId()]) ?>" method="post" onsubmit="return confirm('Êtes-vous sûr de la suppression ?')" style="display: inline-block;">
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="7">Aucun enregistrement n' été trouvé</td>
            </tr>
        <?php endif; ?>
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