<?php   
//include('./login2.php');
require "connect.php";

session_start();
$search = $_POST['search'] ?? "";

$sql = "SELECT *
                FROM project.imagetbl
                INNER JOIN project.registration
                ON imagetbl.controlnumber = registration.id
                WHERE image IS NULL OR TRIM(image) = ''
        ";

        $result = $conn->query($sql);

        $blankCount = $result->num_rows;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://phptutorial.net/app/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <title>Admin Account</title>
</head>

<body class="container mt-5 d-flex justify-content-center">

<main class="my-container">

    <form class="search-box" action="adminaccount.php" method="post">
        <table>  
        <tr>
            <th>
                <a href="adminaccount_withoutcert.php"><button type="button" name="submit">Update</button></a>
                <!-- <a href="register1.php"><button type="button" name="submit">Register</button></a> -->
            </th>   
            <th>
                <input type="text" id="myInput" name="search" placeholder="Search name, username or email..." value="<?php echo ($search); ?>">
                <script>
                document.querySelectorAll('.search').forEach(function(input) {
                    input.addEventListener('keydown', function(event) {
                        if (event.key === 'Backspace') {
                            event.preventDefault(); // Prevent normal backspace
                            this.value = ''; // Clear the input field
                        }
                    });
                });
                </script>    
            </th>
            <th>
                    <button type="submit"  >Search</button>              
                    <button onclick="document.getElementById('myInput').value = ''">Clear</button>    
            </th>
            <!-- <th>
                 <a href="logout.php"><button type="button" class="isolated-btn" 
                 style="background: dark green; border: 0px; color: dark blue;
                    display: flex;
                    justify-content: space-between;
                    position: relative; left:50%;">LOGOUT</button></a>
            </th> -->
            <th>
                    <select 
                                style="text-align: center;
                                border: none;
                                 -moz-appearance: none;
                                -webkit-appearance: none;
                                -ms-appearance: none;
                                -o-appearance: none;
                                appearance: none; "
                            onchange="if(this.value) window.location.href=this.value;">
                        <option class="caps-lock-text"><?php echo $_SESSION['username']?></option>
                        <!-- <option value="profile.php"><button type="submit" method="post"> Profile </button></option> -->
                        <option value="logout.php">Logout</option>
                    </select>
            </th>
        </tr>
        
        </table>
    </form>
    </div>
    <!-- <br><br><br><br> -->
    <?php if ($blankCount > 0): ?>
    <div class="notification">
        ⚠️ <strong>Reminder!</strong>
        There are <?php echo $blankCount; ?>
        employee record(s) with blank required fields.
        Please complete the missing information.
    </div>
<?php else: ?>
    <div style="color: green;">
        ✓ All employee records are complete.
    </div>
<?php endif; ?>
    <!-- $blankCount = $result->num_rows; -->
    <div>
    <!-- <form class="search-box"> -->
    <table id="myTable">
    <thead>

        <tr>
        <th  onclick="sortTable(0)">ID</th>
        <th  onclick="sortTable(1)">Names</th>
        <th  onclick="sortTable(2)">Certificate Type</th>
        <th>Image</th>
        <th>Company</th>
        <th>Date Employed</th>
        
        <th>Action</th>
        <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        

        $sql= "SELECT *
                FROM project.imagetbl
                INNER JOIN project.registration
                ON imagetbl.controlnumber = registration.id
                WHERE role LIKE ?
                OR firstname LIKE ?
                OR lastname LIKE ?
                OR registration.id LIKE ?
                ";

           
            $stmt = $conn->prepare($sql);
            $result = mysqli_query($conn, $sql);
            $searchValue = "%" . $search . "%"; 
            $stmt->bind_param("ssss",$searchValue, $searchValue, $searchValue, $searchValue); 
            $stmt->execute(); $result = $stmt->get_result();

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                 $targetDir = $row['image'];
                 ?>
                 <tr>
                    
                    <td><?php echo $row['id'];?></td>
                    <td class="caps-lock-text"><?php echo $row['firstname']," ",$row['middleinitial'],"."," ",$row['lastname'];?></td>
                    <td><?php echo $row['certificate_type'];?></td>
                    <td><?php echo $row['image'];?></td>
                    <td><?php echo $row['company'];?></td>
                    <td><?php echo $row['workstarteddate'];?></td>
                    <td>
                        <a href="<?php echo $targetDir;?>" target="_blank" class="btn btn-primary" view>
                            VIEW</a>
                    </td>
                    <!-- <td>
                         <a href="adminaccount_withoutcert.php"><button type="button" name="submit" style="background: transparent; border: 1px; color: red">UPDATE</button></a>
                    </td> -->
                    <td> 
                        <a href="<?php echo $targetDir;?>" class="btn btn-secondary" upload>
                        <form action="uploadpage.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="upload" style="background: transparent; border: 0px; color: #5d5a7e">
                                + CERTIFICATE</button>
                        </form>
                        </a>
                        <a href="<?php echo $targetDir;?>" class="btn btn-secondary" delete>
                        <form action="delete.php" method="post" onsubmit="return confirm('Are you sure you want to delete this item?');" style="display:inline;">
                            <input type="hidden" name="imageid" value="<?php echo $row['imageid']; ?>">
                            <button type="submit" style="background: transparent; border: 1px; color: red">
                                DELETE ACCOUNT</button>
                        </form>
                        </a>
                    </td>
                    <!-- <td><?php echo $row['date'];?></td> -->
                 </tr>
                 <?php
            }
        } else {
           echo "<td colspan='3'>No results found</td>";
        }
         //}
        ?>
    </tbody>
</table>

    
<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>
       
</main>

</body>
</html>