<?php
require("Controlador/ConfigBD.php");

if (!empty($_POST)) {
    mysql_query('SET CHARACTER SET utf8');
    $LAFecha=date("Y")."-".date("m")."-".date("d")." ".(date("H")).":".date("i").":".date("s");

    $query = "SELECT 1 FROM Clientes WHERE Email = :Dato1";
    
    $query_params = array(
        ':Dato1' => $_POST['Dato1'];
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
        $response["message"] = "Este usuario no registra en nuestra base de datos";
        die(json_encode($response));
    }else
    {
        $Dato1 =utf8_encode($_POST['Dato1']);
        if($row==1)
        {
            $Code = rand ( 100000 , 999999 );
            $destinatario = "$Dato1"; 
            $asunto = "Reestablecimiento de clave Alfa & Omega Logistics App"; 
            $cuerpo = '
            <html> 
            <head> 
                <title>Reestablecimiento de clave</title> 
            </head> 
            <body> 
                <!--<img src="http://alfayomegalogistics.com/admin/img/logo.png">-->
                <h1>Alfa & Omega Logistics (Reestablecimiento de clave)</h1> 
                <p> 
                Has solicitado reestablecer tu clave. para hacerlo por favor digita el siguiente código <b>'.$Code.'</b>
                </p> 
            </body> 
            </html> 
            '; 

            $headers = "MIME-Version: 1.0\r\n"; 
            $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

            $headers .= "From: Alfa & Omega Logistics<no-reply@alfayomegalogistics.com>\r\n"; 

            mail($destinatario,$asunto,$cuerpo,$headers);
        }
    }
        
    





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