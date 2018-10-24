<?php
require_once '../Controlador/db_connect.php';
if(!empty($_POST))
{

    $response = array();
    $P=$_POST['Parametro'];
    $db = new DB_CONNECT();
    mysql_query('SET CHARACTER SET utf8');

    $result = mysql_query("SELECT * from Mensajeros where Documento='$P'") or die(mysql_error());
    if (mysql_num_rows($result) > 0) {
        $response["receive"] = array();
        
        while ($row = mysql_fetch_array($result)) {
            $dato = array();
            
            $dato["DATO1"] = $row["Documento"];
            $dato["DATO2"] = $row["Nombres"]." ".$row["Apellidos"];
            $dato["DATO3"] = $row["Email"];
            $dato["DATO4"] = $row["Credito"];
            
            array_push($response["receive"], $dato);
        }
        $response["success"] = 1;
        
        echo json_encode($response);
    } else {
        $response["success"] = 0;
        $response["message"] = "No se encontraron datos";
        
        echo json_encode($response);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <form action="" method="POST">
        Palabra: <input type="text" name="Parametro" value="">
        <input type="submit">
    <form>
</body>
</html>