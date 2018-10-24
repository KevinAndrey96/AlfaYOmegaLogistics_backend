<?php
require_once '../Controlador/db_connect.php';
if(!empty($_POST))
{

    $response = array();
    $P=$_POST['Parametro'];
    $db = new DB_CONNECT();
    mysql_query('SET CHARACTER SET utf8');

    $result = mysql_query("SELECT * from Servicios where Estado='Espera' order by IdServicio ASC") or die(mysql_error());
    if (mysql_num_rows($result) > 0) {
        $response["receive"] = array();
        
        while ($row = mysql_fetch_array($result)) {
            $dato = array();
            
            $dato["DATO1"] = $row["IdServicio"];
            $dato["DATO2"] = $row["Tipo"];
            $dato["DATO3"] = $row["Estado"];
            $dato["DATO4"] = $row["DireccionOrigen"];
            $dato["DATO5"] = $row["DireccionDestino"];
            $dato["DATO6"] = $row["Km"];
            $dato["DATO7"] = $row["FechaSolicitud"];
            $dato["DATO8"] = $row["FechaEntrega"];
            $dato["DATO9"] = $row["Descripcion"];
            $dato["DATO10"] = $row["Valor"];
            $dato["DATO11"] = $row["Mensajero"];
            
            array_push($response["receive"], $dato);
        }
        $response["success"] = 1;
        $response["message"] = "Ok";
        
    } else {
        $response["success"] = 0;
        $response["message"] = "No se encontraron datos";
    }
    echo json_encode($response);
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