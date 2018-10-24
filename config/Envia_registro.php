<?php
require("Controlador/ConfigBD.php");

if (!empty($_POST)) {
    mysql_query('SET CHARACTER SET utf8');
    $LAFecha=date("Y")."-".date("m")."-".date("d")." ".(date("H")).":".date("i").":".date("s");

    $query = "SELECT 1 FROM Clientes WHERE Email = :Dato3";
    
    $query_params = array(
        ':Dato3' => $_POST['Dato3']
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
    if ($row) {
                
        $response["success"] = 0;
        $response["message"] = "Lo siento el usuario ya existe";
        die(json_encode($response));
    }
        
    $Dato1 =utf8_encode($_POST['Dato1']);//nombre
    $Dato2 =utf8_encode($_POST['Dato2']);//apellido
    $Dato3 =utf8_encode($_POST['Dato3']);//email
    $Dato4 =utf8_encode($_POST['Dato4']);//Ciudad
    $Dato5 =sha1(utf8_encode($_POST['Dato5']));//contraseña
    $Dato6 =utf8_encode($_POST['Dato6']);//direccion
    $Dato7 =utf8_encode($_POST['Dato7']);//telefono
    
    
    $query = "INSERT INTO Clientes (IdCliente, Nombres, Apellidos, Email, Ciudad, Telefono, Direccion, Contrasena) VALUES (null, ?,?,?,?,?,?,?)";
      
    try {
        $stmt   = $db->prepare($query);
        $result = $stmt->execute(array($Dato1,$Dato2,$Dato3,$Dato4,$Dato7,$Dato6,$Dato5));
    }
    catch (PDOException $ex) {
        
        $response["success"] = 0;
        $response["message"] = "Error base de datos2. Porfavor vuelve a intentarlo";
        die(json_encode($response));
    }
    
    $response["success"] = 1;
    $response["message"] = "Registrado, Por favor inicie sesión";
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
     Dato4:<br /> 
     <input type="text" name="Dato4" value="" /> 
     <br /><br /> 
     Dato5:<br /> 
     <input type="text" name="Dato5" value="" /> 
     <br /><br />
     <input type="submit" value="Enviar datos" /> 
 </form>
 <?php
}

?>