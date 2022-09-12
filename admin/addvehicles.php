<!-- In that page we use to add new vechicles to our site  -->

<?php
$selected = "admin";
require_once "include/header.php";
$category = $con->prepare('select * from categories');
$category->execute();
// get all categories
$categories = $category->rowCount();

$lincenesrank = $con->prepare('select * from lincenesrank');
$lincenesrank->execute();
$lincenesranks = $lincenesrank->rowCount();

if ($categories == 0) {
    header('location:addCategory.php');
}
if ($lincenesranks == 0) {
    header('location:addlincenesranks.php');
}

$v_name = '';
$VType = '';
$price = '';
$passengers = '';
$LicenseNum = '';
$quantity = '1';
$InsuranceVali = '';
$transmission = '';
$testvalidity = '';
$Year = '';
$category_id = '';
$lincenesrank_id = '';
$season_type = '';
$description = '';
$allow_km = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];
    $LicenseNum = $_POST['LicenseNum'];
    $v_name = $_POST['v_name'];
    $VType = $_POST['VType'];
    $Year = $_POST['Year'];
    $season_type = $_POST['season_type'];
    $price = $_POST['price'];
    $passengers = $_POST['passengers'];
    $quantity = $_POST['quantity'];
    $InsuranceVali = $_POST['InsuranceVali'];
    $transmission = $_POST['transmission'];
    $testvalidity = $_POST['testvalidity'];
    $category_id = $_POST['category_id'];
    $lincenesrank_id = $_POST['lincenesrank_id'];
    $description = $_POST['description'];
    $allow_km = $_POST['allow_km'];
    $status = $_POST['status'];

    if (empty($v_name)) {
        $errors['v_name'] = 'v_name is required';
    }
    //get all vehicles and check if the licenseNum of the vehicle thats he the primary key exist in vehicle table
    $data = $con->prepare("select * from vehicles where LicenseNum=?");
    $data->execute(array($LicenseNum));
    $count = $data->rowCount();
// check if the input empty
    if (empty($LicenseNum) || $count > 0) {
        if ($count > 0) {
            $errors[] = 'LicenseNum is already exist';
        }
        if (!is_numeric($LicenseNum)) {
            $errors[] = 'LicenseNum is Number';
        }
        $errors[] = 'LicenseNum  is required';
    }
    if (empty($VType)) {
        $errors['VType'] = 'VType is required';
    }
    if (empty($price)  and !is_numeric($price)) {
        $errors['price'] = 'price is required';
    }
    if (empty($passengers) and !is_numeric($passengers)) {
        $errors['passengers'] = 'passengers is required';
    }
    if (empty($quantity)) {
        $errors['quantity'] = 'quantity is required';
    }

    if (empty($InsuranceVali)) {
        $errors['InsuranceVali'] = 'InsuranceVali is required';
    }
    if (empty($transmission)) {
        $errors['transmission'] = 'transmission is required';
    }
    if (empty($testvalidity)) {
        $errors['testvalidity'] = 'testvalidity is required';
    }
    if (empty($category_id)) {
        $errors['category_id'] = 'category_id is required';
    }
    if (empty($lincenesrank_id)) {
        $errors['lincenesrank_id'] = 'lincenesrank_id is required';
    }
    if (empty($description)) {
        $errors['description'] = 'description is required';
    }
    if (empty($allow_km) and !is_numeric($allow_km)) {
        $errors['allow_km'] = 'allow_km is required';
    }
    if (empty($Year) and !is_numeric($Year)) {
        $errors['Year'] = 'Year is required';
    }

    if (empty($errors)) {
        $image = time() . '-' . $_FILES['image']['name'];
        move_uploaded_file($_FILES["image"]["tmp_name"], '../images/vehicles/' . $image);
         // add new vehicles to databse 
        $stmt = $con->prepare('insert into vehicles
 (LicenseNum,v_name,VType,price,passengers,quantity,InsuranceVali,
 transmission,testvalidity,category_id,lincenes_id ,description,image,
 season_type,allow_km,status,Year,user_id ) 
 values
 (?,?,?,?,?,1,?,?,?,?,?,?,?,?,?,?,?,?)');
        print_r($stmt);
        $stmt->execute(array(
            $LicenseNum,
            $v_name,
            $VType,
            $price,
            $passengers,
            1,
            $InsuranceVali,
            $transmission,
            $testvalidity,
            $category_id,
            $lincenesrank_id,
            $description,
            $image,
            $season_type,
            $allow_km,
            $status,
            $Year,
            $_SESSION['user_id']
        ));
        header("Location:vehicles.php");
        exit;
    }


    $cv = time() . '-' . $_FILES['image']['name'];
}





?>
<!-- if there is error send error alert -->
<?php if (isset($errors)) { ?>
    <div class="AlertMessage">
        <div class="alert alertError">
            <ul>
                <!-- loop threw errors -->
                <?php foreach ($errors as $error) { ?>
                    <li><?php echo $error; ?></li>
                <?php } ?>
        </div>
    </div>
    <br><br><br>
    <br><br><br>
    <br><br><br>
    <br><br><br>
<?php } ?>
<!-- if all is successfully send success message -->
<?php if (isset($_GET["success"])) { ?>
    <div class="AlertMessage">
        <div class="alert alertsuccess">
            <?php echo  '<p">' . $_GET["success"] . '</p>'; ?>
        </div>
    </div>
<?php } ?>

<div class="Admin-Wrapper">
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="Admin-Content" enctype="multipart/form-data" autocomplete="off">
        <div class="leftSide">
            <img src="../images/NoImage.jpg" id="imageOnChange" alt="">
            <input type="file" name="image" id="file" onchange="loadFile(event)">
            <label for="file"></label>
        </div>

        <div class="RightSide">
            <input type="number" name="LicenseNum" value="<?php echo $LicenseNum  ?>" placeholder="LicenseNum" required>
            <input type="text" name="v_name" value="<?php echo $v_name ?>" placeholder="name" required>
            <input type="text" name="VType" value="<?php echo $VType ?>" placeholder="type" required>
            <input type="text" name="Year" value="<?php echo $Year ?>" placeholder="Year" required>
            <input type="text" name="price" value="<?php echo $price ?>" placeholder="price" required>
            <input type="text" name="passengers" value="<?php echo $passengers ?>" placeholder="passengers" required>
            <input type="text" name="quantity" value="<?php echo $quantity ?>" placeholder="quantity" required>
            <input type="text" name="InsuranceVali" value="<?php echo $InsuranceVali ?>" placeholder="InsuranceVali" required>
            <input type="text" name="transmission" value="<?php echo $transmission ?>" placeholder="transmission" required>
            <input type="text" name="testvalidity" value="<?php echo $testvalidity ?>" placeholder="testvalidity" required>
            <input type="text" name="allow_km" value="<?php echo $allow_km ?>" placeholder="allow_km" required> 
<!-- for algoretim to let the customers choose the season type that they want the vehicle to match  -->
            <select name="season_type" required>
                <option value="1">All</option>
                <option value="2">summer</option>
                <option value="3">winter</option>
            </select>
            <!-- the admin/worker can select Ad thats mean new vehicle and display in the Main page or select active or InActive -->
            <select name="status" required>
                <option value="1">InActive</option>
                <option value="2">Active</option>
                <option value="3">Advertisment</option>
            </select>
            <select name="category_id" required>
                <?php
                // get all the categories from categories table
                $stmt = $con->prepare('select * from categories');
                $stmt->execute();
                $categories = $stmt->fetchAll();
                foreach ($categories as $category) {
                ?>

                    <option value="<?php echo $category['id'] ?>"><?php echo $category["name"] ?></option>

                <?php } ?>
            </select>

            <select name="lincenesrank_id" required>
                <?php
                //get all licenserank from lisenserank table
                $stmt = $con->prepare('select * from lincenesrank');
                $stmt->execute();
                $lincenesranks = $stmt->fetchAll();
                foreach ($lincenesranks as $lincenesrank) {
                ?>

                    <option required value="<?php echo $lincenesrank['id'] ?>"><?php echo $lincenesrank["code"] ?></option>

                <?php } ?>
            </select>
            <textarea name="description" placeholder="description" cols="30" rows="10" required><?php echo $description ?></textarea>
            <input type="submit" style="background-color:#00A78E" name="AddVehicle" value="Add Vehicle"  required>
        </div>
    </form>
</div>
