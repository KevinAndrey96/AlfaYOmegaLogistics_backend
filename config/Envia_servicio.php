<?php
require("Controlador/ConfigBD.php");
$LAFecha=date("Y")."-".date("n")."-".date("j")." ".(date("H")).":".date("i").":".date("s");
if (!empty($_POST)) {
    mysql_query('SET CHARACTER SET utf8');
    $query = "SELECT 1 FROM Clientes WHERE Email = :Dato1";
    
    $query_params = array(
        ':Dato1' => $_POST['Dato1']
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
        $response["message"] = "Se presento un error por favor cierre y vuelva a iniciar la sesion";
        die(json_encode($response));
    }
    $Dato1 =utf8_encode($_POST['Dato1']);//ususario
    $Dato2 =utf8_encode($_POST['Dato2']);//tipo
    $Dato3 =utf8_encode($_POST['Dato3']);//tipo
    $Dato4 =utf8_encode($_POST['Dato4']);//cordori
    $Dato5 =utf8_encode($_POST['Dato5']);//corddes
    $Dato6 =utf8_encode($_POST['Dato6']);//diror
    $Dato7 =utf8_encode($_POST['Dato7']);//dirdes
    $Dato8 =utf8_encode($_POST['Dato8']);//descri
    $Dato9 =utf8_encode($_POST['Dato9']);//valor

    if($Dato2=='Especial')
    {
        $query = "INSERT into Servicios (Cliente,Tipo,Km,CoordenadasOrigen,CoordenadasDestino,DireccionOrigen,DireccionDestino,Descripcion,Valor,Mensajero,Estado,FechaSolicitud,FechaEntrega)
    values (?,?,?,?,?,?,?,?,?,'Espera','Solicitud',?,'')
    ";
    $Dato9=0;
    }
    else
    {
        $query = "INSERT into Servicios (Cliente,Tipo,Km,CoordenadasOrigen,CoordenadasDestino,DireccionOrigen,DireccionDestino,Descripcion,Valor,Mensajero,Estado,FechaSolicitud,FechaEntrega)
    values (?,?,?,?,?,?,?,?,?,'Espera','Espera',?,'')
    ";
    }
    
    
      
    try {
        $stmt   = $db->prepare($query);
        $result = $stmt->execute(array($Dato1,$Dato2,$Dato3,$Dato4,$Dato5,$Dato6,$Dato7,$Dato8,$Dato9,$LAFecha));
    }
    catch (PDOException $ex) {
        
        $response["success"] = 0;
        $response["message"] = "Error base de datos 2. Porfavor vuelve a intentarlo";
        die(json_encode($response));
    }
    
    $response["success"] = 1;
    $response["message"] = "Se ha solicitado su servicio";
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