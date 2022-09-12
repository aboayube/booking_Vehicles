<!-- here we get all the comments from database -->
<?php
$selected = 'categories';
include('include/header.php');

$sql = $con->prepare("select comments_vehicles.*, users.name as user_name,
vehicles.image as vehicles_image,vehicles.LicenseNum  as vehicles_LicenseNum 
from comments_vehicles,users,vehicles
  where comments_vehicles.user_id=users.id 
  and comments_vehicles.vehicles_id =vehicles.LicenseNum 
  
  order by comments_vehicles.id DESC");
$sql->execute();
$comments = $sql->fetchAll();

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

    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 70%;
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

    .addItem {

        background: green;
        color: white;
        padding: 4px;
        margin-top: 8px;
    }

    tr {
        background-color: white;
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
            <h1 class="">Customers Comments</h1>
        </div>

<!--here we have alert for every update we do  -->

        <?php
        if (isset($_GET['success'])) {
            if ($_GET['success'] == 1) {
        ?>
                <div class="AlertMessage">
                    <div class="alert alertsuccess">
                        Added Successfully
                    </div>
                </div><br><br><br><br><br><br>
            <?php }
            if ($_GET['success'] == 2) {
            ?>
                <div class="AlertMessage">
                    <div class="alert alertsuccess">
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
        margin-bottom: 50px;width:80%">
            <tr style="color:red">
                <th style="text-align:center;">ID</th>
                <th style="text-align:center;">Vehicle LicenseNum</th>
                <th style="text-align:center;">Image</th>
                <th style="text-align:center;">Customer Name</th>
                <th style="text-align:center;">Ratting</th>
                <th style="text-align:center;">Status</th>
                <th style="text-align:center;">Message</th>
                <th style="text-align:center;">Action</th>
            </tr>
            <!-- got the variables from database and goes on a loop and shows them -->
            <?php

            foreach ($comments as $comment) {


            ?>
                <tr style="
    background: #fff;">
                    <td style="text-align:center;"><?php echo $comment['id'] ?></td>
                    <td style="text-align:center;"><?php echo $comment['vehicles_LicenseNum'] ?></td>
                    <td style="text-align:center;"><img src="../images/vehicles/<?php echo $comment['vehicles_image'] ?>" width="100px" height="100px"></td>
                    <td style="text-align:center;"><?php echo $comment['user_name'] ?></td>
                    <td style="text-align:center;"><?php echo $comment['ratting'] ?></td>
                    <td style="text-align:center;"><?php echo $comment['status'] ? 'Active' : 'InActive' ?></td>
                    <td style="text-align:center;"><?php echo $comment['message'] ?></td>
<!-- both sides admin/worker can access Customers Comments -->
                    <td>

                        <a class="text-center" style="    display: inherit;
    color: green;
    padding-left: 21px;" href="editCommentUser.php?id=<?php echo $comment['id']  ?>"><i class="fa-solid fa-edit"></i></a>
                        <a class="text-center" style="    display: inherit;
    color: red;
    padding-left: 21px;" onclick="return confirm('are your sure delete this comment')" href="deleteCommentUser.php?id=<?php echo $comment['id']  ?>"><i class="fa-solid fa-trash-can"></i></a>

                    </td>

                </tr>
            <?php } ?>
        </table>
    </div>
</div>

