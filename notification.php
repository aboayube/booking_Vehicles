<?php

$selected = 'dashborad';
include('include/header.php');
if (isset($_SESSION["user_id"]) && $_SESSION["role"] != 'users') {
    header("location:index.php");
}
//get the notifications thats belong to the logged in user
$sql = $con->prepare("select * from notification
 where
 to_id=?
 
 order by id DESC");
$sql->execute(array($_SESSION['user_id']));
$notifications = $sql->fetchAll();

//update notification thats mean the user can read the notification
$da = $con->prepare('update notification set read_at=1 where to_id=?');
$da->execute(array($_SESSION['user_id']));

?>
<style>
    .text-center {
        margin-left: 50%;
        margin-top: 50px;
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
</style>
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
<div class="data">
    <div class="items">
        <div class="header">
            <h1 class="">NOTIFICATION</h1>
        </div>

        
        <table id="customers" style="
        margin-bottom: 155px;">
            <tr>
                <th style="text-align:center">ID</th>
                <th style="text-align:center">TITLE</th>
                <th style="text-align:center">MESSAGE</th>
                <th style="text-align:center">DELETE</th>
            </tr>
            <?php
            //loop threw notifications and display the notifications of the user that logged in
            foreach ($notifications as $notification) {

            ?>
                <tr>
                    <td style="text-align:center"><?php echo $notification['id'] ?></td>
                    <td style="text-align:center"><?php echo $notification['title'] ?></td>
                    <td style="text-align:center"><?php echo $notification['message'] ?></td>
                    <td style="text-align:center">
                    <!-- display trash icon thats mean if he want to delete the notifiction -->
                        <a  class="text-center delete" href="deletenotifcation.php?id=<?php echo $notification['id']  ?>" onclick="return confirm('Are you sure you want to delete this notifcation')"><i class="fa-solid fa-trash-can delete"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
</div>
<?php
include('include/footer.php'); ?>
