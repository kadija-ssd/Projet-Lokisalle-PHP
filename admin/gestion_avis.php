<?php require_once '../inc/header.php';


$req=executeRequete("SELECT a.*, m.*, s.*
FROM membre m
INNER JOIN avis a
ON a.id_membre = m.id_membre
INNER JOIN salle s
ON s.id_salle = a.id_salle");

$avis=$req->fetchAll(PDO::FETCH_ASSOC);



if (isset($_GET['action'])):

    $r=executeRequete("DELETE FROM avis WHERE id_avis=:id", array(
        ':id'=>$_GET['id']
    ));

    header('Location:./gestion_avis.php');
    exit();

endif;




?>


<style>
    .rating {
        position: relative;
        width: 160px;

        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.3em;
        padding: 5px 0;
        overflow: hidden;
        border-radius: 20px;
        box-shadow: 0 0 2px #b3acac;
    }

</style>

<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Membre</th>
        <th scope="col">Salle</th>
        <th scope="col">Commentaire</th>
        <th scope="col">Note</th>
        <th scope="col">Date enregistrement</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($avis as $av): ?>
        <tr>
            <th scope="row"><?=  $av['id_avis'] ; ?></th>
            <td><?=  $av['id_membre'].'-'.$av['email']  ; ?></td>
            <td><?=  $av['id_salle'].'-'. $av['titre'] ; ?></td>
            <td><?=  $av['id_salle'].'-'. $av['commentaire'] ; ?></td>


            <td>
                <div class="rating">
                    <span class="rating__result"></span>
                    <i  <?php  if ($av['note']!==0):  echo 'class="rating__star far fa-star fa-solid"'; else:  echo 'class="rating__star far fa-star "';endif; ?>></i>
                    <i <?php  if ($av['note'] >1):  echo 'class="rating__star far fa-star fa-solid"'; else:  echo 'class="rating__star far fa-star "';endif; ?>></i>
                    <i <?php  if ($av['note'] >2):  echo 'class="rating__star far fa-star fa-solid"'; else:  echo 'class="rating__star far fa-star "';endif; ?>></i>
                    <i <?php  if ($av['note'] >3 ):  echo 'class="rating__star far fa-star fa-solid"'; else:  echo 'class="rating__star far fa-star "';endif; ?>></i>
                    <i <?php  if ($av['note'] ==5):  echo 'class="rating__star far fa-star fa-solid"'; else:  echo 'class="rating__star far fa-star "';endif; ?>></i>
                </div></td>
            <td><?=  $av['id_salle'].'-'. date_format(new DateTime($av['date_enregistrement']), 'd-m-Y') ?></td>


            <td>

                <a href="?id=<?= $av['id_avis']; ?>&action=delete"> <i class="fa-solid fa-trash-can fa-2xl"></i></a>
            </td>
        </tr>
    <?php endforeach;  ?>
    </tbody>
</table>


<?php require_once '../inc/footer.php' ?>

