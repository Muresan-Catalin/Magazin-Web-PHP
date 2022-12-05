<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="finalizare.css" />
  <title>Document</title>
</head>

<body>
  <div class="page">
    <div class="form-style-2">
      <div class="form-style-2-heading">Informatii pentru livrare</div>
      <form action="comanda.php" method="post">
        <label for="field1"><span>Nume <span class="required">*</span></span><input type="text" class="input-field" name="nume" value="" required /></label>
        <label for="field1"><span>Prenume <span class="required">*</span></span><input type="text" class="input-field" name="prenume" value="" required /></label>
        <label for="field2"><span>Email <span class="required">*</span></span><input type="email" class="input-field" name="email" value="" required /></label>
        <label for="field1"><span>Telefon <span class="required">*</span></span><input type="text" class="input-field" name="telefon" value="" required /></label>
        <label for="field1"><span>Adresa <span class="required">*</span></span><input type="text" class="input-field" name="adresa" value="" required /></label>
        <label for="field5"><span>Comentarii <span class="required">*</span></span><input type="text" class="input-field" name="comentarii" value="" />
        </label>

        <label><span> </span><input type="submit" value="Submit" /></label>
      </form>
    </div>

    <div class="cart">
      <div class="form-style-2-heading">Cos curent</div>
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
  </div>
  <br />
  <a href="cos.php">inapoi la cos</a>
</body>

</html>