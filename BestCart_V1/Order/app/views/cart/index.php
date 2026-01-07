<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BestCart Cart</title>

<style>

*{font-family: sans-serif;}
.logo{display:flex;} .logoText{color:#00acd4;}
.navLink{display:flex;color:#EC009B;text-decoration:none;gap:5px;}
.logoArea{display:flex;justify-content:space-evenly;align-items:center;}
.logoArea input{border-radius:5px;border:1px solid #6d7482;color:#858D9E;padding:20px;width:320px;}
.searchBtn{background-color:#EC009B;color:white;padding:12px;border-radius:5px;border:none;}
.pink{background-color:#fde6f4;height:40px;margin:0;padding:5px;display:flex;align-items:center;gap:16px;justify-content:flex-end;padding-right:50px;}
.footer{display:flex;align-items:flex-start;justify-content:space-evenly;padding:40px;}
.copyright{border-top:1px solid #858D9E;display:flex;align-items:center;justify-content:center;width:80%;margin:auto;}
.titleFooter{font-size:large;color:black;}
.followLink{color:#EC009B;text-decoration:none;font-size:xx-large;}
.about{display:flex;align-items:center;gap:3px;}
.aref{display:flex;flex-direction:column;text-decoration:none;color:#6d7482;gap:6px;}
.aref a{text-decoration:none;color:#6d7482;}

h1{text-align:center;color:#EC009B;margin-top:20px;}
.cartBox{max-width:900px;margin:auto;background:#fde6f4;padding:20px;border-radius:10px;}
.cart-item{display:flex;justify-content:space-between;align-items:center;background:white;padding:15px;border-radius:10px;margin-bottom:15px;border:1px solid #EC009B44;}
.item-info{display:flex;align-items:center;gap:15px;}
.item-info img{width:80px;height:80px;border-radius:10px;}
.item-title{font-size:18px;font-weight:bold;color:#EC009B;}
.qty-btn{background:#EC009B;color:white;border:none;padding:6px 12px;border-radius:5px;cursor:pointer;}
.remove-btn{background:#EC009B;color:white;border:none;padding:8px 12px;border-radius:5px;cursor:pointer;}
.total{text-align:right;font-size:22px;color:#EC009B;font-weight:bold;margin-top:15px;}
.checkout-btn{width:100%;background:#EC009B;color:white;border:none;padding:15px;font-size:18px;border-radius:10px;margin-top:15px;cursor:pointer;}

.catalogBox{max-width:900px;margin:20px auto;padding:20px;border:1px dashed #EC009B55;border-radius:10px;}
.catalogItem{display:flex;justify-content:space-between;align-items:center;padding:12px;border-bottom:1px solid #eee;}
.addBtn{background:#00acd4;color:white;border:none;padding:10px 14px;border-radius:8px;cursor:pointer;}
.errorBox{max-width:900px;margin:10px auto;background:#fff3f3;border:1px solid #ffbaba;color:#b10000;padding:10px;border-radius:8px;}
</style>
</head>

<body style="margin:0;">


<nav class="pink">
    <a class="navLink" href="<?php echo e(url('cart/index')); ?>"><i class="hgi hgi-stroke hgi-home-09"></i>Home</a>
    <a class="navLink" href="#"><i class="hgi hgi-stroke hgi-customer-service-01"></i>Help & Support</a>
</nav>


<section class="logoArea" style="height:70px;padding:5px;">
    <div class="logo">
        <img src="" alt="" height="70px">
        <h1 class="logoText">BestCart</h1>
    </div>
    <div>
        <input type="search" placeholder="Search your products" style="height:30px;border:1px solid #fde6f4;">
        <button class="searchBtn">Search</button>
    </div>
</section>

<?php if (!empty($flashError)): ?>
  <div class="errorBox"><?php echo e($flashError); ?></div>
<?php endif; ?>


<div class="catalogBox">
  <h2 style="color:#EC009B;margin:0 0 10px 0;">Products (from DB)</h2>
  <?php if (empty($catalog)): ?>
    <div style="color:#6d7482;">No products found in DB.</div>
  <?php else: ?>
    <?php foreach ($catalog as $p): ?>
      <div class="catalogItem">
        <div style="display:flex;gap:12px;align-items:center;">
          <img src="<?php echo e($p['image'] ?: 'default.png'); ?>" style="width:55px;height:55px;border-radius:8px;">
          <div>
            <div style="font-weight:bold;color:#EC009B;"><?php echo e($p['name']); ?></div>
            <div>৳<?php echo (int)$p['price']; ?> <span style="color:#6d7482;">(Stock: <?php echo (int)$p['quantity']; ?>)</span></div>
          </div>
        </div>
        <a class="addBtn" href="<?php echo e(url('cart/add', ['id' => (int)$p['id']])); ?>">Add to Cart</a>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>

<!-- CART PAGE CONTENT -->
<h1>Your Shopping Cart</h1>

<div class="cartBox" id="cart">
  <?php if (count($cartItems) === 0): ?>
    <div style="text-align:center;color:#6d7482;padding:30px;background:white;border-radius:10px;">
      Cart is empty.
    </div>
  <?php else: ?>
    <?php foreach ($cartItems as $item): ?>
      <div class="cart-item">
        <div class="item-info">
          <img src="assets/img/<?php echo e($item['img']); ?>">
          <div>
            <div class="item-title"><?php echo e($item['title']); ?></div>
            <div>৳<?php echo (int)$item['price']; ?></div>
          </div>
        </div>

        <div>
          <button class="qty-btn" type="button" onclick="changeQty(<?php echo (int)$item['id']; ?>, -1)">-</button>
          <input
            id="qty_<?php echo (int)$item['id']; ?>"
            type="number"
            min="1"
            max="99"
            value="<?php echo (int)$item['qty']; ?>"
            style="width:55px;text-align:center;border:1px solid #eee;border-radius:6px;padding:6px;"
            oninput="qtyValidate(this)"
          />
          <button class="qty-btn" type="button" onclick="changeQty(<?php echo (int)$item['id']; ?>, 1)">+</button>

          <form method="post" action="<?php echo e(url('cart/updateqty')); ?>" style="display:inline;">
            <input type="hidden" name="id" value="<?php echo (int)$item['id']; ?>">
            <input type="hidden" id="postqty_<?php echo (int)$item['id']; ?>" name="qty" value="<?php echo (int)$item['qty']; ?>">
            <button class="qty-btn" type="submit" onclick="syncQty(<?php echo (int)$item['id']; ?>)">Update</button>
          </form>
        </div>

        <a class="remove-btn" href="<?php echo e(url('cart/remove', ['id' => (int)$item['id']])); ?>">Remove</a>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>

<div class="total" id="totalPrice">Total: ৳<?php echo (int)$total; ?></div>

<?php if (count($cartItems) > 0): ?>
  <a href="<?php echo e(url('checkout/index')); ?>" style="text-decoration:none;">
    <button class="checkout-btn">Proceed to Checkout</button>
  </a>
<?php else: ?>
  <button class="checkout-btn" disabled style="opacity:.6;cursor:not-allowed;">Proceed to Checkout</button>
<?php endif; ?>

<script>
function qtyValidate(inp){
  let v = parseInt(inp.value || "1", 10);
  if (isNaN(v) || v < 1) v = 1;
  if (v > 99) v = 99;
  inp.value = v;
}
function changeQty(id, delta){
  const input = document.getElementById("qty_" + id);
  let v = parseInt(input.value || "1", 10);
  v = v + delta;
  if (v < 1) v = 1;
  if (v > 99) v = 99;
  input.value = v;
}
function syncQty(id){
  const input = document.getElementById("qty_" + id);
  qtyValidate(input);
  document.getElementById("postqty_" + id).value = input.value;
}
</script>

<footer>
  <div class="footer">
    <div>
      <p><strong>Address:</strong> Kuril, Dhaka</p>
      <p><strong>Phone:</strong> 0123456789</p>
      <p><strong>Email:</strong> customer.care@bestcart.com</p>
    </div>
    <div class="aref">
      <p class="titleFooter">BestCart</p>
      <a href="#">About Us</a>
      <a href="#">BestCart Blog</a>
      <a href="#">Cookies Policy</a>
    </div>
    <div class="aref">
      <p class="titleFooter">Customer Care</p>
      <a href="#">Return & Refund</a>
      <a href="#">Privacy Policy</a>
      <a href="#">Return Policy</a>
      <a href="#">Terms & Conditions</a>
    </div>
    <div>
      <p>Follow us on:</p>
      <a class="followLink" href="#"><i class="hgi hgi-stroke hgi-instagram"></i></a>
      <a class="followLink" href="#"><i class="hgi hgi-stroke hgi-youtube"></i></a>
      <a class="followLink" href="#"><i class="hgi hgi-stroke hgi-linkedin-01"></i></a>
      <a class="followLink" href="#"><i class="hgi hgi-stroke hgi-facebook-01"></i></a>
    </div>
  </div>
  <div class="copyright">
    <i class="hgi hgi-stroke hgi-copyright"></i>
    <p>2025 BestCart © All Rights Reserved.</p>
  </div>
</footer>

</body>
</html>
