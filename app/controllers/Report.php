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

        $pdf->SetTextColor(255, 0, 0);
        $pdf->SetFont('times', 'B', 18);
        $pdf->Cell(0, 10, 'FAREFLEX TAXI BOOKING SYSTEM', 0, 1, 'C');
        $pdf->Ln(5);
    
        $pdf->SetTextColor(0, 0, 0);
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

        $footerLineY = $pdf->getPageHeight() - 20;

        // Set the footer content and position
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->setFooterMargin(PDF_MARGIN_FOOTER);
        // $pdf->setFooterData('', 0, $footerNote);
        // $pdf->setFooterData('', 0, $footerNote);

        // Set the footer line
        $pdf->Line(15, $footerLineY, $pdf->getPageWidth() - 15, $footerLineY);
    
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

        $pdf->SetTextColor(255, 0, 0);
        $pdf->SetFont('times', 'B', 18);
        $pdf->Cell(0, 10, 'FAREFLEX TAXI BOOKING SYSTEM', 0, 1, 'C');
        $pdf->Ln(5);

        $pdf->SetTextColor(0, 0, 0);
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

        $footerLineY = $pdf->getPageHeight() - 20;

        // Set the footer content and position
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->setFooterMargin(PDF_MARGIN_FOOTER);
        // $pdf->setFooterData('', 0, $footerNote);
        // $pdf->setFooterData('', 0, $footerNote);

        // Set the footer line
        $pdf->Line(15, $footerLineY, $pdf->getPageWidth() - 15, $footerLineY);

        $pdf->Output('user_report.pdf', 'D');
    }

    public function rideReportForm(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if (isset($_POST["selectField"]) && !empty($_POST["selectField"])) {
                $reportType = $_POST["selectField"];

                if ($reportType === "option1") {
                    if (isset($_POST["field1Input"]) && !empty($_POST["field1Input"])) {
                        $selectedDate = $_POST["field1Input"];
                        
                        $day = new AdminRide();
                        $result = $day->searchRides($selectedDate);
                        $rows = json_decode(json_encode($result), true);
                        $rideCount = $day->countRideByDate($selectedDate);
                        $dayCount = $day->dayRideCount($selectedDate);
                        $nightCount = $day->nightRideCount($selectedDate);


                        if (!empty($rows)) {
                            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    
                            $pdf->SetCreator('Admin');
                            $pdf->SetAuthor('Admin');
                            $pdf->SetTitle('Ride Report for ' . $selectedDate);
                            $pdf->SetSubject('Ride Report');
                            $pdf->SetKeywords('TCPDF, PDF, report');
    
                            $pdf->AddPage();

                            $pdf->SetTextColor(255, 0, 0);
                            $pdf->SetFont('times', 'B', 18);
                            $pdf->Cell(0, 10, 'FAREFLEX TAXI BOOKING SYSTEM', 0, 1, 'C');
                            $pdf->Ln(5);

                            $pdf->SetTextColor(0, 0, 0);
                            $pdf->SetFont('helvetica', 'B', 12);
                            $pdf->Cell(0, 10, 'Ride Report for ' . $selectedDate, 0, 1, 'C');
                            $pdf->Ln(5);

                            $pdf->Cell(50, 10, 'Total Rides', 1, 0, 'C');
                            $pdf->Cell(50, 10, $rideCount, 1, 1, 'C');
                            $pdf->Ln(5);

                            $pdf->Cell(50, 10, 'Day Rides', 1, 0, 'C');
                            $pdf->Cell(50, 10, $dayCount, 1, 1, 'C');
                            $pdf->Ln(5);

                            $pdf->Cell(50, 10, 'Night Rides', 1, 0, 'C');
                            $pdf->Cell(50, 10, $nightCount, 1, 1, 'C');
                            $pdf->Ln(5);

                            $content = ''; 
                            $content .= '<style>';
                            $content .= 'table { width: 100%; border-collapse: collapse; }';
                            $content .= 'th { background-color: #f2f2f2; text-align: center; }'; 
                            $content .= 'td { padding: 8px; border: none; text-align: center; }'; 
                            $content .= '</style>';
                            $content .= '<table>';
                            $content .= '<tr><th>Ride ID</th><th>Customer ID</th><th>Driver ID</th><th>Taxi Type</th><th>Time</th><th>Fare</th><th>State</th></tr>';
    
                            foreach ($rows as $row) {
                                $content .= '<tr>';
                                $content .= '<td>' . $row['id'] . '</td>'; 
                                $content .= '<td>' . $row['passenger_id'] . '</td>';
                                $content .= '<td>' . $row['driver_id'] . '</td>';
                                $content .= '<td>' . $row['vehicle'] . '</td>';
                                $content .= '<td>' . date('H:i', strtotime($row['date'])) . '</td>';
                                $content .= '<td>' . $row['fare'] . '</td>';
                                $content .= '<td>' . $row['state'] . '</td>'; 
                                $content .= '</tr>';
                            }
    
                            $content .= '</table>';

                            $pdf->writeHTML($content, true, false, true, false, '');

                            // $x = $pdf->GetX();
                            // $y = $pdf->GetY();

                            // $pdf->SetFont('times', '', 10);

                            // $pdf->SetXY($x, $y + 10); 
                            // $pdf->Cell(20, 10, 'Date:');

                            // // Add current date
                            // $pdf->SetXY($x + 20, $y + 10); 
                            // $pdf->Cell(0, 10, date('Y-m-d'));

                            // // Add label for signature
                            // $pdf->SetXY($x + 120, $y + 10);
                            // $pdf->Cell(20, 10, 'Signature:');

                            // // Add dashed line for signature
                            // $pdf->SetXY($x + 140, $y + 10);
                            // $pdf->Cell(0, 10, str_repeat('-', 30));

                            // $pdf->Ln(30);
    
                            // Output PDF
                            $pdf->Output('ride_report.pdf', 'I');
                        } else {
                            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

                            $pdf->AddPage();
    
                            $pdf->SetCreator('Admin');
                            $pdf->SetAuthor('Admin');
                            $pdf->SetTitle('Ride Report for ' . $selectedDate);
                            $pdf->SetSubject('Ride Report');
                            $pdf->SetKeywords('TCPDF, PDF, report');

                            $pdf->SetTextColor(255, 0, 0);
                            $pdf->SetFont('times', 'B', 18);
                            $pdf->Cell(0, 10, 'FAREFLEX TAXI BOOKING SYSTEM', 0, 1, 'C');
                            $pdf->Ln(5);

                            $pdf->SetTextColor(0, 0, 0);
                            $pdf->SetFont('helvetica', 'B', 12);
                            $pdf->Cell(0, 10, 'Ride Report for ' . $selectedDate, 0, 1, 'C');
                            $pdf->Ln(5);
    
                            $pdf->SetTextColor(0, 0, 0);
                            $pdf->SetFont('helvetica', '', 12);
                            $pdf->Cell(0, 10, 'No records found', 0, 1, 'C');

                            $footerLineY = $pdf->getPageHeight() - 20;

                            // Set the footer content and position
                            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                            $pdf->setFooterMargin(PDF_MARGIN_FOOTER);
                            // $pdf->setFooterData('', 0, $footerNote);
                            // $pdf->setFooterData('', 0, $footerNote);

                            // Set the footer line
                            $pdf->Line(15, $footerLineY, $pdf->getPageWidth() - 15, $footerLineY);

                            $pdf->Output('ride_report.pdf', 'I');
                        }

                    } else {
                        echo "Error: Please select a date for Day Report.";
                    }
                }elseif ($reportType === "option2") {
                    if (isset($_POST["field2Input"]) && isset($_POST["field3Input"]) &&
                        !empty($_POST["field2Input"]) && !empty($_POST["field3Input"])) {
                        $startDate = $_POST["field2Input"];
                        $endDate = $_POST["field3Input"];

                        $day = new AdminRide();
                        $result = $day->searchRidesForRange($startDate,$endDate);
                        $rows = json_decode(json_encode($result), true);
                        $rideCount = $day->countRidesByDate($startDate,$endDate);
                        $dayCount = $day->dayRidesCount($startDate,$endDate);
                        $nightCount = $day->nightRidesCount($startDate,$endDate);


                        if (!empty($rows)) {
                            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    
                            $pdf->SetCreator('Admin');
                            $pdf->SetAuthor('Admin');
                            $pdf->SetTitle('Ride Report for ' . $startDate . ' - ' . $endDate);
                            $pdf->SetSubject('Ride Report');
                            $pdf->SetKeywords('TCPDF, PDF, report');
    
                            $pdf->AddPage();

                            $pdf->SetTextColor(255, 0, 0);
                            $pdf->SetFont('times', 'B', 18);
                            $pdf->Cell(0, 10, 'FAREFLEX TAXI BOOKING SYSTEM', 0, 1, 'C');
                            $pdf->Ln(5);

                            $pdf->SetTextColor(0, 0, 0);
                            $pdf->SetFont('helvetica', 'B', 12);
                            $pdf->Cell(0, 10, 'Ride Report for ' . $startDate . ' - ' . $endDate , 0, 1, 'C');
                            $pdf->Ln(5);

                            $pdf->Cell(50, 10, 'Total Rides', 1, 0, 'C');
                            $pdf->Cell(50, 10, $rideCount, 1, 1, 'C');
                            $pdf->Ln(5);

                            $pdf->Cell(50, 10, 'Day Rides', 1, 0, 'C');
                            $pdf->Cell(50, 10, $dayCount, 1, 1, 'C');
                            $pdf->Ln(5);

                            $pdf->Cell(50, 10, 'Night Rides', 1, 0, 'C');
                            $pdf->Cell(50, 10, $nightCount, 1, 1, 'C');
                            $pdf->Ln(5);

                            // Set some content to display in the PDF
                            $content = ''; 
                            $content .= '<style>';
                            $content .= 'table { width: 100%; border-collapse: collapse; }'; 
                            $content .= 'th { background-color: #f2f2f2; text-align: center; }'; 
                            $content .= 'td { padding: 8px; border: none; text-align: center; }';
                            $content .= '</style>';
                            $content .= '<table>';
                            $content .= '<tr><th>Ride ID</th><th>Customer ID</th><th>Driver ID</th><th>Taxi Type</th><th>Time</th><th>Fare</th><th>State</th></tr>';
    
                            foreach ($rows as $row) {
                                $content .= '<tr>';
                                $content .= '<td>' . $row['id'] . '</td>';
                                $content .= '<td>' . $row['passenger_id'] . '</td>';
                                $content .= '<td>' . $row['driver_id'] . '</td>';
                                $content .= '<td>' . $row['vehicle'] . '</td>';
                                $content .= '<td>' . date('H:i', strtotime($row['date'])) . '</td>';
                                $content .= '<td>' . $row['fare'] . '</td>';
                                $content .= '<td>' . $row['state'] . '</td>'; 
                                $content .= '</tr>';
                            }
    
                            $content .= '</table>';

                            $pdf->writeHTML($content, true, false, true, false, '');

                            // $x = $pdf->GetX();
                            // $y = $pdf->GetY();

                            // $pdf->SetFont('times', '', 10);

                            // $pdf->SetXY($x, $y + 10); 
                            // $pdf->Cell(20, 10, 'Date:');

                            // // Add current date
                            // $pdf->SetXY($x + 20, $y + 10); 
                            // $pdf->Cell(0, 10, date('Y-m-d'));

                            // // Add label for signature
                            // $pdf->SetXY($x + 120, $y + 10);
                            // $pdf->Cell(20, 10, 'Signature:');

                            // // Add dashed line for signature
                            // $pdf->SetXY($x + 140, $y + 10);
                            // $pdf->Cell(0, 10, str_repeat('-', 30));

                            // $pdf->Ln(30);

                            $footerLineY = $pdf->getPageHeight() - 20;

                        // Set the footer content and position
                            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                            $pdf->setFooterMargin(PDF_MARGIN_FOOTER);
                            // $pdf->setFooterData('', 0, $footerNote);
                            // $pdf->setFooterData('', 0, $footerNote);

                            // Set the footer line
                            $pdf->Line(15, $footerLineY, $pdf->getPageWidth() - 15, $footerLineY);
    
                            // Output PDF
                            $pdf->Output('ride_report.pdf', 'I');
                        } else {
                            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

                            $pdf->AddPage();
    
                            $pdf->SetCreator('Admin');
                            $pdf->SetAuthor('Admin');
                            $pdf->SetTitle('Ride Report for ' . $startDate . ' - ' . $endDate);
                            $pdf->SetSubject('Ride Report');
                            $pdf->SetKeywords('TCPDF, PDF, report');

                            $pdf->SetTextColor(255, 0, 0);
                            $pdf->SetFont('times', 'B', 18);
                            $pdf->Cell(0, 10, 'FAREFLEX TAXI BOOKING SYSTEM', 0, 1, 'C');
                            $pdf->Ln(5);

                            $pdf->SetTextColor(0, 0, 0);
                            $pdf->SetFont('helvetica', 'B', 12);
                            $pdf->Cell(0, 10, 'Ride Report for ' . $startDate . ' - ' . $endDate , 0, 1, 'C');
                            $pdf->Ln(5);
    
                            $pdf->SetTextColor(0, 0, 0);
                            $pdf->SetFont('helvetica', '', 12);
                            $pdf->Cell(0, 10, 'No records found', 0, 1, 'C');

                            $footerLineY = $pdf->getPageHeight() - 20;

                            // Set the footer content and position
                            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                            $pdf->setFooterMargin(PDF_MARGIN_FOOTER);
                            // $pdf->setFooterData('', 0, $footerNote);
                            // $pdf->setFooterData('', 0, $footerNote);

                            // Set the footer line
                            $pdf->Line(15, $footerLineY, $pdf->getPageWidth() - 15, $footerLineY);

                            $pdf->Output('ride_report.pdf', 'I');
                        }

                    } else {
                        echo "Error: Please select start and end dates for Week/month/year Report.";
                    }
                } 
            }else {
                echo "Error: Report type is required.";
            }
        }
    }

    public function customerReport(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if (isset($_POST["selectField"]) && !empty($_POST["selectField"])) {
                $reportType = $_POST["selectField"];

                if ($reportType === "option1") {
                    $customer = new AdminRide();
                    $result = $customer->customers();
                    $rows = json_decode(json_encode($result), true);
                    $userCounts = $customer->customerByYear();
                    $currentYear = date('Y');
                    $lastYear = $currentYear - 1;
                    $growth = $userCounts[$currentYear] * 100;
                    if($userCounts[$lastYear] != 0){
                        $growth = ($userCounts[$currentYear] - $userCounts[$lastYear])/$userCounts[$lastYear] * 100;
                    }

                    if (!empty($rows)) {
                        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

                        $pdf->SetCreator('Admin');
                        $pdf->SetAuthor('Admin');
                        $pdf->SetTitle('Customer report');
                        $pdf->SetSubject('Customer Report');
                        $pdf->SetKeywords('TCPDF, PDF, report');

                        $pdf->AddPage();

                        $pdf->SetTextColor(255, 0, 0);
                        $pdf->SetFont('times', 'B', 18);
                        $pdf->Cell(0, 10, 'FAREFLEX TAXI BOOKING SYSTEM', 0, 1, 'C');
                        $pdf->Ln(5);

                        $w = array(45, 45, 45,45);
                        // Header
                        $header = array('Customer ID','Name', 'Email', 'Phone');
                        $header1 = array(date('Y') - 1, date('Y'), 'Growth(%)');

                        $pdf->SetTextColor(0, 0, 0);
                        $pdf->SetFont('times', 'B', 14);
                        $pdf->Cell(0, 10, 'Customer count by year', 0, 1, 'C');
                        $pdf->Ln(5);

                        $pdf->SetX(40);
                        $pdf->SetFont('helvetica', '', 10);
                        $pdf->SetFillColor(220, 220, 220);
                        $pdf->SetTextColor(0);
                        $pdf->SetDrawColor(255, 255, 255);
                        $pdf->SetLineWidth(0.3);
                        $pdf->SetFont('', 'B');
                        $pdf->SetFillColor(240, 240, 240);
                        $pdf->SetTextColor(0);
                        $pdf->Cell($w[0], 10, $header1[0], 1, 0, 'C', 1);
                        $pdf->Cell($w[1], 10, $header1[1], 1, 0, 'C', 1);
                        $pdf->Cell($w[2], 10, $header1[2], 1, 1, 'C', 1);
                        $pdf->SetFont('');
                        $pdf->SetFillColor(255);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('');
                        $fill = false;
                        $pdf->SetX(40);
                        $pdf->Cell($w[0], 10, $userCounts[date('Y') - 1], 'LR', 0, 'C', $fill);
                        $pdf->Cell($w[1], 10, $userCounts[date('Y')], 'LR', 0, 'C', $fill);
                        $pdf->Cell($w[2], 10, $growth, 'LR', 0, 'C', $fill);
                        $pdf->Ln(15);

                        $pdf->SetTextColor(0, 0, 0);
                        $pdf->SetFont('times', 'B', 14);
                        $pdf->Cell(0, 10, 'Customer registered within this year', 0, 1, 'C');
                        $pdf->Ln(5);

                        // Output table
                        $pdf->SetX(15);
                        $pdf->SetFont('helvetica', '', 10);
                        $pdf->SetFillColor(220, 220, 220);
                        $pdf->SetTextColor(0);
                        $pdf->SetDrawColor(255, 255, 255);
                        $pdf->SetLineWidth(0.3);
                        $pdf->SetFont('', 'B');
                        $pdf->SetFillColor(240, 240, 240);
                        $pdf->SetTextColor(0);
                        $pdf->Cell($w[0], 10, $header[0], 1, 0, 'C', 1);
                        $pdf->Cell($w[1], 10, $header[1], 1, 0, 'C', 1);
                        $pdf->Cell($w[2], 10, $header[2], 1, 0, 'C', 1);
                        $pdf->Cell($w[3], 10, $header[3], 1, 1, 'C', 1);
                        $pdf->SetFont('');
                        $pdf->SetFillColor(255);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('');
                        $fill = false;
                        $pdf->SetX(15);
                        foreach ($rows as $row) {
                            $fill = !$fill;
                            $pdf->SetX(15);
                            $pdf->Cell($w[0], 10, $row['id'], 'LR', 0, 'C', $fill);
                            $pdf->Cell($w[1], 10, $row['name'], 'LR', 0, 'C', $fill);
                            $pdf->Cell($w[2], 10, $row['email'], 'LR', 0, 'C', $fill);
                            $pdf->Cell($w[3], 10, $row['phone'], 'LR', 1, 'C', $fill);
                            $fill = !$fill;
                        }
                        $pdf->Cell(array_sum($w), 0, '', 'T');
                        $pdf->Ln(5);

                        
                        // $pdf->Ln(30);

                        // $x = $pdf->GetX();
                        // $y = $pdf->GetY();

                        // $pdf->SetFont('times', '', 10);

                        // $pdf->SetXY($x, $y + 10); 
                        // $pdf->Cell(20, 10, 'Date:');

                        //     // Add current date
                        // $pdf->SetXY($x + 20, $y + 10); 
                        // $pdf->Cell(0, 10, date('Y-m-d'));

                        //     // Add label for signature
                        // $pdf->SetXY($x + 120, $y + 10);
                        // $pdf->Cell(20, 10, 'Signature:');

                        //     // Add dashed line for signature
                        // $pdf->SetXY($x + 140, $y + 10);
                        // $pdf->Cell(0, 10, str_repeat('-', 30));

                        $footerLineY = $pdf->getPageHeight() - 20;

                        // Set the footer content and position
                        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                        $pdf->setFooterMargin(PDF_MARGIN_FOOTER);
                        // $pdf->setFooterData('', 0, $footerNote);
                        // $pdf->setFooterData('', 0, $footerNote);

                        // Set the footer line
                        $pdf->Line(15, $footerLineY, $pdf->getPageWidth() - 15, $footerLineY);
                        
                        $pdf->Output('customer_report.pdf', 'I');

                    }else{
                        echo "Error: No customers found for the selected year.";
                    }
                }else if ($reportType === "option2"){
                    if (isset($_POST["field1Input"]) && !empty($_POST["field1Input"])){
                        $custID = $_POST["field1Input"];
                        $customer = new AdminRide();
                        $result = $customer->searchCustomer($custID);
                        $rows = json_decode(json_encode($result), true);
                        $totalCount = $customer->countRideByCustomer($custID);
                        $rejectCount = $customer->rideCountOfCustomer($custID);
                        $successCount = $totalCount - $rejectCount;    
                        $reject = 0;
                        if ($totalCount != 0) {
                            $reject = $rejectCount / $totalCount * 100;
                        }

                        if (!empty($rows)) {
                            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

                            $pdf->SetCreator('Admin');
                            $pdf->SetAuthor('Admin');
                            $pdf->SetTitle('Customer report');
                            $pdf->SetSubject('Customer Report');
                            $pdf->SetKeywords('TCPDF, PDF, report');

                            $pdf->AddPage();

                            $pdf->SetTextColor(255, 0, 0);
                            $pdf->SetFont('times', 'B', 18);
                            $pdf->Cell(0, 10, 'FAREFLEX TAXI BOOKING SYSTEM', 0, 1, 'C');
                            $pdf->Ln(5);

                            $pdf->SetTextColor(0, 0, 0);
                            $pdf->SetFont('times', 'B', 14);
                            $pdf->Cell(0, 10, 'Details of the customer', 0, 1, 'C');
                            $pdf->Ln(5);

                            $w = array(45, 45, 45,45);
                            // Header
                            $header = array('Customer ID','Name', 'Email', 'Phone');
                            $header1 = array('Total','Succeeded', 'Rejected', 'Reject Percentage');

                            $pdf->SetX(15);
                            $pdf->SetFont('helvetica', '', 10);
                            $pdf->SetFillColor(220, 220, 220);
                            $pdf->SetTextColor(0);
                            $pdf->SetDrawColor(255, 255, 255);
                            $pdf->SetLineWidth(0.3);
                            $pdf->SetFont('', 'B');
                            $pdf->SetFillColor(240, 240, 240);
                            $pdf->SetTextColor(0);
                            $pdf->Cell($w[0], 10, $header[0], 1, 0, 'C', 1);
                            $pdf->Cell($w[1], 10, $header[1], 1, 0, 'C', 1);
                            $pdf->Cell($w[2], 10, $header[2], 1, 0, 'C', 1);
                            $pdf->Cell($w[3], 10, $header[3], 1, 1, 'C', 1);
                            $pdf->SetFont('');
                            $pdf->SetFillColor(255);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('');
                            $fill = false;
                            $pdf->SetX(15);
                            foreach ($rows as $row) {
                                $fill = !$fill;
                                $pdf->SetX(15);
                                $pdf->Cell($w[0], 10, $row['id'], 'LR', 0, 'C', $fill);
                                $pdf->Cell($w[1], 10, $row['name'], 'LR', 0, 'C', $fill);
                                $pdf->Cell($w[2], 10, $row['email'], 'LR', 0, 'C', $fill);
                                $pdf->Cell($w[3], 10, $row['phone'], 'LR', 1, 'C', $fill);
                                $fill = !$fill;
                            }
                            $pdf->Ln(5);

                            $pdf->SetTextColor(0, 0, 0);
                            $pdf->SetFont('times', 'B', 14);
                            $pdf->Cell(0, 10, 'Ride bookings', 0, 1, 'C');
                            $pdf->Ln(5);

                            $pdf->SetX(15);
                            $pdf->SetFont('helvetica', '', 10);
                            $pdf->SetFillColor(220, 220, 220);
                            $pdf->SetTextColor(0);
                            $pdf->SetDrawColor(255, 255, 255);
                            $pdf->SetLineWidth(0.3);
                            $pdf->SetFont('', 'B');
                            $pdf->SetFillColor(240, 240, 240);
                            $pdf->SetTextColor(0);
                            $pdf->Cell($w[0], 10, $header1[0], 1, 0, 'C', 1);
                            $pdf->Cell($w[1], 10, $header1[1], 1, 0, 'C', 1);
                            $pdf->Cell($w[2], 10, $header1[2], 1, 0, 'C', 1);
                            $pdf->Cell($w[3], 10, $header1[3], 1, 1, 'C', 1);
                            $pdf->SetFont('');
                            $pdf->SetFillColor(255);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('');
                            $fill = false;

                            $pdf->SetX(15);
                            $pdf->Cell($w[0], 10, $totalCount, 'LR', 0, 'C', $fill);
                            $pdf->Cell($w[1], 10, $successCount, 'LR', 0, 'C', $fill);
                            $pdf->Cell($w[2], 10, $rejectCount, 'LR', 0, 'C', $fill);
                            $pdf->Cell($w[3], 10, $reject, 'LR', 0, 'C', $fill);
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
                            // $pdf->setFooterData('', 0, $footerNote);

                            // Set the footer line
                            $pdf->Line(15, $footerLineY, $pdf->getPageWidth() - 15, $footerLineY);

                            $pdf->Output('customer_report.pdf', 'I');

                        }else{
                            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

                            $pdf->AddPage();
    
                            $pdf->SetCreator('Admin');
                            $pdf->SetAuthor('Admin');
                            $pdf->SetTitle('Customer Report');
                            $pdf->SetSubject('Customer Report');
                            $pdf->SetKeywords('TCPDF, PDF, report');

                            $pdf->SetTextColor(255, 0, 0);
                            $pdf->SetFont('times', 'B', 18);
                            $pdf->Cell(0, 10, 'FAREFLEX TAXI BOOKING SYSTEM', 0, 1, 'C');
                            $pdf->Ln(5);
    
                            $pdf->SetTextColor(0, 0, 0);
                            $pdf->SetFont('helvetica', '', 12);
                            $pdf->Cell(0, 10, 'No records found for Customer ID' .$custID , 0, 1, 'C');

                            $footerLineY = $pdf->getPageHeight() - 20;

                            // Set the footer content and position
                            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                            $pdf->setFooterMargin(PDF_MARGIN_FOOTER);
                            // $pdf->setFooterData('', 0, $footerNote);
                            // $pdf->setFooterData('', 0, $footerNote);

                            // Set the footer line
                            $pdf->Line(15, $footerLineY, $pdf->getPageWidth() - 15, $footerLineY);

                            $pdf->Output('ride_report.pdf', 'I');
                        }

                    }
                }else{
                    echo "Error: Select an option.";
                }
            }else{
                echo "Error: Select an option.";
            }
        }
    }

    public function driverReport(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if (isset($_POST["selectField"]) && !empty($_POST["selectField"])) {
                $reportType = $_POST["selectField"];

                if ($reportType === "option1") {
                    $driver = new AdminRide();
                    $driver1 = new AdminDashboard();
                    $result = $driver->drivers();
                    $rows = json_decode(json_encode($result), true);
                    $userCounts = $driver->driverByYear();
                    $currentYear = date('Y');
                    $lastYear = $currentYear - 1;
                    $growth = $userCounts[$currentYear] * 100;
                    if($userCounts[$lastYear] != 0){
                        $growth = ($userCounts[$currentYear] - $userCounts[$lastYear])/$userCounts[$lastYear] * 100;
                    }
                    $total_driver = $driver1->getRoleCounts();
                    $total_driver_count = $total_driver['driver'];
                    $expiredCount = $driver->expiredDriverCount();
                    $activeCount = $total_driver_count - $expiredCount;

                    // if (!empty($rows)) {
                        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

                        $pdf->SetCreator('Admin');
                        $pdf->SetAuthor('Admin');
                        $pdf->SetTitle('Driver report');
                        $pdf->SetSubject('Driver Report');
                        $pdf->SetKeywords('TCPDF, PDF, report');

                        $pdf->AddPage();

                        // $pdf->SetTextColor(255, 0, 0);
                        // $pdf->SetFont('times', 'B', 18);
                        // $pdf->Cell(0, 10, 'FAREFLEX TAXI BOOKING SYSTEM', 0, 1, 'C');
                        // $pdf->Ln(5);

                        // $w = array(45, 45, 45,45);
                        // // Header
                        // $header = array('Driver ID','Name', 'Email', 'Phone');
                        // $header1 = array(date('Y') - 1, date('Y'), 'Growth(%)');
                        // $header2 = array('Total', 'Active', 'Expired');

                        // $pdf->SetTextColor(0, 0, 0);
                        // $pdf->SetFont('times', 'B', 14);
                        // $pdf->Cell(0, 10, 'Driver Count Summary', 0, 1, 'C');
                        // $pdf->Ln(5);

                        // $pdf->SetX(40);
                        // $pdf->SetFont('helvetica', '', 10);
                        // $pdf->SetFillColor(220, 220, 220);
                        // $pdf->SetTextColor(0);
                        // $pdf->SetDrawColor(255, 255, 255);
                        // $pdf->SetLineWidth(0.3);
                        // $pdf->SetFont('', 'B');
                        // $pdf->SetFillColor(240, 240, 240);
                        // $pdf->SetTextColor(0);
                        // $pdf->Cell($w[0], 10, $header2[0], 1, 0, 'C', 1);
                        // $pdf->Cell($w[1], 10, $header2[1], 1, 0, 'C', 1);
                        // $pdf->Cell($w[2], 10, $header2[2], 1, 1, 'C', 1);
                        // $pdf->SetFont('');
                        // $pdf->SetFillColor(255);
                        // $pdf->SetTextColor(0);
                        // $pdf->SetFont('');
                        // $fill = false;
                        // $pdf->SetX(40);
                        // $pdf->Cell($w[0], 10, $total_driver_count, 'LR', 0, 'C', $fill);
                        // $pdf->Cell($w[1], 10, $activeCount, 'LR', 0, 'C', $fill);
                        // $pdf->Cell($w[2], 10, $expiredCount, 'LR', 0, 'C', $fill);
                        // $pdf->Ln(15);

                        // $pdf->SetTextColor(0, 0, 0);
                        // $pdf->SetFont('times', 'B', 14);
                        // $pdf->Cell(0, 10, 'Driver count by year', 0, 1, 'C');
                        // $pdf->Ln(5);

                        // $pdf->SetX(40);
                        // $pdf->SetFont('helvetica', '', 10);
                        // $pdf->SetFillColor(220, 220, 220);
                        // $pdf->SetTextColor(0);
                        // $pdf->SetDrawColor(255, 255, 255);
                        // $pdf->SetLineWidth(0.3);
                        // $pdf->SetFont('', 'B');
                        // $pdf->SetFillColor(240, 240, 240);
                        // $pdf->SetTextColor(0);
                        // $pdf->Cell($w[0], 10, $header1[0], 1, 0, 'C', 1);
                        // $pdf->Cell($w[1], 10, $header1[1], 1, 0, 'C', 1);
                        // $pdf->Cell($w[2], 10, $header1[2], 1, 1, 'C', 1);
                        // $pdf->SetFont('');
                        // $pdf->SetFillColor(255);
                        // $pdf->SetTextColor(0);
                        // $pdf->SetFont('');
                        // $fill = false;
                        // $pdf->SetX(40);
                        // $pdf->Cell($w[0], 10, $userCounts[date('Y') - 1], 'LR', 0, 'C', $fill);
                        // $pdf->Cell($w[1], 10, $userCounts[date('Y')], 'LR', 0, 'C', $fill);
                        // $pdf->Cell($w[2], 10, $growth, 'LR', 0, 'C', $fill);
                        // $pdf->Ln(15);

                        // $pdf->SetTextColor(0, 0, 0);
                        // $pdf->SetFont('times', 'B', 14);
                        // $pdf->Cell(0, 10, 'Drivers registered within this year', 0, 1, 'C');
                        // $pdf->Ln(5);

                        // Output table
                        // $pdf->SetX(15);
                        // $pdf->SetFont('helvetica', '', 10);
                        // $pdf->SetFillColor(220, 220, 220);
                        // $pdf->SetTextColor(0);
                        // $pdf->SetDrawColor(255, 255, 255);
                        // $pdf->SetLineWidth(0.3);
                        // $pdf->SetFont('', 'B');
                        // $pdf->SetFillColor(240, 240, 240);
                        // $pdf->SetTextColor(0);
                        // $pdf->Cell($w[0], 10, $header[0], 1, 0, 'C', 1);
                        // $pdf->Cell($w[1], 10, $header[1], 1, 0, 'C', 1);
                        // $pdf->Cell($w[2], 10, $header[2], 1, 0, 'C', 1);
                        // $pdf->Cell($w[3], 10, $header[3], 1, 1, 'C', 1);
                        // $pdf->SetFont('');
                        // $pdf->SetFillColor(255);
                        // $pdf->SetTextColor(0);
                        // $pdf->SetFont('');
                        // $fill = false;
                        // $pdf->SetX(15);
                        // foreach ($rows as $row) {
                        //     $fill = !$fill;
                        //     $pdf->SetX(15);
                        //     $pdf->Cell($w[0], 10, $row['id'], 'LR', 0, 'C', $fill);
                        //     $pdf->Cell($w[1], 10, $row['name'], 'LR', 0, 'C', $fill);
                        //     $pdf->Cell($w[2], 10, $row['email'], 'LR', 0, 'C', $fill);
                        //     $pdf->Cell($w[3], 10, $row['phone'], 'LR', 1, 'C', $fill);
                        //     $fill = !$fill;
                        // }
                        // $pdf->Cell(array_sum($w), 0, '', 'T');
                        
                        // $pdf->Ln(30);

                        // $footerLineY = $pdf->getPageHeight() - 20;

                        // Set the footer content and position
                        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                        $pdf->setFooterMargin(PDF_MARGIN_FOOTER);
                        // $pdf->setFooterData('', 0, $footerNote);

                        // // Set the footer line
                        // $pdf->Line(15, $footerLineY, $pdf->getPageWidth() - 15, $footerLineY);
                        
                        $pdf->Output('driver_report.pdf', 'I');

                    // }
                    // else{
                    //     echo "Error: No customers found for the selected year.";
                    // }
                }else if ($reportType === "option2"){
                    if (isset($_POST["field1Input"]) && !empty($_POST["field1Input"])){
                        $custID = $_POST["field1Input"];
                        $customer = new AdminRide();
                        $result = $customer->searchCustomer($custID);
                        $rows = json_decode(json_encode($result), true);
                        $rideCount = $customer->countRideByDriver($custID);

                        if (!empty($rows)) {
                            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

                            $pdf->SetCreator('Admin');
                            $pdf->SetAuthor('Admin');
                            $pdf->SetTitle('Customer report');
                            $pdf->SetSubject('Customer Report');
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
                            // Header
                            $header = array('Customer ID','Name', 'Email', 'Phone');
                            $header1 = array('Registration Date', 'Expire Date', 'Total Rides');

                            $pdf->SetX(15);
                            $pdf->SetFont('helvetica', '', 10);
                            $pdf->SetFillColor(220, 220, 220);
                            $pdf->SetTextColor(0);
                            $pdf->SetDrawColor(255, 255, 255);
                            $pdf->SetLineWidth(0.3);
                            $pdf->SetFont('', 'B');
                            $pdf->SetFillColor(240, 240, 240);
                            $pdf->SetTextColor(0);
                            $pdf->Cell($w[0], 10, $header[0], 1, 0, 'C', 1);
                            $pdf->Cell($w[1], 10, $header[1], 1, 0, 'C', 1);
                            $pdf->Cell($w[2], 10, $header[2], 1, 0, 'C', 1);
                            $pdf->Cell($w[3], 10, $header[3], 1, 1, 'C', 1);
                            $pdf->SetFont('');
                            $pdf->SetFillColor(255);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('');
                            $fill = false;
                            $pdf->SetX(15);
                            foreach ($rows as $row) {
                                $fill = !$fill;
                                $pdf->SetX(15);
                                $pdf->Cell($w[0], 10, $row['id'], 'LR', 0, 'C', $fill);
                                $pdf->Cell($w[1], 10, $row['name'], 'LR', 0, 'C', $fill);
                                $pdf->Cell($w[2], 10, $row['email'], 'LR', 0, 'C', $fill);
                                $pdf->Cell($w[3], 10, $row['phone'], 'LR', 1, 'C', $fill);
                                $fill = !$fill;
                            }
                            $pdf->Ln(5);

                            $pdf->SetTextColor(0, 0, 0);
                            $pdf->SetFont('times', 'B', 14);
                            $pdf->Cell(0, 10, 'Other Details', 0, 1, 'C');
                            $pdf->Ln(5);

                            $pdf->SetX(40);
                            $pdf->SetFont('helvetica', '', 10);
                            $pdf->SetFillColor(220, 220, 220);
                            $pdf->SetTextColor(0);
                            $pdf->SetDrawColor(255, 255, 255);
                            $pdf->SetLineWidth(0.3);
                            $pdf->SetFont('', 'B');
                            $pdf->SetFillColor(240, 240, 240);
                            $pdf->SetTextColor(0);
                            $pdf->Cell($w[0], 10, $header1[0], 1, 0, 'C', 1);
                            $pdf->Cell($w[1], 10, $header1[1], 1, 0, 'C', 1);
                            $pdf->Cell($w[2], 10, $header1[2], 1, 1, 'C', 1);
                            $pdf->SetFont('');
                            $pdf->SetFillColor(255);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('');
                            $fill = false;

                            foreach ($rows as $row) {
                                $fill = !$fill;
                                $pdf->SetX(40);
                                $pdf->Cell($w[0], 10, $row['date'], 'LR', 0, 'C', $fill);
                                $pdf->Cell($w[1], 10, date('Y-m-d', strtotime($row['date'] . ' +1 year')), 'LR', 0, 'C', $fill);
                                $pdf->Cell($w[2], 10, $rideCount, 'LR', 0, 'C', $fill);
                                $fill = !$fill;
                            }
                            
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
                            // $pdf->setFooterData('', 0, $footerNote);

                            // Set the footer line
                            $pdf->Line(15, $footerLineY, $pdf->getPageWidth() - 15, $footerLineY);

                            $pdf->Output('customer_report.pdf', 'I');

                        }else{
                            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

                            $pdf->AddPage();
    
                            $pdf->SetCreator('Admin');
                            $pdf->SetAuthor('Admin');
                            $pdf->SetTitle('Driver Report');
                            $pdf->SetSubject('Driver Report');
                            $pdf->SetKeywords('TCPDF, PDF, report');

                            $pdf->SetTextColor(255, 0, 0);
                            $pdf->SetFont('times', 'B', 18);
                            $pdf->Cell(0, 10, 'FAREFLEX TAXI BOOKING SYSTEM', 0, 1, 'C');
                            $pdf->Ln(5);
    
                            $pdf->SetTextColor(0, 0, 0);
                            $pdf->SetFont('helvetica', '', 12);
                            $pdf->Cell(0, 10, 'No records found for Driver ID' .$custID , 0, 1, 'C');

                            $footerLineY = $pdf->getPageHeight() - 20;

                            // Set the footer content and position
                            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                            $pdf->setFooterMargin(PDF_MARGIN_FOOTER);
                            // $pdf->setFooterData('', 0, $footerNote);
                            // $pdf->setFooterData('', 0, $footerNote);

                            // Set the footer line
                            $pdf->Line(15, $footerLineY, $pdf->getPageWidth() - 15, $footerLineY);

                            $pdf->Output('ride_report.pdf', 'I');
                        }

                    }
                }else{
                    echo "Error: Select an option.";
                }
            }else{
                echo "Error: Select an option.";
            }
        }
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
        $Date = $row->datetime;
        $officerCmnt = $row->officerCmnt;

        
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
        $pdf->Cell(0, 10, 'Details of Complaint: ' . $complaint_id, 0, 1, 'C');
        $pdf->Ln(15);

    

    $pdf->cell(50, 10, 'complanant', 1, 0, 'c');
    $pdf->cell(50, 10, $complainant, 1, 1, 'c');
    $pdf->Ln(15);
    $pdf->cell(50, 10, 'customer Name', 1, 0, 'c');
    $pdf->cell(50, 10, $customer_name, 1, 1, 'c');
    $pdf->Ln(15);
    $pdf->cell(50, 10, 'Driver Name', 1, 0, 'c');
    $pdf->cell(50, 10, $driver_name, 1, 1, 'c');
    $pdf->Ln(15);
    $pdf->cell(50, 10, 'Complaint', 1, 0, 'c');
    $pdf->cell(50, 10, $complaint, 1, 1, 'c');
    $pdf->Ln(15);
    $pdf->cell(50, 10, 'Complaint Date', 1, 0, 'c');
    $pdf->cell(50, 10, $Date, 1, 1, 'c');
    $pdf->Ln(15);
    $pdf->cell(50, 10, 'Officer Action', 1, 0, 'c');
    $pdf->cell(50, 10, $officerCmnt, 1, 1, 'c');
    $pdf->Ln(15);
    

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