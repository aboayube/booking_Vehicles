<!-- get the vehicles from database  by id -->

<?php $selected = "admin";
require_once "include/header.php";

$id = $_GET['id'];

$stmt = $con->prepare('select * from vehicles where LicenseNum=?');
$stmt->execute(array($id));
$count = $stmt->rowCount();
if ($count > 0) {
    $vehicles = $stmt->fetch();
} else {
    header("Location:index.php");
    exit;
}
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $v_name = $_POST['v_name'];
    $VType = $_POST['VType'];
    $price = $_POST['price'];
    $Year = $_POST['Year'];
    $passengers = $_POST['passengers'];
    $quantity = $_POST['quantity'];
    $InsuranceVali = $_POST['InsuranceVali'];
    $transmission = $_POST['transmission'];
    $testvalidity = $_POST['testvalidity'];
    $category_id = $_POST['category_id'];
    $lincenesrank_id = $_POST['lincenesrank_id'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    $season_type = $_POST['season_type'];
    $allow_km = $_POST['allow_km'];
    // check if the input empty

    if (empty($v_name)) {
        $errors['v_name'] = 'v_name is required';
    }
    if (empty($VType)) {
        $errors['VType'] = 'VType is required';
    }
    if (empty($price)) {
        $errors['price'] = 'price is required';
    }
    if (empty($passengers)) {
        $errors['passengers'] = 'passengers is required';
    }
    if (empty($quantity)) {
        $errors['quantity'] = 'quantity is required';
    }
    if (empty($Year)) {
        $errors['Year'] = 'Year is required';
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

    if (empty($errors)) {
        $image = $vehicles['image'];
        if ($_FILES['image']['name']) {
            $image = time() . '-' . $_FILES['image']['name'];
            move_uploaded_file($_FILES["image"]["tmp_name"], '../images/vehicles/' . $image);
        }
        // here we update all the vehicle details 
        $stmt = $con->prepare("update vehicles set
        v_name=?,
        VType=?,
        price=?,
        passengers=?,
        quantity=?,
        InsuranceVali=?,
        transmission=?,
        testvalidity=?,
        category_id=?,
        lincenes_id=?,
        description=?,
        image=?,
        season_type=?,
        allow_km=?,
        status=?,
        Year=?
        where LicenseNum=?");
        $stmt->execute(array(
            $v_name,
            $VType,
            $price,
            $passengers,
            $quantity,
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
            $id
        ));
        header("Location:vehicles.php");
        exit;
    }
    $cv = time() . '-' . $_FILES['image']['name'];
}
?>

<?php if (isset($_GET["error"])) { ?>
    <div class="AlertMessage">
        <div class="alert alertError">
            <?php echo  '<p">' . $_GET["error"] . '</p>'; ?>
        </div>
    </div>
<?php } ?>

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
            <img src="../images/vehicles/<?php echo $vehicles['image'] ?>" id="imageOnChange" alt="">
            <input type="file" name="image" id="file" onchange="loadFile(event)">
            <label for="file"></label>
        </div>

        <div class="RightSide">
            <input type="text" name="v_name" value="<?php echo $vehicles['v_name'] ?>" placeholder="name">
            <input type="text" name="VType" value="<?php echo $vehicles['VType'] ?>" placeholder="type">
            <input type="text" name="Year" value="<?php echo $vehicles['Year'] ?>" placeholder="type">
            <input type="text" name="price" value="<?php echo $vehicles['price'] ?>" placeholder="price">
            <input type="text" name="passengers" value="<?php echo $vehicles['passengers'] ?>" placeholder="passengers">
            <input type="text" name="quantity" value="<?php echo $vehicles['quantity'] ?>" placeholder="quantity">
            <input type="text" name="InsuranceVali" value="<?php echo $vehicles['InsuranceVali'] ?>" placeholder="InsuranceVali">
            <input type="text" name="transmission" value="<?php echo $vehicles['transmission'] ?>" placeholder="transmission">
            <input type="text" name="testvalidity" value="<?php echo $vehicles['testvalidity'] ?>" placeholder="testvalidity">
            <input type="text" name="allow_km" value="<?php echo $vehicles['allow_km'] ?>" placeholder="allow_km">
            <select name="status">
                <!-- here we choose if the vehicle active or to be on ad page -->
                <option value="1" <?php if ($vehicles['status'] == 1) {
                                        echo 'selected';
                                    } ?>>InActive</option>
                <option value="2" <?php if ($vehicles['status'] == 2) {
                                        echo 'selected';
                                    } ?>>Active</option>
                <option value="3" <?php if ($vehicles['status'] == 3) {
                                        echo 'selected';
                                    } ?>>Advertisment</option>
            </select>

<!-- here we choose which season we can drive the vehicle -->
            <select name="season_type">
                <option value="1" <?php if ($vehicles['season_type'] == 1) {
                                        echo 'selected';
                                    } ?>>All</option>
                <option value="2" <?php if ($vehicles['season_type'] == 2) {
                                        echo 'selected';
                                    } ?>>summer</option>
               
                <option value="4" <?php if ($vehicles['season_type'] == 4) {
                                        echo 'selected';
                                    } ?>>winter</option>
            </select>
<!-- for which category it contains  -->

            <select name="category_id">
                <?php
                $stmt = $con->prepare('select * from categories');
                $stmt->execute();
                $categories = $stmt->fetchAll();
                foreach ($categories as $category) {
                ?>

                    <option value="<?php echo $category['id'] ?>" <?php if ($category['id'] == $vehicles['category_id']) {
                                                                        echo 'selected';
                                                                    } ?>><?php echo $category["name"] ?></option>

                <?php } ?>
            </select>

<!-- for which lincenesrank it contains  -->
            <select name="lincenesrank_id">
                <?php
                $stmt = $con->prepare('select * from lincenesrank ');
                $stmt->execute();
                $lincenesranks = $stmt->fetchAll();
                foreach ($lincenesranks as $lincenesrank) {
                ?>

                    <option value="<?php echo $lincenesrank['id'] ?>" <?php if ($lincenesrank['id'] == $lincenesrank['id']) {
                                                                            echo 'selected';
                                                                        } ?>><?php echo $lincenesrank["code"] ?></option>

                <?php } ?>
            </select>
            <textarea name="description" placeholder="description" cols="30" rows="10"><?php echo $vehicles['description'] ?></textarea>
            <input type="submit" style="background-color:#00A78E" name="AddVehicle" value="EDIT VEHICLE" >
        </div>
    </form>
</div>
