<?php
require_once '../includes/_fonctions.php';
include '../includes/_database.php';
include '../includes/_config.php';

session_start();
generateToken();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>boss2boss</title>
</head>

<body>
    <header>
        <div class="header_nav--desktop">
            <a href="/"><img class="nav_logo" src="../assets/img/b2b.png" alt=""></a>
            <nav>
                <ul class="nav_lst">
                    <li><a class="btn btn--header-white--purple" href="../pages/_afterboss.php">afterboss</a></li>
                    <li><a class="btn btn--header-white--orange" href="../pages/_entrepreneur2demain.php">entrepreneur2demain</a></li>
                    <li><a class="btn btn--header-white--red" href="../pages/_lespepes.php">les pépés flingueurs</a></li>
                    <li><a class="btn btn--header-white--red-basic active_mouv" href="../pages/_mouvement-outside.php">mouvement</a></li>
                    <li><a class="btn btn--header-white--blue active_outside" href="../pages/_mouvement-outside.php">outside the box</a></li>
                    <li><a class="btn btn--header-white--green" href="../pages/_b2btv.php">B2B TV</a></li>
                </ul>

            </nav>
            <a type="mail" href="mailto:fpineda@fpineda.co" class="btn btn--var-green">Contact</a>
        </div>
        <div class="header_nav--mobile">
            <div>
                <a href="/"><img class="nav_logo-mobile" src="../assets/img/b2b.png" alt=""></a>
            </div>
            <div class="nav_menu_berger">
                <img src="../assets/svg/menu_berger.svg" alt="">
            </div>
        </div>
        <div class="hidden nav_menu_berger-open">
            <ul class="nav_menu_berger-open--lst">
                <li><a class="menu_berger-itm" href="../pages/afterboss.php">afterboss</a></li>
                <li><a class="menu_berger-itm" href="../pages/_entrepreneur2demain.php">entrepreneur2demain</a></li>
                <li><a class="menu_berger-itm" href="../pages/_lespepes.php">les pépés flingueurs</a></li>
                <li><a class="menu_berger-itm" href="../pages/_mouvement-outside.php">mouvement</a></li>
                <li><a class="menu_berger-itm" href="../pages/_mouvement-outside.php">outside the box</a></li>
                <li><a class="menu_berger-itm" href="../pages/_b2btv.php">B2B TV</a></li>
                <li><a class="menu_berger-itm" type="mail" href="mailto:fpineda@fpineda.co">Contact</a></li>
            </ul>
        </div>
    </header>
    <main class="main--mouv-outside">
        
    <section class="section_card">
            <div class="presentation">
                <img class="logo_mouvement" src="../assets/img/mouvement.png" alt="">

                <p class="section_card--txt">
                    Au travers de conférences-débats, WORKFLOW propose des approches concrètes, pratiques et opérationnelles avec un objectif simple : trouver des clefs d’optimisation à effet immédiat.
                </p>

                <div>
                    <a class="btn btn--var-red-basic" href="pages/">WORKFLOW</a>
                </div>
            </div>
        </section>
        <div class="infos_workflow">

            <?= getFormMouvementByDate($dbCo) ?>
        </div>
        <div>
        <?= getAllFormMouvement($dbCo, $errors) ?>
        </div>
        </section>





    </main>
    <?php require('_footer.php') ?>
    <script type="module" src="../js/script-mouv.js"></script>
</body>

</html>