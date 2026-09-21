<?php
include('./connect.php');
//include("connect.php");
//session_start();
// $id = $_POST['id'] ?? '';
$controlnumber = isset($_POST['controlnumber']) ? $_POST['controlnumber'] : '';
$msg='';

if(isset($_POST['submit'])){
    
    
    $firstname = $_POST['firstname'];
    $middleinitial = $_POST['middleinitial'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $position = $_POST['position'];
    $role = $_POST['role'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $workstarteddate = $_POST['workstarteddate'];
    $company = $_POST['company'];
    
    $birthdate = $_POST['birthdate'];
    $gender=$_POST['gender'];
    $number=$_POST['number'];
    $controlnumber=$_POST['controlnumber'];

    $select1="SELECT * FROM registration WHERE email='$email' and password='$password'";
    $select_user=mysqli_query($conn,$select1);
    if(mysqli_num_rows($select_user)>0){
         $msg="user already exist!";
    }else{
        $insert2="INSERT INTO registration
        (firstname, middleinitial, lastname, birthdate, gender, contact, email,
        position, role, username, password, workstarteddate, company)
        VALUES ( '$firstname', '$middleinitial', '$lastname','$birthdate', '$gender', '$number', '$email',
        '$position', '$role', '$username', '$password', '$workstarteddate', '$company')";
        
        $insert3="INSERT INTO imagetbl
        (controlnumber)
        VALUES ( '$controlnumber')";

        mysqli_query($conn,$insert2);
        mysqli_query($conn,$insert3);
        header('location:login.php');
        }echo "Error Details: ".$conn->error; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="mystyle.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://phptutorial.net/app/css/style.css">
    <title>Registration Form</title>
</head>

<body>
    <main>
            <form action="" method="post">
                <h2>Registration</h2>
                <p class="msg"><? = $msg?></p>
                
                    <select name="position" id="" class="form-control" required>
                        <option value="">--Select Position--</option>
                        <option value="regular">Regular</option>
                        <option value="contractual">Contactual</option>
                    </select>
                <br><br>
                 <input type="hidden" name="controlnumber"
                 <?php $sql = "SELECT * FROM registration ORDER BY id DESC LIMIT 1";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                ?>
                value="<?php echo htmlspecialchars($row['id']+1 ?? ''); ?>"
                readonly>
                <label for="">First name:</label>
                <div class="form-group">
                    <input type="text" name="firstname" placeholder="First name" class="form-control"  oninput="this.value = this.value.toUpperCase()">
                </div>
                <label for="">Middle initial:</label>
                <div class="form-group">
                    <input type="text" name="middleinitial" placeholder="Middle initial" class="form-control" maxlength="1"  oninput="this.value = this.value.toUpperCase()">
                </div>
                <label for="">Last name:</label>
                <div class="form-group">
                    <input type="text" name="lastname" placeholder="Last name" class="form-control"  oninput="this.value = this.value.toUpperCase()">
                </div>
                <label for="">Birth date:</label>
                <input type="date" name="birthdate" autocomplete="off" >
                <br><br>
                <label for="">Gender:</label>
                <div class="form-group">
                    <select name="gender" class="form-control">
                        <option value="">--Select Gender--</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                
                <div>
                <label for="">Contact numer:</label>
                <!-- <select name="contact">
                    <option value="+63">🇵🇭 +63 Philippines</option>
                    <option value="+1">🇺🇸 +1 USA</option>
                    <option value="+44">🇬🇧 +44 UK</option>
                    <option value="+81">🇯🇵 +81 Japan</option>
                </select> -->
                <input type="tel" name="number" maxlength="10" pattern="[0-9]{10}" placeholder="9123456789">
                </div><br>


                <label for="">Office name:</label>
                <div class="form-group">
                    <input type="text" name="company" placeholder="Company name"  oninput="this.value = this.value.toUpperCase()">
                </div>
                
                <label for="">When did you start to work at this company?</label>
                <input type="date" name="workstarteddate" autocomplete="off" >
                <br><br>
                
                <label for="">Email address:</label>
                <div class="form-group">
                <input type="email" name="email" placeholder="Email" class="form-control" required>
                </div>
                <label for="">Username:</label>
                <div class="form-group">
                    <input type="hidden" name="role" value="user">
                </div>
                <div class="form-group">
                <input type="text" name="username" placeholder="Username" class="form-control" required>
                </div>
                <label for="">Password:</label>
                <div class="form-group">
                <input type="password" name="password" placeholder="Password" class="form-control" required>
                </div>
                
                <button class= "btn font-weight-bold" type="submit" name="submit">Register Now</button>
                <p>Already have an account <a href="index.php">Login Now!</a></p>
            </form>
            <!-- <section>
        <div>
        <a href="adminaccount.php"><button class="btn btn-primary" name="submit">Back</button></a>
        <a href="register1.php"><button class="btn btn-primary" name="submit">Register</button></a>
        
        </div>
        <br>
        </section> -->
</main>
</body>
</html>