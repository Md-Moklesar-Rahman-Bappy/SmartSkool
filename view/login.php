<?php include_once('head.php'); ?>

<style>
body.login-page {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.login-box {
    width: 400px;
    margin: 0 auto;
}

.login-logo {
    text-align: center;
    margin-bottom: 20px;
}

.login-logo a {
    color: #fff;
    font-size: 32px;
    font-weight: bold;
    text-decoration: none;
}

.login-card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    padding: 30px;
}

.login-card .form-control {
    border-radius: 5px;
    height: 45px;
    border: 1px solid #ddd;
    padding-left: 15px;
}

.login-card .form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.login-card .btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 5px;
    height: 45px;
    font-size: 16px;
    font-weight: bold;
    transition: transform 0.2s;
}

.login-card .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
}

.login-card .has-feedback .form-control-feedback {
    top: 12px;
}

.input-group-addon {
    background: #f8f9fa;
    border: 1px solid #ddd;
    border-left: none;
}

.input-group .form-control {
    border-right: none;
}

.school-logo {
    width: 80px;
    height: 80px;
    margin-bottom: 15px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 36px;
}

.bg {
    display: none;
}

#loginFrom {
    opacity: 1 !important;
}

.login-title {
    text-align: center;
    color: #333;
    margin-bottom: 25px;
    font-size: 24px;
    font-weight: 600;
}

.login-subtitle {
    text-align: center;
    color: #666;
    margin-bottom: 25px;
    font-size: 14px;
}
</style>

<body class="hold-transition login-page">
    
    <div class="login-box">
        <div class="login-logo">
            <a href="#">
                <div class="school-logo">
                    <i class="fa fa-graduation-cap"></i>
                </div>
                SmartSkool Manager
            </a>
        </div>
        
        <div class="login-card">
            <p class="login-title">Welcome Back!</p>
            <p class="login-subtitle">Please login to continue</p>
            
            <form role="form" action="../index.php" method="post">
                <input type="hidden" name="do" value="user_login">
                <div class="form-group has-feedback">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="text" class="form-control" id="email" placeholder="Email Address" name="email" autocomplete="off">
                    </div>
                </div>
                
                <div class="form-group has-feedback">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password" autocomplete="off">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block" id="btnSubmit" style="width:100%;">
                            <i class="fa fa-sign-in"></i> Login
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
        <div style="text-align: center; margin-top: 20px; color: #fff; font-size: 12px;">
            &copy; <?php echo date('Y'); ?> SmartSkool Manager
        </div>
    </div>

<script>
$("form").submit(function(e) {
    var uname = $('#email').val();
    var password = $('#password').val();
    
    if (uname == '') {
        showToast('Please enter your email address', 'warning');
        $('#email').focus();
        e.preventDefault();
        return false;
    }
    
    if (password == '') {
        showToast('Please enter your password', 'warning');
        $('#password').focus();
        e.preventDefault();
        return false;
    }
    
    return true;
});
</script>

<!-- Error Modal -->
<div class="modal fade" id="login_error" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-red-active">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4>Login Failed</h4>
            </div>
            <div class="modal-body">
                <p style="color:red; font-size:14px;">Invalid email or password. Please try again.</p>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_GET["do"]) && $_GET["do"] == "login_error") {
    echo "<script>
        $(document).ready(function() {
            $('#login_error').modal('show');
            setTimeout(function() {
                $('#login_error').modal('hide');
            }, 3000);
        });
    </script>";
}
?>

</body>