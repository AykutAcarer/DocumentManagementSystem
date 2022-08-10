<?php

/**
 * @brief 
 * @details Unterlagen Information
 * @package IHK-Projekt
 * @filesource
 * @source
 * @author Aykut Acarer
 * @link https://localhost/php/IHK-Projekt/project
 * @remark 20220128 AcarA Anlegen der Index
 */

require_once("config/config.php");
require_once("functions/functions.php");
require_once("ansicht/ansicht.oben.php");

$unterlagen_id = '';
if ($_GET['unterlagen_kapitel_id'] > 0) {
    $unterlagen_kapitel_id = $_GET['unterlagen_kapitel_id'];
}

$res_stmt = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen 
INNER JOIN mandant_1_kiz_unterlagen_kapitel ON unterlagen_id = unterlagen_id_fk 
INNER JOIN mandant_1_kiz_unterlagen_bereich ON unterlagen_bereich_id_fk = unterlagen_bereich_id
INNER JOIN mandant_1_kiz_unterlagen_typ ON unterlagen_typ_id_fk = unterlagen_typ_id
WHERE unterlagen_kapitel_id = '" . $unterlagen_kapitel_id . "'");
$res_stmt->execute();
$erg_stmt = $res_stmt->fetchAll();

$str_conmtent = '';

foreach ($erg_stmt as $unterlagen) {
    $str_conmtent .= '<div class="container-sm">';
    $str_conmtent .= '<div class="d-flex justify-content-between mb-3">';
    $str_conmtent .= '<div class="card mb-3 me-3" style="width: 320px;">';
    $str_conmtent .= '<div class="card-header">Unterlagen</div>';
    $str_conmtent .= '<div class="card-body">';
    $str_conmtent .= '<input type="text" class="card-title form-control form-control-sm" style="background-color:#F9971D;" value="' . $unterlagen->unterlagen_name . ' "readonly>';
    $str_conmtent .= '<div class="d-flex">';
    $str_conmtent .= '<div class="me-1">';
    $str_conmtent .= '<label class="card-text form-label">Bereich:</label>';
    $str_conmtent .= '<input type="text" class="card-text form-control form-control-sm" style="background-color:#F9971D;" value="' . $unterlagen->unterlagen_bereich_name . ' "readonly>';
    $str_conmtent .= '</div>';
    $str_conmtent .= '<div class="">';
    $str_conmtent .= '<label class="card-text form-label">Typ:</label>';
    $str_conmtent .= '<input type="text" class="card-text form-control form-control-sm" style="background-color:#F9971D;" value="' . $unterlagen->unterlagen_typ_name . ' "readonly>';
    $str_conmtent .= '</div>';
    $str_conmtent .= '</div>';
    $str_conmtent .= '<div class="d-flex">';
    $str_conmtent .= '<div class="me-1">';
    $str_conmtent .= '<label class="card-text form-label">Datum:</label>';
    $str_conmtent .= '<input type="text" class="card-text form-control form-control-sm" style="background-color:#F9971D;" value="' . $unterlagen->unterlagen_datum . '   "readonly>';
    $str_conmtent .= '</div>';
    $str_conmtent .= '<div class="">';
    $str_conmtent .= '<label class="card-text form-label">Uhrzeit:</label>';
    $str_conmtent .= '<input type="text" class="card-text form-control form-control-sm" style="background-color:#F9971D;" value="' . $unterlagen->unterlagen_uhrzeit . '"readonly>';
    $str_conmtent .= '</div>';
    $str_conmtent .= '</div>';
    $str_conmtent .= '</div>';
    $str_conmtent .= '</div>';
    $str_conmtent .= '<div class="card mb-3" style="max-width: 540px;">';
    $str_conmtent .= '<div class="row g-0">';
    $str_conmtent .= '<div class="card-header mb-3">Autor der Unterlage</div>';
    $str_conmtent .= '<div class="col-sm-8">';
    $str_conmtent .= '<div class="card-body">';

    //Autor von Unterlagen
    $res_stmt1 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_benutzer 
    INNER JOIN mandant_1_kiz_unterlagen_gruppe ON unterlagen_gruppe_id_fk = unterlagen_gruppe_id
    INNER JOIN mandant_1_kiz_unterlagen_regions ON unterlagen_benutzer_regions_id_fk = unterlagen_regions_id
    INNER JOIN mandant_1_kiz_unterlagen_functions ON unterlagen_benutzer_functions_id_fk = unterlagen_fuctions_id
    WHERE unterlagen_benutzer_id = '" . $unterlagen->unterlagen_autor . "'");
    $res_stmt1->execute();
    $erg_stmt1 = $res_stmt1->fetchAll();
    foreach ($erg_stmt1 as $autor) {
        $str_conmtent .= '<h5 class="card-title mb-1">' . $autor->unterlagen_benutzer_vorname . ' ' . $autor->unterlagen_benutzer_name . '</h5>';
        $str_conmtent .= '<p class="card-text text-muted">' . $autor->unterlagen_benutzer_position . '</p>';
        $str_conmtent .= '<p class="card-text">' . $autor->unterlagen_gruppe_name . '</p>';
        $str_conmtent .= '<p class="card-text">' . $autor->unterlagen_regions_name . '</p>';
        $str_conmtent .= '<a href="mailto: ' . $autor->unterlagen_benutzer_email . '" class="card-link">' . $autor->unterlagen_benutzer_email . '</a>';
    }
    $str_conmtent .= '</div>';
    $str_conmtent .= '</div>';
    $str_conmtent .= '<div class="col-sm-4">';
    $str_conmtent .= '<img src="image/mustermann.png"class="img-fluid rounded-start" alt="" >';
    $str_conmtent .= '</div>';
    $str_conmtent .= '</div>';
    $str_conmtent .= '</div>';
    $str_conmtent .= '</div>';

    //Kapitel
    $str_conmtent .= '<div class="d-flex justify-content-between mb-3">';
    $str_conmtent .= '<div class="card mb-3 me-3" style="width: 320px;">';
    $str_conmtent .= '<div class="card-header">Kapitel</div>';
    $str_conmtent .= '<div class="card-body">';
    $str_conmtent .= '<input type="text" class="card-title form-control form-control-sm" style="background-color:#F9971D;" value="' . $unterlagen->unterlagen_kapitel_name . ' "readonly>';
    $str_conmtent .= '<div class="d-flex">';
    $str_conmtent .= '<div class="me-1">';
    $str_conmtent .= '<label class="card-text form-label">Datum:</label>';
    $str_conmtent .= '<input type="text" class="card-text form-control form-control-sm" style="background-color:#F9971D;" value="' . $unterlagen->unterlagen_kapitel_datum . '   "readonly>';
    $str_conmtent .= '</div>';
    $str_conmtent .= '<div class="">';
    $str_conmtent .= '<label class="card-text form-label">Uhrzeit:</label>';
    $str_conmtent .= '<input type="text" class="card-text form-control form-control-sm" style="background-color:#F9971D;" value="' . $unterlagen->unterlagen_kapitel_time . '"readonly>';
    $str_conmtent .= '</div>';
    $str_conmtent .= '</div>';
    $str_conmtent .= '<label class="card-text form-label">letzte Bearbeitung:</label>';
    $str_conmtent .= '<input type="text" class="card-text form-control form-control-sm" style="background-color:#F9971D;" value="' . $unterlagen->unterlagen_kapitel_bearbeitet_zuletzt . '"readonly>';
    $str_conmtent .= '</div>';
    $str_conmtent .= '</div>';
    $str_conmtent .= '<div class="card mb-3" style="max-width: 540px;">';
    $str_conmtent .= '<div class="row g-0">';
    $str_conmtent .= '<div class="card-header mb-3">Autor des Kapitels</div>';
    $str_conmtent .= '<div class="col-sm-8">';
    $str_conmtent .= '<div class="card-body">';
    // Kapitel - Autor
    $res_stmt2 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_benutzer 
    INNER JOIN mandant_1_kiz_unterlagen_gruppe ON unterlagen_gruppe_id_fk = unterlagen_gruppe_id
    INNER JOIN mandant_1_kiz_unterlagen_regions ON unterlagen_benutzer_regions_id_fk = unterlagen_regions_id
    INNER JOIN mandant_1_kiz_unterlagen_functions ON unterlagen_benutzer_functions_id_fk = unterlagen_fuctions_id
    WHERE unterlagen_benutzer_id = '" . $unterlagen->unterlagen_kapitel_autor . "'");
    $res_stmt2->execute();
    $erg_stmt2 = $res_stmt2->fetchAll();
    foreach ($erg_stmt2 as $mitarbeiter) {
        $str_conmtent .= '<h5 class="card-title mb-">' . $mitarbeiter->unterlagen_benutzer_vorname . ' ' . $mitarbeiter->unterlagen_benutzer_name . '</h5>';
        $str_conmtent .= '<p class="card-text text-muted">' . $mitarbeiter->unterlagen_benutzer_position . '</p>';
        $str_conmtent .= '<p class="card-text">' . $mitarbeiter->unterlagen_gruppe_name . '</p>';
        $str_conmtent .= '<p class="card-text">' . $mitarbeiter->unterlagen_regions_name . '</p>';
        $str_conmtent .= '<a href="mailto: ' . $mitarbeiter->unterlagen_benutzer_email . '" class="card-link">' . $mitarbeiter->unterlagen_benutzer_email . '</a>';
    }
    $str_conmtent .= '</div>';
    $str_conmtent .= '</div>';
    $str_conmtent .= '<div class="col-sm-4">';
    $str_conmtent .= '<img src="image/mustermann.png"class="img-fluid rounded-start" alt="" >';
    $str_conmtent .= '</div>';
    $str_conmtent .= '</div>';
    $str_conmtent .= '</div>';
    $str_conmtent .= '</div>';

    // letzte Bearbeitung
    $str_conmtent .= '<div class="d-flex justify-content-end mb-3">';
    $str_conmtent .= '<div class="card mb-3" style="max-width: 540px;">';
    $str_conmtent .= '<div class="row g-0">';
    $str_conmtent .= '<div class="card-header mb-3">Der Mitarbeiter, der letzte bearbeitet </div>';
    $str_conmtent .= '<div class="col-sm-8">';
    $str_conmtent .= '<div class="card-body">';
    $res_stmt3 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_benutzer 
    INNER JOIN mandant_1_kiz_unterlagen_gruppe ON unterlagen_gruppe_id_fk = unterlagen_gruppe_id
    INNER JOIN mandant_1_kiz_unterlagen_regions ON unterlagen_benutzer_regions_id_fk = unterlagen_regions_id
    INNER JOIN mandant_1_kiz_unterlagen_functions ON unterlagen_benutzer_functions_id_fk = unterlagen_fuctions_id
    WHERE unterlagen_benutzer_id = '" . $unterlagen->unterlagen_kapitel_bearbeitet_von . "'");
    $res_stmt3->execute();
    $erg_stmt3 = $res_stmt3->fetchAll();
    foreach ($erg_stmt3 as $mitarbeiter_letzt) {
        $str_conmtent .= '<h5 class="card-title mb-1">' . $mitarbeiter_letzt->unterlagen_benutzer_vorname . ' ' . $mitarbeiter_letzt->unterlagen_benutzer_name . '</h5>';
        $str_conmtent .= '<p class="card-text text-muted">' . $mitarbeiter_letzt->unterlagen_benutzer_position . '</p>';
        $str_conmtent .= '<p class="card-text">' . $mitarbeiter_letzt->unterlagen_gruppe_name . '</p>';
        $str_conmtent .= '<p class="card-text">' . $mitarbeiter_letzt->unterlagen_regions_name . '</p>';
        $str_conmtent .= '<a href="mailto: ' . $mitarbeiter_letzt->unterlagen_benutzer_email . '" class="card-link">' . $mitarbeiter_letzt->unterlagen_benutzer_email . '</a>';
    }
    $str_conmtent .= '</div>';
    $str_conmtent .= '</div>';
    $str_conmtent .= '<div class="col-sm-4">';
    $str_conmtent .= '<img src="image/mustermann.png"class="img-fluid rounded-start" alt="" >';
    $str_conmtent .= '</div>';
    $str_conmtent .= '</div>';
    $str_conmtent .= '</div>';
    $str_conmtent .= '</div>';
    $str_conmtent .= '</div>';
}

echo $str_conmtent;
require_once("ansicht/ansicht.unten.php");
