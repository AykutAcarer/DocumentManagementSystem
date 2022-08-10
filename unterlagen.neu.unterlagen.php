<?php

/**
 * @brief 
 * @details Neue Unterlagen  
 * @package IHK-Projekt
 * @filesource
 * @source
 * @author Aykut Acarer
 * @link https://localhost/php/IHK-Projekt/project
 * @remark 20220128 AcarA Anlegen der Index
 */

@date_default_timezone_get('Europe/Berlin');

require_once("config/config.php");
require_once("functions/functions.php");
require_once("ansicht/ansicht.oben.php");
require_once("ansicht/ansicht.unten.php");

$str_content = '';
if (@$_GET['unterlagen_id'] == 'neu') 
{


    $str_content .= '<form action="" method="post">';
    $str_content .= '<div class=" d-flex flex-column">';
    // Unterlagen - Name
    $str_content .= '<div class=" d-flex flex-column">';
    $str_content .= '<label for="inlineFormSelectUnterlagen" class="form-label">Unterlagen - Name</label>';
    $str_content .= '<input type="text" name="inlineFormSelectUnterlagen" id="inlineFormSelectUnterlagen" class="form-control form-control-sm ">';
    $str_content .= '</div>';
    // SQL Abfrage - Bereiche
    $str_content .= '<div class="">';
    $res_stmt = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_bereich");
    $res_stmt->execute();
    $erg_stmt = $res_stmt->fetchAll();
    $str_content .= '<label for="inlineFormSelectBereiche" class="form-label">Bereiche</label>';
    $str_content .= '<select class="form-select form-select-sm" name="inlineFormSelectBereiche" id="inlineFormSelectBereiche">';
    $str_content .= '<option value="0">Auswählen...</option>';
    foreach ($erg_stmt as $bereiche) {
        $bereiche_selected = '';
        if (@$_POST['inlineFormSelectBereiche'] == $bereiche->unterlagen_bereich_id) {
            $bereiche_selected = 'selected';
        }
        $str_content .= '<option value="' . $bereiche->unterlagen_bereich_id . '" ' . $bereiche_selected . '>' . $bereiche->unterlagen_bereich_name . '</option>';
    }
    $str_content .= '</select>';
    $str_content .= '</div>';
    // SQL Abfrage - Typ
    $str_content .= '<div class="">';
    $res_stmt1 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_typ");
    $res_stmt1->execute();
    $erg_stmt1 = $res_stmt1->fetchAll();
    $str_content .= '<label for="inlineFormSelectTypen" class="form-label">Typen</label>';
    $str_content .= '<select class="form-select form-select-sm" name="inlineFormSelectTypen" id="inlineFormSelectTypen">';
    $str_content .= '<option value="0">Auswählen...</option>';
    foreach ($erg_stmt1 as $typ) {
        $typ_selected = '';
        if (@$_POST['inlineFormSelectTypen'] == $typ->unterlagen_typ_id) {
            $typ_selected = 'selected';
        }
        $str_content .= '<option value="' . $typ->unterlagen_typ_id . '" ' . $typ_selected . '>' . $typ->unterlagen_typ_name . '</option>';
    }
    $str_content .= '</select>';
    $str_content .= '</div>';
    // Submit - Button
    $str_content .= '<div class="d-flex justify-content-end mt-2 mb-2">';
    $str_content .= '<a href="javascript:window.close();"><button type="button" class="form-control btn btn-sm" style="background-color:#F9971D;" data-bs-dismiss="modal">Abbrechen</button></a>';
    $str_content .= '<input type="submit" name="submit" id="submit" class="form-control form-control-sm ms-2" value="Speichern" style="width: 5rem; background-color:#F9971D;">';
    $str_content .= '</div>';
    $str_content .= '</div>';
    $str_content .= '</form>';

    if (isset($_POST['submit'])) {
        $unterlage_kapitel_datum = date("Y-m-d");
        $unterlage_kapitel_time = date("H:i:s");

        //insert Query
        $res_stmt2 = $conn->prepare("INSERT INTO mandant_1_kiz_unterlagen (unterlagen_bereich_id_fk, unterlagen_typ_id_fk, unterlagen_autor, unterlagen_name, unterlagen_datum, unterlagen_uhrzeit) VALUES ('" . $_POST['inlineFormSelectBereiche'] . "','" . $_POST['inlineFormSelectTypen'] . "','" . $_SESSION['benutzer_id'] . "','" . $_POST['inlineFormSelectUnterlagen'] . "','" . $unterlage_kapitel_datum . "','" . $unterlage_kapitel_time . "')");

        // $res_stmt2->execute();
        $str_content_ergebnis = '';
        if ($res_stmt2->execute()) {
            $str_content_ergebnis .= '<p class="text-primary fs-6 mt-1"> * Erfolgreich gespeichert wurde.</p>';
        }
    }
} 
elseif (@$_GET['unterlagen_id'] > 0) 
{
    $unterlagen_id = $_GET['unterlagen_id'];
    $bereich_id = '';
    $typ_id = '';
    $bereich_id = $_GET['unterlagen_bereich_id'];
    $typ_id = $_GET['unterlagen_typ_id'];

    $str_content .= '<form action="" method="post">';
    $str_content .= '<div class=" d-flex flex-column">';
    // Unterlagen - Name
    $str_content .= '<div class=" d-flex flex-column">';
    $str_content .= '<label for="inlineFormSelectUnterlagen" class="form-label">Unterlagen - Name</label>';
    $res_stmt_unterlagen = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen WHERE unterlagen_id = '" . $unterlagen_id . "'");
    $res_stmt_unterlagen->execute();
    $erg_stmt_unterlagen = $res_stmt_unterlagen->fetchALL();
    foreach ($erg_stmt_unterlagen as $unterlagen) {
        $str_content .= '<input type="text" name="inlineFormSelectUnterlagen" id="inlineFormSelectUnterlagen" class="form-control form-control-sm " value="' . $unterlagen->unterlagen_name . '">';
    }
    $str_content .= '</div>';
    // SQL Abfrage - Bereiche
    $str_content .= '<div class="">';
    $res_stmt = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_bereich");
    $res_stmt->execute();
    $erg_stmt = $res_stmt->fetchAll();
    $str_content .= '<label for="inlineFormSelectBereiche" class="form-label">Bereiche</label>';
    $str_content .= '<select class="form-select form-select-sm bereich" name="inlineFormSelectBereiche" id="inlineFormSelectBereiche">';
    $str_content .= '<option value="0">Auswählen...</option>';
    foreach ($erg_stmt as $bereiche) {
        $bereiche_selected = '';
        if (@$_POST['inlineFormSelectBereiche'] == $bereiche->unterlagen_bereich_id) {
            $bereiche_selected = $bereiche->unterlagen_bereich_id;
        }
        $str_content .= '<option value="' . $bereiche->unterlagen_bereich_id . '" ' . $bereiche_selected . '>' . $bereiche->unterlagen_bereich_name . '</option>';
    }
    $str_content .= '</select>';
    $str_content .= '</div>';
    // SQL Abfrage - Typ
    $str_content .= '<div class="">';
    $res_stmt1 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_typ");
    $res_stmt1->execute();
    $erg_stmt1 = $res_stmt1->fetchAll();
    $str_content .= '<label for="inlineFormSelectTypen" class="form-label">Typen</label>';
    $str_content .= '<select class="form-select form-select-sm typ" name="inlineFormSelectTypen" id="inlineFormSelectTypen">';
    $str_content .= '<option value="0">Auswählen...</option>';
    foreach ($erg_stmt1 as $typ) {
        $typ_selected = '';
        if (@$_POST['inlineFormSelectTypen'] == $typ->unterlagen_typ_id) {
            $typ_selected = $typ->unterlagen_typ_id;
        }
        $str_content .= '<option value="' . $typ->unterlagen_typ_id . '" ' . $typ_selected . '">' . $typ->unterlagen_typ_name . '</option>';
    }
    $str_content .= '</select>';
    $str_content .= '</div>';
    // Submit - Button
    $str_content .= '<div class="d-flex justify-content-end mt-2 mb-2">';
    $str_content .= '<a href="javascript:window.close();"><button type="button" class="btn btn-sm" style="background-color:#F9971D;" data-bs-dismiss="modal">Abbrechen</button></a>';
    $str_content .= '<input type="submit" name="submit" id="submit" class="form-control form-control-sm ms-2" value="Speichern" style="width: 5rem; background-color:#F9971D;">';
    $str_content .= '</div>';
    $str_content .= '</div>';
    $str_content .= '</form>';

    if (isset($_POST['submit'])) {
        $unterlage_kapitel_datum = date("Y-m-d");
        $unterlage_kapitel_time = date("H:i:s");

        //insert Query
        $res_stmt2 = $conn->prepare("UPDATE mandant_1_kiz_unterlagen SET unterlagen_bereich_id_fk ='" . $_POST['inlineFormSelectBereiche'] . "', unterlagen_typ_id_fk = '" . $_POST['inlineFormSelectTypen'] . "', unterlagen_autor = '" . $_SESSION['benutzer_id'] . "', unterlagen_name = '" . $_POST['inlineFormSelectUnterlagen'] . "', unterlagen_datum = '" . $unterlage_kapitel_datum . "', unterlagen_uhrzeit = '" . $unterlage_kapitel_time . "' WHERE unterlagen_id = '" . $unterlagen_id . "'");

        // $res_stmt2->execute();
        $str_content_ergebnis = '';
        if ($res_stmt2->execute()) {
            $str_content_ergebnis .= '<p class="text-primary fs-6 mt-1"> * Erfolgreich gespeichert wurde.</p>';
        }
    }
} 
else if ($_GET['unterlagen_bereich_id'] > 0 && $_GET['unterlagen_typ_id'] > 0) 
{
    $unterlagen_bereich_id = $_GET['unterlagen_bereich_id'];
    $unterlagen_typ_id = $_GET['unterlagen_typ_id'];

    $str_content .= '<form action="" method="post">';
    $str_content .= '<div class=" d-flex flex-column">';
    // Unterlagen - Name
    $str_content .= '<div class=" d-flex flex-column">';
    $str_content .= '<label for="inlineFormSelectUnterlagen" class="form-label">Unterlagen - Name</label>';
    $str_content .= '<input type="text" name="inlineFormSelectUnterlagen" id="inlineFormSelectUnterlagen" class="form-control form-control-sm ">';
    $str_content .= '</div>';
    // SQL Abfrage - Bereiche
    $str_content .= '<div class="">';
    $res_stmt = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_bereich WHERE unterlagen_bereich_id = '" . $unterlagen_bereich_id . "'");
    $res_stmt->execute();
    $erg_stmt = $res_stmt->fetchAll();
    $str_content .= '<label for="inlineFormSelectBereiche" class="form-label">Bereiche</label>';
    foreach ($erg_stmt as $bereiche) {
        $str_content .= '<input type="text" class="form-control form-control-sm" name="inlineFormSelectBereiche" id="inlineFormSelectBereiche" value="' . $bereiche->unterlagen_bereich_name . '" readonly>';
    }
    $str_content .= '</div>';
    // SQL Abfrage - Typ
    $str_content .= '<div class="">';
    $res_stmt1 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_typ WHERE unterlagen_typ_id = '" . $unterlagen_typ_id . "'");
    $res_stmt1->execute();
    $erg_stmt1 = $res_stmt1->fetchAll();
    $str_content .= '<label for="inlineFormSelectTypen" class="form-label">Typen</label>';
    foreach ($erg_stmt1 as $typ) {
        $str_content .= '<input type="text" class="form-control form-control-sm" name="inlineFormSelectTypen" id="inlineFormSelectTypen" value="' . $typ->unterlagen_typ_name . '" readonly>';
    }
    $str_content .= '</div>';
    // Submit - Button
    $str_content .= '<div class="d-flex justify-content-end mt-2 mb-2">';
    $str_content .= '<a href="javascript:window.close();"><button type="button" class="btn btn-sm" style="background-color:#F9971D;" data-bs-dismiss="modal">Abbrechen</button></a>';
    $str_content .= '<input type="submit" name="submit" id="submit" class="form-control form-control-sm ms-2" value="Speichern" style="width: 5rem; background-color:#F9971D;">';
    $str_content .= '</div>';
    $str_content .= '</div>';
    $str_content .= '</form>';

    if (isset($_POST['submit'])) {
        $unterlage_kapitel_datum = date("Y-m-d");
        $unterlage_kapitel_time = date("H:i:s");

        //insert Query
        $res_stmt2 = $conn->prepare("INSERT INTO mandant_1_kiz_unterlagen (unterlagen_bereich_id_fk, unterlagen_typ_id_fk, unterlagen_autor, unterlagen_name, unterlagen_datum, unterlagen_uhrzeit) VALUES ('" . $unterlagen_bereich_id . "','" . $unterlagen_typ_id . "','" . $_SESSION['benutzer_id'] . "','" . $_POST['inlineFormSelectUnterlagen'] . "','" . $unterlage_kapitel_datum . "','" . $unterlage_kapitel_time . "')");

        // $res_stmt2->execute();
        $str_content_ergebnis = '';
        if ($res_stmt2->execute()) {
            $str_content_ergebnis .= '<p class="text-primary fs-6 mt-1"> * Erfolgreich gespeichert wurde.</p>';
        }
    }
}
echo '
<div class="card shadow mt-4">
' . $str_content . '
' . @$str_content_ergebnis . '
</div>



<script>
$(\'.bereich\').val("' . @$bereich_id . '");
$(\'.typ\').val("' . @$typ_id . '");
</script>
';
