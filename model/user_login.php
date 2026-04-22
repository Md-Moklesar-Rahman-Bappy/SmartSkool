<?php
session_start();
include_once('controller/config.php');

if(isset($_POST["do"]) && $_POST["do"] == "user_login"){

    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = $_POST["password"]; 
    
    $sql = "SELECT * FROM user WHERE email='$email'";    
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if (!$row) {
        header("Location: view/login.php?do=login_error&msg=1");
        exit;
    }
    
    $email1 = $row['email'];
    $password1 = $row['password'];
    $type = $row['type'];
    
    $msg = 0;
    
    if($email == $email1 && $password == $password1){
        if($type == "Student"){
            $sql1 = "SELECT * FROM student WHERE email='$email'";    
            $result1 = mysqli_query($conn, $sql1);
            $row1 = mysqli_fetch_assoc($result1);
    
            $index_number = $row1['index_number'];
            $_SESSION["index_number"] = $index_number;
            $_SESSION["type"] = "Student";
            header("Location: view/dashboard1.php");
            exit;
        }
        
        if($type == "Teacher"){
            $sql1 = "SELECT * FROM teacher WHERE email='$email'";    
            $result1 = mysqli_query($conn, $sql1);
            $row1 = mysqli_fetch_assoc($result1);
    
            $index_number = $row1['index_number'];
            $_SESSION["index_number"] = $index_number;
            $_SESSION["type"] = "Teacher";
            header("Location: view/dashboard2.php");
            exit;
        }
        
        if($type == "Admin"){
            $sql1 = "SELECT * FROM admin WHERE email='$email'";    
            $result1 = mysqli_query($conn, $sql1);
            $row1 = mysqli_fetch_assoc($result1);
    
            $index_number = $row1['index_number'];
            $_SESSION["index_number"] = $index_number;
            $_SESSION["type"] = "Admin";
            header("Location: view/dashboard.php");
            exit;
        }
        
        if($type == "Parents"){
            $sql1 = "SELECT * FROM parents WHERE email='$email'";    
            $result1 = mysqli_query($conn, $sql1);
            $row1 = mysqli_fetch_assoc($result1);
    
            $index_number = $row1['index_number'];
            $_SESSION["index_number"] = $index_number;
            $_SESSION["type"] = "Parents";
            header("Location: view/dashboard3.php");
            exit;
        }
    } else {
        $msg += 1;
        header("Location: view/login.php?do=login_error&msg=$msg");
        exit;
    }
}
?>