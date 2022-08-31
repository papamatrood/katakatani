<?php

$years = [];

for ($i = (int) date('Y'); $i >= 2017; $i--) {
    $years[] = $i;
}

define('YEARS', $years);

define('MONTHS', [
    '01'  => 'Janvier',
    '02'  => 'Février',
    '03'  => 'Mars',
    '04'  => 'Avril',
    '05'  => 'Mai',
    '06'  => 'Juin',
    '07'  => 'Juillet',
    '08'  => 'Août',
    '09'  => 'Septembre',
    '10' => 'Octobre',
    '11' => 'Novembre',
    '12' => 'Décembre'
]);

define('MOTIFS', [
    1 => 'Dépense',
    2 => 'Recette'
]);
