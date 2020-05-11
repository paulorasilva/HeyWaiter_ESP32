<!doctype html>
  <html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Material Design for Bootstrap fonts and icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">

    <!-- Material Design for Bootstrap CSS -->
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
    <meta http-equiv="refresh" content="6">
    <title>Hey, Waiter!</title>

    <?php 
      include("files/nav.php");
    ?>
  </head>

  <body>



    <?php   
      $conn = new mysqli ("localhost","root","","hey_waiter");
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      } 
      
      $sql = "SELECT id, tableNumber, request, timer FROM app ORDER BY timer DESC";
        
      if ($result = $conn->query($sql)) {

    ?>
            
            
      <!--Table Head -->
      <table class="table table-hover text-right" >
      <thead>
      <tr>
      <th scope="col ">Table</th>
      <th scope="col">Request</th>
      <th scope="col">Time</th>
      <th scope="col"></th>  
      </tr>
      <thead>



    <?php

      while ($row = $result->fetch_assoc()) {
      $row_id = $row["id"];
      $row_tableNumber = $row["tableNumber"];
      $row_request = $row["request"];
      $row_timer = $row["timer"];

    ?>



      <!-- Table Body-->
      <tbody>
        <tr>
        <td><?php echo $row_tableNumber ?></td>
        <td>
          <?php if($row_request === "waiter"){?> <span class="badge badge-warning">Hey, Waiter!<?php }if($row_request === "payment"){?><span class="badge badge-success">Payment <?php } ?>
        </td>
        <td><span class="badge badge-danger"><?php echo $row_timer ?></td>
        <td><a class="btn btn-primary" href="esp32_index.php?id=<?php echo $row_id; ?>" role="button">X</a></td>

        </tr>
      </tbody>



    <?php
                
  
        }
        $result->free();
          
      }
          
    ?>

      <!-- Close Table Body -->
      </table>


    <?php
    if(isset($_GET['id'])){
        $id_item = addslashes($_GET['id']);
        $result = $conn->query("DELETE FROM app WHERE id = $id_item");

        header("Refresh: 0; url=esp32_index.php");
    }

      $conn->close();
    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>
    <script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>
  </body>
</html>
