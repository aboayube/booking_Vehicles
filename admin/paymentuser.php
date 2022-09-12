<!-- get the vehicles from database by id and user id and payment id  -->

<?php
$selected = 'dashborad';
include('include/header.php');

$sql = $con->prepare("select vehicles.*,vec_order.*,users.name as username, payment.*
 from users,payment,vehicles,vec_order
 where
 payment.user_id=users.id 
 and
 vec_order.vehicles_id =vehicles.LicenseNum 
 and
 vec_order.id= payment.user_vehicles_id
 order by payment.id DESC");
$sql->execute();
$payments = $sql->fetchAll();
?><div class="data">
    <div class="items">
        <div class="header">
            <h1 class="">PAYMENTS MANAGMENT</h1>
        </div>
        <table id="customers">
            <tr>
                <th style="text-align:center;">ID</th>
                <th style="text-align:center;">Vehicle LicenseNum</th>
                <th style="text-align:center;">Image</th>
                <th style="text-align:center;">Customer Name</th>
                <th style="text-align:center;">Price</th>
                <th style="text-align:center;">Paid</th>
                <th style="text-align:center;">Payment Method</th>
                <th style="text-align:center;">Payments</th>
            </tr>
             <!-- here shows all payments  from database , goes on a loop on details -->

            <?php
            foreach ($payments as $payment) {

            ?>
                <tr>
                    <td style="text-align:center;"><?php echo $payment['id'] ?></td>
                    <td style="text-align:center;"><?php echo $payment['LicenseNum'] ?></td>
                    <td style="text-align:center;"><img src="../images/vehicles/<?php echo $payment['image'] ?>" width="100px" height="100px"></td>
                    <td style="text-align:center;"><?php echo $payment['username'] ?></td>
                    <td style="text-align:center;"><?php echo $payment['price'] ?>₪</td>
                    <td style="text-align:center;"><?php echo $payment['Paid'] ?></td>
                    <td style="text-align:center;"><?php echo $payment['payment'] ?></td>
                    <td style="text-align:center;"><?php echo $payment['number_pay'] ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
