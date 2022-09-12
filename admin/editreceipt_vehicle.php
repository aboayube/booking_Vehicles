<!-- get the receipt_vehicles from database  by id -->

<?php
$selected = 'dashborad';
include('include/header.php');

$stmt = $con->prepare("select * from receipt_vehicles where id =?");
$stmt->execute(array($_GET['id']));
$data = $stmt->fetch();

$note = '';
$space = '';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $note = $_POST['note'] ?? '';
    $space = $_POST['space'];

    if (empty($space)) {
        $errors[] = 'you should enter space';
    }
    if (empty($errors)) {
        //When The Worker Or Manager check the Vehicle 
        $st = $con->prepare("select allow_km from vehicles where LicenseNum =?");
        $st->execute(array($_GET['vehicle_id']));
        $allow = $st->fetch();

//We check how many km the customer did , and we get from database the allow km from vehicles by LicenseNum
// and check if the space that the customer did was higher than the allow km.
//if space higher than allow km we calculate for evrey 1000 km more 100 shekel fine
// and send notification for the customer that he does it the reciept.
        if ($space > $allow['allow_km']) {

            $value = $space - $allow['allow_km'];

            $count = $value / 1000;

            $sum = $count * 100;
            $sql3 = $con->prepare('INSERT INTO
          `notification`
          (`to_id`, `title`, `message`, `from_user`) 
         VALUES (?,?,?,?) ');
            $sql3->execute(array($data['user_id'], 'You have exceeded the permitted kilometer','You Should to pay ' . $sum, $_SESSION['user_id']));
            $sql3->execute();
        }
        //here can edit the reciept by id if thats wrong.
        $stmt = $con->prepare("update `receipt_vehicles` set `space`=?, `note`=? where id =?");
        $stmt->execute(array($space, $note, $id));
        header("Location:receipt_vehicles.php");

// after editing insert the new reciept to database and check another time the space and allow km 
//if the space higher than allow_km he get a fine 
        $sql = $con->prepare("insert into notification  ( `from_user`,`to_id`, `message`,`title`) values (?,?,?,?)");
        $sql->execute(array($_SESSION['name'], $data['user_id'], $message, $title));
        header('location:notifications.php?success=1');
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
<div class="data">
    <div class="items">
        <div class="header">
            <h1>Edit Details</h1>
        </div>
        <div class="text-center">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" style="margin-left:250px">
                <label for="fname"> Space</label>
                <input type="text" id="space" name="space" value="<?php echo $data['space'] ?>">
                <label for="fname"> Note</label>
                <textarea name="note"><?php echo $data['note'] ?></textarea>
                <input type="submit" value="Edit">
            </form>

        </div>
    </div>

</div>
