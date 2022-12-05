<?php
require_once "ShoppingCart.php";
session_start();
?>
<HTML>

<HEAD>
    <TITLE>Magazin</TITLE>
    <link href="magazin.css" type="text/css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/fbea0d982c.js" crossorigin="anonymous"></script>
</HEAD>

<BODY>
    <div class="icons">
        <a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
        <a id="admin" style="color: red;" href="./testProd/Vizualizare.php"><i class="fa-solid fa-pen-to-square"></i></a>
        <h1>MIKE.COM</h1>
        <a id="admin" style="color: red;" href="./testProd/Vizualizare.php"><i class="fa-solid fa-pen-to-square"></i></a>
        <a href="cos.php"><i class="fa-solid fa-cart-shopping"></i></i></a>
    </div>
    <div id="product-grid" class="container">
        <!--    <div class="txt-heading"><div class="txt-headinglabel">Products</div></div>-->
        <?php

        if (isset($_SESSION['name'])) {
            if (!$_SESSION['name'] || $_SESSION['name'] != 'admin') {
                echo '<style type="text/css">
                        #admin {
                        display: none;
                    }
                </style>';
            }
        }
        $shoppingCart = new ShoppingCart();
        $query = "SELECT * FROM tbl_product";
        $product_array = $shoppingCart->getAllProduct($query);
        if (!empty($product_array)) {
            foreach ($product_array as $key => $value) {
        ?>
                <div class="product-item">
                    <form method="post" action="cos.php?action=add&code=<?php
                                                                        echo $product_array[$key]["code"]; ?>">

                        <div class="product-img">
                            <img src="<?php echo $product_array[$key]["image"]; ?>">
                        </div>
                        <div class="product-name">
                            <h3><?php echo $product_array[$key]["name"];
                                ?></h3>

                            <span><?php echo $product_array[$key]["descriere"];
                                    ?></span>
                            <p><?php echo $product_array[$key]["categorie"];
                                ?></p>
                            <?php echo
                            "$" . $product_array[$key]["price"];
                            ?>
                            <div class="buttons">
                                <input type="text" name="quantity" value="1" size="2" />
                                <input type="submit" value="Add to cart" class="btnAddAction" />
                            </div>
                        </div>
                        <div>

                        </div>
                    </form>
                </div>
        <?php
            }
        }
        ?>
    </div>
</BODY>

</HTML>