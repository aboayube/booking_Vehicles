<!-- we get vec_order from database -->
<?php
$selected = 'dashboradAdd';
include('include/header.php');
$stmt = $con->prepare("select * from vec_order ");
$stmt->execute();
$data = $stmt->fetchAll();
$user = [];
$vehicles_id = [];

foreach ($data as $da) {
    $user[] = $da['user_id'];
    $vehicles_id[] = $da['vehicles_id'];
}
$vehicles_id = array_unique($vehicles_id);
$user = array_unique($user);
$note = '';
$space = '';
$user_id  = '';
$vehicle   = '';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $note = $_POST['note'] ?? '';
    $space = $_POST['space'];
    $vehicle = $_POST['vehicles_id'];
    $user_id = $_POST['user_id'];

    if (empty($space)) {
        $errors[] = 'You Should Enter A Space';
    }
    if(empty($note)){
        $errors[]='You Should Enter A Note';
    }
    if (empty($errors)) {
    // get the allow_km from vehicles by LicenseNum 
        $st = $con->prepare("select allow_km from vehicles where LicenseNum =?");
        $st->execute(array($vehicle));
        $allow = $st->fetch();
        //when do checkout updating vehicle quantity to 1
        $sql = $con->prepare("update vehicles set quantity = 1 where LicenseNum = '$vehicle'");
        $sql->execute();
       
//We check how many km the customer did , and we get from database the allow km from vehicles by LicenseNum
// and check if the space that the customer did was higher than the allow km.
//if space higher than allow km we calculate for every 1000 km more 100 shekel fine
// and send notification for the customer that he does it the reciept.
        if ($space > $allow['allow_km']) {
            $value = $space - $allow['allow_km'];
            $count = $value / 1000;
            $sum = $count * 100;
            $sql3 = $con->prepare('INSERT INTO
          `notification`
          (`to_id`, `title`, `message`, `from_user`) 
         VALUES (?,?,?,?) ');
            $sql3->execute(array($user_id, 'You have exceeded the permitted kilometer','You Should to pay '  . $sum, $_SESSION['user_id']));
           
        }
        //insert into receipt_vehicles the details we add
        $stmt = $con->prepare("INSERT INTO `receipt_vehicles`(
        `vehicles_id`, `user_id`, `space`, `note`, `worker_name`)
     VALUES (?,?,?,?,?)");
        $stmt->execute(array($vehicle, $user_id, $space, $note, $_SESSION['name']));

        header("Location:receipt_vehicles.php");

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
            <h1>INSERT DETAILS </h1>
        </div>
        <div class="text-center">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" style="margin-left:250px">
                <label for="">VEHICLE DETAILS</label>
                <select name="vehicles_id">
                <!-- here shows all vehicles_id  from database , goes on a loop  -->

                    <?php
                    // loop threw vehicles from vec_order
                    foreach ($vehicles_id as $vehicle) {
                    ?>
                        <option value="<?php echo $vehicle ?>"><?php
                                                               //get the details of the vehicles from vehicles table
                                                                $stmt = $con->prepare("select LicenseNum , v_name , VType from vehicles where LicenseNum =" . $vehicle);
                                                                $stmt->execute();
                                                                $data = $stmt->fetch();
                                                                echo $data['VType'].' '.$data['v_name'].' '.$data['LicenseNum']; ?></option>
                    <?php }
                    ?>
                </select>
                <label for="">CUSTOMER NAME</label>
                <select name="user_id">
                    <?php
                  // loop threw users
                    foreach ($user  as $ue) {

                    ?>
                    <!-- get the name of customer by id from users table  -->
                        <option value="<?php echo $ue ?>"><?php
                                                            $stmt = $con->prepare("select name , id , LicenseNum from users where id =" . $ue);
                                                            $stmt->execute();
                                                            $data = $stmt->fetch();
                                                            echo $data['id'].' '. $data['name']; ?></option>
                    <?php }
                    ?>
                </select>

                <label for="fname"> KM</label>
                <input type="text" id="space" name="space" value="<?php echo $space ?>">
                <label for="fname"> NOTE</label>
                <textarea name="note"><?php echo $note ?></textarea>
                <input type="submit" value="INSERT" class="btn-post">
            </form>

        </div>
    </div>

</div>
