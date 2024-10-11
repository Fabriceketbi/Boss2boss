<?php 
    include './includes/_fonctions.php';
    include './includes/_database.php';
    include './includes/_config.php';

    session_start();
    generateToken();
    
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

<main class="main_connection">
        
        <form class="form_connection" action="../actions.php" method="post">
        <h2>Connexion</h2> 
        <label for="inputAdminName" class="">Nom</label>
        <input type="text" name="adminName" class="input" id="inputAdminName" aria-describedby="">

        <label for="inputPassword" class="">Mot de passe</label>
        <input type="password" name="password" class="input" id="inputPassword" aria-describedby="">

        <div class="content_btn">
            <input type="submit" value="Connexion" class="btn btn--var-green">
            <input id="token" type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
            <input type="hidden" name="action" value="connection">
        </div>
        </form>
    
</main>

    
</body>
</html>