<?php
require_once "../controlador/conexion.php";

$id = $_POST['id'];
$Nombres = $_POST['Nombres'];
$Apellidos = $_POST['Apellidos'];
$Email = $_POST['Email'];
$Ciudad = $_POST['Ciudad'];
$Telefono = $_POST['Telefono'];
$Direccion = $_POST['Direccion'];
if($_POST['oper']=='edit')
{
     $consulta  = "UPDATE Clientes SET
    Nombres = '$Nombres',
    Apellidos = '$Apellidos',
    Email = '$Email',
    Ciudad = '$Ciudad',
    Telefono = '$Telefono',
    Direccion = '$Direccion'
    WHERE IdCliente = '$id' ";
    $resultado1 = @mysql_query($consulta) ;
    
}
if($_POST['oper']=='add')
{
    $Con=substr($Nombres, 0, 3);
    $Con.="alfa2016";
    $Con = strtolower ( $Con );
    $consult1  = "INSERT INTO Clientes (Telefono,Nombres,Apellidos,Contrasena,Email,Ciudad,Direccion) VALUES ('".$Telefono."','".$Nombres."','".$Apellidos."','".sha1($Con)."','".$Email."','".$Ciudad."','".$Direccion."')";
    $resultado1 = @mysql_query($consult1) ;
    
}
if($_POST['oper']=='del')
{
    $consult2  = "DELETE FROM Clientes where IdCliente='$id'";
    $resultado2 = @mysql_query($consult2) ;
    
}
?>