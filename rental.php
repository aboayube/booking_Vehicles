<?php $selected = "shop";
require_once "include/header.php";

$price = '';
if (isset($_SESSION['user_id'])) {
        // For discount for vip users
    $pr = $con->prepare('select id  from clubs where user_Id =?');
    $pr->execute(array($_SESSION['user_id']));
    $count = $pr->rowCount();
    $discount_price = $count;
   
}

$search = '';
//if user click in submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // arange top down
    $range = $_POST['range'];
    $search = $_POST['search'];
    $price = $_POST['price'];
    $season_type = $_POST['season_type'];
    $passengers = $_POST['passengers'];
    $lincenesrank = $_POST['lincenesrank'];
    $sql = 'select DISTINCT vehicles.*, lincenesrank.code
    linces_code   from vehicles,lincenesrank 
    where  
    vehicles.quantity >0  and 
    lincenesrank.id=vehicles.lincenes_id
    ';
    $where = '';
    if (isset($_GET['category'])) {
//if can user select category
        $where .= ' and  vehicles.category_id = ' . $_GET['category'];
    }
    if ($lincenesrank) {
        //if user search by lincenes Rank 
        $where .= ' and vehicles.lincenes_id =' . $lincenesrank;
    }
    if ($season_type && $season_type != 4) {
//if user search by season if he whats to go to Area that is summer he can choose summer
// if he want to go to Area that is winter and snow he can choose winter
        $where .= ' and  vehicles.season_type = ' . $season_type;
    }
    if (!empty($passengers)) {
//if user search by how many passengers 
        $where .= ' and  vehicles.passengers = ' . $passengers;
    }
    if ($search) {
        //search by vehicle type/name/price/transmision
        $where .= ' and CONCAT(transmission,v_name,price,VType) LIKE "%' . $search . '%";';
    }
    $orderby = [];
    if ($range) {
        //select According to A to Z or Z to A
        $orderby[] = '  vehicles.v_name   ' . $range;
    }
    if ($price) {
    //search by  price from high to low or low to high
        $orderby[] = '  vehicles.price  ' . $price;
    }
    $data = '';
    if (!empty($orderby)) {
        $data =  ' order by ';
        foreach ($orderby as $order) {
            $data .= $order;
            $data .= ' ,';
        }

        
        $data = rtrim($data, ',');
    }
    $data = $con->prepare($sql . $where . $data);
    $data->execute(array());
    $vec = $data->fetchAll();
}
//applay searchwhen user select category
else if (isset($_GET["category"])) {
    $stmt = $con->prepare("select vehicles.*, lincenesrank.code
    linces_code   from vehicles,lincenesrank
    where 
       lincenesrank.id=vehicles.lincenes_id
       and   
       vehicles.quantity > 0 and
        category_id =? ");
    $stmt->execute(array($_GET["category"]));
    $vec = $stmt->fetchAll();
} else {
    //if he didnt click submit he get all the vehicles not by categories or price or from a-z or licenseNum
    $stmt = $con->prepare("select vehicles.*, lincenesrank.code
    linces_code   from vehicles,lincenesrank
    where 
    vehicles.quantity >0 and
    vehicles.lincenes_id=lincenesrank.id");
    $stmt->execute();
    $vec = $stmt->fetchAll();
} ?>

<head>
<meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="Free HTML Templates" name="keywords" />
    <meta content="Free HTML Templates" name="description" />

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Rubik&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet" />

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet" />
</head>
<style>
    .category-nav {
        margin-top: 10px !important;
        background: white;
        border-top: 2px solid #EFEFEF;
        border-bottom: 2px solid #EFEFEF;
        color: #000;
    }

    .category-nav ul {

        padding: 20px;
    }

    .category-nav ul li a {
        color: #000;
        font-size: 19px;
    }

    .category-nav ul li a:hover {
        color: #000;

    }

    .search-data {
        width: 90%;
        margin: auto;
        margin-top: 23px;
        padding: 20px;
        background: white;
        border: 2px solid #eee;
        margin-bottom: 20px;
    }

    .search-data select,
    .search-data input,
    .search-data input[type="text"] {
        height: 32px;
        width: 230px;
    }

    .search-data button {
        height: 35px;
        width: 80px;
        border: 0;
        background: #00A78E;
        color: #fff;
    }

    .search::placeholder {
        padding-left: 8px !important;
    }

    .body-data {
        background: #f5f5f5;
    }
</style>
<div class="body-data">
    <div class="content-wrapper">
        <div class="category-nav">
            <ul class="menu-list">
                <?php
                $stmt = $con->prepare("select * from categories ");
                $stmt->execute();
                $categories = $stmt->fetchAll();

                foreach ($categories as &$cat) { ?>
                    <li><a href="rental.php?category=<?php echo $cat["id"] ?>"><?php echo $cat["name"]; ?></a></li>
                <?php } ?>

            </ul>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="search-data">
            <form class="form-inline" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
          <!-- select According to A to Z or Z to A -->
                <select name="range" style="height: 50px;">
                    <option value="">BY ASC </option>
                    <option value="ASC">A-z</option>
                    <option value="DESC">z-A</option>
                </select>
                &nbsp;&nbsp;
                <!-- select According to License Rank-->
                <select name="lincenesrank" style="height: 50px;">
                    <option value="">BY LICENSERANK</option>
                    <?php
                    $links = $con->prepare('SELECT * FROM `lincenesrank`');
                    $links->execute();
                    $datas = $links->fetchAll();
                    foreach ($datas as $data) {
                        echo ' <option value="' . $data['id'] . '">' . $data['code'] . '</option>';
                    }

                    ?>
                </select>
                &nbsp;&nbsp;
                <!-- select According to Number of Passengers-->
                <select name="passengers" style="height: 50px;">
                    <option value="">NUMBER OF PASSENGERS</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>

                </select>
                &nbsp;&nbsp;
                <!-- select According to price from Hight To Low OR Low To High -->
                <select name="price" style="height: 50px;">
                    <option value="">PRICE</option>
                    <option value="ASC">From the lowest price to the highest price</option>
                    <option value="DESC">From the highest price to the lowest price</option>
                </select>
                &nbsp;&nbsp;
                <!-- select According to season type 
            if customer going to area that is season is summer then customer can choose Summer 
        if customer going to area that is season winter then customer can choose Winter
    else All thats mean for all the Seasons-->
                <select name="season_type" style="height: 50px;">
                    <option value="">SEASONS</option>
                    <option value="4">All</option>
                    <option value="2">summer</option>
                    <option value="3">winter</option>
                </select>
                &nbsp;
                &nbsp; <button type="submit" style="border-radius: 3px;height: 50px;width:90px; background-color:#353A4F">FILTER</button>
            </form>
        </div>
        <div class="content-wrapper" >
        <div class="search-data">
            <form class="form-inline" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <input style="height: 50px;width:20%" type="text" name="search" style="height: 28px;" value="<?php echo $search ?>" class="search" placeholder="SEARCH">
            &nbsp;&nbsp;&nbsp; <button type="submit" style="border-radius: 3px;height: 50px;width:90px; background-color:#353A4F">SEARCH</button>
            </form>
                </div>
                </div>
    <div class="home-items-content">
        <div class="items-list">
            <?php
            if (isset($vec)) {
                foreach ($vec as $vehicle) { ?>
                    <div class="card" style="border-radius: 5px;">
                        <div class="product-info">
                            <div class="product-inner-info">
                                <h4 style="color :white;"><?php echo   $vehicle["VType"] . "   " . $vehicle["v_name"]; ?></h4>
                                <?php if ($vehicle["quantity"] > 0) {
                                    echo '<div class="price-buy" style="color:white">';
                                } else {
                                    echo '<div style="margin-top:15px; color:white ">';
                                } ?>
                                <h2 style="color:white; text-align:center; font-size: 30px; "><?php

                                                                            if (isset($discount_price) && $discount_price ) {
                                                                                $data = $vehicle["price"] * 30 / 100;
                                                                                echo ($vehicle["price"] - $data) . "₪/Day";
                                                                            } else {
                                                                                echo $vehicle["price"] . "₪/Day";
                                                                            } ?></h2>

                                <form action="user_vehicles.php?id=<?php echo $vehicle['LicenseNum'] ?>" method="post">

                                    <?php if ($vehicle["quantity"] > 0) echo  '<input type="submit" name="AddToCart" value="VIEW DETAILS">';  ?>
                                    <input type="hidden" name="LicenseNum" value="<?php echo $vehicle['LicenseNum']; ?>"></input>
                                </form>
                            </div>
                        </div>
                    </div>
                    <img src="images/vehicles/<?php echo $vehicle['image']; ?>" alt="">
        </div>
<?php }
            } ?>
    </div>
</div>
</div>

<?php require_once "include/footer.php" ?>
