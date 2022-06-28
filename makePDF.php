<?php
  
ob_end_clean();
require('fpdf/fpdf.php');


class PDF extends FPDF {

  // Page header
  function Header() {
    
    // // Add logo to page
    // $this->Image('gfg1.png',10,8,33);
    
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

// for($i = 1; $i <= 30; $i++)
//   $pdf->Cell(0, 10, 'line number '
//       . $i, 0, 1);
$i = "trap";
$pdf->Cell(0, 10, 'line number '   . $i, 0, 1);
$pdf->Cell(0, 10, 'line number '   . $i, 0, 1);
$pdf->Cell(0, 10, 'line number '   . $i, 0, 1);
$pdf->Output();

?>
