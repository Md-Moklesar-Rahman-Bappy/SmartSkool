<?php session_start(); ?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SmartSkool Manager</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!-- Custom SmartSkool Styles -->
  <link rel="stylesheet" href="../dist/css/smartskool-custom.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../plugins/colorpicker/bootstrap-colorpicker.min.css">
  
  <!-- jvectormap -->
  <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
   <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <link rel="icon" href="../uploads/logo3.png">
    
    <!-- jQuery 2.1.4 --> 
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="../plugins/iCheck/icheck.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
   	<!-- Chart JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.js"> </script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.js"> </script>
    <!-- Select2 -->
    <script src="../plugins/select2/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="../plugins/input-mask/jquery.inputmask.js"></script>
    <script src="../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="../plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>
   	
<!-- page script -->
      <script>
        $(function () {
          $("#example1").DataTable();
          $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
          });
        });
      </script>

      <!-- SmartSkool Custom Utilities -->
      <script>
      // Loading Spinner Overlay
      function showLoading() {
        var overlay = document.createElement('div');
        overlay.className = 'page-loading-overlay active';
        overlay.id = 'page-loading';
        overlay.innerHTML = '<div class="spinner"></div>';
        document.body.appendChild(overlay);
      }

      function hideLoading() {
        var overlay = document.getElementById('page-loading');
        if (overlay) overlay.remove();
      }

      // Toast Notifications
      function showToast(message, type) {
        type = type || 'info';
        var icon = 'fa fa-info-circle';
        if (type === 'success') icon = 'fa fa-check-circle';
        if (type === 'error') icon = 'fa fa-times-circle';
        if (type === 'warning') icon = 'fa fa-exclamation-circle';

        var container = document.querySelector('.toast-container');
        if (!container) {
          container = document.createElement('div');
          container.className = 'toast-container';
          document.body.appendChild(container);
        }

        var toast = document.createElement('div');
        toast.className = 'toast ' + type;
        toast.innerHTML = '<i class="' + icon + '"></i><span>' + message + '</span><i class="fa fa-times toast-close"></i>';
        container.appendChild(toast);

        toast.querySelector('.toast-close').addEventListener('click', function() {
          toast.remove();
        });

        setTimeout(function() {
          toast.style.animation = 'slideIn 0.3s ease-out reverse';
          setTimeout(function() { toast.remove(); }, 300);
        }, 5000);
      }

      // Button Loading State
      function setButtonLoading(btn, loading) {
        if (loading) {
          btn.classList.add('btn-loading');
          btn.disabled = true;
        } else {
          btn.classList.remove('btn-loading');
          btn.disabled = false;
        }
      }

      // Show Empty State
      function showEmptyState(tableId, message, icon) {
        message = message || 'No data available';
        icon = icon || 'fa fa-folder-open';
        var table = document.getElementById(tableId);
        if (!table) return;

        var tbody = table.querySelector('tbody');
        if (!tbody) return;

        var cols = table.querySelectorAll('thead th').length;
        var tr = document.createElement('tr');
        tr.innerHTML = '<td colspan="' + cols + '" class="empty-state"><i class="' + icon + '"></i><h3>' + message + '</h3><p>No records found</p></td>';
        tbody.appendChild(tr);
      }

      // AJAX with loading
      function ajaxWithLoading(url, options) {
        options = options || {};
        showLoading();

        return $.ajax(url, options).always(function() {
          hideLoading();
        });
      }

      // Confirm dialog
      function confirmAction(message, callback) {
        if (confirm(message)) {
          callback();
        }
      }
      </script><!-- Here is the End of page script-->
    
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>