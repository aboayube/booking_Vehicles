<!-- get the vec_order from database by id and user id -->
<?php
$selected = 'categories';
include('include/header.php');
$sql = $con->prepare("select vec_order.*, users.name as user_name,
vehicles.LicenseNum vehicles_Num ,vehicles.image vehicles_image   from 
users,vec_order ,vehicles
where vehicles.LicenseNum =vec_order.vehicles_id 
and users.id=vec_order.user_id
order by vec_order.id DESC");
$sql->execute();
$user_vehicles = $sql->fetchAll();
?>
<style>
    .data {
        margin-top: 20px;
        padding: 20px;
        background-color: #eee;
    }
    .items {
        padding: 2px;
        background-color: #fff;
        border-radius: 20px;
        width: 79%;
        margin: auto;
    }
    .text-center {
        margin-left: 50%;
        margin-top: 50px;
    }
    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 90%;
        margin: auto;
    }
    #customers td,
    #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }
    #customers tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    #customers tr:hover {
        background-color: #ddd;
    }
    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
    }
    th {

        color: #000 !important;
        background: #F8F8FE !important;
    }
</style>
<div class="data">
    <div class="items">
        <div class="header" style="
    display: flex;
    margin-top: 29px;
    justify-content: space-around;">
            <h1 class="">CUSTOMERS ORDERS</h1>
        </div>
        <br>
        <table id="customers" style="
        margin-bottom: 155px;">
            <tr style="color:red">
                <th style="text-align:center;">ID</th>
                <th style="text-align:center;">LicenseNum</th>
                <th style="text-align:center;">Image</th>
                <th style="text-align:center;">Customer Name</th>
                <th style="text-align:center;">Customer License</th>
                <th style="text-align:center;">Pick Up</th>
                <th style="text-align:center;">Drop Day</th>
                <th style="text-align:center;">Total Price</th>
                <th style="text-align:center;">Status</th>
                <th style="text-align:center;">Action</th>
            </tr>
              <!-- here shows all customers orders  from database , goes on a loop and get who edit/delete this -->
                <!-- here can update status if status = 0 the order is pending to approve the order , if status = 1 the order is approved -->
            <?php
            foreach ($user_vehicles as $user_vehicle) {
            ?>
                <tr style="background: #fff;">
                    <td style="text-align:center;"><?php echo $user_vehicle['id'] ?></td>
                    <td style="text-align:center;"><?php echo $user_vehicle['vehicles_Num'] ?></td>
                    <td style="text-align:center;"><img src="../images/vehicles/<?php echo $user_vehicle['vehicles_image'] ?>" width="100" height="100"></td>
                    <td style="text-align:center;"><?php echo $user_vehicle['user_name'] ?></td>
                    <td style="text-align:center;"><img src="../images/license/<?php echo $user_vehicle['image_id'] ?>" width="100" height="100"></td>

                    <td style="text-align:center;"><?php echo $user_vehicle['startday'] ?></td>
                    <td style="text-align:center;"><?php echo $user_vehicle['endday'] ?></td>
                    <td style="text-align:center;"><?php echo $user_vehicle['price'] ?>₪</td>
                    <td style="text-align:center;"><?php echo $user_vehicle['status'] == 0 ?  'Pending': 'Approved' ?></td>
                      <!-- if status = 0 thats is pending then we can edit odrer status to approve the order andd can delete the order then thats delete order-->
                    <?php
                    if ($user_vehicle['status'] == 0) { ?>
                        <th>
                            <a class="text-center" style="display: inherit;color: green;padding-left: 21px;" href="edituservehicles.php?id=<?php echo $user_vehicle['id']  ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a class="text-center" style="display: inherit;color: red;padding-left: 21px;" onclick="return confirm('are sure delete the order')" href="deleteuservehicles.php?id=<?php echo $user_vehicle['id']  ?>"><i class="fa-solid fa-trash"></i></a>
                        </th>
                    <?php } else { ?>
                        <td>  <a class="text-center" style="display: inherit;color: red;padding-left: 21px;" onclick="return confirm('are sure delete the order')" href="deleteuservehicles.php?id=<?php echo $user_vehicle['id']  ?>"><i class="fa-solid fa-trash"></i></a></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
