<?php
require_once __DIR__ . '/../models/AdminDashboard.php';
require_once __DIR__ . '/../../libraries/TCPDF/tcpdf.php';

class Report extends Controller{
    public function userStatics(){
        $newStat = new AdminDashboard();
        $data = $newStat->getRoleCounts();
    
        $pdf = new TCPDF();
    
        $pdf->SetCreator('Admin');
        $pdf->SetAuthor('Admin');
        $pdf->SetTitle('User Report');
        $pdf->SetSubject('User Report');
        $pdf->SetKeywords('TCPDF, PDF, report');
    
        $pdf->AddPage();
    
        $pdf->Image('./assets/img/person.png', 10, 10, 30, '', 'PNG');
    
        $pdf->SetFont('times', 'B', 16);
        $pdf->Cell(0, 10, 'Registered Users of the system', 0, 1, 'C');
        $pdf->Ln(10); 
    
        $tableWidth = 100;
        $pageWidth = $pdf->GetPageWidth();
        $x = ($pageWidth - $tableWidth) / 2;
    
        $pdf->SetFont('times', 'B', 12);
        $pdf->SetXY($x, $pdf->GetY());
        $pdf->Cell(50, 10, 'Role', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Count', 1, 1, 'C');
    
        $pdf->SetFont('times', '', 12);
        foreach ($data as $role => $count) {
            $pdf->SetX($x);
            $pdf->Cell(50, 10, $role, 1, 0, 'C');
            $pdf->Cell(50, 10, $count, 1, 1, 'C');
        }

        $x = $pdf->GetX();
        $y = $pdf->GetY();

        $pdf->SetFont('times', '', 10);

        $pdf->SetXY($x, $y + 10); 
        $pdf->Cell(20, 10, 'Date:');

        // Add current date
        $pdf->SetXY($x + 20, $y + 10); 
        $pdf->Cell(0, 10, date('Y-m-d'));

        // Add label for signature
        $pdf->SetXY($x + 120, $y + 10);
        $pdf->Cell(20, 10, 'Signature:');

        // Add dashed line for signature
        $pdf->SetXY($x + 140, $y + 10);
        $pdf->Cell(0, 10, str_repeat('-', 30));
    
        $pdf->Output('user_report.pdf', 'I');
    }

    public function userStaticsDownload(){
        $newStat = new AdminDashboard();
        $data = $newStat->getRoleCounts();

        $pdf = new TCPDF();

        $pdf->SetCreator('Admin');
        $pdf->SetAuthor('Admin');
        $pdf->SetTitle('User Report');
        $pdf->SetSubject('User Report');
        $pdf->SetKeywords('TCPDF, PDF, report');

        $pdf->AddPage();

        $pdf->Image('./assets/img/person.png', 10, 10, 30, '', 'PNG');

        $pdf->SetFont('times', 'B', 16);
        $pdf->Cell(0, 10, 'Registered Users of the system', 0, 1, 'C');
        $pdf->Ln(10); 

        $tableWidth = 100;
        $pageWidth = $pdf->GetPageWidth();
        $x = ($pageWidth - $tableWidth) / 2;

        $pdf->SetFont('times', 'B', 12);
        $pdf->SetXY($x, $pdf->GetY());
        $pdf->Cell(50, 10, 'Role', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Count', 1, 1, 'C');

        $pdf->SetFont('times', '', 12);
        foreach ($data as $role => $count) {
            $pdf->SetX($x);
            $pdf->Cell(50, 10, $role, 1, 0, 'C');
            $pdf->Cell(50, 10, $count, 1, 1, 'C');
        }

        $x = $pdf->GetX();
        $y = $pdf->GetY();

        $pdf->SetFont('times', '', 10);

        $pdf->SetXY($x, $y + 10); 
        $pdf->Cell(20, 10, 'Date:');

        // Add current date
        $pdf->SetXY($x + 20, $y + 10); 
        $pdf->Cell(0, 10, date('Y-m-d'));

        // Add label for signature
        $pdf->SetXY($x + 120, $y + 10);
        $pdf->Cell(20, 10, 'Signature:');

        // Add dashed line for signature
        $pdf->SetXY($x + 140, $y + 10);
        $pdf->Cell(0, 10, str_repeat('-', 30));

        $pdf->Output('user_report.pdf', 'D');
    }
}


?>