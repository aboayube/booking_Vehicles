<!-- get the receipt_vehicles from database by id and user id   -->

<?php
$selected = 'dashborad';
include('include/header.php');

$sql = $con->prepare("select receipt_vehicles.*,
vehicles.LicenseNum  as vehicles_LicenseNum ,vehicles.image as vehicles_image,
 users.name as user_name 
 from receipt_vehicles,users ,vehicles
 where receipt_vehicles.user_id=users.id  
and 
receipt_vehicles.vehicles_id= vehicles.LicenseNum 
  order by receipt_vehicles.id DESC");
$sql->execute();
$receipt_vehicles = $sql->fetchAll();
?>

<div class="data">
    <div class="items">
        <div class="header" style="">
            <h1 style=" margin-left: 33px;">CHECKOUTS</h1>
            <a href="add_receipt_vehicles.php"><img src="../images/Plus.png"></a>
        </div>

<!--here we have alert for every update we do  -->

        <?php
        if (isset($_GET['success'])) {
            if ($_GET['success'] == 1) {
        ?>
                <div class="AlertMessage">
                    <div class="alert alertError">
                        Added Successfully
                    </div>
                </div><br><br><br><br><br><br>
            <?php }
            if ($_GET['success'] == 2) {
            ?>
                <div class="AlertMessage">
                    <div class="alert alertError">
                        Updated Successfully
                    </div>
                </div><br><br><br><br><br><br>
            <?php }
            if ($_GET['success'] == 3) {
            ?>
                <div class="AlertMessage">
                    <div class="alert alertError">
                        Deleted Successfully
                    </div>
                </div><br><br><br><br><br><br>
        <?php }
        } ?>
        <table id="customers" style="
        margin-bottom: 155px; width:90%">
            <tr style="color:red">
                <th style="text-align:center;">ID</th>
                <th style="text-align:center;">Vehicle LicenseNum</th>
                <th style="text-align:center;">Image</th>
                <th style="text-align:center;">Customer Details</th>
                <th style="text-align:center;">Note</th>
                <th style="text-align:center;">Space</th>
                <th style="text-align:center;">Worker</th>
                <th style="text-align:center; width:50px">Action</th>
            </tr>
                             <!-- here shows all licenses  from database , goes on a loop and get who edit/delete this -->

            <?php
            foreach ($receipt_vehicles as $receipt_vehicle) {
            ?>
                <tr style="background: #fff;">
                    <td style="text-align:center;"><?php echo $receipt_vehicle['id'] ?></td>
                    <td style="text-align:center;"><?php echo $receipt_vehicle['vehicles_LicenseNum'] ?></td>
                    <td style="text-align:center;"><img src="../images/vehicles/<?php echo $receipt_vehicle['vehicles_image'] ?>" width="100px" height="100px"></td>
                    <td style="text-align:center;"><?php echo $receipt_vehicle['id'].' '. $receipt_vehicle['user_name'] ?></td>
                    <td style="text-align:center;"><?php echo $receipt_vehicle['note'] ?></td>
                    <td style="text-align:center;"><?php echo $receipt_vehicle['space'] ?></td>
                    <td style="text-align:center;"><?php echo $receipt_vehicle['worker_name'] ?></td>
                    <!-- if he is a admin he can update or delete the licenserank -->
                    <?php
                    if ($_SESSION['role'] == 'admin' || $_SESSION['name'] == $receipt_vehicle['worker_name']) { ?>
                        <td>
                            <a class="text-center" style="display: inherit;color:#00A78E;padding-left: 21px;" href="editreceipt_vehicle.php?id=<?php echo $receipt_vehicle['id']  ?>&vehicle<?php echo $receipt_vehicle['vehicles_id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a class="text-center" style="display: inherit;color: red;padding-left: 21px;" href="deletereceipt_vehicle.php?id=<?php echo $receipt_vehicle['id']  ?>"><i class="fa-solid fa-trash-can"></i></a>
                        </td>
                    <?php } else { ?>

                        <td>No Actions</td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>

