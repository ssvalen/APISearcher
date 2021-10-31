# APISearcher
API Searcher es una API que centraliza otros servicios de búsqueda para que quién consuma el servicio tenga un solo endpoint en donde coloque su criterio de búsqueda y esta API realice búsquedas en otros servicios.


## HTTP

Todas las transferencias de datos siguen el protocolo HTTP/1.1 y los puntos finales de conexión deben utilizar HTTPS. Dado que la APISearcher está basada en HTTP, funciona con cualquier lenguaje que tenga una biblioteca HTTP, como cURL. Esto significa que la API se puede utilizar directamente en el navegador. Por ejemplo, solicitar la siguiente URL en el navegador:

    curl --location --request GET "https://www.apisearcher.oficinacentral.info/api?search=<search_parameter>"

El control sobre la búsqueda de la API y los datos exportados está disponible en la siguiente URL:

```
https://www.apisearcher.oficinacentral.info/api?search=<search_parameter>
```

### Métodos HTTP aceptados

La API acepta solamente el método HTTP GET, cualquier otro método arrojará un [error 405](https://github.com/ssvalen/APISearcher/blob/main/README.md#soluci%C3%B3n-de-problemas "error 405").


## Opciones de búsqueda:
En la siguiente tabla se definen los valores de los parámetros de búsqueda que se pueden especificar para buscar contenidos dentro de la API:

| Tipos de medios | |
| ------------- | ------------- |
| all  | Busca todos los tipos de medios (por defecto)  |
| movie  | Busca solo películas  |
| tvShow  | Busca solo series  |
| music  | Busca solo música  |
| name  | Busca solo nombres  |

### ¿Cómo implementar las opciones de búsquedad?
Para implementar las opciones de búsqueda debemos agregar la variable **&media=<media_parameter>** a nuestra URL:
```
https://www.apisearcher.oficinacentral.info/api?search=<search_parameter>&media=<media_parameter>
```


Por ejemplo, si queremos buscar solo películas, la URL quedaría de esta manera:

```
https://www.apisearcher.oficinacentral.info/api?search=<search_parameter>&media=movie
```

## Comprendiendo los resultados de búsqueda:
La API devuelve los resultados de su búsqueda en formato de notación de objetos de JavaScript (JSON).

```
curl --location --request GET "https://www.apisearcher.oficinacentral.info/api?search=<search_parameter>&media=all"
```

Ejemplo de salida:
```json
{
    "mediaType": "all",
    "searchResults": {
        "tvShows": [
            {
                "searchSource": "..."
            }
        ],
        "movies": [
            {
                "searchSource": "..."
            }
        ],
        "music": [
            {
                "searchSource": "..."
            }
        ],
        "nameList": [
            {
                "ID": "...",
                "Name": "...",
                "SSN": "...",
                "DOB": "..."
            }
        ]
    }
}
```

## Solución de problemas
Si estás encontrando algunos errores en la API, aquí tienes una lista de explicaciones a algunos de los problemas que puedes estar experimentando:

### Error 400

El código de estado **400 Bad Request** indica que el servidor no puede procesar la solicitud debido a una solicitud mal formada por parte del cliente. Este error aparecerá cuando no se inlcuya la variable **&search=<search_parameter>** en la URL.

```
https://www.apisearcher.oficinacentral.info/api
```

```json
{
    "message": "400 Bad Request: Request must include search parameter!"
}
```

### Error 404
Normalmente, este error se presenta cuando no logramos encontrar el criterio de búsqueda. Cuando este error aparezca podrás observar el siguiente mensaje:
```json
{
    "message": "No matches were found.",
    "mediaType": "..."
}

```
### Error 405
El código de error **405 HTTP Method Not Allowed** indica que el método de solicitud es conocido por el servidor pero no es soportado por el recurso de destino. **El servidor generará un campo de cabecera "Allow"** en una respuesta 405 que contendrá una lista de los métodos soportados actualmente por el recurso de destino.
```json
{
    "message": "405 HTTP Method Not Allowed"
}

```
### Error 500

El error **500 Internal Server Error** puede ser causado por un error durante la ejecución o por un error en el servidor. Significa que el servidor encontró una condición inesperada que le impide cumplir con la solicitud solicitada. 

```json
{
    "message": "500 Internal Server Error"
}

```
