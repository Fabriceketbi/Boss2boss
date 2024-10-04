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
                    <li><a class="btn btn--header-white--green active_b2btv" href="../pages/_b2btv.php">B2B TV</a></li>
                </ul>
            </nav>
            <a type="mail" href="mailto:fpineda@fpineda.co" class="btn btn--var-green">Contact</a>
        </div>
        <div class="header_nav--mobile header_nav--mobile-b2btv">
            <div>
                <a href="/"><img class="nav_logo-mobile" src="../assets/img/b2b.png" alt=""></a>
            </div>
            <div class="nav_menu_berger">
                <img src="../assets/svg/menu_berger.svg" alt="">
            </div>
        </div>
        <div class="hidden nav_menu_berger-open nav_menu_berger-open-b2btv">
            <ul class="nav_menu_berger-open--lst">
                <li><a class="menu_berger-itm" href="../pages/_afterboss.php">afterboss</a></li>
                <li><a class="menu_berger-itm" href="../pages/_entrepreneur2demain.php">entrepreneur2demain</a></li>
                <li><a class="menu_berger-itm" href="../pages/_lespepes.php">les pépés flingueurs</a></li>
                <li><a class="menu_berger-itm" href="../pages/_b2btv.php">B2B TV</a></li>
                <li><a class="menu_berger-itm" type="mail" href="mailto:fpineda@fpineda.co">Contact</a></li>
            </ul>
        </div>


        <div class="header_content-b2btv">
            <div class="header_content-img">
                
                <img class="" src="../assets/img/b2btv-img-header-S.png" alt="">
              
                <div class="header_content-banner">
                    
                <figure>
                <picture>
                    <source media="(min-width: 960px)" srcset="../assets/img/img-tlt-les-rencontres-XL.png">
                    <img src="../assets/img/img-tlt-les-rencontres-S.png" alt="">
                </picture>
                <figcaption></figcaption>
                </figure>    

                    <p class="header_sub-ttl">
                        En toute intimité au coeur de l’emploi et de l’entreprise 
                    </p>
                </div>
            </div>
        
                <h2 class="banner-ttl-b2btv">
                    Découvre tous nos programmes
                </h2>

                <div class="header_content-banner-nav">
                    <a class="btn btn-green" href="">Les rencontres</a>
                    <a class="btn btn-green" href="">Conjuguer au féminin</a>
                    <a class="btn btn-green" href="">Virage</a>
                </div>
        </div>
    </header>

    <main>
        <section class="au-feminin">
            <div class="content-presentation">

            <figure>
                <picture>
                    <source media="(min-width: 960px)" srcset="../assets/img/img-tlt-aufeminin-XL.png">
                    <img src="../assets/img/img-tlt-aufeminin-S.png" alt="">
                </picture>
                <figcaption></figcaption>
            </figure>

                <p class="presentation-txt">
                    Au travers d’une ballade filmée dans l’entreprise, au travers de questions portées sur “l’intime” plus que l’organisationnel, portrait de femmes entrepreneures, leurs forces et faiblesses, la place du regard des autres mais plus encore, l’équilibre entre la vie pro et la vie perso, les enfants...
                </p>
            </div>
                <div class="slider-items">
                    <!-- <div class="slider-item"> -->
                    <iframe class="slider-item" width="560" height="315" src="https://www.youtube.com/embed/62PdsOYKVpQ?si=qfdja0QJ-x87Q5nt" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

                    <!-- </div> -->

                    <!-- <div class="slider-item"> -->
                    <iframe class="slider-item" width="560" height="315" src="https://www.youtube.com/embed/vayDIshiVGQ?si=6m3zAnN9oZKnRc6h" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

                    <!-- </div> -->

                    <!-- <div class="slider-item"> -->
                    <iframe class="slider-item" width="560" height="315" src="https://www.youtube.com/embed/m7qlSGhSLq8?si=xBfh_jqNoy4f6sp2" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

                    <!-- </div> -->

                    <!-- <div class="slider-item"> -->
                    <iframe class="slider-item" width="560" height="315" src="https://www.youtube.com/embed/H9n-mc8qS1o?si=5rA-t4xc_QGiCmZB" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

                </div>
        </section>
        <section class="les-rencontres">
            <div class="content-presentation">
                <figure>
                    <picture>
                        <source media="(min-width: 960px)" srcset="../assets/img/img-tlt-les-rencontres-XL-var.png">
                        <img src="../assets/img/img-tlt-les-rencontres-S-var.png" alt="">
                    </picture>
                    <figcaption></figcaption>
                </figure>
                <p class="presentation-txt">
                    Au travers d’une ballade filmée dans l’entreprise, au travers de questions portées sur “l’intime” plus que l’organisationnel, portrait de femmes entrepreneures, leurs forces et faiblesses, la place du regard des autres mais plus encore, l’équilibre entre la vie pro et la vie perso, les enfants...
                </p>
            </div>

            <div class="slider-items">
                    <div class="slider-item">
                        <iframe src="https://youtube.com/embed/AOS6gr9NkCo" frameborder="0" s></iframe>
                        <h3 class="slider-item-ttl">Titre vidéo</h3>
                    </div>

                    <div class="slider-item">
                        <iframe src="https://youtube.com/embed/AOS6gr9NkCo" frameborder="0" s></iframe>
                        <h3 class="slider-item-ttl">Titre vidéo</h3>
                    </div>

                    <div class="slider-item">
                        <iframe src="https://youtube.com/embed/AOS6gr9NkCo" frameborder="0" s></iframe>
                        <h3 class="slider-item-ttl">Titre vidéo</h3>
                    </div>

                    <div class="slider-item">
                        <iframe src="https://youtube.com/embed/AOS6gr9NkCo" frameborder="0" s></iframe>
                        <h3 class="slider-item-ttl">Titre vidéo</h3>
                    </div>

                </div>
        </section>
        <section class="virage">
            <div class="content-presentation">
                <figure>
                    <picture>
                        <source media="(min-width: 960px)" srcset="../assets/img/img-tlt-virage-XL.png">
                        <img src="../assets/img/img-tlt-virage-S.png" alt="">
                    </picture>
                    <figcaption></figcaption>
                </figure>

                <p class="presentation-txt">
                    Dans un format interview, en situation figée, rencontre autour de la question de l’avenir professionnel, après des études, à l’heure d’une reconversion... avec toujours la même question centrale : comment être heureux.se dans ma vie professionnelles ? 
                </p>
            </div>
                <div class="slider-items">
                    <div class="slider-item">
                        <iframe src="https://youtube.com/embed/AOS6gr9NkCo" frameborder="0" s></iframe>
                        <h3 class="slider-item-ttl">Titre vidéo</h3>
                    </div>

                    <div class="slider-item">
                        <iframe src="https://youtube.com/embed/AOS6gr9NkCo" frameborder="0" s></iframe>
                        <h3 class="slider-item-ttl">Titre vidéo</h3>
                    </div>

                    <div class="slider-item">
                        <iframe src="https://youtube.com/embed/AOS6gr9NkCo" frameborder="0" s></iframe>
                        <h3 class="slider-item-ttl">Titre vidéo</h3>
                    </div>

                    <div class="slider-item">
                        <iframe src="https://youtube.com/embed/AOS6gr9NkCo" frameborder="0" s></iframe>
                        <h3 class="slider-item-ttl">Titre vidéo</h3>
                    </div>

                </div>
        </section>
    </main>

    <?php require('_footer.php') ?>
    <script type="module" src="../js/script-b2btv.js"></script>
    </body>
    </html>