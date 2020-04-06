<?php
/* if( !array_key_exists('HTTP_X_TOKEN',$_SERVER)){
	echo 'ACCESO PROHIBIDO';
  die;
}
$url = 'http://localhost:8001';

$ch = curl_init($url);

curl_setopt( $ch, CURLOPT_HTTPHEADER, [ "X-Token: {$_SERVER['HTTP_X_TOKEN']}"]);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);

$ret = curl_exec($ch);
echo $ret;
if( $ret !== 'true' ){
	echo 'usuario no fue correctamente autenticado';
	die;
} */
/* if(
  !array_key_exists('HTTP_X_HASH_', $_SERVER) ||
  !array_key_exists('HTTP_X_TIMESTAMP', $_SERVER) ||
  !array_key_exists('HTTP_X_UID', $_SERVER)
){
  echo 'ACCESO PROHIBIDO';
  die;
}
list($hash, $uid, $timestamp) = [
  $_SERVER['HTTP_X_HASH_'],
  $_SERVER['HTTP_X_UID'],
  $_SERVER['HTTP_X_TIMESTAMP'],
];

$secret = 'Sh!! No se lo cuentes a nadie';

$newHash = sha1($uid.$timestamp.$secret);
if($newHash !== $hash){
  echo 'ACCESO PROHIBIDO';
  die;
} */
/* 
$user = array_key_exists('PHP_AUTH_USER', $_SERVER)? $_SERVER['PHP_AUTH_USER'] : '';
$password = array_key_exists('PHP_AUTH_PW', $_SERVER)? $_SERVER['PHP_AUTH_PW'] : '';

if($user !== 'andres' || $password !== '1234'){
  echo 'ACCESO PROHIBIDO';
  die;
} 
*/

//Definimos los recursos disponibles
$allowedResorcesTypes = [
  'books',
  'authors',
  'genres',
];

//Validamos que el recurso este disponible
$resourceType = $_GET['resource_type'];

if(!in_array($resourceType, $allowedResorcesTypes)){
  http_response_code(400);
  die;
}

//Defino los recursos
$books = [
  1 => [
    'titulo' => 'Lo que el viento se llevó',
    'id_autor' => 2,
    'id_genero' => 2,
  ],
  2 => [
    'titulo' => 'La Iliada',
    'id_autor' => 1,
    'id_genero' => 1,
  ],
  3 => [
    'titulo' => 'La Odisea',
    'id_autor' => 1,
    'id_genero' => 1,
  ]
];

header ('Content-Type: application/json');

//Levantamos el ID del recurso buscado
$resourceId = array_key_exists('resource_id',$_GET) ? $_GET['resource_id'] : '';

//Generamos la respuesta, asumiendo que el pedido es correcto
switch ( strtoupper($_SERVER['REQUEST_METHOD']) ){
  case 'GET':
    
    if( empty($resourceId)){
      echo json_encode($books);
    }else {
      if( array_key_exists($resourceId, $books)){
        echo json_encode($books[ $resourceId ]);
      } else{
        http_response_code(404);
      }
    }
  break;
  case 'POST':
    $json = file_get_contents('php://input');
    $books[] = json_decode($json, true );
    // echo array_keys( $books)[count($books) - 1];
    echo json_encode($books);
  break;
  case 'PUT':
    //Validamos que el recurso buscado exista
    if(!empty($resourceId)&& array_key_exists($resourceId, $books)){
      //Tomamo la entrada cruda
      $json = file_get_contents('php://input');
      //Transformamos el json recibido a un nuevo elemento 
      $books[$resourceId] = json_decode($json, true);
      //Retornamos la coleccion modificada en json
      echo json_encode($books);
    } 
  break;
  case 'DELETE':
      //Validamos que el recurso exista
      if(!empty($resourceId)&& array_key_exists($resourceId, $books)){
        //Eliminamos el recurso
        unset($books[$resourceId]);
      }
      //Retornamos la coleccion modificada en json
      echo json_encode($books);
  break;
}