<?php

session_start();
require_once 'includes/_config.php';
require_once 'includes/_fonctions.php';
require_once 'includes/_database.php';


preventCSRF();

if (!empty($_REQUEST)) {

    if ($_REQUEST['action'] === 'add-sub-category' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        if (checkName($_REQUEST)) {
            redirectTo('_admin.php');
        } else {

            $insert = $dbCo->prepare("INSERT INTO `sub_category`(`name`)
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

        if (checkName($_REQUEST)) {
            redirectTo('_admin.php');
        } else {
            $insert = $dbCo->prepare("INSERT INTO `category`(`name`) VALUES (:name);");
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
        if (!checkName($_REQUEST)) {
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
            // var_dump($_REQUEST);    
        } else {
            $insert = $dbCo->prepare("INSERT INTO `formation`(`name`, `subtitle`, `description`, `date1_`, `date2_`, `date3_`, `time`, `localisation`, `id_sub_category`, `id_category`, `id_host`) VALUES (:name, :subtitle, :description, :date1, :date2, :date3, :time,
           :localisation, :id_sub_category, :id_category, :id_host);");

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


    if ($_REQUEST['action'] === 'create-admin' && $_SERVER['REQUEST_METHOD'] === 'POST' && (checkAdminInfo($_REQUEST))) {
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
}
