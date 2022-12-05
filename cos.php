<?php
//require_once "ShoppingCart.php";
require "ShoppingCart.php";
session_start();
// Dacă utilizatorul nu este conectat redirecționează la pagina de
//autentificare ...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
// pt membrii inregistrati
$member_id = $_SESSION['id'];
$shoppingCart = new ShoppingCart();
if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":
            if (!empty($_POST["quantity"])) {
                $productResult = $shoppingCart->getProductByCode($_GET["code"]);

                $cartResult = $shoppingCart->getCartItemByProduct($productResult[0]["id"], $member_id);

                if (!empty($cartResult)) {
                    // Modificare cantitate in cos
                    $newQuantity = $cartResult[0]["quantity"] + $_POST["quantity"];
                    $shoppingCart->updateCartQuantity(
                        $newQuantity,
                        $cartResult[0]["id"]
                    );
                } else {
                    // Adaugare in tabelul cos
                    $shoppingCart->addToCart(
                        $productResult[0]["id"],
                        $_POST["quantity"],
                        $member_id
                    );
                }
            }
            break;
        case "remove":
            // Sterg o sg inregistrare
            $shoppingCart->deleteCartItem($_GET["id"]);
            break;
        case "empty":
            // Sterg cosul
            $shoppingCart->emptyCart($member_id);
            break;
    }
}
?>
<HTML>

<HEAD>
    <TITLE>Cos</TITLE>
    <link href="cos.css" type="text/css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/fbea0d982c.js" crossorigin="anonymous"></script>
</HEAD>

<BODY>
    <div id="shopping-cart">
        <div class="txt-heading">
            <h1 class="txt-heading-label">Cos Cumparaturi</h1>
            <a id="btnEmpty" href="cos.php?action=empty">Empty <i class="fa-sharp fa-solid fa-trash"></i></a>
        </div>
        <?php
        $cartItem = $shoppingCart->getMemberCartItem($member_id);
        if (!empty($cartItem)) {
            $item_total = 0;
        ?>
            <table cellpadding="10" cellspacing="1">
                <tbody>
                    <tr>
                        <th style="text-align: left;"><strong>Name</strong></th>
                        <th style="text-align: left;"><strong>Code</strong></th>
                        <th style="text-align:
right;"><strong>Quantity</strong></th>
                        <th style="text-align:
right;"><strong>Price</strong></th>
                        <th style="text-align:
center;"><strong>Action</strong></th>
                    </tr>
                    <?php
                    foreach ($cartItem as $item) {
                    ?>
                        <tr>
                            <td style="text-align: left; border-bottom: #F0F0F0 1px
solid;"><strong><?php echo $item["name"]; ?></strong></td>
                            <td style="text-align: left; border-bottom: #F0F0F0 1px
solid;"><?php echo $item["code"]; ?></td>
                            <td style="text-align: right; border-bottom: #F0F0F0 1px
solid;"><?php echo $item["quantity"]; ?></td>
                            <td style="text-align: right; border-bottom: #F0F0F0 1px
solid;"><?php echo "$" . $item["price"]; ?></td>
                            <td style="text-align: center; border-bottom: #F0F0F0 1px
solid;"><a href="cos.php?action=remove&id=<?php echo
                                            $item["cart_id"]; ?>" class="btnRemoveAction" style="color: red"><i class="fa-solid fa-trash"></i></a></td>
                            <!--            <img src="icon-delete.png"-->
                            <!--                 alt="icon-delete" title="Remove Item" />-->
                        </tr>
                    <?php
                        $item_total += ($item["price"] * $item["quantity"]);
                    }
                    ?>
                    <tr>
                        <td colspan="3" align=right><strong>Total:</strong></td>
                        <td align=right><?php echo "$" . $item_total; ?></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        <?php
        }
        ?>
    </div>
    <div class="buttons">
        <a href="magazin.php"><input type="submit" value="Inapoi la magazin" class="btnAddAction magazin" /></a>
        <a href="logout.php"><input type="submit" value="Logout" class="btnAddAction logout" /></a>
        <a href="finalizare.php"><input type="submit" value="Finalizare Comanda" class="btnAddAction magazin" /></a>
    </div>
    <?php //require_once "product-list.php"; 
    ?>

</BODY>

</HTML>