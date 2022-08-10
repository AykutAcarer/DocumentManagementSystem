<?php

/**
 * @brief 
 * @details Uebersicht 
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

if ($_GET['unterlagen_id'] > 0) {
    $unterlagen_id = $_GET['unterlagen_id'];
}

$res_stmt = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen WHERE unterlagen_id = '" . $unterlagen_id . "'");
$res_stmt->execute();
$erg_stmt = $res_stmt->fetchAll();

$str_content = '';
foreach ($erg_stmt as $unterlagen) {
    $str_content .= '<div class="mb-4">';
    $str_content .= '<input type="text" class="form-control form-control-sm" style="background-color:#F9971D;" value="' . $unterlagen->unterlagen_name . '" readonly>';
    $str_content .= '</div>';
}

$res_stmt_kontrol = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_zugriffrechte WHERE unterlagen_id_fk = '" . $unterlagen_id . "'");
$res_stmt_kontrol->execute();
$erg_stmt_kontrol = $res_stmt_kontrol->fetchAll();

if (empty($erg_stmt_kontrol)) {

    $str_content .= '<div class="">';
    //Gruppenlist_header
    $str_content .= gruppen_list_header();

    $res_stmt_gruppe = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_gruppe");
    $res_stmt_gruppe->execute();
    $erg_stmt_gruppe = $res_stmt_gruppe->fetchAll();
    foreach ($erg_stmt_gruppe as $gruppe) {

        $str_content .= '<tr">';
        $str_content .= '<td>' .  $gruppe->unterlagen_gruppe_name . '</td>';
        $str_content .= '<td>';
        $str_content .= '<input type="checkbox" class="form-check-input alle_schreiben " name="zurecht[' . $gruppe->unterlagen_gruppe_id . ']" id="zurecht[' . $gruppe->unterlagen_gruppe_id . ']" value="schreiben" >';
        $str_content .= '</td>';
        $str_content .= '<td>';
        $str_content .= '<input type="checkbox" class="form-check-input alle_lesen " name="zurecht[' . $gruppe->unterlagen_gruppe_id . ']" id="zurecht[' . $gruppe->unterlagen_gruppe_id . ']" value="lesen" >';
        $str_content .= '</td>';
        $str_content .= '<td>';
        $str_content .= '<input type="checkbox" class="form-check-input alle_none " name="zurecht[' . $gruppe->unterlagen_gruppe_id . ']" id="zurecht[' . $gruppe->unterlagen_gruppe_id . ']" value="none" >';
        $str_content .= '</td>';
        $str_content .= '</tr>';
    }
    $str_content .= '</tbody>';
    $str_content .= '</table>';

    //Mitarbeiterlist_header
    $str_content .= mitarbeiter_list_header();

    $res_stmt_benutzer = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_benutzer");
    $res_stmt_benutzer->execute();
    $erg_stmt_benutzer = $res_stmt_benutzer->fetchAll();
    foreach ($erg_stmt_benutzer as $benutzer) {

        $str_content .= '<tr>';
        $str_content .= '<td>' .  $benutzer->unterlagen_benutzer_name . '</td>';
        $str_content .= '<td>' .  $benutzer->unterlagen_benutzer_vorname . '</td>';
        $res_stmt2 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_gruppe WHERE unterlagen_gruppe_id = '" . $benutzer->unterlagen_gruppe_id_fk . "'");
        $res_stmt2->execute();
        $erg_stmt2 = $res_stmt2->fetchAll();
        foreach ($erg_stmt2 as $benutzer_gruppe) {
            $str_content .= '<td>' .  $benutzer_gruppe->unterlagen_gruppe_name . '</td>';
        }
        $str_content .= '<td>';
        $str_content .= '<input type="checkbox" class="form-check-input alle_benutzer_schreiben " name="zurecht[' . $benutzer->unterlagen_benutzer_id . ']" id="zurecht[' . $benutzer->unterlagen_benutzer_id . ']" value="schreiben">';
        $str_content .= '</td>';
        $str_content .= '<td>';
        $str_content .= '<input type="checkbox" class="form-check-input alle_benutzer_lesen " name="zurecht[' . $benutzer->unterlagen_benutzer_id . ']" id="zurecht[' . $benutzer->unterlagen_benutzer_id . ']" value="lesen">';
        $str_content .= '</td>';
        $str_content .= '<td>';
        $str_content .= '<input type="checkbox" class="form-check-input alle_benutzer_none " name="zurecht[' . $benutzer->unterlagen_benutzer_id . ']" id="zurecht[' . $benutzer->unterlagen_benutzer_id . ']" value="none">';
        $str_content .= '</td>';
        $str_content .= '</tr>';
    }
    $str_content .= '</tbody>';
    $str_content .= '</table>';
    $str_content .= speicher_buttons();
    $str_content .= '</form>';
    $str_content .= '</div>';

    if (isset($_POST['speichern'])) {

        $data = $_POST['zurecht'];
        foreach ($data as $id => $value) {

            $res_stmt_speicher1 = $conn->prepare(
                "INSERT INTO 
            mandant_1_kiz_unterlagen_zugriffrechte 
            (unterlagen_zugriffrechte_id, 
            unterlagen_id_fk, 
            unterlagen_gruppe_zugriff 
            )
            VALUES 
            (?,?,?)"
            );
            $res_stmt_speicher1->bindParam(1, $id);
            $res_stmt_speicher1->bindParam(2, $unterlagen_id);
            $res_stmt_speicher1->bindParam(3, $value);
            $res_stmt_speicher1->execute();
        }
    }
} else {

    $str_content .= '<div class="">';
    //Gruppenlist_header
    $str_content .= gruppen_list_header();

    $res_stmt_gruppe = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_gruppe");
    $res_stmt_gruppe->execute();
    $erg_stmt_gruppe = $res_stmt_gruppe->fetchAll();
    foreach ($erg_stmt_gruppe as $gruppe) {

        $str_content .= '<tr">';
        $str_content .= '<td>' .  $gruppe->unterlagen_gruppe_name . '</td>';

        $res_stmt_prüft = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_zugriffrechte 
        INNER JOIN mandant_1_kiz_unterlagen_gruppe
        ON unterlagen_zugriffrechte_id = unterlagen_gruppe_id
        WHERE unterlagen_id_fk = '" . $unterlagen_id . "'
        AND unterlagen_gruppe_id = '" . $gruppe->unterlagen_gruppe_id . "'");
        $res_stmt_prüft->execute();
        $erg_stmt_prüft = $res_stmt_prüft->fetchAll();

        foreach ($erg_stmt_prüft as $prüft_data) {

            if ($prüft_data->unterlagen_gruppe_zugriff == 'schreiben') {
                $checked_schreiben = 'checked';
                $checked_lesen = '';
                $checked_none = '';
            } elseif ($prüft_data->unterlagen_gruppe_zugriff == 'lesen') {
                $checked_lesen = 'checked';
                $checked_schreiben = '';
                $checked_none = '';
            } elseif ($prüft_data->unterlagen_gruppe_zugriff == 'none') {
                $checked_none = 'checked';
                $checked_lesen = '';
                $checked_schreiben = '';
            }
            $str_content .= '<td>';
            $str_content .= '<input type="checkbox" class="form-check-input alle_schreiben " name="zurecht[' . $prüft_data->unterlagen_gruppe_id . ']" id="zurecht[' . $prüft_data->unterlagen_gruppe_id . ']" value="schreiben" ' . $checked_schreiben . '>';
            $str_content .= '</td>';
            $str_content .= '<td>';
            $str_content .= '<input type="checkbox" class="form-check-input alle_lesen" name="zurecht[' . $prüft_data->unterlagen_gruppe_id . ']" id="zurecht[' . $prüft_data->unterlagen_gruppe_id . ']" value="lesen" ' . $checked_lesen . '>';
            $str_content .= '</td>';
            $str_content .= '<td>';
            $str_content .= '<input type="checkbox" class="form-check-input alle_none" name="zurecht[' . $prüft_data->unterlagen_gruppe_id . ']" id="zurecht[' . $prüft_data->unterlagen_gruppe_id . ']" value="none" ' . $checked_none . '>';
            $str_content .= '</td>';
        }
        $str_content .= '</tr>';
    }
    $str_content .= '</tbody>';
    $str_content .= '</table>';

    //Mitarbeiterlist_header
    $str_content .= mitarbeiter_list_header();

    $res_stmt_benutzer = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_benutzer");
    $res_stmt_benutzer->execute();
    $erg_stmt_benutzer = $res_stmt_benutzer->fetchAll();
    foreach ($erg_stmt_benutzer as $benutzer) {

        $str_content .= '<tr>';
        $str_content .= '<td>' .  $benutzer->unterlagen_benutzer_name . '</td>';
        $str_content .= '<td>' .  $benutzer->unterlagen_benutzer_vorname . '</td>';
        $res_stmt2 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_gruppe WHERE unterlagen_gruppe_id = '" . $benutzer->unterlagen_gruppe_id_fk . "'");
        $res_stmt2->execute();
        $erg_stmt2 = $res_stmt2->fetchAll();
        foreach ($erg_stmt2 as $benutzer_gruppe) {
            $str_content .= '<td>' .  $benutzer_gruppe->unterlagen_gruppe_name . '</td>';
        }

        $res_stmt_prüft_benutzer = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_zugriffrechte 
        INNER JOIN mandant_1_kiz_unterlagen_benutzer
        ON unterlagen_zugriffrechte_id = unterlagen_benutzer_id
        WHERE unterlagen_id_fk = '" . $unterlagen_id . "'
        AND unterlagen_benutzer_id = '" . $benutzer->unterlagen_benutzer_id . "'");
        $res_stmt_prüft_benutzer->execute();
        $erg_stmt_prüft_benutzer = $res_stmt_prüft_benutzer->fetchAll();

        foreach ($erg_stmt_prüft_benutzer as $prüft_data_benutzer) {
            if ($prüft_data_benutzer->unterlagen_gruppe_zugriff == 'schreiben') {
                $checked_schreiben = 'checked';
                $checked_lesen = '';
                $checked_none = '';
            } elseif ($prüft_data_benutzer->unterlagen_gruppe_zugriff == 'lesen') {
                $checked_lesen = 'checked';
                $checked_schreiben = '';
                $checked_none = '';
            } elseif ($prüft_data_benutzer->unterlagen_gruppe_zugriff == 'none') {
                $checked_none = 'checked';
                $checked_lesen = '';
                $checked_schreiben = '';
            }
            $str_content .= '<td>';
            $str_content .= '<input type="checkbox" class="form-check-input alle_benutzer_schreiben" name="zurecht[' . $benutzer->unterlagen_benutzer_id . ']" id="zurecht[' . $benutzer->unterlagen_benutzer_id . ']" value="schreiben" ' . $checked_schreiben . '>';
            $str_content .= '</td>';
            $str_content .= '<td>';
            $str_content .= '<input type="checkbox" class="form-check-input alle_benutzer_lesen" name="zurecht[' . $benutzer->unterlagen_benutzer_id . ']" id="zurecht[' . $benutzer->unterlagen_benutzer_id . ']" value="lesen" ' . $checked_lesen . '>';
            $str_content .= '</td>';
            $str_content .= '<td>';
            $str_content .= '<input type="checkbox" class="form-check-input alle_benutzer_none" name="zurecht[' . $benutzer->unterlagen_benutzer_id . ']" id="zurecht[' . $benutzer->unterlagen_benutzer_id . ']" value="none" ' . $checked_none . '>';
            $str_content .= '</td>';
            $str_content .= '</tr>';
        }
    }
    $str_content .= '</tbody>';
    $str_content .= '</table>';
    $str_content .= speicher_buttons();
    $str_content .= '</form>';
    $str_content .= '</div>';

    if (isset($_POST['speichern'])) 
    {

        $data = $_POST['zurecht'];
        foreach ($data as $id => $value) {


            $res_stmt_speicher1 = $conn->prepare(
                "UPDATE 
            mandant_1_kiz_unterlagen_zugriffrechte 
            SET
            unterlagen_gruppe_zugriff='" . $value . "' 
            WHERE unterlagen_zugriffrechte_id='" . $id . "' 
            AND unterlagen_id_fk='" . $unterlagen_id . "'
            "
            );
            $res_stmt_speicher1->execute();
        }
    }
}
echo $str_content;
require_once("ansicht/ansicht.unten.php");



function gruppen_list_header()
{
    $str_content = '';
    // Gruppenlist
    $str_content .= '<span class="text-muted">- Gruppenlist -</span>';
    $str_content .= '<form action="" method="post">';
    $str_content .= '<table class="table table-striped>';
    $str_content .= '<thead class="">';
    $str_content .= '<tr>';
    $str_content .= '<th scope="col">';
    $str_content .= 'Name';
    $str_content .= '</th>';
    $str_content .= '<th scope="col">Screiben</th>';
    $str_content .= '<th scope="col">Lesen</th>';
    $str_content .= '<th scope="col">N/A</th>';
    $str_content .= '</tr>';
    $str_content .= '</thead>';
    $str_content .= '<tbody>';
    //alle auswählen
    $str_content .= '<tr>';
    $str_content .= '<td></td>';
    $str_content .= '<td>';
    $str_content .= '<label><input type="checkbox" class="form-check-input selectall_schreiben" name="zurecht_schreiben" id="zurecht_schreiben" value="schreiben" > alle auswählen</label>';
    $str_content .= '</td>';
    $str_content .= '<td>';
    $str_content .= '<label><input type="checkbox" class="form-check-input selectall_lesen" name="zurecht_lesen" id="zurecht_lesen" value="lesen" > alle auswählen</label>';
    $str_content .= '</td>';
    $str_content .= '<td>';
    $str_content .= '<label><input type="checkbox" class="form-check-input selectall_none" name="zurecht_none" id="zurecht_lesen" value="none" > alle auswählen</label>';
    $str_content .= '</td>';
    $str_content .= '</tr>';
    return $str_content;
}

function mitarbeiter_list_header()
{
    $str_content = '';
    // Mitarbeiterlist
    $str_content .= '<span class="text-muted">- Mitarbeiterlist -</span>';
    $str_content .= '<table class="table table-striped>';
    $str_content .= '<thead class="">';
    $str_content .= '<tr>';
    $str_content .= '<th scope="col">Name</th>';
    $str_content .= '<th scope="col">Vorname</th>';
    $str_content .= '<th scope="col">Gruppe</th>';
    $str_content .= '<th scope="col">Screiben</th>';
    $str_content .= '<th scope="col">Lesen</th>';
    $str_content .= '<th scope="col">N/A</th>';
    $str_content .= '</tr>';
    $str_content .= '</thead>';
    $str_content .= '<tbody>';
    //alle auswählen
    $str_content .= '<tr>';
    $str_content .= '<td></td>';
    $str_content .= '<td></td>';
    $str_content .= '<td></td>';
    $str_content .= '<td>';
    $str_content .= '<label><input type="checkbox" class="form-check-input selectall_benutzer_schreiben" name="" id="" value="schreiben" > alle auswählen</label>';
    $str_content .= '</td>';
    $str_content .= '<td>';
    $str_content .= '<label><input type="checkbox" class="form-check-input selectall_benutzer_lesen" name="" id="" value="lesen" > alle auswählen</label>';
    $str_content .= '</td>';
    $str_content .= '<td>';
    $str_content .= '<label><input type="checkbox" class="form-check-input selectall_benutzer_none" name="" id="" value="none" > alle auswählen</label>';
    $str_content .= '</td>';
    $str_content .= '</tr>';
    return $str_content;
}
