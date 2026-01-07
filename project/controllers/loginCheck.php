<?php
    require_once('../models/userModel.php');
    if(isset($_POST['submit']) == true){
    session_start();
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
   
        $user = ['email'=> $email, 'password'=>$password];
        $status = login($user);
        if($status){
            setcookie('status', 'true', time()+3000, '/');
            $_SESSION['email'] = $email;
            header('location: ../views/profile.php');
            
        }
        else{
            echo "Invalid email/password...";
        }
}
    else{
        header('location: ../views/login.php');
    }

?>