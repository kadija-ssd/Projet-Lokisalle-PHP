<?php require_once '../inc/header.php';



$req=executeRequete("SELECT m.*, c.* , p.*, s.*
    FROM membre m  INNER JOIN commande c 
    ON m.id_membre=c.id_membre
    INNER JOIN produit p 
    ON p.id_produit=c.id_produit
    INNER JOIN salle s
    ON p.id_salle=s.id_salle");
$commandes=$req->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['action'])):

$r=executeRequete("DELETE FROM commande WHERE id_commande=:id", array(
        ':id'=>$_GET['id']
));

header('Location:./gestion_commande.php');
exit();

endif;




?>

<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Membre</th>
        <th scope="col">Produit</th>
        <th scope="col">Prix</th>
        <th scope="col">Date enregistrement</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
   <?php foreach ($commandes as $commande):  ?>
    <tr>
        <th scope="row"><?=  $commande['id_commande'] ; ?></th>
        <td><?=  $commande['id_membre'].'-'.$commande['email']  ; ?></td>
        <td><?=  $commande['id_salle'].'-'.$commande['titre'].'<br>du '.date_format(new DateTime($commande['date_arrivee']), 'd-m-Y').' au '.date_format(new DateTime($commande['date_depart']), 'd-m-Y') ; ?></td>
        <td><?=  $commande['prix'] ; ?>€</td>
        <td><?=  date_format(new DateTime($commande['date_enregistrement']), 'd-m-Y') ; ?></td>
        <td>

            <a href="?id=<?= $commande['id_commande']; ?>&action=delete"> <i class="fa-solid fa-trash-can fa-2xl"></i></a>
        </td>
    </tr>
   <?php endforeach;  ?>
    </tbody>
</table>
<?php require_once '../inc/footer.php' ?>

