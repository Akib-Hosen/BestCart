<?php
    require_once('db.php');

    
    function getAllOrders($search = ""){
        $con = getConnection();
        if($search != ""){
            $s = mysqli_real_escape_string($con, $search);
           
            $sql = "SELECT * FROM orders 
                    WHERE id LIKE '%$s%' 
                    OR customer_name LIKE '%$s%' 
                    OR email LIKE '%$s%' 
                    ORDER BY id DESC";
        } else {
            $sql = "SELECT * FROM orders ORDER BY id DESC";
        }
        
        $result = mysqli_query($con, $sql);
        $data = [];
        while($row = mysqli_fetch_assoc($result)) $data[] = $row;
        return $data;
    }

    function getOrderById($id){
        $con = getConnection();
        $id = mysqli_real_escape_string($con, $id);
        $result = mysqli_query($con, "SELECT * FROM orders WHERE id=$id");
        return mysqli_fetch_assoc($result);
    }

    
    function addOrder($o){
        $con = getConnection();
        $name = mysqli_real_escape_string($con, $o['customer_name']);
        $email = mysqli_real_escape_string($con, $o['email']); // New
        $status = mysqli_real_escape_string($con, $o['status']);
        $date = mysqli_real_escape_string($con, $o['order_date']);
        $ship = mysqli_real_escape_string($con, $o['shipping_address']); 
        $bill = mysqli_real_escape_string($con, $o['billing_address']);
        $items = mysqli_real_escape_string($con, $o['order_items']);
        
        $sql = "INSERT INTO orders (customer_name, email, total_amount, status, order_date, shipping_address, billing_address, order_items) 
                VALUES ('$name', '$email', '{$o['total_amount']}', '$status', '$date', '$ship', '$bill', '$items')";
        return mysqli_query($con, $sql);
    }

    function updateOrder($o){
        $con = getConnection();
        $id = mysqli_real_escape_string($con, $o['id']);
        $name = mysqli_real_escape_string($con, $o['customer_name']);
        $email = mysqli_real_escape_string($con, $o['email']); // New
        $status = mysqli_real_escape_string($con, $o['status']);
        $date = mysqli_real_escape_string($con, $o['order_date']);
        $ship = mysqli_real_escape_string($con, $o['shipping_address']); 
        $bill = mysqli_real_escape_string($con, $o['billing_address']);
        $items = mysqli_real_escape_string($con, $o['order_items']);

        $sql = "UPDATE orders SET customer_name='$name', email='$email', total_amount='{$o['total_amount']}', status='$status', order_date='$date', shipping_address='$ship', billing_address='$bill', order_items='$items' WHERE id=$id";
        return mysqli_query($con, $sql);
    }

    function deleteOrder($id){
        $con = getConnection();
        return mysqli_query($con, "DELETE FROM orders WHERE id=$id");
    }

   
    function getSalesByDate(){
        $con = getConnection();
        $sql = "SELECT order_date, SUM(total_amount) as total_sales, COUNT(*) as total_orders 
                FROM orders GROUP BY order_date ORDER BY order_date DESC LIMIT 7";
        $result = mysqli_query($con, $sql);
        $data = [];
        while($row = mysqli_fetch_assoc($result)) $data[] = $row;
        return $data;
    }
?>