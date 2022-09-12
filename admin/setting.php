<!-- get the settings from database by id -->
<?php
$selected = 'dashboradAdd';
include("include/header.php");
$stmt = $con->prepare("select * from    settings where id=1 limit 1");
$stmt->execute();
$count = $stmt->rowCount();
if ($count > 0) {
    $setting = $stmt->fetch();
}

$name = $setting['name'];
$email = $setting['email'];
$phone = $setting['phone'];
$whatsapp = $setting['whatsapp'];
$facebook = $setting['facebook'];
$instagram = $setting['instagram'];
$address = $setting['address'];
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $whatsapp = $_POST['whatsapp'];
    $facebook = $_POST['facebook'];
    $instagram = $_POST['instagram'];
    $address = $_POST['address'];

    if (empty($name)) {
        $errors[] = 'you should enter name';
    }
    if (empty($email)) {
        $errors[] = 'you should enter email';
    }
    if (empty($phone)) {
        $errors[] = 'you should enter phone';
    }
    if (empty($whatsapp)) {
        $errors[] = 'you should enter whatsapp';
    }
    if (empty($facebook)) {
        $errors[] = 'you should enter facebook';
    }
    if (empty($instagram)) {
        $errors[] = 'you should enter instagram';
    }
    if (empty($address)) {
        $errors[] = 'you should enter address';
    }

    if (empty($errors)) {

        $logo = $setting['logo'];
        if (isset($_FILES['image'])) {
            if (file_exists('../images/' . $logo)) {
                unlink('../images/' . $logo);
            }
            $logo = time() . '-' . $_FILES['image']['name'];
            move_uploaded_file($_FILES["image"]["tmp_name"], '../images/' . $logo);
        }
        //updating the settings on database 
        $sql = $con->prepare("update settings  set name=?,email=?,phone=?,whatsapp=?,facebook=?,instagram=?,address=?,logo=? where id=1");
        $sql->execute(array($name, $email, $phone, $whatsapp, $facebook, $instagram, $address, $logo));
        header('location:setting.php?success=2');
    }
}
if ($errors) {
    foreach ($errors as $error) {
?>
        <div class="AlertMessage">
            <div class="alert alertError">
                <?php echo  '<p">' . $error . '</p>'; ?>
            </div>
        </div><br><br>
<?php }
} ?>
<style>.file {
  opacity: 0;
  width: 0.1px;
  height: 0.1px;
  position: absolute;
}

.file-input label {
  display: block;
  position: relative;
  width: 200px;
  height: 20px;
  border-radius: 25px;
  background: #00A78E;
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
}</style>

<div class="data">
    <div class="items">
        <div class="header">
            <h1>SETTING</h1>
        </div>
        <?php
        if (isset($_GET['success']) && $_GET['success'] == 2) {
        ?>
            <div class="AlertMessage">
                <div class="alert alertsuccess">
                    UPDATING SUCCESSFULLY
                </div>
            </div><br><br><br><br><br><br>
        <?php } ?>
        <div class="text-center">
            <img src="../images/<?php echo $setting['logo'] ?>" widht="100px" height="100px" style="margin-left: 34%;margin-top: 21px;">
            <form style="margin-left:47%"  action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                <input type="text" style="text-align:center" id="name" name="name" value="<?php echo $setting['name'] ?>" require>
                <input type="text" id="email" style="text-align:center" name="email" value="<?php echo $setting['email'] ?>" require>
                <input type="text" id="address" style="text-align:center" name="address" value="<?php echo $setting['address'] ?>" require>
                <input type="number" id="phone" style="text-align:center" name="phone" value="<?php echo $setting['phone'] ?>" require>
                <input type="text" id="whatsapp" style="text-align:center" name="whatsapp" value="<?php echo $setting['whatsapp'] ?>" require>
                <input type="text" id="facebook" style="text-align:center" name="facebook" value="<?php echo $setting['facebook'] ?>" require>
                <input type="text" id="instagram" style="text-align:center" name="instagram" value="<?php echo $setting['instagram'] ?>" require>
                <div style="margin-left:14%" class="file-input">
  <input type="file" id="file" class="file" type="file" name="image" required>
  <label for="file" name="image">
    CHOOSE A LOGO
    <p class="file-name"></p>
  </label>
</div>
                <input type="submit" value="UPDATE SETTINGS" class="btn-post">
            </form>
        </div>
    </div>
</div>
