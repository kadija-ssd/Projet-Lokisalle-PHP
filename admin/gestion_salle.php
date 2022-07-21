<?php require_once '../inc/header.php';


if (!empty($_POST)) {

    if (!empty($_FILES['photo']['name'])) {
        $photo = date_format(new DateTime(), 'dmYHis') . $_FILES['photo']['name'];

        $photo_bdd = 'upload/' . $photo;

        if (!file_exists('../upload')) {
            mkdir('../upload', 0777, true);
        }
        copy($_FILES['photo']['tmp_name'], '../' . $photo_bdd);


    }


    $requete = executeRequete("REPLACE INTO salle (id_salle,titre, description, photo,pays,ville,adresse, cp,capacite, categorie) VALUES (:id_salle,:titre, :description, :photo, :pays, :ville,:adresse, :cp,:capacite,:categorie)", array(
            ':id_salle'=>$_POST['id_salle'],
            ':titre' => $_POST['titre'],
            ':description' => $_POST['description'],
            ':photo' => $photo_bdd,
            ':pays' => $_POST['pays'],
            ':ville' => $_POST['ville'],
            ':adresse' => $_POST['adresse'],
            ':cp' => $_POST['cp'],
            ':capacite' => $_POST['capacite'],
            ':categorie' => $_POST['categorie']
        )
    );

    //var_dump($requete);

}

$resultat = executeRequete("SELECT * FROM salle");

$salles = $resultat->fetchAll(PDO::FETCH_ASSOC);// fetchAll() à utiliser lorsque l'on attend plusieurs résultats
// PDO::FETCH_ASSOC pour convertir le jeu de résultat en tableau

//var_dump($salles);


if (!empty($_GET['id']) && isset($_GET['action']) && $_GET['action']=='edit') {
    $requete = executeRequete("SELECT * FROM salle WHERE id_salle=:id", array(
        ':id' => $_GET['id']
    ));
    $piece = $requete->fetch(PDO::FETCH_ASSOC);

}

if (!empty($_GET['id']) && isset($_GET['action']) &&  $_GET['action']=='delete') {
    $requ = executeRequete("DELETE FROM salle WHERE id_salle=:id", array(
        ':id' => $_GET['id']
    ));


}


?>

<table class="table table-dark">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">titre</th>
        <th scope="col">description</th>
        <th scope="col">photo</th>
        <th scope="col">pays</th>
        <th scope="col">ville</th>
        <th scope="col">adresse</th>
        <th scope="col">cp</th>
        <th scope="col">capacité</th>
        <th scope="col">catégorie</th>
        <th scope="col">actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($salles as $salle): ?>
        <tr>
            <th scope="row"><?= $salle['id_salle'] ?></th>
            <td><?= $salle['titre'] ?></td>
            <td><?= $salle['description'] ?></td>
            <td><img src="<?= SITE . $salle['photo'] ?>" width="150" alt=""></td>
            <td><?= $salle['pays'] ?></td>
            <td><?= $salle['ville'] ?></td>
            <td><?= $salle['adresse'] ?></td>
            <td><?= $salle['cp'] ?></td>
            <td><?= $salle['capacite'] ?></td>
            <td><?= $salle['categorie'] ?></td>
            <td>
                <a href="?id=<?= $salle['id_salle'] ?>&action=edit"><i class="fa-solid fa-pen-to-square fa-2xl"></i></a>
                <a href="?id=<?= $salle['id_salle'] ?>&action=delete"> <i class="fa-solid fa-trash-can fa-2xl"></i></a>
            </td>
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>


<form method="post" action="" enctype="multipart/form-data">
    <div class="row justify-content-between">
        <div class="col-md-4">
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Titre</label>
                <input type="text" value="<?= $piece['titre'] ?? ''; ?>" name="titre" class="form-control"
                       id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="exampleFormControlTextarea1"
                          rows="3"><?= $piece['description'] ?? ''; ?></textarea>
            </div>

            <div class="mb-3">
                <label for="formFile" class="form-label">Photo</label>
                <input class="form-control" name="photo" type="file" id="formFile">
            </div>


            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Capacité</label>
                <select class="form-select" name="capacite" aria-label="Default select example">
                    <?php for ($i = 1; $i <= 30; $i++):
                        ?>
                        <option <?php if (isset($piece) && $piece['capacite'] == $i): echo 'selected'; endif; ?>
                                value="<?= $i; ?>"><?= $i; ?></option>
                    <?php endfor ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Catégorie</label>
                <select class="form-select" name="categorie" aria-label="Default select example">
                    <option <?php if (isset($piece) && $piece['categorie'] == 'réunion'): echo 'selected'; endif; ?>
                            value="réunion">Réunion
                    </option>
                    <option <?php if (isset($piece) && $piece['categorie'] == 'bureau'): echo 'selected'; endif; ?>
                            value="bureau">Bureau
                    </option>
                    <option <?php if (isset($piece) && $piece['categorie'] == 'formation'): echo 'selected'; endif; ?>
                            value="formation">Formation
                    </option>
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Pays</label>
                <select class="form-select" name="pays" aria-label="Default select example">
                    <option <?php if (isset($piece) && $piece['pays'] == 'france'): echo 'selected'; endif; ?>
                            value="france">France
                    </option>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Ville</label>
                <select class="form-select" name="ville" aria-label="Default select example">
                    <option <?php if (isset($piece) && $piece['ville'] == 'paris'): echo 'selected'; endif; ?>
                            value="paris">Paris
                    </option>
                    <option <?php if (isset($piece) && $piece['ville'] == 'lyon'): echo 'selected'; endif; ?>
                            value="lyon">Lyon
                    </option>
                    <option <?php if (isset($piece) && $piece['ville'] == 'marseille'): echo 'selected'; endif; ?>
                            value="marseille">Marseille
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Adresse</label>
                <textarea class="form-control" name="adresse" id="exampleFormControlTextarea1"
                          rows="3"><?= $piece['adresse'] ?? ''; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Code Postal</label>
                <input type="number" name="cp" value="<?= $piece['cp'] ?? ''; ?>" class="form-control"
                       id="exampleInputPassword1">
            </div>

            <input type="hidden" name="id_salle" value="<?= $piece['id_salle'] ?? 0; ?>">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </div>
</form>


<?php require_once '../inc/footer.php'; ?>
