 <?php
    use App\HTML\Nav;
?>
 <!doctype html>
 <html lang="fr">

 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title><?= 'Gestion des katakatanis'  ?></title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
 </head>

 <body>
     <nav class="navbar navbar-dark navbar-expand-lg bg-info mb-3">
         <div class="container-fluid">
             <a class="navbar-brand" href="<?= $router->url('home') ?>">GK</a>
             <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"></span>
             </button>
             <div class="collapse navbar-collapse" id="navbarSupportedContent">
                 <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                     <?= Nav::item($router->url('home'), "Accueil") ?>
                     <?= Nav::item($router->url('home_katakatani'), "Katakatanis") ?>
                     <?= Nav::item($router->url('home_chauffeur'), "Chauffeurs") ?>
                     <?= Nav::item($router->url('home_comptabilite'), "Comptabilité") ?>
                     <?= Nav::item($router->url('bilan_comptabilite'), "Bilan") ?>
                     <?= Nav::item($router->url('logout'), "Se déconnecter") ?>
                     <!-- <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                    </li> -->
                 </ul>
                 <form class="d-flex" role="search">
                     <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                     <button class="btn btn-outline-light" type="submit">Recherche</button>
                 </form>
             </div>
         </div>
     </nav>
     <div class="container">
         <?= $content ?>
     </div>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
 </body>

 </html>