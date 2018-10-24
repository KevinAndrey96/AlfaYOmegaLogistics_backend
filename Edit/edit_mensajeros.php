<?php
require_once "../controlador/conexion.php";

$id = $_POST['id'];
$Documento = $_POST['Documento'];
$Nombres = $_POST['Nombres'];
$Apellidos = $_POST['Apellidos'];
$Telefono = $_POST['Telefono'];
$Direccion = $_POST['Direccion'];
$Email = $_POST['Email'];
$Credito = 0;
$Ubicacion = "0,0";

$Direccion = $_POST['Direccion'];
if($_POST['oper']=='edit')
{
    $consulta  = "UPDATE Mensajeros SET
    Documento = '$Documento',
    Nombres = '$Nombres',
    Apellidos = '$Apellidos',
    Telefono = '$Telefono',
    Direccion = '$Direccion',
    Email = '$Email',
    WHERE IdMensajero = '$id' ";
    $resultado1 = @mysql_query($consulta) ;
    
}
if($_POST['oper']=='add')
{
    /*$Con=substr($Nombres, 0, 3);
    $Con.="alfa2016";
    $Con = strtolower ( $Con );*/
    $Con=$Documento;
    $consult1  = "INSERT INTO Mensajeros (Documento,Nombres,Apellidos,Contrasena,Telefono,Direccion,Email,Credito,Ubicacion) VALUES ('".$Documento."','".$Nombres."','".$Apellidos."','".sha1($Con)."','".$Telefono."','".$Direccion."','".$Email."','".$Credito."','".$Ubicacion."')";
    $resultado1 = @mysql_query($consult1) ;
    
}
if($_POST['oper']=='del')
{
    $consult2  = "DELETE FROM Mensajeros where IdMensajero='$id'";
    $resultado2 = @mysql_query($consult2) ;
    
}
?>