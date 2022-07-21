<?php require_once 'inc/header.php';



$req=executeRequete("SELECT p.*, s.* FROM produit p INNER JOIN salle s ON p.id_salle=s.id_salle WHERE etat='libre'");
$produits= $req->fetchAll(PDO::FETCH_ASSOC);

?>


<div class="row justify-content-around">
    <div class="col-md-2"></div>
    <div class="col-md-9">
        <div class="row justify-content-between">
            <?php  foreach ($produits as $produit): ?>
                <div class="col-md-4">

                <div class="card mt-3" >
                    <img src="<?=  $produit['photo'] ; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><span style="color: cornflowerblue;padding-right: 50px;"><?=  $produit['titre'] ; ?></span><span><?=  $produit['prix'] ; ?>€</span></h5>
                        <p class="card-text"><?=  $produit['description'] ; ?></p>
                        <p><?=  date_format(new DateTime($produit['date_arrivee']), 'd/m/Y').' au '.date_format(new DateTime($produit['date_depart']), 'd/m/Y') ; ?></p>
                        <a href="<?=  SITE.'fiche_produit.php?id='.$produit['id_produit'] ; ?>" >Voir</a>
                    </div>
                </div>
                </div>


            <?php  endforeach; ?>

        </div>





    </div>
</div>










<?php require_once 'inc/footer.php' ?>


