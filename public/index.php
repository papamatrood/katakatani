<?php

use App\Router;

require '../vendor/autoload.php';

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

define('VIEWPATH', '../views');

$router = new Router(VIEWPATH);

$router
    ->match('/', 'security/login', 'login')
    ->get('/logout', 'security/logout', 'logout')
    ->get('/admin', 'admin/liste/index', 'home')
    ->get('/admin/katakatani/', 'admin/katakatani/index', 'home_katakatani')
    ->match('/admin/katakatani/add', 'admin/katakatani/add', 'add_katakatani')
    ->match('/admin/katakatani/edit/[i:id]', 'admin/katakatani/edit', 'edit_katakatani')
    ->match('/admin/katakatani/delete/[i:id]', 'admin/katakatani/delete', 'delete_katakatani')
    ->get('/admin/chauffeur/', 'admin/chauffeur/index', 'home_chauffeur')
    ->match('/admin/chauffeur/add', 'admin/chauffeur/add', 'add_chauffeur')
    ->match('/admin/chauffeur/edit/[i:id]', 'admin/chauffeur/edit', 'edit_chauffeur')
    ->match('/admin/chauffeur/delete/[i:id]', 'admin/chauffeur/delete', 'delete_chauffeur')
    ->match('/admin/comptabilite/', 'admin/comptabilite/index', 'home_comptabilite')
    ->match('/admin/comptabilite/bilan', 'admin/comptabilite/bilan', 'bilan_comptabilite')
    ->match('/admin/comptabilite/bilan/annuel', 'admin/comptabilite/bilan_annuel', 'bilan_annuel_comptabilite')
    ->match('/admin/comptabilite/add', 'admin/comptabilite/add', 'add_comptabilite')
    ->match('/admin/comptabilite/edit/[i:id]', 'admin/comptabilite/edit', 'edit_comptabilite')
    ->match('/admin/comptabilite/delete/[i:id]', 'admin/comptabilite/delete', 'delete_comptabilite')
    ->run();
