<?php

use App\Auth;
use App\Table\TableComptabilite;

Auth::check();

$id = $params['id'];


if (isset($_POST)) {
    (new TableComptabilite())->delete($id);
    header("Location: " . $router->url('home_comptabilite') . '?delete=1');
    exit;
}