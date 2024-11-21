<?php
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'dompdf/autoload.inc.php';
include 'inc/config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dompdf\Dompdf;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['content'])) {
    try {
        $folderpdf = 'generated_pdf';
        if (is_dir($folderpdf)) {
            $dirHandle = opendir($folderpdf);

            while (($file = readdir($dirHandle)) !== false) {
                if ($file != '.' && $file != '..') {
                    $filePath = $folderpdf . '/' . $file;

                    if (is_file($filePath)) {
                        unlink($filePath);
                    }
                }
            }

            closedir($dirHandle);
        } else {
            mkdir($folderpdf, 0777, true);
        }

        ob_start();
        include _ASSET . 'css/w3/w3.css';
        include _ASSET . 'css/w3/w3-theme-indigo.css';
        $cssContent = ob_get_contents();
        ob_end_clean();

        $doc = new DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML($_POST['content']);
        libxml_clear_errors();

        $xpath = new DOMXPath($doc);
        $chartDiv = $xpath->query("//div[@id='chart']")->item(0);
        $base64ImageChart = '';
        if ($chartDiv) {
            $chartImg = $xpath->query("//div[@id='chart']/img")->item(0);

            if ($chartImg) {
                $base64ImageChart = $chartImg->getAttribute('src');
            }

            // Remove the <div id="chart"> element
            $parent = $chartDiv->parentNode;
            $parent->removeChild($chartDiv);

            // Create a new <div> element with the desired content
            $newDiv = $doc->createElement('div');
            $newDiv->setAttribute('style', 'text-align: center;');

            // Create a new <img> element with the base64 image
            $newImg = $doc->createElement('img');
            $newImg->setAttribute('src', $base64ImageChart);
            $newImg->setAttribute('alt', 'Chart Image');
            $newImg->setAttribute('class', 'chart-image');

            // Append the <img> element to the <div>
            $newDiv->appendChild($newImg);
            $parent->appendChild($newDiv);
        }

        $modifiedContent = $doc->saveHTML();

        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $posisi = $_POST['posisi'];

        $htmlContent = '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="utf-8" />
                <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
                <meta http-equiv="content-language" content="id" />
                <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />
                <link rel="shortcut icon" href="' . _ASSET . 'img/favicon.ico" type="image/x-icon">
                <link rel="stylesheet" href="' . _ASSET . 'css/w3/w3.css">
                <link rel="stylesheet" href="' . _ASSET . 'css/w3/w3-theme-indigo.css" media="all" id="papi_css">
                <script src="' . _ASSET . 'js/jquery.min.js"></script>
                <script src="' . _ASSET . 'js/jquery.min.php"></script>
                <style>
                    body, h1, h2, h3, h4, h5 { font-family: "Raleway", sans-serif }
                    ' . $cssContent . '
                    .chart-image {
                        display: block;
                        margin: 0 auto;
                        width: 1000px;
                        height: auto;
                    }
                </style>
            </head>
            <body>
                ' . $modifiedContent . '
            </body>
            </html>';

        $imagePath = _ASSET . 'img/GeekHunterLogoGreen.png';
        $imageData = base64_encode(file_get_contents($imagePath));
        $base64ImageLogo = 'data:image/png;base64,' . $imageData;

        $htmlContent = str_replace(
            '<img align="right" src="assets/img/GeekHunterLogoGreen.png">',
            '<img align="right" src="' . $base64ImageLogo . '">',
            $htmlContent
        );

        // Create a new PDF document using Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($htmlContent);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Get the PDF content as a string
        $pdfContent = $dompdf->output();

        // Generate a unique file name using uniqid() and timestamp
        // $fileName = $folderpdf . '/' . $nama . '_papi_' . date('dmY') . '.pdf';
        $fileName = $nama . '_papi_' . date('dmY') . '.pdf';

        // Save the PDF content to a file
        // file_put_contents($fileName, $pdfContent);

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'recruiteradm@geekhunter.co';
        $mail->Password = 'lackscsruvgsfqkt';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Sender and recipient
        $mail->setFrom('geekhunter-noreply@geekhunter.co', 'Geekhunter PAPIKostick Test');
        $mail->addAddress('hr@geekhunter.co', 'HR');
        // $mail->addAddress('siddiqqulhakim@gmail.com', 'FAK');
        $mail->addAddress($email, $nama);

        // Attach PDF
        $mail->addStringAttachment($pdfContent, $fileName);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = "Geekhunter - PAPI Result - {$nama}";
        $mail->Body = "Please find attached the PAPIKostick Test Result of:<br><br>"
            . "<b>Name:</b> {$nama}<br>"
            . "<b>Email:</b> {$email}<br>"
            . "<b>Applied position:</b> {$posisi}";
        $mail->send();

        // Send the PDF file to the user for download
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        // readfile($pdfContent);

        echo $pdfContent;
    } catch (Exception $e) {
        $errorMessage = "Error occurred on " . date('Y-m-d H:i:s') . "\n";
        $errorMessage .= "Error: " . $e->getMessage() . "\n";
        $errorMessage .= "Mailer Error: " . $mail->ErrorInfo . "\n";

        // Log the error to a file
        error_log($errorMessage, 3, 'log/error.log');

        // Optionally, you can output the error
        echo "Terjadi error. Error: {$e->getMessage()} - Mailer Error: {$mail->ErrorInfo}";
    }

} else {
    echo 'Invalid request.';
}