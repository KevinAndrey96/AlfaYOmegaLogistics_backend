<?php
require("../Controlador/ConfigBD.php");
if (!empty($_POST)) {
	mysql_query('SET CHARACTER SET utf8');
	$LAFecha=date("Y")."-".date("m")."-".date("d")." ".(date("H")).":".date("i").":".date("s");

	$query = "SELECT 1 FROM Mensajeros WHERE Documento = :Dato1";

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
		$response["message"] = "El Usuario no existe";
		die(json_encode($response));
	}
	else{   
    $Dato1 =utf8_encode($_POST['Dato1']);//Usuario
    $Dato2 =utf8_encode($_POST['Dato2']);//Contraseña

    $query = "SELECT * from Mensajeros where Documento=?";

    try {
    	$stmt   = $db->prepare($query);
    	$result = $stmt->execute(array($Dato1));
    }
    catch (PDOException $ex) {

    	$response["success"] = 0;
    	$response["message"] = "Error base de datos2. Porfavor vuelve a intentarlo";
    	die(json_encode($response));
    }
    $row = $stmt->fetch();
    if ($row) {
    	if($row["Contrasena"]==sha1($Dato2))
    	{
    		$response["success"] = 1;
    		$response["message"] = "Login OK";
    	}
    	else
    	{
    		$response["success"] = 0;
    		$response["message"] = "Contraseña incorrecta";
    	}
    	die(json_encode($response));
    }
}
echo json_encode($response);

} else {
	?>
	<h1>Login</h1> 
	<form action="Validar_login.php" method="post"> 
		Username:<br /> 
		<input type="text" name="Dato1" placeholder="username" /> 
		<br /><br /> 
		Password:<br /> 
		<input type="password" name="Dato2" placeholder="password" value="" /> 
		<br /><br /> 
		<input type="submit" value="Login" /> 
	</form> 

	<?php
}

?> 