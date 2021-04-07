<!DOCTYPE html>
<html lang="en">

<?php
  require 'dbconnect.php';
  session_start();

  if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = $conn->prepare("SELECT * FROM users WHERE username=? and password= ?");
    $query->bind_param("ss", $username, $password);
    $query->execute();
    $result = $query->get_result();

    if($result->num_rows == 1) {    
      while ($data = $result->fetch_assoc()) {
          $_SESSION['user'] = $data['username'];
      }
    }

  }
?>
<head>
  <title>Login</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/3.3/examples/jumbotron-narrow/jumbotron-narrow.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<div class="container">
  <div class="header">
    <nav>
      <ul class="nav nav-pills pull-right">
        <li role="presentation" class="active"><a href="/webbanhang/">Home</a>
        </li>
        <li role="presentation"><a href="/webbanhang/register.php" class="btn btn-link pull-right">Register</a>
        </li>
      </ul>
    </nav>
    <h3 class="text-muted">Login</h3>
  </div>

  <div class="jumbotron">
    <p class="lead"></p>
    <div class="login-form">
      <form role="form" action="/webbanhang/login.php" method="post">
        <div class="form-group">
          <input type="text" name="username" id="email" class="form-control input-lg" placeholder="Username">
        </div>
        <div class="form-group">
          <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password">
        </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <input type="submit" class="btn btn-lg btn-success btn-block" value="Sign In">
      </div>
    </div>
    </form>
    <?php
      if(isset($_SESSION['user'])) {
        echo "<script>alert('Đăng nhập thành công!!'); window.location='http://localhost/webbanhang/index.php';</script>";
      }
    ?>
  </div>

</div>
</body>

</html>