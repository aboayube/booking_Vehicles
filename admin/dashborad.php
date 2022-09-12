<?php
$selected = 'categories';
include('include/header.php');

function  get_count($table, $where = '', $id = 'id')
{
    global $con;
    $user = $con->prepare("select `" . $id . "` from " . $table . "  " . $where);
    $user->execute();
    return $user->rowCount();
}










$category = [];
$countOrder = [];
//test
$conads = $con->prepare('SELECT DISTINCT categories.name , (SELECT count(*) from vec_order where vec_order.category_id=categories.id ) as countOrder from categories;
');
$conads->execute();
$data = $conads->fetchAll();
foreach ($data as $da) {
    if ($da['countOrder'] > 0) {
        $category[] = $da['name'];
        $countOrder[] = $da['countOrder'];
    }
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

<link rel="stylesheet" href="Styles/dashborad.css">
<h1 style="margin-left:41%;margin-top:20px;padding:20px;font-weight:bold;
    font-size: 44px;">Dashborad</h1>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card-counter primary">
                <i class="fa fa-users"></i>
                <span class="count-numbers"><?php echo get_count('users', 'where role="users"') ?></span>
                <span class="count-name">users</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-counter danger">
                <i class="fa fa-user-clock"></i>
                <span class="count-numbers"><?php echo get_count('users', 'where role="worker"') ?></span>
                <span class="count-name">worker</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-counter success">
                <i class="fa fa-database"></i>
                <span class="count-numbers"><?php echo get_count('categories') ?></span>
                <span class="count-name">categories</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-counter info">
                <i class="fa fa-id-card"></i>
                <span class="count-numbers"><?php echo get_count('lincenesrank') ?></span>
                <span class="count-name">lincenesrank</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-counter info">
                <i class="fa fa-car"></i>
                <span class="count-numbers"><?php echo get_count('vehicles', '', 'LicenseNum') ?></span>
                <span class="count-name">vehicles</span>
            </div>
        </div>


    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card-counter primary">
                <i class="fa fa-pause"></i>
                <span class="count-numbers"><?php echo get_count('vec_order', 'where status="0"') ?></span>
                <span class="count-name">need appending</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-counter danger">
                <i class="fa fa-check"></i>
                <span class="count-numbers"><?php echo get_count('vec_order', 'where status="1"') ?></span>
                <span class="count-name">accept to pay</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-counter success">
                <i class="fa fa-cart-shopping"></i>
                <span class="count-numbers"><?php echo get_count('vec_order', 'where status="2"') ?></span>
                <span class="count-name">pay by user</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-counter info">
                <i class="fa-solid fa-arrow-rotate-left"></i>
                <span class="count-numbers"><?php echo get_count('receipt_vehicles') ?></span>
                <span class="count-name">receipt_vehicles</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-counter info">
                <i class="fa fa-users"></i>
                <span class="count-numbers"><?php echo get_count('clubs') ?></span>
                <span class="count-name">clubs</span>
            </div>
        </div>
    </div>
</div>

<div>
    <canvas id="myChart"></canvas>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = [
        <?php


        foreach ($category as $cat) {
            echo '"' . $cat . '",';
        }

        ?>
    ];

    const data = {
        labels: labels,
        datasets: [{
            label: 'Category with VEHICLES',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [
                <?php

                foreach ($countOrder as $count) {
                    echo $count . ',';
                }

                ?>
            ],
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {

        }
    };
</script>
<script>
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
    myChart.canvas.parentNode.style.height = '128px';
</script>