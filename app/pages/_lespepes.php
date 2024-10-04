<?php

session_start();

require_once '../includes/_fonctions.php';
include '../includes/_database.php';

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
                    <li><a class="btn btn--header-white--red active_ppfl" href="../pages/_lespepes.php">les pépés flingueurs</a></li>
                    <li><a class="btn btn--header-white--green" href="../pages/_b2btv.php">B2B TV</a></li>
                </ul>
                
            </nav>
            <a type="mail" href="mailto:fpineda@fpineda.co" class="btn btn--var-green">Contact</a>
        </div>
        <div class="header_nav--mobile">
            <div >
                <a href="/"><img class="nav_logo-mobile" src="../assets/img/b2b.png" alt=""></a>
            </div>
            <div class="nav_menu_berger"><img src="../assets/svg/menu_berger.svg" alt="">
            </div>
        </div>
        <div class="hidden nav_menu_berger-open">
            <ul class="nav_menu_berger-open--lst">
                <li><a class="menu_berger-itm" href="../pages/_afterboss.php">afterboss</a></li>
                <li><a class="menu_berger-itm" href="../pages/_entrepreneur2demain.php">entrepreneur2demain</a></li>
                <li><a class="menu_berger-itm" href="../pages/_lespepes.php">les pépés flingueurs</a></li>
                <li><a class="menu_berger-itm" href="../pages/_b2btv.php">B2B TV</a></li>
                <li><a class="menu_berger-itm" type="mail" href="mailto:fpineda@fpineda.co">Contact</a></li>
            </ul>
        </div>   
    </header>
    <main class="main--lespepes">
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
        ?>
    <section class="section_card--var-lespepes">
            <div class="presentation">
                <img class="logo_lespepesflingueurs" src="../assets/img/lespepesflingueursblack.png" alt="">
            
            <p class="section_card--txt">
            Avec une liberté totale de ton, les "Pépés Flingueurs" - 70 ans
            d'entreprenariat cumulé à 2 - abordent des sujets complexes sans détour mais avec humour et bienveillance. Quitte à regarder la vérité en face, autant sourire au miroir !
            </p>

            <section class="section_peoples">

                <div class="perso">
                    <img class="perso_img" src="../assets/img/FrançoisPineda.png" alt="">
                    <h2 class="name">François PINEDA</h2>
                </div>

                <div class="perso">
                    <img class="perso_img" src="../assets/img/ThierryPerrette.png" alt="">
                    <h2 class="name">Thierry PERRETTE</h2>
                </div>

            </section>

            <!-- <p class="txt_short--var">LA PROCHAINE SESSION</p> -->
        </div>
    </section>
    <div class="infos_offers--var-red">
            <?= getFormLesPepesByDate($dbCo) ?>
    </div>
    
    </div>
    <div id="conférences" class="banner_offers--var-red">
        <h2 class="banner_title">CONFÉRENCES</h2>
        <p class="banner_txt">A l’occasion d’une conférence de 90 minutes animée en duo, des sujets-clefs d’actualité sont abordés : image de soi, management multigénérationnelle, changements sociétaux… Dire, réfléchir et rire (souvent de soi) sont au programme.</p>
    </div>
    <section class="section_formations">
        
        <?= getAllFormLppF($dbCo, $errors) ?>

    </section>
    </main>
    <?php require('_footer.php') ?>
    <script type="module" src="../js/script-lespepesflingueurs.js"></script>
</body>
</html>