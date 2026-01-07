<?php
// $order
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Success</title>
  <style>
    body{margin:0;font-family:sans-serif;background:#fde6f4;}
    .box{
      max-width:700px;margin:60px auto;background:#fff;padding:30px;border-radius:12px;
      box-shadow:0 4px 15px rgba(0,0,0,.1); border:2px solid #EC009B33;
      text-align:center;
    }
    h1{color:#EC009B;margin:10px 0;}
    .btn{
      display:inline-block;text-decoration:none;background:#EC009B;color:#fff;
      padding:12px 18px;border-radius:10px;margin:10px; font-weight:600;
    }
    .btn2{background:#00acd4;}
    .muted{color:#555;}
  </style>
</head>
<body>

  <div class="box">
    <?php if($order): ?>
      <div style="font-size:60px;">✅</div>
      <h1>Order Confirmed!</h1>
      <p class="muted">Your order has been placed successfully.</p>
      <p><strong>Order ID:</strong> <?php echo (int)$order['id']; ?></p>
      <p><strong>Total:</strong> ৳ <?php echo (int)$order['total_amount']; ?></p>

      <a class="btn" href="<?php echo e(url('order/invoice', ['id' => (int)$order['id']])); ?>">View Invoice</a>
      <a class="btn btn2" href="<?php echo e(url('order/history')); ?>">View Order History</a>
      <br><br>
      <a href="<?php echo e(url('cart/index')); ?>" style="color:#EC009B;font-weight:600;text-decoration:none;">← Back to Shop</a>
    <?php else: ?>
      <div style="font-size:60px;">⚠️</div>
      <h1>Order Not Found</h1>
      <p class="muted">Invalid or missing order ID.</p>
      <a class="btn" href="<?php echo e(url('order/history')); ?>">Go to Order History</a>
      <a class="btn btn2" href="<?php echo e(url('cart/index')); ?>">Go to Cart</a>
    <?php endif; ?>
  </div>

</body>
</html>
