<!DOCTYPE html>
<html lang="en">

<?php
  require 'dbconnect.php';
  session_start();

  if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm_password']) 
    && isset($_POST['full_name']) && isset($_POST['address']) && isset($_POST['phone'])) {
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $full_name = $_POST['full_name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    
    if ($password !== $confirm_password) {
        echo "<script>alert('Mật khẩu xác nhận không khớp!!'); window.location= 'http://localhost/webbanhang/register.php'</script>";
        exit();
    }

    if (!preg_match('/^[0-9]{10,}/', $phone)) {
        echo "<script>alert('Số điện thoại không đúng!!'); window.location= 'http://localhost/webbanhang/register.php'</script>";
        exit();
    }

    $query = $conn->prepare("SELECT * FROM users WHERE username=?");
    $query->bind_param("s", $username);
    $query->execute();
    $result = $query->get_result();

    if($result->num_rows == 1) {    
        echo "<script>alert('Tên người dùng đã tồn tại!!'); window.location= 'http://localhost/webbanhang/register.php'</script>";
        exit();
    }
    else {
        $query = $conn->prepare("INSERT INTO users(username, password, full_name, address, phone) VALUES(?, ?, ?, ?, ?)");
        $password = md5($password);
        $query->bind_param("sssss", $username, $password, $full_name, $address, $phone);
        $query->execute();
        echo "<script>alert('Đăng ký thành công!! Vui lòng đăng nhập nà!!'); window.location= 'http://localhost/webbanhang/login.php'</script>";
    }
  }
?>

<head>
    <title>Register</title>
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
                <li role="presentation"><a href="/webbanhang/login.php" class="btn btn-link pull-right">Login</a>
                </li>
            </ul>
        </nav>
        <h3 class="text-muted">Register</h3>
    </div>

    <div class="jumbotron">
        <p class="lead"></p>
        <div class="login-form">
            <form role="form" action="/webbanhang/register.php" method="post">
                <div class="form-group">
                    <input type="text" name="username" id="email" class="form-control input-lg" placeholder="Username">
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password">
                </div>
                <div class="form-group">
                    <input type="password" name="confirm_password" id="password" class="form-control input-lg" placeholder="Confirm Password">
                </div>
                <div class="form-group">
                    <input type="text" name="full_name" id="full_name" class="form-control input-lg" placeholder="Full name">
                </div>
                <div class="form-group">
                    <input type="text" name="address" id="address" class="form-control input-lg" placeholder="Address">
                </div>
                <div class="form-group">
                    <input type="text" name="phone" id="phone" class="form-control input-lg" placeholder="Phone">
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
                echo "<script>alert('Bạn đã đăng nhập rồi!!'); window.location='http://localhost/webbanhang/index.php';</script>";
            }
        ?>
    </div>

</div>
</body>

</html>