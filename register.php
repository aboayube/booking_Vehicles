<?php $selected = "register";
require_once "include/header.php";
//vairables
$username = '';
$email = '';
$password = '';
$Address = '';
$DateOfBirth = '';
$Phone = '';
$LicenseNum = '';
$linces = '';
$errors = [];
$image = '';
//checking if all the inputs is full
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $Address = $_POST['Address'];
    $DateOfBirth = $_POST['DateOfBirth'];
    $Phone = $_POST['Phone'];
    $linces = $_POST['linces'];
    $LicenseNum = $_POST['LicenseNum'];
//checking if the inputs are empty , if the inputs are empty sending error alert
    if (empty($username)) {
        $errors[] = 'you should enter username';
    }
    if (empty($email)) {
        $errors[] = 'you should enter email';
    }
    if (empty($password)) {
        $errors[] = 'you should enter password';
    }
    if (empty($Address)) {
        $errors[] = 'you should enter Address';
    }
    if (empty($DateOfBirth)) {
        $errors[] = 'you should enter DateOfBirth';
    }
    if (empty($Phone)) {
        $errors[] = 'you should enter Phone';
    }
    if (empty($LicenseNum)) {
        $errors[] = 'you should enter LicenseNum';
    }
    if (empty($linces)) {
        $errors[] = 'you should enter linces';
    }
    if (empty($errors)) {
        $password = sha1($_POST['password']);
        $image = $_FILES['image']['name'];

//this function time is take the time when  upload the photo for mileseconds with image name  
        $cv = time() . '-' . $_FILES['image']['name'];
//uploaded the image 
        move_uploaded_file($_FILES["image"]["tmp_name"], 'images/users/' . $cv);

//When the user registers and fills in all the fields, the values enter the user table,but with role users because only customer can do registeration
        $sql = $con->prepare("INSERT INTO `users`
( `name`, `username`, `email`, `password`, `role`,
 `status`, `linces`, `address`, `phone`, `image`, `dateofbirthday`,`LicenseNum`) 
    VALUES (?,?,?,?,'users','1',?,?,?,?,?,?)");

        $sql->execute(array(
            $username, $username, $email, $password,
            $linces, $Address, $Phone, $cv, $DateOfBirth, $LicenseNum
        ));

        $user = $sql->rowCount();
//thats check if the user is active checking all the fields in the database and after that go to the main page(index.php)
        if ($user == 1) {
            $stmt = $con->prepare("select * from users where id =?");
            $stmt->execute(array($con->lastInsertId()));
            $user = $stmt->fetch();

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['image'] = $user['image'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['linces'] = $user['linces'];
            header("Location: index.php");
        } else {
            $errors = '';
        }
    } else {
        echo 'no';
    }
}
?>
<!-- if having an error, displays error alert -->
<?php if (isset($_GET["error"])) { ?>
    <div class="AlertMessage">
        <div class="alert alertError">
            <?php echo  '<p">' . $_GET["error"] . '</p>'; ?>
        </div>
    </div>
<?php } ?>
<!-- if all is good , displays success alert -->
<?php if (isset($_GET["success"])) { ?>
    <div class="AlertMessage">
        <div class="alert alertsuccess">
            <?php echo  '<p">' . $_GET["success"] . '</p>'; ?>
        </div>
    </div>
<?php } ?>
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="Free HTML Templates" name="keywords" />
    <meta content="Free HTML Templates" name="description" />

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Rubik&display=swap"
      rel="stylesheet"
    />

    <!-- Font Awesome -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css"
      rel="stylesheet"
    />

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
    <link
      href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css"
      rel="stylesheet"
    />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet" />
    <style>
.file {
  opacity: 0;
  width: 0.1px;
  height: 0.1px;
  position: absolute;
}

.file-input label {
  display: block;
  position: relative;
  width: 200px;
  height: 50px;
  border-radius: 25px;
  background: linear-gradient(40deg,#0A2749,#e69138);
  box-shadow: 0 4px 7px rgba(0, 0, 0, 0.4);
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  font-weight: bold;
  cursor: pointer;
  transition: transform .2s ease-out;
}

.file-name {
  position: absolute;
  bottom: -35px;
  left: 10px;
  font-size: 0.85rem;
  color: #555;
}

input:hover + label,
input:focus + label {
  transform: scale(1.02);
}

/* Adding an outline to the label on focus */
input:focus + label {
  outline: 1px solid #000;
  outline: -webkit-focus-ring-color auto 2px;
}
html,body {height:100%;}

.captcha {
    background-color:#f9f9f9;
    border:2px solid #d3d3d3;
    border-radius:5px;
    color:#4c4a4b;
    display:flex;
    justify-content:center;
    align-items:center;
}

@media screen and (max-width: 500px) {
    .captcha {
        flex-direction:column;
    }
    .text {
        margin:.5em!important;
        text-align:center;
    }
    .logo {
        align-self: center!important;
    }
    .spinner {
        margin:2em .5em .5em .5em!important;
    }
}

.text {
    font-size:1.75em;
    font-weight:500;
    margin-right:1em;
}
.spinner {
    position:relative;
    width:1em;
    height:0.1em;
    display:flex;
    margin:2em 1em;
    align-items:center;
    justify-content:center;
}
input[type="checkbox"] { position: absolute; opacity: 0; z-index: -1; }
input[type="checkbox"]+.checkmark {
    display:inline-block;
    width:2em;
    height:2em;
    background-color:#fcfcfc;
    border:2.5px solid #c3c3c3;
    border-radius:3px;
    display:flex;
    justify-content:center;
    align-items:center;
    cursor: pointer;
}
input[type="checkbox"]+.checkmark span {
    content:'';
    position:relative;
    margin-top:-3px;
    transform:rotate(45deg);
    width:.75em;
    height:1.2em;
    opacity:0;
}
input[type="checkbox"]+.checkmark>span:after {
    content:'';
    position:absolute;
    display:block;
    height:3px;
    bottom:0;left:0;
    background-color:#029f56;
}
input[type="checkbox"]+.checkmark>span:before {
    content:'';
    position:absolute;
    display:block;
    width:3px;
    bottom:0;right:0;
    background-color:#029f56;
}
input[type="checkbox"]:checked+.checkmark { 
    animation:2s spin forwards;
}
input[type="checkbox"]:checked+.checkmark>span { 
    animation:1s fadein 1.9s forwards;
}
input[type="checkbox"]:checked+.checkmark>span:after {animation:.3s bottomslide 2s forwards;}
input[type="checkbox"]:checked+.checkmark>span:before {animation:.5s rightslide 2.2s forwards;}
@keyframes fadein {
    0% {opacity:0;}
    100% {opacity:1;}
}
@keyframes bottomslide {
    0% {width:0;}
    100% {width:100%;}
}
@keyframes rightslide {
    0% {height:0;}
    100% {height:100%;}
}
.logo {
    display:flex;
    flex-direction:column;
    align-items:center;
    height:100%;
    align-self:flex-end;
    margin:0.5em 1em;
}
.logo img {
    height:2em;
    width:2em;
}
.logo p {
    color:#9d9ba7;
    margin:0;
    font-size:1em;
    font-weight:700;
    margin:.4em 0 .2em 0;
}
.logo small {
    color:#9d9ba7;
    margin:0;
    font-size:.8em;
}
@keyframes spin {
    10% {
        width:0;
        height:0;
        border-width:6px;
    }
    30% {
        width:0;
        height:0;
        border-radius:50%;
        border-width:1em;
        transform: rotate(0deg);
        border-color:rgb(199,218,245);
    }
    50% {
        width:2em;
        height:2em;
        border-radius:50%;
        border-width:4px;
        border-color:rgb(199,218,245);
        border-right-color:rgb(89,152,239);
    }
    70% {
        border-width:4px;
        border-color:rgb(199,218,245);
        border-right-color:rgb(89,152,239);
    }
    90% {
        border-width:4px;
    }
    100% {
        width:2em;
        height:2em;
        border-radius:50%;
        transform: rotate(720deg);
        border-color:transparent;
    }
}
::selection {
    background-color:transparent;
    color:teal;
}
::-moz-selection {
    background-color:transparent;
    color:teal;
}
        </style>
  </head>
<div class="register-wrapper">

    <div class="register-form">
        <h1 style="color:white;">REGISTER</h1>

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off" enctype="multipart/form-data">
            <input type="text" name="username" placeholder="username" required>
            <input type="text" name="email" placeholder="email" required>
            <input type="password" name="password" placeholder="password" required>
            <input type="text" name="Address" placeholder="Address" required>
            <input type="text" name="DateOfBirth" placeholder="DateOfBirth" required>
            <input type="text" name="Phone" placeholder="Phone" required>
            <input type="text" name="LicenseNum" placeholder="LicenseNum" required>
            <div style="display:flex;justify-content: space-between;">
                License Rank:
                <select name="linces" style="width:148px;height:35px;margin-left:11px" required>
                    <?php
                    $sql = $con->prepare('select * from lincenesrank');
                    $sql->execute();
                    $lins = $sql->fetchAll();
                    foreach ($lins as $lin) {
                        echo '<option value="' . $lin['id'] . '">' . $lin['code'] . '</option>';
                    }

                    ?>
                </select>
            </div>

            <div class="file-input">
  <input type="file" id="file" class="file" required>
  <label for="file">
    Choose a photo
    <p class="file-name"></p>
  </label>
</div>
<!-- captcha to check its Not A robot  -->
<div class="captcha">
    <div class="spinner">
        <label required>
            <input type="checkbox" onclick="$(this).attr('disabled','disabled');">
            <span class="checkmark"><span>&nbsp;</span></span>
        </label>
    </div>
    <div class="text" required>
        not robot
    </div>
    <div class="logo">
        <img src="https://forum.nox.tv/core/index.php?media/9-recaptcha-png/"/>
        </div>
</div>
            <input type="submit" name="Register" value="Register">
            <?php
            if (isset($_GET["error"])) {
                echo  '<p style="color:red;">' . $_GET["error"] . '</p>';
            }
            ?>
            <p style="margin-bottom: 15px;">already have an account?<a href="login.php"> login now</a></p>
        </form>
    </div>

</div>

<?php require_once "include/footer.php" ?>
