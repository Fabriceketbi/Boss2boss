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
                    <li><a class="btn btn--header-white--orange active_etp" href="../pages/_entrepreneur2demain.php">entrepreneur2demain</a></li>
                    <li><a class="btn btn--header-white--red" href="../pages/_lespepes.php">les pépés flingueurs</a></li>
                    <li><a class="btn btn--header-white--red-basic" href="../pages/_mouvement-outside.php">mouvement</a></li>
                    <li><a class="btn btn--header-white--blue" href="../pages/_mouvement-outside.php">outside the box</a></li>
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
                <li><a class="menu_berger-itm" href="../pages/_mouvement-outside.php">outside the box</a></li>
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
    <section class="section_card--var order1">
            <div class="presentation">
                <img class="logo_entrepreneurs2demain" src="../assets/img/entrepreneurs2demainblack.png" alt="">
            
            <p class="section_card--txt">
            Nos formations s'adressent à celles et ceux qui sont de jeunes chef.f.es d'entreprise et/ou qui veulent le devenir 
            et/ou qui sont en pleine réflexion et décision de le devenir ! Deux parcours initiaux pour comprendre, poser et envisager les décisions à prendre pour mettre son business en situation de réussite potentielle.
            </p>
            <div class="content_offers">
                    <h2 class="card_title-underline">Découvrez nos offres</h2>
                    <div class="content_offers_btn">
                        <a href="#cursus5j" class="btn btn--var-orange">CURSUS 5 JOURS</a>
                        <a href="#cursus3j" class="btn btn--var-orange">CURSUS 3 JOURS</a>
                    </div>
                </div>

        </div>
    </section>
    <div class="infos_offers--var-orange">
        <?= getCursusByDate ($dbCo) ?>
    </div>

        </card>
    </div>
    <div class="content_cursus">
        <section id="cursus3j" class="section_formations">     
            
            <?= getAllFormE2D3J ($dbCo, $errors) ?>
        <div id="cursus5j"></div>
            <?= getAllFormE2D5J ($dbCo, $errors) ?>
        </section>
        
    </div>
    </main>
    <?php require('_footer.php') ?>
    <script type="module" src="../js/script-entrepreneur2demain.js"></script>
</body>
</html>