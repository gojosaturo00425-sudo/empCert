<?php
    include('./connect.php');
require_once('./operation.php');
$id = isset($_POST['id']) ? $_POST['id'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
</head>
<title>Upload Form</title>
   <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="mystyle.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://phptutorial.net/app/css/style.css">

<body>
<main>
    <h1 class="text-center my-3">Upload Form</h1>
    <a href="adminaccount_withoutcert.php"><button class="btn btn-primary" name="submit">Back</button></a><br><br>
    <div class="container d-flex justify-content-center">
    <form action="display.php" method="POST" enctype="multipart/form-data" >
        
        <input type="number" name="imageid"
         <?php $sql = "SELECT * FROM imagetbl ORDER BY imageid DESC LIMIT 1";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                ?>
                value="<?php echo htmlspecialchars($row['imageid'] ?? ''); ?>"
                readonly>
        <!-- <input type="number" id="received_id" name="controlnumber" value="<?php echo ($id); ?>"><br><br> -->
        <!-- <?php inputFields("000", "controlnumber", "","controlnumber");?> -->
        <select name="certificate_type" id="" class="form-control" required>
                        <option value="">--Select Certificate Type--</option>
                        <option value="Certificate of Emloyment">Certificate of Emloyment</option>
                        <option value="Certificate with Salary/Renumeration">Certificate with Salary/Renumeration</option>
                        <option value="Certificate of No Take Homepay">Certificate of No Take Homepay</option>
                        <option value="Certificate of Bank Endorsement">Certificate of Bank Endorsement</option>
                        <option value="Certificate No Pending Case">Certificate No Pending Case</option>
                    </select>
        <?php inputFields("", "file", "","file");?>
        <button class="btn btn-secondary" name="submit">Upload</button>
        <!-- <button type="submit" name="submit">UPLOAD</button> -->

    </form>
    </div>
</main>
</body>
</html>