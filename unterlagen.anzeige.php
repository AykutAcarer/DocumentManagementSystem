<?php

/**
 * @brief 
 * @details Unterlagen Anzeige
 * @package IHK-Projekt
 * @filesource
 * @source
 * @author Aykut Acarer
 * @link https://localhost/php/IHK-Projekt/project
 * @remark 20220128 AcarA Anlegen der Index
 */
require_once("functions/functions.php");
require_once("config/config.php");
require_once("ansicht/ansicht.oben.php");
require_once("ansicht/ansicht.sidebar.php");
require_once("ansicht/ansicht.unten.php");


if ($_GET['unterlagen_bereich_id'] > 0) {
    $unterlagen_bereich_id = $_GET['unterlagen_bereich_id'];
    $unterlagen_typ_id = $_GET['unterlagen_typ_id'];
}

// Der Name von Bereich und Typ
$res_bereich = $conn->prepare("SELECT unterlagen_bereich_name FROM mandant_1_kiz_unterlagen_bereich WHERE unterlagen_bereich_id = '" . $unterlagen_bereich_id . "'");
$res_bereich->execute();
$erg_bereich = $res_bereich->fetch();

$res_typ = $conn->prepare("SELECT unterlagen_typ_name FROM mandant_1_kiz_unterlagen_typ WHERE unterlagen_typ_id = '" . $unterlagen_typ_id . "'");
$res_typ->execute();
$erg_typ = $res_typ->fetch();

// ------------- Unterlagen Beginn ------------- //
$res_stmt1 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen WHERE unterlagen_bereich_id_fk = '" . $unterlagen_bereich_id . "' AND unterlagen_typ_id_fk = '" . $unterlagen_typ_id . "'");
$res_stmt1->execute();
$erg_stmt1 = $res_stmt1->fetchAll();
$str_content = '';
foreach ($erg_stmt1 as $unterlagen_anzeigen) {

    $str_content .= '<div class="accordion-item mt-2" style="border:1px solid rgba(0,56,130,.3) ">';
    $str_content .= '<h4 class="accordion-header ps-1 pb-2" style="border-bottom:1px solid rgba(0,56,130,.5); " id="panelsStayOpen-heading' . $unterlagen_anzeigen->unterlagen_id . '">';
    $str_content .= '<span class="" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse' . $unterlagen_anzeigen->unterlagen_id . '" aria-expanded="true" aria-controls="panelsStayOpen-collapse' . $unterlagen_anzeigen->unterlagen_id . '">' . $unterlagen_anzeigen->unterlagen_name . '</span>';
    $str_content .= '</h4>';
    // Wenn man alle Unterlagen im Erste anschauen möchte, dann addieren in "class" "show".
    $str_content .= '<div id="panelsStayOpen-collapse' . $unterlagen_anzeigen->unterlagen_id . '" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading' . $unterlagen_anzeigen->unterlagen_id . '">';

    ////////////////KONTROL/////////////////////
    if ($unterlagen_anzeigen->unterlagen_aktiv == 'ja') {
        $benutzer_id = $_SESSION['benutzer_id'];
        $erg_kont = check_in($benutzer_id, $unterlagen_anzeigen->unterlagen_id);
        if ($erg_kont == 'schreiben') {

            $str_content .= '<div class="accordion-body">';
            // Icons //
            $str_content .= '<div class="d-flex justify-content-end">';
            //Bearbeiten
            $str_content .= '<a href="unterlagen.neu.unterlagen.php?unterlagen_id=' . $unterlagen_anzeigen->unterlagen_id . '&unterlagen_bereich_id=' . $unterlagen_bereich_id . '&unterlagen_typ_id=' . $unterlagen_typ_id . '" class="btn btn-sm me-1 text-decoration-none fw-bold " target="PromoteFirefoxWindow" onclick="popup(this.href, this.target); return false" title="Bearbeiten"><img src="image/edit_gray.svg" width="18px;" class=""></img></a>';
            //Export 
            $str_content .= '<a href="unterlagen.export.alternative.php?unterlagen_id=' . $unterlagen_anzeigen->unterlagen_id . '"  target="_blank" class="btn btn-sm me-1 text-decoration-none fw-bold " data-toggle="tooltip" data-placement="top" title="Exportieren"><img src="image/file-pdf-regular.svg" class="text-muted" width="14px;"></img></a>';
            //Löschen
            $str_content .= '<a href="unterlagen.delete.php?unterlagen_id=' . $unterlagen_anzeigen->unterlagen_id . '" class="btn btn-sm me-1 text-decoration-none fw-bold" data-toggle="tooltip" data-placement="top" title="Löschen"><img src="image/trash-gray.svg"  class="" width="20px;" ></img></a>';
            //Neues Kapitel
            $str_content .= '<a href="unterlagen.bearbeiten.php?unterlagen_id=' . $unterlagen_anzeigen->unterlagen_id . '&unterlagen_kapitel_id=neu" class="btn btn-sm text-decoration-none fw-bold newKapitel" target="PromoteFirefoxWindow" onclick="popup(this.href, this.target); return false" title="Neues Kapitel" ><img src="image/file-plus.svg" width="20px;" class=""></img></a> ';
            $str_content .= '</div>';
            // Icons Ende //

            $str_content .= '<div class="d-flex flex-column">';
            //Kapitel(Vater)//
            $res_stmt2 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_kapitel WHERE unterlagen_kapitel_vater = '" . $unterlagen_anzeigen->unterlagen_id . "' ORDER BY unterlagen_kapitel_order ASC");
            $res_stmt2->execute();
            $erg_stmt2 = $res_stmt2->fetchAll();
            foreach ($erg_stmt2 as $unterlage_kapitel_anzeigen) {
                $order = $unterlage_kapitel_anzeigen->unterlagen_kapitel_order;
                $str_content .= '<div class="accordion-item border-0 ">';
                $str_content .= ansicht_unterlagen($unterlage_kapitel_anzeigen, $unterlagen_anzeigen->unterlagen_id, $order);
                //  Kapitel - Level 2  //
                $res_stmt3 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_kapitel WHERE unterlagen_kapitel_vater = '" . $unterlage_kapitel_anzeigen->unterlagen_kapitel_id . "' ORDER BY unterlagen_kapitel_order ASC");
                $res_stmt3->execute();
                $erg_stmt3 = $res_stmt3->fetchAll();
                foreach ($erg_stmt3 as $unterlage_kapitel_level2_anzeigen) {
                    $order2 = $order . '.' . $unterlage_kapitel_level2_anzeigen->unterlagen_kapitel_order;
                    $str_content .= '<div class="accordion-item border-0">';
                    $str_content .= ansicht_unterlagen($unterlage_kapitel_level2_anzeigen, $unterlagen_anzeigen->unterlagen_id, $order2);
                    //  Kapitel - Level 3  //
                    $res_stmt4 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_kapitel WHERE unterlagen_kapitel_vater = '" . $unterlage_kapitel_level2_anzeigen->unterlagen_kapitel_id . "' ORDER BY unterlagen_kapitel_order ASC");
                    $res_stmt4->execute();
                    $erg_stmt4 = $res_stmt4->fetchAll();
                    foreach ($erg_stmt4 as $unterlage_kapitel_level3_anzeigen) {
                        $order3 = $order2 . '.' . $unterlage_kapitel_level3_anzeigen->unterlagen_kapitel_order;
                        $str_content .= '<div class="accordion-item border-0">';
                        $str_content .= ansicht_unterlagen($unterlage_kapitel_level3_anzeigen, $unterlagen_anzeigen->unterlagen_id, $order3);
                        //  Kapitel - Level 4  //
                        $res_stmt5 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_kapitel WHERE unterlagen_kapitel_vater = '" . $unterlage_kapitel_level3_anzeigen->unterlagen_kapitel_id . "' ORDER BY unterlagen_kapitel_order ASC");
                        $res_stmt5->execute();
                        $erg_stmt5 = $res_stmt5->fetchAll();
                        foreach ($erg_stmt5 as $unterlage_kapitel_level4_anzeigen) {
                            $order4 = $order3 . '.' . $unterlage_kapitel_level4_anzeigen->unterlagen_kapitel_order;
                            $str_content .= '<div class="accordion-item border-0">';
                            $str_content .= ansicht_unterlagen($unterlage_kapitel_level4_anzeigen, $unterlagen_anzeigen->unterlagen_id, $order4);

                            $str_content .= '</div>';
                            $str_content .= '</div>';
                            $str_content .= '</div>';
                            // Kapitel-Level 4 Ende //
                        }
                        $str_content .= '</div>';
                        $str_content .= '</div>';
                        $str_content .= '</div>';
                        // Kapitel-Level 3 Ende //
                    }
                    $str_content .= '</div>';
                    $str_content .= '</div>';
                    $str_content .= '</div>';
                    // Kapitel-Level 2 Ende  //
                }
                $str_content .= '</div>';
                $str_content .= '</div>';
                $str_content .= '</div>';
                // Kapitel(Vater) Ende  //
            }
            $str_content .= '</div>';
            $str_content .= '</div>';
        }
        if ($erg_kont == 'lesen') {

            $str_content .= '<div class="d-flex flex-column">';
            //Kapitel(Vater)//
            $res_stmt2 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_kapitel WHERE unterlagen_kapitel_vater = '" . $unterlagen_anzeigen->unterlagen_id . "' ORDER BY unterlagen_kapitel_order ASC");
            $res_stmt2->execute();
            $erg_stmt2 = $res_stmt2->fetchAll();
            foreach ($erg_stmt2 as $unterlage_kapitel_anzeigen) {
                $order = $unterlage_kapitel_anzeigen->unterlagen_kapitel_order;
                $str_content .= '<div class="accordion-item border-0 ">';
                $str_content .= ansicht_unterlagen_lesen($unterlage_kapitel_anzeigen, $unterlagen_anzeigen->unterlagen_id, $order);
                //  Kapitel - Level 2  //
                $res_stmt3 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_kapitel WHERE unterlagen_kapitel_vater = '" . $unterlage_kapitel_anzeigen->unterlagen_kapitel_id . "' ORDER BY unterlagen_kapitel_order ASC");
                $res_stmt3->execute();
                $erg_stmt3 = $res_stmt3->fetchAll();
                foreach ($erg_stmt3 as $unterlage_kapitel_level2_anzeigen) {
                    $order2 = $order . '.' . $unterlage_kapitel_level2_anzeigen->unterlagen_kapitel_order;
                    $str_content .= '<div class="accordion-item border-0">';
                    $str_content .= ansicht_unterlagen_lesen($unterlage_kapitel_level2_anzeigen, $unterlagen_anzeigen->unterlagen_id, $order2);
                    //  Kapitel - Level 3  //
                    $res_stmt4 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_kapitel WHERE unterlagen_kapitel_vater = '" . $unterlage_kapitel_level2_anzeigen->unterlagen_kapitel_id . "' ORDER BY unterlagen_kapitel_order ASC");
                    $res_stmt4->execute();
                    $erg_stmt4 = $res_stmt4->fetchAll();
                    foreach ($erg_stmt4 as $unterlage_kapitel_level3_anzeigen) {
                        $order3 = $order2 . '.' . $unterlage_kapitel_level3_anzeigen->unterlagen_kapitel_order;
                        $str_content .= '<div class="accordion-item border-0">';
                        $str_content .= ansicht_unterlagen_lesen($unterlage_kapitel_level3_anzeigen, $unterlagen_anzeigen->unterlagen_id, $order3);
                        //  Kapitel - Level 4  //
                        $res_stmt5 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_kapitel WHERE unterlagen_kapitel_vater = '" . $unterlage_kapitel_level3_anzeigen->unterlagen_kapitel_id . "' ORDER BY unterlagen_kapitel_order ASC");
                        $res_stmt5->execute();
                        $erg_stmt5 = $res_stmt5->fetchAll();
                        foreach ($erg_stmt5 as $unterlage_kapitel_level4_anzeigen) {
                            $order4 = $order3 . '.' . $unterlage_kapitel_level4_anzeigen->unterlagen_kapitel_order;
                            $str_content .= '<div class="accordion-item border-0">';
                            $str_content .= ansicht_unterlagen_lesen($unterlage_kapitel_level4_anzeigen, $unterlagen_anzeigen->unterlagen_id, $order4);

                            $str_content .= '</div>';
                            $str_content .= '</div>';
                            $str_content .= '</div>';
                            // Kapitel-Level 4 Ende //
                        }
                        $str_content .= '</div>';
                        $str_content .= '</div>';
                        $str_content .= '</div>';
                        // Kapitel-Level 3 Ende //
                    }
                    $str_content .= '</div>';
                    $str_content .= '</div>';
                    $str_content .= '</div>';
                    // Kapitel-Level 2 Ende  //
                }
                $str_content .= '</div>';
                $str_content .= '</div>';
                $str_content .= '</div>';
                // Kapitel(Vater) Ende  //
            }
            $str_content .= '</div>';
            $str_content .= '</div>';
        }
        if ($erg_kont == 'none') {
            $str_content .= '<div class="accordion-body">';
            $res_stmt_rechte = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen 
            INNER JOIN mandant_1_kiz_unterlagen_benutzer ON unterlagen_autor = unterlagen_benutzer_id
            WHERE unterlagen_id = '" . $unterlagen_anzeigen->unterlagen_id . "'");
            $res_stmt_rechte->execute();
            $erg_stmt_rechte = $res_stmt_rechte->fetchAll();
            foreach ($erg_stmt_rechte as $data_recht) {
                $str_content .= '<p>Hinweis:<p>';
                $str_content .= '<p>Kontaktieren Sie bitte der Autor von Dokument<p>';
                $str_content .= '<p>Mail:  <a href="mailto: ' . $data_recht->unterlagen_benutzer_email . '" class="">' . $data_recht->unterlagen_benutzer_email . '</a><p>';
            }
            $str_content .= '</div>';
        }
    } elseif ($unterlagen_anzeigen->unterlagen_aktiv == 'nein') {
        if ($_SESSION['benutzer_id'] == $unterlagen_anzeigen->unterlagen_autor) {
            $str_content .= '<div class="accordion-body">';
            // Icons //
            $str_content .= '<div class="d-flex justify-content-end">';
            //Bearbeiten
            $str_content .= '<a href="unterlagen.neu.unterlagen.php?unterlagen_id=' . $unterlagen_anzeigen->unterlagen_id . '&unterlagen_bereich_id=' . $unterlagen_bereich_id . '&unterlagen_typ_id=' . $unterlagen_typ_id . '" class="btn btn-sm me-1 text-decoration-none fw-bold " target="PromoteFirefoxWindow" onclick="popup(this.href, this.target); return false" title="Bearbeiten"><img src="image/edit_gray.svg" width="18px;" class=""></img></a>';
            //Export 
            $str_content .= '<a href="unterlagen.export.alternative.php?unterlagen_id=' . $unterlagen_anzeigen->unterlagen_id . '"  target="_blank" class="btn btn-sm me-1 text-decoration-none fw-bold " data-toggle="tooltip" data-placement="top" title="Exportieren"><img src="image/file-pdf-regular.svg" class="text-muted" width="14px;"></img></a>';
            //Löschen
            $str_content .= '<a href="unterlagen.delete.php?unterlagen_id=' . $unterlagen_anzeigen->unterlagen_id . '" class="btn btn-sm me-1 text-decoration-none fw-bold" data-toggle="tooltip" data-placement="top" title="Löschen"><img src="image/trash-gray.svg"  class="" width="20px;" ></img></a>';
            //Neues Kapitel
            $str_content .= '<a href="unterlagen.bearbeiten.php?unterlagen_id=' . $unterlagen_anzeigen->unterlagen_id . '&unterlagen_kapitel_id=neu" class="btn btn-sm text-decoration-none fw-bold newKapitel" target="PromoteFirefoxWindow" onclick="popup(this.href, this.target); return false" title="Neues Kapitel" ><img src="image/file-plus.svg" width="20px;" class=""></img></a> ';
            $str_content .= '</div>';
            // Icons Ende //

            $str_content .= '<div class="d-flex flex-column">';
            //Kapitel(Vater)//
            $res_stmt2 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_kapitel WHERE unterlagen_kapitel_vater = '" . $unterlagen_anzeigen->unterlagen_id . "' ORDER BY unterlagen_kapitel_order ASC");
            $res_stmt2->execute();
            $erg_stmt2 = $res_stmt2->fetchAll();
            foreach ($erg_stmt2 as $unterlage_kapitel_anzeigen) {
                $order = $unterlage_kapitel_anzeigen->unterlagen_kapitel_order;
                $str_content .= '<div class="accordion-item border-0 ">';
                $str_content .= ansicht_unterlagen($unterlage_kapitel_anzeigen, $unterlagen_anzeigen->unterlagen_id, $order);
                //  Kapitel - Level 2  //
                $res_stmt3 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_kapitel WHERE unterlagen_kapitel_vater = '" . $unterlage_kapitel_anzeigen->unterlagen_kapitel_id . "' ORDER BY unterlagen_kapitel_order ASC");
                $res_stmt3->execute();
                $erg_stmt3 = $res_stmt3->fetchAll();
                foreach ($erg_stmt3 as $unterlage_kapitel_level2_anzeigen) {
                    $order2 = $order . '.' . $unterlage_kapitel_level2_anzeigen->unterlagen_kapitel_order;
                    $str_content .= '<div class="accordion-item border-0">';
                    $str_content .= ansicht_unterlagen($unterlage_kapitel_level2_anzeigen, $unterlagen_anzeigen->unterlagen_id, $order2);
                    //  Kapitel - Level 3  //
                    $res_stmt4 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_kapitel WHERE unterlagen_kapitel_vater = '" . $unterlage_kapitel_level2_anzeigen->unterlagen_kapitel_id . "' ORDER BY unterlagen_kapitel_order ASC");
                    $res_stmt4->execute();
                    $erg_stmt4 = $res_stmt4->fetchAll();
                    foreach ($erg_stmt4 as $unterlage_kapitel_level3_anzeigen) {
                        $order3 = $order2 . '.' . $unterlage_kapitel_level3_anzeigen->unterlagen_kapitel_order;
                        $str_content .= '<div class="accordion-item border-0">';
                        $str_content .= ansicht_unterlagen($unterlage_kapitel_level3_anzeigen, $unterlagen_anzeigen->unterlagen_id, $order3);
                        //  Kapitel - Level 4  //
                        $res_stmt5 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_kapitel WHERE unterlagen_kapitel_vater = '" . $unterlage_kapitel_level3_anzeigen->unterlagen_kapitel_id . "' ORDER BY unterlagen_kapitel_order ASC");
                        $res_stmt5->execute();
                        $erg_stmt5 = $res_stmt5->fetchAll();
                        foreach ($erg_stmt5 as $unterlage_kapitel_level4_anzeigen) {
                            $order4 = $order3 . '.' . $unterlage_kapitel_level4_anzeigen->unterlagen_kapitel_order;
                            $str_content .= '<div class="accordion-item border-0">';
                            $str_content .= ansicht_unterlagen($unterlage_kapitel_level4_anzeigen, $unterlagen_anzeigen->unterlagen_id, $order4);

                            $str_content .= '</div>';
                            $str_content .= '</div>';
                            $str_content .= '</div>';
                            // Kapitel-Level 4 Ende //
                        }
                        $str_content .= '</div>';
                        $str_content .= '</div>';
                        $str_content .= '</div>';
                        // Kapitel-Level 3 Ende //
                    }
                    $str_content .= '</div>';
                    $str_content .= '</div>';
                    $str_content .= '</div>';
                    // Kapitel-Level 2 Ende  //
                }
                $str_content .= '</div>';
                $str_content .= '</div>';
                $str_content .= '</div>';
                // Kapitel(Vater) Ende  //
            }
            $str_content .= '</div>';
            $str_content .= '</div>';
        } else {
            $str_content .= '<div class="accordion-body">';
            $res_stmt_rechte = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen 
            INNER JOIN mandant_1_kiz_unterlagen_benutzer ON unterlagen_autor = unterlagen_benutzer_id
            WHERE unterlagen_id = '" . $unterlagen_anzeigen->unterlagen_id . "'");
            $res_stmt_rechte->execute();
            $erg_stmt_rechte = $res_stmt_rechte->fetchAll();
            foreach ($erg_stmt_rechte as $data_recht) {
                $str_content .= '<p>Hinweis:<p>';
                $str_content .= '<p>Das Dokument, das Sie erreichen wollen, zurzeit ist nicht aktiv.<p>';
                $str_content .= '<p>Kontaktieren Sie bitte der Autor von Dokument<p>';
                $str_content .= '<p>Mail:  <a href="mailto: ' . $data_recht->unterlagen_benutzer_email . '" class="">' . $data_recht->unterlagen_benutzer_email . '</a><p>';
            }
            $str_content .= '</div>';
        }
    }
    $str_content .= '</div>';
    $str_content .= '</div>';
    // Unterlagen Ende  //
}

echo '
<div class="col-10">
    <div class="d-flex flex-column mt-2 ">
        <div class="d-flex justify-content-between">    
            <span class="fs-6">' . $erg_bereich->unterlagen_bereich_name . ' <img src="fontawesome/svgs/solid/arrow-right.svg" width="10px;" class=""></img> ' . $erg_typ->unterlagen_typ_name . '</span>
            <a href="unterlagen.neu.unterlagen.php?unterlagen_bereich_id=' . $unterlagen_bereich_id . '&unterlagen_typ_id=' . $unterlagen_typ_id . '" class="btn btn-sm hoverfarbe" style="background-color:#FAD499;" target="PromoteFirefoxWindow" onclick="popup(this.href, this.target); return false" title="Neu Unterlagen">Neu Unterlagen</a>
        </div>
        <div class="accordion" id="accordionPanelsStayOpenExample">
            ' . $str_content . '
        </div>
        <!--<div class="d-flex fixed-bottom justify-content-end">
            <div class="me-4">
                <a href="javascript:window.close();" class=""><i class="fas fa-chevron-circle-left fa-2x" style="color:#F9971D;"></i></a>
                <a href="#" class="me-2"><i class="fas fa-chevron-circle-up fa-2x" style="color:#003882;"></i></a>
            </div>
        </div>-->
    </div>
</div>
</div>
</div>';

function ansicht_unterlagen($unterlage_kapitel_anzeigen, $unterlagen_id, $order)
{
    $str_content = '';
    $str_content .= '<h5 class="accordion-header mt-2" id="panelsStayOpen-heading' . $unterlage_kapitel_anzeigen->unterlagen_kapitel_id . '">';
    $str_content .= '<span class="button position-relative" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse' . $unterlage_kapitel_anzeigen->unterlagen_kapitel_id . '" aria-expanded="true" aria-controls="panelsStayOpen-collapse' . $unterlage_kapitel_anzeigen->unterlagen_kapitel_id . '">' . $order . ' ' . $unterlage_kapitel_anzeigen->unterlagen_kapitel_name . '';
    // Icons - Kapitel -Edit   
    $str_content .= '<span class="position-absolute top-0 start-100 ms-4 mt-2 translate-middle badge">';
    $str_content .= '<a href="unterlagen.bearbeiten.php?unterlagen_id=' . $unterlagen_id . '&unterlagen_kapitel_id=' . $unterlage_kapitel_anzeigen->unterlagen_kapitel_id . '"  class="ms-4 me-2" target="PromoteFirefoxWindow" onclick="popup(this.href, this.target); return false" title="Bearbeiten"><img src="image/edit-green.svg" width="12px;" class=""></img></a>';
    // Info
    $str_content .= '<a href="unterlagen.kapitel.info.php?unterlagen_kapitel_id=' . $unterlage_kapitel_anzeigen->unterlagen_kapitel_id . '" target="Promote" onclick="popup(this.href, this.target); return false" class="me-2 view_data" title="Information"><img src="image/info_blue.svg"  width="12px;" class=""></img></a>';
    // Löschen
    $str_content .= '<a href="unterlagen.kapitel.delete.php?unterlagen_kapitel_id=' . $unterlage_kapitel_anzeigen->unterlagen_kapitel_id . '" class="" data-toggle="tooltip" data-placement="top" title="Löschen"><img src="image/trash-red.svg"  width="12px;"class="" ></img></a>';
    $str_content .= '</span>';
    $str_content .= '</span>';
    $str_content .= '</h5>';
    // Wenn man alle Unterlagen im Erste anschauen möchte, dann addieren in "class" "show".
    $str_content .= '<div id="panelsStayOpen-collapse' . $unterlage_kapitel_anzeigen->unterlagen_kapitel_id . '" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-heading' . $unterlage_kapitel_anzeigen->unterlagen_kapitel_id . '">';
    $str_content .= '<div class="accordion-body">';
    $str_content .= '<div class="d-flex flex-column">';
    $str_content .= '' . $unterlage_kapitel_anzeigen->unterlagen_kapitel_inhalt . '';
    if ($unterlage_kapitel_anzeigen->unterlagen_kapitel_dateiname != '') {
        $str_content .= '<div class="">';
        $str_content .= '<a href="unterlagen.anhang.herunterladen.php?file_id=' . $unterlage_kapitel_anzeigen->unterlagen_kapitel_id . '">' . $unterlage_kapitel_anzeigen->unterlagen_kapitel_dateiname . '</a>';
        $str_content .= '</div>';
    }
    $str_content .= '</div>';

    return $str_content;
}

function ansicht_unterlagen_lesen($unterlage_kapitel_anzeigen, $unterlagen_id, $order)
{
    $str_content = '';
    $str_content .= '<h5 class="accordion-header mt-2" id="panelsStayOpen-heading' . $unterlage_kapitel_anzeigen->unterlagen_kapitel_id . '">';
    $str_content .= '<span class="button position-relative" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse' . $unterlage_kapitel_anzeigen->unterlagen_kapitel_id . '" aria-expanded="true" aria-controls="panelsStayOpen-collapse' . $unterlage_kapitel_anzeigen->unterlagen_kapitel_id . '">' . $order . ' ' . $unterlage_kapitel_anzeigen->unterlagen_kapitel_name . '';
    //Icon - Info  
    $str_content .= '<span class="position-absolute top-0 start-100 ms-4 mt-2 translate-middle badge">';
    // Info
    $str_content .= '<a href="unterlagen.kapitel.info.php?unterlagen_kapitel_id=' . $unterlage_kapitel_anzeigen->unterlagen_kapitel_id . '" target="Promote" onclick="popup(this.href, this.target); return false" class="me-2 view_data" title="Information"><img src="image/info_blue.svg"  width="12px;" class=""></img></a>';
    $str_content .= '</span>';
    $str_content .= '</span>';
    $str_content .= '</h5>';
    // Wenn man alle Unterlagen im Erste anschauen möchte, dann addieren in "class" "show".
    $str_content .= '<div id="panelsStayOpen-collapse' . $unterlage_kapitel_anzeigen->unterlagen_kapitel_id . '" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-heading' . $unterlage_kapitel_anzeigen->unterlagen_kapitel_id . '">';
    $str_content .= '<div class="accordion-body">';
    $str_content .= '<div class="d-flex flex-column">';
    $str_content .= '' . $unterlage_kapitel_anzeigen->unterlagen_kapitel_inhalt . '';
    if ($unterlage_kapitel_anzeigen->unterlagen_kapitel_dateiname != '') {
        $str_content .= '<div class="">';
        $str_content .= '<a href="unterlagen.anhang.herunterladen.php?file_id=' . $unterlage_kapitel_anzeigen->unterlagen_kapitel_id . '">' . $unterlage_kapitel_anzeigen->unterlagen_kapitel_dateiname . '</a>';
        $str_content .= '</div>';
    }
    $str_content .= '</div>';

    return $str_content;
}
