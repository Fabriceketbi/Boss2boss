<?php
include './includes/_fonctions.php';
include './includes/_database.php';
include './includes/_config.php';

session_start();
generateToken();

// unset($_SESSION['msg']);
// unset($_SESSION['errorsList']);

$csrfToken = $_SESSION['token'];

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

<body>
    <header>
        <div class="header_nav--desktop">
            <a href="/"><img class="nav_logo" src="assets/img/b2b.png" alt=""></a>
            <nav>
                <ul class="nav_lst">
                    <li><a class="btn btn--header-white--purple active" href="./pages/_afterboss.php">afterboss</a></li>
                    <li><a class="btn btn--header-white--orange" href="./pages/_entrepreneur2demain.php">entrepreneur2demain</a></li>
                    <li><a class="btn btn--header-white--red" href="./pages/_lespepes.php">les pépés flingueurs</a></li>
                    <li><a class="btn btn--header-white--red-basic" href="./pages/_mouvement-outside.php">mouvement</a></li>
                    <li><a class="btn btn--header-white--blue" href="./pages/_mouvement-outside.php#outsideTheBox">outside the box</a></li>
                    <li><a class="btn btn--header-white--green" href="./pages/_b2btv.php">B2B TV</a></li>
                </ul>

            </nav>
            <a type="mail" href="mailto:fpineda@fpineda.co" class="btn btn--var-green">Contact</a>
        </div>
        <div class="header_nav--mobile">
            <div class="nav_logo-mobile">
                <a href=""><img class="nav_logo-mobile" src="assets/svg/logo.svg" alt=""></a>
            </div>

            <div class="nav_menu_berger">
                <img class="" src="assets/svg/menu_berger.svg" alt="">
            </div>
        </div>
        <div class="hidden nav_menu_berger-open">
            <ul class="nav_menu_berger-open--lst">
                <li><a class="menu_berger-itm" href="./pages/_afterboss.php">afterboss</a></li>
                <li><a class="menu_berger-itm" href="./pages/_entrepreneur2demain.php">entrepreneur2demain</a></li>
                <li><a class="menu_berger-itm" href="./pages/_lespepes.php">les pépés flingueurs</a></li>
                <li><a class="menu_berger-itm" href="./pages/_mouvement-outside.php">mouvement</a></li>
                <li><a class="menu_berger-itm" href="./pages/_mouvement-outside.php#outsideTheBox">outside the box</a></li>
                <li><a class="menu_berger-itm" href="./pages/_b2btv.php">B2B TV</a></li>
                <li><a class="menu_berger-itm" type="mail" href="mailto:fpineda@fpineda.co">Contact</a></li>
            </ul>
        </div>

    </header>

    <main class="main_admin">

        <?php
        if (isset($_SESSION['errorsList']) && in_array('add-formation_ko', $_SESSION['errorsList'])) {
            getError('add-formation_ko', $errors);
        }

        if (isset($_SESSION['errorsList']) && in_array('edit-formation_ko', $_SESSION['errorsList'])) {
            getError('edit-formation_ko', $errors);
        }

        if (isset($_SESSION['errorsList']) && in_array('supp-formation_ko', $_SESSION['errorsList'])) {
            getError('supp-formation_ko', $errors);
        }

        if (isset($_SESSION['errorsList']) && in_array('insert_video_ko', $_SESSION['errorsList'])) {
            getError('insert_video_ko', $errors);
        }

        if (isset($_SESSION['errorsList']) && in_array('supp-video_ko', $_SESSION['errorsList'])) {
            getError('supp-video_ko', $errors);
        }

        if (isset($_SESSION['msg']) && in_array('add-formation_ok', $_SESSION['msg'])) {

            getMessage('add-formation_ok', $messages);
        }

        if (isset($_SESSION['msg']) && in_array('edit-formation_ok', $_SESSION['msg'])) {

            getMessage('edit-formation_ok', $messages);
        }

        if (isset($_SESSION['msg']) && in_array('supp-formation_ok', $_SESSION['msg'])) {

            getMessage('supp-formation_ok', $messages);
        }

        if (isset($_SESSION['msg']) && in_array('insert_video_ok', $_SESSION['msg'])) {

            getMessage('insert_video_ok', $messages);
        }

        if (isset($_SESSION['msg']) && in_array('supp-video_ok', $_SESSION['msg'])) {

            getMessage('supp-video_ok', $messages);
        }

        unset($_SESSION['msg']);
        unset($_SESSION['id_form-select']);
        ?>


        <div class="deconnection">
            <p><?= (!empty($_SESSION['admin_name']) ? 'Bonjour ' . $_SESSION['admin_name'] : '') ?></p>
            <form action="../actions.php" method="post">
                <input type="submit" value="Déconnexion" class="btn btn--var-deconnection">
                <input type="hidden" name="action" value="deconnection">
                <input id="token" type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
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

                    <label for="inputSpecification" class="">Précision</label>
                    <textarea type="textearea" name="specification" class="input-txt" id="inputSpecification" aria-describedby="" rows="5" cols="33"></textarea>


                    <label for="intervenant-select">intervenant *</label>

                    <select class="input" name="name_host" id="">
                        <option value="">Choisir un intervenant</option>
                        <?= getAllHosts($dbCo) ?>
                    </select>

                    <?php if (isset($_SESSION['errorsList']) && in_array('host', $_SESSION['errorsList'])) {

                        echo
                        displayErrorMsg('host', $_SESSION['errorsList'], $errors);
                    } ?>


                    <label for="category-select">catégorie *</label>

                    <select class="input" name="category" id="">
                        <option value="">Choisir une catégorie</option>
                        <?= getAllCategories($dbCo) ?>
                    </select>

                    <?php if (isset($_SESSION['errorsList']) && in_array('category', $_SESSION['errorsList'])) {

                        echo
                        displayErrorMsg('add-category_ko', $_SESSION['errorsList'], $errors);
                    } ?>


                    <label for="">sous-catégorie *</label>

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

                    <label for="inputParticipant" class="">Nombre maximum de participant * (si pas précisé, mettre 0)</label>
                    <input type="text" name="participants" class="input" id="inputParticipant" aria-describedby="">

                    <?
                    if (isset($_SESSION['errorsList']) && in_array('nb_participants', $_SESSION['errorsList'])) {
                        echo
                        displayErrorMsg('nb_participants', $_SESSION['errorsList'], $errors);
                        unset($_SESSION['errorsList']);
                    }

                    ?>

                    <label for="inputDate" class="">Date 1</label>
                    <input type="date" name="date1" class="input" id="inputDate" aria-describedby="">

                    <label for="inputDate2" class="">Date 2</label>
                    <input type="date" name="date2" class="input" id="inputDate2" aria-describedby="">

                    <label for="inputDate3" class="">Date 3</label>
                    <input type="date" name="date3" class="input" id="inputDate3" aria-describedby="">

                    <label for="inputTime" class="">Durée</label>
                    <input type="text" name="time" class="input" id="inputTime" aria-describedby="">

                    <label for="inputPrice" class="">Prix * (si pas précisé, mettre 0)</label>
                    <input type="text" name="price" class="input" id="inputPrice" aria-describedby="">

                    <?
                    if (isset($_SESSION['errorsList']) && in_array('price', $_SESSION['errorsList'])) {
                        echo
                        displayErrorMsg('price', $_SESSION['errorsList'], $errors);
                        unset($_SESSION['errorsList']);
                    }

                    ?>

                    <label for="inputReducePrice" class="">Prix avec réduction</label>
                    <input type="text" name="reducePrice" class="input" id="inputReducePrice" aria-describedby="">


                    <div class="content_btn">
                        <input type="submit" value="Valider" class="btn btn--var-green">
                        <input id="token" type="hidden" name="token" value="<?php echo htmlspecialchars($csrfToken); ?>">
                        <input type="hidden" name="action" value="create-formation">
                    </div>
                </form>
            </div>


            <div class="content_form">
                <h2>Formulaire d'ajout d'intervenant</h2>
                <form id="" class="form_formation" action="../actions.php" method="post">

                    <label for="inputName" class="">Nom de l'intervenant</label>
                    <input type="text" name="name" class="input" id="inputName" aria-describedby="">

                    <?
                    if (isset($_SESSION['errorsList']) && in_array('name_host', $_SESSION['errorsList'])) {
                        echo
                        displayErrorMsg('name_host', $_SESSION['errorsList'], $errors);
                        unset($_SESSION['errorsList']);
                    }

                    ?>

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

                    <?
                    if (isset($_SESSION['errorsList']) && in_array('name_category', $_SESSION['errorsList'])) {
                        echo
                        displayErrorMsg('name_category', $_SESSION['errorsList'], $errors);
                        unset($_SESSION['errorsList']);
                    }

                    ?>

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

                    <?
                    if (isset($_SESSION['errorsList']) && in_array('name_subCategory', $_SESSION['errorsList'])) {
                        echo
                        displayErrorMsg('name_subCategory', $_SESSION['errorsList'], $errors);
                        unset($_SESSION['errorsList']);
                    }

                    ?>

                    <div class="content_btn">
                        <input type="submit" value="Valider" class="btn btn--var-green">
                        <input id="token" type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                        <input type="hidden" name="action" value="add-sub-category">

                    </div>
                </form>

                <div class="separator--form"></div>

                <h2>Formulaire d'ajout de vidéo</h2>
                <form id="" class="form_formation" action="../actions.php" method="post">

                    <label for="inputLink" class="">Lien de la vidéo</label>
                    <input type="text" name="link" class="input" id="inputLink" aria-describedby="">

                    <?
                    // if (isset($_SESSION['errorsList']) && in_array('name_subCategory', $_SESSION['errorsList'])) {
                    //     echo
                    //     displayErrorMsg('name_subCategory', $_SESSION['errorsList'], $errors);
                    //     unset($_SESSION['errorsList']);
                    // }

                    ?>

                    <div class="content_btn">
                        <input type="submit" value="Valider" class="btn btn--var-green">
                        <input id="token" type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                        <input type="hidden" name="action" value="add-video">

                    </div>
                </form>





                <div class="separator--form"></div>

                <h2>Formulaire de création de compte admin</h2>

                <form id="" class="form_formation" action="../actions.php" method="post">

                    <label for="inputNameAdmin" class="">Nom</label>
                    <input type="text" name="nameAdmin" class="input" id="inputNameAdmin" aria-describedby="">

                    <?
                    if (isset($_SESSION['errorsList']) && in_array('create_nameAdmin', $_SESSION['errorsList'])) {
                        echo
                        displayErrorMsg('create_nameAdmin', $_SESSION['errorsList'], $errors);
                    }

                    ?>

                    <label for="inputPassword" class="">Mot de passe</label>
                    <input type="password" name="password" class="input" id="inputPassword" aria-describedby="">

                    <?
                    if (isset($_SESSION['errorsList']) && in_array('password', $_SESSION['errorsList'])) {
                        echo
                        displayErrorMsg('password', $_SESSION['errorsList'], $errors);
                        unset($_SESSION['errorsList']);
                    }

                    ?>

                    <div class="content_btn">
                        <input type="submit" value="Valider" class="btn btn--var-green">
                        <input id="token" type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                        <input type="hidden" name="action" value="create-admin">
                    </div>
                </form>

            </div>
        </section>
        <h2>Formations enregistrées</h2>
        <section class="section_recap-form">
            <?= getAllForm($dbCo) ?>

        </section>

        <h2>Vidéos enregistrées</h2>
        <section class="section_recap-videos">
            <?=
            getAllVideos($dbCo);
            ?>
        </section>
    </main>
    <script type="module" src="../js/script-admin.js"></script>

</body>

</html>