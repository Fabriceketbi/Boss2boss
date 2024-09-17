<?php
include './includes/_fonctions.php';
include './includes/_database.php';
include './includes/_config.php';

session_start();
generateToken();


if (!isset($_SESSION["id_admin"])) {
    redirectTo('_connexion.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<header>
        <div class="header_nav--desktop">
            <a href="/"><img class="nav_logo" src="assets/img/boss2boss_white.png" alt=""></a>
            <nav>
                <ul class="nav_lst">
                    <li><a class="btn btn--header-white--purple" href="./pages/_afterboss.php">Afterboss</a></li>
                    <li><a class="btn btn--header-white--orange" href="./pages/_entrepreneur2demain.php">Entrepreneurs2demain</a></li>
                    <li><a class="btn btn--header-white--red" href="./pages/_lespepes.php">Les Pépés Flingueurs</a></li>
                </ul>
                
            </nav>
            <a type="mail" href="mailto:fpineda@fpineda.co" class="btn btn--var-green">Contact</a>
        </div>
        <div class="header_nav--mobile">
            <div class="nav_logo">
                <a href=""><img src="assets/svg/logo.svg" alt=""></a>
            </div>
            <div class="nav_menu_berger"><img src="assets/svg/menu_berger.svg" alt="">
            </div>
        </div>
        <div class="nav_menu_berger-open">
            <ul class="nav_menu_berger-open--lst">
                <li><a class="menu_berger-itm" href="./pages/_afterboss.php">Afterboss</a></li>
                <li><a class="menu_berger-itm" href="./pages/_entrepreneur2demain.php">Entrepreneurs2demain</a></li>
                <li><a class="menu_berger-itm" href="./pages/_lespepes.php">Les Pépés Flingueurs</a></li>
                <li><a class="menu_berger-itm" type="mail" href="mailto:fpineda@fpineda.co">Contact</a></li>
            </ul>
        </div>

    </header>

<body>

    <main class="main_admin">
        <div class="deconnection">
            <p><?= (!empty( $_SESSION['admin_name'] ) ? 'Bonjour ' . $_SESSION['admin_name'] : '') ?></p>
            <form action="../actions.php" method="post">
                <input type="submit" value="Déconnexion" class="btn btn--var-deconnection">
                <input  type="hidden" name="action" value="deconnection">
            </form>
        </div>
        <section class="section_form">
            
            <div class="content_form">
                <h2>Formulaire de création de formation</h2>
                <form id="" class="form_formation" action="../actions.php" method="post">

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

                    <?php if (isset($_SESSION['errorsList']) && in_array('host', $_SESSION['errorsList'])) {

                        echo
                        displayErrorMsg('host', $_SESSION['errorsList'], $errors);
                    } ?>


                    <label for="category-select">catégorie</label>

                    <select class="input" name="category" id="">
                        <option value="">Choisir une catégorie</option>
                        <?= getAllCategories($dbCo) ?>
                    </select>

                    <?php if (isset($_SESSION['errorsList']) && in_array('category', $_SESSION['errorsList'])) {

                        echo
                        displayErrorMsg('add-category_ko', $_SESSION['errorsList'], $errors);
                    } ?>


                    <label for="">sous-catégorie</label>

                    <select class="input" name="subCategory" id="">
                        <option value="">Choisir une sous-catégorie</option>
                        <?= getAllSubCategorie($dbCo) ?>
                    </select>
                    <?php if (isset($_SESSION['errorsList']) && in_array('sub_category', $_SESSION['errorsList'])) {

                        echo
                        displayErrorMsg('sub_category', $_SESSION['errorsList'], $errors);
                        unset($_SESSION['errorsList']);
                    } ?>


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
                </form>
            </div>


            <div class="content_form">
                <h2>Formulaire d'ajout d'intervenant</h2>
                <form id="" class="form_formation" action="../actions.php" method="post">

                    <label for="inputName" class="">Nom de l'intervenant</label>
                    <input type="text" name="name" class="input" id="inputName" aria-describedby="">

                    <div class="content_btn">
                        <input type="submit" value="Valider" class="btn btn--var-green">
                        <input id="token" type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                        <input type="hidden" name="action" value="add-intervenant">
                    </div>
                </form>



                <h2>Formulaire d'ajout de catégorie</h2>

                <form id="" class="form_formation" action="../actions.php" method="post">

                    <label for="inputName" class="">Nom de la catégorie</label>
                    <input type="text" name="name" class="input" id="inputName" aria-describedby="">

                    <div class="content_btn">
                        <input type="submit" value="Valider" class="btn btn--var-green">
                        <input id="token" type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                        <input type="hidden" name="action" value="add-category">
                    </div>
                </form>


                <h2>Formulaire d'ajout de sous-catégorie</h2>

                <form id="" class="form_formation" action="../actions.php" method="post">

                    <label for="inputName" class="">Nom de la sous-catégorie</label>
                    <input type="text" name="name" class="input" id="inputName" aria-describedby="">

                    <div class="content_btn">
                        <input type="submit" value="Valider" class="btn btn--var-green">
                        <input id="token" type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                        <input type="hidden" name="action" value="add-sub-category">
                    </div>
                </form>

                <div class="separator--form"></div>
                <h2>Formulaire de création de compte admin</h2>

                <form id="" class="form_formation" action="../actions.php" method="post">

                    <label for="inputNameAdmin" class="">Nom</label>
                    <input type="text" name="nameAdmin" class="input" id="inputNameAdmin" aria-describedby="">

                    <label for="inputPassword" class="">Mot de passe</label>
                    <input type="password" name="password" class="input" id="inputPassword" aria-describedby="">

                    <div class="content_btn">
                        <input type="submit" value="Valider" class="btn btn--var-green">
                        <input id="token" type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                        <input type="hidden" name="action" value="create-admin">
                    </div>
                </form>

            </div>
        </section>
        <section class="section_recap-form">

            <?= getAllForm($dbCo) ?>


        </section>
    </main>


</body>

</html>