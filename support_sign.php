<?php

if(isset($_POST['login']) || isset($_POST['signup'])){
    include 'connection.php';
    session_start();

    if(isset($_POST['login'])){
        $log_email =$_POST['log_email'];
        $log_pass  =$_POST['log_pass'];
        $q="SELECT name,password from support where email='$log_email'; ";
        $q1=mysqli_query($con,$q);
        $row=mysqli_fetch_array($q1);
        if($row['password'] == $log_pass){
            $_SESSION['support_log_name'] =$row['name'];
            $_SESSION['support_log_email'] =$log_email;
            header("location:support_home.php");
        }
        else{
            echo "incorrect email or password";
        }
    }
    else if(isset($_POST['signup'])){
        $sign_name    =$_POST['sign_name'];
        $sign_pass    =$_POST['sign_pass'];
        $sign_email   =$_POST['sign_email'];
        $sign_phone   =$_POST['sign_phone'];
        $sign_address =$_POST['sign_address'];
        $q2="SELECT email from support where email='$sign_email' ";
        $row=mysqli_query($con,$q2);
        $rowcount=mysqli_num_rows($row);
        if($rowcount>0){
            echo "already exist";
        }
        else{
            $q1="INSERT INTO `support` (`name`, `password`, `email`, `phone`, `address`) VALUES ('$sign_name', '$sign_pass', '$sign_email', '$sign_phone', '$sign_address');";
            $q3=mysqli_query($con,$q1);
            if($q3){
                $_SESSION['support_log_email'] =$sign_email;
                $_SESSION['support_log_name'] =$sign_name;
                header("location:support_home.php");    
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Main Page</title>
    <link rel="shortcut icon" href="logo.png" type="image/png">
</head>
<body>
    <div>
        <form  method="post">
            email<input type="email" name="log_email" required><br>
            pass<input type="password" name="log_pass" required><br>
            <input type="submit" name="login" value="Login"><br>
        </form>
    </div>
    <br><br>
    <div>
        <form method="post">
            name<input type="text" name="sign_name" required><br>
            pass<input type="password" name="sign_pass" required><br>
            email<input type="email" name="sign_email" required><br>
            phone<input type="text" name="sign_phone" required><br>
            address<input type="text" name="sign_address" required><br>
            <input type="submit" name="signup" value="Sign Up">
        </form>
    </div>
    <a href="index.php"><button>Sign Up as user</button></a>
</body>
</html>