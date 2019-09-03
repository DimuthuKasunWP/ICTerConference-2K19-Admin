<?php
$connection = new mysqli("localhost", "root", "password", "db");
if(isset($_POST["confirm"])){
    $id=$_POST['id'];
    $presql="select isConfirmed from participation where id=".$id."";
    $preResult=mysqli_query($connection,$presql);
    if ($result->num_rows > 0) {
        if($row["isConfirmed"]==0) 
            $sql="update participation set isConfirmed='true' where id='".$id."'";
        else
            $sql="update participation set isConfirmed='false' where id='".$id."'";
    $result=mysqli_query($connection,$sql);
    }

}

if(isset($_POST['participation'])){
    $id=$_POST['id'];
    $presql="select isParticipated from participation where id=".$id."";
    $preResult=mysqli_query($connection,$presql);
    if ($result->num_rows > 0) {
        if($row["isParticipated"]==0) 
            $sql="update participation set isParticipated='true' where id='".$id."'";
        else
            $sql="update participation set isParticipated='false' where id='".$id."'";
    
    $result=mysqli_query($connection,$sql);
    }
}


?>