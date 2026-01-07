<?php
// $order, $items
function money($n){ return (int)$n; }
$billing = [];
if ($order && !empty($order['billing_address'])) {
  $decoded = json_decode($order['billing_address'], true);
  if (is_array($decoded)) $billing = $decoded;
}
$productTotal = 0;
foreach ($items as $it) {
  $productTotal += (int)$it['price'] * (int)$it['qty'];
}
$delivery = 0;
if ($order) {
  $delivery = max(0, (int)$order['total_amount'] - $productTotal);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice</title>
  <style>
    body{margin:0;font-family:sans-serif;background:#ffffff;}
    .wrap{max-width:900px;margin:40px auto;padding:0 15px;}
    .card{border:2px solid #ffd0e6;border-radius:12px;padding:20px;}
    h1{color:#EC009B;margin:0 0 10px 0;}
    .row{display:flex;justify-content:space-between;gap:20px;flex-wrap:wrap;}
    .box{flex:1;min-width:260px;background:#fde6f4;padding:15px;border-radius:10px;}
    .title{color:#EC009B;font-weight:700;margin-bottom:8px;}
    table{width:100%;border-collapse:collapse;margin-top:15px;}
    th,td{border:1px solid #ffd0e6;padding:10px;text-align:left;}
    th{background:#fde6f4;color:#EC009B;}
    .totalLine{display:flex;justify-content:flex-end;margin-top:12px;font-size:18px;}
    .btn{display:inline-block;margin-top:15px;text-decoration:none;background:#EC009B;color:#fff;padding:10px 14px;border-radius:10px;font-weight:600;}
    .btn2{background:#00acd4;}
    .muted{color:#666;}
  </style>
</head>
<body>

<div class="wrap">
  <?php if(!$order): ?>
    <div class="card">
      <h1>Invoice Not Found</h1>
      <p class="muted">Invalid order ID.</p>
      <a class="btn" href="<?php echo e(url('order/history')); ?>">Go to Order History</a>
      <a class="btn btn2" href="<?php echo e(url('cart/index')); ?>">Go to Cart</a>
    </div>
  <?php else: ?>
    <div class="card">
      <h1>BestCart Invoice</h1>
      <div class="muted">Order ID: <strong><?php echo (int)$order['id']; ?></strong></div>
      <div class="muted">Date: <?php echo e($order['order_date'] ?? ''); ?></div>

      <div class="row" style="margin-top:15px;">
        <div class="box">
          <div class="title">Billing Info</div>
          <div><strong>Name:</strong> <?php echo e($billing['name'] ?? ($order['customer_name'] ?? '')); ?></div>
          <div><strong>Email:</strong> <?php echo e($billing['email'] ?? ($order['email'] ?? '')); ?></div>
          <div><strong>Phone:</strong> <?php echo e($billing['phone'] ?? ''); ?></div>
          <div><strong>Address:</strong> <?php echo e($billing['address'] ?? ''); ?></div>
          <div><strong>City:</strong> <?php echo e($billing['city'] ?? ''); ?></div>
          <div><strong>Postal:</strong> <?php echo e($billing['postal'] ?? ''); ?></div>
        </div>
        <div class="box">
          <div class="title">Order Summary</div>
          <div><strong>Status:</strong> <?php echo e($order['status'] ?? ''); ?></div>
          <div><strong>Product Total:</strong> ৳ <?php echo money($productTotal); ?></div>
          <div><strong>Delivery:</strong> ৳ <?php echo money($delivery); ?></div>
          <div style="margin-top:10px;font-size:18px;">
            <strong>Grand Total:</strong> ৳ <?php echo money($order['total_amount']); ?>
          </div>
        </div>
      </div>

      <table>
        <thead>
          <tr>
            <th>Item</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($items as $it): ?>
            <tr>
              <td><?php echo e($it['title']); ?></td>
              <td>৳ <?php echo money($it['price']); ?></td>
              <td><?php echo (int)$it['qty']; ?></td>
              <td>৳ <?php echo money((int)$it['price'] * (int)$it['qty']); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <div class="totalLine">
        <strong>Total: ৳ <?php echo money($order['total_amount']); ?></strong>
      </div>

      <a class="btn" href="<?php echo e(url('order/history')); ?>">Back to Order History</a>
      <a class="btn btn2" href="<?php echo e(url('cart/index')); ?>">Back to Cart</a>
    </div>
  <?php endif; ?>
</div>

</body>
</html>
