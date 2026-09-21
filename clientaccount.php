<?php   
//include('./login2.php');
require "connect.php";
session_start();


?>
<!DOCTYPE html>
<html lang="en">
<head>
 
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://phptutorial.net/app/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <title>Client Account</title>
</head>
<body class="container mt-5 d-flex justify-content-center">
                    
<main class="my-container"> 
    <table>
        <form action="">
        <thead>
    
            <tr>
    <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th>
    </th><th></th><th></th><th></th><th></th><th></th><th></th></th><th>
                <th>
                    <select style="text-align: center;
                                    border: none;
                                  -moz-appearance: none;
                                  -webkit-appearance: none;
                                  -ms-appearance: none;
                                  -o-appearance: none;
                                  appearance: none;"
                            onchange="if(this.value) window.location.href=this.value;">
                        <option value=""><?php echo $_SESSION['email']?></option>
                        
                        <option value="profile.php"><button type="submit" method="post"> Profile </button></option>
                        <option value="logout.php">Logout</option>
                    </select>
                </th>
                
            </tr>

        </thead>
        </form>
    </table>

    
    <div class="table-responsive">
    <div>
        <table id="myTable">
        <thead class="table-header">
        <tr>
        <th style="width: 50%;" onclick="sortTable(2)">Certificate Type</th>
        <th>Image</th>
        <th style="width: 5%;">Action</th>
            </tr>
        </thead>
        <tbody>
        <tr>
            <?php
        $email = $_SESSION['email'];
        if(isset($_SESSION['email'])){
        $_SESSION['email'] = $email;
        
        $firstname = $_POST['firstname'] ?? "";;
        $_SESSION['firstname'] = $firstname;
        // $email = $_POST['email'];
        $targetDir = "uploads/";
        
        // $sql= "SELECT * FROM registration where email= '$email'";
        
        $sql="SELECT *
            FROM project.imagetbl
            INNER JOIN project.registration
            ON imagetbl.controlnumber = registration.id
            where email like '%$email%';
            ";
        // $sql="SELECT * FROM registration where email like '%$email%'";
        $result = mysqli_query($conn, $sql);
        // 3. Check if any rows were returned and fetch the data
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $targetDir = $row['image'];
        ?>
                    <!-- <td><?php echo $row['id'];?></td> -->
                    <td> <?php echo $row['certificate_type'];?></td>
                    <td> <?php echo $row['image'];?></td>
                    <td>
                        <a href="<?php echo $targetDir;?>" target="_blank" class="btn btn-primary" view>FILE VIEW</a>
                        <a href="<?php echo $targetDir;?>" class="btn btn-danger" download>DOWNLOAD</a>
                 </tr>
                 <?php
            }
        } else {
            echo "0 results found.";
        }
        }
        ?>
    </tbody>
    </table>
    
    </div>
</div>
</main>
</body>
</html>