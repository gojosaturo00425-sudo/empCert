<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="mystyle.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://phptutorial.net/app/css/style.css">
    <title>Welcome Page</title>
</head>
<body>
    <main>
    <h1>Welcome!</h1>
    <form action="adminlogin.php">
        <button type="submit" name="admin">Admin</button> 
    </form>
    <br>
    <form action="clientlogin.php">
        <button type="submit" name="user">User</button>
    </form>
</main>
</body>
</html>