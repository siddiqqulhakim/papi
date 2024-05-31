<?php
session_start();
include 'config.php';
$data = array();
if (!isset($_POST['email'])) {
    $data['status'] = 'kosong deh';
} else {
    $sql = "SELECT * FROM user_results_v4 WHERE email=?";
    $query = $db->prepare($sql);
    $query->bind_param('s', $_POST['email']);
    $query->execute();
    $query->store_result();
    if ($query->num_rows > 0) {
        $data['status'] = 'ada';
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['sudahada'] = 'yes';
    } else {
        $data['status'] = 'belum ada';
    }
}
echo json_encode($data);
?>