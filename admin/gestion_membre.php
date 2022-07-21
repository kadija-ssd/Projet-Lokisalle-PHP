<?php require_once '../inc/header.php';


if (isset($_GET['id'])){

  if (isset($_POST['statut'])){
      $r=executeRequete("UPDATE membre SET statut= :statut WHERE id_membre=:id", array(
          ':statut'=>1,
          ':id'=>$_GET['id']
      ));

  }else{
      $r=executeRequete("UPDATE membre SET statut= :statut WHERE id_membre=:id", array(
          ':statut'=>0,
          ':id'=>$_GET['id']
      ));

  }

}



if (!empty($_POST) && !isset($_GET['id'])){


   // var_dump($_POST);
    $mdp=password_hash($_POST['mdp'], PASSWORD_DEFAULT);

    $requete=executeRequete(  "INSERT INTO membre (pseudo, nom, prenom,mdp, email, civilite, statut, date_enregistrement) VALUES (:pseudo, :nom, :prenom,:mdp, :email, :civilite, :statut, :date_enregistrement )", array(
            ':pseudo'=>$_POST['pseudo'],
            ':nom'=>$_POST['nom'],
            ':prenom'=>$_POST['prenom'],
            ':mdp'=>$mdp,
            ':email'=>$_POST['email'],
            ':civilite'=>$_POST['civilite'],
            ':statut'=>$_POST['statut'],
            ':date_enregistrement'=>date_format(new DateTime(), 'Y-m-d')


        )
    );


}

$resultat= executeRequete("SELECT * FROM membre");

$membres=$resultat->fetchAll(PDO::FETCH_ASSOC);

?>


    <table class="table table-dark">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">pseudo</th>
            <th scope="col">nom</th>
            <th scope="col">prenom</th>
            <th scope="col">email</th>
            <th scope="col">civilite</th>
            <th scope="col">statut</th>
            <th scope="col">date_enregistrement</th>
            <th scope="col">actions</th>
        </tr>
        </thead>
        <tbody>


        <?php foreach ($membres as $membre):  ?>
            <tr>
                <th scope="row"><?= $membre['id_membre'] ?></th>
                <td><?=$membre['pseudo'] ?></td>
                <td><?=$membre['nom'] ?></td>
                <td><?=$membre['prenom']?></td>
                <td><?=$membre['email'] ?></td>
                <td><?=$membre['civilite'] ?></td>
                <td><?=$membre['statut'] ?></td>
                <td><?=$membre['date_enregistrement'] ?></td>
                <td>
                    <form method="post" action="<?= '?id='.$membre['id_membre']; ?>">
                        <div class="form-check form-switch">
                            <input name="statut" value="1" class="form-check-input info" type="checkbox" id="flexSwitchCheckChecked" >
                           <button type="submit" class="btn btn-info">Changer Rôle</button>
                        </div>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>




        <form method="post" action="" enctype="multipart/form-data">
            <div class="row justify-content-between">
                <div class="col-md-5">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Pseudo</label>
                        <input type="text" name="pseudo" placeholder="pseudo"  class="form-control" id="exampleInputPassword1">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                        <input type="text" name="mdp" placeholder="mot de passe"  class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nom</label>
                        <input type="text" name="nom" placeholder=" votre nom"  class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Prenom</label>
                        <input type="text" name="prenom" placeholder="votre prenom"  class="form-control" id="exampleInputPassword1">
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Email</label>
                        <input type="text" name="email" placeholder="votre email"  class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Civilité</label>
                        <select class="form-select" name="civilite" aria-label="Default select example">
                            <option value="m">Homme</option>
                            <option value="f">Femme</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Statut</label>
                        <select class="form-select" name="statut" aria-label="Default select example">
                            <option value="0">utilisateur</option>
                            <option value="1">administrateur</option>
                        </select>
                    </div>


                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </div>



        </form>









<?php require_once '../inc/footer.php'; ?>