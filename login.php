<!-- login page -->
<?php

$selected = 'login';
include('include/header.php');

if (isset($_SESSION['user_id'])) {
    header('location:index.php');
    exit;
} ?>

<?php if (isset($_GET["success"])) { ?>
    <div class="AlertMessage">
        <div class="alert alertsuccess">
            <?php echo  '<p">' . $_GET["success"] . '</p>'; ?>
        </div>
    </div>
<?php }

$email = '';
$password = '';
$errors = [];

//check if the username and password at the input is exist in the databese
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    //check if the username is empty or the password is empty , if empty inputs sending error alert
    if (empty($username)) {

        $errors[] = 'you should enter username ';
    }
    if (empty($password)) {
        $errors[] = 'you should enter password ';
    }
    //check if there was no error 
    //checking the password with the sha1 password in database (the secured password)
    if (empty($errors)) {

        $password = sha1($_POST['password']);
        
    //get all users whose status is 1 thats mean 1=active
        $sql = $con->prepare("SELECT * FROM users WHERE username = ? AND password=? and status=1");
        $sql->execute(array($username, $password));

        $count = $sql->rowCount();

        if ($count > 0) {
            $user = $sql->fetch();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['image'] = $user['image'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['linces'] = $user['linces'];
//if the role == admin open admin page
            if ($user['role'] == 'admin') {

                header('Location:admin/dashborad.php');
                exit;
                die;
            }
            //if the role == worker open worker page
            else if ($user['role'] == 'worker') {

                header('Location:admin/dashborad.php');
                exit;
                die;
            }
            //if the role not admin or worker thats mean the role is user then open index page (the main page)
            header("Location: index.php");
            exit;
        }
    } else {
        $errors[] = "there is some errors try again";
    }
}
?>

<?php
//if there is an errot 
//loop threw error and send Corresponding error message
if ($errors) {
    foreach ($errors as $error) {
?>
        <div class="AlertMessage">
            <div class="alert alertError">
                <?php echo  '<p">' . $error . '</p>'; ?>
            </div>
        </div>
<?php }
} ?>

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="Free HTML Templates" name="keywords" />
    <meta content="Free HTML Templates" name="description" />

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Rubik&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet" />

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet" />
</head>
<div class="login-wrapper">

    <div class="login-form">
        <h1 style="color:white;">LOGIN</h1>

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" autocomplete="off">
            <input type="text" placeholder="username" name="username" id="">
            <input type="password" placeholder="password" name="password" autocomplete="new-password">
            <input type="submit" name="Login" value="Log In">
            <div class="rememberMe">
                <p>Remember me ?</p>
                <input type="checkbox" name="remember">
            </div>

            <p style="margin-bottom: 15px;">dont have an account?<a href="register.php"> create one now!</a></p>
        </form>
    </div>

</div>

<?php
include('include/footer.php');

