<?php
// Variables: $cartItems, $productTotal, $deliveryCharge, $grandTotal, $errors, $values
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Checkout Page</title>

  <style>
    /* SAME CSS FROM YOUR check_out.html */
    body {
      font-family: Arial, sans-serif;
      background: #ffffff;
      margin: 0;
      padding: 0;
      color: #333;
    }

    .container {
      width: 90%;
      max-width: 1100px;
      margin: 40px auto;
      display: flex;
      gap: 30px;
    }

    .checkout-section {
      flex: 2;
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      border: 2px solid pink;
    }

    .order-summary {
      flex: 1;
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      border: 2px solid pink;
      height: fit-content;
    }

    h2 {
      color: #ff4fa1;
      margin-bottom: 15px;
    }

    label {
      display: block;
      margin-top: 12px;
      color: #444;
    }

    input {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1.8px solid pink;
      border-radius: 6px;
    }

    small {
      color: red;
      font-size: 13px;
      display:block;
      margin-top:5px;
    }

    .summary-item {
      display: flex;
      justify-content: space-between;
      margin: 8px 0;
    }

    .checkout-btn {
      width: 100%;
      background: #ff4fa1;
      color: #fff;
      padding: 15px;
      border: none;
      margin-top: 20px;
      border-radius: 10px;
      font-size: 18px;
      cursor: pointer;
    }

    .checkout-btn:hover {
      background: #ff2e8b;
    }

    .backLink{
      display:inline-block;
      margin: 25px auto 0 auto;
      text-decoration:none;
      color:#ff4fa1;
      font-weight:600;
    }
  </style>
</head>

<body>

  <div class="container">

    <!-- Billing Info -->
    <div class="checkout-section">
      <h2>Billing Information</h2>

      <form method="post" action="<?php echo e(url('checkout/index')); ?>" onsubmit="return jsValidateCheckout();">
        <label>Full Name</label>
        <input id="name" name="name" type="text" placeholder="Enter your full name" value="<?php echo e($values['name']); ?>"/>
        <small id="nameError"><?php echo e($errors['name']); ?></small>

        <label>Email Address</label>
        <input id="email" name="email" type="email" placeholder="Enter your email" value="<?php echo e($values['email']); ?>"/>
        <small id="emailError"><?php echo e($errors['email']); ?></small>

        <label>Phone Number</label>
        <input id="phone" name="phone" type="text" placeholder="Enter phone number" value="<?php echo e($values['phone']); ?>"/>
        <small id="phoneError"><?php echo e($errors['phone']); ?></small>

        <label>Street Address</label>
        <input id="address" name="address" type="text" placeholder="House, Road, Area" value="<?php echo e($values['address']); ?>"/>
        <small id="addressError"><?php echo e($errors['address']); ?></small>

        <label>City</label>
        <input id="city" name="city" type="text" placeholder="City name" value="<?php echo e($values['city']); ?>"/>
        <small id="cityError"><?php echo e($errors['city']); ?></small>

        <label>Postal Code</label>
        <input id="postal" name="postal" type="text" placeholder="Postal code" value="<?php echo e($values['postal']); ?>"/>
        <small id="postalError"><?php echo e($errors['postal']); ?></small>

        <button class="checkout-btn" type="submit">Confirm Order</button>
      </form>

      <a class="backLink" href="<?php echo e(url('cart/index')); ?>">← Back to Cart</a>
    </div>

    <!-- Order Summary -->
    <div class="order-summary">
      <h2>Order Summary</h2>

      <div class="summary-item">
        <span>Product Total:</span>
        <span>৳ <?php echo (int)$productTotal; ?></span>
      </div>

      <div class="summary-item">
        <span>Delivery Charge:</span>
        <span>৳ <?php echo (int)$deliveryCharge; ?></span>
      </div>

      <div class="summary-item" style="font-weight: bold;">
        <span>Total Amount:</span>
        <span>৳ <?php echo (int)$grandTotal; ?></span>
      </div>

      <hr style="margin:15px 0;border:0;border-top:1px solid #ffd0e6;">

      <?php if (count($cartItems) > 0): ?>
        <div style="font-weight:bold;color:#ff4fa1;margin-bottom:10px;">Items</div>
        <?php foreach ($cartItems as $it): ?>
          <div class="summary-item">
            <span><?php echo e($it['title']); ?> (x<?php echo (int)$it['qty']; ?>)</span>
            <span>৳ <?php echo (int)$it['price']*(int)$it['qty']; ?></span>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div style="color:#777;">Cart is empty.</div>
      <?php endif; ?>

    </div>

  </div>

  <!-- JS Validation (Frontend) -->
  <script>
    function jsValidateCheckout(){
      document.getElementById("nameError").innerText = "";
      document.getElementById("emailError").innerText = "";
      document.getElementById("phoneError").innerText = "";

      let name = document.getElementById("name").value.trim();
      let email = document.getElementById("email").value.trim();
      let phone = document.getElementById("phone").value.trim();

      let ok = true;

      if (name.length < 3) {
        document.getElementById("nameError").innerText = "Name must be at least 3 characters.";
        ok = false;
      }

      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailPattern.test(email)) {
        document.getElementById("emailError").innerText = "Invalid email format.";
        ok = false;
      }

      if (!/^\d{11}$/.test(phone)) {
        document.getElementById("phoneError").innerText = "Phone number must be exactly 11 digits.";
        ok = false;
      }
      return ok;
    }
  </script>

</body>
</html>
