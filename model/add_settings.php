<?php

include_once('../controller/config.php');

$school_name = $_POST['school_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$website_url = $_POST['website_url'];

$settings = [
    'school_name' => $school_name,
    'email' => $email,
    'phone' => $phone,
    'address' => $address,
    'website_url' => $website_url
];

$success = true;

foreach ($settings as $key => $value) {
    $sql = "UPDATE settings SET setting_value = '$value' WHERE setting_key = '$key'";
    if (!mysqli_query($conn, $sql)) {
        $success = false;
    }
}

if ($success) {
    echo json_encode(['success' => true, 'message' => 'Settings updated successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error updating settings']);
}

?>