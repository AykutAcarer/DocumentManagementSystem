<?php

/**
 * @brief 
 * @details Zugriffrechte
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


$benutzer_vorname_name = $_SESSION['benutzer_vorname'] . ' ' . $_SESSION['benutzer_name'];
$str_content = '';
$str_content .= '<form action="" method="post">';
$str_content .= '<table class="table table-striped table-hover" style="cursor:pointer;">';
$str_content .= '<thead class="">';
$str_content .= '<tr>';
$str_content .= '<th scope="col">Unterlagen</th>';
$str_content .= '<th scope="col">Bereich</th>';
$str_content .= '<th scope="col">Typ</th>';
$str_content .= '<th scope="col">Zugriffrechte</th>';
$str_content .= '<th scope="col">Aktiv</th>';
$str_content .= '</tr>';
$str_content .= '</thead>';
$str_content .= '<tbody>';

$res_stmt = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen  
LEFT JOIN mandant_1_kiz_unterlagen_bereich ON unterlagen_bereich_id_fk = unterlagen_bereich_id
LEFT JOIN mandant_1_kiz_unterlagen_typ ON unterlagen_typ_id_fk = unterlagen_typ_id
LEFT JOIN mandant_1_kiz_unterlagen_benutzer ON unterlagen_autor = unterlagen_benutzer_id
LEFT JOIN mandant_1_kiz_unterlagen_zugriffrechte ON unterlagen_id = unterlagen_id_fk
WHERE unterlagen_autor = '" . $_SESSION['benutzer_id'] . "'
GROUP BY unterlagen_id");
$res_stmt->execute();
$erg_stmt = $res_stmt->fetchAll();
foreach ($erg_stmt as $unterlagen) {
    $unterlagen_id = $unterlagen->unterlagen_id;

    $res_stmt_benutzer = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_benutzer");
    $res_stmt_benutzer->execute();
    $erg_stmt_benutzer = $res_stmt_benutzer->fetchAll();

    $res_stmt_gruppe = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_gruppe");
    $res_stmt_gruppe->execute();
    $erg_stmt_gruppe = $res_stmt_gruppe->fetchAll();

    $str_content .= '<tr>';
    $str_content .= '<td><a href="unterlagen.anzeige.php?unterlagen_bereich_id=' . $unterlagen->unterlagen_bereich_id . '&unterlagen_typ_id=' . $unterlagen->unterlagen_typ_id . '#panelsStayOpen-heading' . $unterlagen->unterlagen_id . '" target="_blank">' .  $unterlagen->unterlagen_name . '</td>';
    $str_content .= '<td>' . $unterlagen->unterlagen_bereich_name . '</td>';
    $str_content .= '<td>' . $unterlagen->unterlagen_typ_name . '</td>';
    $str_content .= '<td>';
    $str_content .= '<a href="unterlagen.zugriffsrechte.php?unterlagen_id=' . $unterlagen->unterlagen_id . '" class="btn btn btn-sm hoverfarbe" style="background-color:#FAD499;">Zugriffsrechte</a>';
    $str_content .= '</td>';
    $str_content .= '<td>';
    $str_content .= '<div class="d-flex ">';

    if ($unterlagen->unterlagen_aktiv == 'ja') {
        $checked_ja = 'checked';
        $checked_nein = '';
    } elseif ($unterlagen->unterlagen_aktiv == 'nein') {
        $checked_ja = '';
        $checked_nein = 'checked';
    }
    $str_content .= '<input class="form-check-input" type="radio" name="check[' . $unterlagen->unterlagen_id . ']" id="check[' . $unterlagen->unterlagen_id . ']" value="ja" '.$checked_ja.'>  ja';
    $str_content .= '<input class="form-check-input ms-4" type="radio" name="check[' . $unterlagen->unterlagen_id . ']" id="check[' . $unterlagen->unterlagen_id . ']" value="nein" '.$checked_nein.'>  nein';

    $str_content .= '</div>';
    $str_content .= '</td>';
    $str_content .= '</tr>';
}
$str_content .= '</tbody>';
$str_content .= '</table>';
$str_content .= '<div class="d-flex justify-content-end mb-4">';
$str_content .= '<a href="javascript:window.close();"><button type="button" class="form-control btn btn-sm" style="background-color:#F9971D;" data-bs-dismiss="modal">Abbrechen</button></a>';
$str_content .= '<input type="submit" name="speichern" id="speichern" value="speichern" class=" form-control form-control-sm btn btn-sm" style="width:5rem; background-color:#F9971D;"/>';
$str_content .= '</div>';
$str_content .= '</form>';

if (isset($_POST['speichern'])) {

    foreach ($_POST['check'] as $id => $value) {
       
        $res_stmt_speicher1 = $conn->prepare(
            "UPDATE 
            mandant_1_kiz_unterlagen 
            SET
            unterlagen_aktiv='" . $value . "' 
            WHERE unterlagen_id='" . $id . "'
            "
        );
        $res_stmt_speicher1->execute();
    }
}

// echo '<pre>';
// print_r($data);
// echo '</pre>';

echo '

<div class="d-flex flex-column">
    ' . $str_content . '
</div>
</div>
</div>


</body>

<!--<script>
$(\'.check\').click(function() {
    if ($(this).is(\':checked\')) {
        $(this).attr(\'value\', \'ja\');
        alert($(this).val());
    }
    else {
       $(this).attr(\'value\', \'nein\');
       alert($(this).val());
    }
});
</script>-->
</html>';
