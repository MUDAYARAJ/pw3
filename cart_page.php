<?php
session_start();
require_once('ckDb.php');
require_once('cart_page_component.php');
$db=new createDb("hotel_list","products");

$total = 0;
$ototal=0;

if (isset($_POST['remove'])){
    if ($_GET['action'] == 'remove'){
        foreach ($_SESSION['cart'] as $key => $value){
            if($value["product_id"] == $_GET['id']){
                unset($_SESSION['cart'][$key]);
              //  echo "<script>alert('Product has been Removed...!')</script>";
                echo "<script>window.location = 'cart_page.php'</script>";
            }
        }
    }
  }
  

if (isset($_POST['add'])){
    /// print_r($_POST['product_id']);
    if(isset($_SESSION['cart'])){

        $item_array_id = array_column($_SESSION['cart'], "product_id");

        if(in_array($_POST['product_id'], $item_array_id)){
            echo "<script>alert('Product is already added in the cart..!')</script>";
            echo "<script>window.location = 'cart_page.php'</script>";
        }else{

            $count = count($_SESSION['cart']);
            $item_array = array(
                'product_id' => $_POST['product_id']
            );

            $_SESSION['cart'][$count] = $item_array;
        }

    }else{

        $item_array = array(
                'product_id' => $_POST['product_id']
        );

        // Create new session variable
        $_SESSION['cart'][0] = $item_array;
      //  print_r($_SESSION['cart']);
    }
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./cart_page.css" />
    <link rel="stylesheet" href="./sip.css" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <title>Cart-Page</title>
</head>

<body>
    <div class="sideBar w3-display-topright" id="sideBar">
        <ul>
            <li><button id="closeBtn" onclick="closeSide()">X Close</button></li>
            <li><a href="about.html">ABOUT</a></li>
            <li><a href="contact1.html">CONTACT</a></li>

        </ul>
    </div>
    <div class="topcont">
        <div class="w3-container w3-white" id="Bar" width="100%">

            <img src="./photos/download (1).jpg" class="avo-icon" width="70" style="float: left;">
            <a href="./index.php">
                <h1 class="avo-title" style="float: left; color:black;">BMS EATS -
                    <H1 class="hotel_name">CART</H1>
                </h1>
            </a>
            <ul class="topnav" style="padding-top: 0px;">

                <a href="cart_page.html"><i style="float: right;color:black;padding: 14px;"
                        class="material-icons">shopping_cart</i></a>
                <li style="float: right;"><a href="./about.html">ABOUT</a></li>
                <li style="float: right;"><a href="contact1.html">CONTACT</a></li>

            </ul>
            <button class="menuIcon" id="menuBtn" onclick="openSide()"><i style="padding: 14px;"
                    class="material-icons">menu</i></button>
        </div>
    </div>
    <!-- body starts here  -->
    <div>
        <div class="wrap">

            <header class="cart-header cf">
                <strong>Total Items in Your Cart <?php echo "(" . (count($_SESSION['cart']) . ")"); ?></strong>

            </header>
            <div class="cart-table">
                <ul>
                    <li class="item">
                        <?php
                    if (isset($_SESSION['cart'])){
                        $product_id = array_column($_SESSION['cart'], 'product_id');
                        $result = $db->getCart();
                        while ($row = mysqli_fetch_assoc($result)){
                            foreach ($product_id as $id){
                                if ($row['pid'] == $id){
                                    addtocart($row['pid'],$row['product_name'],$row['product_image'],$row['old_price'],$row['new_price']);
                                    $total = $total + (int)$row['new_price'];
                                     $ototal=$ototal+(int)$row['old_price'];
                                }
                            }
                        }

                    }else{
                        echo "<h5>Cart is Empty</h5>";
                    }

?>
                    </li>
                </ul>


            </div>

            <div class="sub-table cf">
                <div class="summary-block">

                    <ul>
                        <li class="subtotal"><span class="sb-label">Subtotal</span><span
                                class="sb-value"><?php echo "₹" . $ototal; ?></span>

                        </li>

                        <li class="savings"><span class="sb-label"> Discount</span><span
                                class="sb-value"><?php echo "₹" .$ototal- $total; ?></span>

                        </li>
                        <li class="grand-total"><span class="sb-label">Total</span><span class="sb-value">
                                <?php echo "₹" . $total; ?></span>
                        </li>
                    </ul>
                </div>

            </div>

            <div class="cart-footer cf">
                <span class="btn">Checkout</span>
            </div>
        </div>
        <script src="./cart_page.js"></script>
</body>

</html>