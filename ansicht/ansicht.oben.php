<?php

/**
 * @brief 
 * @details Ansicht Oben 
 * @package IHK-Projekt
 * @filesource
 * @source
 * @author Aykut Acarer
 * @link https://localhost/php/IHK-Projekt/project
 * @remark 20220128 AcarA Anlegen der Index
 */

session_start();
require_once("config/config.php");
require_once("functions/functions.php");

//Benutzer ID
$_SESSION['benutzer_id'] =  1111;

$res_stmt = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_benutzer WHERE unterlagen_benutzer_id = '" . $_SESSION['benutzer_id'] . "'");
$res_stmt->execute();
$erg_stmt = $res_stmt->fetchALL();

$_SESSION['benutzer_name'] = '';
$_SESSION['benutzer_vorname'] = '';
$_SESSION['gruppe_id_fk'] = '';

foreach ($erg_stmt as $benutzer_daten) 
{
    $_SESSION['benutzer_name'] = $benutzer_daten->unterlagen_benutzer_name;
    $_SESSION['benutzer_vorname'] = $benutzer_daten->unterlagen_benutzer_vorname;
    $_SESSION['gruppe_id_fk'] = $benutzer_daten->unterlagen_gruppe_id_fk;
}
$benutzer_vorname_name = $_SESSION['benutzer_vorname'] . ' ' . $_SESSION['benutzer_name'];

$ansicht_oben = '';
$ansicht_oben = '
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unterlagen</title>
    
    <!-- Konfiguration für Trumbowyg CSS -->
    <link rel="stylesheet" href="editor/Trumbowyg-main/dist/ui/trumbowyg.min.css">
    <link rel="stylesheet" href="editor/Trumbowyg-main/dist/plugins/colors/ui/trumbowyg.colors.css">
    <link rel="stylesheet" href="editor/Trumbowyg-main/dist/plugins/table/ui/trumbowyg.table.min.css">
    

    <!-- Bootstrap CSS -->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">-->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <!--<script src="https://kit.fontawesome.com/0ba0b67143.js" crossorigin="anonymous"></script>-->

    <!-- Bootstrap Modal -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
   
    <!-- Import jquery cdn -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>

    <!-- Import Ajax/Jquery cdn -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <style>
        .link:hover{
            background-color:#f29400;
            transition-delay:0;
            transition-duration:0.3;
            transition-property:background-color;
            transition-timing-function:ease-in;
        }
    </style>

</head>

<body>
<div class="container">
    <div class="row">
        <nav class="navbar d-flex justify-content-between  text-black border border-2 border-secondary border-top-0 border-end-0 border-start-0 mt-2 mb-1" id="navbar">
                <div class="mb-2 d-flex ">
                    <a href="index.php" class=""><img class="logo" alt=" Logo - KIZ" src="image/logo_kiz.png" width="51%" height="100%"></a>
                </div>
                <div class="d-flex justify-content-end ">
                ' . $benutzer_vorname_name . '
                    <div class=" ms-3 rounded-circle bg-light d-flex justify-content-center align-items-center" style="width:30px; height:30px;">
                        <img src="fontawesome/svgs/solid/user.svg" width="51%" height="100%" class="text-black"></img>
                    </div>
                </div>
        </nav>
    </div>
    <div class="row">
';

echo $ansicht_oben;
