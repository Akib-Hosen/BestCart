<?php
    require_once('../models/userModel.php');
    if(isset($_POST['submit']) == true){
        session_start();
        $password = $_REQUEST['password'];
        $email = $_REQUEST['email'];
        $username = $_REQUEST['username'];
                   
            $user = ['password'=>$password, 'email'=>$email, 'username'=> $username];
            $status = addUser($user);
            if($status){
                header('location: ../views/login.php');
            }
            else{
                header('location: ../views/register.php');
            }
        
    }else{
        header('location: ../views/register.php');
    }

?>