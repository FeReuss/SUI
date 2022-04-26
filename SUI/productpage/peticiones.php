<?php
    require __DIR__ . '/funciones.php';
    if (isset($_GET['delete'])){
        if(isset($_GET['int'])){
            /*Obtener variables a borrar*/
            $borrables = $_GET['delete'];
            $int = $_GET['int'];
            $arrayborrable = explode('_', $borrables);

            foreach($arrayborrable as $x){
                $x = trim($x);
                $serverName = "localhost"; 
                $userName = "root";   
                $password = "";
                $dbName = "mysql"; 

                $connectionInfo = array( "Database"=>"dbName", "UID"=>"userName", "PWD"=>"password"); 

                /* Connect using SQL Server Authentication. */  
                /*$conn = sqlsrv_connect($serverName, $connectionInfo);  */
                $conn = mysqli_connect($serverName, $userName, $password,$dbName); 

                $sql = "DELETE FROM `ubicaciones` WHERE `Ubicacion`='$x' AND `IntCode`=$int";
                print_r($sql);
                $result = $conn->query($sql);

            }
            header("Location: product_page.php?int=$int");


        }
    }
    /* Funcion añadir ubicaciones */
    if (isset($_GET['add'])){
        if(isset($_GET['int'])){
            /*Obtener variables a borrar*/
            $anadibles = $_GET['add'];
            $int = $_GET['int'];
            $arrayanadible = explode('_', $anadibles);

            foreach($arrayanadible as $x){
                $serverName = "localhost"; 
                $userName = "root";   
                $password = "";
                $dbName = "mysql"; 

                $connectionInfo = array( "Database"=>"dbName", "UID"=>"userName", "PWD"=>"password"); 

                /* Connect using SQL Server Authentication. */  
                /*$conn = sqlsrv_connect($serverName, $connectionInfo);  */
                $conn = mysqli_connect($serverName, $userName, $password,$dbName);
                
                $sql = "SELECT `Ubicacion` FROM `ubicaciones` WHERE `Ubicacion`='$x' AND `IntCode`=$int";
                $result = $conn->query($sql);

                if($result->num_rows == 0){
                    $sql = "INSERT INTO `ubicaciones` (`IntCode`, `Ubicacion`) VALUES ('$int', '$x')";
                    $result = $conn->query($sql);
                }

            }
            header("Location: product_page.php?int=$int");
        }
    }
    if (isset($_POST['Ubicacion']) && isset($_POST['Ingreso'])){
        $Ubicacion = $_POST['Ubicacion'];
        $ingreso = $_POST['Ingreso'];
        $arrayint = [];       
        $arrayingreso = explode("\n", $ingreso);
        foreach($arrayingreso as $x){
            $x = trim($x);
            if ($x !=''){
                $int = findint($x);
                echo $int;
                if($int != "Codigo interno no encontrado"){
                    array_push($arrayint, $int);
                }
            }

        }
        print_r($arrayint);
        foreach($arrayint as $x){
            $serverName = "localhost"; 
            $userName = "root";   
            $password = "";
            $dbName = "mysql"; 

            $connectionInfo = array( "Database"=>"dbName", "UID"=>"userName", "PWD"=>"password"); 

            /* Connect using SQL Server Authentication. */  
            /*$conn = sqlsrv_connect($serverName, $connectionInfo);  */
            $conn = mysqli_connect($serverName, $userName, $password,$dbName);
            
            $sql = "SELECT `Ubicacion` FROM `ubicaciones` WHERE `Ubicacion`='$Ubicacion' AND `IntCode`='$x'";
            $result = $conn->query($sql);

            if($result->num_rows == 0){
                $sql = "INSERT INTO `ubicaciones` (`IntCode`, `Ubicacion`) VALUES ('$x', '$Ubicacion')";
                $result = $conn->query($sql);
            }
        }
        header("Location: ../index.html");
    }
?>