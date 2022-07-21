<?php require_once "../inc/header.php"; ?>
<?php
//restriction d'accès à la page SI on est connecté :
if( connect() ){

    header('location:inscription.php'); //redirection vers la page de profil
    exit;
}
$error="";
$content="";
//--------------------------------------------------------------------
if( $_POST ){ //Si on valide le formulaire


    //debug( $_POST );

    //Controles sur les saisies de l'internaute (il faudrait faire des controles pour TOUS les inputs du <form>)

    //controle sur la taille du pseudo (15 caractères max)
    if( strlen( $_POST['pseudo'] ) <= 3 || strlen( $_POST['pseudo'] ) > 15 ){
        //SI la taille du speudo postée est inférieure ou égale à 3 - OU QUE - la taille du pseudo posté est supérieur à 15, alors on affiche un message d'erreur
        //strlen() : retourne la taille d'une chaine

        $error .= "<div class='alert alert-danger'> ERREUR taille pseudo (doit comprendre entre 4 et 15 caractères) </div>";
    }
    //EXERCICE PERSO : faire les controles pour le reste des champs ( empty(), taille des saisies, verif email... )

    //-----------------------------
    //Teste si le pseudo est disponible (car on ne peut pas avoir 2 fois le même pseudo car nous l'avons indiqué avec une clé UNIQUE lors de la création de la BDD pour le champ 'pseudo')
    $r = executeRequete("SELECT email FROM membre WHERE email = '$_POST[email]' ");
    //SELECTIONNE le 'pseudo' PROVENANT de la table 'membre' A CONDITION que dans la colonne 'pseudo', ce soit égal à la saisie de l'internaute

    //debug( $r ); //$r représente le jeu de résultat retourné par la requête : un Object PDOStatement

    if( $r->rowCount() >= 1 ){ //SI le résultat est supérieur ou égal à 1, c'est que le pseudo est déjà attribué car il aura trouvé une correspondance dans la table 'membre' et renverra donc UNE ligne de résultat

        $error .= "<div class='alert alert-danger'> Un compte existe à cette adresse mail </div>";
    }

    //-----------------------------
    //boucle sur TOUTES les saisies afin de les passer dans les fonctions htmlentities() et addslashes()

    //-----------------------------
    //Cryptage du mot de passe :
//    $_POST['mdp'] = password_hash( $_POST['mdp'], PASSWORD_DEFAULT);
    //passwrod_hash() : permet de créer une clé de hachage
    //debug( $_POST['mdp'] );

    //-----------------------------
    //INSERTION :
    if( empty( $error ) ){ //SI la variable '$error' est vide (c'est que le formulaire a été rempli correctement), alors on fait l'insertion

        $mdp=password_hash($_POST['mdp'], PASSWORD_BCRYPT);

        executeRequete("INSERT INTO membre( pseudo, mdp, nom, prenom, email, civilite, statut, date_enregistrement )
				VALUES (:pseudo, :mdp, :nom, :prenom, :email, :civilite, :statut, :date_enregistrement)", array(
                        ':pseudo'=>$_POST['pseudo'],
                        ':mdp'=>$mdp,
                        ':nom'=>$_POST['nom'],
                        ':prenom'=>$_POST['prenom'],
                        ':email'=>$_POST['email'],
                        ':civilite'=>$_POST['civilite'],
                         ':statut'=>0,
                        ':date_enregistrement'=>date_format(new DateTime(), 'Y-m-d')

        ));

        $content .= "<div class='alert alert-success'> Inscription validée
						<a href='".SITE."membre/login.php'>Cliquez ici pour vous connecter</a>
					</div>";
    }
}

//--------------------------------------------------------------------
?>
    <h1>INSCRIPTION</h1>

<?php echo $error; //affichage des messages d'erreur ?>

<?= $content; //affichage du contenu ?>

    <form method="post">

        <label>Pseudo</label><br>
        <input type="text" name="pseudo"><br>

        <label>Mot de passe</label><br>
        <input type="text" name="mdp"><br>

        <label>Nom</label><br>
        <input type="text" name="nom"><br>

        <label>Prénom</label><br>
        <input type="text" name="prenom"><br>

        <label>Email</label><br>
        <input type="text" name="email"><br>

        <label>Civilite</label><br>
        <input type="radio" name="civilite" value="f" checked><span>Femme</span><br>
        <input type="radio" name="civilite" value="m"><span>Homme</span><br><br>


        <button type="submit"  class='btn btn-primary'>S'inscrire</button>
    </form>

<?php require_once "../inc/footer.php"; ?>