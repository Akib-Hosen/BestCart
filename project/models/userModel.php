<?php
    require_once('db.php');

    function login($user){
    $con = getConnection();

    $email    = $user['email'];
    $password = $user['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result) == 1){
        return true;   
    }else{
        return false;
    }
}


    function addUser($user){
    $con = getConnection();

    $email    = $user['email'];
    $password = $user['password'];
    $username = $user['username'];
    $role     = "customer";

    
    $checkSql = "SELECT id FROM users WHERE email='$email'";
    $checkResult = mysqli_query($con, $checkSql);

    if(mysqli_num_rows($checkResult) > 0){
        
        echo "This email already exists. Please login.";
        return false;
    }


    $sql1 = "INSERT INTO users (username, password, email, role)
             VALUES ('$username', '$password', '$email', '$role')";
    $status1 = mysqli_query($con, $sql1);


    $sql2 = "INSERT INTO userinfo (username, email, role, phone, address, gender)
             VALUES ('$username', '$email', '$role', '', '', '')";
    $status2 = mysqli_query($con, $sql2);

    if($status1 && $status2){
        return true;
    }
    else{
        return false;
    }
    }



    function updatePassword($email, $newPassword) {
    $con = getConnection();  
    
    
    $sql = "UPDATE users SET password = '$newPassword' WHERE email = '$email'";

    if (mysqli_query($con, $sql)) {
        return true;  
    } else {
        return false;  
    }
    }

    
function insertOrUpdateProfile($userData){
    $con = getConnection();

    $email    = $userData['email'];
    $username = $userData['username'];
    $phone    = $userData['phone'];
    $address  = $userData['address'];
    $gender   = $userData['gender'];
    $role     = "customer";

    
    $sqlCheck = "SELECT * FROM userinfo WHERE email='$email'";
    $r = mysqli_query($con, $sqlCheck);

    if(mysqli_num_rows($r) > 0){
        
        $sql = "UPDATE userinfo 
                SET username='$username',
                    phone='$phone',
                    address='$address',
                    gender='$gender'
                WHERE email='$email'";
    }else{
       
        $sql = "INSERT INTO userinfo (username, email, role, phone, address, gender)
                VALUES('$username', '$email', '$role', '$phone', '$address', '$gender')";
    }

    if(mysqli_query($con, $sql)){
        return true;
    }else{
        return false;
    }
}






function getUserProfile($email) {
    $con = getConnection();  

    $sql = "SELECT email, username, phone, address, gender FROM userInfo WHERE email = '$email'";

    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);  
    }

    return null;  
}

?>