<!-- get the users from database that the role is admin/worker  by id -->

<?php $selected = "admin";
require_once "include/header.php";

$sql = $con->prepare("select * from users where id=?");
$sql->execute(array($_SESSION['user_id']));
$user = $sql->fetch();


$username = $user['username'];
$name = $user['name'];
$email = $user['email'];
$address = $user['address'];
$phone = $user['phone'];
$dateofbirthday = $user['dateofbirthday'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $dateofbirthday = $_POST['dateofbirthday'];

    $password = $_POST['password'];
    $data = '';
    // if it was empty the password can be as it was 
    if ($password) {
        $sq = $con->prepare('update users set password=? where id=?');
        $sq->execute(array(sha1($password), $_SESSION['user_id']));
    }

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
        $image = $user['image'];
        if ($_FILES['image']['name']) {
            if (file_exists("../images/users/" . $_FILES['image']['name'])) {
                unlink("../images/users/" . $user['image']);
            }
            $image = time() . '-' . $_FILES['image']['name'];
            move_uploaded_file($_FILES["image"]["tmp_name"], '../images/users/' . $image);
        }
        // here we can update all details for user
        $sql = $con->prepare("update users set username=?,name=?,email=?,
    address=?,phone=?,dateofbirthday=?,image=? where id=?");
        $sql->execute(array(
            $username, $name, $email,
            $address, $phone, $dateofbirthday, $image, $_SESSION['user_id']
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
            <?php echo  '<p">Updating Successfully</p>'; ?>
        </div>
    </div><br><br><br>
<?php } ?>

<div class="Admin-Wrapper">
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="Admin-Content" enctype="multipart/form-data" autocomplete="off">
        <div class="leftSide">
            <!-- here we can change the photo -->
            <img src="../images/users/<?php echo $user['image'] ?>" id="imageOnChange" alt="">
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

            <input type="submit" style="background-color:#00A78E" name="AddVehicle" value="Update profile" placeholder="Quantity">
        </div>
    </form>
</div>
