<!-- get the users from database that the role is users by id -->
<?php
ob_start();
$selected = "admin";
require_once "include/header.php";
$sql = $con->prepare("select * from users where id=?");
$sql->execute(array($_SESSION['user_id']));
$user = $sql->fetch();
$username = $user['username'];
$name = $user['name'];
$email = $user['email'];
$linces = $user['linces'];
$address = $user['address'];
$phone = $user['phone'];
$LicenseNum = $user['LicenseNum'];
$dateofbirthday = $user['dateofbirthday'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $linces = $_POST['linces'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $LicenseNum = $_POST['LicenseNum'];
    $dateofbirthday = $_POST['dateofbirthday'];
    $password = $_POST['password'];
    $data = '';
    // if it was empty the password can be as it was 
    if ($password) {
        $sq = $con->prepare('update users set password=? where id=?');
        // the password is secured by sha1
        $sq->execute(array(sha1($password), $_SESSION['user_id']));
    }
    //check if the inputs is empty and if the inputs is empty sending error message
    if (empty($username)) {
        $errors[] = 'you should enter username';
    }
    if (empty($address)) {
        $errors[] = 'you should enter address';
    }
    if (empty($phone)) {
        $errors[] = 'you should enter phone';
    }
    if (empty($errors)) {

        $linces = implode(',', $linces);

        $image = $user['image'];
        if ($_FILES['image']['name']) {
            if (file_exists("../images/users/" . $_FILES['image']['name'])) {
                unlink("../images/users/" . $user['image']);
            }
            $image = time() . '-' . $_FILES['image']['name'];

            move_uploaded_file($_FILES["image"]["tmp_name"], 'images/users/' . $image);
        }
         // here we can update all details for user
        $sql = $con->prepare("update users set username=?,name=?,email=?,linces=?,
    address=?,phone=?,dateofbirthday=?,image=?,LicenseNum=?  where id=?");

        $sql->execute(array(
            $username, $name, $email, $linces,
            $address, $phone, $dateofbirthday, $image, $LicenseNum, $_SESSION['user_id']
        ));
        header("location:editprofile.php?success=2");
    }
}
?>
<?php if (isset($_GET["error"])) { ?>
    <div class="AlertMessage">
        <div class="alert alertError">
            <?php echo  '<p">' . $_GET["error"] . '</p>'; ?>
        </div>
    </div>
<?php } ?>

<?php if (isset($_GET["success"])) { ?>
    <div class="AlertMessage">
        <div class="alert alertsuccess">
            <?php echo  '<p">update successfly</p>'; ?>
        </div>
    </div><br><br><br><br><br>
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
  </head>
</br>
<h1 style="
    font-size: 50px;
    text-align:center;
    font-family: 'Brush Script MT', cursive;">PROFILE</h1>
    
<div class="Admin-Wrapper">
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="Admin-Content" enctype="multipart/form-data" autocomplete="off">
        <div class="leftSide">
             <!-- here we can change the photo -->
            <img src="images/users/<?php echo $user['image'] ?>" id="imageOnChange" alt="">
            <input type="file" name="image" id="file" onchange="loadFile(event)">
            <label for="file"></label>
        </div>

        <div class="RightSide">
            <input type="text" name="name" placeholder="name" value="<?php echo $user['name'] ?>">
            <input type="text" name="username" placeholder="username" value="<?php echo $user['username'] ?>">
            <input type="text" name="email" placeholder="email" value="<?php echo $user['email'] ?>">
            <input type="password" name="password" placeholder="password">
            <input type="text" name="address" placeholder="address" value="<?php echo $user['address'] ?>">
            <input type="text" name="phone" placeholder="phone" value="<?php echo $user['phone'] ?>">
            <input type="text" name="dateofbirthday" placeholder="dateofbirthday" value="<?php echo $user['dateofbirthday'] ?>">
            <input type="text" name="LicenseNum" placeholder="LicenseNum" value="<?php echo $user['LicenseNum'] ?>">
            <div style="display:flex;justify-content: space-between;">
                <span style="color:white">License Rank</span>
                <select name="linces[]" style="width:220px;margin-left:50px" multiple="multiple">
                    <?php
                    //get all the license ranks from database
                    $sql = $con->prepare('select * from lincenesrank');
                    $sql->execute();
                    $lins = $sql->fetchAll();
                    // loop threw license rank and the user can add many icense rank and insert the license rank id to the array
                    foreach ($lins as $lin) {
                        echo '<option value="' . $lin['id'] . '" ';
                        if (in_array($lin['id'], explode(',', $user['linces']))) {
                            echo 'selected';
                        }
                        echo '>' . $lin['code'] . '</option>';
                    }

                    ?>
                </select>
            </div>
            <input type="submit" style="background-color:#353A4F" name="AddVehicle" value="Update profile" placeholder="">
        </div>
    </form>
</div>

<?php require_once "include/footer.php";
ob_end_flush();

?>
