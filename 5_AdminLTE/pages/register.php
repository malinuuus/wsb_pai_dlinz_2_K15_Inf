<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Rejestracja użytkownika</p>

      <form action="../scripts/register.php" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Podaj imię" name="firstName">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

          <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Podaj nazwisko" name="lastName">
              <div class="input-group-append">
                  <div class="input-group-text">
                      <span class="fas fa-user"></span>
                  </div>
              </div>
          </div>

        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Podaj email" name="email1">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

          <div class="input-group mb-3">
              <input type="email" class="form-control" placeholder="Powtórz email" name="email2">
              <div class="input-group-append">
                  <div class="input-group-text">
                      <span class="fas fa-envelope"></span>
                  </div>
              </div>
          </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Podaj hasło" name="pass1">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Powtórz hasło" name="pass2">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

          <div class="input-group mb-3">
              <input type="date" class="form-control" name="birthday">
              <div class="input-group-append">
                  <div class="input-group-text">
                      <span class="fas fa-calendar"></span>
                  </div>
              </div>
          </div>

          <div class="input-group mb-3">
              <select name="city_id" class="form-control select2bs4">
                  <?php
                  require_once "../scripts/connect.php";
                  $result = $conn->query("SELECT id, city FROM cities");

                  while ($city = $result->fetch_assoc()) {
                      echo "<option value='$city[id]'>$city[city]</option>";
                  }
                  ?>
              </select>
              <div class="input-group-append">
                  <div class="input-group-text">
                      <span class="fas fa-city"></span>
                  </div>
              </div>
          </div>

        <div class="row">
          <div class="col-7">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               Zatwierdź <a href="#">regulamin</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-5">
            <button type="submit" class="btn btn-primary btn-block">Rejestracja</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>

      <a href="login.html" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

<?php
if (isset($_SESSION["success"])) {
    echo <<< SCRIPT
        <script>
            $(document).Toasts('create', {
                class: 'bg-success',
                title: 'Sukces',
                body: '$_SESSION[success]',
                autohide: true,
                delay: 4000,
                icon: 'fas fa-check'
            });
        </script>
    SCRIPT;
    unset($_SESSION["success"]);
} else if (isset($_SESSION["error"])) {
    echo <<< SCRIPT
        <script>
            $(document).Toasts('create', {
                class: 'bg-warning',
                title: 'Uwaga',
                body: '$_SESSION[error]',
                autohide: true,
                delay: 4000,
                icon: 'fas fa-exclamation-triangle'
            });
        </script>
    SCRIPT;
    unset($_SESSION["error"]);
}
?>

</body>
</html>
