<?php
    require('../img/fpdf186/fpdf.php');
    include('connection.php');

    $house_no = $_GET['house_no'];

    $sql = "SELECT * FROM tenants t INNER JOIN houses h ON t.house_no = h.house_no WHERE h.house_no = $house_no;";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $date = date("F j, Y", strtotime($row['startDate']));
    $datee = new DateTime($row['startDate']);
    $formattedDate = $datee->format("jS \of F, Y");
   
    class PDF extends FPDF{
        function Header(){
            // Arial bold 15
            $this->SetFont('Arial', 'B', 15);
            // Title
            $this->Cell(0, 10, 'House Rental Agreement', 0, 1, 'C');
            $this->Ln(10);
        }

        function Footer(){
            // Go to 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial', 'I', 8);
            // Page number
            $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
        }

        function ChapterTitle($title){
            // Arial 12
            $this->SetFont('Arial', 'B', 12);
            // Background color
            $this->SetFillColor(200, 220, 255);
            // Title
            $this->Cell(0, 10, $title, 0, 1, 'L', true);
            $this->Ln(4);
        }

        function ChapterBody($body){
            // Read text file
            $this->SetFont('Arial', '', 12);
            $this->MultiCell(0, 10, $body);
            $this->Ln();
        }

        function PrintChapter($title, $body){
            $this->AddPage();
            $this->ChapterTitle($title);
            $this->ChapterBody($body);
        }
    }

    $pdf = new PDF();
    $pdf->SetTitle('House Rental Agreement');

    // Add chapters
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 12);

    $agreementText = <<<EOT
    This Rental Agreement ("Agreement") is made and entered into on this $formattedDate, by and between:

    Landlord:
    Name: Mark Christian M. Naval
    Phone: 09124783392

    Tenant:
    Name: $row[fullname]
    Phone: $row[contact]

    Property:
    Address: $row[fulladdress]

    1. Term of Lease
    The lease will begin on $date. If the Tenant does not specify a lease term, the tenancy will be on a month-to-month basis. Either party may terminate the month-to-month tenancy by providing 30 days written notice.

    2. Rent
    The monthly rent will be $row[rent] pesos, payable in advance on the 1st of each month. The rent is to be paid by cash, e-wallet or bank transfer.

    3. Security Deposit
    The Tenant agrees to pay a security deposit and advance payment of $row[deposit] pesos prior to moving in. This will be credited towards the rent if the Tenant fails to pay for a certain month. The deposit will be refunded within 30 days after the end of the lease, provided there are no damages or unpaid rent.

    4. Utilities
    The Tenant will be responsible for the following utilities: electricity, water, gas, and internet.

    5. Maintenance and Repairs
    The Tenant agrees to keep the property in good condition and promptly notify the Landlord of any repairs needed. The Landlord will be responsible for repairs, except those caused by the Tenant's negligence.

    6. Use of Property
    The Tenant agrees to use the property for residential purposes only and will not engage in any illegal activities on the premises.

    7. Pets
    Pets are permitted on the premises under the condition that they do not disturb neighbors, create excessive noise, or make messes outside the house.

    8. Termination
    Either party may terminate this Agreement by providing 30 days written notice. In the event of a breach of this Agreement, the non-breaching party may terminate the Agreement immediately.


    IN WITNESS WHEREOF, the parties have executed this Rental Agreement on the date first above written.

    Landlord:
    _________________________
    Mark Christian M. Naval

    Tenant:
    _________________________
    $row[fullname]
    EOT;

    $pdf->MultiCell(0, 10, $agreementText);
    $pdf->Ln(10);

    // Output the PDF
    $pdf->Output('I', 'Rental_Agreement.pdf');

?>

