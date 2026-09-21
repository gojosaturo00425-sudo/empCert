<?php
    include('./connect.php');
    //include('./operation.php');
    //$image=$_FILES['file'];
    $message = "";
    $targetDir = "uploads/";
    $controlnumber=$_POST['controlnumber']?? "";

    if(isset($_FILES['file'])&& $_FILES['file']['error']==0){
    // $username=$_POST['username'];
    
    // $email=$_POST['email'];
    $fileName = basename($_FILES['file']['name']);
    $image = $targetDir.$fileName;
    $certificate_type=$_POST['certificate_type'];
    $imageid=$_POST['imageid'];

    if(move_uploaded_file($_FILES['file']['tmp_name'],$image)){

        $sql="INSERT INTO imagetbl(controlnumber,image, certificate_type) VALUES 
        ('$controlnumber', '$image', '$certificate_type' )";

        // $sql1="UPDATE imagetbl SET image = '$image', certificate_type = '$certificate_type' WHERE (imageid = '$imageid');";
        if($conn->query($sql)==true){
          $message="File uploaded and save to DB";
          header('location:adminaccount.php');

        //   $stmt = $conn->prepare($sql1);
        //     $result = mysqli_query($conn, $sql1);
        //   echo "<script type='text/javascript'>alert('$message');</script>";
          //exit();
        }else{
            echo"Error".$sql."Error Details: ".$conn->error; 
        }
    }else{
         $message="Error Moving The File";
    }
}else{
    exit();
   
}
?>