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

                            $pdf->Ln(30);
    
                            // Output PDF
                            $pdf->Output('ride_report.pdf', 'I');
                        } else {
                            echo "Error: No rides found for the selected date.";
                        }

                    } else {
                        echo "Error: Please select a date for Day Report.";
                    }
                    redirect('admin/rideReport');
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

                            $pdf->Ln(30);
    
                            // Output PDF
                            $pdf->Output('ride_report.pdf', 'I');
                        } else {
                            echo "Error: No rides found for the selected date.";
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
}


?>