<?php

/**
 * @brief 
 * @details Unterlagen Kapitel Löschen
 * @package IHK-Projekt
 * @filesource
 * @source
 * @author Aykut Acarer
 * @link https://localhost/php/IHK-Projekt/project
 * @remark 20220128 AcarA Anlegen der Index
 */

require_once("config/config.php");
//Daten Löschen

$gelöschte_kapitel_id = '';

if ($_GET['unterlagen_kapitel_id'] > 0) {
    $gelöschte_kapitel_id = $_GET['unterlagen_kapitel_id'];
}

$res_stmt = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen 
INNER JOIN mandant_1_kiz_unterlagen_kapitel ON unterlagen_id = unterlagen_id_fk 
WHERE unterlagen_kapitel_id = '" . $gelöschte_kapitel_id . "'");
$res_stmt->execute();
$erg_stmt = $res_stmt->fetchAll();
$unterlage_vater_id = '';
$gelöschte_kapitel_order = '';
$unterlagen_bereich_id = '';
$unterlagen_typ_id = '';
foreach ($erg_stmt as $unterlagen_kapitel) {
    $unterlage_vater_id = $unterlagen_kapitel->unterlagen_kapitel_vater;
    $gelöschte_kapitel_order = $unterlagen_kapitel->unterlagen_kapitel_order;
    $unterlagen_bereich_id = $unterlagen_kapitel->unterlagen_bereich_id_fk;
    $unterlagen_typ_id = $unterlagen_kapitel->unterlagen_typ_id_fk;
}

//Delete query -kapitel(vater)
$res_stmt_del1 = $conn->prepare("DELETE FROM mandant_1_kiz_unterlagen_kapitel WHERE unterlagen_kapitel_id = '" . $gelöschte_kapitel_id . "'");
$res_stmt_del1->execute();

// Select - kapitel_id (child)
$res_stmt1 = $conn->prepare("SELECT unterlagen_kapitel_id FROM mandant_1_kiz_unterlagen_kapitel WHERE unterlagen_kapitel_vater = '" . $gelöschte_kapitel_id . "'");
$res_stmt1->execute();
$erg_stmt1 = $res_stmt1->fetchAll();
$level1 = '';
foreach ($erg_stmt1 as $unterlagen_kapitel1) {
    $level1 = $unterlagen_kapitel1->unterlagen_kapitel_id;
}
//Delete query -kapitel(child)
$res_stmt_del2 = $conn->prepare("DELETE FROM mandant_1_kiz_unterlagen_kapitel WHERE unterlagen_kapitel_vater = '" . $gelöschte_kapitel_id . "'");
$res_stmt_del2->execute();

// Select - kapitel_id (child-child)
$res_stmt2 = $conn->prepare("SELECT unterlagen_kapitel_id FROM mandant_1_kiz_unterlagen_kapitel WHERE unterlagen_kapitel_vater = '" . $level1 . "'");
$res_stmt2->execute();
$erg_stmt2 = $res_stmt2->fetchAll();
$level2 = '';
foreach ($erg_stmt2 as $unterlagen_kapitel2) {
    $level2 = $unterlagen_kapitel2->unterlagen_kapitel_id;
}
//Delete query -kapitel(child-child)
$res_stmt_del3 = $conn->prepare("DELETE FROM mandant_1_kiz_unterlagen_kapitel WHERE unterlagen_kapitel_vater = '" . $level1 . "'");
$res_stmt_del3->execute();

//Delete query -kapitel(child-child-child)
$res_stmt_del4 = $conn->prepare("DELETE FROM mandant_1_kiz_unterlagen_kapitel WHERE unterlagen_kapitel_vater = '" . $level2 . "'");
$res_stmt_del4->execute();

//Select Query
$res_stmt3 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_kapitel WHERE unterlagen_kapitel_vater = '" . $unterlage_vater_id . "' ORDER BY unterlagen_kapitel_order ASC");
$res_stmt3->execute();
$erg_stmt3 = $res_stmt3->fetchAll();

$neu_kapitel_order = '';
foreach ($erg_stmt3 as $unterlage_kapitel_daten) {

    // Wenn die Kapitelsnummer groesser als gelöschte Kapitelsnummer ist, dann werden die Nummern wiedererstellt 
    if ($unterlage_kapitel_daten->unterlagen_kapitel_order > $gelöschte_kapitel_order) {
        $neu_kapitel_order = $unterlage_kapitel_daten->unterlagen_kapitel_order - 1;
    }
    // Wenn die Kapitelsnummer kleiner als gelöschte Kapitelsnummer ist
    else {
        $neu_kapitel_order = $unterlage_kapitel_daten->unterlagen_kapitel_order;
    }
    //Update Query
    $res_stmt_upd = $conn->prepare("UPDATE mandant_1_kiz_unterlagen_kapitel SET  unterlagen_kapitel_order = '" . $neu_kapitel_order . "' WHERE unterlagen_kapitel_id = '" . $unterlage_kapitel_daten->unterlagen_kapitel_id . "' ");
    $res_stmt_upd->execute();
}
header('location:unterlagen.anzeige.php?unterlagen_bereich_id=' . $unterlagen_bereich_id . '&unterlagen_typ_id=' . $unterlagen_typ_id . '');
