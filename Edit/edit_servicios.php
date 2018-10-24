<?php
require_once "../controlador/conexion.php";

$id = $_POST['id'];
$Cliente = $_POST['Cliente'];
$Tipo = $_POST['Tipo'];
$Km = $_POST['Km'];
$CoordenadasOrigen = $_POST['CoordenadasOrigen'];
$CoordenadasDestino = $_POST['CoordenadasDestino'];
$DireccionOrigen = $_POST['DireccionOrigen'];
$DireccionDestino = $_POST['DireccionDestino'];
$Descripcion = $_POST['Descripcion'];
$Valor = $_POST['Valor'];
$Mensajero = $_POST['Mensajero'];
$Estado = $_POST['Estado'];
$FechaSolicitud = $_POST['FechaSolicitud'];
$FechaEntrega = $_POST['FechaEntrega'];

if($_POST['oper']=='edit')
{
    $consulta  = "UPDATE Servicios SET
    Cliente = '$Cliente',
    Tipo = '$Tipo',
    Km = '$Km',
    CoordenadasOrigen = '$CoordenadasOrigen',
    CoordenadasDestino = '$CoordenadasDestino',
    DireccionOrigen = '$DireccionOrigen',
    DireccionDestino = '$DireccionDestino',
    Descripcion = '$Descripcion',
    Valor = '$Valor',
    Mensajero = '$Mensajero',
    Estado = '$Estado',
    FechaSolicitud = '$FechaSolicitud',
    FechaEntrega = '$FechaEntrega'
    WHERE IdServicio = '$id' ";
    $resultado1 = @mysql_query($consulta) ;
    
}
if($_POST['oper']=='add')
{
    $consult1  = "INSERT INTO Servicios (Cliente,Tipo,Km,CoordenadasOrigen,CoordenadasDestino,DireccionOrigen,DireccionDestino,Descripcion,Valor,Mensajero,Estado,FechaSolicitud,FechaEntrega) VALUES ('".$Cliente."','".$Tipo."','".$Km."','".$CoordenadasOrigen."','".$CoordenadasDestino."','".$DireccionOrigen."','".$DireccionDestino."','".$Descripcion."','".$Valor."','".$Mensajero."','".$Estado."','".$FechaSolicitud."','".$FechaEntrega."')";
    $resultado1 = @mysql_query($consult1) ;
    
}
if($_POST['oper']=='del')
{
    $consult2  = "DELETE FROM Servicios where IdServicio='$id'";
    $resultado2 = @mysql_query($consult2) ;
    
}
?>