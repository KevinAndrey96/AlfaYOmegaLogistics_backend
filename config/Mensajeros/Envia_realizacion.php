<?php
require("../Controlador/ConfigBD.php");

if (!empty($_POST)) {
    mysql_query('SET CHARACTER SET utf8');

    $Dato1 =utf8_encode($_POST['Dato1']);//pin
    $Dato2 =utf8_encode($_POST['Dato2']);//documento
    
    $query = "UPDATE Servicios set 
    Estado = 'Completado'
    where IdServicio = ?
    ";
      
    try {
        $stmt   = $db->prepare($query);
        $result = $stmt->execute(array($Dato1));
    }
    catch (PDOException $ex) {
        
        $response["success"] = 0;
        $response["message"] = "Error base de datos 2. Porfavor vuelve a intentarlo";
        die(json_encode($response));
    }
    
    $response["success"] = 1;
    $response["message"] = "Servicio completado con exito";
    echo json_encode($response);

    
} else {
?>
 <h1>Registro</h1> 
 <form action="" method="post"> 
     Dato1:<br /> 
     <input type="text" name="Dato1" value="" /> 
     <br /><br /> 
     Dato2:<br /> 
     <input type="text" name="Dato2" value="" /> 
     <br /><br /> 
     Dato3:<br /> 
     <input type="text" name="Dato3" value="" /> 
     <br /><br /> 
     <input type="submit" value="Enviar datos" /> 
 </form>
 <?php
}

?>