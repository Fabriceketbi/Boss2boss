<?php

session_start();
require_once 'includes/_config.php';
require_once 'includes/_fonctions.php';
require_once 'includes/_database.php';

preventCSRF();

// var_dump($_SESSION['errorsList']);

if (!empty($_REQUEST)) {

    if ($_REQUEST['action'] === 'add-sub-category' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        if (checkNameSubCategory($_REQUEST)) {
            redirectTo('_admin.php');
        } else {

            $insert = $dbCo->prepare("INSERT INTO `sub_category`(`name_subcat`)
            VALUES (:name);");

            $isInsertOk = $insert->execute([

                'name' => htmlspecialchars($_REQUEST['name']),
            ]);

            if ($isInsertOk) {
                addMessage('add-subCategory_ok');
                redirectTo('_admin.php');
            } else {
                addError('add-subCategory_ko');
                redirectTo('_admin.php');
                unset($_SESSION['errorsList']);
            }
        }
    } else if ($_REQUEST['action'] === 'add-category' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        
        if (checkNameCategory($_REQUEST)) {
            redirectTo('_admin.php');
            
        } else {
            $insert = $dbCo->prepare("INSERT INTO `category`(`name_category`) VALUES (:name);");
            $isInsertOk = $insert->execute([

                'name' => htmlspecialchars($_REQUEST['name']),
            ]);
            if ($isInsertOk) {
                addMessage('add-category_ok');
                redirectTo('_admin.php');
            } else {
                addError('add-category_ko');
                redirectTo('_admin.php');
                unset($_SESSION['errorsList']);
            }
        }

    } else if ($_REQUEST['action'] === 'add-intervenant' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        if (checkNameHost($_REQUEST)) {
            redirectTo('_admin.php');
        } else {
            $insert = $dbCo->prepare("INSERT INTO `host`(`name_host`) VALUES (:name_host);");
            $isInsertOk = $insert->execute([
                'name_host' => htmlspecialchars($_REQUEST['name']),
            ]);
            if ($isInsertOk) {
                addMessage('add-intervenant_ok');
                redirectTo('_admin.php');
            } else {
                addError('add-intervenant_ko');
                redirectTo('_admin.php');
                unset($_SESSION['errorsList']);
            }
        }
    } else if ($_REQUEST['action'] === 'create-formation' && $_SERVER['REQUEST_METHOD'] === 'POST') {

        if (!checkInfosFormation($_REQUEST)) {  
            redirectTo('_admin.php');
        } else {
            $insert = $dbCo->prepare("INSERT INTO `formation`(`name`, `subtitle`, `description`, `date1_`, `date2_`, `date3_`, `time`, `localisation`, `id_sub_category`, `id_category`, `id_host`, `price`, `reduce_price`, `nb_participants`) VALUES (:name, :subtitle, :description, :date1, :date2, :date3, :time,
           :localisation, :id_sub_category, :id_category, :id_host, :price, :reduce_price, :nb_participants);");

            $isInsertOk = $insert->execute([
                'name' => htmlspecialchars($_REQUEST['name']),
                'subtitle' => htmlspecialchars($_REQUEST['subtitle']),
                'description' => htmlspecialchars($_REQUEST['description']),
                'date1' => date('Y-m-d', strtotime($_REQUEST['date1'])),
                'date2' => date('Y-m-d', strtotime($_REQUEST['date2'])),
                'date3' => date('Y-m-d', strtotime($_REQUEST['date3'])),
                'time' => htmlspecialchars($_REQUEST['time']),
                'localisation' => htmlspecialchars($_REQUEST['localisation']),
                'id_sub_category' => intval($_REQUEST['subCategory']),
                'id_category' => intval($_REQUEST['category']),
                'id_host' => intval($_REQUEST['name_host']),
                'price' => intval($_REQUEST['price']),
                'reduce_price' => intval($_REQUEST['reducePrice']),
                'nb_participants' => intval($_REQUEST['participants']),
            ]);


            if ($isInsertOk) {
                addMessage('add-formation_ok');
                redirectTo('_admin.php');
            } else {
                addError('add-formation_ko');
                unset($_SESSION['errorsList']);
            }
        }
    } else if ($_REQUEST['action'] === 'delete-formation' && $_SERVER['REQUEST_METHOD'] === 'POST') {

        $query = $dbCo->prepare("DELETE FROM `formation` WHERE id_formation = :id");

        $queryValues = [
            'id' => $_REQUEST['id']
        ];

        $queryIsOk = $query->execute($queryValues);

        if ($queryIsOk) {
            addMessage('supp-formation_ok');
            redirectTo('_admin.php');
        } else {
            addError('add-formation_ko');
            redirectTo('_admin.php');
            unset($_SESSION['errorsList']);
        }
    } else if ($_REQUEST['action'] === 'update-formation' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!checkUpdateFormation($_REQUEST)) {  
            // var_dump($_SESSION['errorsList']);        
            redirectTo('_admin-edit.php');

        }else{

        $query = $dbCo->prepare("UPDATE formation SET name = :name, subtitle = :subtitle, description = :description, id_sub_category = :id_sub_category, id_category  = :id_category, id_host = :id_host, date1_ = :date1, date2_ = :date2, date3_ = :date3, time = :time, localisation = :localisation WHERE id_formation =:id");

        $queryValues = [
            'name' => htmlspecialchars($_REQUEST['name']),
            'subtitle' => htmlspecialchars($_REQUEST['subtitle']),
            'description' => htmlspecialchars($_REQUEST['description']),
            'id_sub_category' => intval($_REQUEST['subCategory']),
            'id_category' => intval($_REQUEST['category']),
            'id_host' => intval($_REQUEST['name_host']),
            'date1' => date('Y-m-d', strtotime($_REQUEST['date1'])),
            'date2' => date('Y-m-d', strtotime($_REQUEST['date2'])),
            'date3' => date('Y-m-d', strtotime($_REQUEST['date3'])),
            'time' => htmlspecialchars($_REQUEST['time']),
            'localisation' => htmlspecialchars($_REQUEST['localisation']),
            'id' => intval($_REQUEST['id']),
        ];

        $queryIsOk = $query->execute($queryValues);

        if ($queryIsOk) {
            addMessage('edit-formation_ok');
            unset($_SESSION['errorsList']);
            redirectTo('_admin.php');
        } else {
            addError('edit-formation_ko');
            redirectTo('_admin-edit.php');
            unset($_SESSION['errorsList']);
        }
    }
    } elseif ($_REQUEST['action'] === 'connection' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!checkConnexionInfo($_REQUEST)) {
            redirectTo('_connexion.php');
        } else {
            connectedMyAccount($dbCo);
        }
    } elseif ($_REQUEST['action'] === 'deconnection' && $_SERVER['REQUEST_METHOD'] === 'POST') {

        session_destroy();
        redirectTo('_connexion.php');
    }


    if ($_REQUEST['action'] === 'create-admin' && $_SERVER['REQUEST_METHOD'] === 'POST') {

        if (checkAdminInfo($_REQUEST)) {  
            redirectTo('_admin.php');
        }
        else{

            $insert = $dbCo->prepare("INSERT INTO `admin`(`admin_name`, `password`)
            VALUES (:admin_name, :password);");
    
    
            $isInsertOk = $insert->execute([
    
                'admin_name' => htmlspecialchars($_REQUEST['nameAdmin']),
                'password' => password_hash($_REQUEST['password'], PASSWORD_BCRYPT)
            ]);
    
            if ($isInsertOk) {
                addMessage('create-admin_ok');
                redirectTo('_admin.php');
            } else {
                addError('create-admin_ko');
                redirectTo('_admin.php');
                unset($_SESSION['errorsList']);
            }
        }

    }if ($_REQUEST['action'] === 'post_form' && $_SERVER['REQUEST_METHOD'] === 'POST') {

        if (!checkInfosMail($_REQUEST)) {
// var_dump($_REQUEST);
            $_SESSION['id_form-select'] = $_REQUEST['id_formation'];
            addError('echec_inscription');
            if ($_REQUEST['id_category'] === "1") {
                redirectTo('pages/_afterboss.php');
            }
            if ($_REQUEST['id_category'] === "2") {
                redirectTo('pages/_entrepreneur2demain.php');
            }
            if ($_REQUEST['id_category'] === "3") {
                redirectTo('pages/_lespepes.php');
            }
        }
        else {

        $to = "inscription@boss2boss.club ";
        $subject = "inscription";
        $message =  htmlspecialchars($_REQUEST['lastname']) . " " . htmlspecialchars($_REQUEST['firstname']) . " souhaite s'inscrire pour la formation " . htmlspecialchars($_REQUEST['formationName']);
        $headers = htmlspecialchars($_REQUEST['email']);

        var_dump($message);
        var_dump($headers);

        $_SESSION['id_form-select'] = $_REQUEST['id_formation'];
        // mail($to, $subject, $message, $headers);
        addMessage('inscription_ok');  
        if ($_REQUEST['id_category'] === "1") {
            redirectTo('pages/_afterboss.php');
        }
        if ($_REQUEST['id_category'] === "2") {
            redirectTo('pages/_entrepreneur2demain.php');
        }
        if ($_REQUEST['id_category'] === "3") {
            redirectTo('pages/_lespepes.php');
        }

        }

    }if ($_REQUEST['action'] === 'add-video' && $_SERVER['REQUEST_METHOD'] === 'POST') {

        if (checkLinkVideo($_REQUEST)) {
            redirectTo('_admin.php');
            // var_dump($_REQUEST);
        } else {
            $insert = $dbCo->prepare("INSERT INTO `video`(`link`)
            VALUES (:link);");

            $isInsertOk = $insert->execute([

                'link' => htmlspecialchars($_REQUEST['link']),
            ]);

            if ($isInsertOk) {
                addMessage('add_video-ok');
                redirectTo('_admin.php');
            } else {
                addError('add_video-ko');
                unset($_SESSION['errorsList']);
            }
        };
    }elseif ($_REQUEST['action'] === 'delete-video' && $_SERVER['REQUEST_METHOD'] === 'POST') {

        $query = $dbCo->prepare("DELETE FROM `video` WHERE id_video = :id");

        $queryValues = [
            'id' => $_REQUEST['id_video']
        ];

        $queryIsOk = $query->execute($queryValues);

        if ($queryIsOk) {
            addMessage('supp-video_ok');
            redirectTo('_admin.php');
        } else {
            addError('supp-video_ko');
            redirectTo('_admin.php');
            unset($_SESSION['errorsList']);
        }
    }
}



