<?php
require("../Controlador/ConfigBD.php");

if (!empty($_POST)) {
    mysql_query('SET CHARACTER SET utf8');
    $query = "SELECT 1 FROM Mensajeros WHERE Documento = :Dato1 and Contrasena = :Dato2";
    
    $query_params = array(
        ':Dato1' => $_POST['Dato1'],
        ':Dato2' => sha1($_POST['Dato2'])
    );
    
    try {
        
        $stmt   = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch (PDOException $ex) {
                
        $response["success"] = 0;
        $response["message"] = "Error en la base de datos";
        die(json_encode($response));
    }
    
    $row = $stmt->fetch();
    if (!$row) {
                
        $response["success"] = 0;
        $response["message"] = "La contraseña actual es incorrecta";
        die(json_encode($response));
    }
    $Dato1 =utf8_encode($_POST['Dato1']);//Documento
    $Dato2 =utf8_encode($_POST['Dato2']);//Contra Ant
    $Dato3 =utf8_encode($_POST['Dato3']);//Contra Nuev
    
    $query = "UPDATE Mensajeros set 
    Contrasena = ?
    where Documento = ?
    ";
      
    try {
        $stmt   = $db->prepare($query);
        $result = $stmt->execute(array(sha1($Dato3),$Dato1));
    }
    catch (PDOException $ex) {
        
        $response["success"] = 0;
        $response["message"] = "Error base de datos 2. Porfavor vuelve a intentarlo";
        die(json_encode($response));
    }
    
    $response["success"] = 1;
    $response["message"] = "Contraseña cambiada con exito";
    echo json_encode($response);

    
} else {
?>
 <h1>Registro</h1> 
 <form action="register.php" method="post"> 
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