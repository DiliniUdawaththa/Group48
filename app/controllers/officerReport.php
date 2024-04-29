<?php
require_once __DIR__ . '/../models/AdminDashboard.php';
require_once __DIR__ . '/../../libraries/TCPDF/tcpdf.php';

class OfficerReport extends Controller {
    public function complaintReport1($cmt_id) {
        $newReport = new Complaint();
        // $newreport1 = new complainView($cmt_id);

        $pdf = new TCPDF();

        $pdf->SetCreator('Admin');
        $pdf->SetAuthor('Admin');
        $pdf->SetTitle('User Report');
        $pdf->SetSubject('User Report');
        $pdf->SetKeywords('TCPDF, PDF, report');

        
    }

    public function complaintReport($cmt_id){
        $complaint = new Complaint();
        $user = new User();

        $data = [
            'cmt_id' => $cmt_id
        ];
        $rows = $complaint->where($data);
        $row = (object) $rows[0];

        $customer = $row->passenger_id;
        $data1 = [
            'id' => $customer
        ];
        $rows1 = $user->where($data1);
        $row1 = null;
        if (is_array($rows1) && count($rows1) > 0) {
            $row1 = (object) $rows1[0];
        }

        $driver = $row->driver_id;
        $data2 = [
            'id' => $driver
        ];
        $rows2 = $user->where($data2);
        $row2 = null;
        if (is_array($rows2) && count($rows2) > 0) {
            $row2 = (object) $rows2[0];
        }

        $data = [
            'title' => "complaint",
            'row' => $row,
            'row1' => $row1,
            'row2' => $row2,
        ];
        
        $complaint_id = $row->cmt_id;
        $customer_name = $row1->name;
        $driver_name = $row2->name;
        $complainant = $row->complainant;
        $complaint = $row->complaint;
        
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator('Officer');
        $pdf->SetAuthor('Officer');
        $pdf->SetTitle('Complaint Report');
        $pdf->SetSubject('Complaint Report');
        $pdf->SetKeywords('TCPDF, PDF, report');

        $pdf->AddPage();
        
        $pdf->SetTextColor(255, 0, 0);
        $pdf->SetFont('times', 'B', 18);
        $pdf->Cell(0, 10, 'FAREFLEX TAXI BOOKING SYSTEM', 0, 1, 'C');
        $pdf->Ln(5);

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('times', 'B', 14);
        $pdf->Cell(0, 10, 'Details of the Driver', 0, 1, 'C');
        $pdf->Ln(5);

        $w = array(45, 45, 45,45);
        $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('helvetica', 'B', 14);
    $pdf->Cell(0, 10, 'Complaint Details', 0, 1, 'C');
    $pdf->Ln(5);

    $pdf->SetFont('helvetica', '', 12);
    $pdf->MultiCell(0, 10, "Complaint ID: $complaint_id");
    $pdf->MultiCell(0, 10, "Customer Name: $customer_name");
    $pdf->MultiCell(0, 10, "Driver Name: $driver_name");
    $pdf->MultiCell(0, 10, "Complainant: $complainant");
    $pdf->MultiCell(0, 10, "Complaint: $complaint");

    $pdf->Ln(30);

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

    $footerLineY = $pdf->getPageHeight() - 20;

    // Set the footer content and position
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $pdf->setFooterMargin(PDF_MARGIN_FOOTER);
    // $pdf->setFooterData('', 0, $footerNote);

    // Set the footer line
    $pdf->Line(15, $footerLineY, $pdf->getPageWidth() - 15, $footerLineY);
    $pdf->Output('complaint_report.pdf', 'I');
        
    }
}
?>