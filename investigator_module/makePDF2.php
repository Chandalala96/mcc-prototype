<?php
  
ob_end_clean();
require('../fpdf/fpdf.php');


class PDF extends FPDF {

  // Page header
  function Header() {
    
   
    
    // Set font family to Arial bold
    $this->SetFont('Arial','B',20);
    
    // Move to the right
    $this->Cell(80);
    
    // Header
    $this->Cell(50,10,'Incident Report');
    
    // Line break
    $this->Ln(20);
  }

 
}

// Instantiation of FPDF class
$pdf = new PDF();

// Define alias for number of pages
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',14);




$incident_id = $_GET["id"];
$date = $_GET["date"];
$time = $_GET["time"];
$device = $_GET["device"];
$ip_address = $_GET["ip"];
$description = $_GET['desc'];
$status = $_GET['status'];

$pdf->Cell(0, 10, 'Incident Id: '   . $incident_id, 0, 1);
$pdf->Cell(0, 10, 'Date: '   . $date, 0, 1);
$pdf->Cell(0, 10, 'Time: '   . $time, 0, 1);
$pdf->Cell(0, 10, 'Device: '   . $device, 0, 1);
$pdf->Cell(0, 10, 'IP Address: '   . $ip_address, 0, 1);
$pdf->Cell(0, 10, 'Description: '   . $description, 0, 1);
$pdf->Cell(0, 10, 'Status: '   . $status, 0, 1);
$pdf->Output();

?>
