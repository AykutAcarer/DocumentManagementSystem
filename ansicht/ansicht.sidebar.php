<?php

/**
 * @brief 
 * @details Ansicht Menu 
 * @package IHK-Projekt
 * @filesource
 * @source
 * @author Aykut Acarer
 * @link https://localhost/php/IHK-Projekt/project
 * @remark 20220128 AcarA Anlegen der Index
 */

require_once("config/config.php");
require_once("functions/functions.php");

//Menu --- unterlage_bereiche
$res_stmt1 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen 
LEFT JOIN mandant_1_kiz_unterlagen_bereich
ON unterlagen_bereich_id_fk =  unterlagen_bereich_id
LEFT JOIN mandant_1_kiz_unterlagen_typ
ON unterlagen_typ_id_fk = unterlagen_typ_id
GROUP BY unterlagen_bereich_name");
$res_stmt1->execute();
$erg_stmt1 = $res_stmt1->fetchAll();

$str_content = '';
$list_content = '';
$list_content .= '<div class="accordion" id="accordionPanelsStayOpenExample1">';

// ----- Menu Beginn ----- //
foreach ($erg_stmt1 as $unterlage_bereiche) {

    $list_content .= '<div class="accordion-item mt-4" style="border:none; background-color:unset;" >';
    $list_content .= '<h6 class="accordion-header mb-2" style=" color:#003882;" id="panelsStayOpen-heading' . $unterlage_bereiche->unterlagen_bereich_id . '">';
    $list_content .= '<span class="" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse' . $unterlage_bereiche->unterlagen_bereich_id . '" aria-expanded="true" aria-controls="panelsStayOpen-collapse' . $unterlage_bereiche->unterlagen_bereich_id . '" >' . $unterlage_bereiche->unterlagen_bereich_name . '</span>';
    $list_content .= '</h6>';
    // Wenn man alle Unterlagen im Erste anschauen möchte, dann addieren in "class" "show".
    $list_content .= '<div id="panelsStayOpen-collapse' . $unterlage_bereiche->unterlagen_bereich_id . '" class="accordion-collapse collapse mb-2" aria-labelledby="panelsStayOpen-heading' . $unterlage_bereiche->unterlagen_bereich_id . '">';
    // $list_content .= '<div class="accordion-body">';

    // unter Bereiche --- die Liste von Unterlage_typen
    $res_stmt2 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen 
    JOIN mandant_1_kiz_unterlagen_typ ON mandant_1_kiz_unterlagen.unterlagen_typ_id_fk = mandant_1_kiz_unterlagen_typ.unterlagen_typ_id WHERE mandant_1_kiz_unterlagen.unterlagen_bereich_id_fk = '" . $unterlage_bereiche->unterlagen_bereich_id . "' GROUP BY unterlagen_typ_name");
    $res_stmt2->execute();
    $erg_stmt2 = $res_stmt2->fetchAll();

    foreach ($erg_stmt2 as $unterlage_typen) {
        $list_content .= '<div class="ms-2 link" style="border-bottom: 1px solid #003882;"><h6 class="accordion-header mb-1 " id=""><a href="unterlagen.anzeige.php?unterlagen_bereich_id=' . $unterlage_bereiche->unterlagen_bereich_id . '&unterlagen_typ_id=' . $unterlage_typen->unterlagen_typ_id . '" class="text-decoration-none click" style="color:#003882;"><img src="image/folder-plus.svg" class="" width="16px;"></img> ' . $unterlage_typen->unterlagen_typ_name . '';
        $list_content .= '</a></h6></div>';
    }
    // $list_content .= '</div>';
    $list_content .= '</div>';
    $list_content .= '</div>';
}
$list_content .= '</div>';
// ----- Menu Ende ----- //
$ansicht_sidebar = '';
$ansicht_sidebar = '
<div class="col-2 d-flex sticky-top flex-column" style="height:100vh; background-color:#FAD499;">
    <div class="" >
        <div>
            <h6 class="mt-4 mb-4" style="color:#003882;"><b>Unterlagen</b>
            </h6>
        </div>
        ' . $list_content . '
    </div>
</div>
';

echo $ansicht_sidebar;
