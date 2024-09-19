<?php
    require('../img/fpdf186/fpdf.php');
   
    $date = date("F, Y");
    $currYear = date("Y");
    $currMonth = date("m");

    $pdf = new FPDF('P', 'mm', 'A4');

    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', 20);
    $pdf->Cell(65, 10, '', 0, 0);
    $pdf->Cell(59, 15, 'Payment Records', 0, 0);
    $pdf->Cell(59, 10, '', 0, 1);

    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Cell(-1, 10, '', 0, 0);
    $pdf->Cell(59, 40, "Date: $date", 0, 0);
    $pdf->Cell(59, 10, '', 0, 1);

    $pdf->Cell(59, 15, '', 0, 1);

    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Cell(32, 10, 'House No.', 1, 0, 'C');
    $pdf->Cell(74, 10, 'Tenant Name', 1, 0, 'C');
    $pdf->Cell(57, 10, 'Date and Time', 1, 0, 'C');
    $pdf->Cell(27, 10, 'Amount', 1, 0, 'C');

    $pdf->Cell(1, 10, '', 0, 1);

    include('connection.php');
    $sql = ("SELECT * FROM payment WHERE YEAR(datePaid) = ? AND MONTH(datePaid) = ? AND MOP != '*deposit' AND MOP != '*adjust'");
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $currYear, $currMonth);
    $stmt->execute();
    $result = $stmt->get_result();
    $total = 0;

    $pdf->SetFont('Arial', '', 15);
    while($row=$result->fetch_assoc()){
        $pdf->Cell(32, 10, "$row[house_no]", 1, 0, 'C');
        $pdf->Cell(74, 10, "$row[fullname]", 1, 0, 'C');
        $pdf->Cell(57, 10, "$row[datePaid]", 1, 0, 'C');
        $pdf->Cell(27, 10, "$row[amount]", 1, 0, 'C');
        $pdf->Cell(1, 10, '', 0, 1);
        $total += $row['amount'];
    }

    $pdf->Cell(163, 10, "Total:", 1, 0, 'C');
    $pdf->Cell(27, 10, "$total", 1, 0, 'C');
    

     

    $pdf->output();

?>