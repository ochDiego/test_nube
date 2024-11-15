# API de Inventario de Mangas

Esta API permite gestionar el inventario de mangas en una tienda. Incluye areas de acceso publico y privado, y las operaciones CRUD para los mangas.

## Rutas de la API

### Zona Publica

#### Listar todos los mangas

-   **Endpoint**: `GET /api/mangas`
-   **Descripcion**: Devuelve una lista de todos los mangas, incluyendo sus categorias y subcategorias.

### Zona Privada

### Crear un nuevo manga

-   **Endpoint**: `POST /api/mangas`
-   **Descripcion**: Crea un nuevo manga.
-   **Campos requeridos**:
    titulo (string): El título del manga.
    portada (file): Imagen de portada (JPEG o PNG, máximo 2MB).
    categoria_id (int): ID de la categoria del manga.

### Actualiza un manga existente

-   **Endpoint**: `PUT /api/mangas/{id}`
-   **Descripcion**: Actualiza los datos de un manga.
-   **Parametro de URL**: id (int), ID del manga.
-   **Campos opcionales**:
    titulo (string): El titulo del manga.
    portada (file): Nueva imagen de portada.
    categoria_id (int): Nueva categoria.

### Eliminar un manga

-   **Endpoint**: `DELETE /api/mangas/{id}`
-   **Descripcion**: Elimina un manga del inventario.
-   **Parametro de URL**: id (int), ID del manga.

## Puntos clave para la implementación

-   **Autenticacion**: La autenticacion es manejada con Laravel Sanctum para proteger las rutas privadas.
-   **Relaciones**: La API maneja categorias y subcategorias de manera dinamica, permitiendo que las categorias contengan varias subcategorías.
-   **Almacenamiento de imagenes**: Las imagenes de portada se almacenan en el sistema de archivos de Laravel bajo el directorio storage/app/public/images.
-   **Estructura de respuesta**: La API responde en formato JSON.
