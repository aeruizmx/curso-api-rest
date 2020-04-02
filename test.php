<?php

/* 
PRUEBAS PHP

GET
Consulta todos los libros con server.php
curl "http:localhost:8000?resource_type=books"

Consulta libro especifico con server.php
curl "http:localhost:8000?resource_type=books&resource_id=1"

Consulta todos los libros con router.php
curl "http:localhost:8000books"

Consulta libro especifico con router.php
curl "http:localhost:8000books2"

POST
Insertar json con POST
curl -X 'POST' http://localhost:8000/books -d '{"titulo":"Nuevo libro post", "id_autor":3, "id_genero":3}'

PUT
Actualizar valor con PUT
curl -X 'PUT' http://localhost:8000/books/1 -d '{"titulo":"Titulo actualizado con put", "id_autor":1, "id_genero": 2}'

DELETE
Eliminar valores con DELETE
curl -X 'DELETE' http://localhost:8000/books/1 

AUTENTICANCION HTTP
curl http://andres:1234@localhost:8000/books
