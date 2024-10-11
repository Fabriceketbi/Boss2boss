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
                    <li><a class="btn btn--header-white--purple active_afterboss" href="../pages/_afterboss.php">afterboss</a></li>
                    <li><a class="btn btn--header-white--orange" href="../pages/_entrepreneur2demain.php">entrepreneur2demain</a></li>
                    <li><a class="btn btn--header-white--red" href="../pages/_lespepes.php">les pépés flingueurs</a></li>
                    <li><a class="btn btn--header-white--red-basic" href="../pages/_mouvement-outside.php">mouvement</a></li>
                    <li><a class="btn btn--header-white--blue" href="../pages/_mouvement-outside.php#outsideTheBox">outside the box</a></li>
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
                <li><a class="menu_berger-itm" href="../pages/_afterboss.php">afterboss</a></li>
                <li><a class="menu_berger-itm" href="../pages/_entrepreneur2demain.php">entrepreneur2demain</a></li>
                <li><a class="menu_berger-itm" href="../pages/_lespepes.php">les pépés flingueurs</a></li>
                <li><a class="menu_berger-itm" href="../pages/_mouvement-outside.php">mouvement</a></li>
                <li><a class="menu_berger-itm" href="../pages/_mouvement-outside.php#outsideTheBox">outside the box</a></li>
                <li><a class="menu_berger-itm" href="../pages/_b2btv.php">B2B TV</a></li>
                <li><a class="menu_berger-itm" type="mail" href="mailto:fpineda@fpineda.co">Contact</a></li>
            </ul>
        </div>
    </header>
    <main class="main--afterwork">
        <?php
            if (isset($_SESSION['errorsList']) && in_array('echec_inscription', $_SESSION['errorsList'])) {

                echo '
                <div data-msg="" class="show-msg">
                    <div class="content_error">
                    <div class="content_error-cross">
                        <img class="cross-img" src="../assets/img/close.png" alt="">
                    </div>
                    
                    '.displayErrorMsg('echec_inscription', $_SESSION['errorsList'], $errors).'
                    
                    </div>
                </div>';
                }
            if (isset($_SESSION['msg']) && in_array('inscription_ok', $_SESSION['msg'])) {
                
                echo '
                <div data-msg="" class="show-msg">
                    <div data-msg="" class="content_success">
                    <div class="content_success-cross">
                        <img class="cross-img" src="../assets/img/close.png" alt="">
                    </div>

                    '.displaySuccesMsg('inscription_ok', $_SESSION['msg'], $messages).'

                    </div>
                </div>';
                
            }
            unset($_SESSION['msg']);
            unset($_SESSION['id_form-select']);
        ?>
        <section class="section_card--var">

            <div class="presentation">
                <img class="logo_afterboss" src="../assets/img/afterbossvar.png" alt="">

                <p class="section_card--txt">
                    Si personne ne détient la vérité, à plusieurs, on est sûrement plus intelligents ! Sur une thématique donnée, des échanges simples, <span class="txt_short--span">sans tabou</span> sur les maux qui pèsent sur les chef.fes d’entreprise comme sur les dirigeant.es d’entreprise.
                    Une logique collaborative, conviviale et profondément résiliente.
                </p>
                <div class="content_offers">
                    <div class="content_offers_btn">
                        <a href="#afterwork" class="btn btn--var-purple">AFTERWORK</a>
                        <a href="#atelier" class="btn btn--var-purple">LES ATELIERS</a>
                    </div>
                </div>
            </div>
        </section>
        <div class="infos_offers--var">
            <?= getFormAwByDate($dbCo) ?>
        </div>

        </card>
        </div>
        <div id="afterwork" class="banner_offers">
            <h2 class="banner_title">AFTER WORK</h2>
            <p class="banner_txt">Autour d’une thématique animée par un expert, cinq à six chefs d’entreprises échangents, mettent en commun et envisagent des solutions.</p>
        </div>

        <section class="section_formations">
            <?= getFormAbAw($dbCo, $errors) ?>
        </section>

        <div id="atelier" class="banner_offers">
            <h2 class="banner_title">LES ATELIERS</h2>
            <p class="banner_txt">Animé par un.e expert.e, une demi-journée 100% pratique pour traiter d’une problématiques... et la régler !</p>
        </div>

        <section class="section_formations">
            <?= getAllFormAbLa($dbCo, $errors) ?>
        </section>

    </main>
    <?php require('_footer.php') ?>
    <!-- <script type="module" src="../js/script-menu_burger.js"></script> -->
    <script type="module" src="../js/script-afterboss.js"></script>
</body>

</html>