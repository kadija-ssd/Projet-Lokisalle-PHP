<?php  require_once 'inc/header.php';


if (isset($_GET['id'])){
$req=executeRequete("SELECT p.*, s.* FROM produit p INNER JOIN salle s ON p.id_salle=s.id_salle WHERE id_produit=:id", array(
    ':id'=>$_GET['id']
));
$produit= $req->fetch(PDO::FETCH_ASSOC);
}


if (!empty($_POST)){




    $requete=executeRequete("INSERT INTO avis (id_membre, id_salle,note, commentaire, date_enregistrement) VALUES (:id_membre, :id_salle,:note, :commentaire, :date_enregistrement)", array(
        ':id_membre'=>$_SESSION['membre']['id_membre'],
        ':id_salle'=>$_POST['id_salle'],
        ':note'=>$_POST['note'],
        ':commentaire'=>$_POST['commentaire'],
        ':date_enregistrement'=>date_format(new DateTime(), 'Y-m-d')
    ));


    $_SESSION['messages']['info'][]="Merci pour votre contribution";
    header("location:./");
    exit();


}




?>


    <style>
        .rating {
            position: relative;
            width: 180px;
            background: transparent;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.3em;
            padding: 5px;
            overflow: hidden;
            border-radius: 20px;
            box-shadow: 0 0 2px #b3acac;
        }

        .rating__result {
            position: absolute;
            top: 0;
            left: 0;
            transform: translateY(-10px) translateX(-5px);
            z-index: -9;
            font: 3em Arial, Helvetica, sans-serif;
            color: #ebebeb8e;
            pointer-events: none;
        }

        .rating__star {
            font-size: 1.3em;
            cursor: pointer;
            color: #dabd18b2;
            transition: filter linear 0.3s;
        }

        .rating__star:hover {
            filter: drop-shadow(1px 1px 4px gold);
        }
    </style>

    <div class="row justify-content-around">
        <div class="col-md-10"><h1><?=  $produit['titre'] ; ?></h1></div>
        <div class="col-md-1"></div>
    </div>
    <hr>
    <div class="row justify-content-around mb-4">
        <div class="col-md-9">

            <img src="<?=  $produit['photo'] ; ?>" alt="">
        </div>
        <div class="col-md-3">
            <form class="mt-4" action="" method='post'>
                <div class="rating">
                    <span class="rating__result"></span>
                    <i class="rating__star far fa-star"></i>
                    <i class="rating__star far fa-star"></i>
                    <i class="rating__star far fa-star"></i>
                    <i class="rating__star far fa-star"></i>
                    <i class="rating__star far fa-star"></i>
                </div>
                <input type="hidden" id='note' name='note'>
                <input type="hidden" name='id_salle' value="<?=  $produit['id_salle'] ; ?>">
                <div class="form-group">
                    <label for="exampleTextarea" class="form-label mt-4">commentaire</label>
                    <textarea class="form-control border" name="commentaire" id="exampleTextarea" rows="3"></textarea>
                </div>
                <button type="submit" class="btn mt-2 btn-sm btn-primary">Soumettre</button>
            </form>

        </div>
    </div>





    <script>
        const ratingStars = [...document.getElementsByClassName("rating__star")];
        const ratingResult = document.querySelector(".rating__result");
        let note = document.getElementById('note');

        printRatingResult(ratingResult);

        function executeRating(stars, result) {
            const starClassActive = "rating__star fas fa-star";
            const starClassUnactive = "rating__star far fa-star";
            const starsLength = stars.length;
            let i;
            stars.map((star) => {
                star.onclick = () => {
                    i = stars.indexOf(star);

                    if (star.className.indexOf(starClassUnactive) !== -1) {
                        printRatingResult(result, i + 1);
                        let rating = 0;
                        for (i; i >= 0; -- i)
                            stars[i].className = starClassActive;



                    } else {
                        printRatingResult(result, i);
                        for (i; i < starsLength; ++ i)
                            stars[i].className = starClassUnactive;



                    }
                };
            });
        }

        function printRatingResult(result, num = 0) {
            result.textContent = `${num}/5`;
            note.value = num
        }

        executeRating(ratingStars, ratingResult);
    </script>



<?php  require_once 'inc/footer.php'; ?>