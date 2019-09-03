<html lang="en">


<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

        <style>
            table.dataTable thead .sorting:after,
            table.dataTable thead .sorting:before,
            table.dataTable thead .sorting_asc:after,
            table.dataTable thead .sorting_asc:before,
            table.dataTable thead .sorting_asc_disabled:after,
            table.dataTable thead .sorting_asc_disabled:before,
            table.dataTable thead .sorting_desc:after,
            table.dataTable thead .sorting_desc:before,
            table.dataTable thead .sorting_desc_disabled:after,
            table.dataTable thead .sorting_desc_disabled:before {
            bottom: .5em;
            }
        </style>
</head>
<?php

$connection = new mysqli("localhost", "root", "password", "db");
$sql = "SELECT * FROM participants";
$result=mysqli_query($connection,$sql);
?>
<body>
<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">First Name
      </th>
      <th class="th-sm">Last Name
      </th>
      <th class="th-sm">NIC
      </th>
      <th class="th-sm">Email
      </th>
      <th class="th-sm">Confirmation
      </th>
      <th class="th-sm">Participation
      </th>
    </tr>
  </thead>
  <tbody>
      <?php
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
                    
            echo "<tr>";
            echo "<td>".$row["firstname"]."</td>";
            echo "<td>".$row["lastname"]."</td>";
            echo "<td>".$row["email"]."</td>";
            echo "<td>".$row["nic"]."</td>";
            echo "<td><input type='button' id='".$row["id"]."' class='btn btn-primary' value='not confirmed'></td>";
            echo "<td><input type='button' id='".$row["id"]."' class='btn btn-primary' value='not participated'></td>";
            echo "</tr>";
            }
        } else {
            echo "0 results";
        }

      ?>
  </tbody>
  <tfoot>
    <tr><th class="th-sm">First Name
      </th>
      <th class="th-sm">Last Name
      </th>
      <th class="th-sm">NIC
      </th>
      <th class="th-sm">Email
      </th>
      <th class="th-sm">Confirmation
      </th>
      <th class="th-sm">Participation
      </th>
    </tr>
  </tfoot>
</table>

<script>
$(document).ready(function () {
$('#dtBasicExample').DataTable();
$('.dataTables_length').addClass('bs-select');
});
</script>

<script>
$(":button").click(function(e) {
    if($(this).val()=="not confirmed"){
    
    $.ajax({
        type: "POST",
        url: "ViewController.php",
        data: { 
            confirm: 'true',
            id:$(":button").get(0).id;
        },
        success: function(result) {
            // alert('ok');
            $(this).addClass('.btn btn-success');
            $(this).val("confirmed");
            
        },
        error: function(result) {
            alert('error');
        }
    });
    }else if($(this).val()=="confirmed")){
        $.ajax({
        type: "POST",
        url: "ViewController.php",
        data: { 
            confirm: 'true',
            id:$(":button").get(0).id;
        },
        success: function(result) {
            // alert('ok');
            $(this).addClass('.btn btn-primary');
            $(this).val("not confirmed");
            
        },
        error: function(result) {
            alert('error');
        }
    });


    }else if($(this).val()=="participated")){
        $.ajax({
        type: "POST",
        url: "ViewController.php",
        data: { 
            participate: 'true',
            id:$(":button").get(0).id;
        },
        success: function(result) {
            // alert('ok');
            $(this).addClass('.btn btn-primary');
            $(this).val("not participated");
            
        },
        error: function(result) {
            alert('error');
        }
    });

    }else if($(this).val()=="not participated"){
        $.ajax({
        type: "POST",
        url: "ViewController.php",
        data: { 
            participate: 'true',
            id:$(":button").get(0).id;
        },
        success: function(result) {
            // alert('ok');
            $(this).addClass('.btn btn-success');
            $(this).val("participated");
            
        },
        error: function(result) {
            alert('error');
        }
    });
    }
});
</script>
</body>

</html>