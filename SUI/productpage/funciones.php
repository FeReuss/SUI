<?php
  function findbarcode($interno){
    $serverName = "localhost"; 
    $userName = "root";   
    $password = "";
    $dbName = "mysql"; 

    $connectionInfo = array( "Database"=>"dbName", "UID"=>"userName", "PWD"=>"password"); 

    /* Connect using SQL Server Authentication. */  
    /*$conn = sqlsrv_connect($serverName, $connectionInfo);  */
    $conn = mysqli_connect($serverName, $userName, $password,$dbName); 

    $sql = "SELECT `BarCode` FROM barras WHERE `IntCode`=$interno";  

    /* Execute the query. */  

    $result = $conn->query($sql);  

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          return $row['BarCode'];
        }
      } else {
        return "Codigo no encontrado";
      }
      $conn->close();
  }
  function finddescriptor($interno){
    $serverName = "localhost"; 
    $userName = "root";   
    $password = "";
    $dbName = "mysql"; 

    $connectionInfo = array( "Database"=>"dbName", "UID"=>"userName", "PWD"=>"password"); 

    /* Connect using SQL Server Authentication. */  
    /*$conn = sqlsrv_connect($serverName, $connectionInfo);  */
    $conn = mysqli_connect($serverName, $userName, $password,$dbName); 

    $sql = "SELECT `Descriptor` FROM descriptores WHERE`IntCode`=$interno";  

    /* Execute the query. */  

    $result = $conn->query($sql);  

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          return $row['Descriptor'];
        }
      } else {
        return "Descriptor no encontrado";
      }
      $conn->close();
  }
  function findint($interno){
    $serverName = "localhost"; 
    $userName = "root";   
    $password = "";
    $dbName = "mysql"; 

    $connectionInfo = array( "Database"=>"dbName", "UID"=>"userName", "PWD"=>"password"); 

    /* Connect using SQL Server Authentication. */  
    /*$conn = sqlsrv_connect($serverName, $connectionInfo);  */
    $conn = mysqli_connect($serverName, $userName, $password,$dbName); 

    $sql = "SELECT `IntCode` FROM barras WHERE `BarCode`=$interno";  

    /* Execute the query. */  

    $result = $conn->query($sql);  

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          return $row['IntCode'];
        }
      } else {
        return "Codigo interno no encontrado";
      }
      $conn->close();
  }
  function ubications($interno){
    $serverName = "localhost"; 
    $userName = "root";   
    $password = "";
    $dbName = "mysql"; 

    $connectionInfo = array( "Database"=>"dbName", "UID"=>"userName", "PWD"=>"password"); 

    /* Connect using SQL Server Authentication. */  
    /*$conn = sqlsrv_connect($serverName, $connectionInfo);  */
    $conn = mysqli_connect($serverName, $userName, $password,$dbName); 

    $sql = "SELECT `Ubicacion` FROM ubicaciones WHERE `IntCode`=$interno";  

    /* Execute the query. */  

    $result = $conn->query($sql);  

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          if ($row['Ubicacion']!= ""){
            echo "<div><input style='display: none' disabled='true' class='checkubi' type='checkbox' id=".$row['Ubicacion'].">
            <label for='".$row['Ubicacion']."'><div style='position: relative'><img style='max-width: 20vw; max-height: 20vw' src='checkbox.png'/><text style='transform: translate(-50%, -50%); position: absolute; top: 50%; left: 50%'>".$row['Ubicacion']."</text></div></label></div>";
          }
        } 
      } else {
        return "<h1>No hay ubicaciones reportadas</h1>";
      }
      $conn->close();
  }

?>