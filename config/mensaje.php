<?php
if(!empty($_POST))
{
    $response = array();
    $P=$_POST['Parametro'];
        $response["receive"] = array();
            $dato = array();
            $dato["DATO1"] = "hola";
            array_push($response["receive"], $dato);
        
        $response["success"] = 1;
        $response["message"] = "No se encontraron dato $P s";
        
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