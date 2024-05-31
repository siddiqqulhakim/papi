<?php
session_start();
include 'inc/config.php';
$_SESSION['code'] = session_id();
if (isset($_POST['d'])) {
    $data = array();
    foreach ($_POST['d'] as $k => $v) {
        if (!isset($data[$v]))
            $data[$v] = 0;
        $data[$v] += 1;
    }
    $sql = "INSERT INTO user_results_v4(email,nama,raw_result,calc_result,created_at, posisi) VALUES(?,?,?,?,NOW(),?)";
    $query = $db->prepare($sql);
    $d = json_encode($_POST['d']);
    $dt = json_encode($data);
    $query->bind_param('sssss', $_POST['email'], $_POST['nama'], $d, $dt, $_POST['posisi']);
    $query->execute();
    $_SESSION['email'] = $_POST['email'];
    header('location:final.php');
}
