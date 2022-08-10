<?php

/**
 * @brief 
 * @details Unterlagen Löschen
 * @package IHK-Projekt
 * @filesource
 * @source
 * @author Aykut Acarer
 * @link https://localhost/php/IHK-Projekt/project
 * @remark 20220128 AcarA Anlegen der Index
 */
require_once("config/config.php");
//Daten Löschen
$unterlagen_id = '';

if ($_GET['unterlagen_id'] > 0) {
    $unterlagen_id = $_GET['unterlagen_id'];
}

$res_stmt = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen WHERE unterlagen_id = '" . $unterlagen_id . "'");
$res_stmt->execute();
$erg_stmt = $res_stmt->fetchAll();
$unterlagen_bereich_id = '';
$unterlagen_typ_id = '';
foreach ($erg_stmt as $unterlagen) {
    $unterlagen_bereich_id = $unterlagen->unterlagen_bereich_id_fk;
    $unterlagen_typ_id = $unterlagen->unterlagen_typ_id_fk;
}

//Delete query - unterlagen Tabelle
$res_stmt1 = $conn->prepare("DELETE FROM mandant_1_kiz_unterlagen WHERE unterlagen_id ='" . $unterlagen_id . "'");
$res_stmt1->execute();

header('location:unterlagen.anzeige.php?unterlagen_bereich_id=' . $unterlagen_bereich_id . '&unterlagen_typ_id=' . $unterlagen_typ_id . '');
