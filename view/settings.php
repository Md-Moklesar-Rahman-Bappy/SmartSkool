<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    header('location:../index.php');
    exit;
}
?>
<?php include_once('head.php'); ?>
<?php include_once('header_admin.php'); ?>
<?php include_once('sidebar.php'); ?>
<?php include_once('alert.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Settings
            <small>Configure your school information</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Settings</a></li>
        </ol>
    </section>
    
<?php 
include_once('../controller/config.php');

$sql = "SELECT * FROM settings";
$result = mysqli_query($conn, $sql);

$settings = array();
while ($row = mysqli_fetch_assoc($result)) {
    $settings[$row['setting_key']] = $row['setting_value'];
}

$school_name = isset($settings['school_name']) ? $settings['school_name'] : '';
$email = isset($settings['email']) ? $settings['email'] : '';
$phone = isset($settings['phone']) ? $settings['phone'] : '';
$address = isset($settings['address']) ? $settings['address'] : '';
$website_url = isset($settings['website_url']) ? $settings['website_url'] : '';

?>
    
    <section class="content"> 
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel">
                    <div class="panel-heading bg-primary">	
                        <h4 class="panel-title">School Settings</h4>
                    </div>				
                    <div class="panel-body">
                        <form id="settingsForm" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">School Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="school_name" value="<?php echo htmlspecialchars($school_name); ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="email" value="<?php echo htmlspecialchars($email); ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Phone</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="phone" value="<?php echo htmlspecialchars($phone); ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Address</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="address" rows="2" required><?php echo htmlspecialchars($address); ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Website URL</label>
                                <div class="col-sm-9">
                                    <input type="url" class="form-control" id="website_url" value="<?php echo htmlspecialchars($website_url); ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save"></i> Save Settings
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
$(document).ready(function() {
    $('#settingsForm').on('submit', function(e) {
        e.preventDefault();
        
        var formData = {
            school_name: $('#school_name').val(),
            email: $('#email').val(),
            phone: $('#phone').val(),
            address: $('#address').val(),
            website_url: $('#website_url').val()
        };
        
        $.ajax({
            url: '../model/add_settings.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showToast('Settings updated successfully!', 'success');
                } else {
                    showToast('Error: ' + response.message, 'error');
                }
            },
            error: function() {
                showToast('Error saving settings', 'error');
            }
        });
    });
});
</script>

<?php include_once('footer.php'); ?>