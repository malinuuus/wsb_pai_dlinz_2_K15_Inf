<?php
session_start();
if (!isset($_SESSION["logged"]) || session_status() != PHP_SESSION_ACTIVE || session_id() != $_SESSION["logged"]["session_id"]) {
    $_SESSION["error"] = "Zaloguj się!";
    header("location: ./");
} else {
    switch ($_SESSION["logged"]["role_id"]) {
        case 1:
            $role = "logged_user";
            break;

        case 2:
            $role = "logged_moderator";
            break;

        case 3:
            $role = "logged_admin";
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard 2</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../AdminLTE-3.2.0/dist/css/adminlte.min.css">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="../AdminLTE-3.2.0/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
    <?php
    require_once "views/navbar.php";
    ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
    <?php
    require_once "views/$role/aside.php";
    ?>

  <!-- Content Wrapper. Contains page content -->
    <?php
    require_once "views/$role/content.php";
    ?>
  <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <?php
    require_once "views/footer.php";
    ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../AdminLTE-3.2.0/dist/js/adminlte.js"></script>

<!-- PAGE ../AdminLTE-3.2.0/plugins -->
<!-- jQuery Mapael -->
<script src="../AdminLTE-3.2.0/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="../AdminLTE-3.2.0/plugins/raphael/raphael.min.js"></script>
<script src="../AdminLTE-3.2.0/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../AdminLTE-3.2.0/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="../AdminLTE-3.2.0/plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="../AdminLTE-3.2.0/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../AdminLTE-3.2.0/dist/js/pages/dashboard2.js"></script>
</body>
</html>
