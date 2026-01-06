<?php
    session_start();
    header('Content-Type: application/json');
    require_once('../models/productModel.php');
    require_once('../models/userModel.php');
    require_once('../models/orderModel.php');

    $action = $_REQUEST['action'];

 
    if(!isset($_SESSION['admin_status']) && $action !== 'login'){
        echo json_encode(['success' => false, 'message' => 'Unauthorized']);
        exit();
    }

    switch($action){
        
   
        case 'login':
           
            $email = $_POST['email']; 
            $password = $_POST['password'];
            if($email === 'admin@bestcart.com' && $password === 'password'){
                $_SESSION['admin_status'] = true;
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
            }
            break;

        case 'logout':
            session_destroy();
            echo json_encode(['success' => true]);
            break;

       
        case 'get_dashboard':
            $products = getAllProducts();
            $orders = getAllOrders();
            $users = getAllUser();
            
          
            $revenue = 0;
            foreach($orders as $o) $revenue += $o['total_amount'];

            echo json_encode([
                'stats' => [
                    'revenue' => number_format($revenue, 2),
                    'orders' => count($orders),
                    'users' => count($users)
                ],
                'recentOrders' => array_slice($orders, 0, 5) 
            ]);
            break;

        
        case 'get_products':
            echo json_encode(getAllProducts());
            break;

        case 'add_product':
            $data = [
                'name' => $_POST['name'],
                'price' => $_POST['price'],
                'quantity' => $_POST['stock']
            ];
          
            if(addProduct($data)){
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
            break;

        case 'delete_product':
            
            echo json_encode(['success' => true]); 
            break;

        
        case 'get_orders':
            echo json_encode(getAllOrders());
            break;

       
        case 'get_users':
            echo json_encode(getAllUser());
            break;
    }
?>