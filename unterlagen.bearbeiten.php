<?php

/**
 * @brief 
 * @details Unterlagen Bearbeiten
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

$unterlagen_id = $_GET['unterlagen_id'];
$unterlagen_kapitel_id = $_GET['unterlagen_kapitel_id'];

$res_stmt = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen 
INNER JOIN  mandant_1_kiz_unterlagen_bereich ON unterlagen_bereich_id_fk = unterlagen_bereich_id
INNER JOIN mandant_1_kiz_unterlagen_typ ON unterlagen_typ_id_fk = unterlagen_typ_id
WHERE unterlagen_id = '" . $unterlagen_id . "'");
$res_stmt->execute();
$erg_stmt = $res_stmt->fetchAll();

foreach ($erg_stmt as $unterlagen_data) {

    $str_content = '';
    //Bereiche 
    $str_content .= '<div class="me-2">';
    $str_content .= '<label for="inlineFormSelectBereiche" class="form-label">Bereiche</label>';
    $str_content .= '<input type="text" name="inlineFormSelectBereiche" id="inlineFormSelectBereiche" class="form-control form-control-sm" value="' . $unterlagen_data->unterlagen_bereich_name . '"readonly>';
    $str_content .= '</div>';
    //Typ 
    $str_content .= '<div class="me-2">';
    $str_content .= '<label for="inlineFormSelectTypen" class="form-label">Typen</label>';
    $str_content .= '<input type="text" name="inlineFormSelectTypen" id="inlineFormSelectTypen" class="form-control form-control-sm" value="' . $unterlagen_data->unterlagen_typ_name . '"readonly>';
    $str_content .= '</div>';

    //Unterlagen
    $str_content .= '<div class="me-2">';
    $str_content .= '<label for="inlineFormSelectUnterlagen" class="form-label">Unterlagen</label>';
    $str_content .= '<input type="text" name="inlineFormSelectUnterlagen" id="inlineFormSelectUnterlagen" class="form-control form-control-sm" value="' . $unterlagen_data->unterlagen_name . '"readonly>';
    $str_content .= '</div>';

    // ---- neues Kapitel einfügen ---- //
    if ($unterlagen_kapitel_id == 'neu') {
        //Select - Kapitel(Vater)
        $res_stmt1 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_kapitel WHERE unterlagen_kapitel_vater = '" . $unterlagen_id . "'");
        $res_stmt1->execute();
        $erg_stmt1 = $res_stmt1->fetchAll();
        $str_content .= '<div class="me-2">';
        $str_content .= '<label for="inlineFormSelectUnterlagenKapitel" class="form-label">Übergeordnetes Kapitel</label>';
        $str_content .= '<select class="form-select form-select-sm" name="inlineFormSelectUnterlagenKapitel" id="inlineFormSelectUnterlagenKapitel">';
        $str_content .= '<option value="' . $unterlagen_id . '">Auswählen...</option>';
        foreach ($erg_stmt1 as $unterlagen_kapitel) {
            $unterlagen_kapitel_selected = '';
            if (@$_POST['inlineFormSelectUnterlagenKapitel'] == $unterlagen_kapitel->unterlagen_kapitel_id) {
                $unterlagen_kapitel_selected = 'selected';
            }
            $str_content .= '<option value="' . $unterlagen_kapitel->unterlagen_kapitel_id . '" ' . $unterlagen_kapitel_selected . '>' . $unterlagen_kapitel->unterlagen_kapitel_order . '.' . $unterlagen_kapitel->unterlagen_kapitel_name . '</option>';

            $res_stmt12 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_kapitel WHERE unterlagen_kapitel_vater = '" . $unterlagen_kapitel->unterlagen_kapitel_id . "'");
            $res_stmt12->execute();
            $erg_stmt12 = $res_stmt12->fetchAll();
            foreach ($erg_stmt12 as $unterlagen_kapitel_1) {
                $unterlagen_kapitel_selected_1 = '';
                if (@$_POST['inlineFormSelectUnterlagenKapitel'] == $unterlagen_kapitel_1->unterlagen_kapitel_id) {
                    $unterlagen_kapitel_selected_1 = 'selected';
                }
                $str_content .= '<option value="' . $unterlagen_kapitel_1->unterlagen_kapitel_id . '" ' . $unterlagen_kapitel_selected_1 . '>' . $unterlagen_kapitel->unterlagen_kapitel_order . '.' . $unterlagen_kapitel_1->unterlagen_kapitel_order . ' ' . $unterlagen_kapitel_1->unterlagen_kapitel_name . '</option>';

                $res_stmt123 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_kapitel WHERE unterlagen_kapitel_vater = '" . $unterlagen_kapitel_1->unterlagen_kapitel_id . "'");
                $res_stmt123->execute();
                $erg_stmt123 = $res_stmt123->fetchAll();
                foreach ($erg_stmt123 as $unterlagen_kapitel_2) {
                    $unterlagen_kapitel_selected_2 = '';
                    if (@$_POST['inlineFormSelectUnterlagenKapitel'] == $unterlagen_kapitel_2->unterlagen_kapitel_id) {
                        $unterlagen_kapitel_selected_2 = 'selected';
                    }

                    $str_content .= '<option value="' . $unterlagen_kapitel_2->unterlagen_kapitel_id . '" ' . $unterlagen_kapitel_selected_2 . '>' . $unterlagen_kapitel->unterlagen_kapitel_order . '.' . $unterlagen_kapitel_1->unterlagen_kapitel_order . '.' . $unterlagen_kapitel_2->unterlagen_kapitel_order . ' ' . $unterlagen_kapitel_2->unterlagen_kapitel_name . '</option>';

                    $res_stmt1234 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_kapitel WHERE unterlagen_kapitel_vater = '" . $unterlagen_kapitel_2->unterlagen_kapitel_id . "'");
                    $res_stmt1234->execute();
                    $erg_stmt1234 = $res_stmt1234->fetchAll();
                    foreach ($erg_stmt1234 as $unterlagen_kapitel_3) {
                        $unterlagen_kapitel_selected_3 = '';
                        if (@$_POST['inlineFormSelectUnterlagenKapitel'] == $unterlagen_kapitel_3->unterlagen_kapitel_id) {
                            $unterlagen_kapitel_selected_3 = 'selected';
                        }

                        $str_content .= '<option value="' . $unterlagen_kapitel_3->unterlagen_kapitel_id . '" ' . $unterlagen_kapitel_selected_3 . '>' . $unterlagen_kapitel->unterlagen_kapitel_order . '.' . $unterlagen_kapitel_1->unterlagen_kapitel_order . '.' . $unterlagen_kapitel_2->unterlagen_kapitel_order . '.' . $unterlagen_kapitel_3->unterlagen_kapitel_order . ' ' . $unterlagen_kapitel_3->unterlagen_kapitel_name . '</option>';
                    }
                }
            }
        }
        $str_content .= '</select>';
        $str_content .= '</div>';

        if (isset($_POST['speichern'])) {
            $unterlagen_kapitel_datum = date("Y-m-d");
            $unterlagen_kapitel_time = date("H:i:s");
            $unterlagen_kapitel_autor = $_SESSION['benutzer_id'];
            $unterlagen_kapitel_bearbeitet_von = $_SESSION['benutzer_id'];
            $unterlagen_kapitel_bearbeitet_zuletzt = date("Y-m-d H:i:s");

            $filename = '';
            $filename_bcrypt = '';
            $filetyp = '';

            //File Upload
            if (isset($_FILES['inputFile']['name'])) {
                $filename = $_FILES['inputFile']['name'];
                if ($filename !== '') {
                    $filename_bcrypt = password_hash($filename, PASSWORD_DEFAULT);
                }
                $filetyp = $_FILES['inputFile']['type'];
                $destination = 'uploads/' . $filename;
                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                $file = $_FILES['inputFile']['tmp_name'];
                move_uploaded_file($file, $destination);
            }

            //insert Query
            $stmt = $conn->prepare(
                "INSERT INTO 
                mandant_1_kiz_unterlagen_kapitel 
                (unterlagen_id_fk, 
                unterlagen_kapitel_name, 
                unterlagen_kapitel_inhalt, 
                unterlagen_kapitel_order, 
                unterlagen_kapitel_vater, 
                unterlagen_kapitel_datum, 
                unterlagen_kapitel_time, 
                unterlagen_kapitel_dateianhang, 
                unterlagen_kapitel_dateiname, 
                unterlagen_kapitel_dateiendung, 
                unterlagen_kapitel_autor, 
                unterlagen_kapitel_bearbeitet_von, 
                unterlagen_kapitel_bearbeitet_zuletzt) 
                VALUES 
                (?,?,?,?,?,?,?,?,?,?,?,?,?)"
            );
            $stmt->bindParam(1, $unterlagen_id);
            $stmt->bindParam(2, $_POST['ueberschrift']);
            $stmt->bindParam(3, $_POST['summernote-kapitel-text']);
            $stmt->bindParam(4, $_POST['orderNummer']);
            $stmt->bindParam(5, $_POST['inlineFormSelectUnterlagenKapitel']);
            $stmt->bindParam(6, $unterlagen_kapitel_datum);
            $stmt->bindParam(7, $unterlagen_kapitel_time);
            $stmt->bindParam(8, $filename_bcrypt);
            $stmt->bindParam(9, $filename);
            $stmt->bindParam(10, $filetyp);
            $stmt->bindParam(11, $unterlagen_kapitel_autor);
            $stmt->bindParam(12, $unterlagen_kapitel_bearbeitet_von);
            $stmt->bindParam(13, $unterlagen_kapitel_bearbeitet_zuletzt);
            $stmt->execute();
        }
    }
    // ---- Kapitel bearbeiten ---- //
    else if ($unterlagen_id > 0 && $unterlagen_kapitel_id > 0) {
        $res_stmt2 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen 
        INNER JOIN mandant_1_kiz_unterlagen_kapitel ON unterlagen_id = unterlagen_id_fk
        WHERE unterlagen_kapitel_id = '" . $unterlagen_kapitel_id . "'");
        $res_stmt2->execute();
        $erg_stmt2 = $res_stmt2->fetchAll();
        foreach ($erg_stmt2 as $unterlagen_kapitel) {
            $order_nummer = $unterlagen_kapitel->unterlagen_kapitel_order;
            $ueberschrift = $unterlagen_kapitel->unterlagen_kapitel_name;
            $text = $unterlagen_kapitel->unterlagen_kapitel_inhalt;
            $anhang = $unterlagen_kapitel->unterlagen_kapitel_dateiname;

            $str_content .= '<div class="me-2">';
            $str_content .= '<label for="inlineFormSelectUnterlagenKapitel" class="form-label">Übergeordnetes Kapitel</label>';
            if ($unterlagen_kapitel->unterlagen_kapitel_vater > 1000) {
                $res_stmt3 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_kapitel WHERE unterlagen_kapitel_id = '" . $unterlagen_kapitel->unterlagen_kapitel_vater . "'");
                $res_stmt3->execute();
                $erg_stmt3 = $res_stmt3->fetchAll();
                foreach ($erg_stmt3 as $unterlagen_kapitel_vater_name) {
                }
                $str_content .= '<input type="text" name="inlineFormSelectUnterlagenKapitel" id="inlineFormSelectUnterlagenKapitel" class="form-control form-control-sm" value="' . $unterlagen_kapitel_vater_name->unterlagen_kapitel_name . '"readonly>';
            } else {
                $str_content .= '<input type="text" name="inlineFormSelectUnterlagenKapitel" id="inlineFormSelectUnterlagenKapitel" class="form-control form-control-sm" value="' . $unterlagen_data->unterlagen_name . '"readonly>';
            }
            $str_content .= '</div>';
            $anhang_content = '';
            if ($unterlagen_kapitel->unterlagen_kapitel_dateiname != '') {
                $anhang_content .= '<div class="">';
                $anhang_content .= '<a href="downloads.php?file_id=' . $unterlagen_kapitel->unterlagen_kapitel_id . '">' . $unterlagen_kapitel->unterlagen_kapitel_dateiname . '</a>';
                $anhang_content .= '</div>';
            }
        }
        if (isset($_POST['speichern'])) {
            // $unterlagen_kapitel_autor = '';
            $unterlagen_kapitel_bearbeitet_von = $_SESSION['benutzer_id'];
            $unterlagen_kapitel_bearbeitet_zuletzt = date("Y-m-d H:i:s");

            $filename = '';
            $filename_bcrypt = '';
            $filetyp = '';

            //File Upload
            if (isset($_FILES['inputFile']['name'])) {
                $filename = $_FILES['inputFile']['name'];
                if ($filename !== '') {
                    $filename_bcrypt = password_hash($filename, PASSWORD_DEFAULT);
                }
                $filetyp = $_FILES['inputFile']['type'];
                $destination = 'uploads/' . $filename;
                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                $file = $_FILES['inputFile']['tmp_name'];
                move_uploaded_file($file, $destination);
            }

            //update Query
            $res_stmt4 = $conn->prepare(
                "UPDATE 
            mandant_1_kiz_unterlagen_kapitel 
            SET 
            unterlagen_kapitel_name = '" . $_POST['ueberschrift'] . "', 
            unterlagen_kapitel_inhalt = '" . $_POST['summernote-kapitel-text'] . "', 
            unterlagen_kapitel_order = '" . $_POST['orderNummer'] . "', 
            unterlagen_kapitel_vater = '" . $unterlagen_kapitel->unterlagen_kapitel_vater . "', 
            unterlagen_kapitel_dateianhang = '" . $filename_bcrypt . "',
            unterlagen_kapitel_dateiname =  '" . $filename . "',
            unterlagen_kapitel_dateiendung = '" . $filetyp . "',
            unterlagen_kapitel_bearbeitet_von = '" . $unterlagen_kapitel_bearbeitet_von . "', 
            unterlagen_kapitel_bearbeitet_zuletzt = '" . $unterlagen_kapitel_bearbeitet_zuletzt . "' 
            WHERE 
            unterlagen_kapitel_id = '" . $unterlagen_kapitel_id . "'"
            );
            $res_stmt4->execute();


            $res_stmt5 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_kapitel WHERE unterlagen_kapitel_id = '" . $unterlagen_kapitel_id . "'");
            $res_stmt5->execute();
            $erg_stmt5 = $res_stmt5->fetchAll();
            foreach ($erg_stmt5 as $aktualisierte_unterlagen) {
                $order_nummer = $aktualisierte_unterlagen->unterlagen_kapitel_order;
                $ueberschrift = $aktualisierte_unterlagen->unterlagen_kapitel_name;
                $text = $aktualisierte_unterlagen->unterlagen_kapitel_inhalt;
                $anhang = $aktualisierte_unterlagen->unterlagen_kapitel_dateiname;
            }
        }
    }
}

echo '
            <div class="d-flex flex-column mt-2">
                <!-- <div class="d-flex justify-content-end">
                    <a href="unterlagen.kapitel.modal.php?kapitel_id=<?= @$unterlagen_kapitel_id ?>" target="Promote" onclick="openRequestedPopup(this.href, this.target); return false" class="d-flex btn text-muted view_data" title="Information"><i class="fas fa-info-circle"></i></a>
                    <span class="d-flex"><a href="unterlagen.kapitel.delete.php?unterlagenKapitelId=<?= $unterlagen_kapitel_id ?>&unterlagenKapitelOrder=<?= @$order_nummer ?>&unterlagenVaterId=<?= $unterlagen_vater_id ?>&unterlagenBereiche=<?= $unterlagen_bereiche_id ?>&unterlagenBereicheName=<?= $unterlagen_bereiche_name ?>&unterlagenTypeId=<?= $unterlagen_typ_id ?>&unterlagenTypeName=<?= $unterlagen_typ_name ?>" class="btn text-muted" data-toggle="tooltip" data-placement="top" title="Löschen"><i class="far fa-trash-alt"></i></a></span>
                </div> -->
                <form action="" method="post" enctype="multipart/form-data">
                    <div class=" d-flex">
                        ' . $str_content . '
                    </div>
                    <div class="d-flex mb-4">
                        <div class="d-flex flex-column w-25">
                            <div class="d-flex flex-column m-2">
                                <label for="orderNummer" class="form-label">Order Nummer</label>
                                <input type="text" class="form-control form-control-sm" name="orderNummer" id="orderNummer" value="' . @$order_nummer . '">
                            </div>
                            <div class="d-flex flex-column m-2">
                                <label for="ueberschrift" class="form-label">Überschrift</label>
                                <input type="text" class="form-control form-control-sm" name="ueberschrift" id="ueberschrift" value="' . @$ueberschrift . '">
                            </div>
                            <div class="d-flex flex-column m-2">
                                <label class="form-label" for="inputFile">Dateianhang</label>
                                <input type="file" class="form-control form-control-sm" name="inputFile" id="inputFile">
                            </div>
                            <div class="d-flex flex-column m-2">
                                <label class="form-label" for="">Dateianhang</label>
                                <a href="downloads.php?file_id=' . $unterlagen_kapitel_id . '">' . @$anhang . '</a>
                            </div>
                            <div class="ms-2">
                                ' . @$str_content_ergebnis . '
                            </div> 
                        </div>

                        <div class="w-75 ms-2 mt-2">
                            <label for="summernote-kapitel-text" class="form-label">Text</label>
                            <textarea name="summernote-kapitel-text" id="summernote-kapitel-text" cols="30" rows="10" class="form-control form-control-sm" style="height: 300px;">' . @$text . '</textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mb-2">
                        <a href="javascript:window.close();"><button type="button" class="btn form-control btn-sm" style="background-color:#F9971D;">Abbrechen</button></a>
                        <input type="submit" name="speichern" id="speichern" class="ms-2 form-control form-control-sm " value="Speichern" style="width: 5rem; background-color:#F9971D;">
                    </div>
                </form>
            </div>
        </div>
    </div>
    ';
require_once("ansicht/ansicht.unten.php");
