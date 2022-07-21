<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Projet e-commerce</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.1.3/lux/bootstrap.min.css"
          integrity="sha512-B5sIrmt97CGoPUHgazLWO0fKVVbtXgGIOayWsbp9Z5aq4DJVATpOftE/sTTL27cu+QOqpI/jpt6tldZ4SwFDZw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<?php require('init.php');

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= SITE; ?>">Mon site E-commerce</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03"
                aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor03">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="<?= SITE; ?>">Accueil

                    </a>
                </li>

                    <li class="nav-item">
                        <a class="nav-link" href="">Ajout salle</a>
                    </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                       aria-haspopup="true" aria-expanded="false">Espace Membre</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?= SITE.'membre/register.php'; ?>">Inscription</a>
                        <a class="dropdown-item" href="<?= SITE.'membre/login.php'; ?>">Connexion</a>
                        <a class="dropdown-item" href="#">Profil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= SITE . 'admin/gestion_salle.php'; ?>">Gestion salles</a>
                        <a class="dropdown-item" href="<?= SITE . 'admin/gestion_produit.php'; ?>">Gestion produits</a>
                        <a class="dropdown-item" href="<?= SITE.'admin/gestion_membre.php'  ?>">Gestion membres</a>
                        <a class="dropdown-item" href="<?=  SITE.'admin/gestion_avis.php' ; ?>">Gestion avis</a>
                        <a class="dropdown-item" href="<?=  SITE.'admin/gestion_commande.php' ; ?>">Gestion commandes</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="">
                        <button type="button" class="rounded btn btn-outline-warning position-relative p-2 ">
                            <i class="fa-solid fa-cart-arrow-down fa-2xl "></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info">


  </span>
                        </button>
                    </a>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-sm-2" type="text" placeholder="Search">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>
            <?php if (!connect()):
                ?>
                <div class="text-center ">
                    <a href="" class="btn btn-success">Se connecter</a>
                    <a href="" class="btn btn-primary ">S'inscrire</a>
                </div>
            <?php else: ?>
                <div class="text-center ">
                    <a href="" class="btn btn-primary mt-1"><i
                                class="fa-solid fa-power-off"></i></a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</nav>
<div class="container">
    <?php if (isset($_SESSION['messages']) && !empty($_SESSION['messages'])):
        foreach ($_SESSION['messages'] as $type => $mess):
            foreach ($mess as $key => $message):
                ?>

                <div class="alert alert-<?= $type; ?> text-center">
                    <p><?= $message; ?></p>
                </div>
                <?php unset($_SESSION['messages'][$type][$key]); ?>
            <?php endforeach; endforeach; endif; ?>


