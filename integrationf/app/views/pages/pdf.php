<?php

/*require("./fpdf/fpdf.php");
$db = new PDO('mysql:host=localhost;dbname=eya', 'root', '');


class myPDF extends FPDF
{

    function header()
    {
        $this->SetFont("Arial", "B", 16);
        $this->Image('logoweb.png', 10, 0);
        $this->Cell(267, 25, "                                                                                       Certificat", 0, 0, 'c');
        $this->Ln(25);
        $this->Cell(5, 25, "                                         Liste des formations:", 'C');

        $this->ln();
    }

    function footer()
    {
        $this->SetY(-15);
        $this->SetFont("Arial", "B", 10);
        $this->Cell(0, 10, 'Page' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
    function headerTable()
    {
        $this->SetFont("Times", "B", 12);
        $this->Cell(30, 10, 'Titre Certificat', 1, 0, 'C');
        $this->Cell(40, 10, 'date', 1, 0, 'C');
        $this->Cell(50, 10, 'duree', 1, 0, 'C');
        $this->Cell(30, 10, 'Nom', 1, 0, 'C');
        //$this->Cell(30, 10, 'Id Cours', 1, 0, 'C');
        $this->Ln();
    }
    function viewTable($db)
    {
        $this->SetFont("Times", "B", 12);
        $stmt = $db->query('select * from certificat');
        while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
            $this->Cell(30, 10, $data->Titre_Cert, 1, 0, 'L');
            $this->Cell(40, 10, $data->Date_Cert, 1, 0, 'L');
            $this->Cell(50, 10, $data->Duree_Cert, 1, 0, 'L');
            $this->Cell(30, 10, $data->Nom_Etud, 1, 0, 'L');
            //$this->Cell(30, 10, $data->nomFormateur, 1, 0, 'L');
            $this->Ln();
        }
    }
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L', 'A4', 0);
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->output("FORMATION.pdf", "D");*/
/*require("./fpdf/fpdf.php");
$db = new PDO('mysql:host=localhost;dbname=eya', 'root', '');

class myPDF extends FPDF
{
    function header()
    {
        $this->SetFont("Arial", "B", 16);
        $this->Image('logoweb.png', 10, 0);
        $this->Cell(267, 25, "Certificat", 0, 0, 'C');
        $this->Ln(25);
    }

    function footer()
    {
        $this->SetY(-15);
        $this->SetFont("Arial", "B", 10);
        $this->Cell(0, 10, 'Page' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    function viewCertificate($Nom_Etud, $Titre_Cert)
    {
        $this->SetFont("Times", "I", 12);

        // Adjust position to start below the image
        $this->SetXY(50, 80);

        $this->Cell(0, 10, "Nom de l'etudiant: " . $Nom_Etud, 0, 0, 'L');
        $this->Ln(10);

        // Adjust position for the next line of text
        $this->SetX(50);

        $this->Cell(0, 10, "Titre du certificat: " . $Titre_Cert, 0, 0, 'L');
        $this->Ln(10);

        // Adjust position for the next line of text
        $this->SetX(50);

        $this->Cell(0, 10, "Date de delivrance: " . date("d/m/Y"), 0, 0, 'L');
        $this->Ln(20);

        // Adjust position for the next line of text
        $this->SetX(50);

        $this->MultiCell(0, 10, "Ce certificat atteste que " . $Nom_Etud . " a reussi avec succes le cours " . $Titre_Cert . ".");
    }
}

if (isset($_GET['Id_Cert'])) {
    $Id_Cert = $_GET['Id_Cert'];
    $stmt = $db->prepare('SELECT * FROM certificat WHERE Id_Cert = :Id_Cert');
    $stmt->execute(['Id_Cert' => $Id_Cert]);
    $data = $stmt->fetch(PDO::FETCH_OBJ);

   if ($data) {
        $pdf = new myPDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->viewCertificate($data->Nom_Etud, $data->Titre_Cert);
        
            $pdf->Output("Certificat.pdf", "D");
        

    } else {
        echo "Certificat not found!";
    }
} else {
    echo "Id_Cert parameter missing!";
}*/

require "./fpdf/fpdf.php";
require './PHPMailer/PHPMailer.php';
require './PHPMailer/Exception.php';
require './PHPMailer/SMTP.php';
require_once(__DIR__ . "/../../../config/config.php");
//require("./fpdf/fpdf.php");
//$db = new PDO('mysql:host=localhost;dbname=myapp', 'root', '');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



class myPDF extends FPDF
{
    function header()
    {
        $this->SetFont("Arial", "B", 16);
        $this->Image('../img/logo.png', 10, 0);
        $this->Cell(267, 25, "Certificat", 0, 0, 'C');
        $this->Ln(25);
    }

    function footer()
    {
        $this->SetY(-15);
        $this->SetFont("Arial", "B", 10);
        $this->Cell(0, 10, 'Page' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    function viewCertificate($id_etud, $Titre_Cert)
    {
        $this->SetFont("Times", "I", 12);
        $db = config::getConnexion();
        // Prepare and execute the SQL query to fetch the USER_NAME from TABLE_USER
        $stmt = $db->prepare('SELECT USER_NAME 
                      FROM myapp.TABLE_USER 
                      WHERE USER_ID IN (
                          SELECT DISTINCT Id_etud 
                          FROM myapp.certificat 
                          WHERE Id_etud = :id_etud
                      )');

        $stmt->execute(['id_etud' => $id_etud]);

        // Fetch the result
        $user = $stmt->fetch(PDO::FETCH_OBJ);

        // Check if user exists and then use the USER_NAME
        if ($user) {
            $USER_NAME = $user->USER_NAME;

            // Adjust position to start below the image
            $this->SetXY(50, 80);
            // Utilisez le nom de l'utilisateur récupéré à partir de la requête
            $this->Cell(0, 10, "Nom de l'etudiant: " . $USER_NAME, 0, 0, 'L');
            $this->Ln(10);
            $this->SetX(50);
            // Votre code existant ici
            $this->Cell(0, 10, "Titre du certificat: " . $Titre_Cert, 0, 0, 'L');
            $this->Ln(10);
            $this->SetX(50);
            // Votre code existant ici
            $this->Cell(0, 10, "Date de delivrance: " . date("d/m/Y"), 0, 0, 'L');
            $this->Ln(20);
            $this->SetX(50);
            // Votre code existant ici
            $this->MultiCell(0, 10, "Ce certificat atteste que " . $USER_NAME . " a reussi avec succes le cours " . $Titre_Cert . ".");
        }
    }
}

// Modifier la requête pour récupérer Id_etud au lieu de Nom_Etud
if (isset($_GET['Id_Cert'])) {
    $Id_Cert = $_GET['Id_Cert'];
    $db = config::getConnexion();
    $stmt = $db->prepare('SELECT * FROM myapp.certificat WHERE Id_Cert = :Id_Cert');
    $stmt->execute(['Id_Cert' => $Id_Cert]);
    $data = $stmt->fetch(PDO::FETCH_OBJ);

    if ($data) {
        $pdf = new myPDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        // Passer Id_etud au lieu de Nom_Etud
        $pdf->viewCertificate($data->id_etud, $data->Titre_Cert);
        if ($_GET['ACTION'] == 'DOWNLOAD') {
            $pdf->Output("Certificat.pdf", "D");
        } else if ($_GET['ACTION'] == 'EMAIL') {
            // Fetch recipient email dynamically from the database
            $stmt_user = $db->prepare('SELECT User_email FROM myapp.TABLE_USER WHERE USER_ID = :id_etud');
            $stmt_user->execute(['id_etud' => $data->id_etud]);
            $user_data = $stmt_user->fetch(PDO::FETCH_OBJ);

            // Check if recipient email is found
            if ($user_data && isset($user_data->User_email)) {
                // Initialize PHPMailer
                $mail = new PHPMailer(true);

                // Email settings
                $from = "tgear2023@gmail.com";  // your mail
                $password = "ivaebkwsahnsdhsf";  // your mail password
                $to = $user_data->User_email; // Recipient email address
                $subject = "Certificate PDF";  // Email subject
                // Email body
                $body = '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Certificate</title>
                    <style>
                        body {
                            background-color: #d2ddec;
                            margin: 0;
                            padding: 0;
                            -webkit-text-size-adjust: none;
                            text-size-adjust: none;
                            font-family: Arial, sans-serif;
                        }
                        .container {
                            max-width: 700px;
                            margin: 0 auto;
                            padding: 20px;
                            text-align: center;
                        }
                        img {
                            max-width: 100%;
                            height: auto;
                            display: block;
                            margin: 0 auto;
                        }
                        h1 {
                            color: #5774cd;
                            font-size: 24px;
                            margin-bottom: 10px;
                        }
                        p {
                            color: #142a4b;
                            font-size: 14px;
                            margin-bottom: 15px;
                        }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <img src="C:/xampp/htdocs/projetweb/View/back/pages/logoweb.png" alt="logo">
                        <h1>Certificate</h1>
                        <p>Congratulations! You have successfully completed the course and earned your certificate.</p>
                        <p>Please find attached the certificate PDF.</p>
                        <p>Contact us:<br>Phone: +216 99040330<br>Instagram: SkillPulse<br>Address: Ghazela, Tunisia</p>
                    </div>
                </body>
                </html>
                
                ';

                try {
                    // SMTP settings
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = $from;
                    $mail->Password = $password;
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;

                    // Email content
                    $mail->setFrom($from);
                    $mail->addAddress($to);
                    $mail->Subject = $subject;
                    $mail->Body = $body;
                    $mail->isHTML(true);

                    // Attach PDF
                    $file_location = "downloads";
                    $pdf->Output($file_location . "Certificat.pdf", 'F');
                    //$pdfFilePath = realpath("downloads/Certificat.pdf"); // Path to the PDF file
                    //$mail->addAttachment($pdfFilePath);
                    $mail->AddAttachment($file_location . "Certificat.pdf");
                    // Send email
                    if ($mail->send()) {
                        // Output JavaScript alert
                        echo "<script>alert('Email sent successfully');</script>";
                        echo "<script>window.location.href = 'dashboardCertif.php';</script>";
                        exit;
                    } else {
                        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                } catch (Exception $e) {
                    echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                echo "Recipient email not found!";
            }
        } else {
            echo "Invalid action!";
        }
    } else {
        echo "Certificate not found!";
    }
} else {
    echo "Id_Cert parameter missing!";
}
