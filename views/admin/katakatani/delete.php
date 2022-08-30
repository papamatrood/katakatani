<?php

use App\Auth;
use App\Table\TableKatakatani;

Auth::check();

$id = $params['id'];


if (isset($_POST)) {
    (new TableKatakatani())->delete($id);
    header("Location: " . $router->url('home_katakatani') . '?delete=1');
    exit;
}