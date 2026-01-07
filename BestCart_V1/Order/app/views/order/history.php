<?php
// $orders
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order History</title>
  <style>
    body{margin:0;font-family:sans-serif;background:#ffffff;}
    .wrap{max-width:1000px;margin:40px auto;padding:0 15px;}
    h1{color:#EC009B;text-align:center;}
    table{width:100%;border-collapse:collapse;margin-top:20px;}
    th,td{border:1px solid #ffd0e6;padding:12px;text-align:left;}
    th{background:#fde6f4;color:#EC009B;}
    .btn{
      text-decoration:none;background:#EC009B;color:#fff;padding:8px 12px;border-radius:8px;font-weight:600;
      display:inline-block;
    }
    .topLinks{display:flex;justify-content:space-between;align-items:center;margin-top:20px;}
    .link{color:#EC009B;text-decoration:none;font-weight:600;}
    .empty{background:#fde6f4;padding:25px;border-radius:12px;text-align:center;color:#6d7482;margin-top:20px;}
  </style>
</head>
<body>

<div class="wrap">
  <h1>Your Order History</h1>

  <div class="topLinks">
    <a class="link" href="<?php echo e(url('cart/index')); ?>">← Back to Cart</a>
    <a class="link" href="<?php echo e(url('checkout/index')); ?>">Go to Checkout →</a>
  </div>

  <?php if (empty($orders)): ?>
    <div class="empty">No orders found in DB. Place an order from checkout.</div>
  <?php else: ?>
    <table>
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Date</th>
          <th>Status</th>
          <th>Total</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($orders as $o): ?>
          <tr>
            <td><?php echo (int)$o['id']; ?></td>
            <td><?php echo e($o['order_date'] ?? ''); ?></td>
            <td><?php echo e($o['status'] ?? ''); ?></td>
            <td>৳ <?php echo (int)$o['total_amount']; ?></td>
            <td>
              <a class="btn" href="<?php echo e(url('order/invoice', ['id' => (int)$o['id']])); ?>">Invoice</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>

</body>
</html>
