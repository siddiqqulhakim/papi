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
$sql = "SELECT calc_result,nama,email,created_at,id FROM user_results_v4 WHERE email=? ";
$query = $db->prepare($sql);
$query->bind_param('s', $_SESSION['email']);
$query->execute();
$query->store_result();
$query->bind_result($data, $nama, $email, $created_at, $id);
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
    <title>PAPIKostick Test Result</title>
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
    <div class="w3-top">
        <div class="w3-bar w3-theme-d5">
            <span class="w3-bar-item"># PAPI KOSTICK TEST v<?php echo $version; ?></span>
            <a href="#" class="w3-bar-item w3-button">Home</a>
            <div class="w3-dropdown-hover">
                <button class="w3-button">Themes</button>
                <div class="w3-dropdown-content w3-white w3-card-4" id="theme">
                    <?php
                    $color = array("black", "brown", "pink", "orange", "amber", "lime", "green", "teal", "purple", "indigo", "blue", "cyan");
                    foreach ($color as $c) {
                        echo "<a href='#' class='w3-bar-item w3-button w3-{$c} color' data-value='{$c}'> </a>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="w3-container">
        <div class="w3-card-4">
            <div class='w3-container w3-theme-l2'>
                <h2>&nbsp;</h2>
                <h2>PAPI Kostick Test Result</h1>
            </div>
            <div class="s12 w3-padding">
                <p>Hai, <b><?php echo strtoupper($nama); ?></b> berikut adalah interprestasi dari test PAPI Kostick yang
                    sudah Anda isi:</p>
                <table class='w3-table w3-hoverable'>
                    <tbody>
                        <?php
                        $radar = array();
                        $i = 0;
                        $mybody = "<h3>PAPI Kostick Test Result</h3><p>Hai, <b>" . strtoupper($nama) . "</b> berikut adalah interprestasi dari test PAPI Kostick yang sudah Anda isi:</p><p><table>";
                        foreach ($values as $k => $v) {
                            foreach ($lookup[$k] as $val) {
                                if ($aspect != $val->aspect) {
                                    $aspect = $val->aspect;
                                    $aspects = explode('|', $val->aspect);
                                    echo "<tr class='w3-theme-l1'><td style=\"padding:4px;\"><b>{$aspects[0]}</b> <i>{$aspects[1]}</i></td></tr>";
                                    $mybody .= "<tr bgcolor='#bbbbbb'><td style=\"padding:4px;\"><b>{$aspects[0]}</b> <i>{$aspects[1]}</i></td></tr>";
                                }
                                if ($v >= $val->low_value && $v <= $val->high_value) {
                                    $roles = explode('|', $val->role);
                                    $radar[] = array((++$i), $roles[0], $v);
                                    echo "<tr class='w3-theme-l2'><td style=\"padding:4px;\"><b>{$roles[0]}</b> <i>{$roles[1]}</i></td></tr>
                  <tr class='w3-theme-l3'><td style=\"padding:4px;\">{$val->description}</td></tr>
                  <tr class='w3-theme-l4'><td style=\"padding:4px;\">SCORE : {$v} :  {$val->interprestation}</td></tr>";
                                    $mybody .= "<tr bgcolor='#cccccc'><td style=\"padding:4px;\"><b>{$roles[0]}</b> <i>{$roles[1]}</i></td></tr>
                  <tr bgcolor='#eeeeee'><td style=\"padding:4px;\">{$val->description}</td></tr>
                  <tr bgcolor='#ffffff'><td style=\"padding:4px;\">SCORE : {$v} :  {$val->interprestation}</td></tr>";
                                }
                            }
                        }
                        $mybody .= "</table></p><p>data dibuat pada : <b>{$created_at}</b></p>";
                        $_SESSION['data'] = $radar;
                        ?>
                    </tbody>
                </table>
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
                    <div id="body">
                        <div id="chart">
                        </div>
                    </div>
                    <script type="text/javascript"
                        src="assets/js/radar.min.php?c=<?php echo $_SESSION['ver'] . MD5(rand(0, 100)); ?>">
                        </script>
                </div>
                <div class="w3-padding">
                    <center>
                        <div id="qrcode" class="pull-right"></div>
                    </center>
                    <h3>&nbsp;</h3>
                </div>
            </div>
            <footer class="w3-container w3-theme-l1" id='nav'>
                <div class="w3-row">
                    <div class="w3-col s12 w3-padding w3-center">
                        <?php echo "data created on : {$created_at}"; ?>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <h2>&nbsp;</h2>
    <!-- <div class="w3-bottom">
        <div class="w3-bar w3-theme-d4 w3-center">
            Papikostick Test v<?php echo $version; ?> copyright &copy;
            2017<?php echo (date('Y') > 2017 ? date('-Y') : ''); ?>
            by <a href='mailto:siddiqqulhakim@gmail.com'>siddiqqulhakim</a><br />
        </div>
    </div> -->
</body>
<script src="<?php echo _ASSET; ?>js/papi.v4.php?v=<?php echo md5(filemtime(_ASSET . 'js/papi.v4.php')); ?>"></script>
<script src="assets/js/qrcode.min.js"></script>
<script>
    $(document).ready(function () {
    });
</script>

</html>