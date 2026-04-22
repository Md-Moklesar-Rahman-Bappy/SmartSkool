<?php
include_once('../controller/config.php');

$sql = "SELECT * FROM settings";
$result = mysqli_query($conn, $sql);

$settings = array();
while ($row = mysqli_fetch_assoc($result)) {
    $settings[$row['setting_key']] = $row['setting_value'];
}

$school_name = isset($settings['school_name']) ? $settings['school_name'] : 'School Name';
$email = isset($settings['email']) ? $settings['email'] : '';
$phone = isset($settings['phone']) ? $settings['phone'] : '';
$address = isset($settings['address']) ? $settings['address'] : '';
$website_url = isset($settings['website_url']) ? $settings['website_url'] : '';
?>
<footer class="main-footer">
    <div class="row">
        <div class="col-sm-4">
            <strong><?php echo htmlspecialchars($school_name); ?></strong><br>
            <small><?php echo htmlspecialchars($address); ?></small>
        </div>
        <div class="col-sm-4 text-center">
            <small>
                <i class="fa fa-envelope"></i> <?php echo htmlspecialchars($email); ?><br>
                <i class="fa fa-phone"></i> <?php echo htmlspecialchars($phone); ?>
            </small>
        </div>
        <div class="col-sm-4 text-right">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0.2
            </div>
            <small>
                <a href="<?php echo htmlspecialchars($website_url); ?>" target="_blank">Visit Website</a>
            </small>
        </div>
    </div>
</footer>
</body>
</html>