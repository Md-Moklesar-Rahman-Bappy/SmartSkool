<?php

include_once('../controller/config.php');

$sql = "SELECT * FROM settings";
$result = mysqli_query($conn, $sql);

$settings = array();
while ($row = mysqli_fetch_assoc($result)) {
    $settings[$row['setting_key']] = $row['setting_value'];
}

echo json_encode($settings);

?>