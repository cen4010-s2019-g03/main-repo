<?php
require('../../session_info.php');

$conn = new mysqli('localhost','cen4010fal19_g03','h4sRH3MC+n','cen4010fal19_g03');
$result = $conn->query("SELECT * FROM `Issues` JOIN `Users` ON `Issues`.`reported_by` = `Users`.`znum` JOIN `Issue_Statuses` ON `Issues`.`status` = `Issue_Statuses`.`status_id` WHERE `Issues`.`status` <> 4 ORDER BY `date_time_reported` ASC");
$conn->close();

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('times', '', 8, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>false, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
$html = '
<h1>Maintenance Summary Report</h1>
<p>This report displays all campus maintenance issues which have not been resolved.</p>
<table cellpadding="1">
<hr />
<b><tr><td>ID#</td><td>Reported by</td><td>Date/time reported</td><td>Title</td><td>Location</td><td>Priority</td><td>Status</td></tr></b>
';

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$html .= '<hr /><tr><td>' . $row['entry_id'] . '</td><td>' . $row['last'] . ', ' . $row['first'] . '</td><td>' . $row['date_time_reported'] . '</td><td>' . $row['title'] . '</td><td>' . $row['location'] . '</td><td>' . $row['priority'] . '</td><td>' . $row['status'] . '</td></tr>';
	}
}

$html .= '
</table>
';

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
ob_end_clean();
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
