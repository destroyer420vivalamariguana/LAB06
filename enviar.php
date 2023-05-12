<?php
if(!isset($_POST['celular'])){
    header('Location: index.php?mensaje=error');
    exit();
}
include 'model/conexion.php';

$celular = $_POST['celular'];
$nombre= $_POST["nombre"];
$celularTrim=str_replace(" ","",$celular);

$url = 'https://api.green-api.com/waInstance1101818023/SendFileByUpload/02bc785ba8d946eb976fee5b7613ef37460ed0539605472481';

$filePath = 'page/apu2.png';

$fileHandle = fopen($filePath, 'r');


$sentencia = $bd -> query("select * from productos");
$productos = $sentencia->fetchAll(PDO::FETCH_OBJ);
$total=0;
$detalles="";
$fecha = date("d/m/Y");
foreach($productos as $producto){
    $subtotal=$producto->cantidad*$producto->precioProducto;
    $detalles=$detalles."- ".$producto->cantidad. " ". $producto->nombreProducto. " por S/.". $subtotal."\n";
    $total=$total+$subtotal;
}
//echo $detalles;
$payload = array(
    'chatId' => "51".$celularTrim."@c.us",
    'caption' => "*_BOLETA DE PAGO_* \n\n"
    . "*A Nombre de:* _".$nombre."_\n\n"
    . "*Fecha de emisión:* "."_".$fecha."_\n\n"
    . "*Detalles de pago:*\n"
    . "```".$detalles."```"
    . " *Monto Total:* _S/.".$total."_\n\n"
    . "Gracias por su compra."
);
$files = array(
    'file' => new CURLFile($filePath, 'image/png', 'apu2.png')
);
$data = array_merge($payload, $files);
$headers = array();
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_FILETIME, true);

$response = curl_exec($ch);
if ($response === false) {
    header('Location: index.php?mensaje=error');
    exit();
}else{
    curl_close($ch);
    echo $response;
    echo $celular ."<br>";
    echo $celularTrim ."<br>";
    include("comprar.php");
    header('Location: index.php');
}




?>