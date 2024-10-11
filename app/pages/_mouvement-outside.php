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
                    <li><a class="btn btn--header-white--purple" href="_afterboss.php">afterboss</a></li>
                    <li><a class="btn btn--header-white--orange" href="_entrepreneur2demain.php">entrepreneur2demain</a></li>
                    <li><a class="btn btn--header-white--red" href="_lespepes.php">les pépés flingueurs</a></li>
                    <li><a class="btn btn--header-white--red-basic active_mouv" href="_mouvement-outside.php">mouvement</a></li>
                    <li><a class="btn btn--header-white--blue active_outside" href="_mouvement-outside.php#outsideTheBox">outside the box</a></li>
                    <li><a class="btn btn--header-white--green" href="_b2btv.php">B2B TV</a></li>
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
                <li><a class="menu_berger-itm" href="_afterboss.php">afterboss</a></li>
                <li><a class="menu_berger-itm" href="_entrepreneur2demain.php">entrepreneur2demain</a></li>
                <li><a class="menu_berger-itm" href="_lespepes.php">les pépés flingueurs</a></li>
                <li><a class="menu_berger-itm" href="_mouvement-outside.php">mouvement</a></li>
                <li><a class="menu_berger-itm" href="_mouvement-outside.php#outsideTheBox">outside the box</a></li>
                <li><a class="menu_berger-itm" href="_b2btv.php">B2B TV</a></li>
                <li><a class="menu_berger-itm" type="mail" href="mailto:fpineda@fpineda.co">Contact</a></li>
            </ul>
        </div>
    </header>
    <main class="main--mouv-outside">
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
    <section class="section_mouv">

            <div class="presentation_mouv">
                <img class="logo_mouvement" src="../assets/img/mouvement.png" alt="">

                <p class="section_card--txt">
                    Au travers de conférences-débats, WORKFLOW propose des approches concrètes, pratiques et opérationnelles avec un objectif simple : trouver des clefs d’optimisation à effet immédiat.
                </p>

                <div>
                    <a class="btn btn--var-red-basic" href="_mouvement-outside.php#mouv">WORKFLOW</a>
                </div>
            </div>

        <div class="infos_workflow">
            <?= getFormMouvementByDate($dbCo) ?>
        </div>

        <div id="mouv" class="content_form-mouv">
        <?= getAllFormMouvement($dbCo, $errors) ?>
        </div>
        
    </section>

    <section id="outsideTheBox">
            <div class="presentation_outside">
                <img class="logo_outside" src="../assets/img/outsidetheboxcoul.png" alt="">

                <p class="section_card--txt">
                    Et si la solution n’était pas de résoudre les problèmes, mais de changer notre regard sur eux ?
                </p>
                <p class="section_card--txt">
                    OUTSIDE THE BOX place l’humain au centre d’une expérience unique. Grâce à des conférences scénarisées et immersives, nous abordons des thématiques sociétales percutantes et profondément actuelles : pression sociale, peur de l’avenir après les études, et bien d’autres. L’objectif ? Créer un échange riche, authentique, et sans filtre. Il ne s’agit pas de fournir des réponses toutes faites, mais de remettre en question les normes, d’ouvrir de nouvelles perspectives, et d’armer chacun des participants pour tracer leur propre chemin et enfin mettre du sens aux doutes qui les habitent.
                </p>

                <div>
                    <a class="btn btn--var-blue" href="_mouvement-outside.php#outside">DEVENIR ACTEUR DE SA RÉUSSITE</a>
                </div>
            </div>

        <div class="infos_outside">
            <?= getFormOutsideByDate($dbCo) ?>
        </div>

        <div id="outside" class="content_form-outside">
            <?= getAllFormOutside($dbCo, $errors) ?>
        </div>
    </section>



    </main>
    <?php require('_footer.php') ?>
    <script type="module" src="../js/script-mouv.js"></script>
</body>

</html>