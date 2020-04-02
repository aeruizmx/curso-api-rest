<?php

//Definimos los recursos disponibles
$allowedResorcesTypes = [
  'books',
  'authors',
  'genres',
];

//Validamos que el recurso este disponible
$resourceType = $_GET['resource_type'];

if(!in_array($resourceType, $allowedResorcesTypes)){
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
    //Consulta todos los libros con server.php
    //curl "http://localhost:8000?resource_type=books"

    //Consulta libro especifico con server.php
    //curl "http://localhost:8000?resource_type=books&resource_id=1"

    //Consulta todos los libros con router.php
    //curl "http://localhost:8000/books"

    //Consulta libro especifico con router.php
    //curl "http://localhost:8000/books/2"
    if( empty($resourceId)){
      echo json_encode($books);
    }else {
      if( array_key_exists($resourceId, $books)){
        echo json_encode($books[ $resourceId ]);
      }
    }
  break;
  case 'POST':
    //Insertar json con POST
    //curl -X 'POST' http://localhost:8000/books -d '{"titulo":"Nuevo libro post", "id_autor":3, "id_genero":3}'
    $json = file_get_contents('php://input');
    $books[] = json_decode($json, true );
    // echo array_keys( $books)[count($books) - 1];
    echo json_encode($books);
  break;
  case 'PUT':
    //Actualizar valor con PUT
    //curl -X 'PUT' http://localhost:8000/books/1 -d '{"titulo":"Titulo actualizado con put", "id_autor":1, "id_genero": 2}'
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
      //Eliminar valores con DELETE
      //curl -X 'DELETE' http://localhost:8000/books/1 
      //Validamos que el recurso exista
      if(!empty($resourceId)&& array_key_exists($resourceId, $books)){
        //Eliminamos el recurso
        unset($books[$resourceId]);
      }
      //Retornamos la coleccion modificada en json
      echo json_encode($books);
  break;
}