<?php
include './includes/_fonctions.php';
require_once 'includes/_config.php';

session_start();
generateToken();


if (isset($_REQUEST['id'])) {

    $_SESSION['id_formation'] = $_REQUEST['id'];
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
    <main class="main_admin">
        <section class="section_form">

            <div class="content_form">
                <h2>Formulaire de modification de formation</h2>

                <?= editFormation($dbCo, $_SESSION['id_formation'],$errors) ?>
                
            </div>
        </section>
    </main>
</body>

</html>