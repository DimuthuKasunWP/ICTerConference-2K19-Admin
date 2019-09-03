<?php
include 'excel_reader.php'; 
$connection = mysqli_connect("localhost", "root", "password", "db");


$excel = new PhpExcelReader;

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["exelFile"]["tmp_name"]);
move_uploaded_file( $_FILES['file']['tmp_name'],$target_file);

$excel->read($target_file);


$nr_sheets = count($excel->sheets);       
for($i=0; $i<$nr_sheets; $i++) {
  $sheet=$excel->sheets[$i];
$x = 1;
while($x <= $sheet['numRows']) {
  
  $y = 1;
  while($y <= $sheet['numCols']) {
      $sql="create table participants(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        firstname VARCHAR(30) NOT NULL,
        lastname VARCHAR(30) NOT NULL,
        nic varchar(30),
        email VARCHAR(50),
        is_participated boolean,
        is_confirmed boolean
        )  ";
        $result=mysqli_query($connection,$sql);
        if($result){
            $sql2="insert into participants values()";
            $cell = isset($sheet['cells'][$x][$y]) ? $sheet['cells'][$x][$y] : '';
            if(mysqli_query($connection,$sql2)){
                echo "done";
            }else{
                echo "failed2";
            }
        }else{
            echo "failed1";
        }
    
    
    $y++;
  }  
  $x++;
}
}
?>