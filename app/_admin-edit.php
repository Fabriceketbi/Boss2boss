<?php
include './includes/_fonctions.php';
// testCo($dbCo);

generateToken();
var_dump($_REQUEST);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <main class="main_admin">
        <section class="section_form">

            <div class="content_form">
                <h2>Formulaire de modification de formation</h2>

                <?= editFormation($dbCo, 'getAllHosts($dbCo)') ?>
                <!-- <form id="" class="form_formation" action="../actions.php" method="post">

                    <label for="inputName" class="">Nom formation</label>
                    <input type="text" name="name" class="input" id="inputName" aria-describedby="">

                    <label for="inputSubtitle" class="">Sous-titre</label>
                    <input type="text" name="subtitle" class="input" id="inputSubtitle" aria-describedby="">


                    <label for="inputDescription" class="">Description</label>
                    <textarea type="textearea" name="description" class="input-txt" id="inputDescription" aria-describedby="" rows="5" cols="33"></textarea>


                    <label for="intervenant-select">intervenant</label>

                    <select class="input" name="name_host" id="">
                        <option value="">Choisir un intervenant</option>
                        <?= getAllHosts($dbCo) ?>
                    </select>


                    <label for="category-select">catégorie</label>

                    <select class="input" name="category" id="">
                        <option value="">Choisir une catégorie</option>
                        <?= getAllCategories($dbCo) ?>
                    </select>


                    <label for="">sous-catégorie</label>

                    <select class="input" name="subCategory" id="">
                        <option value="">Choisir une sous-catégorie</option>
                        <?= getAllSubCategorie($dbCo) ?>
                    </select>


                    <label for="inputLocalisation" class="">Localisation</label>
                    <input type="text" name="localisation" class="input" id="inputLocalisation" aria-describedby="">


                    <label for="inputDate" class="">Date 1</label>
                    <input type="date" name="date1" class="input" id="inputDate" aria-describedby="">

                    <label for="inputDate2" class="">Date 2</label>
                    <input type="date" name="date2" class="input" id="inputDate2" aria-describedby="">

                    <label for="inputDate3" class="">Date 3</label>
                    <input type="date" name="date3" class="input" id="inputDate3" aria-describedby="">

                    <label for="inputTime" class="">Durée</label>
                    <input type="text" name="time" class="input" id="inputTime" aria-describedby="">


                    <div class="content_btn">
                        <input type="submit" value="Valider" class="btn btn--var-green">
                        <input id="token" type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                        <input type="hidden" name="action" value="create-formation">
                    </div>
                </form> -->
            </div>
        </section>
    </main>
</body>

</html>