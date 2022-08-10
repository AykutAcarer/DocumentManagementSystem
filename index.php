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
require_once("ansicht/ansicht.sidebar.php");
require_once("ansicht/ansicht.unten.php");

// ----- Filtern ----- //
$sucht_content = '';
$sucht_content .= '<div class="card shadow ">';
$sucht_content .= '<div class="card-header bg-darklight">Suchen';
$sucht_content .= '</div>';
$sucht_content .= '<div class="card-body">';
$sucht_content .= '<form action="" method="post">';
$sucht_content .= '<div class="d-flex flex-column">';
//Suchen
$sucht_content .= '<div class="">';
$sucht_content .= '<input type="text" class="form-control form-control-sm" name=" inlineFormSuchen" id="inlineFormSuchen" minLength="3" >';
$sucht_content .= '</div>';
//SQL Abfrage
$res_stmt3 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_bereich");
$res_stmt3->execute();
$erg_stmt3 = $res_stmt3->fetchAll();
//Bereiche 
$sucht_content .= '<div class="d-flex">';
$sucht_content .= '<div class="w-25">';
$sucht_content .= '<label for="inlineFormSelectBereiche" class="form-label">Bereiche</label>';
$sucht_content .= '<select class="form-select form-select-sm" name="inlineFormSelectBereiche" id="inlineFormSelectBereiche">';
$sucht_content .= '<option value="0">Auswählen...</option>';
foreach ($erg_stmt3 as $bereiche) {
    $bereiche_selected = '';
    if (@$_POST['inlineFormSelectBereiche'] == $bereiche->unterlagen_bereich_id) {
        $bereiche_selected = 'selected';
    }
    $sucht_content .= '<option value="' . $bereiche->unterlagen_bereich_id . '" ' . $bereiche_selected . '>' . $bereiche->unterlagen_bereich_name . '</option>';
}
$sucht_content .= '</select>';
$sucht_content .= '</div>';
// SQL Abfrage
$res_stmt4 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_typ");
$res_stmt4->execute();
$erg_stmt4 = $res_stmt4->fetchAll();
// Typ
$sucht_content .= '<div class="ms-2 w-25">';
$sucht_content .= '<label for="inlineFormSelectTypen" class="form-label">Typen</label>';
$sucht_content .= '<select class="form-select form-select-sm" name="inlineFormSelectTypen" id="inlineFormSelectTypen">';
$sucht_content .= '<option value="0">Auswählen...</option>';
foreach ($erg_stmt4 as $typ) {
    $typ_selected = '';
    if (@$_POST['inlineFormSelectTypen'] == $typ->unterlagen_typ_id) {
        $typ_selected = 'selected';
    }
    $sucht_content .= '<option value="' . $typ->unterlagen_typ_id . '" ' . $typ_selected . '>' . $typ->unterlagen_typ_name . '</option>';
}
$sucht_content .= '</select>';
$sucht_content .= '</div>';
// Submit 
$sucht_content .= '<div class="ms-auto p-2 bd-highlight mt-2" >';
$sucht_content .= '<label for="suchen" class="form-label"></label>';
$sucht_content .= '<input type="submit" name="suchen" id="suchen" value="Suchen" class="btn btn-sm mt-3" style="background-color:#F9971D;"/>';
$sucht_content .= '</div>';
$sucht_content .= '</div>';
$sucht_content .= '</div>';
$sucht_content .= '</form>';
$sucht_content .= '</div>';
$sucht_content .= '</div>';

if (isset($_POST['suchen'])) {
    $search_beginn = microtime(true);

    //Ergebnis
    $str_content .= '<div class=""><img src="image/search.svg" class=""></img> Ergebnisse';
    $str_content .= '</div>';
    $str_content .= '<div class="">';
    $str_content .= '<table class="table table-striped table-hover" style="cursor:pointer;">';
    if ($_POST['inlineFormSuchen'] == '') {

        $str_content .= '<thead class="">';
        $str_content .= '<tr>';
        $str_content .= '<th scope="col">Unterlagen</th>';
        $str_content .= '<th scope="col">Bereich</th>';
        $str_content .= '<th scope="col">Typ</th>';
        $str_content .= '<th scope="col">Aktiv</th>';
        $str_content .= '</tr>';
        $str_content .= '</thead>';
        $str_content .= '<tbody>';

        //SQL Abfrage
        $res_stmt5 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen 
        INNER JOIN mandant_1_kiz_unterlagen_kapitel ON unterlagen_id = unterlagen_id_fk
        INNER JOIN mandant_1_kiz_unterlagen_bereich ON unterlagen_bereich_id_fk = unterlagen_bereich_id
        INNER JOIN mandant_1_kiz_unterlagen_typ ON unterlagen_typ_id_fk = unterlagen_typ_id
        GROUP BY unterlagen_id");
        $res_stmt5->execute();
        $erg_stmt5 = $res_stmt5->fetchAll();
        $count = 0;
        foreach ($erg_stmt5 as $unterlagen_suchen) {
            //Suchtkriter - (bereiche > 0 typen == 0)
            if ($_POST['inlineFormSelectBereiche'] > 0 && $_POST['inlineFormSelectTypen'] == 0) {
                if ($unterlagen_suchen->unterlagen_bereich_id == $_POST['inlineFormSelectBereiche']) {
                    $str_content .= ausgabe_tabelle($unterlagen_suchen);
                    $count++;
                }
            }
            //Suchtkriter - (bereiche == 0 typen > 0)
            if ($_POST['inlineFormSelectBereiche'] == 0 && $_POST['inlineFormSelectTypen'] > 0) {
                if ($unterlagen_suchen->unterlagen_typ_id == $_POST['inlineFormSelectTypen']) {
                    $str_content .= ausgabe_tabelle($unterlagen_suchen);
                    $count++;
                }
            }
            //Suchtkriter - (bereiche > 0 typen > 0)
            if ($_POST['inlineFormSelectBereiche'] > 0 && $_POST['inlineFormSelectTypen'] > 0) {
                if ($unterlagen_suchen->unterlagen_bereich_id == $_POST['inlineFormSelectBereiche'] && $unterlagen_suchen->unterlagen_typ_id == $_POST['inlineFormSelectTypen']) {
                    $str_content .= ausgabe_tabelle($unterlagen_suchen);
                    $count++;
                }
            }
        }
        $str_content .= '</tbody>';
    } else {
        $str_content .= '<thead class="">';
        $str_content .= '<tr>';
        $str_content .= '<th scope="col">Unterlagen</th>';
        $str_content .= '<th scope="col">Kapitel</th>';
        $str_content .= '<th scope="col">Bereich</th>';
        $str_content .= '<th scope="col">Typ</th>';
        $str_content .= '<th scope="col">Aktiv</th>';
        $str_content .= '</tr>';
        $str_content .= '</thead>';
        $str_content .= '<tbody>';

        //SQL Abfrage
        $res_stmt6 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen 
        INNER JOIN mandant_1_kiz_unterlagen_kapitel ON unterlagen_id = unterlagen_id_fk 
        INNER JOIN mandant_1_kiz_unterlagen_bereich ON unterlagen_bereich_id_fk = unterlagen_bereich_id
        INNER JOIN mandant_1_kiz_unterlagen_typ ON unterlagen_typ_id_fk = unterlagen_typ_id
        ORDER BY unterlagen_kapitel_order ASC");
        $res_stmt6->execute();
        $erg_stmt6 = $res_stmt6->fetchAll();
        $count = 0;
        foreach ($erg_stmt6 as $unterlagen_suchen1) {
            if (strpos(strtolower($unterlagen_suchen1->unterlagen_kapitel_inhalt), strtolower($_POST['inlineFormSuchen'])) !== FALSE || strpos(strtolower($unterlagen_suchen1->unterlagen_kapitel_name), strtolower($_POST['inlineFormSuchen'])) !== FALSE) {
                $str_content .= ausgabe_tabelle_suchen($unterlagen_suchen1);
                $count++;
            }
        }
        $str_content .= '</tbody>';

        $reset_sucht_kriter = '';
        $reset_sucht_kriter = '
        <script>
            $(\'#inlineFormSelectBereiche\').prop(\'selectedIndex\',0);
            $(\'#inlineFormSelectTypen\').prop(\'selectedIndex\',0);
        </script>
        ';
    }
    $search_ende = microtime(true);
    $search_time = round(($search_ende - $search_beginn), 3);
    $str_content .= '</table>';
    $str_content .= '</div>';

    //Information
    $sucht_ergebnis_info = '';
    $sucht_ergebnis_info .= '<p class="text-muted">Ihre Sucht für "' . $_POST['inlineFormSuchen'] . '"</p>';
    $sucht_ergebnis_info .= '<p class="text-muted">Ungefähr ' . $count . ' Ergebnisse (' . $search_time . ' Sekunden)</p>';
}
echo '
        <div class="col-10 d-flex flex-column post">
            <div class="d-flex justify-content-end mt-4 mb-2">
                <a href="unterlagen.unterlagen.php" class="btn btn-sm me-2 hoverfarbe" style="background-color:#FAD499;" target="PromoteFire" onclick="popup(this.href, this.target); return false" title="Meine Unterlagen">Meine Unterlagen</a>
                <a href="unterlagen.neu.unterlagen.php?unterlagen_id=neu" class="btn btn-sm hoverfarbe" style="background-color:#FAD499;" target="PromoteFirefoxWindow" onclick="popup(this.href, this.target); return false" title="Neu Unterlagen">Neu Unterlagen</a>
            </div>
            <div class="d-flex flex-column">
                <!-- Suchen Eingabe -->
                <div class="">
                    ' . $sucht_content . '
                    <div class="ms-2 me-2 d-flex justify-content-between">
                        ' . @$sucht_ergebnis_info . '
                    </div>
                    <div class="d-flex flex-column">
                        ' . $str_content . '
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
' . @$reset_sucht_kriter . '
<script>
    jQuery(document).ready(function($) {
        $(".klick").click(function() {
            window.location = $(this).data("href");
        });
    });
</script>
';
