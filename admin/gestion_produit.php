<?php require_once '../inc/header.php';

if (!empty($_POST)){


    $requete=executeRequete(  "REPLACE INTO produit (id_produit,id_salle,date_arrivee, date_depart, prix, etat) VALUES (:id_produit,:id_salle ,:date_arrivee, :date_depart ,:prix, :etat )", array(

             ':id_produit'=>$_POST['id_produit'],
             ':id_salle'=>$_POST['id_salle'],
            ':date_arrivee'=>$_POST['date_arrivee'],
            ':date_depart'=>$_POST['date_depart'],
            ':prix'=>$_POST['prix'],
            ':etat'=>'libre'


        )
    );


}

$resultat= executeRequete("SELECT * FROM produit ");

$produits=$resultat->fetchAll(PDO::FETCH_ASSOC);

$req=executeRequete("SELECT * FROM salle");
$salles=$req->fetchAll(PDO::FETCH_ASSOC);

if (!empty($_GET['id']) && isset($_GET['action']) && $_GET['action']=='edit'){
    $re=executeRequete("SELECT * FROM produit WHERE id_produit=:id", array(
            ':id'=>$_GET['id']
    ));
    $prod=$re->fetch(PDO::FETCH_ASSOC);

}

if (!empty($_GET['id']) && isset($_GET['action']) && $_GET['action']=='delete'){
    $res=executeRequete("DELETE FROM produit WHERE id_produit=:id", array(
        ':id'=>$_GET['id']
    ));

    header('location:./gestion_produit.php');

}





?>

<table class="table table-dark">
    <thead>
    <tr>
        <th scope="col">id produit</th>
        <th scope="col">date d'arrivée</th>
        <th scope="col">date de départ</th>
        <th scope="col">salle</th>
        <th scope="col">prix</th>
        <th scope="col">etat</th>
        <th scope="col">actions</th>
    </tr>
    </thead>
    <tbody>


    <?php foreach ($produits as $produit):

        $r=executeRequete("SELECT titre FROM salle WHERE id_salle=:id_salle", array(
                ':id_salle'=>$produit['id_salle']
        ));
       $piece=$r->fetch(PDO::FETCH_ASSOC);

        ?>
        <tr>
            <th scope="row"><?= $produit['id_produit'] ?></th>
            <td><?=$produit['date_arrivee'] ?></td>
            <td><?=$produit['date_depart'] ?></td>
            <td><?=$piece['titre']?></td>
            <td><?=$produit['prix'] ?></td>
            <td><?=$produit['etat'] ?></td>
            <td>

                <a href="?id=<?= $produit['id_produit'] ?>&action=edit"><i class="fa-solid fa-pen-to-square fa-2xl"></i></a>
                <a href="?id=<?= $produit['id_produit'] ?>&action=delete"> <i class="fa-solid fa-trash-can fa-2xl"></i></a>
            </td>
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>



<form method="post" action="" enctype="multipart/form-data">
    <div class="row justify-content-between">
        <div class="col-md-5"><br>
            <div class="mb-3">
                <label class="control-label" for="date">Date d'arrivée</label>
                <input class="form-control" value="<?= substr($prod['date_arrivee'], 0, -9) ?? ''; ?>" id="date" name="date_arrivee"  type="date" />
            </div>
            <div class="mb-3">
                <label class="control-label" for="date">Date de départ</label>
                <input class="form-control" value="<?= substr($prod['date_depart'], 0, -9) ?? ''; ?>" id="date" name="date_depart"  type="date" />
            </div>
        </div>

        <div class="col-md-5">
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Salle</label>
                <select class="form-select" name="id_salle" aria-label="Default select example">
                   <?php foreach ($salles as $salle):  ?>

                       <option <?php if (isset($prod) && $prod['id_salle'] == $salle['id_salle']): echo 'selected'; endif; ?> value="<?= $salle['id_salle'] ?>"><?= $salle['titre'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Tarif</label>
                <input type="number" name="prix" value=<?= $prod['prix'] ?? 0 ?> class="form-control" id="exampleInputPassword1" placeholder="Prix en euros">
            </div>
            <input type="hidden" value="<?= $prod['id_produit'] ?? 0 ?>" name="id_produit" >
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </div>

</form>


<?php require_once '../inc/footer.php';