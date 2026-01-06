<?php
    session_start();
    if (!isset($_SESSION['admin_status'])) {
        header('location: login.php');
        exit();
    }

    require_once('../models/productModel.php');
    require_once('../models/orderModel.php');
    require_once('../models/userModel.php');

    $p_count = count(getAllProducts());
    $o_count = count(getAllOrders());
    $u_count = count(getAllUser());

    
    $sales_data = getSalesByDate();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/admin.css?v=<?php echo time(); ?>">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>

    <?php include('menu.php'); ?>

    <div class="container">
        
        <div class="header-title">Dashboard Overview</div>

        <div class="stats-grid">
            <div class="card">
                <div class="stat-label">Total Products</div>
                <div class="stat-val"><?= $p_count ?></div>
            </div>
            <div class="card">
                <div class="stat-label">Total Orders</div>
                <div class="stat-val"><?= $o_count ?></div>
            </div>
            <div class="card">
                <div class="stat-label">Total Users</div>
                <div class="stat-val"><?= $u_count ?></div>
            </div>
        </div>

        <div class="card">
            <h3 style="margin-bottom:20px; display:flex; align-items:center; gap:10px;">
                <i data-lucide="calendar" style="width:20px"></i> Sales Report (Last 7 Days)
            </h3>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Orders Count</th>
                        <th>Total Revenue</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($sales_data)) { ?>
                        <tr>
                            <td colspan="3" style="text-align:center; color:#64748b; padding: 20px;">No sales found in database.</td>
                        </tr>
                    <?php } else { ?>
                        <?php foreach ($sales_data as $day) { ?>
                            <tr>
                                <td><b><?= $day['order_date'] ?></b></td>
                                <td><?= $day['total_orders'] ?> Orders</td>
                                <td style="color:#10b981; font-weight:bold;">$<?= number_format($day['total_sales'], 2) ?></td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>