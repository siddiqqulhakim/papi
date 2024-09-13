<?php
session_start();
include 'inc/config.php';
$c = isset($_SESSION['c']) ? $_SESSION['c'] : (isset($_GET['c']) ? $_GET['c'] : 'indigo');
$_SESSION['author'] = 'ilham';
$_SESSION['ver'] = sha1(rand());
$version = '0.4';                  //<-- version number
header('Expires: ' . date('r'));
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
$sql = "SELECT calc_result,nama,email,created_at,id,posisi FROM user_results_v4 WHERE email=? ";
$query = $db->prepare($sql);
$query->bind_param('s', $_SESSION['email']);
$query->execute();
$query->store_result();
$query->bind_result($data, $nama, $email, $created_at, $id, $posisi);
$query->fetch();
$tot = 0;
$values = json_decode($data, true);
if (empty($nama))
    die('illegal access, system aborted');
for ($i = 1; $i <= 20; ++$i) {
    if (!isset($values[$i]))
        $values[$i] = 0;
}
ksort($values);
$query->close();
$sql = "
    SELECT
        c.id AS aspect_id,
        b.id AS role_id,
        c.aspect, 
        b.role, 
        a.interprestation,
        b.description,
        a.low_value, 
        a.high_value 
    FROM 
        papi_rules_v4 a 
        JOIN papi_roles_v4 b ON b.id=a.role_id 
        JOIN papi_aspects_v4 c ON c.id=b.aspect_id 
    ORDER BY c.id,b.id;";
$result = $db->query($sql);
$lookup = array();
$role = 0;
while ($row = $result->fetch_object()) {
    if ($role != $row->role_id) {
        $role = $row->role_id;
        $lookup[$row->role_id] = array();
    }
    $lookup[$row->role_id][] = $row;
}
$aspect = '';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Geekhunter PAPIKostick Test <?php echo $version; ?> [Bahasa Indonesia]</title>
    <meta charset="utf-8" />
    <meta http-equiv="expires" content="<?php echo date('r'); ?>" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta http-equiv="content-language" content="en" />
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />
    <meta name="keywords" content="Psikotest, PAPI kostick, test, psychology" />
    <meta name="robots" content="index, follow" />
    <link rel="shortcut icon" href="<?php echo _ASSET; ?>img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo _ASSET; ?>css/w3/w3.css">
    <link rel="stylesheet" href="<?php echo _ASSET; ?>css/w3/w3-theme-<?php echo $c; ?>.css" media="all" id="papi_css">
    <script src="<?php echo _ASSET; ?>js/jquery.min.js"></script>
    <?php if (defined('_ISONLINE') && _ISONLINE): ?>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <?php endif; ?>
    <style>
        body,
        h1,
        h2,
        h3,
        h4,
        h5 {
            font-family: "Raleway", sans-serif
        }

        td.incomplete {
            color: red !important;
        }
    </style>
    <script src="<?php echo _ASSET; ?>js/jquery.min.php"></script>
</head>

<body>

    <!-- Add this div for the loading spinner -->
    <div id="loading-overlay">
        <div id="loading-spinner"></div>
    </div>

    <style>
        /* Style for the loading overlay */
        #loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            /* Set a high z-index to make sure it's above all other elements */
        }

        /* Style for the loading spinner */
        #loading-spinner {
            margin-top: 30%;
            margin-left: 50%;
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top: 4px solid #fff;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 2s linear infinite;
        }

        /* Animation for the loading spinner */
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    <input type="hidden" id="nama" value="<?= $nama ?>">
    <input type="hidden" id="email" value="<?= $email ?>">
    <input type="hidden" id="posisi" value="<?= $posisi ?>">
    <div class="w3-top">
        <div class="w3-bar w3-theme-d5">
            <span class="w3-bar-item"># PAPI KOSTICK TEST v<?php echo $version; ?></span>
            <a href="#" class="w3-bar-item w3-button">Home</a>
            <!-- <div class="w3-dropdown-hover">
                <button class="w3-button">Themes</button>
                <div class="w3-dropdown-content w3-white w3-card-4" id="theme">
                    <?php
                    // $color = array("black", "brown", "pink", "orange", "amber", "lime", "green", "teal", "purple", "indigo", "blue", "cyan");
                    // foreach ($color as $c) {
                    //     echo "<a href='#' class='w3-bar-item w3-button w3-{$c} color' data-value='{$c}'> </a>";
                    // }
                    ?>
                </div>
            </div> -->
        </div>
    </div>
    <br /> <br />
    <div class="w3-container">
        <div class="w3-card-4">
            <input type='button' value='Submit To Geekhunter'
                class='w3-button w3-round-large w3-theme-d1 w3-right w3-margin-8' style="margin: 20px;"
                onclick='printPDFAndSendEmail()' />
        </div>
    </div>

    <div class="w3-container">
        <div class="w3-card-4" id="contentToPrint">
            <div class='w3-container large-bold-color-text'>
                <h2>&nbsp;</h2>
                <span class="large-bold-color-text">Hasil Tes PAPI Kostick</span>
                <a href="https://geekhunter.co/"><img align="right"
                        src="<?php echo _ASSET; ?>img/GeekHunterLogoGreen.png"></a>
            </div>
            <div class="w3-container">
                <b>Nama: <?php echo strtoupper($nama); ?></b>
            </div>
            <div class="w3-container">
                <style>
                    #body {
                        overflow: hidden;
                        margin: 0;
                        font-size: 14px;
                        font-family: "Helvetica Neue", Helvetica;
                    }

                    #chart {
                        position: relative;
                        top: 50px;
                        left: 100px;
                        margin-bottom: 50px;
                    }
                </style>
                <div class="w3-padding">
                    <div id="body" style="text-align: center;">
                        <div id="chart">
                        </div>
                    </div>

                    <script type="text/javascript"
                        src="assets/js/radar.min.php?c=<?php echo $_SESSION['ver'] . MD5(rand(0, 100)); ?>">
                        </script>
                </div>
            </div>
            <div class="s12 w3-padding">
                <table class='w3-table'>
                    <tbody>
                        <?php
                        $radar = array();
                        $i = 0;
                        foreach ($values as $k => $v) {
                            foreach ($lookup[$k] as $val) {
                                if ($aspect != $val->aspect) {
                                    $aspect = $val->aspect;
                                    $aspects = explode('|', $val->aspect);
                                    echo "<tr class='w3-theme-l2'><td style=\"padding:4px; font-size:30px   \"><b>{$aspects[0]}</b> <i>{$aspects[1]}</i></td></tr>
                                        <tr><td style=\"padding:1px;\">&nbsp;<td></tr>";
                                }
                                if ($v >= $val->low_value && $v <= $val->high_value) {
                                    $roles = explode('|', $val->role);
                                    $radar[] = array((++$i), $roles[0], $v);
                                    echo "<tr class='w3-theme-l2'><td style=\"padding:4px;\"><b>{$roles[0]}</b> <i>{$roles[1]}</i></td></tr>
                                    <tr class='w3-theme-l4'><td style=\"padding:4px;\">SCORE : {$v}/10 :  {$val->interprestation}</td></tr>
                                    <tr class='w3-theme-l3'><td style=\"padding:4px;\">{$val->description}</td></tr>
                                    <tr><td style=\"padding:1px;\">&nbsp;<td></tr>";
                                }
                            }
                        }
                        $_SESSION['data'] = $radar;
                        ?>
                    </tbody>
                </table>

            </div>
        </div>

        <input type='button' value='Submit To Geekhunter'
            class='w3-button w3-round-large w3-theme-d1 w3-right w3-margin-8' style="margin: 20px;"
            onclick='printPDFAndSendEmail()' />
    </div>
    <h2>&nbsp;</h2>
</body>
<script src="<?php echo _ASSET; ?>js/papi.v4.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script>
    $(document).ready(function () {
        document.querySelectorAll('circle').forEach(circle => {
            // Get the number from the alt attribute
            const number = circle.getAttribute('alt');

            // Get the position of the circle
            const cx = circle.getAttribute('cx');
            const cy = circle.getAttribute('cy');

            // Create a new text element
            const text = document.createElementNS("http://www.w3.org/2000/svg", "text");

            // Set the attributes for the text element
            text.setAttribute('x', cx);
            text.setAttribute('y', cy);
            text.setAttribute('text-anchor', 'middle'); // Center the text
            text.setAttribute('dominant-baseline', 'middle'); // Vertically align the text in the middle
            text.setAttribute('fill', 'white'); // Text color

            // Set the text content to the number from the alt attribute
            text.textContent = number;

            // Insert the text element after the circle element
            circle.parentNode.insertBefore(text, circle.nextSibling);
        });

        var graphContainer = document.getElementById('chart');
        html2canvas(graphContainer).then(function (canvas) {
            var graphImage = canvas.toDataURL("image/png"); // Convert canvas to base64 image

            // Create an image element for the overlay
            var overlayImage = document.createElement("img");
            overlayImage.src = graphImage;
            overlayImage.style.width = "100%";
            overlayImage.style.height = "100%";

            graphContainer.innerHTML = '';
            graphContainer.appendChild(overlayImage);
        });
    });
</script>
<script>
    function printPDFAndSendEmail() {
        // var confirmation = confirm("Apakah ingin membuat PDF dan mengirim email ke HR? \nPastikan anda mematikan popup-blocker agar dapat mendownload pdf secara otomatis.");
        // if (confirmation) {
        // var graphElement = document.getElementById('graph');
        // graphElement.innerHTML = 'Tidak dapat menampilkan grafik';
        $('#loading-overlay').fadeIn();

        //debug
        // console.log($('#contentToPrint').html());
        // console.log($('#nama').val());

        $.ajax({
            type: 'POST',
            url: 'generate_pdf_and_email.php',
            data: {
                content: $('#contentToPrint').html(),
                // graphImage: graphImage,
                nama: $('#nama').val(),
                email: $('#email').val(),
                posisi: $('#posisi').val(),
            },
            success: function (response) {
                console.log(response);
                window.open(response, '_blank');
                window.location.href = 'success.php';
            },
            error: function () {
                console.log(response);
                window.location.href = 'error.php';
            }
        });
        // }    
    }
</script>

</html>