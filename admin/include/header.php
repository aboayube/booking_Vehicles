<?php
//Because when he converts from page to page, there are no problems
ob_start();
session_start();

require_once "connect.php";

// If he was not a login worker, or he was not a manager or worker when The user logged out back to index.php(main page)
if (!isset($_SESSION["role"]) || $_SESSION["role"] == 'users') {
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $extra = 'index.php';
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/global.css">
    <link rel="stylesheet" href="Styles/navbar.css">
    <link rel="stylesheet" href="Styles/footer.css">
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

        .test-menu:hover .sub-menu-1 ul li {

            width: 166px;
            text-align: center;
            border-bottom: 1px solid #eee;
            color: #000 !important;
            padding: 20px;
        }

        .sub-menu-1 ul li a {
            color: #000 !important;
        }
    </style>
<!-- get the dashboard.css from styles -->
    <?php if ($selected == 'dashborad') { ?>
        <link rel="stylesheet" href="../Styles/dashborad.css">
    <?php } else if ($selected == 'dashboradAdd') { ?>
        <link rel="stylesheet" href="../Styles/dashboradAdd.css">

    <?php
    } else {
    ?>
        <link rel="stylesheet" href="../Styles/admin.css">

    <?php } ?>

    <link rel="shortcut icon" href="images/rolan.jpg " type="image/x-icon">
    <title>RoyalRent™</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>

    <div class="navigation">
        <div class="nav-Content">
            <!-- get the basic setting from database   -->
            <?php
            $stmt = $con->prepare('select *  from settings where id=1');
            $stmt->execute();
            $stting = $stmt->fetch();

            ?>
            <a ><img class="Logo" src="../images/<?php echo $stting['logo'] ?> " alt="Logo"></a>

            <ul class="nav-links" id="navLinks">
           
                <li class="test-menu"><a <?php if (
                                                basename($_SERVER['PHP_SELF']) == "vehicles.php" ||
                                                basename($_SERVER['PHP_SELF']) == 'user_vehicles.php' ||
                                                basename($_SERVER['PHP_SELF']) == 'receipt_vehicles.php' ||
                                                basename($_SERVER['PHP_SELF']) == 'commentsuser.php'
                                            ) {
                                                echo "class='selected'";
                                            } ?>>VEHICLES</a>
                    <div class="sub-menu-1">
                        <ul>
                            <li><a href="vehicles.php">Vehicles List</a></li>
                            <li><a href="user_vehicles.php">Customers Orders</a></li>
                            <li><a href="receipt_vehicles.php">CheckOut </a>
                            <li><a href="commentsuser.php">Comments</a></li>
                </li>
            </ul>
        </div>
        </li>
        <li><a <?php if (basename($_SERVER['PHP_SELF']) == "categories.php") {
                    echo "class='selected'";
                } ?> href="categories.php">CATEGORIES</a></li>
        <li><a <?php if (basename($_SERVER['PHP_SELF']) == "lincenesrank.php") {
                    echo "class='selected'";
                } ?> href="lincenesrank.php">LICENSE RANK </a></li>


        <?php if ($_SESSION['role'] == 'worker') { ?>
            <li><a <?php if (basename($_SERVER['PHP_SELF']) == "editworkerDate.php") {
                        echo "class='selected'";
                    } ?> href="editworkerDate.php"> WORKER DATES</a></li>
        <?php } ?>
        <?php
        if ($_SESSION["role"] == 'admin') { ?>
            <li class="test-menu"><a <?php if (
                                            basename($_SERVER['PHP_SELF']) == "worker.php" ||
                                            basename($_SERVER['PHP_SELF']) == "users.php" ||
                                            basename($_SERVER['PHP_SELF']) == "contact_us.php" ||
                                            basename($_SERVER['PHP_SELF']) == "users_clubs.php"
                                        ) {
                                            echo "class='selected'";
                                        } ?>>MANAGMENT</a>
                <div class="sub-menu-1">
                    <ul>
                        <li><a href="worker.php">Workers</a></li>
                        <li><a href="users.php">Customers</a></li>
                        <li><a href="contact_us.php">Contact Us</a></li>
                        <li><a href="users_clubs.php">Vip Customers</a></li>
                    </ul>
                </div>

            </li>

            <li><a <?php if (basename($_SERVER['PHP_SELF']) == "notifications.php") {
                        echo "class='selected'";
                    } ?> href="notifications.php">NOTIFICATIONS</a></li>
            <li><a <?php if (basename($_SERVER['PHP_SELF']) == "setting.php") {
                        echo "class='selected'";
                    } ?> href="setting.php"> SETTINGS</a></li>
        <?php
        }  ?>
        <li><a <?php if (basename($_SERVER['PHP_SELF']) == "paymentuser.php") {
                    echo "class='selected'";
                } ?> href="paymentuser.php">PAYMENTS </a></li>
       
        <li class="resp-col">
            <div class="res-Avatar" id="resAvatar">
                <img src="../images/defaultAvatar.png" class="Avatar-Logo" alt="Avatar-Logo">
                <?php
                if (isset($_SESSION['user_id'])) {
                    echo '<a href=".">' . $user["username"] . '</a>';
                    echo '<a href="logout.php"><img class="logouticon" src="../images/logout.png"></a>';
                } else {
                    echo '<a href="login.php">Log In</a>';
                }
                ?>
            </div>
        </li>
        </ul>

        <div class="Avatar">
            <?php
            if (isset($_SESSION['user_id'])) {
                echo ' <img src="../images/defaultAvatar.png" class="Avatar-Logo" alt="Avatar-Logo">';
            ?>
                <a href="editprofile.php"><?php echo  $_SESSION["name"] ?></a>
            <?php echo '<a href="logout.php">logout</a>';
            } else {
                echo '<a href="login.php">login</a>';
                echo '<a href="logout.php">register</a>';
            }
            ?>
        </div>
    </div>
    </div>
