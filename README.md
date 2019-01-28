# CustomerApp

Este proyecto contiene dos componentes:
1. *beitech-be:* (backend)  API Rest realizado con el framework de PHP Lumen. 
2. *beitech-fe:* (frontend) Una aplicación web realizada con AngularJS para consumir los servicios del backend.


## Backend
La API Rest esta desarrollada con el framework Lumen con el cual se pueden realizar las siguientes acciones:

1. Consultar el listado de clientes.

2. Permite crear una órden para un cliente con hasta máximo 5 productos. Teniendo en cuenta que sólo algunos productos están permitidos para un cliente.

3. Permite listar las órdenes de un cliente por un rango de fechas.

## Despliegue Backend
1. Editar el archivo *.env* con los datos de conexión de la base de datos.
Ejemplo:
```properties
DB_HOST=127.0.0.1
DB_DATABASE=test
DB_USERNAME=root
DB_PASSWORD=1234
```
2. Descargar dependencias de Lumen:
```
composer update
```
3. Iniciar el backend en un servidor de *PHP >= 7.1.3*

## Frontend
La pagina web esta implementada en html y usa AngularJS, para conectarse con el backend hay que editar el archivo *js/app.js*

1. Dentro del archivo hay que editar la variable *urlAPI* con la url del servidor donde esta montado el backend
2. Cargar el frontend en un servidor.

## Documentación
Los diagramas y las pruebas tanto del backend como del frontend se encuentran en el siguiente documento:

<p><a href="https://github.com/jfnoguerab/customersApp/raw/master/documentation/CustomersApp.pdf">CustomersApp.pdf</a></p>
