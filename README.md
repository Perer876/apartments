<h1 align="center">Depadmin</h1>

## Acerca del proyecto

Mi primer proyecto usando laravel, que permite a **arrendadores** administrar sus departamentos. Permitiendoles cosas como:

- Asignar varios departamentos a un edificio / vivienda.
- Agregar images a departamentos invividuales.
- Agregar a tus inquilinos.
- Generar contratos a diferentes plazos con tus inquilinos.
- Archivar tus inquilinos.

También permite a los **inquilinos** de los departamentos ser registrados o invitados por su arrendador para que puedan ver sus contratos e inclusive ver otros departamentos. 

## Uso

### Instalación

1. Clona el repositorio con `git clone https://github.com/Perer876/apartments.git` y muevete a la carpeta.
2. Instala los paquetes y dependencias `composer install`.
3. Crea tu propio archivo para las variables de entorno, puedes usar `cp .env.example .env` y agrega las credenciales para tu conexión a la base de datos y al servidor de correo.
4. Genera una llave unica para tu proyecto, puedes usar el comando `php artisan key:generate`

### Configuración

Para poder empezar a usar la aplicación por primera vez, primero ejecutamos las migraciones con `php artisan migrate` y después ejecutamos un seeder necesario para el correcto funcionamiento del sistema de roles `php artisan db:seed --class=RoleSeeder`

Por ultimo, para acceder a las images desde la web que se alojen en el servidor web será necesario ejecutar `php artisan storage:link`

## Vistas

### Página de incio

![Image](https://github.com/Perer876/apartments/blob/assets/images/home_page.png)

### Listado de viviendas

![Image](https://github.com/Perer876/apartments/blob/assets/images/buildings_page.png)

### Mostrando una vivienda

![Image](https://github.com/Perer876/apartments/blob/assets/images/building_page.png)

### Mostrando un departamento en concreto

![Image](https://github.com/Perer876/apartments/blob/assets/images/apartment_page.png)

### Listado de inquilinos

![Image](https://github.com/Perer876/apartments/blob/assets/images/tenants_page.png)

### Mostrando un inquilino en concreto

![Image](https://github.com/Perer876/apartments/blob/assets/images/tenant_page.png)

### Vista resposiva

![Image](https://github.com/Perer876/apartments/blob/assets/images/phone_view.png)

## License

Depadmin is under [MIT License](./LICENSE).

## Todo

Le falta mucho para ser una herramienta útil y eficiente. Un lista incial sería:
- [ ] Mejora en la eficiencia del full-text-search.
- [ ] Cambio en algunas vistas para ahcer uso de Livewire y añadir más reactividad.
- [ ] Tener un historial de las rentas mensuales que ha tenido un departamento.
- [ ] Tener vistas únicas de un contrato y ver su progreso.
- [ ] Cambiar método de consulta del estado de un contrato a nivel de base de datos (para poder ordenar) y hacerlo más flexible. 
- [ ] Agregar vistas en la pagina welcome acerca de departamentos.
