<?php
include('./connect.php');
//include("connect.php");
session_start();



$msg='';
if(isset($_POST['submit'])){
    $password = $_POST['password'];
    $email = $_POST['email'];
    $_SESSION['email'] = $email;

    $select1="SELECT * from registration where 
        email='$email'and password='$password'";
    $select_user = mysqli_query($conn,$select1);
    

    if(mysqli_num_rows($select_user)>0){
        $row1=mysqli_fetch_assoc($select_user);

        $_SESSION['user']= $row1['email'];
            $_SESSION['id']= $row1['id'];
            $_SESSION['firstname']= $row1['firstname'];
            $_SESSION['middleinitial']= $row1['middleinitial'];
            $_SESSION['lastname']= $row1['lastname'];
            $_SESSION['gender']= $row1['gender'];
             
             $_SESSION['username']= $row1['username'];
            if($row1['role'] == 'user'){
            
            header('location:clientaccount.php');
           
            }
            elseif($row1['role'] == 'admin'){
           
            header('location:adminaccount.php');

            // elseif($email === "admin@123" && $password==="123"){
            // //$_SESSION['admin']= $row1['email'];
            // //$_SESSION['id']= $row1['id'];
            // header('location:adminaccount.php');
        }else{
            echo $msg="incorrect email and password!";
        }
            
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="mystyle.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://phptutorial.net/app/css/style.css">
    <title>Login</title>
</head>
<body>
    
<main>
    <form action="" method="post">
        <!-- <form action="" method="post"> -->

        <h1>Login</h1>
        <div>
            <label for="username">Email:</label>
            <input type="email" name="email" id="email"
            class = "form-control" autocomplete="off" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password"
            class = "form-control" autocomplete="off" required>
        </div>
        <section>
            <button class="btn font-weight-bold" name="submit">Login</button>
            <!-- <a href="logout.php">Logout</a> <button>logout</button> -->
            <a href="register.php">Register</a>
            <!-- <a href="clientacco.php">Register</a> -->
        </section>
    </form>
    
</main>
</body>
</html>