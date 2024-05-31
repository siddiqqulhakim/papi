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
    try{
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
        include _ASSET . 'css/w3.css';
        include _ASSET . 'css/w3-theme-indigo.css'; 
        $cssContent = ob_get_contents();
        ob_end_clean();

        $imagePath = _ASSET . 'img/GeekHunterLogoGreen.png';
        $imageData = base64_encode(file_get_contents($imagePath));
        $base64Image = 'data:image/png;base64,' . $imageData;
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
                <link rel="stylesheet" href="' . _ASSET . 'css/w3.css">
                <link rel="stylesheet" href="' . _ASSET . 'css/w3-theme-indigo.css" media="all" id="disc_css">
                <script src="' . _ASSET . 'js/jquery.min.js"></script>
                <script src="' . _ASSET . 'js/jspdf.min.js"></script>
                <script src="' . _ASSET . 'js/jspdf.plugin.align.js"></script>
                <script src="' . _ASSET . 'js/jspdf.plugin.autotable.js"></script>
                <style>body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}' . $cssContent . '</style>
            </head>
            <body>
                ' . $_POST['content'] . '
            </body>
            </html>';
        
        $htmlContent = str_replace(
            '<img src="assets/img/GeekHunterLogoGreen.png" align="right">',
            '<img src="' . $base64Image . '" align="right">',
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
        $fileName = $folderpdf . '/' . $nama . '_disc_' . date('dmY') . '.pdf';
        
        // Save the PDF content to a file
        file_put_contents($fileName, $pdfContent);
        
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ghsupport@geekhunter.co';
        $mail->Password = 'fcdmnhxtaclkhycn'; 
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        // Sender and recipient
        $mail->setFrom('geekhunter-noreply@geekhunter.co', 'Geekhunter PAPIKostick Test');
        // $mail->addAddress('hr@geekhunter.co', 'HR');
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
        // header('Content-Type: application/pdf');
        // header('Content-Disposition: attachment; filename="' . $fileName . '"');
        // readfile($fileName);
        
        echo $fileName;
    } catch (Exception $e) {
        echo "Terjadi error. Error: {$e->getMessage()}";
    }  

} else {
    echo 'Invalid request.';
}
?>
