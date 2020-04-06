<?php

/* 
PRUEBAS PHP

Inicio el servidor en la terminal 1, aqui le asignamos el puerto 8000
php -S localhost:8000 server.php

GET
Consulta todos los libros con server.php
curl "http:localhost:8000?resource_type=books"

Consulta libro especifico con server.php
curl "http:localhost:8000?resource_type=books&resource_id=1"

Consulta todos los libros con router.php
curl "http:localhost:8000/books"

Consulta libro especifico con router.php
curl "http:localhost:8000/books/2"

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

AUTENTICACION HMAC
curl http://localhost:8000/books -H 'X-HASH : a8f0ea23877e6d4ba658d4871910063efceb2b34' -H 'X-UID: 1' -H 'X-TIMESTAMP: 1585851283'

AUTENTICACION VIA TOKEN
Solicitar Token
curl http://localhost:8001 -X 'POST' -H 'X-Client-Id: 1' -H 'X-Secret:SuperSecreto!'

Autenticarse
curl http://localhost:8000/books -H 'X-Token:c4b02a1525349e7888d4140dcd524aff2d6296dd'