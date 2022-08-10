<?php

/**
 * @brief 
 * @details Anhang Herunterladen
 * @package IHK-Projekt
 * @filesource
 * @source
 * @author Aykut Acarer
 * @link https://localhost/php/IHK-Projekt/project
 * @remark 20220128 AcarA Anlegen der Index
 */

require_once("config/config.php");

if ($_GET['file_id'] > 0) {
    $file_id = $_GET['file_id'];
}

$stmt = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_kapitel WHERE unterlagen_kapitel_id = '" . $file_id . "'");
$stmt->execute();
$erg_stmt = $stmt->fetchAll();

$filepath = '';
foreach ($erg_stmt as $myfile) {
    $filepath = 'uploads/' . $myfile->unterlagen_kapitel_dateiname;

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        // header('Content-Length: ' . filesize('uploads/' . $file['name']));
        readfile('uploads/' . $myfile->unterlagen_kapitel_dateiname);

        exit;
    }
}
