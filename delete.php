<?php
include('./connect.php');
session_start();
// $search = $_POST['search'] ?? "";
$imageid=$_POST['imageid'] ?? "";

$sql = "DELETE FROM project.imagetbl WHERE imageid=$imageid";
$stmt = $conn->prepare($sql);
if ($stmt)
    {
        if ($stmt->execute()) 
            {
            // header("Location: display.php");
            $imageid=$_POST['imageid'] ?? "";
            $sql = "DELETE FROM project.imagetbl WHERE imageid=$imageid";
            $stmt = $conn->prepare($sql);
            }else
            {   
            echo "Error deleting record: " . $stmt->error;
            }
            header('location:adminaccount.php');
    }
    $stmt->close();

?>


