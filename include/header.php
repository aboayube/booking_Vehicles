<?php
session_start();
// database connection
require_once "connect.php";
if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/global.css">
    <link rel="stylesheet" href="Styles/<?php echo $selected ?>.css">
    <link rel="stylesheet" href="Styles/navbar.css">
    <link rel="stylesheet" href="Styles/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .sub-menu-1 {
            display: none;
        }

        .test-menu:hover .sub-menu-1 {
            display: block;
            position: absolute;
            background-color: #F6F6F6;

        }

        .test-menu:hover .sub-menu-1 ul {
            display: block;
        }

        .test-menu:hover .sub-menu-1 {
            z-index: 1000;

        }
    </style>
    <?php
    $stmt = $con->prepare('select *  from settings where id=1');
    $stmt->execute();
    $stting = $stmt->fetch();

    ?>
    <link rel="shortcut icon" href="images/<?php echo $stting['logo'] ?> " type="image/x-icon">
    <title>RoyalRent™</title>
</head>
<body>
<div class="container-fluid position-relative nav-bar p-0">
        <div class="position-relative px-lg-5" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-secondary navbar-dark py-3 py-lg-0 pl-3 pl-lg-5">
            <a href="index.php"><img class="Logo" src="images/<?php echo $stting['logo'] ?>" alt="Logo"></a>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                    <div class="navbar-nav ml-auto py-0">
                        <a <?php if (basename($_SERVER['PHP_SELF']) == "index.php") {
                           
                        } ?> href="index.php" class="nav-item nav-link ">Home</a>
                        <a <?php if (basename($_SERVER['PHP_SELF']) == "rental.php") {
                            
                        } ?> href="rental.php" class="nav-item nav-link">Vehicles</a>
                        <!-- if the user is login and his role is users display this page -->
                       <?php if (isset($_SESSION["user_id"]) && $_SESSION['role'] == 'users') { ?>

                        <a <?php if (basename($_SERVER['PHP_SELF']) == "order.php") {
                            
                        } ?> href="order.php" class="nav-item nav-link">Orders</a>
                        <li class="test-menu"><a <?php if (basename($_SERVER['PHP_SELF']) == "notification.php") {
                                                  
                                                } ?> href="notification.php" class="nav-item nav-link ">notification
                            <?php
                            //get all the notifcation that dont read
                            $stmt = $con->prepare('select  count(*) from notification where to_id=? and read_at is null');
                            $stmt->execute(array($_SESSION['user_id']));
                            $notification = $stmt->fetch();
                            // display how many notifications thats dont read
                            if ($notification['count(*)'] > 0) {
                                echo "<span class='badge' style='margin-left: 13px;margin-top: 2px;'>" . $notification['count(*)'] . "</span>";
                            }
                            ?>
                        </a>
                        <?php
                        //display the title of the notifications
                                $stmt2 = $con->prepare('select  title from notification where to_id=? order by id desc');
                                $stmt2->execute(array($_SESSION['user_id']));
                                $notification2 = $stmt2->fetchAll();
                                //loop threw notifications
                                foreach ($notification2 as $notification2) {

                                ?>
                                <?php } ?>
                        <div class="sub-menu-1">
                            <ul>
                                <?php
                                //get the title of the notifcation and the details of the notifcation
                                $stmt2 = $con->prepare('select  title from notification where to_id=? order by id desc');
                                $stmt2->execute(array($_SESSION['user_id']));
                                $notification2 = $stmt2->fetchAll();
                                foreach ($notification2 as $notification2) {

                                ?>
                                    <li><a <?php if (basename($_SERVER['PHP_SELF']) == "notification.php") {
                                            } ?> href="notification.php" style="color:orange;" class="nav-item nav-link "><?php echo $notification2['title'] ?></a></li>
                                <?php } ?>
                    </li>
            </ul>
        </div>

        </li>            
    <?php }
                 // if the role == users or without login display this pages
                if (!isset($_SESSION['user_id']) ||    $_SESSION['role'] == 'users') {
    ?> <a <?php if (basename($_SERVER['PHP_SELF']) == "contact.php") {
                     
                    } ?> href="contact.php" class="nav-item nav-link">Contact</a>
    <?php } ?>
    <a <?php if (basename($_SERVER['PHP_SELF']) == "about.php") {
               
            } ?> href="about.php" class="nav-item nav-link">About Us</a>
</div>
<div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                    <div class="navbar-nav ml-auto py-0">
    <li class="resp-col">
        <div class="res-Avatar" id="resAvatar">
            <img src="images/defaultAvatar.png" class="Avatar-Logo" alt="Avatar-Logo">
            <?php
            if (isset($_SESSION['user_id'])) { ?>

                <a <?php if (basename($_SERVER['PHP_SELF']) == "editprofile.php") {
                        
                    } ?> href="editprofile.php" ><?php echo  $_SESSION["name"] ?></a>
                <a href="../includes/logout.inc.php"><img class="logouticon" src="../images/logout.png"></a>
            <?php } else { ?><a <?php if (basename($_SERVER['PHP_SELF']) == "login.php") {
                                    
                                } ?> href="login.php" class="nav-item nav-link">Log In</a>
            <?php  }
            ?>
    </li>
    </ul>
    <div class="Avatar">
        <?php
        if (isset($_SESSION['user_id'])) {
            echo '        <img src="images/defaultAvatar.png" class="Avatar-Logo" alt="Avatar-Logo">';

        ?><a <?php if (basename($_SERVER['PHP_SELF']) == "login.php") {
                    echo "class='selected'";
                } ?> href="editprofile.php" class="nav-item nav-link"><?php echo $_SESSION["name"] ?></a><?php
                                                                                    echo '<a href="logout.php" class="nav-item nav-link">logout</a>';
                                                                                } else {
                                                                                    echo '<a href="login.php" class="nav-item nav-link">login</a>';
                                                                                }
                                                                            ?>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
   </div>

                        
             
            </nav>
      
    </div>
    </div>

