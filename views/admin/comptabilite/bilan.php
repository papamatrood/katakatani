<?php

use App\Auth;
use App\Classes\Chauffeur;
use App\Connection;
use App\Classes\Comptabilite;

Auth::check();

$pdo = Connection::getPDO();

$query = "SELECT c.*, ch.id, ch.prenom, ch.nom, k.numero, SUM(montant) AS resultat
FROM comptabilite c 
JOIN chauffeur ch ON c.katakatani_id = ch.katakatani_id
JOIN katakatani k ON k.id = c.katakatani_id";

$params = [];

$chauff = null;
$act = null;

$month = $_POST['mois'] ?? date('m');
$year = $_POST['annee'] ?? date('Y');
$date_at = $year . '-' . $month;

$query .= " WHERE date_at LIKE :date_at";
$params['date_at'] = '%' . $date_at . '%';

if (!empty($_POST)) {
    $chauff = $_POST['chauffeur'] ?? null;

    if (!is_null($chauff)) {
        $query .= " AND c.katakatani_id = :katakatani_id";
        $params['katakatani_id'] = (int) $chauff;
    }
}

$query .= " GROUP BY ch.id, motif";

$prepare = $pdo->prepare($query);
$prepare->execute($params);

/**
 * @var Chauffeur[]
 */
$chauffeurs = $pdo->query("SELECT katakatani_id, prenom, nom FROM chauffeur")->fetchAll(PDO::FETCH_CLASS, Chauffeur::class);


/**
 * @var Comptabilite[]
 */
$comptabilites = $prepare->fetchAll(PDO::FETCH_CLASS, Comptabilite::class);

$donnees = [];
$depenses = 0;
$recettes = 0;

foreach ($comptabilites as $value) {
    $montant = $value->resultat;
    $donnees[$value->getKatakataniId()]['katakataniId'] = $value->numero;
    $donnees[$value->getKatakataniId()]['nomComplet'] = $value->getNomComplet();
    if ($value->getMotif() == 'Recette') {
        $donnees[$value->getKatakataniId()]['recette'] = $montant;
    } elseif ($value->getMotif() == 'Dépense') {
        $donnees[$value->getKatakataniId()]['depense'] = $montant;
    }
    $donnees[$value->getKatakataniId()]['date'] = MONTHS[$value->getDateAt()->format('m')] . ' ' . $value->getDateAt()->format('Y');
}
?>

<br>
<h3>Liste des comptabilites</h3>
<br>
<form method="post">
    <fieldset class="border rounded-3 p-3">
        <legend class="float-none w-auto px-3">Filtre</legend>
        <div class="row">
            <div class="col">
                <div class="input-group mb-3">
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
                    <select name="mois" class="form-select form-select-sm">
                        <option value="" selected disabled hidden>Sélectionner un mois</option>
                        <?php foreach (MONTHS as $numero => $mois) : ?>
                            <?php $selected = $numero !== $month ? null : 'selected' ?>
                            <option value="<?= $numero ?>" <?= $selected ?>>
                                <?= $mois ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <select name="annee" class="form-select form-select-sm">
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
<br>

<table class="table table-striped table-hover table-bordered" style="width:100%">
    <thead class="table-dark">
        <tr>
            <th style="width:7%">Katakani N°#</th>
            <th style="width:15%">Prénom & Nom</th>
            <th style="width:11%">Recette</th>
            <th style="width:11%">Dépense</th>
            <th style="width:11%">Resultat</th>
            <th style="width:10%">Date</th>
        </tr>
    </thead>
    <?php if (!empty($comptabilites)) : ?>
        <tbody class="table-group-divider">
            <?php
            $class = null;
            foreach ($donnees as $donnee) :
                $recette = (int) ($donnee['recette'] ?? '0');
                $depense = (int) ($donnee['depense'] ?? '0');
                $resultat = $recette - $depense;
                if ($resultat > 0) {
                    $class = 'table-success';
                } elseif ($resultat < 0) {
                    $class = 'table-danger';
                }

                $depenses += $depense;
                $recettes += $recette;
            ?>
                <tr class="<?= $class ?>">
                    <td>#<?= $donnee['katakataniId'] ?></td>
                    <td><?= $donnee['nomComplet'] ?></td>
                    <td><?= number_format($recette, '0', '', ' ') . ' FCFA' ?></td>
                    <td><?= number_format($depense, '0', '', ' ') . ' FCFA' ?></td>
                    <td><?= number_format($resultat, '0', '', ' ') . ' FCFA' ?></td>
                    <td><?= $donnee['date'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot class="<?php if (($recettes - $depenses) <= 0) : ?>table-danger<?php else : ?>table-success<?php endif; ?>">
            <tr>
                <th colspan="2">Bilan : </th>
                <th><?= number_format($recettes, '0', '', ' ') . ' FCFA' ?></th>
                <th><?= number_format($depenses, '0', '', ' ') . ' FCFA' ?></th>
                <th><?= number_format($recettes - $depenses, '0', '', ' ') . ' FCFA' ?></th>
                <th><?= $donnee['date'] ?></th>
            </tr>
        </tfoot>
    <?php else : ?>
        </tbody class="table-group-divider">
        <tr>
            <td colspan="6">Aucun enregistrement n' été trouvé</td>
        </tr>
        </tbody>
    <?php endif; ?>
</table>