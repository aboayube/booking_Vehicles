<!-- we get from database -->
<?php
$selected = 'dashborad';
include('include/header.php');

$sql = $con->prepare("select * from contact_us  order by id DESC");
$sql->execute();
$contact_uss = $sql->fetchAll();

?>
<!-- here the admin can only access the managament of contactus page -->
<div class="data">
    <div class="items">
        <div class="header">
            <h1 class="">CONTACT US MANAGMENT</h1>
        </div>
        <?php
        if (isset($_GET['success'])) {
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
        margin-bottom: 155px;">
            <tr>
                <th style="text-align:center;">ID</th>
                <th style="text-align:center;">Customer Name</th>
                <th style="text-align:center;">Email </th>
                <th style="text-align:center;">Subject </th>
                <th style="text-align:center;">Message</th>
                <th style="text-align:center;">Action</th>
            </tr>
                        <!-- got the variables from database and goes on a loop and shows them -->
            <?php

            foreach ($contact_uss as $contact_us) {

            ?>
                <tr>
                    <td style="text-align:center;"><?php echo $contact_us['id'] ?></td>
                    <td style="text-align:center;"><?php echo $contact_us['name'] ?></td>
                    <td style="text-align:center;"><?php echo $contact_us['email'] ?></td>
                    <td style="text-align:center;"><?php echo $contact_us['subject'] ?></td>
                    <td style="text-align:center;"><?php echo $contact_us['message'] ?></td>

                    <td>

                        <a class="text-center delete" href="deletecontact_us.php?id=<?php echo $contact_us['id']  ?>" onclick="return confirm('Are you sure you want to delete this Message')"><i class="fa-solid fa-trash-can delete"></i></a>

                    </td>

                </tr>
            <?php } ?>

        </table>
    </div>
</div>
