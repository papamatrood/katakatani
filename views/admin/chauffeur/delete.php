<?php

use App\Auth;
use App\Table\TableChauffeur;

Auth::check();

$id = $params['id'];


if (isset($_POST)) {
    (new TableChauffeur())->delete($id);
    header("Location: " . $router->url('home_chauffeur') . '?delete=1');
    exit;
}