<?php
 require_once '../inc/header.php';





if(!empty($_POST)):

    $resultat=executeRequete("SELECT * FROM membre WHERE email=:email", array(
            ':email'=>$_POST['email']
    ));

     if ($resultat->rowCount() == 1){

         $membre=$resultat->fetch(PDO::FETCH_ASSOC);




         if (password_verify($_POST['mdp'], $membre['mdp'])){


             $_SESSION['membre']=$membre;
             $_SESSION['messages']['success'][]='Bienvenue '.$membre['pseudo'];
             echo '<script>
             window.location.href = \'http://localhost/lokisalle/\';
             </script>';

         }else{

             $_SESSION['messages']['danger'][]='Erreur sur le mot de passe';
            echo '<script>
             window.location.href = \'http://localhost/lokisalle/membre/login.php\';
             </script>';

         }


     }







 endif;











?>



<form method="post" action="">

    <section class="vh-100 bg-image" style="background-color: #C7C8C9;">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">Connexion</h2>

                                <label for="inputEmail">Email</label>
                                <input type="email" value="" name="email" id="inputEmail"
                                       class="form-control" autocomplete="email" required autofocus>
                                <label for="inputPassword" class="mt-3">Mot de passe</label>
                                <input type="password" name="mdp" id="inputPassword" class="form-control"
                                       autocomplete="current-password" required>


                                <button class="btn mb-2 mt-3 mb-md-0 btn-outline-secondary btn-block" type="submit">
                                    Se connecter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</form>







<?php  require_once '../inc/footer.php'?>
