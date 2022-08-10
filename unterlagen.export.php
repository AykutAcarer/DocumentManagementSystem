<?php

require_once("config/config.php");
require_once('klasse/tcpdf/examples/tcpdf_include.php');
require_once('klasse/tcpdf/tcpdf.php');

$unterlagen_id = '';
if ($_GET['unterlagen_id'] > 0) {
    $unterlagen_id = $_GET['unterlagen_id'];
}
$res_stmt_name = $conn("SELECT * FROM mandant_1_kiz_unterlagen WHERE unterlagen_id = '" . $unterlagen_id . "'");
$res_stmt_name->execute();
$erg_stmt_name = $res_stmt_name->fetchAll();
$unterlagen_ueberschrift = '';
foreach ($erg_stmt_name as $unterlagen) {
    $unterlagen_ueberschrift = $unterlagen->unterlagen_name;
}

@date_default_timezone_get('Europe/Berlin');
$datum = date("d.m.Y");
//Definitionen für pdf-Erstellung hier überschreiben
// define('K_PATH_IMAGES', 'C:/xampp/htdocs/php/15.IHK-Projekt/project/image/');
// define('PDF_HEADER_LOGO', 'kiz_logo.jpg');
// define('PDF_HEADER_LOGO_WIDTH', 20);
// define('PDF_HEADER_TITLE', 'Klassenbuch');
// define('PDF_HEADER_STRING', $klassenbuch['bob_nummer'] . ' - ' . $klassenbuch['bob_name']);
// define('PDF_MARGIN_LEFT', 15);
// define('PDF_MARGIN_TOP', 40);
// define('PDF_MARGIN_RIGHT', 15);
// define('PDF_MARGIN_HEADER', 15);
// define('PDF_MARGIN_FOOTER', 10);
define('PDF_FOOTER_BACKGROUND', 'kiz_pdf_footer.png');
// define('BOB_NAME', $klassenbuch['bob_name']);
define('PDF_FONT', 'Arial');


class MYPDF extends TCPDF
{
    //Deckblatt - //Kopfzeile
    public function HeaderDecklatt()
    {
        $this->SetY(25);
        //Titel + Schriftart einstellen + Textfarbe
        $this->SetFont(PDF_FONT, 'B', 12);
        // $this->SetTextColor(0, 0, 0);
        // $this->Cell(10, 100, 'KONZEPT', 0, '0', 'L', 0, '', 0, false, 'M', 'M');

        // Subtitle + Font
        // $cell_height = $this->getCellHeight($headerfont[2] / $this->k);
        // $this->SetY((20 / $this->k) + $this->y);
        // $this->SetFont(PDF_FONT, 'B', 14);
        // $this->Cell(10, 100, '', 0, '0', 'L', 0, '', 0, false, 'M', 'M');

        // Logo
        $image_file = K_PATH_IMAGES . 'kiz_logo.jpg';
        $this->Image($image_file, 10, 10, 25, '', 'jpg', '', 'T', false, 300, 'R', false, false, 0, false, false, false);
    }
    // Deckblatt - Fußzeile
    public function FooterDeckblatt()
    {
        global $datum;
        // Logo
        $image_file = K_PATH_IMAGES . PDF_FOOTER_BACKGROUND;
        $this->Image($image_file, 0, 275, 210, '', 'png', '', '', false, 300, '', false, false, 0, false, false, false);
        // Position 15 mm von unten 
        $this->SetY(-14);
        // Schriftart einstellen 
        $this->SetFont(PDF_FONT, 'R', 8);
        // Textfarbe
        $this->SetTextColor(255, 255, 255);
        //Linke der Deckblattfooter
        $this->Cell(60, 0, 'Bieter: KIZ PROWINA GmbH', 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(60, 0, '© KIZ', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        // Seitennummer
        $this->Cell(70, 0,  '' . $datum . '' . ' / Seite ' . $this->getAliasNumPage() . ' von ' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
    //Kopfzeile
    public function Header()
    {
        if ($this->page == 1) {
            //für Deckblatt
            $this->HeaderDecklatt();
        } else {
            $this->SetY(15);
            //Titel + Schriftart einstellen + Textfarbe
            $this->SetFont(PDF_FONT, 'B', 20);
            $this->SetTextColor(0, 0, 0);
            $this->Cell(0, 0, '', 0, '0', 'C', 0, '', 0, false, 'M', 'M');

            // Subtitle + Font
            // $cell_height = $this->getCellHeight($headerfont[2] / $this->k);
            // $this->SetY((20 / $this->k) + $this->y);
            // $this->SetFont(PDF_FONT, 'B', 14);
            // $this->Cell(0, 0, '' . $_GET['unterlagenUeberschrift'] . '', 0, '0', 'C', 0, '', 0, false, 'M', 'M');

            // Logo
            $image_file = K_PATH_IMAGES . 'kiz_logo.jpg';
            $this->Image($image_file, 10, 10, 25, '', 'jpg', '', 'T', false, 300, 'R', false, false, 0, false, false, false);
        }
    }

    // Fußzeile
    public function Footer()
    {
        if ($this->page == 1) {
            //für Deckblatt
            $this->FooterDeckblatt();
        } else {
            // Logo
            $image_file = K_PATH_IMAGES . PDF_FOOTER_BACKGROUND;
            $this->Image($image_file, 0, 275, 210, '', 'png', '', '', false, 300, '', false, false, 0, false, false, false);
            // Position 15 mm von unten 
            $this->SetY(-14);
            // Schriftart einstellen 
            $this->SetFont(PDF_FONT, 'R', 8);
            // Textfarbe
            $this->SetTextColor(255, 255, 255);
            // Seitennummer
            $this->Cell(60, 0, '', 0, false, 'L', 0, '', 0, false, 'T', 'M');
            $this->Cell(60, 0, '© KIZ', 0, false, 'C', 0, '', 0, false, 'T', 'M');
            $this->Cell(70, 0, 'Seite ' . $this->getAliasNumPage() . ' von ' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
        }
    }
}
// neues PDF-Dokument erstellen 
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Dokumentinformationen festlegen 
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Benutzer');
$pdf->SetTitle('' . $unterlagen_ueberschrift . '');
$pdf->SetSubject('' . $unterlagen_ueberschrift . '');
$pdf->SetKeywords('KIZ, PDF, ' . $unterlagen_ueberschrift . '');

// Standardkopfdaten festlegen 
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 006', PDF_HEADER_STRING);

// Schriftarten für Kopf- und Fußzeile festlegen 
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Festlegen der Standardschriftart mit festem Abstand 
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// margins setzen
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// automatische Seitenumbrüche einstellen 
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// image scale factor setzen
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// einige sprachabhängige Strings setzen
if (@file_exists(dirname(__FILE__) . 'klasse/tcpdf/examples/lang/eng.php')) {
    require_once(dirname(__FILE__) . 'klasse/tcpdf/examples/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// --------------------  Deckblatt -------------------- //

// Schriftart einstellen 
$pdf->SetFont(PDF_FONT, '', 11);
// Deckblatt addieren
$pdf->AddPage();

//Ueberschrift
$pdf->SetY(65);
$str_deckblatt_content1 = '
<h1 style="letter-spacing: 2px;"><b>' . $_GET['unterlagenUeberschrift'] . '</b><br>
<span style=" font-size:16px; letter-spacing: 2px;"><strong></strong></span></h1>
';
$pdf->writeHTML($str_deckblatt_content1, true, false, true, false, '');

//Inhalt
// $pdf->SetY(110);
// $str_deckblatt_content2 = '
// <p style="letter-spacing: 3px;">Jobcenter Fürstenfeldbruck<br>
// Vergabenummer: </p>
// ';
// $pdf->writeHTML($str_deckblatt_content2, true, false, true, false, '');

//Tabelle
$pdf->SetY(200);
$str_deckblatt_content3 = '
<table cellspacing="0" cellpadding="1" border="0">
<tr>
    <td rowspan="2"><b>KIZ PROWINA GmbH</b><br /><b>Kristin Weidner</b><br />Hermann-Steinhäuser-Str. 43-47<br />63065 Offenbach
    <br /><br />Tel.: 069-667796-100<br />Fax: 069-667796-222<br />E-Mail: <a href"mailto:ausschreibung@kiz.de">ausschreibung@kiz.de</a></td>
    <td rowspan="2"><b>KIZ PROWINA GmbH</b><br /><b>Rainer Emmrich</b><br />Westendstr. 177<br />80686 München
    <br /><br />Tel.: 089 75 96 78 81<br />Fax: 069-667796-222<br />E-Mail: <a href"mailto:ausschreibung@kiz.de">raineremmrich@kiz.de</a></td>
</tr>
</table>';
$pdf->writeHTML($str_deckblatt_content3, true, false, true, false, '');

// --------------------  Inhalt -------------------- //

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

//Select Abfrage nach dem ID
$stmt = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_kapitel WHERE kapitel_vater = ? ORDER BY kapitel_order ASC");
$stmt->bindParam(1, $unterlagen_id);
$stmt->execute();

foreach ($stmt as $unterlage_kapitel) {
    // Schriftart einstellen 
    $pdf->SetFont('helvetica', '', 10);

    // eine Seite hinzufügen 
    $pdf->AddPage();

    // -------- Kapitel (Vater) Beginn -------- //

    // ein Lesezeichen für die aktuelle Position setzen - Level 0
    $pdf->Bookmark('' . $unterlage_kapitel['kapitel_order'] . '.' . $unterlage_kapitel['kapitel_name'] . '', 0, 0, '', 'B', array(0, 64, 128));

    // eine Zeile mit Cell() ausgeben - Ueberschrift der Kapitel
    $pdf->writeHTMLCell(0, 10, '', '', '<h4><b>' . $unterlage_kapitel['kapitel_order'] . '.' . $unterlage_kapitel['kapitel_name'] . '</b></h4>', 0, 0, 0, true, 'L', true);


    // Inhalt der Kapitel
    $html = '';
    $html .= '<br>' . $unterlage_kapitel['kapitel_inhalt'] . '<br>';
    $pdf->writeHTML($html, true, true, true, false, '');

    // -------- Kapitel (Child) Beginn -------- //

    $stmt1 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_kapitel WHERE kapitel_vater = ? ORDER BY kapitel_order ASC");
    $stmt1->bindParam(1, $unterlage_kapitel['kapitel_id']);
    $stmt1->execute();

    foreach ($stmt1 as $unterlage_child_kapitel) {

        // ein Lesezeichen für die aktuelle Position setzen Level 1
        $pdf->Bookmark('' . $unterlage_kapitel['kapitel_order'] . '.' . $unterlage_child_kapitel['kapitel_order'] . '.' . $unterlage_child_kapitel['kapitel_name'] . '', 1, 0, '', '', array(0, 0, 0));

        // eine Zeile mit Cell() ausgeben - Ueberschrift der Kapitel
        $pdf->writeHTMLCell(0, 10, '', '', '<h4><b>' . $unterlage_kapitel['kapitel_order'] . '.' . $unterlage_child_kapitel['kapitel_order'] . '.' . $unterlage_child_kapitel['kapitel_name'] . '</b></h4>', 0, 0, 0, true, 'L', true);

        // Inhalt der Kapitel (Child)
        $html1 = '';
        $html1 .= '<br>' . $unterlage_child_kapitel['kapitel_inhalt'] . '<br>';
        $pdf->writeHTML($html1, true, true, true, false, '');

        // -------- Kapitel (Child-Child) Beginn -------- //
        $stmt2 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_kapitel WHERE kapitel_vater = ? ORDER BY kapitel_order ASC");
        $stmt2->bindParam(1, $unterlage_child_kapitel['kapitel_id']);
        $stmt2->execute();
        foreach ($stmt2 as $unterlage_child_child_kapitel) {

            // ein Lesezeichen für die aktuelle Position setzen Level 2
            $pdf->Bookmark('' . $unterlage_kapitel['kapitel_order'] . '.' . $unterlage_child_kapitel['kapitel_order'] . '.' . $unterlage_child_child_kapitel['kapitel_order'] . '.' . $unterlage_child_child_kapitel['kapitel_name'] . '', 2, 0, '', '', array(0, 0, 0));

            // eine Zeile mit Cell() ausgeben - Ueberschrift der Kapitel
            $pdf->writeHTMLCell(0, 10, '', '', '<h4><b>  ' . $unterlage_kapitel['kapitel_order'] . '.' . $unterlage_child_kapitel['kapitel_order'] . '.' . $unterlage_child_child_kapitel['kapitel_order'] . '.' . $unterlage_child_child_kapitel['kapitel_name'] . '</b></h4>', 0, 0, 0, true, 'L', true);

            // Inhalt der Kapitel (Child-Child)
            $html2 = '';
            $html2 .= '<br>' . $unterlage_child_child_kapitel['kapitel_inhalt'] . '<br>';
            $pdf->writeHTML($html2, true, true, true, false, '');

            // -------- Kapitel (Child-Child-Child) Beginn -------- //

            $stmt3 = $conn->prepare("SELECT * FROM mandant_1_kiz_unterlagen_kapitel WHERE kapitel_vater = ? ORDER BY kapitel_order ASC");
            $stmt3->bindParam(1, $unterlage_child_child_kapitel['kapitel_id']);
            $stmt3->execute();
            foreach ($stmt3 as $unterlage_child_child_child_kapitel) {

                // ein Lesezeichen für die aktuelle Position setzen Level 2
                $pdf->Bookmark('' . $unterlage_kapitel['kapitel_order'] . '.' . $unterlage_child_kapitel['kapitel_order'] . '.' . $unterlage_child_child_kapitel['kapitel_order'] . '.' . $unterlage_child_child_child_kapitel['kapitel_order'] . '. ' . $unterlage_child_child_child_kapitel['kapitel_name'] . '', 3, 0, '', '', array(0, 0, 0));

                // eine Zeile mit Cell() ausgeben - Ueberschrift der Kapitel
                $pdf->writeHTMLCell(0, 10, '', '', '<h4><b>  ' . $unterlage_kapitel['kapitel_order'] . '.' . $unterlage_child_kapitel['kapitel_order'] . '.' . $unterlage_child_child_kapitel['kapitel_order'] . '.' . $unterlage_child_child_child_kapitel['kapitel_order'] . '. ' . $unterlage_child_child_child_kapitel['kapitel_name'] . '</b></h4>', 0, 0, 0, true, 'L', true);

                // Inhalt der Kapitel (Child-Child-Child)
                $html3 = '';
                $html3 .= '<br>' . $unterlage_child_child_child_kapitel['kapitel_inhalt'] . '<br>';
                $pdf->writeHTML($html3, true, true, true, false, '');
                // -------- Kapitel (Child-Child-Child) Ende -------- //
            }
            // -------- Kapitel (Child-Child) Ende -------- //
        }
        // -------- Kapitel (Child) Ende -------- //
    }
    // -------- Kapitel (Vater) Ende -------- //
}
// -------- Unterlagen Ende -------- //


// ---------- Indexverzeichnis ---------- //

$pdf->addTOCPage();
$pdf->SetFont('Arial', 'B', 11);
$pdf->MultiCell(0, 0, 'Inhaltsverzeichnis ', 0, 'L', 0, 1, '', '', true, 0);
$pdf->Ln();

// auf dem zweiten Seite eine Indexverzeichnis addieren
$pdf->addTOC(2, 'Arial', '.', 'Inhaltsverzeichnis ', 'B', array(128, 0, 0));

$pdf->endTOCPage();


//PDF-Dokument schließen und ausgeben 
$pdf->Output('' . $unterlagen_ueberschrift . '', 'I');
