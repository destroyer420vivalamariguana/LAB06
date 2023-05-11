<?php
if(!isset($_POST['celular'])){
    header('Location: index.php?mensaje=error');
    exit();
}
include 'model/conexion.php';

$celular = $_POST['celular'];
$nombre= $_POST["nombre"];

$url = 'https://api.green-api.com/waInstance1101818587/SendMessage/bc5b6f845f1e42f9b30d4acff8e71d0f127962e6bea14b248c';
$data = [
    "chatId" => "51".$celular."@c.us",
    "message" =>  'Estimado(a) '.$nombre.' '.'GRACIAS POR SU COMPRA'
];
$options = array(
    'http' => array(
        'method'  => 'POST',
        'content' => json_encode($data),
        'header' =>  "Content-Type: application/json\r\n" .
            "Accept: application/json\r\n"
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
$response = json_decode($result);
echo var_dump($response); 

?>