<?php  require_once 'inc/header.php';

$req=executeRequete("SELECT p.*, s.* FROM produit p INNER JOIN salle s ON p.id_salle=s.id_salle WHERE id_produit=:id", array(
    ':id'=>$_GET['id']
));
$produit= $req->fetch(PDO::FETCH_ASSOC);


$r=executeRequete("SELECT p.*, s.* FROM produit p INNER JOIN salle s ON p.id_salle=s.id_salle WHERE titre!=:titre LIMIT 4",array(
        ':titre'=>$produit['titre']
    )
);






$produits=$r->fetchAll(PDO::FETCH_ASSOC);


if (isset($_GET['etat'])){

    $requete=executeRequete("UPDATE produit SET etat=:etat WHERE id_produit=:id_produit",array(
        ':etat'=>$_GET['etat'],
        ':id_produit'=>$_GET['id']
    ));



    $r=executeRequete("INSERT INTO commande (id_membre, id_produit, date_enregistrement) VALUES (:id_membre, :id_produit, :date_enregistrement)", array(
        ':id_membre'=>$_SESSION['membre']['id_membre'],
        ':id_produit'=>$_GET['id'],
        ':date_enregistrement'=>date_format(new DateTime(), 'Y-m-d')
    ));


    $_SESSION['messages']['info'][]="Merci pour votre contribution";
//    header("location:./");
//    exit();

    echo '<script  type="text/javascript">window.location.replace("index.php")</script>';
}

$adresse=str_replace(' ','%20', $produit['adresse']);




?>


<div class="row justify-content-around mb-5">
    <div class="col-md-10"><h1><?=  $produit['titre'] ; ?></h1></div>
    <div class="col-md-1"><a href="<?='?id='.$produit['id_produit'].'&etat=reservation' ?>" class="btn btn-success">Réserver</a></div>
</div>
<hr>
<div class="row justify-content-around mb-4">
    <div class="col-md-8">

        <img width="800" src="<?=  $produit['photo'] ; ?>" alt="">
    </div>
    <div class="col-md-4">
        <h5>Description</h5>
        <p><?= $produit['description'] ?></p>
        <div class="mapouter mt-5"><div class="gmap_canvas"><iframe src="https://maps.google.com/maps?q=<?=$adresse
        ?>%20<?=$produit['ville']?>&t=&z=13&ie=UTF8&iwloc=&output=embed" width="600" height="500" id="gmap_canvas"  frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://fmovies-online.net"></a><br><style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}</style><a href="https://www.embedgooglemap.net">embed google</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:400px;width:400px;}</style></div></div>

    </div>
</div>

<div class="row justify-content-around mb-4">
    <h5>Informations complémentaires</h5>
    <div class="col-md-4"><span>Arrivée: <?=  date_format(new DateTime($produit['date_arrivee']), 'd/m/Y') ; ?></span><br>
    <span>Départ: <?=  date_format(new DateTime($produit['date_depart']), 'd/m/Y') ; ?></span></div>
    <div class="col-md-4"><span>Capacité: <?= $produit['capacite']  ?></span><br>
    <span>Catégorie: <?=  $produit['categorie'] ; ?></span></div>
    <div class="col-md-4">
        <span>Adresse: <?=  $produit['adresse'].', '.$produit['cp'].', '.$produit['ville'] ; ?></span><br>
        <span>Tarif: <?=  $produit['prix'] ; ?>€</span>
    </div>

</div>


<h3 >Autres produits</h3>
<hr>
<div class="row justify-content-center">
    <?php  foreach ($produits as $salle): ?>
    <div class="col-md-3 text-center"><a href="<?=  SITE.'fiche_produit.php?id='.$salle['id_produit'] ; ?>"><img height="100" width="200" src="<?=  $salle['photo'] ; ?>" alt=""></a></div>
    <?php  endforeach; ?>
</div>
<hr>
<div class="row justify-content-around">
    <div class="col-md-9"><a href="<?= SITE.'avis.php?id='.$_GET['id'];  ?>">Déposer un commentaire et une note</a></div>
    <div class="col-md-3"><a href="<?= SITE;  ?>" >Retour vers le catalogue</a></div>
</div>

<?php  require_once 'inc/footer.php'; ?>
