<?php
$selected = 'dashborad';
include('include/header.php');
//To perform a payment operation, this query shows the customer, 
//according to his ID, the vehicle he wants to rent and proceed with the payment operation
$stmt = $con->prepare("SELECT * FROM vec_order where id  =? and user_id=?");
$stmt->execute(array($_GET['id'], $_SESSION['user_id']));
$data = $stmt->fetch();
?><head>
<meta charset="utf-8" />
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<meta content="Free HTML Templates" name="keywords" />
<meta content="Free HTML Templates" name="description" />
<link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
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
<style>

       .container{

        height: 100vh;

       }

       .card{

        border: none;
       }

       .card-header {
            padding: .5rem 1rem;
            margin-bottom: 0;
            background-color: rgba(0,0,0,.03);
            border-bottom: none;
        }

        .btn-light:focus {
            color: #212529;
            background-color: #e2e6ea;
            border-color: #dae0e5;
            box-shadow: 0 0 0 0.2rem rgba(216,217,219,.5);
        }

        .form-control{

          height: 50px;
    border: 2px solid #eee;
    border-radius: 6px;
    font-size: 14px;
        }

        .form-control:focus {
    color: #495057;
    background-color: #fff;
    border-color: #039be5;
    outline: 0;
    box-shadow: none;

    }

    .input{

      position: relative;
    }

    .input i{

          position: absolute;
    top: 16px;
    left: 11px;
    color: #989898;
    }

    .input input{

      text-indent: 25px;
    }

    .card-text{

      font-size: 13px;
    margin-left: 6px;
    }

    .certificate-text{

      font-size: 12px;
    }

       
    .billing{
      font-size: 11px;
    }  

    .super-price{

          top: 0px;
    font-size: 22px;
    }

    .super-month{

          font-size: 11px;
    }

    .line{
      color: #bfbdbd;
    }

    .free-button{

          background: #1565c0;
    height: 52px;
    font-size: 15px;
    border-radius: 8px;
    }

    .payment-card-body{

    flex: 1 1 auto;
    padding: 24px 1rem !important;

    }
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}



.input_group {
    margin-bottom: 8px;
    width: 100%;
    position: relative;
    display: flex;
    flex-direction: row;
    padding: 5px 0;
}

.input_box {
    width: 100%;
    margin-right: 12px;
    position: relative;
}

.input_box:last-child {
    margin-right: 0;
}

.input_box .name {
    padding: 14px 10px 14px 50px;
    width: 100%;
    background-color: #fcfcfc;
    border: 1px solid #0003;
    outline: none;
    letter-spacing: 1px;
    transition: 0.3s;
    border-radius: 3px;
    color: #333;
}

.input_box .name:focus, .dob:focus {
    -webkit-box-shadow: 0 0 2px 1px #21cdd3;
    -moz-box-shadow: 0 0 2px 1px #21cdd3;
    box-shadow: 0 0 2px 1px #21cdd3;
    border: 1px solid #21cdd3;
}

.input_box .icon {
    width: 48px;
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    top: 0px;
    left: 0px;
    bottom: 0px;
    color: #333;
    background-color: #f1f1f1;
    border-radius: 2px 0 0 2px;
    transition: 0.3s;
    font-size: 20px;
    pointer-events: none;
    border: 1px solid #00000003;
    border-right: none;
}

.name:focus+.icon {
    background-color: #21cdd3;
    color: #fff;
    border-right: 1px solid #21cdd3;
    border: none;
    transition: 1s;
}

.dob {
    width: 30%;
    padding: 14px;
    text-align: center;
    background-color: #fcfcfc;
    transition: 0.3s;
    outline: none;
    border: 1px solid #c0bfbf;
    border-radius: 3px;
}

.radio {
    display: none;
}

.input_box label {
    width: 50%;
    padding: 13px;
    background-color: #fcfcfc;
    display: inline-block;
    float: left;
    text-align: center;
    border: 1px solid #c0bfbf;
}

.input_box label:first-of-type {
    border-top-left-radius: 3px;
    border-bottom-right-radius: 3px;
    border-right: none;
}

.input_box label:last-of-type {
    border-top-right-radius: 3px;
    border-bottom-right-radius: 3px;
}

.radio:checked+label {
    background-color: #2B2E4A;
    color: #fff;
    transition: 0.5s;
}

.input_box button {
    width: 100%;
    background-color: orange;
    border: none;
    color: #fff;
    padding: 15px;
    border-right: 4px;
    font-size: 16px;
    transition: all 0.3s ease;
    border-radius: 8px;
}

.input_box button:hover {
    cursor: pointer;
    background-color: #2B2E4A;
}
        
</style>

       
    
       
            <div class="input_group">
  
        </div>
        <h2 style="font-family:fantasy;">Payment Details</h2>
         
            <div class="input_group">
                <div class="input_box">
                <i  class="fa fa-credit-card icon"></i>
<!--  this.value is value select by user
and go to script to apply function getPrice
-->
                <select style="text-align:center; width:50%"  id="data" onchange="getPrice(this.value)" style=" width: 19%;">  
                <option value="-">-</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
            
            <form action="visa/visa.php" method="get" style="margin-left:0">

<input type="hidden" name="id" id="id" value="<?php echo $_GET['id'] ?>" />
<input type="hidden" name="oldPrice" id="oldPrice" value="<?php echo $data['price'] ?>">
<input type="hidden" name="number_pay" id="number_pay" />
<input type="hidden" name="Paid" id="Paid" />
                </div>
            </div>

            
      
            <!--Payment Details End-->
       
         <div class="input_box">
                   
                   <label for="bc1"><span>
                           <i class="fa fa-cc-visa"></i>Price:<p id="price"><?php echo $data['price'] ?></p></span></label>
                   
                       
                   <label for="bc2"><span>
                   <div id="paypal-button-container">
                           <i class="fa fa-cc-paypal"></i>Per Month:<p id="dataprice">0</p></span></label></a>
                           
               </div>
               
           </div>
            <div id="paypal-button-container">
            <div class="input_group">
                <div class="input_box">
                    <button type="submit">PAY NOW</button>
                </div>
            </div>
            </div>
        </form>
    </div>
    <form action="visa/paypal.php" method="get" style="margin-left:0">

<input type="hidden" name="id" id="id" value="<?php echo $_GET['id'] ?>" />
<input type="hidden" name="oldPrice" id="oldPrice" value="<?php echo $data['price'] ?>">
<input type="hidden" name="number_pay" id="number_pay" />
<input type="hidden" name="Paid" id="Paid" />
            
            <div class="input_group">
                <div class="input_box">
                    
                    <button  type="submit"><img style="width:60px"src="visa/PayPal.png"></button>
                </div>
            </div>

        </form>
</body>

<script>
//function to get data of numbers of pays and to return  number of pays and paid will online
    function getPrice(value) {
        let dataprice = document.getElementById("price").textContent;
 //2000
        let pay = dataprice / value;
   //1000
//    number of pays
        document.getElementById("dataprice").textContent = Math.round(pay);
        document.getElementById("Paid").value = pay;
        document.getElementById("number_pay").value = value
    }
</script>

</html>
<?php include("include/footer.php");

